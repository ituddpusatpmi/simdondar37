<?php

/***********************************************
 * Author 	: suwena 
 * Date 	: 26 Mei 2018
 * Modifier 	: irawan
 * Date 	: 29 Januari 2024
 * Fungsi	: Daftar Permintaan Dropping Darah BDRS (Online)
 * Keterangan Modul : 
 * 		MENU BARU
 * Table terkait : 
 *		- Select 	: stokkantong, dpermintaan_darah JOIN hpermintaan_darah
 *		- exec (local)  : stokkantong (UPDATE), kirim_bdrs (INSERT)
 *		- exec (online) : b_minta (UPDATE), b_mintad (UPDATE), b_stok (INSERT)
 ***********************************************/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
    <link type="text/css" href="css/calender.css" rel="stylesheet" />
    <!--<link type="text/css" href="css/table1.css" rel="stylesheet" />-->
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
    <script type="text/javascript" src="js/tgl_rekap.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
    <link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />

    <style>
        #serahterima {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 16px;
            border-collapse: collapse;
        }

        #serahterima td,
        #serahterima th {
            border: 1px solid #ddd;
            padding: 5px;
        }

        #serahterima tr:nth-child(even) {
            background-color: #ffe6e6;
        }

        #serahterima tr:hover {
            background-color: #ddd;
        }

        #serahterima th {
            padding-top: 3px;
            padding-bottom: 3px;
            text-align: left;
            font-weight: lighter;
            background-color: #ff9999;
            color: #000000;
        }

        #serahterima input {
            padding-top: 2px;
            padding-bottom: 2px;
            text-align: left;
            background-color: lightyellow;
            color: #000000;
        }
    </style>
</head>

<?php
require_once('clogin.php');
require_once('config/dbi_connect.php');
$namauser = $_SESSION['namauser'];
$namalengkap = $_SESSION['nama_lengkap'];

$tglawal = date("Y-m-d");
$hariini = date("Y-m-d");
$notransaksi = "";

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
    $formattedDate = $dateTime->format("d ") . $bulan[(int) $split[1]] . $dateTime->format(" Y - H:i") . " WIB";

    return $formattedDate;
}

?>

<body>
    <div class="container col-lg">
        <!-- membuat tulisan alert berwarna hijau dengan tulisan di tengah  -->
        <h3 class="alert alert-info text-center" role="alert">
            DAFTAR PERMINTAAN DROPPING DARAH (BDRS) - <i>Online</i>
        </h3>
        <br>
        <!-- membuat card untuk membungkus tabel bootstrap  -->
        <div class="card">
            <div class="card-body">

                <!--
                <a name="atas" id="atas"></a>
                <div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">DAFTAR PERMINTAAN DROPPING DARAH (BDRS) - <i>Online</i></div>
                <br>
        -->
                <?php
                if (!empty($_POST['waktu'])) {
                    $tglawal = $_POST['waktu'];
                }
                if (!empty($_POST['waktu1'])) {
                    $hariini = $_POST['waktu1'];
                }
                ?>
                <form name="cari" method="POST" action="">
                    <table class="list" cellpadding=1 cellspacing="0" border="0">
                        <tr class="field">
                            <td align="left" nowrap>Dari tanggal :</td>
                            <td><input name="waktu" id="datepicker" value="<?= $tglawal ?>" type=text size=10></td>
                            <td align="right" nowrap>sampai tanggal :</td>
                            <td><input name="waktu1" id="datepicker1" value="<?= $hariini ?>" type=text size=10></td>
                            <td><input type=submit name=submit class="swn_button_blue" value="Ok"></td>
                        </tr>
                    </table>
                </form>

                <table id="serahterima"
                    style="border-collapse: collapse; border: 2px solid #808080; box-shadow: 1px 2px 2px #000000; width: 100%;">
                    <tr style="font-size: 12px">
                        <th style="height: 40px; text-align: center; font-weight: bold" rowspan="3">No</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" rowspan="3">No. Transaksi</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" rowspan="3">Jenis Permintaan
                        </th>
                        <th style="height: 40px; text-align: center; font-weight: bold" rowspan="3">Tgl. Permintaan</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" rowspan="3">Asal</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" rowspan="3">Petugas</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" colspan="8">Jumlah</th>
                        <!-- <th style="height: 40px; text-align: center; font-weight: bold" rowspan="2">Lihat Formulir<br>Permintaan Dropping</th> -->
                        <th style="height: 40px; text-align: center; font-weight: bold" rowspan="3">Aksi</th>
                    </tr>
                    <tr style="font-size: 12px">
                        <th style="height: 40px; text-align: center; font-weight: bold" colspan="2">WB</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" colspan="2">PRC</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" colspan="2">TC</th>
                        <th style="height: 40px; text-align: center; font-weight: bold" colspan="2">FFP</th>
                    </tr>
                    <tr style="font-size: 12px">
                        <th style="height: 40px; text-align: center; font-weight: bold">Permintaan</th>
                        <th style="height: 40px; text-align: center; font-weight: bold">Terpenuhi</th>
                        <th style="height: 40px; text-align: center; font-weight: bold">Permintaan</th>
                        <th style="height: 40px; text-align: center; font-weight: bold">Terpenuhi</th>
                        <th style="height: 40px; text-align: center; font-weight: bold">Permintaan</th>
                        <th style="height: 40px; text-align: center; font-weight: bold">Terpenuhi</th>
                        <th style="height: 40px; text-align: center; font-weight: bold">Permintaan</th>
                        <th style="height: 40px; text-align: center; font-weight: bold">Terpenuhi</th>
                    </tr>
                    <?php
                    $no = 0;
			
		    $q_utd = mysqli_query($dbi, "select id from utd where aktif='1'");
         	    $utd   = mysqli_fetch_assoc($q_utd);

                    // ** minta token dulu dong **
                    $oauthUrl = "https://bdrs.or.id/OAuth2_tk.php";
                    $clientId = $utd['id'];
		    //error_log("ID UDD adalah: ".$clientId);
                    $clientSecret = "clients_udds";

                    // set parameter untuk request token
                    $tokenParams = http_build_query(array(
                        'grant_type' => 'client_credentials',
                        'client_id' => $clientId,
                        'client_secret' => $clientSecret,
                    ));

                    // Buat permintaan token OAuth2
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $oauthUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POST, true);
                    //curl_setopt($ch, CURLOPT_POSTFIELDS, $tokenParams);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode($tokenParams));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/x-www-form-urlencoded',
                    ));

                    $tokenResponse = curl_exec($ch);
		    $error = curl_error($ch);
                    curl_close($ch);

			//error_log("OAuth Response: " . $tokenResponse);
			if ($error) {
			    error_log("cURL Error: " . $error);
			}

			// Debugging - Output ke browser console (via HTML)
			//echo "<script>console.log('OAuth Response: " . addslashes($tokenResponse) . "');</script>";

                    // Decode respons token
                    $tokenData = json_decode($tokenResponse, true);

                    // Periksa apakah token berhasil diambil
                    if (!isset($tokenData['access_token'])) {
			error_log("Gagal mendapatkan OAuth2 Token: " . json_encode($tokenData));
                        die(json_encode(array('status' => 'error', 'message' => 'Gagal mendapatkan OAuth2 Token')));
                    }

                    $accessToken = $tokenData['access_token'];
                    $sessUDD = $tokenData['udds'];
                   
		    //error_log("token dan sessUDD adalah: ".$accessToken." - ".$sessUDD); 

                    // **2. Panggil API `apiDaftarMintaBDRS.php` dengan Header Authorization**
                    //$apiUrl = "https://bdrs.or.id/apiDaftarMintaBDRS.php?idUDD=$sessUDD"; // Tidak pakai `tooks`
                    $apiUrl = "https://bdrs.or.id/apiDaftarMintaBDRS.php?idUDD=$sessUDD&tooks=$accessToken"; // Tidak pakai `tooks`
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $apiUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        "Authorization: Bearer $accessToken" // Kirim token di header
                    ));

                    $apiResponse = curl_exec($ch);
                    curl_close($ch);
		
			// Debugging - Log response API ke file error log
			//error_log("API Response: " . $apiResponse);
			if ($error) {
			    error_log("cURL API Error: " . $error);
			}

			// Debugging - Output ke browser console (via HTML)
			//echo "<script>console.log('API Response: " . addslashes($apiResponse) . "');</script>";

                    $apiData = json_decode($apiResponse, true);

                    $apiPermintaan = array(); // Array untuk menyimpan data API
                    if ($apiData && $apiData['status'] === 'success') {
                        foreach ($apiData['data'] as $permintaan) {
                            $idPermintaan = $permintaan['id_permintaan'];
                            $jenisMinta = $permintaan['jenisMinta'];
			    $dateObj = new DateTime($permintaan['tgl']);
			    $tglMinta = $dateObj->format('d-m-Y');
                            $noTrans = $permintaan['noTrans'];
                            $kodeBDRS = $permintaan['kodeBDRS'];
                            $ptgMinta = $permintaan['ptgMinta'];
                            $status = $permintaan['status'];

                            $jM = ($jenisMinta == '0') ? "DROPPING" : (($jenisMinta == '1') ? "RETUR" : "-");

                            $selBDRSOL = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `nama` FROM `bdrs` WHERE `kd_online` = '$kodeBDRS'"));
                            $jumBeriWB = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$idPermintaan' AND `produk` = 'WB'"));
                            $jumBeriPRC = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$idPermintaan' AND `produk` = 'PRC'"));
                            $jumBeriTC = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$idPermintaan' AND `produk` = 'TC'"));
                            $jumBeriFFP = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$idPermintaan' AND `produk` = 'FFP'"));
                            $jumBeriWB = $jumBeriWB['Jumlah'];
                            $jumBeriPRC = $jumBeriPRC['Jumlah'];
                            $jumBeriTC = $jumBeriTC['Jumlah'];
                            $jumBeriFFP = $jumBeriFFP['Jumlah'];
                            $jumBeri = $jumBeriWB + $jumBeriPRC + $jumBeriTC + $jumBeriFFP;

                            // Tentukan aksi berdasarkan status
                            if ($status == 0) {
                                $actions = '<a href="pmikomponen.php?module=form_bdrs_ol&nt=' . $noTrans . '&clid=' . $clientId . '&tooks=' . $accessToken . '">
                                                 <button class="btn-accept btn-success">Proses</button>
                                             </a> |
                                             <button class="btn-reject btn-danger" data-id="' . $noTrans . '">Reject</button>';
                                //$actions = '<a href="droppingBdrs.php?nt=' . $noTrans . '&clid=' . $clientId . '&tooks=' . $accessToken . '">
                                //                <button class="btn-accept btn-success">Proses</button>
                                //            </a> |
                                //            <button class="btn-reject btn-danger" data-id="' . $noTrans . '" data-client-id="' . $clientId . '" data-access-token="' . $accessToken . '">Reject</button>';
                            } else {
                                $actions = $stts; // Tampilkan status jika tidak dalam kondisi 0
                            }


                            // Hitung jumlah produk berdasarkan jenisnya
                            $jumWB = $jumPRC = $jumTC = $jumFFP = 0;
                            foreach ($permintaan['details'] as $detail) {
                                switch ($detail['produk']) {
                                    case 'WB':
                                        $jumWB += $detail['jumlah'];
                                        break;
                                    case 'PRC':
                                        $jumPRC += $detail['jumlah'];
                                        break;
                                    case 'TC':
                                        $jumTC += $detail['jumlah'];
                                        break;
                                    case 'FFP':
                                        $jumFFP += $detail['jumlah'];
                                        break;
                                }
                            }

                            $apiPermintaan[] = array(
                                'noTrans' => $noTrans,
                                'jenisMinta' => $jM,
                                'tgl' => $tglMinta, // API tidak memiliki tanggal
                                'namaBDRS' => $selBDRSOL['nama'],
                                'ptgMinta' => $ptgMinta,
                                'jumWB' => $jumWB,
                                'jumBeriWB' => $jumBeriWB,
                                'jumPRC' => $jumPRC,
                                'jumBeriPRC' => $jumBeriPRC,
                                'jumTC' => $jumTC,
                                'jumBeriTC' => $jumBeriTC,
                                'jumFFP' => $jumFFP,
                                'jumBeriFFP' => $jumBeriFFP,
                                'status' => $actions
                            );
                        }
                    }

                    // Query Database
                    $qry = "SELECT 
                            d.`id_permintaan`, 
                            d.`jenisMinta`, 
                            d.`bdrs_udd`, 
                            d.`noTrans`, 
                            d.`kodeBDRS`, 
                            d.`ptgMinta`, 
                            DATE_FORMAT(d.`tgl`,'%d-%m-%Y') as tgl, 
                            d.`status` 
                            FROM `dpermintaan_darah` d 
                            WHERE (DATE(d.`tgl`)>='$tglawal' AND DATE(d.`tgl`)<='$hariini') 
                            AND d.`noTrans` IS NOT NULL 
                            AND d.`kodeBDRS` IS NOT NULL";

                    $sql = mysqli_query($dbi, $qry);

                    // Fungsi untuk mendapatkan jumlah produk darah
                    function getJumlah($dbi, $id, $produk, $table, $field)
                    {
                        $id = mysqli_real_escape_string($dbi, $id);
                        $produk = mysqli_real_escape_string($dbi, $produk);

                        $query = "SELECT COALESCE(SUM($field), 0) AS Jumlah FROM $table WHERE id_permintaan = '$id' AND produk = '$produk'";
                        $result = mysqli_query($dbi, $query);

                        if (!$result) {
                            die("Query Error: " . mysqli_error($dbi) . " - Query: " . $query);
                        }

                        #return mysqli_fetch_assoc($result)array("Jumlah");
			$row = mysqli_fetch_assoc($result);
			return $row["Jumlah"];

                    }

                    // Inisialisasi Total
                    $jmltotalWB = $jmltotalPRC = $jmltotalTC = $jmltotalFFP = 0;

                    // Loop Data dari Database
                    while ($tmp = mysqli_fetch_assoc($sql)) {
                        $no++;
                        $jM = ($tmp['jenisMinta'] == '0') ? "DROPPING" : (($tmp['jenisMinta'] == '1') ? "RETUR" : "-");
                        $stts = ($tmp['status'] == '0') ? "Belum diProses" : (($tmp['status'] == '1') ? "Selesai" : "Dibatalkan");

                        $selBdrs = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT `nama` FROM `bdrs` WHERE `kd_online` = '$tmp[kodeBDRS]'"));

                        $jumWB = getJumlah($dbi, $tmp['id_permintaan'], 'WB', 'hpermintaan_darah', 'jumlah');
                        $jumPRC = getJumlah($dbi, $tmp['id_permintaan'], 'PRC', 'hpermintaan_darah', 'jumlah');
                        $jumTC = getJumlah($dbi, $tmp['id_permintaan'], 'TC', 'hpermintaan_darah', 'jumlah');
                        $jumFFP = getJumlah($dbi, $tmp['id_permintaan'], 'FFP', 'hpermintaan_darah', 'jumlah');

                        // Menjumlahkan total
                        $jmltotalWB += $jumWB;
                        $jmltotalPRC += $jumPRC;
                        $jmltotalTC += $jumTC;
                        $jmltotalFFP += $jumFFP;

                        $jumBeriWB = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$tmp[id_permintaan]' AND `produk` = 'WB'"));
                        $jumBeriPRC = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$tmp[id_permintaan]' AND `produk` = 'PRC'"));
                        $jumBeriTC = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$tmp[id_permintaan]' AND `produk` = 'TC'"));
                        $jumBeriFFP = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(`nokantong`) AS Jumlah FROM `kirim_bdrs` WHERE `id_permintaan` = '$tmp[id_permintaan]' AND `produk` = 'FFP'"));
                        $jumBeriWB = $jumBeriWB['Jumlah'];
                        $jumBeriPRC = $jumBeriPRC['Jumlah'];
                        $jumBeriTC = $jumBeriTC['Jumlah'];
                        $jumBeriFFP = $jumBeriFFP['Jumlah'];
                        $jumBeri = $jumBeriWB + $jumBeriPRC + $jumBeriTC + $jumBeriFFP;

                        ?>
                        <tr style="text-align: center; font-size: 12px;height: 30px;">
                            <td align="right"><?php echo $no; ?>.</td>
                            <td><?php echo $tmp['noTrans']; ?></td>
                            <td><?php echo $jM; ?></td>
                            <td><?php echo $tmp['tgl']; ?></td>
                            <td><?php echo $selBdrs['nama']; ?></td>
                            <td><?php echo $tmp['ptgMinta']; ?></td>
                            <td><?php echo $jumWB; ?></td>
                            <td><?php echo $jumBeriWB; ?></td>
                            <td><?php echo $jumPRC; ?></td>
                            <td><?php echo $jumBeriPRC; ?></td>
                            <td><?php echo $jumTC; ?></td>
                            <td><?php echo $jumBeriTC; ?></td>
                            <td><?php echo $jumFFP; ?></td>
                            <td><?php echo $jumBeriFFP; ?></td>
                            <td>
                                <?php if ($tmp['status'] == 0) { ?>
                                    <a href="pmikomponen.php?module=form_bdrs_ol&nt=<?php echo$tmp['noTrans'] ?>&clid=<?php echo $clientId ?>&tooks=<?php echo $accessToken ?>">
                                    <!--<a href="droppingBdrs.php?nt=<?= $tmp['noTrans'] ?>">-->
                                        <button class="btn-accept btn-success">
                                            Proses
                                        </button>
                                    </a>
                                    |
                                    <button class="btn-reject btn-danger"
                                        data-id="<?php echo $tmp['noTrans']; ?>">Reject</button>

                                <?php } else {
                                    echo $stts;
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }

                    // Loop Data dari API
                    foreach ($apiPermintaan as $data) {
                        $no++;

                        echo "<tr style='text-align: center; font-size: 12px; height: 30px;'>";
                        echo "<td align='right'>{$no}.</td>";
                        echo "<td>{$data['noTrans']}</td>";
                        echo "<td>{$data['jenisMinta']}</td>";
                        echo "<td>{$data['tgl']}</td>";
                        echo "<td>{$data['namaBDRS']}</td>";
                        echo "<td>{$data['ptgMinta']}</td>";
                        echo "<td>{$data['jumWB']}</td>";
                        echo "<td>{$data['jumBeriWB']}</td>";
                        echo "<td>{$data['jumPRC']}</td>";
                        echo "<td>{$data['jumBeriPRC']}</td>";
                        echo "<td>{$data['jumTC']}</td>";
                        echo "<td>{$data['jumBeriTC']}</td>";
                        echo "<td>{$data['jumFFP']}</td>";
                        echo "<td>{$data['jumBeriFFP']}</td>";
                        echo "<td>{$data['status']}</td>";
                        echo "</tr>";
                    }
                    ?>
		    <!--
                    <tr style="text-align: center; font-size: 12px; height: 40px;">
                        <td colspan="6">TOTAL</td>
                        <td><?php echo $jmltotalWB; ?></td>
                        <td><?php echo $jmltotalPRC; ?></td>
                        <td><?php echo $jmltotalTC; ?></td>
                        <td><?php echo $jmltotalFFP; ?></td>
                        <td>-</td>
                    </tr>
		    -->
                </table>
                <br>
            </div>
        </div>
        <div style="font-size:10px; color:#000000; font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">Build :
            19-01-2024</div>
    </div>


    <!-- Modal Detail -->
    <div class="modal fade" id="mdInfo" aria-hidden="true" aria-labelledby="exampleOptionalLarge" role="dialog"
        tabindex="-1">
        <div class="modal-dialog modal-simple modal-center modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p>
                    <h4 class="modal-title">Detail Permintaan - </h4>
                    <h4 class="modal-title" id="infoNt"></h4>
                    </p>
                </div>
                <!-- <form action="" method="POST"> -->
                <div class="modal-body">
                    <!-- <h4>Detail Permintaan Darah</h4> -->
                    <table>
                        <tr>
                            <td style="font-size: 12pt">No. Transaksi</td>
                            <td>:</td>
                            <td style="text-align: left; font-size: 12pt; font-weight: bold;" id="infoNt">No. Transaksi
                            </td>
                        </tr>
                        <tr>
                            <td>Asal</td>
                            <td>:</td>
                            <td style="text-align: left;" id="infoAsal">Asal</td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>:</td>
                            <td style="text-align: left;" id="infoTujuan">Tujuan</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12pt">Jenis Permintaan</td>
                            <td>:</td>
                            <td style="text-align: left; font-size: 12pt; font-weight: bold;" id="infoJenis">Jenis
                                Permintaan</td>
                        </tr>
                        <tr>
                            <td>Tanggal Permintaan</td>
                            <td>:</td>
                            <td style="text-align: left;" id="infoTglMinta">Tanggal Permintaan</td>
                        </tr>
                        <tr>
                            <td>Petugas BDRS</td>
                            <td>:</td>
                            <td style="text-align: left;" id="infoPtgMinta">Petugas BDRS</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12pt">Status Permintaan</td>
                            <td>:</td>
                            <td style="text-align: left; font-size: 12pt; font-weight: bold;" id="infoStats">Status
                                Permintaan</td>
                        </tr>
                    </table>
                    <input type="hidden" name="infoID" id="infoID">
                    <br><br>
                    <table class="table table-striped" border="1px">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center text-middle">Komponen Darah yang Diminta</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="text-center text-middle">Komponen Darah</th>
                                <th colspan="5" class="text-center text-middle">Golongan Darah</th>
                            </tr>
                            <tr>
                                <th class="text-center text-middle">A</th>
                                <th class="text-center text-middle">B</th>
                                <th class="text-center text-middle">O</th>
                                <th class="text-center text-middle">AB</th>
                                <th class="text-center text-middle">JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>WB (<i>Whole Blood</i>)</td>
                                <td class="text-center text-middle" id="infoWba"></td>
                                <td class="text-center text-middle" id="infoWbb"></td>
                                <td class="text-center text-middle" id="infoWbo"></td>
                                <td class="text-center text-middle" id="infoWbab"></td>
                                <td class="text-center text-middle" id="infoJumWB"></td>
                            </tr>
                            <tr>
                                <td>PRC (<i>Packet Red Cells</i>)</td>
                                <td class="text-center text-middle" id="infoPrca"></td>
                                <td class="text-center text-middle" id="infoPrcb"></td>
                                <td class="text-center text-middle" id="infoPrco"></td>
                                <td class="text-center text-middle" id="infoPrcab"></td>
                                <td class="text-center text-middle" id="infoJumPRC"></td>
                            </tr>
                            <tr>
                                <td>TC (<i>Thrombocyte</i>)</td>
                                <td class="text-center text-middle" id="infoTca"></td>
                                <td class="text-center text-middle" id="infoTcb"></td>
                                <td class="text-center text-middle" id="infoTco"></td>
                                <td class="text-center text-middle" id="infoTcab"></td>
                                <td class="text-center text-middle" id="infoJumTC"></td>
                            </tr>
                            <tr>
                                <td>FFP (<i>Fresh Frozen Plasma</i>)</td>
                                <td class="text-center text-middle" id="infoFfpa"></td>
                                <td class="text-center text-middle" id="infoFfpb"></td>
                                <td class="text-center text-middle" id="infoFfpo"></td>
                                <td class="text-center text-middle" id="infoFfpab"></td>
                                <td class="text-center text-middle" id="infoJumFFP"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" name="infoData" class="btn btn-primary">IYA</button> 
                                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">TIDAK</button> -->
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
    <!-- End Modal Detail -->

    <script>
        document.querySelectorAll('.btn-reject').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;

                // Tampilkan konfirmasi
                const confirmed = confirm('Apakah Anda yakin ingin menolak data ini?');
                if (confirmed) {
                    // Kirim permintaan ke server
                    fetch('modul/dropping/batalkanPermintaan.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: id })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Data permintaan dropping berhasil ditolak!');
                                window.location.href = 'pmiqa.php?module=permintaan_bdrs_list';
                            } else {
                                alert('Gagal menolak data: ' + data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>


</body>
