<?php
require_once('clogin.php');
require_once('config/db_connect.php');
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script src="js1/jquery.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/btn_swn_slide.css" rel="stylesheet" />

<script type="text/javascript" language="javascript">
function kosongkantable(){var konfirmasi = confirm('Apakah anda yakin mengosongkan hasil import sementara Biomerieux Davinci Quatro??');
if (konfirmasi==true){$.ajax({url : "modul/imltd_import_davinci_proses.php?op=kosongkan",async: false,dataType: 'json',success: function(json){
pesan = json.result.sukses;alert(pesan)}});}};
</script>


<head>
<title>SIMUDDA - Import hasil IMLTD bioMerieux Da Vinci Quatro</title>
</head>

<body>
<?php
$sql = "CREATE TABLE IF NOT EXISTS `imltd_import_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `nokantong` varchar(20) NOT NULL DEFAULT '-',
  `hbsag_cut_off` varchar(8) NOT NULL DEFAULT '0',
  `hbsag_quanti` varchar(8) NOT NULL DEFAULT '0',
  `hbsag_reader` varchar(8) NOT NULL DEFAULT '0',
  `hbsag_result` varchar(20) NOT NULL DEFAULT '',
  `hcv_cut_off` varchar(8) NOT NULL DEFAULT '0',
  `hcv_quanti` varchar(8) NOT NULL DEFAULT '0',
  `hcv_reader` varchar(8) NOT NULL DEFAULT '0',
  `hcv_result` varchar(20) NOT NULL DEFAULT '',
  `hiv_cut_off` varchar(8) NOT NULL DEFAULT '0',
  `hiv_quanti` varchar(8) NOT NULL DEFAULT '0',
  `hiv_reader` varchar(8) NOT NULL DEFAULT '0',
  `hiv_result` varchar(20) NOT NULL DEFAULT '',
  `syp_cut_off` varchar(8) NOT NULL DEFAULT '0',
  `syp_quanti` varchar(8) NOT NULL DEFAULT '0',
  `syp_reader` varchar(8) NOT NULL DEFAULT '0',
  `syp_result` varchar(20) NOT NULL DEFAULT '',
  `hbsag_metode` varchar(10) NOT NULL DEFAULT '',
  `hcv_metode` varchar(10) NOT NULL DEFAULT '',
  `hiv_metode` varchar(10) NOT NULL DEFAULT '',
  `syp_metode` varchar(10) NOT NULL DEFAULT '',
  `reagen_hbsag` varchar(15) NOT NULL DEFAULT '',
  `reagen_hcv` varchar(15) NOT NULL DEFAULT '',
  `reagen_hiv` varchar(15) NOT NULL DEFAULT '',
  `reagen_syp` varchar(15) NOT NULL DEFAULT '',
  `kantong_valid` char(1) NOT NULL DEFAULT '0',
  `hbsag_od` varchar(10) NOT NULL DEFAULT '0',
  `hcv_od` varchar(10) NOT NULL DEFAULT '0',
  `hiv_od` varchar(10) NOT NULL DEFAULT '0',
  `syp_od` varchar(10) NOT NULL DEFAULT '0',
  `sudah_proses` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";
   mysql_query($sql);
?>

<table border=0 background=images/biomerieux_logo.png>
	<tr><td colspan=2 align="left" valign="middle"><font size="6" color=blue font-family="Arial">IMLTD - bioM&eacuterieux DAVINCI QUATRO</font></td></tr>
	<tr><td valign="top"><a href="javascript:kosongkantable();" class="a-btn">
			<span class="a-btn-text">Bersihkan hasil import</span><span class="a-btn-slide-text">bioM&eacuterieux Da Vinci Quatro</span>
			<span class="a-btn-icon-right"><span></span></span>
		</a></td>
		<td rowspan=10>
				<div><img src="images/davinci_quatro.png" height="300px" width="auto"></div></td></tr>
	<tr><td valign="top"><a href="pmiimltd.php?module=import_davincihbsag" class="a-btn">
			<span class="a-btn-text">Import hasil HBsAg</span><span class="a-btn-slide-text">bioM&eacuterieux Da Vinci Quatro</span>
			<span class="a-btn-icon-right"><span></span></span>
		</a></td></tr>
	<tr><td valign="top"><a href="pmiimltd.php?module=import_davincihcv" class="a-btn">
			<span class="a-btn-text">Import hasil HCV</span><span class="a-btn-slide-text">bioM&eacuterieux Da Vinci Quatro</span>
			<span class="a-btn-icon-right"><span></span></span>
		</a></td></tr>
	<tr><td valign="top"><a href="pmiimltd.php?module=import_davincihiv" class="a-btn">
			<span class="a-btn-text">Import hasil HIV</span><span class="a-btn-slide-text">bioM&eacuterieux Da Vinci Quatro</span>
			<span class="a-btn-icon-right"><span></span></span>
		</a></td></tr>
	<tr><td valign="top"><a href="pmiimltd.php?module=import_davincisyp" class="a-btn">
			<span class="a-btn-text">Import hasil Syphilis</span><span class="a-btn-slide-text">bioM&eacuterieux Da Vinci Quatro</span>
			<span class="a-btn-icon-right"><span></span></span>
		</a></td></tr>
	<tr><td valign="top"><a href="pmiimltd.php?module=import_davincikonfirmasi" class="a-btn">
			<span class="a-btn-text">Konfirmasi Hasil Import </span><span class="a-btn-slide-text">bioM&eacuterieux Da Vinci Quatro</span>
			<span class="a-btn-icon-right"><span></span></span>
		</a></td></tr>
</table>
</body>
</html>
