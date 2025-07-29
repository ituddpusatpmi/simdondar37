<?
date_default_timezone_set("Asia/Jakarta");
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='../config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../index.php target=\"_top\"><b>LOGIN</b></a></center>";
  die ("");
}
?>
