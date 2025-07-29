<?php
session_start();
include '../config/dbi_connect.php';
//include '../config/dta_config.php';


$udd=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `nama`,`id` FROM `utd` WHERE `aktif`='1';"));
$id_uddaktif=$udd['id'];
$nama_uddaktif=$udd['nama'];
$g_noserahterima = $_GET['id'];
$mode           = $_GET['mode'];
$shift_terima   =   mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `nama` FROM `shift` WHERE `jam`<=current_time() and `sampai_jam`>=current_time()"));
$shift          =   $shift_terima['nama'];
$arr_sr         = array();
$arr_srd        = array();
$arr_kantong    = array();
$arr_pendonor   = array();
$arr_ht         = array();

$tgl        = date('Ymd');
$token      = "17091945".$tgl;
$sekarang   = date("Y-m-d H:i:s");


//Cari Serahterima 

$curlsr = curl_init();
    curl_setopt_array($curlsr, array(
    CURLOPT_URL => "https://dbdonor.pmi.or.id/konsolidasi/get_proses_transaksi.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array('trans' => $g_noserahterima, 'mode' => 'hapus'),
    ));
    $responsesr = curl_exec($curlsr);
    curl_close($curlsr);   
?>


<meta http-equiv="refresh" content="0; url=?module=sr_aftap_kns">