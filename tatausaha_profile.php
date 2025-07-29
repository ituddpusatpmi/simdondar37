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
			width: '155px',
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
			height: '85px',
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
    <li><a href="pmitatausaha.php?module=dataumum"><img src="images/tu_data_umum.png" alt="" /></a></li>
    <li><a href="pmitatausaha.php?module=databangunan"><img src="images/tu_bangunan.png" alt="" /></a></li>
    <li><a href="pmitatausaha.php?module=datapelayanan"><img src="images/tu_pelayanan.png" alt="" /></a></li>
	<li><a href="pmitatausaha.php?module=dataimmunohematologi"><img src="images/tu_imunohematologi.png" alt="" /></a></li>
    <li><a href="pmitatausaha.php?module=reaksi_transfusi"><img src="images/tu_reaksi_td.png" alt="" /></a></li>
    <li><a href="pmitatausaha.php?module=personalia"><img src="images/tu_personalia.png" alt="" /></a></li>
    <li><a href="pmitatausaha.php?module=set_tanggal"><img src="images/set_tgl_laporan.png" alt="" /></a></li>
</ul>
</div>

