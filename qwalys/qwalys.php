<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="qwalys/css/sbimenu.css" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=News+Cycle&v1' rel='stylesheet' type='text/css' />
    </head>
    <body>
		<div class="container">
		<table border="0" width="100%">
			<tr><td align="center" colspan="2" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">QWALYS<sup>&reg</sup> 3 Diagast</b><br>Antibody Screening & Grouping<br></td></tr>
			<tr><td>	
			<div class="content">
				<div id="sbi_container" class="sbi_container">
					<div class="sbi_panel" data-bg="qwalys/images/abs.png">
						<a href="#" class="sbi_label">Antibody Screening</a>
						<div class="sbi_content">
							<ul>
								<li><a href="pmikonfirmasi.php?module=konfirm_abs">Pengesahan_ABS</a></li>
								<li><a href="pmikonfirmasi.php?module=abs_to_data">Data_Pengesahan_ABS</a></li>
							</ul>
						</div>
					</div>
					<div class="sbi_panel" data-bg="qwalys/images/abd.png">
						<a href="#" class="sbi_label">Golongan Darah ABD</a>
						<div class="sbi_content">
							<ul>
								<li><a href="pmikonfirmasi.php?module=konfirm_abd">Pengesahan_ABD</a></li>
								<li><a href="pmikonfirmasi.php?module=abd_to_data">Data_Pengesahan_ABD</a></li>
							</ul>
						</div>
					</div>
					<div class="sbi_panel" data-bg="qwalys/images/rekap.png">
						<a href="#" class="sbi_label">Data Rekap</a>
						<div class="sbi_content">
							<ul>
								<li><a href="pmikonfirmasi.php?module=abs_reag">Reagen_ABS</a></li>
                                <li><a href="pmikonfirmasi.php?module=abd_reag">Reagen_ABD</a></li>
								<li><a href="pmikonfirmasi.php?module=qwalys_srcid">Detail_Sample</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			</td></tr>
		</table>
		</div>
		<script type="text/javascript" src="qwalys/js/jquery.min.js"></script>
		<script type="text/javascript" src="qwalys/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="qwalys/js/jquery.bgImageMenu.js"></script>
		<script type="text/javascript">
			$(function() {
				$('#sbi_container').bgImageMenu({
					defaultBg	: 'qwalys/images/qwalys_back.png',
					menuSpeed	: 300,
					type		: {
						mode		: 'horizontalSlide',
						speed		: 550,
						easing		: 'easeOutBounce',
						seqfactor	: 100
					}
				});
			});
		</script>
    </body>
</html>
