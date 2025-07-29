<?
session_start();
include ('../config/db_connect.php');
 $lv=$_SESSION[leveluser];
 $no=mysql_real_escape_string($_GET[NoTrans]);
 if($lv=='aftap'){
    $q=mysql_query("DELETE FROM `htransaksi` WHERE `htransaksi`.`NoTrans` = '$no' ");
	?> <META http-equiv="refresh" content="0; url=../pmiaftap.php?module=check"> <?
 }elseif($lv=='mobile'){
    $q=mysql_query("DELETE FROM `htransaksi` WHERE `htransaksi`.`NoTrans` = '$no' ");
	?> <META http-equiv="refresh" content="0; url=../pmimobile.php?module=check"> <?
 }elseif($lv=='kasir'){
    $q=mysql_query("DELETE FROM `htransaksi` WHERE `htransaksi`.`NoTrans` = '$no' ");
	?> <META http-equiv="refresh" content="0; url=../pmikasir.php?module=check"> <?
 }
