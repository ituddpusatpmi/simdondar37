<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d", $tglsebelum);
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
	<font size="4" color=00008B>DATA PENGGUNAAN REAGEN Architect i2000SR</b></font><br><br>
	<form name="cari" method="POST" action="<?echo $PHPSELF?>">
		<table class="list" cellpadding= cellspacing="0" border="0" width="600px">
			<tr class="field">
				<td align="left" nowrap>Dari tanggal :</td>
				<td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size=10></td>
				<td align="right" nowrap>sampai dengan tanggal :</td>
				<td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
				<td><input type=submit name=submit class="swn_button_blue" value="Ok"></td>
			</tr>
		</table>	
	</form>
	<table class="list" border=1 cellpadding=5 cellspacing=3 style="border-collapse:collapse" width="600px">
		<tr class="field">
			<td rowspan="2">NO.</td>
			<td rowspan="2">NAMA REAGEN ARCHITECT</td>
			<td rowspan="2">NOMOR LOT</td>
			<td colspan="3">JUMLAH</td>
		</tr>
		<tr class="field">
            <td>KONTROL</td>
            <td>SAMPEL</td>
            <td>TOTAL</td>
		</tr>
	<?php
	$no=0;
    $ttl_b="0";
    $ttl_c="0";
    $ttl_i="0";
    $ttl_s="0";
    $sqlsmp="SELECT `parameter` as Reagan, `lot_reag`, count(`id`) as jumlah FROM `imltd_arc_raw` where
		     date(`run_time`)>='$tglawal' AND
		     date(`run_time`)<='$hariini'
		     group by `parameter`, `lot_reag`";
	$sample=mysql_query($sqlsmp);
	while($tmp=mysql_fetch_assoc($sample)){
		$no++;
		$sqlqc ="SELECT count(`id`) as jumlah
                FROM `imltd_arc_qc` where
		        date(`run_time`)>='$tglawal' AND
		        date(`run_time`)<='$hariini' and
		        `parameter`='$tmp[Reagan]' and
		        `lot_reag`='$tmp[lot_reag]'";
        $qc=mysql_fetch_assoc(mysql_query($sqlqc));
        $ttl=$qc['jumlah']+$tmp['jumlah'];
        switch ($tmp['Reagan']){
            case "HBsAgQ2"      : $ttl_b=$ttl_b+$ttl;break;
            case "Syphilis"     : $ttl_s=$ttl_s+$ttl;break;
            case "_HIV Ag/Ab"   : $ttl_i=$ttl_i+$ttl;break;
            case "Anti-HCV"     : $ttl_c=$ttl_c+$ttl;break;
            default:break;
        }
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td align="left"><?=$tmp['Reagan']?></td>
			<td align="center"><?=$tmp['lot_reag']?></td>
            <td align="right"><?=number_format($qc['jumlah'],0,'','.')?></td>
			<td align="right"><?=number_format($tmp['jumlah'],0,'','.')?></td>
            <td align="right"><?=number_format($ttl,0,'','.')?></td>
		</tr>
	<?}?>
        <tr class="field">
            <td colspan="5" align="left">TOTAL PER PARAMETER</td><td></td>
        </tr>

        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan="5" align="left">Reagen HBsAg</td><td align="right"><?=number_format($ttl_b,0,'','.')?></td>
        </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan="5" align="left">Reagen Anti HCV</td><td align="right"><?=number_format($ttl_c,0,'','.')?></td>
        </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan="5" align="left">Reagen Anti HIV</td><td align="right"><?=number_format($ttl_i,0,'','.')?></td>
        </tr>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan="5" align="left">Reagen Syphilis</td><td align="right"><?=number_format($ttl_s,0,'','.')?></td>
        </tr>
    <?
	if ($no==0){?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td colspan=8 align="center">Tidak ada data Reagen  Arcitect <i>i2000SR</i></td>
	<?}?>
	</table><br>
    <a href="architec/imltd_arc_cetakreagen.php?tgl1=<?=$tglawal?>&tgl2=<?=$hariini?>"class="swn_button_blue" target="_blank">Cetak</a>
	<a href="pmiimltd.php?module=import_arc2000"class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

