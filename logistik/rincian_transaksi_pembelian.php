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
  $h=mysql_fetch_assoc(mysql_query("select hstok_transaksi.notrans, hstok_transaksi.tanggal, hstok_transaksi.uraian, hstok_transaksi.noreferensi,hstok_transaksi.po,
					        hstok_transaksi.jatuhtempo, hstok_transaksi.keterangan, hstok_transaksi.subtotal, hstok_transaksi.potongan,
						hstok_transaksi.ppn, hstok_transaksi.biayalain, hstok_transaksi.total, hstok_transaksi.bayar, hstok_transaksi.sisa,
						hstok_transaksi.petugas, hstok_transaksi.supplier,
						supplier.Kode, supplier.Nama, supplier.Alamat, supplier.Telp1, supplier.namaCp
					from hstok_transaksi left join supplier on supplier.Kode=hstok_transaksi.supplier
					where notrans='$_GET[notrans]'"));
?>
<!--img src="logistik/img/transaksipembelian.jpg" width="100%"><br-->
                                   
<h2>TRANSAKSI PENERIMAAN/PEMBELIAN BARANG</h2>
<form name="transaksi"  method="post" action="<?=$PHPSELF?>">
  <table class="form" border="0" cellspacing="1" cellpadding="2" width="100%">
    <tr>
	<td width=120 style="color: black;">Kode Supplier</td><td class="input" >: <?=$h[supplier]?></td>
	<td width=130 style="color: black;">Nomor Transaksi</td><td width=150 class="input">: <?=$h[notrans]?></td>
    </tr>
    <tr>
	<td width=120 style="color: black;">Nama Supplier</td><td class="input">: <?=$h[Nama]?></td>
	<td style="color: black;">Tanggal</td><td class="input">: <?=$h[tanggal]?></td>
    </tr>
    <tr>
	<td style="color: black;">Alamat</td><td class="input" >: <?=$h[Alamat]?></td>
	<td style="color: black;">Tanggal Jatuh Tempo</td><td class="input">: <?=$h[jatuhtempo]?></td>
    </tr>
    <tr>
	<td style="color: black;">Referensi</td><td class="input">: <?=$h[noreferensi]?></td>
	<td style="color: black;">Nomor PO</td><td class="input">: <?=$h[po]?></td>
    </tr>
    <table class="list" border="1" cellspacing="0" cellpadding="4" width="100%">
      <tr class="field">
	<td align="center" style="color: black;">No</td>
	<td align="center" style="color: black;">Kode</td>
	<td align="center" style="color: black;">Nama Barang</td>
	<td align="center" style="color: black;">No.Lot</td>
	<td align="center" style="color: black;">ED</td>
	<td align="center" style="color: black;">Jml</td>
	<td align="center" style="color: black;">Satuan</td>
	<td align="center" style="color: black;">Harga<br>Satuan</td>
	<td align="center" style="color: black;">Disc<br>(%)</td>
	<td align="center" style="color: black;">Total</td>
      </tr>
      <?
      $no=0;
      $subtotal2=0;
      $detail=mysql_query("select hstok_transaksi_detail.kode, hstok_transaksi_detail.qtytransaksi, hstok_transaksi_detail.qtymasuk, hstok_transaksi_detail.qtykeluar,
				hstok_transaksi_detail.harga, hstok_transaksi_detail.diskonpersen, hstok_transaksi_detail.diskontotal, hstok_transaksi_detail.subtotal,
				hstok_transaksi_detail.catatan, hstok_transaksi_detail.nomorlot, hstok_transaksi_detail.kadaluwarsa,
				hstok_transaksi_detail.catatandetail, hstok.namabrg,hstok.satuan
			from hstok_transaksi_detail left join hstok on hstok.kode=hstok_transaksi_detail.kode
			where hstok_transaksi_detail.notrans='$_GET[notrans]' order by hstok_transaksi_detail.id asc");
    while ($dtrans = mysql_fetch_assoc($detail)){
	  $no++;
	  $harga    = number_format($dtrans['harga'],2,',','.');
	  $qtymasuk = number_format($dtrans['qtymasuk'],0,',','.');
	  $tot1     = $dtrans['harga'] * $dtrans['qtymasuk'];
	  $disk     = number_format($dtrans['diskonpersen'],1,',','.'); 
	  $pot      = $tot1 * $dtrans['diskonpersen'] /100;
	  $subtot    = $tot1 - $pot;
	  $subtotal2=$subtotal2+$subtot;
	  $subtotal = number_format($subtot,2,',','.');
        if ($dtrans['kadaluwarsa']=="0000-00-00"){$ed="-";} else{$ed=$dtrans['kadaluwarsa'];}
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['kode']."</td>
		<td align=left>".$dtrans['namabrg']."</td>
		<td align=left>".$dtrans['nomorlot']."</td>
		<td align=left>".$ed."</td>
		<td align=right>".$dtrans['qtymasuk']."</td>
		<td align=left>".$dtrans['satuan']."</td>
		<td align=right>".$harga."</td>
		<td align=right>".$disk."</td>
		<td align=right>".$subtotal."</td>
		</tr>";
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
  <tr class="field">
    <td colspan=9 align="right" style="color: black;">Sub Total</td><td class="input" align="right" style="color: black;"><?=$subtotal2?></td>
  </tr> 
  <tr class="record">
    <td colspan=9 align="right">Potongan</td><td class="input" align="right"><?=$potongan?></td>
  </tr>
  <tr class="record">
      <td colspan=9 align="right">PPN</td><td class="input" align="right"><?=$ppntotal?></td>
  </tr>
  <tr class="record">
    <td colspan=9 align="right">Biaya</td><td class="input" align="right"><?=$biaya?></td>
  </tr>
  <tr class="field">
    <td colspan=9 align="right" style="color: black;">TOTAL</td><td class="input" align="right" style="color: black;"><?=$total2?></td>
  </tr>
</table>
</table><br>
<table class="list" border="0" cellspacing="1" cellpadding="2" width="100%">
    <tr>
        <td align="center" valign="top">Disahkan Oleh,<br><br><br></td>
        <td align="center" valign="top">Penyedia,</td>
        <td align="center" valign="top">Petugas Logistik UDD,</td>
    </tr>
  <tr>
      <td align="center" class="input">(......................)</td>
      <!-- <td align="center" class="input">(<?= $h[namaCp] ?>)</td> -->
      <td align="center" class="input">(......................)</td>
      <!-- <td align="center" class="input">(<?= $h[petugas] ?>)</td> -->
      <td align="center" class="input">(......................)</td>
  </tr>
</table>
</form>
  
<a href="javascript:window.print()">Cetak</a>

  

