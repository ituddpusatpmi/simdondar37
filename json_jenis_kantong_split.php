<?php
include "config/db_connect.php";
$today=date("Y-m-d");
$today1=date("Y-m-d H:i:s");
$stokktg=mysql_query("select jenis, Status, merk, produk, gol_darah, RhesusDrh, tgl_Aftap, metoda, lama_pengambilan, DATE_ADD(tgl_Aftap, INTERVAL 1 DAY) as besok, kodePendonor, abs, nolot_ktg from stokkantong where (Status='2' or Status='1') and NoKantong='$_GET[NoKantong]'");

if (mysql_num_rows($stokktg)=='1') {
    echo '{"darah": ';
    while($stokk=mysql_fetch_assoc($stokktg)) {
        $jenis=$stokk['jenis'];
        $stt=$stokk['Status'];
        $mrk=$stokk['merk'];
        $prd=$stokk['produk'];
        $gol=$stokk['gol_darah'];
        $rhs=$stokk['RhesusDrh'];
        $tgl=$stokk['tgl_Aftap'];
        $besok=$stokk['besok'];
        $mtd=$stokk['metoda'];
        $durasi=$stokk['lama_pengambilan'];
        $kodep=$stokk['kodePendonor'];
        $abs=$stokk['abs'];
        $nolot=$stokk['nolot_ktg'];

        

	if($mrk=='HAEMONETIC'){
	    if($tgl=='') $tgl=$today1;
        echo ' {
        "jenis_kantong":"'.$jenis.'",
        "merk":"'.$mrk.'",
        "metoda":"'.$mtd.'",
        "gol_darah":"'.$gol.'",
        "rhs_darah":"'.$rhs.'",
        "tgl_aftap":"'.$tgl.'",
        "besok":"'.$besok.'",
        "stt":"'.$stt.'",
        "prd":"'.$prd.'",
        "durasi":"'.$durasi.'",
        "kodep":"'.$kodep.'",
        "abs0":"'.$abs.'",
        "nolot0":"'.$nolot.'",
        "valid":"1" }';	
	}else if($mrk='COM.TECH'){
	    if($tgl=='') $tgl=$today1;
        echo ' {
        "jenis_kantong":"'.$jenis.'",
        "merk":"'.$mrk.'",
        "metoda":"'.$mtd.'",
        "gol_darah":"'.$gol.'",
        "rhs_darah":"'.$rhs.'",
        "tgl_aftap":"'.$tgl.'",
        "besok":"'.$besok.'",
        "stt":"'.$stt.'",
        "prd":"'.$prd.'",
        "durasi":"'.$durasi.'",
        "kodep":"'.$kodep.'",
        "abs0":"'.$abs.'",
        "nolot0":"'.$nolot.'",
        "valid":"1" }';	
	}else if($mrk='AMICORE'){
	    if($tgl=='') $tgl=$today1;
        echo ' {
        "jenis_kantong":"'.$jenis.'",
        "merk":"'.$mrk.'",
        "metoda":"'.$mtd.'",
        "gol_darah":"'.$gol.'",
        "rhs_darah":"'.$rhs.'",
        "tgl_aftap":"'.$tgl.'",
        "besok":"'.$besok.'",
        "stt":"'.$stt.'",
        "prd":"'.$prd.'",
        "durasi":"'.$durasi.'",
        "kodep":"'.$kodep.'",
        "abs0":"'.$abs.'",
        "nolot0":"'.$nolot.'",
        "valid":"1" }';	
	}
        else{
            if($tgl=='') $tgl=$today1;
        echo ' {
        "jenis_kantong":"'.$jenis.'",
        "merk":"'.$mrk.'",
        "metoda":"'.$mtd.'",
        "gol_darah":"'.$gol.'",
        "rhs_darah":"'.$rhs.'",
        "tgl_aftap":"'.$tgl.'",
        "besok":"'.$besok.'",
        "stt":"'.$stt.'",
        "prd":"'.$prd.'",
        "durasi":"'.$durasi.'",
        "kodep":"'.$kodep.'",
        "abs0":"'.$abs.'",
        "nolot0":"'.$nolot.'",
        "valid":"1" }';
        }
    }
    echo '}';
} else
{
    echo '{"darah": ';
    echo '
"gol_darah":"",
"valid":"0"
}';
    echo '}';
}
?>
