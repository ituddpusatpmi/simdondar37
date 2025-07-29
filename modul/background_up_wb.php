<?php
session_start();
require_once('../config/db_connect_server.php');

$q_cek_update=mysql_query("select * from log_update where jenis='update_stok' ",$con);
$a_cek_update=mysql_fetch_assoc($q_cek_update);
$terakhir=$a_cek_update['waktu'];

$idp	= mysql_query("select id from utd where aktif='1'",$con);
$idp1	= mysql_fetch_assoc($idp);
$id_udd=$idp1['id'];
echo $id_udd;
//-------------- Upload quarantine blood to server -----------------
$q_update=mysql_query("SELECT wb_a,wb_b,wb_ab,wb_o,wb_x
			FROM `stok`
			WHERE `status` = '1'
			",$con);
while($b=mysql_fetch_assoc($q_update)){
    $wb_a	=$b["wb_a"];	$wb_b	=$b["wb_b"];
    $wb_ab	=$b["wb_ab"];	$wb_o	=$b["wb_o"];
    $wb_x	=$b["wb_x"];
    $q_insert	=mysql_query("UPDATE stok SET
                    wb_a='$wb_a',wb_b='$wb_b',wb_ab='$wb_ab',wb_o='$wb_o',wb_x='$wb_x'
                    WHERE id_udd='$id_udd' AND status='1' ",$con_server);
}
//-------------- End quarantine blood to server -----------------
//-------------- Upload healhty blood to server -----------------
$q_update=mysql_query("SELECT wb_a,wb_b,wb_ab,wb_o,wb_x
			FROM `stok`
			WHERE `status` = '0'
			",$con);
while($b=mysql_fetch_assoc($q_update)){
    print_r($b);
    $wb_a	=$b["wb_a"];	$wb_b	=$b["wb_b"];
    $wb_ab	=$b["wb_ab"];	$wb_o	=$b["wb_o"];
    $wb_x	=$b["wb_x"];
    $q_insert	=mysql_query("UPDATE stok SET
                    wb_a='$wb_a',wb_b='$wb_b',wb_ab='$wb_ab',wb_o='$wb_o',wb_x='$wb_x'
                    WHERE id_udd='$id_udd' AND status='0'",$con_server);
}
//-------------- End healhty blood to server -----------------
//}
?>