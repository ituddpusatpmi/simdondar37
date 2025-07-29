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
$tahun      = date("Y");
$v_tahun    = $_POST['tahun'];
if (empty($v_tahun)){$v_tahun=$tahun;}
$udd="select * from utd where aktif='1'";
$udd=mysql_fetch_assoc(mysql_query($udd));
$id_udd=$udd['id'];
$qlap="SELECT `u_id`, `u_tahun`, `u_id_udd`, `u_nama`, `u_alamat`, `u_kab`, `u_prov`, `u_kpos`, `u_telp`, `u_email`,
        `u_ka_nama`, `u_ka_hp`, `u_ka_email`, `u_komite_mdk`, `u_distr_terbuka`, `u_distr_cold_chain`,
        `u_jml_dokter_kompeten`, `u_ptgs_komptn`, `u_inform_c`, `u_lbr_mon_td`, `u_jml_pasien_td`, `u_jml_pasien_rtd`,
         `u_periksa_kgd`, `u_kgd_auto`, `u_kgd_semi`, `u_kgd_manual`, `u_periksa_abs`, `u_abs_auto`, `u_abs_semi`,
         `u_abs_manual`, `u_periksa_iab`, `u_iab_auto`, `u_iab_semi`, `u_iab_manual`, `u_periksa_cross`, `u_cross_auto`,
         `u_cross_semi`, `u_cross_manual` FROM `rpt_data_umum` WHERE `u_id_udd`='$udd[id]'";
$qlap=mysql_fetch_assoc(mysql_query($qlap));
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <br>
            <div class="panel with-nav-tabs panel-primary" id="shadow1">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6">
                            <div><h4 style="text-transform: uppercase;">LAPORAN KETENAGAAN</h4></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel-title pull-right">
                                <form class="form-inline"  method="POST" action="pmitatausaha.php?module=lap_personalia">
                                    <div class="form-group">TAHUN
                                        <select class="form-control" name="tahun">
                                            <?php
                                            $s1='';$s2='';$s3='';$s4='';$s5='';$s6='';
                                            switch ($v_tahun){
                                                case $tahun-5 : $s1='selected';break;
                                                case $tahun-4 : $s2='selected';break;
                                                case $tahun-3 : $s3='selected';break;
                                                case $tahun-2 : $s4='selected';break;
                                                case $tahun-1 : $s5='selected';break;
                                                case $tahun   : $s6='selected';break;
                                            }
                                            ?>
                                            <option value='<?php echo $tahun-5;?>' <?php echo $s1; ?> > <?php echo $tahun-5?> </option>
                                            <option value='<?php echo $tahun-4;?>' <?php echo $s2; ?> > <?php echo $tahun-4?> </option>
                                            <option value='<?php echo $tahun-3;?>' <?php echo $s3; ?> > <?php echo $tahun-3?> </option>
                                            <option value='<?php echo $tahun-2;?>' <?php echo $s4; ?> > <?php echo $tahun-2?> </option>
                                            <option value='<?php echo $tahun-1;?>' <?php echo $s5; ?> > <?php echo $tahun-1?> </option>
                                            <option value='<?php echo $tahun;?>'   <?php echo $s6; ?> > <?php echo $tahun?> </option>
                                        </select>
                                    </div>
                                    <button class="btn btn-default" type="submit" id="shadow2"><i class="fa fa-check mr-1"></i> OK</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="text-center"><h4>LAPORAN KETENAGAAN</h4></div>
                        <div class="text-center"><h4><?php echo $qlap['u_nama'];?></h4></div>
                        <div class="text-center"><h4 style="text-transform: uppercase;"> <?php echo 'TAHUN '.$v_tahun;?></h4></div>
                        <div class="text-left"><h5>D. KETENAGAAN</h5></div>
                        <div style="overflow-x:auto;">
                        <table class="table table-hover table-bordered table-condensed" style="width: 100%;">
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

                                                        order BY `sdm_id`
                                                        ";
                            //echo $select_query;
                            $result = mysql_query($select_query);
                            $no=0;
                            while($row = mysql_fetch_array($result)){
                                $no++;
                                ?>
                                <tr>
                                    <td nowrap class="text-right"><?php echo $no;?></td>
                                    <td nowrap><?php echo $row["sdm_nama"];?></td>
                                    <td ><?php echo $row["sdm_jbtn"];?></td>
                                    <td ><?php echo $row["sdm_jenis_tng"];?></td>
                                    <td ><?php echo $row["sdm_pendidikan"];?></td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_s2"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_s1"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_d3"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_d1"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_sma"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_pns"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_pmi"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_honor"]=='1'){
                                            ?> &radic;<?php
                                        }?>
                                    </td>
                                    <td class="text-center"><?php
                                        if ($row["sdm_dpt_plthn"]=='1'){
                                            echo "Ya";
                                        } else {echo "Tidak";}?>
                                    </td>
                                    <td  style="white-space: pre;"><?php echo $row["sdm_plthn"];?></td>
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
                    <a href="pmitatausaha.php?module=upload&mdl=umum&t=<?php echo $tahun;?>" class="btn btn-default" id="shadow2" title="Upload Laporan ke UDD Pusat"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload ke Pusat</a>
                    <a href="pmitatausaha.php?module=rpt_personalia&thn=<?php echo $v_tahun;?>" class="btn btn-default" id="shadow2"><i class="fa fa-print" aria-hidden="true" title="Cetak Laporan"></i>&nbsp;&nbsp;Cetak Laporan</a>
                    <a href="pmitatausaha.php?module=laporan" class="btn btn-default" id="shadow2"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                </div>

            </div>
        </div>
    </div>
 </div>
</body>
</html>

