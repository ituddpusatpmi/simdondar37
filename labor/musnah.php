<?php
	include "koneksi.php";
	
	$n = $_POST['jum']; // membaca jumlah data

// looping
for ($i=1; $i<=$n; $i++)
{
    $tanggal = $_POST['tanggal'.$i];
    $shift = $_POST['shift'.$i];
	$tgl_aftap = $_POST['tgl_aftap'.$i];
	$kantong = $_POST['kantong'.$i];
	$gol = $_POST['gol'.$i];
	$rhesus = $_POST['rhesus'.$i];
	$jenis = $_POST['jenis'.$i];
	$keterangan = $_POST['keterangan'.$i];
	
  
       $query = "INSERT INTO musnah (tanggal,shift,tgl_aftap,kantong,gol,rhesus,jenis,keterangan) VALUES ('$tanggal','$shift','$tgl_aftap','$kantong','$gol','$rhesus','$jenis','$keterangan')";
       $hasil = mysql_query($query);

}

if($hasil){
include "home.php";
echo "Kantong berhasil dimusnahkan";
}
else{
echo "ERROR";
}
	
?>