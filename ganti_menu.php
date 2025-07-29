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
<?php
$multilevel=explode(",",$_SESSION['multilevel']);
?>
<div class="container">
	<ul class="thumb">
		<?php
		$td0=php_uname('n');
		$td0=strtoupper($td0);
		$td0=substr($td0,0,1);
		if ($_SESSION['leveluser']!='admin') {
			if ($td0=='M') die('GANTI MENU HANYA BISA DILAKUKAN DARI SIMUDDA SERVER!!!!');
			if ($td0=='B') die('GANTI MENU HANYA BISA DILAKUKAN DARI SIMUDDA SERVER!!!!');
		}
	for ($i=0;$i<sizeof($multilevel);$i++) { 
		$levelframe=$multilevel[$i];
		$level=$multilevel[$i];
		if ($multilevel[$i]=='laboratorium') {$levelframe='laborat';$level='laboratorium';}
		echo '<li><a href="index2.php?module=home&level='.$level.'" target="_top" class="fisheyeItem"><img src="images/level/'.$levelframe.'.png" alt=""/></a></li>';
	} ?>
	</ul>
</div>
