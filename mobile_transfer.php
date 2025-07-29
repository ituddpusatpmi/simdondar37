<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$col6=mysql_query("SELECT * FROM `htransaksi` ");if ($col4){mysql_query ("ALTER TABLE `htransaksi` CHANGE `notrans` `NoTrans` VARCHAR( 25 ) NOT NULL DEFAULT '-' ");}
$col7=mysql_query("SELECT * FROM `htransaksi` WHERE `NoTrans`=' ' ");if($col7){mysql_query("DELETE FROM `htransaksi` WHERE `NoTrans` =' ' ");}	

?>

<link href="css/content2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript"> 
$(document).ready(function(){

//Larger thumbnail preview 

$("ul.thumb li").hover(function() {
	$(this).css({'z-index' : '10'});
	$(this).find('img').addClass("hover").stop()
		.animate({
			marginTop: '-110px', 
			marginLeft: '-110px', 
			top: '55%', 
			left: '55%', 
			width: '140px', 
			height: '155px',
			padding: '20px' 
		}, 200);
	
	} , function() {
	$(this).css({'z-index' : '0'});
	$(this).find('img').removeClass("hover").stop()
		.animate({
			marginTop: '0', 
			marginLeft: '0',
			top: '0', 
			left: '0', 
			width: '100px', 
			height: '111px', 
			padding: '5px'
		}, 400);
});

//Swap Image on Click
//	$("ul.thumb li a").click(function() {
		
//		var mainImage = $(this).attr("href"); //Find Image Name
//		$("#main_view img").attr({ src: mainImage });
//		return false;		
//	});
 
});
</script> 
</head>

<div class="container">
<ul class="thumb">
<? 
include 'config/koneksi.php';
//$idp1=mysql_fetch_assoc(mysql_query("select * from tempat_donor where active='1'"));
//	if (substr($idp1[id1],0,1)!="M") { 
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,1);
//	if ($td0!="M") { ?>
	<li><a href="pmimobile.php?module=download"><img src="images/mobile_download1.png" alt=""/></a></li>
<? //} else { ?>
	<li><a href="pmimobile.php?module=upload"><img src="images/uploadmu.png" alt="" /></a></li>
<? //} ?>
	<li><a href="pmimobile.php?module=upload_ulang"><img src="images/upload_ulang2.png" alt="" /></a></li>
<? //} ?>
</ul>
</ul>
</ul>
</div>

