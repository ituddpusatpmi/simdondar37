<?php
session_start();
require_once('../config/db_connect_server.php');

$idp	= mysql_query("select id from utd where aktif='1'",$con);
$idp1	= mysql_fetch_assoc($idp);
$id_udd=$idp1['id'];
//echo $id_udd;
//-------------- Upload quarantine blood to server -----------------
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='A' )",$con));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='B' )",$con));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='AB' )",$con));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='O' )",$con));
$X=mysql_num_rows(mysql_query("select Status from stokkantong
		where Status='1' and sah='1' and (gol_darah!='A' or gol_darah!='B' or gol_darah!='AB' or gol_darah!='O') ",$con));

$q_insert	=mysql_query("
					INSERT INTO stok (id_udd,status,wb_a,wb_b,wb_ab,wb_o,wb_x)
					VALUES ('$id_udd','1','$A','$B','$AB','$O','$X')
					ON DUPLICATE KEY
					UPDATE 
                    wb_a='$A',wb_b='$B',wb_ab='$AB',wb_o='$O',wb_x='$X'
                    ",$con_server);
//-------------- End quarantine blood to server -----------------

mysql_close($con);
mysql_close($con_server);

echo mysql_error();
?>
