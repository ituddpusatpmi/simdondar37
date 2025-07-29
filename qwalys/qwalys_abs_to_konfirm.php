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
	<table border=0><tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Data Pemeriksaan Antibody screening - Qwalys<sup>&reg</sup> 3</td></tr>
        <td align="left" style="background-color: #ffffff;font-size:20px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Belum terkonfirmasi</td></tr>
	</table>
	<table class="list" border=1 cellpadding=5 cellspacing=10 style="border-collapse:collapse">
		<tr class="field">
			<td>NO.</td>
			<td>QWALYS 3<br> S/N</td>
			<td>TANGGAL<br>PERIKSA</td>
			<td>OPERATOR<br>Qwalys</td>
            <td>MICROPLATE</td>
            <td>PARAMETER</td>
			<td>JUMLAH<br>SAMPLE</td>
			<td>ACTION</td>
		</tr>
	<?php
	$no=0;
	$jml=0;
	$sql="select q.sn, q.microplate, q.operator,date(q.runtime) as runtime, q.parameter2, count(sample_id) as jml
		  from qwalys_abs_raw q where q.confirm is null
		  group by date(q.runtime), q.sn, q.microplate, q.operator, q.parameter2";
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
		$jml=$jml+$tmp['jml'];
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td><?=$tmp['sn']?></td>
			<td><?=$tmp['runtime']?></td>
			<td><?=$tmp['operator']?></td>
            <td><?=$tmp['microplate']?></td>
            <td><?=$tmp['parameter2']?></td>
			<td align="right"><?=number_format($tmp['jml'],0,',','.')?></td>
			<td>
				<a href="pmikonfirmasi.php?module=konfirm_abs1&sn=<?=$tmp['sn']?>&tgl=<?=$tmp['runtime']?>&user=<?=$tmp['operator']?>&plate=<?=$tmp['microplate']?>&param=<?=$tmp['parameter2']?>" class="swn_kiri">Konfirmasi</a> |
				<a href="pmikonfirmasi.php?module=qwalys_process&op=del&sn=<?=$tmp['sn']?>&tgl=<?=$tmp['runtime']?>&user=<?=$tmp['operator']?>&plate=<?=$tmp['microplate']?>&param=RAE" onclick="return confirm('PERHATIAN \n \nYakin akan menghapus data transfer alat \n<?=$tmp['sn']?>, \ntanggal: <?=$tmp['runtime']?>, \noperator: <?=$tmp['operator']?>, \njumlah tes: <?=$tmp['jml']?> ?');">Hapus</a>
		</tr>
	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=8>Tidak ada data</td></tr>
	<?} else {
		?><tr class="field">
			<td colspan=6>Jumlah Sample</td>
			<td><?=number_format($jml,0,',','.')?></td>
			<td colspan=2></td>
			</tr><?
	}?>
	</table><br>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

