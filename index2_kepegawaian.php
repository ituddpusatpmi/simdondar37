			<font size="1"><a href="pmikepegawaian.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Laporan</a></font><p>
			<font size="1"><a href="pmikepegawaian.php?module=search_kepeg" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />Karyawan</a></font><p>

		<!--font size="1"><a href="pmikepegawaian.php?module=aftap1" target="isiadmin" class="fisheyeItem"><img src="images/aftap_m.png" />Aftap</a></font><p>

			<font size="1"><a href="pmikepegawaian.php?module=double_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />EDIT Pendonor GANDA</a></font><p>
			<font size="1"><a href="pmikepegawaian.php?module=receptionis_cetak" target="isiadmin" class="fisheyeItem"><img src="images/print.png"/>Cetak</a></font>
<font size="1"><a href="pmikepegawaian.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmikepegawaian.php?module=search_pendonor_calling" target="isiadmin" class="fisheyeItem"><img src="images/call_pendonor.png" />Donor Calling</a></font><p-->
			<font size="1"><a href="pmikepegawaian.php?module=kepeg_transaksi" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png" />Transaksi</a></font>
			
			
			<font size="1"><a href="pmikepegawaian.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmikepegawaian.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
<?
			mysql_query("update pegawai set kgb1=(kgb + interval 2 year)");
			mysql_query("update pegawai set kp1=(kp + interval 4 year)");
			mysql_query("update pegawai set tglpensiun=(tglLhr + interval 56 year)");
			mysql_query("UPDATE pegawai set umur=(TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25");
			mysql_query("UPDATE pegawai set masakerja=(TO_DAYS(NOW())- TO_DAYS(tmt)) / 365.25");
			mysql_query("UPDATE keluarga set umur=(TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25");
			mysql_query("update keluarga set tunjangan='1' where Status='0' and umur > '25' and keluarga like 'A%'");
			mysql_query("update keluarga set tunjangan='1' where Status > '2'");
			mysql_query("update keluarga set tunjangan='1' where (keluarga='sk' or keluarga='ik'");

?>
