<?php
/**
 * Created by PhpStorm.
 * User: irawandb
 * Date: 5/11/16
 * Time: 10:14 AM
 */
?>
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/calender.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<?php
//include('clogin.php');
include('../config/db_connect.php');
//$sekarang=DATE('Y-m-d');
//$sekarang1=$sekarang;
$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
$bulan0=substr($sekarang,5,2);
$bulan=(int)$bulan0;
$bulan=$array_bulan[$bulan];
//$tahun=substr($sekarang,0,4);
?>
<!--<form name="cari" method="POST" action="modul/laporan_donasi_bulanan_wb_aksi.php">-->
<!--<table>-->
<?
if (isset($_POST['waktu'])) {$sekarang=$_POST['waktu'];}
$tahun=substr($sekarang,0,4);

$rowone1=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone2=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone3=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone4=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone5=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone6=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone7=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone8=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone9=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone10=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone11=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone12=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone13=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone14=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone15=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));
$rowone16=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) < 18"));

$rowtwo1=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo2=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo3=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo4=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo5=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo6=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo7=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo8=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo9=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo10=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo11=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo12=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo13=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo14=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo15=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));
$rowtwo16=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24"));

$rowthree1=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree2=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree3=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree4=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree5=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree6=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree7=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree8=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree9=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree10=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree11=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree12=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree13=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree14=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree15=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
$rowthree16=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));

$rowfour1=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour2=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour3=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour4=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour5=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour6=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour7=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour8=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour9=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour10=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour11=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour12=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour13=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour14=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour15=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));
$rowfour16=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 59"));

$rowfive1=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive2=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive3=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive4=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive5=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive6=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive7=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive8=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive9=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive10=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive11=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive12=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive13=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive14=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive15=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
$rowfive16=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 60 AND 150"));
/*
$rowjum1=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='O' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum2=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='O' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum3=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='A' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum4=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='A' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum5=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='B' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum6=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='B' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum7=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='AB' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum8=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='AB' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum9=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='O' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum10=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='O' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum11=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='A' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum12=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='A' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum13=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='B' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum14=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='B' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum15=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='AB' AND p.Rhesus='+' AND ($tahun - YEAR(p.TglLhr)) <=150"));
$rowjum16=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND ($tahun - YEAR(p.TglLhr)) <= 150 AND p.GolDarah='AB' AND p.Rhesus='-' AND ($tahun - YEAR(p.TglLhr)) <=150"));
*/

$rowjum1=$rowone1['Jumlah']+$rowtwo1['Jumlah']+$rowthree1['Jumlah']+$rowfour1['Jumlah']+$rowfive1['Jumlah'];
$rowjum2=$rowone2['Jumlah']+$rowtwo2['Jumlah']+$rowthree2['Jumlah']+$rowfour2['Jumlah']+$rowfive2['Jumlah'];
$rowjum3=$rowone3['Jumlah']+$rowtwo3['Jumlah']+$rowthree3['Jumlah']+$rowfour3['Jumlah']+$rowfive3['Jumlah'];
$rowjum4=$rowone4['Jumlah']+$rowtwo4['Jumlah']+$rowthree4['Jumlah']+$rowfour4['Jumlah']+$rowfive4['Jumlah'];
$rowjum5=$rowone5['Jumlah']+$rowtwo5['Jumlah']+$rowthree5['Jumlah']+$rowfour5['Jumlah']+$rowfive5['Jumlah'];
$rowjum6=$rowone6['Jumlah']+$rowtwo6['Jumlah']+$rowthree6['Jumlah']+$rowfour6['Jumlah']+$rowfive6['Jumlah'];
$rowjum7=$rowone7['Jumlah']+$rowtwo7['Jumlah']+$rowthree7['Jumlah']+$rowfour7['Jumlah']+$rowfive7['Jumlah'];
$rowjum8=$rowone8['Jumlah']+$rowtwo8['Jumlah']+$rowthree8['Jumlah']+$rowfour8['Jumlah']+$rowfive8['Jumlah'];
$rowjum9=$rowone9['Jumlah']+$rowtwo9['Jumlah']+$rowthree9['Jumlah']+$rowfour9['Jumlah']+$rowfive9['Jumlah'];
$rowjum10=$rowone10['Jumlah']+$rowtwo10['Jumlah']+$rowthree10['Jumlah']+$rowfour10['Jumlah']+$rowfive10['Jumlah'];
$rowjum11=$rowone11['Jumlah']+$rowtwo11['Jumlah']+$rowthree11['Jumlah']+$rowfour11['Jumlah']+$rowfive11['Jumlah'];
$rowjum12=$rowone12['Jumlah']+$rowtwo12['Jumlah']+$rowthree12['Jumlah']+$rowfour12['Jumlah']+$rowfive12['Jumlah'];
$rowjum13=$rowone13['Jumlah']+$rowtwo13['Jumlah']+$rowthree13['Jumlah']+$rowfour13['Jumlah']+$rowfive13['Jumlah'];
$rowjum14=$rowone14['Jumlah']+$rowtwo14['Jumlah']+$rowthree14['Jumlah']+$rowfour14['Jumlah']+$rowfive14['Jumlah'];
$rowjum15=$rowone15['Jumlah']+$rowtwo15['Jumlah']+$rowthree15['Jumlah']+$rowfour15['Jumlah']+$rowfive15['Jumlah'];
$rowjum16=$rowone16['Jumlah']+$rowtwo16['Jumlah']+$rowthree16['Jumlah']+$rowfour16['Jumlah']+$rowfive16['Jumlah'];

$utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
?>
<h2 style="text-align: center">LAPORAN JUMLAH PENDONOR BARU/ULANG (ORANG)
    </br><?=strtoupper($utd['nama'])?>
    </br>TAHUN <?=$sekarang?></h2>
<br>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>B.2. DONOR DARAH (Jumlah Orang yang mendonorkan darahnya)</b></h2>
        </legend>
        <table class=form border=1 cellpadding=0 cellspacing=0>
            <!--                    <th colspan=7></th>-->
            <tr class="field">
                <td style="text-align: center" rowspan="4">No.</td>
                <td style="text-align: center; width: 250px" rowspan="4">Kelompok </br>Umur</td>
                <td style="text-align: center; width: 500px" colspan="8">Jumlah Donor Darah Menurut Golongan dan Rh Darah</td>
                <td style="text-align: center; width: 500px" colspan="8">Jumlah Donor Darah Menurut Golongan dan Rh Darah</td>
            </tr>
            <tr>
                <td style="text-align: center" colspan="8">Baru</td>
                <td style="text-align: center" colspan="8">Ulang</td>
            </tr>
            <tr>
                <td style="text-align: center" colspan="2">O</td>
                <td style="text-align: center" colspan="2">A</td>
                <td style="text-align: center" colspan="2">B</td>
                <td style="text-align: center" colspan="2">AB</td>
                <td style="text-align: center" colspan="2">O</td>
                <td style="text-align: center" colspan="2">A</td>
                <td style="text-align: center" colspan="2">B</td>
                <td style="text-align: center" colspan="2">AB</td>
            </tr>
            <tr>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
            </tr>
            <tr>
                <td style="text-align: center">1</td>
                <td><?="< 18 Tahun"?></td>
                <td style="text-align: center" class="input"><?=$rowone1['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone2['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone3['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone4['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone5['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone6['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone7['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone8['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone9['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone10['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone11['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone12['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone13['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone14['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone15['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowone16['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">2</td>
                <td><?="18 - 24 Tahun"?></td>
                <td style="text-align: center" class="input"><?=$rowtwo1['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo2['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo3['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo4['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo5['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo6['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo7['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo8['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo9['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo10['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo11['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo12['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo13['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo14['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo15['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowtwo16['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">3</td>
                <td><?="25 - 44 Tahun"?></td>
                <td style="text-align: center" class="input"><?=$rowthree1['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree2['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree3['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree4['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree5['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree6['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree7['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree8['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree9['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree10['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree11['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree12['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree13['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree14['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree15['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree16['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">4</td>
                <td><?="45 - 59 Tahun"?></td>
                <td style="text-align: center" class="input"><?=$rowfour1['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour2['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour3['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour4['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour5['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour6['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour7['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour8['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour9['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour10['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour11['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour12['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour13['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour14['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour15['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfour16['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">5</td>
                <td><?="60 Tahun Keatas"?></td>
                <td style="text-align: center" class="input"><?=$rowfive1['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive2['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive3['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive4['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive5['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive6['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive7['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive8['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive9['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive10['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive11['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive12['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive13['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive14['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive15['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowfive16['Jumlah']?></td>
            </tr>
            <?
            //                    while ($dataatas=mysql_fetch_assoc($data_rekap)) {
            $komp=mysql_fetch_assoc(mysql_query("SELECT jenis FROM stokkantong WHERE nokantong='$dataatas[nokantong]'"));

            $gda=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gda FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='A' AND user='$_POST[usname]' GROUP BY musnah"));
            $gdb=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gdb FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='B' AND user='$_POST[usname]' GROUP BY musnah"));
            $gdo=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gdo FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='O' AND user='$_POST[usname]' GROUP BY musnah"));
            $gdab=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gdab FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='AB' AND user='$_POST[usname]' GROUP BY musnah"));

            if ($dataatas['StatTempat']=='')  $tempatatas="Logistik";
            if ($dataatas['StatTempat']=='1') $tempatatas="Lab";
            switch ($komp['jenis']){
                case "1": $jns="Single"; break;
                case "2": $jns="Double"; break;
                case "3": $jns="Triple"; break;
                case "4": $jns="Quadruple"; break;
                case "6": $jns="Pediatrik"; break;
            }
            switch($dataatas[musnah]){
                case "0": $st1="Sehat"; break;
                case "1": $st1="Musnah"; break;
            }
            ?>
            <!--                    --><?//}?>
            <tr><td style="text-align: center" colspan="2"><b>JUMLAH</b></td>
                <td style="text-align: center" class="input"><?=$rowjum1?></td>
                <td style="text-align: center" class="input"><?=$rowjum2?></td>
                <td style="text-align: center" class="input"><?=$rowjum3?></td>
                <td style="text-align: center" class="input"><?=$rowjum4?></td>
                <td style="text-align: center" class="input"><?=$rowjum5?></td>
                <td style="text-align: center" class="input"><?=$rowjum6?></td>
                <td style="text-align: center" class="input"><?=$rowjum7?></td>
                <td style="text-align: center" class="input"><?=$rowjum8?></td>
                <td style="text-align: center" class="input"><?=$rowjum9?></td>
                <td style="text-align: center" class="input"><?=$rowjum10?></td>
                <td style="text-align: center" class="input"><?=$rowjum11?></td>
                <td style="text-align: center" class="input"><?=$rowjum12?></td>
                <td style="text-align: center" class="input"><?=$rowjum13?></td>
                <td style="text-align: center" class="input"><?=$rowjum14?></td>
                <td style="text-align: center" class="input"><?=$rowjum15?></td>
                <td style="text-align: center" class="input"><?=$rowjum16?></td>
            </tr>
        </table>
    </fieldset>
</div>
</br>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>CATATAN</b></h2>
        </legend>
        <table>
            <tr>
                <td>1</td>
                <td>Laporan dilaporkan dalam periode tahunan.</td>
            </tr>
            <tr>
                <td style="vertical-align: top">2</td>
                <td>Bila dalam satu tahun menyumbangkan darah lebih dari satu kali, dan salah satunya adalah sebagai Donor Sukarela bukan Donor Bayaran,
                    </br>maka status akhir pendonor adalah Donor Sukarela.</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Bila penyumbangan darah dalam setahun dan sebagai Donor Pengganti, maka status akhir pendonor adalah Donor Pengganti.</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Bila dalam satu tahun pernah menjadi Donor Bayaran maka status akhir pendonor adalah sebagai Donor Bayaran.</td>
            </tr>
            <tr>
                <td style="vertical-align: top">5</td>
                <td>Cekal Permanen adalah : Pendonor yang tidak diperkenankan, untuk menyumbangkan darah lagi seumur hidupnya (misalnya : oleh karena
                    </br>Uji Konfirmasi Diagnostik IMLTD adalah Positif, pendonor terdiagnosa menderita penyakit yang tidak memungkinkan untuk melakukan Donor Darah).</td>
            </tr>
            <tr>
                <td style="vertical-align: top">6</td>
                <td>Cekal Sementara adalah : Pendonor yang tidak diperkenankan, untuk menyumbangkan darah lagi sementara waktu
                    </br>(misalnya : oleh karena Alasan Medis atau tidak terpenuhi persyaratan donor).</td>
            </tr>
        </table>
    </fieldset>
</div>
<!--<form name=xls method=post action=modul/rekap_pembuatan_kantong_xls.php>-->
<!--<input type=hidden name=pertgl value='--><?//=$pertgl?><!--'>-->
<!--<input type=hidden name=perbln value='--><?//=$perbln?><!--'>-->
<!--<input type=hidden name=perthn value='--><?//=$perthn?><!--'>-->
<!--<input type=hidden name=pertgl1 value='--><?//=$pertgl1?><!--'>-->
<!--<input type=hidden name=perbln1 value='--><?//=$perbln1?><!--'>-->
<!--<input type=hidden name=perthn1 value='--><?//=$perthn1?><!--'>-->
<!--<input type=hidden name=waktu value='--><?//=$sekarang?><!--'>-->
<!--<input type=hidden name=waktu1 value='--><?//=$sekarang1?><!--'>-->
<!--<input type=submit name=submit value='Download Rekap (.XLS)'>-->
<!--</form>-->

