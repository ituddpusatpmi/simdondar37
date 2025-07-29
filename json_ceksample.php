<?
include "config/db_connect.php";

$no_kantong = mysql_real_escape_string($_GET[NoKantong]);
//$q_kantong=mysql_query("select Status from stokkantong where NoKantong='$no_kantong' 
//			and NoKantong like '%A' and Status='0' and StatTempat='1' ");
$q_kantong=mysql_query("select Hasil from hasilelisa where noKantong='$no_kantong'");

if (mysql_num_rows($q_kantong)=='1') {
    echo '{"sample": ';
    echo '{"valid":"1"}';
    echo '}';
} else {
    echo '{"sample": ';
    echo '"valid":"0"}';
    echo '}';
}
?>


