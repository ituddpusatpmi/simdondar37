<?php
 
$host = 'localhost';
$username = 'root';
$password = 'F201603907';
$database = 'dbdokumen';
 
mysql_connect($host, $username, $password) or die('Koneksi gagal');
mysql_select_db($database) or die ('Database tidak ditemukan');
 
?>
