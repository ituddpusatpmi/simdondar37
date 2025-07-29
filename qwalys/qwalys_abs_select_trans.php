<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d");
$hariini = date("Y-m-d");
$notransaksi="";
?>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>

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
    <?php
    if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
    if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
    ?>
	<table border=0><tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Data Pemeriksaan Antibody screening - Qwalys<sup>&reg</sup> 3</td></tr>
	</table>
    <form name="cari" method="POST" action="<?echo $PHPSELF?>">
        <table class="list" cellpadding=1 cellspacing="0" border="0" width="700px">
            <tr class="field">
                <td align="left" nowrap>Dari tanggal :</td>
                <td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size=10></td>
                <td align="right" nowrap>sampai tanggal :</td>
                <td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
                <td><input type=submit name=submit class="swn_button_blue" value="Ok"></td>
            </tr>
        </table>
    </form>

	<table class="list" border=1 cellpadding=5 cellspacing=10 style="border-collapse:collapse" width="700px">
		<tr class="field">
			<td>NO.</td>
            <td>No Transaksi</td>
			<td>Tanggal</td>
			<td>Operator Qwalys</td>
            <td>Petugas Konfirmasi</td>
            <td>Jumlah Sample</td>
            <td>Aksi</td>
		</tr>
	<?php
	$no=0;
	$jml=0;
	$sql="select `abs_notrans`, date(`abs_tgl`) as tgl_konfirmasi, `abs_user`, `abs_checker`, count(`abs_id`) as jml
          from `abs`
          WHERE  DATE(`abs_tgl`)>='$tglawal' and DATE(`abs_tgl`)<='$hariini'
          group by `abs_notrans`, date(`abs_tgl`), `abs_user`, `abs_checker`";
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
		$jml=$jml+$tmp['jml'];
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td><?=$tmp['abs_notrans']?></td>
			<td><?=$tmp['tgl_konfirmasi']?></td>
			<td><?=$tmp['abs_user']?></td>
            <td><?=$tmp['abs_checker']?></td>
            <td align="right"><?=number_format($tmp['jml'],0,',','.')?></td>
            <td>
                <a href="pmikonfirmasi.php?module=abs_data&notrs=<?=$tmp['abs_notrans']?> ">Detail</a>
		</tr>
	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=7>Tidak ada data</td></tr>
	<?} else {
		?><tr class="field">
			<td colspan=5>Total Sample</td>
			<td align="right"><?=number_format($jml,0,',','.')?></td>
			<td></td>
		</tr><?
	}?>
	</table><br>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a>
	<?
?>
</body>
</html>

