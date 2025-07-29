<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
 //-->
</style>
<?
include '../config/db_connect.php';
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
?>
<h1> Form Pelacakan Pasien</h1>
<form nama=pasien method=post>
<table class="list" border=0 cellspacing=0 cellpadding=0>
   <tr class="field">
<td class="input" align=left>
Nama </td><td><input name="nama" id="nama" type="text" size="20" />
</td>
</tr>
</table>
<input type=submit name=submit value='Submit'>
</form>

<?
if (isset($_POST[submit])) {
echo "<h1>Data Pasien</h1>";
?>
<table class="list" border=1 cellspacing=0 cellpadding=3>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	  <td>Kode Pasien</td>
	  <td>Nama Pasien</td>
	  <td>Alamat</td>
	  <td>Gol Darah</td>
	  <td>Rh Darah</td>
	  <td>JK</td>
	  <td>Tgl Lahir</td>
	  
</tr>

<?
$nama=mysql_real_escape_string($_POST[nama]);
$ps=mysql_query("select * from pasien where nama like '%$nama%'");
while ($ps1=mysql_fetch_assoc($ps)) {
$cekal='Tidak';
if ($ps1[cekal]=='1') $cekal='Ya';
if ($ps1[kelamin]=='L') $jk1="Laki-laki";
if ($ps1[kelamin]=='P') $jk1="Perempuan";
$bln1=substr($ps1[tglminta],6,2);
$bln1=(int)$bln1;
$tgll=substr($ps1[tglminta],8,2).' '.$array_bulan[$bln1].' '.substr($ps1[tglminta],0,4);
?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<?
echo " 
	<td class=input align=left>$ps1[no_rm]</td>
	<td class=input align=left>$ps1[nama]</td>
	<td class=input align=left>$ps1[alamat]</td>
	<td class=input>$ps1[gol_darah]</td>
	<td class=input>$ps1[rhesus]</td>
	<td class=input align=left>$ps1[kelamin]</td>
	<td class=input align=left>$ps1[tgl_lahir]</td>
	</tr>";
}

echo "</table>";
?>
<?
echo "<h1>Data Permintaan</h1>";
?>
<table class="list" border=1 cellspacing=0 cellpadding=3>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td>No</td>	
	<td>Kode Pasien</td> 	
	<td>Tgl Minta</td>  
	<td>No. form</td>
	<td>No. Reg. RS</td>
	<td>RS</td>
  	<td>Bagian</td>
	<td>Jenis Layanan</td>
	<td>Jenis Darah</td>
	<td>Gol Drh</td>
	<td>Rh Drh</td>
	<td>Jumlah</td>
	<td>Tgl Diperlukan</td>
	<td>Tpt Permintaan</td>
	<td>Petugas Input</td>
	  
</tr>


<?
$ps6=mysql_query("select * from pasien where nama like '%$nama%'");
$ps5=mysql_fetch_assoc($ps6);
$nama=mysql_real_escape_string($_POST[nama]);
$jenis1=mysql_query("select * from dtranspermintaan where no_rm='$ps5[no_rm]'");
$no=1;
while ($jenis=mysql_fetch_assoc($jenis1)) {

$ps3=mysql_fetch_assoc(mysql_query("select tglminta,noform,regrs,bagian,jenis,petugas,rs,no_rm from htranspermintaan where noform='$jenis[NoForm]'"));
$rs=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$ps3[rs]'"));

?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<?
echo " 
	<td class=input align=left>$no</td>
	<td class=input align=left>$ps3[no_rm]</td>
	<td class=input align=left>$ps3[tglminta]</td>
	<td class=input align=left>$ps3[noform]</td>
	<td class=input align=left>$ps3[regrs]</td>
	<td class=input>$rs[NamaRs]</td>
	<td class=input>$ps3[bagian]</td>
	<td class=input>$ps3[jenis]</td>
	<td class=input align=left>$jenis[JenisDarah]</td>
	<td class=input align=left>$jenis[GolDarah]</td>
	<td class=input align=left>$jenis[Rhesus]</td>
	<td class=input align=left>$jenis[Jumlah]</td>
	<td class=input align=left>$jenis[TglPerlu]</td>
	<td class=input align=left>$jenis[tempat]</td>
	<td class=input align=left>$ps3[petugas]</td>
	</tr>";
$no++;
}
echo "</table>";
?>
<?
echo "<h1>Data Hasil Crossmatch</h1>";
?>
<table class="list" border=1 cellspacing=0 cellpadding=3>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>
	<td rowspan='2'>No</td>	
	<td rowspan='2'>Tgl Cross</td>	
	<td rowspan='2'>Kode Pasien</td> 	
	<td rowspan='2'>No Form</td>  
	<td colspan='3'>Kantong</td>
	<td rowspan='2'>Status<br>Ktg</td>
	<td rowspan='2'>Metode</td>
  	<td rowspan='2'>Status<br>Cross</td>
	<td rowspan='2'>Hasil<br>Cross</td>
	<td colspan='4'>Aglutinasi</td>
	<td rowspan='2'>Petugas Cross</td>
	<td rowspan='2'>Cheker</td>
	<td rowspan='2'>Mengesahkan</td>
	<td rowspan='2'>Tpt Permintaan</td>
	<td rowspan='2'>Tgl Keluar</td>
	<td rowspan='2'>Petugas Input</td>
	  
</tr>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td>Nomor</td>	
	<td>Gol & Rh</td>	
	<td>Komponen</td> 		
	<td>Gel Tes</td>	
	<td>Fase 1</td>	
	<td>Fase 2</td> 	
	<td>Fase 3</td>  
	  
</tr>


<?
$ps7=mysql_query("select * from pasien where nama like '%$nama%'");
$ps8=mysql_fetch_assoc($ps7);
$nama=mysql_real_escape_string($_POST[nama]);
$jenis3=mysql_query("select * from dtransaksipermintaan where no_rm='$ps8[no_rm]'");
$no2=1;
while ($jenis4=mysql_fetch_assoc($jenis3)) {

$ps9=mysql_fetch_assoc(mysql_query("select petugas,rs,no_rm from htranspermintaan where noform='$jenis4[NoForm]'"));
$ktg=mysql_fetch_assoc(mysql_query("select gol_darah,RhesusDrh,produk from stokkantong where noKantong='$jenis4[NoKantong]'"));
$rs2=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$ps9[rs]'"));
$status='DiBawa';
if ($jenis4[Status]=='1') $status='Titip';
if ($jenis4[Status]=='B') $status='Batal';

$status1='Compatible';
if ($jenis5[StatusCross]=='0') $status1='Compatible Boleh Keluar';
if ($jenis5[StatusCross]=='2') $status1='Compatible Tidak Boleh Keluar';

?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<?
echo " 
	<td class=input align=left>$no2</td>
	<td class=input align=left>$jenis4[tgl]</td>
	<td class=input align=left>$jenis4[no_rm]</td>
	<td class=input align=left>$jenis4[NoForm]</td>
	<td class=input align=left>$jenis4[NoKantong]</td>
	<td class=input align=left>$ktg[gol_darah] ($ktg[RhesusDrh])</td>
	<td class=input align=left>$ktg[produk]</td>
	<td class=input align=left>$status</td>
	<td class=input align=left>$jenis4[MetodeCross]</td>
	<td class=input align=left>$status1</td>
	<td class=input align=left>$jenis4[stat2]</td>
	<td class=input align=left>$jenis4[aglutinasi]</td>
	<td class=input align=left>$jenis4[fase1]</td>
	<td class=input align=left>$jenis4[fase2]</td>
	<td class=input align=left>$jenis4[fase3]</td>
	
	<td class=input align=left>$jenis4[petugas]</td>
	<td class=input align=left>$jenis4[cheker]</td>
	<td class=input align=left>$jenis4[mengesahkan]</td>
	<td class=input align=left>$jenis4[tempat]</td>
	<td class=input align=left>$jenis4[tgl_keluar]</td>
	<td class=input align=left>$ps9[petugas]</td>
	</tr>";
$no2++;
}
echo "</table>";
}
