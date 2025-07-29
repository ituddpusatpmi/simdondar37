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
$produk="";
$gol_darah="";
$rh_darah="";
$bagian="";
$wilayah="";
$tempat="";
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
if ($_POST[gol_status]!='') $src_status=$_POST[gol_status];
if ($_POST[gol_rs]!='') $src_rs=$_POST[gol_rs];
if ($_POST[gol_layanan]!='') $src_lay=$_POST[gol_layanan];
if ($_POST[gol_shift]!='') $src_shift=$_POST[gol_shift];
if ($_POST[rm]!='') $srcrm=$_POST[rm];
if ($_POST[nomorf]!='') $srcform=$_POST[nomorf];
if ($_POST[hasil]!='') $hasil=$_POST[hasil];
if ($_POST[produk]!='') $produk=$_POST[produk];
if ($_POST[gol_darah]!='') $gol_darah=$_POST[gol_darah];
if ($_POST[rh_darah]!='') $rh_darah=$_POST[rh_darah];
if ($_POST[bagian]!='') $bagian=$_POST[bagian];
if ($_POST[wilayah]!='') $wilayah=$_POST[wilayah];
if ($_POST[tempat]!='') $tempat=$_POST[tempat];

?>
<h1>RINCIAN KEGIATAN JADWAL MOBIL UNIT</h1>
<form method=post> Mulai:
TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>>
NO.FORM <input type=text name=nomorf id=nomorf size=10 value=<?=$srcform?>>
	NO.RM <input type=text name=rm id=rm size=10 value=<?=$srcrm?>><br>
	STATUS PENGAMBILAN<select name="gol_status">
	<option value="">-SEMUA-</option>
	<option value="0">BAWA</option>
	<option value="1">TITIP</option>
	<option value="B">BATAL</option>
	</select>
RS
<select name="gol_rs">
<option value="" selected>- SEMUA -</option>
<?php
$qrs = mysql_query("select * from rmhsakit ");

while ($rowrs1 = mysql_fetch_array($qrs)){
  echo "<option value=$rowrs1[Kode]>$rowrs1[NamaRs]</option>";
}
?>
</select>

WILAYAH<select name="wilayah">
	<option value="">-SEMUA-</option>
	<option value="0">DALAM KOTA</option>
	<option value="1">LUAR KOTA</option>
	</select>

LAYANAN
<select name="gol_layanan">
<option value="" selected>-SEMUA-</option>
<?php
$ql= mysql_query("select * from jenis_layanan ");

while ($rowl1 = mysql_fetch_array($ql)){
  echo "<option value=$rowl1[kode]>$rowl1[nama]</option>";
}
?>
</select>

BAGIAN
<select name="bagian">
<option value="" selected>-SEMUA-</option>
<?php
$ql= mysql_query("select * from bagian ");

while ($rowl1 = mysql_fetch_array($ql)){
  echo "<option value=$rowl1[nama]>$rowl1[nama]</option>";
}
?>
</select>
<br>
HASIL CROSSMATCH<select name="hasil">
	<option value="">-SEMUA-</option>
	<option value="1">COMPATIBLE</option>
	<option value="0">INCOMPATIBLE BLH KLR</option>
	<option value="2">INCOMPATIBLE TDK BLH KLR</option>
	</select>

SHIFT<select name="gol_shift">
						<option value="">-SEMUA-</option>
						<option value="1">SHIFT I</option>
						<option value="2">SHIFT II</option>
						<option value="3">SHIFT III</option>
					</select>

PRODUK
<select name="produk">
<option value="" selected>-SEMUA-</option>
<?php
$ql= mysql_query("select * from produk ");

while ($rowl1 = mysql_fetch_array($ql)){
  echo "<option value=$rowl1[Nama]>$rowl1[Nama]</option>";
}
?>
</select>

GOL. DARAH<select name="gol_darah">
						<option value="">-SEMUA-</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="O">O</option>
						<option value="AB">AB</option>
					</select>

Rh DARAH<select name="rh_darah">
						<option value="">-SEMUA-</option>
						<option value="+">Positip</option>
						<option value="-">Negatip</option>
					</select>
TEMPAT<select name="tempat">
						<option value="">-SEMUA-</option>
						<option value="UDD">UDD</option>
						<option value="BDRS">BDRS</option>
						<option value="BDRS2">BDRS2</option>
					</select>

<input type="submit" name="submit" value="Lihat" class="swn_button_blue">
</form>
<?
$transaksipermintaan=mysql_query("select * from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status like '%$src_status%' and rs like '%$src_rs%' and layanan like '%$src_lay' and shift like '%$src_shift%' and NoForm like '%$srcform%' and no_rm like '%$srcrm%' and StatusCross like '%$hasil%' and produk_darah like '%$produk%' and gol_darah like '%$gol_darah%' and rh_darah like '%$rh_darah%' and bagian like '%$bagian%' and wil_rs like '%$wilayah%' and tempat like '%$tempat%' order by NoForm ASC  ");



$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Total Darah keluar Ke Rumah sakit sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " kantong";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">No Formulir</td>
	
	<td colspan='5' align="center">DATA PASIEN</td>
	<td colspan='4' align="center">DATA RS</td>
	<td colspan='3' align="center">DATA PERMINTAAN</td>
	
	<td colspan='3' align="center">DATA KTG/DARAH</td>
        <td colspan='4' align="center">CROSSMATCH</td>
	<td colspan='6' align="center">PEMBAYARAN</td>
        </tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">No RM</td>
	<td align="center">Nama</td>
	<td align="center">Alamat</td>
	<td align="center">JK</td>
	<td align="center">Gol&Rh</td>

	<td align="center">Nama RS</td>
	<td align="center">Bagian</td>
	<td align="center">Klas</td>
	<td align="center">Ruangan</td>

	<td align="center">Jenis</td>
        <td align="center">Layanan</td>
	<td align="center">No Layanan</td>

	<td align="center">Nomor</td>
        <td align="center">Gol&Rh</td>
        <td align="center">Produk</td>

	<td align="center">Hasil</td>
	<td align="center">Petugas</td>
	<td align="center">Tgl</td>
	<td align="center">Shift</td>

	<td align="center">jenis<br>Biaya</td>
	<td align="center">Status</td>
	<td align="center">Tgl</td>
	<td align="center">Kasir</td>
	<td align="center">Shift</td>
	<td align="center">No Kwitansi</td>
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF6346; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['NoForm']?></td>
	<td align="center"><?=$datatransaksipermintaan['no_rm']?></td>
	
	<? 	
	$pasien1=mysql_query("select * from pasien where no_rm='$datatransaksipermintaan[no_rm]'");
	$ambilpasien=mysql_fetch_array($pasien1);
	//$permintaan1=mysql_query("select * from htranspermintaan where no_rm='$datatransaksipermintaan[no_rm]'");
	//$permintaan=mysql_fetch_array($permintaan1);
	
	?>
	<td align="center"><?=$ambilpasien['nama']?></td>
	<td align="center"><?=$ambilpasien['alamat']?></td>
	<td align="center"><?=$ambilpasien['kelamin']?></td>
	<td align="center"><?=$ambilpasien['gol_darah']?> (<?=$ambilpasien['rhesus']?> )</td>
	
	<? 	
	$rs1=mysql_query("select * from rmhsakit where Kode='$datatransaksipermintaan[rs]'");
	$ambilrs1=mysql_fetch_array($rs1);
	$layanan=mysql_query("select * from jenis_layanan where kode='$datatransaksipermintaan[layanan]'");
	$layanan1=mysql_fetch_array($layanan);
	$layanan2=mysql_query("select * from htranspermintaan where noform='$datatransaksipermintaan[NoForm]'");
	$layanan3=mysql_fetch_array($layanan2);
	?>
	<td align="center"><?=$ambilrs1['NamaRs']?></td>
	<td align="center"><?=$datatransaksipermintaan[bagian]?></td>
	<td align="center"><?=$layanan3['kelas']?></td>
	<td align="center"><?=$layanan3['ruangan']?></td>

			<?
			if ($layanan3[jenis_permintaan]=='0') $jenisminta='Biasa';
			if ($layanan3[jenis_permintaan]=='1') $jenisminta='Cadangan';
			if ($layanan3[jenis_permintaan]=='2') $jenisminta='Siap Pakai';
			if ($layanan3[jenis_permintaan]=='3') $jenisminta='Cyto';	
			 ?>
	<td class=input align=center><? echo $jenisminta?></td>
	<td align="center"><?=$layanan1['nama']?></td> 
	<td align="center"><?=$layanan3['nojenis']?></td> 

        <td align="center"><?=$datatransaksipermintaan['NoKantong']?></td>
	<? 	
	$kantong1=mysql_query("select * from stokkantong where NoKantong='$datatransaksipermintaan[NoKantong]'");
	$ambilkantong1=mysql_fetch_array($kantong1);
	
	?>
	<td align="center"><?=$datatransaksipermintaan['gol_darah']?>(<?=$datatransaksipermintaan['rh_darah']?>)</td>
	<td align="center"><?=$datatransaksipermintaan['produk_darah']?></td>
	<?
	$hasilcross='Compatible';
	if ($datatransaksipermintaan['StatusCross']=="0") $hasilcross='inCompatible Blh Klr';
	if ($datatransaksipermintaan['StatusCross']=="2") $hasilcross='inCompatible Tdk Blh Klr';
	$statuscross='DiBawa';
	if ($datatransaksipermintaan['Status']=="1") $statuscross='Titip';
	if ($datatransaksipermintaan['Status']=="B") $statuscross='Batal';
	?>

	<td align="center"><?=$hasilcross?></td>
	<td align="center"><?=$datatransaksipermintaan['petugas']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl']?></td>
	<td align="center"><?=$datatransaksipermintaan['shift']?></td>
	<? 	
	$pembayaran1=mysql_query("select * from dpembayaranpermintaan where notrans='$datatransaksipermintaan[NoForm]'");
	$pembayaran=mysql_fetch_array($pembayaran1);
	
	?>
	<td align="center"><?=$pembayaran['namabrg']?></td>
	
	<td align="center"><?=$statuscross?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_keluar']?></td>
	<td align="center"><?=$pembayaran['petugas']?></td>
	<td align="center"><?=$pembayaran['shift']?></td>
	<? 	
	$kwitansi1=mysql_query("select * from kwitansi where NoForm='$datatransaksipermintaan[NoForm]'");
	$kwitansi=mysql_fetch_array($kwitansi1);
	?>
	<td align="center"><?=$kwitansi['nomer']?></td>
</tr>
<? $no++;} ?>
</table>
<br>
<form name=xls method=post action=modul/rekap_darah_keluar_xls.php>
<input type=hidden name=today value='<?=$today?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=hidden name=status value='<?=$src_status?>'>
<input type=hidden name=layanan value='<?=$src_lay?>'>
<input type=hidden name=shift2 value='<?=$src_shift?>'>
<input type=hidden name=NoForm value='<?=$srcform?>'>
<input type=hidden name=rs value='<?=$src_rs?>'>
<input type=hidden name=norm value='<?=$srcrm?>'>
<input type=hidden name=hasil value='<?=$hasil?>'>

<input type=hidden name=produk value='<?=$produk?>'>
<input type=hidden name=gol_darah value='<?=$gol_darah?>'>
<input type=hidden name=rh_darah value='<?=$rh_darah?>'>
<input type=hidden name=bagian value='<?=$bagian?>'>
<input type=hidden name=wilayah value='<?=$wilayah?>'>
<input type=hidden name=tempat value='<?=$tempat?>'>
<input type=submit name=submit2 value='Print Rincian Darah Keluar (.XLS)'>
</form>

<?
mysql_close();
?>
