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
			width: '155px',
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
			height: '85px',
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
<style>body {font-family: "Lato", sans-serif;}</style>
<body>
<div class="container">
    <div style="background-color: #ffffff;font-size:22px; font-weight: bold;color:#ff0000;text-shadow: 1px 1px 2px #000000; "Lato", sans-serif;">LAPORAN BULANAN</div><br>
    <ul class="thumb">
        <li><a href="pmitatausaha.php?module=lap_donasi_wb"><img src="images/lap_donasi_wb.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=lap_donasi_aph"><img src="images/lap_donasi_aph.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=imltd"><img src="images/lap_imltd.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=imltd_donasi"><img src="images/lap_imltd_by_donasi.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=musnah"><img src="images/lap_musnah_darah.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=komponen"><img src="images/lap_komponen_darah.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=permintaan"><img src="images/lap_permintaan_darah.png" alt="" /></a></li>
    </ul>
    <br><div style="background-color: #ffffff;font-size:22px; font-weight: bold; color:#ff0000;text-shadow: 1px 1px 2px #000000; "Lato", sans-serif;">LAPORAN TAHUNAN</div><br>
    <ul class="thumb">
        <li><a href="pmitatausaha.php?module=lap_umum"><img src="images/tu_data_umum.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=pendonor"><img src="images/lap_jumlah_pendonor.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=lap_pelayanan"><img src="images/lap_pelayanan.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=lap_personalia"><img src="images/lap_ketenagaan.png" alt="" /></a></li>
        <li><a href="pmitatausaha.php?module=lap_immunohematologi"><img src="images/lap_immunohematologi.png" alt="" /></a></li>
    </ul>
</div>

</body>
