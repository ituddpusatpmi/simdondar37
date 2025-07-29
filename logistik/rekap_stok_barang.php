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

<head>
<!--img src="../logistik/img/kartustok.jpg" width="100%"><br-->
	<h2 class="list">LAPORAN STOK BARANG</h2>
	<form name="cari" method="POST" action="<? echo $PHPSELF ?>">
		<table class="form">
			<tr>
				<td>Status Stok</td>
				<td class="input">
					<select name="stok">
						<option value="0">Semua barang</option>
						<option value="1" selected>Barang ada stok</option>
						<option value="2">Barang tidak ada stok</option>
						<option value="3">Barang stok MINUS</option>
					</select>
				</td>
				<td>Jenis barang </td>
				<td class="input">
					<select name="jenis">
						<option value="" selected>Semua jenis barang</option>
						<option value="BAG">Kantong Darah</option>
						<option value="REAG">Reagensia</option>
						<option value="BHP">Bahan Habis Pakai</option>
						<option value="AHP">Alat Habis Pakai</option>
						<option value="APD">Alat Pelindung Diri</option>
						<option value="ATK">Alat Tulis Kantor & Cetakan</option>
						<option value="KEB">Kebersihan</option>
						<option value="SOUV">Souvenir</option>
						<option value="LAIN">Lain-lain</option>
						<option value="INV">Inventaris</option>
					</select>
				</td>
				<td>Status</td>
				<td class="input">
					<select name="aktif">
						<option value="0">Semua</option>
						<option value="1" selected>Barang Aktif</option>
						<option value="2">Barang tidak aktif</option>
					</select>
				</td>
				<td><input type=submit name=submit value="Tampilkan"></td>
			</tr>
		</table>
	</form>
</head>

<body>
    

	<?
	if (isset($_POST['rekam'])) {
		for ($i = 0; $i < count($_POST['kode']); $i++) {
			$tgl = date('Y-m-d');
			$tgl2 = date('Ymd');
			$notrans = "OP" . $tgl2;
			$kode = $_POST['kode'][$i];
			$stoktotal = $_POST['stoktotal'][$i];
			$query = "INSERT INTO hstok_akhir (notrans,kode,stoktotal,tgl) VALUES ('" . $notrans . "','" . $kode . "','" . $stoktotal . "', '" . $tgl . "')";
			mysql_query($query);

			if ($query) {
				echo '<script language="javascript">alert("Data Berhasil di input !!!"); document.location="pmilogistik.php?modul=rekap_stok";</script>';
			} else {
			}
			// echo $query;
		}
	}

	if (isset($_POST[submit])) {
	?><?
		$statusstok = $_POST[stok];
		$jenistok = $_POST[jenis];
		$aktif = $_POST[aktif];
		$order = " order by status, namabrg asc ";
		switch ($statusstok) {
			case "0":
				$where = "";
				break;
			case "1":
				$where = " AND (stoktotal>0) ";
				break;
			case "2":
				$where = " AND stoktotal=0   ";
				break;
			case "3":
				$where = " AND stoktotal<0   ";
				break;
			default:
				$where = '';
				break;
		}
		switch ($aktif) {
			case "0":
				$where1 = "";
				break;
			case "1":
				$where1 = " AND aktif='0' ";
				break;
			case "2":
				$where1 = " AND aktif='1' ";
				break;
			default:
				$where1 = '';
				break;
		}
		$data = mysql_query("select * from hstok where status like '%$jenistok%' $where $where1 $order");
		?>
	<form method="POST" name="rekam" method="POST" action="">
		<table class="list" cellpadding=3 cellspacing=0 border=1>
			<tr class="field">
				<td>No</td>
				<td>Jenis</td>
				<td>Kode</td>
				<td>Nama Barang</td>
				<td>Merk</td>
				<td>Stok<br> Minimal</td>
				<td>Jml Stok</td>
				<td>Satuan</td>
				<td>Harga<br> @Rp.</td>
				<td>Harga Total<br>Rp.</td>
			</tr>
			<?
			$no = 0;
			$grandtotal = 0;
			while ($data1 = mysql_fetch_assoc($data)) {
				$no++;
				$harga = number_format($data1['harga'], 0, ',', '.');
				$stoktotal = number_format($data1['stoktotal'], 0, ',', '.');
				$jmlharga = $data1['harga'] * $data1['stoktotal'];
				$jumlahharga = number_format($jmlharga, 0, ',', '.');
				$grandtotal = $grandtotal + $jmlharga;
			?>

				<tr class="record">
					<td align="right"><?= $no ?>.</td>
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
					<td align="left"><?= $jenis ?></td>
					<td align="left"><a href=pmilogistik.php?module=kartu_stok&kode=<?= $data1[kode] ?>><?= $data1[kode] ?></a><input name="kode[]" type="text" value="<?php echo $data1['kode']; ?>" hidden></td>
					<td align="left"><?= $data1[namabrg] ?></td>
					</td>
					<td align="left"><?= $data1[merk] ?>
					<td align="right"><?= $data1[min] ?></td>
					<? $min = $data1[min];
					$max = $data1[stoktotal];
					if ($max <= $min) { ?>
						<td align="right" bgcolor="RED"><?= $stoktotal ?><input name="stoktotal[]" type="text" value="<?php echo $stoktotal; ?>" hidden></td>
					<? } else { ?>
						<td align="right"><?= $stoktotal ?><input name="stoktotal[]" type="text" value="<?php echo $stoktotal; ?>" hidden></td>
					<? } ?>
					<td align="right"><?= $data1[satuan] ?></td>
					<td align="right"><?= $harga ?></td>
					<td align="right"><?= $jumlahharga ?></td>
				</tr>
			<? } ?>
			<tr class="field">
				<td colspan="9">JUMLAH</td>
				<td align="right"><?= number_format($grandtotal, 0, ',', '.'); ?></td>
			</tr>
		</table>
		<br>
		<!--td><input type="submit" name="rekam" value="Stok Opnam"></td-->

	</form>
</body>
<a href="javascript:window.print()">Cetak</a>
<?
	}
?>
