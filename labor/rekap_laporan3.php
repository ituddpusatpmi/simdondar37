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
<form method="post" action="rekap_laporan3.php">
<table width="100%">
<tr>
	<td><b>LAPORAN PEMUSNAHAN DARAH </b></td>
    <td align="right"><input type="text" name="tanggal" placeholder="tahun-bulan-tanggal" id="datepicker" />&nbsp;<select name="shift"><option>PAGI</option><option>SIANG</option><option>MALAM</option></select>&nbsp;<input type="submit" value="search" /> &nbsp; <a href="home.php">Home<img src="images/home.png" width="20" height="20" /></a>&nbsp;<a href="logout.php">Logout<img src="images/out.png" width="30" height="30" /></a></td>
</tr>
</table>
</form>
<hr />
<?php
	$tanggal = $_POST['tanggal'];
	$shift = $_POST['shift'];
	
	$sql=" select * from musnah where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	$data = mysql_fetch_array($proses); 
?>
<p><b>TANGGAL :</b>&nbsp;<?php echo $data['tanggal']; ?>&nbsp;<b>SHIFT :</b>&nbsp;<?php echo $data['shift']; ?><text style="display:none"><input type="text" name="id" value="<?php echo $data['id']; ?>" /></text></p>
<br />
<table border="1" align="center">
   <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>No</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Tanggal / Shift</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Tanggal Aftap</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>No Kantong</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Golongan</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Rhesus</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Jenis</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Keterangan</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>Aksi</strong></div></td>
  </tr>
  <?php
	$tanggal = $_POST['tanggal'];
	$shift = $_POST['shift'];
	
	$sql=" select * from musnah where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
	?>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $nourut; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center"><input type="text" name="tanggal" value="<?php echo $data['tanggal']; ?>" size="8" />&nbsp;<select name="shift">
    																			<option><?php echo $data['shift']; ?></option>
                                                                                <option>PAGI</option>
                                                                                <option>SIANG</option>
                                                                                <option>MALAM</option>
                                                                               </select></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="tgl_aftap" id="datepicker18" value="<?php echo $data['tgl_aftap']; ?>" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="kantong" value="<?php echo $data['kantong']; ?>" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <select name="gol">
        <option><?php echo $data['gol']; ?></option>
        <option>A</option>
        <option>B</option>
        <option>AB</option>
        <option>O</option>
      </select>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center"><select name="rhesus">
    	<option><?php echo $data['rhesus']; ?></option>
        <option>(+)</option>
        <option>(-)</option>
        </select></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    	<select name="jenis">
        	<option><?php echo $data['jenis']; ?></option>
            <option>WB</option>
            <option>PRC</option>
            <option>FFP</option>
            <option>LP</option>
            <option>TC</option>
            <option>AHF</option>
            <option>PD</option>
        </select></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <select name="keterangan">
        	<option><?php echo $data['keterangan']; ?></option>
            <option>Kadaluarsa</option>
            <option>Gagal Aftap</option>
            <option>Reaktif Buang</option>
            <option>Reaktif Dirujuk ke UTDP</option>
            <option>Lisis</option>
            <option>Plebotomi</option>
            <option>Lifemik</option>
            <option>Greyzone</option>
            <option>DCT Positif</option>
            <option>Kantong Bocor</option>
            <option>Satelit Rusak</option>
            <option>Bekas Pembuangan WE</option>
            <option>Hematokrit Tinggi</option>
        </select></div></td>
    <td><a href="ubah_musnah.php?ubah=<?php echo $data['id']; ?>"><img src="images/ubah.png" /></a>&nbsp;&nbsp;<a href="hapus_musnah.php?hapus=<?php echo $data['id']; ?>"><img src="images/hapus.png" /></a>&nbsp;</td>
  </tr>
  <?php
	}
	?>
</table>
<?php
	$tanggal = $_POST['tanggal'];
	$sql="select * from musnah where tanggal='$tanggal'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
?>
<p align="center"><a href="excel.php?cari=<?php echo $data['tanggal']; ?>">Export To Excel</a></p>
<BR />
</body>
</html>
