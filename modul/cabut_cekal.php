<?
session_start();
$today=date("Y-m-d");
if ($_SESSION[leveluser]=='admin' || $_SESSION[leveluser]== 'konseling') {
	$hapus=mysql_query("update pendonor set cekal='0' where Kode='$_GET[Kode]'");
	$catat=mysql_query("insert into cekal (kode_pendonor, petugas, status) values 
			    ('$_GET[Kode]','$_SESSION[namauser]','0')");
	//=======Audit Trial====================================================================================
	$log_mdl ='ADMIN';
	$log_aksi='Cabut Cekal pendonor '.$_GET[Kode];
	include_once "user_log.php";
	//=====================================================================================================
	if ($hapus) {
		if ($_SESSION[leveluser] == 'admin') {
			echo ("Status Cekal Pendonor dengan Kode: $_GET[Kode] telah dicabut.
			<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"3; URL=pmiadmin.php?module=history&q=$_GET[Kode]\">");
		}
		if ($_SESSION[leveluser] == 'konseling') {
			echo ("Status Cekal Pendonor dengan Kode: $_GET[Kode] telah dicabut.
			<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"3; URL=pmikonseling.php?module=history&q=$_GET[Kode]\">");
		}
	}
}
?>
