<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION['namaudd'];
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
	<li><a href="pmikonfirmasi.php?module=konfirmasi_gol_darah"><img src="images/laborat_konfirmasi_goldarah.png" alt=""/></a></li>	
	
	
	<li><a href="pmikonfirmasi.php?module=kgd_sample"><img src="images/kgd_sample.png" alt=""/></a></li>	
	<li><a href="pmikonfirmasi.php?module=antibodycovid"><img src="images/covid.png" alt=""/></a></li>	
	<li><a href="pmikonfirmasi.php?module=hematologi"><img src="images/hematology.png" alt=""/></a></li>
    <li><a href="pmikonfirmasi.php?module=manual_kgd"><img src="images/manual_kgd.png" alt="" /></a></li>
    <li><a href="pmikonfirmasi.php?module=rekap_konfirmasi"><img src="images/list_kgd.png" alt=""/></a></li>
    <li><a href="pmikonfirmasi.php?module=rkp_kgd"><img src="images/rekap_kgd.png" alt=""/></a></li>
</ul>
</ul>
</ul>
</div>

