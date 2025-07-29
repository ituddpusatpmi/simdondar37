   <?
   $p=mysql_fetch_assoc(mysql_query("select Nama,Kode,tglkembali from pendonor where Kode='$_GET[Kode]'"));
   ?>
   <h1 class="table">HISTORY KONSELING</h1>
<br>
   <h1 class="table">Nama : <?=$p[Nama]?></h1>
   <h1 class="table">Kode  : <?=$p[Kode]?></h1>
   <h1 class="table">Tgl Kembali  : <?=$p[tglkembali]?></h1>
   <table class="list" border=0 cellspacing=1 cellpadding=1>
   <!--tr class="field"-->
    <tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No.</td>
	<td rowspan='2' align="center">TGL.</td>
	<td rowspan='2' align="center">No. TRANSAKSI</td>
        <td rowspan='2' align="center">PARAMETER</td>
	<td rowspan='2' align="center">NILAI<br>TITER</td>
	<td rowspan='2' align="center">TINDAKAN</td>
        <td rowspan='2' align="center">KET</td>
	<td rowspan='2' align="center">PETUGAS</td>
        </tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
		
	</tr>

   <?
   $no=0;
   $trans=mysql_query("select Tgl,notrans,parameter,nilai,hasil,ket,petugas from konseling where kodependonor='$_GET[Kode]' order by Tgl");
   while ($dtrans = mysql_fetch_assoc($trans)){
		$no++;


 $pengambilan='Dirujuk';
	if ($dtrans[hasil]=='1') $pengambilan='Diberi Obat';
	if ($dtrans[hasil]=='2') $pengambilan='Konsul';
 $cara_ambil='HBsAg';
	if ($dtrans[parameter]=='1') $cara_ambil='HCV';
	if ($dtrans[parameter]=='2') $cara_ambil='HIV';
	if ($dtrans[parameter]=='3') $cara_ambil='SYPHILIS';


	  echo "<tr class=\"record\">
                <td align=center>".$no."</td>
                <td align=left>".$dtrans['Tgl']."</td>
		<td align=center>".$dtrans['notrans']."</td>
		<td align=center>".$cara_ambil."</td>
		<td align=center>".$dtrans['nilai']."</td>
		<td align=center>".$pengambilan."</td>
		<td align=center>".$dtrans['ket']."</td>
		<td align=left>".$dtrans['petugas']."</td>
		
</tr>";
	}
	  echo "</table>";
?>

