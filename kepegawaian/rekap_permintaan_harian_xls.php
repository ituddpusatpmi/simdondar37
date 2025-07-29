<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_keluar.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];

?>
<h3 class="table">Rekap Darah Keluar <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h3>
<br>
<table class=form border=1 cellpadding=0 cellspacing=0>
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
<td rowspan=2>No. Reg. Pelayanan</td>
          <td rowspan=2>Nama Dokter</td>
          <td rowspan=2>Gol Darah</td>
	<td rowspan=2>Jenis Darah</td>
	  <td rowspan=2>Jumlah</td>
          <td colspan=2>Status Hasil</td>
	  <td rowspan=2>Tempat</td>
		<td rowspan=2>Shift</td>
	<td rowspan=2>Petugas Input</td>
	
        </tr>
  
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

          <td>Bawa</td>
          <td>Titip</td>

</tr>


<?php
$no=1;
$trans0=mysql_query("select ht.NoForm,ht.bagian,ht.kelas,ht.NamaOS,ht.umur,ht.jk,ht.Alamat,ht.rs,ht.NamaDokter,ht.TglMinta,ht.jenis,ht.tempat,ht.shift,ht.nojenis,ht.petugas from htranspermintaan as ht where CAST(ht.TglMinta as date)>='$today' and CAST(ht.TglMinta as date)<='$today1' group by TglMinta order by ht.TglMinta");
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
$tgl_form=$trans[TglMinta];
$tglf=date("d",strtotime($tgl_form));
$blnf=date("n",strtotime($tgl_form));
$thnf=date("Y",strtotime($tgl_form));
$bulanf=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnf1=$bulanf[$blnf];
$jamf = date("H:i:s",strtotime($tgl_form));

/*
$blnmin=substr($trans[TglMinta],5,2);
$tglmin=substr($trans[TglMinta],8,2);
$thnmin=substr($trans[TglMinta],0,4);*/
?>
      <td class=input><?=$tglf?> <?=$blnf1?> <?=$thnf?> <?=$jamf?></td>
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
	<td class=input><?=$trans[petugas]?></td>
	</tr>
<?
}
?>
</table>
<?
mysql_close();
?>
