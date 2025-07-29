<link rel="shortcut icon" href="images/index.ico" type="image/x-icon"/>
<title>Sistem Informasi Manajemen Unit Donor Darah</title>
<?php
include "config/koneksi.php";
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
session_start();
$namauser     =$_SESSION['namauser'];
$idlogin      =$_SESSION['sesi_id'];
$client_ip    =getIP();
$today        = date("Y-m-d H:i:s");
mysql_query("UPDATE datalogin SET logout = '$today', stat='0' where ip='$client_ip' AND username1='$namauser' AND id= '$idlogin' AND stat = '1'");
//=======Audit Trial====================================================================================
$log_mdl ='Logout';
$log_aksi='User keluar dari SIMDONDAR';
include_once "user_log.php";
//=====================================================================================================
session_destroy();
?>
<script language="javascript">
      top.window.location='index.php';
</script>

