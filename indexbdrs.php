<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Cache-Control" content="must-revalidate">
<title>Sistem Informasi Manajemen Unit Donor Darah</title>
<link href="index/css_general.css" rel="stylesheet" type="text/css" media="">
<link href="css/front.css" media="screen, projection" rel="stylesheet" type="text/css">
<link href="css/div.css" rel="stylesheet" type="text/css">
<link href="css/counter.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/tabcontent.css" />
<link rel="stylesheet" href="Style.css" type="text/css" />
<script language="JavaScript" src="FusionCharts.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/tabcontent.js"></script>
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script language=javascript src="js/ajax.js" type="text/javascript"> </script>
<link rel="stylesheet" type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css">
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
 <script language="javascript" src="modul/thickbox/thickbox.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#div_test').load('random_session.php').fadeIn("slow");
$('#div_test1').load('random_session.php').fadeIn("slow");
$('#div_test2').load('random_session.php').fadeIn("slow");
}, 2000); // refresh every 2000 milliseconds
</script>
<script type="text/javascript">
        $(document).ready(function() {

            $(".signin").click(function(e) {          
				e.preventDefault();
                $("fieldset#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
            });
			
			$("fieldset#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("fieldset#signin_menu").hide();
				}
			});			
			
        });
</script>
</head>
<? include 'config/db_connect.php'; ?>
<br>
<table border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td>
  <div id="topnav" class="topnav">
<a href="modul/data_pendonor.php?&width=400&height=300" class="thickbox mobile1"><span>Pendonor</span></a> 
<a href="index.php?loadmap=1" class="mobile1">LOAD MAP</a>
<a href="../simudda_pusat/index.php" class="mobile1">SIM UTDP</a><a href="index.php" class="signin"><span>Sign in</span></a> 
</div>
  <fieldset id="signin_menu">
    <form method="post" id="signin" action="cek_login.php">
      <label for="username">Username</label>
      <input id="username" name="username" value="" title="username" tabindex="4" type="text">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" name="password" value="" title="password" tabindex="5" type="password">
      </p>
      <p class="remember">
        <input id="signin_submit" value="Sign in" tabindex="6" type="submit">
      </p>
    </form>
  </fieldset>
	</td></tr>
	<tr><td>
<table><tr>
<td>
<div class="kiri1" id="kiri1">
<? if ($_GET[menu]==1) { include 'Menu.html'; } else {?>
<h1 class="shadow" align="center">STOK Darah</h1>
<ul id="darahtabs" class="shadetabs">
<li><a href="#" rel="sehat" class="selected">Sehat</a></li>
<li><a href="#" rel="karantina">Karantina</a></li>
<?
$bd=mysql_query("select concat('bdrs',substring(kode,3,1)) as kd from bdrs order by kode limit 1");
for ($bd1=mysql_fetch_assoc($bd)) { 
$bdrs=strtoupper($bd1[kd]);
$b1=$bd1[kd];
?>
<!--<li><a href="#" rel="<?//=$bd1[kd]?>"><?//=$bdrs?></a></li>-->
<li><a href="#" rel="<?=$b1?>"><?=$bdrs?></a></li>
<!--<li><a href="#" rel="bdrs1">BDRS1</a></li>-->
<? } ?>
</ul>
<div id="sehat" class="tabcontent" align="center">
<script type="text/javascript">
var countries=new ddtabcontent("darahtabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
<script type="text/javascript">
		   var chart = new FusionCharts("FCF_MSColumn3D.swf", "ChartId", "350", "145");
	    chart.setDataURL('get_latest_stokutdS.php');
		   chart.render("sehat");
</script>
</div>
<div id="karantina" class="tabcontent" align="center">
<script type="text/javascript">
var countries=new ddtabcontent("darahtabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
<script type="text/javascript">
		   var chart = new FusionCharts("FCF_MSColumn3D.swf", "ChartId", "350", "145");
	    chart.setDataURL('get_latest_stokutdK.php');
		   chart.render("karantina");
</script>
</div>
<?
//$bd=mysql_query("select concat('bdrs',substring(kode,3,1)) as kd from bdrs order by kode");
//for ($bd1=mysql_fetch_assoc($bd)) { 

?>
<div id="<?=$bd1[kd]?>" class="tabcontent" align="center">
<script type="text/javascript">
var countries=new ddtabcontent("darahtabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
<script type="text/javascript">
		   var chart = new FusionCharts("FCF_MSColumn3D.swf", "ChartId", "350", "145");
	    chart.setDataURL("get_latest_stokutd_bdrs.php?bdrs=b<?=substr($bd1[kd],2)?>");
		   chart.render("<?=$bd1[kd]?>");
</script>
</div>
<?// } ?>
<!--
<div id="bdrs2" class="tabcontent" align="center">
<script type="text/javascript">
var countries=new ddtabcontent("darahtabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
<script type="text/javascript">
		   var chart = new FusionCharts("FCF_MSColumn3D.swf", "ChartId", "350", "145");
	    chart.setDataURL('get_latest_stokutd_bdrs2.php');
		   chart.render("bdrs2");
</script>
</div>
<div id="bdrs3" class="tabcontent" align="center">
<script type="text/javascript">
var countries=new ddtabcontent("darahtabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
<script type="text/javascript">
		   var chart = new FusionCharts("FCF_MSColumn3D.swf", "ChartId", "350", "145");
	    chart.setDataURL('get_latest_stokutd_bdrs3.php');
		   chart.render("bdrs3");
</script>
</div>
-->
<h1 class="shadow" align="center">Jumlah Pendonor</h1>
<div id="nasional" style="left:5px;">
	<script type="text/javascript">
			var myChart = new FusionCharts("FCF_MSColumn3D.swf", "chartdonor", "340", "150");
	    myChart.setDataURL('get_latest_donorutd.php');
	    myChart.render("nasional");
	</script>
</div>
<br>
<br>
<h1 class="shadow" align="center">Jumlah Donor Hari Ini:</h1>
<br>
<div align="center" id="div_test2" class="shadow"></div>
</div>
</div>
<? } ?>
</td>
<td>
<div class="kanan">
<div class="kanan0">
<?php
if ($_GET[loadmap]==1) include "modul/add_load_mobile.php";
  ?>     
<div id="map_canvas" style="width: 100%; height: 100%; "><img src="images/UDD_all.png"></div>
</div>
</div>
</td>  
</tr></table>
</td>
    </tr>
</table>
