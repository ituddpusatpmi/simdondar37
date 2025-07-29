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
<?php
$awalbulan = date("Y-m-01");
$hariini = date("Y-m-d");
?>
<!--img src="logistik/img/transaksipengeluaran.jpg" width="100%"><br-->
<h2 class="list">REKAP BARANG KELUAR</h2>
<form name="cari" method="POST" action="<? echo $PHPSELF ?>">
	<table>
		<tr>
			<td>Pilih Tanggal : </td>
			<td>
				<input name="waktu" id="datepicker" value="<?= $awalbulan ?>" type=text size=10> Sampai Dengan
				<input name="waktu1" id="datepicker1" value="<?= $hariini ?>" type=text size=10>
			</td>
			<td>
				<input type=submit name=submit value="Submit">
			</td>
		</tr>
	</table>
</form>

<?
if (isset($_POST[submit])) {

	$perbln = substr($_POST[waktu], 5, 2);
	$pertgl = substr($_POST[waktu], 8, 2);
	$perthn = substr($_POST[waktu], 0, 4);

	$perbln1 = substr($_POST[waktu1], 5, 2);
	$pertgl1 = substr($_POST[waktu1], 8, 2);
	$perthn1 = substr($_POST[waktu1], 0, 4);
?>

	<h3 class="list">TANGGAL : <?= $pertgl ?>-<?= $perbln ?>-<?= $perthn ?> s/d <?= $pertgl1 ?>-<?= $perbln1 ?>-<?= $perthn1 ?></h3>

	<?
	/*$data_masuk = mysql_query("select
		      hstok_transaksi.tanggal, hstok_transaksi.uraian, hstok_transaksi.notrans, hstok_transaksi.supplier, hstok_transaksi.noreferensi,hstok_transaksi.petugas, hstok_transaksi.jenis,
		      hstok_transaksi_detail.kode, hstok_transaksi_detail.qtymasuk, 
		      hstok.namabrg, hstok.satuan, hstok.harga, hstok.status
		      from hstok_transaksi
		      left join hstok_transaksi_detail on hstok_transaksi_detail.notrans=hstok_transaksi.notrans
		      left join hstok on hstok.kode=hstok_transaksi_detail.kode
		      where
		      hstok_transaksi_detail.qtymasuk >0 AND
		      date(hstok_transaksi.tanggal)>='$_POST[waktu]' AND
		      date(hstok_transaksi.tanggal)<='$_POST[waktu1]'
		      order by hstok_transaksi.tanggal, hstok_transaksi.notrans  asc");*/


	$data = mysql_query("select \n" .
		"hstok.namabrg, \n" .
		"hstok.status,\n" .
		"hstok.satuan, \n" .
		"SUM(hstok_transaksi_detail.qtykeluar) AS jumlah \n" .
		"from hstok_transaksi\n" .
		"left join hstok_transaksi_detail on hstok_transaksi_detail.notrans=hstok_transaksi.notrans\n" .
		"left join hstok on hstok.kode=hstok_transaksi_detail.kode\n" .
		"where\n" .
		"hstok_transaksi_detail.qtykeluar >0 AND\n" .
		"date(hstok_transaksi.tanggal)>='$_POST[waktu]' AND\n" .
		"date(hstok_transaksi.tanggal)<='$_POST[waktu1]'\n" .
		"GROUP BY hstok_transaksi_detail.kode ORDER BY hstok.namabrg asc");
	?>
	<table class="list" cellpadding=5 cellspacing=1 width="100%">
		<tr class="field">
			<td>No</td>
			<td>Nama Barang</td>
			<td>Jenis Barang</td>
			<td>Satuan</td>
			<td>Jumlah</td>
		</tr>
		<?
		$no = 0;
		while ($data1 = mysql_fetch_assoc($data)) {
			$no++;
		?>

			<tr class="record">
				<td align="center"><?= $no ?>.</td>
				<?php
				switch ($data1[status]) {
					case "REAG":
						$jenis = 'Reagensia';
						break;
					case "BAG":
						$jenis = 'Kantong Darah';
						break;
					case "BHP":
						$jenis = 'Bahan Habis Pakai';
						break;
					case "AHP":
						$jenis = 'Alat Habis Pakai';
						break;
					case "ATK":
						$jenis = 'Alat Tulis Kantor & Cetakan';
						break;
					case "APD":
						$jenis = 'Alat Pelindung Diri';
						break;
					case "INV":
						$jenis = 'Inventaris';
						break;
					case "KEB":
						$jenis = 'Kebersihan';
						break;
					case "SOUV":
						$jenis = 'Souvenir';
						break;
					case "LAIN":
						$jenis = 'Lain-lain';
						break;
					default:
						$jenis = '--';
						break;
				} ?>
				<td align="left"><?= $data1[namabrg] ?></td>
				<td align="left"><?= $jenis ?></td>
				<td align="center"><?= $data1[satuan] ?></td>
				<td align="center"><?= $data1[jumlah] ?></td>
			</tr>
		<? } ?>
	</table>
	</form>
	<a href="javascript:window.print()">Cetak</a>
<?
}
?>
