<?php
header('Content-Type: application/json');

//include "config/dbi_connect.php"; 
include "../config/dbi_connect.php"; 

$inputan = isset($_POST['inputan']) ? $_POST['inputan'] : '';
$barcode = isset($_POST['barcode']) ? $_POST['barcode'] : '';
$kolom   = isset($_POST['kolom']) ? $_POST['kolom'] : '1';

$response = array();

$inputan = strtoupper(trim(str_replace(" ", "", $inputan)));

function isNomorKantong($inputan)
{
    return preg_match('/^[A-Z0-9]{9,19}$/i', $inputan);
}

function isNomorTransaksi($inputan) {
    //return preg_match('/^KV\d{3}[A-Z]-\d{6}-\d{4}$/i', $inputan); 
    return preg_match('/^KV[0-9]{3}[A-Z]-[0-9]{6}-[0-9]{4}$/i', $inputan); 
}

if (!$inputan || !$barcode || !$kolom) {
    header("HTTP/1.1 400 Bad Request");
    echo "Parameter tidak lengkap.";
    exit;
}

if (isNomorKantong($inputan)) {
    $cek = mysqli_query($dbi, "SELECT * FROM stokkantong WHERE noKantong='$inputan' LIMIT 1");
    if (mysqli_num_rows($cek) > 0) {
        $response['status'] = 'ok';
        $response['tipe'] = 'kantong';
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "Nomor kantong tidak ditemukan.";
        exit;
    }

} elseif (isNomorTransaksi($inputan)) {
    $cek = mysqli_query($dbi, "SELECT * FROM dpengolahan WHERE NoTrans='$inputan'");
    if (mysqli_num_rows($cek) > 0) {
        $response['status'] = 'ok';
        $response['tipe'] = 'transaksi';
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "Transaksi tidak ditemukan.";
        exit;
    }

} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Format input tidak dikenali. Inputan: " . htmlspecialchars($inputan) . 
         ", Barcode: " . htmlspecialchars($barcode) . 
         ", Kolom: " . htmlspecialchars($kolom);
    exit;
}

echo json_encode($response);

