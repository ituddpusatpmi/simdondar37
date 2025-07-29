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
    $v_tanggal_laporan=$_POST['tanggal'];
    $name = $_POST['udd'];
    echo "<br>Update Data.";
    $q_umm="UPDATE `rpt_data_umum` SET `u_tgl_laporan` = '$v_tanggal_laporan'";
    $q_umm=mysql_query($q_umm);
    if ($q_umm){echo "Update Sukses<br>";}else{echo "Update Error<br>";}
    ?><META http-equiv="refresh" content="0;URL=pmitatausaha.php?module=set_tanggal"><?php
} else {
    $tahun=date('Y');
    $udd="select * from utd where aktif='1'";
    $udd=mysql_fetch_assoc(mysql_query($udd));
    $id_udd=$udd['id'];
    $qlap="SELECT * FROM `rpt_data_umum` WHERE `u_id_udd`='$udd[id]'";
    $qlap=mysql_fetch_assoc(mysql_query($qlap));
    if($qlap['u_id_udd']==$udd['id']){
        $nama_udd=$qlap['u_nama'];
        $alamat_udd=$qlap['u_alamat'];
        $id_udd = $qlap['u_id_udd'];
        $ada_data='1';
        $tanggal_laporan=$qlap['u_tgl_laporan'];
    } else {
        $ada_data='0';
        $nama_udd=$udd['nama'];
        $id_udd = $udd['id'];
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <br>
                <form class="form-horizontal" method="post" action="pmitatausaha.php?module=set_tanggal">
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4>Setting Laporan</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label" for="tanggal">Tanggal Pelaporan</label>
                                        <input type="date" class="form-control input-sm" id="tanggal" placeholder="yyyy-mm-dd" name="tanggal" required value="<?php echo $tanggal_laporan; ?>">
                                        <small>Format tanggal : Tahun-Bulan-Tanggal --> YYYY-MM-DD</small>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" name="submit" class="btn btn-default" id="shadow2"><i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Simpan Data</button>
                            <a href="pmitatausaha.php?module=laporan" class="btn btn-default" id="shadow2"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
</body>
</html>
