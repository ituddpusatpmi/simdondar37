<?
include "config/db_connect.php";
$barang=mysql_query("select * from pendonor where Kode='$_GET[kode]'");
echo '{"barang": ';
    while($barang1=mysql_fetch_assoc($barang)){
        $kode=$barang1['Kode'];
        $nama=$barang1['Nama'];
        $stok=$barang1['Alamat'];
        $harga=$barang1['harga'];
        $reagenujs=$barang1['reagenujs'];
        $ketsatuan=$barang1['ketsatuan'];
        echo '{
            "kode":"'.$kode.'",
            "nama":"'.$nama.'",
            "stok":"'.$stok.'",
            "harga":"'.$harga.'",
            "reagenujs":"'.$reagenujs.'",
            "ketsatuan":"'.$ketsatuan.'"
        }';
    }
    echo '}';
?>

<!--
<?
include "config/db_connect.php";
$barang=mysql_query("select kode,namabrg,stoktotal,harga,reagenujs,ketsatuan from hstok where kode='$_GET[kode]'");
echo '{"barang": ';
    while($barang1=mysql_fetch_assoc($barang)){
        $kode=$barang1['kode'];
        $nama=$barang1['namabrg'];
        $stok=$barang1['stoktotal'];
        $harga=$barang1['harga'];
        $reagenujs=$barang1['reagenujs'];
        $ketsatuan=$barang1['ketsatuan'];
        echo '{
            "kode":"'.$kode.'",
            "nama":"'.$nama.'",
            "stok":"'.$stok.'",
            "harga":"'.$harga.'",
            "reagenujs":"'.$reagenujs.'",
            "ketsatuan":"'.$ketsatuan.'"
        }';
    }
    echo '}';
?>
-->
