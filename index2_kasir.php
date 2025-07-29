


			
			<font size="1"><a href="pmikasir.php?module=pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor21.png" />Pendonor</a></font><p>
			<font size="1"><a href="pmikasir.php?module=aftap1" target="isiadmin" class="fisheyeItem"><img src="images/aftap6.png" />MCU &<br> Aftap</a></font><p>
			<font size="1"><a href="pmikasir.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<font size="1"><a href="pmikasir.php?module=double_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor24.png" />EDIT Pendonor GANDA</a></font><p>
			<font size="1"><a href="pmikasir.php?module=search_pendonor_calling" target="isiadmin" class="fisheyeItem"><img src="images/call_pendonor.png" />Donor Calling</a></font><p>
			<!--font size="1"><a href="pmikasir.php?module=pasien_plebotomi" target="isiadmin" class="fisheyeItem"><img src="images/pasien_plebotomi1.png" />Pasien Plebotomi</a></font><p-->
			<font size="1"><a href="pmikasir.php?module=receptionis_transaksi" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png" />Transaksi</a></font>
            <font size="1"><a href="pmikasir.php?module=tpk_menu" target="isiadmin" class="fisheyeItem"><img src="images/apheresis.png" />Apheresis</a></font>
			<font size="1"><a href="pmikasir.php?module=receptionis_cetak" target="isiadmin" class="fisheyeItem"><img src="images/print.png"/>Cetak</a></font>
			<font size="1"><a href="pmikasir.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmikasir.php?rstock=3" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check Kantong</a></font>
			<font size="1"><a href="pmikasir.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmikasir.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
