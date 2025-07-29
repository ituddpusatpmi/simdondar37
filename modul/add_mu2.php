<?php
require("../config/koneksi.php");
$namauser   =$_SESSION[namauser];
$namabagian =$_SESSION[namabagian];
$levelusr   =$_SESSION[leveluser];  

//KONEKSI WEB & SERVER

// Gets data from URL parameters
$id_mu     = $_GET['id_mu'];
$instansi  = $_GET['instansi'];
$tgl       = $_GET['datepicker'];
$jumlah    = $_GET['jumlah'];

//$jam_mulai = $_GET['jam_mulai'];
//$tgljam = $tgl.' '.$jam_mulai.':00';
//$tgljam = $tgl.' '.$jam_mulai.':00';

$lat    = $_GET['lat'];
$lng    = $_GET['lng'];
$q_utd	= mysql_query("select id from utd where aktif='1'");			
$utd	= mysql_fetch_assoc($q_utd);
// Insert new row with user data
if ($id_mu>0) {
	mysql_query("delete from kegiatan where NoTrans='$id_mu'");
    mysql_query("UPDATE detailinstansi SET lat='$lat', lng='$lng' WHERE KodeDetail='$instansi'");
	$query = sprintf("INSERT INTO kegiatan " .
         " (NoTrans, kodeinstansi, jumlah, lat, lng, TglPenjadwalan, tempat, id_udd) " .
         " VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
        mysql_real_escape_string($id_mu),
        mysql_real_escape_string($instansi),
        mysql_real_escape_string($jumlah),
        mysql_real_escape_string($lat),
        mysql_real_escape_string($lng),
	mysql_real_escape_string($tgl),
	mysql_real_escape_string($instansi),
        mysql_real_escape_string($utd[id]));
} else {
    mysql_query("UPDATE detailinstansi SET lat='$lat', lng='$lng' WHERE KodeDetail='$instansi'");
$query = sprintf("INSERT INTO kegiatan " .
         " (NoTrans, kodeinstansi, jumlah, lat, lng, TglPenjadwalan, tempat, id_udd) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
        mysql_real_escape_string($instansi),
        mysql_real_escape_string($jumlah),
        mysql_real_escape_string($lat),
    	mysql_real_escape_string($lng),
	mysql_real_escape_string($tgl),
	mysql_real_escape_string($instansi),
	mysql_real_escape_string($utd[id]));
}
$result = mysql_query($query);
//=======Audit Trial====================================================================================
$log_mdl =$levelusr;
$log_aksi="Input MU: '.$instansi.' tanggal: '.$tgl.' jumlah: '.$jumlah.'";
include_once "user_log.php";
//=====================================================================================================

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

?>
