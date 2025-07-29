<?php
	include "koneksi.php";
	
	$hapus = $_GET['hapus'];
	
	$sql="delete from user where id='$hapus'";
	$result=mysql_query($sql);
	
	include "petugas_dokumen.php";
?>
