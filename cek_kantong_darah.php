<?php
require_once('config/koneksi.php');
$no_label = strtoupper($_GET['no_label']);
	// Escape User Input to help prevent SQL Injection
$no_label = mysql_real_escape_string($no_label);
	//build query
$query = "SELECT noKantong,gol_darah,RhesusDrh,produk FROM stokkantong WHERE noKantong='$no_label' AND sah='1' and Status between 1 and 2";
	//Execute query
$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
$row = mysql_fetch_assoc($qry_result);
$row1 = mysql_fetch_assoc(mysql_query("select KodePendonor from htransaksi where noKantong='$no_label'"));
$row2 = mysql_fetch_assoc(mysql_query("select Nama from pendonor where Kode='$row1[KodePendonor]'"));
$nkt=strtoupper($row[noKantong]);
echo '{"kantong":';
echo '{';
echo '"gol_darah":"'.$row[gol_darah].'"';
echo ',"nokantong":"'.$nkt.'"';
echo ',"rhesus":"'.$row[RhesusDrh].'"';
echo ',"produk":"'.$row[produk].'"';
echo ',"kode":"'.$row1[KodePendonor].'"';
echo ',"nama":"'.$row2[Nama].'"';
echo '}';
echo '}';
?>
