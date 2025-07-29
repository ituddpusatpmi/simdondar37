<?php
session_start();
require_once('../config/db_connect_server.php');

$idp	= mysql_query("select id from utd where aktif='1'",$con);
$idp1	= mysql_fetch_assoc($idp);
$id_udd=$idp1['id'];
echo $id_udd;
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
//-------------- Upload healhty blood to server -----------------
$produk=mysql_query("select * from produk order by no",$con);
while ($produk1=mysql_fetch_assoc($produk)) {
	$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and (stat2='0' or stat2 is null))",$con));
	$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and (stat2='0' or stat2 is null))",$con));
	$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and (stat2='0' or stat2 is null))",$con));
	$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and (stat2='0' or stat2 is null))",$con));
	$pa=$produk1[Nama]."_a";
	$pb=$produk1[Nama]."_b";
	$pab=$produk1[Nama]."_ab";
	$po=$produk1[Nama]."_o";
	
	$q_insert	=mysql_query("
					INSERT INTO stok (id_udd,status,$pa,$pb,$pab,$po)
					VALUES ('$id_udd','0','$A','$B','$AB','$O')
					ON DUPLICATE KEY
					UPDATE 
                    $pa='$A',$pb='$B',$pab='$AB',$po='$O'
                    ",$con_server);
}
//-------------- End healhty blood to server -----------------

//-------------- Upload reserved blood to server -----------------
$produk=mysql_query("select * from produk order by no",$con);
while ($produk1=mysql_fetch_assoc($produk)) {
	$A=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='A'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')",$con));
	$B=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='B'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')",$con));
	$AB=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='AB'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')",$con));
	$O=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='O'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')",$con));
	$pa=$produk1[Nama]."_a";
	$pb=$produk1[Nama]."_b";
	$pab=$produk1[Nama]."_ab";
	$po=$produk1[Nama]."_o";
	$q_insert	=mysql_query("
					INSERT INTO stok (id_udd,status,$pa,$pb,$pab,$po)
					VALUES ('$id_udd','2','$A','$B','$AB','$O')
					ON DUPLICATE KEY
					UPDATE 
                    $pa='$A',$pb='$B',$pab='$AB',$po='$O'
                    ",$con_server);
}
//-------------- End reserved blood to server -----------------
mysql_close($con);
mysql_close($con_server);

echo mysql_error();
?>