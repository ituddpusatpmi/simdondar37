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
});

</script> 
</head>

<div class="container">
<ul class="thumb">
	<li><a href="pmimobile.php?module=rekap_transaksi1"><img src="images/rekap_transaksi_donor.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=rekap_transaksi2"><img src="images/rekap_transaksi0.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=rekap_mu"><img src="images/lap_mu.png" alt=""/></a></li>
	<li><a href="pmimobile.php?module=report_down_up"><img src="images/report_down_up_mu.png" alt="" /></a></li>
    	<li><a href="pmimobile.php?module=ev_mu"><img src="images/ev_mu.png" alt="" /></a></li>
	
</ul>
</ul>
</ul>
</div>

