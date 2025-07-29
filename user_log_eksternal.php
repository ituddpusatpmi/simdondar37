<?php
function CaritIP() {
  $ip='';
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
$log_mdl	= strtoupper($log_mdl);
$client_ip	= CaritIP();
$time_aksi=date("Y-m-d H:i:s");
$q=mysql_query("INSERT INTO `user_log`(`time_aksi`,`komputer`, `user`, `modul`, `aksi_user`, `keterangan`) VALUES
    ('$time_aksi','$client_ip','$_SESSION[namauser]','$log_mdl','$log_aksi','')");
?>
