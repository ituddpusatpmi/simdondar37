<?php
require_once('config/koneksi.php');
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

//require_once('23april2011/simudda/tcpdf/config/lang/eng.php');
//require_once('23april2011/simudda/tcpdf/tcpdf.php');
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
$pdf->SetMargins(0, 1, 0);
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
//$pdf->AddPage('L','BK');
$resolution= array(100, 20);
 $pdf->AddPage('L', $resolution);
//$pdf->AddPage();

// define barcode style
$style = array(
	'position' => 'S',
	'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
	'border' => false,
	'padding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);
// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
//$nk0=str_replace("undefined","",$_GET[nk]);
//$jn=explode(",",$_GET['jenis_kantong']);
$nk=explode(",",$_GET['nk']);
$ck=$_GET['ck'];
//echo "NK $nk[0] JK $nk[1]";

for ($i=0; $i<$nk[1]; $i++) {
if ($i==0) $nk1=$nk[0];
if ($i==1) $nk1=$nk[0];
if ($i==2) $nk1=$nk[0];
if ($i==3) $nk1=$nk[0];
if ($i==4) $nk1=$nk[0];
if ($i==5) $nk1=$nk[0];
if(substr($nk1,-1)=="A") {
for ($ij=0;$ij<$ck/2;$ij++) {
$sql=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(3);
$pdf->Cell(0, 0,''.$sql[nama],0, 0,'L');
$jn='S';
if ($nk[1]=='2') $jn='D';
if ($nk[1]=='3') $jn='T';
if ($nk[1]=='4') $jn='Q';
if ($nk[1]=='6') $jn='P';
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(41);
$pdf->Cell(0, 0,'J-'.$jn,0, 0,'L');
$pdf->SetX(2);
$pdf->write1DBarcode($nk1, 'C128', '', '', 44, 19, '', $style, 'T');
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(52);
$pdf->Cell(0, 0,''.$sql[nama],0, 0,'L');
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(93);
$pdf->Cell(0, 0,'J-'.$jn,0, 0,'L');
$pdf->SetX(52);
$pdf->write1DBarcode($nk1, 'C128', '', '', 44, 19, '', $style, 'N');
}
} else {
$sql=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(2);
$pdf->Cell(0, 0,''.$sql[nama],0, 0,'L');
$jn='S';
if ($nk[1]=='2') $jn='D';
if ($nk[1]=='3') $jn='T';
if ($nk[1]=='4') $jn='Q';
if ($nk[1]=='6') $jn='P';
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(43);
$pdf->Cell(0, 0,'J-'.$jn,0, 0,'L');
$pdf->SetX(2);
$pdf->write1DBarcode($nk1, 'C39', '', '', 44, 19, '', $style, 'T');
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(54);
$pdf->Cell(0, 0,''.$sql[nama],0, 0,'L');
$pdf->SetFont('helvetica', '', 7);
$pdf->SetX(93);
$pdf->Cell(0, 0,'J-'.$jn,0, 0,'L');
$pdf->SetX(52);
$pdf->write1DBarcode($nk1, 'C39', '', '', 44, 19, '', $style, 'N');
}
}
//Close and output PDF document
$pdf->Output('bkantong.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>
