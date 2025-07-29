<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    if ($_POST[jenis]!=''){$jenis_reagen=$_POST[jenis];}else{$jenis_reagen='0';}

    ?>
	<table border=0><tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Data Reagen/BHP Antibody screening - Qwalys<sup>&reg</sup> 3</td></tr>
	</table>
    <form name="cari" method="POST" action="<?echo $PHPSELF?>">
        <table class="list" cellpadding=1 cellspacing="0" border="0"  width="80%">
            <tr class="field">
                <td align="left" nowrap>Dari tanggal :</td>
                <td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text ></td>
                <td align="right" nowrap>sampai tanggal :</td>
                <td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text></td>
                <td><select name="jenis" id="jenis">
                	<option value="1">Microplate</option>
                	<option value="2">NanoLys</option>
                	<option value="3">ScreenDiluent</option>
                	<option value="4">HemaScreen Pool</option>
                	</select>
                </td>
                <td><input type=submit name=submit class="swn_button_blue" value="Ok"></td>
            </tr>
        </table>
    </form>

	<table class="list" border=1 cellpadding=5 cellspacing=10 style="border-collapse:collapse" width="80%">
		<tr class="field">
			<td>NO.</td>
            <td>Tanggal</td>
			<td>Barcode</td>
			<td>Batch</td>
            <td>Tangal ED</td>
            <td>Jumlah Sample</td>
		</tr>
	<?php
	$no=0;
	$jml=0;

	switch ($jenis_reagen){
		case "1" : $sql="SELECT date(`runtime`) as tgl,  `microplate` as reagen, count(`sample_id`) as jml
					     FROM `qwalys_abs_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
					 	 group by date(`runtime`), `microplate`";$namareagen="Mircoplate";break;
		case "2" : $sql="SELECT date(`runtime`) as tgl,  `nl_barcode` as reagen, `nl_batch` as lot, `nl_ed` as ed,
						 count(`sample_id`) as jml
					     FROM `qwalys_abs_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
					 	 group by date(`runtime`), `nl_barcode`, `nl_batch`, `nl_ed`";$namareagen="NanoLys";break;
		case "3" : $sql="SELECT date(`runtime`) as tgl,  `sd_barcode` as reagen, `sd_batch` as lot, `sd_ed` as ed,
						 count(`sample_id`) as jml
					     FROM `qwalys_abs_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
					 	 group by date(`runtime`), `sd_barcode`, `sd_batch`, `sd_ed`";$namareagen="ScreenDiluent";break;
		case "4" : $sql="SELECT date(`runtime`) as tgl,  `hsp_barcode` as reagen, `hsp_batch` as lot, `hsp_ed` as ed,
						 count(`sample_id`) as jml
					     FROM `qwalys_abs_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
					 	 group by date(`runtime`), `hsp_barcode`, `hsp_batch`, `hsp_ed`";$namareagen="HemaScreen Pool";break;
	
	}

	?>
	<tr>
		<td colspan="6">Reagen/BHP : <?=$namareagen?></td>
	</tr>
	<?
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
		if ($jenis_reagen=="1"){
			$pplate   =$tmp['reagen'];
        	$lot	  =substr($pplate,8,3);
        	$ed_plate =substr($pplate,4,2).'/20'.substr($pplate,6,2);
        	$a_date   = "20".substr($pplate,6,2).'-'.substr($pplate,4,2).'-01';
        	$ed		  = date("Y-m-t", strtotime($a_date));
		} else {
			$lot=$tmp['lot'];
			$ed=$tmp['ed'];
		}
		$jml=$jml+$tmp['jml'];
		?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no.'.'?></td>
			<td><?=$tmp['tgl']?></td>
			<td><?=$tmp['reagen']?></td>
			<td><?=$lot?></td>
            <td><?=$ed?></td>
            <td align="right"><?=number_format($tmp['jml'],0,',','.')?></td>
		</tr>
	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=6>Tidak ada data</td></tr>
	<?} else {
		?><tr class="field">
			<td colspan=5>Total Sample</td>
			<td align="right"><?=number_format($jml,0,',','.')?></td>
		</tr><?
	}?>
	</table><br>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a>
	<?
?>
</body>
</html>

