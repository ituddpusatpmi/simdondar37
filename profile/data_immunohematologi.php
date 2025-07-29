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
                `u_periksa_kgd` ='$_POST[chk_kgd]',
                `u_kgd_auto` = '$_POST[kgd_auto]',
                `u_kgd_semi` ='$_POST[kgd_semi]',
                `u_kgd_manual` ='$_POST[kgd_conv]',
                `u_periksa_abs` = '$_POST[chk_abs]',
                `u_abs_auto` ='$_POST[abs_auto]',
                `u_abs_semi` ='$_POST[abs_semi]',
                `u_abs_manual` ='$_POST[abs_conv]',
                `u_periksa_iab` = '$_POST[chk_iab]',
                `u_iab_auto` ='$_POST[iab_auto]',
                `u_iab_semi` ='$_POST[iab_semi]',
                `u_iab_manual` ='$_POST[iab_conv]',
                `u_periksa_cross` = '$_POST[chk_crs]',
                `u_cross_auto` ='$_POST[crs_auto]',
                `u_cross_semi` ='$_POST[crs_semi]',
                `u_cross_manual` ='$_POST[crs_conv]'
                WHERE
                `u_id`='$_POST[id_edit]'";
        //echo "<br>$q_umm";
        $q_umm=mysql_query($q_umm);
        if ($q_umm){echo "Update Sukses<br>";}else{echo "Update Error<br>";}
    }else {
        echo "<br>Tambah Data.";
        $q_umm  ="INSERT INTO `rpt_data_umum`(`u_tahun`, `u_id_udd`,
                  `u_periksa_kgd`, `u_kgd_auto`, `u_kgd_semi`, `u_kgd_manual`,
                  `u_periksa_abs`, `u_abs_auto`, `u_abs_semi`, `u_abs_manual`,
                  `u_periksa_iab`, `u_iab_auto`, `u_iab_semi`, `u_iab_manual`,
                  `u_periksa_cross`, `u_cross_auto`, `u_cross_semi`, `u_cross_manual`)
                  VALUES ('$tahun', '$_POST[id_udd]',
                  '$_POST[chk_kgd]','$_POST[kgd_auto]','$_POST[kgd_semi]','$_POST[kgd_conv]',
                  '$_POST[chk_abs]','$_POST[abs_auto]','$_POST[abs_semi]','$_POST[abs_conv]',
                  '$_POST[chk_iab]','$_POST[iab_auto]','$_POST[iab_semi]','$_POST[iab_conv]',
                  '$_POST[chk_crs]','$_POST[crs_auto]','$_POST[crs_semi]','$_POST[crs_conv]')";
        //echo "<br>$q_umm";
        $q_umm=mysql_query($q_umm);
        if ($q_umm){echo "Insert Sukses<br>";}else{echo "Error Insert<br>";}
    }
    ?><META http-equiv="refresh" content="1;URL=pmitatausaha.php?module=dataimmunohematologi"><?php
} else {
    $tahun=date('Y');
    $udd="select * from utd where aktif='1'";
    $udd=mysql_fetch_assoc(mysql_query($udd));
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
            <div class="col-lg-12">
                <br>
                <form class="form-horizontal" method="post" action="pmitatausaha.php?module=dataimmunohematologi">
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4>IMUNOHEMATOLOGI </h4>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" value="<?php echo $ada_data;?>" name="ada_data">
                            <input type="hidden" value="<?php echo $id_udd;?>" name="id_udd">
                            <input type="hidden" value="<?php echo $qlap['u_id'];?>" name="id_edit">
                            <table class="table table-hover table-bordered">
                                <thead class="pmi">
                                <tr>
                                    <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
                                    <th class="text-center" rowspan="2" style="vertical-align: middle;">Jenis Pemeriksaan</th>
                                    <th class="text-center" rowspan="2" style="vertical-align: middle;">Dilakukan/<br>Tidak</th>
                                    <th class="text-center" colspan="3" style="vertical-align: middle;">Metode dan Nama Alat yang digunakan</th>
                                </tr>
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;">Fully Automatic</th>
                                    <th class="text-center" style="vertical-align: middle;">Semi Automatic/Gell Test</th>
                                    <th class="text-center" style="vertical-align: middle;">Convensional/Tabung</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td><td>Konfirmasi Golongan Darah</td>
                                    <?php if ($qlap['u_periksa_kgd']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_kgd" value="1"></td>
                                    <td><input class="form-control input-sm" type="text" name="kgd_auto" value="<?php echo $qlap['u_kgd_auto']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="kgd_semi" value="<?php echo $qlap['u_kgd_semi']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="kgd_conv" value="<?php echo $qlap['u_kgd_manual']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>2</td><td>Skrining Antibodi</td>
                                    <?php if ($qlap['u_periksa_abs']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_abs" value="1"></td>
                                    <td><input class="form-control input-sm" type="text" name="abs_auto" value="<?php echo $qlap['u_abs_auto']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="abs_semi" value="<?php echo $qlap['u_abs_semi']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="abs_conv" value="<?php echo $qlap['u_abs_manual']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>3</td><td>Identifikasi Antibodi</td>
                                    <?php if ($qlap['u_periksa_iab']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?>name="chk_iab" value="1"></td>
                                    <td><input class="form-control input-sm" type="text" name="iab_auto" value="<?php echo $qlap['u_iab_auto']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="iab_semi" value="<?php echo $qlap['u_iab_semi']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="iab_conv" value="<?php echo $qlap['u_iab_manual']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>4</td><td>Uji Silang Serasi</td>
                                    <?php if ($qlap['u_periksa_cross']=='1'){$chek='checked';}else{$chek='';}?>
                                    <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_crs" value="1"></td>
                                    <td><input class="form-control input-sm" type="text" name="crs_auto" value="<?php echo $qlap['u_cross_auto']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="crs_semi" value="<?php echo $qlap['u_cross_semi']; ?>"></td>
                                    <td><input class="form-control input-sm" type="text" name="crs_conv" value="<?php echo $qlap['u_cross_manual']; ?>"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="submit" class="btn btn-default" id="shadow2"><i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Simpan Data</button>
                            <a href="pmitatausaha.php?module=upload&mdl=umum&t=<?php echo $tahun;?>" class="btn btn-default" id="shadow2" title="Upload Laporan ke UDD Pusat"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload ke Pusat</a>
                            <a href="pmitatausaha.php?module=profile" class="btn btn-default" id="shadow2"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>
