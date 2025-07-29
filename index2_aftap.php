			<font size="1"><a href="pmiaftap.php?module=serahterima" target="isiadmin" class="fisheyeItem"><img src="images/serahterima1.png" />Serah Terima Kantong</a></font>
			<font size="1"><a href="pmiaftap.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<font size="1"><a href="pmiaftap.php?module=pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor21.png" />Pendonor</a></font><p>
			<font size="1"><a href="pmiaftap.php?module=aftap1" target="isiadmin" class="fisheyeItem"><img src="images/aftap6.png" />MCU &<br>Aftap</a></font><p>
            <font size="1"><a href="aftap/aftap.php" target="_blank" class="fisheyeItem"><img src="aftap/antrian.png" />Layar<br>Antrian</a></font><p>
            <font size="1"><a href="pmiaftap.php?module=tpk_menu" target="isiadmin" class="fisheyeItem"><img src="images/apheresis.png" />Apheresis</a></font>
			<font size="1"><a href="pmiaftap.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check<br>Stok</a></font>
			<font size="1"><a href="pmiaftap.php?rstock=3" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check<br>Kantong</a></font>
			<font size="1"><a href="pmiaftap.php?module=aftap_permintaan" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png" />Transaksi</a></font>
			<font size="1"><a href="pmiaftap.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmiaftap.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
