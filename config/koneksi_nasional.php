<?php
$server = "simdondar.dynns.com";
$username = "utdpmi";
$password = "utdpmi10022017";
$database = "utdnasional";


// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
