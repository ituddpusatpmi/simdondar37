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
	<li><a href="pmimobile.php?module=check"><img src="images/medical_checkup_mobile.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=spengambilan"><img src="images/mobile_darah_ambil1.png" alt="" /></a></li>
	<li><a href="pmimobile.php?module=gantikantong"><img src="images/pergantian_kantong.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=epengambilan"><img src="images/pengambilan_edit.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=minta_barang"><img src="images/form_permintaan_mobile.png" alt="" /></a></li>
	<li><a href="pmimobile.php?module=minta_paket"><img src="images/form_permintaan_paket.png" alt="" /></a></li>
	<li><a href="pmimobile.php?module=lap_transaksi"><img src="images/laporan_trans_mobil.png" alt="" /></a></li>
	<li><a href="pmimobile.php?module=rekap_transaksi"><img src="images/rekap_transaksi.png" alt="" /></a></li>
	<li><a href="pmimobile.php?module=pengajuan_piagam"><img src="images/piagam2.png" alt="" /></a></li>
	<li><a href="pmimobile.php?module=laporan_piagam"><img src="images/lap_ctk_piagam.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=pendonor_instansi"><img src="images/donorinstansi.png" alt=""/></a></li>
	<li><a href="logistik/transaksi_minta_barang.php"><img src="images/form_permintaan_barang.png" alt="" /></a></li>
	<!--<li><a href="modul/update.php"><img src="images/update_simudda.png" alt=""/></a></li>-->
	<li><a href="pmimobile.php?module=rekap_transaksi_sum"><img src="images/jadwal_mu.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=manual_mu"><img src="images/manual_mu.png" alt="" /></a></li>

</ul>
</div>

