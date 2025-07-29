<head>
<script language=javascript src="idhasil.js" type="text/javascript"> </script>
<script language=javascript src="util.js" type="text/javascript"> </script>
</head>
<body OnLoad="document.label_lab.nokantong.focus();">
<form name="label_lab" method="POST" action="<?=$PHPSELF?>">
<table border=0>
<tr><td>
No Kantong
</td><td>
<input name="nokantong" type="text">
</td></tr>
<tr><td colspan=2>
<input name="submit" type="submit" value="Submit">
</td></tr>
</form>
<? 
require_once('config/db_connect.php');
if (isset($_POST[submit])) {
$kantong=mysql_query("select * from stokkantong where noKantong='$_POST[nokantong]' and Status='2' and statkonfirmasi='1'");
$kantong1=mysql_num_rows($kantong);
if ($kantong1>0) { $kantong1=mysql_fetch_assoc($kantong);
?>
<tr><td>Produk</td><td><?=$kantong1[produk]?></td></tr>
<tr><td>Volume</td><td><?=$kantong1[volume]?></td></tr>
<tr><td>Gol Darah</td><td><?=$kantong1[gol_darah]?></td></tr>
<tr><td>Rhesus</td><td><?=$kantong1[RhesusDrh]?></td></tr>
<tr><td>Aftap</td><td><?=$kantong1[tgl_Aftap]?></td></tr>
<tr><td>Exp</td><td><?=$kantong1[kadaluwarsa]?></td></tr>
<tr><td><b><u>Non Reaktif Terhadap</u></b></td><td></td></tr>
<?
$no=1;
$lab=mysql_query("select jenisperiksa from drapidtest where nokantong='$_POST[nokantong]' and Hasil='1'");
$lab2=mysql_query("select jenisperiksa from hasilelisa where nokantong='$_POST[nokantong]' and Hasil='0'");
while($lab12=mysql_fetch_assoc($lab2)){
if ($lab12[jenisperiksa]=="0") $lab112="HBsAg";
if ($lab12[jenisperiksa]=="1") $lab112="HCV";
if ($lab12[jenisperiksa]=="2") $lab112="HIV";
if ($lab12[jenisperiksa]=="3") $lab112="Syp";?>

<tr><td><?=$no?>.<?=$lab112?></td><td></td></tr>
<?
$no++;
}
while($lab1=mysql_fetch_assoc($lab)){
if ($lab1[jenisperiksa]=="0") $lab11="HBsAg";
if ($lab1[jenisperiksa]=="1") $lab11="HCV";
if ($lab1[jenisperiksa]=="2") $lab11="HIV";
if ($lab1[jenisperiksa]=="3") $lab11="Syp";?>

<tr><td><?=$no?>.<?=$lab11?></td><td></td></tr>
<?
$no++;
}

}
else {
echo "Status kantong bukan darah sehat atau belum diuji saring atau belum di konfirmasi gol darah, harap klik CHECK STOK untuk melihat status";
}
}
if (isset($kantong1[noKantong])) {
?>
<tr><td>
	<input name=cetak type=button value="Cetak" onclick="$.fn.colorbox({href:'idhasil.php?noKantong=<?=$kantong1[noKantong]?>', iframe:true, innerWidth:350, innerHeight:350},function(){ $().bind('cbox_closed', function(){window.location ='pmilaboratorium.php?module=shasil_labl'})});">
	</td><td></td></tr>
<? } ?>
</table>
</body>
