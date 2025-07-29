<?php
	include "koneksi.php";
	
	$tanggal = $_POST['tanggal'];
	$shift = $_POST['shift'];
	$tgl_form = $_POST['tgl_form'];
	$formulir = $_POST['formulir'];
	$kembali_a = $_POST['kembali_a'];
	$kembali_b = $_POST['kembali_b'];
	$kembali_ab = $_POST['kembali_ab'];
	$kembali_o = $_POST['kembali_o'];
	$keluar_a = $_POST['keluar_a'];
	$keluar_b = $_POST['keluar_b'];
	$keluar_ab = $_POST['keluar_ab'];
	$keluar_o = $_POST['keluar_o'];
	$kembali_a2 = $_POST['kembali_a2'];
	$kembali_b2 = $_POST['kembali_b2'];
	$kembali_ab2 = $_POST['kembali_ab2'];
	$kembali_o2 = $_POST['kembali_o2'];
	$keluar_a2 = $_POST['keluar_a2'];
	$keluar_b2 = $_POST['keluar_b2'];
	$keluar_ab2 = $_POST['keluar_ab2'];
	$keluar_o2 = $_POST['keluar_o2'];
	$kembali_a3 = $_POST['kembali_a3'];
	$kembali_b3 = $_POST['kembali_b3'];
	$kembali_ab3 = $_POST['kembali_ab3'];
	$kembali_o3 = $_POST['kembali_o3'];
	$keluar_a3 = $_POST['keluar_a3'];
	$keluar_b3 = $_POST['keluar_b3'];
	$keluar_ab3 = $_POST['keluar_ab3'];
	$keluar_o3 = $_POST['keluar_o3'];
	$kembali_a4 = $_POST['kembali_a4'];
	$kembali_b4 = $_POST['kembali_b4'];
	$kembali_ab4 = $_POST['kembali_ab4'];
	$kembali_o4 = $_POST['kembali_o4'];
	$keluar_a4 = $_POST['keluar_a4'];
	$keluar_b4 = $_POST['keluar_b4'];
	$keluar_ab4 = $_POST['keluar_ab4'];
	$keluar_o4 = $_POST['keluar_o4'];
	$kembali_a5 = $_POST['kembali_a5'];
	$kembali_b5 = $_POST['kembali_b5'];
	$kembali_ab5 = $_POST['kembali_ab5'];
	$kembali_o5 = $_POST['kembali_o5'];
	$keluar_a5 = $_POST['keluar_a5'];
	$keluar_b5 = $_POST['keluar_b5'];
	$keluar_ab5 = $_POST['keluar_ab5'];
	$keluar_o5 = $_POST['keluar_o5'];
	$kembali_a6 = $_POST['kembali_a6'];
	$kembali_b6 = $_POST['kembali_b6'];
	$kembali_ab6 = $_POST['kembali_ab6'];
	$kembali_o6 = $_POST['kembali_o6'];
	$keluar_a6 = $_POST['keluar_a6'];
	$keluar_b6 = $_POST['keluar_b6'];
	$keluar_ab6 = $_POST['keluar_ab6'];
	$keluar_o6 = $_POST['keluar_o6'];
	$kembali_a7 = $_POST['kembali_a7'];
	$kembali_b7 = $_POST['kembali_b7'];
	$kembali_ab7 = $_POST['kembali_ab7'];
	$kembali_o7 = $_POST['kembali_o7'];
	$keluar_a7 = $_POST['keluar_a7'];
	$keluar_b7 = $_POST['keluar_b7'];
	$keluar_ab7 = $_POST['keluar_ab7'];
	$keluar_o7 = $_POST['keluar_o7'];
	$petugas = $_POST['petugas'];
	$keterangan = $_POST['keterangan']; 

$sql="insert into laporan(tanggal,shift,tgl_form,formulir,kembali_a,kembali_b,kembali_ab,kembali_o,keluar_a,keluar_b,keluar_ab,keluar_o,kembali_a2,kembali_b2,kembali_ab2,
kembali_o2,keluar_a2,keluar_b2,keluar_ab2,keluar_o2,kembali_a3,kembali_b3,kembali_ab3,kembali_o3,keluar_a3,keluar_b3,keluar_ab3,keluar_o3,kembali_a4,
kembali_b4,kembali_ab4,kembali_o4,keluar_a4,keluar_b4,keluar_ab4,keluar_o4,kembali_a5,kembali_b5,kembali_ab5,kembali_o5,keluar_a5,keluar_b5,keluar_ab5,
keluar_o5,kembali_a6,kembali_b6,kembali_ab6,kembali_o6,keluar_a6,keluar_b6,keluar_ab6,keluar_o6,kembali_a7,kembali_b7,kembali_ab7,kembali_o7,keluar_a7,
keluar_b7,keluar_ab7,keluar_o7,petugas,keterangan) values('$tanggal','$shift','$tgl_form','$formulir','$kembali_a','$kembali_b','$kembali_ab',
'$kembali_o','$keluar_a','$keluar_b','$keluar_ab','$keluar_o','$kembali_a2','$kembali_b2','$kembali_ab2','$kembali_o2','$keluar_a2',
'$keluar_b2','$keluar_ab2','$keluar_o2','$kembali_a3','$kembali_b3','$kembali_ab3','$kembali_o3','$keluar_a3','$keluar_b3','$keluar_ab3',
'$keluar_o3','$kembali_a4','$kembali_b4','$kembali_ab4','$kembali_o4','$keluar_a4','$keluar_b4','$keluar_ab4','$keluar_o4','$kembali_a5',
'$kembali_b5','$kembali_ab5','$kembali_o5','$keluar_a5','$keluar_b5','$keluar_ab5','$keluar_o5','$kembali_a6','$kembali_b6','$kembali_ab6',
'$kembali_o6','$keluar_a6','$keluar_b6','$keluar_ab6','$keluar_o6','$kembali_a7','$kembali_b7','$kembali_ab7','$kembali_o7','$keluar_a7',
'$keluar_b7','$keluar_ab7','$keluar_o7','$petugas','$keterangan')";
$result=mysql_query($sql);

if($result){
include "home.php";
echo "No Formulir ".$formulir." berhasil di input";
}
else{
echo "ERROR";
}
?>