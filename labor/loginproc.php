<?php
 
// memulai session
session_start();
 
include "koneksi.php";
 
$userid = $_POST['userid'];
$password = $_POST['pass'];
 
// query untuk mendapatkan record dari username
$query = "SELECT * FROM admin WHERE userid = '$userid'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
//$pass = $data['password'];

//$status = $data['status'];

/*if($status == 'non_aktif')
{
	?>
		<script>
			alert ("Maaf..!! User Anda Tidak Aktif"); history.back();
		</script>
	<?php
}*/
// cek kesesuaian password
if (md5($password) == $data['password'])
{ 
    // menyimpan username dan level ke dalam session
    $_SESSION['tingkat'] = $data['tingkat'];
    $_SESSION['userid'] = $data['userid'];
 
    // tampilkan menu
    include_once ("menu.php");
 
}
else
{
	?>
		<script>
			alert ("Maaf..!! User / Password Anda Salah"); history.back();
		</script>
	<?php
}

?>