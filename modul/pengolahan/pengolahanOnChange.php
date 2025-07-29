<?php
include '../../config/dbi_connect.php';
// include '../config/dbi_connect.php';

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
            case "FP":
            case "FP 72":
            case "FFP Leucodepleted":
                $pVol = 150;
                $pCepat = 4000;
                $bSuhu = 22;
                break;
            case "AHF":
            case "LP":
            case "LPLS":
            case "LP Apheresis":
                $pVol = 150;
                $pCepat = 3000;
                $bSuhu = 22;
                break;
            case "PRCLR":
            case "PCLS": // Plasma Kaya Trombosit (Platet Rich Plasma)
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
        /** versi 5.4 ++
            echo json_encode([
                'tglEd' => $tglEd->format('Y-m-d H:i:s'),
                'pcepat' => $pCepat,
                'psuhu' => $bSuhu,
                'volume' => $pVol
            ]);
        */

        // Debugging saja
        // error_log("Debugging Information:");
        // error_log("tglEd: " . $tglEd->format('Y-m-d H:i:s'));
        // error_log("pcepat: " . $pCepat);
        // error_log("psuhu: " . $bSuhu);
        // error_log("volume: " . $pVol);

        echo json_encode(array(
            'tglEd' => $tglEd->format('Y-m-d H:i:s'),
            'pcepat' => $pCepat,
            'psuhu' => $bSuhu,
            'volume' => $pVol
        ));
    } else {
        // Debugging apabila error doang
        // error_log("Error: Produk tidak ditemukan". $produk);
        echo json_encode(array('error' => 'Produk tidak ditemukan'));
    }
}
