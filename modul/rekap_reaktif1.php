<!--link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
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
$today=date("Y-m-d");
if (isset($_POST[minta1])) $today=$_POST[minta1];
$perbln=substr($today,5,2);
$perthn=substr($today,0,4);

$bln2=date("n",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$bln2];


$hasil=mysql_query("select noKantong as nk from stokkantong where hasil='2' and ident='m' and substring(tglperiksa,1,10) like '$today'");
	$TRec=mysql_num_rows($hasil);
$perthn=substr($today,0,4);
	?>
<div>
<form name=mintadarah1 method=post> Bulan :
<input type=text name=minta1 id=datepicker size=10 onChange="this.form.submit();">
</form>
</div>
	<table class="list" id="box-table-b">
      <tr>
        <td colspan=2>Daftar Kantong Non Reaktif :
          <?=$bln22?>
          -
          <?=$perthn?></td>
		  <!--td>Ketik No Kantong <input name="cari" type="text" /></td>
      </tr>
      <tr class="record">
        <th colspan=9><b>Total =
          <?=mysql_num_rows($hasil)?>
          Kantong</b></th>
      </tr>
      <tr class="field">
        <th rowspan=2><b>No</b></th>
        <th rowspan=2><b>No Kantong</b></th>
        <th colspan=4><b>Jenis Periksa</b></th>
        <th rowspan=2><b>Tanggal Test</b></th>
	<th rowspan=2><b>Pemeriksa</b></th>
      </tr>
      <tr class="field">
        <th><b>HBsAg</b></th>
        <th><b>HCV</b></th>
        <th><b>HIV</b></th>
        <th><b>Syp</b></th>
      </tr>
      <?
				$no=1;
				while($baris=mysql_fetch_assoc($hasil)){ ?>
      <tr class="record">
        <td><div align="center"><font size="2">
            <?=$no?>
          . </font></div></td>
        <td><?=$baris[nk]?>
          <a href="modul/detail_nonreaktif.php?nokan=<?=$baris[nk]?>&width=430&height=250" class="thickbox"><img src="images/button_search.png" border="0" /></a> </td>
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
</form></td>>
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
} else {
$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh,OD from hasilelisa where noKantong='$baris[nk]' and jenisPeriksa='$jenis'");
$reak2=mysql_fetch_assoc($reak1);
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';
?>
        <td><?=$hasilr?> , <?=$reak2[OD]?></td>
        <?
$tgl=$reak2[tglPeriksa];
$pemeriksa=$reak2[dicatatOleh];
}
}
?>
        <td><?=$tgl?></td>
	<td><?=$pemeriksa?></td>
      </tr>
      <?
		$no++;
	} ?>
    </table>
	</br>
<form name=xls method=post action=modul/rekap_nonreaktif_xls.php>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=submit name=submit2 value='Print Rekap Non Reaktif (.XLS)'>
</form-->

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
<h3 class="list">Rekap Hasil Pemeriksaan IMLTD Reaktif Rapid</h3>
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
<h3 class="list">Rekap Hasil pemeriksaan reaktif Rapid dari Tgl : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> s/d Tgl:
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<!--form rekap-->
<?
$hasil=mysql_query("select dr.noKantong as nk,dr.tgl_tes as tgl,dr.jenisperiksa as jp,sk.tgl_Aftap as ta,sk.gol_darah as gd,sk.RhesusDrh as rh,sk.statKonfirmasi as kon,sk.mu as md from drapidtest as dr,stokkantong as sk where dr.hasil='0' and dr.tgl_tes>='$_POST[waktu]' and dr.tgl_tes<='$_POST[waktu1]' and sk.noKantong=dr.noKantong group by dr.nokantong order by tgl_Aftap ASC");
$hbs=mysql_fetch_assoc(mysql_query("select count(jenisperiksa) as hbs from drapidtest where jenisperiksa='0' and hasil='0' and tgl_tes>='$_POST[waktu]' and tgl_tes<='$_POST[waktu1]' "));
$hcv=mysql_fetch_assoc(mysql_query("select count(jenisperiksa) as hcv from drapidtest where jenisperiksa='1' and hasil='0' and tgl_tes>='$_POST[waktu]' and tgl_tes<='$_POST[waktu1]' "));
$hiv=mysql_fetch_assoc(mysql_query("select count(jenisperiksa) as hiv from drapidtest where jenisperiksa='2' and hasil='0' and tgl_tes>='$_POST[waktu]' and tgl_tes<='$_POST[waktu1]' "));
$syp=mysql_fetch_assoc(mysql_query("select count(jenisperiksa) as syp from drapidtest where jenisperiksa='3' and hasil='0' and tgl_tes>='$_POST[waktu]' and tgl_tes<='$_POST[waktu1]' "));

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
          <!----a href="modul/detail_nonreaktif.php?nokan=<?=$baris[nk]?>&width=430&height=250" class="thickbox"><img src="images/button_search.png" border="0" /></a--> </td>
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
        <?
for ($jenis=0;$jenis<4;$jenis++) {
$reak0=mysql_query("select Hasil,tgl_tes,dicatatoleh,Metode from drapidtest where nokantong='$baris[nk]' and jenisperiksa='$jenis' limit 1");
if (mysql_num_rows($reak0)=='1') {
$reak=mysql_fetch_assoc($reak0);  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='0') $hasilr='Reaktif';
?>
        <td><?=$hasilr?></td>
        <?
$tgl=$reak[tgl_tes];
$pemeriksa=$reak[dicatatoleh];
$metode=$reak[Metode];

$umur=mysql_fetch_assoc(mysql_query("select umur as um ,JenisDonor as jd ,jk as jk,donorbaru as db from htransaksi  where nokantong='$baris[nk]'"));
//$kantong=mysql_fetch_assoc(mysql_query("select gol_darah as gd ,RhesusDrh as rh ,statKonfirmasi as kon,tgl_Aftap as ta from stokkantong where noKantong='$baris[nk]' order by tgl_Aftap ASC"));
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
	</br>

<form name=xls method=post action=modul/rekap_reaktif1_xls.php>
<input type=hidden name=pertgl value="<?=$pertgl?>">
<input type=hidden name=perbln value="<?=$perbln?>">
<input type=hidden name=perthn value="<?=$perthn?>">
<input type=hidden name=pertgl1 value="<?=$pertgl1?>">
<input type=hidden name=perbln1 value="<?=$perbln1?>">
<input type=hidden name=perthn1 value="<?=$perthn1?>">
<input type=submit name=submit2 value='Print Rekap Reaktif Rapid (.XLS)'>
</form>
</tr>
<?
}
?>

