<head>
<script language=javascript src="idhasil.js" type="text/javascript"> </script>
<script language=javascript src="util.js" type="text/javascript"> </script>
</head>
<body OnLoad="document.label_lab.cetak.focus();">
<form name="label_lab">
<table border="0">
<?
require_once('config/db_connect.php');
$notrans=$_GET['ns'];
$kantong=mysql_query("select * from hpengolahan where notrans='$notrans' AND musnah='0'");
    while($kkomp=mysql_fetch_assoc($kantong)){
        $stokk=mysql_fetch_assoc(mysql_query("SELECT tgl_Aftap, kadaluwarsa FROM stokkantong WHERE noKantong='$kkomp[nokantong]'"));
?>
	<tr><td>No Kantong</td><td><?=$kkomp['nokantong']?></td></tr>
	<tr><td>Produk</td><td><?=$kkomp['komponen']?></td></tr>
	<tr><td>Volume</td><td><?=$kkomp['volume']?></td></tr>
	<tr><td>Gol Darah</td><td><?=$kkomp['gd']?></td></tr>
	<tr><td>Rhesus</td><td><?=$kkomp['rh']?></td></tr>
	<tr><td>Aftap</td><td><?=$stokk['tgl_Aftap']?></td></tr>
	<tr><td>Exp</td><td><?=$stokk['kadaluwarsa']?></td></tr>
	<tr><td><b><u>Non Reaktif Terhadap</u></b></td><td></td></tr>
<?
$no=1;
$lab=mysql_query("select jenisperiksa from drapidtest where nokantong='$kkomp[nokantong]' and Hasil='1'");
$lab2=mysql_query("select jenisperiksa from hasilelisa where nokantong='$kkomp[nokantong]' and Hasil='0'");
while($lab12=mysql_fetch_assoc($lab2)){
	if ($lab12['jenisperiksa']=="0") $lab112="HBsAg";
	if ($lab12['jenisperiksa']=="1") $lab112="HCV";
	if ($lab12['jenisperiksa']=="2") $lab112="HIV";
	if ($lab12['jenisperiksa']=="3") $lab112="Syp";?>
	<tr>
		<td><?=$no?>.<?=$lab112?></td>
		<td></td>
	</tr>
<?
$no++;
}
while($lab1=mysql_fetch_assoc($lab)){
	if ($lab1['jenisperiksa']=="0") $lab11="HBsAg";
	if ($lab1['jenisperiksa']=="1") $lab11="HCV";
	if ($lab1['jenisperiksa']=="2") $lab11="HIV";
	if ($lab1['jenisperiksa']=="3") $lab11="Syp";?>

<tr><td><?=$no?>.<?=$lab11?></td><td></td></tr>
<?
$no++;
}
}
?>
<tr><td>
	<!--input name="cetak" type=button value="Cetak" id="cetak" onclick="$.fn.colorbox({href:'label_komponen_quick.php?notrans=<?=$_GET['ns']?>', iframe:true, innerWidth:350, innerHeight:350},function(){ $().bind('cbox_closed', function(){window.location ='pmikomponen.php?module=laborat_komponen'})});"-->
	<input name="cetak" type=button value="Cetak" id="cetak" onclick="$.fn.colorbox({href:'idpasien_barcode3.php?notrans=<?=$_GET['ns']?>', iframe:true, innerWidth:350, innerHeight:350},function(){ $().bind('cbox_closed', function(){window.location ='pmikomponen.php?module=laborat_komponen'})});">
	</td><td></td></tr>
</table>
</form>
</body>
