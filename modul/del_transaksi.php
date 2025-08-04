<?
session_start();
include ('../config/db_connect.php');
 $lv=$_SESSION[leveluser];
 $no=mysql_real_escape_string($_GET[NoTrans]);
 if($lv=='aftap'){
    $q=mysql_query("update `htransaksi` set pengambilan='1',Status='2',jumHB='-' WHERE `NoTrans` = '$no' ");
    ?> <META http-equiv="refresh" content="0; url=../pmiaftap.php?module=spengambilan"> <?
 }elseif($lv=='mobile'){
    $q=mysql_query("update `htransaksi` set pengambilan='1',Status='2',jumHB='-' WHERE `NoTrans` = '$no' ");
    ?> <META http-equiv="refresh" content="0; url=../pmimobile.php?module=spengambilan"> <?
 }elseif($lv=='kasir'){
    $q=mysql_query("update `htransaksi` set pengambilan='1',Status='2',jumHB='-' WHERE `NoTrans` = '$no' ");
    ?> <META http-equiv="refresh" content="0; url=../pmikasir.php?module=spengambilan"> <?
 }
