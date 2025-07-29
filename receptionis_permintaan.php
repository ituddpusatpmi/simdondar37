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
        <li><a href="pmikasir2.php?module=searchpasien"><img src="images/cari_pasien4.png" alt=""/></a></li>
	<li><a href="pmikasir2.php?module=permintaan" onclick="return confirm('Apakah Anda yakin Ini Pasien Baru?')"><img src="images/pasien_baru.png" alt=""/></a></li>
	<li><a href="pmikasir2.php?module=tambah_permintaan" onclick="return confirm('Apakah Anda yakin Ini Permintaan Tambahan?')"><img src="images/permintaan_tambah.png" alt=""/></a></li>
    <li><a href="pmikasir2.php?module=kwitansititer"><img src="images/pembayaran1.png" alt=""/></a></li>
</ul>
</ul>
</ul>
</div>

