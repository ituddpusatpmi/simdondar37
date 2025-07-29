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
			width: '110px', 
			height: '120px',
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
			width: '80px', 
			height: '90px', 
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
<?php
session_start();
if (($_SESSION[leveluser])=='p2d2s'){
?>
<ul class="thumb">
	<li><a href="pmip2d2s.php?module=wa_inbox"><img src="whatsapp/images/inbox.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=wa_sent"><img src="whatsapp/images/outbox.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=wa_outbox"><img src="whatsapp/images/pending.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=wa_setting"><img src="whatsapp/images/setting.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=wa_manual"><img src="whatsapp/images/manual.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=wa_broadcast"><img src="whatsapp/images/broadcast.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=wa_instansi"><img src="whatsapp/images/instansi.png" alt="" /></a></li>
	<li><a href="pmip2d2s.php?module=wa_ultah"><img src="whatsapp/images/ultah.png" alt="" /></a></li>
<?}else{?>
<ul class="thumb">
	<li><a href="pmiadmin.php?module=wa_inbox"><img src="whatsapp/images/inbox.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=wa_sent"><img src="whatsapp/images/outbox.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=wa_outbox"><img src="whatsapp/images/pending.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=wa_setting"><img src="whatsapp/images/setting.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=wa_manual"><img src="whatsapp/images/manual.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=wa_broadcast"><img src="whatsapp/images/broadcast.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=wa_instansi"><img src="whatsapp/images/instansi.png" alt="" /></a></li>
	<li><a href="pmiadmin.php?module=wa_ultah"><img src="whatsapp/images/ultah.png" alt="" /></a></li>

<?}?>	
	
</ul>
</div>

