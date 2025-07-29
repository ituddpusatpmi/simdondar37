<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Pasien_Plebotomi.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$today=date("Y-m-d");
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];

?>
<h3 class="list">Rekap Plebotomi <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<?
$data=mysql_query("select transaksi_plebotomi.notransaksi, date(transaksi_plebotomi.tgltransaksi) as tgltransaksi, transaksi_plebotomi.tglaftap, transaksi_plebotomi.rumahsakit,
		   transaksi_plebotomi.dokterpasien, transaksi_plebotomi.diagnosa, transaksi_plebotomi.bagian, transaksi_plebotomi.petugaspenerima,
		   transaksi_plebotomi.aftaper, transaksi_plebotomi.dokterudd, transaksi_plebotomi.biaya, transaksi_plebotomi.nokantong,
		   transaksi_plebotomi.status, transaksi_plebotomi.catatan, transaksi_plebotomi.diambil, pasien_plebotomi.kode, pasien_plebotomi.nama,
		   pasien_plebotomi.alamat, pasien_plebotomi.kota, pasien_plebotomi.kelamin, pasien_plebotomi.lahir, pasien_plebotomi.golda,
		   pasien_plebotomi.rhesus, pasien_plebotomi.jumlah_plebotomi
		   FROM transaksi_plebotomi inner join pasien_plebotomi on pasien_plebotomi.kode=transaksi_plebotomi.kodepasien
		   where date(transaksi_plebotomi.tgltransaksi)>='$_POST[waktu]' and date(transaksi_plebotomi.tgltransaksi)<='$_POST[waktu1]'");
?>
<table class="list" cellpadding=5>
	<tr class="field">
		<td>No</td>
		<td>Tanggal</td>
		<td>Kode Pasien</td>
		<td>Nama Pasien</td>
		<td>Diagnosa</td>
		<td>No. Kantong</td>
		<td>Dokter Pasien</td>
		<td>Penerima</td>
		<td>Dokter UDD</td>
		<td>Aftaper</td>
		<td>Biaya</td>
		<td>Status</td>
		<td>Catatan</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		switch ($data1[status]){
                       case "0":
				$status="Belum diambil";break;
                       case "1":
				$status="Berhasil";break;
                       case "2":
				$status="Batal";break;
                       case "3":
				$status="Gagal";break;
		}
	?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[tgltransaksi]?></td>
		<td><?=$data1[kode]?></td>
		<td><?=$data1[nama]?></td>
		<td><?=$data1[diagnosa]?></td>
		<td><?=$data1[nokantong]?></td>
		<td><?=$data1[dokterpasien]?></td>
		<td><?=$data1[petugaspenerima]?></td>
		<td><?=$data1[dokterudd]?></td>
		<td><?=$data1[aftaper]?></td>
		<td><?=$data1[biaya]?></td>
		<td><?=$status?></td>
		<td><?=$data1[catatan]?></td>
	</tr>
	<?
	}
?>
</table>