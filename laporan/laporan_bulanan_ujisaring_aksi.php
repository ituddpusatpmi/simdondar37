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
$sekarang=DATE('Y-m-d');
$sekarang1=$sekarang;
$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    if (isset($_POST['waktu'])) {$sekarang=$_POST['waktu'];$sekarang1=$sekarang;}
    if ($_POST['waktu1']!='') $sekarang1=$_POST['waktu1'];
    $bulan0=substr($sekarang,5,2);
    $bulan=(int)$bulan0;
    $bulan=$array_bulan[$bulan];

    $perbln=substr($sekarang,5,2);
    $pertgl=substr($sekarang,8,2);
    $perthn=substr($sekarang,0,4);

    $perbln1=substr($sekarang1,5,2);
    $pertgl1=substr($sekarang1,8,2);
    $perthn1=substr($sekarang1,0,4);

$rowone1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND umur < 18 "));
$rowone2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND umur < 18 AND ulang='0'"));
$rowone3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND umur < 18 AND ulang='1'"));
$rowone4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND umur < 18"));
$rowone5=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND umur < 18 AND ulang='0'"));
$rowone6=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND umur < 18 AND ulang='1'"));
$rowone7=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND umur < 18"));
$rowone8=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND umur < 18 AND ulang='0'"));
$rowone9=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND umur < 18 AND ulang='1'"));
$rowone10=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND umur < 18"));
$rowone11=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND umur < 18 AND ulang='0'"));
$rowone12=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND umur < 18 AND ulang='1'"));
$rowone13="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='A' AND Rhesus='-' AND h.umur < 18 "));
$rowone14="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='+' AND h.umur < 18 "));
$rowone15="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='-' AND h.umur < 18 "));

$rowtwo1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND  umur BETWEEN 18 AND 24  "));
$rowtwo2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='0'"));
$rowtwo3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='1'"));
$rowtwo4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND  umur BETWEEN 18 AND 24 "));
$rowtwo5=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='0'"));
$rowtwo6=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='1'"));
$rowtwo7=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND  umur BETWEEN 18 AND 24 "));
$rowtwo8=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='0'"));
$rowtwo9=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='1'"));
$rowtwo10=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND  umur BETWEEN 18 AND 24 "));
$rowtwo11=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='0'"));
$rowtwo12=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
             FROM hasilelisa
             WHERE tglPeriksa>='$sekarang'
             AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND  umur BETWEEN 18 AND 24  AND ulang='1'"));
$rowtwo13="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='A' AND Rhesus='-' AND h.umur BETWEEN 18 AND 24 "));
$rowtwo14="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='+' AND h.umur BETWEEN 18 AND 24 "));
$rowtwo15="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='-' AND h.umur BETWEEN 18 AND 24 "));

$rowthree1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND  umur BETWEEN 25 AND 44  "));
$rowthree2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='0'"));
$rowthree3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='1'"));
$rowthree4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND  umur BETWEEN 25 AND 44 "));
$rowthree5=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='0'"));
$rowthree6=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='1'"));
$rowthree7=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND  umur BETWEEN 25 AND 44 "));
$rowthree8=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='0'"));
$rowthree9=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='1'"));
$rowthree10=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND  umur BETWEEN 25 AND 44 "));
$rowthree11=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='0'"));
$rowthree12=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND  umur BETWEEN 25 AND 44  AND ulang='1'"));
$rowthree13="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='A' AND Rhesus='-' AND h.umur BETWEEN 25 AND 44 "));
$rowthree14="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='+' AND h.umur BETWEEN 25 AND 44 "));
$rowthree15="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='-' AND h.umur BETWEEN 25 AND 44 "));

$rowfour1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND umur BETWEEN 45 AND 59  "));
$rowfour2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='0'"));
$rowfour3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='1'"));
$rowfour4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND umur BETWEEN 45 AND 59 "));
$rowfour5=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='0'"));
$rowfour6=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='1'"));
$rowfour7=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND umur BETWEEN 45 AND 59 "));
$rowfour8=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='0'"));
$rowfour9=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='1'"));
$rowfour10=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND umur BETWEEN 45 AND 59 "));
$rowfour11=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='0'"));
$rowfour12=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND umur BETWEEN 45 AND 59  AND ulang='1'"));
$rowfour13="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='A' AND Rhesus='-' AND h.umur BETWEEN 45 AND 59 "));
$rowfour14="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='+' AND h.umur BETWEEN 45 AND 59 "));
$rowfour15="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='-' AND h.umur BETWEEN 45 AND 59 "));

$rowfive1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND umur >=60  "));
$rowfive2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND umur >=60  AND ulang='0'"));
$rowfive3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='0' AND Hasil!='0' AND umur >=60  AND ulang='1'"));
$rowfive4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND umur >=60 "));
$rowfive5=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND umur >=60  AND ulang='0'"));
$rowfive6=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='1' AND Hasil!='0' AND umur >=60  AND ulang='1'"));
$rowfive7=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND umur >=60 "));
$rowfive8=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND umur >=60  AND ulang='0'"));
$rowfive9=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='2' AND Hasil!='0' AND umur >=60  AND ulang='1'"));
$rowfive10=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND umur >=60 "));
$rowfive11=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND umur >=60  AND ulang='0'"));
$rowfive12=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
                 FROM hasilelisa
                 WHERE tglPeriksa>='$sekarang'
                 AND tglPeriksa<='$sekarang1' AND jenisPeriksa='3' AND Hasil!='0' AND umur >=60  AND ulang='1'"));
    $rowfive13="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='A' AND Rhesus='-' AND h.umur BETWEEN 60 AND 150"));
    $rowfive14="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='+' AND h.umur BETWEEN 60 AND 150"));
    $rowfive15="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='-' AND h.umur BETWEEN 60 AND 150"));

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
    $rowjum13="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='A' AND Rhesus='-' AND h.umur <=150"));
    $rowjum14="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='+' AND h.umur <=150"));
    $rowjum15="0";//mysql_fetch_assoc(mysql_query("select count(p.Kode) as Jumlah from pendonor p, htransaksi h where DATE(h.Tgl)>='$sekarang' and DATE(h.Tgl)<='$sekarang1' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.GolDarah='B' AND Rhesus='-' AND h.umur <=150"));

//    $jum=mysql_fetch_assoc(mysql_query("select count(h.NoKantong) as kod from user_komponen where substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND user='$_POST[usname]'"));

    $utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
    ?>
    <h2 style="text-align: center">LAPORAN UJI SARING
    </br><?=strtoupper($utd['nama'])?>
    </br>BULAN <?=strtoupper($bulan)?></h2>
    <br>
<div style="display:table-cell">
<fieldset>
    <legend class="table">
        <h2><b>C.1. UJI SARING INFEKSI MENULAR LEWAT TRANSFUSI DARAH</b></h2>
    </legend>
    <table><tr>
                <table class=form border=1 cellpadding=0 cellspacing=0>
<!--                    <th colspan=7></th>-->
                    <tr class="field">
                        <td style="text-align: center" rowspan="3">No.</td>
                        <td style="text-align: center; width: 250px" rowspan="3">Kelompok </br>h.umur</td>
                        <td style="text-align: center; width: 700px" colspan="15">Hasil Pemeriksaan Uji Saring**</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" colspan="3">Hepatitis B</td>
                        <td style="text-align: center" colspan="3">Hepatitis C</td>
                        <td style="text-align: center" colspan="3">HIV</td>
                        <td style="text-align: center" colspan="3">Sifilis</td>
                        <td style="text-align: center" colspan="3">Malaria</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; width: 100px" >Total </br>diperiksa<sup>(1)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif<sup>(2)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif</br>Ulang<sup>(3)</sup></td>
                        <td style="text-align: center; width: 100px" >Total </br>diperiksa<sup>(1)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif<sup>(2)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif</br>Ulang<sup>(3)</sup></td>
                        <td style="text-align: center; width: 100px" >Total </br>diperiksa<sup>(1)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif<sup>(2)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif</br>Ulang<sup>(3)</sup></td>
                        <td style="text-align: center; width: 100px" >Total </br>diperiksa<sup>(1)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif<sup>(2)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif</br>Ulang<sup>(3)</sup></td>
                        <td style="text-align: center; width: 100px" >Total </br>diperiksa<sup>(1)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif<sup>(2)</sup></td>
                        <td style="text-align: center; width: 100px" >Reaktif</br>Ulang<sup>(3)</sup></td>
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
                    </tr>
                </table>

        </tr>
    </table>
</fieldset>
</div>
    </br>
    <!--batas form rekap -->

<br>
<?
    // HBSAG //
$c2one1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%NAT%'"));
$c2one2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%CHLIA%'"));
$c2one3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%ELISA%'"));
$c2one4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%RAPID%'"));

// HCV //
$c2two1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%NAT%'"));
$c2two2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%CHLIA%'"));
$c2two3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%ELISA%'"));
$c2two4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%RAPID%'"));

// HIV //
$c2trhee1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%NAT%'"));
$c2trhee2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%CHLIA%'"));
$c2trhee3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%ELISA%'"));
$c2trhee4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%RAPID%'"));

// SYPHLIS //
$c2four1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%NAT%'"));
$c2four2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%CHLIA%'"));
$c2four3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%ELISA%'"));
$c2four4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%RAPID%'"));

    // MALARIA //
    $c2five1="0";
    $c2five2="0";
    $c2five3="0";
    $c2five4="0";

    // JUMLAH KESELURUHAN //
    $jumc2one=$c2one1['Jumlah']+$c2two1['Jumlah']+$c2trhee1['Jumlah']+$c2four1['Jumlah'];
    $jumc2two=$c2one2['Jumlah']+$c2two2['Jumlah']+$c2trhee2['Jumlah']+$c2four2['Jumlah'];
    $jumc2trhee=$c2one3['Jumlah']+$c2two3['Jumlah']+$c2trhee3['Jumlah']+$c2four3['Jumlah'];
    $jumc2four=$c2one4['Jumlah']+$c2two4['Jumlah']+$c2trhee4['Jumlah']+$c2four4['Jumlah'];
?>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>C.2. METODE UJI SARING INFEKSI MENULAR LEWAT TRANSFUSI DARAH (IMLTD)</b></h2>
        </legend>
            <table class=form border='1' cellpadding='0' cellspacing='0'>
                <tr class="field">
                    <td style="text-align: center" rowspan="2">No.</td>
                    <td style="text-align: center; width: 150px" rowspan="2">Jenis IMLTD</td>
                    <td style="text-align: center; width: 340px" colspan="4">Metode (Sebutkan Nama Reagen)</td>
                </tr>
                <tr>
                    <td style="text-align: center">NAT</td>
                    <td style="text-align: center">CHLIA</td>
                    <td style="text-align: center">EIA</td>
                    <td style="text-align: center">RAPID</td>
                </tr>
                <tr>
                    <td style="text-align: center">1</td>
                    <td>Hepatitis B</td>
                    <td style="text-align: center" class="input"><?=$c2one1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2one2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2one3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2one4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">2</td>
                    <td>Hepatitis C</td>
                    <td style="text-align: center" class="input"><?=$c2two1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2two2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2two3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2two4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">3</td>
                    <td>HIV</td>
                    <td style="text-align: center" class="input"><?=$c2trhee1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2trhee2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2trhee3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2trhee4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">4</td>
                    <td>Syphilis</td>
                    <td style="text-align: center" class="input"><?=$c2four1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2four2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2four3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c2four4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">5</td>
                    <td>Malaria</td>
                    <td style="text-align: center" class="input">0</td>
                    <td style="text-align: center" class="input">0</td>
                    <td style="text-align: center" class="input">0</td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center" colspan="2">JUMLAH</td>
                    <td style="text-align: center" class="input"><?=$jumc2one?></td>
                    <td style="text-align: center" class="input"><?=$jumc2two?></td>
                    <td style="text-align: center" class="input"><?=$jumc2trhee?></td>
                    <td style="text-align: center" class="input"><?=$jumc2four?></td>
                </tr>
            </table>
        </fieldset>
    </div>
<td></td>

<?php

// HBSAG //
$c3one1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%NAT%' AND ulang='1' AND jns_donor='0' AND baru_ulang='0'"));
$c3one2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%CHLIA%' AND ulang='1' AND jns_donor='0' AND baru_ulang='1'"));
$c3one3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%ELISA%' AND ulang='1' AND jns_donor='1'"));
$c3one4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='0' AND Metode like '%RAPID%' AND ulang='1' AND jns_donor='2'"));

// HCV //
$c3two1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%NAT%' AND ulang='1' AND jns_donor='0' AND baru_ulang='0'"));
$c3two2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%CHLIA%' AND ulang='1' AND jns_donor='0' AND baru_ulang='1'"));
$c3two3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%ELISA%' AND ulang='1' AND jns_donor='1'"));
$c3two4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='1' AND Metode like '%RAPID%' AND ulang='1' AND jns_donor='2'"));

// HIV //
$c3trhee1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%NAT%' AND ulang='1' AND jns_donor='0' AND baru_ulang='0'"));
$c3trhee2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%CHLIA%' AND ulang='1' AND jns_donor='0' AND baru_ulang='1'"));
$c3trhee3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%ELISA%' AND ulang='1' AND jns_donor='1'"));
$c3trhee4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='2' AND Metode like '%RAPID%' AND ulang='1' AND jns_donor='2'"));

// SYPHLIS //
$c3four1=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%NAT%' AND ulang='1' AND jns_donor='0' AND baru_ulang='0'"));
$c3four2=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%CHLIA%' AND ulang='1' AND jns_donor='0' AND baru_ulang='1'"));
$c3four3=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%ELISA%' AND ulang='1' AND jns_donor='1'"));
$c3four4=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(noKantong)) as Jumlah
            FROM hasilelisa
            WHERE tglPeriksa>='$sekarang' AND tglPeriksa<='$sekarang1'
            AND jenisPeriksa='3' AND Metode like '%RAPID%' AND ulang='1' AND jns_donor='1'"));

// MALARIA //
$c3five1="0";
$c3five2="0";
$c3five3="0";
$c3five4="0";

// JUMLAH KESELURUHAN //
$jumc3one=$c3one1['Jumlah']+$c3two1['Jumlah']+$c3trhee1['Jumlah']+$c3four1['Jumlah'];
$jumc3two=$c3one2['Jumlah']+$c3two2['Jumlah']+$c3trhee2['Jumlah']+$c3four2['Jumlah'];
$jumc3trhee=$c3one3['Jumlah']+$c3two3['Jumlah']+$c3trhee3['Jumlah']+$c3four3['Jumlah'];
$jumc3four=$c3one4['Jumlah']+$c3two4['Jumlah']+$c3trhee4['Jumlah']+$c3four4['Jumlah'];
?>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>C.3. JUMLAH DONASI REAKTIF ULANG</b></h2>
        </legend>
            <table class=form border='1' cellpadding='0' cellspacing='0'>
                <!--                    <th colspan=7></th>-->
                <tr class="field">
                    <td style="text-align: center; width: 50px" rowspan="3">No.</td>
                    <td style="text-align: center; width: 150px" rowspan="3">Jenis Pemeriksaan</td>
                    <td style="text-align: center" colspan="4">Jenis Donasi</td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 100px" colspan="2">Donor Sukarela</td>
                    <td style="text-align: center; width: 100px" rowspan="2">Donor</br>Pengganti</td>
                    <td style="text-align: center; width: 100px" rowspan="2">Donor</br>Bayaran</td>
                </tr>
                <tr>
                    <td style="text-align: center; width: 100px">BARU</td>
                    <td style="text-align: center; width: 100px">ULANG</td>
                </tr>
                <tr>
                    <td style="text-align: center">1</td>
                    <td>Hepatitis B</td>
                    <td style="text-align: center" class="input"><?=$c3one1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3one2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3one3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3one4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">2</td>
                    <td>Hepatitis C</td>
                    <td style="text-align: center" class="input"><?=$c3two1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3two2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3two3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3two4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">3</td>
                    <td>HIV</td>
                    <td style="text-align: center" class="input"><?=$c3trhee1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3trhee2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3trhee3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3trhee4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">4</td>
                    <td>Syphilis</td>
                    <td style="text-align: center" class="input"><?=$c3four1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3four2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3four3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3four4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">5</td>
                    <td>Malaria</td>
                    <td style="text-align: center" class="input"><?=$c3five1['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3five2['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3five3['Jumlah']?></td>
                    <td style="text-align: center" class="input"><?=$c3five4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center" colspan="2">JUMLAH</td>
                    <td style="text-align: center" class="input"><?=$jumc3one?></td>
                    <td style="text-align: center" class="input"><?=$jumc3two?></td>
                    <td style="text-align: center" class="input"><?=$jumc3trhee?></td>
                    <td style="text-align: center" class="input"><?=$jumc3four?></td>
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
        <td>* * : </td>
    <td>(1)</td>
    <td>Merupakan jumlah total kantong darah yang diperiksa uji saring IMLTD dengan semua metode yang digunakan (sama dengan jumlah donasi).</td>
    </tr>
    <tr>
    <td></td>
    <td>(2)</td>
    <td>Merupakan jumlah total kantong darah dengan hasil uji saring yang reaktif pertama kali dari semua metode yang digunakan.</td>
    </tr>
    <tr>
    <td></td>
    <td style="vertical-align: top">(3)</td>
    <td>Merupakan jumlah kantong darah sengan hasil uji saring yang reaktif ulang (pemeriksaan IMLTD induplicat) dari semua metode yang digunakan
        </br>(sampel yang diperiksa adalah sampel reaktif pertama kali).</td>
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

