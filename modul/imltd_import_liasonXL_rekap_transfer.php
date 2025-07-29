<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d",$tglsebelum);
$hariini = date("Y-m-d");
?>

<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMDONDAR</title>
</head>

<body>
	<?
		if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
		if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
	?>
	<font size="5" color=#00008B><b>REKAP TRANSFER PEMERIKSAAN DIASORIN LIAISON<sup>&reg</sup>XL</b></font><br>
	<form name="cari" method="POST" action="<?echo $PHPSELF?>">
		<table class="list" cellpadding=1 cellspacing=1 width="750px">
			<tr class="field">
				<td align="left">Dari tanggal :</td>
				<td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size=10></td>
				<td align="left">sampai dengan tanggal :</td>
				<td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
				<td><input type=submit name=submit class="swn_button_blue" value="Tampilkan data transfer"></td>
			</tr>
		</table>	
	</form>
	<table class="list" border=2 cellpadding=5 cellspacing=10 style="border-collapse:collapse" width="750px">
		<tr class="field">
			<td rowspan=2>NO.</td>
			<td colspan=2>PEMERIKSAAN</td>
			<td rowspan=2>WAKTU TRANSFER</td>
			<td rowspan=2>NO<br>TRANSAKSI</td>
			<td rowspan=2>JUMLAH<br>PEMERIKSAAN</td>
			<td rowspan=2>STATUS<br>TRANSAKSI</td>
		</tr>
		<tr class="field">
			<td>TANGGAL</td>
			<td>JAM</td>
		</tr>
	<?php
	$no=0;
	$sql="SELECT `id_transaksi`,`confirm`,`instrument_name`,`run_time`, date(`run_time`) as tanggal, time(`run_time`) as jam, `operator`, count(`sample_id`) as jml_sample
		FROM `liason2021`
		WHERE DATE(`run_time`)>='$tglawal' and DATE(`run_time`)<='$hariini' AND `sample_type`='S' and (qualitative in ('-1','0','1'))
		GROUP BY `id_transaksi`";	

	/*$sql="SELECT Tgl, Jam, WaktuInsert, NoTransaksi, Count( DISTINCT `SampleID` ) AS jumlah, Status FROM `imltd_liason_import_temp`
		  WHERE DATE(`Tgl`)>='$tglawal' and DATE(`Tgl`)<='$hariini'
		  AND Status='0'
		  Group by NoTransaksi";*/
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
		if ($tmp['confirm']==0) {$statusnya="Belum dikonfirmasi";}else{$statusnya="Selesai";}
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td><?=$tmp['tanggal']?></td>
			<td><?=$tmp['jam']?></td>
			<td><?=$tmp['jam']?></td>
			<td><?=$tmp['id_transaksi']?></td>
			<td align="right"><?=$tmp['jml_sample']?></td>
			<td align="left"><?=$statusnya?></td>
		</tr>
	<?}
	if ($no==0){?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td colspan=8 align="center">Tidak ada data ............</td>
	<?}?>
	</table><br>
	<a href="pmiimltd.php?module=import_liasonxl" class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

