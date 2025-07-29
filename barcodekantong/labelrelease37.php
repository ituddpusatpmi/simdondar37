<?php
ob_start();
require_once('../tcpdf2/tcpdf.php');
require_once('../tcpdf/include/tcpdf_fonts.php');
function tgl_indo($tanggal){
	$bulan = array (1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
// create new PDF document
$pdf = new TCPDF('L', 'mm', array('41','89'), true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// $pdf->setLanguageArray($l);
$pdf->SetFont('helvetica', '', 10);
// define barcode style
$style_br = array(
    'position' => '',
    'align' => 'L',
    'stretch' => true,
    'fitwidth' => false,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => '0',
    'vpadding' => '0',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => false,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
$style_qr = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(0,0,0),
    'bgcolor' => false
);
require_once('../config/dbi_connect.php');

// Cari nomor dokumen
$query=mysqli_query($dbi,"SELECT * FROM `dokumen_mutu` WHERE `dok_modul`='PROLIS' AND `dok_menu`='labelprolis'");
if($query){
    $dok=mysqli_fetch_assoc($query);
    $no_dokumen=$dok['dok_nomor'];
}else{
    $no_dokumen     = "NOMOR DOK: ??";
}

$nokantong      = $_GET['kantong'];
$g_tipebarcode  = $_GET['tipe'];

$kantong_a	= substr($nokantong,0,-1);
$kantong_a	= $kantong_a.'A';

$sqlrelease=mysqli_query($dbi,"SELECT *, `rnokantong`, round(`rvolume`,0) as volume,
					`rproduk`, `rgolda`,DATE_FORMAT(`rtgl_aftap`, '%d-%m-%Y') as tglaftap,
					DATE_FORMAT(`rtgl_olah`, '%d-%m-%Y') as tglolah ,
					DATE_FORMAT(`rtgl_ed`, '%d-%m-%Y %H:%i') as tgled ,
                    `rstatus`, `rsatus_ket`
					FROM `release` WHERE rnokantong='$nokantong'");	
$queryrelease   =mysqli_fetch_assoc($sqlrelease);
$volume_kantong =$queryrelease['volume'];                    
$gol_darah      =$queryrelease['rgolda'];
$gol_abo        =substr($gol_darah,0,-1);
$gol_rh         =substr($gol_darah, -1);
($gol_rh=='-') ? $rhesus="Rh NEGATIF" : $rhesus="Rh POSITIF";
$namaproduk     =$queryrelease['rproduk'];        
$ketlulus = $queryrelease['rsatus_ket'];

$qrykantong=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT * FROM `stokkantong` WHERE `noKantong`='$nokantong'"));
$volume_asal=$qrykantong['volumeasal'];
$noselang=$qrykantong['noSelang'];
$donasi=mysqli_query($dbi,"SELECT *, date(tgl) as tanggal_aftap FROM htransaksi WHERE NoKantong='$kantong_a';");
$donasi=mysqli_fetch_assoc($donasi);
($donasi['JenisDonor']=='0') ? $jenis_donor="Donor Sukarela" : $jenis_donor="Donor Pengganti" ;
$no_donasi=$donasi['NoTrans'];
$tgl_aftap=tgl_indo($donasi['tanggal_aftap']);
$merkkantong    = $qrykantong['merk'];
$jenis_kantong  = $qrykantong['jenis'];
// Cari informasi dari Master  kantong:
$qrymasterkantong=mysqli_query($dbi,"SELECT * FROM `master_kantong` WHERE `merk`='$merkkantong' AND `jenis`='$jenis_kantong' AND `vol`='$volume_asal'");
if($qrymasterkantong){
    if(mysqli_num_rows($qrymasterkantong)>0){
        $dtmasterkantong=mysqli_fetch_assoc($qrymasterkantong);
        $acd_volume = $dtmasterkantong['antikoagulant'];
        $jenis_acd  = $dtmasterkantong['anticoagulant_name'];
    }else{
        $acd_volume = "";
        $jenis_acd  = "";
    }
}else{
    $acd_volume = "";
    $jenis_acd  = "";
}

// Cek Hasil NAT
$qnat=mysqli_query($dbi,"SELECT *  FROM `hasilnat` WHERE `idsample` LIKE '$kantong_a'");
if($query){
    if(mysqli_num_rows($qnat)>0){
        $periksa_nat=1;
        $motode_imltd="dengan metode Chlia & NAT";
    }else{
        $periksa_nat=0;
        $motode_imltd="dengan metode Chlia";
    }
}else{
    $periksa_nat=0;
    $motode_imltd="dengan metode Chlia";
}


$pdf->AddPage('L',array(100,100));
$pdf->SetFillColor(255,255,255);
$udd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT nama,alamat from utd where down='1' and aktif='1'"));
$pdf->SetFont('helvetica', 'b', 12);
$pdf->SetXY(2,2);$pdf->Cell(0, 0,$udd['nama'],0, 1, 'C');
$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(2,6);$pdf->Cell(0, 0,$udd['alamat'],0, 1, 'C');

// KIRI ATAS (DONASI)
// Hasil Release
$pdf->SetXY(1,10);$pdf->SetFont('helvetica', 'b', 14);$pdf->Cell(49, 0, $ketlulus, 0,1,'C');
$pdf->SetLineWidth(0.4);$pdf->Line(1,17,50,17); 

// Barcode, cek apakah ada nomor selang/tidak
$pj_selang=strlen($noselang);
if($pj_selang>0){
    $pj_nokantong=strlen($queryrelease['rnokantong']);
    $pdf->SetXY(2,19);$pdf->write1DBarcode(strtoupper($queryrelease['rnokantong']), $g_tipebarcode, '', '', 47, 8, 0.28, $style_br, 'N');
    ($pj_nokantong>10) ? $pdf->SetFont('helvetica', 'b', 13) : $pdf->SetFont('helvetica', 'b', 18);
    $pdf->SetXY(1,26);$pdf->Cell(49, 0, strtoupper($queryrelease['rnokantong']), 0,1,'C');
    $pdf->SetFont('helvetica', '', 11);
    $pdf->SetXY(2,35);$pdf->write1DBarcode(strtoupper($noselang), $g_tipebarcode, '', '', 48, 7, 0.28, $style_br, 'N');
    $pdf->SetXY(1,42);$pdf->Cell(49, 0, 'Selang:'.$noselang, 0,1,'C');
}else{
    $pj_nokantong=strlen($queryrelease['rnokantong']);
    $pdf->SetXY(2,20);$pdf->write1DBarcode(strtoupper($queryrelease['rnokantong']), $g_tipebarcode, '', '', 48, 15, 0.28, $style_br, 'N');
    ($pj_nokantong>10) ? $pdf->SetFont('helvetica', 'b', 13) : $pdf->SetFont('helvetica', 'b', 18);
    $pdf->SetXY(1,35);$pdf->Cell(49, 0, strtoupper($queryrelease['rnokantong']), 0,1,'C');
}



// Jenis Donor
$pdf->SetLineWidth(0.4);$pdf->Line(1,47,50,47); 
$pdf->SetXY(1,47);$pdf->SetFont('helvetica', 'b', 14);$pdf->Cell(49, 0, $jenis_donor, 0,1,'C');
$pdf->SetLineWidth(0.4);$pdf->Line(1,53,50,53); 
//=====================================================

// KANAN ATAS
$pdf->SetXY(50,12);$pdf->SetFont('helvetica', '', 9);$pdf->Cell(0, 0, 'GOLONGAN DARAH', 0,1,'C');
$pdf->SetXY(50,13);$pdf->SetFont('helvetica', 'b', 60);$pdf->Cell(0, 0,$gol_abo, 0, 5, 'C');
$pdf->SetXY(50,35);$pdf->SetFont('helvetica', 'b', 20);$pdf->Cell(0, 0,$rhesus, 0, 5, 'C');
$pdf->SetLineWidth(0.4);$pdf->Line(50,44,99,44);
//  ===============================================

//IMLTD
$pdf->SetXY(51,45);$pdf->SetFont('helvetica','', 9);$pdf->Cell(0, 0, 'Pemeriksaan Screening', 0,1);
$pdf->SetXY(51,49);$pdf->Cell(0, 0, 'Non Reaktif terhadap: Anti HIV,' , 0,1);
$pdf->SetXY(51,53);$pdf->Cell(0, 0, 'Anti HCV, HBsAg & Syphilis', 0,1);
$pdf->SetXY(51,57);$pdf->Cell(0, 0, $motode_imltd, 0,1);
// Cek ABS
$cek_abs=mysqli_query($dbi,"SELECT *  FROM `abs` WHERE `abs_sample_id` = '$kantong_a'");
if($cek_abs){
    if(mysqli_num_rows($cek_abs)>0){
        $dtabs=mysqli_fetch_assoc($cek_abs);
        $hasil_abs = $dtabs['abs_result'];
        $pdf->SetXY(51,61);$pdf->SetFont('helvetica','', 9);$pdf->Cell(0, 0, 'Antibody Screening : '.$hasil_abs, 0,1);
    }
}
$pdf->SetLineWidth(0.4);$pdf->Line(50,66,99,66);	
//Informasi Tanggal

$pdf->SetFont('helvetica', 10);
$pdf->SetXY(51,67);	$pdf->Cell(0, 0, 'Aftap', 0);
$pdf->SetXY(65,67);	$pdf->Cell(0, 0, ':', 0);
$pdf->SetXY(66,67);	$pdf->Cell(0, 0, $queryrelease['tglaftap'], 0);
$pdf->SetFont('helvetica', 10);
$pdf->SetXY(51,71);	$pdf->Cell(0, 0, 'Produksi', 0);
$pdf->SetXY(65,71);	$pdf->Cell(0, 0, ':', 0);
$pdf->SetXY(66,71);	$pdf->Cell(0, 0, $queryrelease['tglolah'], 0);
$pdf->SetXY(51,75);	$pdf->Cell(0, 0, 'ED', 0);
$pdf->SetXY(65,75);	$pdf->Cell(0, 0, ':', 0);
$pdf->SetXY(66,75);	$pdf->Cell(0, 0, $queryrelease['tgled'], 0);
// Informasi Antikoqgulant --> Cek dari Master Kantong
if ( $queryrelease['rproduk']=='PRC' || $queryrelease['rproduk']=='Leucodepleted' || $queryrelease['rproduk']=='WE' ){
    if(!$jenis_acd==""){
        $pdf->SetXY(51,79);	$pdf->SetFont('helvetica','', 10);$pdf->Cell(0, 0, 'CPD : '.$jenis_acd.' / '.$volume_asal, 0);
    }
}
$pdf->SetLineWidth(0.4);$pdf->Line(50,84,99,84);
//Informasi Penyimpanan
$suhu_simpan='';
$suhu_kirim='';
if (($queryrelease['rproduk']=='TC') or ($queryrelease['rproduk']=='TC Aferesis')) {
    $suhu_simpan = '20-24';
    $suhu_kirim = '20-24';
} elseif ($queryrelease['rproduk']=='FFP'){
    $suhu_simpan = '-30';
    $suhu_kirim = '-30';
} elseif ($queryrelease['rproduk']=='FFP Konvalesen'){
    $suhu_simpan = '-30';
    $suhu_kirim = '-30';
}else {
    $suhu_simpan = '2-4';
    $suhu_kirim = '2-4';
   		
}



$sqlsuhukirim=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `suhutransport` FROM `produk` WHERE `Nama`='$namaproduk'"));
$suhupengiriman=$sqlsuhukirim['suhutransport'];
$pdf->SetXY(51,84);	$pdf->SetFont('helvetica','', 10);$pdf->Cell(0, 0, 'Suhu simpan:', 0);
$pdf->SetXY(75,84);	$pdf->SetFont('helvetica','b', 11);$pdf->Cell(0, 0, $suhu_simpan.TCPDF_FONTS::unichr(186).'C', 0,0,'L');
$pdf->SetXY(51,88);	$pdf->SetFont('helvetica','', 10);$pdf->Cell(0, 0, 'Suhu transport:', 0);
$pdf->SetXY(78,88);	$pdf->SetFont('helvetica','b', 11);$pdf->Cell(0, 0, $suhu_kirim.TCPDF_FONTS::unichr(186).'C', 0,0,'L');



// KIRI BAWAH
$qr_code_kantong=strtoupper($udd['nama'])."\n".'Kantong : '.$queryrelease['rnokantong']."\n".'Produk : '.$queryrelease['rproduk']."\n".'Golongan :'.$queryrelease['rgolda']."\n".'Kedaluwarsa : '.$queryrelease['tgled']."\n".'Suhu simpan : '.$queryrelease['rsuhu']."\n".'Suhu transport : '.$suhupengiriman;
$pdf->write2DBarcode($qr_code_kantong, 'QRCODE,H', 14, 54, 25, 25, $style_qr, 'N');
if (strlen($queryrelease['rproduk'])>5){
	$pdf->SetXY(1,78);$pdf->SetFont('helvetica', 'b', 18);
	$pdf->Cell(49, 0,$queryrelease['rproduk'], 0, 5, 'C');
}else{
	$pdf->SetXY(1,78);$pdf->SetFont('helvetica', 'b', 22);
	$pdf->Cell(49, 0,$queryrelease['rproduk'], 0, 5, 'C');	
}
$pdf->SetXY(1,87);$pdf->SetFont('helvetica', 'b', 16);$pdf->Cell(49, 0, $queryrelease['volume'].' ml', 0, 5, 'C');
// ==============

// Vertical
$pdf->SetLineWidth(0.4);$pdf->Line(50,10,50,95);
// Atas
$pdf->SetLineWidth(0.5);$pdf->Line(1,10,99,10); 

// Bawah
$pdf->SetLineWidth(0.5);$pdf->Line(1,95,99,95);
// Kiri
$pdf->SetLineWidth(0.5);$pdf->Line(1,10,1,95);
// Kanan
$pdf->SetLineWidth(0.5);$pdf->Line(99,10,99,95);

$pdf->SetXY(45,96);$pdf->SetFont('helvetica','b', 6);$pdf->Cell(0, 0, $no_dokumen, 0,1,'R');
ob_clean();
$pdf->IncludeJS("print();");
$pdf->Output($nokantong.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
