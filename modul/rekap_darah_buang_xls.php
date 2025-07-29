<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rincian_pemusnahan_darah.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');


$today      	=$_POST[today];
$today1     	=$_POST[today1];
$alasan		=$_POST[alasan];
$produk		=$_POST[produk];
$drh		=$_POST[drh];
$rh		=$_POST[rh];
$srcrm		=$_POST[rm];
$srcform	=$_POST[nomorf];
$jenis		=$_POST[jenis];

?>
<h1>REKAP PEMUSNAHAN DARAH</h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?> <?=$jenis?>  </h1>


<?
$transaksipermintaan=mysql_query("select * from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and noKantong like '%$srcform%' and user like '%$srcrm%' and produk like '%$produk%' and gol_darah like '$drh%' and RhesusDrh like '%$rh%' and alasan_buang like '%$alasan%' and jenis like '%$jenis%'  order by tgl_buang ");

//'  and alasan_buang like '%$alasan%'     and jenis like '%$jenis%'


$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " kantong";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr tr style="background-color:#8E006B; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<td>No Kantong</td>
	<td>Jenis</td>
	<td>Gol & Rh</td>
	<td>Produk</td>
	<td>Volume</td>
	<td>Tgl Aftap</td>
	<td>Tgl Kadaluarsa</td>
        <td>Tgl Buang</td>
	<td>Alasan Buang</td> 
	<td>Petugas Buang</td>
	
        </tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr str style="background-color:#FECCBF; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['noKantong']?></td>
<?
$jenis='Single';
if ($datatransaksipermintaan[jenis]=='2') $jenis='Double';
if ($datatransaksipermintaan[jenis]=='3') $jenis='Triple';
if ($datatransaksipermintaan[jenis]=='4') $jenis='Quadruple';
if ($datatransaksipermintaan[jenis]=='6') $jenis='Pediatrik';
?>
	<td align="center"><?=$jenis?></td>
	<td align="center"><?=$datatransaksipermintaan['gol_darah']?>(<?=$datatransaksipermintaan['RhesusDrh']?>)</td>
	<td align="center"><?=$datatransaksipermintaan['produk']?></td>
	<td align="center"><?=$datatransaksipermintaan['volume']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_Aftap']?></td>
	<td align="center"><?=$datatransaksipermintaan['kadaluwarsa']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_buang']?></td>
<?
if ($datatransaksipermintaan[alasan_buang]=='2') $alasan='Kadaluwarsa';
if ($datatransaksipermintaan[alasan_buang]=='0') $alasan='Gagal Aftap';
if ($datatransaksipermintaan[alasan_buang]=='3') $alasan='Plebotomi';
if ($datatransaksipermintaan[alasan_buang]=='4') $alasan='Reaktif Dibuang';
if ($datatransaksipermintaan[alasan_buang]=='5') $alasan='Lifemik';
if ($datatransaksipermintaan[alasan_buang]=='6') $alasan='Greyzone';
if ($datatransaksipermintaan[alasan_buang]=='7') $alasan='DCT Positif';
if ($datatransaksipermintaan[alasan_buang]=='8') $alasan='Kantong Bocor';
if ($datatransaksipermintaan[alasan_buang]=='1') $alasan='Lisis';
if ($datatransaksipermintaan[alasan_buang]=='9') $alasan='Satelit Rusak';
if ($datatransaksipermintaan[alasan_buang]=='10') $alasan='Bekas Pembuatan TPK';
if ($datatransaksipermintaan[alasan_buang]=='11') $alasan='Reaktif Rujuk keUDDP';
if ($datatransaksipermintaan[alasan_buang]=='12') $alasan='Hematokrit Tinggi';
if ($datatransaksipermintaan[alasan_buang]=='13') $alasan='Limbah Sisa PRC';
if ($datatransaksipermintaan[alasan_buang]=='14') $alasan='Leukosit Tinggi';
if ($datatransaksipermintaan[alasan_buang]=='15') $alasan='Produk Rusak';
if ($datatransaksipermintaan[alasan_buang]=='16') $alasan='Produk Sampel QC';

?>

	<td align="center"><?=$alasan?></td>
	<td align="center"><?=$datatransaksipermintaan['user']?></td>

</tr>
<? $no++;} ?>
</table>

<?
mysql_close();
?>
