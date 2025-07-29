<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglawal=date("Y-m-d");
$hariini = date("Y-m-d");
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #8888FF }
</style>
<style type="t	ext/css">.styled-select select {background-color: #F7D7D7; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
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
	<title>Sistem Informasi Unit Donor Darah</title>
</head>
<body>
	<?
	if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
	if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
	?>
	<font size="5" color=red>REKAP PANGGILAN TELP KELUAR</font><br>
	<form name="cari" method="POST" action="<?echo $PHPSELF?>">
		<font size="2" color=black>
		DARI TANGGAL :<input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size="8">
		S/D. :<input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size="8">
		<input type=submit name=submit class="swn_btn_tengah" value="Lihat"></font>
	</form>
	<table class="list" border=1 cellpadding=5 cellspacing=5 style="border-collapse:collapse">
		<tr class="field">
			<td>NO.</td>
			<td>NOMOR<br>TUJUAN</td>
			<td>JUMLAH</td>
			<td>KET. TUJUAN</td>
		</tr>
		<?
		$no=0;
		$tlp="SELECT tlp_out.notlp, COUNT( tlp_out.notlp ) AS jumlah
			FROM tlp_out
			WHERE
			(date(tlp_out.tgl)>='$tglawal' and date(tlp_out.tgl)<='$hariini')
			GROUP BY tlp_out.notlp";
		$qtlp=mysql_query($tlp);
		while ($qtlp1=mysql_fetch_assoc($qtlp)) {
			$kontaktujuan="-";
			//Cari data rumah sakit
			$sqcek=mysql_query("select `NamaRs` from rmhsakit where `telp`='$qtlp1[notlp]' limit 1");
			$sqkontak=mysql_fetch_assoc($sqcek);$kontaktujuan=$sqkontak['NamaRs'];if ($kontaktujuan!==""){$ket="Rumah Sakit: ";}else{$ket="";}
			//cari pada karyawan
			if ($kontaktujuan==""){
				$sqcek=mysql_query("SELECT `nama_lengkap` FROM `pmi`.`user` WHERE `telp`='$qtlp1[notlp]' limit 1");
				$sqkontak=mysql_fetch_assoc($sqcek);$kontaktujuan=$sqkontak['nama_lengkap'];if ($kontaktujuan!==""){$ket="Karyawan UDD: ";}else{$ket="";}
			}
			
			//cari pada pendonor
			if ($kontaktujuan==""){
				$sqcek=mysql_query("SELECT `Nama` FROM `pendonor` WHERE `telp`= '$qtlp1[notlp]' or `telp2`='$qtlp1[notlp]' limit 1");
				$sqkontak=mysql_fetch_assoc($sqcek);$kontaktujuan=$sqkontak['Nama'];if ($kontaktujuan!==""){$ket="DONOR: ";}else{$ket="";}
			}
			
			//cari data instansi donor
			if ($kontaktujuan==""){
				$sqcek=mysql_query("SELECT `nama`, `cp` FROM `detailinstansi` WHERE `telp`='$qtlp1[notlp]' or `cp`='$qtlp1[notlp]' limit 1");
				$sqkontak=mysql_fetch_assoc($sqcek);$kontaktujuan=$sqkontak['nama'];if ($kontaktujuan!==""){$ket="INSTANSI DONOR: ";}else{$ket="";}
			}
			$no++;?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
				<td align="right"><?=$no?>.</td>
				<td align="left"><?=$qtlp1['notlp']?></td>
				<td align="center"><?=$qtlp1['jumlah']?></td>
				<td align="left"><?=$kontaktujuan?></td>
		<?}?>
	</table>
</body>
</html>