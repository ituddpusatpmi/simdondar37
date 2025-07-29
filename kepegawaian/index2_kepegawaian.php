			<font size="1"><a href="pmikepegawaian.php?module=rekap" target="isiadmin" class="fisheyeItem"><img src="images/laporan_karyawan.png" />Laporan</a></font><p>
			<font size="1"><a href="pmikepegawaian.php?module=search_kepeg_kontrak" target="isiadmin" class="fisheyeItem"><img src="images/pendonor_m.png" />Karyawan Kontrak</a></font><p>			
			<font size="1"><a href="pmikepegawaian.php?module=search_kepeg" target="isiadmin" class="fisheyeItem"><img src="images/karyawan2.png" />Karyawan</a></font><p>
			

		<!--font size="1"><a href="pmikepegawaian.php?module=aftap1" target="isiadmin" class="fisheyeItem"><img src="images/aftap_m.png" />Aftap</a></font><p>

			<font size="1"><a href="pmikepegawaian.php?module=double_pendonor" target="isiadmin" class="fisheyeItem"><img src="images/pendonor2.png" />EDIT Pendonor GANDA</a></font><p>
			<font size="1"><a href="pmikepegawaian.php?module=receptionis_cetak" target="isiadmin" class="fisheyeItem"><img src="images/print.png"/>Cetak</a></font>
<font size="1"><a href="pmikepegawaian.php?rstock=1" target="isiadmin" class="fisheyeItem"><img src="images/stok.png" />Check Stok</a></font>
			<font size="1"><a href="pmikepegawaian.php?module=search_pendonor_calling" target="isiadmin" class="fisheyeItem"><img src="images/call_pendonor.png" />Donor Calling</a></font><p-->
			<font size="1"><a href="pmikepegawaian.php?module=kepeg_transaksi" target="isiadmin" class="fisheyeItem"><img src="images/lap_karyawan1.png" />Transaksi</a></font>
			
			
			<font size="1"><a href="pmikepegawaian.php?module=ganti_passwd&act=edituser&id=<?=$_SESSION['namauser']?>" target="isiadmin" class="fisheyeItem"><img src="images/profil_kepeg1.png" />Edit Profil</a></font>
<? if ($_SESSION[multilevel]!='') { ?>
			<font size="1"><a href="pmikepegawaian.php?module=ganti_menu" target="isiadmin" class="fisheyeItem"><img src="images/gantilevel_peg.png" />Ganti Level</a></font>
<? } ?>
			<font size="1"><a href="javascript:logout();" class="fisheyeItem"><img src="images/logout_kepeg.png"/>Logout</a></font>
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

		//update kgb rapel
		mysql_query("UPDATE kgbpeg set jmlbulanrapel=ceil(((TO_DAYS(tglakhirrapel)- TO_DAYS(tglawalrapel)) / 365.25)*12)");
		mysql_query("UPDATE kgbpeg set nilairapel=(gajibaru - gajilama)");
		mysql_query("UPDATE kgbpeg set jmlrapel=(jmlbulanrapel*nilairapel)");

		//update kp rapel
		mysql_query("UPDATE kppeg set jmlbulanrapel=ceil(((TO_DAYS(tglakhirrapel)- TO_DAYS(tglawalrapel)) / 365.25)*12)");
		mysql_query("UPDATE kppeg set nilairapel=(gajibaru - gajilama)");
		mysql_query("UPDATE kppeg set jmlrapel=(jmlbulanrapel*nilairapel)");
			
		//update maksimal pangkat karyawan
			//$golongan=mysql_fetch_assoc(mysql_query("select * from golonganpeg"));
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='5' and p.ijasah='SD'  and statuspeg != '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='7' and p.ijasah='SMP' and statuspeg != '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='9' and p.ijasah='SMA' and statuspeg != '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='11' and (p.ijasah='D1' or p.ijasah='D2') and statuspeg != '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='12' and p.ijasah='D3' and statuspeg != '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='13' and p.ijasah='S1' and statuspeg != '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='14' and p.ijasah='S2' and statuspeg != '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='15' and p.ijasah='S3' and statuspeg != '3' ");

			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='5' and p.ijasah='SD'  and statuspeg = '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='7' and p.ijasah='SMP' and statuspeg = '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='9' and p.ijasah='SMA' and statuspeg = '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='11' and (p.ijasah='D1' or p.ijasah='D2') and statuspeg = '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='12' and p.ijasah='D3' and statuspeg = '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='13' and p.ijasah='S1' and statuspeg = '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='14' and p.ijasah='S2' and statuspeg = '3' ");
			mysql_query("update pegawai as p,golonganpeg as g set p.golmaks=g.golongan where g.id='15' and p.ijasah='S3' and statuspeg = '3' ");




?>
