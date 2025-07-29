   <?
   $p=mysql_fetch_assoc(mysql_query("select * from kegiatan where kodeinstansi='$_GET[q]'"));
   $i=mysql_fetch_assoc(mysql_query("select * from detailinstansi where KodeDetail='$_GET[q]'"));
   ?>
   <h1 class="table">History Kegiatan Instansi</h1>
   <h1 class="table">Nama : <?=$i[nama]?></h1>
   <h1 class="table">Kode  : <?=$p[kodeinstansi]?></h1>
   <table class="list" border=0 cellspacing=1 cellpadding=1>
   <tr class="field">
     	<td rowspan='2'>No</td>
     	<td rowspan='2'>Tanggal</td>
	<td colspan='3'>Jumlah Donor</td>
	<td rowspan='2'>Status</td>
</tr>
<tr class="field">
	<td>Sukses</td>
	<td>Gagal</td>
	<td>Batal</td>
</tr>
   <?
   $no=0;
   $trans=mysql_query("select * from kegiatan where kodeinstansi='$_GET[q]' order by tglpelaksanaan ASC");
	
			
   while ($dtrans = mysql_fetch_assoc($trans)){
$tempat1=mysql_fetch_assoc(mysql_query("select * from detailinstansi where KodeDetail='$dtrans[kodeinstansi]'"));
$tempat='Dalam Gedung';

if ($dtrans[Status]=='-') $status="Terjadwal";
if ($dtrans[Status]=='0') $status="Fixed";
if ($dtrans[Status]=='1') $status="Selesai";
if ($dtrans[Status]=='2') $status="Ditunda";
if ($dtrans[Status]=='3') $status="Batal";
		$no++;
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['TglPelaksanaan']."</td>		
		<td align=left>".$dtrans['sukses']."</td>
		<td align=left>".$dtrans['gagal']."</td>
		<td align=left>".$dtrans['batal']."</td>
		<td align=left>".$status."</td>
</tr>";
	}
	  echo "</table>";
?>

