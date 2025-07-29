<?php
require_once('clogin.php');
require_once('config/db_connect_lis.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$today=date('Y-m-d');
$today1=$today;
?>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #F0FFFF}.initial { background-color: #F0FFFF; color:#000000 }
	.normal { background-color: #F0FFFF }.highlight { background-color: #7FFF00 }
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMDONDAR</title>
</head>

<body>
	<font size="4" color=00008B>DATA PEMERIKSAAN Cobas 6000 BELUM KONFIRMASI</b></font><br><br>
	<style>
		td {font-family: "Arial", Verdana, serif;}
	</style>
	<table class="list" border=1 cellpadding=5 cellspacing=10 style="border-collapse:collapse" width="600px";>
		<tr class="field">
			<td>NO.</td>
			<td>INSTRUMENT</td>
			<td>TANGGAL</td>
			<td>OPERATOR</td>
			<td>JUMLAH<br>PEMERIKSAAN</td>
			<td>ACTION</td>
		</tr>
	<?php
	$no=0;
	$sql="SELECT `instrument_name`,	date(`run_time`) as tanggal, `operator`, count(`sample_id`) as jml_sample
		FROM `cobas6000`
		WHERE `confirm`='0' and `sample_type`='S' and (qualitative in ('-1','0','1'))
		GROUP BY `instrument_name`, date(`run_time`),`operator`";	
	$qraw=mysql_query($sql,$con_lis);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td><?=$tmp['instrument_name']?></td>
			<td><?=$tmp['tanggal']?></td>
			<td><?=$tmp['operator']?></td>
			<td align="right"><?=$tmp['jml_sample']?></td>
			<td>
				<a href="pmiimltd.php?module=rochekonfirmasi&ins=<?=$tmp['instrument_name']?>&tgl=<?=$tmp['tanggal']?>&usr=<?=$tmp['operator']?>" class="swn_kiri">Konfirmasi</a> |
				<a href="pmiimltd.php?module=rocheprocess&op=del&ins=<?=$tmp['instrument_name']?>&tgl=<?=$tmp['tanggal']?>&usr=<?=$tmp['operator']?>" onclick="return confirm('PERHATIAN \n \nYakin akan menghapus data transfer alat \n<?=$tmp['instrument_name']?>, \nTanggal: <?=$tmp['tanggal']?>, \nOperator: <?=$tmp['operator']?>, \nJumlah tes: <?=$tmp['jml_sample']?> ?');" class="swn_kanan">Hapus</a>
				
		</tr>
	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=8>Yess.....MANTAP !!!..Semua data sudah dikonfirmasi.......</td>
	<?}?>
	</table><br>
	<a href="pmiimltd.php?module=import_roche"class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

