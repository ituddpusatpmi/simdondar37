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
$bulan = date("n");
$tahun = date('Y');
$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
?>

<head>
	<img src="logistik/img/kop_daftar_barang_log.png" width="100%"><br>
	<h2 align="center" class="list">LAPORAN PERSEDIAAN AKHIR BULAN <? echo strtoupper($nama_bulan[$bulan - 1]) ?> <?php echo $tahun ?> <br> (STOK OPNAME)</h2>

</head>

<body>

	<table class="list" cellpadding=5 cellspacing=1 width="100%">
		<tr class="field">
			<td>No</td>
			<td>Jenis</td>
			<td>Kode</td>
			<td>Nama Barang</td>
			<td>Satuan</td>
			<td>Stok<br> Awal</td>
			<td>Masuk</td>
			<td>Keluar</td>
			<td>Stok Akhir</td>
			<td>Tanggal<br> Kadaluarsa</td>
		</tr>
		<?
		$data = mysql_query("select * from hstok_akhir where month (tgl)=($bulan - 1) and year(tgl)= '$tahun' ");

		// $lihat = "select * from hstok_akhir where month (tgl)=($bulan - 1) and year(tgl)= '$tahun'";
		// echo $lihat;

		// $order = "order by status, namabrg asc ";
		// $data = mysql_query("select * from hstok where aktif=0");




		$no = 0;
		$grandtotal = 0;
		while ($data1 = mysql_fetch_assoc($data)) {
			$no++;
			$harga = number_format($data1['harga'], 0, ',', '.');
			$stoktotal = number_format($data1['stoktotal'], 0, ',', '.');
			$jmlharga = $data1['harga'] * $data1['stoktotal'];
			$jumlahharga = number_format($jmlharga, 0, ',', '.');
			$grandtotal = $grandtotal + $jmlharga;
			$opnama =  mysql_fetch_assoc(mysql_query("SELECT namabrg,status,satuan FROM hstok WHERE kode='$data1[kode]'"));
			$opmasuk = mysql_fetch_assoc(mysql_query("SELECT namabrg,status,satuan SUM(hstok_transaksi_detail.qtymasuk) AS jumlah
			FROM hstok_transaksi
			left join hstok_transaksi_detail on hstok_transaksi_detail.kode=hstok_transaksi.kode
			left join hstok on hstok.kode=hstok_transaksi_detail.kode
			WHERE
			kode='$data1[kode]' AND
			hstok_transaksi_detail.qtymasuk >0 AND
			month (tanggal)=($bulan - 1) and year(tanggal)= '$tahun'
			GROUP BY hstok_transaksi_detail.kode"));
		?>

			<tr class="record">
				<td align="right"><?= $no ?>.</td>
				<?php
				switch ($opnama[status]) {
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
				}
				?>
				<td align="left"><?= $jenis ?></td>
				<td align="left"><a href=pmilogistik.php?module=kartu_stok&kode=<?= $data1[kode] ?>><?= $data1[kode] ?></a></td>
				<td align="left"><?= $opnama[namabrg] ?></td>
				<td align="right"><?= $opnama[satuan] ?></td>
				<td align="right"><?= $stoktotal ?> </td>
				<td align="right"><? echo $opmasuk ?></td>
				<td align="right"></td>
				<td align="right"></td>
			</tr>
		<? } ?>
		<tr class="field">
			<td colspan="9">JUMLAH</td>
			<td align="right"><?= number_format($grandtotal, 0, ',', '.'); ?></td>
		</tr>
	</table>
</body>
<a href="javascript:window.print()">Cetak</a>