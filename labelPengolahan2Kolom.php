<?php
require_once('config/dbi_connect.php');
//============================================================+
// File name   : example_027.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 027 for TCPDF class
//               1D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 1D Barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

$nT = isset($_GET['nT']) ? $_GET['nT'] : null;
$transaksi = isset($_GET['transaksi']) ? $_GET['transaksi'] : 'transaksi';
// $nT = "KV317D-160425-0001";

function formatTanggal($inputTanggal)
{
    if (is_null($inputTanggal) || $inputTanggal === '0000-00-00' || $inputTanggal === '0000-00-00 00:00:00') {
        return "Format Tanggal Tidak Valid";
    }

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

    try {
        $dateTime = new DateTime($inputTanggal);
        $split = explode('-', $inputTanggal);

        if (strpos($inputTanggal, ':') !== false) {
            $formattedDate = $dateTime->format("d ") . $bulan[(int) $split[1]] . $dateTime->format(" Y - H:i");
        } else {
            $formattedDate = $dateTime->format("d ") . $bulan[(int) $split[1]] . $dateTime->format(" Y");
        }

        return $formattedDate;
    } catch (Exception $e) {
        return "Format Tanggal Tidak Valid";
    }
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('irawanDB');
$pdf->SetTitle('SIMDONDAR');
$pdf->SetSubject('LABEL KOMPONEN DARAH');
$pdf->SetKeywords('SIMDONDAR, PDF, barcode, pmi, udd, jember');
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(-1, 5, 0);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$style = array(
    'position' => 'S',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'text' => false,
    'font' => 'dejavusans',
    'fontsize' => 12,
    'stretchtext' => 1
);
if (isset($transaksi)) {
    if ($transaksi === 'transaksi') {
        $query = "SELECT noKantong, Produk, petugas, tgl, DATE(tgl) as tanggal, goldarah, rhesus, jenis 
                FROM `dpengolahan` 
                WHERE NoTrans='$nT'";
    } elseif ($transaksi === 'kantong') {
        $query = "SELECT noKantong, Produk, petugas, tgl, DATE(tgl) as tanggal, goldarah, rhesus, jenis 
                FROM `dpengolahan` 
                WHERE noKantong='$nT'";
    } else {
        $query = null;
    }

    if ($query) {
        $result = mysqli_query($dbi, $query);
    } else {
        $result = false;
    }
} else {
    $result = false;
}

$namaUDDQuery = "SELECT nama FROM utd WHERE aktif = 1 LIMIT 1";
$namaUDDResult = mysqli_query($dbi, $namaUDDQuery);

if ($namaUDDResult && mysqli_num_rows($namaUDDResult) > 0) {
    $namaUDDRow = mysqli_fetch_assoc($namaUDDResult);
    $namaUDD = $namaUDDRow['nama'];
} else {
    $namaUDD = 'UDD PMI Kabupaten Jember';
}

$resolution = array(100, 20);

$barcodeType = isset($_GET['barcode']) ? $_GET['barcode'] : 'C128';
//$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}


foreach ($rows as &$row) {
    $noKantong = $row['noKantong'];
    $metodaQuery = "SELECT metoda FROM stokkantong WHERE noKantong = '$noKantong'";
    $metodaResult = mysqli_query($dbi, $metodaQuery);

    if ($metodaResult && mysqli_num_rows($metodaResult) > 0) {
        $metodaRow = mysqli_fetch_assoc($metodaResult);
        $row['metoda'] = $metodaRow['metoda'];
    } else {
        $row['metoda'] = null;
    }
}
unset($row);

$fontSizeUDD = strlen($namaUDD) > 30 ? 4.4 : 6;
error_log("Count of rows: " . count($rows) . " - NoTrans:" . $nT . " - Barcode Type: " . $barcodeType . " - Transaksi: " . $transaksi);

if (count($rows) === 1) {

    // OPSI SATU BARIS DUA LABEL DAN SATU KANTONG DUA LABEL DALAM SATU BARIS
    $pdf->AddPage('L', $resolution);
    $maxY = 20;
    $marginTop = 7.7;
    $labelHeight = 10;

    $index = 0;

    foreach ($rows as $row) {
        // $kodeSatelit = $alphabet[$index % count($alphabet)];
        $noKantong = $row['noKantong'];

        $posY = $marginTop + ($index % 1) * $labelHeight;
        if ($index > 0) {
            $pdf->AddPage('L', $resolution);
            $posY = $marginTop;
        }

        // Ukuran font dinamis tergantung panjang kode
        $bagsize = strlen($noKantong) <= 8 ? 9 : (strlen($noKantong) <= 12 ? 7.5 : 6.5);

        switch ($row['jenis']) {
            case '2':
                $label = 'DOUBLE';
                $jnkiri = 34;
                $jnkanan = 87;
                break;
            case '3':
                $label = 'TRIPLE';
                $jnkiri = 35.5;
                $jnkanan = 88.5;
                break;
            case '4':
                $label = 'QUADRUPLE';
                $jnkiri = 28.8;
                $jnkanan = 81.8;
                break;
            case '6':
                $label = 'PEDIATRIK';
                $jnkiri = 31;
                $jnkanan = 84;
                break;
            default:
                $label = 'SINGLE';
                $jnkiri = 35;
                $jnkanan = 88;
                break;
        }

        // Cetak barcode kiri & kanan
        $pdf->SetFont('dejavusans', '', 6);
        $fontSizeUDD = strlen($namaUDD) > 30 ? 4.4 : 6;
        $adjustedYLeft = strlen($namaUDD) > 30 ? $posY - 5.2 : $posY - 5.7;
        $pdf->SetFont('dejavusans', '', $fontSizeUDD);
        $pdf->SetXY(1, $adjustedYLeft);
        $pdf->Cell(0, 0, $namaUDD, 0, 0, 'L');

        $adjustedYRight = strlen($namaUDD) > 30 ? $posY - 5.2 : $posY - 5.7;
        $pdf->SetXY(54, $adjustedYRight);
        $pdf->Cell(0, 0, $namaUDD, 0, 0, 'L');

        switch ($row['goldarah']) {
            case 'AB':
                $posXL = 36.3;
                $posXR = 89.3;
                break;
            default:
                $posXL = 36.2;
                $posXR = 89.2;
                break;
        }

        switch ($row['rhesus']) {
            case '+':
                $posXL += 0;
                $posXR += 0;
                break;
            case '-':
                $posXRL -= 0.3;
                $posXR -= 0.3;
                break;
            default:
                break;
        }

        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetXY($posXR, $posY - 5.3);
        $goldarahRight = $row['goldarah'];
        $rhesusRight = $row['rhesus'] === '+' ? 'POS' : ($row['rhesus'] === '-' ? 'NEG' : $row['rhesus']);
        $pdf->Cell(0, 0, $goldarahRight . ' ' . $rhesusRight, 0, 0, 'L');

        $pdf->SetXY($posXL, $posY - 5.3);
        $goldarahLeft = $row['goldarah'];
        $rhesusLeft = $row['rhesus'] === '+' ? 'POS' : ($row['rhesus'] === '-' ? 'NEG' : $row['rhesus']);
        $pdf->Cell(0, 0, $goldarahLeft . ' ' . $rhesusLeft, 0, 0, 'L');

        $pdf->SetXY(2, $posY - 2.7);
        $pdf->write1DBarcode($noKantong, $barcodeType, '', '', 43, 7, '', $style, 'T');
        $pdf->SetX(55);
        $pdf->write1DBarcode($noKantong, $barcodeType, '', '', 43, 7, '', $style, 'N');

        // Label jenis kantong
        $pdf->SetFont('helvetica', '', 7);
        $pdf->SetXY($jnkiri, $posY + 4.3);
        $pdf->Cell(0, 0, $label, 0, 0, 'L');
        $pdf->SetX($jnkanan);
        $pdf->Cell(0, 0, $label, 0, 0, 'L');

        // No Kantong teks
        $pdf->SetFont('helvetica', '', $bagsize);
        $pdf->SetXY(1, $posY + 4.3);
        $pdf->Cell(0, 0, $noKantong, 0, 0, 'L');
        $pdf->SetXY(53.7, $posY + 4.3);
        $pdf->Cell(0, 0, $noKantong, 0, 0, 'L');

        if (!empty($row['metoda'])) {
            $pdf->SetFont('dejavusans', '', 4);

            switch ($row['metoda']) {
                case 'TT':
                    $metodaLabel = "Top & Top";
                    $metodaXL = 36.9;
                    $metodaXR = 89.8;
                    break;
                case 'TB':
                    $metodaLabel = "Top & Bottom";
                    $metodaXL = 34.2;
                    $metodaXR = 87.4;
                    break;
                case 'TBF':
                    $metodaLabel = "Filter";
                    $metodaXL = 40.4;
                    $metodaXR = 93.4;
                    break;
                default:
                    $metodaLabel = $row['metoda'];
                    $metodaXL = 41.4;
                    $metodaXR = 94.4;
                    break;
            }

            $pdf->SetXY($metodaXL, $posY + 7);
            $pdf->Cell(0, 0, $metodaLabel, 0, 0, 'L');
            $pdf->SetXY($metodaXR, $posY + 7);
            $pdf->Cell(0, 0, $metodaLabel, 0, 0, 'L');
        }

        if (!empty($row['Produk'])) {
            // Left side
            $pdf->SetFont('dejavusans', 'B', 7);
            $pdf->SetXY(1, $posY + 6.75);
            $pdf->Cell(0, 0, $row['Produk'], 0, 0, 'L');
            $pdf->SetFont('dejavusans', '', 4);
            $pdf->SetXY(1, $posY + 9.2);
            $pdf->Cell(0, 0, 'Pengolahan: ' . formatTanggal($row['tgl']), 0, 0, 'L');

            // Right side
            $pdf->SetFont('dejavusans', 'B', 7);
            $pdf->SetXY(54, $posY + 6.75);
            $pdf->Cell(0, 0, $row['Produk'], 0, 0, 'L');
            $pdf->SetFont('dejavusans', '', 4);
            $pdf->SetXY(54, $posY + 9.2);
            $pdf->Cell(0, 0, 'Pengolahan: ' . formatTanggal($row['tgl']), 0, 0, 'L');
        }

        $index++;
    }
    // END OF OPSI SATU BARIS DUA LABEL DAN SATU KANTONG DUA LABEL DALAM SATU BARIS
} else if (count($rows) > 1) {
    // OPSI SATU BARIS DUA LABEL DANSATU KANTONG SATU LABEL
    $total = count($rows);

    function jenisToLabel($jenis, $metoda)
    {
        switch ($jenis) {
            case '2':
                $label = 'DOUBLE';
                $jnkiri = 34;
                $jnkanan = 87;
                break;
            case '3':
                $label = 'TRIPLE';
                $jnkiri = 35.7;
                $jnkanan = 88.7;
                break;
            case '4':
                $label = 'QUADRUPLE';
                $jnkiri = 29;
                $jnkanan = 82;
                break;
            case '6':
                $label = 'PEDIATRIK';
                $jnkiri = 31;
                $jnkanan = 84;
                break;
            default:
                $label = 'SINGLE';
                $jnkiri = 35;
                $jnkanan = 88;
                break;
        }
        return array($label, $jnkiri, $jnkanan);
    }

    for ($i = 0; $i < $total; $i += 2) {
        $pdf->AddPage('L', $resolution);

        // Ambil data kiri
        $left = $rows[$i];
        $leftKode = $left['noKantong'];
        $leftJenis = $left['jenis'];

        // Ambil data kanan, jika ada
        $right = isset($rows[$i + 1]) ? $rows[$i + 1] : null;
        $rightKode = isset($right['noKantong']) ? $right['noKantong'] : '';
        $rightJenis = isset($right['jenis']) ? $right['jenis'] : '';

        // Ukuran font dinamis
        $fontsizeLeft = strlen($leftKode) <= 8 ? 9 : (strlen($leftKode) <= 12 ? 7.5 : 6.5);
        $fontsizeRight = strlen($rightKode) <= 8 ? 9 : (strlen($rightKode) <= 12 ? 7.5 : 6.5);

        // Ambil label jenis
        list($jnL, $jnkiri, ) = jenisToLabel($leftJenis, $left['metoda']);
        list($jnR, , $jnkanan) = jenisToLabel($rightJenis, $right['metoda']);

        $y = 4.7;

        $pdf->SetFont('dejavusans', '', $fontSizeUDD);
        $adjustedY = strlen($namaUDD) > 30 ? $y - 2.5 : $y - 3;
        $pdf->SetXY(1, $adjustedY);
        $pdf->Cell(0, 0, $namaUDD, 0, 0, 'L');
        switch ($left['goldarah']) {
            case 'AB':
                $posX = 36.3;
                break;
            default:
                $posX = 37.7;
                break;
        }

        switch ($left['rhesus']) {
            case '+':
                $posX += 0;
                break;
            case '-':
                $posX -= 0.2;
                break;
            default:
                break;
        }

        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetXY($posX, $y - 2.7);
        $goldarah = $left['goldarah'];
        $rhesus = $left['rhesus'] === '+' ? 'POS' : ($left['rhesus'] === '-' ? 'NEG' : $left['rhesus']);
        $pdf->Cell(0, 0, $goldarah . ' ' . $rhesus, 0, 0, 'L');

        if ($right) {
            $pdf->SetFont('dejavusans', '', 6);
            $fontSizeUDDRight = strlen($namaUDD) > 30 ? 4.4 : 6;
            $adjustedYRight = strlen($namaUDD) > 30 ? $y - 2.5 : $y - 3;
            $pdf->SetFont('dejavusans', '', $fontSizeUDD);
            $pdf->SetXY(54, $adjustedYRight);
            $pdf->Cell(0, 0, $namaUDD, 0, 0, 'L');
            $pdf->SetFont('dejavusans', '', 6);

            switch ($right['goldarah']) {
                case 'AB':
                    $posX = 89.3;
                    break;
                default:
                    $posX = 90.7;
                    break;
            }

            switch ($right['rhesus']) {
                case '+':
                    $posX += 0;
                    break;
                case '-':
                    $posX -= 0.3;
                    break;
                default:
                    break;
            }

            $pdf->SetXY($posX, $y - 2.7);
            $goldarahRight = $right['goldarah'];
            $rhesusRight = $right['rhesus'] === '+' ? 'POS' : ($right['rhesus'] === '-' ? 'NEG' : $right['rhesus']);
            $pdf->Cell(0, 0, $goldarahRight . ' ' . $rhesusRight, 0, 0, 'L');
        }

        $pdf->SetXY(2, $y);
        $pdf->write1DBarcode($leftKode, $barcodeType, '', '', 43, 7, '', $style, 'T');

        $pdf->SetFont('dejavusans', '', $fontsizeLeft);
        $pdf->SetXY(1, $y + 7);
        $pdf->Cell(0, 0, $leftKode, 0, 0, 'L');
        $pdf->SetFont('dejavusans', '', 7);
        $pdf->SetXY($jnkiri, $y + 7);
        $pdf->Cell(0, 0, $jnL, 0, 0, 'L');
        if (!empty($left['metoda'])) {
            $pdf->SetFont('dejavusans', '', 4);

            switch ($left['metoda']) {
                case 'TT':
                    $metodaLabel = "Top & Top";
                    $metodaX = 36.7;
                    break;
                case 'TB':
                    $metodaLabel = "Top & Bottom";
                    $metodaX = 34.2;
                    break;
                case 'TBF':
                    $metodaLabel = "Filter";
                    $metodaX = 40.3;
                    break;
                default:
                    $metodaLabel = $left['metoda'];
                    $metodaX = 42;
                    break;
            }

            $pdf->SetXY($metodaX, $y + 9.5);
            $pdf->Cell(0, 0, $metodaLabel, 0, 0, 'L');
        }

        if (!empty($left['Produk'])) {
            $pdf->SetFont('dejavusans', 'B', 7);
            $pdf->SetXY(1, $y + 9.5);
            $pdf->Cell(0, 0, $left['Produk'], 0, 0, 'L');
            $pdf->SetFont('dejavusans', '', 4);
            $pdf->SetXY(1, $y + 12.3);
            $pdf->Cell(0, 0, 'Pengolahan: ' . formatTanggal($left['tgl']), 0, 0, 'L');
        }

        if ($right) {
            $pdf->SetXY(55, $y);
            $pdf->write1DBarcode($rightKode, $barcodeType, '', '', 43, 7, '', $style, 'N');
            $pdf->SetFont('dejavusans', '', $fontsizeRight);
            $pdf->SetXY(54, $y + 7);
            $pdf->Cell(0, 0, $rightKode, 0, 0, 'L');
            $pdf->SetFont('dejavusans', '', 7);
            $pdf->SetXY($jnkanan, $y + 7);
            $pdf->Cell(0, 0, $jnR, 0, 0, 'L');
            if (!empty($right['metoda'])) {
                $pdf->SetFont('dejavusans', '', 4);

                switch ($right['metoda']) {
                    case 'TT':
                        $metodaLabel = "Top & Top";
                        $metodaX = 89.7;
                        break;
                    case 'TB':
                        $metodaLabel = "Top & Bottom";
                        $metodaX = 87.2;
                        break;
                    case 'TBF':
                        $metodaLabel = "Filter";
                        $metodaX = 93.3;
                        break;
                    default:
                        $metodaLabel = $right['metoda'];
                        $metodaX = 95;
                        break;
                }

                $pdf->SetXY($metodaX, $y + 9.5);
                $pdf->Cell(0, 0, $metodaLabel, 0, 0, 'L');
            }
            if (!empty($right['Produk'])) {
                $pdf->SetFont('dejavusans', 'B', 7); // Set font to bold
                $pdf->SetXY(54, $y + 9.7);
                $pdf->Cell(0, 0, $right['Produk'], 0, 0, 'L');
                $pdf->SetFont('dejavusans', '', 4);
                $pdf->SetXY(54, $y + 12.3);
                $pdf->Cell(0, 0, 'Pengolahan: ' . formatTanggal($right['tgl']), 0, 0, 'L');
            }
        }
    }
    // END OF OPSI SATU BARIS DUA LABEL DANSATU KANTONG SATU LABEL
} else {
    // Logic for handling no rows
    $pdf->AddPage();
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->Cell(0, 10, 'No data available to generate labels.', 0, 1, 'C');
}

$pdf->Output('LabelKomponen2Kolom.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
