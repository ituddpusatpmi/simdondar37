		<font size="1"><a href="pmitatausaha.php?module=profile" target="isiadmin" class="fisheyeItem"><img src="images/input_profile.png"/>Pendataan</a></font><p>
        <font size="1"><a href="pmitatausaha.php?module=laporan" target="isiadmin" class="fisheyeItem"><img src="images/report2.png"/>Laporan</a></font>
        <font size="1"><a href="pmitatausaha.php?module=upload" target="isiadmin" class="fisheyeItem"><img src="images/upload_lap1.png"/>Kirim Laporan</a></font>
        <font size="1"><a href="pmitatausaha.php?module=cek_laporan" target="isiadmin" class="fisheyeItem"><img src="images/download_lap.png"/>Cek Laporan</a></font>
        <font size="1"><a href="pmitatausaha.php?module=statistik" target="isiadmin" class="fisheyeItem"><img src="images/statistic1.png"/>Statistik</a></font>
		<font size="1"><a href="pmitatausaha.php?module=komponen_musnah" target="isiadmin" class="fisheyeItem"><img src="musnah/images/musnah_icon.png" />Pemusnahan Produk</a></font>
		<font size="1"><a href="pmitatausaha.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png"/>Check Stok</a></font>
		<font size="1"><a href="pmitatausaha.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
		<font size="1"><a href="pmitatausaha.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
		<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
