<?
session_start();
include ('config/db_connect.php');
$today=date("Y-m-d H:i:s");
    $lv=$_SESSION[leveluser];
    $nkt=mysql_real_escape_string($_GET[noKantong]);
    $nktc=substr($nkt,0,strlen($nkt)-1);
    $tambah=mysql_query("UPDATE stokkantong set StatTempat='1', tglmutasi='$today' where noKantong like '$nktc%'");
//=======Audit Trial====================================================================================
$log_mdl ='LOGISTIK';
$log_aksi='Pengesahan Kantong Logistik : '.$nkt;
include('user_log.php');
//=====================================================================================================
?>
<META http-equiv="refresh" content="0; url=../pmilogistik.php?module=pengesahan_kantong">





