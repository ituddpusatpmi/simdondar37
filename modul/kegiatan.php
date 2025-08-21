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
$namauser = $_SESSION[namauser];
$today = "";
$today1 = "";
$src_rs = "";
$src_lay = "";
$src_shift = "";
$produk = "";
$gol_darah = "";
$rh_darah = "";
$bagian = "";
$wilayah = "";
$tempat = "";
$hasil = "";
if ($_POST[minta1] != '') $today = $_POST[minta1];
if ($_POST[minta2] != '') $today1 = $_POST[minta2];
if ($_POST[gol_status] != '') $src_status = $_POST[gol_status];
if ($_POST[gol_rs] != '') $src_rs = $_POST[gol_rs];
if ($_POST[gol_layanan] != '') $src_lay = $_POST[gol_layanan];
if ($_POST[gol_shift] != '') $src_shift = $_POST[gol_shift];
if ($_POST[rm] != '') $srcrm = $_POST[rm];
if ($_POST[nomorf] != '') $srcform = $_POST[nomorf];
if ($_POST[hasil] != '') $hasil = $_POST[hasil];
if ($_POST[produk] != '') $produk = $_POST[produk];
if ($_POST[gol_darah] != '') $gol_darah = $_POST[gol_darah];
if ($_POST[rh_darah] != '') $rh_darah = $_POST[rh_darah];
if ($_POST[bagian] != '') $bagian = $_POST[bagian];
if ($_POST[wilayah] != '') $wilayah = $_POST[wilayah];
if ($_POST[tempat] != '') $tempat = $_POST[tempat];

?>
<h2>JADWAL KEGIATAN MOBIL UNIT</h2>
<form method=post> Mulai:
	TANGGAL : <input type=text name=minta1 id=datepicker size=10 autocomplete=off value=<?= $today ?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 autocomplete=off value=<?= $today1 ?>>
	STATUS <select name="hasil">
		<option value="">-SEMUA-</option>
		<option value="-">TERJADUAL</option>
		<option value="0">FIXED</option>
		<option value="1">SELESAI</option>
		<option value="2">DITUNDA</option>
		<option value="3">BATAL</option>
	</select>

	<input type="submit" name="submit" value="Lihat" class="swn_button_blue">
</form>
<?
$sql_intsansidonor = mysql_query("select * from kegiatan where CAST(TglPenjadwalan as date) >= '$today' and CAST(TglPenjadwalan as date) <= '$today1' AND Status like '%$hasil%' order by TglPenjadwalan ASC");
?>
<?
$countp = mysql_num_rows($sql_intsansidonor);
echo "Mobil Unit sebanyak <b> $countp </b> Kegiatan";
?>
<table border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td rowspan="2" align="center">NO</td>
		<td rowspan="2" align="center">INSTANSI</td>
		<td rowspan="2" align="center">TANGGAL</td>
		<td rowspan="2" align="center">RENCANA<br>JUMLAH</td>
		<td rowspan="2" align="center">STATUS</td>
		<td colspan="3" align="center">HASIL AFTAP</td>
		<td rowspan="2" align="center">KENDARAAN</td>
	</tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align="center">SUKSES</td>
		<td align="center">GAGAL</td>
		<td align="center">BATAL</td>
	</tr>
	<?
	$no = 0;
	while ($data = mysql_fetch_assoc($sql_intsansidonor)) {
		$no++;
		$instansi = mysql_fetch_assoc(mysql_query("select nama from detailinstansi where KodeDetail='$data[kodeinstansi]'"));
	?>
		<tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?= $no ?>.</td>
			<td align="left" class=input><?= $instansi[nama] ?></td>
			<td align="center" class=input><?= $data[TglPenjadwalan] ?></td>
			<td align="center" class=input><?= $data[jumlah] ?></td>
			<?
			$status = "Terjadual";
			if ($data[Status] == "0") $status = "Fixed";
			if ($data[Status] == "1") $status = "Selesai";
			if ($data[Status] == "2") $status = "Ditunda";
			if ($data[Status] == "3") $status = "Batal";
			?>
			<td align="left" class=input><?= $status ?></td>
			<td align="center" class=input><?= $data[sukses] ?></td>
			<td align="center" class=input><?= $data[gagal] ?></td>
			<td align="center" class=input><?= $data[batal] ?></td>

			<?
			$kendaraan = 'BUS MU';
			if ($data[kendaraan] == '1') $kendaraan = 'MOBIL MU';
			?>
			<td align="left" class=input><?= $kendaraan ?></td>

		</tr>
	<?
	} ?>
</table>
<?
mysql_close();
?>