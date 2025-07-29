<?php
//include ('../config/dbi_connect.php');

$id_udd='13'; // ???? Silahkan tanya ke mas danang ya..
$today=date('Y-m-d');
$todayupd=date('d/m/Y H:i:s');


// buat koneksi local
$db_host0 = '192.168.10.200'; // Nama Server
$db_user0 = 'pmijateng'; // User Server
$db_pass0 = 'PMIPROVjat3ngOK!'; // Password Server
$db_name0 = 'pmi'; // Nama Database
$dbi = mysqli_connect("$db_host0", "$db_user0", "$db_pass0", "$db_name0");


// buat koneksi jateng
$db_host1 = '103.229.73.113'; // Nama Server
$db_user1 = 'k6934369_portal'; // User Server
$db_pass1 = 'jawatengah2016'; // Password Server
$db_name1 = 'k6934369_posko'; // Nama Database
$link1 = mysqli_connect("$db_host1", "$db_user1", "$db_pass1", "$db_name1");


/*
// query mu lokal
$result = mysqli_query($dbi, "SELECT kegiatan.TglPenjadwalan, detailinstansi.nama, kegiatan.jumlah, kegiatan.lat, kegiatan.lng, kegiatan.jammulai, kegiatan.jamselesai, kegiatan.ket, kegiatan.Status FROM kegiatan INNER JOIN detailinstansi ON kegiatan.kodeinstansi = detailinstansi.KodeDetail WHERE kegiatan.TglPenjadwalan >= '$today' AND kegiatan.`Status` IN ('1','4')");
 
// ambil data mu lokal
while ($row=mysqli_fetch_array($result))
{$tgl=$row[0];$instansi=$row[1];$jumlah=$row[2];$lat=$row[3];$lng=$row[4];$mulai=$row[5];$selesai=$row[6];
if($row[7]=='0') {$ket='Umum';} else {$ket='Internal';} 
if ($row[8]=='4') {$ket='BATAL';}


//Cek data di jateng
$result_cek = mysqli_query($link1, "SELECT udd_jadwal_mu.tgl_mu, udd_jadwal_mu.instansi FROM udd_jadwal_mu WHERE udd_jadwal_mu.tgl_mu >= '$tgl' AND udd_jadwal_mu.pmi = '$id_udd' and udd_jadwal_mu.instansi like '%$instansi%' LIMIT 1");
while ($row=mysqli_fetch_array($result_cek)){  $tgl_jateng=$row[0]; $instansi_jateng=$row[1];}

//Jika ditemukan proses update
if (($tgl_jateng==$tgl) AND ($instansi_jateng==$instansi)) {
$update_mu = mysqli_query($link1, "UPDATE `udd_jadwal_mu` SET `instansi`='$instansi', `target`='$jumlah', `tgl_mu`='$tgl', `jam_mulai`='$mulai', `peruntukan`='$ket', `pic` ='-', `latitude` = '$lat', `longitude` = '$lng', `update` = '$todayupd', `user_input` = '0' WHERE udd_jadwal_mu.tgl_mu = '$tgl_jateng' AND udd_jadwal_mu.pmi = '$id_udd' and udd_jadwal_mu.instansi ='$instansi_jateng'"); echo "$instansi behasil di UPDATE </br>";}

//Tidak ditemukan proses insert
else {$insert_mu = mysqli_query($link1, "INSERT INTO `udd_jadwal_mu` SET `pmi` ='1', `instansi` = '$instansi', `target` ='$jumlah', `tgl_mu` = '$tgl',`jam_mulai` = '$mulai', `jam_selesai` = '$selesai',`peruntukan` ='$ket', `pic` ='-',`latitude` = '$lat',`longitude` = '$lng',`update` = '00/00/0000 00:00:00', `user_input` = '0'"); echo "$instansi berhasil di INSERT</br> ";}
}

*/
// query stok lokal
$stokA = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT COUNT(*) AS T FROM `stokkantong` WHERE `Status`='2' AND `gol_darah`='A' AND `kadaluwarsa` > '$today' AND `hasil_release` IN ('1','3')")); $stokkA=$stokA['T'];
$stokB = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT COUNT(*) AS T FROM `stokkantong` WHERE `Status`='2' AND `gol_darah`='B' AND `kadaluwarsa` > '$today' AND `hasil_release` IN ('1','3')")); $stokkB=$stokB['T'];
$stokO = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT COUNT(*) AS T FROM `stokkantong` WHERE `Status`='2' AND `gol_darah`='O' AND `kadaluwarsa` > '$today' AND `hasil_release` IN ('1','3')")); $stokkO=$stokO['T'];
$stokAB = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT COUNT(*) AS T FROM `stokkantong` WHERE `Status`='2' AND `gol_darah`='AB' AND `kadaluwarsa` > '$today' AND `hasil_release` IN ('1','3')")); $stokkAB=$stokAB['T'];
echo "Stok (A=$stokkA ,B=$stokkB ,O=$stokkO ,AB=$stokkAB)";

//UPDATE STOK JATENG
$update_stok = mysqli_query($link1,"UPDATE stok_darah_update SET golda_a='$stokkA', golda_b='$stokkB', golda_ab='$stokkAB', golda_o='$stokkO', tgl_update='$todayupd' WHERE `pmi` = '$id_udd'");
if ($update_stok) {echo " Berhasil di UPDATE";} else {echo " GAGAL di update ";}


?>
