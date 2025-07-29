<?php
require_once('config/koneksi.php');
$no_label = $_GET['no_label'];
	// Escape User Input to help prevent SQL Injection
$no_label = mysql_real_escape_string($no_label);
$no_label = $no_label.'A';
	//build query
//$query = "SELECT noKantong,gol_darah,tgl_Aftap,produk FROM stokkantong WHERE noKantong='$no_label'";
	//Execute query
//$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
$row = mysql_fetch_assoc($qry_result);
$pjg_ktg = strlen($row[noKantong]);
$no= substr($row[noKantong],0,$pjg_ktg-1);
$pjg_tgl = strlen($row[tgl_Aftap]);
$tgl= substr($row[tgl_Aftap],0,$pjg_tgl-9);
echo '{"kantong":';
echo '{"noKantong":"'.$no.'"';
echo ',"gol_darah":"'.$row[gol_darah].'"';
echo ',"tgl_aftap":"'.$tgl.'"';
echo ',"produk":"'.$row[produk].'"';
echo '}';
echo '}';
?>
