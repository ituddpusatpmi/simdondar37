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
    $v_id_rtd   = $_POST['id_rtd'];
    $v_tahun    = $_POST['tahun'];
    $v_id_udd   = $_POST['id_udd'];
    $v_jenis    = $_POST['jenis'];
    $v_jumlah   = $_POST['jumlah'];
    $q_update="UPDATE `rpt_data_reaksi_td`
               SET
               `rtd_tahun`='$v_tahun',
               `rtd_id_udd`='$v_id_udd',
               `rtd_jenis_rtd`='$v_jenis',
               `rtd_jml`='$v_jumlah'
               WHERE
               `rtd_id`='$v_id_rtd'";
    $q_insert ="INSERT INTO `rpt_data_reaksi_td`
                (`rtd_tahun`,`rtd_id_udd`, `rtd_jenis_rtd`, `rtd_jml`)
                VALUES
                ('$v_tahun','$v_id_udd','$v_jenis','$v_jumlah')";
    if ($v_mode=='1'){
        //echo "$q_insert";
        $add_data=mysql_query($q_insert);
        if ($add_data){echo "Penambahan data reaksi tranfusi berhasil";}else{echo "Penambahan data reaksi transfusi - Tidak berhasil";}
    }else{
        //echo "$q_update";
        $upd_data=mysql_query($q_update);
        if ($upd_data){echo "Update data reaksi transfusi berhasil";}else{echo "Update data reaksi transfusi - Tidak berhasil";}
    }
    ?><META http-equiv="refresh" content="1;URL=pmitatausaha.php?module=reaksi_transfusi"><?php
} else {
    $mode=$_GET['m'];
    $id=$_GET['x'];
    if ($mode=='1'){
        $title="TAMBAH DATA REAKSI TRANSFUSI";
        $tahun=date('Y');
    }else{
        $title="EDIT DATA REAKSI TRANSFUSI";
        $q_dt0="SELECT `rtd_id`, `rtd_tahun`, `rtd_id_udd`, `rtd_jenis_rtd`, `rtd_jml`
                FROM `rpt_data_reaksi_td`
                WHERE `rtd_id`='$id'";
        $q_dt=mysql_fetch_assoc(mysql_query($q_dt0));
        $tahun=$q_dt['rtd_tahun'];
    }
    $udd="select * from utd where aktif='1'";
    $udd=mysql_fetch_assoc(mysql_query($udd));

?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <br>
                <form class="form-horizontal" method="post" action="pmitatausaha.php?module=detail_reaksitd">
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4><?php echo $title; ?></h4>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="id_rtd" value="<?php echo $q_dt['rtd_id'];?>">
                            <input type="hidden" name="id_udd" value="<?php echo $udd['id'];?>">
                            <input type="hidden" name="mode" value="<?php echo $mode;?>">
                            <table class="table table-responsive table-hover">
                                <tr>
                                    <td class="default">Tahun</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="tahun" name="tahun" required value="<?php echo $tahun;?>"></td>
                                </tr>
                                <tr>
                                    <td class="default">Jenis Reaksi Transfusi</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="jenis" name="jenis" required value="<?php echo $q_dt['rtd_jenis_rtd'];?>"></td>
                                </tr>
                                <tr>
                                    <td class="default">Jumlah</td>
                                    <td><input type="text" class="form-control input-sm panel-custom-red" id="jumlah" name="jumlah" required value="<?php echo $q_dt['rtd_jml'];?>"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="submit" class="btn btn-default" id="shadow2"> <i class="fa fa-save" aria-hidden="true">&nbsp;Simpan</i></button>
                            <a href="pmitatausaha.php?module=reaksi_transfusi" class="btn btn-default" id="shadow2"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Batal</a>
                        </div>
                       </form>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>