<?php
ini_set('display_errors', 1);
//Set Time WIB di Server Pusat
date_default_timezone_set("Asia/Jakarta");
$start_con= new DateTime(date("Y-m-d H:i:s"));

//Config Data Pusat
$hostpusat = 'simdondar.dynns.com';
$userpusat = 'utdpmi';
$pwdpusat = 'utdpmi10022017';
//$hostpusat = 'localhost';
//$userpusat = 'root';
//$pwdpusat = 'F201603907';
$datapusat = 'utdnasional';

//Config Data Lokal
$hostlocal = 'localhost';
$userlocal = 'root';
$pwdlocal = 'F201603907';
$datalocal= 'pmi';

//Koneksi ke Data Pusat
try {
    $dbpusat = new PDO("mysql:host=$hostpusat;dbname=$datapusat", $userpusat, $pwdpusat);
    $end_con=new DateTime(date("Y-m-d H:i:s"));
    $interval = $start_con->diff($end_con);
    echo "Data Pusat OK: ".$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

//Koneksi ke Data Lokal
$start_con= new DateTime(date("Y-m-d H:i:s"));
try {
    $dblocal = new PDO("mysql:host=$hostlocal;dbname=$datalocal", $userlocal, $pwdlocal);
    $end_con=new DateTime(date("Y-m-d H:i:s"));
    $interval = $start_con->diff($end_con);
    echo "Data Lokal OK: ".$interval->format('%H').":".$interval->format('%I').":".$interval->format('%S')."\n";
    //print "Data Lokal: OK\n";
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

//Set PDO Error Message
$dbpusat->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$dblocal->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
