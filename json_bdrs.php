<?
include "config/db_connect.php";
$today=date("Y-m-d");
//$bdrs=mysql_query("select gol_darah from stokkantong where noKantong='$_GET[NoKantong]' and Status='2'");
//$bdrs=mysql_query("select gol_darah,RhesusDrh,produk,tgl_Aftap,kadaluwarsa,tglpengolahan from stokkantong where noKantong='$_GET[NoKantong]' and Status='2' and log=0 and hasil_release='1' and log='0' and (stat2 is null or stat2='0')");
$bdrs=mysql_query("select gol_darah,RhesusDrh,produk,tgl_Aftap,kadaluwarsa,tglpengolahan from stokkantong where noKantong='$_GET[NoKantong]' and Status='2' and hasil_release='1' and (stat2 is null or stat2='0') and `log`='0'");
if (mysql_num_rows($bdrs)=='1') {
    echo '{"darah": ';
    while($bdrs1=mysql_fetch_assoc($bdrs)){
        $gol=$bdrs1['gol_darah'];
        $produk=$bdrs1['produk'];
	$rh=$bdrs1['RhesusDrh'];
	$aftap=$bdrs1['tgl_Aftap'];
	$kadaluwarsa=$bdrs1['kadaluwarsa'];
	$olah=$bdrs1['tglpengolahan'];
        echo '
            {
                "gol_darah":"'.$gol.'",
                "produk":"'.$produk.'",
		"RhesusDrh":"'.$rh.'",
		"tgl_Aftap":"'.$aftap.'",
		"kadaluwarsa":"'.$kadaluwarsa.'",
		"tglpengolahan":"'.$olah.'",
                "valid":"1"
            }';
    }
    echo '}';
		$temp=mysql_query("UPDATE stokkantong set log=0 where noKantong='$_GET[NoKantong]'"); 
}

?>
