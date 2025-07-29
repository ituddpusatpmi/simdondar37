<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?
  include('clogin.php');
  include('config/db_connect.php');
?>

<?
  $h=mysql_fetch_assoc(mysql_query("select hstok_order.notrans, hstok_order.tanggal, hstok_order.uraian, hstok_order.catatanlain,
					    hstok_order.catatanlain, hstok_order.subtotal, hstok_order.potongan,
					    hstok_order.ppn, hstok_order.biayalain, hstok_order.total,
					    hstok_order.petugas, hstok_order.supplier,
					    supplier.Kode, supplier.Nama, supplier.Alamat, supplier.Telp1, supplier.namaCp
				    from hstok_order left join supplier on supplier.Kode=hstok_order.supplier
				    where hstok_order.notrans='$_GET[notrans]'"));
  $utd=mysql_fetch_assoc(mysql_query("select nama from utd where aktif=1"));
$dir=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa order by Nama ASC limit 1 "));
  
?>
<title>PO <?=$utd[nama]?></title>
<!--img src='images/header_pmi_750x62.png' width=750px-->
<!--img src="logistik/img/orderpembelian.jpg" width="100%"><br-->
<body>
<h1><?=$utd[nama]?></h1>
<h3><strong>ORDER PEMBELIAN</h3></strong>
<form name="transaksi"  method="post" action="<?=$PHPSELF?>">
  <table class="record" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
    <tr>
	<td width=120>Kode Supplier</td><td class="input" >: <?=$h[supplier]?></td>
	<td width=130>Nomor Transaksi</td><td width=150 class="input">: <?=$h[notrans]?></td>
    </tr>
    <tr>
	<td>Nama Supplier</td><td class="input">: <?=$h[Nama]?></td>
	<td>Tanggal</td><td class="input">: <?=$h[tanggal]?></td>
    </tr>
    <tr>
	<td>Alamat</td><td class="input" >: <?=$h[Alamat]?></td>
	<td>Referensi</td><td class="input">: <?=$h[noreferensi]?></td>
    </tr>
    <tr>
	<td>Telp</td><td class="input" >: <?=$h[Telp1]?></td>
	<td colspan=2></td>
    </tr>
    <table class="record" border="1" cellspacing="0" cellpadding="0" width=750 style="border-collapse:collapse">
      <tr class="field">
	<td align="center">No</td>
	<td align="center" colspan="2">Nama Barang</td>
	<td align="center">Jml<br>Order</td>
	<td align="center">Satuan</td>
	<td align="center">Harga<br>Satuan</td>
	<td align="center">Disc<br>(%)</td>
	<td align="center">Total</td>
	<td align="center">Kode<br>AB</td>
      </tr>
      <?
      $no=0;
      $subtotal2=0;
      $detail=mysql_query("select hstok_order_detail.kode, hstok_order_detail.qtyorder, hstok_order_detail.kode_rab,
				hstok_order_detail.harga, hstok_order_detail.diskonpersen, hstok_order_detail.diskontotal, hstok_order_detail.subtotal,
				hstok_order_detail.catatan, hstok_order_detail.catatandetail,
				hstok_order_detail.catatandetail, hstok.namabrg,hstok.satuan
			from hstok_order_detail left join hstok on hstok.kode=hstok_order_detail.kode
			where hstok_order_detail.notrans='$_GET[notrans]' order by hstok_order_detail.id asc");
    while ($dtrans = mysql_fetch_assoc($detail)){
	  $no++;
	  $harga    = number_format($dtrans['harga'],2,',','.');
	  $qtymasuk = number_format($dtrans['qtyorder'],0,',','.');
	  $tot1     = $dtrans['harga'] * $dtrans['qtyorder'];
	  $disk     = number_format($dtrans['diskonpersen'],1,',','.'); 
	  $pot      = $tot1 * $dtrans['diskonpersen'] /100;
	  $subtot    = $tot1 - $pot;
	  $subtotal2=$subtotal2+$subtot;
	  $subtotal = number_format($subtot,2,',','.');
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                
		<td align=left colspan=2>".$dtrans['namabrg']."</td>
		<td align=center>".$dtrans['qtyorder']."</td>
		<td align=center>".$dtrans['satuan']."</td>
		<td align=right>".$harga."</td>
		<td align=right>".$disk."</td>
		<td align=right>".$subtotal."</td>
		<td align=center>".$dtrans['kode_rab']."</td>
		</tr>";
  }
  if ($no<10){
    $no1=$no;
    While (($no1+$no)<11){
      $no1++;
      echo "<tr class=\"record\">
                <td align=center>".$no1."</td>
                <td align=left colspan=2></td>
		<td align=center></td>
		<td align=center></td>
		<td align=right></td>
		<td align=right></td>
		<td align=right></td>
		<td align=right></td>
		</tr>";
    }
  }
  $potongan=$h[potongan];
  $ppn=$h[ppn];
  $biaya=$h[biayalain];
  $ppntotal=($subtotal2-$potongan)*$ppn/100;
  $total2=$h[total];
  $subtotal2=number_format($subtotal2,2,',','.');
  $potongan=number_format($potongan,2,',','.');
  $ppntotal=number_format($ppntotal,2,',','.');
  $biaya=number_format($biaya,2,',','.');
  $total2=number_format($total2,2,',','.');

  ?>
  <tr class="record">
    <td colspan=7 align="right" >Sub Total</td><td class="input" align="right"><?=$subtotal2?></td><td></td>
  </tr> 
  <tr class="record">
    <td colspan=7 align="right">Potongan</td><td class="input" align="right"><?=$potongan?></td><td></td>
  </tr>
  <tr class="record">
      <td colspan=7 align="right">PPN</td><td class="input" align="right"><?=$ppntotal?></td><td></td>
  </tr>
  <tr class="record">
    <td colspan=7 align="right">Biaya</td><td class="input" align="right"><?=$biaya?></td><td></td>
  </tr>
  <tr class="record">
    <td colspan=7 align="right">TOTAL</td><td class="input" align="right"><?=$total2?></td><td></td>
  </tr>
</table>
</table>
<table class="list" border="0" cellspacing="1" cellpadding="2" width=750 style="border-collapse:collapse">
  <tr>
   <td align="left" valign="top">Catatan : <?=$h[catatanlain]?></td>
  </tr>
  <tr>
   <td align="center" valign="top">Supplier,<br><br><br><br></td>
   <td align="center" valign="top"><?=$utd[nama]?><br>Bag Logistik,</td>
   <td align="center" valign="top"><?=$utd[nama]?><br>Mengetahui:,</td>
  </tr>
  <tr>
    <td align="center" class="input" >(______________________)</td>
    <td align="center" class="input" >(<?=$h[petugas]?>)</td>
    <td align="center" class="input" >(______________________)</td>
  </tr>
</table>
</form>
</body>
<tfoot>
<table width=750px>
  <tr>
    <?
    $waktu=date('Y-m-d H:i:s');?>
    <td align=right><a href="javascript:window.print()"><?=$waktu?></a></td>
    <td align=center></td>
    </tr>
</table>
</tfoot>
  

