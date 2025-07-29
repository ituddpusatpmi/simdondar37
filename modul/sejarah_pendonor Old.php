   <?
   $p=mysql_fetch_assoc(mysql_query("select Nama,Kode from pendonor where Kode='$_GET[kode]'"));
   ?>
   <h1 class="table">Sejarah Pendonor</h1>
   <h1 class="table">Nama : <?=$p[Nama]?></h1>
   <h1 class="table">Kode  : <?=$p[Kode]?></h1>
   <table class="list" border=1 cellspacing=0 cellpadding=0>
   <tr class="field">
	<td>No</td>
	<td>Tanggal</td>
	<td>No. Kantong</td>
	<td>Volume</td>
	<td>BB/kg</td>
	<td>Tensi</td>
	<td>HB</td>
	<td>Petugas Tensi</td>
<td>Petugas HB</td>
<td>Aftaper</td>
<td>Jenis Donor</td> 
<td>No. Form</td>  
<td>Pengambilan</td> 
<td>Tempat Donor</td> 
<td>Instansi</td>  
</tr>
   <?


   $no=0;
   $trans=mysql_query("select Tgl,NoKantong,Diambil,beratBadan,tensi,Hb,petugasTensi,petugasHB,petugas,user,JenisDonor,NoForm,Pengambilan,tempat,Instansi from htransaksi where KodePendonor='$_GET[kode]' order by Tgl");
   while ($dtrans = mysql_fetch_assoc($trans)){
		$no++;
 $jenis='Sukarela';
	if ($dtrans[JenisDonor]=='1') $jenis='Pengganti';

 $pengambilan='Batal';
	if ($dtrans[Pengambilan]=='2') $pengambilan='Gagal';
	if ($dtrans[Pengambilan]=='0') $pengambilan='Berhasil';

 $tempat1='Dalam Gedung';
	if ($dtrans[tempat]=='M') $tempat1='Mobile Unit';

	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=center>".$dtrans['Tgl']."</td>
		<td align=center>".$dtrans['NoKantong']."</td>
		<td align=center>".$dtrans['Diambil']."</td>
		<td align=center>".$dtrans['beratBadan']."</td>
		<td align=center>".$dtrans['tensi']."</td>
		<td align=center>".$dtrans['Hb']."</td>
		<td align=center>".$dtrans['petugasTensi']."</td>
		<td align=center>".$dtrans['petugasHB']."</td>
		<td align=center>".$dtrans['petugas']."</td>
		<td align=center>".$jenis."</td>
		<td align=center>".$dtrans['NoForm']."</td>
		<td align=center>".$pengambilan."</td>
		<td align=center>".$tempat1."</td>
		<td align=center>".$dtrans['Instansi']."</td>
	 




</tr>";
	}





	  echo "</table>";



?>

