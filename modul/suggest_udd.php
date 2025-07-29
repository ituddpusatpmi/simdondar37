<?php

if ( !isset($_REQUEST['term']) )
    exit;
include "../config/koneksi.php";
//$dblink = mysql_connect('localhost', 'root', 'dewa') or die( mysql_error() );
//mysql_select_db('pmi');

$udd = mysql_query('select * from utd where nama like "%'. mysql_real_escape_string($_REQUEST['term']) .'%"');

$data = array();
if ( $udd && mysql_num_rows($udd) )
{
    while( $row = mysql_fetch_array($udd, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['nama'] .', '. $row['id'] ,
            'value' => $row['id']
        );
    }
}

echo json_encode($data);
flush();

