<?php
session_start();
include("../config/db_connect.php");
$nama_paket = $_REQUEST['nama_paket'];
$nama_paket = mysql_real_escape_string($nama_paket);
$isi01 = $_REQUEST['isi1'];
$isi01 = mysql_real_escape_string($isi01);
$isi001=explode(";",$isi01);
$isi1=$isi001[0];
$isi02 = $_REQUEST['isi2'];
$isi02 = mysql_real_escape_string($isi02);
$isi002=explode(";",$isi02);
$isi2=$isi002[0];
$isi03 = $_REQUEST['isi3'];
$isi03 = mysql_real_escape_string($isi03);
$isi003=explode(";",$isi03);
$isi3=$isi003[0];
$isi04 = $_REQUEST['isi4'];
$isi04 = mysql_real_escape_string($isi04);
$isi004=explode(";",$isi04);
$isi4=$isi004[0];

	$q_trans0="insert into master_paket (nama_paket,isi1,isi2,isi3,isi4) values ('$nama_paket','$isi1','$isi2','$isi3','$isi4')";
	$q_trans=mysql_query($q_trans0);
	
	$pak=mysql_query("insert into paket (kode_paket,stok_logistik,stok_kasir,stok_mu,aktif) values ('$nama_paket','','','','1')");
if ($q_trans) echo "Sukses";
?>
