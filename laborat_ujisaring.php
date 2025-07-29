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
    <!--li><a href="pmiimltd.php?module=elisa"><img src="images/elisa.png" alt=""/></a></li-->
	<li><a href="pmiimltd.php?module=laborat_elisaclia"><img src="images/laborat_elisa_clia.png" alt=""/></a></li>
	<!--li><a href="pmiimltd.php?module=laborat_nat"><img src="images/laborat_nat.png" alt=""/-->
	<li><a href="pmiimltd.php?module=master_reagen"><img src="images/logistik_masterreagen.png" alt=""/></a></li>
	<li><a href="pmiimltd.php?module=reagen_aktif"><img src="images/aktifreagen.png" alt=""/></a></li>
    <li><a href="pmiimltd.php?module=reagen_nonaktif"><img src="images/nonaktifreagen.png" alt=""/></a></li>
	<li><a href="pmiimltd.php?module=update_test_reagen"><img src="images/update_reagen1.png" alt=""/></a></li>
	<li><a href="pmiimltd.php?module=elisabayang"><img src="images/elisa2.png" alt=""/></a></li>
	<li><a href="pmiimltd.php?module=musnah"><img src="images/pemusnahan_kantong.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rincian_darah_buang"><img src="images/rincian_musnah.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_darah_buang"><img src="images/rekap_musnah.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=manual_imltd"><img src="images/manual_imltd.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=changestatus"><img src="images/ubah_status_kantong.png" alt="" /></a></li>
<li><a href="pmiimltd.php?module=release_duplo"><img src="imltd/images/duplo_release.png" alt="" /></a></li>
</ul>
</ul>
</ul>
</div>

