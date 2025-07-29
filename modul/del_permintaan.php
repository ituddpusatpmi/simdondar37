<?
include ('../config/db_connect.php');
  $no=$_GET[notrans];

   	$q=mysql_query("UPDATE `htranspermintaan` set `status`='2' WHERE `noform` = '$no' ");
	$dtrans=mysql_query("delete from `dtranspermintaan` WHERE `NoForm` = '$no'");
	$dpasien=mysql_query("delete from `daftarpasien` WHERE `noform` = '$no'");
	 
	switch ($_SESSION[leveluser]){
        case "laboratorium":
            ?><META http-equiv="refresh" content="0; url=../pmiadmin.php?module=rekap_permintaan"><?;
            break;
	case "kasir2":
            ?><META http-equiv="refresh" content="0; url=../pmikasir2.php?module=rekap_permintaan"><?;
            break;
        default:
            echo "Anda tidak memiliki hak akses";?>
	<META http-equiv="refresh" content="0; url=../pmikasir2.php?module=rekap_permintaan">
<?}?>
	

