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
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 10, 'Trace reagen Abbott Architect No.Lot: '.$_GET[lot], 0, false, 'R', 0, '', 0, false, 'T', 'M');
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
		$hs='<br><br><br><table border="0.1" cellpadding="3" cellspacing="0">
        <tr style="background-color:Gainsboro">
			<th rowspan="2" align="center" width="40px">NO</th>
	        <th rowspan="2" align="center" width="70px">TANGGAL</th>
            <th rowspan="2" align="center" width="175px">INSTRUMENT</th>
		    <th colspan="3" align="center" width="195px">JUMLAH TERPAKAI</th>
		</tr>
		<tr style="background-color:Gainsboro">
			<th align="center">KONTROL</th>
    	    <th align="center">SAMPLE</th>
		    <th align="center">JUMLAH</th>
        </tr>
			</table>', 
		$tc=array(0,0,0), $lc=array(0,0,0));

			
	// set document information
	$pdf->SetTitle('Trace Reagen IMLTD - SIMDONDAR');
	$pdf->SetSubject('Trace Reagen IMLTD - SIMDONDAR');
			
	// set margins
    $pdf->SetMargins(20,35, 20, true);
	//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(15);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // add a page
	$pdf->AddPage();

    $sq="SELECT `instr`, `arc_serial`,date(`run_time`) as tanggal, count(`id_tes`) as jumlah, `parameter`
			FROM `imltd_arc_raw` WHERE  `lot_reag`='$lot' group by `instr`, `arc_serial`,date(`run_time`), `parameter`";
    $sqllot=mysql_query($sq);
	//$pdf->SetFont('helvetica', 'B', 14);
	//$pdf->Write(0, 'DATA KONFIRMASI PEMERIKSAAN IMLTD', '', 0, 'L', true, 0, false, false, 0);
			
	$pdf->SetFont('helvetica', '', 9);

	$tbl = <<<EOD
        <table border="0.1" cellpadding="3" cellspacing="0">

EOD;
			//end header kolom


    $no=1;
    $total_sample   ="0";
    $total_qc       ="0";
    $total      ="0";
	while ($isi = mysql_fetch_array($sqllot)) {
        $sql_qc0="SELECT `instr`, `arc_serial`,date(`run_time`) as tanggal, count(`id_tes`) as jumlah
		 	 FROM `imltd_arc_qc` WHERE  `lot_reag`='$lot'  and date(`run_time`)='$isi[tanggal]'  and `arc_serial`='$isi[arc_serial]'
		 	 group by `instr`, `arc_serial`,date(`run_time`)";
        $sql_qc1=mysql_query($sql_qc0);
        $sql_qc2=mysql_fetch_assoc($sql_qc1);
        $jml=$sql_qc2[jumlah]+$isi[jumlah];
        $total_sample =$total_sample+$isi[jumlah];
        $total_qc     =$total_qc+$sql_qc2[jumlah];
        $total        =$total_qc+$total_sample;

		$tbl.='
			<tr>
				<td align="right" width="40px">'.$no.'. '.'</td>
				<td align="center" width="70px">'.$isi[tanggal].'</td>
				<td align="left" width="175px">'.$isi[instr].' S/N: '.$isi[arc_serial].'</td>
				<td align="right" width="65px">'.$sql_qc2[jumlah].'</td>
				<td align="right" width="65px">'.$isi[jumlah].'</td>
				<td align="right" width="65px">'.$jml.'</td>
				';
		$tbl .='</tr>';
		$no++;
	}
    $q_reag0=" SELECT `Nama`, `noLot`, `jumTest`, `tglKad`, `kodeSup`, `status`, `keterangan`, `aktif`, `kode`, `metode`, `kodestok` FROM `reagen` WHERE `noLot`='$lot' and `nolot`<>''";
    $q_reag1=mysql_query($q_reag0);
    $q_reag2=mysql_fetch_assoc($q_reag1);
    $tbl.='
        <tr style="background-color:Gainsboro">
            <td colspan="6" align="left">RINGKASAN</td>
        </tr>
        <tr><td colspan="3" align="left">Nama Reagen</td>
            <td colspan="3" align="left">'.$q_reag2[Nama].'</td>
            </tr>
        <tr><td colspan="3" align="left">Nomor Lot</td>
            <td colspan="3" align="left">'.$q_reag2[noLot].'</td>
            </tr>
    	<tr><td colspan="3" align="left">Tanggal Kadaluarsa</td>
            <td colspan="3" align="left">'.$q_reag2[tglKad].'</td>
            </tr>
        <tr><td colspan="3" align="left">Total Kontrol</td>
            <td colspan="3" align="left">'.$total_qc.'</td>
            </tr>
        <tr><td colspan="3" align="left">Total Sample</td>
            <td colspan="3" align="left">'.$total_sample.'</td>
            </tr>
        <tr><td colspan="3" align="left">Total</td>
            <td colspan="3" align="left">'.$total.'</td>
    	    </tr>';
    $tbl.='</table>';
	$pdf->writeHTML($tbl, true, false, false, false, '');
	$namaPDF = 'Trace Reagen Lot-'.$lot.'.pdf';
	$pdf->Output($namaPDF,'I');
?>
