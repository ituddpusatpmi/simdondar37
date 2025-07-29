<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$col4=mysql_query("SELECT `NoTrans` FROM `konseling`");if(!$col4){
//buat tabel konseling 
mysql_query("CREATE TABLE konseling (
  `notrans` varchar(20) NOT NULL DEFAULT '',
  `kodependonor` varchar(25) DEFAULT NULL,
  `kodependonor_lama` varchar(15) DEFAULT NULL,
  `tgl` DATETIME DEFAULT NULL,
  `parameter` char( 1) DEFAULT '0' COMMENT '0=HBsAg 1=HCV 2=HIV 3=SHYPILIS',
  `nilai` VARCHAR( 6) DEFAULT NULL,
  `hasil` char( 1) NOT NULL DEFAULT '0' COMMENT '0=Dirujuk 1=DiberikanObat 2=Konsul',
  `ket` text DEFAULT NULL,
  `petugas` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`NoTrans`))");}

?>

			<font size="1"><a href="pmikonseling.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>			
			<font size="1"><a href="pmikonseling.php?module=search_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />Pendonor</a></font><p>			
			<font size="1"><a href="pmikonseling.php?module=konseling_ujisaring" target="isiadmin" class="fisheyeItem"><img src="images/imltd1.png" />IMLTD</a></font><p>
			<font size="1"><a href="pmikonseling.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmikonseling.php?rstock=3" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check Kantong</a></font>
			<font size="1"><a href="pmikonseling.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmikonseling.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
