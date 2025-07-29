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
<script type="text/javascript">
	function butuh(){
		var nilai=document.forms['required']['shift'].value;
		if(nilai==null || nilai==""){
			alert('Shift tidak boleh kosong !');
			return false;
		}
	}
</script>
<script src="delJsMick.txt"></script>
<script type="text/javascript">
	window.setTimeout("waktu()",1000);
	function waktu(){
	var tanggal=new Date();
	setTimeout("waktu()",1000);
	document.getElementById("tanggalku").innerHTML=tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();}
</script>
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
    <script>
	$(function() {
		$( "#datepicker2" ).datepicker();
		$("#datepicker2").change(function(){
			$("#datepicker2").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker3" ).datepicker();
		$("#datepicker3").change(function(){
			$("#datepicker3").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
	<script>
	$(function() {
		$( "#datepicker4" ).datepicker();
		$("#datepicker4").change(function(){
			$("#datepicker4").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>    
    <script>
	$(function() {
		$( "#datepicker5" ).datepicker();
		$("#datepicker5").change(function(){
			$("#datepicker5").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker6" ).datepicker();
		$("#datepicker6").change(function(){
			$("#datepicker6").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker7" ).datepicker();
		$("#datepicker7").change(function(){
			$("#datepicker7").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker8" ).datepicker();
		$("#datepicker8").change(function(){
			$("#datepicker8").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker9" ).datepicker();
		$("#datepicker9").change(function(){
			$("#datepicker9").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker10" ).datepicker();
		$("#datepicker10").change(function(){
			$("#datepicker10").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker11" ).datepicker();
		$("#datepicker11").change(function(){
			$("#datepicker11").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker12" ).datepicker();
		$("#datepicker12").change(function(){
			$("#datepicker12").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker13" ).datepicker();
		$("#datepicker13").change(function(){
			$("#datepicker13").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    
     <script>
	$(function() {
		$( "#datepicker14" ).datepicker();
		$("#datepicker14").change(function(){
			$("#datepicker14").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker15" ).datepicker();
		$("#datepicker15").change(function(){
			$("#datepicker15").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker16" ).datepicker();
		$("#datepicker16").change(function(){
			$("#datepicker16").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker17" ).datepicker();
		$("#datepicker17").change(function(){
			$("#datepicker17").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker18" ).datepicker();
		$("#datepicker18").change(function(){
			$("#datepicker18").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker19" ).datepicker();
		$("#datepicker19").change(function(){
			$("#datepicker19").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker20" ).datepicker();
		$("#datepicker20").change(function(){
			$("#datepicker20").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker21" ).datepicker();
		$("#datepicker21").change(function(){
			$("#datepicker21").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker22" ).datepicker();
		$("#datepicker22").change(function(){
			$("#datepicker22").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker23" ).datepicker();
		$("#datepicker23").change(function(){
			$("#datepicker23").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker24" ).datepicker();
		$("#datepicker24").change(function(){
			$("#datepicker24").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
    <script>
	$(function() {
		$( "#datepicker25" ).datepicker();
		$("#datepicker25").change(function(){
			$("#datepicker25").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
     <script>
	$(function() {
		$( "#datepicker26" ).datepicker();
		$("#datepicker26").change(function(){
			$("#datepicker26").datepicker("option","dateFormat","yy-mm-dd");
			});
	});
	</script>
     <script>
	$(function() {
		$( "#datepicker27" ).datepicker();
		$("#datepicker27").change(function(){
			$("#datepicker27").datepicker("option","dateFormat","yy-mm-dd");
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
<table align="center" width="100%">
<tr>
<td colspan="3">
<?php
	$sql="select tanggal,shift from stok group by id desc";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses); 
?>
<table width="888" align="center">
<tr>
	<td width="799" align="center" bgcolor="#CCFF33"><b><marquee behavior="alternate">STOK DARAH TERAKHIR PADA TANGGAL :&nbsp;<?php echo $data['tanggal']; ?> SHIFT :&nbsp;<?php echo $data['shift']; ?></marquee></b></td><td width="77">&nbsp;<a href="logout.php">Logout<img src="images/out.png" width="30" height="30" /></a></td>
</tr>
</table>
<form method="post" action="rekap_laporan2.php">
<table align="center">
<tr>
    <td width="350" valign="top" align="right"><input type="text" name="tanggal" placeholder="tahun-bulan-tanggal" id="datepicker" />&nbsp;<select name="shift"><option>Pilih Shift</option><option>PAGI</option><option>SIANG</option><option>MALAM</option></select>&nbsp;<input type="submit" value="search" /> <a href="home.php"><img src="images/AG00334_.gif" width="25" height="25"  /></a></td>
</tr>
</table>
</form>
</td>
</tr>
<tr>
<td width="30%"><div align="center"></div></td>
<td width="37%">
<table border="1" align="center">
  <tr bgcolor="#FFA072">
    <td width="12%" rowspan="2"><div align="center"><strong>JENIS STOK</strong></div></td>
    <td colspan="4"><div align="center"><strong>STOK DARAH</strong></div></td>
    </tr>
  <tr bgcolor="#FFA072">
    <td width="5%"><div align="center"><strong>A</strong></div></td>
    <td width="5%"><div align="center"><strong>B</strong></div></td>
    <td width="6%"><div align="center"><strong>AB</strong></div></td>
    <td width="7%"><div align="center"><strong>O</strong></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select wb_a as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
	<?php
		$sql="select wb_b as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select wb_ab as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select wb_o as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select prc_a as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select prc_b as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select prc_ab as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select prc_o as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select ffp_a as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select ffp_b as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select ffp_ab as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ffp_o as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select lp_a as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select lp_b as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select lp_ab as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select lp_o as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select tc_a as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select tc_b as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select tc_ab as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select tc_o as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select ahf_a as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select ahf_b as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select ahf_ab as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ahf_o as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select pd_a as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select pd_b as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
    <?php
		$sql="select pd_ab as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select pd_o as jumlah from stok order by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <?php echo $data['jumlah']; ?>
    </div></td>
    </tr>
</table>
</td>
<td width="33%"><div align="center"></div></td>
</tr>
<?php
	$sql="select petugas1,petugas2,petugas3,petugas4 from stok order by id desc";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
?>
<tr align="center">
<td height="45" colspan="4">Petugas 1 :&nbsp;<b><?php echo $data['petugas1']; ?></b>&nbsp;Petugas 2 :&nbsp;<b><?php echo $data['petugas2']; ?></b>&nbsp;Petugas 3 :&nbsp;<b><?php echo $data['petugas3']; ?></b>&nbsp;Petugas 4 :&nbsp;<b><?php echo $data['petugas4']; ?></b></td>
</tr>
</table>
<br />
<table width="100%">
<tr>
	<td><b>LAPORAN JAGA LABORATORIUM UTD-PMI KOTA PEKANBARU</b></td>
    <form method="post" action="rekap_laporan.php">
    <td align="right">Tanggal :
      <input type="text" name="tanggal" placeholder="tahun-bulan-tanggal" id="datepicker3" />
      <select name="shift"><option>Pilih Shift</option><option>PAGI</option><option>SIANG</option><option>MALAM</option></select>&nbsp;<input type="submit" value="search" /> <a href="home.php"><img src="images/AG00334_.gif" width="25" height="25"  /></a></td>
    </form>
</tr>
<!--
<tr>
	<form method="post" action="lttd4.php">
	<td align="right" bgcolor="#00FFFF" colspan="2">Rekap LTTD IV Bulan : <input type="text" name="" placeholder="thn-bln-tgl" size="10" id="datepicker26" />sampai<input type="text" name="" placeholder="thn-bln-tgl" size="10" id="datepicker27" />
    												<input type="submit" value="search" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    </form>
</tr>
-->
</table>
<hr>
<?php
	$tgl=date('Y-m-d');
?>
<form method="post" action="proses.php" onsubmit="return butuh()" name="required" onkeypress="return event.keyCode != 13;">
<p align="center"><b>TANGGAL :</b>&nbsp;<input type="text" name="tanggal" value="<?php echo $tgl; ?>" id="datepicker4" />&nbsp;<b>SHIFT :</b>&nbsp;
											<select name="shift">
											<option></option>
                                            <option>PAGI</option>
                                            <option>SIANG</option>
                                            <option>MALAM</option>
                                            </select><font color="#FF0000">* wajib diisi</font></p>
<p align="center"><strong>Data Crossmatch</strong></p>
<table border="1" align="center">
  <tr bgcolor="#FFA072">
    <td width="111" rowspan="2"><div align="center"><strong>TANGGAL FORMULIR</strong></div></td>
    <td width="108" rowspan="2"><div align="center"><strong>NO FORMULIR</strong></div></td>
    <td width="127" rowspan="2"><div align="center"><strong>JENIS</strong></div></td>
    <td colspan="4"><div align="center"><strong>DARAH KEMBALI</strong></div></td>
    <td colspan="4"><div align="center"><strong>DARAH KELUAR</strong></div></td>
    <td width="106" rowspan="2"><div align="center"><strong>PETUGAS</strong></div></td>
    <td width="107" rowspan="2"><div align="center"><strong>KETERANGAN</strong></div></td>
  </tr>
  <tr bgcolor="#FFA072">
    <td width="31"><div align="center"><strong>A</strong></div></td>
    <td width="31"><div align="center"><strong>B</strong></div></td>
    <td width="53"><div align="center"><strong>AB</strong></div></td>
    <td width="32"><div align="center"><strong>O</strong></div></td>
    <td width="27"><div align="center"><strong>A</strong></div></td>
    <td width="27"><div align="center"><strong>B</strong></div></td>
    <td width="50"><div align="center"><strong>AB</strong></div></td>
    <td width="31"><div align="center"><strong>O</strong></div></td>
    </tr>
  <tr bgcolor="#CCCCCC">
    <td width="111" rowspan="7" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="tgl_form" placeholder="thn-bln-tgl" id="datepicker2" size="10" />
    </div></td>
    <td width="108" rowspan="7" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="formulir" placeholder="No / TglBlnThn" />
    </div></td>
    <td><div align="center"><strong>WB</strong></div></td>
    <td><div align="center">
      <input type="text" name="kembali_a" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_b" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_ab" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_o" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_a" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_b" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_ab" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_o" size="1" />
    </div></td>
    <td rowspan="7"><div align="center">
      <select name="petugas">
        <option>...</option>
        <?php
				$tampil="select * from pegawai group by nama";
				$proses=mysql_query($tampil);
				while($data=mysql_fetch_array($proses))
				{
				echo "<option>".$data['nama']."</option>";
				}
		?>
      </select>
    </div></td>
    <td rowspan="7"><div align="center">
      <select name="keterangan">
    		<option>...</option>
            <option>BPJS</option>
            <option>Non BPJS</option>
            <option>Klaim</option>
            <option>BDRS</option>
      </select>
    </div></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>PRC</strong></div></td>
    <td><div align="center">
      <input type="text" name="kembali_a2" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_b2" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_ab2" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_o2" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_a2" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_b2" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_ab2" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_o2" size="1" />
    </div></td>
    </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>FFP</strong></div></td>
    <td><div align="center">
      <input type="text" name="kembali_a3" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_b3" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_ab3" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_o3" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_a3" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_b3" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_ab3" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_o3" size="1" />
    </div></td>
    </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>LP</strong></div></td>
    <td><div align="center">
      <input type="text" name="kembali_a4" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_b4" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_ab4" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_o4" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_a4" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_b4" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_ab4" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_o4" size="1" />
    </div></td>
    </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>TC</strong></div></td>
    <td><div align="center">
      <input type="text" name="kembali_a5" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_b5" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_ab5" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_o5" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_a5" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_b5" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_ab5" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_o5" size="1" />
    </div></td>
    </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>AHF</strong></div></td>
    <td><div align="center">
      <input type="text" name="kembali_a6" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_b6" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_ab6" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_o6" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_a6" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_b6" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_ab6" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_o6" size="1" />
    </div></td>
    </tr>
  <tr bgcolor="#CCCCCC">
    <td><div align="center"><strong>PD</strong></div></td>
    <td><div align="center">
      <input type="text" name="kembali_a7" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_b7" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_ab7" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="kembali_o7" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_a7" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_b7" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_ab7" size="1" />
    </div></td>
    <td><div align="center">
      <input type="text" name="keluar_o7" size="1" />
    </div></td>
    </tr>
</table>
<table align="center">
<tr><td><input type="submit" name="submit" value="Submit" />  <a href="home.php"><img src="images/AG00334_.gif" width="25" height="25"  /></a></td></tr>
</table>
</form>
<hr />
<form method="post" action="rekap_laporan3.php">
<p align="center"><strong>PEMUSNAHAN DARAH</strong></p>
<p align="center">Tanggal : <input type="text" name="tanggal" id="datepicker5" placeholder="tahun-bulan-tanggal" />&nbsp;<select name="shift">
															<option>Pilih Shift</option>
                                                            <option>PAGI</option>
                                                            <option>SIANG</option>
                                                            <option>MALAM</option>
                                                            </select>&nbsp;
                   <input type="submit" value="Search" /></p>
</form>
<form method="post" action="submit.php">
<p align="center"><strong>Jumlah Darah yang Mau Dimusnahkan : </strong><input type="text" name="jum" size="5">&nbsp;<select name="shift">
																													<option>Pilih Shift</option>
                                                                                                                    <option>PAGI</option>
                                                                                                                    <option>SIANG</option>
                                                                                                                    <option>MALAM</option>
                                                                                                                    </select>
                                                                                                                    <select name="jenis">
                                                                                                                    <option>Pilih Jenis</option>
                                                                                                                    <option>WB</option>
                                                                                                                    <option>PRC</option>
                                                                                                                    <option>FFP</option>
                                                                                                                    <option>LP</option>
                                                                                                                    <option>TC</option>
                                                                                                                    <option>AHF</option>
                                                                                                                    <option>PD</option>
                                                                                                                    </select>
<input type="submit" name="submit" value="Submit"></p>
</form>
<br />
</body>
</html>
