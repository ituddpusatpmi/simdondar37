<?
include "config/db_connect.php";
$today=date("Y-m-d");
$today1=date("Y-m-d H:i:s");
//$dokter=mysql_query("select * from stokkantong where Status='2' and NoKantong='$_GET[NoKantong]' and datediff('$today',cast(tgl_Aftap as date))<=35");
// MADIUN KARANTINA BISA KOMPONEN & BALI 
$dokter=mysql_query("select * from stokkantong where (Status='2' or Status='1') and NoKantong='$_GET[NoKantong]' and jenis >'1' ");
//$dokter=mysql_query("select * from stokkantong where  Status='2' and jenis!='1' and statkonfirmasi='1' and sah='1' and NoKantong='$_GET[NoKantong]'");

if (mysql_num_rows($dokter)=='1') {
echo '{"darah": ';
while($dokter1=mysql_fetch_assoc($dokter))
{
$jenis=$dokter1['jenis'];
$gol=$dokter1['gol_darah'];
$rhs=$dokter1['RhesusDrh'];
$tgl=$dokter1['tgl_Aftap'];
if ($tgl=='') $tgl=$today1;
echo '
{
"jenis_kantong":"'.$jenis.'",
"gol_darah":"'.$gol.'",
"rhs_darah":"'.$rhs.'",
"tgl_aftap":"'.$tgl.'",
"valid":"1"
}';
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
