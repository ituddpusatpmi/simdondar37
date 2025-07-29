<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style>
    .awesomeText {
        color: #000;
        font-size: 150%;
    }
</style>
<style>
#wgtmsr{
 width:190px;   
}

#wgtmsr option{
 width:180px;   
}
</style>
<style type="text/css">
    @import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
    .normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>

<body OnLoad="document.formlot.inputlot.focus();">
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
if (!empty($_POST[submit])) {
    $lot=$_POST[inputlot];
    if ($lot!==""){
    	$sq="SELECT `instr`, `arc_serial`,date(`run_time`) as tanggal, count(`id_tes`) as jumlah, `parameter`
			FROM `imltd_arc_raw` WHERE  `lot_reag`='$lot' group by `instr`, `arc_serial`,date(`run_time`), `parameter`";
    	$sqllot=mysql_query($sq);
    }
}
if (!empty($_POST[submit2])) {
	$lot=$_POST[wgtmsr];
	if (($lot!=="") or ($lot!=="-") ){
    	$sq="SELECT `instr`, `arc_serial`,date(`run_time`) as tanggal, count(`id_tes`) as jumlah, `parameter`
			FROM `imltd_arc_raw` WHERE  `lot_reag`='$lot' group by `instr`, `arc_serial`,date(`run_time`), `parameter`";
    	$sqllot=mysql_query($sq);
    }
}

?>

<color="blue" class="awesomeText"><b>TRACE (JEJAK) REAGEN ARCHITECT I2000SR</b><br><BR>

<form name=formlot method=post>
	<table border="0" width="600px">
	<tr style="background-color: #ffffff;">
		<td>Masukkan/scan LOT Reagen </td>
		<td><INPUT type="text" size="15" name="inputlot" value="<?=$lot?>"></td>
    	<td><input type=submit name=submit value=Submit class="swn_button_blue"></td>
    </tr>
    <tr style="background-color: #ffffff;">
    	<td>Atau Pilih LOT yang pernah dipakai</td>
    	<td><select name="wgtmsr" id="wgtmsr">
    			<option value="">-</option>
    			<? 	$sq_lot_inraw0="SELECT DISTINCT `lot_reag` FROM `imltd_arc_raw`";
    	   			$sq_lot_inraw1=mysql_query($sq_lot_inraw0);
					while($sq_lot_inraw2=mysql_fetch_assoc($sq_lot_inraw1)) {
						$select="";?>
						<option value="<?=$sq_lot_inraw2[lot_reag]?>"<?=$select?>><?=$sq_lot_inraw2[lot_reag]?></option>
				<?	}?>
    		</select></td>
    	<td><input type=submit name=submit2 value=Submit class="swn_button_blue"></td>
    </tr>
    </table>
</form>

<table  class="list" border=1 cellpadding="3" cellspacing="3" width="600px" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<th rowspan="2">NO</th>
	    <th rowspan="2">TANGGAL</th>
        <th rowspan="2">INSTRUMENT</th>
		<th colspan="3">JUMLAH TERPAKAI</th>
	</tr>
	<tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<th>KONTROL</th>
    	<th>SAMPLE</th>
		<th>JUMLAH</th>
	</tr>
<?

$no=1;
$total_sample   ="0";
$total_qc       ="0";
$total      ="0";
while ($sqllot_s=mysql_fetch_assoc($sqllot)) {
	$sql_qc0="SELECT `instr`, `arc_serial`,date(`run_time`) as tanggal, count(`id_tes`) as jumlah
		 	 FROM `imltd_arc_qc` WHERE  `lot_reag`='$lot'  and date(`run_time`)='$sqllot_s[tanggal]'  and `arc_serial`='$sqllot_s[arc_serial]'
		 	 group by `instr`, `arc_serial`,date(`run_time`)";
	$sql_qc1=mysql_query($sql_qc0);
	$sql_qc2=mysql_fetch_assoc($sql_qc1);
	$jml=$sql_qc2[jumlah]+$sqllot_s[jumlah];
    $total_sample =$total_sample+$sqllot_s[jumlah];
    $total_qc     =$total_qc+$sql_qc2[jumlah];
    $total        =$total_qc+$total_sample;
    ?>
    <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
	    <td class=input align="right"><?=$no++.'. '?></td>
        <td class=input><?=$sqllot_s[tanggal]?></td>
        <td class=input><?=$sqllot_s[instr].' - '.$sqllot_s[arc_serial]?></td>
        <td class=input align="right"><?=$sql_qc2[jumlah]?></td>
        <td class=input align="right"><?=$sqllot_s[jumlah]?></td>
        <td class=input align="right"><?=$jml?></td>
     </tr>
    <?
}
$q_reag0=" SELECT `Nama`, `noLot`, `jumTest`, `tglKad`, `kodeSup`, `status`, `keterangan`, `aktif`, `kode`, `metode`, `kodestok` FROM `reagen` WHERE `noLot`='$lot' and `nolot`<>''";
$q_reag1=mysql_query($q_reag0);
$q_reag2=mysql_fetch_assoc($q_reag1);
?>
<tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
       <th colspan="6">RINGKASAN</th>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
	<td colspan="3">Nama Raegan</td>
    <td class=input align="left" colspan="3"><?=$q_reag2[Nama]?></td>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
    <td colspan="3">Nomor Lot</td>
    <td class=input align="left" colspan="3"><?=$q_reag2[noLot]?></td>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
    <td colspan="3">Tanggal Kadaluarsa</td>
    <td class=input align="left" colspan="3"><?=$q_reag2[tglKad]?></td>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
        <td colspan="3">Total Kontrol</td>
        <td class=input align="left" colspan="3"><?=$total_qc?></td>
</tr>
    <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
        <td colspan="3">Total Sample</td>
        <td class=input align="left" colspan="3"><?=$total_sample?></td>
    </tr>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
        <td colspan="3">Total Digunakan</td>
        <td class=input align="left" colspan="3"><?=$total?></td>
    </tr>
</table>
<br>
<a href="pmiimltd.php?module=trace_arc_detail&nolot=<?=$lot?>"class="swn_button_blue">Detail Sample</a>
<a href="architec/imltd_arc2000_trace_rpt.php?lot=<?=$lot?>"class="swn_button_blue" target="_blank">Cetak</a>
<a href="pmiimltd.php?module=import_arc2000"class="swn_button_blue">Kembali</a>

