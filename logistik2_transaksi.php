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
 
// ini dihilangkan 
//<li><a href="pmilogistik.php?module=master_stok"><img src="images/master_stok.png" alt="" /></a></li> Sudah include di Tambah Barang
 
});
</script> 
</head>

<div class="container">
<ul class="thumb">
	<li><a href="pmilogistik.php?module=entry_barang"><img src="images/entry_barang.png" alt=""/></a></li>
	<li><a href="pmilogistik.php?module=master_barang"><img src="images/barang.png" alt=""/></a></li>
	<li><a href="pmilogistik.php?module=entry_kontak"><img src="images/entry_kontak.png" alt=""/></a></li>
	<li><a href="pmilogistik.php?module=kontak"><img src="images/kontak.png" alt="" /></a></li>
	<li><a href="logistik/transaksi_order_beli.php"><img src="images/order_beli.png" alt=""/></a></li>
	<li><a href="logistik/transaksi_beli.php"><img src="images/barang_beli.png" alt="" /></a></li>
	<li><a href="logistik/transaksi_bantuan.php"><img src="images/barang_bantuan.png" alt="" /></a></li>
	<li><a href="pmilogistik.php?module=rekap_minta_proses"><img src="images/transaksi_penuhi_permintaan.png" alt="" /></a></li>
	<li><a href="logistik/transaksi_jual.php"><img src="images/barang_jual.png" alt=""/></a></li>
	<li><a href="logistik/transaksi_keluar.php"><img src="images/barang_keluar.png" alt=""/></a></li>
	<li><a href="pmilogistik.php?module=koreksi_stok"><img src="images/koreksi_stok.png" alt=""/></a></li>
	<!--<li><a href="pmilogistik.php?module=master_paket"><img src="images/master_paket.png" alt=""/></a></li>-->
	<!--<li><a href="pmilogistik.php?module=distribusi_paket"><img src="images/distribusi_paket.png" alt="" /></a></li>-->
	<li><a href="logistik/transaksi_minta_barang.php"><img src="images/form_permintaan_barang.png" alt="" /></a></li>
</ul>
</div>

