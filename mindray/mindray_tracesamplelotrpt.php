<?php
require('../tcpdf/tcpdf.php');
require_once('../config/dbi_connect.php');
$g_prm=trim($_GET['prm']);
$g_lot=$_GET['lot'];
switch($g_prm){
    case "HBsAg"        : $p_sql=" m.`b_od` as `od` , m.`b_hasil` as `hasil`, m.`b_range` as `range`, m.`b_unit` as `unit`, ";$w_sql=" m.`b_lot_reag` ";break;
    case "Anti-HCV"     : $p_sql=" m.`c_od` as `od` , m.`c_hasil` as `hasil`, m.`c_range` as `range`, m.`c_unit` as `unit`, ";$w_sql=" m.`c_lot_reag` ";break;
    case "Anti-HIV"     : $p_sql=" m.`i_od` as `od` , m.`i_hasil` as `hasil`, m.`i_range` as `range`, m.`i_unit` as `unit`, ";$w_sql=" m.`i_lot_reag` ";break;
    case "Sifilis/TP"   : $p_sql=" m.`s_od` as `od` , m.`s_hasil` as `hasil`, m.`s_range` as `range`, m.`s_unit` as `unit`, ";$w_sql=" m.`s_lot_reag` ";break;
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    //Page header
	public function Header() {
	    $headerData = $this->getHeaderData();
		$image_file = '../images/header_pmi_750x62.png';
		$this->SetXY(0,0);
        $this->Image($image_file, 5, 5, 190,15, 'png', '', 'T', false, 300, 'L', false, false, 0, false, false, false);
	    $this->SetFont('helvetica', 'B', 14);
		$this->SetXY(10,20);
        $this->Cell(0, 0, ''.$this->NamaUDDPMI.'', 0, false, 'L', 0, '', 0, false, 'T', 'M');
	}
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 10, 'Hal: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$udd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT upper(`nama`) as `nama` FROM `utd` WHERE `aktif`='1'"));
$pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->NamaUDDPMI = $namautd=$udd['nama'];
$pdf->setHeaderData($ln='', $lw=0, $ht='',$hs='', $tc=array(0,0,0), $lc=array(0,0,0));
$pdf->SetTitle('Trace Sample Mindray IMLTD - SIMDONDAR');
$pdf->SetSubject('IMLTD - SIMDONDAR');
$pdf->SetMargins(10, 20.2, 10, true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->SetXY(10,30);
$pdf->SetFont('helvetica', '', 12);
$html ="Rincian <i>trace</i> Lot Reagen Mindray Chlia";
$pdf->writeHTML($html, true, false, false, false, '');
$html ='Parameter: '.$g_prm.', No. Lot: '.$g_lot;
$pdf->writeHTML($html, true, false, false, false, '');
$sql=mysqli_query($dbi,"SELECT m.`no_trans`, m.`instr`, m.`id_tes`, ".$p_sql." date(m.`koonfirm_time`) as `tglkonfirm` FROM `mindray_confirm` m WHERE ".$w_sql." = '$g_lot'");
$html='
	<table border="0.1" cellpadding="3" cellspacing="0" width="100%">
		<thead>
		<tr style="background-color:Silver">
			<td width="50px"  align="center">No</td>
			<td width="70px" align="center">Tanggal</td>
            <td width="75px" align="center">No Transaksi</td>
            <td width="110px" align="center">No Sample</td>
			<td width="100px" align="center">Instrument</td>
            <td width="70px" align="center">OD</td>
			<td width="70px" align="center">Hasil</td>
		</tr>
		</thead>
		<tbody>';
$no=0;
while($row=mysqli_fetch_assoc($sql)){
	$no++;
    $od=str_replace('<', ' < ', $row['od']);
	$html .='<tr nobr="true">
				<td width="50px" align="right">'.$no.'.</td>
				<td width="70px" align="center">'.$row['tglkonfirm'].'</td>
				<td width="75px" align="center">'.$row['no_trans'].'</td>
				<td width="110px">'.$row['id_tes'].'</td>
				<td width="100px">'.$row['instr'].'</td>
				<td width="70px" align="center">'.$od.'</td>
				<td width="70px">'.$row['hasil'].'</td>
			</tr>';
}
$html .='</tbody></table>';
$pdf->SetFont('helvetica', '', 10);
$pdf->writeHTML($html, true, false, false, false, '');
$namaPDF = 'Rincian Trace Reagan Mindray.pdf';
$pdf->Output($namaPDF,'I');
?>
