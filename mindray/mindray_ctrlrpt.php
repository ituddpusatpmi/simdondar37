<?php
require('../tcpdf/tcpdf.php');
require_once('../config/dbi_connect.php');
$tgl1 	= $_GET['t1'];
$tgl2 	= $_GET['t2'];
$parameter 	= $_GET['p'];
$newDate1 = date("d-m-Y", strtotime($tgl1));
$newDate2 = date("d-m-Y", strtotime($tgl2));
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
$pdf->SetTitle('Hasil Kontrol Reagen Mindray IMLTD - SIMDONDAR');
$pdf->SetSubject('IMLTD - SIMDONDAR');
$pdf->SetMargins(10, 20.2, 10, true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->SetXY(10,30);
$pdf->SetFont('helvetica', '', 10);
switch ($parameter){
    case ""         : $st_param="";$w_param=" ";break;
    case "HBsAg-I"  : $st_param=", Parameter: HBsAg";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
    case "Anti-HCV" : $st_param=", Parameter: Anti-HCV";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
    case "HIV"      : $st_param=", Parameter: Anti-HIV";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
    case "Anti-TP"  : $st_param=", Parameter:Anti-TP";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
}
$sql = mysqli_query($dbi,"SELECT `mdr_id`, `mdr_instrument`, `mdr_ctrl_name`, `mdr_ctrl_lot`, `mdr_ctrl_param`, `mdr_ctrl_type`, `mdr_ctrl_unit`, `mdr_ctrl_od`, `mdr_ctrl_rev1`, `mdr_ctrl_rev2`, `mdr_ctrl_ed`, `mdr_ctrl_rev3`, `mdr_ctrl_time`, `on_insert` FROM `lis_pmi`.`mindray_control` 
                 WHERE  (STR_TO_DATE(CONCAT(MID(`mdr_ctrl_time`,7,4),'-',MID(`mdr_ctrl_time`,4,2),'-',MID(`mdr_ctrl_time`,1,2)),'%Y-%m-%d') BETWEEN '$tgl1' AND '$tgl2') ".$w_param);
/*
$od_b=str_replace('<', ' < ', $sql['mdr_ctrl_od']);
$od_c=str_replace('<', ' < ', $sql['mdr_ctrl_od']);
$od_i=str_replace('<', ' < ', $sql['mdr_ctrl_od']);
$od_s=str_replace('<', ' < ', $sql['mdr_ctrl_od']);
*/
$pdf->SetFont('helvetica', '', 12);
$html ='KONTROL REAGEN MINDRAY';
$pdf->writeHTML($html, true, false, false, false, '');
$html ='Tanggal: '.$newDate1.' s/d '.$newDate2.$st_param;

$pdf->writeHTML($html, true, false, false, false, '');

$html='
	<table border="0.1" cellpadding="3" cellspacing="0" width="100%">
		<thead>
		<tr style="background-color:Silver">
			<td width="40px"  align="center">No</td>
			<td width="110px" align="center">Tanggal</td>
			<td width="90px" align="center">Instrument</td>
			<td width="70px" align="center">Parameter</td>
			<td width="110px" align="center">Nama Control</td>
			<td width="70px" align="center">OD</td>
			<td width="50px" align="center">Unit</td>
		</tr>
		</thead>
		<tbody>';
$no=0;
while($row=mysqli_fetch_assoc($sql)){
	$no++;
	$html .='<tr nobr="true">
				<td width="40px" align="right">'.$no.'.</td>
				<td width="110px" align="center">'.$row['mdr_ctrl_time'].'</td>
				<td width="90px" align="center">'.$row['mdr_instrument'].'</td>
				<td width="70px">'.$row['mdr_ctrl_param'].'</td>
				<td width="110px">'.$row['mdr_ctrl_name'].'</td>
				<td width="70px" align="center">'.$row['mdr_ctrl_od'].'</td>
				<td width="50px">'.$row['mdr_ctrl_unit'].'</td>
			</tr>';
}
$html .='</tbody></table>';
$pdf->SetFont('helvetica', '', 10);
$pdf->writeHTML($html, true, false, false, false, '');
$namaPDF = 'Hasil Kontrol Reagen Mindray.pdf';
$pdf->Output($namaPDF,'I');
?>
