<?php
require_once('clogin.php');
require_once('config/db_connect.php');
session_start();
$namauser=$_SESSION[namauser];
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='del'){
	$kantong    = $_GET['ktg'];
	$user		= $_GET['usr'];
    $modul		= $_GET['mdl'];
    $sq_del   	= "DELETE FROM `serahterima_detail_tmp` WHERE `dst_nokantong`='$kantong' AND `dst_user`='$user' AND `dst_modul`='$modul'";
	$sql_delete  = mysql_query($sq_del);
	if ($sql_delete){
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data BERHASIL dilakukan.")';
		echo '</script>';
        header("Location: pmiaftap.php?module=sr_aftap");
	} else {
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data GAGAL.")';
		echo '</script>';
        header("Location: pmiaftap.php?module=sr_aftap");
	}
}

if($op=='batal'){
    $user		= $_GET['usr'];
    $modul		= $_GET['mdl'];
    $sq_del   	= "DELETE FROM `serahterima_detail_tmp` WHERE `dst_user`='$user' AND `dst_modul`='$modul'";
    $sql_delete  = mysql_query($sq_del);
    if ($sql_delete){
        echo '<script language="javascript">';
        echo 'alert("Penghapusan data BERHASIL dilakukan.")';
        echo '</script>';
        header("Location: pmiaftap.php?module=serahterima");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Penghapusan data GAGAL.")';
        echo '</script>';
        header("Location: pmiaftap.php?module=serahterima");
    }
}

if($op=='deltrx'){
    $notrx		= $_GET['no'];
    $sq_delh   	= "DELETE FROM `serahterima_detail` WHERE `dst_notrans`='$notrx'";
    $sql_delete  = mysql_query($sq_delh);
    $sq_deld   	= "DELETE FROM `serahterima` WHERE `hst_notrans`='$notrx'";
    $sql_delete  = mysql_query($sq_deld);
    if ($sql_delete){
        echo '<script language="javascript">';
        echo 'alert("Penghapusan data BERHASIL dilakukan.")';
        echo '</script>';
        header("Location: pmikomponen.php?module=sr_aftap_list");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Penghapusan data GAGAL.")';
        echo '</script>';
        header("Location: pmikomponen.php?module=sr_aftap_list");
    }
}

if($op=='kosongkan'){
    $user		= $_GET['usr'];
    $modul		= $_GET['mdl'];
    $sq_del   	= "DELETE FROM `serahterima_detail_tmp` WHERE `dst_user`='$user' AND `dst_modul`='$modul'";
    $sql_delete  = mysql_query($sq_del);
    if ($sql_delete){
        echo '<script language="javascript">';
        echo 'alert("Penghapusan data BERHASIL dilakukan.")';
        echo '</script>';
        header("Location: pmikomponen.php?module=sr_aftap");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Penghapusan data GAGAL.")';
        echo '</script>';
        header("Location: pmikomponen.php?module=sr_aftap");
    }
}
?>
