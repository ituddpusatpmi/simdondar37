<?php
include '../config/koneksi.php';

if ( !isset($_REQUEST['term']) )
    exit;
/*
$dblink = mysql_connect('localhost', 'root', 'dewa') or die( mysql_error() );
mysql_select_db('pmi');
*/
$rs = mysql_query('select * from detailinstansi where nama like "%'. mysql_real_escape_string($_REQUEST['term']) .'%"');

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['nama'] .', '. $row['KodeDetail'] ,
            'value' => $row['KodeDetail']
        );
    }
}

echo json_encode($data);
flush();

