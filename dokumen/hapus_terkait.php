<?php
	include "koneksi.php";
	
	$hapus = $_GET['hapus'];
	
	$sql="delete from kontrol where nomor='$hapus'";
	$result=mysql_query($sql);
	
	include "index2.php";
?>