<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
//$col=mysql_query("SELECT `zonawaktu` FROM `utd`");if (!$col){mysql_query("ALTER TABLE  `utd` ADD  `zonawaktu` VARCHAR( 16 ) NULL DEFAULT  '-' COMMENT  'Asia/Jakarta atau Asia/Makassar atau Asia/Jayapura'");}
//$elisa=mysql_query("SELECT `umur` FROM `hasilelisa`");if (!$elisa){mysql_query("ALTER TABLE `hasilelisa` ADD `umur` INT NOT NULL, ADD `jns_donor` VARCHAR(1) NOT NULL, ADD `baru_ulang` VARCHAR(1) NOT NULL, ADD `catatan` VARCHAR(10) NOT NULL");}
//$rapid=mysql_query("SELECT `umur` FROM `drapidtest`");if (!$rapid){mysql_query("ALTER TABLE `drapidtest` ADD `umur` INT NOT NULL, ADD `jns_donor` VARCHAR(1) NOT NULL, ADD `baru_ulang` VARCHAR(1) NOT NULL, ADD `catatan` VARCHAR(10) NOT NULL");}

//update table htransaksi rekap
//$col1=mysql_query("SELECT `mesin_apheresis` FROM `htransaksi`");if (!$col1){mysql_query("ALTER TABLE  `htransaksi` 
//ADD  `mesin_apheresis` VARCHAR( 15 ) NOT NULL DEFAULT  '-'");}
//$col5=mysql_query("SELECT `umur` FROM `htransaksi`");if (!$col5){mysql_query("ALTER TABLE `htransaksi` 
//ADD `umur` int (11) not null default '0' AFTER `volumekantong`, 
//ADD `donorbaru` INT( 11 ) NOT NULL DEFAULT '0' COMMENT '0:Baru 1:Ulang' AFTER `umur`, 
//ADD `pekerjaan` varchar (30) not null AFTER `donorbaru`, 
//ADD `jk` INT( 11 ) NOT NULL COMMENT '0:Laki, 1:Perempuan' AFTER `pekerjaan`, 
//ADD `donorke` INT( 3 ) NOT NULL DEFAULT '0' AFTER `jk`");}

//$col2=mysql_query("SELECT `jam` from `shift`");if (!$col2){mysql_query("DROP TABLE `shift`");
//mysql_query("CREATE TABLE `shift` (`nama` VARCHAR( 3 ) NOT NULL DEFAULT '-' , `jam` TIME NULL ,  PRIMARY KEY (`nama`) )");}

//$col4=mysql_query("SELECT * FROM `shift` WHERE `nama` = ' '");if (!$col4){mysql_query ("INSERT INTO `shift` (`nama` ,`jam`) VALUES ('I', '08:00:00'),('II', '14:00:00'),('III', '21:00:00')");}
//$col6=mysql_query("SELECT * FROM `htransaksi` ");if ($col4){mysql_query ("ALTER TABLE `htransaksi` CHANGE `notrans` `NoTrans` VARCHAR( 25 ) NOT NULL DEFAULT '-' ");}
//$col7=mysql_query("SELECT * FROM `htransaksi` WHERE `NoTrans`=' ' ");if($col7){mysql_query("DELETE FROM `htransaksi` WHERE `NoTrans` =' ' ");}
//$col8=mysql_query("SELECT * FROM `update` WHERE `pendonor`=' ' ");if($col8){mysql_query("ALTER TABLE `pendonor` ADD `update` INT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=Belum kirim 1=kirim 2=kirim edit' ");}

?>


<link rel="shortcut icon" href="images/index.ico" type="image/x-icon"/>
<title>SIMDONDAR</title>
<script type="text/javascript" language="JavaScript1.2" src="script/ajax.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="script/tools.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js1/interface.js"></script>
<link type="text/css" href="css/interface-fisheye.css" rel="stylesheet"> 
<style>
.header0 {
	width: 100.0%;
	height:100%;
	background:#D9E5BF;
	position:fixed;
	left:0px;
	top:0px;
}
.header01 {
	width: 30%;
	height: 110px;
	background: #DD2527;
	position: relative;
	left:1.4%;
	top:5px;
	-webkit-border-top-left-radius: 7px;
	-moz-border-radius-topleft: 7px;
	border-top-left-radius: 7px;
	-webkit-border-bottom-left-radius: 7px;
	-moz-border-radius-bottomleft: 7px;
	border-bottom-left-radius: 7px;
	font-family:arial;
	font-size:14px;
	color:#ffffff;
	text-shadow: 1px 2px 1px #000;
	font-weight:bold;
}
.header02 {
	width: 30%;
	height: 110px;
	background: #FF6346;
	position: relative;
	left: 30%;
	top:-105px;
}
.header03 {
	width: 25%;
	height: 110px;
	background: #FFA688;
	position: relative;
	left: 60%;
	top:-215px;
}
.header04 {
	width: 13.6%;
	height: 110px;
	background: #FFE7DB;
	position: relative;
	left: 85%;
	top:-325px;
	-webkit-border-top-right-radius: 7px;
	-moz-border-radius-topright: 7px;
	border-top-right-radius: 7px;	
	-webkit-border-bottom-right-radius: 7px;
	-moz-border-radius-bottomright: 7px;
	border-bottom-right-radius: 7px;	
}
.header05 {
	width: 11.45%;
	height: 100px;
	background-repeat:no-repeat;
	position: relative;
	left: 85%;
	top:-420px;
}
.header051 {
	width:94px;
	height:61px;
	position: relative;
	left:88%;
	top:-550px;
}
.header100 {
	width:98.8%;
	height:98%;
	position: relative;
	left: 7px;
	top: 5px;
	background:#ED000A;
	border-top: 1px solid #636D65;
	border-bottom: 1px solid #636D65;
	border-right: 1px solid #636D65;
	-webkit-border-top-left-radius: 4px;
	-moz-border-radius-topleft: 4px;
	border-top-left-radius: 4px;	
	-webkit-border-top-right-radius: 4px;
	-moz-border-radius-topright: 4px;
	border-top-right-radius: 4px;	
	-webkit-border-bottom-left-radius: 4px;
	-moz-border-radius-bottomleft: 4px;
	border-bottom-left-radius: 4px;	
	-webkit-border-bottom-right-radius: 4px;
	-moz-border-radius-bottomright: 4px;
	border-bottom-right-radius: 4px;	
}
.header100kiri {
	width:10px;
	height:86%;
	background:#ED000A;
	position:relative;
	left:15px;
	top:-490px;
}
.header10 {
	width:97.1%;
	height:76%;
	position: relative;
	left: 1.4%;
	top: -420px;
	background:#FFFFFF;
	border-top: 1px solid #636D65;
	border-left: 1px solid #636D65;
	border-bottom: 1px solid #636D65;
	border-right: 1px solid #636D65;
	-webkit-border-top-left-radius: 10px;
	-moz-border-radius-topleft: 10px;
	border-top-left-radius: 10px;	
	-webkit-border-top-right-radius: 10px;
	-moz-border-radius-topright: 10px;
	border-top-right-radius: 10px;	
	-webkit-border-bottom-left-radius: 10px;
	-moz-border-radius-bottomleft: 10px;
	border-bottom-left-radius: 10px;	
	-webkit-border-bottom-right-radius: 10px;
	-moz-border-radius-bottomright: 10px;
	border-bottom-right-radius: 10px;	
}
.nama {
	width: auto;
	height:40px;
	position:relative;
	left:20px;
	top:-415px;
	color:#FFFFFF;
	font-size: 12px !important;
	font-family: sans-serif;
	text-shadow: 1px 2px 1px #000;
	font-weight: normal;
}
.fisheye {
	position:relative;
	top:-95%;
	left:40px;
}
</style>
<script type="text/javascript" language="JavaScript1.2">
function get_fresh(){
	document.location.reload();
}
function logout() {
    if (confirm("Anda yakin akan menutup Aplikasi SIMDONDAR ini?"))
		document.location.href="logout.php";
}

</script>
<?
session_start();
$mm='mobil';
$bb='bdrs';
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,1);

//$td0='M';

if ($td0=='M') {
	if (($_SESSION[leveluser]=='mobile') or (strpos($_SESSION[multilevel],$mm))) {
		$_SESSION[leveluser]='mobile';
	} else {
		die('ANDA TIDAK PUNYA AKSES MOBILE UNIT!!!!<br> Klik <b> <a href=index.php>DI SINI</a> </b> untuk login kembali');
	}
}

if ($td0=='B' and $_SESSION[namauser]!='admin') {
	if (($_SESSION[leveluser]=='bdrs') or (strpos($_SESSION[multilevel],$bb))) {
		$_SESSION[leveluser]='bdrs';
	} else {
		die('ANDA TIDAK PUNYA AKSES BDRS UNIT!!!!<br> Klik <b> <a href=index.php>DI SINI</a> </b> untuk login kembali');
	}
}

if (isset($_GET[level])) {
	$level=explode(",",$_SESSION[multilevel]);
	for ($i=0;$i<sizeof($level);$i++) {
		if ($level[$i]==$_GET[level]) $_SESSION[leveluser]=$level[$i];
		}
}

?>
<div class="header0">
<div class="header100">
	<div class="header01"></div>
	<div class="header02"></div>
	<div class="header03"></div>
	<div class="header04"></div>
	<div class="header05"><img src='images/pmi.png' width="98%"></div>
	<div class="header10">
	<? if ($_GET[module]=='home' and $_GET[level]=='laboratorium') {
		?>
		<iframe name="isiadmin" width="100%" height="100%" frameborder="0">
		</iframe>
		<?
	} elseif 
		($_GET[module]=='home' and $_GET[level]=='aftap') {
		?>
		<iframe src='pmiaftap.php?module=rekap_transaksi_sum' name="isiadmin" width="100%" height="100%" frameborder="0">
		</iframe>
		<?
	} elseif 
		($_GET[module]=='home' and $_GET[level]=='mobile') {
		?>
		<iframe src='pmimobile.php?module=rekap_transaksi_sum' name="isiadmin" width="100%" height="100%" frameborder="0">
		</iframe>
		<?
	} elseif 
		($_GET[module]=='home' and $_GET[level]=='p2d2s') {
		?>
		<iframe src='pmip2d2s.php?module=rekap_transaksi_sum' name="isiadmin" width="100%" height="100%" frameborder="0">
		</iframe>
		<?
	}
	 else {
		?>
		<iframe name="isiadmin" width="100%" height="100%" frameborder="0">
		</iframe>
	<? } ?>
	</div>
	<div class="nama"><?=$_SESSION['namauser'].' ('.$_SESSION['nama_lengkap'].')'?></div>
</div>

<div id="fisheye" class="fisheye" >
<div class="fisheyeContainter">
<? 
	switch($_SESSION['leveluser']) {
	case 'admin':
		include('index2_admin.php');
		break;
	case 'kasir':
		include('index2_kasir.php');
		break;
	case 'kasir2':
		include('index2_kasir2.php');
		break;
	case 'p2d2s':
		include('index2_p2d2s.php');
		break;
	case 'aftap':
		include('index2_aftap.php');
		break;
	case 'konfirmasi':
		include('index2_konfirmasi.php');
		break;
	case 'imltd':
		include('index2_imltd.php');
		break;
	case 'komponen':
		include('index2_komponen.php');
		break;
	case 'qa':
		include('index2_qa.php');
		break;
	case 'qc':
		include('index2_qc.php');
		break;
	case 'laboratorium':
		include('index2_laborat.php');
		break;
	case 'logistik':
		include('index2_logistik.php');
		break;
	case 'mobile':
		include('index2_mobile.php');
		break;
        case 'bdrs':
		include('index2_bdrs.php');
		break;
        case 'pimpinan':
		include('index2_pimpinan.php');
		break;
	case 'konseling':
		include('index2_konseling.php');
		break;
	case 'keuangan':
		include('index2_keuangan.php');
		break;
	case 'diklat':
		include('index2_diklat.php');
		break;
	case 'monev':
		include('index2_monev.php');
		break;
	case 'saranaprasarana':
		include('index2_saranaprasarana.php');
		break;
	case 'tatausaha':
		include('index2_tatausaha.php');
		break;
	case 'kepegawaian':
		include('index2_kepegawaian.php');
		break;
	case 'mk':
		include('index2_mk.php');
		break;
	case 'dokumen':
		include('index2_dokumen.php');
		break;
	case 'fraksionasi':
		include('index2_fraksionasi.php');
		break;
	default;
		include('index2_kasir.php');
		break;


}
?>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(
		function()
		{
			$('#fisheye').Fisheye(
				{
					maxWidth: 30,
					items: 'a',
					itemsText: 'span',
					container: '.fisheyeContainter',
					itemWidth: 65,
					proximity: 90,
					halign : 'left'
				}
			)
			
		}
	);
</script>
</div>
