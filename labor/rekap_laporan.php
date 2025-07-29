<?php
	session_start();
	include "cek.php";
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
<table width="100%">
<tr>
<td><img src="images/garis.jpg" width="1064" height="48" /></td><td><img src="images/pmi2.png" width="154" height="70"></td>
</tr>
<tr>
<td colspan="2"><marquee><font color="#FF0000"><strong>UNIT DONOR DARAH PMI KOTA PEKANBARU</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Jl. Diponegoro IX No. 15 Pekanbaru 28133  Telepon : (0761) 23126, 885126, Fax : (0761) 23126</strong>
</marquee></td>
</tr>
</table>
<form method="post" action="rekap_laporan.php">
<table width="100%">
<tr>
	<td><b>LAPORAN JAGA LABORATORIUM UTD-PMI KOTA PEKANBARU</b></td>
    <td align="right"><input type="text" name="tanggal" placeholder="tahun-bulan-tanggal" id="datepicker" />&nbsp;<select name="shift"><option>PAGI</option><option>SIANG</option><option>MALAM</option></select>&nbsp;<input type="submit" value="search" /> &nbsp; <a href="home.php">Home<img src="images/home.png" width="20" height="20" /></a>&nbsp;<a href="logout.php">Logout<img src="images/out.png" width="30" height="30" /></a></td>
</tr>
</table>
</form>
<hr />
<?php
	$tanggal = $_POST['tanggal'];
	$shift = $_POST['shift'];
	
	$sql=" select id,tanggal,shift,tgl_form,formulir,kembali_a,kembali_a2,kembali_a3,kembali_a4,kembali_a5,kembali_a6,kembali_a7,kembali_b,kembali_b2,kembali_b3,kembali_b4,kembali_b5,kembali_b6,kembali_b7,kembali_ab,kembali_ab2,kembali_ab3,kembali_ab4,kembali_ab5,kembali_ab6,kembali_ab7,kembali_o,kembali_o2,kembali_o3,kembali_o4,kembali_o5,kembali_o6,kembali_o7,keluar_a,keluar_a2,keluar_a3,keluar_a4,keluar_a5,keluar_a6,keluar_a7,keluar_b,keluar_b2,keluar_b3,keluar_b4,keluar_b5,keluar_b6,keluar_b7,keluar_ab,keluar_ab2,keluar_ab3,keluar_ab4,keluar_ab5,keluar_ab6,keluar_ab7,keluar_o,keluar_o2,keluar_o3,keluar_o4,keluar_o5,keluar_o6,keluar_o7,petugas,keterangan from laporan where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	while($data = mysql_fetch_array($proses)){ 
?>
<p><b>TANGGAL :</b>&nbsp;<?php echo $data['tanggal']; ?>&nbsp;<b>SHIFT :</b>&nbsp;<?php echo $data['shift']; ?><text style="display:none"><input type="text" name="id" value="<?php echo $data['id']; ?>" /></text></p>
<table width="865" border="1">
  <tr bgcolor="#FFA072">
    <td rowspan="2"><div align="center"><strong>TANGGAL</strong></div></td>
    <td width="110" rowspan="2"><div align="center"><strong>NO FORMULIR</strong></div></td>
    <td width="45" rowspan="2"><div align="center"><strong>JENIS</strong></div></td>
    <td colspan="4"><div align="center"><strong>DARAH KEMBALI</strong></div></td>
    <td colspan="4"><div align="center"><strong>DARAH KELUAR</strong></div></td>
    <td rowspan="2"><div align="center"><strong>PETUGAS</strong></div></td>
    <td rowspan="2"><div align="center"><strong>KETERANGAN</strong></div></td>
    <td rowspan="2"><div align="center"><strong>AKSI</strong></div></td>
  </tr>
  <tr bgcolor="#FFA072">
    <td width="25"><div align="center"><strong>A</strong></div></td>
    <td width="25"><div align="center"><strong>B</strong></div></td>
    <td width="33"><div align="center"><strong>AB</strong></div></td>
    <td width="25"><div align="center"><strong>O</strong></div></td>
    <td width="24"><div align="center"><strong>A</strong></div></td>
    <td width="24"><div align="center"><strong>B</strong></div></td>
    <td width="30"><div align="center"><strong>AB</strong></div></td>
    <td width="23"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="78" rowspan="7"><div align="center"><?php echo $data['tgl_form']; ?></div></td>
    <td rowspan="7"><div align="center"><?php echo $data['formulir']; ?></div></td>
    <td><div align="center"><strong>WB</strong></div></td>
    <td><?php echo $data['kembali_a']; ?></td>
    <td><?php echo $data['kembali_b']; ?></td>
    <td><?php echo $data['kembali_ab']; ?></td>
    <td><?php echo $data['kembali_o']; ?></td>
    <td><?php echo $data['keluar_a']; ?></td>
    <td><?php echo $data['keluar_b']; ?></td>
    <td><?php echo $data['keluar_ab']; ?></td>
    <td><?php echo $data['keluar_o']; ?></td>
    <td rowspan="7" width="72" valign="center"><div align="center"><?php echo $data['petugas']; ?></div></td>
    <td rowspan="7" width="112" valign="center"><div align="center"><?php echo $data['keterangan']; ?></div></td>
    <td rowspan="7" width="151" valign="center"><div align="center"><a href="edit_rekap.php?edit=<?php echo $data['id']; ?>">Edit<img src="images/setting1.png" width="30" height="30" /></a>&nbsp;<a href="hapus_rekap.php?hapus=<?php echo $data['id']; ?>">Hapus<img src="images/hapus.png" width="30" height="30" /></a></div></td>
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
<?php
	}
	?>
<BR />
</body>
</html>