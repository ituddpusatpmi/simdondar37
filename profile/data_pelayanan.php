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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require_once('config/db_connect.php');
session_start();
if(isset($_POST['submit'])){
    $ada_data= $_POST['ada_data'];
    $name = $_POST['udd'];
    $tahun = date("Y");
    if ($ada_data=='1'){
        echo "<br>Update Data.";
        $q_umm="UPDATE `rpt_data_umum` SET
                `u_tahun` = '$tahun',
                `u_id_udd` = '$_POST[id_udd]',
                `u_komite_mdk` =  '$_POST[chk_komite]',
                `u_distr_terbuka` = '$_POST[chk_terbuka]',
                `u_distr_cold_chain` = '$_POST[chk_dingin]',
                `u_jml_dokter_kompeten` = '$_POST[jml_dokter]',
                `u_ptgs_komptn` = '$_POST[jml_pttd]',
                `u_inform_c` = '$_POST[chk_ic]',
                `u_lbr_mon_td` = '$_POST[chk_monitor_td]',
                `u_jml_pasien_td` = '$_POST[jml_pasien]',
                `u_jml_pasien_rtd` ='$_POST[jml_rtd]'
                WHERE
                `u_id`='$_POST[id_edit]'";
        //echo "<br>$q_umm";
        $q_umm=mysql_query($q_umm);
        if ($q_umm){echo "Update Sukses<br>";}else{echo "Update Error<br>";}
    }else {
        echo "<br>Tambah Data.";
        $q_umm  ="INSERT INTO `rpt_data_umum`(`u_tahun`, `u_id_udd`,
                  `u_komite_mdk`, `u_distr_terbuka`, `u_distr_cold_chain`, `u_jml_dokter_kompeten`, `u_ptgs_komptn`, `u_inform_c`,
                  `u_lbr_mon_td`, `u_jml_pasien_td`, `u_jml_pasien_rtd`)
                  VALUES ('$tahun', '$_POST[id_udd]',
                  '$_POST[chk_komite]','$_POST[chk_terbuka]','$_POST[chk_dingin]','$_POST[jml_dokter]','$_POST[jml_pttd]','$_POST[chk_ic]',
                  '$_POST[chk_monitor_td]','$_POST[jml_pasien]','$_POST[jml_rtd]')";
        //echo "<br>$q_umm";
        $q_umm=mysql_query($q_umm);
        if ($q_umm){echo "Insert Sukses<br>";}else{echo "Error Insert<br>";}
    }
    ?><META http-equiv="refresh" content="1;URL=pmitatausaha.php?module=datapelayanan"><?php
} else {
    $tahun=date('Y');
    $udd="select * from utd where aktif='1'";
    $udd=mysql_fetch_assoc(mysql_query($udd));
    $id_udd=$udd['id'];
    $qlap="SELECT * FROM `rpt_data_umum` WHERE `u_id_udd`='$udd[id]' and `u_tahun`='$tahun'";
    $qlap=mysql_fetch_assoc(mysql_query($qlap));
    if($qlap['u_id_udd']==$udd['id']){
        $nama_udd=$qlap['u_nama'];
        $alamat_udd=$qlap['u_alamat'];
        $id_udd = $qlap['u_id_udd'];
        $ada_data='1';
    } else {
        $ada_data='0';
        $nama_udd=$udd['nama'];
        $alamat_udd=$udd['alamat'];
        $id_udd = $udd['id'];
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <br>
                <form class="form-horizontal" method="post" action="pmitatausaha.php?module=datapelayanan">
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4>DATA PELAYANAN</h4>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" value="<?php echo $ada_data;?>" name="ada_data">
                            <input type="hidden" value="<?php echo $id_udd;?>" name="id_udd">
                            <input type="hidden" value="<?php echo $qlap['u_id'];?>" name="id_edit">
                            <table class="table table-hover table-bordered">
                                <thead class="pmi">
                                <tr>
                                    <th class="text-center" nowrap>No</th>
                                    <th class="text-center" nowrap>Jenis Layanan</th>
                                    <th class="text-center" nowrap>Ya/Tidak</th>
                                    <th class="text-center" nowrap>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-left" nowrap>Komite/Panitia Transfusi Darah</td>
                                    <?php if ($qlap['u_komite_mdk']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_komite" value="1"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="text-left" nowrap>Distribusi darah dengan sistem tertutup (tidak melibatkan keluarga pasien)</td>
                                    <?php if ($qlap['u_distr_terbuka']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_terbuka" value="1"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td nowrap>Distribusi darah dengan mekanisme rantai dingin</td>
                                    <?php if ($qlap['u_distr_cold_chain']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_dingin" value="1"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td nowrap>Dokter yang terlatih pelaksanaan transfusi darah</td>
                                    <?php if ($qlap['u_jml_dokter_kompeten']>0){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_dokter" value="1"></td>
                                    <td><input class="form-control input-sm" type="text" name="jml_dokter" value="<?php echo $qlap['u_jml_dokter_kompeten'] ?>" onkeypress="return isNumberKey(event)"></td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td nowrap>Petugas yang terlatih pelaksanaan transfusi darah</td>
                                    <?php if ($qlap['u_ptgs_komptn']>0){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?>  name="chk_pttd" value="1"></td>
                                    <td><input class="form-control input-sm" type="text" name="jml_pttd" value="<?php echo $qlap['u_ptgs_komptn'] ?>" onkeypress="return isNumberKey(event)"></td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td nowrap>Informed consent untuk pelaksanaan transfusi darah</td>
                                    <?php if ($qlap['u_inform_c']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?>  name="chk_ic" value="1"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td nowrap>Lembar monitor transfusi darah</td>
                                    <?php if ($qlap['u_lbr_mon_td']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_monitor_td" value="1"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">8</td>
                                    <td nowrap>Jumlah pasien yang ditransfusi </td>
                                    <td></td>
                                    <td><input class="form-control input-sm" type="text" name="jml_pasien" value="<?php echo $qlap['u_jml_pasien_td'];?>" onkeypress="return isNumberKey(event)"></td>
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
                                    <td><input class="form-control input-sm" type="text" name="jml_rtd" value="<?php echo $total;?>" onkeypress="return isNumberKey(event)" autofocus=""></td>
                                </tr>
                                <tr>

                                    <td class="text-center">10</td>
                                    <td>Reaksi transfusi</td>
                                    <td></td><td><?php echo $q_jml['jml'];?></td>
                                </tr>
                                <?php
                                    $q_reaksi="SELECT `rtd_id`, `rtd_tahun`, `rtd_bulan`, `rtd_id_udd`, `rtd_jenis_rtd`, `rtd_jml` FROM `rpt_data_reaksi_td`
                                               WHERE
                                               `rtd_id_udd`='$id_udd' AND `rtd_tahun`='$tahun'";
                                    $q_reaksi=mysql_query($q_reaksi);
                                    $no=0;
                                    while ($row=mysql_fetch_array($q_reaksi)){
                                        $no++;
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $no.'. '.$row['rtd_jenis_rtd'];?></td>
                                            <td></td>
                                            <td><?php echo $row['rtd_jml'];?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="submit" class="btn btn-default" id="shadow2"><i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Simpan Data</button>
                            <a href="pmitatausaha.php?module=reaksi_transfusi" class="btn btn-default" id="shadow2"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Data Reaksi Transfusi</a>
                            <a href="pmitatausaha.php?module=profile" class="btn btn-default" id="shadow2"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>
