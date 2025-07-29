<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d");
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
<style>
    td {font-family: "Arial", Verdana, serif;}
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
	<font size="4" color=00008B>DATA KONFIRMASI PEMERIKSAAN Cobas 6000</b></font><br><br>
	<form name="cari" method="POST" action="<?echo $PHPSELF?>">
		<table class="list" cellpadding=1 cellspacing="0" border="0" width="600px">
			<tr class="field">
				<td align="left" nowrap>Dari tanggal :</td>
				<td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size=10></td>
				<td align="right" nowrap>sampai dengan tanggal :</td>
				<td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
				<td><input type=submit name=submit class="swn_button_blue" value="Ok"></td>
			</tr>
		</table>	
	</form>
	<table class="list" border=1 cellpadding=3 cellspacing=3 style="border-collapse:collapse" width="600px">
	    <tr class="field">
			<td>NO.</td>
			<td>NO. TRANS</td>
			<td>INSTRUMENT</td>
			<td>TANGGAL</td>
			<td>PETUGAS</td>
			<td>JML<br>SAMPLE</td>
			<td>AKSI</td>
		</tr>
	<?php
	$no=0;
	$sql="SELECT `no_trans`, `instr`,  date(`koonfirm_time`) as tanggal, `konfirmer`, count(`id_tes`) as jumlah
          FROM `imltd_cobas_konfirm`
          WHERE DATE(`koonfirm_time`)>='$tglawal' and DATE(`koonfirm_time`)<='$hariini'
          GROUP BY `no_trans`";
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td align="right"><?=$tmp['no_trans']?></td>
			<td><?=$tmp['instr']?></td>
			<td><?=$tmp['tanggal']?></td>
			<td><?=$tmp['konfirmer']?></td>
			<td align="right"><?=$tmp['jumlah']?></td>
			<td>
				<a href="pmiimltd.php?module=rocheviewkonfirmasi&notrans=<?=$tmp['no_trans']?> ">Lihat</a>
		</tr>
	<?}
	if ($no==0){?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td colspan=8 align="center">Tidak ada data konfirmasi pemeriksaan IMLTD Cobas 6000</i></td>
	<?}?>
	</table><br>
	<a href="pmiimltd.php?module=import_roche"class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

