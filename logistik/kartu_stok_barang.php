<!--img src="../logistik/img/kartustok.jpg" width="100%"><br-->

    <?
	$p = mysql_fetch_assoc(mysql_query("select * from hstok where kode='$_GET[kode]'"));
	$now = date('Y');
	?>
   <h1 class="table">Kartu Stok Barang</h1>
   <h2 class="table">Kode : <?= $p[kode] ?></h2>
   <h2 class="table">Nama barang : <?= $p[namabrg] ?></h2>
   <h2 class="table">Stok : <?= $p[stoktotal] ?></h2>

   <table class="list" border=1 cellspacing=1 cellpadding=3 style="border-collapse:collapse">
   	<tr class="field">
   		<td>No</td>
   		<td>Tanggal</td>
   		<td>Nomor</td>
   		<td>Uraian</td>
   		<td>Supplier/Bagian</td>
   		<td>Referensi</td>
   		<td>Harga</td>
   		<td>Masuk</td>
   		<td>Keluar</td>
   		<td>Sisa Stok</td>
   	</tr>
   	<?
		$no = 0;
		$totalmasuk = 0;
		$totalkeluar = 0;
		/*$sqlstok = mysql_query("select hstok_transaksi.tanggal, hstok_transaksi.notrans, hstok_transaksi.uraian, hstok_transaksi.noreferensi,
		        hstok_transaksi_detail.harga, hstok_transaksi_detail.qtymasuk,
		        hstok_transaksi_detail.qtykeluar
			from hstok_transaksi inner join hstok_transaksi_detail on hstok_transaksi_detail.notrans=hstok_transaksi.notrans
			where hstok_transaksi_detail.kode='$_GET[kode]'  AND YEAR(hstok_transaksi.tanggal)='$now' order by id");*/

		//UPDATE YUWAN 26-10-2023
		$sqlstok = mysql_query("SELECT\n" .
			"hstok_transaksi.tanggal,\n" .
			"hstok_transaksi.notrans,\n" .
			"hstok_transaksi.uraian,\n" .
			"hstok_transaksi.noreferensi,\n" .
			"hstok_transaksi_detail.harga,\n" .
			"hstok_transaksi_detail.qtymasuk,\n" .
			"hstok_transaksi_detail.qtykeluar,\n" .
			"supplier.Nama AS supplier\n" .
			"FROM\n" .
			"hstok_transaksi\n" .
			"INNER JOIN hstok_transaksi_detail ON hstok_transaksi_detail.notrans = hstok_transaksi.notrans\n" .
			"INNER JOIN supplier ON hstok_transaksi.supplier = supplier.Kode\n" .
			"WHERE\n" .
			"hstok_transaksi_detail.kode = '$_GET[kode]' AND YEAR(hstok_transaksi.tanggal)='$now'\n" .
			"ORDER BY\n" .
			"hstok_transaksi_detail.id ASC");

		while ($dtrans = mysql_fetch_assoc($sqlstok)) {
			$no++;
			$harga = number_format($dtrans['harga'], 0, ',', '.');
			if ($harga == 0) {
				$harga = "";
			};
			$masuk = number_format($dtrans['qtymasuk'], 0, ',', '.');
			if ($masuk == 0) {
				$masuk = "";
			};
			$keluar = number_format($dtrans['qtykeluar'], 0, ',', '.');
			if ($keluar == 0) {
				$keluar = "";
			};
			$totalmasuk 	= $totalmasuk + $dtrans['qtymasuk'];
			$totalkeluar 	= $totalkeluar + $dtrans['qtykeluar'];
			$sisastok	= $totalmasuk - $totalkeluar;
			$sisastok	= number_format($sisastok, 0, ',', '.');
			echo "<tr class=\"record\">
                <td align=center>" . $no . "</td>
                <td align=left>" . $dtrans['tanggal'] . "</td>
		<td align=left>" . $dtrans['notrans'] . "</td>
		<td align=left>" . $dtrans['uraian'] . "</td>
		<td align=left>" . $dtrans['supplier'] . "</td>
		<td align=left>" . $dtrans['noreferensi'] . "</td>
		<td align=right>" . $harga . "</td>
		<td align=right>" . $masuk . "</td>
		<td align=right>" . $keluar . "</td>
		<td align=right>" . $sisastok . "</td>
	      </tr>";
		}
		echo "<tr class=\"record\">
	      <td colspan=7 align=right>JUMLAH</td>
	      <td colspan=1 align=right>" . number_format($totalmasuk, 0, ',', '.') . "</td>
	      <td colspan=1 align=right>" . number_format($totalkeluar, 0, ',', '.') . "</td>
	      <!--td colspan=1 align=right>" . $sisastok . "</td-->
	      </tr>";
		echo "</table>";
		?>
   	<a href="javascript:window.print()">Cetak</a>
