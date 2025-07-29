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
?>
<!--<form name="cari" method="POST" action="modul/laporan_donasi_bulanan_wb_aksi.php">-->
<!--<table>-->
    <?
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

    $rowone1=mysql_fetch_assoc(mysql_query("select count(NoKantong) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur < 18 AND caraambil='0'"));
    $rowone2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur < 18 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowone3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur < 18 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowone4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur < 18 AND JenisDonor='1' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowone5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur < 18 AND JenisDonor='2' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowone6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur < 18 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowone7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur < 18 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowone8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='0' AND umur < 18  AND caraambil='0'"));
    $rowone9=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='1' AND umur < 18  AND caraambil='0'"));
    $rowone10=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='+' AND umur < 18  AND caraambil='0'"));
    $rowone11=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='-' AND umur < 18  AND caraambil='0'"));
    $rowone12=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='+' AND umur < 18  AND caraambil='0'"));
    $rowone13=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='-' AND umur < 18 AND caraambil='0'"));
    $rowone14=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='+' AND umur < 18 AND caraambil='0'"));
    $rowone15=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='-' AND umur < 18 AND caraambil='0'"));
    $rowone16=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='+' AND umur < 18 AND caraambil='0'"));
    $rowone17=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='-' AND umur < 18 AND caraambil='0'"));

    $rowtwo1=mysql_fetch_assoc(mysql_query("select count(NoKantong) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 18 AND 24 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowtwo3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 18 AND 24 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowtwo4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 18 AND 24 AND JenisDonor='1' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowtwo5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 18 AND 24 AND JenisDonor='2' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowtwo6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 18 AND 24 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowtwo7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 18 AND 24 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowtwo8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='0' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo9=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='1' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo10=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='+' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo11=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='-' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo12=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='+' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo13=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='-' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo14=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='+' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo15=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='-' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo16=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='+' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));
    $rowtwo17=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='-' AND umur BETWEEN 18 AND 24 AND caraambil='0'"));

    $rowthree1=mysql_fetch_assoc(mysql_query("select count(NoKantong) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 25 AND 44 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowthree3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 25 AND 44 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowthree4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 25 AND 44 AND JenisDonor='1' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowthree5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 25 AND 44 AND JenisDonor='2' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowthree6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 25 AND 44 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowthree7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 25 AND 44 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowthree8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='0' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree9=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='1' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree10=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='+' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree11=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='-' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree12=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='+' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree13=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='-' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree14=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='+' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree15=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='-' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree16=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='+' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));
    $rowthree17=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='-' AND umur BETWEEN 25 AND 44 AND caraambil='0'"));

    $rowfour1=mysql_fetch_assoc(mysql_query("select count(NoKantong) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 45 AND 59 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfour3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 45 AND 59 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfour4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 45 AND 59 AND JenisDonor='1' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfour5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 45 AND 59 AND JenisDonor='2' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfour6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 45 AND 59 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowfour7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 45 AND 59 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowfour8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='0' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour9=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='1' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour10=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='+' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour11=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='-' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour12=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='+' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour13=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='-' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour14=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='+' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour15=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='-' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour16=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='+' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));
    $rowfour17=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='-' AND umur BETWEEN 45 AND 59 AND caraambil='0'"));

    $rowfive1=mysql_fetch_assoc(mysql_query("select count(NoKantong) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 60 AND 150 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfive3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 60 AND 150 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfive4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 60 AND 150 AND JenisDonor='1' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfive5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur BETWEEN 60 AND 150 AND JenisDonor='2' AND NoTrans LIKE 'DG%' AND caraambil='0'"));
    $rowfive6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND umur BETWEEN 60 AND 150 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowfive7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND umur BETWEEN 60 AND 150 AND NoTrans LIKE 'M%' AND caraambil='0'"));
    $rowfive8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='0' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive9=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='1' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive10=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='+' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive11=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='-' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive12=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='+' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive13=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='-' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive14=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='+' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive15=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='-' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive16=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='+' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));
    $rowfive17=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='-' AND umur BETWEEN 60 AND 150 AND caraambil='0'"));

    $rowjum1=mysql_fetch_assoc(mysql_query("select count(NoKantong) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND umur <=150 AND caraambil='0'"));
    $rowjum2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND umur <=150 AND caraambil='0'"));
    $rowjum3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND JenisDonor='0' AND NoTrans LIKE 'DG%' AND umur <=150 AND caraambil='0'"));
    $rowjum4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND JenisDonor='1' AND NoTrans LIKE 'DG%' AND umur <=150 AND caraambil='0'"));
    $rowjum5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND JenisDonor='2' AND NoTrans LIKE 'DG%' AND umur <=150 AND caraambil='0'"));
    $rowjum6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=0 AND NoTrans LIKE 'M%' AND umur <=150 AND caraambil='0'"));
    $rowjum7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND donorbaru=1 AND NoTrans LIKE 'M%' AND umur <=150 AND caraambil='0'"));
    $rowjum8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='0' AND umur <=150 AND caraambil='0'"));
    $rowjum9=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND jk='1' AND umur <=150 AND caraambil='0'"));
    $rowjum10=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='+' AND umur <=150 AND caraambil='0'"));
    $rowjum11=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='O' AND rhesus='-' AND umur <=150 AND caraambil='0'"));
    $rowjum12=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='+' AND umur <=150 AND caraambil='0'"));
    $rowjum13=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='A' AND rhesus='-' AND umur <=150 AND caraambil='0'"));
    $rowjum14=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='+' AND umur <=150 AND caraambil='0'"));
    $rowjum15=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='B' AND rhesus='-' AND umur <=150 AND caraambil='0'"));
    $rowjum16=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='+' AND umur <=150 AND caraambil='0'"));
    $rowjum17=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='0' AND gol_darah='AB' AND rhesus='-' AND umur <=150 AND caraambil='0'"));

    $jum=mysql_fetch_assoc(mysql_query("select count(noKantong) as kod from user_komponen where substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND user='$_POST[usname]'"));

    $utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
    ?>
    <h2 style="text-align: center">LAPORAN DONASI DARAH LENGKAP (<i>WHOLE BLOOD/WB</i>)
    </br><?=strtoupper($utd['nama'])?>
    </br>BULAN <?=strtoupper($bulan)?></h2>
    <br>
<div style="display:table-cell">
<fieldset>
<legend class="table">
    <h2><b>A.1.a. DONASI (Jumlah Kantong darah yang didapatkan dari para donor darah)</b></h2>
</legend>
    <table><tr>
                <table class=form border=1 cellpadding=0 cellspacing=0>
<!--                    <th colspan=7></th>-->
                    <tr class="field">
                        <td style="text-align: center" rowspan="3">No.</td>
                        <td style="text-align: center; width: 120px" rowspan="3">Kelompok </br>Umur</td>
                        <td style="text-align: center; width: 90px" rowspan="3">Jumlah Total </br>Donasi </br>(kantong)</td>
                        <td style="text-align: center" colspan="4">Jumlah Donasi Dalam Gedung (jumlah kantong)</td>
                        <td style="text-align: center" colspan="2" rowspan="2">Jumlah Donasi Sukarela Dari Kegiatan</br>
                        Mobile Unit (jumlah kantong)</td>
                        <td style="text-align: center" colspan="2">Jumlah Donasi</td>
                        <td style="text-align: center; width: 400px" colspan="8">Jumlah Donasi Darah Menurut Golongan Darah dan Rhesus</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" colspan="2">Donor Sukarela</td>
                        <td style="text-align: center; width: 70px" rowspan="2">Donor </br>Pengganti</td>
                        <td style="text-align: center; width: 70px" rowspan="2">Donor </br>Bayaran</td>
                        <td style="text-align: center; width: 50px" rowspan="2">Pria</td>
                        <td style="text-align: center; width: 50px" rowspan="2">Wanita</td>
                        <td style="text-align: center" colspan="2">O</td>
                        <td style="text-align: center" colspan="2">A</td>
                        <td style="text-align: center" colspan="2">B</td>
                        <td style="text-align: center" colspan="2">AB</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; width: 80px" >Baru</td>
                        <td style="text-align: center; width: 80px" >Ulang</td>
                        <td style="text-align: center; width: 120px" >Baru</td>
                        <td style="text-align: center; width: 120px" >Ulang</td>
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
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
                        <td style="text-align: center" class="input"><?=$rowone17['Jumlah']?></td>
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
                        <td style="text-align: center" class="input"><?=$rowtwo17['Jumlah']?></td>
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
                        <td style="text-align: center" class="input"><?=$rowthree17['Jumlah']?></td>
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
                        <td style="text-align: center" class="input"><?=$rowfour17['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td style="text-align: center">5</td>
                        <td><?="60 Tahun"?></td>
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
                        <td style="text-align: center" class="input"><?=$rowfive17['Jumlah']?></td>
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
                        <td style="text-align: center" class="input"><?=$rowjum1['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum2['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum3['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum4['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum5['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum6['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum7['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum8['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum9['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum10['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum11['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum12['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum13['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum14['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum15['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum16['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowjum17['Jumlah']?></td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>
</fieldset>
</div>
    </br>
    <!--batas form rekap -->

<br>
<?
$b1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND beratBadan<45"));
$b2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND umur < 17"));
$b3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND Hb<12"));
$b4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND Hb>17"));
//$b5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND "));
//$b6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND "));
$b7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='2'"));
?>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>A.1.b. JUMLAH DONOR YANG DITOLAK BERDASARKAN ALASAN PENOLAKAN</b></h2>
        </legend>
            <table class=form border=1 cellpadding=0 cellspacing=0>
                <!--                    <th colspan=7></th>-->
                <tr class="field">
                    <td style="text-align: center" >No.</td>
                    <td style="text-align: center; width: 700px" colspan="9">Alasan Penolakan</td>
                    <td style="text-align: center; width: 90px">Jumlah </br>(kantong)</td>
                </tr>
                <tr>
                    <td style="text-align: center">1</td>
                    <td colspan="9"><?="Berat Badan Kurang ( < 45 Kg)"?></td>
                    <td style="text-align: center" class="input"><?=$b1['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">2</td>
                    <td colspan="9"><?="Usia < 17 Tahun"?></td>
                    <td style="text-align: center" class="input"><?=$b2['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">3</td>
                    <td colspan="9"><?="Kadar Hb Rendah ( < 12,5 Gr/dl)"?></td>
                    <td style="text-align: center" class="input"><?=$b3['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">4</td>
                    <td colspan="9"><?="Riwayat Medis Lain (Hipertensi, Hipotensi, Minum Obat,
                    Pasca Operasi, Kadar Hb Tinggi > 17 Gr/dl)"?></td>
                    <td style="text-align: center" class="input"><?=$b4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">5</td>
                    <td colspan="9"><?="Perilaku Beresiko Tinggi (Homo Seksual, Tato/Tindik Kurang Dari 6 Bulan,
                    Sex Bebas, Penasun, Napi"?></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center">6</td>
                    <td colspan="9"><?="Riwayat Bepergian ( Daerah Endemis Malaria, Negara Dengan Kasus HIV Tinggi,
                    Negara Dengan Kasus Sapi Gila)"?></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center">7</td>
                    <td colspan="9"><?="Alasan Lain (Gagal pengambilan darah)"?></td>
                    <td style="text-align: center" class="input"><?=$b7['Jumlah']?></td>
                </tr>
            </table>
        </fieldset>
    </div>

<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>A.1.c. TERIMA DARI UTD LAIN</b></h2>
        </legend>
            <table class=form border=1 cellpadding=0 cellspacing=0>
                <!--                    <th colspan=7></th>-->
                <tr class="field">
                    <td style="text-align: center; width: 50px" >No.</td>
                    <td style="text-align: center; width: 120px" colspan="5">Nama UTD</td>
                    <td style="text-align: center; width: 90px">Jumlah </br>(kantong)</td>
                </tr>
                <tr>
                    <td style="text-align: center">1</td>
                    <td colspan="5"></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center">2</td>
                    <td colspan="5"></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center">3</td>
                    <td colspan="5"></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center">4</td>
                    <td colspan="5"></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center">5</td>
                    <td colspan="5"></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center" colspan="6">JUMLAH</td>
                    <td style="text-align: center" class="input"><?=$jum['kod']?></td>
                </tr>
                <?
                //                    while ($dataatas=mysql_fetch_assoc($data_rekap)) {
                $komp=mysql_fetch_assoc(mysql_query("SELECT jenis FROM stokkantong WHERE nokantong='$dataatas[nokantong]'"));

                $gda=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gda FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='A' AND user='$_POST[usname]' GROUP BY musnah"));
                $gdb=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gdb FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='B' AND user='$_POST[usname]' GROUP BY musnah"));
                $gdo=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gdo FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='O' AND user='$_POST[usname]' GROUP BY musnah"));
                $gdab=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as gdab FROM user_komponen WHERE substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND komponen='$dataatas[komponen]' AND gd='AB' AND user='$_POST[usname]' GROUP BY musnah"));

                if ($dataatas[StatTempat]=='')  $tempatatas="Logistik";
                if ($dataatas[StatTempat]=='1') $tempatatas="Lab";
                switch ($komp[jenis]){
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
            </table>
        </td>

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
    <td>Donor Baru adalah : Seseorang yang baru pertama kali dalam seumur hidup menyumbangkan darahnya.</td>
    </tr>
    <tr>
    <td>2</td>
    <td>Donor Ulang adalah : Seseorang yang pernah dalam seumur hidup menyumbangkan darahnya.</td>
    </tr>
    <tr>
    <td style="vertical-align: top">3</td>
    <td>Donor Bayaran adalah : Seseorang yang memberikan darahnya dengan mendapatkan pembayaran atau keuntungan
                lainnya, untuk memenuhi kebutuhan hidup</br>
                yang mendasar atau sesuatu yang dapat dijual atau dapat ditukarkan kedalam uang tunai atau ditransfer ke orang lain.</td>
    </tr>
</table>
        </fieldset>
    </div>

<form name=xls method=post action=modul/rekap_pembuatan_kantong_xls.php>
<!--<input type=hidden name=pertgl value='--><?//=$pertgl?><!--'>-->
<!--<input type=hidden name=perbln value='--><?//=$perbln?><!--'>-->
<!--<input type=hidden name=perthn value='--><?//=$perthn?><!--'>-->
<!--<input type=hidden name=pertgl1 value='--><?//=$pertgl1?><!--'>-->
<!--<input type=hidden name=perbln1 value='--><?//=$perbln1?><!--'>-->
<!--<input type=hidden name=perthn1 value='--><?//=$perthn1?><!--'>-->
<!--<input type=hidden name=waktu value='--><?//=$sekarang?><!--'>-->
<!--<input type=hidden name=waktu1 value='--><?//=$sekarang1?><!--'>-->
<input type=submit name=submit value='Upload Laporan ke Server'>
</form>

