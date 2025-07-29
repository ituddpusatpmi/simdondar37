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
<style type="text/css">
    @import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
    .normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>


<?
include('config/db_connect.php');

$lot_no = $_GET['nolot'];
$sq0="SELECT `run_time`, `id_tes`, `instr`, `arc_serial`, `parameter`, `lot_reag`, `abs`, `hasil`, `trans_time` FROM `imltd_arc_raw`
      WHERE `lot_reag`='$lot_no'";
$sql1=mysql_query($sq0);
?>

<a name="atas" id="atas"></a>
<color="blue" class="awesomeText"><b>Detail sample diperiksa dengan REAGEN ARCHITECT I2000SR<br>Nomor LOT.: <?=$lot_no?><br>
<a href="#bawah" class="swn_button_blue">Ke bawah</a>

<table  class="list" border=1 cellpadding="5" cellspacing="5"  style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<th rowspan="2">NO.</th>
	    <th rowspan="2">SAMPLE ID</th>
        <th rowspan="2">INSTRUMENT</th>
		<th rowspan="2">WAKTU PERIKSA</th>
        <th colspan="2">HASIL</th>
        <th rowspan="2">STATUS</th>

	</tr>
	<tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<th>ABS</th>
    	<th>KET</th>
	</tr>
<?

$no=1;
while ($sqllot_s=mysql_fetch_assoc($sql1)) {
	$sql_kt1=mysql_query("select Status, sah, StatTempat, stat2 from stokkantong where noKantong='$sqllot_s[id_tes]'");
    $sql_kt2=mysql_fetch_assoc($sql_kt1);
    $status_ktg=$sql_kt2['Status']; $kantong_sah=$sql_kt2['sah'];
    switch ($status_ktg){
        case '0' : $statuskantong='Kosong('.$status_ktg.')';
            if ($c_ktg[StatTempat]==NULL) $statuskantong='Kosong-Logistik('.$status_ktg.')';
            if ($c_ktg[StatTempat]=='0')  $statuskantong='Kosong-Logistik ('.$status_ktg.')';
            if ($c_ktg[StatTempat]=='1')  $statuskantong='Kosong-Aftap('.$status_ktg.')';
            break;
        case '1' : if ($c_ktg['sah']=="1"){
            $statuskantong='Karantina('.$status_ktg.')';
        } else{
            $statuskantong='Belum disahkan('.$status_ktg.')';
        }
            break;
        case '2' : $statuskantong='Sehat('.$status_ktg.')';
            if (substr($c_ktg[stat2],0,1)=='b') $tempat=" (BDRS)";
            break;
        case '3' : $statuskantong='Keluar('.$status_ktg.')';break;
        case '4' : $statuskantong='Rusak('.$status_ktg.')';break;
        case '5' : $statuskantong='Rusak-Gagal('.$status_ktg.')';break;
        case '6' : $statuskantong='Dimusnahkan('.$status_ktg.')';break;
        default  : $statuskantong='-';
    }
    ?>
    <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
	    <td class=input align="right"><?=$no++.'. '?></td>
        <td class=input><?=$sqllot_s[id_tes]?></td>
        <td class=input><?=$sqllot_s[instr].' - '.$sqllot_s[arc_serial]?></td>
        <td class=input><?=$sqllot_s[run_time]?></td>
        <td class=input align="right"><?=$sqllot_s[abs]?></td>
        <td class=input><?=$sqllot_s[hasil]?></td>
        <td class=input><?=$statuskantong?></td>
     </tr>
    <?
}
$q_reag0=" SELECT `Nama`, `noLot`, `jumTest`, `tglKad`, `kodeSup`, `status`, `keterangan`, `aktif`, `kode`, `metode`, `kodestok` FROM `reagen` WHERE `noLot`='$lot_no'";
$q_reag1=mysql_query($q_reag0);
$q_reag2=mysql_fetch_assoc($q_reag1);
?>
<tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
       <th colspan="7">RINGKASAN</th>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
	<td colspan="3">Nama Raegan</td>
    <td class=input align="left" colspan="4"><?=$q_reag2[Nama]?></td>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
    <td colspan="3">Nomor Lot</td>
    <td class=input align="left" colspan="4"><?=$q_reag2[noLot]?></td>
    </tr>
<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
    <td colspan="3">Tanggal Kadaluarsa</td>
    <td class=input align="left" colspan="4"><?=$q_reag2[tglKad]?></td>
    </tr>
</table>
<br>
<a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah">
<a href="pmiimltd.php?module=import_arc2000"class="swn_button_blue">Kembali ke Awal</a>
<a href="architec/imltd_arc2000_trace_detail_rpt.php?lot=<?=$lot_no?>"class="swn_button_blue" target="_blank">Cetak</a>
<a href="pmiimltd.php?module=trace_arc"class="swn_button_blue">Kembali</a>

