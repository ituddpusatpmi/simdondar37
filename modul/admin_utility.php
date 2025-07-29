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
	<!--<li><a href="modul/update.php"><img src="images/update_simudda.png" alt=""/></a></li>-->
	<li><a href="modul/update.php"><img src="images/update_simudda.png" alt=""/></a></li>
	<li><a href="pmiadmin.php?module=aturuser"><img src="images/atur_user.png" alt=""/></a></li>
	<li><a href="pmiadmin.php?module=aturberita"><img src="images/atur_berita.png" alt="" /></a></li>
        <li><a href="pmiadmin.php?module=aturagenda"><img src="images/atur_agenda.png" alt="" /></a></li>
        <li><a href="pmiadmin.php?module=aktif_udd"><img src="images/aktifkan_udd.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=tambah_pengumuman"><img src="images/update_pengumuman.png" alt=""/></a></li>
	<li><a href="pmiadmin.php?module=edit_harga"><img src="images/daftar_biaya.png" alt=""/></a></li>
	<li><a href="pmiadmin.php?module=tambah_bdrs"><img src="images/bdrs_utility.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=backup_data"><img src="images/backup.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=restore_data"><img src="images/restore.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=restore_data"><img src="images/restore.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=teskoneksi"><img src="images/restore.png" alt="" /></a></li>
</ul>
</ul>
</ul>
</div>

