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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

</head>
<body>
<?php
require_once('config/dbi_connect.php');
$sqlconfig  = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT * from db_server where modul='laporan'"));

$svr_lap_usr    = $sqlconfig['user'];
$svr_lap_ip     = $sqlconfig['ip'];
$svr_lap_db     = $sqlconfig['db'];
$svr_lap_pwd    = $sqlconfig['password'];
$svr_lap_mdl    = $sqlconfig['modul'];
$svr_lap_alias  = $sqlconfig['alias'];
$svr_lap_port   = $sqlconfig['port'];

// Connection to server
// $con_lap = mysqli_connect($svr_lap_ip, $svr_lap_usr, $svr_lap_pwd, $svr_lap_db, $svr_lap_port);

$tahun       = date("Y");
$bulan       = date("m");
$v_tahun     = $_POST['tahun'];
$v_bulan      = $_POST['bulan'];

if (empty($v_tahun)){$v_tahun=$tahun;}
if (empty($v_bulan)){$v_bulan=$bulan;}
if(isset($_POST['jenis_periode'])){$v_jenisperiode = $_POST['jenis_periode'];}else{$v_jenisperiode='X';}
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <br>
                    <div class="panel with-nav-tabs panel-primary" id="shadow1">
                        <div class="panel-heading">
                            <h4>UPLOAD LAPORAN</h4>
                        </div>
                        <form class="form-horizontal" method="POST" action="pmitatausaha.php?module=upload">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="jenis_periode">Periode Laporan</label>
                                            <div class="col-sm-8">
                                                <?php
                                                    $p1='';$p2='';
                                                    switch($v_jenisperiode){
                                                        case 'B':$p1='selected';break;
                                                        case 'T':$p2='selected';break;
                                                    }
                                                ?>
                                                <select class="form-control" name="jenis_periode" id="jenis_periode" title="Pilih jenis periode laporan">
                                                    <option value="B" <?php echo $p1;?>>Bulanan</option>
                                                    <option value="T" <?php echo $p2;?>>Tahunan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="bulan">Bulan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="bulan" id="bulan" title="Pilihan ini hanya berlaku apabila periode laporan adalah bulanan">
                                                <?php
                                                $array_bulan=array("1"=>"Januari","2"=>"Februari","3"=>"Maret","4"=>"April","5"=>"Mei","6"=>"Juni","7"=>"Juli","8"=>"Agustus","9"=>"September","10"=>"Oktober","11"=>"Nopember","12"=>"Desember");
                                                foreach($array_bulan AS $val => $cap){
                                                    if($v_bulan==$val){
                                                        echo '<option value="'.$val.'" selected>'.$cap.'</option>';
                                                    }else{
                                                        echo '<option value="'.$val.'">'.$cap.'</option>';
                                                    }
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="tahun">Tahun</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="tahun" id="tahun" title="Pilih tahun yang akan dilaporkan">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:25px;">
                                    <div class="col-lg-12">
                                        <table class="table table-responsive" id="shadow1">
                                            <tr><th class="active" style="width: 40%;">Periode Laporan</th>
                                                <td style="color:red;font-weight: bold">
                                                    <?php
                                                    switch ($v_jenisperiode){
                                                        case 'T': echo "TAHUN ".$v_tahun;break;
                                                        case 'B': echo "BULAN ".$array_bulan[$v_bulan]." ".$v_tahun;break;
                                                        case 'X' :break;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="active">Server </th>
                                                <td><?php echo $svr_lap_alias; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="active">Waktu mulai</th>
                                                <td><div id="start_t"></div> </td>
                                            </tr>
                                            <tr>
                                                <th class="active">Status Upload</th>
                                                <td><div id='load_t' style='display: none;'>
                                                        <img src='/profile/simdondar_kirim_data.gif'>
                                                    </div><div id="pesan_t"></div></td>
                                            </tr>
                                            <tr>
                                                <th class="active">Waktu Selesai</th>
                                                <td><div id="end_t"></div> </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" name="submit"  class="btn btn-default class_shadow1" title="Persiapan pengiriman data laporan"><i class="fa  fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Persiapan Upload</button>
                                <?php
                                if ($v_jenisperiode=='B' or $v_jenisperiode=='T'){
                                    echo '<button type="button" id="btn_upload"  name="submit2" class="btn btn-danger class_shadow1" title="Pastikan data SIMDONDAR sudah dilakukan validasi sebelum dikirim ke Pusat"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload Laporan</button>';
                                }
                                ?>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    function addZero(i) {
        if (i < 10) {i = "0" + i;}
        return i;
    }
    $(document).ready(function(){
        $("#btn_upload").click(function(){
            var g_bulan = $('#bulan').val();
            var g_tahun = $('#tahun').val();
            var g_jenis = $('#jenis_periode').val();
            var dt = new Date();
            var time = addZero(dt.getHours()) + ":" + addZero(dt.getMinutes()) + ":" + addZero(dt.getSeconds());
            $.ajax({
                url: '/profile/upload_proses.php',
                type: 'post',
                data: {t:g_tahun,b:g_bulan,m:g_jenis},
                beforeSend: function(){
                    $('#pesan_t').empty();
                    $("#load_t").show();
                    $("#start_t").html(time);
                    $("#end_t").html('');
                },
                success: function(response){
                    var dt2 = new Date();
                    var time2 = addZero(dt2.getHours()) + ":" + addZero(dt2.getMinutes()) + ":" + addZero(dt2.getSeconds());
                    $('#pesan_t').empty();
                    $('#pesan_t').append(response);
                    $("#end_t").html(time2);
                },
                complete:function(text){
                    $("#load_t").hide();
                    $("#btn_upload").hide();
                }
            });

        });
    });
</script>