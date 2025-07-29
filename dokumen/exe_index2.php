<?php
	include "koneksi.php";
	
	$bidang = $_POST['bidang'];
	$nama1 = $_POST['nama1'];
	$nama2 = $_POST['nama2'];
	$nama3 = $_POST['nama3'];
	$nama4 = $_POST['nama4'];
	$nama5 = $_POST['nama5'];
	$nama6 = $_POST['nama6'];
	$nama7 = $_POST['nama7'];
	$kontrol1 = $_POST['kontrol1'];
	$kontrol2 = $_POST['kontrol2'];
	$kontrol3 = $_POST['kontrol3'];
	$kontrol4 = $_POST['kontrol4'];
	$kontrol5 = $_POST['kontrol5'];
	$kontrol6 = $_POST['kontrol6'];
	$kontrol7 = $_POST['kontrol7'];
	$terkait1 = $_POST['terkait1'];
	$terkait2 = $_POST['terkait2'];
	$terkait3 = $_POST['terkait3'];
	$terkait4 = $_POST['terkait4'];
	$terkait5 = $_POST['terkait5'];
	$terkait6 = $_POST['terkait6'];
	$terkait7 = $_POST['terkait7'];

		$sql = "insert into kontrol(bidang,nama1,nama2,nama3,nama4,nama5,nama6,nama7,kontrol1,kontrol2,kontrol3,kontrol4,kontrol5,kontrol6,kontrol7,terkait1,terkait2,terkait3,terkait4,terkait5,terkait6,terkait7) values ('$bidang','$nama1','$nama2','$nama3','$nama4','$nama5','$nama6','$nama7','$kontrol1','$kontrol2','$kontrol3','$kontrol4','$kontrol5','$kontrol6','$kontrol7','$terkait1','$terkait2','$terkait3','$terkait4','$terkait5','$terkait6','$terkait7')";
		
$result=mysql_query($sql);

if($result){
include "index2.php";
echo "Dokumen terkait berhasil ditambahkan";
}
else{
echo "ERROR";
}

?>