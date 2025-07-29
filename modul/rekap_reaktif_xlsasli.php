<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_reaktif_elisa.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$perthn1."-".$perbln1."-".$pertgl1;


	?>

	<table class="list" id="box-table-b">
<tr> <td colspan=12>Daftar Pemeriksaan IMLTD Kantong Reaktif Elisa dari tanggal : <?=$today?> sampai dengan  <?=$today1?> </td></tr>
<?
//$hasil=mysql_query("select dr.noKantong as nk,dr.tglPeriksa as tgl,dr.jenisPeriksa,sk.tgl_Aftap as ta,sk.gol_darah as gd,sk.RhesusDrh as rh,sk.statKonfirmasi as kon,sk.mu as md from hasilelisa as dr,stokkantong as sk where dr.tglPeriksa>='$_POST[waktu]' and dr.tglPeriksa<='$_POST[waktu1]' and sk.noKantong=dr.noKantong  and dr.hasil='1' group by sk.nokantong order by sk.tgl_Aftap ASC  ");
$hasil=mysql_query("select dr.noKantong as nk,dr.tglPeriksa as tgl,sk.tgl_Aftap as ta,sk.gol_darah as gd,sk.RhesusDrh as rh,sk.statKonfirmasi as kon,mu as md from hasilelisa as dr,stokkantong as sk where dr.hasil='1' and dr.tglPeriksa>='$today' and dr.tglPeriksa<='$today1' and sk.noKantong=dr.noKantong group by dr.nokantong order by tgl_Aftap ASC");
$hbs=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as hbs from hasilelisa where jenisPeriksa='0' and hasil='1' and tglPeriksa>='$today' and tglPeriksa<='$today1' "));
$hcv=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as hcv from hasilelisa where jenisPeriksa='1' and hasil='1' and tglPeriksa>='$today' and tglPeriksa<='$today1' "));
$hiv=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as hiv from hasilelisa where jenisPeriksa='2' and hasil='1' and tglPeriksa>='$today' and tglPeriksa<='$today1' "));
$syp=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as syp from hasilelisa where jenisPeriksa='3' and hasil='1' and tglPeriksa>='$today' and tglPeriksa<='$today1' "));
	$TRec=mysql_num_rows($hasil);
?>
      <tr class="record">
        <th colspan=16><b>Total =
          <?=mysql_num_rows($hasil)?>
          Kantong dengan rincian : HBsAg = <?=$hbs[hbs]?> Kantong, HCV = <?=$hcv[hcv]?> Kantong, HIV = <?=$hiv[hiv]?> Kantong, Syphilis = <?=$syp[syp]?> Kantong</b></th>
      </tr>
      <tr class="field">
        <th rowspan=2><b>No</b></th>
        <th rowspan=2><b>No Kantong</b></th>
	<!--th rowspan=2><b>Surat Panggilan</b></th-->
        <th colspan=4><b>Jenis Periksa</b></th>
        <th rowspan=2><b>Tanggal Test</b></th>
	<th rowspan=2><b>Pemeriksa</b></th>
	<th rowspan=2><b>Metode</b></th>
	<th rowspan=2><b>Tanggal Aftap</b></th>
	<th rowspan=2><b>DG/MU</b></th>	
	<th rowspan=2><b>Gol&Rh<br>Darah</b></th>
	<th rowspan=2><b>Konf. GolDar</b></th>
	<th rowspan=2><b>Umur</b></th>
	<th colspan=2><b>Jenis Donor</b></th>
	<th rowspan=2><b>JK</b></th>
      </tr>
      <tr class="field">
        <th><b>HBsAg</b></th>
        <th><b>HCV</b></th>
        <th><b>HIV</b></th>
        <th><b>Syp</b></th>
	<th><b>DS/DP</b></th>
	<th><b>Baru/Ulang</b></th>
      </tr>
      <?
				$no=1;
				while($baris=mysql_fetch_assoc($hasil)){ 
$kon='Belum';
if($baris[kon]=='1') $kon='Sudah';
?>
      <tr class="record">
        <td><div align="center"><font size="2">
            <?=$no?>
		</font></div></td>
        <td><?=$baris[nk]?>
          <!--a href="modul/detail_nonreaktif.php?nokan=<?=$baris[nk]?>&width=430&height=250" class="thickbox"><img src="images/button_search.png" border="0" /></a> </td>
        <!--<td>
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
</form></td>-->
        <?
for ($jenis=0;$jenis<4;$jenis++) {
$reak0=mysql_query("select Hasil,tglPeriksa,dicatatOleh,Metode,OD from hasilelisa where nokantong='$baris[nk]' and jenisPeriksa='$jenis' limit 1");
if (mysql_num_rows($reak0)=='1') {
$reak=mysql_fetch_assoc($reak0);  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='1') $hasilr='Reaktif';
?>
        <td><?=$hasilr?>, <?=$reak[OD]?></td>
        <?
$tgl=$reak[tglPeriksa];
$pemeriksa=$reak[dicatatOleh];
$metode=$reak[Metode];

$umur=mysql_fetch_assoc(mysql_query("select umur as um ,JenisDonor as jd ,jk as jk,donorbaru as db from htransaksi  where nokantong='$baris[nk]'"));
} /*else {

$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh,OD,Metode from hasilelisa where noKantong='$baris[nk]' and jenisPeriksa='$jenis' limit 1");
$reak2=mysql_fetch_assoc($reak1);
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';

?>
        <td><?=$hasilr?> , <?=$reak2[OD]?></td>
        <?
$tgl=$reak2[tglPeriksa];

$pemeriksa=$reak2[dicatatOleh];
$metode=$reak2[Metode];
}*/
}
?>

        <!--td><?=$tgl?></td-->
	<td><?=$baris[tgl]?></td>
	<td><?=$pemeriksa?></td>
	<td><?=$metode?></td>
	<td><?=$baris[ta]?></td>
<? if ($baris[md]=="")$mu1="DG";
	if ($baris[md]!="")$mu1="MU";
?>
	<td><?=$mu1?></td>
	<td><?=$baris[gd]?> (<?=$baris[rh]?>)</td>
	<td><?=$kon?></td>
	<td><?=$umur[um]?> th</td>
<?
$ds="DS";
if ($umur[um]=="1") $ds="DP";
$baru="Baru";
if ($umur[db]>"0") $baru="Ulang";
$jk="Laki-Laki";
if ($umur[jk]=="1") $jk="Perempuan";
?>

	<td><?=$ds?></td>
	<td><?=$baru?></td>
	<td><?=$jk?></td>
      </tr>
      <?

		$no++;
	} ?>
    </table>
