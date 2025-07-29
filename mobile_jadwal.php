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
<li><a href="pmip2d2s.php?module=entry_jadwal_mobile"><img src="images/entry_jad_mobile.png" alt="" /></a></li>
<li><a href="pmip2d2s.php?module=data_jadwal_mobile"><img src="images/data_jad_mobile.png" alt="" /></a></li>
<li><a href="pmip2d2s.php?module=data_jadwal_mobile_now"><img src="images/donor_instansi_m.png" alt="" /></a></li>
<li><a href="pmip2d2s.php?module=rincian_kegiatan"><img src="images/kegiatan.png" alt="" /></a></li>
<!--li><a href="pmip2d2s.php?module=rekap_jadwal_mobile"><img src="images/data_jad_mobile.png" alt="" /></a></li-->
</ul>
</div>

