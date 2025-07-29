			<font size="1"><a href="pmikeuangan.php?module=keuangan1" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Transaksi</a></font><p>
			<font size="1"><a href="pmikeuangan.php?module=keuangan2" target="isiadmin" class="fisheyeItem"><img src="images/home1.png"/>Laporan</a></font>
			<font size="1"><a href="pmikeuangan.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmikeuangan.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmikeuangan.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
