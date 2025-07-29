<link href="css/content2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript"> 
$(document).ready(function(){

//Larger thumbnail preview 

$("ul.thumb li").hover(function() {
	$(this).css({'z-index' : '10'});
	$(this).find('img').addClass("hover").stop()
		.animate({
			marginTop: '-100px', 
			marginLeft: '-100px', 
			top: '55%', 
			left: '55%', 
			width: '140px', 
			height: '165px',
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
			height: '120px', 
			padding: '5px'
		}, 1000);
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
	<li><a href="?module=barcode_automake"><img src="pmf/images/barcode_01_multi.png" alt="" /></a></li>
	<li><a href="?module=barcode_noselang"><img src="pmf/images/barcode_01_single_selang.png" alt="" /></a></li>
	<li><a href="?module=barcode_mutasi"><img src="pmf/images/barcode_02_mutasi.png" alt="" /></a></li>
	<li><a href="?module=barcode__mutasiforprint"><img src="pmf/images/barcode_05_mutasicetak.png" alt="" /></a></li>
	<li><a href="?module=barcode_autor"><img src="pmf/images/barcode_03_rekapbarcode.png" alt="" /></a></li>
	<li><a href="?module=barcode_mutasirekap"><img src="pmf/images/barcode_04_rekapmutasi.png" alt="" /></a></li>
	<li><a href="?module=barcode_rekappakai"><img src="pmf/images/barcode_06_rekappakai.png" alt="" /></a></li>
	<li><a href="?module=barcode_reprint"><img src="pmf/images/barcode_07_cetakulang.png" alt="" /></a></li>
	
</ul>
</div>

