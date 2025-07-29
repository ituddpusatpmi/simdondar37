<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/disable_enter.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.5.2.min.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />

<?
include('../config/db_connect.php');
?>

<?
$h = mysql_fetch_assoc(mysql_query("select hstok_order.notrans, hstok_order.tanggal, hstok_order.uraian, hstok_order.catatanlain,
					    hstok_order.catatanlain, hstok_order.subtotal, hstok_order.potongan,
					    hstok_order.ppn, hstok_order.biayalain, hstok_order.total,
					    hstok_order.petugas, hstok_order.supplier,
					    supplier.Kode, supplier.Nama, supplier.Alamat, supplier.Telp1, supplier.namaCp
				    from hstok_order left join supplier on supplier.Kode=hstok_order.supplier
				    where hstok_order.notrans='$_GET[notrans]'"));
$utd = mysql_fetch_assoc(mysql_query("select nama from utd where aktif=1"));

?>
<title>PO <?= $utd[nama] ?></title>

<body>
  <!--img src="../logistik/img/permintaanbarang.jpg" width="100%"><br-->

  <h2><strong>PERMINTAAN BARANG</h2></strong>
  <form name="transaksi" method="post" action="<?= $PHPSELF ?>">
    <table class="record" border="0" cellspacing="1" cellpadding="4" width="100%" style="border-collapse:collapse">
      <tr>
        <td width=120>Bagian</td>
        <td class="input">: <?= $h[supplier] ?></td>
        <td width=130>Nomor Transaksi</td>
        <td width=150 class="input">: <?= $h[notrans] ?></td>
      </tr>
      <tr>
        <td></td>
        <td class="input">: <?= $h[Nama] ?></td>
        <td>Tanggal</td>
        <td class="input">: <?= $h[tanggal] ?></td>
      </tr>
      <tr>
        <td>Penanggung Jawab</td>
        <td class="input">: <?= $h[namaCp] ?></td>
        <td>Referensi</td>
        <td class="input">: <?= $h[noreferensi] ?></td>
      </tr>
      <table class="record" border="1" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse">
        <tr class="field">
          <td align="center">No</td>
          <td align="center">Kode</td>
          <td align="center" colspan=2>Nama Barang</td>
          <td align="center">Jml<br>Order</td>
          <td align="center">Satuan</td>
        </tr>
        <?
        $no = 0;
        $subtotal2 = 0;
        $detail = mysql_query("select hstok_order_detail.kode, hstok_order_detail.qtyorder,
				hstok_order_detail.harga, hstok_order_detail.diskonpersen, hstok_order_detail.diskontotal, hstok_order_detail.subtotal,
				hstok_order_detail.catatan, hstok_order_detail.catatandetail,
				hstok_order_detail.catatandetail, hstok.namabrg,hstok.satuan
			from hstok_order_detail left join hstok on hstok.kode=hstok_order_detail.kode
			where hstok_order_detail.notrans='$_GET[notrans]' order by hstok_order_detail.id asc");
        while ($dtrans = mysql_fetch_assoc($detail)) {
          $no++;
          $qtorder = number_format($dtrans['qtyorder'], 0, ',', '.');
          echo "<tr class=\"record\">
                <td align=center>" . $no . "</td>
                <td align=left>" . $dtrans['kode'] . "</td>
		<td align=left colspan=2>" . $dtrans['namabrg'] . "</td>
		<td align=right>" . $qtorder . "</td>
		<td align=left>" . $dtrans['satuan'] . "</td>
		</tr>";
        }
        if ($no < 10) {
          $no1 = $no;
          while (($no1 + $no) < 11) {
            $no1++;
            echo "<tr class=\"record\">
                <td align=center>" . $no1 . "</td>
		<td align=right></td>
                <td align=left colspan=2></td>
		<td align=right></td>
		<td align=left></td>
		</tr>";
          }
        }
        ?>
      </table>

    </table>
    <table class="list" border="0" cellspacing="1" cellpadding="2" width="100%" style="border-collapse:collapse">
      <tr>
        <td align="left" valign="top">Catatan : <?= $h[catatanlain] ?></td>
      </tr>
      <tr>
        <td align="center" valign="top">Logistik,<br><br><br><br></td>
        <td align="center" valign="top">Disahkan Oleh,</td>
        <td align="center" valign="top"><?= $utd[nama] ?><br>Yang meminta,</td>
      </tr>
      <tr>
        <td align="center" class="input">(______________________)</td>
        <td align="center" class="input">(______________________)</td>
        <td align="center" class="input">(<?= $h[petugas] ?>)</td>
      </tr>
    </table>
  </form>
</body>
<tfoot>
  <table width="100%">
    <tr>
      <?
      $waktu = date('Y-m-d H:i:s'); ?>
      <td align=right><a href="javascript:window.print()"><?= $waktu ?></a></td>
      <td align=center></td>
    </tr>
  </table>
</tfoot>
