   <?
   $p=mysql_fetch_assoc(mysql_query("select * from logbook_h where kode='$_GET[kode]'"));
   
   ?>
   <h2 >Histosy Logbook</h1>

    <table>
        <tr>
            <td>Kode Alat</td><td>:<?=$p[kode]?></td>
        </tr>
        <tr>
            <td>Nama Alat</td><td>:<?=$p[nama_barang]?></td>
        </tr>
        <tr>
            <td>Bagian</td><td>:<?=$p[bagian]?></td>
        </tr>
    </table>
   
   <table width=50% class="list" border=1 cellspacing=1 cellpadding=3 style="border-collapse:collapse">
   <tr class="field">
     <td>No</td>
     <td>Tanggal</td>
     <td>Uraian</td>
     <td>Status</td>
     <td>Petugas</td>
    </tr>
  <?
  $no=0;
  $sqllbk=mysql_query("select logbook_d.tgl, logbook_d.uraian, logbook_d.petugas, logbook_d.status
			from logbook_d inner join logbook_h on logbook_d.kode=logbook_h.kode
			where logbook_h.kode='$_GET[kode]' order by tgl DESC");
   while ($dtrans = mysql_fetch_assoc($sqllbk)){
	  $no++;
	  if ($dtrans['status']=='0') {$pesan = 'Rusak';}
	  if ($dtrans['status']=='1') {$pesan = 'Baik';}
	  if ($dtrans['status']=='2') {$pesan = 'Dalam Proses Kalibrasi';}
	  if ($dtrans['status']=='3') {$pesan = 'Dalam Proses Perawatan';}
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['tgl']."</td>
		<td align=left>".$dtrans['uraian']."</td>
		<td align=left>".$pesan."</td>
		<td align=left>".$dtrans['petugas']."</td>
	      </tr>";
	}
	
	  echo "</table>";
?>
   <a href="javascript:window.print()">Cetak</a>

