<link href="css/content2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript"> 
$(document).ready(function(){

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
});

</script> 
</head>

<div class="container">
<ul class="thumb">
	<li><a href="pmiadmin.php?module=graphdonor"><img src="images/graph_donor.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=graphdonasi"><img src="images/graph_donasi_pie.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=graphtrendbulanan"><img src="images/graph_trend_bulanan.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=lacak_pasien"><img src="images/lacak_pasien.png" alt="" /></a></li>
	
	<!---
	<li><a href="pmiadmin.php?module=laporan_uji_sharing"><img src="images/laporan_uji_saring.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=laporan_lttd4"><img src="images/laporan_lttd4.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=laporan_lttd5"><img src="images/laporan_lttd5.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=laporan_lttd6"><img src="images/laporan_lttd6.png" alt="" /></a></li>
	>
        <li><a href="pmiadmin.php?module=lacak_pasien"><img src="images/lacak_pasien.png" alt="" /></a></li>
        <li><a href="pmiadmin.php?module=sejarah"><img src="images/lacak_pendonor.png" alt="" /></a></li-->
	<li><a href="pmiadmin.php?module=skantong"><img src="images/pencocokan_stok.png" alt=""/></a></li>
	<li><a href="pmiadmin.php?module=rekap_pendonor"><img src="images/rekap_pendonor_excel.png" alt=""/></a></li>
</ul>
</ul>
</ul>
</div>

