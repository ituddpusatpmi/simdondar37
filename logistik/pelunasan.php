<?
include ('../config/db_connect.php');
	$no=mysql_real_escape_string($_GET[notrans]);
    	$query=mysql_query("select * from hstok_transaksi where hstok_transaksi.notrans='$no'");
        $r=mysql_fetch_array($query);
        $tot=$r['total'];  
            $master=mysql_query("update hstok_transaksi set bayar='$tot', sisa=0, pelunasan=curdate() where notrans='$no'");
	?> <META http-equiv="refresh" content="0; url=../pmilogistik.php?module=rekap_hutang">

