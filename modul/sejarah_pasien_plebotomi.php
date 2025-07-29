   <?
   $p=mysql_fetch_assoc(mysql_query("select Nama,Kode from pasien_plebotomi where Kode='$_GET[kode]'"));
   ?>
   <h1 class="table">Sejarah Pasien Plebotomi</h1>
   <h1 class="table">Nama Pasien: <?=$p[Nama]?></h1>
   <h1 class="table">Kode Kode  : <?=$p[Kode]?></h1>
   <table class="list" border=1 cellspacing=1 cellpadding=3>
   <tr class="field">
	<td>No</td>
	<td>Tanggal</td>
	<td>Rumah Sakit</td>
	<td>Diagnosa</td>
	<td>Dokter Pasien</td>
	<td>Dokter UDD</td>
	<td>Penerima</td>
	<td>Aftaper</td>
	<td>No. Kantong</td>
	<td>Volume</td>
	<td>Status</td>
	<td>Catatan</td>
   </tr>
   <?
   $no=0;
   $trans=mysql_query("SELECT * FROM transaksi_plebotomi WHERE kodepasien='$_GET[kode]' order by tgltransaksi");
   while ($dtrans = mysql_fetch_assoc($trans)){
		$no++;
   $status='Gagal';
	if ($dtrans[status]=='2') $status='Batal';
	if ($dtrans[status]=='1') $status='Berhasil';
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=center>".$dtrans['tgltransaksi']."</td>
		<td align=left>".$dtrans['rumahsakit']."</td>
		<td align=left>".$dtrans['diagnosa']."</td>
		<td align=left>".$dtrans['dokterpasien']."</td>
		<td align=left>".$dtrans['dokterudd']."</td>
		<td align=left>".$dtrans['petugaspenerima']."</td>
		<td align=left>".$dtrans['aftaper']."</td>
		<td align=center>".$dtrans['nokantong']."</td>
		<td align=center>".$dtrans['diambil']."</td>
		<td align=center>".$status."</td>
		<td align=left>".$dtrans['catatan']."</td>
	     </tr>";
	}
	  echo "</table>";
?>

