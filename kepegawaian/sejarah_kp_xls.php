<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=sejarah_kp.xls");
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
<?
$data=mysql_query("select * from kppeg where nik='$data3[Kode]'");
?>
<table>
<h3 class="list">Jumlah Proses KP :  <?=mysql_num_rows($data)?>  Kali</h3>
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
		<td><?=$data1[gollama]?></td>
		<td><?=$data1[golbaru]?></td>
		<td><?=$data1[ijasah]?></td>
		<td><?=$data1[golongan]?></td>
		<td><?=$data1[jabatan]?></td>
		<td><?=$data1[pencatat]?></td>
		<td><?=$data1[tanggal_entry]?></td>
		<td><?=$data1[lamaproses]?> Hari</td>
		</tr>
	 <?}?> 
</table>
