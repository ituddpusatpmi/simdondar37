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
$pdf->SetTitle('Pengiriman Surat Konfirmasi Uji Saring');
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
$ckt=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$_POST[nokan]'"));
$srt=mysql_fetch_assoc(mysql_query("select pd.Kode,pd.Nama,pd.GolDarah,pd.Alamat from pendonor as pd,htransaksi as ht where pd.Kode=ht.KodePendonor and ht.NoKantong='$ckt[noKantong]'"));
$nosurat=$_POST[nosurat];
$up=mysql_query("update stokkantong set stokcheck='$nosurat' where noKantong='$ckt[noKantong]'");

$today=date("Y-m-d");
$tgl2=date("d",strtotime($today));
$bln2=date("n",strtotime($today));
$thn2=date("Y",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$bln2];

$udd=mysql_fetch_assoc(mysql_query("select nama,alamat,daerah,hari,jam from utd where down='1' and aktif='1'"));
$pdf->Ln(25);
$pdf->SetX(121);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(0,8,$udd[daerah].' , '.$tgl2.' '.$bln22.'  '.$thn2,0,1,'L');
$pdf->SetX(15);
$pdf->Cell(20,8,'Nomor',0,0,'L');
$pdf->Cell(86,8,': '.$nosurat,0,0,'L');
$pdf->Cell(0,8,'Kepada Yth. ',0,1,'L');
$pdf->SetX(15);
$pdf->Cell(20,8,'Perihal',0,0,'L');
$pdf->SetFont('helvetica','BUI',11);
$pdf->Cell(86,8,':  Konfirmasi Uji Saring Darah Donor',0,0,'L');
$pdf->SetFont('helvetica','',11);
$pdf->Cell(0,8,'Sdr. '.$srt[Nama],0,1,'L');
$pdf->SetX(121);
$pdf->Cell(0,8,$srt[Alamat],0,1,'L');
$pdf->SetX(121);
$pdf->Cell(0,8,'di -',0,1,'L');
$pdf->SetX(123);
$pdf->Cell(0,8,'Tempat',0,1,'L');
$pdf->Ln(10);
$pdf->SetX(15);
$pdf->SetFont('helvetica','',11);
$pdf->Cell(0,8,'Dengan Hormat,',0,1,'L');
$pdf->Ln(2);
$pdf->SetX(25);
$pdf->Cell(0,8,'Dengan ini diberitahukan bahwa, sehubungan dengan Donor Darah yang sudah Saudara laksana -',0,1,'L'); 
$pdf->SetX(15);
$pdf->Cell(0,8,'kan, dari pemeriksaan Laboratorium yang kami lakukan, didapat hasil yang perlu di KONFIRMASI ULANG.',0,1,'L');
$pdf->SetX(15);
$pdf->Cell(0,8,'Maka bersama ini, kami mengharap kehadiran Saudara ke kantor '.$udd[nama],0,1,'L');
$pdf->SetX(15);
$pdf->Cell(0,8,$udd[alamat].' untuk berkonsultasi dengan dokter yang bertugas.',0,1,'L');
$pdf->Ln(3);
$pdf->SetX(25);
$pdf->Cell(0,8,'Adapun waktu konsultasi di '.$udd[nama].' adalah setiap:',0,1,'L'); 
$pdf->SetX(25);
$pdf->Cell(50,8,'  -  hari        :  '.$udd[hari].' ',0,1,'L');
$pdf->SetX(25);
$pdf->Cell(50,8,'  -  Jam       :  '.$udd[jam].'',0,1,'L');
$pdf->Ln(3);
$pdf->SetX(25);
$pdf->Cell(0,8,'Demikian pemberitahuan kami atas kesediaan dan partisipasi Saudara untuk mendonorkan darah,',0,1,'L'); 
$pdf->SetX(15);
$pdf->Cell(0,8,'kami ucapkan terima kasih.',0,1,'L'); 
$pdf->Ln(10);
$pdf->SetX(120);
$pdf->Cell(0,8,$udd[nama],0,1,'C');
$pdf->SetX(120);
$pdf->Cell(0,8,'Direktur,',0,1,'C');
$pdf->Ln(15);
$pdf->SetX(120);
$pdf->SetFont('helvetica','U',11);
$kep=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa where kode='dr01'"));
$pdf->Cell(0,8,$kep[Nama],0,1,'C');

//$nama_file=$_GET[idpendonor].".pdf";
$pdf->Output('kirim_surat.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>
