<?php

if ( !isset($_REQUEST['term']) )
    exit;
include "../config/koneksi.php";
//$dblink = mysql_connect('localhost', 'root', 'dewa') or die( mysql_error() );
//mysql_select_db('pmi');

$kel = mysql_query('select * from jenis_layanan where Nama like "%'. mysql_real_escape_string($_REQUEST['term']) .'%"');

$data = array();
if ( $kel && mysql_num_rows($kel) )
{
    while( $row = mysql_fetch_array($kel, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['Nama'],
            'value' => $row['Nama']
        );
    }
}

echo json_encode($data);
flush();
mysql_close();
