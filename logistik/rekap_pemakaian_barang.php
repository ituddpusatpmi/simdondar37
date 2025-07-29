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
  $awalbulan=date("Y-m-01");
  $hariini = date("Y-m-d");
  
  
?>

<h2 class="list">REKAP PENGELUARAN/PEMAKAIAN BARANG KE BAGIAN DI UDD</h2>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
		<td>Pilih Periode : </td>
	<td>
		<input name="waktu" id="datepicker"  value="<?=$awalbulan?>" type=text size=10> Sampai Dengan
		<input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10>
		<td>
		<select name="bagian">
            <option value="">Semua bagian</option>
            <?php
				$q = "select Kode,Nama from `supplier` where jenis =2 order by Nama";
				$d = mysql_query($q,$con);
				 while($data=mysql_fetch_assoc($d)){
				?>
				<option value="<?=$data[Kode]?>"<?=$select?>>
				<?=$data[Nama]?>
				</option>
               <?}?>
				
			?>
          </select>
		
	</td>
		<td><input type=submit name=submit value="Submit"></td>
	</tr>
	</table>
</form>

<?
if (isset($_POST[submit])){

	$perbln=substr($_POST[waktu],5,2);
	$pertgl=substr($_POST[waktu],8,2);
	$perthn=substr($_POST[waktu],0,4);

	$perbln1=substr($_POST[waktu1],5,2);
	$pertgl1=substr($_POST[waktu1],8,2);
	$perthn1=substr($_POST[waktu1],0,4);
	$bagian = $_POST['bagian'];
?>
<h3 class="list">Periode <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> s/d <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?></h3>

<?
	if ($bagian ==""){
	$data=mysql_query("select
		      hstok_transaksi.tanggal, hstok_transaksi.notrans, hstok_transaksi.supplier, hstok_transaksi.noreferensi,hstok_transaksi.petugas,
		      supplier.Nama,
		      hstok_transaksi_detail.kode, hstok_transaksi_detail.qtykeluar,
		      hstok.namabrg, hstok.satuan, hstok.harga, hstok.status
		      from hstok_transaksi
		      left join supplier on supplier.Kode=hstok_transaksi.supplier
		      left join hstok_transaksi_detail on hstok_transaksi_detail.notrans=hstok_transaksi.notrans
		      left join hstok on hstok.kode=hstok_transaksi_detail.kode
		      where 
		      ((hstok_transaksi.jenis='OJ') OR (hstok_transaksi.jenis='AL') OR (hstok_transaksi.jenis='IO') )AND
		
		      date(hstok_transaksi.tanggal)>='$_POST[waktu]' AND
		      date(hstok_transaksi.tanggal)<='$_POST[waktu1]'
		      order by hstok_transaksi.tanggal, hstok_transaksi.notrans  asc");
	} else {
    $data=mysql_query("select
		      hstok_transaksi.tanggal, hstok_transaksi.notrans, hstok_transaksi.supplier, hstok_transaksi.noreferensi,hstok_transaksi.petugas,
		      supplier.Nama,
		      hstok_transaksi_detail.kode, hstok_transaksi_detail.qtykeluar,
		      hstok.namabrg, hstok.satuan, hstok.harga, hstok.status
		      from hstok_transaksi
		      left join supplier on supplier.Kode=hstok_transaksi.supplier
		      left join hstok_transaksi_detail on hstok_transaksi_detail.notrans=hstok_transaksi.notrans
		      left join hstok on hstok.kode=hstok_transaksi_detail.kode
		      where 
		      ((hstok_transaksi.jenis='OJ') OR (hstok_transaksi.jenis='AL') OR (hstok_transaksi.jenis='IO') )AND
		
		      date(hstok_transaksi.tanggal)>='$_POST[waktu]' AND
		      date(hstok_transaksi.tanggal)<='$_POST[waktu1]' AND supplier.Kode = '$bagian' 
		      order by hstok_transaksi.tanggal, hstok_transaksi.notrans  asc");
	}
?>
<table class="list" cellpadding=5 cellspacing=1 border=1 style="border-collapse:collapse">
	<tr class="field">
		<td>No</td>
		<td>Tanggal</td>
		<td>Nomor</td>
		<td>Nama Bagian</td>
		<td>Jenis</td>
		<td>Keterangan</td>
		<td>Kode</td>
		<td>Nama Barang</td>
		<td>Jumlah</td>
		<td>Harga</td>
		<td>Satuan</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
	$jumlah=number_format($data1['qtykeluar'],0,',','.');
	$harga=number_format($data1['harga'],0,',','.');
	?>
	
	<tr class="record">
		<td align="right"><?=$no?>.</td>
		<td align="center"><?=$data1[tanggal]?></td>
		<td align="center"><a href=pmilogistik.php?module=rincian_transaksi_keluar&notrans=<?=$data1[notrans]?>><?=$data1[notrans]?></a></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$data1[status]?></td>
		<td align="left"><?=$data1[noreferensi]?></td>
		<td align="left"><?=$data1[kode]?></td>
		<td align="left"><?=$data1[namabrg]?></td>
		<td align="right"><?=$jumlah?></td>
		<td align="right"><?=$harga?></td>
		<td align="left"><?=$data1[satuan]?></td>
	</tr>
	<? } ?>
</table>
</form>
<a href="javascript:window.print()">Cetak</a>
<?
}

