<?php
/*
TIM SIM UTDP PMI 2017
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
        //$this->Cell(0, 10, 'No.Dok.:UTD BALI-UJS-L3-001', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', 'N', 8);
        $this->Cell(0, 5, date("Y/m/d H\hi:s"), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 10, 'Hal: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
    // create new PDF document
    //$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf->setHeaderData($ln='', $lw=0, $ht='',
		$hs='<br><br><br><table border="0.1" cellpadding="3" cellspacing="0">
        <tr style="background-color:Gainsboro">
			<th rowspan="2" width="40px" align="center">NO.</th>
    	    <th rowspan="2" width="70px" align="center">SAMPLE ID</th>
            <th rowspan="2" width="70px" align="center">ARCHITECT<br>S/N</th>
    		<th rowspan="2" width="100px" align="center">WAKTU PERIKSA</th>
            <th colspan="2" width="100  px" align="center">HASIL</th>
            <th rowspan="2" width="100px" align="center">STATUS</th>
    		</tr>
		<tr style="background-color:Gainsboro">
			<th width="40px" align="center">ABS</th>
    	    <th width="60px" align="center">KET</th>
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

    $sq0="SELECT `run_time`, `id_tes`, `instr`, `arc_serial`, `parameter`, `lot_reag`, `abs`, `hasil`, `trans_time` FROM `imltd_arc_raw`
      WHERE `lot_reag`='$lot'";
    $sql1=mysql_query($sq0);

	$pdf->SetFont('helvetica', '', 9);

	$tbl = <<<EOD
        <table border="0.1" cellpadding="3" cellspacing="0">

EOD;
			//end header kolom


    $no=1;
    while ($sqllot_s=mysql_fetch_assoc($sql1)) {
        $sql_kt1=mysql_query("select Status, sah, StatTempat, stat2 from stokkantong where noKantong='$sqllot_s[id_tes]'");
        $sql_kt2=mysql_fetch_assoc($sql_kt1);
        $status_ktg=$sql_kt2['Status']; $kantong_sah=$sql_kt2['sah'];
        switch ($status_ktg){
            case '0' : $statuskantong='Kosong';
                if ($c_ktg[StatTempat]==NULL) $statuskantong='Kosong-Logistik';
                if ($c_ktg[StatTempat]=='0')  $statuskantong='Kosong-Logistik';
                if ($c_ktg[StatTempat]=='1')  $statuskantong='Kosong-Aftap';
                break;
            case '1' : if ($c_ktg['sah']=="1"){
                $statuskantong='Karantina';
            } else{
                $statuskantong='Belum disahkan';
            }
                break;
            case '2' : $statuskantong='Sehat';
                if (substr($c_ktg[stat2],0,1)=='b') $tempat=" (BDRS)";
                break;
            case '3' : $statuskantong='Keluar';break;
            case '4' : $statuskantong='Rusak';break;
            case '5' : $statuskantong='Rusak-Gagal';break;
            case '6' : $statuskantong='Musnah';break;
            default  : $statuskantong='-';
        }

		$tbl.='
			<tr>
				<td align="right" width="40px">'.$no.'. '.'</td>
				<td align="left" width="70px">'.$sqllot_s[id_tes].'</td>
				<td align="left" width="70px">'.$sqllot_s[arc_serial].'</td>
				<td align="left" width="100px">'.$sqllot_s[run_time].'</td>
				<td align="right" width="40px">'.$sqllot_s[abs].'</td>
				<td align="center" width="60px">'.$sqllot_s[hasil].'</td>
				<td align="left" width="100px">'.$statuskantong.'</td>
				';
		$tbl .='</tr>';
		$no++;
	}
    $q_reag0=" SELECT `Nama`, `noLot`, `jumTest`, `tglKad`, `kodeSup`, `status`, `keterangan`, `aktif`, `kode`, `metode`, `kodestok` FROM `reagen` WHERE `noLot`='$lot'";
    $q_reag1=mysql_query($q_reag0);
    $q_reag2=mysql_fetch_assoc($q_reag1);
    $tbl.='
        <tr style="background-color:Gainsboro">
            <td colspan="7" align="left">RINGKASAN</td>
        </tr>
        <tr><td colspan="2" align="left">Nama Reagen</td>
            <td colspan="5" align="left">'.$q_reag2[Nama].'</td>
            </tr>
        <tr><td colspan="2" align="left">Nomor Lot</td>
            <td colspan="5" align="left">'.$q_reag2[noLot].'</td>
            </tr>
    	<tr><td colspan="2" align="left">Tanggal Kadaluarsa</td>
            <td colspan="5" align="left">'.$q_reag2[tglKad].'</td>
            </tr>';
    $tbl.='</table>';
	$pdf->writeHTML($tbl, true, false, false, false, '');
	$namaPDF = 'Trace Reagen Lot-'.$lot.'.pdf';
	$pdf->Output($namaPDF,'I');
?>
