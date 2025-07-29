<?php
session_start();
include "config/koneksi.php";
include "config/library.php";

$module=$_GET[module];
$act=$_GET[act];


// Menghapus data
if (isset($module) AND $act=='hapus'){
  mysql_query("DELETE FROM user WHERE id_user='$_GET[id]'");
  header('location:pmiadmin.php?module='.$module);
}

// Input user
elseif ($module=='aturuser' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO user(id_user,
                                password,
                                nama_lengkap,
                                email,level,telp)
                               VALUES('$_POST[id_user]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]','$_POST[leveluser]','$_POST[telp]')");
  header('location:pmiadmin.php?module='.$module);
}

// Update user
elseif ($module=='ganti_passwd' AND $act=='update'){
  // Apabila password tidak diubah
  if (empty($_POST[password])) {
    mysql_query("UPDATE user SET 
                                 nama_lengkap = '$_POST[nama_lengkap]',
                                 email        = '$_POST[email]',
				 telp         = '$_POST[telp]'
                           WHERE id_user      = '$_POST[id]'");
  }
  // Apabila password diubah
  else {
    $pass=md5($_POST[password]);
    $sandi="UPDATE user SET 
                                 password     = '$pass',
                                 nama_lengkap = '$_POST[nama_lengkap]',
                                 email        = '$_POST[email]',
				 telp         = '$_POST[telp]'
                           WHERE id_user      = '$_POST[id]'";
	$profile=mysql_query($sandi);
  }
	//=======Audit Trial====================================================================================
	$log_mdl ='UPDATE Profil User';
	$log_aksi='Update Profil Berhasil';
	include_once "user_log.php";
	//=====================================================================================================
echo "Data berhasil di update";
}


?>
