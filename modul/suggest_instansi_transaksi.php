<?php
include '../config/koneksi.php';

if ( !isset($_REQUEST['term']) )
    exit;
/*
$dblink = mysql_connect('localhost', 'root', 'dewa') or die( mysql_error() );
mysql_select_db('pmi');
*/
$rs = mysql_query('select Instansi from htransaksi where Instansi like "%'. mysql_real_escape_string($_REQUEST['term']) . '%" GROUP BY Instansi');

$data = array();
if ( $rs && mysql_num_rows($rs) )
{
    while( $row = mysql_fetch_array($rs, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['Instansi'],
            'value' => $row['Instansi']
        );
    }
}
$data[] = array(
    'label' => 'DALAM GEDUNG',
    'value' => 'DALAM GEDUNG'
);

echo json_encode($data);
flush();

