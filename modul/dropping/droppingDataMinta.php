<?php
include "config/dbi_connect.php";

// $noTrans = "NA120824-3671-001";
// $noTrans = isset($_GET['nT']) ? $_GET['nT'] : '';
if (!empty($nT)) {

    // function formatTanggal($inputTanggal)
    // {
    //     $bulan = array(
    //         1 => 'Januari',
    //         'Februari',
    //         'Maret',
    //         'April',
    //         'Mei',
    //         'Juni',
    //         'Juli',
    //         'Agustus',
    //         'September',
    //         'Oktober',
    //         'November',
    //         'Desember'
    //     );
    //     $dateTime = new DateTime($inputTanggal);
    //     $split = explode('-', $inputTanggal);
    //     // return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

    //     // Format tanggal dengan zona waktu WIB.
    //     // $formattedDate = $dateTime->format("d ") . $bulan[(int)$split[1]] . $dateTime->format(" Y - H:i") . " WIB";

    //     // tanpa zona waktu ..
    //     $formattedDate = $dateTime->format("d ") . $bulan[(int)$split[1]] . $dateTime->format(" Y - H:i");

    //     return $formattedDate;
    // }

    $sql = "SELECT 
    p.Nama,
    SUM(CASE WHEN h.gol_darah = 'A' AND h.rhesusDarah = '+' THEN h.jumlah ELSE 0 END) AS A_POS,
    SUM(CASE WHEN h.gol_darah = 'A' AND h.rhesusDarah = '-' THEN h.jumlah ELSE 0 END) AS A_NEG,
    SUM(CASE WHEN h.gol_darah = 'B' AND h.rhesusDarah = '+' THEN h.jumlah ELSE 0 END) AS B_POS,
    SUM(CASE WHEN h.gol_darah = 'B' AND h.rhesusDarah = '-' THEN h.jumlah ELSE 0 END) AS B_NEG,
    SUM(CASE WHEN h.gol_darah = 'O' AND h.rhesusDarah = '+' THEN h.jumlah ELSE 0 END) AS O_POS,
    SUM(CASE WHEN h.gol_darah = 'O' AND h.rhesusDarah = '-' THEN h.jumlah ELSE 0 END) AS O_NEG,
    SUM(CASE WHEN h.gol_darah = 'AB' AND h.rhesusDarah = '+' THEN h.jumlah ELSE 0 END) AS AB_POS,
    SUM(CASE WHEN h.gol_darah = 'AB' AND h.rhesusDarah = '-' THEN h.jumlah ELSE 0 END) AS AB_NEG,
    SUM(h.jumlah) AS total_jumlah 
    FROM produk p JOIN hpermintaan_darah h
    ON p.Nama=h.produk
    WHERE h.noTrans = '$nT' 
    GROUP BY h.produk 
    ORDER BY h.produk";
    $result = $dbi->query($sql);

    $no = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $no++;

            echo "<tr>
        <td>{$row['Nama']}</td>
        <td>{$row['A_POS']}</td>
        <td>{$row['A_NEG']}</td>
        <td>{$row['B_POS']}</td>
        <td>{$row['B_NEG']}</td>
        <td>{$row['O_POS']}</td>
        <td>{$row['O_NEG']}</td>
        <td>{$row['AB_POS']}</td>
        <td>{$row['AB_NEG']}</td>
        <td>{$row['total_jumlah']}</td>
        </tr>";
        }
    } else {
        echo "<tr>";
        echo "<td colspan='10'><b>TIDAK ADA DATA</b> untuk ditampilkan.</td>";
        echo "</tr>";
    }
}
