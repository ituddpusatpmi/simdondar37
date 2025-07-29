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
$pdf->SetMargins(false);
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

// set font
$pdf->SetFont('helvetica', '', 10);

require_once('config/koneksi.php');

//-------------------- add a page ------------------------
$hasil=mysql_query("select * from stokkantong where NoKantong='$_GET[noKantong]'");
while($hasil1=mysql_fetch_assoc($hasil)){
$kantong1=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$hasil1[NoKantong]'"));
$pdf->AddPage('P','IDH');
$pdf->SetFillColor(255,255,255);
//if ($kantong1[gol_darah]=='A') $pdf->SetFillColor(255,255,255);
//if ($kantong1[gol_darah]=='B') $pdf->SetFillColor(0,127,127);
//if ($kantong1[gol_darah]=='AB') $pdf->SetFillColor(255,255,0);
//if ($kantong1[gol_darah]=='O') $pdf->SetFillColor(211,113,201);

//$pdf->Rect(0, 0, 90, 85, 'DF');
//$pdf->SetAlpha(1.0);
//$pdf->SetXY(2,1);
//$pdf->SetFont('helvetica', 'b', 36);
//$pdf->Cell(0, 12,$kantong1[gol_darah].''.$kantong1[RhesusDrh], 0);

//$pdf->SetXY(12,6);
//$pdf->SetFont('helvetica', 'b', 20);
//$pdf->Cell(0, 12,$kantong1[RhesusDrh], 0);
$lab=mysql_query("select * from htranspermintaan where NoForm='$_GET[noform]'");
if ($lab) $lab1=mysql_fetch_assoc($lab);
$udd=mysql_fetch_assoc(mysql_query("select nama,alamat from utd where down='1' and aktif='1'"));
$pdf->SetFont('helvetica', '',11);
$pdf->SetXY(0,0);
$pdf->Cell(0, 12,'PALANG MERAH INDONESIA',0, 1, 'C');
$pdf->SetFont('helvetica', 'b', 10);
$pdf->SetXY(0,4);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'C');
$pdf->SetFont('helvetica', '', 7);
$pdf->SetXY(0,7);
$pdf->Cell(0, 12,$udd[alamat],0, 1, 'C');

$pdf->SetLineWidth(0.4);
$pdf->Line(0,14.5,110,14.5);

//$pdf->SetXY(0,11);
//$pdf->SetFont('helvetica', 'bu', 9);
//$pdf->Cell(0, 12, 'DATA KANTONG', 0,1,'C');

$pdf->SetXY(4,13);
$pdf->SetFont('helvetica', 'bu', 9);
$pdf->Cell(0, 12, 'No Kantong', 0,1,'L');
$pdf->SetXY(25,15.5);
$pdf->write1DBarcode($hasil1[noKantong], 'C39', '', '', '', 8, 0.28, $style, 'N');
$pdf->SetXY(4,20);
$pdf->SetFont('helvetica', 'b', 12);
$pdf->Cell(0, 10, $hasil1[noKantong], 0,1,'L');

$pdf->SetXY(19,35);
$pdf->SetFont('helvetica', 'b', 40);
$pdf->Cell(0, 12,$hasil1[gol_darah].''.$hasil1[RhesusDrh], 0);

$pdf->SetXY(4,24);
$pdf->SetFont('helvetica', 'b', 12);
$pdf->Cell(0, 12, 'Produk: ', 0);

$pdf->SetXY(21,24);
$pdf->SetFont('helvetica', 'b', 22);
$pdf->Cell(0, 12,$hasil1[produk], 0);

$pdf->SetXY(4,30);
$pdf->SetFont('helvetica', 'b', 12);
$pdf->Cell(0, 12, 'Isi :', 0);

$pdf->SetXY(13,30);
$pdf->SetFont('helvetica', 'b', 14);
$pdf->Cell(0, 12, $hasil1[volume].' cc', 0);

$pdf->SetXY(4,36);
$pdf->SetFont('helvetica', 'b', 12);
$pdf->Cell(0, 12, 'Gol,Rh:', 0);

$pdf->SetXY(54,19);
$pdf->SetFont('helvetica','bu', 9);
$pdf->Cell(0, 12, 'Non Reaktif Terhadap:', 0,1);

$pdf->SetXY(55,22);
$pdf->SetFont('helvetica','', 9);
$pdf->Cell(0, 12, '1. Anti HIV', 0);
$pdf->SetXY(55,26);
$pdf->Cell(0, 12, '2. Anti HCV', 0);
$pdf->SetXY(74,22);
$pdf->Cell(0, 12, '3. HBsAg', 0);
$pdf->SetXY(74,26);
$pdf->Cell(0, 12, '4. Shypilis', 0);

$tgl_aftap=$hasil1[tgl_Aftap];
$tgl1=date("d",strtotime($tgl_aftap));
$bln1=date("n",strtotime($tgl_aftap));
$thn1=date("Y",strtotime($tgl_aftap));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];
$jam = date("H:i",strtotime($tgl_aftap));

$pdf->SetXY(46,30);
$pdf->SetFont('helvetica', 'b', 9);
$pdf->Cell(0, 12, 'Aftap  : '.$tgl1.' ' .$bln11. ' ' .$thn1. ' ' .$jam, 0);

$tgl_olah=$hasil1[tglpengolahan];
$tgl3=date("d",strtotime($tgl_olah));
$bln3=date("n",strtotime($tgl_olah));
$thn3=date("Y",strtotime($tgl_olah));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln33=$bulan[$bln3];
$jam3 = date("H:i",strtotime($tgl_olah));

$pdf->SetXY(46,34);
$pdf->SetFont('helvetica', 'b', 9);
$pdf->Cell(0, 12, 'Diolah : '.$tgl3.' ' .$bln33. ' ' .$thn3. ' ' .$jam3, 0);

$kadaluwarsa=$hasil1[kadaluwarsa];
$tgl2=date("d",strtotime($kadaluwarsa));
$bln2=date("n",strtotime($kadaluwarsa));
$thn2=date("Y",strtotime($kadaluwarsa));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$bln2];
$jam2 = date("H:i",strtotime($kadaluwarsa));
$pdf->SetXY(47,38);
$pdf->SetFont('helvetica', 'b', 9);
$pdf->Cell(0, 12, '   Exp  : '.$tgl2.' ' .$bln22. ' ' .$thn2. ' ' .$jam2, 0);

$pdf->SetXY(52,42);
$pdf->SetFont('helvetica','', 9);
$pdf->Cell(0, 12, 'Simpan pada Suhu', 0);
$pdf->SetXY(80,46);
$pdf->SetFont('helvetica','b', 9);
if ($hasil1[produk]=='TC') {
   $pdf->writeHTML(': 20-24<sup>o</sup>C', true, 0, true, 0);
} elseif ($hasil1[produk]=='FFP'){
   $pdf->writeHTML(': -20<sup>o</sup>C', true, 0, true, 0);
} else {
   $pdf->writeHTML(': 2-6<sup>o</sup>C', true, 0, true, 0);
}
$pdf->SetLineWidth(0.5);
$pdf->Line(0,50,110,50);

$pdf->SetXY(0,45); 
$pdf->SetFont('helvetica','bU', 9);
$pdf->Cell(0, 14,'DATA PASIEN', 0,1,'C');
/*
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
$bulan = $array_bulan[date('n')];
$tanggal = date ('j');
$tahun = date('Y');
$jam = date('H:i');

$tgl_cross=$hasil1[tgl];
$tglc=date("d",strtotime($tgl_cross));
$blnc=date("n",strtotime($tgl_cross));
$thnc=date("Y",strtotime($tgl_cross));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnc1=$bulan[$blnc];
$jamc = date("H:i",strtotime($tgl_cross));

$pdf->SetXY(4,40.5); 
$pdf->SetFont('helvetica','b', 10);
$pdf->Cell(0, 12,'NO FORM : '.$hasil1[NoForm], 0);

$tgl_form=$lab1[tgl_register];
$tglf=date("d",strtotime($tgl_form));
$blnf=date("n",strtotime($tgl_form));
$thnf=date("Y",strtotime($tgl_form));
$bulanf=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnf1=$bulanf[$blnf];
$jamf = date("H:i",strtotime($tgl_form));

$pdf->SetXY(40,40.5); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 12,'terima :                              Jam : ', 0);
*/
//$lab=mysql_query("select * from htranspermintaan where noform='$_GET[noform]'");
  //  if ($lab) $lab1=mysql_fetch_assoc($lab);
   // $norm= $lab1[no_rm];
  //  $pasien=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$norm'"));
    $pdf->SetXY(4,50);
    $pdf->SetFont('helvetica', 'b', 9);
    	$pdf->Cell(0, 12,'Nama :', 0);

//$pdf->SetXY(4,44);
//$pdf->SetFont('helvetica', 'b', 9);
//$pdf->Cell(0, 12,'Nama :'.$lab1[NamaOS], 0);

//$jk='Laki-laki';
//if($pasien[kelamin]=='P')$jk="Perempuan";

$pdf->SetXY(4,54);
$pdf->SetFont('helvetica', 'b', 9);
	$pdf->Cell(0, 12,'JK   :', 0);

$pdf->SetXY(4,58);
$pdf->SetFont('helvetica', 'b', 9);
	$pdf->Cell(0, 12,'Umur :        th', 0);

//$darah=mysql_query("select * from dtranspermintaan where NoForm='$_GET[noform]'");
//if ($darah) $darah1=mysql_fetch_assoc($darah);
$pdf->SetXY(4,62); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 12, 'Gol Darah :                Rh :', 0);

$pdf->SetXY(4,66); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 12, 'Diagnosa : ', 0);

//$nam=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$lab1[rs]'"));
$pdf->SetXY(55,50); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 12,'RS       : ', 0);

$pdf->SetXY(55,54); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 13, 'No. RM  : ', 0);

$pdf->SetXY(55,58); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 13, 'Bagian  : ', 0);

$pdf->SetXY(55,62); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 12,'Kelas    :', 0);

$pdf->SetXY(55,66); 
$pdf->SetFont('helvetica','b', 9);
$pdf->Cell(0, 12,'Layanan : ', 0);

$pdf->SetLineWidth(0.5);
$pdf->Line(0,75,110,75);

$pdf->SetXY(0,70); 
$pdf->SetFont('helvetica','bU', 9);
$pdf->Cell(0, 14,'DATA CROSSMATCH', 0,1,'C');

$pdf->SetXY(4,75);
$pdf->SetFont('helvetica', 'b', 9);
$pdf->Cell(0, 12, 'TGL CROSSMATCH:                                Jam :  ', 0);


//if ($hasil1[StatusCross]=='0'){$comp="INCOMPATIBLE BOLEH KELUAR";  }else if ($hasil1[StatusCross]=='2'){$comp="INCOMPATIBLE TDK BOLEH KELUAR";  } else{ $comp="COMPATIBLE";}
$pdf->SetXY(4,79);
$pdf->SetFont('helvetica','b', 8);
$pdf->Cell(0, 12, 'DENGAN HASIL : ', 0,1,'L');
/*
$pdf->SetXY(4,73);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 12, 'Hasil: '.$hasil1[stat2], 0);
*/
$pdf->SetXY(60,83);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0, 12, 'KET: ', 0);


session_start();
//$kerja=mysql_fetch_assoc(mysql_query("select petugas from dtransaksipermintaan where NoKantong='$kantong1[noKantong]'"));
$pdf->SetXY(4,87); 
$pdf->SetFont('helvetica','b', 8);
$pdf->Cell(0, 13,'Dikerjakan Oleh :', 0);

//$kerja1=mysql_fetch_assoc(mysql_query("select cheker from dtransaksipermintaan where NoKantong='$kantong1[noKantong]'"));
$pdf->SetXY(50,87); 
$pdf->SetFont('helvetica','b', 8);
$pdf->Cell(0, 13, 'Dicek Oleh :', 0);

$pdf->SetXY(4,91); 
$pdf->SetFont('helvetica','i', 8);
$pdf->Cell(0, 13,'Perhatian : Harap Diperiksa kembali sebelum ditransfusikan', 0);


}

$pdf->Output('idcross.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
