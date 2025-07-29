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
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMUDDA - List Kendaraan Kantor</title>
</head>
<body>
	
<font size="5" color=red>DAFTAR KENDARAAN KANTOR</font><br><br>
	<table class="list" border=1 cellpadding=5 cellspacing=2 style="border-collapse:collapse">
		<tr class="field">
			<td>No.</td>
			<td>NO. POL</td>
			<td>NAMA KENDARAAN</td>
			<td>SOPIR<BR>P.JAWAB</td>
			<td>TAHUN</td>
			<td>MERK</td>
			<td>ASAL</td>
			<td>BAHAN BAKAR</td>
			<td>TGL<br>SAMSAT</td>
			<td>NO. BPKB</td>
			<td>AKSI</td>
		</tr>
	<?php
	$no=0;
	$sql="SELECT `nopol`, `tahun`, `asal`, `tipe`, `merk`, `bbm`, `tgl_samsat`, `sopir`, `nama_mobil`, `no_bpkb`, `no_mesin`, `no_rangka`, `roda` FROM `mobil`";
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;?>
		<tr class="record">
			<td align="right"><?=$no?>.</td>
			<td align="left"><?=$tmp['nopol']?></td>
			<td align="left"><?=$tmp['nama_mobil']?></td>
			<td align="left"><?=$tmp['sopir']?></td>
			<td align="right"><?=$tmp['tahun']?></td>
			<td align="left"><?=$tmp['merk']?></td>
			<td align="left"><?=$tmp['asal']?></td>
			<td align="left"><?=$tmp['bbm']?></td>
			<td align="center"><?=$tmp['tgl_samsat']?></td>
			<td align="left"><?=$tmp['bpkb']?></td>
			<td><a href="pmimobile.php?module=kendaraan_edit&nopol=<?=$tmp['nopol']?> "class="swn_btn_kiri">Edit</a>
			    <a href="pmimobile.php?module=hapus_kendaraan&op=hapus&nopol=<?=$tmp['nopol']?> "class="swn_btn_kanan">Hapus</a></td>
		</tr>
	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=11>Master kendaraan belum ada</td>
	<?}?>
	</table><br>
	<a href="pmimobile.php?module=kendaraan_tambah"class="swn_button_green">Tambah</a>
	<a href="pmimobile.php?module=kendaraan_transaksi"class="swn_button_green">Transaksi</a>
	<a href="pmimobile.php?module=kendaraan_laporan"class="swn_button_green">Laporan</a>
	<?
?>
</body>
</html>

