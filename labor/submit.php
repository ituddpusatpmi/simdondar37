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
<br />
<p align="center"><a href="home.php"><img src="images/home.png" width="25" height="25" />&nbsp;Home</a></p>
<form method="post" action="musnah.php">
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
  </tr>
  <?php
$tgl=date('Y-m-d');
$shift = $_POST['shift'];
$jenis = $_POST['jenis'];
$n = $_POST['jum']; // membaca jumlah data

for ($i=1; $i<=$n; $i++)
{
  echo "<tr><td>".$i."</td><td><input type='text' name='tanggal".$i."' value='".$tgl."' size='8'> <select name='shift".$i."'><option>".$shift."</option><option>PAGI</option><option>SIANG</option><option>MALAM</option></select></td><td align='center'><input type='text' name='tgl_aftap".$i."' id='datepicker".$i."' value='".$tgl."' size='8'></td><td><input type='text' name='kantong".$i."' placeholder='No Kantong'></td><td align='center'><select name='gol".$i."'><option></option><option>A</option><option>B</option><option>AB</option><option>O</option></select></td><td align='center'><select name='rhesus".$i."'><option></option><option>(+)</option><option>(-)</option></select></td><td align='center'><select name='jenis".$i."'><option>".$jenis."</option><option>WB</option><option>PRC</option><option>FFP</option><option>LP</option><option>TC</option><option>AHF</option><option>PD</option></select></td><td><select name='keterangan".$i."'><option></option><option>Kadaluarsa</option><option>Gagal Aftap</option><option>Reaktif Buang</option><option>Reaktif Dirujuk ke UTDP</option><option>Lisis</option><option>Plebotomi</option><option>Lifemik</option><option>Greyzone</option><option>DCT Positif</option><option>Kantong Bocor</option><option>Satelit Rusak</option><option>Bekas Pembuangan WE</option><option>Hematokrit Tinggi</option></select></td></tr>";
}
?>
</table>
<input type="hidden" name="jum" value="<?php echo $n; ?>">
<p align="center"><input type="submit" name="submit" value="Submit"></p>
</form>
<br />
</body>
</html>