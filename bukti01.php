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
$nspasi=8-$nby1;
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
$pdf->SetTitle('SIMUDDA UTDP');
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
	'font' => 'courier',
	'fontsize' => 10,
	'stretchtext' => 4
);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
require_once('config/koneksi.php');
$Y=0;
$X=0;
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
$idp2	= substr($idp1[nomer],3);
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$nomerkw=$kd.'-'.$idp4.$idp3;
mysql_query("update kwitansi set nomer='$nomerkw' where nomer like '$kd%'");
for ($ii=0;$ii<1;$ii++) {
//$bayar1=mysql_fetch_assoc(mysql_query("select ht.bagian,ht.NoForm,ht.NamaOS,ht.rs,ds.GolDarah,ht.Diagnosa,dp.BiayaLD,dp.TotPotongan,dp.TotDibayar,dp.tgl
//                                      from htranspermintaan as ht,dpembayaran as dp,dtranspermintaan as ds
 //                                     where ht.NoForm=ds.NoForm and ds.NoForm=dp.noForm and dp.noForm='$_GET[noform]'"));
$bayar1=mysql_fetch_assoc(mysql_query("select * from htranspermintaan where noform='$_GET[noform]'"));
$minta=mysql_fetch_assoc(mysql_query("select * from dtranspermintaan where NoForm='$bayar1[NoForm]'"));
$pasien=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$bayar1[no_rm]'"));
$rs=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$bayar1[rs]'"));
$bayar2=mysql_fetch_assoc(mysql_query("select Jumlah from pembayaran where Tgl=(select max(Tgl) from pembayaran where NoTrans='$_GET[noform]')"));
$bayar_sbl=mysql_fetch_assoc(mysql_query("select sum(subTotal) from dpembayaranpermintaan
					where notrans='$_GET[noform]'"));
$bayar3=mysql_fetch_assoc(mysql_query("select sum(subTotal) from dpembayaranpermintaan
                                      where notrans='$_GET[noform]' and namabrg='CROSSMATCH'"));
$bayar4=mysql_fetch_assoc(mysql_query("select TotDibayar,TotPotongan from dpembayaran where noForm='$_GET[noform]'"));

$udd=mysql_fetch_assoc(mysql_query("select nama,alamat,daerah,telp,fax from utd where down='1' and aktif='1'"));
$bdd=mysql_fetch_assoc(mysql_query("select * from bdrs where kode='$bd1'"));
$pdf->SetFont('courier', 'b', 13);
$pdf->SetXY(3,2);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'C');
$pdf->SetFont('courier','' ,12);
$pdf->SetXY(3,6);
$pdf->Cell(0, 12,$udd[alamat].' Telp.'.$udd[telp].' Fax.'.$udd[fax],0, 1, 'C');
$pdf->SetXY(0+$X,$Y+7);
$pdf->Cell(0, 12,'__________________________________________________________________________________________________________',0, 1, 'C');

$pdf->SetFont('courier', 'bu', 12);
$pdf->SetXY(3,10);
$pdf->Cell(0, 14, 'BUKTI PENGAMBILAN DARAH', 0,0,'C');

$kan1=mysql_query("select sum(jumlah) as jum from dtranspermintaan where NoForm='$_GET[noform]'");
$kan=mysql_fetch_assoc($kan1);
$pdf->SetXY(3,16);
$pdf->SetFont('courier', '', 12);
//if ($_GET[yby]=='') $_GET[yby]=$bayar1[NamaOS];
$pdf->Cell(15, 12, 'No.Form',0,0,'L'); 
$pdf->Cell(50, 12,'   : '.$bayar1[noform],0, 0,'L'); 

$pdf->SetXY(3,20);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(15, 12, 'Nama',0,0,'L'); 
$pdf->Cell(50, 12,'   : '.$pasien[nama], 0,0,'L');

$pdf->SetXY(3,24);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(15, 12, 'Alamat',0,0,'L'); 
$pdf->Cell(50, 12,'   : '.$pasien[alamat], 0,0,'L');

$pdf->SetXY(3,28);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(15, 12, 'RS',0,0,'L'); 
$pdf->Cell(50, 12,'   : '.$rs[NamaRs], 0,0,'L');

$pdf->SetXY(3,32);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(15, 12, 'Ruang',0,0,'L'); 
$pdf->Cell(50, 12,'   : '.$bayar1[bagian], 0);                         

$pdf->SetXY(3,36);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(15, 12, 'Jumlah',0,0,'L'); 
$pdf->Cell(50, 12,'   : '.$kan[jum].' Kantong', 0);     

$pdf->SetXY(3,41);
$pdf->SetFont('courier', 'b', 12);
$pdf->Cell(15, 12, 'Sifat Permintaan : '.$bayar1[jenis_permintaan],0,0,'L'); 
                     

$pdf->SetXY(100,16);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(15, 12, 'Komponen Darah :',0,0,'L'); 
//$pdf->Cell(50, 12,': '.$kan[JenisDarah], 0);                         

//JenisDarah 	GolDarah 	Rhesus 	Jumlah
$no=0;
$kan=mysql_query("select JenisDarah,GolDarah,Rhesus,Jumlah from dtranspermintaan where NoForm='$bayar1[noform]' ");
$nkk=0;
while ($kan1=mysql_fetch_assoc($kan)) {
$bayar6=mysql_fetch_assoc(mysql_query("select JenisDarah,GolDarah,Rhesus,Jumlah from dtranspermintaan where JenisDarah='$kan[JenisDarah]'"));
$pdf->SetFont('courier', '', 12);
$nk1=$nkk+1;
if ($nkk=='0') {

$pdf->SetXY(100+$X,$Y+20+$no);
$pdf->Cell(0, 13, $nk1.'. '.$kan1[JenisDarah], 0);
$pdf->SetXY(160+$X,$Y+20+$no);
$pdf->Cell(0, 13,$kan1[GolDarah].'('.$kan1[Rhesus].')  '.$kan1[Jumlah].' Kantong', 0);
}
if ($nkk>'0') {
$pdf->SetXY(100+$X,$Y+20+$no);
$pdf->Cell(0, 13, $nk1.'. '.$kan1[JenisDarah], 0);
$pdf->SetXY(160+$X,$Y+20+$no);
$pdf->Cell(0, 13, $kan1[GolDarah].'('.$kan1[Rhesus].')  '.$kan1[Jumlah].' Kantong', 0);
}
$nkk++;
$no=$no+3;
}

$jam=date("H:i:s");
$pdf->SetXY(3,46);
$pdf->SetFont('courier', 'b', 12);
$pdf->Cell(0, 13,'Sampel Diterima Pukul '. $jam,0,0,'C'); 

$tglbayar=date("Y-m-d");
$tgl1=date("d",strtotime($tglbayar));
$bln1=date("n",strtotime($tglbayar));
$thn1=date("Y",strtotime($tglbayar));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];

/*
$pdf->SetXY(50,14);
$pdf->SetFont('courier', '', 10);
$pdf->Cell(0, 13, 'No Kantong : '.$kan1[NoKantong], 0);
*/
$pdf->SetXY(23,50);
$pdf->SetFont('courier', '', 12);
$kt=explode(' ',$udd[daerah]);
$kota=$udd[daerah];
//if ($kt[4]!='') $kota=$kota.' '.$kt[4];
$pdf->Cell(0, 13, $kota.','.$tgl1.' ' .$bln11. ' ' .$thn1, 0,0,'C');
$pdf->SetXY(23,54);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Petugas Piket', 0,0,'C');
$pdf->SetXY(23,66);
$pdf->SetFont('courier', 'u', 12);
$pdf->Cell(0, 13, $nama_lengkap, 0,0,'C');
//$pdf->SetXY(3+$X,$Y+80);
//$pdf->Cell(0, 13, '------------------------------------------------------------------------------------------!! Potong disini !!---------------------------------------------------------------------------------------------------', 0,0,'C');
//$Y=$Y+90;
}
$pdf->Output('bukti.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
