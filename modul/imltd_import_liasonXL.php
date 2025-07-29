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
<link href="css/blitzer/js-image-slider-liasonxl.css" rel="stylesheet" type="text/css" />
<script src="css/blitzer/js-image-slider.js" type="text/javascript"></script>
<style>body {background:#F6F6F6;font:normal 0.9em Arial; margin-top: 40px ;margin-left: 50px;padding:0; padding-bottom:50px;}</style>
<style type="text/css">label{text-shadow: 2px 2px #8B0000;}</style>
<head>
	<title>SIMDONDAR - Diasorin LiaisonXL</title>
</head>
<body>
<?php
include('modul/imltd_import_liasonXL_prepare.php');
?>
<table border=0>
	<tr>
		<td colspan=3 align="left" valign="top">
			<font size="7" color="Blue" font-family="Arial"><b><label>IMLTD Diasorin Liaison<sup>&reg</sup>XL</font>
		</td>
	</tr>
	<tr>
		<td>
			<table>
				<tr>
					<td><div id="sliderFrame"><div id="slider">
						<a href="#"><img src="images/liason1.png" alt="<?=$msg1?>"/></a>
						<a href="#"><img src="images/liason2.png" alt="<?=$msg2?>"/></a>
						<a href="#"><img src="images/liason3.png" alt="<?=$msg3?>"/></a>
						<a href="#"><img src="images/liason4.png" alt="<?=$msg4?>"/></a>
						<a href="#"><img src="images/liason5.png" alt="<?=$msg5?>"/></a>
						<a href="#"><img src="images/liason6.png" alt="<?=$msg6?>"/></a>
					</div></div></td></tr>
			</table>
		</td>
		<td>
			<table>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_liasonxl_raw" class="a-btn">
						<span class="a-btn-text">Data transfer dari Liaison<sup>&reg</sup>XL untuk konfirmasi</span>
						<span class="a-btn-slide-text">Diason Liaison<sup>&reg</sup>XL - TIM SIMDONDAR Nasional</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<!--tr><td valign="top"><a href="pmiimltd.php?module=import_liasonxl_konfirm" class="a-btn">
						<span class="a-btn-text">Konfirmasi kantong darah</span>
						<span class="a-btn-slide-text">Diason Liaison<sup>&reg</sup>XL - TIM SIMDONDAR Nasional</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr-->
				<tr><td valign="top"><a href="pmiimltd.php?module=import_liasonxl_rekap" class="a-btn">
						<span class="a-btn-text">Rekap transfer data</span>
						<span class="a-btn-slide-text">Diason Liaison<sup>&reg</sup>XL - TIM SIMDONDAR Nasional</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
