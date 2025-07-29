<?php
	include "koneksi.php";
	
	$bidang = $_POST['bidang'];
	$nama1 = $_POST['nama1'];
	$nama2 = $_POST['nama2'];
	$tingkat = $_POST['tingkat'];
	$kontrol1 = $_POST['kontrol1'];
	$kontrol2 = $_POST['kontrol2'];
	$kontrol3 = $_POST['kontrol3'];
	$kontrol4 = $_POST['kontrol4'];
	$periode = $_POST['periode'];
	$no_versi = $_POST['no_versi'];
	$tgl_setuju = $_POST['tgl_setuju'];
	$tgl_pelaksanaan = $_POST['tgl_pelaksanaan'];
	$tgl_peninjauan = $_POST['tgl_peninjauan'];
	$pembuat = $_POST['pembuat'];
	$pemeriksa = $_POST['pemeriksa'];
	$pengesah = $_POST['pengesah'];
	

		$sql = "insert into formulir(bidang,nama1,nama2,tingkat,kontrol,periode,no_versi,tgl_setuju,tgl_pelaksanaan,tgl_peninjauan,pembuat,pemeriksa,pengesah) values ('$bidang','$nama1','$nama2','$tingkat',concat('$kontrol1','$kontrol2','$kontrol3','$kontrol4'),'$periode','$no_versi','$tgl_setuju','$tgl_pelaksanaan','$tgl_peninjauan','$pembuat','$pemeriksa','$pengesah')";
		
$result=mysql_query($sql);

if($result){
include "formulir.php";
echo "Dokumen Formulir berhasil di input";
}
else{
echo "ERROR";
}

?>