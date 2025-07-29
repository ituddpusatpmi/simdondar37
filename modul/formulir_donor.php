<?php

require_once('../config/koneksi.php');
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

require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sudarko');
$pdf->SetTitle('Formulir Donor Darah');
$pdf->SetSubject('Barcode');
$pdf->SetKeywords('SIMUDDA, PDF, Reaktif, kantong, pmi, udd');

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
$pdf->AddPage('P','A4');
//$pdf->AddPage();

// define barcode style
$style = array(
	'position' => 'C',
	'border' => false,
	'padding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 10
);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);

//shift
$s1='';$s2='';$s3='';
$waktu=date('H:i:s');
$jam1=mysql_fetch_assoc(mysql_query("select * from shift where nama='I'"));
$jam2=mysql_fetch_assoc(mysql_query("select * from shift where nama='II'"));	
$jam3=mysql_fetch_assoc(mysql_query("select * from shift where nama='III'"));
						
$sh1=$jam1[jam]; $sh2=$jam2[jam]; $sh3=$jam3[jam];
if ($waktu >= $sh1 ){ $shift='1';}
if ($waktu >= $sh2 ){ $shift='2';}
if ($waktu >= $sh3 ){ $shift='3';}
if ($waktu < $sh1 ){  $shift='3';}
//--shift
				
					
$ckt=mysql_fetch_assoc(mysql_query("select Kode,Kode_lama,Nama,Alamat,kelurahan,kecamatan,wilayah,telp2,TglLhr,umur,TempatLhr,GolDarah,Rhesus,jk,pekerjaan,jumDonor,tglkembali,Status,p10,p25,p50,p75,p100 from pendonor where (Kode='$_POST[nokan]' or Kode_lama='$_POST[nokan]') and cekal='0'"));
$srt=mysql_fetch_assoc(mysql_query("select pd.Kode,pd.Nama,pd.GolDarah,pd.Alamat from pendonor as pd,htransaksi as ht where pd.Kode=ht.KodePendonor and ht.NoKantong='$ckt[noKantong]'"));

//------transaksi Donor----
$today1=date("Y-m-d H:i:s");
$kota=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));
$tambah=mysql_query("insert into htransaksi 
			(NoTrans,KodePendonor,KodePendonor_lama,Pengambilan,tempat,Tgl,Instansi,kendaraan,
			JenisDonor,id_permintaan,Status,Nopol,apheresis,umur,shift,kota,ketBatal) 
	value ('$_POST[notrans]','$ckt[Kode]','$ckt[Kode_lama]','-','0','$today1','$_POST[instansi]','$_POST[kendaraan]',
		'0','-','0','-','0','$ckt[umur]','$shift','$kota[id]','9')");


$idp=mysql_query("select * from tempat_donor where active='1'");
		$idp1=mysql_fetch_assoc($idp);
		if (substr($idp1[id1],0,1)=="M") { mysql_query("update htransaksi set mu='1' where NoTrans='$_POST[notrans]'");
							mysql_query("update htransaksi set tempat='M' where NoTrans='$_POST[notrans]'");}



//......END transaksi donor.........



$today=date("Y-m-d");
$tgl2=date("d",strtotime($today));
$bln2=date("n",strtotime($today));
$thn2=date("Y",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$bln2];

$udd=mysql_fetch_assoc(mysql_query("select nama,alamat,daerah from utd where down='1' and aktif='1'"));
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(2+$X,$Y);
$pdf->Cell(0, 12,'FORMULIR DONOR DARAH',0, 1, 'C');
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(2+$X,$Y+4);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'C');
$pdf->SetXY(2+$X,$Y+9);
$pdf->Cell(0, 10,$udd[alamat],0, 1, 'C');
$pdf->SetXY(2+$X,$Y+11);
$pdf->Cell(0, 12,'==========================================================================================================',0, 1, 'L');


$pdf->SetXY(10+$X,$Y+15);
$pdf->SetFont('courier', 'BU', 12);
$pdf->Cell(0, 13, 'DIISI OLEH PENDONOR', 0,1,'C');

$pdf->SetXY(2+$X,$Y+19);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Kode Pendonor    : '.$ckt[Kode], 0);

$pdf->SetXY(115+$X,$Y+19);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Penghargaan Donor Yg sudah diterima :', 0);

$pdf->SetXY(2+$X,$Y+23);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Nama Pendonor    : '.$ckt[Nama], 0);

$pdf->SetXY(120+$X,$Y+23);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, '1.10x  2.25x  3.50x  4.75x  5.100x', 0);

$pdf->SetXY(2+$X,$Y+27);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'TTL              : '.$ckt[TempatLhr].','.$ckt[TglLhr], 0);

$pdf->SetXY(115+$X,$Y+27);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Bersediakah anda donor dibulan puasa?', 0);

$pdf->SetXY(115+$X,$Y+35);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Bersediakah Anda Ditelphone saat per-', 0);

$pdf->SetXY(115+$X,$Y+39);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'sediaan stok darah kosong?', 0);

$pdf->SetXY(2+$X,$Y+31);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Gol&Rh Darah     : '.$ckt[GolDarah].'('.$ckt[Rhesus].')', 0);

$pdf->SetXY(120+$X,$Y+31);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, '1.Bersedia  2. Tidak bersedia', 0);

$pdf->SetXY(120+$X,$Y+43);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, '1.Bersedia  2. Tidak bersedia', 0);

$pdf->SetXY(2+$X,$Y+35);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Alamat           : '.$ckt[Alamat], 0);

$pdf->SetXY(2+$X,$Y+39);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'kelurahan        : '.$ckt[kelurahan],0);

$pdf->SetXY(2+$X,$Y+43);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Kecamatan        : '.$ckt[kecamatan], 0);

$pdf->SetXY(2+$X,$Y+47);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Wilayah          : '.$ckt[wilayah], 0);

$pdf->SetXY(2+$X,$Y+51);
$pdf->SetFont('courier', '', 11);
$jk='Laki-Laki';
if( $ckt[jk]=='1') $jk='Perempuan';
$pdf->Cell(0, 13, 'Jenis Kelamin    : '.$jk, 0);

$pdf->SetXY(2+$X,$Y+55);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Nomor HP         : '.$ckt[telp2].'*', 0);

$pdf->SetXY(2+$X,$Y+59);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Pekerjaan        : '.$ckt[pekerjaan].'*', 0);

$pdf->SetXY(2+$X,$Y+63);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Jumlah Donor     : '.$ckt[jumDonor].'*  Kali', 0);

$pdf->SetXY(2+$X,$Y+67);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Tgl Kembali Donor: '.$ckt[tglkembali], 0);

$pdf->SetXY(2+$X,$Y+71);
$pdf->SetFont('courier', '', 11);
$status='Belum Menikah';
if($ckt[Status]=='1') $status='Menikah';
$pdf->Cell(0, 13, 'Status pernikahan: '.$status, 0);

$pdf->SetXY(2+$X,$Y+76);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Mohon dijawab dengan sejujurnya, untuk keselamatan anda dan calon penerima darah anda ',0);

$pdf->SetXY(2+$X,$Y+80);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'dengan melingkari jawaban yang benar dan sesuai kondisi anda, APAKAH ANDA : ',0);

$pdf->SetXY(2+$X,$Y+85);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1. Sehat saat ini',0);

$pdf->SetXY(148+$X,$Y+85);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+89);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'2. Tiga bulan terakhir mendapatkan Pengobatan/Sakit/Operasi',0);

$pdf->SetXY(148+$X,$Y+89);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+93);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'3. Pernah ada riwayat/keluhan penyakit :',0);

$pdf->SetXY(9+$X,$Y+96);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'- Ginjal, Jantung, Kencing manis, TBC, Ashma, Alergi',0);
$pdf->SetXY(148+$X,$Y+96);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(9+$X,$Y+99);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'- Radang akut/maag akut/kronis, Gangguan darah/ Hemofilia',0);
$pdf->SetXY(148+$X,$Y+99);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(9+$X,$Y+102);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'- Kanker/Tumor, Penyakit kronis lain',0);
$pdf->SetXY(148+$X,$Y+102);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+106);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'4. Sering pingsan/kejang-kejang',0);
$pdf->SetXY(148+$X,$Y+106);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+110);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'5. Pernah kontak dengan penderita AIDS',0);
$pdf->SetXY(148+$X,$Y+110);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+114);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'6. Ada kemungkinan gejala Hepatitis B/C,Shypilis,malaria',0);
$pdf->SetXY(148+$X,$Y+114);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+118);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'7. Pernah pergi kedaerah endemi malaria',0);
$pdf->SetXY(148+$X,$Y+118);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+122);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'8. Sedang minum obat yang mengandung aspirin atau antibiotik',0);
$pdf->SetXY(9+$X,$Y+125);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'dalam 3 hari terakhir',0);
$pdf->SetXY(148+$X,$Y+125);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+129);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'9. Mendapatkan imunisasi 2-4 minggu terakhir',0);
$pdf->SetXY(148+$X,$Y+129);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);


$pdf->SetXY(2+$X,$Y+133);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'10. Mendapat transfusi darah dalam 6 bulan terakhir',0);
$pdf->SetXY(148+$X,$Y+133);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu',0);

$pdf->SetXY(2+$X,$Y+137);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'11. Pernah digigit binatang yg menderita rabies 1 th terakhir',0);
$pdf->SetXY(148+$X,$Y+137);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+141);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'12. Pernah mendonorkan darah kurang dari 3 bulan terakhir',0);
$pdf->SetXY(148+$X,$Y+141);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+145);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'13. Tidur malam minimal 5-6 Jam',0);
$pdf->SetXY(148+$X,$Y+145);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+149);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'14. Pernah mengkonsumsi narkoba atau pecandu alkohol',0);
$pdf->SetXY(148+$X,$Y+149);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+153);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'15. Pernah berperilaku Sex Bebas',0);
$pdf->SetXY(148+$X,$Y+153);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(2+$X,$Y+157);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'16. Bagi wanita, tiak sedang Haid/hamil/menyusui',0);
$pdf->SetXY(148+$X,$Y+157);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'1.Ya 2.Tidak 3.Tidaktahu ',0);

$pdf->SetXY(10+$X,$Y+162);
$pdf->SetFont('courier', 'BU', 12);
$pdf->Cell(0, 13, 'DIISI OLEH PETUGAS HB', 0);

$pdf->SetXY(120+$X,$Y+162);
$pdf->SetFont('courier', 'BU', 12);
$pdf->Cell(0, 13, 'DIISI OLEH DOKTER / PARAMEDIS', 0,1,'C');
$pdf->SetXY(120+$X,$Y+166);
$pdf->SetFont('courier', 'BU', 12);
$pdf->Cell(0, 13, 'YANG DIBERI WEWENANG', 0,1,'C');

$pdf->SetXY(2+$X,$Y+171);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Nama Petugas HB',0);
$pdf->SetXY(40+$X,$Y+171);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,': ...................... ',0);

$pdf->SetXY(105+$X,$Y+171);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Nama Dokter/Paramedis : ...................',0);

$pdf->SetXY(2+$X,$Y+175);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Jenis Donor',0);
$pdf->SetXY(40+$X,$Y+175);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,': a. Sukarela ',0);

$pdf->SetXY(105+$X,$Y+175);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Tensi:       Suhu:      Nadi:     ',0);

$pdf->SetXY(40+$X,$Y+179);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'  b. Pengganti ',0);

$pdf->SetXY(105+$X,$Y+179);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Riwayat Medis      : .....................',0);

$pdf->SetXY(40+$X,$Y+183);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'  c. Autologus ',0);
$pdf->SetXY(105+$X,$Y+183);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Kesimpulan         : a. Diambil   b. Ditolak',0);

$pdf->SetXY(2+$X,$Y+187);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'CuSO4 : a.Tenggelam b.Mengapung c.Melayang',0);
$pdf->SetXY(105+$X,$Y+187);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Jenis Kantong : 1.Single 2.Double 3.Triple ',0);

$pdf->SetXY(2+$X,$Y+191);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'HB    : ________gr/dl  HCT : _______%',0);
$pdf->SetXY(105+$X,$Y+191);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'                4.Quadruple 5.Pediatrik ',0);

$pdf->SetXY(2+$X,$Y+195);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Berat badan     : _______ kg',0);
$pdf->SetXY(105+$X,$Y+195);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Jumlah Pengambilan : _________ CC ',0);

$pdf->SetXY(2+$X,$Y+199);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Gol Darah       : A  B  AB  O   Rh : +  -',0);

$pdf->SetXY(10+$X,$Y+204);
$pdf->SetFont('courier', 'BU', 12);
$pdf->Cell(0, 13, 'DIISI OLEH PETUGAS AFTAP', 0);


$pdf->SetXY(2+$X,$Y+209);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Nama Petugas AFTAP : ........................',0);
$pdf->SetXY(50+$X,$Y+209);
$pdf->SetFont('courier', 'B', 12);
$pdf->Cell(0, 13, 'NO KANTONG : ', 0,1,'C');

$pdf->SetXY(2+$X,$Y+213);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Pengambilan        : a. Lancar  b. Tidak lancar  c. Stop pada ________ CC',0);

$pdf->SetXY(2+$X,$Y+217);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Reaksi Pendonor    : a. Pusing  b. Pingsan  c. Hematom  d. Lainnya ________________',0);

$pdf->SetXY(2+$X,$Y+225);
$pdf->SetFont('courier', 'Bu', 11);
$pdf->Cell(0, 13,'PERNYATAAN PENDONOR' ,0);

$pdf->SetXY(2+$X,$Y+229);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Yth. Petugas '.$udd[nama] ,0);

$pdf->SetXY(2+$X,$Y+233);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Saya telah membaca dan memahami segenap informasi yang telah diberikan dan menjawab',0);

$pdf->SetXY(2+$X,$Y+237);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'pertanyaan-pertanyaannya dengan sebenar-benarnya, Saya mengerti dan bersedia menyu-',0);

$pdf->SetXY(2+$X,$Y+241);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'mbangkan darah sebanyak 350cc atau lebih, dan setuju diambil contoh darah untuk ke-',0);

$pdf->SetXY(2+$X,$Y+245);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'pentingan laboratorium atau riset, dan saya setuju contoh darah saya diperiksa dari',0);

$pdf->SetXY(2+$X,$Y+249);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Anti HBsAg, Anti HCV, Anti Shypilis, dan HIV.',0);

$pdf->SetXY(2+$X,$Y+253);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'Apabila ternyata hasil pemeriksaan lab meragukan, saya bersedia untuk di konfirmasi',0);

$pdf->SetXY(2+$X,$Y+257);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13,'dan darah saya tidak ditransfusikan kepada pasien.',0);


$pdf->SetXY(2+$X,$Y+265);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0,8,$udd[daerah].' , '.$tgl2.' '.$bln22.' '.$thn2,0,1,'C');

$pdf->SetXY(2+$X,$Y+270);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0,8,'Yang Menyatakan,',0,1,'C');

$pdf->SetXY(2+$X,$Y+287);
$pdf->SetFont('helvetica','BU',11);
$pdf->Cell(0,8,$ckt[Nama],0,1,'C');

//$nama_file=$_GET[idpendonor].".pdf";
$pdf->Output('kirim_surat.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>
