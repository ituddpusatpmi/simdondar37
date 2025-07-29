<style type="text/css">
<!--
@import url("topstyle.css");
-->
</style>
<body onload="document.musnah.NoKantong.focus()">
<?
$today=date("Y-m-d");

include ('clogin.php');
include ('config/db_connect.php');

if (isset($_POST['Button'])) {
	for ($i=0;$i<count($_POST[aktif]);$i++) {
		$n_reag=$_POST[aktif][$i];
		$aktifkan=mysql_query("update reagen set aktif='1' where (kode='$n_reag')");
	}

	if ($aktifkan) {
		echo "<BR>Reagen sudah diaktifkan<BR>";
		echo "<META http-equiv='refresh' content='0; url='<?echo $PHPSELF;?>";
	}
} else {
	//$hasil=mysql_query("select * from reagen where jumTest>0 and aktif='0' and (tglKad > '$today') and status='1'");
	//$hasil=mysql_query("select * from reagen where jumTest>0 and aktif='0' and (tglKad > '$today') and status='0'");
	$hasil=mysql_query("select * from reagen where jumTest>0 and aktif='0' order by tglKad ASC");
	$TRec=mysql_num_rows($hasil);
	?>
	<form name="aktif" align="left" method="post" action="<?echo $PHPSELF?>">
		<input type="submit" name="Button" value="Aktifkan reagen">
		<table class="list" id="box-table-b">
			<tr class="field">
				<th><b>No</b></th>
				<th><b> Kode Reagen</b></th>
				<th><b> No Lot</b></th>
				<th><b> Nama</b></th>
				<th><b> Jumlah Test</b></th>
				<th><b> Tgl Expired</b></th>
			</tr>
			<input type="hidden" name="jumlah" value="<?=mysql_num_rows($hasil)?>"> <?
	$no=1;
	while($baris=mysql_fetch_assoc($hasil)){ ?>
			<tr class="record">
				<td>
				<div align="center"><font size="2"><?=$no?>.
					<input type=checkbox name=aktif[] value="<?=$baris[kode]?>">
				</div>
				</td>
				<td>
					<?=$baris[kode]?>
				</td>
				<td>
					<?=$baris[noLot]?>
				</td>
				<td>
					<?=$baris[Nama]?>
				</td>
				<td>
					<?=$baris[jumTest]?>
				</td>
				<td>
					<?=$baris[tglKad]?>
				</td>
			</tr>
		<?
		$no++;
	} ?>
</table>
</form><?
} ?>
</body>
