<?php
session_start();
include "config/dbi_connect.php";

$dAllDay = date("Y-m-d H:i:s");
$dDay = DATE("Y-m-d");
$d = DATE('d');
$m = DATE('m');
$yr = DATE('Y');
$y = substr($yr, 2, 2);

$mUser = $_SESSION['namauser'];

function formatTanggal($inputTanggal)
{
    // Daftar bulan dalam Bahasa Indonesia
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    // Cek apakah input valid
    if (strtotime($inputTanggal) === false) {
        return "Invalid date";
    }

    // Pisahkan tanggal dan waktu menggunakan DateTime
    $dateTime = new DateTime($inputTanggal);

    // Format tanggal sesuai kebutuhan
    $tanggal = $dateTime->format("d");
    $bulanIndex = (int)$dateTime->format("m");
    $tahun = $dateTime->format("Y");
    $waktu = $dateTime->format("H:i");

    // Gabungkan dalam format yang diinginkan
    // $formattedDate = $tanggal . ' ' . $bulan[$bulanIndex] . ' ' . $tahun . ' - ' . $waktu . ' WIB';
    $formattedDate = $tanggal . ' ' . $bulan[$bulanIndex] . ' ' . $tahun . ' - ' . $waktu;

    return $formattedDate;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $noTrans = mysqli_real_escape_string($dbi, $_POST['noTrans']);
    $tglMinta = mysqli_real_escape_string($dbi, $_POST['tglMinta']);
    $tujuan = mysqli_real_escape_string($dbi, $_POST['tujuan']);
    $jenisMinta = mysqli_real_escape_string($dbi, $_POST['jenisMinta']);

    $shift = mysqli_real_escape_string($dbi, $_POST['shift']);
    $nK = mysqli_real_escape_string($dbi, $_POST['nomorKantong']);

    $kPetugas = mysqli_real_escape_string($dbi, $mUser);


    $valResult = isValidNomorKantong($nK, $dbi);
    if ($valResult === true) {
        $selID = "SELECT id_permintaan, bdrs_udd, noTrans, kodeBDRS FROM dpermintaan_darah WHERE `noTrans` = '$noTrans' ORDER BY `insert_on` DESC";
        $sID = $dbi->query($selID);
        if ($sID->num_rows > 0) {
            $reID = $sID->fetch_assoc();

            $sData = "SELECT substring(noKantong, -1) as nK, LEFT(noKantong, LENGTH(noKantong) - 1) as tanpaSatelite, tgl_Aftap, gol_darah, RhesusDrh, jenis, produk, kadaluwarsa, volume FROM stokkantong WHERE noKantong = '$nK'";
            $result = mysqli_query($dbi, $sData);
        }

        if ($result) {
            $selData = mysqli_fetch_assoc($result);
            $tAftap = $selData['tgl_Aftap'];
            $jKantong = $selData['jenis'];
            $aboab = $selData['gol_darah'];
            $rh = $selData['RhesusDrh'];
            $jkomp = $selData['produk'];

            $tglEd = new DateTime($tAftap);

            $resultKantong = mysqli_query($dbi, "SELECT jenis, volume, gol_darah, RhesusDrh, tgl_Aftap FROM stokkantong WHERE noKantong LIKE '$selData[tanpaSatelite]%' AND noKantong LIKE '%A'");
            if (!$resultKantong || mysqli_num_rows($resultKantong) == 0) {
                // Handle the error, e.g., log it, throw an exception, or set a default value
                echo json_encode(array('status' => 'error', 'message' => 'Data kantong tidak ditemukan atau query gagal'));
                exit;
            }
            $selKantong = mysqli_fetch_assoc($resultKantong);

            $selTemp = "INSERT INTO kirimbdrs 
                        (no_permintaan, noTrans, kodeBDRS, nokantong, golDarah, rh, produk, bdrs, tgl, petugas) 
                        VALUES 
                        ('$reID[id_permintaan]', '$noTrans', '$reID[kodeBDRS]', '$nK', '$aboab', '$rh', '$jkomp', '$reID[bdrs_udd]', '$dAllDay', '$kPetugas')";

            $selTemp1 = "INSERT INTO kirim_bdrs 
                        (id_permintaan, noTrans, kodeBDRS, nokantong, golDarah, rh, produk, bdrs, tgl_kirim, petugas) 
                        VALUES 
                        ('$reID[id_permintaan]', '$noTrans', '$reID[kodeBDRS]', '$nK', '$aboab', '$rh', '$jkomp', '$reID[bdrs_udd]', '$dAllDay', '$kPetugas')";
	    $selTemp10 = mysqli_query($dbi, $selTemp1);

            if (mysqli_query($dbi, $selTemp)) {
                $upStok = "UPDATE stokkantong SET `Status` = 3, `stat2` = '$reID[bdrs_udd]' WHERE noKantong = '$nK'";
                if (mysqli_query($dbi, $upStok)) {
                    error_log("Berhasil disimpan");
                    echo json_encode(array('status' => 'success'));
                }
            //echo json_encode(array('status' => 'success', 'message' => 'Kantong berhasil ditambahkan gengs.'));

            } else {
                // echo "Error: " . mysqli_error($dbi);
                error_log("Error: " . mysqli_error($dbi));
                echo json_encode(array('status' => 'error', 'message' => 'Error: ' . mysqli_error($dbi) . ', Jam Mulai ' . $jamMulaiPutar));
            }
        } else {
            // echo "Nomor Kantong tidak valid: " . $valResult;
            error_log("Nomor Kantong tidak valid: " . $valResult);
            echo json_encode(array('status' => 'error', 'message' => 'Nomor Kantong tidak valid'));
        }
    }
}

function isValidNomorKantong($nK, $dbi)
{
    $sData0 = "SELECT `jenis`, `produk`, `tglpengolahan`, `Status`, `volume`, `merk`, `lama_pengambilan`, `sah`, `kadaluwarsa` FROM stokkantong WHERE `noKantong` = '$nK'";
    $result0 = mysqli_query($dbi, $sData0);


    if ($result0 && mysqli_num_rows($result0) > 0) {
        $sD = mysqli_fetch_assoc($result0);
        $kedaluwarsa = strtotime($sD['kadaluwarsa']);

        $selDpTemp = mysqli_query($dbi, "SELECT `nokantong` FROM kirimbdrs WHERE `nokantong` = '$nK' AND `status` = '0'");

        if (mysqli_num_rows($selDpTemp) > 0) {

            $pesanExist = "Kantong <b>SUDAH ADA DALAM DAFTAR</b>, lihat daftar antrian dropping darah dan periksa kembali nomor kantong yang anda masukkan.";
            echo json_encode(array('status' => 'error', 'message' => $pesanExist));
            exit;
        }

        if ($sD['Status'] == 0) {
            echo json_encode(array('status' => 'error', 'message' => 'Status Kantong Kosong, harap periksa kembali nomor kantong yang anda masukkan'));
            exit;
        }

        if ($sD['Status'] == 3) {
            echo json_encode(array('status' => 'error', 'message' => 'Status <b>Kantong Keluar</b>, harap periksa kembali nomor kantong yang anda masukkan'));
            exit;
        }

        if ($sD['sah'] == 0 || is_null($sD['sah'])) {
            echo json_encode(array('status' => 'error', 'message' => 'Kantong darah <b>BELUM DISAHKAN.</b>!'));
            exit;
        }

        if ($sD['Status'] != 2) {
            echo json_encode(array('status' => 'error', 'message' => 'Status Kantong Tidak Sesuai, harap periksa kembali nomor kantong yang anda masukkan. <b>Status Kantong Bukan Darah Sehat</b>.'));
            exit;
        }

        if (!is_null($sD['kadaluwarsa']) && $kedaluwarsa < time()) {
            echo json_encode(array('status' => 'error', 'message' => 'Kantong darah sudah <b>KEDALUWARSA</b> pada tanggal: <br><b>' . formatTanggal($sD['kadaluwarsa']) . '</b> dan tidak dapat diproses.'));
            exit;
        }

        return true;
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Nomor Kantong tidak ditemukan'));
        exit;
    }
}
