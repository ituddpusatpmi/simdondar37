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
echo "<h1>Sejarah Pasien</h1>";
?>
<table class="list" border=0 cellspacing=0 cellpadding=3>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	  <td>Nama Pasien</td>
	  <td>Alamat</td>
	  <td>Tanggal</td>
	  <td>Kode Kantong</td>
	  <td>Nama Pendonor</td>
	  <td>Kode Pendonor</td>
	  <td>Status Cekal</td>
</tr>
<?
$nama=mysql_real_escape_string($_POST[nama]);
$ps=mysql_query("select h.namaos,h.alamat,h.tglminta,d.nokantong,pd.kode,pd.nama,pd.cekal from htranspermintaan as h,dtransaksipermintaan as d, pendonor as pd,stokkantong as s where h.noform=d.noform and d.nokantong=s.nokantong and s.kodependonor=pd.kode and h.namaos like '%$nama%'");
while ($ps1=mysql_fetch_assoc($ps)) {
$cekal='Tidak';
if ($ps1[cekal]=='1') $cekal='Ya';
$bln1=substr($ps1[tglminta],6,2);
$bln1=(int)$bln1;
$tgll=substr($ps1[tglminta],8,2).' '.$array_bulan[$bln1].' '.substr($ps1[tglminta],0,4);
?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<?
echo "<td class=input align=left>$ps1[namaos]</td>
	<td class=input align=left>$ps1[alamat]</td>
	<td class=input>$tgll</td>
	<td class=input>$ps1[nokantong]</td>
	<td class=input align=left>$ps1[nama]</td>
	<td class=input align=left>$ps1[kode]</td>
	<td class=input>$cekal</td></tr>";
}
echo "</table>";
}
