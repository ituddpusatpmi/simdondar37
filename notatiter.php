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
$nspasi=11-$nby1;
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
$pdf->SetMargins(2, 2, 2);
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
    'font' => 'courier',//'courier',
    'fontsize' => 10,
    'stretchtext' => 4
);

// PRINT VARIOUS 1D BARCODES

// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, 'CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9', 0, 1);
require_once('config/koneksi.php');
/*
     $idp    = mysql_query("select nomor from kwitansi order by nomer desc limit 1");
     $idp1    = mysql_fetch_assoc($idp);
     $idp2    = (int)(substr($idp1[Kode],2,3));
     $idp3=(int)$idp2+1;
     $j_nol1= 3-(strlen(strval($idp3)));
     for ($i=0; $i<$j_nol1; $i++){
          $idp4 .="0";
     }
     $kode=$kd.$idp4.$idp3;

*/
//------------------------ set id transaksi ------------------------->
$idp    = mysql_query("select * from tempat_donor where active='1'");
$idp1    = mysql_fetch_assoc($idp);
$kd='KW';
if ($td1=='B') $kd=$td0;
$th        = substr(date("Y"),2,2);
$bl        = date("m");
$tgl    = date("d");
$kdtp    = $tgl.$bl.$th."-";
$idp    = mysql_query("select nomer from kwitansilain where nomer like '%$kdtp%' order by nomer DESC");
$idp1    = mysql_fetch_assoc($idp);
//$idp2    = (int)(substr($idp1[nomer],9,3));
$idp2    = substr($idp1[nomer],9,3);
if ($idp2<1) {$idp2="000";}
$idp3    = (int)$idp2+1;
$id31    =3-(strlen(strval($idp3)));
//$id31    = strlen($idp2)-strlen($idp3);
$idp4    = "";
for ($i=0; $i<$id31; $i++){
    $idp4 .="0";
}
$nomerkw=$kd.$kdtp.$idp4.$idp3;
$noform1=$_GET[noform];
$htrans1=$_GET[yby];
$today=date("Y-m-d");
    
    
//shift
    $s1='';$s2='';$s3='';$s4='';
    $waktu=date('H:i:s');
    $jam1=mysql_fetch_assoc(mysql_query("select * from shift where nama='I'"));
    $jam2=mysql_fetch_assoc(mysql_query("select * from shift where nama='II'"));
    $jam3=mysql_fetch_assoc(mysql_query("select * from shift where nama='III'"));
    $jam4=mysql_fetch_assoc(mysql_query("select * from shift where nama='IV'"));
    
    $sh1=$jam1[jam]; $sh2=$jam2[jam]; $sh3=$jam3[jam];$sh4=$jam4[jam];
    if ($waktu >= $sh1 ){ $shift='1';}
    if ($waktu >= $sh2 ){ $shift='2';}
    if ($waktu >= $sh3 ){ $shift='3';}
    if ($waktu < $sh1 ){ $shift='4';}
    
//

    
     $pendonor = mysql_fetch_assoc(mysql_query("SELECT Nama,GolDarah,Rhesus from pendonor where Kode='$noform1' limit 1"));
                    $htrans = mysql_fetch_assoc(mysql_query("SELECT\n".
                                "pmi.htranspermintaan.no_rm,\n".
                                "pmi.pasien.nama,\n".
                                "pmi.pasien.kelamin,\n".
                                "pmi.pasien.umur,\n".
                                "pmi.pasien.gol_darah,\n".
                                "pmi.pasien.rhesus,\n".
                                "pmi.rmhsakit.NamaRs\n".
                                "FROM\n".
                                "pmi.htranspermintaan\n".
                                "JOIN pmi.pasien\n".
                                "ON pmi.htranspermintaan.no_rm = pmi.pasien.no_rm \n".
                                "JOIN pmi.rmhsakit\n".
                                "ON pmi.htranspermintaan.rs = pmi.rmhsakit.Kode\n".
                                "where noform='$htrans1'\n".
                                "limit 1"));
        

    mysql_query("insert into kwitansilain (nomer,NoForm,jumlah,Tgl,petugas,shift,tempat,kodebiaya,no_rm,rs,layanan) values ('$nomerkw','$htrans1','150000','$today','$namauser','$shift','UDD','BY013','$htrans[no_rm]','-','-')");




$pdf->Image("logo_pmi.png",4,1.5,15,15);


$udd=mysql_fetch_assoc(mysql_query("select nama,alamat from utd where down='1' and aktif='1'"));
$bdd=mysql_fetch_assoc(mysql_query("select * from bdrs where kode='$bd1'"));
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(20+$X,$Y);
$pdf->Cell(0, 12,'PALANG MERAH INDONESIA',0, 1, 'L');
$pdf->SetFont('courier', '', 12);
$pdf->SetXY(20+$X,$Y+4);
$pdf->Cell(0, 12,$udd[nama],0, 1, 'L');
$pdf->SetXY(20+$X,$Y+9);
$pdf->Cell(0, 10,$udd[alamat],0, 1, 'L');
$pdf->SetXY(4+$X,$Y+11.2);
$pdf->Cell(0, 12,'==========================================================================================================',0, 1, 'L');
$pdf->SetFont('courier', 'b', 12);
$pdf->SetXY(4+$X,$Y+15);
$pdf->Cell(0, 12, 'KWITANSI PEMERIKSAAN LABORATORIUM KLINIK PMI               No. '.$nomerkw, 0,0,'L');



    $pdf->SetXY(4+$X,$Y+23);
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(0, 13, 'Telah Terima Dari   : '.$pendonor[Nama], 0);

    $pdf->SetXY(4+$X,$Y+36);
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(0, 13, 'Guna Membayar Biaya Pemeriksaan Titer Antibody ', 0);
        
    $pdf->SetXY(4+$X,$Y+43);
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(0, 13, 'Untuk Permintaan Darah Plasma Konvalesen  ', 0);

    $pdf->SetXY(4+$X,$Y+50);
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(0, 13, 'Nama Pasien          : '.$htrans[nama].' ('.$htrans[umur].' Thn)', 0);
    
    $pdf->SetXY(4+$X,$Y+57);
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(0, 13, 'Gol. Darah           : '.$htrans[gol_darah].'('.$htrans[rhesus].')', 0);
    
    $pdf->SetXY(4+$X,$Y+64);
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(0, 13, 'Dirawat di           : '.$htrans[NamaRs], 0);




$tglbayar=date("Y-m-d");
$tgl1=date("d",strtotime($tglbayar));
$bln1=date("n",strtotime($tglbayar));
$thn1=date("Y",strtotime($tglbayar));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];
    
    $pdf->SetXY(4+$X,$Y+66);
    $pdf->SetFont('courier', '', 12);
    $pdf->Cell(0, 13,'____________________________________________', 0,0,'L');
    


$pdf->SetXY(4+$X,$Y+73);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(12, 13,     'Total dibayar       :', 0,0,'L');
$pdf->Cell(100, 13,                           rp('150000'),0,0,'R');



/*
$pdf->SetXY(50,14);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'No Kantong : '.$kan1[NoKantong], 0);
*/
$pdf->SetXY(125+$X,$Y+86);
$pdf->SetFont('courier', '', 12);
$kt=explode(' ',$udd[nama]);
$kota=$kt[3].' '.$kt[4];
//if ($kt[4]!='') $kota=$kota.' '.$kt[4];
$pdf->Cell(0, 13, $kota.', '.$tgl1.' ' .$bln11. ' ' .$thn1, 0,0,'C');



$pdf->SetXY(125+$X,$Y+90);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, 'Petugas Piket', 0,0,'C');
$pdf->SetXY(125+$X,$Y+103);
$pdf->SetFont('courier', '', 12);
$pdf->Cell(0, 13, $namauser, 0,0,'C');



//$pdf->SetXY(4+$X,$Y+77);
//$pdf->SetFont('courier', 'b', 9);
//$pdf->Cell(0, 13, 'Darah yang sudah di proses atau diambil, tidak dapat dikembalikan', 0,0,'L');
$pdf->SetXY(4+$X,$Y+105);
if ($ii<2) $pdf->Cell(0, 13, '==========================================================================================================',0, 1, 'L');
$pdf->SetXY(4+$X,$Y+109);
$pdf->SetFont('courier','bu', 10);
$pdf->Cell(0, 13, 'PERHATIAN :', 0,0,'L');

$pdf->SetXY(4+$X,$Y+113);
$pdf->SetFont('courier','', 10);
$pdf->Cell(0, 13, '- Biaya Yang tertera dikwitansi ini BUKAN HARGA DARAH, karena darah tidak untuk diperjual belikan', 0,0,'L');

$pdf->SetXY(4+$X,$Y+117);
$pdf->SetFont('courier','', 10);
$pdf->Cell(0, 13, '- Hasil Pemeriksaan Titer dapat diterima, maksimal 2 x 24 Jam setelah pengambilan sampel', 0,0,'L');

$pdf->SetXY(4+$X,$Y+121);
$pdf->SetFont('courier','', 10);
$pdf->Cell(0, 13, '- Biaya pemeriksaan sampel yang sudah di proses atau diambil, tidak dapat dikembalikan ', 0,0,'L');

$pdf->SetXY(4+$X,$Y+128);
$pdf->SetFont('courier','', 11);
$pdf->Cell(0, 13, '--== TERIMA KASIH dan SEMOGA LEKAS SEMBUH ==-- ', 0,0,'C');
$Y=$Y+127;

$pdf->Output('nota.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>

