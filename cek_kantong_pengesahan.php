<?php
require_once('config/koneksi.php');
$no_label = $_GET['no_label'];
	// Escape User Input to help prevent SQL Injection
$no_label = mysql_real_escape_string($no_label);
//$no_label = $no_label.'A';
	//build query
$query = "SELECT nokantong FROM pengesahan WHERE nokantong='$no_label'";
	//Execute query
$qry_result = mysql_query($query) or die(mysql_error());

	//Build Result String
$row = mysql_fetch_assoc($qry_result);
$pjg_ktg = strlen($row['nokantong']);
$no= substr($row['nokantong'],0,$pjg_ktg-1);
echo '{"kantong":';
echo '{"noKantong":"'.$no.'"';
echo '}';
echo '}';
?>
