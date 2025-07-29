<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem InforMasi DONor DARah</title>
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
require_once('config/db_connect.php');
session_start();

if(isset($_POST['submit'])){
    $v_mode=$_POST['mode'];
    $v_id_bangunan= $_POST['id_bangunan'];
    $v_tahun    = $_POST['tahun_lap'];
    $v_id_udd   = $_POST['id_udd'];
    $v_kepemilikan= $_POST['kepemilikan'];
    $v_klasrs   = $_POST['kelas_rs'];
    $v_klas_utd = $_POST['kelas_utd'];
    $v_tingkat_utd=$_POST['tingkat_utd'];
    $v_dana_bgn = $_POST['asal_dana_bangunan'];
    $v_dana_alat    = $_POST['asal_dana_alat'];
    $v_thn_opr=$_POST['tahun_opr'];
    $v_ada_bantuan=$_POST['ada_bantuan'];
    $v_jml_bantuan=$_POST['jml_bantuan'];
    $v_bppd = $_POST['bppd'];
    $v_sk_bppd=$_POST['sk_bppd'];
    $v_no_bgn=$_POST['no_bangunan'];
    $q_update="UPDATE `rpt_data_bangunan`
               SET
               `b_tahun`='$v_tahun',
               `b_id_udd`='$v_id_udd',
               `b_kpemilikan`='$v_kepemilikan',
               `b_klasrs`='$v_klasrs',
               `b_klas_udd`='$v_klas_utd',
               `b_tingkat_udd`='$v_tingkat_utd',
               `b_dana_bngunan`='$v_dana_bgn',
               `b_dana_alat`='$v_dana_alat',
               `b_th_operasional`='$v_thn_opr',
               `b_dana_apbd`='$v_ada_bantuan',
               `b_jml_dana_apbd`='$v_jml_bantuan',
               `b_bppd`='$v_bppd',
               `b_sk_bppd`='$v_sk_bppd',
               `b_no_bgn`='$v_no_bgn'
               WHERE
               `b_id`='$v_id_bangunan'";
    $q_insert ="INSERT INTO `rpt_data_bangunan`
                (`b_tahun`, `b_id_udd`, `b_kpemilikan`, `b_klasrs`, `b_klas_udd`, `b_tingkat_udd`, `b_dana_bngunan`,
                 `b_dana_alat`, `b_th_operasional`, `b_dana_apbd`, `b_jml_dana_apbd`, `b_bppd`, `b_sk_bppd`,`b_no_bgn`)
                VALUES
                ('$v_tahun','$v_id_udd','$v_kepemilikan','$v_klasrs','$v_klas_utd','$v_tingkat_utd','$v_dana_bgn',
                '$v_dana_alat','$v_thn_opr','$v_ada_bantuan','$v_jml_bantuan','$v_bppd','$v_sk_bppd','$v_no_bgn')";
    if ($v_mode=='1'){
        //echo "$q_insert";
        $add_data=mysql_query($q_insert);
        if ($add_data){echo "Penambahan data bangunan berhasil";}else{echo "Penambahan data bangunan - Tidak berhasil";}
    }else{
        //echo "$q_update";
        $upd_data=mysql_query($q_update);
        if ($upd_data){echo "Update data bangunan berhasil";}else{echo "Update data bangunan - Tidak berhasil";}
    }
    ?><META http-equiv="refresh" content="1;URL=pmitatausaha.php?module=databangunan"><?php
} else {
    $tahun=date('Y');
    $mode=$_GET['m'];
    $id=$_GET['x'];
    if ($mode=='1'){
        $title="TAMBAH DATA BANGUNAN";
    }else{
        $title="EDIT DATA BANGUNAN";
        $q_dt0="SELECT `b_id`, `b_tahun`, `b_id_udd`, `b_kpemilikan`, `b_klasrs`, `b_klas_udd`, `b_tingkat_udd`, `b_dana_bngunan`,
                `b_dana_alat`, `b_th_operasional`, `b_dana_apbd`, `b_jml_dana_apbd`, `b_bppd`, `b_sk_bppd`, `b_no_bgn`
                FROM `rpt_data_bangunan` WHERE `b_id`='$id'";
        $q_dt=mysql_fetch_assoc(mysql_query($q_dt0));
    }
    $udd="select * from utd where aktif='1'";
    $udd=mysql_fetch_assoc(mysql_query($udd));

?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <br>
                <form class="form-horizontal" method="post" action="pmitatausaha.php?module=tambahbangunan">
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4><?php echo $title; ?></h4>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="id_bangunan" value="<?php echo $q_dt['b_id'];?>">
                            <input type="hidden" name="id_udd" value="<?php echo $udd['id'];?>">
                            <input type="hidden" name="tahun_lap" value="<?php echo $tahun;?>">
                            <input type="hidden" name="mode" value="<?php echo $mode;?>">
                            <table class="table table-responsive table-hover">
                                <tr>
                                    <td class="default">Nomor Bangunan</td>
                                    <td>
                                        <?php
                                        $sel1="";$sel2="";$sel3="";$sel4="";$sel5="";$sel5="";$sel7="";$sel8="";
                                        switch ($q_dt['b_no_bgn']){
                                            case "1";$sel1="selected";break;
                                            case "2";$sel2="selected";break;
                                            case "3";$sel1="selected";break;
                                            case "4";$sel2="selected";break;
                                            case "5";$sel1="selected";break;
                                            case "6";$sel2="selected";break;
                                            case "7";$sel1="selected";break;
                                            case "8";$sel2="selected";break;
                                        }
                                        ?>
                                        <select class="form-control" name="no_bangunan">
                                            <option value="1" <?php echo $sel1;?>>1</option>
                                            <option value="2" <?php echo $sel2;?>>2</option>
                                            <option value="3" <?php echo $sel3;?>>3</option>
                                            <option value="4" <?php echo $sel4;?>>4</option>
                                            <option value="5" <?php echo $sel5;?>>5</option>
                                            <option value="6" <?php echo $sel6;?>>6</option>
                                            <option value="7" <?php echo $sel7;?>>7</option>
                                            <option value="8" <?php echo $sel8;?>>8</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="default">Kepemilikan</td>
                                    <td>
                                        <?php
                                            $sel1="";$sel2="";
                                            switch ($q_dt['b_kpemilikan']){
                                                case "0";$sel1="selected";break;
                                                case "1";$sel2="selected";break;

                                            }
                                        ?>
                                        <select class="form-control" name="kepemilikan">
                                            <option value="0" <?php echo $sel1;?>>PMI</option>
                                            <option value="1" <?php echo $sel2;?>>Pemerintah</option>
                                        </select>
                                    </td>
                                    <td class="default">Kelas Rumah Sakit</td>
                                    <td>
                                        <?php
                                        switch ($q_dt['b_klasrs']){
                                            case "Tipe A";$sel1="selected";break;
                                            case "Tipe B";$sel2="selected";break;
                                            case "Tipe C";$sel3="selected";break;
                                            case "Tipe D";$sel4="selected";break;
                                            case "Tipe E";$sel5="selected";break;
                                        }
                                        ?>
                                        <select class="form-control" name="kelas_rs">
                                            <option value="Tipe A" <?php echo $sel1;?>>Tipe A</option>
                                            <option value="Tipe B" <?php echo $sel2;?>>Tipe B</option>
                                            <option value="Tipe C" <?php echo $sel3;?>>Tipe C</option>
                                            <option value="Tipe D" <?php echo $sel4;?>>Tipe D</option>
                                            <option value="Type E" <?php echo $sel5;?>>Tipe E</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="default">Kelas UTD</td>
                                    <td>
                                        <?php
                                        switch ($q_dt['b_klas_udd']){
                                            case "Utama";$sel1="selected";break;
                                            case "Madya";$sel2="selected";break;
                                            case "Pratama";$sel3="selected";break;                                        }
                                        ?>
                                        <select class="form-control" name="kelas_utd">
                                            <option value="Utama" <?php echo $sel1;?>>Utama</option>
                                            <option value="Madya" <?php echo $sel2;?>>Madya</option>
                                            <option value="Pratama" <?php echo $sel3;?>>Pratama</option>
                                        </select>
                                    </td>
                                    <td class="default">Tingkatan UTD</td>
                                    <td>
                                        <?php
                                            switch ($q_dt['b_tingkat_udd']){
                                            case "Nasional";$sel1="selected";break;
                                            case "Provinsi";$sel2="selected";break;
                                            case "Kabupaten";$sel3="selected";break;                                        }
                                        ?>
                                        <select class="form-control" name="tingkat_utd">
                                            <option value="Nasional" <?php echo $sel1;?>>Nasional</option>
                                            <option value="Provinsi" <?php echo $sel2;?>>Provinsi</option>
                                            <option value="Kabupaten" <?php echo $sel3;?>>Kabupaten/Kota</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="default">Asal dana bangunan</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="asal_dana_bangunan" name="asal_dana_bangunan" required value="<?php echo $q_dt['b_dana_bngunan'];?>"></td>
                                    <td class="default">Asal dana peralatan</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="asal_dana_alat" name="asal_dana_alat" required value="<?php echo $q_dt['b_dana_alat'];?>"></td>
                                </tr>
                                <tr>
                                    <td class="default">Operasional sejak tahun</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="tahun_opr" name="tahun_opr" required value="<?php echo $q_dt['b_th_operasional'];?>"></td>
                                    <th></th><td></td>
                                </tr>
                                <tr>
                                    <td class="default">Ada Bantuan</td>
                                    <td>
                                        <?php
                                        switch ($q_dt['b_dana_apbd']){
                                            case "1";$sel1="selected";break;
                                            case "0";$sel2="selected";break;
                                        }
                                        ?>
                                        <select class="form-control" name="ada_bantuan">
                                            <option value="1" <?php echo $sel1;?>>Ada</option>
                                            <option value="0" <?php echo $sel2;?>>Tidak</option>
                                        </select>
                                    </td>
                                    <td class="default">Jumlah Bantuan</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="jml_bantuan" name="jml_bantuan" required value="<?php echo $q_dt['b_jml_dana_apbd'];?>"></td></tr>
                                <tr>
                                    <td class="default">Besaran BPPD</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="bppd" name="bppd" required value="<?php echo $q_dt['b_bppd'];?>"></td>
                                    <td class="default">Dasar Hukum BPPD</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="sk_bppd" name="sk_bppd" required value="<?php echo $q_dt['b_sk_bppd'];?>"></td></tr>

                            </table>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="submit" class="btn btn-default" id="shadow2"> <i class="fa fa-save" aria-hidden="true">&nbsp;Simpan</i></button>
                            <a href="pmitatausaha.php?module=databangunan" class="btn btn-default" id="shadow2"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Batal</a>
                        </div>
                       </form>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>