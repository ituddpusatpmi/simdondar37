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
      <td align="right"><a href="home.php">Home <img src="images/home.png" width="20" height="20" /></a>&nbsp;<a href="logout.php">Logout<img src="images/out.png" width="30" height="30" /></a></td>
    </tr>
  </table>
<hr />
<table align="center" width="100%" bgcolor="#CCCCCC">
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
<form method="post" action="rekap_laporan2.php">
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
<table width="100%" border="1" align="center">
  <tr bgcolor="#FFA072">
    <td width="12%" rowspan="2"><div align="center"><strong>JENIS STOK</strong></div></td>
    <td colspan="4"><div align="center"><strong>STOK DARAH</strong></div></td>
    <td colspan="6"><div align="center"><strong>KANTONG TERPAKAI</strong></div></td>
  </tr>
  <tr bgcolor="#FFA072">
    <td width="5%"><div align="center"><strong>A</strong></div></td>
    <td width="5%"><div align="center"><strong>B</strong></div></td>
    <td width="6%"><div align="center"><strong>AB</strong></div></td>
    <td width="7%"><div align="center"><strong>O</strong></div></td>
    <td width="21%"><div align="center"><strong>TEMPAT</strong></div></td>
    <td width="21%"><div align="center"><strong>TIPE KANTONG</strong></div></td>
    <td width="5%"><div align="center"><strong>A</strong></div></td>
    <td width="5%"><div align="center"><strong>B</strong></div></td>
    <td width="6%"><div align="center"><strong>AB</strong></div></td>
    <td width="7%"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['wb_a']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['wb_b']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['wb_ab']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['wb_o']; ?>
    </div></td>
    <td rowspan="7" bgcolor="#FFA072"><div align="center"><strong>UDD-PMI</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>SINGLE</strong></div></td>
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
    <td bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['prc_a']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['prc_b']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['prc_ab']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['prc_o']; ?>
    </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>DOUBLE</strong></div></td>
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
    <td bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ffp_a']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ffp_b']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ffp_ab']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ffp_o']; ?>
    </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>TRIPLE</strong></div></td>
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
    <td bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['lp_a']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['lp_b']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['lp_ab']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['lp_o']; ?>
    </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>QUADROWPLE</strong></div></td>
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
    <td bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['tc_a']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['tc_b']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['tc_ab']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['tc_o']; ?>
    </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_a5']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_b5']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_ab5']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_o5']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ahf_a']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ahf_b']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ahf_ab']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['ahf_o']; ?>
    </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_a6']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_b6']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_ab6']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_o6']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['pd_a']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['pd_b']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['pd_ab']; ?>
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php echo $data['pd_o']; ?>
    </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_a7']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_b7']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_ab7']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['udd_o7']; ?></div></td>
  </tr>
  <tr>
    <td colspan="5" rowspan="28" bgcolor="#FFA072" valign="top"><strong>Catatan :</strong><br /><?php echo $data['catatan']; ?></td>
    <td rowspan="7" bgcolor="#FFA072"><div align="center"><strong>UDD-PMI LAIN</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a1']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b1']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab1']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o1']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a2']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b2']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab2']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o2']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a3']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b3']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab3']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o3']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>QUADRWOPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_a4']; ?> </div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_b4']; ?> </div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_ab4']; ?> </div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['uddl_o4']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_a5']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_b5']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_ab5']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_o5']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_a6']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_b6']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_ab6']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_o6']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_a7']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_b7']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_ab7']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"><?php echo $data['uddl_o7']; ?></div></td>
    </tr>
  <tr>
    <td rowspan="7" bgcolor="#FFA072"><div align="center"><strong>MU / BU</strong> <strong>1</strong><br /><?php echo $data['bu1']; ?></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a1']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b1']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab1']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o1']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a2']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b2']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab2']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o2']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a3']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b3']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab3']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o3']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>QUADRWOPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_a4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_b4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_ab4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu_o4']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_a5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_b5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_ab5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_o5']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_a6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_b6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_ab6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_o6']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_a7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_b7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_ab7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu_o7']; ?></div></td>
    </tr>
  <tr>
    <td rowspan="7" bgcolor="#FFA072"><div align="center"><strong>MU / BU 2</strong><br /><?php echo $data['bu2']; ?></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a1']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b1']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab1']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o1']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a2']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b2']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab2']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o2']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a3']; ?></div></td>
    <td width="5%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b3']; ?></div></td>
    <td width="6%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab3']; ?></div></td>
    <td width="7%" bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o3']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>QUADRWOPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_a4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_b4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_ab4']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['mu2_o4']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_a5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_b5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_ab5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_o5']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_a6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_b6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_ab6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_o6']; ?></div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_a7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_b7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_ab7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['mu2_o7']; ?></div></td>
    </tr>
  <tr>
    <td rowspan="7" bgcolor="#FFA072"><div align="center"><strong>GERAI DONOR</strong></div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a1']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b1']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab1']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o1']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a2']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b2']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab2']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o2']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a3']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b3']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab3']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o3']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_a4']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_b4']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_ab4']; ?> </div></td>
    <td bgcolor="#CCCCCC"><div align="center"> <?php echo $data['gerai_o4']; ?> </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_a5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_b5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_ab5']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_o5']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_a6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_b6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_ab6']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_o6']; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_a7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_b7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_ab7']; ?></div></td>
    <td bgcolor="#CCCCCC"><div align="center"><?php echo $data['gerai_o7']; ?></div></td>
  </tr>
</table>
</td>
<td>
<table align="center">
	<tr>
    	<?php
		
			$sql="select sum(wb_a+wb_b+wb_ab+wb_o+prc_a+prc_b+prc_ab+prc_o+ffp_a+ffp_b+ffp_ab+ffp_o+lp_a+lp_b+lp_ab+lp_o+tc_a+tc_b+tc_ab+tc_o+ahf_a+ahf_b+ahf_ab+ahf_o+pd_a+pd_b+pd_ab+pd_o) as jumlah from stok where tanggal='$tanggal' and shift='$shift'";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
    	<td>* PERSEDIAAN DARAH KESELURUHAN</td><td>:</td><td><?php echo $data['jumlah']; ?></td>
    </tr>
    <tr>
    	<?php
		$tanggal = $_POST['tanggal'];
		$shift = $_POST['shift'];
		
			$sql="select sum(keluar_a+keluar_b+keluar_ab+keluar_o+keluar_a2+keluar_b2+keluar_ab2+keluar_o2+keluar_a3+keluar_b3+keluar_ab3+keluar_o3+keluar_a4+keluar_b4+keluar_ab4+keluar_o4+keluar_a5+keluar_b5+keluar_ab5+keluar_o5+keluar_a6+keluar_b6+keluar_ab6+keluar_o6+keluar_a7+keluar_b7+keluar_ab7+keluar_o7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
    	<td>* PENGELUARAN (Pasien / BDRS)</td><td>:</td><td><?php echo $data['jumlah']; ?></td>
    </tr>
    <tr>
    <?php
		$tanggal = $_POST['tanggal'];
		$shift = $_POST['shift'];
		
			$sql="select count(kantong) as jumlah from musnah where tanggal='$tanggal' and shift='$shift'";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
    	<td>* PENGELUARAN (Pemusnahan)</td><td>:</td>
        <td><?php echo $data['jumlah']; ?></td>
    </tr>
    <tr>
    	<?php
		$tanggal = $_POST['tanggal'];
		$shift = $_POST['shift'];
		
			$sql="select * from stok where tanggal='$tanggal' and shift='$shift'";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
    	<td align="center" colspan="3">Klik Reset Untuk Input Ulang Jika Terjadi Kesalahan</td>
    </tr>
    <tr>
    	<td align="center" colspan="3"><a href="hapus_stok.php?hapus=<?php echo $data['id']; ?>"><font color="red"><strong>RESET</strong></font></a></td>
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
<br /><br />
<br /><br />
<form name="required" method="post" action="proses.php" onsubmit="return butuh()" onkeypress="return event.keyCode != 13;">
<p><b>TANGGAL :</b>&nbsp;<input type="text" name="tanggal" value="<?php echo $tanggal; ?>" id="datepicker4" />&nbsp;<b>SHIFT :</b>&nbsp;
											<select name="shift">
											<option></option>
                                            <option>PAGI</option>
                                            <option>SIANG</option>
                                            <option>MALAM</option>
                                            </select><font color="#FF0000">* wajib diisi</font></p>
<table align="center" width="100%">
<tr>
<td width="70%">
<table width="100%" border="1">
  <tr bgcolor="#FFA072">
    <td width="17%" rowspan="2"><div align="center"><strong>JENIS STOK</strong></div></td>
    <?php
	$sql="select tanggal,shift from stok group by id desc";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses); 
	?>
    <td colspan="4"><div align="center"><strong>STOK TERAKHIR</strong><br /><b>TANGGAL :&nbsp;<?php echo $data['tanggal']; ?></b><br /><b>SHIFT :&nbsp;<?php echo $data['shift']; ?></b></div></td>
    <td width="17%" rowspan="2"><div align="center"><strong>JENIS STOK</strong></div></td>
    <?php
	$sql="select tanggal,shift from laporan where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses); 
	?>
    <td colspan="4"><div align="center"><strong>STOK TERPAKAI</strong><br /><b>TANGGAL :&nbsp;<?php echo $data['tanggal']; ?></b><br /><b>SHIFT :&nbsp;<?php echo $data['shift']; ?></b></div></td>
    <td colspan="6" bgcolor="#CCFF33"><div align="center"><strong>KANTONG MASUK</strong></div></td>
    </tr>
  <tr bgcolor="#FFA072">
    <td width="17%"><div align="center"><strong>A</strong></div></td>
    <td width="17%"><div align="center"><strong>B</strong></div></td>
    <td width="17%"><div align="center"><strong>AB</strong></div></td>
    <td width="17%"><div align="center"><strong>O</strong></div></td>
    <td width="9%"><div align="center"><strong>A</strong></div></td>
    <td width="9%"><div align="center"><strong>B</strong></div></td>
    <td width="9%"><div align="center"><strong>AB</strong></div></td>
    <td width="8%"><div align="center"><strong>O</strong></div></td>
    <td width="13%" bgcolor="#CCFF33"><div align="center"><strong>TEMPAT</strong></div></td>
    <td width="9%" bgcolor="#CCFF33"><div align="center"><strong>TIPE KANTONG</strong></div></td>
    <td width="9%" bgcolor="#CCFF33"><div align="center"><strong>A</strong></div></td>
    <td width="8%" bgcolor="#CCFF33"><div align="center"><strong>B</strong></div></td>
    <td width="9%" bgcolor="#CCFF33"><div align="center"><strong>AB</strong></div></td>
    <td width="9%" bgcolor="#CCFF33"><div align="center"><strong>O</strong></div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select wb_a as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="wba" size="1" value="<?php echo $data['jumlah']; ?>" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select wb_b as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="wbb" value="<?php echo $data['jumlah']; ?>"  size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select wb_ab as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="wbab" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select wb_o as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="wbo" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <?php
		$sql="select sum(keluar_a) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select sum(keluar_b) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai2" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai3" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai4" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <td rowspan="7" bgcolor="#CCFF33"><div align="center"><strong>UDD-PMI</strong> <strong>PEKANBARU</strong></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_a1" size="5" />
    </div></td>
    <td width="8%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_b1" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_ab1" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_o1" size="5" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select prc_a as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="prca" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select prc_b as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="prcb" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select prc_ab as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="prcab" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select prc_o as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="prco" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <?php
		$sql="select sum(keluar_a2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai5" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai6" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai7" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai8" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_a2" size="5" />
    </div></td>
    <td width="8%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_b2" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_ab2" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_o2" size="5" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ffp_a as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ffpa" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ffp_b as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ffpb" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ffp_ab as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ffpab" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ffp_o as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ffpo" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <?php
		$sql="select sum(keluar_a3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai9" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai10" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai11" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai12" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_a3" size="5" />
    </div></td>
    <td width="8%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_b3" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_ab3" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_o3" size="5" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select lp_a as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="lpa" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select lp_b as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="lpb" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select lp_ab as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="lpab" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select lp_o as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="lpo" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <?php
		$sql="select sum(keluar_a4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai13" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai14" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai15" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai16" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_a4" size="5" />
    </div></td>
    <td width="8%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_b4" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_ab4" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_o4" size="5" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select tc_a as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="tca" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select tc_b as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="tcb" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select tc_ab as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="tcab" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select tc_o as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="tco" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <?php
		$sql="select sum(keluar_a5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai17" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai18" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai19" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai20" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_a5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_b5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_ab5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_o5" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ahf_a as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ahfa" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ahf_b as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ahfb" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ahf_ab as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ahfab" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select ahf_o as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="ahfo" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <?php
		$sql="select sum(keluar_a6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai21" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai22" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai23" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai24" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_a6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_b6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_ab6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_o6" size="5" />
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select pd_a as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="pda" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select pd_b as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="pdb" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select pd_ab as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="pdab" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <?php
		$sql="select pd_o as jumlah from stok group by id desc";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
      <input type="text" name="pdo" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /> </div></td>
    <td bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <?php
		$sql="select sum(keluar_a7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai25" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_b7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai26" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_ab7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai27" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select sum(keluar_o7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pakai28" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_a7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_b7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_ab7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="udd_o7" size="5" />
    </div></td>
    </tr>
  <tr>
    <td colspan="5" valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td colspan="5" valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td rowspan="7" bgcolor="#CCFF33"><div align="center"><strong>UDD-PMI LAIN</strong></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_a1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_b1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_ab1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_o1" size="5" />
    </div></td>
  </tr>
  <tr>
    <td width="17%" rowspan="4" bgcolor="#CCFF33"><div align="center"><strong>JENIS STOK</strong></div></td>
    <td colspan="4" rowspan="3" bgcolor="#CCFF33"><div align="center"><strong>JENIS DARAH MASUK</strong></div></td>
    <td rowspan="4" valign="center" bgcolor="#FFA072"><div align="center"><strong>JENIS STOK</strong></div></td>
    <?php
	$sql="select tanggal,shift from laporan where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses); 
	?>
    <td colspan="4" rowspan="3" valign="center" bgcolor="#FFA072"><div align="center"><strong>DARAH KEMBALI<br />TANGGAL : <?php echo $data['tanggal']; ?><br />SHIFT : <?php echo $data['shift']; ?></strong></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_a2" size="5" />
      </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_b2" size="5" />
      </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_ab2" size="5" />
      </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_o2" size="5" />
      </div></td>
  </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_a3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_b3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_ab3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_o3" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_a4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_b4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_ab4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_o4" size="5" />
    </div></td>
    </tr>
  <tr>
    <td width="17%" bgcolor="#CCFF33"><div align="center"><strong>A</strong></div></td>
    <td width="17%" bgcolor="#CCFF33"><div align="center"><strong>B</strong></div></td>
    <td width="17%" bgcolor="#CCFF33"><div align="center"><strong>AB</strong></div></td>
    <td width="17%" bgcolor="#CCFF33"><div align="center"><strong>O</strong></div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>A</strong></div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>B</strong></div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>AB</strong></div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>O</strong></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_a5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_b5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_ab5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_o5" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>WB</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="wb_a" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="wb_b" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="wb_ab" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="wb_o" size="5" />
    </div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <?php
		$sql="select sum(kembali_a) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_b) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_ab) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_o) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_a6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_b6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_ab6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_o6" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>PRC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="prc_a" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="prc_b" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="prc_ab" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="prc_o" size="5" />
    </div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <?php
		$sql="select sum(kembali_a2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_b2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_ab2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_o2) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_a7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_b7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_ab7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="uddl_o7" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>FFP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ffp_a" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ffp_b" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ffp_ab" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ffp_o" size="5" />
    </div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <?php
		$sql="select sum(kembali_a3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_b3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_ab3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_o3) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <td rowspan="7" bgcolor="#CCFF33"><div align="center"><strong>MU-BU</strong> <strong>1</strong><br /><input type="text" name="bu1" placeholder="Mobile Unit" /></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_a1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_b1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_ab1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_o1" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>LP</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="lp_a" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="lp_b" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="lp_ab" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="lp_o" size="5" />
    </div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <?php
		$sql="select sum(kembali_a4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_b4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_ab4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_o4) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_a2" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_b2" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_ab2" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_o2" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>TC</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="tc_a" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="tc_b" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="tc_ab" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="tc_o" size="5" />
    </div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <?php
		$sql="select sum(kembali_a5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_b5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_ab5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_o5) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_a3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_b3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_ab3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_o3" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>AHF</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ahf_a" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ahf_b" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ahf_ab" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="ahf_o" size="5" />
    </div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <?php
		$sql="select sum(kembali_a6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_b6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_ab6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_o6) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_a4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_b4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_ab4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_o4" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>PD</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pd_a" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pd_b" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pd_ab" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="pd_o" size="5" />
    </div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <?php
		$sql="select sum(kembali_a7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_b7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_ab7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <?php
		$sql="select sum(kembali_o7) as jumlah from laporan where tanggal='$tanggal' and shift='$shift'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#CCCCCC"><div align="center"><?php echo $data['jumlah']; ?></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_a5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_b5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_ab5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_o5" size="5" />
    </div></td>
    </tr>
  <tr>
    <td colspan="4" rowspan="11" valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td rowspan="3" valign="center" bgcolor="#FFA072"><div align="center"><strong>JENIS DARAH</strong></div></td>
    <?php
	$sql="select tanggal,shift from musnah where tanggal='$tanggal' and shift='$shift'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses); 
	?>
    <td colspan="5" rowspan="2" valign="center" bgcolor="#FFA072"><div align="center"><strong>PEMUSNAHAN DARAH <br />TANGGAL : <?php echo $data['tanggal']; ?><br />SHIFT : <?php echo $data['shift']; ?></strong></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_a6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_b6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_ab6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_o6" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_a7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_b7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_ab7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu_o7" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>A</strong></div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>B</strong></div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>AB</strong></div></td>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>O</strong></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td rowspan="7" bgcolor="#CCFF33"><div align="center"><strong>MU-BU 2</strong><br /><input type="text" name="bu2" placeholder="Mobile Unit" /></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_a1" size="5" />
    </div></td>
    <td width="8%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_b1" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_ab1" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_o1" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>WB</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center">
      <input type="text" name="musnah" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" />
    </div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah2" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah3" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='WB' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah4" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td bgcolor="#CCFF33"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_a2" size="5" />
    </div></td>
    <td width="8%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_b2" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_ab2" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_o2" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>PRC</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah5" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah6" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah7" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PRC' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah8" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_a3" size="5" />
    </div></td>
    <td width="8%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_b3" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_ab3" size="5" />
    </div></td>
    <td width="9%" bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_o3" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>FFP</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah9" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah10" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah11" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='FFP' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah12" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td bgcolor="#CCFF33"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_a4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_b4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_ab4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_o4" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>LP</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah13" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah14" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah15" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='LP' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah16" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td bgcolor="#CCFF33"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_a5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_b5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_ab5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_o5" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>TC</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah17" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah18" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah19" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='TC' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah20" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td bgcolor="#CCFF33"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_a6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_b6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_ab6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_o6" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>AHF</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah21" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah22" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah23" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='AHF' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah24" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_a7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_b7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_ab7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="mu2_o7" size="5" />
    </div></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FFA072"><div align="center"><strong>PD</strong></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='A'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah25" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='B'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah26" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='AB'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah27" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <?php
		$sql="select count(id) as jumlah from musnah where tanggal='$tanggal' and shift='$shift' and jenis='PD' and gol='O'";
		$proses=mysql_query($sql);
		$data=mysql_fetch_array($proses);
	?>
    <td valign="top" bgcolor="#FFA072"><div align="center"><input type="text" name="musnah28" value="<?php echo $data['jumlah']; ?>" size="1" readonly="readonly" /></div></td>
    <td valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td rowspan="7" bgcolor="#CCFF33"><div align="center"><strong>GERAI DONOR</strong></div></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>SINGLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_a1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_b1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_ab1" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_o1" size="5" />
    </div></td>
    </tr>
  <tr>
    <td colspan="6" valign="top" bgcolor="#FFA072">&nbsp;</td>
    <td bgcolor="#CCFF33"><div align="center"><strong>DOUBLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_a2" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_b2" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_ab2" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_o2" size="5" />
    </div></td>
    </tr>
  <tr>
    <td colspan="10" rowspan="5" valign="top" bgcolor="#FFA072"><table align="top">
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
    </table>      <p><strong>Catatan :</strong><br />
        <textarea name="catatan" rows="2" cols="20" placeholder="catatan tambahan"></textarea>
      </p></td>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRIPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_a3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_b3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_ab3" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_o3" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>QUADROWPLE</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_a4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_b4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_ab4" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_o4" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>PEDIATRIK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_a5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_b5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_ab5" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_o5" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>APHERESIS</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_a6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_b6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_ab6" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_o6" size="5" />
    </div></td>
    </tr>
  <tr>
    <td bgcolor="#CCFF33"><div align="center"><strong>TRANSFERPACK</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_a7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_b7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_ab7" size="5" />
    </div></td>
    <td bgcolor="#CCCCCC"><div align="center">
      <input type="text" name="gerai_o7" size="5" />
    </div></td>
    </tr>
</table>
</td>
<td width="30%"><table>
  <tr>
    <td><table>
      <tr>
        <td>Petugas 1 :
          <select name="petugas1">
            <option>...</option>
            <?php
				$tampil="select * from pegawai";
				$proses=mysql_query($tampil);
				while($data=mysql_fetch_array($proses))
				{
				echo "<option>".$data['nama']."</option>";
				}
			?>
          </select></td>
      </tr>
      <tr>
        <td>Petugas 2 :
          <select name="petugas2">
            <option>...</option>
            <?php
				$tampil="select * from pegawai";
				$proses=mysql_query($tampil);
				while($data=mysql_fetch_array($proses))
				{
				echo "<option>".$data['nama']."</option>";
				}
			?>
          </select></td>
      </tr>
      <tr>
        <td>Petugas 3 :
          <select name="petugas3">
            <option>...</option>
            <?php
				$tampil="select * from pegawai";
				$proses=mysql_query($tampil);
				while($data=mysql_fetch_array($proses))
				{
				echo "<option>".$data['nama']."</option>";
				}
			?>
          </select></td>
      </tr>
      <tr>
        <td>Petugas 4 :
          <select name="petugas4">
            <option>...</option>
            <?php
				$tampil="select * from pegawai";
				$proses=mysql_query($tampil);
				while($data=mysql_fetch_array($proses))
				{
				echo "<option>".$data['nama']."</option>";
				}
			?>
          </select></td>
      </tr>
    </table></td>
  </tr>
</table></td>
</tr>
<tr>
<td>
<table align="center">
  <tr>
    <td align="center"><input type="submit" name="submit" value="Update" />  <a href="home.php"><img src="images/reload.png" width="30" height="30"  /></a></td>
    </tr>
</table>
</td>
</tr>
</table>
</form>
</body>
</html>
