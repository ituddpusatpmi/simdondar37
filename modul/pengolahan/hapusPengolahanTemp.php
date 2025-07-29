<?php
// Koneksi ke database
include '../../config/dbi_connect.php'; // Sesuaikan dengan file koneksi Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Query untuk menghapus baris dari database
    $query = "DELETE FROM dpengolahan_temp WHERE `id` = ?";
    $stmt = $dbi->prepare($query);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'status' => 'success', 'message' => 'Berhasil menghapus data'));
    } else {
        echo json_encode(array('success' => false, 'status' => 'error', 'message' => 'Gagal menghapus data'));
    }

    $stmt->close();
    $dbi->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Metode tidak valid'));
}
