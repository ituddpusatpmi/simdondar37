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
	<title>SIMUDDA - Import hasil IMLTD NAT Procleix Ultrio Plus</title>
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
		<td colspan=3 align="center" valign="middle"><font size="6" color="GoldenRod" font-family="Arial"><b><label>IMLTD NAT - eSAS Procleix<sup>&reg</sup> Ultrio Plus</font></td>
	</tr>
	<tr>
		<td>
			<table>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_procleix_nat_lis" class="a-btn">
						<span class="a-btn-text">Import manual file LIS eSAS</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_procleix_rawlist" class="a-btn">
						<span class="a-btn-text">Konfirmasi kantong darah</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_procleix_rawlistall" class="a-btn">
						<span class="a-btn-text">Rekapitulasi transfer data</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
						<span class="a-btn-icon-right"><span></span></span></a></td></tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td><div id="sliderFrame"><div id="slider">
						<a href="#"><img src="images/procleix0.png" alt="<?=$msg1?>"/></a>
						<a href="pmiimltd.php?module=import_procleix_nat_lis"><img src="images/procleix1.png" alt="<?=$msg2?>" /></a>
						<a href="pmiimltd.php?module=import_nat_procleix_rawlist"><img src="images/procleix2.png" alt="<?=$msg3?>" />
						<a href="#"><img src="images/procleix6.png" alt="<?=$msg4?>" />
						<a href="pmiimltd.php?module=import_nat_procleix_rawlistall"><img src="images/procleix3.png" alt="<?=$msg5?>" />
						<a href="#"><img src="images/procleix7.png" alt="<?=$msg2?>"/>
						<a href="pmiimltd.php?module=import_procleix_nat_lis"><img src="images/procleix4.png" alt="<?=$msg3?>"/>
						<a href="#"><img src="images/procleix8.png" alt="<?=$msg4?>"
						<a href="pmiimltd.php?module=import_procleix_nat_lis"><img src="images/procleix5.png" alt="<?=$msg5?>"/>
					</div></div></td></tr>
			</table>
		</td>
		<td>
			<table>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_procleix_laporannat" class="a-btn">
					<span class="a-btn-text">Laporan pemeriksaan NAT</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
					<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_procleix_stoknat" class="a-btn">
					<span class="a-btn-text">Laporan stok darah NAT</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
					<span class="a-btn-icon-right"><span></span></span></a></td></tr>
				<tr><td valign="top"><a href="pmiimltd.php?module=import_nat_procleix_stoknatdetail" class="a-btn">
					<span class="a-btn-text">Laporan stok darah NAT Detail</span><span class="a-btn-slide-text">Modul eSAS Procleix<sup>&reg</sup> Ultrio Plus</span>
					<span class="a-btn-icon-right"><span></span></span></a></td></tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
