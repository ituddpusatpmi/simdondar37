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
    $v_mode     = $_POST['mode'];
    $v_id_sdm   = $_POST['id_sdm'];
    $v_tahun    = $_POST['tahun_lap'];
    $v_bulan    = $_POST['bulan_lap'];
    $v_id_udd   = $_POST['id_udd'];
    $v_nama     = $_POST['nama'];
    $v_jabatan  = $_POST['jenis_jabatan'];
    $v_jenis_tenaga = $_POST['jenis_tenaga'];
    $v_jenis_pendidikan=$_POST['jenis_pendidikan'];
    $v_dpt_pelatihan=$_POST['pelatihan'];
    $v_pelatihan    = $_POST['data_pelatihan'];
    $v_tingkat_pendidikan = $_POST['tingkat_pendidikan'];
    $v_no_urut      = $_POST['no_absen'];
    $v_s2='0';$v_s1='0';$v_d3='0';$v_d1='0';$v_sma='0';
    switch ($v_tingkat_pendidikan){
        case '0':$v_s2='1';break;
        case '1':$v_s1='1';break;
        case '2':$v_d3='1';break;
        case '3':$v_d1='1';break;
        case '4':$v_sma='1';break;
    }
    $v_status   = $_POST['status'];
    $v_pns='0';$v_pmi='0';$v_honor='0';
    switch ($v_status){
        case '0' : $v_pns='1';break;
        case '1' : $v_pmi='1';break;
        case '3' : $v_honor='1';break;
    }

    $q_update="UPDATE `rpt_data_sdm`
                SET
                `sdm_tahun`='$v_tahun',
                `sdm_id_udd`='$v_id_udd',
                `sdm_urutan`='$v_no_urut',
                `sdm_nama`='$v_nama',
                `sdm_jbtn`='$v_jabatan',
                `sdm_jenis_tng`='$v_jenis_tenaga',
                `sdm_pendidikan`='$v_jenis_pendidikan',
                `sdm_s2`='$v_s2',
                `sdm_s1`='$v_s1',
                `sdm_d3`='$v_d3',
                `sdm_d1`='$v_d1',
                `sdm_sma`='$v_sma',
                `sdm_pns`='$v_pns',
                `sdm_pmi`='$v_pmi',
                `sdm_honor`='$v_honor',
                `sdm_dpt_plthn`='$v_dpt_pelatihan',
                `sdm_plthn`='$v_pelatihan'
                WHERE
                `sdm_id`='$v_id_sdm'";
    $q_insert ="INSERT INTO `rpt_data_sdm`
                (`sdm_tahun`, `sdm_id_udd`, `sdm_urutan`, `sdm_nama`, `sdm_jbtn`, `sdm_jenis_tng`,
                `sdm_pendidikan`, `sdm_s2`, `sdm_s1`, `sdm_d3`, `sdm_d1`, `sdm_sma`, `sdm_pns`, `sdm_pmi`, `sdm_honor`,
                 `sdm_dpt_plthn`, `sdm_plthn`)
                VALUES
                ('$v_tahun','$v_id_udd','$v_no_urut','$v_nama','$v_jabatan','$v_jenis_tenaga',
                  '$v_jenis_pendidikan','$v_s2','$v_s1','$v_d3','$v_d1','$v_sma','$v_pns','$v_pmi','$v_honor',
                  '$v_dpt_pelatihan','$v_pelatihan')";
    if ($v_mode=='1'){
        //echo "$q_insert";
        $add_data=mysql_query($q_insert);
        if ($add_data){echo "Penambahan data personalias berhasil";}else{echo "Penambahan data personalia - Tidak berhasil";}
    }else{
        //echo "$q_update";
        $upd_data=mysql_query($q_update);
        if ($upd_data){echo "Update data personalias berhasil";}else{echo "Update data personalias - Tidak berhasil";}
    }
    ?><META http-equiv="refresh" content="1;URL=pmitatausaha.php?module=personalia"><?php
} else {
    $tahun=date('Y');
    $mode=$_GET['m'];
    $bulan=date('m');
    $id=$_GET['x'];
    if ($mode=='1'){
        $title="TAMBAH DATA PERSONALIA";
    }else{
        $title="EDIT DATA PERSONALIA";
        $q_dt0="SELECT `sdm_id`, `sdm_tahun`, `sdm_id_udd`, `sdm_urutan`,
                `sdm_nama`, `sdm_jbtn`, `sdm_jenis_tng`, `sdm_pendidikan`,
                `sdm_s2`, `sdm_s1`, `sdm_d3`, `sdm_d1`, `sdm_sma`, `sdm_pns`,
                `sdm_pmi`, `sdm_honor`, `sdm_dpt_plthn`, `sdm_plthn`, `sdm_aktif`
                FROM `rpt_data_sdm` WHERE `sdm_id`='$id'";
        $q_dt=mysql_fetch_assoc(mysql_query($q_dt0));
    }
    $udd="select * from utd where aktif='1'";
    $udd=mysql_fetch_assoc(mysql_query($udd));

?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <form class="form" method="post" action="pmitatausaha.php?module=tambahpersonalia">
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4><?php echo $title; ?></h4>
                        </div>
                        <div class="panel-body">
                        <div class="row">
                            <input type="hidden" name="id_sdm" value="<?php echo $q_dt['sdm_id'];?>">
                            <input type="hidden" name="id_udd" value="<?php echo $udd['id'];?>">
                            <input type="hidden" name="tahun_lap" value="<?php echo $tahun;?>">
                            <input type="hidden" name="bulan_lap" value="<?php echo $bulan;?>">
                            <input type="hidden" name="mode" value="<?php echo $mode;?>">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="no_absen">No Urut</label>
                                    <input type="text" class="form-control" id="no_absen" name="no_absen" required value="<?php echo $q_dt['sdm_urutan'];?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $q_dt['sdm_nama'];?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="jenis_jabatan">Jenis Jabatan</label>
                                    <?php
                                    $sel1="";$sel2="";$sel3="";$sel4="";$sel5="";$sel6="";$sel7="";$sel8="";$sel9='';
                                    switch ($q_dt['sdm_jbtn']){
                                        case 'Kepala UTD' : $sel1="selected";break;
                                        case 'Kepala Bidang' : $sel2="selected";break;
                                        case 'Kepala Bagian' : $sel3="selected";break;
                                        case 'Manager Kualitas' : $sel4="selected";break;
                                        case 'Kepala Sub Bidang' : $sel5="selected";break;
                                        case 'Kepala Seksi' : $sel6="selected";break;
                                        case 'Kepala Urusan' : $sel7="selected";break;
                                        case 'Koordinator' : $sel8="selected";break;
                                        case 'Staf' : $sel9="selected";break;
                                    }
                                    ?>
                                        <select class="form-control" name="jenis_jabatan">
                                            <option value="Kepala UTD" <?php echo $sel1;?>>Kepala UTD</option>
                                            <option value="Kepala Bidang" <?php echo $sel2;?>>Kepala Bidang</option>
                                            <option value="Kepala Bagian" <?php echo $sel3;?>>Kepala Bagian</option>
                                            <option value="Manager Kualitas" <?php echo $sel4;?>>Manager Kualitas</option>
                                            <option value="Kepala Sub Bidang" <?php echo $sel5;?>>Kepala Sub Bidang</option>
                                            <option value="Kepala Seksi" <?php echo $sel6;?>>Kepala Seksi</option>
                                            <option value="Kepala Urusan" <?php echo $sel7;?>>Kepala Urusan</option>
                                            <option value="Koordinator" <?php echo $sel8;?>>Koordinator</option>
                                            <option value="Staf" <?php echo $sel9;?>>Staf</option>
                                        </select>

                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="jenis_tenaga">Jenis Tenaga</label>
                                    <?php
                                    $sel1="";$sel2="";$sel3="";$sel4="";$sel5="";$sel6="";$sel7="";$sel8="";
                                    switch ($q_dt['sdm_jenis_tng']){
                                        case 'Kepala UTD' : $sel1="selected";break;
                                        case 'Staf Medis' : $sel2="selected";break;
                                        case 'Pelaksana Teknis' : $sel3="selected";break;
                                        case 'Pelaksana Keuangan/Administrasi' : $sel4="selected";break;
                                        case 'Tenaga Penunjang' : $sel5="selected";break;
                                    }
                                    ?>

                                        <select class="form-control" name="jenis_tenaga">
                                            <option value="Kepala UTD" <?php echo $sel1;?>>Kepala UTD</option>
                                            <option value="Staf Medis" <?php echo $sel2;?>>Staf Medis</option>
                                            <option value="Pelaksana Teknis" <?php echo $sel3;?>>Pelaksana Teknis</option>
                                            <option value="Pelaksana Keuangan/Administrasi" <?php echo $sel4;?>>Pelaksana Keuangan/Administrasi</option>
                                            <option value="Tenaga Penunjang" <?php echo $sel5;?>>Tenaga Penunjang</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_pendidikan">Jenis Pendidikan</label>
                                    <input type="text" class="form-control" name="jenis_pendidikan" required value="<?php echo $q_dt['sdm_pendidikan'];?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="tingkat_pendidikan">Tingkat Pendidikan</label>
                                    <?php
                                    $sel1="";$sel2="";$sel3="";$sel4="";$sel5="";$sel6="";$sel7="";$sel8="";
                                    if ($q_dt['sdm_s2']=='1'){$sel1='selected';}
                                    if ($q_dt['sdm_s1']=='1'){$sel2='selected';}
                                    if ($q_dt['sdm_d3']=='1'){$sel3='selected';}
                                    if ($q_dt['sdm_d1']=='1'){$sel4='selected';}
                                    if ($q_dt['sdm_sma']=='1'){$sel5='selected';}
                                    ?>
                                    <select class="form-control" name="tingkat_pendidikan">
                                        <option value="0" <?php echo $sel1;?>>S2/Magister</option>
                                        <option value="1" <?php echo $sel2;?>>S1</option>
                                        <option value="2" <?php echo $sel3;?>>D3</option>
                                        <option value="3" <?php echo $sel4;?>>D1</option>
                                        <option value="4" <?php echo $sel5;?>>SMA/Sederajat atau dibawahnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label class="control-label" for="status">Status Kepegawaian</label>
                                    <?php
                                    $sel1="";$sel2="";$sel3="";$sel4="";$sel5="";$sel6="";$sel7="";$sel8="";
                                    if ($q_dt['sdm_pns']=='1'){$sel1='selected';}
                                    if ($q_dt['sdm_pmi']=='1'){$sel2='selected';}
                                    if ($q_dt['sdm_honor']=='1'){$sel3='selected';}

                                    ?>
                                    <select class="form-control" name="status">
                                        <option value="0" <?php echo $sel1;?>>PNS</option>
                                        <option value="1" <?php echo $sel2;?>>PMI</option>
                                        <option value="2" <?php echo $sel3;?>>Honor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="pelatihan">Sudah mendapat pelatihan</label>
                                    <?php
                                    $sel1="";$sel2="";$sel3="";$sel4="";$sel5="";$sel6="";$sel7="";$sel8="";
                                    if ($q_dt['sdm_dpt_plthn']=='1'){$sel2='selected';}else{$sel1='selected';}
                                    ?>
                                    <select class="form-control" name="pelatihan">
                                        <option value="0" <?php echo $sel1;?>>Tidak</option>
                                        <option value="1" <?php echo $sel2;?>>Ya</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="data_pelatihan">Pelatihan yang diikuti</label>
                                    <textarea class="form-control" rows="4" name="data_pelatihan"><?php echo $q_dt['sdm_plthn'];?></textarea>
                                </div>
                            </div>
                        </div>

                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="submit" class="btn btn-default" id="shadow2"> <i class="fa fa-save" aria-hidden="true">&nbsp;Simpan</i></button>
                            <a href="pmitatausaha.php?module=personalia" class="btn btn-default" id="shadow2"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Batal</a>
                        </div>
                       </form>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>