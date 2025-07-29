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

<div class="container">
    <div class="row">
        <div class="col-lg-10">
        <br>
            <div class="panel with-nav-tabs panel-primary" id="shadow1">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6">
                            <div><h4 style="text-transform: uppercase;">PELAYANAN DARAH RS</h4></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel-title pull-right">
                                <form class="form-inline"  method="POST" action="pmitatausaha.php?module=lap_pelayanan">
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center"><h4>LAPORAN PELAYANAN DARAH DI RUMAH SAKIT</h4></div>
                            <div class="text-center"><h4><?php echo $qlap['u_nama'];?></h4></div>
                            <div class="text-center"><h4 style="text-transform: uppercase;"> <?php echo 'TAHUN '.$v_tahun;?></h4></div>
                        </div>
                        <div class="col-lg-12">
                            <h4>C.PELAYANAN DARAH DI RUMAH SAKIT</h4>
                            <table class="table table-hover table-bordered">
                                <thead class="pmi">
                                <tr>
                                    <th class="text-center" nowrap>No</th>
                                    <th class="text-center" nowrap>Urian</th>
                                    <th class="text-center" nowrap>Ya/Tidak</th>
                                    <th class="text-center" nowrap>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-left" nowrap>Komite/Panitia Transfusi Darah</td>
                                    <td class="text-center">
                                        <?php if($qlap['u_komite_mdk']=='1'){echo 'Ya';}else{echo 'Tidak';} ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="text-left" nowrap>Distribusi darah dengan sistem tertutup (tidak melibatkan keluarga pasien)</td>
                                    <td nowrap class="text-center"><?php if ($qlap['u_distr_terbuka']=='1'){echo 'Ya';}else{echo 'Tidak';}?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td nowrap>Distribusi darah dengan mekanisme rantai dingin</td>
                                    <td nowrap class="text-center"><?php if ($qlap['u_distr_cold_chain']=='1'){echo 'Ya';}else{echo 'Tidak';}?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td nowrap>Dokter yang terlatih pelaksanaan transfusi darah</td>
                                    <td nowrap class="text-center"><?php if ($qlap['u_jml_dokter_kompeten']>1){echo 'Ya';}else{echo 'Tidak';}?></td>
                                    <td class="text-center"><?php echo $qlap['u_jml_dokter_kompeten'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td nowrap>Petugas yang terlatih pelaksanaan transfusi darah</td>
                                    <td nowrap class="text-center"><?php if ($qlap['u_ptgs_komptn']>1){echo 'Ya';}else{echo 'Tidak';}?></td>
                                    <td class="text-center"><?php echo $qlap['u_ptgs_komptn'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td nowrap>Informed consent untuk pelaksanaan transfusi darah</td>
                                    <td nowrap class="text-center"><?php if ($qlap['u_inform_c']=='1'){echo 'Ya';}else{echo 'Tidak';}?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td nowrap>Lembar monitor transfusi darah</td>
                                    <td nowrap class="text-center"><?php if ($qlap['u_lbr_mon_td']=='1'){echo 'Ya';}else{echo 'Tidak';}?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">8</td>
                                    <td nowrap>Jumlah pasien yang ditransfusi </td>
                                    <td></td>
                                    <td class="text-center"><?php echo $qlap['u_jml_pasien_td'];?></td>
                                </tr>
                                <tr>
                                    <?php
                                    $q_reaksi="SELECT sum(`rtd_jml`) as `jml` FROM `rpt_data_reaksi_td`
                                               WHERE `rtd_id_udd`='$id_udd' AND `rtd_tahun`='$tahun'";
                                    $q_jml=mysql_fetch_assoc(mysql_query($q_reaksi));
                                    if ($qlap['u_jml_pasien_rtd']>0){
                                        $total=$qlap['u_jml_pasien_rtd'];
                                    } else {
                                        $total=$q_jml['jml'];
                                    }
                                    ?>
                                    <td class="text-center">9</td>
                                    <td nowrap>Jumlah pasien yang mengalami reaksi transfusi</td>
                                    <td></td>
                                    <td class="text-center"><?php echo $total; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">10</td>
                                    <td>Jenis Reaksi Transfusi:</td>
                                    <td></td><td></td>
                                </tr>
                                <?php
                                $q_reaksi="SELECT `rtd_id`, `rtd_tahun`, `rtd_id_udd`, `rtd_jenis_rtd`, `rtd_jml` FROM `rpt_data_reaksi_td`
                                               WHERE
                                               `rtd_id_udd`='$id_udd' AND `rtd_tahun`='$v_tahun'";
                                $q_reaksi=mysql_query($q_reaksi);
                                $no=0;
                                while ($row=mysql_fetch_array($q_reaksi)){
                                    $no++;
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>&nbsp;&nbsp<?php echo $no.'. '.$row['rtd_jenis_rtd'];?></td>
                                        <td></td>
                                        <td class="text-center"><?php echo $row['rtd_jml'];?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <div class="panel-footer">
                    <a href="pmitatausaha.php?module=upload&mdl=pelayanan&t=<?php echo $v_tahun;?>" class="btn btn-default" id="shadow2" title="Upload Laporan ke UDD Pusat"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload ke Pusat</a>
                    <a href="pmitatausaha.php?module=rpt_pelayanan&thn=<?php echo $v_tahun;?>" class="btn btn-default" id="shadow2"><i class="fa fa-print" aria-hidden="true" title="Cetak Laporan"></i>&nbsp;&nbsp;Cetak Laporan</a>
                    <a href="pmitatausaha.php?module=laporan" class="btn btn-default" id="shadow2"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                </div>
            </div>
        </div>
    </div>
 </div>
</body>
</html>