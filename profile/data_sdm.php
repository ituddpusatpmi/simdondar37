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
$v_src   = $_POST['src'];
if (empty($v_src)){$v_src='';}
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>

                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <div class="panel-title pull-left"><h4><strong>DATA PERSONALIA</strong></h4></div>
                            <div class="panel-title pull-right">
                                <form class="form-horizontal" role="form" name="cari" id="cari" action="pmitatausaha.php?module=personalia" method="POST">
                                     <input type="text" class="form-control input-sm" name="src" id="src" placeholder="pencarian data....">
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div id="data_bangunan_udd">
                                <div style="overflow-x:auto;">
                                    <table class="table table-hover table-bordered table-condensed">
                                        <thead class="pmi">
                                        <tr>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Nama</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Jenis Jabatan</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Jenis Tenaga</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Jenis Pendidikan</th>
                                            <th class="text-center" colspan="5" style="vertical-align: middle;">Pendidikan</th>
                                            <th class="text-center" colspan="3" style="vertical-align: middle;">Status Kepegawaian</th>
                                            <th class="text-center" colspan="2" style="vertical-align: middle;;">Pelatihan Tekhnis Pelayanan Darah</th>
                                            <th class="text-center" rowspan="2" style="vertical-align: middle;">Aksi</th>

                                        </tr>
                                        <tr>
                                            <th class="text-center" style="vertical-align: middle;">S2</th>
                                            <th class="text-center" style="vertical-align: middle;">S1</th>
                                            <th class="text-center" style="vertical-align: middle;">D3</th>
                                            <th class="text-center" style="vertical-align: middle;">D1</th>
                                            <th class="text-center" style="vertical-align: middle;">SMA<a href="#" data-toggle="tooltip" data-placement="top" title="SMA/Sederajat atau dibawahnya"><sup>*)</sup></a></th>
                                            <th class="text-center" style="vertical-align: middle;">PNS</th>
                                            <th class="text-center" style="vertical-align: middle;">PMI</th>
                                            <th class="text-center" style="vertical-align: middle;">Honor</th>
                                            <th class="text-center" style="vertical-align: middle;">Ya/<br>Tidak</th>
                                            <th class="text-center" style="vertical-align: middle;">Jenis</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $select_query = "SELECT `sdm_id`, `sdm_tahun`, `sdm_id_udd`, `sdm_urutan`,
                                                        `sdm_nama`, `sdm_jbtn`, `sdm_jenis_tng`, `sdm_pendidikan`,
                                                        `sdm_s2`, `sdm_s1`, `sdm_d3`, `sdm_d1`, `sdm_sma`, `sdm_pns`,
                                                        `sdm_pmi`, `sdm_honor`, `sdm_dpt_plthn`, `sdm_plthn`, `sdm_aktif`
                                                        FROM `rpt_data_sdm`
                                                        WHERE
                                                        ( `sdm_nama` like '%$v_src%') OR
                                                        ( `sdm_jbtn` like '%$v_src%') OR
                                                        ( `sdm_jenis_tng` like '%$v_src%') OR
                                                        ( `sdm_pendidikan` like '%$v_src%') OR
                                                        ( `sdm_plthn` like '%$v_src%')

                                                        order BY `sdm_urutan`, `sdm_id`
                                                        ";
                                        $result = mysql_query($select_query);
                                        $no=0;
                                        while($row = mysql_fetch_array($result)){
                                            $no++;
                                            ?>
                                            <tr>
                                                <td nowrap class="text-right"><?php echo $row["sdm_urutan"];?></td>
                                                <td nowrap><?php echo $row["sdm_nama"];?></td>
                                                <td nowrap><?php echo $row["sdm_jbtn"];?></td>
                                                <td nowrap><?php echo $row["sdm_jenis_tng"];?></td>
                                                <td nowrap><?php echo $row["sdm_pendidikan"];?></td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_s2"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_s1"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_d3"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_d1"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_sma"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_pns"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_pmi"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_honor"]=='1'){
                                                        ?> &radic;<?php
                                                    }?>
                                                </td>
                                                <td nowrap class="text-center"><?php
                                                    if ($row["sdm_dpt_plthn"]=='1'){
                                                        echo "Ya";
                                                    } else {echo "Tidak";}?>
                                                </td>

                                                <td  style="white-space: pre;"><?php echo $row["sdm_plthn"];?></td>

                                                <td class="text-right" nowrap>
                                                    <a href="pmitatausaha.php?module=tambahpersonalia&m=2&x=<?php echo $row['sdm_id']; ?>"><span class="fa fa-pencil" id="shadow2" title="Ubah data bangunan">&nbsp;&nbsp;Edit</span></a>&nbsp;&nbsp;
                                                    <a href="pmitatausaha.php?module=aksi&act=d&mdl=sdm&x=<?php echo $row['sdm_id']; ?>"><span class="fa fa-trash text-danger" id="shadow2" title="Hapus data" onclick="return confirm('Are you sure to delete this item?');">&nbsp;&nbspHapus</span></a>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="pmitatausaha.php?module=tambahpersonalia&m=1" class="btn btn-default" id="shadow2" title="Tambah Data personalia"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;Tambah Data</a>
                            <a href="pmitatausaha.php?module=profile" class="btn btn-default" id="shadow2" title="Kembali"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>