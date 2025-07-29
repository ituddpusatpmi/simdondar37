<?
session_start();
include ('../config/db_connect.php');
$lv=$_SESSION[leveluser];
echo "Mengosongkan Pesan outbox......";
$modehapus=mysql_real_escape_string($_GET[mode]);
$hapussms=mysql_query("DELETE FROM `wagw`.`outbox`");
//$hapussms=mysql_query("DELETE FROM `sms`.`outbox_multipart`");
?>
    <META http-equiv="refresh" content="2; url=../pmiadmin.php?module=wa_outbox">    






