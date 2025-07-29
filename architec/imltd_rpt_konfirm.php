<?php
/*
Yudha T. Putra
*/

require('../tcpdf/tcpdf.php');
$link = mysql_connect('localhost', 'root', 'F201603907');
		mysql_select_db('pmi');
$notrans 	= $_GET['notrans'];
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $udd=mysql_fetch_assoc(mysql_query("SELECT `nama` FROM `utd` WHERE `aktif`='1'"));
        $namautd=$udd['nama'];
        $image_file = '../images/header_pmi_750x62.png';
        //$this->Image($image_file, 10, 2, 62, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title
        $this->Cell(0, 10, ''.$namautd.'', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'NO.Konfirmasi : '.$_GET[notrans], 0, false, 'R', 0, '', 0, false, 'T', 'M');

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', '', 8);
        // Page number
        //$this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        //$this->Cell(0, 10, 'No.Dok.:UTD BALI-UJS-L3-001', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        //$this->Cell(0, 10, 'No.Dok.:UTD BALI-UJS-L3-001', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Hal: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
	// create new PDF document
	//$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf = new MYPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
			
	// set document information
	$pdf->SetTitle('Daftar User SIMDONDAR');
	$pdf->SetSubject('Daftar User SIMDONDAR');
			
	// set margins
    $pdf->SetMargins(10, 16, 10, true);
	//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // add a page
	$pdf->AddPage();

    $sql = mysql_query("SELECT `id`, `no_trans`, `instr`, `instr_v`, `scc_serial`, `interface_sn`, `arc_serial`, `trans_time`, `user`,
		 `id_tes`, `carrier`, `position`,
		 `b_lot_reag`, `b_id_raw`, `b_ed_reag`, `b_kode_reag`, `b_sn_reag`, `b_abs`, `b_run_time`, `b_hasil`, `b_ket_tes`,
		 `c_lot_reag`, `c_id_raw`, `c_ed_reag`, `c_kode_reag`, `c_sn_reag`, `c_abs`, `c_run_time`, `c_hasil`, `c_ket_tes`,
		 `i_lot_reag`, `i_id_raw`, `i_ed_reag`, `i_kode_reag`, `i_sn_reag`, `i_abs`, `i_run_time`, `i_hasil`, `i_ket_tes`,
		 `s_lot_reag`, `s_id_raw`, `s_ed_reag`, `s_kode_reag`, `s_sn_reag`, `s_abs`, `s_run_time`, `s_hasil`, `s_ket_tes`,
		 `konfirmer`, `koonfirm_time`, `disahkan`, `status_kantong`, `konfirm_action` FROM `imltd_arc_konfirm` WHERE no_trans='$notrans'");
	$pdf->SetFont('helvetica', 'B', 14);
	$pdf->Write(0, 'DATA KONFIRMASI PEMERIKSAAN IMLTD', '', 0, 'L', true, 0, false, false, 0);
			
	$pdf->SetFont('helvetica', '', 9);

	$tbl = <<<EOD
        <table border="0.1" cellpadding="3" cellspacing="0">
        <tr style="background-color:Gainsboro">
			<td rowspan="2" align="center" valign="center" width="25px">No</td>
			<td rowspan="2" align="center" valign="center"width="75px">SampleID</td>
			<td colspan="3" align="center" valign="center">HBsAg</td>
			<td colspan="3" align="center" valign="center">HCV</td>
			<td colspan="3" align="center" valign="center">HIV</td>
			<td colspan="3" align="center" valign="center">Syphilis</td>
			<td rowspan="2" align="center" valign="center">Status<br>Kantong</td>
            <td rowspan="2" align="center" valign="center">Konfirm</td>
		</tr>
		<tr style="background-color:Gainsboro">
			<td align="center">OD</td><td align="center">Hasil</td><td align="center">Ket</td>
            <td align="center">OD</td><td align="center">Hasil</td><td align="center">Ket</td>
            <td align="center">OD</td><td align="center">Hasil</td><td align="center">Ket</td>
            <td align="center">OD</td><td align="center">Hasil</td><td align="center">Ket</td>

EOD;
			//end header kolom
			$tbl .= "</tr>";

			$no = 1;
			while ($isi = mysql_fetch_array($sql)) {
                $nomor      =$isi['no_trans'];
                $operator   =$isi['user'];
                $konfirmer  =$isi['konfirmer'];
                $pengesah   =$isi['disahkan'];
                $waktuKonfirmiasi=$isi['koonfirm_time'];
                $instrument =$isi['instr'].' - S/N:'.$isi['arc_serial'];
                if($isi[b_lot_reag]!==""){$reag_b     ='Lot.:'.$isi['b_lot_reag'].', ED.:'.$isi['b_ed_reag'];}
                if($isi[c_lot_reag]!==""){$reag_c     ='Lot.:'.$isi['c_lot_reag'].', ED.:'.$isi['c_ed_reag'];}
                if($isi[i_lot_reag]!==""){$reag_i     ='Lot.:'.$isi['i_lot_reag'].', ED.:'.$isi['i_ed_reag'];}
                if($isi[s_lot_reag]!==""){$reag_s     ='Lot.:'.$isi['s_lot_reag'].', ED.:'.$isi['s_ed_reag'];}
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
                switch($isi['b_hasil']){
                    case "0" : $hasilb="NR";break;
                    case "1" : $hasilb="R";break;
                    case "2" : $hasilb="GZ";break;
                    default  : $hasilb="";
                }
                switch($isi['c_hasil']){
                    case "0" : $hasilc="NR";break;
                    case "1" : $hasilc="R";break;
                    case "2" : $hasilc="GZ";break;
                    default  : $hasilc="";
                }
                switch($isi['i_hasil']){
                    case "0" : $hasili="NR";break;
                    case "1" : $hasili="R";break;
                    case "2" : $hasili="GZ";break;
                    default  : $hasili="";
                }
                switch($isi['s_hasil']){
                    case "0" : $hasils="NR";break;
                    case "1" : $hasils="R";break;
                    case "2" : $hasils="GZ";break;
                    default  : $hasils="";
                }
				$tbl.='
					<tr>
						<td align="right">'.$no.'. '.'</td>
						<td>'.$isi[id_tes].'</td>
						<td align="right">'.$isi[b_abs].'</td>
						<td align="center">'.$hasilb.'</td>
						<td>'.$isi[b_ket].'</td>
						<td align="right">'.$isi[c_abs].'</td>
						<td align="center">'.$hasilc.'</td>
						<td>'.$isi[c_ket].'</td>
						<td align="right">'.$isi[i_abs].'</td>
						<td align="center">'.$hasili.'</td>
						<td>'.$isi[i_ket].'</td>
						<td align="right">'.$isi[s_abs].'</td>
						<td align="center">'.$hasils.'</td>
						<td>'.$isi[s_ket].'</td>
						<td>'.$statuskantong.'</td>
						<td>'.$aksik.'</td>
						';
					$tbl .='</tr>';
					$no++;
				}
                $opr_arc=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$operator'"));
                $operator_arc=$opr_arc[nama_lengkap];
                $konfr=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$konfirmer'"));
                $konfirmer_arc=$konfr[nama_lengkap];
                $tbl.='
                <tr>
    	            <td colspan="3" align="left">Instrument</td><td colspan="5" align="left">'.$instrument.'</td>
    	            <td colspan="2" align="left">Reagen HbsAg</td><td colspan="6" align="left">'.$reag_b.'</td>
                </tr>
                <tr><td colspan="3" align="left">Nomor & Waktu Konfirmasi</td><td colspan="5" align="left">'.$nomor.', '.$waktuKonfirmiasi.'</td>
                    <td colspan="2" align="left">Reagen HCV</td><td colspan="6" align="left">'.$reag_c.'</td>
                </tr>
    	        <tr><td colspan="3" align="left">Operator Architect</td><td colspan="5" align="left">'.$operator_arc.'</td>
    	            <td colspan="2" align="left">Reagen HIV</td><td colspan="6" align="left">'.$reag_i.'</td>
    	        </tr>
    	        <tr><td colspan="3" align="left">Petugas Konfirmasi</td><td colspan="5" align="left">'.$konfirmer_arc.'</td>
    	            <td colspan="2" align="left">Reagen TPHA</td><td colspan="6" align="left">'.$reag_s.'</td>
    	        </tr>
    	        <tr><td colspan="3" align="left">Petugas Pengesahan</td><td colspan="5" align="left">'.$pengesah.'</td></tr>
    	        <tr>
    	        <td rowspan="4" colspan="16" align="left" >
                    <b>Catatan :</b>
                        <ol>
                            <li>Status Kantong adalah status kantong pada saat konfirmasi dilakukan (bukan status kantong saat ini)</li>
                            <li>Kolom "Konfirm" adalah aksi dari user saat proses konfirmasi dilakukan</li>
                            <li>Kolom Hasil : NR (Non Reaktif); R (Reaktif) GZ (GrayZone) </li>
                        </ol>
                    </td>
    	        </tr>';
			$tbl.='</table>';
			$pdf->writeHTML($tbl, true, false, false, false, '');
			$namaPDF = 'Data Konfirmasi-'.$notrans.'.pdf';
			$pdf->Output($namaPDF,'I');
?>
