<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/bln_reaktif.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 <script language="javascript" src="js/jquery.js"></script>
 <script language="javascript" src="modul/thickbox/thickbox.js"></script>
<?
include('config/db_connect.php');
$today=date("Y-m");
if (isset($_POST[minta1])) $today=$_POST[minta1];
$perbln=substr($today,5,2);
$perthn=substr($today,0,4);

$bln2=date("n",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$bln2];

$hasil=mysql_query("select noKantong as nk from drapidtest where hasil='0' and substring(tgl_tes,1,7) like '$today'");
	$TRec=mysql_num_rows($hasil);
$perthn=substr($today,0,4);
	?>
<div>
<form name=mintadarah1 method=post> Bulan :
<input type=text name=minta1 id=datepicker size=10 onChange="this.form.submit();">
</form>
</div>
	<table class="list" id="box-table-b">
<tr> <td colspan=2>Daftar Kantong Reaktif Rapid Test: <?=$bln22?> - <?=$perthn?></td></tr>
			<tr class="record">
				<th colspan=9><b>Total = <?=mysql_num_rows($hasil)?> Kantong</b></th></tr><tr class="field">
				<th rowspan=2><b>No</b></th>
				<th rowspan=2><b>No Kantong</b></th>
				<th rowspan=2><b>Surat Panggilan</b></th>
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
  <a href="modul/detail_reaktif_rapid.php?nokan=<?=$baris[nk]?>&width=430&height=250" class="thickbox"><img src="images/button_search.png" border="0" /></a>
</td>
<td>
<form name="kirim" method="post" action="modul/kirim_surat_reaktif.php" target="_blank">
<?
$check=mysql_fetch_assoc(mysql_query("select stokcheck from stokkantong where noKantong='$baris[nk]'"));
if ($check[stokcheck]=='') {
?>
No Surat : <input name="nosurat" type="text" size="20" type="text">
<? } else { ?>
No Surat : <?=$check[stokcheck]?>
<input name="nosurat" type="hidden" value="<?=$check[stokcheck]?>">
<? }?>
<input name="nokan" type="hidden" value="<?=$baris[nk]?>">
<input name="submit" type="submit" value="Kirim Surat">
</form></td>				
<?
for ($jenis=0;$jenis<4;$jenis++) {
$reak0=mysql_query("select Hasil,tgl_tes,dicatatoleh from drapidtest where nokantong='$baris[nk]' and jenisPeriksa='$jenis'");
if (mysql_num_rows($reak0)=='1') {
$reak=mysql_fetch_assoc($reak0);  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='0') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak[tgl_tes];
$pemeriksa=$reak[dicatatoleh];
}/* else {
$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh from hasilelisa where noKantong='$baris[nk]' and jenisPeriksa='$jenis'");
$reak2=mysql_fetch_assoc($reak1);
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak2[tglPeriksa];
$pemeriksa=$reak2[dicatatOleh];
}
//}*/
?>		
<td><?=$tgl?></td>
<td><?=$pemeriksa?></td>
	</tr>
		<?
		$no++;
	} ?>
</table>
</br>
<form name=xls method=post action=modul/rekap_reaktif_xls.php>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=submit name=submit2 value='Print Rekap Reaktif (.XLS)'>
</form>

