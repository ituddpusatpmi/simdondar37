<?
session_start();
include ('../config/db_connect.php');
 $lv=$_SESSION[leveluser];
 $no=mysql_real_escape_string($_GET[notransaksi]);
 if($lv=='aftap'){
    $q=mysql_query("DELETE FROM `transaksi_plebotomi` WHERE `transaksi_plebotomi`.`notransaksi` = '$no' ");
	?> <META http-equiv="refresh" content="0; url=../pmikasir.php?module=daftar_permintaan_plebotomi"> <?
 }elseif($lv=='mobile'){
    $q=mysql_query("DELETE FROM `transaksi_plebotomi` WHERE `transaksi_plebotomi`.`notransaksi` = '$no' ");
	?> <META http-equiv="refresh" content="0; url=../pmikasir.php?module=daftar_permintaan_plebotomi"> <?
 }
