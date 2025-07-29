<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Data_Pegawai_kontrak.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');

$nik	    =$_POST[nik];
$kelamin    =$_POST[kelamin];
$status	    =$_POST[status];
$ijasah     =$_POST[ijasah];
$status1    =$_POST[status1];
$pangkat    =$_POST[pangkat];
$bagian     =$_POST[bagian];
$bagian1    =$_POST[bagian1];
$jabatan    =$_POST[jabatan];

$namaudd=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'"));
?>
<h1>REKAP DATA KARYAWAN KONTRAK <?=$namaudd[nama]?></h1>


<?
$transaksipermintaan=mysql_query("select * from pegawai_kontrak where Kode like '%$nik%' and Jk like '%$kelamin%' and status like '%$status%' and ijasah like '%$ijasah%' 
			and statuspeg like '%$status1%' and golongan like '%$pangkat%' and bagian1 like '%$bagian%' and bagian like '%$bagian1%' 
			and jabatan like '%$jabatan%' order by Kode ASC  ");

$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Total Data Karyawan yang dipilih sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " Data";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">NIK</td>
	<td rowspan='2' align="center">NAMA</td>
	<td rowspan='2' align="center">ALAMAT</td>
	<td colspan='5' align="center">KELAHIRAN</td>
	<td colspan='12' align="center">PENDIDIKAN & PEKERJAAN</td>
        </tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">Tempat</td>
	<td align="center">Tgl</td>
	<td align="center">Umur</td>
	<td align="center">Jk</td>
	<td align="center">Status</td>

	<td align="center">Ijasah</td>
	<td align="center">Golongan</td>
	<td align="center">Kelompok</td>	
	<td align="center">Bagian</td>
	<td align="center">Jabatan</td>
	<td align="center">Status Peg.</td>
	<td align="center">TMT Kontrak</td>
        <td align="center">Masa Kerja</td>

	
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF6346; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="left"><?=$no?></td>
	<td align="left"><?=$datatransaksipermintaan['Kode']?></td>
	<td align="left"><?=$datatransaksipermintaan['Nama']?></td>
	
	<!--? 	
	$pasien1=mysql_query("select * from pasien where no_rm='$datatransaksipermintaan[no_rm]'");
	$ambilpasien=mysql_fetch_array($pasien1);
	$permintaan1=mysql_query("select * from htranspermintaan where no_rm='$datatransaksipermintaan[no_rm]'");
	$permintaan=mysql_fetch_array($permintaan1);

	?>
	<td align="center"><?=$ambilpasien['nama']?></td>
	<td align="center"><?=$ambilpasien['alamat']?></td>
	<td align="center"><?=$ambilpasien['kelamin']?></td>
	<td align="center"><?=$ambilpasien['gol_darah']?> (<?=$ambilpasien['rhesus']?> )</td>
	
	<? 	
	$rs1=mysql_query("select * from rmhsakit where Kode='$datatransaksipermintaan[rs]'");
	$ambilrs1=mysql_fetch_array($rs1);
	
	?>
	<td align="center"><?=$ambilrs1['NamaRs']?></td-->
	<td align="left"><?=$datatransaksipermintaan['Alamat']?></td>
	<td align="left"><?=$datatransaksipermintaan['TempatLhr']?></td>
	<td align="left"><?=$datatransaksipermintaan['TglLhr']?></td>
	<td align="left"><?=$datatransaksipermintaan['umur']?></td>
			<?
			if ($datatransaksipermintaan[Status]=='0') $jenisminta='Bujang';
			if ($datatransaksipermintaan[Status]=='1') $jenisminta='Menikah';
			if ($datatransaksipermintaan[Status]=='2') $jenisminta='Duda';
			if ($datatransaksipermintaan[Status]=='3') $jenisminta='Janda';
			if ($datatransaksipermintaan[Status]=='4') $jenisminta='Suami Karyawan';
			if ($datatransaksipermintaan[Status]=='5') $jenisminta='Istri Karyawan';

			if ($datatransaksipermintaan[Jk]=='0') $jk1='Laki-laki';
			if ($datatransaksipermintaan[Jk]=='1') $jk1='Perempuan';
			 ?>
	<td align="left"><?=$jk1?></td>
	<td align="left"><?=$jenisminta?></td>

	<td align="center"><?=$datatransaksipermintaan['ijasah']?></td> 
	<td align="left"><?=$datatransaksipermintaan['golongan']?></td> 
	<?
	if ($datatransaksipermintaan[bagian1]=='0') $kelompok1='Non Teknis';
	if ($datatransaksipermintaan[bagian1]=='1') $kelompok1='Teknis';
	if ($datatransaksipermintaan[bagian1]=='2') $kelompok1='Managerial';

	if ($datatransaksipermintaan[statuspeg]=='0') $statuspeg='Kontrak';
	if ($datatransaksipermintaan[statuspeg]=='1') $statuspeg='Capeg 80%';
	if ($datatransaksipermintaan[statuspeg]=='2') $statuspeg='Tetap 100%';
	

	 ?>
        <td align="center"><?=$kelompok1?></td>
	<?
		$pasien1=mysql_query("select * from bagianpeg where kode='$datatransaksipermintaan[bagian]'");
		$ambilpasien=mysql_fetch_array($pasien1);
		?>
	<td align="left"><?=$ambilpasien['nama']?></td>
	<td align="left"><?=$datatransaksipermintaan['jabatan']?></td>
	<td align="left"><?=$statuspeg?></td>
	<td align="left"><?=$datatransaksipermintaan['tmtkontrak']?></td>
	<td align="left"><?=$datatransaksipermintaan['masakerja']?></td>


	<!--//(`Kode`,`NoKTP`,`Nama`,`Alamat`,`Jk`,`telp`,`TempatLhr`,`TglLhr`,`Status`,`GolDarah`,
	//				`Rhesus`,`kelurahan`,`kecamatan`,`wilayah`,`KodePos`,`title`,`telp2`,`ibukandung`,`pencatat`,`waktu_update`,
	//				`tanggal_entry`,`tmt`,`ijasah`,`statuspeg`,`kgb`,`kp`,`golongan`,`jabatan`,`sisacuti`,`tmtkontrak`,`tmt80`,`tglcuti`,`pp`,`bagian`,`kelompok`)-->
	
</tr>
<? $no++;} ?>
</table>

<?
mysql_close();
?>
