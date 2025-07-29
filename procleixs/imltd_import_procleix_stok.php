<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #8888FF }
</style>
<style type="text/css">.styled-select select {background-color: #F7D7D7; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<script>
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {$('html,body').animate({scrollTop: target.offset().top}, 5000);return false;}
    }
  });
});
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMUDDA - Import LIS Procleix(R) System Software</title>
</head>
<body>
	<font size="5" color=red>STOK DARAH SEHAT NAT</font><br>
	<table class="list" border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse">
		<tr class="field">
			<td rowspan=2>NO.</td>
			<td rowspan=2>NAMA PRODUK DARAH</td>
			<td colspan=4>GOLONGAN DARAH</td>
			<td rowspan=2>JUMLAH</td>
		</tr>
		<tr class="field">
			<td>A</td>
			<td>B</td>
			<td>O</td>
			<td>AB</td>
		</tr>
		<?
		$no=0;
		$jumA='0';$jumB='0';$jumAB='0';$jumO='0';$jumA_='0';$jumB_='0';$jumAB_='0';$jumO_='0';$jumX='0';
		include('modul/imltd_import_procleix_prepare.swn');
		$produk=mysql_query($stok_nat);
		while ($produk1=mysql_fetch_assoc($produk)) {
			$no++;
			$A=$produk1['golA'];
			$B=$produk1['golB'];
			$O=$produk1['golO'];
			$AB=$produk1['golAB'];
			$jumA=$jumA+$A;
			$jumB=$jumB+$B;
			$jumAB=$jumAB+$AB;
			$jumO=$jumO+$O;
			if ($A<1) $A='-';
			if ($B<1) $B='-';
			if ($AB<1) $AB='-';
			if ($O<1) $O='-';?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
				<td align="right"><?=$no?>.</td>
				<td align="left"><?=$produk1['lengkap']?></td>
				<td align="right"><?=$A?></td>
				<td align="right"><?=$B?></td>
				<td align="right"><?=$O?></td>
				<td align="right"><?=$AB?></td>
				<td align="right"><?=$AB+$A+$B+$O?></td>
		<?}
		if ($no>0){?>
		</tr>
			<tr class="field">
				<td align="left" colspan="2">TOTAL</td>
				<td align="right"><?=$jumA?></td>
				<td align="right"><?=$jumB?></td>
				<td align="right"><?=$jumO?></td>
				<td align="right"><?=$jumAB?></td>
				<td align="right"><?=$jumAB+$jumA+$jumB+$jumO?></td>
			</tr>
		<?}
		if ($no==0){?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
				<td align="center" colspan="7">Tidak ada Stok darah sehat NAT</td>
			</tr>
		<?}?>
	</table>
	<a href="pmiimltd.php?module=import_nat_panther"class="swn_button_green">Kembali</a>
	<a href="pmiimltd.php?module=import_nat_panther_stoknatdetail"class="swn_button_blue">Detail</a>
</body>
</html>

