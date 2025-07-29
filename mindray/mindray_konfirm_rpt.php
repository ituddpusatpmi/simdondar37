<?php
require('../tcpdf/tcpdf.php');
require_once('../config/dbi_connect.php');
$notrans 	= $_GET['notrans'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    //Page header
	public function Header() {
	    $headerData = $this->getHeaderData();
	    $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 10, ''.$this->NamaUDDPMI.'', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', '', 9);
        $this->Cell(0, 10, 'HASIL PEMERIKSAAN IMLTD No: '.$_GET['notrans'], 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $this->SetFont('helvetica', 'B', 9);
	    $this->writeHTML($headerData['string']);
	}
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 10, 'Hal: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
$udd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT upper(`nama`) as `nama` FROM `utd` WHERE `aktif`='1'"));
$pdf = new MYPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->NamaUDDPMI = $namautd=$udd['nama'];
$pdf->setHeaderData($ln='', $lw=0, $ht='',
		$hs='<br><br><br><table border="0.1" cellpadding="3" cellspacing="0" width="100%">
        <tr style="background-color:Silver">
			<td rowspan="2" align="center" valign="center" width="25px">No</td>
			<td rowspan="2" align="center" valign="middle" width="105px">No.Sample/<br>No.Kantong</td>
			<td colspan="2" align="center" valign="center">HBsAg</td>
			<td colspan="2" align="center" valign="center">HCV</td>
			<td colspan="2" align="center" valign="center">HIV</td>
			<td colspan="2" align="center" valign="center">Syphilis</td>
			<td rowspan="2" align="center" valign="center">Status<br>Kantong</td>
            <td rowspan="2" align="center" valign="center">Konfirm<br>user</td>
		</tr>
		<tr style="background-color:Silver">
			<td align="center">OD</td><td align="center">Hasil</td>
            <td align="center">OD</td><td align="center">Hasil</td>
            <td align="center">OD</td><td align="center">Hasil</td>
            <td align="center">OD</td><td align="center">Hasil</td>
        </tr>
			</table>', 
$tc=array(0,0,0), $lc=array(0,0,0));
$pdf->SetTitle('Hasil Konfirmasi IMLTD - SIMDONDAR');
$pdf->SetSubject('Hasil Konfirmasi IMLTD - SIMDONDAR');
$pdf->SetMargins(10, 25.2, 10, true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
$sql = mysqli_query($dbi,"SELECT * FROM `mindray_confirm` WHERE `no_trans`='$notrans'");
$pdf->SetFont('helvetica', '', 9);

	$tbl = <<<EOD
        <table border="0.1" cellpadding="3" cellspacing="0" width="100%">

EOD;
			$no = 1;
			while ($isi = mysqli_fetch_array($sql)) {
				$color		='0';
                $nomor      =$isi['no_trans'];
                $operator   =$isi['user'];
                $konfirmer  =$isi['konfirmer'];
                $pengesah   =$isi['disahkan'];
                $waktuKonfirmiasi=$isi['koonfirm_time'];
                $instrument =$isi['instr'];
                $od_b=str_replace('<', ' < ', $isi['b_od']);
                $od_c=str_replace('<', ' < ', $isi['c_od']);
                $od_i=str_replace('<', ' < ', $isi['i_od']);
                $od_s=str_replace('<', ' < ', $isi['s_od']);
                if($isi['b_lot_reag']!==""){$reag_b     ='Lot.:'.$isi['b_lot_reag'].', ED.:'.$isi['b_ed_reag'].', Range:'.$isi['b_range'].' '.$isi['b_unit'];}
                if($isi['c_lot_reag']!==""){$reag_c     ='Lot.:'.$isi['c_lot_reag'].', ED.:'.$isi['c_ed_reag'].', Range:'.$isi['c_range'].' '.$isi['c_unit'];}
                if($isi['i_lot_reag']!==""){$reag_i     ='Lot.:'.$isi['i_lot_reag'].', ED.:'.$isi['i_ed_reag'].', Range:'.$isi['i_range'].' '.$isi['i_unit'];}
                if($isi['s_lot_reag']!==""){$reag_s     ='Lot.:'.$isi['s_lot_reag'].', ED.:'.$isi['s_ed_reag'].', Range:'.$isi['s_range'].' '.$isi['s_unit'];}
                //Status Kantong Saat Konfirmasi
                switch ($isi['status_kantong']){
                    case '0' : $statuskantong='Kosong';break;
                    case '1' : $statuskantong='Karantina';break;
                    case '2' : $statuskantong='Sehat';break;
                    case '3' : $statuskantong='Keluar';break;
                    case '4' : $statuskantong='Rusak';break;
                    case '5' : $statuskantong='Gagal';break;
                    case '6' : $statuskantong='Musnah';break;
                    default  : $statuskantong='-';
                }
                //Aksi User saat konfirmasi
                switch($isi['konfirm_action']){
                    case "0":$aksik='-';break;
                    case "1":$aksik='Sehat';break;
                    case "2":$aksik='Cekal';break;
                    case "3":$aksik='Tunda';break;
                    default :$aksik="";
                }
                //Hasil
                /*switch($isi['b_hasil']){
                    case "NonReaktif" : $hasilb="NR";break;
                    case "Reaktif" : $hasilb="R";$color='1';break;
                    default  : $hasilb="";
                }
                switch($isi['c_hasil']){
                    case "NonReaktif" : $hasilc="NR";break;
                    case "1" : $hasilc="R";$color='1';break;
                    default  : $hasilc="";
                }
                switch($isi['i_hasil']){
                    case "NonReaktif" : $hasili="NR";break;
                    case "Reaktif" : $hasili="R";$color='1';break;
                    default  : $hasili="";
                }
                switch($isi['s_hasil']){
                    case "NonReaktif" : $hasils="NR";break;
                    case "Reaktif" : $hasils="R";$color='1';break;
                    default  : $hasils="";
                }*/
                // 10022022 (THEO) EDIT .N.R menjadi NR
                //Hasil
                switch($isi['b_hasil']){
                    case "NonReaktif" : $hasilb="NR";break;
                    case "Reaktif" : $hasilb="R";$color='1';break;
                    default  : $hasilb="";
                }
                switch($isi['c_hasil']){
                    case "NonReaktif" : $hasilc="NR";break;
                    case "1" : $hasilc="R";$color='1';break;
                    default  : $hasilc="";
                }
                switch($isi['i_hasil']){
                    case "NonReaktif" : $hasili="NR";break;
                    case "Reaktif" : $hasili="R";$color='1';break;
                    default  : $hasili="";
                }
                switch($isi['s_hasil']){
                    case "NonReaktif" : $hasils="NR";break;
                    case "Reaktif" : $hasils="R";$color='1';break;
                    default  : $hasils="";
                }
                if ($color=='0'){
				$tbl.='
					<tr nobr="true">
						<td align="right" width="25px">'.$no.'. '.'</td>
						<td width="105px">'.$isi['id_tes'].'</td>
						<td align="center">'.$od_b.'</td>
						<td align="center">'.$hasilb.'</td>
						<td align="center">'.$od_c.'</td>
						<td align="center">'.$hasilc.'</td>
						<td align="center">'.$od_i.'</td>
						<td align="center">'.$hasili.'</td>
						<td align="center">'.$od_s.'</td>
						<td align="center">'.$hasils.'</td>
						<td>'.$statuskantong.'</td>
						<td>'.$aksik.'</td>
						';
					$tbl .='</tr>';
				} else {
				$tbl.='
					<tr style="background-color:Gainsboro" nobr="true">
						<td align="right" width="25px">'.$no.'. '.'</td>
						<td width="105px">'.$isi['id_tes'].'</td>
						<td align="center">'.$od_b.'</td>
						<td align="center">'.$hasilb.'</td>
						<td align="center">'.$od_c.'</td>
						<td align="center">'.$hasilc.'</td>
						<td align="center">'.$od_i.'</td>
						<td align="center">'.$hasili.'</td>
						<td align="center">'.$od_s.'</td>
						<td align="center">'.$hasils.'</td>
						<td>'.$statuskantong.'</td>
						<td>'.$aksik.'</td>
						';
					$tbl .='</tr>';	
				}
					$no++;
				}
                $opr_arc=mysqli_fetch_assoc(mysqli_query($dbi,"select nama_lengkap from user where id_user='$operator'"));if ($opr_arc){$operator_arc=$opr_arc['nama_lengkap'];} else {$operator_arc=$operator;}
                $konfr=mysqli_fetch_assoc(mysqli_query($dbi,"select nama_lengkap from user where id_user='$konfirmer'"));if ($konfr){$konfirmer_arc=$konfr['nama_lengkap'];}else{$konfirmer_arc=$konfirmer;}
                $sah_arc=mysqli_fetch_assoc(mysqli_query($dbi,"select nama_lengkap from user where id_user='$pengesah'"));if ($sah_arc){$pengesah_arc=$sah_arc['nama_lengkap'];} else {$pengesah_arc=$pengesah;}
                $tbl.='
                <tr style="background-color:Silver" nobr="true">
    	            <td colspan="2" align="left">Instrument</td>
    	            <td colspan="4" align="left">'.$instrument.'</td>
    	            <td colspan="8" align="left">INFORMASI REAGENSIA</td>

                </tr>
                <tr><td colspan="2" align="left">Nomor & Waktu Konfirmasi</td>
                    <td colspan="4" align="left">'.$nomor.', '.$waktuKonfirmiasi.'</td>
                    <td colspan="2" align="left">Reagen HbsAg</td>
    	            <td colspan="6" align="left">'.$reag_b.'</td>
                </tr>
    	        <tr><td colspan="2" align="left">Operator Alat</td>
    	            <td colspan="3" align="left">'.$operator_arc.'</td>
    	            <td colspan="1" align="left">Paraf:</td>
    	            <td colspan="2" align="left">Reagen HCV</td>
                    <td colspan="6" align="left">'.$reag_c.'</td>
    	        </tr>
    	        <tr><td colspan="2" align="left">Petugas Konfirmasi</td>
    	            <td colspan="3" align="left">'.$konfirmer_arc.'</td>
    	            <td colspan="1" align="left">Paraf:</td>
    	            <td colspan="2" align="left">Reagen HIV</td>
    	            <td colspan="6" align="left">'.$reag_i.'</td>
    	        </tr>
    	        <tr><td colspan="2" align="left">Petugas Pengesahan</td>
    	            <td colspan="3" align="left">'.$pengesah_arc.'</td>
    	            <td colspan="1" align="left">Paraf:</td>
    	            <td colspan="2" align="left">Reagen TPHA</td>
    	            <td colspan="6" align="left">'.$reag_s.'</td>
    	        </tr>
    	        <tr>
    	        <td rowspan="4" colspan="12" align="left">
                        <ul style="padding-top:0px;">
                            <li>Kolom <b>Status Kantong</b> adalah status kantong pada saat konfirmasi dilakukan (<u>bukan status kantong saat ini</u>)</li>
                            <li>Kolom <b>Konfirm user</b> adalah aksi dari user saat proses konfirmasi dilakukan</li>
                            <li>Kolom Hasil : <b>NR=Non Reaktif; R=Reaktif; GZ= GrayZone</b> </li>
                        </ul>
                    </td>
    	        </tr>';
$tbl.='</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');
$namaPDF = 'Mindray_Chlia_Konfirmasi-'.$notrans.'.pdf';
$pdf->Output($namaPDF,'I');
?>
