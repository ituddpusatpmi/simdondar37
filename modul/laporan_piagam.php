<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
include('clogin.php');
include('config/db_connect.php');
?>
<h1 class="list">REKAP PIAGAM YANG SUDAH DICETAK</h1>
<form name="cari" method="POST" action="<? echo $PHPSELF ?>">
	<table>
		<tr>
			<td>Pilih Piagam</td>
			<td class="input">
				<select name="piagam">
					<option value="p10" selected>Piagam 10</option>
					<option value="p25">Piagam 25</option>
					<option value="p50">Piagam 50</option>
					<option value="p75">Piagam 75</option>
					<option value="p100">Piagam 100</option>
					<option value="psatya">Piagam Satya Lencana</option>
					<option value="pprov">Piagam Provinsi</option>
				</select>
			</td>
			<td>Pilih Periode : </td>
			<td>
				<input name="waktu" id="datepicker" type=text size=10 autocomplete=off> Sampai Dengan
				<input name="waktu1" id="datepicker1" type=text size=10 autocomplete=off>
			</td>
			<td>
				<input type=submit name=submit value="Submit">
			</td>
		</tr>
	</table>
</form>
<?
if (isset($_POST[submit])) {
	$piagam 	= $_POST[piagam];
	$perbln = substr($_POST[waktu], 5, 2);
	$pertgl = substr($_POST[waktu], 8, 2);
	$perthn = substr($_POST[waktu], 0, 4);

	$perbln1 = substr($_POST[waktu1], 5, 2);
	$pertgl1 = substr($_POST[waktu1], 8, 2);
	$perthn1 = substr($_POST[waktu1], 0, 4);

	switch ($piagam) {
		case "p10":
			$piagam1 = "10 kali";
			break;
		case "p25":
			$piagam1 = "25 kali";
			break;
		case "p50":
			$piagam1 = "50 kali";
			break;
		case "p75":
			$piagam1 = "75 kali";
			break;
		case "p100":
			$piagam1 = "100 kali";
			break;
		case "psatya":
			$piagam1 = "Satya Lencana";
			break;
		case "pprov":
			$piagam1 = "Provinsi";
			break;
	}

?>
	<h3 class="list">Rekap Piagam <?= $piagam1 ?> Periode <?= $pertgl ?> - <?= $perbln ?> - <?= $perthn ?> sampai dengan <?= $pertgl1 ?> - <?= $perbln1 ?> - <?= $perthn1 ?></h3>

	<?
	$data = mysql_query("SELECT a.Kode,a.TempatLhr, a.TglLhr, a.Pekerjaan, a.telp2, a.Nama,a.Alamat,a.Jk,a.GolDarah,a.Rhesus,a.jumDonor,a.p10, a.p25, a.p50, a.p75, a.p100, a.psatya, a.pprov,
                        date(b.tglDiajukan) as diajukan, date(b.tglDicetak) as dicetak, date(b.tglDiberikan) as diberikan, date(b.tglKembali) as kembali, b.nopiagam,b.jenispiagam
                        FROM pendonor a
                        INNER JOIN piagam b ON a.Kode = b.kodependonor
                        WHERE b.jenispiagam = '$piagam'
                        AND date(b.tglDiajukan)
                        BETWEEN  '$_POST[waktu]'
                        AND  '$_POST[waktu1]'
                        ORDER BY b.tglDiajukan ASC");
	?>
	<table class="list" cellpadding=5 cellspacing=1>
		<tr class="field">
			<td>No</td>
			<td>No Piagam</td>
			<td>Kode Pendonor</td>
			<td>Nama Pendonor</td>
			<td>JK</td>
			<td>Tgl. Lahir</td>
			<td>Alamat</td>
			<td>No. HP</td>
			<td>Pekerjaan</td>
			<td>Gol Darah</td>
			<td>Donasi</td>
			<td>Tgl Diajukan</td>
			<td>Tgl Dicetak</td>
			<td>Tgl Diberikan</td>
			<td>Tgl Kembali</td>
		</tr>
		<?
		$no = 0;
		while ($data1 = mysql_fetch_assoc($data)) {
			$no++;
			switch ($data1[Jk]) {
				case "0":
					$jk = "LK";
					break;
				case "1":
					$jk = "PR";
					break;
			}
		?>
			<tr class="record">
				<td><?= $no ?></td>
				<td><?= $data1[nopiagam] ?></td>
				<td><?= $data1[Kode] ?></td>
				<td align="left"><?= $data1[Nama] ?></td>
				<td><?= $jk ?></td>
				<td><?= $data1[TempatLhr] . ',<br> ' . $data1[TglLhr] ?></td>
				<td align="left"><?= $data1[Alamat] ?></td>
				<td><?= $data1[telp2] ?></td>
				<td><?= $data1[Pekerjaan] ?></td>
				<td><?= $data1[GolDarah] ?></td>
				<td><?= $data1[jumDonor] ?></td>
				<td><?= $data1[diajukan] ?></td>
				<td><?= $data1[dicetak] ?></td>
				<td><?= $data1[diberikan] ?></td>
				<td><?= $data1[kembali] ?></td>
			</tr>
		<? } ?>
	</table>
	<br>
	<form name=xls method=post action=modul/laporan_piagam_xls.php>
		<input type=hidden name=pertgl value='<?= $pertgl ?>'>
		<input type=hidden name=perbln value='<?= $perbln ?>'>
		<input type=hidden name=perthn value='<?= $perthn ?>'>
		<input type=hidden name=pertgl1 value='<?= $pertgl1 ?>'>
		<input type=hidden name=perbln1 value='<?= $perbln1 ?>'>
		<input type=hidden name=perthn1 value='<?= $perthn1 ?>'>
		<input type=hidden name=waktu value='<?= $_POST[waktu] ?>'>
		<input type=hidden name=waktu1 value='<?= $_POST[waktu1] ?>'>
		<input type=hidden name=piagam value='<?= $_POST[piagam] ?>'>
		<input type=submit name=submit value='Eksport ke file (.XLS)'>
	</form>

<?
}
?>