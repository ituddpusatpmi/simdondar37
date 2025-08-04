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

function format_ribuan($nilai)
{
	return number_format($nilai, 0, ',', '.');
}

?>

<?
$h = mysql_fetch_assoc(mysql_query("select hstok_transaksi.notrans, hstok_transaksi.tanggal, hstok_transaksi.uraian, hstok_transaksi.noreferensi,
					        hstok_transaksi.jatuhtempo, hstok_transaksi.keterangan, hstok_transaksi.subtotal, hstok_transaksi.potongan,
						hstok_transaksi.ppn, hstok_transaksi.biayalain, hstok_transaksi.total, hstok_transaksi.bayar, hstok_transaksi.sisa,
						hstok_transaksi.petugas, hstok_transaksi.supplier,
						supplier.Kode, supplier.Nama, supplier.Alamat, supplier.Telp1, supplier.namaCp
					from hstok_transaksi left join supplier on supplier.Kode=hstok_transaksi.supplier
					where notrans='$_GET[notrans]'"));
?>
<!--img src="logistik/img/transaksipemakaian.jpg" width="100%"><br-->

<h2>TRANSAKSI PENGELUARAN/PEMAKAIAN BARANG</h2>
<form name="transaksi" method="post" action="<?= $PHPSELF ?>">
	<table class="record" border="0" cellspacing="1" cellpadding="2" width="100%">
		<tr>
			<td width=120>Penerima</td>
			<td class="input">: <?= $h[supplier] ?></td>
			<td width=130>Nomor Transaksi</td>
			<td width=150 class="input">: <a href="javascript:window.print()"><?= $h[notrans] ?></a></td>
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
		<table class="record" border="1" cellspacing="1" cellpadding="4" width="100%" style="border-collapse:collapse">
			<tr class="field">
				<td align="center">NO</td>
				<td align="center">KODE</td>
				<td align="center">NAMA BARANG</td>
				<td align="center">NO. LOT</td>
				<td align="center">KADALUARSA</td>
				<td align="center">JUMLAH<br>MINTA</td>
				<td align="center">JUMLAH<br>DIBERI</td>
				<td align="center">SATUAN</td>
				<!--td align="center">Harga @<br>(Rp.)</td>
				<td align="center">Total<br>(Rp.)</td-->
			</tr>
			<?
			$no = 0;
			$subtotal2 = 0;
			$detail = mysql_query("select hstok_transaksi_detail.kode, hstok_transaksi_detail.qtytransaksi, hstok_transaksi_detail.qtymasuk, hstok_transaksi_detail.qtykeluar,
				hstok_transaksi_detail.harga, hstok_transaksi_detail.diskonpersen, hstok_transaksi_detail.diskontotal, hstok_transaksi_detail.subtotal,
				hstok_transaksi_detail.catatan, hstok_transaksi_detail.nomorlot, hstok_transaksi_detail.kadaluwarsa,
				hstok_transaksi_detail.catatandetail, hstok.namabrg, hstok.harga, hstok.satuan
			from hstok_transaksi_detail left join hstok on hstok.kode=hstok_transaksi_detail.kode
			where hstok_transaksi_detail.notrans='$_GET[notrans]' order by hstok_transaksi_detail.id asc");
			while ($dtrans = mysql_fetch_assoc($detail)) {
				$no++;
				$qtykeluar = number_format($dtrans['qtykeluar'], 0, ',', '');
				if ($dtrans['kadaluwarsa'] == "0000-00-00") {
					$ed = "-";
				} else {
					$ed = $dtrans['kadaluwarsa'];
				}
				if ($dtrans['nomorlot'] == "XXXXXXXX") {
					$lot = "-";
				} else {
					$lot = $dtrans['nomorlot'];
				}

				$permintaan = mysql_fetch_assoc(mysql_query("select qtyorder,qtyterpenuhi from hstok_order_detail where notrans='$h[noreferensi]' and kode='$dtrans[kode]'"));

				echo "<tr class=\"record\">
                <td align=center>" . $no . "</td>
                <td align=left>" . $dtrans['kode'] . "</td>
		<td align=left>" . $dtrans['namabrg'] . "</td>
		<td align=left>" . $lot . "</td>
		<td align=left>" . $ed . "</td>
        <td align=center>" . $permintaan['qtyorder'] . "</td>
		<td align=right>" . $qtykeluar . "</td>
		<td align=left>" . $dtrans['satuan'] . "</td>";
			?>
				<!--td align=right><?= format_ribuan($dtrans['harga']) ?></td>
				<td align=right><?= format_ribuan($dtrans['harga'] * $qtykeluar) ?></td-->
			<? echo "
		</tr>";
			}
			if ($no < 10) {
				$no1 = $no;
				while (($no1 + $no) < 11) {
					$no1++;
					echo "<tr class=\"record\">
                <td align=center>" . $no1 . "</td>
		<td align=right></td>
                <td align=left></td>
		<td align=right></td>
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>
		<!--td align=left></td-->
		</tr>";
				}
			}
			?>
		</table>
	</table><br>
	<table class="list" border="0" cellspacing="1" cellpadding="2" width="100%">
		<tr>
			<td align="center" valign="top">Disahkan Oleh,<br><br><br></td>
			<td align="center" valign="top">Penerima,</td>
			<td align="center" valign="top">Petugas Logistik UDD,</td>
		</tr>
		<tr>
			<td align="center" class="input">(......................)</td>
			<td align="center" class="input">(......................)</td>
			<td align="center" class="input">(<?= $h[petugas] ?>)</td>
		</tr>
	</table>
</form>
