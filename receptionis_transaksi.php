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
	<li><a href="pmikasir.php?module=pengajuan_piagam"><img src="images/rekapajuanpiagam.png" alt="" /></a></li>
	<li><a href="pmikasir.php?module=transaksi_donor_lama"><img src="images/sejarahdonor.png" alt="" /></a></li>
	<li><a href="logistik/transaksi_minta_barang.php"><img src="images/form_permintaan_barang.png" alt="" /></a></li>
	<li><a href="pmikasir.php?module=manual_seleksi"><img src="images/manual_seleksi.png" alt="" /></a></li>
	<li><a href="pmikasir.php?module=swab"><img src="images/covid_pcr.png" alt="" /></a></li>
	<li><a href="pmikasir.php?module=swabrekap"><img src="images/covid_pcr_rekap.png" alt="" /></a></li>
	<li><a href="pmikasir.php?module=samplerekap"><img src="images/kode_sample.png" alt=""/></a></li>
	<li><a href="pmikasir.php?module=ambilsampel"><img src="images/kode_sample.png" alt=""/></a></li>
</ul>
</div>

