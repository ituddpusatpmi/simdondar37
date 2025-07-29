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
$pdf->AddPage('L','IDH');
//$pdf->AddPage();

/*define barcode style
$style = array(
	'position' => 'R',
	'border' => false,
	'padding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => false,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4*/
//);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
require_once('config/koneksi.php');
$kantong=mysql_query("select * from stokkantong where noKantong='$_GET[noKantong]'");
if ($kantong) $kantong1=mysql_fetch_assoc($kantong);

$pdf->SetXY(8,0);
$pdf->Cell(0, 12,'PALANG MERAH INDONESIA',0, 1, 'C');

$udd=mysql_fetch_assoc(mysql_query("select nama,alamat from utd where down='1' and aktif='1'"));
$pdf->SetFont('helvetica', 'b', 12);
$pdf->SetFont('helvetica', 'b', 12);
$pdf->SetXY(8,4);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'C');
$pdf->SetFont('helvetica', '', 8);
$pdf->SetXY(8,9);
$pdf->Cell(0, 9,$udd[alamat],0, 1, 'C');

$pdf->SetLineWidth(0.5);
$pdf->Line(0,15,98,15);

/*$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
$pdf->SetFont('helvetica', 'ub', 12);
$pdf->SetXY(0,4);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'C');*/

$pdf->SetXY(4,11);
$pdf->SetFont('helvetica', 10);
$pdf->Cell(0, 13, 'Produk : '.$kantong1[produk], 0);

$pdf->SetXY(4,14);
$pdf->SetFont('helvetica',  10);
$pdf->Cell(0, 14, 'Volume : '.$kantong1[volume], 0);

$pdf->SetXY(4,18);
$pdf->SetFont('helvetica',  10);
$pdf->Cell(0, 14, 'Rhesus : '.$kantong1[RhesusDrh], 0);

$tgl_aftap=$kantong1[tgl_Aftap];
$tgl1=date("d",strtotime($tgl_aftap));
$bln1=date("n",strtotime($tgl_aftap));
$thn1=date("Y",strtotime($tgl_aftap));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];
$jam = date("H:i",strtotime($tgl_aftap));
$pdf->SetXY(4,22);
$pdf->SetFont('helvetica', 10);
$pdf->Cell(0, 14, 'Aftap : '.$tgl1.' ' .$bln11. ' ' .$thn1. '  ' .$jam, 0);

$kadaluwarsa=$kantong1[kadaluwarsa];
$tgl2=date("d",strtotime($kadaluwarsa));
$bln2=date("n",strtotime($kadaluwarsa));
$thn2=date("Y",strtotime($kadaluwarsa));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$bln2];
$jam2 = date("H:i",strtotime($kadaluwarsa));
$pdf->SetXY(4,26);
$pdf->SetFont('helvetica', 10);
$pdf->Cell(0, 14, 'Exp.  : '.$tgl2.' ' .$bln22. ' ' .$thn2.'  '.$jam2, 0);


$pdf->SetXY(50,15);
$pdf->SetFont('helvetica', 'b', 40);
$pdf->Cell(0, 13,$kantong1[gol_darah], 0);

$pdf->SetXY(70,20);
$pdf->SetFont('helvetica', 'b', 20);
$pdf->Cell(0, 13,$kantong1[RhesusDrh], 0);

$pdf->SetXY(3,32); 
$pdf->SetFont('helvetica', 'bu', 12);
$pdf->Cell(0, 13, 'No Kantong', 0,1,'L');
$pdf->SetXY(3,42);
$pdf->write1DBarcode($_GET[noKantong], 'C128A', '', '', '', 9, 0.30, $style, 'N');
$pdf->SetXY(3,48);
$pdf->SetFont('helvetica', 'b', 10);
$pdf->Cell(0, 12, $_GET[noKantong], 0,1,'L');
/*$pdf->SetXY(4,36);
$pdf->write1DBarcode(trim($_GET[noKantong]), 'C128', '', '', '', 15, 0.30, $style, 'N');
/*$pdf->SetXY(25,53);
$pdf->SetFont('helvetica', 'b', 8);
$pdf->Cell(0, 12, $_GET[noKantong], 0,1,'L');*/

$pdf->SetXY(40,32); 
$pdf->SetFont('helvetica','bu', 12);
$pdf->Cell(0, 13, 'Non Reaktif Terhadap:', 0);

$pdf->SetXY(60,37); 
$pdf->SetFont('helvetica','', 10);
$pdf->Cell(0, 13, '1. Anti HIV', 0);
$pdf->SetXY(60,42); 
$pdf->Cell(0, 13, '2. Anti HCV', 0);
$pdf->SetXY(60,47); 
$pdf->Cell(0, 13, '3. HBsAg', 0);
$pdf->SetXY(60,52); 
$pdf->Cell(0, 13, '4. Shypilis', 0);

$pdf->SetXY(3,55);
$pdf->SetFont('helvetica','', 9);
$pdf->Cell(0, 12, 'Simpan pada Suhu', 0);
$pdf->SetXY(33,59);
$pdf->SetFont('helvetica','b', 9);
if ($kantong1[produk]=='TC') {
$pdf->writeHTML('20-24<sup>o</sup>C', true, 0, true, 0);
} else {
$pdf->writeHTML('2-6<sup>o</sup>C', true, 0, true, 0);
}

$pdf->Output('idhasil.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>
