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
$w_param="";
(empty($_POST['tgl1'])) ? $tanggal1=date("Y-m-01") : $tanggal1=$_POST['tgl1'];
(empty($_POST['tgl2'])) ? $tanggal2=date("Y-m-d") : $tanggal2=$_POST['tgl2'];
(empty($_POST['parameter'])) ? $parameter="" : $parameter=$_POST['parameter'];
switch ($parameter){
    case ""         : $sel1=" selected ";$w_param=" ";break;
    case "HBsAg-I"  : $sel2=" selected ";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
    case "Anti-HCV" : $sel3=" selected ";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
    case "HIV"      : $sel4=" selected ";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
    case "Anti-TP"  : $sel5=" selected ";$w_param=" AND `mdr_ctrl_param`='$parameter' ";break;
}
$select_query = "SELECT `mdr_id`, `mdr_instrument`, `mdr_ctrl_name`, `mdr_ctrl_lot`, `mdr_ctrl_param`, `mdr_ctrl_type`, `mdr_ctrl_unit`, `mdr_ctrl_od`, `mdr_ctrl_rev1`, `mdr_ctrl_rev2`, `mdr_ctrl_ed`, `mdr_ctrl_rev3`, `mdr_ctrl_time`, `on_insert` FROM `lis_pmi`.`mindray_control` 
                 WHERE  (STR_TO_DATE(CONCAT(MID(`mdr_ctrl_time`,7,4),'-',MID(`mdr_ctrl_time`,4,2),'-',MID(`mdr_ctrl_time`,1,2)),'%Y-%m-%d') BETWEEN '$tanggal1' AND '$tanggal2') ".$w_param;
// echo $select_query;
$mdl_param='t1='.$tanggal1.'&t2='.$tanggal2.'&p='.$parameter;
$result = mysqli_query($dbi,$select_query);
if ($result){
    $jumdata=mysqli_num_rows($result);}
?>
<div class="container-fluid">
    <div class="row" style="padding-top: 20px;">
        <div class="col-lg-10 col-md-11 col-sm-12 col-xs-12">
            <div class="panel panel-primary shadow">
                <div class="panel-heading">
                    <div class="panel-title pull-left" style="font-size:150%;">
                        List Control Mindray Chlia
                    </div>
                    <div class="panel-title pull-right">
                        <a href="pmiimltd.php?module=mindraylottrace" class="btn btn-info shadow-xx"><span class="glyphicon glyphicon-zoom-in" style="font-size: 120%;"></span>&nbsp;&nbsp;Trace Lot</a>&nbsp;
                        <a href="pmiimltd.php?module=mindrayreagen" class="btn btn-warning shadow-xx"><span class="glyphicon glyphicon-qrcode" style="font-size: 120%;"></span>&nbsp;&nbsp;Penggunaan Reagen</a>&nbsp;
                        <a href="pmiimltd.php?module=mindray_menu" class="btn btn-success shadow-xx"><span class="glyphicon glyphicon-home" style="font-size: 120%;"></span>&nbsp;&nbsp;Menu</a>&nbsp;
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="src1">Dari tgl</label>
                            <input name="tgl1" id="datepicker"  value="<?=$tanggal1?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="src1">sampai tgl</label>   
                            <input name="tgl2" id="datepicker1"  value="<?=$tanggal2?>" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="src2">Parameter</label>
                            <select name="parameter" class="select-sm form-control">
                                <option value="" <?php echo $sel1;?> >Semua Parameter</option>
                                <option value="HBsAg-I" <?php echo $sel2;?> >HBsAg</option>
                                <option value="Anti-HCV" <?php echo $sel3;?> >Anti-HCV</option>
                                <option value="HIV" <?php echo $sel4;?> >Anti-HIV</option>
                                <option value="Anti-TP" <?php echo $sel5;?> >Anti-TP</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary shadow-xx"><span class="glyphicon glyphicon-ok" style="font-size: 120%;"></span>&nbsp;Ok</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-md-11 col-sm-12 col-xs-12">
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered table-sm">
                    <thead class="pmi">
                    <tr style="height: 40px;">
                        <th class="text-center" style="vertical-align: middle;">No</th>
                        <th class="text-center" style="vertical-align: middle;">Tanggal</th>
                        <th class="text-center" style="vertical-align: middle;">Instrument</th>
                        <th class="text-center" style="vertical-align: middle;">Parameter</th>
                        <th class="text-center" style="vertical-align: middle;">Nama Control</th>
                        <th class="text-center" style="vertical-align: middle;">OD</th>
                        <th class="text-center" style="vertical-align: middle;">Unit</th>
                        <th class="text-center" style="vertical-align: middle;">Lot</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=0;
                        if ($jumdata>0){
                            while($row = mysqli_fetch_array($result)){
                                $no++;
                                echo'
                                <tr>
                                    <td nowrap class="text-right">'.$no.'.</td>
                                    <td nowrap class="text-left">'.$row['mdr_ctrl_time'].'</td>
                                    <td nowrap class="text-left">'.$row['mdr_instrument'].'</td>
                                    <td nowrap class="text-left">'.$row['mdr_ctrl_param'].'</td>
                                    <td nowrap class="text-left">'.$row['mdr_ctrl_name'].'</td>
                                    <td nowrap class="text-center">'.$row['mdr_ctrl_od'].'</td>
                                    <td nowrap class="text-center">'.$row['mdr_ctrl_unit'].'</td>
                                    <td nowrap class="text-center">'.$row['mdr_ctrl_lot'].'</td>
                                </tr>';
                            }
                        }else{
                            echo'
                                <tr>
                                    <td nowrap class="text-center" colspan="8">TIDAK ADA DATA</td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    if ($jumdata>0){
        echo '
        <div class="row" style="padding-top:20px;">
            <div class="col-lg-12">                
               <button type="button" class="btn btn-primary shadow showModal" aria-label="Left Align" data-toggle="modal" data-target="#myModal" data-href="mindray/mindray_ctrlrpt.php?'.$mdl_param.'&#zoom=FitH&pagemode=none" title="Cetak Kontrol Reagen Mindray Chlia"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;&nbsp;Cetak</button>
            </div>
        </div>';
    }
    ?>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">   
        <div class="modal-content">
            <div class="modal-header shadow">
                <button type="button" class="close btn-sm btn-default" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:white;">Cetak Hasil IMLTD</h4>
            </div>
            <div class="modal-body">
            <div class="container-frame"> 
                <iframe class="responsive-iframe" src=""  frameborder="0" allowtransparency="true">Your browser doesn't support iframes</iframe>
            </div>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
  $(document).ready(function() {
    $(".showModal").click(function(e) {
      e.preventDefault();
      var url = $(this).attr("data-href");
      var ntrx= $(this).attr("title");
      $("#myModal h4").text(ntrx);
      $("#myModal iframe").attr("src", url);
      $("#myModal").modal("show");
    });
  });
</script>
