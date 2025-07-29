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
$pdf->SetTitle('Nota');
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
$pdf->SetFont('courier', 'b', 10);
// add a page
//$pdf->AddPage('L','IDH');
$pdf->AddPage('P','NOTA');
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
	'fontsize' => 8,
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
//$kd='dg';
//$kd=date('Ymd');
/*
if ($td1=='B') $kd=$td0;

if ($td1!='B') $kd='b1';

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
*/
$kodet4 = $today=date("Y");
$kodet5 = substr($today,2,2);
$kodet6 = $today=date("dm");
$kodet7 = $kodet6.$kodet5;
$kodet1 = mysql_fetch_assoc(mysql_query("select nomer from kwitansi where substring(nomer,1,6)='$kodet7' order by nomer desc limit 1"));
$kodet2 = substr($kodet1[nomer],7,3);
//$kodet2 = (int)$kodet2;
$kodet3 = $kodet2+1;
$kode_trans=$kodet7;
if ($kodet2>="009") {
$digi="0"; } else { $digi="00";}
$nomerkw=$kode_trans.'-'.$digi.$kodet3;

mysql_query("update kwitansi set nomer='$nomerkw' where nomer like '%$digi%'");
for ($ii=0;$ii<1;$ii++) {
$bayar1=mysql_fetch_assoc(mysql_query("select ht.jenis,ht.bagian,ht.NoForm,ht.NamaOS,ht.rs,ds.GolDarah,ht.Diagnosa,dp.BiayaLD,dp.TotPotongan,dp.TotDibayar,dp.tgl
                                      from htranspermintaan as ht,dpembayaran as dp,dtranspermintaan as ds
                                      where ht.NoForm=ds.NoForm and ds.NoForm=dp.noForm and dp.noForm='$_GET[noform]'"));
$rs=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$bayar1[rs]'"));
$bayar2=mysql_fetch_assoc(mysql_query("select Jumlah from pembayaran where Tgl=(select max(Tgl) from pembayaran where NoTrans='$_GET[noform]')"));
$bayar_sbl=mysql_fetch_assoc(mysql_query("select sum(subTotal) from dpembayaranpermintaan
					where notrans='$_GET[noform]'"));
$bayar3=mysql_fetch_assoc(mysql_query("select sum(subTotal) from dpembayaranpermintaan
                                      where notrans='$_GET[noform]' and namabrg='CROSSMATCH'"));
$bayar4=mysql_fetch_assoc(mysql_query("select TotDibayar,TotPotongan from dpembayaran where noForm='$_GET[noform]'"));

$udd=mysql_fetch_assoc(mysql_query("select nama,alamat from utd where down='1' and aktif='1'"));
$bdd=mysql_fetch_assoc(mysql_query("select * from bdrs where kode='$bd1'"));
$pdf->SetFont('courier', 'b', 9);
$pdf->SetXY(2+$X,$Y+1);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'C');
$pdf->SetFont('courier', 'b', 9);
$pdf->SetXY(2+$X,$Y+4);
$pdf->Cell(0, 12,$udd[alamat],0, 1, 'C');
$pdf->SetXY($X,$Y+6);
$pdf->Cell(0, 12,'========================================',0, 1, 'C');


$pdf->SetXY(2+$X,$Y+7);
$pdf->Cell(0, 12,$bdd[nama],0, 1, 'L');
$pdf->SetFont('courier', 'b', 8);
$pdf->SetXY($X,$Y+10);
$pdf->Cell(0, 13, 'KWITANSI No. '.$nomerkw, 0,0,'L');
$pdf->SetXY($X,$Y+14);
$pdf->Cell(0, 13, 'Telah Terima dari : '.$_GET[yby], 0);

$kolf=mysql_num_rows(mysql_query("select NoKantong from dtransaksipermintaan where NoForm='$_GET[noform]' and Status='0' and tgl_keluar is NULL"));
$pdf->SetXY($X,$Y+18);
$pdf->SetFont('courier', 'b', 8);
if ($_GET[yby]=='') $_GET[yby]=$bayar1[NamaOS];
$pdf->Cell(0, 13, 'No Formulir : '.$bayar1[NoForm],0, 1,'L'); 

$pdf->SetXY($X,$Y+22);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(0, 13, 'Nama Pasien : '.$bayar1[NamaOS], 0);

$pdf->SetXY($X,$Y+26);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(0, 13, 'Nama RS : '.$rs[NamaRs], 0);

$pdf->SetXY($X,$Y+30);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(0, 13, 'Ruangan : '.$bayar1[bagian], 0);

$pdf->SetXY($X,$Y+34);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(0, 13, 'Layanan : '.$bayar1[jenis], 0);

$pdf->SetXY($X,$Y+38);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(0, 13, 'Gol Darah : '.$bayar1[GolDarah], 0);                         

$pdf->SetXY($X,$Y+42);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(0, 13, 'Jumlah : '.$kolf.' Kolf', 0);


$tglbayar=date("Y-m-d");
$tgl1=date("d",strtotime($tglbayar));
$bln1=date("n",strtotime($tglbayar));
$thn1=date("Y",strtotime($tglbayar));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];

$pdf->SetXY($X,$Y+46);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(20, 13, 'Rincian :', 0,0,'L');
//$pdf->Cell(74, 13,'- LD                     '.rp($bayar1[BiayaLD]),0,0,'R');
$pdf->SetXY($X,$Y+50);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(20, 13,'- BPPD',0,0,'L');
$pdf->Cell(35, 13,rp($bayar1[BiayaLD]-$bayar3['sum(subTotal)']),0,0,'L');

$pdf->SetXY($X,$Y+54);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(20, 13,'- Crossmatch',0,0,'L');
$pdf->Cell(35, 13,rp($bayar3['sum(subTotal)']),0,0,'L');

$pdf->SetXY($X,$Y+58);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(12, 13, 'Sudah bayar :', 0,0,'L');
$pdf->Cell(40, 13,rp($bayar_sbl['sum(subTotal)']-$bayar2[Jumlah]-$bayar1[BiayaLD]+$bayar4[TotDibayar]),0,0,'R');

$pdf->SetXY($X,$Y+62);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(12, 13, 'Total Bayar :', 0,0,'L');
$pdf->Cell(40, 13,rp($bayar2[Jumlah]),0,0,'R');

$pdf->SetXY($X,$Y+66);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(12, 13, 'Kekurangan :', 0,0,'L');
$pdf->Cell(40, 13,rp($bayar1[BiayaLD]-$bayar4[TotDibayar]-$bayar4[TotPotongan]),0,0,'R');

$no=0;
$kan=mysql_query("select NoKantong from dtransaksipermintaan where NoForm='$_GET[noform]' and Status='0' and tgl_keluar is NULL");
$nkk=0;
while ($kan1=mysql_fetch_assoc($kan)) {
// Ubah titipan yang tersisa
$kan11=mysql_query("update dtransaksipermintaan set status='B' where NoKantong='$kan1[NoKantong]' and Status='1'");
$pdf->SetFont('courier', 'b', 8);
$nk1=$nkk+1;
if ($nkk=='0') {
$pdf->SetXY(25+$X,$Y+38+$no);
$pdf->Cell(0, 13, 'Kode: '.$nk1.'. '.$kan1[NoKantong], 0);
}
if ($nkk>'0') {
$pdf->SetXY(42+$X,$Y+38+$no);
$pdf->Cell(0, 13, $nk1.'. '.$kan1[NoKantong], 0);
}
$nkk++;
$no=$no+3;
}
/*
$pdf->SetXY(50,14);
$pdf->SetFont('courier', 'b', 10);
$pdf->Cell(0, 13, 'No Kantong : '.$kan1[NoKantong], 0);
*/

$pdf->SetXY(3+$X,$Y+70);
$pdf->SetFont('courier', 'b', 8);
$kt=explode(' ','PALANG MERAH INDONESIA');
$pdf->SetXY(5+$X,$Y+70);
$pdf->SetFont('courier', 'b', 8);
$kt1=explode(' ',$udd[nama]);
$pdf->SetXY(5+$X,$Y+70);
$pdf->SetFont('courier', 'b', 8);
$kt=explode(' ',$udd[alamat]);



$kota=$kt1[3].' '.$kt1[4];
//if ($kt[4]!='') $kota=$kota.' '.$kt[4];
$jam=date('H:i');
$pdf->Cell(0, 13, $kota.', '.$tgl1.' ' .$bln11. ' ' .$thn1.' '.$jam, 0,0,'C');
$pdf->SetXY($X,$Y+73);
$pdf->SetFont('courier', 'b', 8);
$pdf->Cell(0, 13, 'Petugas Piket ', 0,0,'C');
$pdf->SetXY(0+$X,$Y+75);
$pdf->Cell(0, 13, $nama_lengkap, 0,0,'C');
//$pdf->SetXY(0+$X,$Y+80);
//$pdf->Cell(0, 13, '------------------------------------------------------------------------------------------!! Potong disini !!---------------------------------------------------------------------------------------------------', 0,0,'C');
$Y=$Y+96;
}
$pdf->Output('nota.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
