<?php
//============================================================+
// File name   : example_027.php
// Begin       : 2008-03-04
// Last Update : 2010-05-02
//
// Description : Example 027 for TCPDF class
//               1D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 1D Barcodes.
 * @author Nicola Asuni
 * @copyright 2004-2009 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

$kddr=strtoupper($_GET['kp']);
$ntr=$_GET['nt'];
$hariini=DATE("Y-m-d");
$jamini=DATE("H:i:s");

$jamcetak=substr($jamini,0,2);
$menitcetak=substr($jamini,3,2);

if($jamcetak=='00' || $jamcetak=='01' || $jamcetak=='02' || $jamcetak=='03' || $jamcetak=='04' || $jamcetak=='05' || $jamcetak=='06' || $jamcetak=='07'){$shiftcetak="Malam";}
elseif($jamcetak=='21' || $jamcetak=='22' || $jamcetak=='23'){$shiftcetak="Malam";}
elseif($jamcetak<'07' && $menitcetak<='59'){$shiftcetak="Malam";}
elseif($jamcetak=='08' || $jamcetak=='09' || $jamcetak=='10' || $jamcetak=='11' || $jamcetak=='12' || $jamcetak=='13'){$shiftcetak="Pagi";}
elseif($jamcetak<='14' && $menitcetak<='59'){$shiftcetak="Pagi";}
elseif($jamcetak>='14' && $menitcetak<='59'){$shiftcetak="Sore";}
elseif($jamcetak=='15' || $jamcetak=='16' || $jamcetak=='17' || $jamcetak=='18' || $jamcetak=='19' || $jamcetak=='20'){$shiftcetak="Sore";}
elseif($jamcetak<='20' && $menitcetak<='59'){$shiftcetak="Sore";}
else{$shiftcetak="-";}

$waktu=gmdate("H:i",time()+7*3600);
$t=explode(":",$waktu);
$jam=$t[0];
$menit=$t[1];
if ($jam>=8 and $jam<14 ){
    if ($menit >00 AND $menit<60){
        $sv="0";
        $ucapan="Pagi";}
}else if ($jam>=14 and $jam<21 ){
    if ($menit >00 AND $menit<60){
        $sv="1";
        $ucapan="Sore";     }
}else if ($jam>=21 and $jam<=0 ){
    if ($menit >00 AND $menit<60){
        $sv="2";
        $ucapan="Malam";     }
}else if ($jam>=0 and $jam<8 ){
    if ($menit >00 AND $menit<60){
        $sv="2";
        $ucapan="Malam";     }
}else {
    $ucapan="Error";
}

##    date_default_timezone_set("Asia/Jakarta"); = Fungsi menggunakan waktu default sesuai waktu GMT
/*
    $b = time();
    $hour = date("G",$b); = Fungsi untuk waktu 24 jam

    if ($hour>=0 && $hour<8) = Kondisioal untuk menampilkan ucapan menurut waktu/jam  
    {
    $ucapan="Malam";
    }
    elseif ($hour >=8 && $hour<=14)
    {
    $ucapan="Pagi";
    }
    elseif ($hour >=15 && $hour<=21)
    {
    $ucapan="Sore";
    }
    else ($hour >21 && $hour<=0)
    {
    $ucapan="Malam";
    }
*/

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('IrawanDB');
$pdf->SetTitle('Simudda Formulir Donor');
$pdf->SetSubject('Formulir');
$pdf->SetKeywords('Simudda, PDF, formulir, donor, pmi, jember');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(0, 0, 0);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 0);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set a barcode on the page footer
//$pdf->setBarcode(date('Y-m-d H:i:s'));

// set font
$pdf->SetFont('helvetica', '', 10);
// add a page
//$pdf->AddPage('P','A4'); // P untuk Potrait
$pdf->AddPage('P','F4'); // L untuk Landscape
//$pdf->AddPage();

//// Example of Image from data stream ('PHP rules')
//$imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
//
//// The '@' character is used to indicate that follows an image data stream and not an image file name
//$pdf->Image('@'.$imgdata);
//$pdf->Rect(10, 10, 10, 10, 'F', array(), array(128,255,128));
//$pdf->Image('images/image_demo.jpg', 10,10, 10, 10, 'JPG', '', '', false, 300, '', false, false, 0, false, false);

// Image example with resizing
//$pdf->Image('tcpdf/images/pmi_transparan.png', 0, 0, 210, 330, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
//$pdf->Image('tcpdf/images/Logo_PMI_Besar.png', 17, 3, 18, 17, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Image('tcpdf/Logo_PMI_Besar.png', 2, 3, 37, 18, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Image('tcpdf/images/UKAS.png', 179, 2.5, 25, 17, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

// define barcode style
$style = array(
	'position' => 'R',
	'border' => false,
	'padding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);

// Garis Putus Putus //
$style1 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
// Garis Biasa //
$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
// Garis Titik Titik //
$style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(255, 0, 0));
$style4 = array('L' => 0,
    'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
    'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
    'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10'));
$style5 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 64, 128));
$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
$style7 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 128, 0));
$style8 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

// Circle and ellipse
$pdf->SetFont('helvetica', 'b',7);
$pdf->Text(186, 44, 'NOMOR');
$pdf->Text(184, 47, 'ANTRIAN');
$pdf->SetFont('helvetica', 'b',25);
$pdf->Text(181, 50, $_GET['ia']);
$pdf->SetLineStyle($style8);
$pdf->Circle(192,54,12); /** (Horizontal, Vertical, Diameter Lingkaran); **/
//$pdf->Circle(25,105,10, 90, 180, null, $style6);
//$pdf->Circle(25,105,10, 270, 360, 'F');
//$pdf->Circle(25,105,10, 270, 360, 'C', $style6);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
require_once('config/koneksi.php');
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$skg=DATE("Y-m-d");
$thn_skrg=DATE("Y");
$bln_skrg=DATE("m");
$tgl_skrg=DATE("d");
$bs=DATE("n",strtotime(DATE("Y-m-d")));
$sekarang=$tgl_skrg.' '.$bulan[$bs].' '.$thn_skrg;

$pdr=mysql_query("select * from pendonor where Kode='$_GET[kp]'");
if ($pdr) $pd=mysql_fetch_assoc($pdr);

if($pd['GolDarah']=='X' OR $pd['GolDarah']===NULL OR $pd['GolDarah']==''){$gd='-';}else{$gd=$pd['GolDarah'];}
if($pd['Rhesus']=='' OR $pd['Rhesus']===NULL){$rh='( )';}else{$rh='('.$pd['Rhesus'].')';}

$tgl=date("d",strtotime(DATE("Y-m-d")));
$bln=date("n",strtotime(DATE("Y-m-d")));
$thn=date("Y",strtotime(DATE("Y-m-d")));
$bln=$bulan[$bln];

$tgll=date("d",strtotime($pd[TglLhr]));
$blnl=date("n",strtotime($pd[TglLhr]));
$thnl=date("Y",strtotime($pd[TglLhr]));
$blnl=$bulan[$blnl];

$tgl_lahir=$pd[TglLhr];
$thn_lhr=substr($pd[TglLhr],0,4);
$bln_lhr=substr($pd[TglLhr],6,2);
$tgl_lhr=substr($pd[TglLhr],8,2);

if($pd[Jk]=='0'){$jk="Laki-Laki";}else{$jk="Perempuan";}
if($pd[Status]=='0'){$nikah="Belum Menikah";}else{$nikah="Menikah";}
if($pd[Call]=='0'){$call="Tidak";}else{$call="Dapat";}

$tt=mysql_query("SELECT substr(tglpembuatan,12,8) as waktu, tglpembuatan, user FROM user_komponen WHERE nokantong='$_GET[noKantong]' ORDER BY tglpembuatan DESC LIMIT 1");
$tglproses=mysql_fetch_assoc($tt);
if(mysql_num_rows($tt)<1){
$petugas=$_SESSION['namauser'];
}else{
$petugas=$tglproses[user];
}
$ptt=$_GET['usr'];

$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
$pdf->SetFont('helvetica', 'B', 14);
$pdf->SetXY(0,1);
$pdf->Cell(0, 12,'PMI KABUPATEN JEMBER',0, 1, 'C');
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetXY(0,5);
$pdf->Cell(0, 12,'UNIT TRANSFUSI DARAH',0, 1, 'C');

$pdf->SetFont('helvetica', '',10);
$pdf->SetXY(0,9);
$pdf->Cell(0, 12,'Jl. Srikoyo No.115 Patrang - Jember, Telp (0331) 484383, Fax (0331) 488430',0, 1, 'C');
$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(40,13);
$pdf->Cell(0, 12,'Kode Dokumen :',0, 1);
$pdf->SetFont('helvetica', 'b', 8);
$pdf->SetXY(62,13);
//$pdf->Cell(0, 12,'FM-UTD-LAB-02- -04',0, 1);
$pdf->Cell(0, 12,'FM-L3-UTD-DONOR-001- -001',0, 1);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(104,13);
//$pdf->Cell(0, 12,'Revisi :',0, 1);
$pdf->Cell(0, 12,'Versi :',0, 1);
$pdf->SetFont('helvetica', 'b', 8);
$pdf->SetXY(113,13);
//$pdf->Cell(0, 12,'02',0, 1);
$pdf->Cell(0, 12,'001',0, 1);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(120,13);
//$pdf->Cell(0, 12,'Tanggal Terbit :',0, 1);
$pdf->Cell(0, 12,'Tgl Revisi :',0, 1);
$pdf->SetFont('helvetica', 'b', 8);
$pdf->SetXY(135,13);
//$pdf->Cell(0, 12,'25-05-2015',0, 1);
//$pdf->Cell(0, 12,'07-03-2017',0, 1);
$pdf->Cell(0, 12,'-',0, 1);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(139,13);
//$pdf->Cell(0, 12,'Tanggal Terbit :',0, 1);
$pdf->Cell(0, 12,'Tgl Pelaksanaan :',0, 1);
$pdf->SetFont('helvetica', 'b', 8);
$pdf->SetXY(162,13);
$pdf->Cell(0, 12,'07-03-2017',0, 1);

// Rect (Kiri, Atas, Kanan, Bawah)
//$pdf->Rect(2, 15, 105, 6, 'D', array('all' => $style2)); // Persegi Panjang Kecil
$pdf->Rect(2, 21, 105, 6, 'D', array('all' => $style2)); // Persegi Panjang Kecil Kiri
$pdf->Rect(107, 21, 101, 6, 'D', array('all' => $style2)); // Persegi Panjang Kecil Kanan
$pdf->Rect(2, 27, 206, 41, 'D', array('all' => $style2)); // Persegi Panjang Utama
$pdf->Rect(107, 29, 0, 37, 'D', array('all' => $style2)); // Garis Lurus
$pdf->Rect(2, 68, 206, 46, 'D', array('all' => $style2)); // Persegi Panjang Tengah
$pdf->Rect(107, 70, 0, 41, 'D', array('all' => $style2)); // Garis Lurus Tengah
$pdf->Rect(2, 114, 206, 28, 'D', array('all' => $style2)); // Persegi Panjang Ketiga
$pdf->Rect(2, 142, 206, 15, 'D', array('all' => $style2)); // Persegi Panjang Keempat
$pdf->Rect(2, 157, 206, 12, 'D', array('all' => $style2)); // Persegi Panjang Kelima
$pdf->Rect(2, 169, 206, 12, 'D', array('all' => $style2)); // Persegi Panjang Keenam

//// Rect (Kiri, Atas, Kanan, Bawah)
//$pdf->Rect(2, 29, 80, 50, 'D', array('all' => $style2)); // Persegi Panjang No Warna

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,17);
$pdf->Cell(0, 14, 'Kode Donor');
$pdf->SetXY(35,17);
$pdf->Cell(0, 14, ': '.$pd['Kode']);
//$pdf->SetFont('helvetica', 'b',9);
//$pdf->SetXY(74,17);
//$pdf->Cell(0, 14, 'Nomor Antrian');
//$pdf->SetXY(97,17);
//$pdf->Cell(0, 14, ': '.$_GET['noant']);

//$pdf->SetFont('helvetica', '', 10);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(108,17);
$pdf->Cell(0, 14, 'Tanggal Donor');
$pdf->SetXY(140,17);
$pdf->Cell(0, 14, ': '.$tgl.' '.$bln.' '.$thn);

$pdf->SetFont('helvetica', 'b', 8);
$pdf->SetXY(185,17);
$pdf->Cell(0, 14, $ptt.' - '.$shiftcetak);
//$pdf->Cell(0, 14, 'Rhesus : '.$kantong1[RhesusDrh], 0);

//$pdf->SetFont('helvetica', '',10);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,23);
$pdf->Cell(0, 13, 'No. KTP/SIM');
$pdf->SetXY(35,23);
$pdf->Cell(0, 13, ': '.$pd[NoKTP]);

//$pdf->SetFont('helvetica', '',10);
$pdf->SetXY(2,27);
$pdf->Cell(0, 14, 'Nama');
$pdf->SetXY(35,27);
$pdf->Cell(0, 14, ': '.$pd[Nama]);
//$pdf->Cell(0, 14, 'Rhesus : '.$kantong1[RhesusDrh], 0);

//$pdf->SetFont('helvetica', 'b',9);
//$pdf->SetXY(2,57);
$pdf->SetXY(108,23);
$pdf->Cell(0, 14, 'Gol. Darah (Rh)');
$pdf->SetFont('helvetica', 'b',9);
//$pdf->SetXY(35,57);
$pdf->SetXY(140,23);
$pdf->Cell(0, 14, ': '.$gd.' '.$rh);

$pdf->SetFont('helvetica', '',9);
$pdf->SetXY(108,28);
$pdf->Cell(0, 13, 'Alamat');
$pdf->SetXY(140,28);
$pdf->Cell(0, 14, ': '.$pd[Alamat]);
$pdf->SetXY(108,33);
$pdf->Cell(0, 13, 'Kelurahan');
$pdf->SetXY(140,33);
$pdf->Cell(0, 14, ': '.$pd[kelurahan]);
$pdf->SetXY(108,38);
$pdf->Cell(0, 13, 'Kecamatan');
$pdf->SetXY(140,38);
$pdf->Cell(0, 14, ': '.$pd[kecamatan]);
$pdf->SetXY(108,43);
$pdf->Cell(0, 13, 'Kabupaten');
$pdf->SetXY(140,43);
$pdf->Cell(0, 14, ': '.$pd[wilayah]);
$pdf->SetXY(108,48);
$pdf->Cell(0, 13, 'Kode Pos');
$pdf->SetXY(140,48);
$pdf->Cell(0, 14, ': '.$pd[KodePos]);

//$pdf->Line(5, 10, 80, 30, $style3); // Miring
//$pdf->Line(5, 10, 5, 30, $styl3); // Lurus Kebawah
//$pdf->Line(5, 10, 80, 10, $style2); // Mendatar

//$pdf->SetXY(4,10);
//$pdf->Rect(100, 10, 40, 20, 'DF', $style2, array(220, 220, 200)); // Persegi Panjang Fill Warna Abu-Abu

//$pdf->SetFont('helvetica', '',10);
$pdf->SetXY(108,58);
$pdf->Cell(0, 13, 'Nama Ibu Kandung');
$pdf->SetXY(140,58);
$pdf->Cell(0, 14, ': '.$pd[ibukandung]);

//$pdf->SetXY(108,28);
$pdf->SetXY(2,32);
$pdf->Cell(0, 13, 'Jenis Kelamin');
//$pdf->SetXY(140,28);
$pdf->SetXY(35,32);
$pdf->Cell(0, 14, ': '.$jk);

//$pdf->SetXY(108,33);
$pdf->SetXY(2,37);
$pdf->Cell(0, 13, 'Tempat, Tgl Lahir');
//$pdf->SetXY(140,33);
$pdf->SetXY(35,37);
$pdf->Cell(0, 14, ': '.$pd[TempatLhr].', '.$tgll.' '.$blnl.' '.$thnl);

//$pdf->SetXY(108,38);
$pdf->SetXY(2,42);
$pdf->Cell(0, 13, 'Pekerjaan');
//$pdf->SetXY(140,38);
$pdf->SetXY(35,42);
$pdf->Cell(0, 13, ': '.$pd[Pekerjaan]);

//$pdf->SetXY(108,43);
$pdf->SetXY(2,47);
$pdf->Cell(0, 13, 'Status Nikah');
//$pdf->SetXY(140,43);
$pdf->SetXY(35,47);
$pdf->Cell(0, 13, ': '.$nikah);

$pdf->SetFont('helvetica', '',9);
$pdf->SetXY(2,57);
$pdf->Cell(0, 13, 'Bersedia dihubungi ?');
$pdf->SetXY(35,57);
$pdf->Cell(0, 13, ': ');
/** Tanda Centang pada Bersedia Dihubungi */
if($pd['Call']=='1'){
// Keterangan Gambar posisi_xx, posisi_yy, ukuran_xx, ukuran_yy, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false //
    $pdf->Image('tcpdf/images/checkmark.png', 38, 62, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
}elseif($pd['Call']=='0'){
// Keterangan Gambar posisi_xx, posisi_yy, ukuran_xx, ukuran_yy, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false //
    $pdf->Image('tcpdf/images/checkmark.png', 49, 62, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
}else{
}
/** END Centang pada Bersedia Dihubungi */
$pdf->Rect(38, 62, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(41,57);
$pdf->Cell(0, 13, 'Iya');
$pdf->Rect(49, 62, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(52,57);
$pdf->Cell(0, 13, 'Tidak');

//$pdf->SetXY(108,48);
//$pdf->Cell(0, 13, 'Telepon');
//$pdf->SetXY(140,48);
//$pdf->Cell(0, 13, ': '.$pd[telp]);

//$pdf->SetXY(108,53);
$pdf->SetFont('helvetica', '',9);
$pdf->SetXY(2,52);
$pdf->Cell(0, 13, 'Handphone');
//$pdf->SetXY(140,53);
$pdf->SetXY(35,52);
$pdf->Cell(0, 13, ': '.$pd[telp2]);

$pdf->SetXY(108,53);
$pdf->Cell(0, 13, 'Jumlah Donasi');
$pdf->SetXY(140,53);
$pdf->Cell(0, 13, ': '.$pd[jumDonor]);

$pdf->SetFont('helvetica', 'b', 10);
$pdf->SetXY(2,65);
$pdf->Cell(0, 13, 'DIISI OLEH PETUGAS HB :');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,70);
$pdf->Cell(0, 13, 'Petugas Hb :
...................................................................................');

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(2,74);
$pdf->Cell(0, 13, 'Konfirmasi Data Pendonor :');
$pdf->Rect(46, 79, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,78);
$pdf->Cell(0, 13, 'Jenis Pemeriksaan Hb :');

$gariskecil = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
// Rect (Kiri, Atas, Kanan, Bawah)
$pdf->Rect(4, 87, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(7,82);
$pdf->Cell(0, 13, 'CuSO4 1,053');
$pdf->Rect(29, 87, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(32,82);
$pdf->Cell(0, 13, 'Tenggelam');
$pdf->Rect(51, 87, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(54,82);
$pdf->Cell(0, 13, 'Melayang');
$pdf->Rect(71, 87, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(74,82);
$pdf->Cell(0, 13, 'Mengapung');

$pdf->Rect(4, 91, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(7,86);
$pdf->Cell(0, 13, 'CuSO4 1,062');
$pdf->Rect(29, 91, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(32,86);
$pdf->Cell(0, 13, 'Tenggelam');
$pdf->Rect(51, 91, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(54,86);
$pdf->Cell(0, 13, 'Melayang');
$pdf->Rect(71, 91, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(74,86);
$pdf->Cell(0, 13, 'Mengapung');

$pdf->SetXY(2,91);
$pdf->Cell(0, 13, 'Hemo Control :');
$pdf->Rect(26, 96, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(29,91);
$pdf->Cell(0, 13, 'Hb ............................ gr / dl');
$pdf->Rect(73, 96, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(77,91);
$pdf->Cell(0, 13, 'Hct ................... %');
$pdf->SetXY(2,96);
$pdf->Cell(0, 13, 'Berat Badan ................... Kg.');

$pdf->SetXY(2,104);
$pdf->Cell(0, 13, 'Gol. Darah');
// Rect (Kiri, Atas, Kanan, Bawah)
$pdf->Rect(20, 105, 6, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetFont('helvetica', 'b', 21);
$pdf->SetXY(19,102);
$pdf->Cell(0, 13, 'A');
$pdf->Rect(30, 105, 6, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetFont('helvetica', 'b', 21);
$pdf->SetXY(29,102);
$pdf->Cell(0, 13, 'B');
$pdf->Rect(40, 105, 12, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetFont('helvetica', 'b', 21);
$pdf->SetXY(40,102);
$pdf->Cell(0, 13, 'AB');
$pdf->Rect(56, 105, 6, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetFont('helvetica', 'b', 21);
$pdf->SetXY(55,102);
$pdf->Cell(0, 13, 'O');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(66,104);
$pdf->Cell(0, 13, 'Rhesus');
// Rect (Kiri, Atas, Kanan, Bawah)
$pdf->Rect(79, 108, 4, 4, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->SetFont('helvetica', '', 17);
$pdf->SetXY(83,103);
$pdf->Cell(0, 13, '+');

$pdf->Rect(90, 108, 4, 4, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetFont('helvetica', '', 19);
$pdf->SetXY(95,103);
$pdf->Cell(0, 13, '-');

$htdonor=mysql_fetch_assoc(mysql_query("SELECT JenisDonor, NoForm FROM htransaksi WHERE KodePendonor='$_GET[kp]' ORDER BY Tgl DESC LIMIT 1"));
$pasien=mysql_fetch_assoc(mysql_query("SELECT ht.NoForm, ht.medis, ht.bagian, ht.kelas, ht.NamaDokter, ht.NamaOS, ht.rs, dt.GolDarah, dt.Rhesus, dt.JenisDarah, dt.TglPerlu
        FROM htranspermintaan ht, dtranspermintaan dt WHERE ht.NoForm=dt.NoForm AND ht.NoForm='$htdonor[NoForm]'"));
$rsdirawat=mysql_fetch_assoc(mysql_query("SELECT NamaRs FROM rmhsakit WHERE Kode='$pasien[rs]'"));

$tglp=date("d",strtotime($pasien['TglPerlu']));
$blnp=date("n",strtotime($pasien['TglPerlu']));
$thnp=date("Y",strtotime($pasien['TglPerlu']));
$blnp=$bulan[$blnp];

/** Tanda Centang pada Jenis Donor  */
if($htdonor['JenisDonor']=='0'){
// Keterangan Gambar posisi_xx, posisi_yy, ukuran_xx, ukuran_yy, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false //
$pdf->Image('tcpdf/images/checkmark.png', 132, 70, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
}elseif($htdonor['JenisDonor']=='1'){
// Keterangan Gambar posisi_xx, posisi_yy, ukuran_xx, ukuran_yy, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false //
$pdf->Image('tcpdf/images/checkmark.png', 152, 70, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
}else{
}
/** END Centang pada Jenis Donor */

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(108,65);
$pdf->Cell(0, 13, 'Macam Donor');
$pdf->Rect(132, 70, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(135,65);
$pdf->Cell(0, 13, 'Sukarela');
$pdf->Rect(152, 70, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(155,65);
$pdf->Cell(0, 13, 'Pengganti');
$pdf->SetFont('helvetica', 'ub', 10);
$pdf->SetXY(126,70);
$pdf->Cell(0, 13, 'KOLOM UNTUK DONOR PENGGANTI');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(108,75);
$pdf->Cell(0, 13, 'Nama OS');
$pdf->SetXY(130,75);
if($htdonor['JenisDonor']=='1'){
    $pdf->Cell(0, 13, ': '.$pasien['NamaOS']);
    $pdf->SetXY(108,80);
    $pdf->Cell(0, 13, 'RS Dirawat');
    $pdf->SetXY(130,80);
    $pdf->Cell(0, 13, ': '.$rsdirawat['NamaRs']);
    $pdf->SetXY(108,85);
    $pdf->Cell(0, 13, 'No. Form.');
    $pdf->SetXY(130,85);
    $pdf->Cell(0, 13, ': '.$htdonor['NoForm']);
    $pdf->SetXY(108,90);
    $pdf->Cell(0, 13, 'Jenis Darah');
    $pdf->SetXY(130,90);
    $pdf->Cell(0, 13, ': '.$pasien['JenisDarah']);
    $pdf->SetXY(108,95);
    $pdf->Cell(0, 13, 'Tgl Dibutuhkan');
    $pdf->SetXY(130,95);
    $pdf->Cell(0, 13, ': '.$tglp.' '.$blnp.' '.$thnp);
    $pdf->SetXY(108,104);
    $pdf->Cell(0, 13, 'Gol. Darah');
    $pdf->SetXY(130,104);
    $pdf->Cell(0, 13, ':');

//$pdf->Circle(138,109,5); /** (Horizontal, Vertical, Diameter Lingkaran); **/

// Rect (Kiri, Atas, Kanan, Bawah)
    $pdf->Rect(134, 105, 7, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(134,102);
    $pdf->Cell(0, 13, 'A');
    $pdf->Rect(150, 105, 7, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(150,102);
    $pdf->Cell(0, 13, 'B');
    $pdf->Rect(166, 105, 12, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(166,102);
    $pdf->Cell(0, 13, 'AB');
    $pdf->Rect(186, 105, 8, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(186,102);
    $pdf->Cell(0, 13, 'O');
}else{
    $pdf->Cell(0, 13, ':
................................................................................');
    $pdf->SetXY(108,80);
    $pdf->Cell(0, 13, 'RS Dirawat');
    $pdf->SetXY(130,80);
    $pdf->Cell(0, 13, ':
................................................................................');
    $pdf->SetXY(108,85);
    $pdf->Cell(0, 13, 'No. Form.');
    $pdf->SetXY(130,85);
    $pdf->Cell(0, 13, ':
................................................................................');
    $pdf->SetXY(108,90);
    $pdf->Cell(0, 13, 'Jenis Darah');
    $pdf->SetXY(130,90);
    $pdf->Cell(0, 13, ':
................................................................................');
    $pdf->SetXY(108,95);
    $pdf->Cell(0, 13, 'Tgl Dibutuhkan');
    $pdf->SetXY(130,95);
    $pdf->Cell(0, 13, ':
................................................................................');
    $pdf->SetXY(108,104);
    $pdf->Cell(0, 13, 'Gol. Darah');
    $pdf->SetXY(130,104);
    $pdf->Cell(0, 13, ':');
// Rect (Kiri, Atas, Kanan, Bawah)
    $pdf->Rect(134, 105, 7, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(134,102);
    $pdf->Cell(0, 13, 'A');
    $pdf->Rect(150, 105, 7, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(150,102);
    $pdf->Cell(0, 13, 'B');
    $pdf->Rect(166, 105, 12, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(166,102);
    $pdf->Cell(0, 13, 'AB');
    $pdf->Rect(186, 105, 8, 7, 'D', array('all' => $gariskecil)); // Kotak Checkbox
    $pdf->SetFont('helvetica', 'b', 21);
    $pdf->SetXY(186,102);
    $pdf->Cell(0, 13, 'O');
}

$pdf->SetFont('helvetica', 'b', 10);
$pdf->SetXY(2,112);
$pdf->Cell(0, 13, 'DIISI OLEH PETUGAS PEMERIKSA :');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,119);
$pdf->Cell(0, 13, 'Pemeriksa :
 ..............................................');

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(62,119);
$pdf->Cell(0, 13, 'Konfirmasi Data Pendonor :');
$pdf->Rect(106, 124, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(110,119);
$pdf->Cell(0, 13, 'Tensi :
 ............................');

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(148,119);
$pdf->Cell(0, 13, 'Suhu :
 ..................');

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(178,119);
$pdf->Cell(0, 13, 'Nadi :
 .................');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,125);
$pdf->Cell(0, 13, 'Riwayat Medis : taa.lain - lain :
 ...............................................................................................................
...................................................................');

$gariskecil = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
// Rect (Kiri, Atas, Kanan, Bawah)
$pdf->Rect(4, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(8,131);
$pdf->Cell(0, 13, 'Ditolak /');
$pdf->Rect(23, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(26,131);
$pdf->Cell(0, 13, 'Diambil Sebanyak');
$pdf->Rect(56, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(60,131);
$pdf->Cell(0, 13, '250cc');
$pdf->Rect(73, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(76,131);
$pdf->Cell(0, 13, '350cc');

$pdf->SetXY(90,131);
$pdf->Cell(0, 13, 'Kantong : ');
$pdf->Rect(107, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(110,131);
$pdf->Cell(0, 13, 'Single /');
$pdf->Rect(125, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(128,131);
$pdf->Cell(0, 13, 'Double /');
$pdf->Rect(144, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(147,131);
$pdf->Cell(0, 13, 'Triple /');
$pdf->Rect(160, 136, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(163,131);
$pdf->Cell(0, 13, 'Quadruple');

$pdf->SetFont('helvetica', 'b', 10);
$pdf->SetXY(2,139);
$pdf->Cell(0, 13, 'DIISI PETUGAS AFTAP :');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,147);
$pdf->Cell(0, 13, 'Petugas Aftap :
 ..............................................');

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(126,147);
$pdf->Cell(0, 13, 'No. Kantong :
 .........................................
.....................');

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(77,147);
$pdf->Cell(0, 13, 'Konfirmasi Data Pendonor :');
$pdf->Rect(121, 152, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

//$pdf->SetFont('helvetica', '', 9);
//$pdf->SetXY(2,147);
//$pdf->Cell(0, 13, 'Nama Petugas Aftap :
// ............................................................
//.........................................');

$pdf->SetFont('helvetica', 'b', 9);
$pdf->SetXY(126,147);
$pdf->Cell(0, 13, 'No. Kantong :
 .........................................
.....................');

$pdf->SetFont('helvetica', 'b', 10);
$pdf->SetXY(2,153);
$pdf->Cell(0, 13, 'Pengambilan');
$pdf->SetFont('helvetica', '', 10);
$pdf->Rect(4, 164, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(7,159);
$pdf->Cell(0, 13, 'Baik');
$pdf->Rect(20, 164, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(23,159);
$pdf->Cell(0, 13, 'Tidak Lancar');
$pdf->Rect(49, 164, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(52,159);
$pdf->Cell(0, 13, 'Stop .................. cc');

$pdf->SetFont('helvetica', 'b', 10);
$pdf->SetXY(126,153);
$pdf->Cell(0, 13, 'Reaksi Donor');
$pdf->SetFont('helvetica', '', 10);
$pdf->Rect(127, 164, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(130,159);
$pdf->Cell(0, 13, 'Pusing');
$pdf->Rect(147, 164, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(150,159);
$pdf->Cell(0, 13, 'Pingsan');
$pdf->Rect(168, 164, 3, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->SetXY(172,159);
$pdf->Cell(0, 13, 'Tidak Ada Keluhan');

$pdf->SetFont('helvetica', 'b', 10);
$pdf->SetXY(2,165);
$pdf->Cell(0, 13, 'Keterangan :');

$pdf->SetFont('helvetica', 'b', 14);
$pdf->SetXY(2,185);
$pdf->Cell(0, 13, 'KUESIONER RIWAYAT KESEHATAN');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(2,192);
$pdf->Cell(0, 13, 'Beri tanda "Centang"          pada kotak jawaban yang sesuai');
// Keterangan Gambar posisi_xx, posisi_yy, ukuran_xx, ukuran_yy, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false //
$pdf->Image('tcpdf/images/checkmark.png', 34, 196, 5, 5, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(30,192);
//$check = html_entity_decode('&#966;', ENT_XHTML,"ISO-8859-1");
//html_entity_decode('&#x2713;', ENT_XHTML,"ISO-8859-1");
//$pdf->SetFont('ZapfDingbats','', 10);
//$pdf->Cell(0, 13, $check, 1, 0);
//$reportSubtitle = stripslashes($_POST['pagesubtitle']);
//$reportSubtitle = iconv('UTF-8', 'windows-1252', $reportSubtitle);
$pdf->Cell(0, 13, $check);

$pdf->SetXY(2,198);
$pdf->Cell(0, 13, 'Kami akan bertanya kepada anda setiap kali anda menyumbangkan darah tentang kesehatan anda secara
 umum untuk memutuskan apakah');
$pdf->SetXY(2,202);
$pdf->Cell(0, 13, 'darah anda aman untuk diberikan kepada pasien.');

$pdf->SetXY(70,207);
$pdf->Cell(0, 13, 'Iya');
$pdf->SetXY(79,207);
$pdf->Cell(0, 13, 'Tidak');
$pdf->SetXY(89,207);
$pdf->Cell(0, 13, 'Petugas');

/** @var Informed Consent sesuai isian dari Database $selq */
$selq=mysql_fetch_assoc(mysql_query("SELECT * FROM informed_consent WHERE notrans='$ntr' AND KodePendonor='$kddr'"));
if($selq['q1']==0){$q1="71.5";}else{$q1="82.5";}        if($selq['q2']==0){$q2="71.5";}else{$q2="82.5";}
if($selq['q3']==0){$q3="71.5";}else{$q3="82.5";}        if($selq['q4']==0){$q4="71.5";}else{$q4="82.5";}
if($selq['q5']==0){$q5="71.5";}else{$q5="82.5";}        if($selq['q6']==0){$q6="71.5";}else{$q6="82.5";}
if($selq['q7']==0){$q7="71.5";}else{$q7="82.5";}        if($selq['q8']==0){$q8="71.5";}else{$q8="82.5";}
if($selq['q9']==0){$q9="71.5";}else{$q9="82.5";}        if($selq['q10']==0){$q10="71.5";}else{$q10="82.5";}
if($selq['q11']==0){$q11="71.5";}else{$q11="82.5";}     if($selq['q12']==0){$q12="71.5";}else{$q12="82.5";}
if($selq['q13']==0){$q13="71.5";}else{$q13="82.5";}     if($selq['q14']==0){$q14="175.5";}else{$q14="186.5";}
if($selq['q15']==0){$q15="175.5";}else{$q15="186.5";}     if($selq['q16']==0){$q16="175.5";}else{$q16="186.5";}
if($selq['q17']==0){$q17="175.5";}else{$q17="186.5";}     if($selq['q18']==0){$q18="175.5";}else{$q18="186.5";}
if($selq['q19']==0){$q19="175.5";}else{$q19="186.5";}     if($selq['q20']==0){$q20="175.5";}else{$q20="186.5";}
if($selq['q21']==0){$q21="175.5";}else{$q21="186.5";}     if($selq['q22']==0){$q22="175.5";}else{$q22="186.5";}
if($selq['q23']==0){$q23="175.5";}else{$q23="186.5";}     if($selq['q24']==0){$q24="175.5";}else{$q24="186.5";}
if($selq['q25']==0){$q25="175.5";}else{$q25="186.5";}

$pdf->Rect(70, 217, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q1, 217, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(70, 220, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 226, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 229, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 232, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 235, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 238, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 241, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 244, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 247, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 250, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 253, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(70, 256, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->Rect(81, 217, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(81, 220, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->Image('tcpdf/images/checkmark.png', $q2, 220, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 226, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q3, 226, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 229, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q4, 229, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 232, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q5, 232, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 235, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q6, 235, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 238, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q7, 238, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 241, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q8, 241, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 244, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q9, 244, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 247, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q10, 247, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 250, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q11, 250, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 253, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q12, 253, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(81, 256, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q13, 256, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

$pdf->Rect(92, 217, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 220, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 226, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 229, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 232, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 235, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 238, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 241, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 244, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 247, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 250, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 253, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(92, 256, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->SetXY(174,207);
$pdf->Cell(0, 13, 'Iya');
$pdf->SetXY(183,207);
$pdf->Cell(0, 13, 'Tidak');
$pdf->SetXY(193,207);
$pdf->Cell(0, 13, 'Petugas');
/* Checkbox Kanan */
$pdf->Rect(174, 217, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 220, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 223, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 226, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 229, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 232, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 235, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 238, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 244, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 250, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 256, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(174, 259, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->Rect(185, 217, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q14, 217, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 220, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q15, 220, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 223, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q16, 223, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 226, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q17, 226, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 229, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q18, 229, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 232, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q19, 232, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 235, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q20, 235, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 238, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q21, 238, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 244, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q22, 244, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 250, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q23, 250, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

/** Pertanyaan Tambahan untuk Wanita */
if($pd['Jk']=='0'){
$pdf->Rect(185, 256, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(185, 259, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
}else{
$pdf->Rect(185, 256, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q24, 256, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
$pdf->Rect(185, 259, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Image('tcpdf/images/checkmark.png', $q25, 259, 3, 3, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
}

$pdf->Rect(196, 217, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 220, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 223, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 226, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 229, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 232, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 235, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 238, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 244, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 250, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 256, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox
$pdf->Rect(196, 259, 6, 3, 'D', array('all' => $gariskecil)); // Kotak Checkbox

$pdf->SetXY(2,212);
$pdf->Cell(0, 13, '1.');
$pdf->SetXY(9,212);
$pdf->Cell(0, 13, 'Sehatkah Anda Hari ini ?');

$pdf->SetXY(2,215);
$pdf->Cell(0, 13, '2.');
$pdf->SetXY(9,215);
$pdf->Cell(0, 13, 'Sedang minum antibiotik ?');

$pdf->SetXY(2,218);
$pdf->Cell(0, 13, '3.');
$pdf->SetXY(9,218);
$pdf->Cell(0, 13, 'Sedang minum Aspirin? atau Obat');
$pdf->SetXY(9,221);
$pdf->Cell(0, 13, 'Yang Mengandung Aspirin ?');

$pdf->SetXY(2,224);
$pdf->Cell(0, 13, '4.');
$pdf->SetXY(9,224);
$pdf->Cell(0, 13, 'Adakah keluhan setelah donor terakhir ?');

$pdf->SetXY(2,227);
$pdf->Cell(0, 13, '5.');
$pdf->SetXY(9,227);
$pdf->Cell(0, 13, 'Apakah Anda Merasa Pusing ?');

$pdf->SetXY(2,230);
$pdf->Cell(0, 13, '6.');
$pdf->SetXY(9,230);
$pdf->Cell(0, 13, 'Sakit / Operasi dalam 3 Bulan ini ?');

$pdf->SetXY(2,233);
$pdf->Cell(0, 13, '7.');
$pdf->SetXY(9,233);
$pdf->Cell(0, 13, 'Pernah Sakit Kencing Manis ?');

$pdf->SetXY(2,236);
$pdf->Cell(0, 13, '8.');
$pdf->SetXY(9,236);
$pdf->Cell(0, 13, 'Pernah Ada gangguan / Sakit Ginjal ?');

$pdf->SetXY(2,239);
$pdf->Cell(0, 13, '9.');
$pdf->SetXY(9,239);
$pdf->Cell(0, 13, 'Pernah Mengalami Sakit Radang ?');

$pdf->SetXY(2,242);
$pdf->Cell(0, 13, '10.');
$pdf->SetXY(9,242);
$pdf->Cell(0, 13, 'Pernah Sakit Jantung ?');

$pdf->SetXY(2,245);
$pdf->Cell(0, 13, '11.');
$pdf->SetXY(9,245);
$pdf->Cell(0, 13, 'Pernah ada penyakit Kelainan Darah ?');

$pdf->SetXY(2,248);
$pdf->Cell(0, 13, '12.');
$pdf->SetXY(9,248);
$pdf->Cell(0, 13, 'Pernah sakit Haemofilia ?');

$pdf->SetXY(2,251);
$pdf->Cell(0, 13, '13.');
$pdf->SetXY(9,251);
$pdf->Cell(0, 13, 'Pernah sakit Asma ?');

$pdf->SetXY(107,212);
$pdf->Cell(0, 13, '14.');
$pdf->SetXY(114,212);
$pdf->Cell(0, 13, 'Punya Alergi Makanan / Obat ?');

$pdf->SetXY(107,215);
$pdf->Cell(0, 13, '15.');
$pdf->SetXY(114,215);
$pdf->Cell(0, 13, 'Pernah Sakit TBC ?');

$pdf->SetXY(107,218);
$pdf->Cell(0, 13, '16.');
$pdf->SetXY(114,218);
$pdf->Cell(0, 13, 'Sering / Pernah Kejang-kejang ? ');

$pdf->SetXY(107,221);
$pdf->Cell(0, 13, '17.');
$pdf->SetXY(114,221);
$pdf->Cell(0, 13, 'Punya Gejala HIV ?');

$pdf->SetXY(107,224);
$pdf->Cell(0, 13, '18.');
$pdf->SetXY(114,224);
$pdf->Cell(0, 13, 'Punya Gejala / Sakit Hepatitis B/C ?');

$pdf->SetXY(107,227);
$pdf->Cell(0, 13, '19.');
$pdf->SetXY(114,227);
$pdf->Cell(0, 13, 'Punya Gejala Syphilis ?');

$pdf->SetXY(107,230);
$pdf->Cell(0, 13, '20.');
$pdf->SetXY(114,230);
$pdf->Cell(0, 13, 'Pernah Sakit Malaria ?');

$pdf->SetXY(107,233);
$pdf->Cell(0, 13, '21.');
$pdf->SetXY(114,233);
$pdf->Cell(0, 13, 'Pergi keluar negeri 6 bulan terakhir ?');

$pdf->SetXY(107,236);
$pdf->Cell(0, 13, '22.');
$pdf->SetXY(114,236);
$pdf->Cell(0, 13, 'Jarak Donasi Donor terakhir');
$pdf->SetXY(114,239);
$pdf->Cell(0, 13, 'kurang dari 60 Hari ?');

$pdf->SetXY(107,242);
$pdf->Cell(0, 13, '23.');
$pdf->SetXY(114,242);
$pdf->Cell(0, 13, 'Identitas Donasi sesuai dengan');
$pdf->SetXY(114,245);
$pdf->Cell(0, 13, 'Identitas KTP / SIM ?');

$pdf->SetFont('helvetica', 'bu', 8);
$pdf->SetXY(107,248);
$pdf->Cell(0, 13, 'PERTANYAAN TAMBAHAN UNTUK WANITA');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(107,251);
$pdf->Cell(0, 13, '24.');
$pdf->SetXY(114,251);
$pdf->Cell(0, 13, 'Sedang Hamil / Menyusui ?');

$pdf->SetXY(107,254);
$pdf->Cell(0, 13, '25.');
$pdf->SetXY(114,254);
$pdf->Cell(0, 13, 'Sedang Menstruasi ?');

$pdf->SetFont('helvetica', 'ub', 15);
$pdf->SetXY(0,261);
$pdf->Cell(0, 13, 'PERNYATAAN DONOR',0,1,'C');

$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(4,266);
$pdf->Cell(0, 13, '* Saya menyatakan bahwa saya telah memahami formulir isian dan menjawab sesuai pengetahuan saya.');
$pdf->SetXY(4,269);
$pdf->Cell(0, 13, '* Saya mengerti dan bersedia, darah saya dilakukan pemeriksaan terhadap Virus
 Hepatitis B, Hepatitis C, HIV, dan Syphilis sesuai dengan');
$pdf->SetXY(4,272);
$pdf->Cell(0, 13, '  metode/reagen screening yang ada di UTD PMI Kabupaten Jember untuk kepentingan saya
 dan penerimaan darah.');
$pdf->SetXY(4,275);
$pdf->Cell(0, 13, '* Saya bersedia diberitahu hasil pemeriksaan darah saya terhadap Virus
 Hepatitis B, Hepatitis C, HIV, dan Syphilis.');
$pdf->SetXY(4,278);
//$pdf->Cell(0, 13, '* Saya telah diberitahu ada beberapa resiko transfusi darah yang berasal dari pendonor darah.');
$pdf->Cell(0, 13, '* Saya telah diberitahu dan mengerti tentang efek samping donor.');
$pdf->SetXY(0,283);
$pdf->Cell(0, 13, 'Jember, '.$sekarang,0,1,'C');

$pdf->SetXY(35,288);
$pdf->Cell(0, 13, 'Tanda Tangan Donor');
$pdf->SetXY(35,315);
$pdf->Cell(0, 13, '( '.$pd[Nama].' )');

$pdf->SetXY(140,288);
$pdf->Cell(0, 13, 'Tanda Tangan Petugas');
$pdf->SetXY(139,315);
$pdf->Cell(0, 13, '( .................................... )');

/**
I : send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
D : send to the browser and force a file download with the name given by name.
F : save to a local server file with the name given by name.
S : return the document as a string (name is ignored).
FI : equivalent to F + I option
FD : equivalent to F + D option
E : return the document as base64 mime multi-part email attachment (RFC 2045)
 */

//$pdf->Output('Form_Donor.pdf', 'I');
$pdf->Output('/var/www/simudda/form-donor/Form_Donor_'.$_GET['kp'].$_GET['nt'].'pdf', 'F');
$hasil_print    = shell_exec('lpr /var/www/simudda/form-donor/Form_Donor_'.$_GET['kp'].$_GET['nt'].'pdf');
echo "<pre>$hasil_print</pre>";

//============================================================+
// END OF FILE
//============================================================+
?>

<META http-equiv="refresh" content="0; url=/touch1">