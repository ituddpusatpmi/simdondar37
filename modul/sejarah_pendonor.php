   <?
   $p=mysql_fetch_assoc(mysql_query("select Nama,Kode,tglkembali from pendonor where Kode='$_GET[kode]'"));
   ?>
   <h1 class="table">Sejarah Pendonor</h1>
   <h1 class="table">Nama : <?=$p[Nama]?></h1>
   <h1 class="table">Kode  : <?=$p[Kode]?></h1>
   <h1 class="table">Tgl Kembali  : <?=$p[tglkembali]?></h1>
   <table class="list" border=0 cellspacing=1 cellpadding=1>
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
     <td>Cara Ambil</td>
     <td>Petugas Input</td>
</tr>
   <?
   $no=0;
   $trans=mysql_query("select Tgl,NoKantong,Diambil,beratBadan,tensi,Hb,petugasTensi,petugasHB,petugas,user,JenisDonor,NoForm,Pengambilan,tempat,Instansi,caraAmbil from htransaksi where KodePendonor='$_GET[kode]' order by Tgl");
   while ($dtrans = mysql_fetch_assoc($trans)){
		$no++;
 $jenis='Sukarela';
	if ($dtrans[JenisDonor]=='1') $jenis='Pengganti';

 $pengambilan='Batal';
	if ($dtrans[Pengambilan]=='2') $pengambilan='Gagal';
	if ($dtrans[Pengambilan]=='0') $pengambilan='Berhasil';
 $cara_ambil='Biasa';
	if ($dtrans[caraAmbil]=='1') $cara_ambil='Tromboferesis';
	if ($dtrans[caraAmbil]=='2') $cara_ambil='Leukaferesis';
	if ($dtrans[caraAmbil]=='3') $cara_ambil='Plasmaferesis';
	if ($dtrans[caraAmbil]=='4') $cara_ambil='Eritoferesis';
	if ($dtrans[caraAmbil]=='5') $cara_ambil='Plebotomi';
	
 $tempat1='Dalam Gedung';
	if ($dtrans[tempat]=='M') $tempat1='Mobile Unit';
	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['Tgl']."</td>
		<td align=center>".$dtrans['NoKantong']."</td>
		<td align=center>".$dtrans['Diambil']."</td>
		<td align=center>".$dtrans['beratBadan']."</td>
		<td align=center>".$dtrans['tensi']."</td>
		<td align=center>".$dtrans['Hb']."</td>
		<td align=left>".$dtrans['petugasTensi']."</td>
		<td align=left>".$dtrans['petugasHB']."</td>
		<td align=left>".$dtrans['petugas']."</td>
		<td align=center>".$jenis."</td>
		<td align=center>".$dtrans['NoForm']."</td>
		<td align=center>".$pengambilan."</td>
		<td align=left>".$tempat1."</td>
		<td align=left>".$dtrans['Instansi']."</td>
		<td align=left>".$cara_ambil."</td>
		<td align=left>".$dtrans['user']."</td>
</tr>";
	}
	  echo "</table>";
?>

