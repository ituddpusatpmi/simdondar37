<?
session_start();
include ('../config/db_connect.php');
$lv=$_SESSION[leveluser];
$idsms=mysql_real_escape_string($_GET[Id]);
$hapussms=mysql_query("DELETE FROM `wagw`.`outbox` WHERE `outbox`.`id` = '$idsms'"); 
if (($_SESSION[leveluser])=='p2d2s'){
?>
    <META http-equiv="refresh" content="0; url=../pmip2d2s.php?module=wa_outbox">
<?}else{?>
    <META http-equiv="refresh" content="0; url=../pmiadmin.php?module=wa_outbox">
<?}?>





