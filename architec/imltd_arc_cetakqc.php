<?php
/*
Yudha T. Putra
*/

require('../tcpdf/tcpdf.php');
$link = mysql_connect('localhost', 'root', 'F201603907');
		mysql_select_db('pmi');
$tglawal 	= $_GET['tgl1'];
$harini 	= $_GET['tgl2'];
$snarc		= $_GET['sn'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
	public function Header() {
        $udd=mysql_fetch_assoc(mysql_query("SELECT `nama` FROM `utd` WHERE `aktif`='1'"));
        $namautd=$udd['nama'];
	    $headerData = $this->getHeaderData();
	    $this->SetFont('helvetica', 'B', 9);
        $this->Cell(0, 10, ''.$namautd.'', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 10, 'DATA KONTROL REAGEN ARCHITECT i2000SR', 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', 'B', 8);
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
	$pdf->SetTitle('Data Kontrol Reagen Arcitect i200SR');
	$pdf->SetSubject('Data Kontrol Reagen Arcitect i200SR');
			
	// set margins
    $pdf->SetMargins(20, 20, 20, true);
	//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // add a page
	$pdf->AddPage();

	$pdf->SetFont('helvetica', 'B', 11);
	$pdf->Write(0, 'DATA KONTROL REAGENSIA ARCHITECT i2000SR', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Write(0, 'Dari tanggal '.$tglawal.' s/d '.$harini, '', 0, 'L', true, 0, false, false, 0);
			
	$pdf->SetFont('helvetica', '', 8);

	$tbl = <<<EOD
                <br><table border="0.1" cellpadding="3" cellspacing="0">
                <tr style="background-color:Gainsboro">
			        <td rowspan="2" width="25px" align="center">NO.</td>
					<td rowspan="2" width="50px" align="center">TGL</td>
					<td colspan="2" align="center">HBsAgQ2</td>
					<td colspan="2" align="center">Anti-HCV</td>
					<td colspan="4" align="center">HIV Ag/Ab</td>
					<td colspan="2" align="center">Syphilis</td>
		        </tr>
		        <tr style="background-color:Gainsboro">
		            <td align="center">NEG</td><td align="center">POS</td>
        		    <td align="center">NEG</td><td align="center">POS</td>
		            <td align="center">NEG</td><td align="center">POS1</td><td align="center">POS2</td align="center"><td>POS3</td>
		            <td align="center">NEG</td><td align="center">POS</td>
                </tr>

EOD;
			//end header kolom
	$no=0;
    $c_neg="0";
    $c_pos="0";
    $b_neg="0";
    $b_pos="0";
    $s_neg="0";
    $s_pos="0";
    $i_neg="0";
    $i_pos1="0";
    $i_pos2="0";
    $i_pos3="0";
    $sqlqc="SELECT DISTINCT date(`run_time`) as tanggal FROM `imltd_arc_qc` WHERE date(`run_time`)>='$tglawal' and date(`run_time`)<='$harini' AND
    		`arc_serial` like '$snarc'";
	$q_qc=mysql_query($sqlqc);
	while($tmp=mysql_fetch_assoc($q_qc)){
        $no++;
		$sqlqc1 ="SELECT `id_tes`,`abs` FROM `imltd_arc_qc` WHERE date(`run_time`)='$tmp[tanggal]' and `arc_serial`='$snarc'";
        $qc=mysql_query($sqlqc1);
		while ($tmp1=mysql_fetch_assoc($qc)){

		    switch($tmp1['id_tes']){
                case "Anti-HCVNEG"      :$c_neg=$tmp1['abs'];break;
                case "Anti-HCVPOS"      :$c_pos=$tmp1['abs'];break;
                case "HBsAgQ2NEG"       :$b_neg=$tmp1['abs'];break;
                case "HBsAgQ2POS"       :$b_pos=$tmp1['abs'];break;
                case "SyphilisNEG"      :$s_neg=$tmp1['abs'];break;
                case "SyphilisPOSITIVE" :$s_pos=$tmp1['abs'];break;
                case "_HIV Ag/AbNEG"    :$i_neg=$tmp1['abs'];break;
                case "_HIV Ag/AbPOS1"   :$i_pos1=$tmp1['abs'];break;
                case "_HIV Ag/AbPOS2"   :$i_pos2=$tmp1['abs'];break;
                case "_HIV Ag/AbPOS3"   :$i_pos3=$tmp1['abs'];break;
                default:break;
            }
		}
		$tgl_row=$tmp['tanggal'];
        $tbl.='
        <tr>
		    <td align="right">'.$no.'.</td>
			<td align="center">'.$tgl_row.'</td>
            <td align="right">'.$b_neg.'</td>
			<td align="right">'.$b_pos.'</td>
            <td align="right">'.$c_neg.'</td>
            <td align="right">'.$c_pos.'</td>
            <td align="right">'.$i_neg.'</td>
            <td align="right">'.$i_pos1.'</td>
            <td align="right">'.$i_pos2.'</td>
            <td align="right">'.$i_pos3.'</td>
            <td align="right">'.$s_neg.'</td>
            <td align="right">'.$s_pos.'</td>
		</tr>';
	}
    $tbl.='</table>';
	$pdf->writeHTML($tbl, true, false, false, false, '');
	$namaPDF = 'Kontrol_Architect_i2000sr_'.$tglawal.'_s/d_'.$harini.'pdf';
	$pdf->Output($namaPDF,'I');
?>
