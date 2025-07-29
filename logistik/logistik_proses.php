<?php
include "db/koneksi.php";
session_start();
$namauser=$_SESSION[namauser];
$levelusr=$_SESSION[leveluser];
$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='cekulang'){
    $kode=$_GET['kode'];
    echo "Kode : $kode";
    $sql    = mysql_query("SELECT (SUM(qtymasuk) - SUM(qtykeluar)) AS stok FROM hstok_transaksi_detail WHERE kode = '$kode'");
    $sql1   = mysql_fetch_array($sql);
    $stok   = $sql1['stok'];
    echo "stok = $stok<br>";
    $master=mysql_query("update hstok set stoktotal='$stok' where kode='$kode'"); 
}

if($op=='cekulangsemua'){
    $qbrg    = mysql_query("SELECT kode, namabrg, stoktotal FROM hstok order by kode");
    $no=0;
    echo '<table border=1 width=900px>';
    echo '<tr>
            <td>NO</td>
            <td>KODE</td>
            <td>NAMA BARANG</td>
            <td>STOK</td>
            <td>RE-STOK</td>
          </tr>';
    while($brg=mysql_fetch_row($qbrg)){
        $no++;
        $sql    = mysql_query("SELECT (SUM(qtymasuk) - SUM(qtykeluar)) AS stok FROM hstok_transaksi_detail WHERE kode = '$brg[0]'");
        $sql1   = mysql_fetch_array($sql);
        $stok   = $sql1['stok'];
        $master=mysql_query("update hstok set stoktotal='$stok' where kode='$kode'");
        echo "<tr>
            <td align=right>$no.</td>
            <td>$brg[0]</td>
            <td>$brg[1]</td>
            <td align=right>$brg[2]</td>
            <td align=right>$stok</td>
          </tr>";
    }
    echo '</table>';
    //=======Audit Trial====================================================================================
   $log_mdl =$levelusr;
   $log_aksi='Cek Ulang stok barang';
   include_once "user_log.php";
   //=====================================================================================================	
}

?>
