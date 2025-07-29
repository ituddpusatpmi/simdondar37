<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
?>
<font size="6" color=red>Tunggu..... sedang menghapus data transaksi <?=$_GET['no'];?></b></font><br>
<?php
$notransaksi=$_GET['no'];
$sql=mysql_query("DELETE FROM `liason2021` WHERE `run_time`='$notransaksi'");
?><META http-equiv="refresh" content="1; url=../pmiimltd.php?module=import_liasonxl_raw">
