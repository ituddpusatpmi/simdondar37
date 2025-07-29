<?php
include "config/dbi_connect.php";

$petugas = "irawanDB"; // 
// $nT = isset($_GET['nT']) ? $_GET['nT'] : '';

function formatTanggal($inputTanggal)
{
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
    $dateTime = new DateTime($inputTanggal);
    $split = explode('-', $inputTanggal);
    // return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

    // Format tanggal dengan zona waktu WIB.
    // $formattedDate = $dateTime->format("d ") . $bulan[(int)$split[1]] . $dateTime->format(" Y - H:i") . " WIB";

    // tanpa zona waktu ..
    $formattedDate = $dateTime->format("d ") . $bulan[(int)$split[1]] . $dateTime->format(" Y - H:i");

    return $formattedDate;
}
if (!empty($nT)) {

    $sql = "SELECT 
    k.id, 
    k.no_permintaan, 
    k.noTrans, 
    k.kodeBdrs, 
    k.nokantong, 
    k.bdrs, 
    k.tgl, 
    k.petugas, 
    s.gol_darah, 
    s.RhesusDrh, 
    s.produk, 
    s.volume, 
    s.tgl_Aftap, 
    s.tglpengolahan, 
    s.kadaluwarsa 
FROM 
    kirimbdrs k 
JOIN 
    stokkantong s 
ON 
    k.nokantong = s.noKantong 
WHERE 
    k.noTrans = '$nT' AND k.`status` IS NULL
ORDER BY 
    s.gol_darah ASC,
    k.id DESC"; 
    $result = $dbi->query($sql);

    // 
        // $noKantong = $_POST['nK'];
        // SELECT jenis, volume, merk, produk, gol_darah, RhesusDrh, tgl_Aftap, tglpengolahan, kadaluwarsa, nolot_ktg 
        // FROM 
        // stokkantong 
        // WHERE 
        // noKantong = ?"
        // Loop dan eksekusi statement untuk setiap kantong

    //Shift Pengolahan
    $shift  = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `nama`,`jam`,`sampai_jam` FROM `shift` WHERE time(now()) between time(`jam`) AND time(`sampai_jam`)"));
    $sf  = $shift['nama'];

    switch ($sf) {
        case 'PAGI':
            $shft = 1;
            break;
        case 'SORE':
            $shft = 2;
            break;
        case 'MALAM':
            $shft = 3;
            break;
        case 'MALAM 2':
            $shft = 4;
            break;
        default:
            $shft = 0;
            break;
    }

    //$sData = "SELECT jenis, produk, tglpengolahan, Status, volume, merk, lama_pengambilan FROM stokkantong WHERE noKantong = ''";
    //$rData = $dbi->query($sData);
    //$sD = fetch_assoc($rData);
    $index = 0;
    $no = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selKantong = "SELECT substring(noKantong, -1) as nK, merk, DATE_ADD(tgl_Aftap, INTERVAL 1 DAY) as besok, TIMESTAMPDIFF(HOUR, tgl_Aftap, NOW()) AS Jarak, jenis, Produk, gol_darah, RhesusDrh, volume, tgl_Aftap, tglpengolahan, kadaluwarsa FROM stokkantong WHERE noKantong = '$row[nokantong]'";
            $resSK = $dbi->query($selKantong);
            $sK = $resSK->fetch_assoc();

            $selMetode = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT Metode FROM hasilelisa WHERE noKantong = '{$row['nokantong']}'"));

            $selIMLTD = "SELECT 
                        MAX(CASE WHEN jenisPeriksa = 0 THEN Hasil END) AS jenisPeriksa_0,
                        MAX(CASE WHEN jenisPeriksa = 1 THEN Hasil END) AS jenisPeriksa_1,
                        MAX(CASE WHEN jenisPeriksa = 2 THEN Hasil END) AS jenisPeriksa_2,
                        MAX(CASE WHEN jenisPeriksa = 3 THEN Hasil END) AS jenisPeriksa_3
                        FROM hasilelisa WHERE noKantong = '{$row['nokantong']}'";
            $sIMLTD = $dbi->query($selIMLTD);
            if ($sIMLTD->num_rows > 0) {
                $hasilIMLTD = $sIMLTD->fetch_assoc();
            } else {
                $hasilIMLTD = array(
                    'jenisPeriksa_0' => null,
                    'jenisPeriksa_1' => null,
                    'jenisPeriksa_2' => null,
                    'jenisPeriksa_3' => null
                );
            }

            // Menetapkan hasil merk jika $sK didefinisikan
            $merk0 = isset($sK['merk']) ? $sK['merk'] : 'Unknown';

            if ($hasilIMLTD['jenisPeriksa_0'] === NULL) {
                $hasilPeriksa0 = "-";
            } else {
                $hasilPeriksa0 = ($hasilIMLTD['jenisPeriksa_0'] == 0) ? "NR" : "R";
            }

            if ($hasilIMLTD['jenisPeriksa_1'] === NULL) {
                $hasilPeriksa1 = "-";
            } else {
                $hasilPeriksa1 = ($hasilIMLTD['jenisPeriksa_1'] == 0) ? "NR" : "R";
            }

            if ($hasilIMLTD['jenisPeriksa_2'] === NULL) {
                $hasilPeriksa2 = "-";
            } else {
                $hasilPeriksa2 = ($hasilIMLTD['jenisPeriksa_2'] == 0) ? "NR" : "R";
            }

            if ($hasilIMLTD['jenisPeriksa_3'] === NULL) {
                $hasilPeriksa3 = "-";
            } else {
                $hasilPeriksa3 = ($hasilIMLTD['jenisPeriksa_3'] == 0) ? "NR" : "R";
            }

            switch ((int)($sK['jenis'])) {
                case 1:
                    $jK = "Single";
                    break;
                case 2:
                    $jK = "Double";
                    break;
                case 3:
                    $jK = "Triple";
                    break;
                case 4:
                    $jK = "Quadruple";
                    break;
                case 6:
                    $jK = "Pediatrik";
                    break;
                default:
                    $jK = "-";
                    break;
            }

            $no++;

            echo "<tr>";
            echo "<td>
                    <button type='button' class='btn btn-link text-danger' onclick='deleteRow(this)' style='width: 30px; height: 30px; padding: 0; border: none; background: none;'>X
                    </button>
                    <input id='idMinta' type='hidden' name='idMinta' value='" . $row["id"] . "'/>
                </td>";
            echo "<td>
                    <input id='NoTrans' type='hidden' name='NoTrans' value='" . $row["noTrans"] . "'/>
                    <input id='petugas' type='hidden' name='petugas' value='" . $petugas . "'/>
                    <input id='shift' type='hidden' name='shift' value='" . $shft . "'/>" . $no . "</td>";
            echo "<td>
                <input type='hidden' name='nK[]' value='" . $row["nokantong"] . "'>" .
                $row["nokantong"] . "
                </td>";
            echo "<td>" . $sK["gol_darah"] . " (" . $sK["RhesusDrh"] . ")</td>";
            echo "<td>" . $sK["Produk"] . "</td>";
            echo "<td>" . $sK["volume"] . "</td>";
            echo "<td>" . formatTanggal($sK["tgl_Aftap"]) . "</td>";
            echo "<td>" . formatTanggal($sK["kadaluwarsa"]) . "</td>";
            echo "<td>" . formatTanggal($sK["tglpengolahan"]) . "</td>";
            echo "<td>" . $hasilPeriksa0 . "</td>";
            echo "<td>" . $hasilPeriksa1 . "</td>";
            echo "<td>" . $hasilPeriksa2 . "</td>";
            echo "<td>" . $hasilPeriksa3 . "</td>";
            echo "<td>" . strtoupper($selMetode["Metode"]) . "</td>";
            echo "</tr>";

            $index++;
        }
    } else {
        echo "<tr>";
        echo "<td colspan='19'><b>TIDAK ADA DATA</b> untuk ditampilkan.</td>";
        echo "</tr>";
    }
}
?>
<script>
    function deleteRow(button) {
        var row = button.closest('tr');
        var id = row.querySelector('input[name="idMinta"]').value; // Mendapatkan idOlah
        var noKantong = row.querySelector('input[name="nK[]"]').value; // Mendapatkan noKantong

        // Set nomor kantong di dalam modal
        document.getElementById('modalNoKantong').textContent = noKantong;

        // Tampilkan modal
        $('#confirmDeleteModal').modal('show');

        // Set up tindakan untuk tombol "Hapus" di modal
        document.getElementById('confirmDeleteButton').onclick = function() {
            // Lanjutkan dengan penghapusan setelah konfirmasi
            $.ajax({
                url: 'modul/dropping/hapusDroppingTemp.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    try {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            // row.remove(); // hanya menghapus dari tampilan HTML
                            location.reload();
                        } else {
                            alert('Gagal menghapus data: ' + jsonResponse.message);
                        }
                    } catch (e) {
                        alert('Gagal memproses response dari server.');
                    }
                    // Sembunyikan modal setelah penghapusan
                    $('#confirmDeleteModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat menghapus data: ' + error);
                    $('#confirmDeleteModal').modal('hide');
                }
            });
        };
    }
</script>
