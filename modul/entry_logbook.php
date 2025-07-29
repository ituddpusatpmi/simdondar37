<?php
require_once('config/db_connect.php');
session_start();
$namaudd = $_SESSION[namaudd];
?>

<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disable_enter.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>

</script>
<?
//include('../clogin.php');
include('../config/db_connect.php');
$namauser = $_SESSION[namauser];
if (isset($_POST[submit])) {
	$kode = strtoupper($_POST[Kode]);
	$nama_barang = strtoupper($_POST[nama_barang]);
	$tipe = $_POST[tipe];
	$unit = $_POST[unit];
	$jenis = $_POST[jenis];
	$sn = $_POST[sn];
	$no_inventarisasi = $_POST[no_inventarisasi];
	$tempat = $_POST[tempat];
	$bagian = $_POST[bagian];
	$tahun = $_POST[tahun];
	$tgl_kalibrasi = $_POST[tgl_kalibrasi];
	$suplier = $_POST[suplier];
	$jenis_pengadaan = $_POST[jenis_pengadaan];
	$asal = $_POST[asal];
	$harga = $_POST[harga];
	$status = $_POST[status];
	$fungsi = $_POST[fungsi];

	if ($kode !== "") {
		$tambah = mysql_query("insert into logbook_h (kode, unit, nama_barang ,tipe, jenis, sn, no_inventarisasi, tempat, bagian, tahun, 			tgl_kalibrasi, suplier, jenis_pengadaan, asal, harga,status, fungsi) values
		('$kode','$unit','$nama_barang','$tipe','$jenis','$sn','$no_inventarisasi','$tempat','$bagian','$tahun','$tgl_kalibrasi','$suplier',
		'$jenis_pengadaan','$asal','$harga','$status','$fungsi')");
		//=======Audit Trial====================================================================================
		$log_mdl = 'LOGBOOK';
		$log_aksi = 'Input master Logbook Kode: ' . $kode . ' Nama barang: ' . $nama_barang . ' Bagian: ' . $bagian . ' status: ' . $status;
		include_once "user_log.php";
		//=====================================================================================================

		if ($tambah) {
			echo "Data Barang Telah berhasil dientry <script>parent.$.fn.colorbox.close();</script>";
?>
			<META http-equiv="refresh" content="1; url=pmiqc.php?module=entry_logbook"><?
																					} else {
																						echo "Data Barang gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
																						?>
			<META http-equiv="refresh" content="1; url=pmiqc.php?module=entry_logbook"><?
																					}
																				} else {
																					echo "Data tidak bisa dimasukkan Kode minimal 3 karakter <script>parent.$.fn.colorbox.close();</script>";
																				}
																			}
																						?>
<form name="barang" method="POST" action="<?= $PHPSELF ?>">
	<h1>Entry Master Log Book</h1>
	<table class="form" border="2">
		<tr>
			<td>Kode Barang</td>
			<td class="input"><input name="Kode" type="text" size="15"></td>
		</tr>
		<tr>
			<td>Unit</td>
			<td class="input">
				<select name="unit">
					<option value="UTD">UTD</option>
					<option value="Markas">Markas</option>
				</select>
			</td>
		</tr>

		<tr>
			<td>Nama Barang</td>
			<td class="input"><input name="nama_barang" type="text" size="30"></td>
		</tr>
		<tr>
			<td>Tipe</td>
			<td class="input">
				<select name="tipe">
					<option value="Medis">Medis</option>
					<option value="Non Medis">Non Medis</option>
				</select>
		</tr>
		<tr>
			<td>Jenis</td>
			<td class="input">
				<select name="jenis">
					<option value="0">Manual</option>
					<option value="1">otomatis</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Fungsi</td>
			<td class="input">
				<select name="fungsi">
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
		</tr>

		<tr>
			<td>No. Seri</td>
			<td class="input"><input name="sn" type="text" size="20"></td>
		</tr>

		<tr>
			<td>No. Inventarisasi</td>
			<td class="input"><input name="no_inventarisasi" type="text" size="20"></td>
		</tr>

		<tr>
			<td>Tempat</td>
			<td class="input"><input name="tempat" type="text" size="15" </td>
		</tr>
		<tr>
			<td>Bagian</td>
			<td class="input">
				<select name="bagian">
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
					<option value="Distribusi">Distribusi(BDRS)</option>
					<option value="HumasIT">Humas & IT</option>
					<option value="Pimpinan">Pimpinan</option>
					<option value="Konseling">Konseling</option>
					<option value="Administrator">Administrator</option>
					<option value="QA">QA</option>
					<option value="QC">QC</option>
					<option value="Keuangan">Keuangan</option>
					<option value="Umum">Umum</option>
					<option value="SDM">SDM</option>
					<option value="Aset Sarpras">Aset & Sarpras</option>
					<option value="Kasir CSO">Kasir & CSO</option>
					<option value="Poliklinik">Poliklinik</option>
					<option value="Koperasi">Koperasi</option>
					<option value="Hemodialisis">Hemodialisis</option>
					<option value="Poli Kandungan">Poli Kandungan</option>
					<option value="PB Satgana">PB/Satgana</option>
					<option value="Sekretariat">Sekretariat</option>
					<option value="Lab Klinik">Lab. Klinik</option>
					<option value="Mobile Unit">Mobile Unit</option>
				</select>
		</tr>
		<tr>
			<td>Tahun</td>
			<td class="input"><input name="tahun" type="text" size="5" </td>
		</tr>
		<tr>
			<td>Tgl Kalibrasi</td>
			<td class="input"> <input type="text" name="tgl_kalibrasi" id="datepicker" placeholder="yyyy-mm-dd" size=11></td>
		</tr>
		<tr>
			<td>Suplier</td>
			<td class="input"><input name="suplier" type="text" size="20"></td>
		</tr>
		<tr>
			<td>Jenis Pengadaan</td>
			<td class="input">
				<select name="jenis_pengadaan">
					<option value="0">Pembelian Alat Baru</option>
					<option value="1">Bantuan</option>

				</select>
		</tr>
		<tr>
			<td>Asal</td>
			<td class="input"><input name="asal" type="text" size="15"></td>
		</tr>
		<tr>
			<td>Nilai (Harga)</td>
			<td class="input"><input name="harga" type="text" size="10"></td>
		</tr>
		<tr>
			<td>Status (Keadaan)</td>
			<td class="input">
				<select name="status">
					<option value="1">Baik</option>
					<option value="0">Rusak</option>
					<option value="2">Dalam Proses Kalibrasi</option>
					<option value="3">Dalam Proses Perawatan</option>
				</select>
			</td>
		</tr>
	</table>
	<input name="submit" type="submit" value="Simpan Data">
</form>
