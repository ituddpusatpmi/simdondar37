<?php
require_once('config/koneksi.php');
$no_form = $_GET['no_form'];
	// Escape User Input to help prevent SQL Injection
$no_form = mysql_real_escape_string($no_form);
	//build query
//$jck=mysql_num_rows(mysql_query("select * from dtransaksipermintaan where NoForm='$no_form'"));
$jck=0;
$jck=mysql_num_rows(mysql_query("select * from dtransaksipermintaan where NoForm='$no_form' and stat3='ok'"));
//$jck1=mysql_fetch_assoc(mysql_query("select sum(Jumlah) as Jumlah from dtranspermintaan where NoForm='$no_form'"));
$jck1=mysql_fetch_assoc(mysql_query("select sum(Jumlah) as Jumlah,sum(JTitip) as JTitip from dtranspermintaan where NoForm='$no_form' and stat3='ok'"));
//$query = "SELECT * FROM htranspermintaan WHERE NoForm='$no_form'";
$query = "SELECT * FROM htranspermintaan WHERE noform='$no_form' stat3='ok'";
//$query1 = "SELECT GolDarah FROM dtranspermintaan WHERE NoForm='$no_form'";
$query1 = "SELECT GolDarah FROM dtranspermintaan WHERE NoForm='$no_form' stat3='ok'";
	//Execute query
//if ($jck<$jck1[Jumlah]) {

$jck2=$jck1[Jumlah]-$jck;
$jck3=$jck1[Jumlah]-$jck1[JTitip];
$qry_result = mysql_query($query) or die(mysql_error());
$qry_result1 = mysql_query($query1) or die(mysql_error());
//} 

	//Build Result String
$row = mysql_fetch_assoc($qry_result);
$row1 = mysql_fetch_assoc($qry_result1);
echo '{"form":';
echo '{"no_form":"'.$row['noform'].'"';
echo ',"gol_darah":"'.$row1['GolDarah'].'"';
echo ',"cross":"'.$jck2.'"';
echo ',"sudahcross":"'.$jck.'"';
echo ',"minta":"'.$jck3.'"';
echo '}';
echo '}';
?>
