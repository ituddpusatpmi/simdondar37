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
	<!--li><a href="pmiimltd.php?module=rekap_reaktif"><img src="images/laporan_reaktif.png" alt=""/></a></li>
	<li><a href="pmiimltd.php?module=rekap_reaktif1"><img src="images/laporan_reaktif1.png" alt=""/></a></li>
	<li><a href="pmiimltd.php?module=rekap_nonreaktif"><img src="images/hasil_lab2.png" alt="" /></a></li-->
	 
	<li><a href="pmiimltd.php?module=rincian_imltd_elisa"><img src="images/rekap_imltd_harian.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=pmk_lap_imltd"><img src="laporan/images/laporan_bulanan_screening.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_reaktif"><img src="images/rekap_imltd_rr.png" alt=""/></a></li>
	<!--li><a href="pmiimltd.php?module=rekap_transaksi"><img src="images/rekap_transaksi0.png" alt=""/></a></li>
	<li><a href="pmiimltd.php?module=rekap_permintaan_lama"><img src="images/rekap_permintaan1.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_permintaan"><img src="images/rekap_permintaan0.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_cross"><img src="images/rekap_cross.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_darah_keluar_lama"><img src="images/rekap_darah_klr_lama.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_darah_keluar"><img src="images/rekap_darah_out.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_darah_keluar_bdrs"><img src="images/rekap_kirim_bdrs.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_darah_keluar_udd"><img src="images/rekap_kirim_udd.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_terima_darah_udd_lain"><img src="images/rekap_terima_darah.png" alt="" /></a></li>	
	<li><a href="pmiimltd.php?module=laporan_darah_buang"><img src="images/rekap_buang_darah.png" alt="" /></a></li>
	<li><a href="pmiimltd.php?module=rekap_rujukan"><img src="images/rekaprujukan.png" alt="" /></a></li-->
</ul>
</ul>
</ul>
</div>

