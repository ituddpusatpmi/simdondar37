<?php
require('../tcpdf/tcpdf.php');
require_once('../config/dbi_connect.php');
$notrans 	= $_GET['notrans'];
$sample 	= $_GET['nokantong'];
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
$pdf->SetTitle('Hasil Pemeriksaan IMLTD - SIMDONDAR');
$pdf->SetSubject('Hasil  IMLTD - SIMDONDAR');
$pdf->SetMargins(10, 20.2, 10, true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$pdf->SetXY(10,30);$pdf->SetFont('helvetica', 'BU', 12);$pdf->Cell(0, 0, 'HASIL PEMERIKSAAN UJI SARING DARAH', 0, false, 'c', 0, '', 0, false, 'T', 'M');
$pdf->SetXY(10,40);
$pdf->SetFont('helvetica', '', 11);
$sql =mysqli_fetch_assoc(mysqli_query($dbi,"SELECT * FROM `mindray_confirm` WHERE `no_trans`='$notrans' AND `id_tes`='$sample'"));
$petugas=$sql['user'];
$opr_mdr=mysqli_fetch_assoc(mysqli_query($dbi,"select nama_lengkap from user where id_user='$petugas'"));
if ($opr_mdr){$operator_=$opr_mdr['nama_lengkap'];} else {$operator_=$petugas;}
$html='
	<table border="0" cellpadding="3" cellspacing="0" width="100%">
		<tr>
			<td style="width:100px;">No. Pemeriksaan</td>	<td style="width:250px;">: '.$sql['no_trans'].'</td>
			<td style="width:60px;">Tanggal</td>			<td style="width:130px;">: '.$sql['rpt_created'].'</td>
		</tr>
		<tr>
			<td style="width:100px;">Kode Sample</td>		<td style="width:250px;">: '.$sql['id_tes'].'</td>
			<td style="width:60px;"></td>					<td style="width:130px;"></td>
		</tr>
	</table>
';
$pdf->writeHTML($html, true, false, false, false, '');
$od_b=str_replace('<', ' < ', $sql['b_od']);
$od_c=str_replace('<', ' < ', $sql['c_od']);
$od_i=str_replace('<', ' < ', $sql['i_od']);
$od_s=str_replace('<', ' < ', $sql['s_od']);
 /*
$res_b=str_replace('NR', 'NON REAKTIF', $sql['b_hasil']);
$res_c=str_replace('NR', 'NON REAKTIF', $sql['c_hasil']);
$res_i=str_replace('NR', 'NON REAKTIF', $sql['i_hasil']);
$res_s=str_replace('NR', 'NON REAKTIF', $sql['s_hasil']);*/
// 100222 EDIT THEO ========> ubah .N.R menjadi NR

    $res_b=str_replace('NR', 'NON REAKTIF', $sql['b_hasil']);
    $res_c=str_replace('NR', 'NON REAKTIF', $sql['c_hasil']);
    $res_i=str_replace('NR', 'NON REAKTIF', $sql['i_hasil']);
    $res_s=str_replace('NR', 'NON REAKTIF', $sql['s_hasil']);
    
$html='
	<table border="0.1" cellpadding="3" cellspacing="0" width="100%">
		<tr style="background-color:Silver">
			<td width="30px"align="center">No</td>
			<td width="150px"align="center">Parameter</td>
			<td width="110px"align="center">OD</td>
			<td width="100px"align="center">Hasil</td>
			<td width="150px"align="center">Referensi</td>
		</tr>
		<tr>
			<td width="30px"align="center">1</td>
			<td width="150px"align="center">HBsAg</td>
			<td width="110px"align="center">'.$od_b.'</td>
			<td width="100px"align="center">'.$res_b.'</td>
			<td width="150px"align="center">'.$sql['b_range'].' '.$sql['b_unit'].'</td>
		</tr>
		<tr>
			<td width="30px"align="center">2</td>
			<td width="150px"align="center">Anti-HCV</td>
			<td width="110px"align="center">'.$od_c.'</td>
			<td width="100px"align="center">'.$res_c.'</td>
			<td width="150px"align="center">'.$sql['c_range'].' '.$sql['c_unit'].'</td>
		</tr>
		<tr>
			<td width="30px"align="center">3</td>
			<td width="150px"align="center">Anti-HIV</td>
			<td width="110px"align="center">'.$od_i.'</td>
			<td width="100px"align="center">'.$res_i.'</td>
			<td width="150px"align="center">'.$sql['i_range'].' '.$sql['i_unit'].'</td>
		</tr>
		<tr>
			<td width="30px"align="center">4</td>
			<td width="150px"align="center">Sifilis/TP</td>
			<td width="110px"align="center">'.$od_s.'</td>
			<td width="100px"align="center">'.$res_s.'</td>
			<td width="150px"align="center">'.$sql['s_range'].' '.$sql['s_unit'].'</td>
		</tr>
	</table>
';
$pdf->writeHTML($html, true, false, false, false, '');
$html='
	<table border="0" cellpadding="3" cellspacing="0" width="100%">
		<tr>
			<td align="center">Pemeriksa,<br><br><br></td>
			<td align="center">Penanggung Jawab,<br><br><br></td>
		</tr>
		<tr>
			<td align="center">'.$operator_.'</td>
			<td align="center">.....................................</td>
		</tr>
	</table>
	';
$pdf->writeHTML($html, true, false, false, false, '');
$namaPDF = 'HasilSkrining-'.$notrans.'_'.$sample.'.pdf';
$pdf->Output($namaPDF,'I');
?>
