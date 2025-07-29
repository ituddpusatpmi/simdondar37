<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];

$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='tambah'){
    $data=mysql_query("select * from hstok where stoktotal>0");
    echo"<option>Barang</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}
elseif($op=='hapus'){
    $nopol=$_GET['nopol'];
    $cek=mysql_fetch_row(mysql_query("select id from mobil_transaksi where nopol='$nopol'"));
    if ($cek>0){
        echo "<script>alert('Master Kendaraan ini tidak bisa dihapus, karena sudah ada data transaksi pembiayaan yang dimasukkan.')</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=../pmimobile.php?module=master_kendaraan\">";
    } else{
        $del=mysql_query("delete from mobil where nopol='$nopol'");
        if ($del){
            echo "<script>alert('Data kendaraan telah dihapus.')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=../pmimobile.php?module=master_kendaraan\">";
        } 
    }
}

?>
