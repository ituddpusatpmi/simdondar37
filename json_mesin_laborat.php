<?php
/**
 * Created by PhpStorm.
 * User: irawandb
 * Date: 5/13/18
 * Time: 3:35 PM
 */
include "config/db_connect.php";
$alat1=mysql_query("select * from logbook_h WHERE no_inventarisasi='$_GET[mesin]'");

if (mysql_num_rows($alat1)=='1') {
    echo '{"alat": ';
    while($alat=mysql_fetch_assoc($alat1)) {
        $id     = $alat['id'];
        $kode	= $alat['kode'];
        $noinv  = $alat['no_inventarisasi'];
        $nmalat = $alat['nama_barang'];
        $noseri = $alat['sn'];

        echo ' {
        "noinv":"'.$noinv.'",
        "nmalat":"'.$nmalat.'",
	"kode":"'.$kode.'",
        "noseri":"'.$noseri.'" }';
        }
    echo '}';
}
?>
