<?php
// Koneksi ke database
include 'config/dbi_connect.php'; // Sesuaikan dengan file koneksi Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // Sanitasi input untuk keamanan

    // Ambil nomor kantong terkait dari tabel kirimbdrs
    $selKantongResult = mysqli_query($dbi, "SELECT noKantong FROM kirimbdrs WHERE `id` = $id");
    
    if ($selKantongResult && mysqli_num_rows($selKantongResult) > 0) {
        $selKantong = mysqli_fetch_assoc($selKantongResult);
        
        // Query untuk menghapus baris dari database
        $query = "DELETE FROM kirimbdrs WHERE `id` = ?";
        $stmt = $dbi->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                // Update status stok kantong terkait
                $upStok = mysqli_query($dbi, "UPDATE stokkantong SET `Status` = 2, `stat2` = NULL WHERE noKantong = '{$selKantong['noKantong']}'");
                
                if ($upStok) {
                    echo json_encode(array('success' => true, 'status' => 'success', 'message' => 'Berhasil menghapus data'));
                } else {
                    echo json_encode(array('success' => false, 'status' => 'error', 'message' => 'Gagal mengupdate stok kantong'));
                }
            } else {
                echo json_encode(array('success' => false, 'status' => 'error', 'message' => 'Gagal menghapus data'));
            }

            $stmt->close();
        } else {
            echo json_encode(array('success' => false, 'status' => 'error', 'message' => 'Gagal mempersiapkan statement'));
        }
    } else {
        echo json_encode(array('success' => false, 'status' => 'error', 'message' => 'Data tidak ditemukan'));
    }

    $dbi->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Metode tidak valid'));
}
