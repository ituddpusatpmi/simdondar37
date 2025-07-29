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
		}, 400);
	
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
		}, 800);
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
	<li><a href="pmip2d2s.php?module=tambah_kategori"><img src="images/tambah_kategori.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=tambah_instansi"><img src="images/mobile_instansi1.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=lap_transaksi"><img src="images/laporan_trans_mobil.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=rekap_transaksi"><img src="images/rekap_transaksi.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=pengajuan_piagam"><img src="images/rekapajuanpiagam.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=piagam"><img src="images/inputpiagam.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=laporan_piagam"><img src="images/lap_ctk_piagam.png" alt=""/></a></li>
	<li><a href="pmip2d2s.php?module=pendonor_instansi"><img src="images/donorinstansi.png" alt=""/></a></li>
	<li><a href="logistik/transaksi_minta_barang.php"><img src="images/form_permintaan_barang.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=transaksi_donor_lama"><img src="images/sejarahdonor.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=pendonor_cekal_instansi"><img src="images/cekal_instansi.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=laporan_catatandonor"><img src="images/logbookpendonor.png" alt=""/></a></li>
	<li><a href="pmip2d2s.php?module=manual_p2dds"><img src="images/manual_p2dds.png" alt=""/></a></li>
	
</ul>
</div>

