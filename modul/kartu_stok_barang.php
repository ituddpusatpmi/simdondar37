   <?
   $p=mysql_fetch_assoc(mysql_query("select * from hstok where kode='$_GET[kode]'"));
   ?>
   <h1 class="table">Kartu Stok Barang</h1>
   <h2 class="table">Kode  : <?=$p[kode]?></h2>
   <h2 class="table">Nama barang  : <?=$p[namabrg]?></h2>
   <h2 class="table">Stok  : <?=$p[stoktotal]?></h2>
   
   <table class="list" border=0 cellspacing=1 cellpadding=3>
   <tr class="field">
     <td>No</td>
     <td>Tanggal</td>
     <td>Nomor</td>
     <td>Uraian</td>
     <td>Referensi</td>
     <td>Harga</td>
     <td>Masuk</td>
     <td>Keluar</td>
     <td>Sisa Stok</td>
    </tr>
  <?
  $no=0;
  $totalmasuk=0;
  $totalkeluar=0;
  $sqlstok=mysql_query("select hstok_transaksi.tanggal, hstok_transaksi.notrans, hstok_transaksi.uraian, hstok_transaksi.noreferensi,
		        hstok_transaksi_detail.harga, hstok_transaksi_detail.qtymasuk,
		        hstok_transaksi_detail.qtykeluar
			from hstok_transaksi inner join hstok_transaksi_detail on hstok_transaksi_detail.notrans=hstok_transaksi.notrans
			where hstok_transaksi_detail.kode='$_GET[kode]' order by id");
   while ($dtrans = mysql_fetch_assoc($sqlstok)){
	  $no++;
	  $harga =number_format($dtrans['harga'],0,',','.');
	  if ($harga==0){$harga="";};
	  $masuk =number_format($dtrans['qtymasuk'],0,',','.');
	  if ($masuk==0){$masuk="";};
	  $keluar=number_format($dtrans['qtykeluar'],0,',','.');
	  if ($keluar==0){$keluar="";};
	  $totalmasuk 	= $totalmasuk + $dtrans['qtymasuk'];
	  $totalkeluar 	= $totalkeluar + $dtrans['qtykeluar'];
	  $sisastok	=$totalmasuk-$totalkeluar;
	  $sisastok	=number_format($sisastok,0,',','.');
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['tanggal']."</td>
		<td align=left>".$dtrans['notrans']."</td>
		<td align=left>".$dtrans['uraian']."</td>
		<td align=left>".$dtrans['noreferensi']."</td>
		<td align=right>".$harga."</td>
		<td align=right>".$masuk."</td>
		<td align=right>".$keluar."</td>
		<td align=right>".$sisastok."</td>
	      </tr>";
	}
        echo "<tr class=\"record\">
	      <td colspan=6 align=right>JUMLAH</td>
	      <td colspan=1 align=right>".number_format($totalmasuk,0,',','.')."</td>
	      <td colspan=1 align=right>".number_format($totalkeluar,0,',','.')."</td>
	      <td colspan=1 align=right>".$sisastok."</td>
	      </tr>";	
	  echo "</table>";
  
?>

