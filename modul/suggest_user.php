<?php
include '../config/koneksi.php';

if ( !isset($_REQUEST['term']) )
    exit;
/*
$dblink = mysql_connect('localhost', 'root', 'dewa') or die( mysql_error() );
mysql_select_db('pmi');
*/
$rs = mysql_query('select * from user where nama_lengkap like "%'. mysql_real_escape_string($_REQUEST['term']) .'%"');

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['nama_lengkap'] .', '. $row['level'] ,
            'value' => $row['nama_lengkap']
        );
    }
}

echo json_encode($data);
flush();

