<?php
require_once('clogin.php');
require_once('config/db_connect.php');
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
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMDONDAR</title>
</head>

<body>
	<font size="4" color=00008B>DATA PEMERIKSAAN ABD Groupping - Qwalys 3</b></font><br><br>
	<table class="list" border=1 cellpadding=5 cellspacing=10 style="border-collapse:collapse">
		<tr class="field">
			<td>NO.</td>
			<td>QWALYS 3 S/N</td>
			<td>TANGGAL</td>
			<td>OPERATOR</td>
            <td>MICROPLATE</td>
            <td>PARAMETER</td>
			<td>JUMLAH<br>SAMPLE</td>
			<td>ACTION</td>
		</tr>
	<?php
	$no=0;
	$sql="select q.sn, q.microplate, q.operator,date(q.runtime) as runtime,q.parameter1, count(sample_id) as jml
		  from qwalys_abd_raw q where q.confirm is null
		  group by q.sn, q.microplate, q.operator, q.parameter1, date(q.runtime)";
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td><?=$tmp['sn']?></td>
			<td><?=$tmp['runtime']?></td>
			<td><?=$tmp['operator']?></td>
            <td><?=$tmp['microplate']?></td>
            <td><?=$tmp['parameter1']?></td>
			<td align="right"><?=$tmp['jml']?></td>
			<td>
				<a href="pmikonfirmasi.php?module=import_arc2000_konfirm&ins=<?=$tmp['instr']?>&sn=<?=$tmp['arc_serial']?>&dt=<?=$tmp['run_time']?>&usr=<?=$tmp['user']?>" class="swn_kiri">Konfirmasi</a> |
				<a href="pmikonfirmasi.php?module=qwalys_proses&op=del&ins=<?=$tmp['instr']?>&sn=<?=$tmp['arc_serial']?>&dt=<?=$tmp['run_time']?>&usr=<?=$tmp['user']?>" onclick="return confirm('PERHATIAN \n \nYakin akan menghapus data transfer alat \n<?=$tmp['instr']?> <?=$tmp['arc_serial']?>, \ntanggal: <?=$tmp['run_time']?>, \noperator: <?=$tmp['user']?>, \njumlah tes: <?=$tmp['jumlah']?> ?');" class="swn_kanan">Hapus</a>
				
		</tr>
	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=8>Yess.....MANTAP !!!..Semua data sudah dikonfirmasi.......</td>
	<?}?>
	</table><br>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

