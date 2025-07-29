			<font size="1"><a href="pmidiklat.php?module=jadwal_diklat" target="isiadmin" class="fisheyeItem"><img src="images/jadwal_mobile.png" />Jadwal MU</a></font><p>
			<font size="1"><a href="pmidiklat.php?module=rekap_transaksi_harian" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<font size="1"><a href="pmidiklat.php?module=diklat_transaksi" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png"/>Transaksi</a></font>
			<!--font size="1"><a href="pmidiklat.php?module=search_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor_m.png" />Pendonor</a></font>
			<font size="1"><a href="pmidiklat.php?module=sahkantong" target="isiadmin" class="fisheyeItem"><img src="images/update_stock.png" />Pengesahan Kantong MU</a></font><p>
			<font size="1"><a href="pmidiklat.php?module=check" target="isiadmin" class="fisheyeItem"><img src="images/medical_m.png" />Medical Checkup</a></font>
			<font size="1"><a href="pmidiklat.php?module=spengambilan" target="isiadmin" class="fisheyeItem"><img src="images/aftap_m.png" />Aftap</a></font>

			<font size="1"><a href="pmidiklat.php?module=mobile_sms" target="isiadmin" class="fisheyeItem"><img src="images/layanan_sms.png" />Layanan SMS</a></font><p>
	
			<font size="1"><a href="pmidiklat.php?module=mobile_cetak" target="isiadmin" class="fisheyeItem"><img src="images/print.png"/>Cetak</a></font-->
			<font size="1"><a href="pmidiklat.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmidiklat.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmidiklat.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti level</a></font>
<? } ?>

			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
