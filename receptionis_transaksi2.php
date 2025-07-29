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
	<li><a href="pmikasir2.php?module=inputstok"><img src="distribusi/images/input_stok.png" alt="" /></a></li>
	
	<li><a href="pmikasir2.php?module=pembayaran"><img src="images/pembayaran1.png" alt=""/></a></li>
	<li><a href="pmikasir2.php?module=form_pengantar"><img src="images/cetak_pengantar_darah.png" alt=""/></a></li>
	<li><a href="pmikasir2.php?module=tambah_dokter"><img src="images/tambah_dokter1.png" alt=""/></a></li>
	
	<li><a href="pmikasir2.php?module=tambah_rs"><img src="images/tambah_rs.png" alt=""/></a></li>
	<li><a href="pmikasir2.php?module=tambah_kelas"><img src="images/tambah_kelas.png" alt="" /></a></li>
	<li><a href="pmikasir2.php?module=tambah_layanan"><img src="images/tambah_layanan.png" alt="" height="117" /></a></li>
	<li><a href="pmikasir2.php?module=edit_harga"><img src="images/daftar_biaya.png" alt=""/></a></li>
	<li><a href="pmikasir2.php?module=ganti_shift"><img src="images/ganti_shift.png" alt="" /></a></li>
	<li><a href="pmikasir2.php?module=pasien_plebotomi"><img src="images/pasien_plebotomi.png" alt="" /></a></li>
	<li><a href="logistik/transaksi_minta_barang.php"><img src="images/form_permintaan_barang.png" alt="" /></a></li>
	<li><a href="pmikasir2.php?module=manual_loket"><img src="images/manual_loket.png" alt="" /></a></li>
</ul>
</div>

