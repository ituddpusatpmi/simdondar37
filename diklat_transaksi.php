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
	<!--li><a href="pmidiklat.php?module=search_pendonor"><img src="images/mobile_donor_cari1.png" alt=""/></a></li>
	<li><a href="pmidiklat.php?module=check"><img src="images/medical_checkup_mobile.png" alt=""/></a></li>
	<li><a href="pmidiklat.php?module=spengambilan"><img src="images/mobile_darah_ambil1.png" alt="" /></a></li-->
	<li><a href="pmidiklat.php?module=tambah_kategori"><img src="images/tambah_kategori.png" alt="" /></a></li>
	<li><a href="pmidiklat.php?module=tambah_diklat"><img src="images/mobile_instansi1.png" alt="" /></a></li>
	<li><a href="pmidiklat.php?module=registrasi"><img src="images/reg_diklat.png" alt="" /></a></li>
	<li><a href="pmidiklat.php?module=minta_barang"><img src="images/form_permintaan_mobile.png" alt="" /></a></li>
	<li><a href="pmidiklat.php?module=minta_paket"><img src="images/form_permintaan_paket.png" alt="" /></a></li>
	<li><a href="pmidiklat.php?module=lap_transaksi"><img src="images/laporan_trans_mobil.png" alt="" /></a></li>
	<li><a href="pmidiklat.php?module=rekap_transaksi"><img src="images/rekap_transaksi.png" alt="" /></a></li>
	<!--li><a href="pmidiklat.php?module=piagam"><img src="images/piagam.png" alt="" /></a></li>
	<!--li><a href="pmidiklat.php?module=downloadtogerai"><img src="images/downloadtogerai.png" alt="" /></a></li>
	<li><a href="pmidiklat.php?module=uploadfromgerai"><img src="images/uploadfromgerai.png" alt="" /></a></li>
	<li><a href="modul/update.php"><img src="images/update_simudda.png" alt=""/></a></li-->
	<li><a href="pmidiklat.php?module=pendonor_instansi"><img src="images/donorinstansi.png" alt=""/></a></li>
</ul>
</div>

