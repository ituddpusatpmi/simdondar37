<?php
/*
Yudha T. Putra
*/

require('../tcpdf/tcpdf.php');
$link = mysql_connect('localhost', 'root', 'F201603907');
		mysql_select_db('pmi');
$lot 	= $_GET['lot'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
	public function Header() {
        $udd=mysql_fetch_assoc(mysql_query("SELECT `nama` FROM `utd` WHERE `aktif`='1'"));
        $namautd=$udd['nama'];
	    $headerData = $this->getHeaderData();
	    $this->SetFont('helvetica', 'B', 9);
        $this->Cell(0, 10, ''.$namautd.'', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', '', 9);
        $this->Cell(0, 10, 'TRACE REAGEN ARCHITECT i2000SR', 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', 'B', 9);
	    $this->writeHTML($headerData['string']);
	}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', '', 8);
        // Page number
        //$this->Cell(0, 10, 'No.Dok.:UTD BALI-UJS-L3-001', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        //$this->Cell(0, 10, 'No.Dok.:UTD BALI-UJS-L3-001', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Hal: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
    // create new PDF document
    //$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf->setHeaderData($ln='', $lw=0, $ht='',
		$hs='',
		$tc=array(0,0,0), $lc=array(0,0,0));

			
	// set document information
	$pdf->SetTitle('Data Penggunaan Reagen Arcitect i200SR');
	$pdf->SetSubject('Data Penggunaan Reagen Arcitect i200SR');
			
	// set margins
    $pdf->SetMargins(20, 20, 20, true);
	//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // add a page
	$pdf->AddPage();

	$pdf->SetFont('helvetica', 'B', 14);
	$pdf->Write(0, 'DATA PENGGUNAAN REAGENSIA ARCHITECT i2000SR', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Write(0, 'Dari tanggal '.$tglawal.' s/d '.$harini, '', 0, 'L', true, 0, false, false, 0);
			
	$pdf->SetFont('helvetica', '', 11);

	$tbl = <<<EOD
                <br><table border="0.1" cellpadding="3" cellspacing="0">
                <tr style="background-color:Gainsboro">
			        <td rowspan="2" valign="center" align="center" width="25px">NO</td>
			        <td rowspan="2" align="center" width="150px">NAMA REAGEN ARCHITECT</td>
			        <td rowspan="2" align="center" width="100px">NOMOR LOT</td>
			        <td colspan="3" align="center" width="200px">JUMLAH</td>
		        </tr>
		        <tr style="background-color:Gainsboro">
			        <td align="center" width="66px">KONTROL</td>
                    <td align="center" width="66px">SAMPEL</td>
                    <td align="center" width="67px">TOTAL</td>
                </tr>

EOD;
			//end header kolom
	$no = 0;
    $no=0;
    $ttl_b="0";
    $ttl_c="0";
    $ttl_i="0";
    $ttl_s="0";
    $sqlsmp="SELECT `parameter` as Reagan, `lot_reag`, count(`id`) as jumlah FROM `imltd_arc_raw` where
		     date(`run_time`)>='$tglawal' AND date(`run_time`)<='$harini' group by `parameter`, `lot_reag`";
    $sample=mysql_query($sqlsmp);
    while($tmp=mysql_fetch_assoc($sample)){
        $no++;
        $sqlqc ="SELECT count(`id`) as jumlah FROM `imltd_arc_qc` where
		        date(`run_time`)>='$tglawal' AND date(`run_time`)<='$harini' and `parameter`='$tmp[Reagan]' and `lot_reag`='$tmp[lot_reag]'";
        $qc=mysql_fetch_assoc(mysql_query($sqlqc));
        $ttl=$qc[jumlah]+$tmp[jumlah];
        switch ($tmp[Reagan]){
            case "HBsAgQ2"      : $ttl_b=$ttl_b+$ttl;break;
            case "Syphilis"     : $ttl_s=$ttl_s+$ttl;break;
            case "_HIV Ag/Ab"   : $ttl_i=$ttl_i+$ttl;break;
            case "Anti-HCV"     : $ttl_c=$ttl_c+$ttl;break;
            default:break;
        }
        $nmreag     =$tmp[Reagan];
        $lot        =$tmp[lot_reag];
        $jml_sqc    =$qc[jumlah];
        $jml_sample =$tmp[jumlah];

        $tbl.='
		<tr>
			<td align="right">'.$no.'</td>
			<td align="left">'.$nmreag.'</td>
			<td align="center">'.$lot.'</td>
            <td align="right">';
        $tbl.=number_format($jml_sqc,0,'','.').'</td>';
        $tbl.='
			<td align="right">';
        $tbl.=number_format($jml_sample,0,'','.').'</td>';
        $tbl.='
            <td align="right">';
        $tbl.=number_format($ttl,0,'','.').'</td>
		</tr>';
	}
    $tbl.='
        <tr style="background-color:Gainsboro">
            <td colspan="5" align="left">TOTAL PER PARAMETER</td><td></td>
        </tr>';
    $tbl.='
        <tr>
            <td colspan="5" align="left">Reagen HBsAg</td><td align="right">';
    $tbl.=number_format($ttl_b,0,'','.')."</td></tr>";
    $tbl.='
        <tr>
            <td colspan="5" align="left">Reagen Anti-HCV</td><td align="right">';
    $tbl.=number_format($ttl_c,0,'','.')."</td></tr>";
    $tbl.='
        <tr>
            <td colspan="5" align="left">Reagen Anti-HIV</td><td align="right">';
    $tbl.=number_format($ttl_c,0,'','.')."</td></tr>";
    $tbl.='
        <tr>
            <td colspan="5" align="left">Reagen Syphilis</td><td align="right">';
    $tbl.=number_format($ttl_s,0,'','.')."</td></tr>";
    $tbl.='</table>';
	$pdf->writeHTML($tbl, true, false, false, false, '');
	$namaPDF = 'Data Reagen Architect i2000sr.pdf';
	$pdf->Output($namaPDF,'I');
?>
