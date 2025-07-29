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
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=1"><img src="images/laporan_pengambilan_darah.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=2"><img src="images/laporan_kegiatan_utd.png" alt=""/></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=3"><img src="images/lttd_tglperiksa_ds.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=31"><img src="images/lttd_tglaftap_ds.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=32"><img src="images/lttd_tglperiksa_bu.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=33"><img src="images/lttd_tglaftap_bu.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=4"><img src="images/laporan_lttd4.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=5"><img src="images/laporan_lttd5.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=laporan&jenis=6"><img src="images/laporan_lttd6.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=graphdonor"><img src="images/graph_donor.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=graphdonasi"><img src="images/graph_donasi_pie.png" alt="" /></a></li>
	<li><a href="pmikonfirmasi.php?module=graphtrendbulanan"><img src="images/graph_trend_bulanan.png" alt="" /></a></li>
	<!--li><a href="pmikonfirmasi.php?module=lacak_pasien"><img src="images/lacak_pasien.png" alt="" /></a></li>
        <!--li><a href="pmikonfirmasi.php?module=sejarah"><img src="images/sejarah_pendonor.png" alt="" /></a></li>
    <li><a href="modul/karantina.php"><img src="images/darah_karantina.png" alt=""/></a></li>
    <li><a href="modul/sehat.php"><img src="images/darah_sehat.png" alt=""/></a></li>
    <li><a href="modul/titip.php"><img src="images/darah_titipan.png" alt=""/></a></li-->
</ul>
</ul>
</ul>
</div>

