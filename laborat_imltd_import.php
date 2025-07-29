<link href="css/content2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript"> 
$(document).ready(function(){
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
});
</script> 
</head>

<div class="container">
	<ul class="thumb">
			<li><a href="pmiimltd.php?module=import_etimax3000"><img src="images/imltd_import_etimax3000.png" alt=""/></a></li>
			<li><a href="pmiimltd.php?module=import_davinci"><img src="images/da_vinci_quatro.png" alt=""/></a></li>
			<li><a href="pmiimltd.php?module=import_nat_procleix"><img src="images/nat_ultrio.png" alt=""/></a></li>
			<!-- <li><a href="pmiimltd.php?module=import_nat_panther"><img src="procleixs/red-phanter.png" alt=""/></a></li> -->
			<li><a href="pmiimltd.php?module=import_liasonxl"><img src="images/liaisonxl.png" alt=""/></a></li>
			<li><a href="pmiimltd.php?module=import_arc2000"><img src="images/architech.png" alt=""/></a></li>
			<li><a href="pmiimltd.php?module=import_roche"><img src="images/roche_cobas.png" alt=""/></a></li>
			<li><a href="pmiimltd.php?module=import_alinity"><img src="alinity/alinity-i.png" alt=""/></a></li>
			<li><a href="pmiimltd.php?module=import_sysmex"><img src="images/sysmex-hiscl.png" alt=""/></a></li>
			<li><a href="pmiimltd.php?module=mindray_menu"><img src="mindray/cli2000i.png" alt=""/></a></li>
			<!-- <li><a href="pmiimltd.php?module=evolisbiorad"><img src="evolis/evolis.png" alt=""/></a></li> -->
			<li><a href="pmiimltd.php?module=panther"><img src="panther_nat/images/panther.png" alt=""/></a></li>
	</ul>
</div>

