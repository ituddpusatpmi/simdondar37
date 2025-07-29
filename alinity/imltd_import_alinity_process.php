<?php
require_once('clogin.php');
require_once('config/db_connect_lis.php');
session_start();
$namauser=$_SESSION[namauser];
$today=date("Y-m-d");

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

//update reagen
if($op=='reagen'){
	$jmltestb	= $_GET['tesb'];
	$jmltestc	= $_GET['tesc'];
	$jmltests	= $_GET['tess'];
	$jmltesti	= $_GET['tesi'];
	$kodereagenb	= $_GET['reagb'];
	$kodereagenc	= $_GET['reagc'];
	$kodereagent	= $_GET['reagt'];
	$kodereageni	= $_GET['reagi'];
	$sql=mysql_query("update reagen set jumTest=jumTest-$jmltestb where kode='$kodereagenb'");
	$sql=mysql_query("update reagen set jumTest=jumTest-$jmltestc where kode='$kodereagenc'");
	$sql=mysql_query("update reagen set jumTest=jumTest-$jmltestt where kode='$kodereagent'");
	$sql=mysql_query("update reagen set jumTest=jumTest-$jmltesti where kode='$kodereageni'");
}

//aksi kantong
if($op=='kantong'){
	$kantong	= $_GET['kantong'];
	$konfirm	= $_GET['konfirm'];
	$no_kantong=substr($kantong,0,-1);
	
}
//Delete  Raw
if($op=='del'){
	$instrument	= $_GET['ins'];
	$tgl		= $_GET['tgl'];
	$user		= $_GET['usr'];
	$sq_del   	= "DELETE FROM lis_pmi.`alinity_i` WHERE `instrument_name`='$instrument'  AND `operator`='$user' AND
				DATE(`run_time`)='$tgl' AND `confirm`='0'";
    echo "$q_del<br>";
	$sql_delete  = mysql_query($sq_del);
	if ($sql_delete){
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data BERHASIL dilakukan.")';
		echo '</script>';
        header("Location: pmiimltd.php?module=alinitylistkonfirmasi");
	} else {
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data GAGAL.")';
		echo '</script>';
        header("Location: pmiimltd.php?module=alinitylistkonfirmasi");
	}

}

?>
