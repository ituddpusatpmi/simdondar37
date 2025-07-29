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
<style>
    td {font-family: "Arial", Verdana, serif;}
    tr {font-family: "Arial", Verdana, serif;}
    th {font-family: "Arial", Verdana, serif;}
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
	<font size="4" color=00008B>DATA PENGGUNAAN REAGEN Cobas 6000</b></font><br><br>
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
	<table class="list" border=1 cellpadding=5 cellspacing=3 style="border-collapse:collapse">
		<tr class="field">
			<td rowspan="2">NO.</td>
			<td rowspan="2">Tanggal</td>
			<td colspan="3">HBsAg</td>
            <td colspan="3">HCV</td>
            <td colspan="3">HIV</td>
            <td colspan="3">SYPHILIS</td>
		</tr>
		<tr class="field">
            <td>Kontrol</td>
            <td>Sample</td>
            <td>Jumlah</td>
            <td>Kontrol</td>
            <td>Sample</td>
            <td>Jumlah</td>
            <td>Kontrol</td>
            <td>Sample</td>
            <td>Jumlah</td>
            <td>Kontrol</td>
            <td>Sample</td>
            <td>Jumlah</td>
		</tr>
	<?php
	$no=0;
    $ttl_sb="0";
    $ttl_sc="0";
    $ttl_si="0";
    $ttl_ss="0";
    $ttl_cb="0";
    $ttl_cc="0";
    $ttl_ci="0";
    $ttl_cs="0";
    $ttl_b="0";
    $ttl_c="0";
    $ttl_i="0";
    $ttl_s="0";
    $jml_b="0";
    $jml_c="0";
    $jml_i="0";
    $jml_s="0";
    $sqlsmp="SELECT date(`run_time`) as tgl,
            sum(case when `sample_type`='S' and `parameter_no`='1' then 1 else 0 END) as s_b,
            sum(case when `sample_type`='S' and `parameter_no`='2' then 1 else 0 END) as s_c,
            sum(case when `sample_type`='S' and `parameter_no`='3' then 1 else 0 END) as s_i,
            sum(case when `sample_type`='S' and `parameter_no`='4' then 1 else 0 END) as s_s,
            sum(case when `sample_type`='C' and `parameter_no`='1' then 1 else 0 END) as c_b,
            sum(case when `sample_type`='C' and `parameter_no`='2' then 1 else 0 END) as c_c,
            sum(case when `sample_type`='C' and `parameter_no`='3' then 1 else 0 END) as c_i,
            sum(case when `sample_type`='C' and `parameter_no`='4' then 1 else 0 END) as c_s
            from lis_pmi.cobas6000 WHERE date(`run_time`)>='$tglawal' AND date(`run_time`)<='$hariini'
            group by date(`run_time`)";
	$sample=mysql_query($sqlsmp);
	while($tmp=mysql_fetch_assoc($sample)){
		$no++;
        $ttl_sb=$ttl_sb+$tmp['s_b'];
        $ttl_sc=$ttl_sc+$tmp['s_c'];
        $ttl_si=$ttl_si+$tmp['s_i'];
        $ttl_ss=$ttl_ss+$tmp['s_s'];
        $ttl_cb=$ttl_cb+$tmp['c_b'];
        $ttl_cc=$ttl_cc+$tmp['c_c'];
        $ttl_ci=$ttl_ci+$tmp['c_i'];
        $ttl_cs=$ttl_cs+$tmp['c_s'];
        $ttl_b=$ttl_sb+$ttl_cb;
        $ttl_c=$ttl_sc+$ttl_cc;
        $ttl_i=$ttl_si+$ttl_ci;
        $ttl_s=$ttl_ss+$ttl_cb;
        $jml_b=$tmp['s_b'] + $tmp['c_b'];
        $jml_c=$tmp['s_c'] + $tmp['c_c'];
        $jml_i=$tmp['s_i'] + $tmp['c_i'];
        $jml_s=$tmp['s_s'] + $tmp['c_s'];
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td align="left"><?=$tmp['tgl']?></td>
            <td align="right"><?=number_format($tmp['c_b'],0,'','.')?></td>
			<td align="right"><?=number_format($tmp['s_b'],0,'','.')?></td>
            <td align="right"><?=number_format($jml_b,0,'','.')?></td>

            <td align="right"><?=number_format($tmp['c_c'],0,'','.')?></td>
            <td align="right"><?=number_format($tmp['s_c'],0,'','.')?></td>
            <td align="right"><?=number_format($jml_c,0,'','.')?></td>

            <td align="right"><?=number_format($tmp['c_i'],0,'','.')?></td>
            <td align="right"><?=number_format($tmp['s_i'],0,'','.')?></td>
            <td align="right"><?=number_format($jml_i,0,'','.')?></td>

            <td align="right"><?=number_format($tmp['c_s'],0,'','.')?></td>
            <td align="right"><?=number_format($tmp['s_s'],0,'','.')?></td>
            <td align="right"><?=number_format($jml_s,0,'','.')?></td>

		</tr>
	<?}?>
        <tr class="field">
            <td colspan="2" align="left">TOTAL PER PARAMETER</td>
            <td align="right"><?=number_format($ttl_cb,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_sb,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_b,0,'','.')?></td>

            <td align="right"><?=number_format($ttl_cc,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_sc,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_c,0,'','.')?></td>

            <td align="right"><?=number_format($ttl_ci,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_si,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_i,0,'','.')?></td>

            <td align="right"><?=number_format($ttl_cs,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_ss,0,'','.')?></td>
            <td align="right"><?=number_format($ttl_s,0,'','.')?></td>

        </tr>
    <?
	if ($no==0){?>
        <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td colspan=14 align="center">Tidak ada data Reagen  Arcitect <i>i2000SR</i></td>
	<?}?>
	</table><br>
    <!-- <a href="roche/imltd_import_cobas_reagen_cetak.php?tgl1=<?=$tglawal?>&tgl2=<?=$hariini?>"class="swn_button_blue" target="_blank">Cetak</a> -->
	<a href="pmiimltd.php?module=import_roche"class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

