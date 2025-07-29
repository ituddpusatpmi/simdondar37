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
  <table width="100%">
    <tr>
      <td align="center"><b>LAPORAN JAGA LABORATORIUM UTD-PMI KOTA PEKANBARU</b></td>
      <td align="right"><a href="menua.php">Home <img src="images/home.png" width="20" height="20" /></a>&nbsp;<a href="logout.php">Logout<img src="images/out.png" width="30" height="30" /></a></td>
    </tr>
  </table>
<hr />
<table align="center" width="100%">
<tr>
<td colspan="2">
<?php
	$tanggal = $_POST['tanggal'];
	$shift = $_POST['shift'];	
	
	$sql="select tanggal,shift,wb_a,wb_b,wb_ab,wb_o,prc_a,prc_b,prc_ab,prc_o,ffp_a,ffp_b,ffp_ab,ffp_o,lp_a,lp_b,lp_ab,lp_o,tc_a,tc_b,tc_ab,
tc_o,ahf_a,ahf_b,ahf_ab,ahf_o,pd_a,pd_b,pd_ab,pd_o,udd_a1,udd_b1,udd_ab1,udd_o1,udd_a2,udd_b2,udd_ab2,udd_o2,udd_a3,udd_b3,udd_ab3,udd_o3,
udd_a4,udd_b4,udd_ab4,udd_o4,udd_a5,udd_b5,udd_ab5,udd_o5,udd_a6,udd_b6,udd_ab6,udd_o6,udd_a7,udd_b7,udd_ab7,udd_o7,uddl_a1,uddl_b1,uddl_ab1,
uddl_o1,uddl_a2,uddl_b2,uddl_ab2,uddl_o2,uddl_a3,uddl_b3,uddl_ab3,uddl_o3,uddl_a4,uddl_b4,uddl_ab4,uddl_o4,uddl_a5,uddl_b5,uddl_ab5,uddl_o5,
uddl_a6,uddl_b6,uddl_ab6,uddl_o6,uddl_a7,uddl_b7,uddl_ab7,uddl_o7,mu_a1,mu_b1,mu_ab1,mu_o1,mu_a2,mu_b2,mu_ab2,mu_o2,mu_a3,mu_b3,mu_ab3,mu_o3,
mu_a4,mu_b4,mu_ab4,mu_o4,mu_a5,mu_b5,mu_ab5,mu_o5,mu_a6,mu_b6,mu_ab6,mu_o6,mu_a7,mu_b7,mu_ab7,mu_o7,mu2_a1,mu2_b1,mu2_ab1,mu2_o1,mu2_a2,mu2_b2,
mu2_ab2,mu2_o2,mu2_a3,mu2_b3,mu2_ab3,mu2_o3,mu2_a4,mu2_b4,mu2_ab4,mu2_o4,mu2_a5,mu2_b5,mu2_ab5,mu2_o5,mu2_a6,mu2_b6,mu2_ab6,mu2_o6,mu2_a7,mu2_b7,mu2_ab7,
mu2_o7,bu1,bu2,gerai_a1,gerai_b1,gerai_ab1,gerai_o1,gerai_a2,gerai_b2,gerai_ab2,gerai_o2,gerai_a3,gerai_b3,gerai_ab3,gerai_o3,gerai_a4,gerai_b4,gerai_ab4,
gerai_o4,gerai_a5,gerai_b5,gerai_ab5,gerai_o5,gerai_a6,gerai_b6,gerai_ab6,gerai_o6,gerai_a7,gerai_b7,gerai_ab7,gerai_o7,catatan from stok where tanggal='$tanggal' and shift='$shift'";

	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses); 
?>
<form method="post" action="rekap_laporan2a.php">
<table align="center">
<tr>
	<td><b>STOK DARAH TERAKHIR PADA TANGGAL :&nbsp;<?php echo $data['tanggal']; ?> &nbsp;SHIFT :&nbsp;<?php echo $data['shift']; ?></b></td>
    <td width="50">&nbsp;</td>
    <td><input type="text" name="tanggal" placeholder="tahun-bulan-tanggal" id="datepicker2" />&nbsp;<select name="shift"><option>PAGI</option><option>SIANG</option><option>MALAM</option></select>&nbsp;<input type="submit" value="search" /></td>
</tr>
</table>
</form>
</td>
</tr>
<tr>
<td>
<table border="1" align="center">
  <tr bgcolor="#FF0000">
    <td colspan="6"><div align="center"><strong>KANTONG TERPAKAI</strong></div></td>
  </tr>
  <tr bgcolor="#FF0000">
    <td width="21%"><div align="center"><strong>TEMPAT</strong></div></td>
    <td width="21%"><div align="center"><strong>TIPE KANTONG</strong></div></td>
    <td width="5%"><div align="center"><strong>A</strong></div></td>
    <td width="5%"><div align="center"><strong>B</strong></div></td>
    <td width="6%"><div align="center"><strong>AB</strong></div></td>
    <td width="7%"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td rowspan="7" bgcolor="#FF0000"><div align="center"><strong>UDD-PMI</strong></div></td>
    <td bgcolor="#FF0000"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_a1']; ?>
    </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_b1']; ?>
    </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_ab1']; ?>
    </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_o1']; ?>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_a2']; ?>
    </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_b2']; ?>
    </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_ab2']; ?>
    </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_o2']; ?>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_a3']; ?>
    </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_b3']; ?>
    </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_ab3']; ?>
    </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_o3']; ?>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_a4']; ?>
    </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_b4']; ?>
    </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_ab4']; ?>
    </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['udd_o4']; ?>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_a5']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_b5']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_ab5']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_o5']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_a6']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_b6']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_ab6']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_o6']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_a7']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_b7']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_ab7']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_o7']; ?></div></td>
  </tr>
  <tr>
    <td rowspan="7" bgcolor="#FF0000"><div align="center"><strong>UDD-PMI LAIN</strong></div></td>
    <td  bgcolor="#FF0000"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a1']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b1']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab1']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o1']; ?> </div></td>
    </tr>
  <tr>
    <td  bgcolor="#FF0000"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a2']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b2']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab2']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o2']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a3']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b3']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab3']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o3']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>QUADRWOPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a4']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b4']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab4']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o4']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_a5']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_b5']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_ab5']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_o5']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_a6']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_b6']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_ab6']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_o6']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_a7']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_b7']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_ab7']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_o7']; ?></div></td>
    </tr>
  <tr>
    <td rowspan="7" bgcolor="#FF0000"><div align="center"><strong>MU / BU</strong> <strong>1</strong><br /><?php echo $data['bu1']; ?></div></td>
    <td bgcolor="#FF0000"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a1']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b1']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab1']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o1']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a2']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b2']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab2']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o2']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a3']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b3']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab3']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o3']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>QUADRWOPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o4']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_a5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_b5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_ab5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_o5']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_a6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_b6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_ab6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_o6']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_a7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_b7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_ab7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_o7']; ?></div></td>
    </tr>
  <tr>
    <td rowspan="7" bgcolor="#FF0000"><div align="center"><strong>MU / BU 2</strong><br /><?php echo $data['bu2']; ?></div></td>
    <td bgcolor="#FF0000"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a1']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b1']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab1']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o1']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a2']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b2']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab2']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o2']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a3']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b3']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab3']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o3']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>QUADRWOPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o4']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_a5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_b5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_ab5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_o5']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_a6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_b6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_ab6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_o6']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_a7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_b7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_ab7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_o7']; ?></div></td>
    </tr>
  <tr>
    <td rowspan="7" bgcolor="#FF0000"><div align="center"><strong>GERAI DONOR</strong></div></td>
    <td bgcolor="#FF0000"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a1']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b1']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab1']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o1']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a2']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b2']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab2']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o2']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a3']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b3']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab3']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o3']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a4']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b4']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab4']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o4']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_a5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_b5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_ab5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_o5']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_a6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_b6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_ab6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_o6']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_a7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_b7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_ab7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_o7']; ?></div></td>
  </tr>
</table>
</td>
</tr>
<tr align="center">
<?php
	$tanggal = $_POST['tanggal'];
	$shift = $_POST['shift'];	
	
	$sql="select petugas1,petugas2,petugas3,petugas4 from stok where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses); 
?>
<td colspan="4">Petugas 1 :&nbsp;<b><?php echo $data['petugas1']; ?></b>&nbsp;Petugas 2 :&nbsp;<b><?php echo $data['petugas2']; ?></b>&nbsp;Petugas 3 :&nbsp;<b><?php echo $data['petugas3']; ?></b>&nbsp;Petugas 4 :&nbsp;<b><?php echo $data['petugas4']; ?></b></td>
</tr>
</table>
<br />
<table border="0" align="center">
  <tr>
    <td>
    <?php
	$sql="select * from stok where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <table border="1">
  <tr>
    <td rowspan="2" bgcolor="#00FF33"><div align="center"><strong>JENIS DARAH</strong></div>      <div align="center"></div></td>
    <td colspan="4" bgcolor="#00FF33"><div align="center"><strong>STOK PADA<br />
          TANGGAL :&nbsp;<?php echo $data['tanggal']; ?><br />
          SHIFT :&nbsp;<?php echo $data['shift']; ?></strong></div></td>
    </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>A</strong></div></td>
    <td bgcolor="#00FF33"><div align="center"><strong>B</strong></div></td>
    <td bgcolor="#00FF33"><div align="center"><strong>AB</strong></div></td>
    <td bgcolor="#00FF33"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>WB</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['wb_a']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['wb_b']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['wb_ab']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['wb_o']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>PRC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['prc_a']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['prc_b']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['prc_ab']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['prc_o']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>FFP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ffp_a']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ffp_b']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ffp_ab']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ffp_o']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>LP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['lp_a']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['lp_b']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['lp_ab']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['lp_o']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>TC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['tc_a']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['tc_b']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['tc_ab']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['tc_o']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>AHF</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ahf_a']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ahf_b']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ahf_ab']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['ahf_o']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#00FF33"><div align="center"><strong>PD</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['pd_a']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['pd_b']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['pd_ab']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['pd_o']; ?></div></td>
  </tr>
</table>
</td>
    <td>&nbsp;</td>
    <td>
    <?php
		$sql="select tanggal,shift,sum(keluar_a) as jlh1,sum(keluar_b) as jlh2,sum(keluar_ab) as jlh3,sum(keluar_o) as jlh4
		,sum(keluar_a2) as jlh5,sum(keluar_b2) as jlh6,sum(keluar_ab2) as jlh7,sum(keluar_o2) as jlh8
		,sum(keluar_a3) as jlh9,sum(keluar_b3) as jlh10,sum(keluar_ab3) as jlh11,sum(keluar_o3) as jlh12
		,sum(keluar_a4) as jlh13,sum(keluar_b4) as jlh14,sum(keluar_ab4) as jlh15,sum(keluar_o4) as jlh16
		,sum(keluar_a5) as jlh17,sum(keluar_b5) as jlh18,sum(keluar_ab5) as jlh19,sum(keluar_o5) as jlh20
		,sum(keluar_a6) as jlh21,sum(keluar_b6) as jlh22,sum(keluar_ab6) as jlh23,sum(keluar_o6) as jlh24
		,sum(keluar_a7) as jlh25,sum(keluar_b7) as jlh26,sum(keluar_ab7) as jlh27,sum(keluar_o7) as jlh28 from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <table border="1">
  <tr>
    <td rowspan="2" bgcolor="#FF0000"><div align="center"><strong>JENIS DARAH</strong></div>      <div align="center"></div></td>
    <td colspan="4" bgcolor="#FF0000"><div align="center"><strong>STOK TERPAKAI</strong><br />
        <b>TANGGAL :&nbsp;<?php echo $data['tanggal']; ?></b><br />
        <b>SHIFT :&nbsp;<?php echo $data['shift']; ?></b></div></td>
    </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>A</strong></div></td>
    <td bgcolor="#FF0000"><div align="center"><strong>B</strong></div></td>
    <td bgcolor="#FF0000"><div align="center"><strong>AB</strong></div></td>
    <td bgcolor="#FF0000"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>WB</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh1']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh2']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh3']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh4']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PRC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh8']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>FFP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh9']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh10']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh11']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh12']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>LP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh13']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh14']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh15']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh16']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh17']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh18']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh19']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh20']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>AHF</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh21']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh22']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh23']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh24']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PD</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh25']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh26']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh27']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh28']; ?></div></td>
  </tr>
</table></td>
    <td>&nbsp;</td>
    <td>
    <?php
		$sql="select tanggal,shift,sum(kembali_a) as jlh1,sum(kembali_b) as jlh2,sum(kembali_ab) as jlh3,sum(kembali_o) as jlh4
		,sum(kembali_a2) as jlh5,sum(kembali_b2) as jlh6,sum(kembali_ab2) as jlh7,sum(kembali_o2) as jlh8
		,sum(kembali_a3) as jlh9,sum(kembali_b3) as jlh10,sum(kembali_ab3) as jlh11,sum(kembali_o3) as jlh12
		,sum(kembali_a4) as jlh13,sum(kembali_b4) as jlh14,sum(kembali_ab4) as jlh15,sum(kembali_o4) as jlh16
		,sum(kembali_a5) as jlh17,sum(kembali_b5) as jlh18,sum(kembali_ab5) as jlh19,sum(kembali_o5) as jlh20
		,sum(kembali_a6) as jlh21,sum(kembali_b6) as jlh22,sum(kembali_ab6) as jlh23,sum(kembali_o6) as jlh24
		,sum(kembali_a7) as jlh25,sum(kembali_b7) as jlh26,sum(kembali_ab7) as jlh27,sum(kembali_o7) as jlh28 from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <table border="1">
  <tr>
    <td rowspan="2" bgcolor="#FFA072"><div align="center"><strong>JENIS DARAH</strong></div>      <div align="center"></div></td>
    <td colspan="4" bgcolor="#FFA072"><div align="center"><strong>DARAH KEMBALI<br />
      TANGGAL : <?php echo $data['tanggal']; ?><br />
      SHIFT : <?php echo $data['shift']; ?></strong></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>A</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>B</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>AB</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh1']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh2']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh3']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh4']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh8']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh9']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh10']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh11']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh12']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh13']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh14']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh15']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh16']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh17']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh18']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh19']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh20']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh21']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh22']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh23']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh24']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh25']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh26']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh27']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jlh28']; ?></div></td>
  </tr>
</table></td>
  <td>&nbsp;</td>
  <td>
  <?php
		$sql="select * from musnah where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
  <table border="1">
  <tr>
    <td rowspan="2" bgcolor="#FF0000"><div align="center"><strong>JENIS DARAH</strong></div></td>
    <td colspan="4" bgcolor="#FF0000"><div align="center"><strong>PEMUSNAHAN DARAH<br />TANGGAL : <?php echo $data['tanggal']; ?><br />SHIFT : <?php echo $data['shift']; ?></strong></div></td>
    </tr>
  <tr bgcolor="#FF0000">
    <td><div align="center"><strong>A</strong></div></td>
    <td><div align="center"><strong>B</strong></div></td>
    <td><div align="center"><strong>AB</strong></div></td>
    <td><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>WB</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PRC</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>FFP</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>LP</strong></div></td>
     <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>TC</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>AHF</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center"><strong>PD</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses); 
	?>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
  </tr>
</table>

  </td>
  </tr>
</table>
<table align="center">
        <tr>
          <?php
			$sql="select sum(wb_a+wb_b+wb_ab+wb_o+prc_a+prc_b+prc_ab+prc_o+ffp_a+ffp_b+ffp_ab+ffp_o+lp_a+lp_b+lp_ab+lp_o+tc_a+tc_b+tc_ab+tc_o+ahf_a+ahf_b+ahf_ab+ahf_o+pd_a+pd_b+pd_ab+pd_o) as jumlah from stok where tanggal='$tanggal' and shift='$shift'";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
          <td><strong>* PERSEDIAAN DARAH KESELURUHAN</strong></td>
          <td>:</td>
          <td><?php echo $data['jumlah']; ?></td>
          </tr>
        <tr>
          <?php
			$sql="select sum(keluar_a+keluar_b+keluar_ab+keluar_o+keluar_a2+keluar_b2+keluar_ab2+keluar_o2+keluar_a3+keluar_b3+keluar_ab3+keluar_o3+keluar_a4+keluar_b4+keluar_ab4+keluar_o4+keluar_a5+keluar_b5+keluar_ab5+keluar_o5+keluar_a6+keluar_b6+keluar_ab6+keluar_o6+keluar_a7+keluar_b7+keluar_ab7+keluar_o7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
          <td><strong>* PENGELUARAN (Pasien / BDRS)</strong></td>
          <td>:</td>
          <td><?php echo $data['jumlah']; ?></td>
          </tr>
          <tr>
          <?php
		$tanggal = $_POST['tanggal'];
		$shift = $_POST['shift'];
		
			$sql="select count(kantong) as jumlah from musnah where tanggal='$tanggal' and shift='$shift'";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
          <td><strong>* PENGELUARAN (Pemusnahan)</strong></td>
          <td>:</td>
          <td><?php echo $data['jumlah']; ?></td>
          </tr>
      </table>
<br />
</body>
</html>