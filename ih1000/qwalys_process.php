<?php
require_once('clogin.php');
require_once('config/db_connect.php');
session_start();
$namauser=$_SESSION[namauser];


$op=isset($_GET['op'])?$_GET['op']:null;

//cekal pendonor
if($op=='donorcekal'){
    //MENCEKAL PENDONOR BERDASARKAN INPUT NOMOR KANTONG
    $kantong=$_GET['kantong'];
    //Cari Kode Pendonornya
    $no_kantong=substr($kantong,0,-1);
    $no_kantong=$no_kantong.'A';
    $pendonor=mysql_query("select kodePendonor as kode from htransaksi where NoKantong='$no_kantong'");
	$datapendonor=mysql_fetch_assoc($pendonor);
	$idpendonor=$datapendonor['kode'];
	$upd_donor_cekal=mysql_query("UPDATE pendonor SET Cekal='1' WHERE Kode='$idpendonor'");
	//insert ke table cekal
	$tambah_cekal=mysql_query("insert into cekal ('$idpendonor','$today','$_SESSION[namauser]','1')");
}

//Delete ABS Raw
if($op=='del'){
	$sn			= $_GET['sn'];
	$tgl		= $_GET['tgl'];
	$user		= $_GET['user'];
    $plate		= $_GET['plate'];
    $param		= $_GET['param'];

    $sq_del   	= "DELETE FROM `qwalys_abs_raw` WHERE `sn`='$sn' AND `operator`='$user' AND
				   DATE(`runtime`)='$tgl' AND `parameter2`='$param' AND `confirm` is null ";
	$sql_delete  = mysql_query($sq_del);
	if ($sql_delete){
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data BERHASIL dilakukan.")';
		echo '</script>';
        header("Location: pmikonfirmasi.php?module=konfirm_abs");
	} else {
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data GAGAL.")';
		echo '</script>';
        header("Location: pmikonfirmasi.php?module=konfirm_abs");
	}
}

?>
