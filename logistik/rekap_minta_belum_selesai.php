<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

<?
  include('clogin.php');
  include('config/db_connect.php');
?>
<h2 class="list">PEMINTAAN BARANG DARI BAGIAN UTD YANG BELUM SELESAI DIPROSES</h2>
<?
    $data=mysql_query("select hstok_order.*, supplier.Nama 
		      from hstok_order left join supplier on supplier.Kode=hstok_order.supplier
		      where 
		      hstok_order.jenis='SO' AND
		      hstok_order.status_order<>2
		      order by hstok_order.tanggal, hstok_order.notrans");
?>
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Tanggal</td>
		<td>Nomor</td>
		<td>Kode</td>
		<td>Nama Bagian</td>
		<td>Referensi</td>
		<td>Status</td>
		<td>Aksi</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
	$status=$data1['status_order'];
	if ($status=="0"){
	  $statusorder="Belum Proses";
	} elseif($status=="1"){
	  $statusorder="Sedang diproses";
	} else{
	  $statusorder="Sudah selesai";
	}
	?>
	<tr class="record">
		<td align="right"><?=$no?>.</td>
		<td align="center"><?=$data1[tanggal]?></td>
		<td align="center"><?=$data1[notrans]?></td>
		<td align="left"><?=$data1[supplier]?></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$data1[noreferensi]?></td>
		<td align="left"><?=$statusorder?></td>
		<td align="center">
		  <a href=pmilogistik.php?module=rincian_minta_barang&notrans=<?=$data1[notrans]?>>Lihat</a>|
		  <a href=pmilogistik.php?module=transaksi_penuhi_barang&notrans=<?=$data1[notrans]?>>Penuhi</a>|
		  <a href=pmilogistik.php?module=close_minta_barang&notrans=<?=$data1[notrans]?>>Selesaikan</a>
		</td>
	</tr>
	<? } ?>
</table>

<?

?>
