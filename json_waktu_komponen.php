<?php
/**
 * Created by PhpStorm.
 * User: irawandb
 * Date: 5/13/18
 * Time: 3:35 PM
 */
include "config/db_connect.php";
$nokantong=$_GET['NoKantong'];
$nokan=substr($nokantong,0,-1);
$alat1=mysql_query("select * from komp_g5 WHERE NoKantong like '$nokan%'");

if (mysql_num_rows($alat1)=='1') {
    echo '{"komp": ';
    while($komp=mysql_fetch_assoc($alat1)) {
        $kantong     	= $komp['NoKantong'];
        $tgl		= $komp['tgl_proses'];
        $jawal  	= $komp['jam_mulai'];
        $jakhir 	= $komp['jam_selesai'];


        echo ' {
        "kantong":"'.$kantong.'",
        "tanggal":"'.$tgl.'",
	"mulai":"'.$jawal.'",
        "selesai":"'.$jakhir.'" }';
        }
    echo '}';
}
?>
