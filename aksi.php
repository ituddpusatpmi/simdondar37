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
                                email,level,telp,bagian,jabatan)
                               VALUES('$_POST[id_user]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[leveluser]',
                                '$_POST[telp]',
                                '$_POST[bagian]',
                                '$_POST[jabatan]')");
  header('location:pmiadmin.php?module='.$module);
}

// Update user
elseif ($module=='aturuser' AND $act=='update'){
  // Apabila password tidak diubah
$multi='';

for ($i=0; $i< 20; $i++){
$mlv=$_POST[multilevel][$i];
if ($mlv!='') $multi=$multi.','.$mlv;
}
$multi=substr($multi,1);
echo "<br> MULTI $multi";
  if (empty($_POST[password])) {
    mysql_query("UPDATE user SET id_user      = '$_POST[id_user]',
                                 nama_lengkap = '$_POST[nama_lengkap]',
                                 email        = '$_POST[email]',
                                 level        = '$_POST[leveluser]',
                                 telp         = '$_POST[telp]',
                                 bagian       = '$_POST[bagian]',
                                 jabatan      = '$_POST[jabatan]',
                                 multi        = '$multi'
                           WHERE id_user      = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE user SET id_user      = '$_POST[id_user]',
                                 password     = '$pass',
                                 nama_lengkap = '$_POST[nama_lengkap]',
                                 email        = '$_POST[email]',
                                 level        = '$_POST[leveluser]',
                                 telp         = '$_POST[telp]',
                                 bagian       = '$_POST[bagian]',
                                 jabatan      = '$_POST[jabatan]',
                                 multi        = '$multi'
                           WHERE id_user      = '$_POST[id]'");
  }
  header('location:pmiadmin.php?module='.$module);
}
?>
