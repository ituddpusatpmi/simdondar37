<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
?>
<font size="4" color=red>Tunggu..... sedang menghapus data ......</b></font><br>
<?php
$run_number=$_GET['no'];
$sql=mysql_query("DELETE FROM `imltd_procleix_raw` WHERE `run_number`='$run_number'");
$sql=mysql_query("DELETE FROM `imltd_nat_lis` WHERE `runnumber`='$run_number'");
?><META http-equiv="refresh" content="3; url=../pmiimltd.php?module=import_nat_procleix_rawlist">
