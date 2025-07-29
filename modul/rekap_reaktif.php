<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
 <script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<?
include('clogin.php');
include('config/db_connect.php');

?>
<h3 class="list">Rekap Hasil Pemeriksaan IMLTD Reaktif</h3>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table>
<tr>
<td>Pilih Periode : </td>
<td>
<input name="waktu" id="datepicker" type=text size=10> Sampai Dengan
<input name="waktu1" id="datepicker1" type=text size=10>
</td><td>

<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?

if (isset($_POST[submit])) {
$namauser=$_SESSION[namauser];
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);


?>
<h3 class="list">Rekap Hasil pemeriksaan reaktif dari Tgl : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> s/d Tgl:
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<!--form rekap-->
<?

$hasil=mysql_query("select noKantong as nk, jenis as jn, tglperiksa as tgl,gol_darah as gd,RhesusDrh as rh,tgl_Aftap as ta,statKonfirmasi as kon from stokkantong where hasil='4' and ident='m' and CAST(tglperiksa as date) >='$_POST[waktu]' and CAST(tglperiksa as date) <='$_POST[waktu1]' order by tglperiksa ASC");

	
$hbs=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as hbs from hasilelisa where jenisPeriksa='0' and hasil='1' and CAST(tglperiksa as date) >='$_POST[waktu]' and CAST(tglperiksa as date) <='$_POST[waktu1]' group by noKantong"));
$hcv=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as hcv from hasilelisa where jenisPeriksa='1' and hasil='1' and CAST(tglperiksa as date) >='$_POST[waktu]' and CAST(tglperiksa as date) <='$_POST[waktu1]' group by noKantong"));
$hiv=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as hiv from hasilelisa where jenisPeriksa='2' and hasil='1' and CAST(tglperiksa as date) >='$_POST[waktu]' and CAST(tglperiksa as date) <='$_POST[waktu1]' group by noKantong"));
$syp=mysql_fetch_assoc(mysql_query("select count(jenisPeriksa) as syp from hasilelisa where jenisPeriksa='3' and hasil='1' and CAST(tglperiksa as date) >='$_POST[waktu]' and CAST(tglperiksa as date) <='$_POST[waktu1]' group by noKantong"));

	$TRec=mysql_num_rows($hasil);
?>

<br>
<table class="list" id="box-table-b"> 
      <tr>

        <!--td colspan=2>Daftar Kantong Non Reaktif :
          <?=$bln22?>
          -

          <?=$perthn?></td>
		  <!--td>Ketik No Kantong <input name="cari" type="text" /></td-->
      </tr>
      <tr class="record">
        <th colspan=17><b>Total =
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
	<!--th rowspan=2><b>Pendonor</b></th-->
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
          <!--a href="modul/detail_nonreaktif.php?nokan=<?=$baris[nk]?>&width=430&height=250" class="thickbox"><img src="images/button_search.png" border="0" /></a--> </td>
        <!--td>
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
</form></td-->
        <!--?
for ($jenis=0;$jenis<4;$jenis++) {
$reak0=mysql_query("select Hasil,tglPeriksa,dicatatOleh,Metode,jenisperiksa,OD from hasilelisa where nokantong='$baris[nk]' and jenisPeriksa='$jenis' limit 1");
if (mysql_num_rows($reak0)=='1') {
$reak=mysql_fetch_assoc($reak0);  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='1') $hasilr='Reaktif';
?-->
<?
$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh,Metode,jenisperiksa,OD from hasilelisa where nokantong='$baris[nk]' and jenisPeriksa='0'");
$reak2=mysql_query("select Hasil,tglPeriksa,dicatatOleh,Metode,jenisperiksa,OD from hasilelisa where nokantong='$baris[nk]' and jenisPeriksa='1'");
$reak3=mysql_query("select Hasil,tglPeriksa,dicatatOleh,Metode,jenisperiksa,OD from hasilelisa where nokantong='$baris[nk]' and jenisPeriksa='2'");
$reak4=mysql_query("select Hasil,tglPeriksa,dicatatOleh,Metode,jenisperiksa,OD from hasilelisa where nokantong='$baris[nk]' and jenisPeriksa='3'");
$reak11=mysql_fetch_assoc($reak1);
$reak12=mysql_fetch_assoc($reak2);
$reak13=mysql_fetch_assoc($reak3);
$reak14=mysql_fetch_assoc($reak4);

$hasil11='-';
if ($reak11[Hasil]=='0') {
$hasil11='Non Reaktif';
}else if ($reak11[Hasil]=='1') { 
$hasil11='Reaktif';
}
$hasil12='-';
if ($reak12[Hasil]=='0') {
$hasil12='Non Reaktif';
}else if ($reak12[Hasil]=='1') { 
$hasil12='Reaktif';
}
$hasil13='-';
if ($reak13[Hasil]=='0') {
$hasil13='Non Reaktif';
}else if ($reak13[Hasil]=='1') { 
$hasil13='Reaktif';
}
$hasil14='-';
if ($reak14[Hasil]=='0') {
$hasil14='Non Reaktif';
}else if ($reak14[Hasil]=='1') { 
$hasil14='Reaktif';
}

?>
<td><?=$hasil11?>, <?=$reak11[OD]?></td>
<td><?=$hasil12?>, <?=$reak12[OD]?></td>
<td><?=$hasil13?>, <?=$reak13[OD]?></td>
<td><?=$hasil14?>, <?=$reak14[OD]?></td>


        <?
$ptgs=mysql_fetch_assoc(mysql_query("select dicatatOleh,Metode from hasilelisa where nokantong='$baris[nk]'"));
$tgl=$reak[tglPeriksa];
$pemeriksa=$reak[dicatatOleh];
$metode=$ptgs[Metode];


$umur=mysql_fetch_assoc(mysql_query("select umur as um ,JenisDonor as jd ,jk as jk,donorbaru as db from htransaksi  where nokantong='$baris[nk]'"));
?>

        <!--td><?=$tgl?></td-->
	<td><?=$baris[tgl]?></td>
	<td><?=$ptgs[dicatatOleh]?></td>
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
	<!--td><?=$baris[nm]?></td-->
      </tr>
      <?

		$no++;
	} ?>
    </table>
	</br>

<form name=xls method=post action=modul/rekap_reaktif_xls.php>
<input type=hidden name=pertgl value="<?=$pertgl?>">
<input type=hidden name=perbln value="<?=$perbln?>">
<input type=hidden name=perthn value="<?=$perthn?>">
<input type=hidden name=pertgl1 value="<?=$pertgl1?>">
<input type=hidden name=perbln1 value="<?=$perbln1?>">
<input type=hidden name=perthn1 value="<?=$perthn1?>">
<input type=submit name=submit2 value='Print Rekap Reaktif Elisa (.XLS)'>
</form>
</tr>
<?
}
?>

