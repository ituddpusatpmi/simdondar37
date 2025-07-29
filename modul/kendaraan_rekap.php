<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$nopol="";
$jenisbiaya="";
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d",$tglsebelum);
$hariini = date("Y-m-d");
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #8888FF }
</style>
<style type="t	ext/css">.styled-select select {background-color: #F7D7D7; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<script>
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {$('html,body').animate({scrollTop: target.offset().top}, 5000);return false;}
    }
  });
});
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sistem Informasi Unit Donor Darah</title>
</head>
<body>
	<?
	if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
	if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
	if ($_POST[nopol]!='') $nopol=$_POST[nopol];
	if ($_POST[jenisbiaya]!='') $jenisbiaya=$_POST[jenisbiaya];
	?>
	<font size="5" color=red>REKAP BIAYA KENDARAAN</font><br>
	<form name="cari" method="POST" action="<?echo $PHPSELF?>">
		<font size="2" color=black>
		DARI TANGGAL :<input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size="8">
		S/D. :<input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size="8">
		NO. POLISI :<input name="nopol" id="nopol" value="<?=$nopol?>" type=text size="8">
		JENIS BIAYA :<input name="jenisbiaya" id="jenisbiaya" value="<?=$jenisbiaya?>" type=text>
		<input type=submit name=submit class="swn_btn_tengah" value="Lihat"></font>
	</form>
	<table class="list" border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse">
		<tr class="field">
			<td>NO.</td>
			<td>TANGGAL</td>
			<td>NO.POLISI</td>
			<td>NAMA KENDARAAN</td>
			<td>JENIS</td>
			<td>URAIAN</td>
			<td>REKANAN</td>
			<td>REFERENSI</td>
			<td>PETUGAS</td>
			<td>BIAYA</td>
		</tr>
		<?
		$no=0;
		$total=0;
		$mbl="SELECT  `mobil_transaksi`.`id` ,  `mobil_transaksi`.`tglinput` ,  `mobil_transaksi`.`nopol` ,  `mobil_transaksi`.`tgl` ,  `mobil_transaksi`.`jenis_transaksi` , `mobil_transaksi`.`uraian_transaksi` ,  `mobil_transaksi`.`petugas` ,  `mobil_transaksi`.`nominal` ,  `mobil_transaksi`.`referensi` ,  `mobil_transaksi`.`rekanan` , `mobil_transaksi`.`km` ,  `mobil_transaksi`.`keterangan` , mobil.nama_mobil
			  FROM  `mobil_transaksi` 
			  INNER JOIN mobil ON mobil.nopol = mobil_transaksi.nopol
			  WHERE (date(`mobil_transaksi`.`tgl`)>='$tglawal' and date(`mobil_transaksi`.`tgl`)<='$hariini') and `mobil_transaksi`.`nopol` like '%$nopol%'
			  AND (`mobil_transaksi`.`jenis_transaksi`) like '%$jenisbiaya%'
			  ORDER BY `mobil_transaksi`.`tgl`";
		$qmbl=mysql_query($mbl);
		while ($qmobil=mysql_fetch_assoc($qmbl)) {
			$no++;
			$total=$total+$qmobil['nominal'];
			$nilai=number_format($qmobil['nominal'],0,",",".");
			?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
				<td align="right"><?=$no?>.</td>
				<td align="left"><?=$qmobil['tgl']?></td>
				<td align="left"><?=$qmobil['nopol']?></td>
				<td align="left"><?=$qmobil['nama_mobil']?></td>
				<td align="left"><?=$qmobil['jenis_transaksi']?></td>
				<td align="left"><?=$qmobil['uraian_transaksi']?></td>
				<td align="left"><?=$qmobil['rekanan']?></td>
				<td align="left"><?=$qmobil['referensi']?></td>
				<td align="left"><?=$qmobil['petugas']?></td>
				<td align="right"><?=$nilai?></td>
				
			</tr>
		<?}
		if ($no==0){?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="center" colspan=10>Tidak ada transaksi sesuai dengan filter data yang dimasukkan.</td>
		</tr><?
		}?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right" colspan=9>TOTAL</td>
			<td align="right"><?=number_format($total,0,",",".")?></td>
		</tr>
	</table>
	<a href="pmimobile.php?module=master_kendaraan"class="swn_button_blue">Kembali</a>
</body>
</html>