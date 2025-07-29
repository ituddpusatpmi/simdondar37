<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_keluar_lama.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');

$today=date('Y-m-d');
$today1=$today;
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);
?>
<font size="5" color=blue>DAFTAR REKAP PERMINTAAN DARAH</font><br>
<form method=post>
	<font size="2" color=blue>
	DARI TANGGAL :    <?=$today?>   
	S/D TANGGAL  :    <?=$today1?>
	</font>
	<input type="submit" name="submit" value="Lihat" class="swn_button_blue"> 
</form>
<br></br>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td rowspan=2>No</td>
          <td rowspan=2>No Form</td>
          <td rowspan=2>Tgl Minta</td>
          <td rowspan=2>Nama Pasien</td>
	<td rowspan=2>Umur</td>
	  <td rowspan=2>JK</td>
          <td rowspan=2>Alamat</td>
          <td rowspan=2>Rumah Sakit</td>
	<td rowspan=2>Bagian</td>
	<td rowspan=2>Kelas</td>
 	<td rowspan=2>Jenis Pelayanan</td>
<td rowspan=2>No. Reg. Layanan</td>
          <td rowspan=2>Nama Dokter</td>
          <td rowspan=2>Gol Darah</td>
	<td rowspan=2>Jenis Darah</td>
	  <td rowspan=2>Jumlah</td>
          <td colspan=2>Status Hasil</td>
	  <td rowspan=2>Tempat</td>
		<td rowspan=2>Shift</td>
        </tr>
  
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

          <td>Bawa</td>
          <td>Titip</td>

</tr>	
<?
$no=1;
$trans0=mysql_query("select ht.NoForm,ht.bagian,ht.kelas,ht.NamaOS,ht.umur,ht.jk,ht.Alamat,ht.rs,ht.NamaDokter,ht.TglMinta,ht.jenis,ht.tempat,ht.shift,ht.nojenis from copyhtranspermintaan as ht where ht.TglMinta>='$today' and ht.TglMinta<='$today1' group by NoForm order by ht.NoForm");
while ($trans=mysql_fetch_assoc($trans0)) {
$dtrans=mysql_fetch_assoc(mysql_query("select sum(Jumlah) as Jumlah,GolDarah,JenisDarah from dtranspermintaan where NoForm='$trans[NoForm]'"));
?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td> 
<?
$bawa=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as noform from dtransaksipermintaan as dt where dt.NoForm='$trans[NoForm]' and (dt.Status='0' or dt.Status='L')"));
$titip=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as noform from dtransaksipermintaan as dt where dt.NoForm='$trans[NoForm]' and dt.Status='1'"));
$total=$bawa[noform]+$titip[noform];
if ($_SESSION[leveluser]=='laboratorium' or $_SESSION[leveluser]=='bdrs') {
if ($dtrans[Jumlah]>$total) {

if ($_SESSION[leveluser]=='laboratorium') echo "<td class=input><a href=pmilaboratorium.php?module=crossmatch&noform=$trans[NoForm]>$trans[NoForm]</a></td>";  
if ($_SESSION[leveluser]=='bdrs') echo "<td class=input><a href=pmibdrs.php?module=crossmatch&noform=$trans[NoForm]>$trans[NoForm]</a></td>";  
} else {
?>

      <td class=input><?=$trans[NoForm]?></td>
<?} } else { 
if ($_SESSION[leveluser]=='kasir' or $_SESSION[leveluser]=='bdrs') {
	$bayar=mysql_query("select * from dtransaksipermintaan where noForm='$trans[NoForm]' and (status='0' or status='1')");
	$nbayar=mysql_num_rows($bayar);
	if ($nbayar>0) {
echo "<td class=input><a href=pmikasir.php?module=pembayaran&noform=$trans[NoForm]>$trans[NoForm]</a></td>"; 
} else {
?>

      <td class=input><?=$trans[NoForm]?></td>
<?}} else {?>
      <td class=input><?=$trans[NoForm]?></td>
<?}
}
$blnmin=substr($trans[TglMinta],5,2);
$tglmin=substr($trans[TglMinta],8,2);
$thnmin=substr($trans[TglMinta],0,4);
?>
      <td class=input><?=$tglmin?>-<?=$blnmin?>-<?=$thnmin?></td>
      <td class=input><?=$trans[NamaOS]?></td>
	<td class=input><?=$trans[umur]?></td>
	<td class=input><?=$trans[jk]?></td>
      <td class=input><?=$trans[Alamat]?></td>
<?
$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$trans[rs]'"));
?>
      	<td class=input><?=$rmhskt[NamaRs]?></td>
	<td class=input><?=$trans[bagian]?></td>
	<td class=input><?=$trans[kelas]?></td>
	<td class=input><?=$trans[jenis]?></td>
	<td class=input><?=$trans[nojenis]?></td>
      	<td class=input><?=$trans[NamaDokter]?></td>
      	<td class=input><?=$dtrans[GolDarah]?></td>
<td class=input><?=$dtrans[JenisDarah]?></td>
      <td class=input><?=$dtrans[Jumlah]?></td>
      <td class=input><?=$bawa[noform]?></td>
      <td class=input><?=$titip[noform]?></td>
	<td class=input><?=$trans[tempat]?></td>
	<td class=input><?=$trans[shift]?></td>	
	</tr>
<?
}
?>
</table>
<?
mysql_close();
?>
