<?php

if ( !isset($_REQUEST['term']) )
    exit;
include "../config/koneksi.php";
//$dblink = mysql_connect('localhost', 'root', 'dewa') or die( mysql_error() );
//mysql_select_db('pmi');

$rs = mysql_query('select * from rmhsakit where NamaRs like "%'. mysql_real_escape_string($_REQUEST['term']) .'%"');

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['NamaRs'] .', '. $row['Kode'] ,
            'value' => $row['Kode']
        );
    }
}

echo json_encode($data);
flush();

