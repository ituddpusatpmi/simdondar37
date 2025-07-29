<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
?>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMDONDAR</title>
</head>
<a href="pmiimltd.php?module=import_arc2000"class="swn_button_blue">Kembali</a>
<body>
<iframe src="architec/imltd_import_arc_manual" width="100%" height="90%"></iframe>
</body>
