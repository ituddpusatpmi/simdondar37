<?php
	include "koneksi.php";
	
	$hapus = $_GET['hapus'];
	
	$sql="delete from kebijakan where kontrol='$hapus'";
	$result=mysql_query($sql);


	$hapus_riwayat=mysql_query("delete from riwayat where kontrol='$hapus'");
	
	include "kebijakan.php";
?>
