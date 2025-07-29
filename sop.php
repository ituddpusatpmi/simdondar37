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
	
	<li><a href="pmiadmin.php?module=instalasi"><img src="images/instalasi.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=migrasi"><img src="images/migrasi.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=backup"><img src="images/backup-sop.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=levelakses"><img src="images/level.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=testinglive"><img src="images/testing.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=mulfunction"><img src="images/mulfunction.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=validasi"><img src="images/validasi.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=training"><img src="images/training.png" alt="" /></a></li>
	



</ul></div>

