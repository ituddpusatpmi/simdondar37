			<font size="1"><a href="pmimonev.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<font size="1"><a href="pmimonev.php?module=search_dds" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />Pendonor</a></font><p>
			<font size="1"><a href="pmimonev.php?module=aftap1" target="isiadmin" class="fisheyeItem"><img src="images/aftap_m.png" />Aftap</a></font><p>
			<font size="1"><a href="pmimonev.php?module=double_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />EDIT Pendonor GANDA</a></font><p>
			<font size="1"><a href="pmimonev.php?module=search_pendonor_calling" target="isiadmin" class="fisheyeItem"><img src="images/call_pendonor.png" />Donor Calling</a></font><p>
			<font size="1"><a href="pmimonev.php?module=monev_transaksi" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png" />Transaksi</a></font>
			<font size="1"><a href="pmimonev.php?module=receptionis_cetak" target="isiadmin" class="fisheyeItem"><img src="images/print.png"/>Cetak</a></font>
			<font size="1"><a href="pmimonev.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmimonev.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmimonev.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
