<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
$jenis="";
$merk="";
$nokan="";
$tempat="";

if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
if ($_POST[nomokt]!='') $nokan=$_POST[nomokt];
if ($_POST[jenis]!='') $jenis=$_POST[jenis];
if ($_POST[merk]!='') $merk=$_POST[merk];
if ($_POST[tempat]!='') $tempat=$_POST[tempat];
?>
<h1>LAPORAN PEMBUATAN BARCODE SPUIT</h1>
<form method=post> Mulai:
TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>><br><br>
NO. SPUIT <input type=text name=nomokt id=nomokt size=10 value=<?=$srcform?>>
	</select>
Merk<select name="merk">
	<option value="">-SEMUA-</option>
	<option value="TERUMO">TERUMO</option>
	<option value="BD">BD</option>
	<option value="ONEMED">ONEMED</option>
	</select>




<!--?
include('clogin.php');
include('config/db_connect.php');
?>
<h3 class="list">Rekap Input dan Pembuatan Barcode Kantong Baru</h3>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table>
<tr>
<td>Pilih Periode : </td>
<td>
<input name="waktu" id="datepicker" type=text size=10> Sampai Dengan
<input name="waktu1" id="datepicker1" type=text size=10>
</td--><td>
<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?

if (isset($_POST[submit])) {
$namauser=$_SESSION[namauser];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);

$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);
?>
<h3 class="list">Rincian pencetakan barcode spuit Tgl : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> s/d Tgl:
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<!--form rekap-->
<?
$jum=mysql_fetch_assoc(mysql_query("select count(noKantong) as kod from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1' and keterangan like '1' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%'"));


/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendono) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
//$golA=mysql_fetch_assoc(mysql_query("select count(jenis) as S from stokkantong where keterangan like '1' and cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='1' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%' and AsalUTD is NULL"));
//$golB=mysql_fetch_assoc(mysql_query("select count(jenis) as D from stokkantong where keterangan like '1' and cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='2' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%' and AsalUTD is NULL"));
//$golAB=mysql_fetch_assoc(mysql_query("select count(jenis) as T from stokkantong where keterangan like '1' and cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='3' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%' and AsalUTD is NULL"));
//$golO=mysql_fetch_assoc(mysql_query("select count(jenis) as Q from stokkantong where keterangan like '1' and cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='4' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%' and AsalUTD is NULL"));
//$jkP=mysql_fetch_assoc(mysql_query("select count(jenis) as P from stokkantong where keterangan like '1' and cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='6' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%' and AsalUTD is NULL"));
?>

<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Laporan Jumlah Pencetakan Barcode Spuit</b></th>
<tr class="field">

<tr><td><b>Jumlah Total</b></td>
<td class=input width=100 height=50 style='font-size:16;font-weight:bold; text-align:center;'><?=$jum[kod]?></td></tr>
</table>
</td>

</tr>
</table>
</br>
<!--batas form rekap -->


<?


$data=mysql_query("select * from stokkantong where keterangan like '1' and cast(tglTerima as date)>='$today' and cast(tglTerima as date)<='$today1' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%' and AsalUTD is NULL"); ?>
<table class="list" cellpadding=5>
	<tr class="field">
		<td>No</td>
		<td>Merk</td>
		<td>Tanggal Input</td>
		<td>No Spuit</td>
		<td>Volume</td>
		<td>Status</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		if ($data1[StatTempat]==NULL) $tempat1="Logistik";
		if ($data1[StatTempat]=='0') $tempat1="Logistik";
		if ($data1[StatTempat]=='1' and $data1[Status]=='0') $tempat1="Aftap";
		if ($data1[StatTempat]=='1' and $data1[Status]=='1') $tempat1="Lab(Karantina)";
		if ($data1[StatTempat]=='1' and $data1[Status]=='2') $tempat1="Lab(Sehat)";
		if ($data1[StatTempat]=='1' and $data1[Status]=='3') $tempat1="Keluar";
		if ($data1[StatTempat]=='1' and $data1[Status]=='6') $tempat1="Rusak";		
		switch ($data1[jenis]){
                       case "1":
				$jenis1="Single";
				break;
                       case "2":
				$jenis1="Double";
				break;
                       case "3":
				$jenis1="Triple";
				break;
                       case "4":
				$jenis1="Quadruple";
				break;
                       case "6":
				$jenis1="Pediatrik";
				break;
		}
		?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[merk]?></td>
		<td><?=$data1[tglTerima]?></td>
		<td><?=$data1[noKantong]?></td>
		<td><?=$data1[volume]?></td>
		<td><?=$tempat1?></td>
	</tr>
<? } ?>
</table>



<tr>
			<td>Yang Merekap :</td>
			<td><? echo $namauser;?></td></tr>



<tr>

<br>
<form name=xls method=post action=modul/laporan_spuit_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=waktu value='<?=$today?>'>
<input type=hidden name=waktu1 value='<?=$today1?>'>
<input type=hidden name=nokan1 value='<?=$nokan?>'>
<input type=hidden name=jenis2 value='<?=$jenis?>'>
<input type=hidden name=merk1 value='<?=$merk?>'>
<input type=hidden name=user value='<?=$namauser?>'>
<input type=hidden name=tempat2 value='<?=$tempat?>'>
<input type=submit name=submit value='Download Laporan (.XLS)'>

</form>
</tr>
<?
}
?>
