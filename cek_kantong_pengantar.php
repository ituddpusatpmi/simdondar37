
<?php
require_once('config/koneksi.php');
$no_label = $_GET['no_label'];
$noform = $_GET['noform'];
	// Escape User Input to help prevent SQL Injection
$no_label = mysql_real_escape_string($no_label);
$noform= mysql_real_escape_string($noform);
	//build query
$query = "SELECT noKantong,gol_darah,tgl_Aftap,produk,rhesusDrh FROM stokkantong WHERE noKantong='$no_label' and Status='3'";
	//Execute query
$qry_result = mysql_query($query) or die(mysql_error());

$query1 = "SELECT MetodeCross,StatusCross,tgl,stat2 FROM dtransaksipermintaan WHERE NoKantong='$no_label' and Status='0'";
	//Execute query
$qry_result1 = mysql_query($query1) or die(mysql_error());

	//Build Result String

$qk=mysql_query("select * from dtransaksipermintaan where NoForm='$noform' and NoKantong='$no_label' and Status='0'");
if ($qk==0) {
$row = mysql_fetch_assoc($qry_result);
$row1 = mysql_fetch_assoc($qry_result1);
$pjg_ktg = strlen($row[noKantong]);
//$no= substr($row[noKantong],0,$pjg_ktg-1);
$no= $row[noKantong];
$pjg_tgl = strlen($row[tgl_Aftap]);
$tgl= substr($row[tgl],0,$pjg_tgl-9);
$pjg_tgl1 = strlen($row[tgl]);
$tgl1= substr($row1[tgl],0,$pjg_tgl1-9);
echo '{"kantong":';
echo '{"noKantong":"'.$no.'"';
echo ',"gol_darah":"'.$row[gol_darah].'"';
echo ',"rh_darah":"'.$row[rhesusDrh].'"';
echo ',"tgl_aftap":"'.$tgl.'"';
echo ',"produk":"'.$row[produk].'"';
echo ',"metodecross":"'.$row1[MetodeCross].'"';
echo ',"tgl_cross":"'.$tgl1.'"';
echo ',"statuscross":"'.$row1[StatusCross].'"';
echo ',"ketcross":"'.$row1[stat2].'"';
echo '}';
echo '}';
} else
{
echo '{"kantong": ';
echo '{
"noKantong":"",
"valid":"0"
}';
echo '}';
}
?>
