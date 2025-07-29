<h1><u>PENCARIAN</u> <u>DONOR</u> </h1>
<?
include("tanggal_indo.php"); 
$srckode="";
$srcnama="";
$srcalamat="";
$srckelurahan="";
$srckecamatan="";
$srcwilayah="";
$srctmptlhr="";
$srctgllahir="";
$srcabo="";
$srcrhesus="";
$telp="";

if ($_POST[kode]!='') $srckode=$_POST[kode];
if ($_POST[nama]!='') $srcnama=$_POST[nama];
if ($_POST[alamat]!='') $srcalamat=$_POST[alamat];
if ($_POST[kelurahan]!='') $srckelurahan=$_POST[kelurahan];
if ($_POST[kecamatan]!='') $srckecamatan=$_POST[kecamatan];
if ($_POST[wilayah]!='') $srcwilayah=$_POST[wilayah];
if ($_POST[tempatlahir]!='') $tempatlahir=$_POST[tempatlahir];
if ($_POST[tgllahir]!='') $srctgllahir=$_POST[tgllahir];
if ($_POST[goldarah]!='') $src_abo=$_POST[goldarah];
if ($_POST[rhesus]!='') $srcrhesus=$_POST[rhesus];
if ($_POST[telp]!='') $srctelp=$_POST[telp];

//pilihan mobil unit 
	$instan0=mysql_query("select * from detailinstansi where aktif='1'");
	$instan01=mysql_fetch_assoc($instan0);
	$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);
	if ($td0=='M') {
		$ninstan = mysql_num_rows($instan0);
		if ($ninstan!=1)  { $pesan="SILAKAN <b><a href=pmimobile.php?module=data_jadwal_mobile>PILIH/GANTI INSTANSI</a></b> DULU SEBELUM MELANJUTKAN!!!";}
		else { $pesan=$instan01[nama]; 
//		$tempat=mysql_query("update detailinstansi set aktif='0' where aktif='1'");
		}
	}

//selesai
//----------------------------
	?>
<form  method=post>
<table>

<tr><td>Kode Pendonor</td><td>:</td><td><input type=text name='kode' size='20' placeholder="ID KARTU DONOR"></td><td>Tempat Lahir</td><td>:</td><td><input type=text name='tempatlahir' size='20' placeholder="Tempat Lahir"></td></tr>
<tr><td>Nama Pendonor</td><td>:</td><td><input type=text name='nama' size='25' placeholder="Nama Pendonor"></td><td>Tanggal Lahir</td><td>:</td><td><input type=text name='tgllahir' size='10' placeholder="YYYY-MM-DD"></td></tr>
<tr><td>Alamat</td><td>:</td><td><input type=text name='alamat' size='30' placeholder="Alamat"></td><td>Golongan Darah</td><td>:</td><td><select name="goldarah">
																			<option value="">SEMUA</option>
																			<option value="A">A</option>
																			<option value="B">B</option>
																			<option value="AB">AB</option>
																			<option value="O">O</option>
																			</select></td></tr>
<tr><td>Kelurahan</td><td>:</td><td><input type=text name='kelurahan' size='20' placeholder="Kelurahan"></td>
<td>Rhesus</td><td>:</td><td><select name="rhesus">
																			<option value="">SEMUA</option>
																			<option value="+">(Positif) +</option>
																			<option value="-">(Negatif) -</option>
																			</select></td></tr>
<tr><td>Kecamatan</td><td>:</td><td><input type=text name='kecamatan' size='20' placeholder="Kecamatan"></td><td>No Telp/Hp</td><td>:</td><td><input type=text name='telp' size='13' placeholder="Nomor Handphone"></td></tr>
<tr><td>Wilayah</td><td>:</td><td><input type=text name='wilayah' size='20' placeholder="Wilayah"></td></tr>
<tr>
<td>
<input type="submit" name="submit" value="Cari" class="swn_button_blue"> 
<?  if ($_SESSION[leveluser]=='aftap') { ?>
<input type="button" value="Donor Baru" onClick="document.location.href='pmiaftap.php?module=registrasi'">
<? } else if ($_SESSION[leveluser]=='kasir') { ?>
<input type="button" value="Donor Baru" onClick="document.location.href='pmikasir.php?module=registrasi'">

<? } else if ($_SESSION[leveluser]=='mobile') { ?>
<input type="button" value="Donor Baru" onClick="document.location.href='pmimobile.php?module=registrasi'">

<? } else if ($_SESSION[leveluser]=='konseling') { ?>
<input type="button" value="Donor Baru" onClick="document.location.href='pmikonseling.php?module=registrasi'">

<? } else if ($_SESSION[leveluser]=='p2d2s') { ?>
<input type="button" value="Donor Baru" onClick="document.location.href='pmip2d2s.php?module=registrasi'">


<? 
} ;
?>







</td></tr>
</tr>
</table>

</form>

<?

if (isset($_POST[submit])) {
//$kode=$_POST['kode'];
$jd=mysql_query("select * from pendonor where Kode like '%$srckode%' and Nama like '%$srcnama%' and Alamat like '%$srcalamat%' and kelurahan like '%$srckelurahan%' and kecamatan like '%$srckecamatan%' and wilayah like '%$srcwilayah%' and TempatLhr like '%$srctmptlhr%' and TglLhr like '%$srctgllahir%' and GolDarah like '%$src_abo%' and Rhesus like '%$srcrhesus%' and telp2 like '%$srctelp%'");

//$jd=mysql_query("select * from pendonor where Nama like '%$srcnama%' OR Nama like '%$srcnama%'");


?>
<br><br>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="110%">
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

<!--td align="center">No</td-->
<td align="center">Kode Pendonor</td>
<td align="center">Nama</td>
<td align="center">Alamat</td>
<td align="center">Kelurahan</td>
<td align="center">Kecamatan</td>
<td align="center">Wilayah</td>
<td align="center">Gol Darah</td>
<td align="center">Rh</td>
<td align="center">Aphr</td>
<td align="center">Jk</td>
<td align="center">Tempat Lahir</td>
<td align="center">Tanggal Lahir</td>
<td align="center">Telp/Hp</td>
<td align="center">Jumlah Donor</td>
<td align="center">IMLTD</td>
<td align="center">Kartu</td>
</tr>
<?  
while ($datadonor=mysql_fetch_array($jd)){
$kode=$datadonor['Kode'];

?>
<tr>
<td align="right">
<?
if (date('Y-m-d')>=$datadonor['tglkembali'] and ($datadonor['Cekal']=='0')){
?>
<!-- Apheresis -->
<? //if $datadonor['apheresis']=='1' {?>
<a href="pmikasir.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=0" target="isiadmin" class="fisheyeItem"><img src="../images/bloodbag.png" /></a>  | 
<? //};?>

<!-- Cetak Kartu -->
<a href="/jqupc/index.php?ext=jpg&idpendonor=<? echo $datadonor['Kode'] ?>"><img src="../images/idcard.png" width=30 height=25/></a> |

<!-- Antri Donor -->

<a href="pmikasir.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=1"><img src="../images/aferesis.png" width=25 height=25/></a>
<?} else echo" ";?> |
<!--Cetak Form Donor -->
<a href="formulir_donor_PDF.php?kp=<? echo $datadonor['Kode'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/form.png" width=25 height=25/></a> |
<a href="pmi<? echo $_SESSION[leveluser]?>.php?module=eregistrasi&Kode=<? echo $datadonor['Kode'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/ubah.png" /></a><br>
<a href="pmi<? echo $_SESSION[leveluser]?>.php?module=history&q=<? echo $datadonor['Kode']?>" target="isiadmin" class="fisheyeItem"><?=$datadonor['Kode'] ?><?=$datadonor['Kode_lama'] ?></a></td>
<td align="center"><?=$datadonor['Nama'] ?></td>
<td align="center"><?=$datadonor['Alamat'] ?></td>
<td align="center"><?=$datadonor['kelurahan'] ?></td>
<td align="center"><?=$datadonor['kecamatan'] ?></td>
<td align="center"><?=$datadonor['wilayah'] ?></td>
<td align="center"><?=$datadonor['GolDarah'] ?></td>
<td align="center"><?=$datadonor['Rhesus'] ?></td>
<td align="center"><?=$datadonor['apheresis'] ?></td>
<?
if ($datadonor['JK']=='0'){
$jeniskelamin='Laki-Laki';} else
$jeniskelamin='Perempuan';

?>
<td align="center"><?=$jeniskelamin?></td>
<td align="center"><?=$datadonor['TempatLhr'] ?></td>
<td align="center">
<? $tgllahir=date("d/m/Y",strtotime($datadonor['TglLhr'])); 
echo $tgllahir;
?>
</td>
<td align="center"><?=$datadonor['telp2'] ?></td>
<td align="center"><?=$datadonor['jumDonor'] ?> kali</td>
<td align="center">
<?
if ($datadonor['Cekal']=='0') {
$statusc='OK';
} else
$statusc='Konfirmasi Ke Dokter';
echo $statusc ?></td>
<td align="center"><?=$datadonor['kartu_cetak'] ?></td>
</tr>
<?
$no++;
} ;}?>
</table>

