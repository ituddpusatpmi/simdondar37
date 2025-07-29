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
<h2 class="list">REKAP HUTANG PEMBELIAN BARANG</h2>
<?
    $data=mysql_query("select hstok_transaksi.*, supplier.Nama 
		      from hstok_transaksi left join supplier on supplier.Kode=hstok_transaksi.supplier
		      where 
		      hstok_transaksi.jenis='PJ' AND
		      hstok_transaksi.sisa>0
		      order by hstok_transaksi.tanggal asc");
?>
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Tanggal</td>
		<td>Nomor</td>
		<td>Kode</td>
		<td>Nama Supplier</td>
		<td>Referensi</td>
		<td>Sub Total</td>
		<td>Potongan</td>
		<td>PPN</td>
		<td>Biaya</td>
		<td>TOTAL</td>
		<td>Terbayar</td>
		<td>Sisa Hutang</td>
		<td>Pelunasan</td>
	</tr>
	<?
	$no=0;
	$sumtotal=0;
	$sumsubtotal=0;
	$sumpotongan=0;
	$sumppn=0;
	$sumbiaya=0;
	$sumbayar=0;
	$sumsisa=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	  $no++;
	  $subtotal 	=number_format($data1['subtotal'],0,',','.');
	  $potongan 	=number_format($data1['potongan'],0,',','.');
	  $bayar 	=number_format($data1['bayar'],0,',','.');
	  $sisa 	=number_format($data1['sisa'],0,',','.');
	  $total 	=number_format($data1['total'],0,',','.');
	  $biayalain 	=number_format($data1['biayalain'],0,',','.');
	  $ppnrupiah	=($data1['subtotal'] - $data1['potongan'])*$data1['ppn']/100;
	  $ppnrupiah	=number_format($ppnrupiah,0,',','.');
	  $sumtotal	=$sumtotal+$data1['total'];
	  $sumsubtotal	=$sumsubtotal+$data1['subtotal'];
	  $sumpotongan	=$sumpotongan+$data1['potongan'];
	  $sumppn	=$sumppn+ (($data1['subtotal'] - $data1['potongan'])*$data1['ppn']/100);
	  $sumbiaya	=$sumbiaya+$data1['biayalain'];
	  $sumbayar	=$sumbayar+$data1['bayar'];
	  $sumsisa	=$sumsisa+$data1['sisa'];
	  
	  $fsisa	=number_format($sumsisa,0,',','.');
	  $ftotal	=number_format($sumtotal,0,',','.');
	  $fsubtotal	=number_format($sumsubtotal,0,',','.');
	  $fpotongan	=number_format($sumpotongan,0,',','.');
	  $fppn		=number_format($sumppn,0,',','.');
	  $fbiaya	=number_format($sumbiaya,0,',','.');
	  $fbayar	=number_format($sumbayar,0,',','.');
	  ?>
	  <tr class="record">
		<td align="right"><?=$no?>.</td>
		<td align="center"><?=$data1[tanggal]?></td>
		<td align="center"><a href=pmilogistik.php?module=rincian_transaksi_beli&notrans=<?=$data1[notrans]?>><?=$data1[notrans]?></a></td>
		<td align="left"><?=$data1[supplier]?></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$data1[noreferensi]?></td>
		<td align="right"><?=$subtotal?></td>
		<td align="right"><?=$potongan?></td>
		<td align="right"><?=$ppnrupiah?></td>
		<td align="right"><?=$biayalain?></td>
		<td align="right"><?=$total?></td>
		<td align="right"><?=$bayar?></td>
		<td align="right"><?=$sisa?></td>
		<td align="center"><a href=pmilogistik.php?module=lunas&notrans=<?=$data1[notrans]?>>LUNASI</a></td>
		</tr>
	<? }
	?>
	<tr class="record">
	  <td colspan="6" align="center">TOTAL HUTANG PEMBELIAN</td>
	  <td align="right"><?=$fsubtotal?></td>
	  <td align="right"><?=$fpotongan?></td>
	  <td align="right"><?=$fppn?></td>
	  <td align="right"><?=$fbiaya?></td>
	  <td align="right"><?=$ftotal?></td>
	  <td align="right"><?=$fbayar?></td>
	  <td align="right"><?=$fsisa?></td>
	</tr>
	<?
	?>
</table>
</form>

<?

?>
