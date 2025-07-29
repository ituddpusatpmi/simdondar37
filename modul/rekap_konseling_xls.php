<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_konseling.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');
/*
<input type=hidden name=today value='<?=$today?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=hidden name=gol_status value='<?=$src_status?>'>
<input type=hidden name=nomorf value='<?=$srcform?>'>
<input type=hidden name=hasil value='<?=$src_hasil?>'>
*/
$today      =$_POST[today];
$today1     =$_POST[today1];
$src_status =$_POST[gol_status];
$srcform    =$_POST[nomorf];
$src_hasil     =$_POST[hasil]


?>
<h1>REKAP TRANSAKSI KONSELING</h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>


<?
$transaksipermintaan=mysql_query("select a.notrans,a.kodependonor,a.tgl,a.parameter,a.nilai,a.hasil,a.ket,a.petugas,
b.Nama,b.Alamat,b.Jk,b.TempatLhr,b.TglLhr from konseling as a,pendonor as b where CAST(a.tgl as date)>='$today' and CAST(a.tgl as date)<='$today1' and a.notrans like '%$srcform%' and a.parameter like '%$src_status%' and a.hasil like '%$src_hasil%' and b.Kode=a.kodependonor order by a.tgl ASC  ");

//  

$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Konseling yang sudah dilakukan kepada pendonor sebanyak :   ";
echo"<b>";
echo $countp;
echo"</b>";
echo " Kali";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">TGL.</td>
	<td rowspan='2' align="center">NoTrans</td>
	<td rowspan='2' align="center">ID DONOR</td>
	<td rowspan='2' align="center">NAMA PENDONOR</td>
	<td colspan='2' align="center">LAHIR</td>
        <td rowspan='2' align="center">PARAMETER</td>
	<td rowspan='2' align="center">NILAI<br>TITER</td>
	<td rowspan='2' align="center">TINDAKAN</td>
        <td rowspan='2' align="center">KET</td>
	<td rowspan='2' align="center">PETUGAS</td>
        </tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">TEMPAT</td>
        <td align="center">TANGGAL</td>	
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF6346; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl']?></td>
	<td align="center"><?=$datatransaksipermintaan['notrans']?></td>
	<td align="center"><?=$datatransaksipermintaan['kodependonor']?></td>
	<td align="center"><?=$datatransaksipermintaan['Nama']?></td>
	<td align="center"><?=$datatransaksipermintaan['TempatLhr']?></td>
	<td align="center"><?=$datatransaksipermintaan['TglLhr']?></td> 
	<?
	$parameter='HBsAg';
	if ($datatransaksipermintaan['parameter']=="1") $parameter='HCV';
	if ($datatransaksipermintaan['parameter']=="2") $parameter='HIV';
	if ($datatransaksipermintaan['parameter']=="3") $parameter='SYPHILIS';	
	$tindakan='Dirujuk';
	if ($datatransaksipermintaan['hasil']=="1") $tindakan='Diberikan Obat';
	if ($datatransaksipermintaan['hasil']=="2") $tindakan='Konsul';
	
	?>
	<td align="center"><?=$parameter?></td> 
	<td align="center"><?=$datatransaksipermintaan['nilai']?></td> 
        <td align="center"><?=$tindakan?></td>
	<td align="center"><?=$datatransaksipermintaan['ket']?></td> 
	<td align="center"><?=$datatransaksipermintaan['petugas']?></td> 
	
</tr>
<? $no++;} ?>
</table>

<?
mysql_close();
?>
