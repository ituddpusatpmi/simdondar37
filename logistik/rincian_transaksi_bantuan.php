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
$h = mysql_fetch_assoc(mysql_query("select hstok_transaksi.notrans, hstok_transaksi.tanggal, hstok_transaksi.uraian, hstok_transaksi.noreferensi,
					        hstok_transaksi.jatuhtempo, hstok_transaksi.keterangan, hstok_transaksi.subtotal, hstok_transaksi.potongan,
						hstok_transaksi.ppn, hstok_transaksi.biayalain, hstok_transaksi.total, hstok_transaksi.bayar, hstok_transaksi.sisa,
						hstok_transaksi.petugas, hstok_transaksi.supplier,
						supplier.Kode, supplier.Nama, supplier.Alamat, supplier.Telp1
					from hstok_transaksi left join supplier on supplier.Kode=hstok_transaksi.supplier
					where notrans='$_GET[notrans]'"));
?>

<img src="logistik/img/kop_penerimaan.jpeg" width="100%"><br>

<h2>TRANSAKSI PENERIMAAN BARANG BANTUAN</h2>
<form name="transaksi" method="post" action="<?= $PHPSELF ?>">
	<table class="form" border="0" cellspacing="1" cellpadding="2" width=100%>
		<tr>
			<td width=120>Pengirim/Supplier</td>
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
			<td>Alamat</td>
			<td class="input">: <?= $h[Alamat] ?></td>
			<td>Tanggal Jatuh Tempo</td>
			<td class="input">: <?= $h[jatuhtempo] ?></td>
		</tr>
		<tr>
			<td colspan=2></td>
			<td>Referensi</td>
			<td class="input">: <?= $h[noreferensi] ?></td>
		</tr>
		<table class="list" border="1" cellspacing="0" cellpadding="0" width=100%>
			<tr class="field">
				<td>No</td>
				<td>Kode</td>
				<td>Nama Barang</td>
				<td>No.Lot</td>
				<td>ED</td>
				<td>Jml</td>
				<td>Satuan</td>
			</tr>
			<?
			$no = 0;
			$subtotal2 = 0;
			$detail = mysql_query("select hstok_transaksi_detail.kode, hstok_transaksi_detail.qtytransaksi, hstok_transaksi_detail.qtymasuk, hstok_transaksi_detail.qtykeluar,
				hstok_transaksi_detail.harga, hstok_transaksi_detail.diskonpersen, hstok_transaksi_detail.diskontotal, hstok_transaksi_detail.subtotal,
				hstok_transaksi_detail.catatan, hstok_transaksi_detail.nomorlot, hstok_transaksi_detail.kadaluwarsa,
				hstok_transaksi_detail.catatandetail, hstok.namabrg,hstok.satuan
			from hstok_transaksi_detail left join hstok on hstok.kode=hstok_transaksi_detail.kode
			where hstok_transaksi_detail.notrans='$_GET[notrans]' order by hstok_transaksi_detail.id asc");
			while ($dtrans = mysql_fetch_assoc($detail)) {
				$no++;
				$harga    = number_format($dtrans['harga'], 2, ',', '.');
				$qtymasuk = number_format($dtrans['qtymasuk'], 0, ',', '.');
				$tot1     = $dtrans['harga'] * $dtrans['qtymasuk'];
				$disk     = number_format($dtrans['diskonpersen'], 1, ',', '.');
				$pot      = $tot1 * $dtrans['diskonpersen'] / 100;
				$subtot    = $tot1 - $pot;
				$subtotal2 = $subtotal2 + $subtot;
				$subtotal = number_format($subtot, 2, ',', '.');
				echo "<tr class=\"record\">
                <td align=center>" . $no . "</td>
                <td align=left>" . $dtrans['kode'] . "</td>
		<td align=left>" . $dtrans['namabrg'] . "</td>
		<td align=left>" . $dtrans['nomorlot'] . "</td>
		<td align=left>" . $dtrans['kadaluwarsa'] . "</td>
		<td align=right>" . $dtrans['qtymasuk'] . "</td>
		<td align=left>" . $dtrans['satuan'] . "</td>
		</tr>";
			}
			?>
		</table>
	</table><br>
	<table class="list" border="0" cellspacing="1" cellpadding="2" width=750>
		<tr>
			<td align="center" valign="top">Pengirim,<br><br><br></td>
			<td align="center" valign="top">Petugas UDD,</td>
		</tr>
		<tr>
			<td align="center" class="input">(......................)</td>
			<td align="center" class="input">(<?= $h[petugas] ?>)</td>
		</tr>
	</table>
</form>
<a href="javascript:window.print()">Cetak</a>