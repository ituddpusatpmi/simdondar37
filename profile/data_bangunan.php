<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMDONDAR</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

</head>
<body>
<?php
session_start();
require_once('config/db_connect.php');
$tahun=date('Y');
$udd="select * from utd where aktif='1'";
$udd=mysql_fetch_assoc(mysql_query($udd));

    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <br>

                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4>DATA BANGUNAN</h4>
                        </div>
                        <div class="panel-body">
                            <div id="data_bangunan_udd">
                                <div style="overflow-x:auto;">
                                    <table class="table table-hover table-bordered table-condensed">
                                        <thead class="pmi">
                                        <tr>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Kepemilikan</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Kelas RS</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Kelas UTD</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Tingkatan</th>
                                            <th class="text-center" colspan="2" style="vertical-align: middle;">Asal Dana</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Operasional<br>Sejak<br>Tahun</th>
                                            <th class="text-center" colspan="2" style="vertical-align: middle;" nowrap>Bantuan Anggaran</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">BPPD</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Dasar Hukum BPPD</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Aksi</th>

                                        </tr>
                                        <tr>
                                            <th class="text-center" style="vertical-align: middle;">Bangunan</th>
                                            <th class="text-center" style="vertical-align: middle;">Alat</th>
                                            <th class="text-center" style="vertical-align: middle;">Ya</th>
                                            <th class="text-center" style="vertical-align: middle;">Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $select_query = "SELECT `b_id`, `b_tahun`, `b_id_udd`, `b_kpemilikan`, `b_klasrs`, `b_klas_udd`, `b_tingkat_udd`,
                                                    `b_dana_bngunan`, `b_dana_alat`, `b_th_operasional`, case when `b_dana_apbd`='0' then '-' ELSE 'Ada' END as b_dana_apbd, `b_jml_dana_apbd`, `b_bppd`,
                                                    `b_sk_bppd`,`b_no_bgn` FROM `rpt_data_bangunan` order by `b_no_bgn`";
                                        $result = mysql_query($select_query);
                                        $no=0;
                                        while($row = mysql_fetch_array($result)){
                                            $no++;
                                            if($row["b_tingkat_udd"]=="Kabupaten"){$kelas_utd="Kabupaten/Kota";}else{$kelas_utd=$row["b_tingkat_udd"];}
                                            if($row["b_kpemilikan"]=="0"){$milik="PMI";}else{$milik="Pemerintah";}
                                            echo '<tr>
                                                        <td nowrap class="text-right">' . $row["b_no_bgn"] . '</td>
                                                        <td nowrap>' . $milik . '</td>
                                                        <td nowrap>' . $row["b_klasrs"] . '</td>
                                                        <td nowrap>' . $row["b_klas_udd"] . '</td>
                                                        <td nowrap>' . $kelas_utd . '</td>
                                                        <td nowrap>' . $row["b_dana_bngunan"] . '</td>
                                                        <td nowrap>' . $row["b_dana_alat"] . '</td>
                                                        <td nowrap class="text-center">' . $row["b_th_operasional"] . '</td>
                                                        <td nowrap class="text-center">' . $row["b_dana_apbd"] . '</td>
                                                        <td nowrap class="text-right">' . $row["b_jml_dana_apbd"] . '</td>
                                                        <td nowrap class="text-right">' . $row["b_bppd"] . '</td>
                                                        <td nowrap>' . $row["b_sk_bppd"] . '</td>
                                                        <td class="text-right" nowrap>';
                                                            ?>  <a href="pmitatausaha.php?module=tambahbangunan&m=2&x=<?php echo $row['b_id']; ?>"><span class="fa fa-pencil" id="shadow2" title="Ubah data bangunan">&nbsp;&nbsp;Edit</span></a>&nbsp;&nbsp;
                                                                <a href="pmitatausaha.php?module=aksi&act=d&mdl=bangunan&x=<?php echo $row['b_id']; ?>"><span class="fa fa-trash text-danger" id="shadow2" title="Hapus data" onclick="return confirm('Are you sure to delete this item?');">&nbsp;&nbspHapus</span></a><?php
                                            echo '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="pmitatausaha.php?module=tambahbangunan&m=1" class="btn btn-default" id="shadow2"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Data Bangunan</a>
                            <a href="pmitatausaha.php?module=profile" class="btn btn-default" id="shadow2"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
            </div>
        </div>
    </div>
</body>
</html>
