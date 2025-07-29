<?
include ('../config/db_connect.php');
  $no=$_GET[id];
  $kode=$_GET[Kode];
  $nama=$_GET[nama];
  $tgl=$_GET[tgl];
    $q=mysql_query("delete from `pendonor_log` WHERE `id` = '$no' ");
	
	 
	switch ($_SESSION[leveluser]){
	case "p2d2s":
            ?><META http-equiv="refresh" content="0; url=../pmip2d2s.php?module=logpendonor&Kode=<?=$kode?>&nama<?=$nama?>"><?;
            break;
	
        default:
            echo "Anda tidak memiliki hak akses";
    }?>
	

