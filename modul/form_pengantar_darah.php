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
session_start();
$namauser=$_SESSION[namauser];
$nama_lengkap=$_SESSION[nama_lengkap];
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sudarko');
$pdf->SetTitle('Formulir Pengantar Darah');
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
$pdf->SetFont('courier', '', 10);
// add a page
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
//	'font' => 'courier',//'courier',
	'font' => 'helveticaB',
	'fontsize' => 10,
	'stretchtext' => 4
);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
$ckt=mysql_fetch_assoc(mysql_query("select * from dtransaksipermintaan where NoForm='$_POST[noform]' "));
$pasien=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$ckt[no_rm]'"));
$minta=mysql_fetch_assoc(mysql_query("select * from htranspermintaan where NoForm='$_POST[noform]'"));
$minta1=mysql_fetch_assoc(mysql_query("select * from dtranspermintaan where NoForm='$_POST[noform]'"));
$srt=mysql_fetch_assoc(mysql_query("select pd.Kode,pd.Nama,pd.GolDarah,pd.Alamat from pendonor as pd,htransaksi as ht where pd.Kode=ht.KodePendonor and ht.NoKantong='$ckt[noKantong]'"));


//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$kd='LAB.BPD/';
if ($td1=='B') $kd=$td0;
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= $tgl.$bl.$th."/";
$idp	= mysql_query("select nomer from pengantar where nomer like '%$kdtp%' order by nomer DESC");
$idp1	= mysql_fetch_assoc($idp);
//$idp2	= (int)(substr($idp1[nomer],9,3));
$idp2	= substr($idp1[nomer],15,4);
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	=4-(strlen(strval($idp3)));
//$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$nomerkw=$kd.$kdtp.$idp4.$idp3;
$noform1=$_POST[noform];
$today=date("Y-m-d");
$today1=date("Y-m-d H:i:s");
$jam=substr($today1,11);


//------transaksi Donor----
$kota=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));
$tambah=mysql_query("insert into pengantar (nomer,NoForm,Tgl,petugas,no_rm) values ('$nomerkw','$noform1','$today','$namauser','$ckt[no_rm]')");





//......END transaksi donor.........
//------------------------ END set id transaksi ------------------------->



$today=date("Y-m-d");
$tgl2=date("d",strtotime($today));
$bln2=date("n",strtotime($today));
$thn2=date("Y",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$bln2];

//$pdf->Image("logo_pmi.png",4,1.5,15,15);



$udd=mysql_fetch_assoc(mysql_query("select nama,alamat,daerah,telp,fax from utd where down='1' and aktif='1'"));
$pdf->SetFont('courier', 'B', 12);
$pdf->SetXY(2+$X,$Y);
$pdf->Cell(0, 12,'FORMULIR PENGELUARAN DARAH',0, 1, 'C');
$pdf->SetFont('courier', 'B', 12);
$pdf->SetXY(2+$X,$Y+4);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'C');
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(2+$X,$Y+9);
$pdf->Cell(0, 10,$udd[alamat].'   Telp :'.$udd[telp].'   Fax :'.$udd[fax],0, 1, 'C');
$pdf->SetXY(2+$X,$Y+11);
$pdf->Cell(0, 12,'==========================================================================================================',0, 1, 'L');


$pdf->SetXY(4+$X,$Y+13);
$pdf->SetFont('courier', 'B', 11);
$pdf->Cell(0, 13, 'NOMOR : '.$nomerkw, 0,0,'L');

$pdf->SetXY(4+$X,$Y+19);
$pdf->SetFont('courier', 'u', 11);
$pdf->Cell(0, 13, 'DATA PASIEN' , 0);	
				 
$pdf->SetXY(4+$X,$Y+23);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'No. Form. : '.$ckt[NoForm], 0);

$pdf->SetXY(4+$X,$Y+27);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'No. ID    : '.$pasien[no_rm], 0);


$pdf->SetXY(4+$X,$Y+31);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Nama      : '.$pasien[nama], 0);

//$pdf->SetXY(2+$X,$Y+27);
//$pdf->SetFont('courier', '', 11);
//$pdf->Cell(0, 13, 'Nama               : '.$ckt[TempatLhr].','.$ckt[TglLhr], 0);

//$pdf->SetXY(115+$X,$Y+27);
//$pdf->SetFont('courier', '', 11);
//$pdf->Cell(0, 13, 'Bersediakah anda donor dibulan puasa?', 0);

$pdf->SetXY(4+$X,$Y+35);
$pdf->SetFont('courier', '', 11);
if ($pasien[kelamin]=='L') $kelamin='Laki-laki';
if ($pasien[kelamin]=='P') $kelamin='Perempuan';
$pdf->Cell(0, 13, 'JK        : '.$kelamin, 0);

$pdf->SetXY(4+$X,$Y+39);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'UMUR      : '.$minta[umur].' th', 0);

$pdf->SetXY(4+$X,$Y+43);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Gol(Rh)   : '.$pasien[gol_darah].' ('.$pasien[rhesus].')', 0);

$pdf->SetXY(4+$X,$Y+47);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'HB        : '.$minta[hb].' gr/dl', 0);

$pdf->SetXY(4+$X,$Y+51);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Alamat    : '.$pasien[alamat],0);

$pdf->SetXY(4+$X,$Y+57);
$pdf->SetFont('courier', 'u', 11);
$pdf->Cell(0, 13, 'DATA HASIL CROSSMATCH',0);

$pdf->SetXY(4+$X,$Y+61);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, '                 Gol(rh) ',0);
$pdf->SetXY(4+$X,$Y+64);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'No. No Kantong   Produk       Metode       Status         Hasil        Ket.',0);

$no=0;
$kan=mysql_query("select * from dtransaksipermintaan where NoForm='$_POST[noform]' and Status='0' ");
$nkk=0;
while ($kan1=mysql_fetch_assoc($kan)) {
$bayar6=mysql_fetch_assoc(mysql_query("select volume from stokkantong where nokantong='$kan1[NoKantong]'"));

$pdf->SetFont('courier', '', 11);
$nk1=$nkk+1;
if ($nkk=='0') {
if ($kan1[StatusCross]=='1') $hasilcross='COMPATIBLE';
if ($kan1[StatusCross]=='0') $hasilcross='INCOMPATIBLE';
$pdf->SetXY(4+$X,$Y+68+$no);
$ubah=mysql_query("update dtransaksipermintaan set antar='1' where NoKantong='$kan1[NoKantong]' and antar='0' ");
$pdf->Cell(0, 13,$nk1.'.  '.$kan1[NoKantong].'    '.$kan1[gol_darah].'('.$kan1[rh_darah].'),'.$kan1[produk_darah].'     '.$kan1[MetodeCross].'     '.$hasilcross.'     '.$kan1[stat2].'          '.$kan1[Ket], 0);
}
if ($nkk>'0') {
if ($kan1[StatusCross]=='1') $hasilcross='COMPATIBLE';
if ($kan1[StatusCross]=='0') $hasilcross='INCOMPATIBLE';
$pdf->SetXY(4+$X,$Y+68+$no);
$ubah=mysql_query("update dtransaksipermintaan set antar='1' where NoKantong='$kan1[NoKantong]' and antar='0' ");
$pdf->Cell(0, 13,$nk1.'.  '.$kan1[NoKantong].'    '.$kan1[gol_darah].'('.$kan1[rh_darah].'),'.$kan1[produk_darah].'    '.$kan1[MetodeCross].'     '.$hasilcross.'     '.$kan1[stat2].'          '.$kan1[Ket], 0);
}
$nkk++;
$no=$no+3;
}


$pdf->SetXY(20+$X,$Y+111);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0,8,'Pengirim,',0,1,'');

$pdf->SetXY(20+$X,$Y+126);
$pdf->SetFont('helvetica','u',11);
$pdf->Cell(0,8,$namauser,0,1,'');

//SAMPING KANAN
$pdf->SetXY(100+$X,$Y+13);
$pdf->SetFont('courier', 'b', 12);
$jenis=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$minta[jenis]'"));
$pdf->Cell(0, 13, 'JENIS LAYANAN :  '  .$jenis[nama], 0);

$pdf->SetXY(100+$X,$Y+19);
$pdf->SetFont('courier', 'u', 11);
$pdf->Cell(0, 13, 'DATA PERAWATAN' , 0);

$pdf->SetXY(100+$X,$Y+23);
$pdf->SetFont('courier', '', 11);
$rs=mysql_fetch_assoc(mysql_query("select NamaRs,wilayah from rmhsakit where Kode='$ckt[rs]'"));
$pdf->Cell(0, 13, 'Rumah Sakit :  '  .$rs[NamaRs], 0);

$pdf->SetXY(100+$X,$Y+27);
$pdf->SetFont('courier', '', 11);
if ($rs[wilayah]=='0') $wilayah='DALAM KOTA';
if ($rs[wilayah]=='1') $wilayah='LUAR KOTA';
$pdf->Cell(0, 13, 'Wilayah     :  '  .$wilayah, 0);

$pdf->SetXY(100+$X,$Y+31);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'No. RM. RS  :  '  .$minta[regrs], 0);

$pdf->SetXY(100+$X,$Y+35);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Bagian      :  '  .$minta[bagian], 0);

$pdf->SetXY(100+$X,$Y+39);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Klas        :  '  .$minta[kelas].'     Ruang : '  .$minta[ruangan], 0);

$pdf->SetXY(100+$X,$Y+43);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Jml Minta   :  '  .$minta1[Jumlah].' Kolp     Gol (Rh) : '  .$minta1[GolDarah].' ('.$minta1[Rhesus].')', 0);


$pdf->SetXY(100+$X,$Y+47);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Diagnosa    :  '  .$minta[diagnosa], 0);


$pdf->SetXY(100+$X,$Y+51);
$pdf->SetFont('courier', '', 11);
$pdf->Cell(0, 13, 'Alasan Transfusi :  '  .$minta[alasan], 0);




$pdf->SetXY(120+$X,$Y+103);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0,8,$udd[daerah].' , '.$tgl2.' '.$bln22.' '.$thn2,0,1,'C');
$pdf->SetXY(120+$X,$Y+107);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0,8,'Jam  '.$jam,0,1,'C');

$pdf->SetXY(120+$X,$Y+111);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0,8,'Penerima,',0,1,'C');


$pdf->SetXY(120+$X,$Y+126);
$pdf->SetFont('helvetica','u',11);
$pdf->Cell(0,8,'____________________',0,1,'C');





//$nama_file=$_GET[idpendonor].".pdf";
$pdf->Output('nota.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
?>
