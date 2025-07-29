<?php
/**
 * Created by PhpStorm.
 * User: irawandb
 * Date: 5/11/16
 * Time: 09:45 AM
 */
?>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
include('clogin.php');
include('config/db_connect.php');
$sekarang=DATE('Y-m-d');
$sekarang1=$sekarang;
$tgl1=DATE("Y-m-01");
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
$utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
?>
<form name="cari" method="POST" action="laporan/laporan_donasi_bulanan_aph_aksi.php">
<table>
    <h2 style="text-align: center">LAPORAN DONASI APHERESIS</h2>
<tr>
<td>Pilih Periode : </td>
<td>
<input name="waktu" id="datepicker" value="<?=$tgl1?>" type=text size=10> Sampai Dengan
<input name="waktu1" id="datepicker1" value="<?=$sekarang?>" type=text size=10>
</td><td>
<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?php
    if (isset($_POST[waktu])) {$sekarang=$_POST[waktu];$sekarang1=$sekarang;}
    if ($_POST[waktu1]!='') $sekarang1=$_POST[waktu1];

    $perbln=substr($sekarang,5,2);
    $pertgl=substr($sekarang,8,2);
    $perthn=substr($sekarang,0,4);

    $perbln1=substr($sekarang1,5,2);
    $pertgl1=substr($sekarang1,8,2);
    $perthn1=substr($sekarang1,0,4);

    $data_rekap=mysql_query("select count(*) as total, komponen, musnah from user_komponen where substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND user='$_POST[usname]'  GROUP BY komponen, musnah");
    $jum=mysql_fetch_assoc(mysql_query("select count(noKantong) as kod from user_komponen where substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND user='$_POST[usname]'"));
    ?>
<br>
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
<!---->
