			<font size="1"><a href="pmisaranaprasarana.php?module=logistik1" target="isiadmin" class="fisheyeItem"><img src="images/logistik1.png" />Logistik</a></font><p>
			<font size="1"><a href="pmisaranaprasarana.php?module=logistik2" target="isiadmin" class="fisheyeItem"><img src="images/master_logistik.png" />Transaksi</a></font><p>
			<font size="1"><a href="pmisaranaprasarana.php?module=logistik3" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap</a></font><p>
			<font size="1"><a href="pmisaranaprasarana.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmisaranaprasarana.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmisaranaprasarana.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
