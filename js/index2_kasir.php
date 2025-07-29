<?
/*$col=mysql_query("ALTER TABLE `htransaksi` CHANGE `notrans` `NoTrans` VARCHAR( 25 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '-'");*/
$sekarang=date("Y-m-d");
//mysql_query("ALTER TABLE `pendonor` CHANGE `tanggal_entry` `tanggal_entry` DATETIME NOT NULL ");
$col1=mysql_query("select `tglkembali` from pendonor where `tglkembali` like '0000%' ");if($col1){mysql_query("update pendonor set tglkembali='$sekarang' where tglkembali like '1970%' ");}
$col2=mysql_query("select `tanggal_entry` from pendonor where `tanggal_entry` like '0000%' ");if($col2)
{
mysql_query("ALTER TABLE `pendonor` CHANGE `tanggal_entry` `tanggal_entry` DATETIME NOT NULL ");
mysql_query("update pendonor set tanggal_entry=waktu_update where tanggal_entry like '0000%' ");
}

$col3=mysql_query("select `kendaraan` from htransaksi");if(!$col3){mysqL_query(" ALTER TABLE `htransaksi` 	
				ADD `kendaraan` INT( 1 ) NULL DEFAULT NULL AFTER `sisadarah` ,
				ADD `hasil_hbsag` VARCHAR( 1 ) NOT NULL DEFAULT '0' AFTER `kendaraan` ,
				ADD `hasil_hcv` VARCHAR( 1 ) NOT NULL DEFAULT '0' AFTER `hasil_hbsag` ,
				ADD `hasil_hiv` VARCHAR( 1 ) NOT NULL DEFAULT '0' AFTER `hasil_hcv` ,
				ADD `hasil_syp` VARCHAR( 1 ) NOT NULL DEFAULT '0' AFTER `hasil_hiv` ,
				ADD `hasil_nat` VARCHAR( 1 ) NOT NULL DEFAULT '0' AFTER `hasil_syp` ,
				ADD `tglperiksa` DATE NULL AFTER `hasil_nat` ");}


//mysql_query("update pendonor as p,htransaksi as h set p.tglkembali=(h.Tgl + interval 75 day) where  p.kode=h.kodependonor and h.Tgl like '2015-11-%' ");

?>


			<font size="1"><a href="pmikasir.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<!--font size="1"><a href="pmikasir.php?module=search_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />Pendonor</a></font--><p>
			<font size="1"><a href="pmikasir.php?module=cari_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />Cari Pendonor</a></font><p>

			
			<font size="1"><a href="pmikasir.php?module=aftap1" target="isiadmin" class="fisheyeItem"><img src="images/aftap6.png" />MCU &<br> Aftap</a></font><p>
<font size="1"><a href="pmikasir.php?module=sahkan_kantong" target="isiadmin" class="fisheyeItem"><img src="images/pengesahan3.png" />Pengesahan</a></font><p>
			<!--font size="1"><a href="pmikasir.php?module=searchpasien"  target="isiadmin" class="fisheyeItem"><img src="images/pasienminta.png"/>Pasien Permintaan</a></font><p-->
			
			
			<font size="1"><a href="pmikasir.php?module=double_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor21.png" />EDIT Pendonor GANDA</a></font><p>
			<font size="1"><a href="pmikasir.php?module=search_pendonor_calling" target="isiadmin" class="fisheyeItem"><img src="images/call_pendonor.png" />Donor Calling</a></font><p>
			<font size="1"><a href="pmikasir.php?module=pasien_plebotomi" target="isiadmin" class="fisheyeItem"><img src="images/pasien_plebotomi1.png" />Pasien Plebotomi</a></font><p>
			<font size="1"><a href="pmikasir.php?module=receptionis_transaksi" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png" />Transaksi</a></font>
			<font size="1"><a href="pmikasir.php?module=receptionis_cetak" target="isiadmin" class="fisheyeItem"><img src="images/print.png"/>Cetak</a></font>
			<font size="1"><a href="pmikasir.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmikasir.php?rstock=3" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check Kantong</a></font>
			<font size="1"><a href="pmikasir.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmikasir.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
