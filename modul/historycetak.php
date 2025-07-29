   <?
   $p=mysql_fetch_assoc(mysql_query("select Nama,Kode,tglkembali from pendonor where Kode='$_GET[kode]'"));
   ?>
   <h1 class="table">History Cetak Kartu</h1>
   <h1 class="table">Nama : <?=$p[Nama]?></h1>
   <h1 class="table">Kode  : <?=$p[Kode]?></h1>
   <table class="list" border=0 cellspacing=1 cellpadding=1>
   <tr class="field">
     	<td>No</td>
     	<td>Tanggal</td>
     	<td>Tempat Cetak</td>
	<td>Petugas</td>
</tr>
   <?
   $no=0;
   $trans=mysql_query("select * from idcard where kodependonor='$_GET[kode]' order by tglcetak");
	

			
   while ($dtrans = mysql_fetch_assoc($trans)){
$tempat1=mysql_fetch_assoc(mysql_query("select * from detailinstansi where KodeDetail='$dtrans[tempat]'"));
$tempat='Dalam Gedung';
if ($dtrans[tempat]!='0') $tempat=$tempat1[nama];
		$no++;
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['tglcetak']."</td>		
		
		<td align=left>".$tempat."</td>
		<td align=left>".$dtrans['petugas']."</td>
</tr>";
	}
	  echo "</table>";
?>

