        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootsrap337/fonts/font-awesome.min.css" />
    <link type="text/css" href="css/calender.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
    <script type="text/javascript" src="js/tgl_rekap.js"></script>
    <link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
    <style>
        .container-frame {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            }
        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border: none;
            }
        </style>
<body>
<?php
session_start();
require_once('config/dbi_connect.php');
date_default_timezone_set('Asia/Makassar');
$sel1=$sel2=$sel3=$sel4=$sel5=$p_param=$p_lot=$w_sql=$sel_ed=$msg="";
if (isset($_POST['submit'])){
    $p_param = $_POST['parameter'];
    $p_lot   = $_POST['lot'];
    switch($p_param){
        case ""  : $sel1="selected";$w_sql="";$st_param="";break;
        case "1" : $sel2="selected";$w_sql=" `b_lot_reag` ";$sel_ed=" `b_ed_reag` ";$st_param=" HBsAg ";break;
        case "2" : $sel3="selected";$w_sql=" `c_lot_reag` ";$sel_ed=" `c_ed_reag` ";$st_param=" Anti-HCV ";break;
        case "3" : $sel4="selected";$w_sql=" `i_lot_reag` ";$sel_ed=" `i_ed_reag` ";$st_param=" Anti-HIV";break;
        case "4" : $sel5="selected";$w_sql=" `s_lot_reag` ";$sel_ed=" `s_ed_reag` ";$st_param=" Sifilis/TP ";break;
    }
    $msg=$st_param.' Lot: '.$p_lot;
    if ($p_param==""){
        echo "<script>alert('Pilih parameter dan lot reagen terlebih dahulu')</script>";
    }
}

?>
<div class="container-fluid">
    <div class="row" style="padding-top: 20px;">
        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
            <div class="panel panel-primary shadow">
                <div class="panel-heading">
                    <div class="panel-title pull-left" style="font-size:150%;">
                        <i>Trace</i> Lot Reagen Mindray Chlia
                    </div>
                    <div class="panel-title pull-right">
                        <a href="pmiimltd.php?module=mindraykontrol" class="btn btn-danger shadow-xx"><span class="glyphicon glyphicon-barcode" style="font-size: 120%;"></span>&nbsp;&nbsp;Control Reagen</a>&nbsp;
                        <a href="pmiimltd.php?module=mindrayreagen" class="btn btn-warning shadow-xx"><span class="glyphicon glyphicon-qrcode" style="font-size: 120%;"></span>&nbsp;&nbsp;Penggunaan Reagen</a>&nbsp;
                        <a href="pmiimltd.php?module=mindray_menu" class="btn btn-success shadow-xx"><span class="glyphicon glyphicon-home" style="font-size: 120%;"></span>&nbsp;&nbsp;Menu</a>&nbsp;
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="parameter">Pilih Parameter</label>
                            <select name="parameter" id="parameter" class="select-sm form-control">
                                <option value=""  <?php echo $sel1;?> >Pilih Parameter</option>
                                <option value="1" <?php echo $sel2;?> >HBsAg</option>
                                <option value="2" <?php echo $sel3;?> >Anti-HCV</option>
                                <option value="3" <?php echo $sel4;?> >Anti-HIV</option>
                                <option value="4" <?php echo $sel5;?> >Anti-TP</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="lot">Pilih Lot</label>
                            <select name="lot" class="select-sm form-control" id="lot">
                                    <?php 
                                        if (!$p_param==""){
                                            switch($p_param){
                                                case "1" : $q_param="SELECT DISTINCT `b_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `b_lot_reag`";break;
                                                case "2" : $q_param="SELECT DISTINCT `c_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `c_lot_reag`";break;
                                                case "3" : $q_param="SELECT DISTINCT `i_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `i_lot_reag`";break;
                                                case "4" : $q_param="SELECT DISTINCT `s_lot_reag` as `nolot`, count(`id`) as jumlah FROM `mindray_confirm` GROUP BY `s_lot_reag`";break;
                                            }
                                            $lot=mysqli_query($dbi,$q_param);
                                                while ($rsl=mysqli_fetch_assoc($lot)){
                                                    if ($p_lot==$rsl['nolot']){
                                                        echo '<option value="'.$rsl['nolot'].'" selected>'.$rsl['nolot'].'</option>';
                                                    }else{
                                                        echo '<option value="'.$rsl['nolot'].'">'.$rsl['nolot'].'</option>';
                                                    }
                                                }
                                        }else{
                                            echo '<option value="">Pilih Lot</option>';
                                        }
                                    ?>
                                    
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary shadow-xx"><span class="glyphicon glyphicon-ok" style="font-size: 120%;"></span>&nbsp;Ok</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4>Rinkasan pemakaian reagen <?php echo $msg;?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-top: 10px;">
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered table-sm">
                    <thead class="pmi">
                    <tr style="height: 40px;">
                        <th class="text-center" style="vertical-align: middle;">No</th>
                        <th class="text-center" style="vertical-align: middle;">Tanggal</th>
                        <th class="text-center" style="vertical-align: middle;">Instrument</th>
                        <th class="text-center" style="vertical-align: middle;">Jumlah Sample</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!$p_param==""){
                            $no=0;
                            $jumdata=0;
                            $total_sample=0;
                            $qry_lot=mysqli_query($dbi,"SELECT date(`koonfirm_time`) as tanggal, `instr`, ".$sel_ed." as ed,count(`id_tes`) as jumlah
                                      FROM `mindray_confirm` WHERE ".$w_sql."='$p_lot' GROUP BY DATE(`koonfirm_time`),`instr`, ".$sel_ed);
                            while($row=mysqli_fetch_assoc($qry_lot)){
                                $ed=$row['ed'];
                                $total_sample=$total_sample+$row['jumlah'];
                                $no++;$jumdata++;
                                echo '<tr>
                                        <td class="text-right">'.$no.'.</td>
                                        <td class="text-center">'.$row['tanggal'].'</td>
                                        <td class="text-center">'.$row['instr'].'</td>
                                        <td class="text-center">'.$row['jumlah'].'</td>
                                      </tr>';
                            }
                        }else{
                            echo'<tr><td colspan="4">Tidak ada data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-10 col-xs-12" style="padding-top: 10px;">
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered table-sm">
                        <thead class="pmi">
                            <th>RINGKASAN</th>
                            <th class="text-right">
                                <?php
                                    if ($jumdata>0){echo '<a href="pmiimltd.php?module=mindraytracesample&prm='.$st_param.'&lot='.$p_lot.'" class="btn btn-default btn-xs shadow" title="Lihat rincian sample yang diperiksa"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;&nbsp;Lihat rincian sample</a>';}
                                ?>
                            </th>
                        </thead>
                        <tbody>
                            <tr><td>Nomor LOT</td><th> <?php echo $p_lot;?></th></tr>
                            <tr><td>Kadaluarsa</td><th> <?php echo $ed;?></th></tr>
                            <tr><td>Total sample</td><th> <?php echo $total_sample;?></th></tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
$(document).ready(function() {
   $('#parameter').change(function() { 
     var parameter = $(this).val(); 
     $.ajax({
            type: 'GET', 
            url: 'mindray/mindray_getlot.php', 
            data: 'param=' + parameter, 
            success: function(response) { 
                $('#lot').html(response); 
            }
       });
    });
});
</script>
