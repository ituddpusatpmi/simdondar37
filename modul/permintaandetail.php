   <?
   $p=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$_GET[kode]'"));
   $q=mysql_fetch_assoc(mysql_query("SELECT * FROM htranspermintaan WHERE no_rm='$_GET[kode]'"));
   $form=$q[noform];
   $r=mysql_fetch_assoc(mysql_query("SELECT * FROM dtranspermintaan WHERE no_rm='$_GET[kode]'"));
   
   ?>
   	<h1 class="table">DATA PASIEN</h1>
    	<h1 class="table">NO RM            : <?=$p[no_rm]?></h1>
   	<h1 class="table">Nama             : <?=$p[nama]?></h1>
	<h1 class="table">Gol & Rh Darah   : <?=$p[gol_darah]?> (<?=$p[rhesus]?>)</h1>
   	<h1 class="table">Tgl Lahir        : <?=$p[tgl_lahir]?></h1>
<br>
<h1 class="table">HISTORY DATA PERMINTAAN DARAH</h1>
</br>
   <table class="list" border=0 cellspacing=1 cellpadding=1>
   <tr class="field">
     <td>No.</td>
	<td>No trans</td>
     <td>No.Form</td>
     <td>No.RM</td>
     <td>Nama</td>
     <td>RS</td>
     <td>Bagian</td>
     <td>Tgl Permintaan</td>
     <td>Tgl Diperlukan</td>
     <td>Jenis Layanan</td>
     <td>Petugas Input</td>
     <td>Diagnosa</td>
	<td>Gol $ Rh Darah</td>
     <td>Komponen</td> 
     <td>Jml Ktg</td>
	<td>Metode</td>  
	<td>Aglutinasi</td>
	<td>Status</td>
	<td>Keterangan</td>
</tr>
   <?
   $no=0;
   $trans=mysql_query("SELECT a.*,b.* FROM htranspermintaan a , dtranspermintaan b where a.no_rm='$_GET[kode]' and b.no_rm='$_GET[kode]' ORDER BY a.tgl_register");
   
   while ($dtrans = mysql_fetch_assoc($trans)){
		$no++;
  $rumahsakit=mysql_query("SELECT * FROM rmhsakit WHERE kode='$dtrans[rs]'");
  $rmh = mysql_fetch_assoc($rumahsakit);
  $minta=mysql_query("SELECT * FROM dtranspermintaan WHERE no_rm='$dtrans[no_rm]'");
  $dminta = mysql_fetch_assoc($minta);
  $minta2=mysql_query("SELECT * FROM dtransaksipermintaan WHERE NoForm='$dtrans[NoForm]'");
  $dminta2 = mysql_fetch_assoc($minta2);
  
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
		<td align=center>"."<a href=pmikasir2.php?module=editpermintaan&ID=".$dtrans['ID']." TITLE=\"Edit Permintaan Darah\">
										  ".$dtrans['ID']."</a></td>
		 <td align=center>"."<a href=pmikasir2.php?module=editlayanan&kode=".$dtrans['NoForm']." TITLE=\"Edit Layanan & Pembayaran\"> 
										".$dtrans['NoForm']."</a></td>
		<td align=center>".$dtrans['no_rm']."</td>
		<td align=center>".$p['nama']."</td>
		<td align=center>".$rmh['NamaRs']."</td>
		<td align=center>".$dtrans['bagian']."</td>
		<td align=center>".$dtrans['tgl_register']."</td>
		<td align=left>".$dtrans['TglPerlu']."</td>
		<td align=left>".$dtrans['jenis']."</td>
		<td align=left>".$dtrans['petugas']."</td>
		<td align=left>".$dtrans['diagnosa']."</td>
		<td align=center>".$dtrans['GolDarah']." (".$dminta['Rhesus'].")</td>
		<td align=center>".$dtrans['JenisDarah']."</td>
		<td align=center>".$dtrans['Jumlah']."</td>
		<td align=center>".$dminta2['MetodeCross']."</td>
		<td align=center>".$dminta2['aglutinasi']."</td>
		<td align=center>".$dminta2['stat2']."</td>
		<td align=center>".$dminta2['Ket']."</td>

</tr>";
	}
	  echo "</table>";
?>

