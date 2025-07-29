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
	<li><a href="pmiqc.php?module=qcwb"><img src="images/wbqc.png" alt=""/></a></li>
	<li><a href="pmiqc.php?module=qcprc"><img src="images/prcqc.png" alt=""/></a></li>
	<li><a href="pmiqc.php?module=qcffp"><img src="images/qcffp.png" alt=""/></a></li>
	<li><a href="pmiqc.php?module=qctc"><img src="images/qctc.png" alt=""/></a></li>
	<li><a href="pmiqc.php?module=hasilqc"><img src="images/lapqc.png" alt=""/></a></li>
	<!--li><a href="pmiqc.php?module=laborat_qc"><img src="images/rincian_musnah.png" alt="" /></a></li>
	<!--li><a href="pmiqc.php?module=rekap_darah_buang"><img src="images/rekap_musnah.png" alt="" /></a></li>
	<!--li><a href="pmiqc.php?module=stok_sehat"><img src="images/stok_kembali_sehat.png" alt=""/></a></li>
	<!--li><a href="pmiqc.php?module=skantong"><img src="images/pencocokan_stok.png" alt=""/></a></li-->


</ul>
</ul>
</ul>
</div>

