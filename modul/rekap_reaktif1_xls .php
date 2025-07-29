<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_reaktif.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$today=$perthn."-".$perbln;

$hasil=mysql_query("select noKantong as nk from drapidtest where hasil='0' and substring(tgl_tes,1,7) like '$today'");
	$TRec=mysql_num_rows($hasil);
$perbln=substr($today,5,2);
$perthn=substr($today,0,4);
	?>

	<table class="list" id="box-table-b">
<tr> <td colspan=2>Daftar Kantong Reaktif : <?=$perbln?> - <?=$perthn?></td></tr>
			<tr class="record">
				<th colspan=7><b>Total = <?=mysql_num_rows($hasil)?> Kantong</b></th></tr><tr class="field">
				<th rowspan=2><b>No</b></th>
				<th rowspan=2><b>No Kantong</b></th>
				<th colspan=4><b>Jenis Periksa</b></th>
				<th rowspan=2><b>Tanggal Test</b></th>
				<th rowspan=2><b>Pemeriksa</b></th>
			</tr><tr class="field">
				<th><b>HBsAg</b></th>
				<th><b>HCV</b></th>
				<th><b>HIV</b></th>
				<th><b>Syp</b></th>
				</tr>
<?
				$no=1;
				while($baris=mysql_fetch_assoc($hasil)){ ?>
			<tr class="record">
				<td>
				<div align="center"><font size="2"><?=$no?>.
				</div>
				</td>
				<td>
					<?=$baris[nk]?>
				<input name=detil type=button value="Detail" onclick="$.fn.colorbox({href:'modul/detail_reaktif.php?nokan=<?=$baris[nk]?>',iframe:true,innerWidth:420,innerHeight:180},function(){ $().bind('cbox_closed',function(){window.location ='pmilaboratorium.php?module=rekap_reaktif'})});">
				</td>
<?
$reak0=mysql_query("select Hasil,tgl_tes,dicatatoleh from testrapid where nokantong='$baris[nk]'");
while($reak=mysql_fetch_assoc($reak0)){  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='0') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak[tgl_tes];
$pemeriksa=$reak[dicatatoleh];

/*

$reak0=mysql_query("select Hasil,tgl_tes,dicatatoleh from drapidtest where nokantong='$baris[nk]'");
if (mysql_num_rows($reak0)=='1') {
$reak=mysql_fetch_assoc($reak0);  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='0') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak[tgl_tes];
$pemeriksa=$reak[dicatatoleh];*/


}
$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh from hasilelisa where noKantong='$baris[nk]'");
while($reak2=mysql_fetch_assoc($reak1)){  
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak2[tglPeriksa];
$pemeriksa=$reak2[dicatatOleh];

/*

$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh from hasilelisa where noKantong='$baris[nk]'");
$reak2=mysql_fetch_assoc($reak1);
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak2[tglPeriksa];
$pemeriksa=$reak2[dicatatOleh];*/


}

?>		
<td><?=$tgl?></td>
<td><?=$pemeriksa?></td>
	</tr>
		<?
		$no++;
	} ?>
</table>
