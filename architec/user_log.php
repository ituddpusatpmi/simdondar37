<?php
session_start();
$idp	= mysql_query("select id,id1 from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$tempat	= $idp1[id1];
$log_mdl = strtoupper($log_mdl);
if ($time_aksi==''){$time_aksi=date("Y-m-d H:i:s");}
$q=mysql_query("INSERT INTO `user_log`(`time_aksi`,`komputer`, `user`, `modul`, `aksi_user`, `keterangan`, `tempat`) VALUES
    ('$time_aksi','$_SESSION[client_ip]','$_SESSION[namauser]','$log_mdl','$log_aksi','','$tempat')");
?>
