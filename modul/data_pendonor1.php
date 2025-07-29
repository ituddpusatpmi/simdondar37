<?
if (isset($_GET[q])) {
include ('../config/db_connect.php');
$today=date('Y-m-d H:i:s');
$q=$_GET["q"];
$query = mysql_query("SELECT * FROM pendonor where Kode='$q' ");
$query1 = mysql_query("SELECT * FROM htransaksi where KodePendonor='$q' order by Tgl ASC");	

//$dtrans = mysql_fetch_array($trans);
$cekal1=mysql_fetch_assoc(mysql_query("select cekal,tglkembali,jumDonor,Rhesus,GolDarah,Nama from pendonor where Kode='$q' "));
$query2=mysql_fetch_assoc($quey);

$instansi=mysql_fetch_assoc(mysql_query("select * from detailinstansi where aktif='1'"));
$kendaraan=mysql_fetch_assoc(mysql_query("select k.kendaraan, d.KodeDetail,d.aktif from kegiatan as k, detailinstansi as d where k.kodeinstansi=d.KodeDetail and d.aktif='1'"));



//transaksidonor
//------------------------ set id transaksi ------------------------->
$udd1   = mysql_query("select id from utd where aktif='1'");
$udd    = mysql_fetch_assoc($udd1);
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= substr($idp1[id1],0,2).$tgl.$bl.$th."-".$udd[id]."-";
$idp	= mysql_query("select NoTrans from htransaksi where NoTrans like '$kdtp%' order by NoTrans DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[NoTrans],14,4);
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->






?>
<table bgcolor="#000012" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDD12">
		<th colspan=4><b>INFO DONOR KEMBALI</b></th></tr>
</table>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>Nama Pendonor</th> 
		<th>Gol Drh</th>
		<th>Jml Donor</th>
		<th>Tgl Kembali</th>
		<th>Status</th>
	</tr>

	<? while($row = mysql_fetch_object($query)): ?>
<?
$cekal='OK';
if ($cekal1[cekal]=='1') $cekal='Confirm';
?>
	<tr bgcolor="#FFFFFF">
		<td><?=$row->Nama?></td>
		<td><?=$row->GolDarah?>(<?=$row->Rhesus?>)</td>
		<td align="center"><?=$row->jumDonor?></td>
		<td align="center"><?=$row->tglkembali?></td>
		<td align="center"><?=$cekal?></td>
	</tr>
	<? endwhile; ?>
</table>
<table>
<? if ($cekal1[cekal] =="0" and $cekal1[tglkembali] <= $today) { ?>
<tr>
<td>
<form name="kirim" method="post" action="formulir_donor_PDF.php?kp=<?=$q?>" target="_blank">
<input name="nokan" type="hidden" value="<?=$q?>">
<input name="notrans" type="hidden" value="<?=$id_transaksi_baru?>">
<input name="instansi" type="hidden" value="<?=$instansi[nama]?>">
<input name="kendaraan" type="hidden" value="<?=$kendaraan[kendaraan]?>">
<input name="submit" type="submit" value="Cetak Form Donor">
</form></td>
</tr>
<?}?>	
</table>

<br></br>
<table bgcolor="#000012" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDD12">
		<th colspan=4><b>INFO HISTORY DONOR</b></th></tr>
</table>

<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>No.</th>
		<th>Tanggal</th>
		<th>BB</th>
		<th>Tensi</th>
		<th>Jenis</th>
<th>Tempat</th>
<th>Instansi</th>
<th>Nokantong</th>
<th>Status<br>Aftap</th>
	</tr>
<?
$no=1;
//$trans=mysql_query("select * from htransaksi where KodePendonor='$q' order by Tgl DESC ");
$trans=mysql_query("SELECT Kodependonor,Tgl,Pengambilan,beratBadan,tensi,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas FROM htransaksi where KodePendonor='$q' 
		UNION
			SELECT Kodependonor,Tgl,Pengambilan,beratBadan,tensi,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas FROM htransaksilama where KodePendonor='$q' order by Tgl DESC");
	 while ($dtrans = mysql_fetch_assoc($trans)):

$jenis='DS';
	if ($dtrans[JenisDonor]=='1') $jenis='DP';
$tempat='DG';
	if ($dtrans[tempat]=='M') $tempat='MU';

	  
?>

	<tr bgcolor="#FFFFFF">
		<td><?=$no++?></td>
		<td><?=$dtrans[Tgl]?></td>
		<td><?=$dtrans[beratBadan]?> kg</td>
		<td align="center"><?=$dtrans[tensi]?></td>
		<td align="center"><?=$jenis?></td>
		<td align="center"><?=$tempat?></td>
		<td align="center"><?=$dtrans[Instansi]?></td>
		<td align="center"><?=$dtrans[NoKantong]?></td>
<?
//$pengambilan=mysql_fetch_assoc(mysql_query("select Pengambilan from htransaksi where KodePendonor='$q'"));
	if ($dtrans[Pengambilan]=='0') $pengambilan1="Berhasil";
	if ($dtrans[Pengambilan]=='2') $pengambilan1="Gagal Aftap";
	if ($dtrans[Pengambilan]=='1') $pengambilan1="Batal";
?>
		<td align="center"><?=$pengambilan1?></td>
	</tr>

	<? endwhile; ?>
</table>
	

<? 
}?>

