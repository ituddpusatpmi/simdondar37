<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_barang_keluar.xls");
header("Pragma: no-cache");
header("Expires: 0");

 include('clogin.php');
include('../config/db_connect.php');

$today=$_POST[today];
$today1=$_POST[today1];
$kategori=$_POST[kategori1];
$jenis=$_POST[jenis1];
$bagian=$_POST[bagian1];



?>
<h1>REKAP BARANG KELUAR</h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>

<?
    $data=mysql_query("select
		      hstok_transaksi.tanggal, hstok_transaksi.notrans, hstok_transaksi.supplier, hstok_transaksi.noreferensi,hstok_transaksi.petugas,
		      supplier.Nama,
		      hstok_transaksi_detail.kode, hstok_transaksi_detail.qtykeluar,
		      hstok.namabrg, hstok.satuan, hstok.status, hstok.kategori
		      from hstok_transaksi
		      left join supplier on supplier.Kode=hstok_transaksi.supplier
		      left join hstok_transaksi_detail on hstok_transaksi_detail.notrans=hstok_transaksi.notrans
		      left join hstok on hstok.kode=hstok_transaksi_detail.kode
		      where 
		      ((hstok_transaksi.jenis='OJ') OR (hstok_transaksi.jenis='AL') OR (hstok_transaksi.jenis='IO') )AND
		
		      date(hstok_transaksi.tanggal)>='$today' AND 
		      date(hstok_transaksi.tanggal)<='$today1' AND supplier.Nama like '%$bagian%' 
			AND hstok.status like '%$jenis%'  AND hstok.kategori like '%$kategori%'
		      order by hstok_transaksi.tanggal, hstok_transaksi.notrans  asc");
?>
<table class="list" cellpadding=5 cellspacing=1 border=1 style="border-collapse:collapse">
	<tr class="field">
		<td>No</td>
		<td>Tanggal</td>
		<td>Nomor Transaksi</td>
		<td>Nama Bagian</td>
		<td>Keterangan</td>
		<td>Kode</td>
		<td>Nama Barang</td>
		<td>Jumlah</td>
		<td>Satuan</td>
		<td>Petugas</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
	$jumlah=number_format($data1['qtykeluar'],0,',','.');
	?>
	
	<tr class="record">
		<td align="right"><?=$no?>.</td>
		<td align="center"><?=$data1[tanggal]?></td>
		<td align="center"><?=$data1[notrans]?></a></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$data1[noreferensi]?></td>
		<td align="left"><?=$data1[kode]?></td>
		<td align="left"><?=$data1[namabrg]?></td>
		<td align="right"><?=$jumlah?></td>
		<td align="left"><?=$data1[satuan]?></td>
		<td align="left"><?=$data1[petugas]?></td>
	</tr>
	<? } ?>
</table>


<?
mysql_close();
?>
