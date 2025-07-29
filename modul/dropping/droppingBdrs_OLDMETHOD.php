<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropping Darah ke BDRS</title>

    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="modul/dropping/css/bootstrap/4.5.2/bootstrap.min.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> -->

    <!-- jQuery (Required if using jQuery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="modul/dropping/css/dropping.css">
    <script>
        window.onload = function() {
            document.getElementById('nomorKantong').focus();
        };
    </script>
</head>
<?php
require_once("config/dbi_connect.php");
$hariIni = DATE("Y-m-d");

//$nT = "NA120824-3671-001";
$nT = isset($_GET['nt']) ? $_GET['nt'] : '';

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

$selDMinta = "SELECT `id_permintaan`, `bdrs_udd`, `noTrans`, `kodeBDRS`, `ptgMinta`, DATE(`tgl`) as tgl FROM dpermintaan_darah WHERE `noTrans` = '$nT'";
$sDMinta = $dbi->query($selDMinta);
if ($sDMinta->num_rows > 0) {
    $sDM = $sDMinta->fetch_assoc();
}
// $selMinta = "SELECT `id_permintaan`, `noTrans`, `kodeBDRS` FROM hpermintaan_darah WHERE `noTrans` = '$nT'";
// $sMinta = $dbi->query($selMinta);
// if($sMinta->num_rows > 0){
//     $sM = $sMinta->fetch_assoc();
// }
$selBdrs = "SELECT `kode`, `kd_online`, `nama` FROM bdrs WHERE `kode` = '$sDM[bdrs_udd]'";
$sBdrs = $dbi->query($selBdrs);
if ($sBdrs->num_rows > 0) {
    $sB = $sBdrs->fetch_assoc();
}

function tanggalSaja($tglSaja)
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

    // Memeriksa apakah input tanggal sesuai dengan format YYYY-mm-dd
    $dateTime = DateTime::createFromFormat('Y-m-d', $tglSaja);
    if (!$dateTime) {
        return 'Format tanggal tidak valid';
    }

    $split = explode('-', $tglSaja);
    if (count($split) < 3) {
        return 'Format tanggal tidak valid';
    }

    // Format tanggal dengan nama bulan dalam Bahasa Indonesia
    $tanggalSaja = $dateTime->format("d ") . $bulan[(int)$split[1]] . $dateTime->format(" Y");

    return $tanggalSaja;
}

$sql = "SELECT `nokantong` FROM kirimbdrs WHERE noTrans = '$nT' ORDER BY `id` DESC";
$result = $dbi->query($sql);

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

// Untuk Tombol Simpan dan Lanjutkan
$isDisabled = ($result->num_rows <= 0) ? 'disabled' : '';
?>

<body>
    <div class="container-fluid">
        <h3 class="text-center my-5">Pengiriman Darah ke BDRS
            <br>
		<b>
		   <?php echo strtoupper($sB['nama']); ?>
		</b>
        </h3>

        <div class="container-fluid">
            <div class="row no-gutters align-items-end">
                <div class="col-6">
                    <div class="row no-gutters">
                        <div class="col-3">
                            <h6>
                                <label for="noTrans">No. Transaksi</label>
                            </h6>
                        </div>
                        <div class="col-6">
                            <h6 style="color: #dc3545;">
                                <label for="noTransIsi">:</label>&nbsp;<b><?php echo $nT; ?></b>
                                <input type="hidden" id="noTransIsi" name="noTransIsi" value="<?php echo $nT; ?>">
                            </h6>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-3">
                            <h6>
                                <label for="tglMinta">Tanggal Permintaan</label>
                            </h6>
                        </div>
                        <div class="col-6">
                            <h6>
                                <label for="tglMintaIsi">:</label>&nbsp;<b><?php echo tanggalSaja($sDM['tgl']); ?></b>
                                <input type="hidden" id="tglMintaIsi" name="tglMintaIsi" value="<?php echo $sDM['tgl']; ?>">
                            </h6>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-3">
                            <h6>
                                <label for="tujuan">Tujuan</label>
                            </h6>
                        </div>
                        <div class="col-6">
                            <h6>
                                <label for="tujuanIsi">:</label>&nbsp;<b><?php echo $sB['nama']; ?></b>
                                <input class="form-control" type="hidden" id="tujuanIsi" name="tujuanIsi" value="<?php echo $sB['kode']; ?>" readonly>
                            </h6>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-3">
                            <h6>
                                <label for="jenisMinta">Jenis Permintaan</label>
                            </h6>
                        </div>
                        <div class="col-6">
                            <h6 style="color: #28a745;">
                                <label for="jenisMintaIsi">:</label>&nbsp;<b>DROPPING</b>
                                <input class="form-control" type="hidden" id="jenisMintaIsi" name="jenisMintaIsi" value="<?php echo "DROPPING"; ?>" readonly>
                            </h6>
                        </div>
                    </div>
                    <input id="shift" type="hidden" name="shift" value="<?php echo ($shft); ?>" />
                    <div class="row no-gutters">
                        <div class="form-group col-6">
                            <label for="nomorKantong">Nomor Kantong:</label>
                            <input type="text" class="form-control" id="nomorKantong" onkeypress="handleKeyPress(event)">
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <h4 class="text-center">Rincian Permintaan Darah</h4>
                    <div class="cell cell__big">
                        <table class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle">KOMPONEN</th>
                                    <th colspan="2" style="vertical-align: middle">A</th>
                                    <th colspan="2" style="vertical-align: middle">B</th>
                                    <th colspan="2" style="vertical-align: middle">O</th>
                                    <th colspan="2" style="vertical-align: middle">AB</th>
                                    <th rowspan="2" style="vertical-align: middle">JUMLAH</th>
                                </tr>
                                <tr>
                                    <th>POS</th>
                                    <th>NEG</th>
                                    <th>POS</th>
                                    <th>NEG</th>
                                    <th>POS</th>
                                    <th>NEG</th>
                                    <th>POS</th>
                                    <th>NEG</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                $nT; // Ambil nilai nT dari query string
                                include 'modul/dropping/droppingDataMinta.php';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <form name="droppingForm" id="droppingForm">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle"></th>
                        <th rowspan="2" style="vertical-align: middle">No.</th>
                        <th rowspan="2" style="vertical-align: middle">No. Kantong</th>
                        <th rowspan="2" style="vertical-align: middle">Gol. Darah (Rhesus)</th>
                        <th rowspan="2" style="vertical-align: middle">Komponen Darah</th>
                        <th rowspan="2" style="vertical-align: middle">Volume</th>
                        <th rowspan="2" style="vertical-align: middle">Tgl Aftap</th>
                        <th rowspan="2" style="vertical-align: middle">Tgl Kedaluwarsa</th>
                        <th rowspan="2" style="vertical-align: middle">Tgl Pengolahan</th>
                        <th colspan="4" style="vertical-align: middle">Hasil Pemeriksaan</th>
                        <th rowspan="2" style="vertical-align: middle">Metode Pemeriksaan</th>
                    </tr>
                    <tr>
                        <th>HBsAg</th>
                        <th>HCV</th>
                        <th>HIV Produk</th>
                        <th>Syphilis</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    $nT; // Ambil nilai nT dari query string
                    include 'modul/dropping/droppingData.php'; 
                    ?>
                </tbody>
            </table>
            <button class="btn btn-success" type="button" onclick="simpanDanLanjutkan()" <?php echo $isDisabled; ?>>
                Simpan dan Lanjutkan
            </button>

        </form>
    </div>

    <!-- MODAL PROSES PENGOLAHAN BERHASIL -->
    <div class="modal fade" id="suksesModal" tabindex="-1" role="dialog" aria-labelledby="suksesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Berhasil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Pesan kesalahan boleh diisi di sini gess -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PESAN ERROR -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Terjadi Kesalahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Pesan kesalahan boleh diisi di sini gess -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HAPUS BARIS -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">HAPUS DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus baris Nomor Kantong <b id="modalNoKantong"></b> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="modul/dropping/js/aksiDropping.js" defer></script>

    <script>
        function simpanDanLanjutkan() {
            var formData = new FormData(document.getElementById('droppingForm'));

            $.ajax({
                url: 'modul/dropping/prosesDropping.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        // Parsing JSON dari respons
                        var jsonResponse = response; // Jika jQuery otomatis parsing JSON

                        if (jsonResponse.status === 'success') {
                            // Tampilkan modal sukses
                            $('#suksesModal .modal-body').html(jsonResponse.message);
                            $('#suksesModal').modal('show');

                            // Setelah modal ditutup, direct dengan parameter noTrans
                            $('#suksesModal').on('hidden.bs.modal', function() {
                                location.reload();
                            });
                        } else {
                            $('#errorModal .modal-body').html(jsonResponse.message);
                            $('#errorModal').modal('show');
                        }
                    } catch (e) {
                        $('#errorModal .modal-body').html('Terjadi kesalahan saat memproses respons.');
                        $('#errorModal').modal('show');
                    }

                }
            });
        }
    </script>
</body>

</html>
