<!DOCTYPE html>
<html>
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script src="js1/jquery.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/btn_swn_slide_down.css" rel="stylesheet" />
<link href="css/blitzer/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="css/blitzer/js-image-slider.js" type="text/javascript"></script>
<style>body {background:#F6F6F6;font:normal 0.9em Arial; margin-top: 40px ;margin-left: 50px;padding:0; padding-bottom:50px;}</style>
<style type="text/css">label{text-shadow: 2px 2px #8B0000;}</style>
<head>
	<title>SIMDONDAR - Import hasil IMLTD NAT Panther Ultrio Elite</title>
</head>
<body>
<?php
include('modul/imltd_import_procleix_prepare.swn');
mysql_query($sql1);
mysql_query($sql2);
mysql_query($sql3);
?>
<table border=0>
	<tr>
		<td colspan=3 align="center" valign="middle"><font size="6" color="GoldenRod" font-family="Arial"><b><label>IMLTD NAT - Panther<sup>&reg</sup> Ultrio Elite</font></td>
	</tr>
	<tr>
		<td>
			<table>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_panther_nat_lis" class="a-btn">
						<span class="a-btn-text">Import manual file LIS </span><span class="a-btn-slide-text">Modul Panther Procleix<sup>&reg</sup> Ultrio Elite</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_panther_rawlist" class="a-btn">
						<span class="a-btn-text">Konfirmasi kantong darah</span><span class="a-btn-slide-text">Modul Panther Procleix<sup>&reg</sup> Ultrio Elite</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_panther_rawlistall" class="a-btn">
						<span class="a-btn-text">Rekapitulasi transfer data</span><span class="a-btn-slide-text">Modul Panther Procleix<sup>&reg</sup> Ultrio Elite</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td><div id="sliderFrame"><div id="slider">
						<a href="#"><img src="procleixs/1.png" /></a>
						<a href="#"><img src="procleixs/2.png" /></a>
						<a href="#"><img src="procleixs/3.png" /></a>
					</div></div></td></tr>
			</table>
		</td>
		<td>
			<table>
				<!--tr><td valign="top"><a href="pmiimltd.php?module=import_nat_panther_laporannat" class="a-btn">
					<span class="a-btn-text">Laporan pemeriksaan NAT</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
					<span class="a-btn-icon-right"><span></span></span></a></td></tr-->
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_panther_stoknat" class="a-btn">
					<span class="a-btn-text">Laporan stok darah NAT</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
					<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_panther_stoknatdetail" class="a-btn">
					<span class="a-btn-text">Laporan stok darah NAT Detail</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
					<span class="a-btn-icon-right"><span></span></span></a></td></tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
