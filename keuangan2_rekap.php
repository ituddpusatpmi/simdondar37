<link href="css/content.css" rel="stylesheet" type="text/css" />
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
        <li><a href="pmikeuangan.php?module=rekap_beli"><img src="images/rekap_beli.png" alt=""/></a></li>
	<li><a href="pmikeuangan.php?module=rekap_jual"><img src="images/rekap_jual.png" alt=""/></a></li>
	<li><a href="pmikeuangan.php?module=rekap_hutang"><img src="images/rekap_hutang.png" alt=""/></a></li>
	<li><a href="pmikeuangan.php?module=rekap_piutang"><img src="images/rekap_piutang.png" alt=""/></a></li>
	<li><a href="pmikeuangan.php?module=rekap_bayar_hutang"><img src="images/rekap_bayar_hutang.png" alt=""/></a></li>
	<li><a href="pmikeuangan.php?module=rekap_bayar_piutang"><img src="images/rekap_bayar_piutang.png" alt=""/></a></li>
	
</ul>
</ul>
</ul>
</div>
