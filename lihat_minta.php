<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
include 'config/db_connect.php';
if ($_POST[submit]) {
	$box=$_POST['beri'];
        $jumberi=$_POST['jumberi'];
        $kode=$_POST['kode'];
        for ($i=0;$i<count($box);$i++) {
	$ck=mysql_fetch_assoc(mysql_query("select * from hstok where Kode='$kode[$i]'"));
	$ber=(int)$ck[StokTotal];
	if ($ber>=$jumberi[$i]) {
	$upstat=mysql_query("update hpermintaan set status='1' 
                        where (NoTrans='$box[$i]')");
	$jberi=mysql_query("update dpermintaan set JumBeri='$jumberi[$i]' 
                        where (KodeBrg='$kode[$i]' and notrans='$box[$i]')");
	$kurang=$ber-$jumberi[$i];
	$up=mysql_query("update hstok set StokTotal='$kurang' where Kode='$kode[$i]'");
	} else {
	echo ("Stok Barang Tidak Cukup  !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">"); }
}
	//echo "hasil $kurang $ber $jumberi[$i]";
	if ($upstat) echo ("Data telah diupdate !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=$PHP_SELF\">");
}
?>
<h1 class="table">Lihat Permintaan Barang</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Pilih Periode : </td>
<td class="input">
<input class=text name="waktu" id="datepicker" type=text size=10>Sampai Dengan
<input class=text name="waktu1" id="datepicker1" type=text size=10>
</td></tr>
<tr>
<td>Bagian :</td><td class="input">
                <select name="bagian">
                <option value="0">ATK</option>
                <option value="1">LAB</option>
                </select>
        </td></tr>
<tr>
<td>Status :</td><td class="input">
                <select name="status">
		<option value="0">Belum Diberi</option>
                <option value="1">Sudah Diberi</option>
                </select>
        </td>
</tr></table>
<input type=submit name=submit value="Search">
</form>
<?if (isset($_POST[submit])) {
$today=date("Y-m-d");
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);
if ($_POST[status]=='0') { $kete="Belum Diberi"; } else { $kete="Sudah Diberi"; }
?>
<h1 class="table">List Permintaan Barang ( <?=$kete?> )<br>
Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h1>
<?
$cek0=mysql_query("select * from hpermintaan where (tgl>='$_POST[waktu]' and tgl<='$_POST[waktu1]') and jenis='$_POST[bagian]' and status='$_POST[status]'");
while ($cek=mysql_fetch_assoc($cek0)) {
$minta0=mysql_query("select * from dpermintaan where notrans='$cek[NoTrans]'"); 
if (($_POST[status]=='0') and ($cek[status]=='0')) {
?>
<table class=form border=1 cellpadding=0 cellspacing=0>
<form align="left" method="post" action="<?echo $PHPSELF?>">
<tr class="field">
          <td>No</td>
          <td>No Trans</td>
          <td>Kode Barang</td>
          <td>Jumlah Minta</td>
          <td>Jumlah Diberi</td>
          <td>Keterangan</td>
   </tr>
<?
$no=1;
if ($minta0) while ($minta=mysql_fetch_assoc($minta0)) {
	if ($minta[JumBeri]=='0') {
	?>
	<tr class="record">
		<td><?=$no?>.<input type=hidden name=beri[] value="<?=$minta[notrans]?>"></td>
          <td class=input><?=$minta[notrans]?></td> 
          <td class=input><?=$minta[KodeBrg]?></td> 
          <td class=input><?=$minta[jumMinta]?></td> 
          <td class=input><input type="text" name="jumberi[]" size="5"> </td> 
          <td class=input><?=$minta[Ket]?></td></tr>
	<? $no++; ?> 
	<input type="hidden" name="kode[]" value="<?=$minta[KodeBrg]?>">
	<? }
}
?>
</table>
<input type="submit" name="submit" value="Submit">
</form>
<? } else {
?>
<h1 class="table">Header Permintaan</h1>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr class="field">
          <td>No Trans</td>
          <td>Nama Peminta</td>
          <td>Jenis</td>
          <td>Status</td>
   </tr>
<tr class="record">
      <td class=input><?=$cek[NoTrans]?></td>
      <td class=input><?=$cek[nama]?></td>
<?if ($cek[jenis]=='0') { $jen="ATK"; } else { $jen="LAB"; }
if ($cek[status]=='1') $stat="Sudah Diberi"; 
?>
      <td class=input><?=$jen?></td>
      <td class=input><?=$stat?></td>
</tr></table>
</br>
<h1 class="table">Detil Permintaan</h1>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr class="field">
          <td>Kode Barang</td>
          <td>Nama Barang</td>
          <td>Jumlah Minta</td>
          <td>Jumlah Beri</td>
          <td>Keterangan</td>
   </tr>
<tr class="record">
<?
//}
if ($minta0) while ($minta=mysql_fetch_assoc($minta0)) {
$nama=mysql_fetch_assoc(mysql_query("select NamaBrg from hstok where Kode='$minta[KodeBrg]'"));
?>
                 <td class=input><?=$minta[KodeBrg]?></td> 
                 <td class=input><?=$nama[NamaBrg]?></td> 
                 <td class=input><?=$minta[jumMinta]?></td> 
                 <td class=input><?=$minta[JumBeri]?></td> 
                 <td class=input><?=$minta[Ket]?></td></tr>
<?}
 ?>

</table>
<?}
}
if ($_POST[status]=='1')  {

?>
</br>
<form name=xls method=post action=list_minta_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=jenis value='<?=$_POST[bagian]?>'>
<input type=hidden name=status value='<?=$_POST[status]?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=waktu1 value='<?=$_POST[waktu1]?>'>
<input type=submit name=submit value='Print List Permintaan (.XLS)'>
</form>
<?}
}
?>
