<?php
$server = "192.168.28.1";
$username = "root";
$password = "root";
$database = "kuisioner";


// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
