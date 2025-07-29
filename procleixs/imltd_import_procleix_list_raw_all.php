<?php
//=====================================================================
//0		Sample ID
//1		Overall Interpretation
//2		Name of the Protocol								header
//3		Run number											header
//4		Run Date and Time									header
//5		Status Flags (if any)
//6		Internal Control RLU
//7		Internal Control Result
//8		Analyte RLU
//9		Analyte S/CO
//10	Kinetic Index										header
//11	Operator’s Name										header
//12	Internal Control Cutoff								header
//13	Analyte Cutoff										header
//14	Negative Calibrator Analyte Average					header
//15	Negative Calibrator IC Average						header
//16	HIV-1 or WNV Positive Calibrator Analyte Average	header
//17	HIV-1 or WNV Positive Calibrator IC Average			header
//18	HCV Positive Calibrator Analyte Average				header
//19	HCV Positive Calibrator IC Average					header
//20	Master Lot Number									header
//21	Master Lot Date										header
//22	PROCLEIX® HC+ S/N									header
//23	PROCLEIX® HC+ Firmware Revision						header
//24	Run Number Prefix									header
//25	Type of tube
//26	HBV Positive Calibrator Analyte Average				header
//27	HBV Positive Calibrator IC Average					header
//===============================================================

require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d",$tglsebelum);
$hariini = date("Y-m-d");
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMUDDA - Import LIS Procleix(R) System Software</title>
</head>
<body>
	
<font size="5" color=red>DATA PEMERIKSAAN NAT Panther <b>Procleix<sup>&reg</sup> Ultrio Elite</b></font><br><br>
<?
if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
?>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table class="list" cellpadding=1 cellspacing=1>
	<tr class="field">
		<td align="left">Dari tanggal :</td>
		<td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size=10></td>
		<td align="left">sampai :</td>
		<td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
		<td><input type=submit name=submit class="swn_button_blue" value="Tampilkan"></td>
	</tr>
	</table>	
</form>
	
	
	<table class="list" border=1 cellpadding=2 cellspacing=2	 style="border-collapse:collapse">
		<tr class="field">
			<td>No.</td>
			<td>Tanggal</td>
			<td>Run Number</td>
			<td>Jumlah<br>Test</td>
			<td>Operator</td>
			<td>User transfer</td>
			<td>Tgl Konfirmasi</td>
			<td>Konfirmasi</td>
		</tr>
		
	<?php
	$no  = 0;
	$sql = "SELECT  *,DATE(`tgl_periksa` ) AS tgl, count(sample_id) as jml
		FROM  `imltd_nat_panther_raw`  
		WHERE DATE(`tgl_periksa`)>='$tglawal' and DATE(`tgl_periksa`)<='$hariini'
		group by 
		`run_number`";

	$qraw = mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;?>
		<tr class="record">
			<td><?=$no?></td>
			<td><?=$tmp['tgl']?></td>
			<td><?=$tmp['run_number']?></td>
			<td><?=$tmp['jml']-8?></td>
			<td align="left"><?=$tmp['username']?></td>
			<td align="left"><?=$tmp['username']?></td>
			<td align="left"><?=$tmp['tgl_konfirm']?></td>
			<? if ($tmp['konfirm']==0){
				$konf="Belum";?>
				<td><a href="pmiimltd.php?module=import_nat_procleix_konfirm&no=<?=$tmp['run_number']?> "class="swn_button_green">Konfirm</a>
			        <a href="pmiimltd.php?module=import_nat_procleix_rawdel&no=<?=$tmp['run_number']?> "class="swn_button_red">Hapus</a>
					<a href="pmiimltd.php?module=import_nat_procleix_raw_result&no=<?=$tmp['run_number']?> "class="swn_button_blue">Lihat</a></td>
				<?}else{
					$konf="Sudah di konfirmasi!";?>
					<td align="left"><?=$konf?>
					<a href="pmiimltd.php?module=import_nat_panther_raw_result&no=<?=$tmp['run_number']?> "class="swn_button_blue">Lihat</a></td><?
				}?>
			
		</tr>
	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=10>Tidak ada data transfer pemeriksaan NAT Panther<sup>&reg</sup> Ultrio Elite <br>dari tanggal <?=$tglawal?> sampai dengan tanggal <?=$hariini?></td>
	<?}?>
	</table><br>
	<a href="pmiimltd.php?module=import_nat_panther"class="swn_button_blue">Kembali</a>
	<?
?>
</body>
</html>

