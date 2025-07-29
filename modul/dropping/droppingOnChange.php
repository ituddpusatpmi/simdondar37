<?php
// Include connection to the database
include '../config/dbi_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produk = $_POST['produk'];
    // var_dump($produk);

    $tglEd = new DateTime();

    $selProduk = "SELECT * FROM produk WHERE Nama = '$produk'";
    $sProduk = mysqli_query($dbi, $selProduk);

    if ($sP = mysqli_fetch_assoc($sProduk)) {
        // var_dump($sP);
        $daysToAdd = (int)$sP['umurhari'];
        $hoursToAdd = (int)$sP['umurjam'];

        $tglEd->modify("+$daysToAdd days");
        if ($hoursToAdd > 0) {
            $tglEd->modify("+$hoursToAdd hours");
        }

        // nilai default
        $pVol = 200;
        $pCepat = 3000;
        $bSuhu = 22;

        switch ($produk) {
            case "WB":
            case "PRC":
                $pVol = ($_POST['jKantong'] === 'B') ? 150 : 200;
                break;
            case "WE":
                $pCepat = 3000;
                $bSuhu = 4;
                break;
            case "TC":
            case "BC":
                $pVol = 200;
                $pCepat = ($_POST['jKantong'] === 'A') ? 2000 : 4000;
                $bSuhu = 22;
                break;
            case "FFP":
            case "FP24":
            case "FP72":
            case "FFP Leucodepletet":
                $pVol = 150;
                $pCepat = 4000;
                $bSuhu = 22;
                break;
            case "AHF":
            case "LP":
            case "LP Leucodepletet":
            case "LP Apheresis":
                $pVol = 150;
                $pCepat = 3000;
                $bSuhu = 22;
                break;
            case "PRC Leucoreduction":
            case "PRC Leucodepletet":
            case "WB Leucodepletet":
                $pVol = 150;
                $pCepat = 3000;
                $bSuhu = 22;
                break;
            case "PRC Apheresis":
                $pVol = 150;
                $pCepat = 4000;
                $bSuhu = 22;
                break;
            default:
                $pVol = 200;
                $pCepat = 3000;
                $bSuhu = 22;
                break;
        }

        // Kembalikan hasil dalam format JSON
        echo json_encode([
            'tglEd' => $tglEd->format('Y-m-d H:i:s'),
            'pcepat' => $pCepat,
            'psuhu' => $bSuhu,
            'volume' => $pVol
        ]);
    } else {
        echo json_encode(['error' => 'Produk tidak ditemukan']);
    }
}
