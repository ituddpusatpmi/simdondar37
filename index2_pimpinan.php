			<font size="1"><a href="pmipimpinan.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<font size="1"><a href="pmipimpinan.php?module=rekap_permintaan" target="isiadmin" class="fisheyeItem"><img src="images/report_permintaan_darah.png" />Rekap Permintaan</a></font><p>
			<font size="1"><a href="pmipimpinan.php?module=manual" target="isiadmin" class="fisheyeItem"><img src="images/manual.png" />Manual SIMDONDAR</a></font>			
                        <font size="1"><a href="pmipimpinan.php?module=pimpinan_laporan" target="isiadmin" class="fisheyeItem"><img src="images/laporan.png" />Laporan</a></font>
            <!--font size="1"><a href="pmipimpinan.php?module=laporan_pmk" target="isiadmin" class="fisheyeItem"><img src="laporan/images/laporan-bulanan-besar.png" />Laporan PMK</a></font-->
			<font size="1"><a href="pmipimpinan.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmipimpinan.php?rstock=3" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check Kantong</a></font>
			<font size="1"><a href="pmipimpinan.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmipimpinan.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
