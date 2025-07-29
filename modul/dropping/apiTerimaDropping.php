<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// require_once("config/dbi_connect.php");
require_once('adm/config.php');

$justToday  = DATE("Y-m-d");
$hariini    = DATE("Y-m-d H:i:s");
$d          = DATE('d');
$m          = DATE('m');
$y          = DATE('Y');
$key        = 'bdrs.or.id' . $m . $d . $y;
$token      = $_POST['keyy'];

$input = file_get_contents('php://input');

$data = json_decode($input, true);

$response = ['status' => 'error', 'message' => ''];

if (!empty($data) && is_array($data)) {
    try {
        $conn->begin_transaction();

        $insert_sql = "INSERT INTO b_stokbdrs (
            noKantong, noTrans, noselang, jenis, volume, merk, produk, gol_darah, RhesusDrh,
            StatTempat, AsalUTD, tgl_Aftap, tglpengolahan, kadaluwarsa, tglperiksa
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare statement
        if ($stmt = $conn->prepare($insert_sql)) {
            // Loop melalui setiap item data
            foreach ($data as $row) {

                $nokantong = $row['nK'] ?? NULL;
                $noTrans = $row['nT'] ?? NULL;
                $noSelang = $row['noSelang'] ?? NULL;
                $jenis = $row['jn'] ?? NULL;
                $volume = $row['voll'] ?? NULL;
                $merk = $row['merk'] ?? NULL;
                $produk = $row['prodd'] ?? NULL;
                $gol_darah = $row['ABOAB'] ?? NULL;
                $RhesusDrh = $row['rh'] ?? NULL;
                $statTempat = $row['statTempat'] ?? NULL;
                $asalUTD = $row['asalUTD'] ?? NULL;
                $tgl_Aftap = $row['aftap'] ?? NULL;
                $tglpengolahan = $row['olah'] ?? NULL;
                $kadaluwarsa = $row['ed'] ?? NULL;
                $tglperiksa = $row['periksa'] ?? NULL;

                // Bind parameter
                $stmt->bind_param(
                    "sssssssssssssss",
                    $nokantong,
                    $noTrans,
                    $noSelang,
                    $jenis,
                    $volume,
                    $merk,
                    $produk,
                    $gol_darah,
                    $RhesusDrh,
                    $statTempat,
                    $asalUTD,
                    $tgl_Aftap,
                    $tglpengolahan,
                    $kadaluwarsa,
                    $tglperiksa
                );

                // Eksekusi pernyataan
                if (!$stmt->execute()) {
                    throw new Exception("Error pada INSERT: " . $stmt->error);
                }
            }

            // Commit transaksi
            $conn->commit();
            $response['status'] = 'success';
            $response['message'] = 'Data berhasil diproses dan disimpan.';
        } else {
            throw new Exception('Error preparing statement: ' . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        $response['message'] = $e->getMessage();
    }
} else {
    // Jika data tidak valid
    $response['message'] = 'Data tidak valid atau kosong';
}

// Kirim respons JSON
echo json_encode($response);
