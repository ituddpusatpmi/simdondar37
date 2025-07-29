<?php
//require_once('config/koneksi_local.php');

include ("/var/www/simudda/config/koneksi_local.php");

    $dk         = mysql_query("ALTER TABLE `kegiatan` CHANGE `TglPenjadwalan` `TglPenjadwalan` DATE NULL DEFAULT NULL");
?>

