<?php
require_once('config/koneksi.php');
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
require_once('tcpdf2/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Suwena');
$pdf->SetTitle('SIMUDDA');
$pdf->SetSubject('Barcode Bag');
$pdf->SetKeywords('SIMUDDA, PDF, barcode, pmi, udd');
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(-1,5,0);   //$pdf->SetMargins(-1,2,0);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l); }
$resolution= array(100, 20);
$pdf->AddPage('L', $resolution);
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
    // Setting Text pada bagian bawah barcodes //
    'text' => false,
    'font' => 'helvetica',
    'fontsize' => 12,
    'stretchtext' => 1
);
$nk=explode(",",$_GET['nk']);
$ck=explode(",",$_GET['ck']);
$merk=$_GET['merk'];
$jenis=$_GET['jenis'];
$prn=$_GET['pr_dialog'];
$nokantong=$nk[0];
$jeniskantong=$nk[1];
$judul=$jenis.'_'.$nk[0];
$jumcetak=$ck[0];   $jumcetak2=$ck[1];  $jumcetak3=$ck[2];
$jumcetak4=$ck[3];  $jumcetak5=$ck[4];  $jumcetak6=$ck[5];
/** Tidak Digunakan
$mtd=$_GET['metoda'];
switch ($mtd){
    case 'TT':$metoda="Top&Top";break;
    case 'TB':$metoda="Top&Bottom";break;
    case 'FT':$metoda="Filter";break;
    case '0':$metoda="";break;
}
*/
for ($ij=0;$ij<$jumcetak/2;$ij++) {
    $ijk=$ij+1;
    $sql=mysql_fetch_assoc(mysql_query("SELECT nama, length(nama) as pjnama FROM utd WHERE aktif='1'"));

    /** ATUR POSISI (X KIRI), (X KANAN) DAN (UKURAN FONT) DARI NAMA UTD TERLEBIH DAHULU */
    $utdkiri=4.1; $utdkanan=57.1; $fontsize=7.5;

    $jn='Single'; $jnkiri="37"; $jnkanan="89";                          // Label Kiri X=32 - Label Kanan X=85
    if ($nk[1]=='2'){ $jn='Double'; $jnkiri="35"; $jnkanan="88";}         // Label Kiri X=31 - Label Kanan X=84
    if ($nk[1]=='3'){ $jn='Triple'; $jnkiri="37"; $jnkanan="90";}         // Label Kiri X=32 - Label Kanan X=85
    if ($nk[1]=='4'){ $jn='Quadruple'; $jnkiri="32"; $jnkanan="85";}      // Label Kiri X=27 - Label Kanan X=81
//    if ($nk[1]=='4' && $metoda!=0){
//        $jn='Quadruple'.'-'.$metoda; $jnkiri="27"; $jnkanan="80";
//    }else{
//        $jn='Quadruple'; $jnkiri="27"; $jnkanan="80";}      // Label Kiri X=27 - Label Kanan X=81
    if ($nk[1]=='6'){ $jn='Pediatrik'; $jnkiri="33"; $jnkanan="86";}      // Label Kiri X=29 - Label Kanan X=82

    /** Font Size for Bag Numbers (Not Include Initials A,B,C etc..) */
    if(strlen($nokantong)<=8){$bagsize=9;
    }elseif(strlen($nokantong)>8 && strlen($nokantong)<=12){$bagsize=7.5;
    }else{$bagsize=6.5;}

    /*Ed lama buka kantong*/
	$today=DATE('Y-m-d');                          
    	$master = mysql_fetch_assoc(mysql_query("SELECT lama_buka from master_kantong where merk='$merk' AND jenis='$jeniskantong'"));
	$ed=DATE('d-m-Y', strtotime( '+'.$master['lama_buka'].' days', strtotime($today)));	


	$pdf->SetXY(5,$ij * 20 + 6);
    /*    $this->write1DBarcode($code, $type, $x, $y, $w, $h, $xres, $newstyle, ''); */
    $pdf->write1DBarcode($nokantong.'A', $jenis, '', '', 39, 7, '', $style, 'T');
    $pdf->SetX(58);
    $pdf->write1DBarcode($nokantong.'A', $jenis, '', '', 39, 7, '', $style, 'N');

    $pdf->SetFont('helvetica', '', $fontsize);
    $pdf->SetXY($utdkiri,2);
//    $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L'); 
    $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
    $pdf->SetX($utdkanan);
//    $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
    $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

    $pdf->SetFont('helvetica', '', 7);
    $pdf->SetXY($jnkiri,13);
    $pdf->Cell(0, 0,$jn,0, 0,'L');
    $pdf->SetX($jnkanan);
    $pdf->Cell(0, 0,$jn,0, 0,'L');

    $pdf->SetFont('helvetica', '', $bagsize);
    $pdf->SetXY(4,12.5);
    $pdf->Cell(0, 0,$nokantong.'A',0, 0,'L');
    $pdf->SetX(57);
    $pdf->Cell(0, 0,$nokantong.'A',0, 0,'L');
	
    $pdf->SetFont('helvetica', '', 7);
    $pdf->SetXY(4,16);
    $pdf->Cell(0, 0,'Gunakan Sebelum : '.$ed,0, 0,'L');
    $pdf->SetX(57);
    $pdf->Cell(0, 0,'Gunakan Sebelum : '.$ed,0, 0,'L');


}
switch ($jeniskantong){
    case '2':
        for ($ij=0;$ij<$jumcetak2/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak * 20 + 6);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
        }
        break;
    case '3':
        for ($ij=0;$ij<$jumcetak2/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak * 20 + 6);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak3/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
        }
        break;
    case '4':
        for ($ij=0;$ij<$jumcetak2/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak * 20 + 6);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak3/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak4/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 + $jumcetak3 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'D',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'D',0, 0,'L');
        }
        break;
    case '5':
        for ($ij=0;$ij<$jumcetak2/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak * 20 + 6);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak3/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak4/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 + $jumcetak3 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'D',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'D',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak5/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 + $jumcetak3 + $jumcetak4 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'E', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'E', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'E',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'E',0, 0,'L');
        }
        break;
    case '6':
        for ($ij=0;$ij<$jumcetak2/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak * 20 + 6);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'B', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'B',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak3/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'C', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'C',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak4/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 + $jumcetak3 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'D', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'D',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'D',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak5/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 + $jumcetak3 + $jumcetak4 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'E', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'E', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'E',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'E',0, 0,'L');
        }
        for ($ij=0;$ij<$jumcetak6/2;$ij++) {

            $pdf->SetXY(5,$ij + $jumcetak + $jumcetak2 + $jumcetak3 + $jumcetak4 + $jumcetak5 * 20 + 6);
            $pdf->write1DBarcode($nokantong.'F', $jenis, '', '', 39, 7, '', $style, 'T');
            $pdf->SetX(58);
            $pdf->write1DBarcode($nokantong.'F', $jenis, '', '', 39, 7, '', $style, 'N');

            $pdf->SetFont('helvetica', '', $fontsize);
            $pdf->SetXY($utdkiri,2);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');
            $pdf->SetX($utdkanan);
            $pdf->Cell(0, 0,''.strtoupper($sql['nama']),0, 0,'L');

            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetXY($jnkiri,13);
            $pdf->Cell(0, 0,$jn,0, 0,'L');
            $pdf->SetX($jnkanan);
            $pdf->Cell(0, 0,$jn,0, 0,'L');

            $pdf->SetFont('helvetica', '', $bagsize);
            $pdf->SetXY(4,13);
            $pdf->Cell(0, 0,$nokantong.'F',0, 0,'L');
            $pdf->SetX(57);
            $pdf->Cell(0, 0,$nokantong.'F',0, 0,'L');
        }
        break;
}
if ($prn=='1'){$pdf->IncludeJS('print(true);');}
$pdf->Output('cetak_kantong.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
