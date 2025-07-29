<SCRIPT LANGUAGE="JavaScript" SRC="js/rs.js"></SCRIPT>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
   // $('#dokter').autocomplete({source:'modul/suggest_dokter.php', minLength:2}),
    //$('#ruangan').autocomplete({source:'modul/suggest_ruangan.php', minLength:2}),
    //$('#jenis').autocomplete({source:'modul/suggest_jenis.php', minLength:2}),
    $('#nik').autocomplete({source:'kepegawaian/suggest_pegawai.php', minLength:2});});
</script>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />


<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
$src_rs="";
$src_lay="";
$src_shift="";
//if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
//if ($_POST[minta2]!='') $today1=$_POST[minta2];
if ($_POST[nik]!='') 		$nik		=$_POST[nik];
if ($_POST[kelamin]!='') 	$kelamin	=$_POST[kelamin];
if ($_POST[status]!='') 	$status		=$_POST[status];
if ($_POST[ijasah]!='') 	$ijasah		=$_POST[ijasah];
if ($_POST[status1]!='') 	$status1	=$_POST[status1];
if ($_POST[pangkat]!='') 	$pangkat	=$_POST[pangkat];
if ($_POST[bagian]!='') 	$bagian		=$_POST[bagian];
if ($_POST[bagian1]!='') 	$bagian1	=$_POST[bagian1];
if ($_POST[jabatan]!='') 	$jabatan	=$_POST[jabatan];
$namaudd=mysql_fetch_assoc(mysql_query("select nama from utd where aktif='1'"));
?>
<h1>REKAP DATA KARYAWAN <?=$namaudd[nama]?></h1>

<h1> </h1>
<form method=post> <!--Mulai:
<!--TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>><br>
	NO.FORM <input type=text name=nomorf id=nomorf size=10 value=<?=$srcform?>>
	NO.RM <input type=text name=rm id=rm size=10 value=<?=$srcrm?>-->
Mencari satu data NIK <input type=text name=nik id=nik placeholder="Ketikkan nama karyawan" size=25 value=<?=$srcform?>>
Kelamin<select name="kelamin">
	<option value="" selected>- SEMUA -</option>
	  <option value="0">Laki-laki</option>
	  <option value="1">Perempuan</option>
	</select>
	
Pernikahan
<select name="status">
<option value="" selected>- SEMUA -</option>
	<option value="0">Bujang</option>
	<option value="1">Menikah</option>
	<option value="2">Duda</option>
	<option value="3">Janda</option>
	<option value="4">Suami Karyawan</option>
	<option value="5">Istri Karyawan</option>
</select>

Ijasah<select name="ijasah">
	<option value="" selected>- SEMUA -</option>
	  <option value="SMP">SMP</option>
	  <option value="SMA">SMA</option>
	  <option value="D1">D1</option>
	  <option value="D3">D3</option>
	  <option value="S1">S1</option>
	  <option value="S2">S2</option>
	  <option value="S3">S3</option>
	  <option value="S4">S4</option></select>
	</select>

Status Pegawai
<select name="status1">
<option value="" selected>- SEMUA -</option>
	<option value="0">Paruh Waktu</option>
	<option value="1">Kontrak</option>
	<option value="7">Tetap 80%</option>
	<option value="2">Tetap 100%</option>
	<option value="3">PNS Dipekerjakan</option>
	<option value="4">Resign</option>
	<option value="5">Pindah UDD</option>
	<option value="6">Meninggal</option>
	<option value="8">Purna Tugas</option>
  <option value="9">Pensiun</option>
</select>
<br>
Golongan
<select name="pangkat">
<option value="" selected>- SEMUA -</option>
<?php
$qrs = mysql_query("select * from golonganpeg ");

while ($rowrs1 = mysql_fetch_array($qrs)){
  echo "<option value=$rowrs1[golongan]>$rowrs1[golongan]</option>";
}
?>
</select>

Bagian
<select name="bagian">
<option value="" selected>- SEMUA -</option>
	<option value="1">Teknis</option>
	<option value="0">Non Teknis</option>
	<option value="2">Managerial</option>
</select>

Nama Bagian
<select name="bagian1">
<option value="" selected>- SEMUA -</option>
<?php
$qrs = mysql_query("select * from bagianpeg ");

while ($rowrs1 = mysql_fetch_array($qrs)){
  echo "<option value=$rowrs1[kode]>$rowrs1[nama]</option>";
}
?>
</select>
<!--LAYANAN
<select name="gol_layanan">
<option value="" selected>-SEMUA-</option>
<?php
$ql= mysql_query("select * from jenis_layanan ");

while ($rowl1 = mysql_fetch_array($ql)){
  echo "<option value=$rowl1[nama]>$rowl1[nama]</option>";
}
?>
</select-->

Jabatan<select name="jabatan">
	<option value="" selected>-SEMUA-</option>
	<option value="staff">Staff</option>
	<option value="kaTU">Ka. TU</option>
	<option value="sekretaris">Sekretaris</option>
	<option value="kabig">Kabig</option>
	<option value="wadir" >Wadir</option>
	<option value="direktur">Direktur</option>
	</select>

<!--SHIFT<select name="gol_shift">
						<option value="">-SEMUA-</option>
						<option value="1">SHIFT I</option>
						<option value="2">SHIFT II</option>
						<option value="3">SHIFT III</option>
					</select-->

<input type="submit" name="submit" value="Cari" class="swn_button_red">
</form>
<?
$transaksipermintaan=mysql_query("select * from pegawai where Kode like '%$nik%' and Jk like '%$kelamin%' and status like '%$status%' and ijasah like '%$ijasah%' 
			and statuspeg like '%$status1%' and golongan like '%$pangkat%' and kelompok like '%$bagian%' and bagian like '%$bagian1%' 
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
<tr style="background-color:#FF5500; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">NIK</td>
	<td rowspan='2' align="center">NAMA</td>
	<td rowspan='2' align="center">ALAMAT</td>
	<td colspan='5' align="center">KELAHIRAN</td>
	<td colspan='12' align="center">PENDIDIKAN & PEKERJAAN</td>
        </tr>
	<tr style="background-color:#FF5500; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
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
	<td align="center">TMT</td>
        <td align="center">Masa Kerja</td>
	<td align="center">Tgl Pensiun</td>
	
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF9960; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="left"><?=$no?></td>
	<td align="left"><?="<a href=pmi".$_SESSION[leveluser].".php?module=sejarahpeg&kode=".$datatransaksipermintaan['Kode']." TITLE=\"DETIL DATA KARYAWAN\">
										".$datatransaksipermintaan['Kode']."</a>";?></td>
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
	if ($datatransaksipermintaan[kelompok]=='0') $kelompok1='Non Teknis';
	if ($datatransaksipermintaan[kelompok]=='1') $kelompok1='Teknis';
	if ($datatransaksipermintaan[kelompok]=='2') $kelompok1='Managerial';

	if ($datatransaksipermintaan[statuspeg]=='0') $statuspeg='Paruh Waktu';
	if ($datatransaksipermintaan[statuspeg]=='1') $statuspeg='Kontrak';
	if ($datatransaksipermintaan[statuspeg]=='2') $statuspeg='Tetap 100%';
	if ($datatransaksipermintaan[statuspeg]=='3') $statuspeg='PNS Dipekerjakan';
	if ($datatransaksipermintaan[statuspeg]=='4') $statuspeg='Resign';
	if ($datatransaksipermintaan[statuspeg]=='5') $statuspeg='Pindah UDD';
	if ($datatransaksipermintaan[statuspeg]=='6') $statuspeg='Meninggal';
	if ($datatransaksipermintaan[statuspeg]=='7') $statuspeg='Capeg 80%';
	if ($datatransaksipermintaan[statuspeg]=='8') $statuspeg='Purna Tugas';
	if ($datatransaksipermintaan[statuspeg]=='9') $statuspeg='Pensiun';

	 ?>
        <td align="center"><?=$kelompok1?></td>
	<?
		$pasien1=mysql_query("select * from bagianpeg where kode='$datatransaksipermintaan[bagian]'");
		$ambilpasien=mysql_fetch_array($pasien1);
		?>
	<td align="left"><?=$ambilpasien['nama']?></td>
	<td align="left"><?=$datatransaksipermintaan['jabatan']?></td>
	<td align="left"><?=$statuspeg?></td>
	<td align="left"><?=$datatransaksipermintaan['tmt']?></td>
	<td align="left"><?=$datatransaksipermintaan['masakerja']?></td>
	<td align="left"><?=$datatransaksipermintaan['tglpensiun']?></td>

	<!--//(`Kode`,`NoKTP`,`Nama`,`Alamat`,`Jk`,`telp`,`TempatLhr`,`TglLhr`,`Status`,`GolDarah`,
	//				`Rhesus`,`kelurahan`,`kecamatan`,`wilayah`,`KodePos`,`title`,`telp2`,`ibukandung`,`pencatat`,`waktu_update`,

	//				`tanggal_entry`,`tmt`,`ijasah`,`statuspeg`,`kgb`,`kp`,`golongan`,`jabatan`,`sisacuti`,`tmtkontrak`,`tmt80`,`tglcuti`,`pp`,`bagian`,`kelompok`)-->
	
</tr>
<? $no++;} ?>
</table>
<br>

<form name=xls method=post action=kepegawaian/rekap_pegawai_xls.php>
<input type=hidden name=nik value='<?=$nik?>'>
<input type=hidden name=kelamin value='<?=$kelamin?>'>
<input type=hidden name=status value='<?=$status?>'>
<input type=hidden name=ijasah value='<?=$ijasah?>'>
<input type=hidden name=status1 value='<?=$status1?>'>
<input type=hidden name=pangkat value='<?=$pangkat?>'>
<input type=hidden name=bagian value='<?=$bagian?>'>
<input type=hidden name=bagian1 value='<?=$bagian1?>'>
<input type=hidden name=jabatan value='<?=$jabatan?>'>
<input type=submit name=submit2 value='Print Rekap Data Karyawan (.XLS)'>
</form>

<?
mysql_close();
?>
