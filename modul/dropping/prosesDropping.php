<?php
session_start();
require_once("config/dbi_connect.php");
//require_once('../../config/c_wgaw.php');

$justToday = DATE("Y-m-d");
$hariini = DATE("Y-m-d H:i:s");
$d = DATE('d');
$m = DATE('m');
$y = DATE('Y');
$keyy = 'bdrs.or.id' . $m . $d . $y;
//$keyy = 'pmitangerang.id' . $m . $d . $y;

$response = array('success' => false, 'message' => '');

$noTrans = isset($_POST['NoTrans']) ? $_POST['NoTrans'] : '';

// Ambil jam saat ini
$currentHour = date('H');

// Tentukan waktu berdasarkan jam
if ($currentHour >= 6 && $currentHour < 12) {
    $waktuSaatIni = 'PAGI';
} elseif ($currentHour >= 12 && $currentHour < 16) {
    $waktuSaatIni = 'SIANG';
} elseif ($currentHour >= 16 && $currentHour < 19) {
    $waktuSaatIni = 'SORE';
} else {
    $waktuSaatIni = 'MALAM';
}

try {
    // Mulai transaksi
    // $dbi->begin_transaction();

    $dbi->query("START TRANSACTION");

    $seleksi_sql = "SELECT 
        k.no_permintaan as nP, 
        k.nokantong as nK, 
        s.noselang as noSelang, 
        k.tgl AS tglProses, 
        k.petugas AS ptgs, 
        s.jenis AS jn, 
        s.volume AS voll, 
        s.merk, 
        s.produk AS prodd, 
        s.gol_darah AS ABOAB, 
        s.RhesusDrh AS rh, 
        k.kodeBdrs AS statTempat, 
        '3509' AS asalUTD,
        s.tgl_Aftap AS aftap, 
        s.tglpengolahan AS olah, 
        s.kadaluwarsa AS ed, 
        s.tglperiksa AS periksa
    FROM 
        kirimbdrs k 
    JOIN 
        stokkantong s 
    ON 
        k.nokantong = s.noKantong 
    WHERE 
        k.noTrans = ? AND k.`status` IS NULL
    ORDER BY 
        s.gol_darah ASC,
        k.id DESC";

    if ($stmt = $dbi->prepare($seleksi_sql)) {
        // Bind parameter untuk noTrans
        $stmt->bind_param("s", $noTrans);

        // Eksekusi pernyataan
        if (!$stmt->execute()) {
            throw new Exception("Error pada SELEKSI DATA stokkantong: " . $stmt->error);
        }

        // Ambil hasil query
        // $result = $stmt->get_result();
        // $data = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->store_result(); // Menyimpan hasil
        $stmt->bind_result($nP, $nK, $noSelang,  $tglProses, $ptgs, $jn, $voll, $merk, $prodd, $ABOAB, $rh, $statTempat, $asalUTD, $aftap, $olah, $ed, $periksa);
        $data = array();

        while ($stmt->fetch()) {
	$selNmLengkap = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `nama_lengkap` FROM `user` WHERE `id_user` = '$ptgs' "));
	$nmLengkap = isset($selNmLengkap['nama_lengkap']) ? $selNmLengkap['nama_lengkap'] : null;

            $data[] = array(
                'nP' => $nP,
                'nK' => $nK,
                'nT' => $noTrans,
                'noSelang' => $noSelang,
                'tglProses' => $tglProses,
                'ptgs' => $nmLengkap,
                //'noSelang' => $noSelang,
                'jn' => $jn,
                'voll' => $voll,
                'merk' => $merk,
                'prodd' => $prodd,
                'ABOAB' => $ABOAB,
                'rh' => $rh,
                'statTempat' => $statTempat,
                'asalUTD' => $asalUTD,
                'aftap' => $aftap,
                'olah' => $olah,
                'ed' => $ed,
                'periksa' => $periksa,
                'tK' => $keyy
            );
        }


        // Periksa jika data ada dan formatnya sesuai
        if (empty($data)) {
            throw new Exception("Data tidak ditemukan untuk NoTrans: " . htmlspecialchars($noTrans));
        }

    // Simpan JSON ke dalam file txt
    $filePath = __DIR__ . '/dataKirimDropping.txt'; // Nama file
    $buatFile = file_put_contents($filePath, $data);
    // file_put_contents($filePath, print_r($jsonData, true), FILE_APPEND);

        // Kirim data ke REST API
        $apiUrl = 'https://bdrs.or.id/apiTerimaDropping.php';
        //$apiUrl = 'https://bdrs.pmitangerang.id/apiTerimaDropping.php';
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, [
        //     'Content-Type: application/json',
        //     'Content-Length: ' . strlen(json_encode($data)),
        //     'keyy: ' . $keyy
        // ]);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data)),
            'keyy: ' . $keyy
        ));

        // Tambahkan baris ini untuk menggunakan sertifikat CA
        //curl_setopt($ch, CURLOPT_CAINFO, 'cacert-2024-09-24.pem');


        $apiResponse = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('cURL Error: ' . curl_error($ch));
        }
        curl_close($ch);

        // Cek apakah REST API memberikan respons yang valid
        $apiResponseData = json_decode($apiResponse, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Error decoding JSON response: ' . json_last_error_msg());
        }
        if ($apiResponseData['status'] !== 'success') {
            throw new Exception('REST API Error: ' . $apiResponseData['message']);
        }

        $update_sql = "UPDATE kirimbdrs SET `status` = 0 WHERE nokantong = ?";
        if ($update_stmt = $dbi->prepare($update_sql)) {
            foreach ($data as $row) {
                // tambahkan apalah disini didalam pengulangan
                // $nokantong = $row['nK'] ?? NULL;
                $nokantong = isset($row['nK']) ? $row['nK'] : NULL;

                $update_stmt->bind_param("s", $nokantong);

                if (!$update_stmt->execute()) {
                    throw new Exception("Error pada UPDATE STATUS: " . $update_stmt->error);
                }
            }
        } else {
            throw new Exception('Error preparing update statement: ' . $dbi->error);
        }

	// UPDATE KIRIM_BDRS
        $update_sql1 = "UPDATE kirim_bdrs SET `status` = 0 WHERE nokantong = ?";
        if ($update_stmt1 = $dbi->prepare($update_sql1)) {
            foreach ($data as $row1) {
                $nokantong1 = isset($row1['nK']) ? $row1['nK'] : NULL;

                $update_stmt1->bind_param("s", $nokantong1);

                if (!$update_stmt1->execute()) {
                    throw new Exception("Error pada UPDATE STATUS KIRIM_BDRS: " . $update_stmt1->error);
                }
            }
        } else {
            throw new Exception('Error preparing update statement: ' . $dbi->error);
        }

	// UPDATE DPERMINTAAN_DARAH
        $update_sql2 = "UPDATE `dpermintaan_darah` SET `status` = 1 WHERE `noTrans` = ?";
        if ($update_stmt2 = $dbi->prepare($update_sql2)) {
            foreach ($data as $row1) {
                $noTrans2 = isset($noTrans) ? $noTrans : NULL;

                $update_stmt2->bind_param("s", $noTrans2);

                if (!$update_stmt2->execute()) {
                    throw new Exception("Error pada UPDATE STATUS DPERMINTAAN_DARAH: " . $update_stmt2->error);
                }
            }
        } else {
            throw new Exception('Error preparing update statement: ' . $dbi->error);
        }

        $selNamaRS = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `b`.`nama` FROM `kirimbdrs` k, `bdrs` b WHERE `k`.`kodeBdrs`=`b`.`kd_online` AND `k`.`noTrans` = '$noTrans'"));
        $nmRS = isset($selNamaRS['nama']) ? $selNamaRS['nama'] : '';

        $selTelpRS = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `ptgTelp` FROM `dpermintaan_darah` WHERE `noTrans` = '$noTrans'"));
        $telpPtgRS = isset($selTelpRS['ptgTelp']) ? $selTelpRS['ptgTelp'] : '';

        $idUser = mysqli_real_escape_string($dbi, $_SESSION['namauser']);
        // $acUser = 0;
        $cUser = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `nama_lengkap` FROM `user` WHERE `id_user` = '$idUser' AND `aktif` = 0"));

        $msgUDD = "SELAMAT " . $waktuSaatIni . ",\nPermintaan Dropping Darah telah terpenuhi oleh *UDD PMI Kabupaten Jember*.\n\nPetugas kami *" . $cUser['nama_lengkap'] . "* telah selesai memproses kebutuhan darah " . $nmRS . " dengan Nomor Transaksi Permintaan: *" . $noTrans . "*. \nHarap  menunggu petugas BloodJet kami mengirimkan darah hingga sampai ke tempat anda. \nTerima Kasih";

        $kiriWA = "INSERT INTO `outbox` (`wa_mode`,`wa_no`,`wa_text`) VALUES ('1','$telpPtgRS','$msgUDD')";
        $a1_wa2 = mysqli_query($cwgaw, $kiriWA);

        // Update response jika berhasil
        $response['success'] = true;
        $response['status'] = 'success';
        $response['message'] = 'Nomor Transaksi: <b>' . htmlspecialchars($noTrans) . '</b>, Berhasil disimpan.';
        $response['data'] = $data;

        // Commit transaksi
        // $dbi->commit();
        $dbi->query("COMMIT");
        file_put_contents('log.txt', print_r($data, true));
    } else {
        throw new Exception('Error preparing statement: ' . $dbi->error);
    }
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    // $dbi->rollback();
    $dbi->query("ROLLBACK");
    $response['message'] = $e->getMessage();
}

// Kirimkan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);



