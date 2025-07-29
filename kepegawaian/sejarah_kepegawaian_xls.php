<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=sejarah_kepegawaian.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
 
?>

	     	<?
		$data31=mysql_query("select * from pegawai where Kode='$_POST[kode]'");
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
						$statuspeg="Tetap";
					}else if($data3[statuspeg]=='1'){
						$statuspeg="Kontrak";
					}else if($data3[statuspeg]=='3'){
						$statuspeg="PNS Diperbantukan";
					}else if($data3[statuspeg]=='4'){
						$statuspeg="Resign";
					}else if($data3[statuspeg]=='5'){
						$statuspeg="Pindah UDD";
					}else if($data3[statuspeg]=='6'){
						$statuspeg="Meninggal";
					}else if($data3[statuspeg]=='0'){
						$statuspeg="Paruh Waktu";
					}else{
						$statuspeg="tidak jelas";}



?>
<tr><td>Tgl Lahir</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[TglLhr]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Status Karyawan</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$statuspeg?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Tgl KP berikutnya</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[kp1]?></td></tr></h3>
<tr><td>Jenis Kelamin</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$jk?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Umur</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[umur]?> Tahun</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Tgl Pensiun</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[tglpensiun]?></td></tr></h3>
<tr><td>Status Pernikahan</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$jk1?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>TMT</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[tmt]?></td><td><?='&nbsp'.'&nbsp'.'&nbsp'?></td><td>Masa Kerja</td><td><?='&nbsp'.'&nbsp'.'&nbsp'?>:<?='&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'?></td><td><?=$data3[masakerja]?> Tahun</td></tr></h3>
</table>
<!--Data Keluarga-->
<?
$klrg=mysql_query("select * from keluargapeg where nik='$data3[Kode]'");
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
$data=mysql_query("select * from kgbpeg where nik='$data3[Kode]'");
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
		<td><?=$data1[pencatat]?></td>
		<td><?=$data1[tanggal_entry]?></td>
		<td><?=$data1[lamaproses]?> Hari</td>
		</tr>
	 <?}?> 
</table>

<!--Sejarah KP-->

<?
$pangkat=mysql_query("select * from kppeg where nik='$data3[Kode]'");
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
		<td>Status Pengajuan</td>
		<td>Gol Lama</td>
		<td>gol Baru</td>
		<td>Pendidikan</td>	
		<td>Golongan</td>
		<td>Jabatan</td>
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
		<td><?=$pangkat1[golongan]?></td>
		<td><?=$pangkat1[jabatan]?></td>
		<td><?=$pangkat1[pencatat]?></td>
		<td><?=$pangkat1[tanggal_entry]?></td>
		<td><?=$pangkat1[lamaproses]?> Hari</td>
		</tr>
	 <?}?> 
</table>
<!--Sejarah DIKLAT-->

<?
$diklat=mysql_query("select * from diklatpeg where nik='$data3[Kode]'");
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
		<td rowspan='2'>Nama Diklat</td>
		<td rowspan='2'>Jenis Diklat</td>
		<td rowspan='2'>Penyelenggara</td>
		<td rowspan='2'>Tempat</td>
		<td colspan='2'>Tanggal</td>
		<td rowspan='2'>Lama Diklat</td>	
		<td rowspan='2'>Status</td>
		<td rowspan='2'>Sertifikat</td>
		<td rowspan='2'>No Sertifikat</td>
		<td rowspan='2'>biaya</td>
		<td rowspan='2'>Sponsor</td>
		<td rowspan='2'>Petugas Input</td>
		<td rowspan='2'>Tanggal Input</td>
		</tr>
	<tr class="field">
		<td>dari</td>
		<td>Sampai</td>
		</tr>
	<?
	$no=0;
	


	while ($diklat1=mysql_fetch_assoc($diklat)) { 
	$no++;
	


	?>

		<tr class="record">
		<td><?=$no?></td>
		<td><?=$diklat1[Nama]?></td>
		<td><?=$diklat1[notrans]?></td>
		<td><?=$diklat1[jenis]?></td>
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
		<td> <?=$stat2?></td>
		<td><?=$diklat1[sertifikat]?></td>
		<td><?=$diklat1[nosertifikat]?></td>
		<td><?=$diklat1[biaya]?></td>
		<td><?=$diklat1[sponsor]?></td>
		<td><?=$diklat1[pencatat]?></td>
		<td><?=$diklat1[tanggal_entry]?></td>
		</tr>
	 <?}?> 
</table>


