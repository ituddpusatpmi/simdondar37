			<!--font size="1"><a href="pmiimltd.php?module=search_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />Pendonor</a></font><p-->			
			
			<!--font size="1"><a href="pmiimltd.php?module=rekap_darah_titip" target="isiadmin" class="fisheyeItem"><img src="images/report_permintaan_darah.png" />Darah Titipan</a></font><p-->
			<font size="1"><a href="pmiimltd.php?module=laborat_ujisaring" target="isiadmin" class="fisheyeItem"><img src="images/imltd1.png" />IMLTD MANUAL</a></font><p>
			<font size="1"><a href="pmiimltd.php?module=import" target="isiadmin" class="fisheyeItem"><img src="images/imltd3.png" />IMLTD KONEKSI ALAT</a></font><p>
			<font size="1"><a href="pmiimltd.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<!--font size="1"><a href="pmiimltd.php?module=laborat_konfirmasi" target="isiadmin" class="fisheyeItem"><img src="images/konfirmasi_gol_darah.png" />Konfirmasi Gol. Darah</a></font><p>
			<font size="1"><a href="pmiimltd.php?module=laborat_komponen" target="isiadmin" class="fisheyeItem"><img src="images/update_stock.png" />Pembuatan Komponen</a></font><p>
			<font size="1"><a href="pmiimltd.php?module=laborat_distribusi" target="isiadmin" class="fisheyeItem"><img src="images/distribusi_darah.png" />Distribusi Darah</a></font-->
			<font size="1"><a href="pmiimltd.php?module=imltd_laporan" target="isiadmin" class="fisheyeItem"><img src="images/laporan.png" />Laporan</a></font>
			<font size="1"><a href="pmiimltd.php?module=imltd_permintaan" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png" />Permintaan Brg Lab</a></font>
			<font size="1"><a href="pmiimltd.php?rstock=2" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check Kantong</a></font>
			<font size="1"><a href="pmiimltd.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmiimltd.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
