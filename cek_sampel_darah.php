<?php
require_once('config/koneksi.php');
$no_label = strtoupper($_GET['no_label']);
    // Escape User Input to help prevent SQL Injection
$no_label = mysql_real_escape_string($no_label);
    //build query

$query = "SELECT sk_kode,sk_donor,sk_gol,sk_rh FROM samplekode WHERE sk_kode='$no_label'";
//$query = "SELECT noKantong,gol_darah,RhesusDrh,produk FROM stokkantong WHERE noKantong='$no_label'";
    //Execute query
$qry_result = mysql_query($query) or die(mysql_error());

    //Build Result String
$row = mysql_fetch_assoc($qry_result);
$nkt=strtoupper($row[noKantong]);
echo '{"kantong":';
echo '{';
echo '"gol_darah":"'.$row[sk_gol].'"';
echo ',"nokantong":"'.$row[sk_kode].'"';
echo ',"rhesus":"'.$row[sk_rh].'"';
echo ',"kode":"'.$row[sk_donor].'"';
echo '}';
echo '}';
?>

