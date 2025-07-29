<?php
session_start();
include '../config/dbi_connect.php';
header("Content-Type: application/json");
if (!isset($_POST['noTransaksi']) || !isset($_POST['dari']) || !isset($_POST['kirimKe'])) {
    echo json_encode(array("status" => "error", "message" => "Parameter tidak lengkap"));
    exit;
}

$g_noserahterima = $_POST['noTransaksi'];
$g_kirimdari = $_POST['dari'];
$g_kirimke = $_POST['kirimKe'];

$arr_sr = array();
$arr_srd = array();
$arr_kantong = array();
$arr_ht = array();
$arr_pd = array();
$qry_sr_head = mysqli_query($dbi, "SELECT * FROM `serahterima` WHERE `hst_notrans`='$g_noserahterima'");
$arr_sr = mysqli_fetch_assoc($qry_sr_head);
if (!$arr_sr) {
    $arr_sr = array();
}
$qry_sr_detail = mysqli_query($dbi, "SELECT * FROM `serahterima_detail` WHERE `dst_notrans`='$g_noserahterima'");
while ($row = mysqli_fetch_assoc($qry_sr_detail)) {
    $arr_srd[] = $row;
    $no_kantong = $row['dst_nokantong'];
    $kodedonor  = $row['dst_kodedonor'];
    $htrans     = $row['dst_no_aftap'];
    $base_nokantong = substr($no_kantong, 0, -1);
    $length_nokantong = strlen($no_kantong);
    //Data Kantong
    $qrykantong = mysqli_query($dbi, "SELECT * FROM `stokkantong` WHERE `noKantong` LIKE '$base_nokantong%' AND LENGTH(`noKantong`) = $length_nokantong;");
    while ($dtkantong = mysqli_fetch_assoc($qrykantong)) {
        $arr_kantong[] = $dtkantong;
    }
    //Data Pendonor
    $qrypd  = mysqli_query($dbi, "SELECT * FROM `pendonor` WHERE `Kode` = '$kodedonor'");
    while ($dtpd = mysqli_fetch_assoc($qrypd)) {
        $arr_pd[] = $dtpd;
    }
    //Data Htrans
    $qryht  = mysqli_query($dbi, "SELECT * FROM `htransaksi` WHERE `NoTrans` = '$htrans'");
    while ($dtht = mysqli_fetch_assoc($qryht)) {
        $arr_ht[] = $dtht;
    }
}
$arr_kirim = array(
    'notransaksi' => $g_noserahterima,
    'dariudd' => $g_kirimdari ,
    'keudd'=>$g_kirimke,
    'serahterima' => $arr_sr,
    'serahterimadetail' => $arr_srd,
    'stokkantong' => $arr_kantong,
    'pendonor' => $arr_pd,
    'htransaksi' => $arr_ht
);

$json_data = json_encode($arr_kirim);
if (!$json_data) {
    echo json_encode(array("status" => "error", "message" => "Gagal mengonversi data ke JSON"));
    exit;
}

$file_path = 'kirim_data.json';
file_put_contents($file_path, $json_data);
$api_url = "https://dbdonor.pmi.or.id/konsolidasi/serahterima_kirimdarah.php";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Content-Length: " . strlen($json_data)
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$error = curl_error($curl);
curl_close($curl);

if ($response === false) {
    echo json_encode(array("status" => "error", "message" => "Gagal menghubungi API tujuan: $error"));
    exit;
}

$api_response = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(array("status" => "error", "message" => "Respon dari API tidak valid"));
    exit;
}

if ($http_code !== 200 || (isset($api_response['status']) && $api_response['status'] === "error")) {
    echo json_encode(array(
        "status" => "error",
        "message" => isset($api_response['message']) ? $api_response['message'] : "Terjadi kesalahan pada API tujuan"
    ));
    exit;
}
mysqli_query($dbi,"UPDATE`serahterima` SET `up_data`='1' WHERE `hst_notrans`='$g_noserahterima'");
echo json_encode(array(
    "status" => "success",
    "message" => "Data berhasil dikirim",
    "file" => $file_path,
    "api_response" => $api_response
));
?>