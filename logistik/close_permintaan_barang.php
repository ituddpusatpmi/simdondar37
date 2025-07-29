<?
session_start();
include ('../config/db_connect.php');
  echo "Proses penutupan permintaan barang";
  $lv=$_SESSION[leveluser];
  $levelusr=$_SESSION[leveluser];
  $notrans=mysql_real_escape_string($_GET[notrans]);
  mysql_query("update hstok_order set status_order=2 where notrans='$notrans'");
  //=======Audit Trial====================================================================================
  $log_mdl =$levelusr;
  $log_aksi='Close permintaan barang no : '.$notrans;
  include_once "user_log.php";
  //=====================================================================================================
  ?>
  <META http-equiv="refresh" content="1; url=../pmilogistik.php?module=rekap_minta_proses">
