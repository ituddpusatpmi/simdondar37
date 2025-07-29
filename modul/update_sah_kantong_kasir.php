<?
session_start();
include ('../config/db_connect.php');
 $lv=$_SESSION[leveluser];
   $nkt=mysql_real_escape_string($_GET[noKantong]);
			mysql_query("update stokkantong set sah='1' where noKantong='$nkt' and Status='1'");?>
			<META http-equiv="refresh" content="0; url=../pmikasir.php?module=rekap_transaksi">




