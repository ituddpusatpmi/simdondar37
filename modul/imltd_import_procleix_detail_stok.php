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
<a name="atas" id="atas">
<font size="5" color=red>DETAIL STOK DARAH SEHAT NAT</font><br>
<a href="pmiimltd.php?module=import_nat_procleix"class="swn_btn_kiri">Kembali</a>
<a href="#bawah" class="swn_btn_kanan">Ke bawah</a>
	<table class="list" border=1 cellpadding=2 cellspacing=2 style="border-collapse:collapse" width="1000px">
		<tr class="field">
			<td>NO.</td>
			<td>NOMOR<br>KANTONG</td>
			<td>JENIS<br>KOMPONEN</td>
			<td>GOLONGAN<br>DARAH</td>
			<td>RHESUS</td>
			<td>KODE<br>PENDONOR</td>
			<td>TANGGAL<br>AFTAP</td>
			<td>TANGGAL<br>PENGOLAHAN</td>
			<td>TANGGAL<br>KADALUWARSA</td>
		</tr>
	<?php
	$no=0;
	$sql="select noKantong,Status,produk,hasilNAT,gol_darah,RhesusDrh,kodePendonor,tgl_Aftap,kadaluwarsa,tglpengolahan from stokkantong
		  where Status='2' and (stat2='0' or stat2 is null) and sah='1' and date(kadaluwarsa) > current_date and hasilNAT=1
		  order by gol_darah, RhesusDrh, produk, kadaluwarsa";
	
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;?>
		<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no?>.</td>
			<td align="left"><?=$tmp['noKantong']?></td>
			<td align="left"><?=$tmp['produk']?></td>
			<td align="center"><?=$tmp['gol_darah']?></td>
			<td align="center"><?=$tmp['RhesusDrh']?></td>
			<td align="left"><?=$tmp['kodePendonor']?></td>
			<td align="left"><?=$tmp['tgl_Aftap']?></td>
			<td align="left"><?=$tmp['tglpengolahan']?></td>
			<td align="left"><?=$tmp['kadaluwarsa']?></td>
		</tr>
	<?}
	if ($no==0){?><tr class="record"><td colspan=9>Tidak ada stok darah NAT</td><?}?>
	</table>
	<a href="pmiimltd.php?module=import_nat_procleix"class="swn_btn_kiri">Kembali</a>
	<a href="#atas" class="swn_btn_kanan">Ke Atas</a><a name="bawah" id="bawah"></a>
</body>
</html>

