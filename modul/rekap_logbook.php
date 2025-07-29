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
	<h2 class="list">DAFTAR LOGBOOK</h2>
	<form name="cari" method="POST" action="<? echo $PHPSELF ?>">
		<table class="form">
			<tr>

				<td>Unit</td>
				<td class="input">
					<select name="unit">
						<option value="">Semua</option>
						<option value="UTD">UTD</option>
						<option value="Markas">Markas</option>
					</select>
				</td>

				<td>Tipe</td>
				<td class="input">
					<select name="tipe">
						<option value="">Semua</option>
						<option value="Medis">Medis</option>
						<option value="Non Medis">Non Medis</option>
					</select>
				</td>


				<td>Bagian</td>
				<td class="input">
					<select name="bagian">
						<option value="">Semua</option>
						<option value="PPDDS">PPDDS</option>
						<option value="Logistik">Logistik</option>
						<option value="Seleksi Donor">Seleksi Donor</option>
						<option value="Aftap">Aftap</option>
						<option value="Mobile">Mobile Unit</option>
						<option value="KGD">Konfirmasi Golongan Darah</option>
						<option value="IMLTD">IMLTD</option>
						<option value="Komponen">Komponen</option>
						<option value="Karantina">Karantina</option>
						<option value="Pasien Service">Pasien service</option>
						<option value="Crossmatch">Crossmatch</option>
						<option value="Pimpinan">Pimpinan</option>
						<option value="Konseling">Konseling</option>
						<option value="Administrator">Administrator</option>
						<option value="QA">QA</option>
						<option value="QC">QC</option>
						<option value="Keuangan">Keuangan</option>
						<option value="Umum">Umum</option>
						<option value="SDM">SDM</option>

					</select>
				</td>

				<td>Fungsi</td>
				<td class="input">
					<select name="fungsi">
                        <option value="">Semua</option>
						<?php
						$q = "select * from logbook_f";
						$do = mysql_query($q, $con);
						while ($data = mysql_fetch_assoc($do)) {
							$select = "";
						?>
							<option value="<?= $data[fungsi] ?>" <?= $select ?>><?= $data[fungsi] ?>
							</option>
						<? } ?>
					</select>
				</td>

				<td>Status</td>
				<td class="input">
					<select name="aktif">
						<option value="">Semua</option>
						<option value="0">Rusak</option>
						<option value="1" selected>Baik</option>
						<option value="2">Dalam Proses Kalibrasi</option>
						<option value="3">Dalam Proses Perawatan</option>
						<option value="4">Dimusnahkan</option>
					</select>
				</td>

				<td><input type=submit name=submit value="Tampilkan"></td>
			</tr>
		</table>
	</form>
</head>

<body>

	<?
	if (isset($_POST[submit])) {
	?><?

		$unit = $_POST[unit];
		$tipe = $_POST[tipe];
		$bagian = $_POST[bagian];
		$fungsi = $_POST[fungsi];
		$aktif = $_POST[aktif];
		$order = " order by status asc ";
		//  switch ($statusstok){
		//	case "0" : $where="";Break;
		//	case "1" : $where=" AND jenis='0' ";Break;
		//	case "2" : $where=" AND jenis='1' ";Break;
		//	default  : $where='';Break;	
		//}	
		//  switch ($aktif){
		//	case "0" : $where1="";Break;
		//	case "1" : $where1=" AND aktif='0' ";Break;
		//	case "2" : $where1=" AND aktif='1' ";Break;
		//	case "3" : $where1=" AND aktif='2' ";Break;
		//	case "4" : $where1=" AND aktif='3' ";Break;
		//	default  : $where1='';Break;	
		//  }	
		$data = mysql_query("select * from logbook_h where unit like '%$unit%' AND tipe like '%$tipe%'  AND fungsi like '%$fungsi%' AND bagian like '%$bagian%' AND status like '%$aktif' order by nama_barang");
	?>
	<table width="100%" class="list" cellpadding=3 cellspacing=0 border=1>
		<tr class="field">
			<td>No</td>
			<td>Kode</td>
			<td>Nama Barang</td>
			<td>Serial Number</td>
			<td>Jenis</td>
			<td>No INV</td>

			<td>Bagian</td>
			<td>Status</td>
			<td>Aksi</td>
		</tr>
		<?
		$no = 0;
		//$grandtotal=0;
		while ($data1 = mysql_fetch_assoc($data)) {
			$no++;
		?>

			<tr class="record">
				<td align="right"><?= $no ?></td>
				<?
				if ($data1['jenis'] == '0') {
					$jenis = 'Manual';
				}
				if ($data1['jenis'] == '1') {
					$jenis = 'Otomatis';
				}
				?>
				<td align="left"><a href=pmiqc.php?module=history_logbook&kode=<?= $data1[kode] ?>><?= $data1[kode] ?></a></td>
				<td align="left"><?= $data1[nama_barang] ?></td>
				<td align="left"><?= $data1[sn] ?></td>
				<td align="left"><?= $jenis ?></td>
				<td align="right"><?= $data1[no_inventarisasi] ?></td>
				<!--td align="right"><?= $data1[tempat] ?></td-->
				<td align="right"><?= $data1[tempat] ?></td>
				<?
				if ($data1['status'] == '0') {
					$status1 = 'Rusak';
				}
				if ($data1['status'] == '1') {
					$status1 = 'Baik';
				}
				if ($data1['status'] == '2') {
					$status1 = 'Dlm Proses Kalibrasi';
				}
				if ($data1['status'] == '3') {
					$status1 = 'Dlm Proses Perawatan';
				}
				?>
				<td align="right"><?= $status1 ?></td>
				<td><a href=pmiqc.php?module=entry_aksilogbook&ID=<? echo $data1[kode] ?>>Entry</a></td>
			</tr>
		<? } ?>

	</table>
</body>
<a href="javascript:window.print()">Cetak</a>
<br>
created : 21-12-17
</br>
<?
	}
?>
