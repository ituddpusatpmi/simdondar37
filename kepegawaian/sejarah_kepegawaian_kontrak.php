		<?
		$data31=mysql_query("select * from pegawai_kontrak where Kode='$_GET[kode]'");
		$data3=mysql_fetch_assoc($data31);		
		?>
<table>
<h2>BIODATA KARYAWAN</h2>
</table>
<table>
<tr><td>NIK</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[Kode]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Pendidikan</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[ijasah]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Tgl KGB Terakhir</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[kgb]?></td></tr>
<tr><td>Nama</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[Nama]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Golongan</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[golongan]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Tgl KP Terakhir</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[kp]?></td></tr></h3>
<tr><td>Tempat Lahir</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[TempatLhr]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Jabatan</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[jabatan]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Tgl KGB Berikutnya</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[kgb1]?></td></tr></h3>
<?
if($data3[Jk]=="0"){$jk="Laki-laki";}else{$jk="Perempuan";}

					if($data3[Status]=='0'){
						$jk1="Bujang";
					}else if($data3[Status]=='1'){
						$jk1="Menikah";
					}else if($data3[Status]=='5'){
						$jk1="Istri Karyawan";
					}else if($data3[Status]=='3'){
						$jk1="Janda";
					}else if($data3[Status]=='4'){
						$jk1="Suami Karyawan";
					}else if($data3[Status]=='2'){
						$jk1="Duda";
					}else{
						$jk1="tidak jelas";
					}




					if($data3[statuspeg]=='2'){
						$statuspeg="Capeg 80%";
					}else if($data3[statuspeg]=='1'){
						$statuspeg="Kontrak";
					}else if($data3[statuspeg]=='0'){
						$statuspeg="Kontrak";}



?>
<tr><td>Tgl Lahir</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[TglLhr]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Status Karyawan</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$statuspeg?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Tgl KP berikutnya</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[kp1]?></td></tr></h3>
<tr><td>Jenis Kelamin</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$jk?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Umur</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[umur]?> Tahun</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Tgl Pensiun</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[tglpensiun]?></td></tr></h3>
<tr><td>Status Pernikahan</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$jk1?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>TMT</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[tmt]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Masa Kerja</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[masakerja]?> Tahun</td></tr></h3>
</table>

<!--Data Keluarga-->
<?
$klrg=mysql_query("select * from keluargapeg where nik='$data3[Kode]' order by notrans ASC");
?>
<table>
<h3 class="list">Jumlah Keluarga :  <?=mysql_num_rows($klrg)?>  Orang</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Notrans</td>
		<td>NO KTP</td>
		<td>Nama</td>
		<td>Alamat</td>
		<td>JK</td>
		<td>Tpt Lhr</td>
		<td>Tgl Lhr</td>
		<td>Status</td>	
		<td>Umur</td>
		<td>Pendidikan</td>
		<td>Tunjangan</td>
		<td>Status Klrg</td>
		<td>Pekerjaan</td>
		<td>Petugas</td>
		<td>Tanggal Input</td>
		</tr>

	<?
	$no1=0;
	


	while ($klrg1=mysql_fetch_assoc($klrg)) { 
	$no1++;
	


	?>

		<tr class="record">
		<td><?=$no1?></td>
		<td><?=$klrg1[notrans]?></td>
		<td><?=$klrg1[NoKTP]?></td>
		<td><?=$klrg1[Nama]?></td>
		<td><?=$klrg1[Alamat]?></td>
		<?
		if ($klrg1[Jk]=='0') $jk1="Laki-laki";
		$jk1="Perempuan";
		?>
		<td> <?=$jk1?></td>
		<td><?=$klrg1[TempatLhr]?></td>
		<td><?=$klrg1[TglLhr]?></td>

		<?
		if($klrg1[Status]=="0")$status1="Menikah";
		if($klrg1[Status]=="1")$status1="Sekolah/Kuliah";
		if($klrg1[Status]=="2")$status1="Bekerja";
		if($klrg1[Status]=="3")$status1="Cerai";
		if($klrg1[Status]=="4")$status1="Meninggal";
		
		?>

		<td><?=$status1?></td>
		<td><?=$klrg1[umur]?> Tahun</td>
		<td><?=$klrg1[ijasah]?></td>
		<?
		
		if($klrg1[tunjangan]=='0'){$tunjangan='Ya';}else{$tunjangan='Tidak';}
		
		?>

		<td><?=$tunjangan?></td>
		<?
		if($klrg1[keluarga]=="i")$keluarga="Istri";
		if($klrg1[keluarga]=="s")$keluarga="Suami";
		if($klrg1[keluarga]=="a1")$keluarga="Anak Ke-1";
		if($klrg1[keluarga]=="a2")$keluarga="Anak Ke-2";
		?>
		<td><?=$keluarga?></td>
		<td><?=$klrg1[pekerjaan]?></td>
		<td><?=$klrg1[pencatat]?></td>
		<td><?=$klrg1[tanggal_entry]?></td>
		</tr>
	 <?}?> 
</table>






<!--data KGB-->
<?
$data=mysql_query("select * from kgbpeg where nik='$data3[Kode]' order by notrans ASC");
?>

<h3 class="list">History KGB :  <?=mysql_num_rows($data)?>  Kali</h3>

<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Notrans</td>
		<td>Tgl Diajukan</td>
		<td>Tgl SK</td>
		<td>No SK</td>
		<td>Status Pengajuan</td>
		<td>Gaji Lama</td>
		<td>Gaji Baru</td>
		<td>Pendidikan</td>	
		<td>Golongan</td>
		<td>Jabatan</td>
		<td>Masa Kerja</td>
		<td>Petugas Catat</td>
		<td>Tanggal Catat</td>
		<td>Lama Proses</td>
		</tr>

	<?
	$no=0;
	


	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
	


	?>

		<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[notrans]?></td>
		<td><?=$data1[tglajukan]?></td>
		<td><?=$data1[tglsk]?></td>
		<td><?=$data1[nosk]?></td>
		<?
		if ($data1[Status]=='0') $stat="Diajukan";
		if ($data1[Status]=='1') $stat="Di Proses";
		$stat="Selesai";
		?>
		<td> <?=$stat?></td>
		<td><?=$data1[gajilama]?></td>
		<td><?=$data1[gajibaru]?></td>
		<td><?=$data1[ijasah]?></td>
		<td><?=$data1[golongan]?></td>
		<td><?=$data1[jabatan]?></td>
		<td><?=$data1[masakerja]?> Th</td>
		<td><?=$data1[pencatat]?></td>
		<td><?=$data1[tanggal_entry]?></td>
		<td><?=$data1[lamaproses]?> Hari</td>
		</tr>
	 <?}?> 
</table>

<!--Sejarah KP-->

<?
$pangkat=mysql_query("select * from kppeg where nik='$data3[Kode]' order by notrans ASC");
?>
<table>
<h3 class="list">History KP :  <?=mysql_num_rows($pangkat)?>  Kali</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Notrans</td>
		<td>Tgl Diajukan</td>
		<td>Tgl SK</td>
		<td>No SK</td>
		<td>Status<br>Pengajuan</td>
		<td>Gol Lama</td>
		<td>gol Baru</td>
		<td>Pendidikan</td>	
		<td>Jabatan</td>
		<td>masa kerja</td>
		<td>Petugas Catat</td>
		<td>Tanggal Catat</td>
		<td>Lama Proses</td>
		</tr>

	<?
	$no=0;
	


	while ($pangkat1=mysql_fetch_assoc($pangkat)) { 
	$no++;
	


	?>

		<tr class="record">
		<td><?=$no?></td>
		<td><?=$pangkat1[notrans]?></td>
		<td><?=$pangkat1[tglajukan]?></td>
		<td><?=$pangkat1[tglsk]?></td>
		<td><?=$pangkat1[nosk]?></td>
		<?
		if ($pangkat1[Status]=='0') $stat="Diajukan";
		if ($pangkat1[Status]=='1') $stat="Di Proses";
		$stat="Selesai";
		?>
		<td> <?=$stat?></td>
		<td><?=$pangkat1[gollama]?></td>
		<td><?=$pangkat1[golbaru]?></td>
		<td><?=$pangkat1[ijasah]?></td>
		<td><?=$pangkat1[jabatan]?></td>
		<td><?=$pangkat1[masakerja]?> Th</td>
		<td><?=$pangkat1[pencatat]?></td>
		<td><?=$pangkat1[tanggal_entry]?></td>
		<td><?=$pangkat1[lamaproses]?> Hari</td>
		</tr>
	 <?}?> 
</table>

<!--Sejarah DIKLAT-->

<?
$diklat=mysql_query("select * from diklatpeg where nik='$data3[Kode]' order by notrans ASC");
?>
<table>
<h3 class="list">History DIKLAT :  <?=mysql_num_rows($diklat)?>  Kali</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td rowspan='2'>No</td>
		<td rowspan='2'>Notrans</td>
		<td rowspan='2'>Masa Kerja</td>
		<td rowspan='2'>Nama Diklat</td>
		<td rowspan='2'>Jenis Diklat</td>
		<td rowspan='2'>Penyelenggara</td>
		<td rowspan='2'>Tempat</td>
		<td colspan='2'>Tanggal</td>
		<td rowspan='2'>Lama Diklat</td>	
		<td rowspan='2'>Status</td>
		<td rowspan='2'>Sertifikat</td>
		<td rowspan='2'>No Sertifikat</td>
		<td colspan='2'>biaya</td>
		<td rowspan='2'>Sponsor</td>
		<td rowspan='2'>Petugas Input</td>
		<td rowspan='2'>Tanggal Input</td>
		</tr>
	<tr class="field">
		<td>dari</td>
		<td>Sampai</td>
		<td>Jumlah</td>
		<td>Penanggung</td>
		</tr>
	<?
	$no=0;
	


	while ($diklat1=mysql_fetch_assoc($diklat)) { 
	$no++;
	


	?>

		<tr class="record">
		<td><?=$no?></td>
		<td><?=$diklat1[notrans]?></td>
		<td><?=$diklat1[masakerja]?> Th</td>
		<td><?=$diklat1[Nama]?></td>
		<?
		$jenis="Pendidikan";
		if ($diklat1[jenis]=='1') $jenis="Pelatihan";
		if ($diklat1[jenis]=='2') $jenis="Workshop";
		if ($diklat1[jenis]=='3') $jenis="Seminar";
		?>
		<td><?=$jenis?></td>
		<td><?=$diklat1[penyelenggara]?></td>
		<td><?=$diklat1[tempat]?></td>
		<td><?=$diklat1[tglawal]?></td>
		<td><?=$diklat1[tglakhir]?></td>
		<td><?=$diklat1[masadiklat]?> Hari</td>
		<?
		$stat2="Tidak Lulus";
		if ($diklat1[Status]=='0') $stat2="Lulus";
		if ($diklat1[Status]=='1') $stat2="Lulus Bersyarat";
		?>
		<td><?=$stat2?></td>

		<?
		$sertifikat="Ada";
		if ($diklat1[sertifikat]=='1') $sertifikat="Tidak Ada";
		?>
		<td><?=$sertifikat?></td>
		<td><?=$diklat1[nosertifikat]?></td>
		<td><?=$diklat1[jumbiaya]?></td>
		<?
		$biaya="UDDP";
		if ($diklat1[biaya]=='1') $stat2="Pribadi";
		if ($diklat1[biaya]=='2') $stat2="Sponsor";
		?>
		<td><?=$biaya?></td>
		<td><?=$diklat1[sponsor]?></td>
		<td><?=$diklat1[pencatat]?></td>
		<td><?=$diklat1[tanggal_entry]?></td>
		</tr>
	 <?}?> 
</table>

<!--Sejarah TUGAS-->

<?
$tugas=mysql_query("select * from tugaspeg where nik='$data3[Kode]' order by notrans ASC");
?>
<table>
<h3 class="list">History TUGAS :  <?=mysql_num_rows($tugas)?>  Kali</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td rowspan='2'>No</td>
		<td rowspan='2'>Notrans</td>
		<td rowspan='2'>Masa Kerja</td>
		<td rowspan='2'>Nama Tugas</td>
		<td rowspan='2'>Jenis Tugas</td>
		<td rowspan='2'>Penyelenggara</td>
		<td rowspan='2'>Tempat</td>
		<td colspan='2'>Tanggal</td>
		<td rowspan='2'>Lama Diklat</td>	
		<td rowspan='2'>Status</td>
		<td colspan='2'>Kendaraan</td>
		<td colspan='2'>Surat tugas</td>
		<td colspan='2'>Biaya</td>
		<td rowspan='2'>Sponsor</td>
		<td rowspan='2'>Petugas Input</td>
		<td rowspan='2'>Tanggal Input</td>
		</tr>
	<tr class="field">
		<td>dari</td>
		<td>Sampai</td>
		<td>Pribadi/Umum</td>
		<td>Jenis</td>
		<td>Tanggal</td>
		<td>Nomor</td>
		<td>Jumlah</td>
		<td>Ditanggung</td>
		</tr>
	<?
	$no=0;
	


	while ($tugas1=mysql_fetch_assoc($tugas)) { 
	$no++;
	


	?>

		<tr class="record">
		<td><?=$no?></td>
		<td><?=$tugas1[notrans]?></td>
		<td><?=$tugas1[masakerja]?> Th</td>
		<td><?=$tugas1[Nama]?></td>	
		<?
		$jenistugas="Pembinaan";
		if ($tugas1[jenis]=='1') $jenistugas="MONEV";
		if ($tugas1[jenis]=='2') $jenistugas="Workshop";
		if ($tugas1[jenis]=='3') $jenistugas="Undangan Rapat";
		if ($tugas1[jenis]=='4') $jenistugas="Pelayanan";
		?>	
		<td><?=$jenistugas?></td>
		<td><?=$tugas1[penyelenggara]?></td>
		<td><?=$tugas1[tempat]?></td>
		<td><?=$tugas1[tglawal]?></td>
		<td><?=$tugas1[tglakhir]?></td>
		<td><?=$tugas1[masadiklat]?> Hari</td>
		<?
		$stat2="Tidak Selesai";
		if ($tugas1[Status]=='0') $stat2="Selesai";
		if ($tugas1[Status]=='1') $stat2="Selesai dg catatan";

		if ($tugas1[kendaraan]=='0') $kendaraan="Pribadi";
		if ($tugas1[kendaraan]=='1') $kendaraan="Umum";


		if ($tugas1[jnskendaraan]=='0') $jeniskendaraan="Kend. Roda 4";
		if ($tugas1[jnskendaraan]=='1') $jeniskendaraan="Pesawat";
		if ($tugas1[jnskendaraan]=='2') $jeniskendaraan="Kereta Api";
		if ($tugas1[jnskendaraan]=='3') $jeniskendaraan="Bus";
		if ($tugas1[jnskendaraan]=='4') $jeniskendaraan="Kapal Laut";
		if ($tugas1[jnskendaraan]=='5') $jeniskendaraan="Lain-lain";
	
		if ($tugas1[biaya]=='0') $biaya1="UDDP";
		if ($tugas1[biaya]=='1') $biaya1="UDD CABANG";
		if ($tugas1[biaya]=='2') $biaya1="PRIBADI";
		if ($tugas1[biaya]=='3') $biaya1="SPONSOR";

		
		?>
		<td> <?=$stat2?></td>
		<td><?=$kendaraan?></td>
		<td><?=$jeniskendaraan?></td>
		<td><?=$tugas1[tglsertifikat]?></td>
		<td><?=$tugas1[nosertifikat]?></td>
		<td><?=$tugas1[jumbiaya]?></td>
		<td><?=$biaya1?></td>
		<td><?=$tugas1[sponsor]?></td>
		<td><?=$tugas1[pencatat]?></td>
		<td><?=$tugas1[tanggal_entry]?></td>
		</tr>
	 <?}?> 
</table>

<!--Sejarah Penghargaan-->

<?
$piagam=mysql_query("select * from penghargaanpeg where nik='$data3[Kode]' order by notrans ASC");
?>
<table>
<h3 class="list">History PENGHARGAAN :  <?=mysql_num_rows($piagam)?>  Kali</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td rowspan='2'>No</td>
		<td rowspan='2'>Notrans</td>
		<td rowspan='2'>Nama Penghargaan</td>		
		<td rowspan='2'>Masa Kerja</td>
		<td rowspan='2'>Jabatan</td>
		<td rowspan='2'>No Penghargaan</td>
		<td colspan='2'>Tanggal</td>
		<td rowspan='2'>Lama<br>Proses</td>	
		<td rowspan='2'>Status</td>
		<td rowspan='2'>Keterangan</td>
		<td rowspan='2'>Pencatat</td>
		<td rowspan='2'>Tgl Entry</td>
		
		</tr>
	<tr class="field">
		<td>pengajuan</td>
		<td>Penghargaan</td>
		</tr>
	<?
	$no=0;
	


	while ($piagam1=mysql_fetch_assoc($piagam)) { 
	$no++;

	?>
		<tr class="record">
		<td><?=$no?></td>
		<td><?=$piagam1[notrans]?></td>	
		<?
		$jenispiagam="Pembinaan";
		if ($piagam1[jenis]=='1') $jenispiagam="Penghargaan 10 Tahun";
		if ($piagam1[jenis]=='2') $jenispiagam="Penghargaan 20 Tahun";
		if ($piagam1[jenis]=='3') $jenispiagam="Penghargaan 30 Tahun";
		if ($piagam1[jenis]=='4') $jenispiagam="Penghargaan Purnatugas";
		?>	
		<td align='left'><?=$jenispiagam?></td>
		<td><?=$piagam1[masakerja]?> Th</td>
		<td><?=$piagam1[jabatan]?></td>
		<td><?=$piagam1[nosk]?></td>
		<td><?=$piagam1[tglajukan]?></td>
		<td><?=$piagam1[tglsk]?></td>
		<td align='right'><?=$piagam1[lamaproses]?> Hari</td>
		<?
		$stat3="Selesai";
		if ($piagam1[Status]=='0') $stat3="Diajukan";
		if ($piagam1[Status]=='1') $stat3="Menunggu Proses";		
		?>
		<td> <?=$stat3?></td>
		<td align='left'><?=$piagam1[ket]?></td>
		<td><?=$piagam1[pencatat]?></td>
		<td><?=$piagam1[tanggal_entry]?></td>
		</tr>
	 <?}?> 
</table>

<!--Sejarah MUTASI-->

<?
$mutasi=mysql_query("select * from mutasipeg where nik='$data3[Kode]' order by notrans ASC");
?>
<table>
<h3 class="list">History MUTASI Bagian :  <?=mysql_num_rows($mutasi)?>  Kali</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Notrans</td>
		<td>Kategori</td>
		<td>Tgl Diajukan</td>
		<td>Tgl SK</td>
		<td>No SK</td>
		<td>Status Pengajuan</td>
		<td>Bagian Lama</td>
		<td>Bagian Baru</td>
		<td>Pendidikan</td>	
		<td>Golongan</td>
		<td>Jabatan</td>
		<td>Masa Kerja</td>
		<td>Petugas Catat</td>
		<td>Tanggal Catat</td>
		<td>Lama Proses</td>
		</tr>

	<?
	$no=0;
	


	while ($mutasi1=mysql_fetch_assoc($mutasi)) { 
	$no++;
	


	?>

		<tr class="record">
		<td><?=$no?></td>
		<td><?=$mutasi1[notrans]?></td>
		<?
		$alasan="Dismosi";
		if ($mutasi1[alasan]=='0') $alasan="Rotasi";
		if ($mutasi1[alasan]=='1') $alasan="Promosi";
		
		?>
		<td><?=$alasan?></td>
		<td><?=$mutasi1[tglajukan]?></td>
		<td><?=$mutasi1[tglsk]?></td>
		<td><?=$mutasi1[nosk]?></td>
		<?
		$stat="Selesai";
		if ($mutasi1[Status]=='0') $stat="Diajukan";
		if ($mutasi1[Status]=='1') $stat="Di Proses";
		
		?>
		<td> <?=$stat?></td>
		
		<?$bagian1=mysql_fetch_assoc(mysql_query("select nama from bagianpeg where kode='$mutasi1[bagianlama]'"));
			$bagian=mysql_fetch_assoc(mysql_query("select nama from bagianpeg where kode='$mutasi1[bagianbaru]'"));		
		
		?>
		
		<td><?=$bagian1[nama]?></td>
		<td><?=$bagian[nama]?></td>
		<td><?=$mutasi1[ijasah]?></td>
		<td><?=$mutasi1[golongan]?></td>
		<td><?=$mutasi1[jabatan]?></td>
		<td><?=$mutasi1[masakerja]?> Th</td>
		<td><?=$mutasi1[pencatat]?></td>
		<td><?=$mutasi1[tanggal_entry]?></td>
		<td><?=$mutasi1[lamaproses]?> Hari</td>
		</tr>
	 <?}?> 
</table>

<!--Sejarah DP2-->

<?
$dpp1=mysql_query("select * from dpppeg where nikpeg='$data3[Kode]' order by tglawal ASC");
?>
<table>
<h3 class="list">History DP2  :  <?=mysql_num_rows($dpp1)?>  Kali</h3>
</table>
<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td rowspan='2'>No</td>
		<td colspan='2'>Tgl Penilaian</td>
		<td colspan='5'>Data Penilai</td>
		<td colspan='5'>Data Atasan Penilai</td>
		<td colspan='9'> Unsur Penilaian</td>
		<td rowspan='2'>keberatan <br> Karyawan</td>
		<td rowspan='2'>Tanggapan <br> Penilai</td>
		<td rowspan='2'>Keputusan <br> Atasan</td>	
		<td rowspan='2'>Ket. <br>Lain-lain</td>
		<td colspan='3'>Tanggal</td>
		<td colspan='2'>Input</td>
		
		</tr>
		<tr class="field">
		<td>Dari</td>
		<td>Sampai</td>
		<td>NIK</td>
		<td>Nama</td>
		<td>Pangkat/<br>Golongan</td>
		<td>Jabatan</td>
		<td>Direktorat</td>
		<td>NIK</td>
		<td>Nama</td>
		<td>Pangkat/<br>Golongan</td>
		<td>Jabatan</td>
		<td>Direktorat</td>
		<td>Tanggung Jawab</td>
		<td>Ketaatan</td>
		<td>Kejujuran</td>
		<td>Kerjasama</td>
		<td>Prakarsa</td>
		<td>Kepemimpinan</td>
		<td>Jumlah</td>	
		<td>Rata-rata</td>
		<td>Kesimpulan</td>
		<td>Terima Kary.</td>
		<td>Dibuat Penilai</td>
		<td>Terima Atasan</td>
		<td>Tanggal</td>
		<td>Petugas</td>		
		
		</tr>

	<?
	$no=0;
	


	while ($dpp=mysql_fetch_assoc($dpp1)) { 
	$no++;
	


	?>

		<tr class="record">
		<td><?=$no?></td>
		<td><?=$dpp[tglawal]?></td>
		<td><?=$dpp[tglakhir]?></td>
		<?
		$pen1=mysql_query("SELECT * from pegawai where Kode='$dpp[nikpenilai]'");
		$pen=mysql_fetch_assoc($pen1);
		?>
		<td><?=$dpp[nikpenilai]?></td>
		<td><?=$pen[Nama]?></td>
		<td><?=$pen[golongan]?></td>
		<td><?=$pen[jabatan]?></td>
		<?
		$dirpen=mysql_fetch_assoc(mysql_query("select nama from direktoratpeg where kode='$pen[direktorat]'"));

		?>
		<td><?=$dirpen[nama]?></td>

		<?
		$ata1=mysql_query("SELECT * from pegawai where Kode='$dpp[nikatasan]'");
		$ata=mysql_fetch_assoc($ata1);
		?>
		<td><?=$dpp[nikatasan]?></td>
		<td><?=$ata[Nama]?></td>
		<td><?=$ata[golongan]?></td>
		<td><?=$ata[jabatan]?></td>
		<?
		$dirata=mysql_fetch_assoc(mysql_query("select nama from direktoratpeg where kode='$ata[direktorat]'"));

		?>
		<td><?=$dirata[nama]?></td>
		<td><?=$dpp[tanggungjawab]?></td>
		<td><?=$dpp[ketaatan]?></td>
		<td><?=$dpp[kejujuran]?></td>
		<td><?=$dpp[kerjasama]?></td>
		<td><?=$dpp[prakarsa]?></td>
		<td><?=$$dpp[kepemimpinan]?></td>
		
		<td><?=$dpp[jumlahstaff]?></td>
		<td><?=$dpp[rataratastaff]?></td>
		<?
		if ($dpp[rataratastaff]>'0.0'  and $dpp[rataratastaff]<='50.0') $kesimpulan="Buruk";
		if ($dpp[rataratastaff]>'50.0' and $dpp[rataratastaff]<='60.0') $kesimpulan="Kurang";
		if ($dpp[rataratastaff]>'60.0' and $dpp[rataratastaff]<='75.0') $kesimpulan="Cukup";
		if ($dpp[rataratastaff]>'75.0' and $dpp[rataratastaff]<='90.0') $kesimpulan="Baik";
		if ($dpp[rataratastaff]>'90.0' and $dpp[rataratastaff]<='100.0') $kesimpulan="Sangat Baik";
		?>
		<td><?=$kesimpulan?></td>
		<td><?=$dpp[keberatan]?></td>
		<td><?=$dpp[tanggapan]?></td>
		<td><?=$dpp[keputusan]?></td>
		<td><?=$dpp[keterangan]?></td>
		<td><?=$dpp[tglterima]?></td>
		<td><?=$dpp[tgldibuat]?></td>
		<td><?=$dpp[tglterimaatasan]?></td>
		<td><?=$dpp[tanggal_entry]?></td>
		<td><?=$dpp[pencatat]?></td>
		</tr>
	 <?}?> 
</table>


<br>
<form name=xls method=post action=kepegawaian/sejarah_kepegawaian_xls.php>
<input type=hidden name=kode value='<?=$_GET[kode]?>'>
<input type=submit name=submit value='Eksport ke file (.XLS)'>
</form>


