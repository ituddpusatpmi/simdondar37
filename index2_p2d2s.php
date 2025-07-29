			<font size="1"><a href="pmip2d2s.php?module=jadwal_mobile" target="isiadmin" class="fisheyeItem"><img src="images/jadwal_mobile.png" />Jadwal MU</a></font><p>
			<font size="1"><a href="pmip2d2s.php?module=mobile_app" target="isiadmin" class="fisheyeItem"><img src="images/mobile_app1.png""/>Mobile<br>App</a></font><p>
			<!--font size="1"><a href="pmip2d2s.php?module=dtd" target="isiadmin" class="fisheyeItem"><img src="images/dtd_index.png" />Door To Door</a></font><p-->
			<font size="1"><a href="pmip2d2s.php?module=rekap_transaksi_harian1" target="isiadmin" class="fisheyeItem"><img src="images/report_harian.png" />Rekap Transaksi</a></font><p>
			<font size="1"><a href="pmip2d2s.php?module=p2d2s_transaksi" target="isiadmin" class="fisheyeItem"><img src="images/stock2.png"/>Transaksi</a></font>
			<font size="1"><a href="pmip2d2s.php?module=cari_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />Cari Pendonor</a></font><p>

<?
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,1);
	if ($td0 !="M") { ?>
			<font size="1"><a href="pmip2d2s.php?module=mobile_sms" target="isiadmin" class="fisheyeItem"><img src="images/layanan_sms.png" />Layanan SMS</a></font><p>
			<font size="1"><a href="pmip2d2s.php?module=admin_wa" target="isiadmin" class="fisheyeItem"><img src="whatsapp/images/wagw.png" />WhatsApp</a></font><p>
<?}?>		
			<font size="1"><a href="pmip2d2s.php?module=mobile_cetak" target="isiadmin" class="fisheyeItem"><img src="images/print.png"/>Cetak</a></font>
			<font size="1"><a href="pmip2d2s.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmip2d2s.php?rstock=3" target="isiadmin" class="fisheyeItem"><img src="images/aftap2.png" />Check Kantong</a></font>
			<font size="1"><a href="pmip2d2s.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/change_password.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmip2d2s.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/multi.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/out.png"/>Logout</a></font>
