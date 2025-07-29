<?php
$nT = isset($_GET['noTrans']) ? $_GET['noTrans'] : 'Tidak ada nomor transaksi';

echo "Ini halaman percobaan dengan mengambil parameter noTrans: " . htmlspecialchars($nT);
