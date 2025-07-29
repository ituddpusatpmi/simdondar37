<?php
//require_once('clogin.php');
include ('config/dbi_connect.php');
//session_start();
$namauser=$_SESSION['namauser'];
$op =   $_GET['op'];

if($op=='del'){
	$kantong    = $_GET['ktg'];
	$user		= $_GET['usr'];
    $level		= $_GET['bagian'];
    $sq_del   	= "DELETE FROM `ar_stokkantongtemp` WHERE `noKantong`='$kantong' AND  `bagian`='$level'";
	$sql_delete  = mysqli_query($dbi, $sq_del);
    echo $sq_del;
	if ($sql_delete){
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data BERHASIL dilakukan.")';
		echo '</script>';
        if ($level == "komponen"){ 
            header("Location: pmikomponen.php?module=musnah");
        }else{
            header("Location: pmiqa.php?module=musnah");
        }
	} else {
		echo '<script language="javascript">';
		echo 'alert("Penghapusan data GAGAL.")';
		echo '</script>';
        if ($level == "komponen"){
            header("Location: pmikomponen.php?module=musnah");
        }else{
            header("Location: pmiqa.php?module=musnah");
        }
	}
}

if($op=='batal'){
    $user		= $_GET['usr'];
    $level		= $_GET['bagian'];
    $sq_del   	= "DELETE FROM `ar_stokkantongtemp` WHERE `bagian`='$level'";
    echo $sq_del;
    
    $sql_delete  = mysqli_query($dbi, $sq_del);
    
        if ($level == "komponen"){
            header("Location: pmikomponen.php?module=musnahlist");
        }else if ($level == "qa"){
            header("Location: pmiqa.php?module=musnahlist");
        }else if ($level == "imltd"){
            header("Location: pmiimltd.php?module=musnahlist");
        }
    
}




?>
