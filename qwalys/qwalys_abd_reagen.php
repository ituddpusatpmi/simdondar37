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
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Data Reagen/BHP ABD Grouping - Qwalys<sup>&reg</sup> 3</td></tr>
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
                	<option value="2">BromeLine</option>
                	<option value="3">MagneLys</option>
                	<option value="4">HemaLys A1 S1</option>
                	<option value="5">HemaLys B S1</option>                	
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
			<td>No. Batch</td>
            <td>Tanggal ED</td>
            <td>Jumlah Tes</td>
		</tr>
	<?php
	$no=0;
	$jml=0;

	switch ($jenis_reagen){
		case "1" : $sql="SELECT date(`runtime`) as tgl,  `microplate` as reagen, count(`sample_id`) as jml
					     FROM `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
					 	 group by date(`runtime`), `microplate`";$namareagen="Mircoplate";break;
		case "2" : $sql="SELECT date(`runtime`) as tgl,
                         `AntiA_Reag1Barcode` AS barcode, `AntiA_Reag1Batch` AS lot, `AntiA_Reag1ED` as ed
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
                         union
                         SELECT  date(`runtime`) , `AntiB_Reag1Barcode`,`AntiB_Reag1Batch`,`AntiB_Reag1ED`
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
                         UNION
                         SELECT  date(`runtime`), `Antid_Reag1Barcode`, `AntiD_Reag1Batch`, `AntiD_Reag1ED`
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
                         UNION
                         SELECT date(`runtime`)l,  `AntiRHC_Reag1Barcode`,`AntiRHC_Reag1Batch`,`AntiRHC_Reag1ED`
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'";
					 	 $namareagen="BromeLine";break;
		case "3" : $sql="SELECT date(`runtime`) as tgl,
                         `AntiA_Reag2Barcode` AS barcode, `AntiA_Reag2Batch` AS lot, `AntiA_Reag2ED` as ed
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
                         union
                         SELECT  date(`runtime`) , `AntiB_Reag2Barcode`,`AntiB_Reag2Batch`,`AntiB_Reag2ED`
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
                         UNION
                         SELECT  date(`runtime`), `AntiD_Reag2Barcode`, `AntiD_Reag2Batch`, `AntiD_Reag2ED`
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
                         UNION
                         SELECT date(`runtime`)l,  `AntiRHC_Reag2Barcode`,`AntiRHC_Reag2Batch`,`AntiRHC_Reag2ED`
                         FROM qwalys_abd_raw where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'";$namareagen="MagneLys";break;
		case "4" : $sql="SELECT date(`runtime`) as tgl,  `CellA1_Reag1Barcode` as reagen, `CellA1_Reag1Batch` as lot, `CellA1_Reag1ED` as ed,
						 count(`sample_id`) as jml
					     FROM `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
					 	 group by date(`runtime`), `CellA1_Reag1Barcode`, `CellA1_Reag1Batch`, `CellA1_Reag1ED`";$namareagen="HemaLys A1 S1";break;
		case "5" : $sql="SELECT date(`runtime`) as tgl,  `CellB_Reag1Barcode` as reagen, `CellB_Reag1Batch` as lot, `CellB_Reag1ED` as ed,
						 count(`sample_id`) as jml
					     FROM `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini'
					 	 group by date(`runtime`), `CellB_Reag1Barcode`, `CellB_Reag1Batch`, `CellB_Reag1ED`";$namareagen="HemaLys B S1";break;
	}
	//echo "$sql";
	?>
	<tr>
		<td colspan="6">Reagen/BHP : <b><?=$namareagen?></b></td>
	</tr>
	<?
	//using condition to show record different betwen [2,3] and [1,4,5]
    if (($jenis_reagen=="1") or ($jenis_reagen=="4") or ($jenis_reagen=="5")) {
        $jml=0;
	    $qraw=mysql_query($sql);
	    while($tmp=mysql_fetch_assoc($qraw)){
    		$no++;
	    	if ($jenis_reagen=="1"){
		    	$tgl	  =$tmp['tgl'];
    			$barcode  =$tmp['reagen'];
    			$pplate   =$tmp['reagen'];
    			$jml_test =$tmp['jml'];
            	$lot	  =substr($pplate,8,3);
            	$ed_plate =substr($pplate,4,2).'/20'.substr($pplate,6,2);
            	$a_date   = "20".substr($pplate,6,2).'-'.substr($pplate,4,2).'-01';
            	$ed		  = date("Y-m-t", strtotime($a_date));
	    	} else {
		    	$tgl	  =$tmp['tgl'];
    			$barcode  =$tmp['reagen'];
    			$lot	  =$tmp['lot'];
    			$ed	 	  =$tmp['ed'];
    			$jml_test =$tmp['jml'];
    		}
            $jml=$jml+$tmp['jml'];
	    	?>
		    <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			    <td align="right"><?=$no.'.'?></td>
			    <td><?=$tgl?></td>
    			<td><?=$barcode?></td>
    			<td><?=$lot?></td>
                <td><?=$ed?></td>
                <td align="right"><?=number_format($jml_test,0,',','.')?></td>
    		</tr>
	    <?}
    } else {
		if ($jenis_reagen=="2"){
            $jml=0;
            $qraw=mysql_query($sql);
            while($tmp=mysql_fetch_assoc($qraw)){
                $no++;
                    $tgl	  =$tmp['tgl'];
                    $barcode  =$tmp['barcode'];
                    $lot	  =$tmp['lot'];
                    $ed	 	  =$tmp['ed'];
                    //$jml_test =$tmp['jml']; need sql to get count per barcodes from reag1
                    $sq_1=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiA_Reag1Barcode`='$barcode'"));
                    $sq_2=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiB_Reag1Barcode`='$barcode'"));
                    $sq_3=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiD_Reag1Barcode`='$barcode'"));
                    $sq_4=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiRHC_Reag1Barcode`='$barcode'"));
                    $jml_1=$sq_1['jml'];
                    $jml_2=$sq_2['jml'];
                    $jml_3=$sq_3['jml'];
                    $jml_4=$sq_4['jml'];
                    $jml_test=$jml_1+$jml_2+$jml_3+$jml_4;
                    $jml=$jml+$jml_1+$jml_2+$jml_3+$jml_4;
                ?>
                <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?=$no.'.'?></td>
                    <td><?=$tgl?></td>
                    <td><?=$barcode?></td>
                    <td><?=$lot?></td>
                    <td><?=$ed?></td>
                    <td align="right"><?=number_format($jml_test,0,',','.')?></td>
                </tr>
            <?}
		} else {
            $jml=0;
            $qraw=mysql_query($sql);
            while($tmp=mysql_fetch_assoc($qraw)){
                $no++;
                $tgl	  =$tmp['tgl'];
                $barcode  =$tmp['barcode'];
                $lot	  =$tmp['lot'];
                $ed	 	  =$tmp['ed'];
                $jml_test =$tmp['jml'];
                //$jml=$jml+$tmp['jml'];
                //$jml_test =$tmp['jml']; need sql to get count per barcodes from reag1
                $sq_1=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiA_Reag2Barcode`='$barcode'"));
                $sq_2=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiB_Reag2Barcode`='$barcode'"));
                $sq_3=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiD_Reag2Barcode`='$barcode'"));
                $sq_4=mysql_fetch_assoc(mysql_query("SELECT count(`id`) as jml from `qwalys_abd_raw` where date(`runtime`)>='$tglawal' and date(`runtime`)<='$hariini' and `AntiRHC_Reag2Barcode`='$barcode'"));
                $jml_1=$sq_1['jml'];
                $jml_2=$sq_2['jml'];
                $jml_3=$sq_3['jml'];
                $jml_4=$sq_4['jml'];
                $jml_test=$jml_1+$jml_2+$jml_3+$jml_4;
                $jml=$jml+$jml_1+$jml_2+$jml_3+$jml_4;
                ?>
                <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?=$no.'.'?></td>
                    <td><?=$tgl?></td>
                    <td><?=$barcode?></td>
                    <td><?=$lot?></td>
                    <td><?=$ed?></td>
                    <td align="right"><?=number_format($jml_test,0,',','.')?></td>
                </tr>
            <?}

		}
    }
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

