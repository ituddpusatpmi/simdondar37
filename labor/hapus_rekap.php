<?php
	include "koneksi.php";
	
	$hapus = $_GET['hapus'];
	
	$sql="delete from laporan where id='$hapus'";
	
	$result=mysql_query($sql);
	
	if($result){
include "home.php";
echo "";
}
else{
echo "ERROR";
}
?>