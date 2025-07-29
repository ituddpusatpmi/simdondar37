<?php
	include "koneksi.php";
	
	$nomor = $_POST['nomor'];
	$bidang = $_POST['bidang'];
	$nama1 = $_POST['nama1'];
	$nama2 = $_POST['nama2'];
	$nama3 = $_POST['nama3'];
	$kontrol1 = $_POST['kontrol1'];
	$kontrol2 = $_POST['kontrol2'];
	$kontrol3 = $_POST['kontrol3'];
	$terkait1 = $_POST['terkait1'];
	$terkait2 = $_POST['terkait2'];
	$terkait3 = $_POST['terkait3'];

		$sql = "update kontrol set bidang='$bidang',nama1='$nama1',nama2='$nama2',nama3='$nama3',kontrol1='$kontrol1',kontrol2='$kontrol2',kontrol3='$kontrol3',terkait1='$terkait1',terkait2='$terkait2',terkait3='$terkait3' where nomor='$nomor'";
		
$result=mysql_query($sql);

if($result){
include "index2.php";
echo "Dokumen terkait berhasil diedit";
}
else{
echo "ERROR";
}

?>