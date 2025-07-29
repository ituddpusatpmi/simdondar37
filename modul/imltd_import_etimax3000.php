<?php
require_once('clogin.php');
require_once('config/db_connect.php');
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script src="js1/jquery.js" type="text/javascript"></script>
<script src="js1/jquery.imageLens.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />

<script type="text/javascript" language="javascript">
function kosongkantable(){var konfirmasi = confirm('Apakah anda yakin mengosongkan hasil import sementara Diasorin Eti-Max 3000??');
if (konfirmasi==true){$.ajax({url : "modul/imltd_import_etimax3000_proses.php?op=kosongkan",async: false,dataType: 'json',success: function(json){
pesan = json.result.sukses;alert(pesan)}});}}$(function () {$("#etimax_zoom").imageLens({lensSize:150,borderSize:3,borderColor:"red",imageSrc:"images/etimax3000b.png"});});
</script>


<head>
<title>SIMUDDA - Import hasil IMLTD Diasorin Eti-max 3000</title>
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
<table class="list" border=0>
	<tr class="field"><td colspan=2 align="center" valign="middle"><font size="4" font-family="Arial">IMPORT HASIL DIASORIN ETI-MAX 3000</font></td></tr>
	<tr><td rowspan=10><img id="etimax_zoom" src="images/etimax3000.png"/></td></tr>
	<tr><td> <img src=images/ETI-Max300logo.png style="float: left;" title="ETI-Max 3000" alt="ETI-Max 3000" /><font size="1" font-family="Arial">Update 25-11-2014</font></td></tr>
	<tr><td valign="top"><a accesskey="k" href="javascript:kosongkantable();"class="swn_button" title="Mengosongkan table penampungan sementara hasil import." >Kosongkan table import</a></td></tr>
	<tr><td valign="top"><a accesskey="b" href="pmiimltd.php?module=import_etimax3000hbsag"class="swn_button" title="Import Parameter HBsAg">Import Hasil HBsAg</a></td></tr>
	<tr><td valign="top"><a accesskey="c" href="pmiimltd.php?module=import_etimax3000hcv"class="swn_button" title="Import Parameter Anti-HCV">Import Hasil Anti-HCV</a></td></tr>
	<tr><td valign="top"><a accesskey="i" href="pmiimltd.php?module=import_etimax3000hiv"class="swn_button" title="Import Parameter Anti-HIV">Import Hasil Anti-HIV</a></td></tr>
	<tr><td valign="top"><a accesskey="s" href="pmiimltd.php?module=import_etimax3000syp"class="swn_button" title="Import Parameter Syphilis">Import Hasil Syphilis</a></td></tr>
	<tr><td valign="top"><a accesskey="p" href="pmiimltd.php?module=import_etimax3000konfirmasi"class="swn_button" title="Proses hasil IMLTD yang telah diimport">Proses Hasil Import</a></td></tr>
	<tr><td><br><br></td></tr>
</table>
</body>
</html>
