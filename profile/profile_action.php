<?php
require_once('config/db_connect.php');
$aksi   = $_GET['act'];
$modul  = $_GET['mdl'];
$id     = $_GET['x'];
$tahun  = $_GET['t'];
$bulan  = $_GET['b'];
switch ($modul){
    case "rtd":
        if ($aksi=='d'){
            $q_del="DELETE FROM `rpt_data_reaksi_td` WHERE `rtd_id`='$id'";
            $q_del=mysql_query($q_del);
        }
        ?><META http-equiv="refresh" content="0;URL=pmitatausaha.php?module=reaksi_transfusi"><?php
        break;
    case "bangunan":
        if ($aksi=='d'){
            $q_del="DELETE FROM `rpt_data_bangunan` WHERE `b_id`='$id'";
            $q_del=mysql_query($q_del);
        }
        ?><META http-equiv="refresh" content="0;URL=pmitatausaha.php?module=databangunan"><?php
        break;
    case "sdm":
        if ($aksi=='d'){
            $q_del="DELETE FROM `rpt_data_sdm` WHERE `sdm_id`='$id'";
            $q_del=mysql_query($q_del);
        }
        ?><META http-equiv="refresh" content="0;URL=pmitatausaha.php?module=personalia"><?php
        break;
}
?>