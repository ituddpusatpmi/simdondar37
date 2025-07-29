<?php
	include "koneksi.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Jaga Laboratorium</title>
	<link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
	<script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="jquery-ui-1.10.3/demos.css">
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$("#datepicker").change(function(){
			$("#datepicker").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <style type="text/css">
		.ui-datepicker {
				font-family:Garamond;
				font-size:12px;
				margin-left:10px
				}
	</style>
<script language=javascript>
<!--

//Disable right mouse click Script

var message="Right Click Disable, Sorry..!";

///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")

// -->
</script>
</head>

<body>
<form method="post" action="rekap_laporan.php">
<table width="100%">
<tr>
	<td><b>LAPORAN JAGA LABORATORIUM UTD-PMI KOTA PEKANBARU</b></td>
    <td align="right"><input type="text" name="tanggal" placeholder="tahun-bulan-tanggal" id="datepicker" />&nbsp;<select name="shift"><option>PAGI</option><option>SIANG</option><option>MALAM</option></select>&nbsp;<input type="submit" value="search" /> &nbsp; <a href="index.php">Home<img src="images/home.png" width="20" height="20" /></a></td>
</tr>
</table>
</form>
<hr />
<?php
	$rekap1 = $_POST['rekap1'];
	$rekap2 = $_POST['rekap2'];
	$rekap3 = $_POST['rekap3'];
	$rekap4 = $_POST['rekap4'];
	
	$sql=" select tanggal,shift,id,tgl_aftap,tgl_aftap1,tgl_aftap2,tgl_aftap3,tgl_aftap4,tgl_aftap5,tgl_aftap6,tgl_aftap7,tgl_aftap8,tgl_aftap9,tgl_aftap10,tgl_aftap11,tgl_aftap12,tgl_aftap13,tgl_aftap14,tgl_aftap15,tgl_aftap16,tgl_aftap17,tgl_aftap18,tgl_aftap19,donor,gol_minta,kantong1,kantong2,kantong3,kantong4,kantong5,kantong6,kantong7,kantong8,kantong9,kantong10,kantong11,kantong12,kantong13,kantong14,kantong15,kantong16,kantong17,kantong18,kantong19,kantong20,permintaan_b1,permintaan_b2,permintaan_b3,permintaan_b4,permintaan_b5,permintaan_b6,permintaan_b7,permintaan_b8,permintaan_b9,permintaan_b10,permintaan_b11,permintaan_b12,permintaan_b13,permintaan_b14,permintaan_b15,permintaan_b16,permintaan_b17,permintaan_b18,permintaan_b19,permintaan_b20,pasien,jk,gol_pasien,kembali_a,kembali_a2,kembali_a3,kembali_a4,kembali_a5,kembali_a6,kembali_a7,kembali_b,kembali_b2,kembali_b3,kembali_b4,kembali_b5,kembali_b6,kembali_b7,kembali_ab,kembali_ab2,kembali_ab3,kembali_ab4,kembali_ab5,kembali_ab6,kembali_ab7,kembali_o,kembali_o2,kembali_o3,kembali_o4,kembali_o5,kembali_o6,kembali_o7,keluar_a,keluar_a2,keluar_a3,keluar_a4,keluar_a5,keluar_a6,keluar_a7,keluar_b,keluar_b2,keluar_b3,keluar_b4,keluar_b5,keluar_b6,keluar_b7,keluar_ab,keluar_ab2,keluar_ab3,keluar_ab4,keluar_ab5,keluar_ab6,keluar_ab7,keluar_o,keluar_o2,keluar_o3,keluar_o4,keluar_o5,keluar_o6,keluar_o7,keterangan1,keterangan2,keterangan3,keterangan4,keterangan5,keterangan6,keterangan7,keterangan8,keterangan9,keterangan10,keterangan11,keterangan12,keterangan13,keterangan14,keterangan15,keterangan16,keterangan17,keterangan18,keterangan19,keterangan20,perubahan,rs_umum,rs_swasta,rb_umum,rb_swasta,bd_umum,bd_swasta,bagian,dokter,petugas,compabiliti,incompabiliti1,incompabiliti2,incompabiliti3,incompabiliti4,asal_kantong,keterangan,jam_selesai,metode from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
	$proses=mysql_query($sql);
	while($data = mysql_fetch_array($proses)){ 
?>
<p><b>TANGGAL :</b>&nbsp;<?php echo $data['tanggal']; ?>&nbsp;<b>SHIFT :</b>&nbsp;<?php echo $data['shift']; ?><text style="display:none"><?php echo $data['id']; ?></text></p>
<table width="100%" border="1">
  <tr bgcolor="#FFA072">
    <td rowspan="2"><div align="center"><strong>TGL. AFTAP</strong></div></td>
    <td colspan="2"><div align="center"><strong>KETERANGAN</strong></div></td>
    <td rowspan="2"><div align="center"><strong>NOMOR KANTONG</strong></div></td>
    <td rowspan="2"><div align="center"><strong>NAMAPASIEN</strong></div></td>
    <td rowspan="2"><div align="center"><strong>L / P</strong></div></td>
    <td rowspan="2"><div align="center"><strong> GOL DARAH RH</strong></div></td>
    <td rowspan="2"><div align="center"><strong>JENIS</strong></div></td>
    <td colspan="4"><div align="center"><strong>DARAH KEMBALI</strong></div></td>
    <td colspan="4"><div align="center"><strong>DARAH KELUAR</strong></div></td>
    <td rowspan="2"><div align="center"><strong>KET.</strong></div></td>
  </tr>
  <tr bgcolor="#FFA072">
    <td><div align="center"><strong>DONOR</strong></div></td>
    <td><div align="center"><strong>GOL. DARAH RH</strong></div></td>
    <td><div align="center"><strong>A</strong></div></td>
    <td><div align="center"><strong>B</strong></div></td>
    <td><div align="center"><strong>AB</strong></div></td>
    <td><div align="center"><strong>O</strong></div></td>
    <td><div align="center"><strong>A</strong></div></td>
    <td><div align="center"><strong>B</strong></div></td>
    <td><div align="center"><strong>AB</strong></div></td>
    <td><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="15" rowspan="7"><div align="center"><?php echo $data['tgl_aftap']; ?>
    <?php echo $data['tgl_aftap1']; ?>
    <?php echo $data['tgl_aftap2']; ?>
    <?php echo $data['tgl_aftap3']; ?>
    <?php echo $data['tgl_aftap4']; ?>
    <?php echo $data['tgl_aftap5']; ?>
    <?php echo $data['tgl_aftap6']; ?>
    <?php echo $data['tgl_aftap7']; ?>
    <?php echo $data['tgl_aftap8']; ?>
    <?php echo $data['tgl_aftap9']; ?>
    <?php echo $data['tgl_aftap10']; ?>
    <?php echo $data['tgl_aftap11']; ?>
    <?php echo $data['tgl_aftap12']; ?>
    <?php echo $data['tgl_aftap13']; ?>
    <?php echo $data['tgl_aftap14']; ?>
    <?php echo $data['tgl_aftap15']; ?>
    <?php echo $data['tgl_aftap16']; ?>
    <?php echo $data['tgl_aftap17']; ?>
    <?php echo $data['tgl_aftap18']; ?>
    <?php echo $data['tgl_aftap19']; ?></div></td>
    <td rowspan="7"><div align="center"><?php echo $data['donor']; ?></div></td>
    <td rowspan="7"><div align="center"><?php echo $data['gol_minta']; ?></div></td>
    <td width="20" rowspan="7" valign="top"><div align="left"><?php echo $data['kantong1']; ?>-<?php echo $data['permintaan_b1']; ?>
    <?php echo $data['kantong2']; ?>-<?php echo $data['permintaan_b2']; ?>
    <?php echo $data['kantong3']; ?>-<?php echo $data['permintaan_b3']; ?>
    <?php echo $data['kantong4']; ?>-<?php echo $data['permintaan_b4']; ?>
    <?php echo $data['kantong5']; ?>-<?php echo $data['permintaan_b5']; ?>
    <?php echo $data['kantong6']; ?>-<?php echo $data['permintaan_b6']; ?>
    <?php echo $data['kantong7']; ?>-<?php echo $data['permintaan_b7']; ?>
    <?php echo $data['kantong8']; ?>-<?php echo $data['permintaan_b8']; ?>
    <?php echo $data['kantong9']; ?>-<?php echo $data['permintaan_b9']; ?>
    <?php echo $data['kantong10']; ?>-<?php echo $data['permintaan_b10']; ?>
    <?php echo $data['kantong11']; ?>-<?php echo $data['permintaan_b11']; ?>
    <?php echo $data['kantong12']; ?>-<?php echo $data['permintaan_b12']; ?>
    <?php echo $data['kantong13']; ?>-<?php echo $data['permintaan_b13']; ?>
    <?php echo $data['kantong14']; ?>-<?php echo $data['permintaan_b14']; ?>
    <?php echo $data['kantong15']; ?>-<?php echo $data['permintaan_b15']; ?>
    <?php echo $data['kantong16']; ?>-<?php echo $data['permintaan_b16']; ?>
    <?php echo $data['kantong17']; ?>-<?php echo $data['permintaan_b17']; ?>
    <?php echo $data['kantong18']; ?>-<?php echo $data['permintaan_b18']; ?>
    <?php echo $data['kantong19']; ?>-<?php echo $data['permintaan_b19']; ?>
    <?php echo $data['kantong20']; ?>-<?php echo $data['permintaan_b20']; ?></div></td>
    <td rowspan="7"><div align="center"><?php echo $data['pasien']; ?></div></td>
    <td rowspan="7"><div align="center"><?php echo $data['jk']; ?></div></td>
    <td rowspan="7"><div align="center"><?php echo $data['gol_pasien']; ?></div></td>
    <td><div align="center"><strong>WB</strong></div></td>
    <td><?php echo $data['kembali_a']; ?></td>
    <td><?php echo $data['kembali_b']; ?></td>
    <td><?php echo $data['kembali_ab']; ?></td>
    <td><?php echo $data['kembali_o']; ?></td>
    <td><?php echo $data['keluar_a']; ?></td>
    <td><?php echo $data['keluar_b']; ?></td>
    <td><?php echo $data['keluar_ab']; ?></td>
    <td><?php echo $data['keluar_o']; ?></td>
    <td rowspan="7" width="20" valign="top"><div align="center"><?php echo $data['keterangan1']; ?>
    <?php echo $data['keterangan2']; ?>
    <?php echo $data['keterangan3']; ?>
    <?php echo $data['keterangan4']; ?>
    <?php echo $data['keterangan5']; ?>
    <?php echo $data['keterangan6']; ?>
    <?php echo $data['keterangan7']; ?>
    <?php echo $data['keterangan8']; ?>
    <?php echo $data['keterangan9']; ?>
    <?php echo $data['keterangan10']; ?>
    <?php echo $data['keterangan11']; ?>
    <?php echo $data['keterangan12']; ?>
    <?php echo $data['keterangan13']; ?>
    <?php echo $data['keterangan14']; ?>
    <?php echo $data['keterangan15']; ?>
    <?php echo $data['keterangan16']; ?>
    <?php echo $data['keterangan17']; ?>
    <?php echo $data['keterangan18']; ?>
    <?php echo $data['keterangan19']; ?>
    <?php echo $data['keterangan20']; ?></div></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>PRC</strong></div></td>
    <td><?php echo $data['kembali_a2']; ?></td>
    <td><?php echo $data['kembali_b2']; ?></td>
    <td><?php echo $data['kembali_ab2']; ?></td>
    <td><?php echo $data['kembali_o2']; ?></td>
    <td><?php echo $data['keluar_a2']; ?></td>
    <td><?php echo $data['keluar_b2']; ?></td>
    <td><?php echo $data['keluar_ab2']; ?></td>
    <td><?php echo $data['keluar_o2']; ?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>FFP</strong></div></td>
    <td><?php echo $data['kembali_a3']; ?></td>
    <td><?php echo $data['kembali_b3']; ?></td>
    <td><?php echo $data['kembali_ab3']; ?></td>
    <td><?php echo $data['kembali_o3']; ?></td>
    <td><?php echo $data['keluar_a3']; ?></td>
    <td><?php echo $data['keluar_b3']; ?></td>
    <td><?php echo $data['keluar_ab3']; ?></td>
    <td><?php echo $data['keluar_o3']; ?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>LP</strong></div></td>
    <td><?php echo $data['kembali_a4']; ?></td>
    <td><?php echo $data['kembali_b4']; ?></td>
    <td><?php echo $data['kembali_ab4']; ?></td>
    <td><?php echo $data['kembali_o4']; ?></td>
    <td><?php echo $data['keluar_a4']; ?></td>
    <td><?php echo $data['keluar_b4']; ?></td>
    <td><?php echo $data['keluar_ab4']; ?></td>
    <td><?php echo $data['keluar_o4']; ?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>TC</strong></div></td>
    <td><?php echo $data['kembali_a5']; ?></td>
    <td><?php echo $data['kembali_b5']; ?></td>
    <td><?php echo $data['kembali_ab5']; ?></td>
    <td><?php echo $data['kembali_o5']; ?></td>
    <td><?php echo $data['keluar_a5']; ?></td>
    <td><?php echo $data['keluar_b5']; ?></td>
    <td><?php echo $data['keluar_ab5']; ?></td>
    <td><?php echo $data['keluar_o5']; ?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>AHF</strong></div></td>
    <td><?php echo $data['kembali_a6']; ?></td>
    <td><?php echo $data['kembali_b6']; ?></td>
    <td><?php echo $data['kembali_ab6']; ?></td>
    <td><?php echo $data['kembali_o6']; ?></td>
    <td><?php echo $data['keluar_a6']; ?></td>
    <td><?php echo $data['keluar_b6']; ?></td>
    <td><?php echo $data['keluar_ab6']; ?></td>
    <td><?php echo $data['keluar_o6']; ?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>PD</strong></div></td>
    <td><?php echo $data['kembali_a7']; ?></td>
    <td><?php echo $data['kembali_b7']; ?></td>
    <td><?php echo $data['kembali_ab7']; ?></td>
    <td><?php echo $data['kembali_o7']; ?></td>
    <td><?php echo $data['keluar_a7']; ?></td>
    <td><?php echo $data['keluar_b7']; ?></td>
    <td><?php echo $data['keluar_ab7']; ?></td>
    <td><?php echo $data['keluar_o7']; ?></td>
  </tr>
</table>
<br />
<table width="100%" border="1">
  <tr bgcolor="#FFA072">
    <td rowspan="3"><div align="center"><strong>PERUBAHAN JENIS PERMINTAAN AWAL</strong></div></td>
    <td colspan="2"><div align="center"><strong>RUMAH SAKIT</strong></div></td>
    <td colspan="2"><div align="center"><strong>RUMAH BERSALIN</strong></div></td>
    <td colspan="2"><div align="center"><strong>BANK DARAH</strong></div></td>
    <td rowspan="3"><div align="center"><strong>BAGIAN</strong></div></td>
    <td rowspan="3"><div align="center"><strong>DOKTER YANG MEMINTA</strong></div></td>
    <td colspan="6"><div align="center"><strong>HASIL CROSSMATCH</strong></div></td>
    <td rowspan="3"><div align="center"><strong>ASAL KANTONG</strong></div></td>
    <td rowspan="3"><div align="center"><strong>KETERANGAN</strong></div></td>
    <td rowspan="3"><div align="center"><strong>JAM SELESAI CROSSMATCH</strong></div></td>
    <td rowspan="3"><div align="center"><strong>&nbsp;EDIT/DELETE&nbsp;</strong></div></td>
  </tr>
  <tr bgcolor="#FFA072">
    <td rowspan="2"><div align="center"><strong>UMUM</strong></div></td>
    <td rowspan="2"><div align="center"><strong>SWASTA</strong></div></td>
    <td rowspan="2"><div align="center"><strong>UMUM</strong></div></td>
    <td rowspan="2"><div align="center"><strong>SWASTA</strong></div></td>
    <td rowspan="2"><div align="center"><strong>UMUM</strong></div></td>
    <td rowspan="2"><div align="center"><strong>SWASTA</strong></div></td>
    <td rowspan="2"><div align="center"><strong>NAMA PETUGAS</strong></div></td>
    <td rowspan="2"><div align="center"><strong>COMP</strong></div></td>
    <td colspan="4"><div align="center"><strong>INCOMPATIBLE</strong></div></td>
  </tr>
  <tr bgcolor="#FFA072">
    <td><div align="center"><strong>My +</strong></div></td>
    <td><div align="center"><strong>Mn +</strong></div></td>
    <td><div align="center"><strong>Dct</strong></div></td>
    <td><div align="center"><strong>Ak</strong></div></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><?php echo $data['perubahan']; ?></div></td>
    <td><div align="center"><?php echo $data['rs_umum']; ?></div></td>
    <td><div align="center"><?php echo $data['rs_swasta']; ?></div></td>
    <td><div align="center"><?php echo $data['rb_umum']; ?></div></td>
    <td><div align="center"><?php echo $data['rb_swasta']; ?></div></td>
    <td><div align="center"><?php echo $data['bd_umum']; ?></div></td>
    <td><div align="center"><?php echo $data['bd_swasta']; ?></div></td>
    <td><div align="center"><?php echo $data['bagian']; ?></div></td>
    <td><div align="center"><?php echo $data['dokter']; ?></div></td>
    <td><div align="center"><?php echo $data['petugas']; ?></div></td>
    <td><div align="center"><?php echo $data['compabiliti']; ?></div></td>
    <td><div align="center"><?php echo $data['incompabiliti1']; ?></div></td>
    <td><div align="center"><?php echo $data['incompabiliti2']; ?></div></td>
    <td><div align="center"><?php echo $data['incompabiliti3']; ?></div></td>
    <td><div align="center"><?php echo $data['incompabiliti4']; ?></div></td>
    <td><div align="center"><?php echo $data['asal_kantong']; ?></div></td>
    <td><div align="center"><?php echo $data['keterangan']; ?></div></td>
    <td><div align="center"><?php echo $data['jam_selesai']; ?><br /><?php echo $data['metode']; ?></div></td>
    <td><a href="edit_rekap.php?edit=<?php echo $data['id']; ?>">Edit<img src="images/setting1.png" width="20" height="20" /></a>&nbsp;<a href="hapus_rekap.php?hapus=<?php echo $data['id']; ?>">Hapus<img src="images/hapus.png" width="20" height="20" /></a></td>
  </tr>
</table>
<?php
	}
	?>
<br />
<table>
<tr bgcolor="#CCFF33">
	<td>Pencarian Berdasarkan : </td>
	<td><input type="text" value="<?php echo $rekap2; ?>" readonly="readonly" /></td>
    <td>&nbsp;</td>
    <td>Tanggal : </td>
    <td><input type="text" value="<?php echo $rekap3; ?> sampai <?php echo $rekap4; ?>" readonly="readonly" size="30" /></td>
</tr>
</table>
<br />
<table width="100%">
<tr>
<td>
<table border="1">
  <tr bgcolor="#FFA072">
    <td width="17%" rowspan="2"><div align="center"><strong>JENIS STOK</strong></div></td>
    <td colspan="4"><div align="center"><strong>STOK TERPAKAI</strong><br />
    </div></td>
  </tr>
  <tr bgcolor="#FFA072">
    <td width="9%"><div align="center"><strong>A</strong></div></td>
    <td width="9%"><div align="center"><strong>B</strong></div></td>
    <td width="9%"><div align="center"><strong>AB</strong></div></td>
    <td width="8%"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <?php
		$sql="select sum(keluar_a) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai2" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai3" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai4" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <?php
		$sql="select sum(keluar_a2) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai5" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b2) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai6" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab2) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai7" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o2) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai8" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <?php
		$sql="select sum(keluar_a3) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai9" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b3) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai10" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab3) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai11" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o3) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai12" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <?php
		$sql="select sum(keluar_a4) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai13" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b4) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai14" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab4) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai15" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o4) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai16" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <?php
		$sql="select sum(keluar_a5) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai17" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b5) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai18" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab5) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai19" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o5) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai20" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <?php
		$sql="select sum(keluar_a6) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai21" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b6) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai22" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab6) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai23" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o6) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai24" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <?php
		$sql="select sum(keluar_a7) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai25" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b7) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai26" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab7) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai27" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o7) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai28" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
  </tr>
</table>
</td>
<td>
<table width="525" border="1" align="center">
  <tr>
  <?php
	$sql="select count(id) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
  ?>
    <td colspan="2" bgcolor="#FFA072"><strong>Jumlah Record Pencarian</strong></td>
    <td width="68" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
<?php
	$sql="select sum(keluar_a+keluar_b+keluar_ab+keluar_o+keluar_a2+keluar_b2+keluar_ab2+keluar_o2+keluar_a3+keluar_b3+keluar_ab3+keluar_o3+keluar_a4+keluar_b4+keluar_ab4+keluar_o4+keluar_a5+keluar_b5+keluar_ab5+keluar_o5+keluar_a6+keluar_b6+keluar_ab6+keluar_o6+keluar_a7+keluar_b7+keluar_ab7+keluar_o7) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
?>
    <td rowspan="6" bgcolor="#FFA072"><strong>Kantong yang terpakai</strong></td>
    <td bgcolor="#FFA072"><strong>Total</strong></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Pasien</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>BDRS</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Rusak</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Expired</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Reaktif</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="69" rowspan="2" bgcolor="#FFA072"><strong>Metode</strong></td>
    <td width="106" bgcolor="#FFA072"><strong>Gel Test</strong></td>
    <?php 
	$sql="select count(metode) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4' and metode='Gel Test'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Konvensional</strong></td>
    <?php 
	$sql="select count(metode) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4' and metode='Konvensional'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td rowspan="4" bgcolor="#FFA072"><strong>Bagian</strong></td>
    <td bgcolor="#FFA072"><strong>Bedah</strong></td>
    <?php 
	$sql="select count(metode) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4' and bagian='Bedah'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Penyakit dalam</strong></td>
    <?php 
	$sql="select count(metode) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4' and bagian='Penyakit Dalam'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Kebidanan</strong></td>
    <?php 
	$sql="select count(metode) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4' and bagian='Kebidanan'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><strong>Anak</strong></td>
    <?php 
	$sql="select count(metode) as jumlah from laporan where $rekap1 like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4' and bagian='Anak'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
</table>
</td>
<td>
<table border="1">
<tr>
	<td colspan="2" bgcolor="#FFA072"><div align="center"><strong>RS</strong></div></td>
    <td colspan="2" bgcolor="#FFA072"><div align="center"><strong>RB</strong></div></td>
    <td colspan="2" bgcolor="#FFA072"><div align="center"><strong>BD</strong></div></td>
</tr>
<tr>
	<td bgcolor="#FFA072"><div align="center"><strong>Umum</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Swasta</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Umum</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Swasta</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Umum</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Swasta</strong></div></td>
</tr>
<tr>
	<?php
		$sql="select count(rs_umum) as jumlah from laporan where rs_umum like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
	<td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(rs_swasta) as jumlah from laporan where rs_swasta like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(rb_umum) as jumlah from laporan where rb_umum like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(rb_swasta) as jumlah from laporan where rb_swasta like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(bd_umum) as jumlah from laporan where bd_umum like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(bd_swasta) as jumlah from laporan where bd_swasta like '%$rekap2%' and tanggal between '$rekap3' and '$rekap4'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
</tr>
</table>
</td>
</tr>
</table>
<br />
</body>
</html>