<?
session_start();
include ('../config/db_connect.php');
$lv=$_SESSION[leveluser];
$idsms=mysql_real_escape_string($_GET[Id]);
$hapussms=mysql_query("DELETE FROM `sms`.`inbox` WHERE `inbox`.`ID` = '$idsms'"); ?>
    <META http-equiv="refresh" content="0; url=../pmiadmin.php?module=sms_inbox">





