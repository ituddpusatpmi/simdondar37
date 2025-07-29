<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
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
include('config/db_connect.php');
include('clogin.php');
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);



?>


<h3 class="list">Rekap Hasil Pemeriksaan IMLTD Non Reaktif</h3>
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
<h3 class="list">Rekap Hasil pemeriksaan non reaktif dari Tgl : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> s/d Tgl:
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<!--form rekap-->
<?
//$hasil=mysql_query("select noKantong as nk,tglperiksa as tgl from stokkantong where hasil='2' and ident='m' and tglperiksa>='$_POST[today]' and tglperiksa<='$_POST[today1]' order by tglperiksa ASC");
$hasil=mysql_query("select noKantong as nk, jenis as jn, tglperiksa as tgl,gol_darah as gd,RhesusDrh as rh,tgl_Aftap as ta,statKonfirmasi as kon from stokkantong where hasil='2' and ident='m' and CAST(tglperiksa as date) >='$_POST[waktu]' and CAST(tglperiksa as date) <='$_POST[waktu1]' order by tglperiksa ASC");
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
	<th rowspan=2><b>Metode</b></th>
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
</form></td>-->
        <?
for ($jenis=0;$jenis<4;$jenis++) {
$reak0=mysql_query("select Hasil,tgl_tes,dicatatoleh,Metode from drapidtest where nokantong='$baris[nk]' and jenisperiksa='$jenis'");
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
} else {

$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh,OD,Metode from hasilelisa where noKantong='$baris[nk]' and jenisPeriksa='$jenis'");
$reak2=mysql_fetch_assoc($reak1);
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';

?>
        <td><?=$hasilr?> , <?=$reak2[OD]?></td>
        <?
$tgl=$reak2[tglPeriksa];

$pemeriksa=$reak2[dicatatOleh];
$metode=$reak2[Metode];
}
}
?>

        <!--td><?=$tgl?></td-->
	<td><?=$baris[tgl]?></td>
	<td><?=$pemeriksa?></td>
	<td><?=$metode?></td>
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
</form>
</tr>
<?
}
?>

