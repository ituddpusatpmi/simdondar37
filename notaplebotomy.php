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
session_start();
$namauser=$_SESSION[namauser];
$nama_lengkap=$_SESSION[nama_lengkap];
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
function rp($a) {
$by1=(string)((int)$a);
$nby1=strlen($by1);
$nspasi=11-$nby1;
$nsp='';
for ($i=0;$i<$nspasi;$i++) {
$nsp .=" ";
}
if ($nby1>3) $byr1="Rp. ".$nsp.substr($by1,0,$nby1-3).".".substr($by1,$nby1-3,3).",00";
if ($nby1>6) $byr1="Rp. ".$nsp.substr($by1,0,$nby1-6).".".substr($by1,$nby1-6,3).".".substr($by1,$nby1-3,3).",00";
return $byr1;
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sudarko');
$pdf->SetTitle('Simbada Kode Kantong');
$pdf->SetSubject('Barcode');
$pdf->SetKeywords('Simbada, PDF, barcode,kantong, pmi, jember');

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
$pdf->SetMargins(2, 2, 2);
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
$pdf->SetFont('courier', '', 12);
// add a page
//$pdf->AddPage('L','IDH');
$pdf->AddPage('P','A4');
//$pdf->AddPage();

// define barcode style
$style = array(
	'position' => 'R',
	'border' => false,
	'padding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'courier',//'courier',
	'fontsize' => 10,
	'stretchtext' => 4
);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
require_once('config/koneksi.php');
/*
	 $idp	= mysql_query("select nomor from kwitansi order by nomer desc limit 1");
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= (int)(substr($idp1[Kode],2,3));
	 $idp3=(int)$idp2+1;
	 $j_nol1= 3-(strlen(strval($idp3)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode=$kd.$idp4.$idp3;

*/
//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$kd='PB';
if ($td1=='B') $kd=$td0;
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= $tgl.$bl.$th."-";
$idp	= mysql_query("select nomer from kwitansi where nomer like '%$kdtp%' order by nomer DESC");
$idp1	= mysql_fetch_assoc($idp);
//$idp2	= (int)(substr($idp1[nomer],9,3));
$idp2	= substr($idp1[nomer],9,3);
if ($idp2<1) {$idp2="000";}
$idp3	= (int)$idp2+1;
$id31	=3-(strlen(strval($idp3)));
//$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$nomerkw=$kd.$kdtp.$idp4.$idp3;
$noform1=$_GET[noform];
$jumlah1=mysql_fetch_assoc(mysql_query("select Jumlah from pembayaran where Tgl=(select max(Tgl) from pembayaran where NoTrans='$_GET[noform]')"));
$jumlah2=mysql_fetch_assoc(mysql_query("select dpem.shift,dpem.kodeBrg,
dper.NoKantong,dper.tempat,dper.no_rm,dper.rs,dper.layanan 
from dpembayaranpermintaan as dpem,
dtransaksipermintaan as dper where dpem.notrans='$_GET[noform]' and dper.NoForm='$_GET[noform]'  order by dper.NoKantong "));
$today=date("Y-m-d");
//------------------------ END set id transaksi ------------------------->
/*
$Y=3;
$X=3;
$bd1=php_uname('n');
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,2);
$td1=substr($td0,0,1); 
$kd='dg';
if ($td1=='B') $kd=$td0; 
//if ($td1!='B') $kd='b1';
$idp	= mysql_query("select * from kwitansi where nomer like '$kd%' order by nomer DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[nomer],1);
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$nomerkw=$kd.'-'.$idp4.$idp3;
*/

//mysql_query("insert into kwitansi (nomer,NoForm,jumlah,Tgl,petugas,shift,tempat,kodebiaya,no_rm,rs,layanan) values ('$nomerkw','$noform1','$jumlah1[Jumlah]','$today','$namauser','$jumlah2[shift]','$jumlah2[tempat]','$jumlah2[kodeBrg]','$jumlah2[no_rm]','$jumlah2[rs]','$jumlah2[layanan]')");

//mysql_query("update dpembayaranpermintaan set rs='$jumlah2[rs]',layanan='$jumlah2[layanan]',kwitansi='$nomerkw',stat='1' where notrans='$noform1' and stat='0'");
//mysql_query("update pembayaran set nokwitansi='$nomerkw' where noform='$GET_[noform]'");
for ($ii=0;$ii<1;$ii++) {
$bayar1 = mysql_fetch_assoc(mysql_query("SELECT\n".
										"	transaksi_plebotomi.*, \n".
										"	pasien_plebotomi.nama, \n".
										"	pasien_plebotomi.alamat, \n".
										"	pasien_plebotomi.lahir, \n".
										"	YEAR(pasien_plebotomi.lahir) as tahun, \n".
										"	biaya.Harga\n".
										"FROM\n".
										"	transaksi_plebotomi\n".
										"	INNER JOIN\n".
										"	pasien_plebotomi\n".
										"	ON \n".
										"		transaksi_plebotomi.kodepasien = pasien_plebotomi.kode,\n".
										"	biaya where transaksi_plebotomi.notransaksi='$_GET[noform]'"));

$usia	= date('Y')- $bayar1['tahun'];
$pdf->Image("logo_pmi.png",4,1.5,15,15);


$udd=mysql_fetch_assoc(mysql_query("select nama,alamat from utd where aktif='1'"));
$bdd=mysql_fetch_assoc(mysql_query("select * from bdrs where kode='$bd1'"));
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(20+$X,$Y);
$pdf->Cell(0, 12,'PALANG MERAH INDONESIA',0, 1, 'L');
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(20+$X,$Y+4);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'L');
$pdf->SetXY(20+$X,$Y+9);
$pdf->Cell(0, 10,$udd[alamat],0, 1, 'L');
$pdf->SetXY(4+$X,$Y+12);
$pdf->Cell(0, 12,'===============================================================================================',0, 1, 'C');
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(4+$X,$Y+16);
$pdf->Cell(0, 12, 'Telah Terima dari                                       KWITANSI PLEBOTOMI ', 0,0,'L');

//$kolf=mysql_num_rows(mysql_query("select NoKantong from dtransaksipermintaan where NoForm='$_GET[noform]' and Status='0'"));
//$kolf1=mysql_num_rows(mysql_query("select NoKantong from dtransaksipermintaan where NoForm='$_GET[noform]' and Status='1'"));
$pdf->SetXY(4+$X,$Y+22);
$pdf->SetFont('courier', '', 12);
if ($_GET[yby]=='') $_GET[yby]=$bayar8[nama];
$pdf->Cell(0, 13, 'No Register         : '.$noform1, 0);

$pdf->SetXY(4+$X,$Y+29);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Nama Pasien         : '.$bayar1[nama].'('.$usia.' Thn)', 0);

$pdf->SetXY(4+$X,$Y+36);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Tanggal Lahir       : '.$bayar1[lahir], 0);

$pdf->SetXY(4+$X,$Y+43);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Alamat Pasien       : '.$bayar1[alamat], 0);


$pdf->SetXY(4+$X,$Y+50);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Nama RS             : '.$bayar1[rumahsakit], 0);

$pdf->SetXY(4+$X,$Y+57);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Bagian              : '.$bayar1[bagian], 0);

$pdf->SetXY(4+$X,$Y+64);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Jenis Layanan       : TERAPI PLEBOTOMI', 0);

$tglbayar=date("Y-m-d");
$tgl1=date("d",strtotime($tglbayar));
$bln1=date("n",strtotime($tglbayar));
$thn1=date("Y",strtotime($tglbayar));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];


$pdf->SetXY(4+$X,$Y+71);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(12, 13, 'Nomor Bag / Vol.    : '.$bayar1[nokantong].' / '.$bayar1[diambil].' ml', 0,0,'L');
//$pdf->Cell(100, 13,                           rp($bayar_sbl['sum(subTotal)']-$bayar2[Jumlah]),0,0,'R');


$pdf->SetXY(4+$X,$Y+75);
$pdf->Cell(126, 13,                              '----------------------------',0, 1, 'R');
$pdf->SetXY(4+$X,$Y+80);
$pdf->SetFont('courier', 'b', 12);
$pdf->Cell(12, 13,     'Total Biaya         : '.rp($bayar1[Harga]), 0,0,'L');
//$pdf->Cell(100, 13,                           ,0,0,'L');
//$pdf->SetXY(4+$X,$Y+80);
//$pdf->Cell(110, 13,                              '___________________________',0, 1, 'R');

//$pdf->SetXY(4+$X,$Y+51);
//$pdf->SetFont('courier', '', 12);
//$pdf->Cell(12, 13, 'Kekurangan :', 0,0,'L');
//$pdf->Cell(45, 13,rp($bayar1[BiayaLD]-$bayar4[TotDibayar]-$bayar4[TotPotongan]),0,0,'R');

$no=0;
$kan=mysql_query("select no_kantong from dpembayaranpermintaan where notrans='$bayar1[noform]' ");
$nkk=0;
while ($kan1=mysql_fetch_assoc($kan)) {
$bayar6=mysql_fetch_assoc(mysql_query("select gol_darah,produk,RhesusDrh from stokkantong where nokantong='$kan1[no_kantong]'"));
$pdf->SetFont('courier', '', 12);
$nk1=$nkk+1;
if ($nkk=='0') {

$pdf->SetXY(105+$X,$Y+19+$no);
$pdf->Cell(0, 13, 'No Kantong : '.$nk1.'. '.$kan1[no_kantong].'   '.$bayar6[gol_darah].'('.$bayar6[RhesusDrh].')'.$bayar6[produk].' **', 0);
}
if ($nkk>'0') {
$pdf->SetXY(138+$X,$Y+20+$no);
$pdf->Cell(0, 13, $nk1.'. '.$kan1[no_kantong].'   '.$bayar6[gol_darah].'('.$bayar6[RhesusDrh].')'.$bayar6[produk].' **', 0);
}
$nkk++;
$no=$no+3;
}
/*
$pdf->SetXY(50,14);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'No Kantong : '.$kan1[NoKantong], 0);
*/
$pdf->SetXY(125+$X,$Y+90);
$pdf->SetFont('courier', '', 10);
$kt=explode(' ',$udd[nama]);
$kota=$kt[3];
//if ($kt[4]!='') $kota=$kota.' '.$kt[4];
$pdf->Cell(0, 13, $kota.', '.$tgl1.' ' .$bln11. ' ' .$thn1, 0,0,'C');

$pdf->SetXY(80+$X,$Y+90);
$pdf->SetFont('courier', '', 10);
$pdf->Cell(0, 13, 'An. Pasien / Keluarga', 0,0,'L');
$pdf->SetXY(80+$X,$Y+98);
$pdf->SetFont('courier', '', 10);
$pdf->Cell(0, 13,'___________________', 0,0,'L');


$pdf->SetXY(125+$X,$Y+93);
$pdf->SetFont('courier', '', 10);
$pdf->Cell(0, 13, 'Petugas Piket', 0,0,'C');
$pdf->SetXY(125+$X,$Y+99);
$pdf->SetFont('courier', '', 10);
$pdf->Cell(0, 13, $namauser, 0,0,'C');



//$pdf->SetXY(4+$X,$Y+77);
//$pdf->SetFont('courier', 'b', 9);
//$pdf->Cell(0, 13, 'Darah yang sudah di proses atau diambil, tidak dapat dikembalikan', 0,0,'L');
$pdf->SetXY(4+$X,$Y+102);
if ($ii<2) $pdf->Cell(0, 13, '===============================================================================================',0, 1, 'C');
$pdf->SetXY(4+$X,$Y+105);
$pdf->SetFont('courier','bu', 10);
$pdf->Cell(0, 13, 'PERHATIAN :', 0,0,'L');

$pdf->SetXY(4+$X,$Y+108);
$pdf->SetFont('courier','', 9);
$pdf->Cell(0, 13, '- Biaya Yang tertera dikwitansi ini BUKAN HARGA DARAH, karena darah tidak untuk diperjual belikan', 0,0,'L');

$pdf->SetXY(4+$X,$Y+112);
$pdf->SetFont('courier','', 9);
$pdf->Cell(0, 13, '- Biaya ini merupakan BIAYA PENGGANTI PENGOLAHAN DARAH (BPPD) yang meliputi Biaya :  ', 0,0,'L');

$pdf->SetXY(8+$X,$Y+116);
$pdf->SetFont('courier','', 9);
$pdf->Cell(0, 13, '1. Kantong Darah                              3. Proses Pengambilan darah donor', 0,0,'L');

$pdf->SetXY(8+$X,$Y+120);
$pdf->SetFont('courier','', 9);
$pdf->Cell(0, 13, '2. Penyimpanan dan perawatan komponen darah   4. Administrasi', 0,0,'L');

$pdf->SetXY(4+$X,$Y+124);
$pdf->SetFont('courier','', 9);
$pdf->Cell(0, 13, '- Darah yang sudah di proses atau diambil, tidak dapat dikembalikan ', 0,0,'L');

$pdf->SetXY(4+$X,$Y+129);
$pdf->SetFont('courier','', 11);
$pdf->Cell(0, 13, '--== TERIMA KASIH ==-- ', 0,0,'C');
$Y=$Y+127;
}
$pdf->Output('nota.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
