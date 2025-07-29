<?
include ('../config/db_connect.php');
  $no=$_GET[NoTrans];
  $kode=$_GET[kode];
  $tgl=$_GET[tgl];
    $q=mysql_query("delete from `htransaksi` WHERE `NoTrans` = '$no' ");
	$qlama=mysql_query("delete from `htransaksilama` WHERE `id` = '$no' AND `KodePendonor` = '$kode' ");
	 
	switch ($_SESSION[leveluser]){
	case "p2d2s":
            ?><META http-equiv="refresh" content="0; url=../pmip2d2s.php?module=history&q=<?=$kode?>"><?;
            break;
        case "aftap":
            ?><META http-equiv="refresh" content="0; url=../pmiaftap.php?module=history&q=<?=$kode?>"><?;
            break;
        case "admin":
            ?><META http-equiv="refresh" content="0; url=../pmiadmin.php?module=history&q=<?=$kode?>"><?;
            break;
	case "kasir":
            ?><META http-equiv="refresh" content="0; url=../pmikasir.php?module=history&q=<?=$kode?>"><?;
            break;
        default:
            echo "Anda tidak memiliki hak akses";
    }?>
	

