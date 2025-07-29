<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_keluar_datalama.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');


$today      =$_POST[today];
$today1     =$_POST[today1];
$src_status =$_POST[status];
$src_lay    =$_POST[layanan];
$srcform    =$_POST[NoForm];
$src_rs     =$_POST[rs]


?>
<h1>REKAP DARAH KELUAR KE RUMAH SAKIT (DATA LAMA)</h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>


<?
$transaksipermintaan=mysql_query("select a.NoForm,a.NoKantong,a.tgl,a.tgl_keluar,a.petugas,a.tempat,a.Status,
b.NamaOS,b.bagian,b.rs,b.jenis,b.nojenis from dtransaksipermintaan as a,copyhtranspermintaan as b where CAST(a.tgl_keluar as date)>='$today' and CAST(a.tgl_keluar as date)<='$today1' and a.NoForm like '%$srcform%' and a.Status like '%$src_status%' and b.rs like '%$src_rs%' and b.jenis like '%$src_lay%' and b.NoForm=a.NoForm order by a.tgl_keluar ASC  ");



$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Total Darah keluar Ke Rumah sakit sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " kantong";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">No Formulir</td>
	<td rowspan='2' align="center">Nama Pasien</td>
	<td rowspan='2' align="center">Rumah Sakit</td>
	<td rowspan='2' align="center">Bagian</td>
        <td rowspan='2' align="center">Layanan</td>
	<td rowspan='2' align="center">No Layanan</td>
	<td colspan='3' align="center">Kantong</td>
        <td colspan='4' align="center">Crossmatch</td>
	<td colspan='5' align="center">Pembayaran</td>
        </tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">nomor</td>
        <td align="center">Gol & Rh Darah</td>
        <td align="center">Produk Darah</td>

	<td align="center">Status</td>
	<td align="center">Petugas</td>
	<td align="center">Tgl</td>
	<td align="center">Tempat</td>

	<td align="center">jenis Biaya</td>
	<td align="center">Status</td>
	<td align="center">Tgl</td>
	<td align="center">Kasir</td>
	<td align="center">Shift</td>
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF6346; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['NoForm']?></td>
	<td align="center"><?=$datatransaksipermintaan['NamaOS']?></td>
	
	<? 	
	$rs1=mysql_query("select * from rmhsakit where Kode='$datatransaksipermintaan[rs]'");
	$ambilrs1=mysql_fetch_array($rs1);
	
	?>
	<td align="center"><?=$ambilrs1['NamaRs']?></td>
	<td align="center"><?=$datatransaksipermintaan['bagian']?></td>
	<td align="center"><?=$datatransaksipermintaan['jenis']?></td> 
	<td align="center"><?=$datatransaksipermintaan['nojenis']?></td> 
        <td align="center"><?=$datatransaksipermintaan['NoKantong']?></td>
	<? 	
	$kantong1=mysql_query("select * from stokkantong where NoKantong='$datatransaksipermintaan[NoKantong]'");
	$ambilkantong1=mysql_fetch_array($kantong1);
	
	?>
	<td align="center"><?=$ambilkantong1['gol_darah']?>(<?=$ambilkantong1['RhesusDrh']?>)</td>
	<td align="center"><?=$ambilkantong1['produk']?></td>
	<?
	$hasilcross='Compatible';
	if ($datatransaksipermintaan['StatusCross']=="0") $hasilcross='inCompatible Blh Klr';
	if ($datatransaksipermintaan['StatusCross']=="2") $hasilcross='inCompatible Tdk Blh Klr';
	$statuscross='DiBawa';
	if ($datatransaksipermintaan['Status']=="1") $statuscross='Titip';
	if ($datatransaksipermintaan['Status']=="B") $statuscross='Batal';
	?>
	<td align="center"><?=$hasilcross?></td>
	<td align="center"><?=$datatransaksipermintaan['petugas']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl']?></td>
	<td align="center"><?=$datatransaksipermintaan['tempat']?></td>
	<? 	
	$pembayaran1=mysql_query("select * from dpembayaranpermintaan where notrans='$datatransaksipermintaan[NoForm]'");
	$pembayaran=mysql_fetch_array($pembayaran1);
	
	?>
	<td align="center"><?=$pembayaran['namabrg']?></td>
	
	<td align="center"><?=$statuscross?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_keluar']?></td>
	<td align="center"><?=$pembayaran['petugas']?></td>
	<td align="center"><?=$pembayaran['shift']?></td>
</tr>
<? $no++;} ?>
</table>

<?
mysql_close();
?>
