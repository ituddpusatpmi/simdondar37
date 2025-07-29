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
	<li><a href="pmiadmin.php?module=manual_p2dds"><img src="images/manual_p2dds.png" alt=""/></a></li>
	<li><a href="pmiadmin.php?module=manual_logistik"><img src="images/manual_logistik.png" alt=""/></a></li>
	<li><a href="pmiadmin.php?module=manual_seleksi"><img src="images/manual_seleksi.png" alt="" /></a></li>
    <li><a href="pmiadmin.php?module=manual_aftap"><img src="images/manual_aftap.png" alt="" /></a></li>
    <li><a href="pmiadmin.php?module=manual_mu"><img src="images/manual_mu.png" alt="" /></a></li>
    <li><a href="pmiadmin.php?module=manual_kgd"><img src="images/manual_kgd.png" alt="" /></a></li>
    <li><a href="pmiadmin.php?module=manual_imltd"><img src="images/manual_imltd.png" alt="" /></a></li>
    <li><a href="pmiadmin.php?module=manual_komponen"><img src="images/manual_komponen.png" alt="" /></a></li>
    <li><a href="pmiadmin.php?module=manual_loket"><img src="images/manual_loket.png" alt="" /></a></li>
    <li><a href="pmiadmin.php?module=manual_cross"><img src="images/manual_cross.png" alt="" /></a></li>
</ul></div>

