<?php
//============================================================+
// File name   : example_027.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 027 for TCPDF class
//               1D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 1D Barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('/var/www/simudda/tcpdf2/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Suwena');
$pdf->SetTitle('SIMUDDA');
$pdf->SetSubject('Barcode Bag');
$pdf->SetKeywords('SIMUDDA, PDF, barcode, pmi, udd');
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(-1,5,0);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// set font
$pdf->SetFont('helvetica', '', 10);
// add a page
//$pdf->AddPage();
$resolution= array(100, 20);
$pdf->AddPage('L', $resolution);
$pdf->SetFont('helvetica', '', 10);
// define barcode style
$style = array(
	'position' => 'S',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => false,
	//'hpadding' => 'auto',
	//'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);
$nk=explode(",",$_GET[nk]);$ck=$_GET[ck];$jenis=$_GET[jenis];$prn=$_GET[pr_dialog];
$nokantong=$nk[0];
$jeniskantong=$nk[1];
$judul=$jenis.'_'.$nk[0];
for ($ij=0;$ij<$ck/2;$ij++) {
    $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'A', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'A', $jenis, '', '', 40, 14, '', $style, 'N');
}
switch ($jeniskantong){
    case '2': $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'A', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 40, 14, '', $style, 'N');break;
    case '3': $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 40, 14, '', $style, 'N');break;
    case '4': $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'A', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 40, 14, '', $style, 'N');
              $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 40, 14, '', $style, 'N');break;
    case '5': $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 40, 14, '', $style, 'N');
              $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'E', $jenis, '', '', 40, 14, '', $style, 'N');break;
    case '6': $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'A', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 40, 14, '', $style, 'N');
              $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 40, 14, '', $style, 'N');
              $pdf->SetX(4);$pdf->write1DBarcode($nokantong.'E', $jenis, '', '', 40, 14, '', $style, 'T');$pdf->SetX(55);$pdf->write1DBarcode($nokantong.'F', $jenis, '', '', 40, 14, '', $style, 'N');break;
}
if ($prn=='1'){$pdf->IncludeJS('print(true);');}
$pdf->Output('bkantong.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
