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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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
    echo "$tahun<br>";

    echo "<b> $name </b>";
    if ($ada_data=='1'){
        echo "<br>Update Data.";
        $q_umm="UPDATE `rpt_data_umum` SET
                `u_tahun` = '$tahun',
                `u_id_udd` = '$_POST[id_udd]',
                `u_nama` =  '$_POST[udd]',
                `u_alamat` = '$_POST[alamat]',
                `u_kab`	= '$_POST[kab]',
                `u_prov` = '$_POST[prop]',
                `u_kpos` = '$_POST[kpos]',
                `u_telp` ='$_POST[telp]',
                `u_email` ='$_POST[email]',
                 `u_ka_nama` = '$_POST[ka_utd]',
                `u_ka_hp` = '$_POST[ka_telp]',
                `u_ka_email` = '$_POST[ka_email]',
                `u_komite_mdk` =  '$_POST[chk_komite]',
                `u_distr_terbuka` = '$_POST[chk_terbuka]',
                `u_distr_cold_chain` = '$_POST[chk_dingin]',
                `u_jml_dokter_kompeten` = '$_POST[jml_dokter]',
                `u_ptgs_komptn` = '$_POST[jml_pttd]',
                `u_inform_c` = '$_POST[chk_ic]',
                `u_lbr_mon_td` = '$_POST[chk_monitor_td]',
                `u_jml_pasien_td` = '$_POST[jml_pasien]',
                `u_jml_pasien_rtd` ='$_POST[jml_rtd]',
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
        echo "<br>$q_umm";
        $q_umm=mysql_query($q_umm);
        if ($q_umm){echo "Update Sukses<br>";}else{echo "Update Error<br>";}
    }else {
        echo "<br>Tambah Data.";
        $q_umm  ="INSERT INTO `rpt_data_umum`(`u_tahun`, `u_id_udd`, `u_nama`, `u_alamat`, `u_kab`, `u_prov`, `u_kpos`, `u_telp`, `u_email`,
                  `u_ka_nama`, `u_ka_hp`, `u_ka_email`,
                  `u_komite_mdk`, `u_distr_terbuka`, `u_distr_cold_chain`, `u_jml_dokter_kompeten`, `u_ptgs_komptn`, `u_inform_c`,
                  `u_lbr_mon_td`, `u_jml_pasien_td`, `u_jml_pasien_rtd`,
                  `u_periksa_kgd`, `u_kgd_auto`, `u_kgd_semi`, `u_kgd_manual`,
                  `u_periksa_abs`, `u_abs_auto`, `u_abs_semi`, `u_abs_manual`,
                  `u_periksa_iab`, `u_iab_auto`, `u_iab_semi`, `u_iab_manual`,
                  `u_periksa_cross`, `u_cross_auto`, `u_cross_semi`, `u_cross_manual`)
                  VALUES ('$tahun', '$_POST[id_udd]','$_POST[udd]','$_POST[alamat]','$_POST[kab]','$_POST[prop]', '$_POST[kpos]','$_POST[telp]','$_POST[email]',
                  '$_POST[ka_utd]', '$_POST[ka_telp]', '$_POST[ka_email]',
                  '$_POST[chk_komite]','$_POST[chk_terbuka]','$_POST[chk_dingin]','$_POST[jml_dokter]','$_POST[jml_pttd]','$_POST[chk_ic]',
                  '$_POST[chk_monitor_td]','$_POST[jml_pasien]','$_POST[jml_rtd]',
                  '$_POST[chk_kgd]','$_POST[kgd_auto]','$_POST[kgd_semi]','$_POST[kgd_conv]',
                  '$_POST[chk_abs]','$_POST[abs_auto]','$_POST[abs_semi]','$_POST[abs_conv]',
                  '$_POST[chk_iab]','$_POST[iab_auto]','$_POST[iab_semi]','$_POST[iab_conv]',
                  '$_POST[chk_crs]','$_POST[crs_auto]','$_POST[crs_semi]','$_POST[crs_conv]'
                  )";
        echo "<br>$q_umm";
        $q_umm=mysql_query($q_umm);
        if ($q_umm){echo "Insert Sukses<br>";}else{echo "Error Insert<br>";}
    }
    ?><META http-equiv="refresh" content="5;URL=pmitatausaha.php?module=dataumum"><?php
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
                <form class="form-horizontal" method="post" action="pmitatausaha.php?module=dataumum">
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#umum"><h5>Data Umum</h5></a></li>
                                <li><a data-toggle="tab" href="#pimpinan"><h5>Pimpinan</h5></a></li>
                                <li><a data-toggle="tab" href="#gedung"><h5>Bangunan</h5></a></li>
                                <li><a data-toggle="tab" href="#layanan"><h5>Pelayanan</h5></a></li>
                                <li><a data-toggle="tab" href="#imunohematologi"><h5>Immunohematologi</h5></a></li>
                                <li><a data-toggle="tab" href="#reaksitransfusi"><h5>Reaksi Transfusi</h5></a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="umum" class="tab-pane fade in active">
                                    <p class="judul col-sm-offset-1">Data Umum</p>
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="udd">UTD/UDD</label>
                                                <div class="col-sm-10">
                                                    <strong><input type="text" class="form-control input-sm panel-custom-red" id="udd" name="udd" required value="<?php echo $nama_udd;?>"></strong>
                                                    <input type="hidden" value="<?php echo $ada_data;?>" name="ada_data">
                                                    <input type="hidden" value="<?php echo $id_udd;?>" name="id_udd">
                                                    <input type="hidden" value="<?php echo $qlap['u_id'];?>" name="id_edit">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="alamat">Alamat</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control input-sm" id="alamat" placeholder="Alamat" name="alamat" required value="<?php echo $alamat_udd; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="kota">Kab/Kota</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm" id="kota" placeholder="kota" name="kab"  value="<?php echo $qlap['u_kab']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="alamat">Provinsi</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control input-sm" id="prop" placeholder="Provinsi" name="prop"  value="<?php echo $qlap['u_prov']; ?>">
                                                </div>
                                            </div>

                                        </div>
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="kodepos">Kd Pos</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control input-sm" id="kpos"  name="kpos"  value="<?php echo $qlap['u_kpos']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="telp">Telp</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control input-sm" id="telp"  name="telp" value="<?php echo $qlap['u_telp']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">Fax</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control input-sm" id="email" placeholder="email@email.com"   name="email" value="<?php echo $qlap['u_email']; ?>">
                                                </div>
                                            </div>

                                    </div>
                                </div>

                                <div id="pimpinan" class="tab-pane fade">
                                    <p class="judul col-sm-offset-2"> Data Pimpinan</p>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="udd">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control input-sm" id="ka_utd" name="ka_utd"  value="<?php echo $qlap['u_ka_nama'];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="ka_telp">Telp/HP</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" id="ka_telp" placeholder="No Telp/HP Ka UTD" name="ka_telp"  value="<?php echo $qlap['u_ka_hp']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="ka_email">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control input-sm" id="ka_email" placeholder="email@email.com"   name="ka_email" value="<?php echo $qlap['u_ka_email']; ?>">
                                            </div>
                                        </div>
                                </div>

                                <div id="gedung" class="tab-pane fade">
                                    <span class="judul">Data Bangunan</span>
                                    <div id="detail_bangunan">
                                        <div style="overflow-x:auto;">
                                            <table class="table table-condensed table-hover table-bordered">
                                                <thead class="pmi">
                                                <tr>
                                                    <th class="text-center" rowspan="2">No</th>
                                                    <th class="text-center" rowspan="2">Kepemilikan</th>
                                                    <th class="text-center" rowspan="2">Kelas RS</th>
                                                    <th class="text-center" rowspan="2">Kelas UTD</th>
                                                    <th class="text-center" rowspan="2">Tingkatan</th>
                                                    <th class="text-center" colspan="2">Asal Dana</th>
                                                    <th class="text-center" rowspan="2">Operasional<br>Sejak<br>Tahun</th>
                                                    <th class="text-center" colspan="2">Bantuan Anggaran</th>
                                                    <th class="text-center" rowspan="2">BPPD</th>
                                                    <th class="text-center" rowspan="2">Dasar Hukum BPPD</th>
                                                    <th class="text-center" rowspan="2"><button type="button" name="tambah" id="tambah" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-default btn-sm">Tambah</button></th>

                                                </tr>
                                                <tr>
                                                    <th class="text-center">Bangunan</th>
                                                    <th class="text-center">Alat</th>
                                                    <th class="text-center">Ya</th>
                                                    <th class="text-center">Jumlah</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $select_query = "SELECT `b_id`, `b_tahun`, `b_id_udd`, `b_kpemilikan`, `b_klasrs`, `b_klas_udd`, `b_tingkat_udd`,
                                                    `b_dana_bngunan`, `b_dana_alat`, `b_th_operasional`, `b_dana_apbd`, `b_jml_dana_apbd`, `b_bppd`,
                                                    `b_sk_bppd` FROM `rpt_data_bangunan` order by `b_id`";
                                                $result = mysql_query($select_query);
                                                $no=0;
                                                while($row = mysql_fetch_array($result)){
                                                    $no++;
                                                    if($row["b_kpemilikan"]=="0"){$milik="PMI";}else{$milik="Pemerintah";}
                                                    echo '<tr>
                                                        <td>' . $no . '</td>
                                                        <td>' . $milik . '</td>
                                                        <td>' . $row["b_klasrs"] . '</td>
                                                        <td>' . $row["b_klas_udd"] . '</td>
                                                        <td>' . $row["b_tingkat_udd"] . '</td>
                                                        <td>' . $row["b_dana_bngunan"] . '</td>
                                                        <td>' . $row["b_dana_alat"] . '</td>
                                                        <td>' . $row["b_th_operasional"] . '</td>
                                                        <td>' . $row["b_dana_apbd"] . '</td>
                                                        <td>' . $row["b_jml_dana_apbd"] . '</td>
                                                        <td>' . $row["b_bppd"] . '</td>
                                                        <td>' . $row["b_sk_bppd"] . '</td>

                                                        <td class="text-right">
                                                            <input type="button" name="view" value="view" id="' . $row["b_id"] . '" class="btn btn-info btn-xs view_data" />
                                                            <a href="profile/profile_act.php?x='.$row["b_id"].'"><span class="fa fa-trash text-danger fa-lg" title="Hapus data Gedung" onclick="return confirm(Anda yakin menghapus data gedung ini?);"></span></a>
                                                    </tr>';
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                       </div>
                                    </div>

                                <div id="layanan" class="tab-pane fade">
                                    <p class="judul">Data Pelayanan</p>
                                    <table class="table table-condensed table-hover table-bordered">
                                        <thead class="pmi">
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Jenis Layanan</th>
                                            <th class="text-center">Ya/Tidak</th>
                                            <th class="text-center">Jumlah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-left">Komite/Panitia Transfusi Darah</td>
                                            <?php if ($qlap['u_komite_mdk']=='1'){$chek='checked';}else{$chek='';}?>
                                            <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_komite" value="1"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-left">Distribusi darah dengan sistem tertutup (tidak melibatkan keluarga pasien)</td>
                                            <?php if ($qlap['u_distr_terbuka']=='1'){$chek='checked';}else{$chek='';}?>
                                            <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_terbuka" value="1"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Distribusi darah dengan mekanisme rantai dingin</td>
                                            <?php if ($qlap['u_distr_cold_chain']=='1'){$chek='checked';}else{$chek='';}?>
                                            <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_dingin" value="1"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Dokter yang terlatih pelaksanaan transfusi darah</td>
                                            <?php if ($qlap['u_jml_dokter_kompeten']>0){$chek='checked';}else{$chek='';}?>
                                            <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_dokter" value="1"></td>
                                            <td><input class="form-control input-sm" type="text" name="jml_dokter" value="<?php echo $qlap['u_jml_dokter_kompeten'] ?>" onkeypress="return isNumberKey(event)"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Petugas yang terlatih pelaksanaan transfusi darah</td>
                                            <?php if ($qlap['u_ptgs_komptn']>0){$chek='checked';}else{$chek='';}?>
                                            <td class="text-center"><input type="checkbox" <?php echo $chek;?>  name="chk_pttd" value="1"></td>
                                            <td><input class="form-control input-sm" type="text" name="jml_pttd" value="<?php echo $qlap['u_ptgs_komptn'] ?>" onkeypress="return isNumberKey(event)"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td>Informed consent untuk pelaksanaan transfusi darah</td>
                                            <?php if ($qlap['u_inform_c']=='1'){$chek='checked';}else{$chek='';}?>
                                            <td class="text-center"><input type="checkbox" <?php echo $chek;?>  name="chk_ic" value="1"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td>Lembar monitor transfusi darah</td>
                                            <?php if ($qlap['u_lbr_mon_td']=='1'){$chek='checked';}else{$chek='';}?>
                                            <td class="text-center"><input type="checkbox" <?php echo $chek;?> name="chk_monitor_td" value="1"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">8</td>
                                            <td>Jumlah pasien yang ditransfusi </td>
                                            <td></td>
                                            <td><input class="form-control input-sm" type="text" name="jml_pasien" value="<?php echo $qlap['u_jml_pasien_td'];?>" onkeypress="return isNumberKey(event)"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">9</td>
                                            <td>Jumlah pasien yang mengalami reaksi transfusi</td>
                                            <td></td>
                                            <td><input class="form-control input-sm" type="text" name="jml_rtd" value="<?php echo $qlap['u_jml_pasien_rtd'];?>" onkeypress="return isNumberKey(event)"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">10</td>
                                            <td>Reaksi transfusi --> pada Tab "Reaksi Transfusi"</td>
                                            <td></td><td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="imunohematologi" class="tab-pane fade">
                                    <p class="judul">Immunohematologi</p>
                                    <table class="table table-condensed table-hover table-bordered">
                                        <thead class="pmi">
                                        <tr>
                                            <th class="text-center" rowspan="2">No</th>
                                            <th class="text-center" rowspan="2">Jenis Pemeriksaan</th>
                                            <th class="text-center" rowspan="2">Dilakukan/<br>Tidak</th>
                                            <th class="text-center" colspan="3">Metode dan Nama Alat yang digunakan</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center" >Fully Automatic</th>
                                            <th class="text-center" >Semi Automatic/Gell Test</th>
                                            <th class="text-center" >Convensional/Tabung</th>
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
                                <div id="reaksitransfusi" class="tab-pane fade">
                                    <p class="judul"> Reaksi Transfusi</p>
                                    <table class="table table-hover table-bordered">
                                        <thead class="pmi">
                                            <tr>
                                                <th>No</th>
                                                <th>Jenis Reaksi</th>
                                                <th>Jumlah</th>
                                                <th>Tambah</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-default" id="shadow2"><i class="fa fa-address-book fa-lg" aria-hidden="true"></i> Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>

<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<!-- Form add data bangunan -->
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pmi">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Tambah Data Bangunan :</h5>
            </div>
            <form method="post" id="insert_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="kepemilikan">Kepemilikan</label>
                                <select class="form-control input-sm" name="kepemilikan" id="kepemilikan">
                                    <option value="0">PMI</option>
                                    <option value="1">Pemerintah</option>
                                </select>
                            </div>
                            <div class="form-group"><label for="klas_rs">Klas RS</label><input type="text" name="klas_rs" id="klas_rs" class="form-control input-sm"></div>
                            <div class="form-group"><label for="klas_utd">Klas UTD</label><input type="text" name="klas_utd" id="klas_utd" class="form-control input-sm"></div>
                            <div class="form-group"><label for="tk_utd">Tingkatan UTD</label><input type="text" name="tk_utd" id="tk_utd" class="form-control input-sm"></div>
                            <div class="form-group"><label for="dana_bgn">Asal Dana Bangunan</label><input type="text" name="dana_bgn" id="dana_bgn" class="form-control input-sm"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="dana_alat">Asal Dana Peralatan</label><input type="text" name="dana_alat" id="dana_alat" class="form-control input-sm"></div>
                            <div class="form-group"><label for="th_operasional">Operasional Sejak Tahun</label><input type="text" name="th_operasional" id="th_operasional" class="form-control input-sm"></div>
                            <div class="form-group"><label for="hibah">Bantuan Anggaran</label><input type="text" name="hibah" id="hibah" class="form-control input-sm"></div>
                            <div class="form-group"><label for="bppd">Besaran BPPD</label><input type="text" name="bppd" id="bppd" class="form-control input-sm"></div>
                            <div class="form-group"><label for="sk_bppd">Dasar Hukum BPPD</label><input type="text" name="sk_bppd" id="sk_bppd" class="form-control input-sm"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add data Bangunan-->

<!-- Edit data Bangunan -->
<div id="dataModal" class="modal fade">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Data Bangunan</h4>
            </div>
            <div class="modal-body" id="bangunan_detail">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#insert_form').on("submit", function(event){
            event.preventDefault();
            if($('#kemepilikan').val() == "")  {alert("Data kepemilikan harus diisi");}
            else if($('#klas_utd').val() == '')  {  alert("Kelas UTD harus diisi");  }
            else if($('#tk_utd').val() == '')  {  alert("Tingkatan UTD harus diisi");  }
            else
            {
                $.ajax({
                    url:"pmitatausaha?module=addgedung",
                    method:"POST",
                    data:$('#insert_form').serialize(),
                    beforeSend:function(){
                        $('#insert').val("Menyimpan");
                    },
                    success:function(data){
                        $('#insert').val("Simpan");
                        $('#insert_form')[0].reset();
                        $('#add_data_Modal').modal('hide');
                        $('#detail_bangunan').html(data);
                    }
                });
            }
        });


        $(document).on('click', '.view_data', function(){
            var gedung_id = $(this).attr("id");
            $.ajax({
                url:"pmitatausaha?module=editgedung",
                method:"POST",
                data:{gedung_id:gedung_id},
                success:function(data){
                    $('#bangunan_detail').html(data);
                    $('#dataModal').modal('show');
                }
            });
        });


    });
</script>