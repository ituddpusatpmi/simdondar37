<?php
include "../config/koneksi.php";

//Tambahan fungsi untuk mencari ip client
function getIP() { 
  $ip; 
  if (getenv("HTTP_CLIENT_IP")) 
    $ip = getenv("HTTP_CLIENT_IP"); 
  else if(getenv("HTTP_X_FORWARDED_FOR")) 
    $ip = getenv("HTTP_X_FORWARDED_FOR"); 
  else if(getenv("REMOTE_ADDR")) 
    $ip = getenv("REMOTE_ADDR"); 
  else 
    $ip = "UNKNOWN";
  return $ip; 
}
//end of function
$client_ip	=getIP();

$nama	=$_GET["id"];
$kode	=$_POST["password"];
$pass	=md5($kode);
$tgl	=date('Y-m-d');
$tgl_up	=date('Y-m-d', strtotime('+90 days', strtotime($tgl)));
$edit	=mysql_query("SELECT id_user,password FROM user WHERE id_user='$nama'");
$r	=mysql_fetch_assoc($edit);

	if ($r['password']==$pass){
		echo "<center>Password baru tidak boleh sama dengan password lama<br>";
		echo "<a href=ganti_passwdex.php?id=$nama&pass=$kode><b>ULANGI</b></a></center>";
		
	} else {
		$query	=mysql_query("UPDATE user SET password='$pass', update_on='$tgl_up' WHERE id_user='$nama'");
		$query2	=mysql_query("INSERT INTO datalogin(username1, ip, stat, KompName, keterangan) VALUES ('$nama','$client_ip',1,'Ubah Password','-')");
		if($query){
			echo "<center>Password Anda berhasil di update<br>";
			echo "<a href=../index.php><b>LOGIN</b></a></center>";
		}}
		
		?>
