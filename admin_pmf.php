<link href="css/content2.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-latest.js"></script> 
<script type="text/javascript"> 
$(document).ready(function(){
	$("ul.thumb li").hover(function() {
		$(this).css({'z-index' : '10'});
		$(this).find('img').addClass("hover").stop()
			.animate({
				marginTop: '-100px', 
				marginLeft: '-100px', 
				top: '55%', 
				left: '55%', 
				width: '140px', 
				height: '165px',
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
				height: '120px', 
				padding: '5px'
			}, 1000);
	});
});
</script> 
</head>

<div class="container">
	<ul class="thumb">
		<li><a href="?module=pmf_uddmastert"><img src="pmf/images/udd_site_01.png" alt="" /></a></li>
		<li><a href="?module=pmf_inspeksi"><img src="pmf/images/inspeksi_01.png" alt="" /></a></li>
		<li><a href="?module=pmf_iaudit"><img src="pmf/images/internalaudit_01.png" alt="" /></a></li>
		<li><a href="?module=pmf_reagen"><img src="pmf/images/master_reagen_01.png" alt="" /></a></li>
		<li><a href="?module=pmf_acd"><img src="pmf/images/pmf_masterantikuagulasi_01.png" alt="" /></a></li>
		<li><a href="?module=pmf_kantong"><img src="pmf/images/master_kantong_01.png" alt="" /></a></li>
		<li><a href="?module=pmf_dokumen"><img src="pmf/images/dokumen_mutu_01.png" alt="" /></a></li>
		<li><a href="?module=pmf_audittrail"><img src="pmf/images/audit_trail.png" alt="" /></a></li>
		<li><a href="?module=pmf_datapenolakan"><img src="pmf/images/pmf_penolakandonor.png" alt="" /></a></li>
		<li><a href="?module=pmf_imltdrr"><img src="pmf/images/imltd_rr.png" alt="" /></a></li>
		<li><a href="?module=pmf_insidensi"><img src="pmf/images/insidensi_imltd.png" alt="" /></a></li>
		<li><a href="?module=pmf_prevalensi"><img src="pmf/images/prevalensi_imltd.png" alt="" /></a></li>
		<li><a href="?module=pmf_prevalensijenisdonor"><img src="pmf/images/prevalensi_imltd_jenisdonor.png" alt="" /></a></li>
		<li><a href="?module=pmf_upload"><img src="pmf/images/pmf_upload.png" alt="" /></a></li>
		<li><a href="?module=pmf_lookback"><img src="pmf/images/loop_back_01.png" alt="" /></a></li>
	</ul>
</div>