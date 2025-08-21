<?php

if ( !isset($_REQUEST['term']) )
    exit;
include "../config/koneksi.php";

$query = mysql_query('select Nama, TglLhr from pendonor where Nama like "%' . mysql_real_escape_string($_REQUEST['term']) . '%" order by Nama asc limit 20');

$data = array();
if ($query && mysql_num_rows($query) )
{
    while( $row = mysql_fetch_array($query, MYSQL_ASSOC) )
    {
        $data[] = array(
            'label' => $row['Nama'] .' ('. $row['TglLhr'].')',
            'value' => $row['Nama'],
            'tgl' => date('d', strtotime($row['TglLhr'])),
            'bln' => date('m', strtotime($row['TglLhr'])),
            'thn' => date('Y', strtotime($row['TglLhr']))
        );
    }
}

echo json_encode($data);
flush();

