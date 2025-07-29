<?
session_start();
include ('../config/db_connect.php');
$lv=$_SESSION[leveluser];
echo "Mengosongkan sms Inbox......";
$modehapus=mysql_real_escape_string($_GET[mode]);
$hapussms=mysql_query("DELETE FROM `sms`.`inbox`");
//$hapussms=mysql_query("DELETE FROM `sms`.`outbox_multipart`");
?>
    <META http-equiv="refresh" content="2; url=../pmiadmin.php?module=sms_inbox">    






