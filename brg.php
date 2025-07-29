<?
include "config/db_connect.php";
$barang=mysql_query("select kode,namabrg,stoktotal,harga from hstok where kode='$_GET[kode]'");
echo '{"barang": ';
    while($barang1=mysql_fetch_assoc($barang)){
        $kode=$barang1['kode'];
        $nama=$barang1['namabrg'];
        $stok=$barang1['stoktotal'];
        $harga=$barang1['harga'];
        echo '{
            "kode":"'.$kode.'",
            "nama":"'.$nama.'",
            "stok":"'.$stok.'",
            "harga":"'.$harga.'"
        }';
    }
    echo '}';
?>
