<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=sejarah_penghargaan_karyawan.xls");
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
