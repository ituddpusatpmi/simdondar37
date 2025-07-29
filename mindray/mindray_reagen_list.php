
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
        .shadow{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .shadow-xx{
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
        }
        </style>
<body>
<?php
session_start();
require_once('config/dbi_connect.php');
date_default_timezone_set('Asia/Makassar');
(empty($_POST['tgl1'])) ? $tanggal1=date("Y-m-01") : $tanggal1=$_POST['tgl1'];
(empty($_POST['tgl2'])) ? $tanggal2=date("Y-m-d") : $tanggal2=$_POST['tgl2'];
$select_s= "SELECT
    CONCAT(MID(`mdr_sample_date2`,7,4),'-',MID(`mdr_sample_date2`,4,2),'-',MID(`mdr_sample_date2`,1,2)) AS Tanggal,
    SUM(CASE WHEN `mdr_param1`='HBsAg-I' THEN 1 ELSE 0 END) AS 'HBSAG',
    SUM(CASE WHEN `mdr_param1`='Anti-HCV' THEN 1 ELSE 0 END) AS 'HCV',
    SUM(CASE WHEN `mdr_param1`='HIV' THEN 1 ELSE 0 END) AS 'HIV',
    SUM(CASE WHEN `mdr_param1`='Anti-TP' THEN 1 ELSE 0 END) AS 'TP'
    FROM `lis_pmi`.`mindray_result`
    WHERE  (STR_TO_DATE(CONCAT(MID(`mdr_sample_date2`,7,4),'-',MID(`mdr_sample_date2`,4,2),'-',MID(`mdr_sample_date2`,1,2)),'%Y-%m-%d') BETWEEN '$tanggal1' AND '$tanggal2')
    GROUP BY 
    CONCAT(MID(`mdr_sample_date2`,7,4),'-',MID(`mdr_sample_date2`,4,2),'-',MID(`mdr_sample_date2`,1,2))";
// echo $select_query;
$select_c="SELECT
    CONCAT(MID(`mdr_ctrl_time`,7,4),'-',MID(`mdr_ctrl_time`,4,2),'-',MID(`mdr_ctrl_time`,1,2)) AS Tanggal,
    SUM(CASE WHEN `mdr_ctrl_param`='HBsAg-I' THEN 1 ELSE 0 END) AS 'HBSAG',
    SUM(CASE WHEN `mdr_ctrl_param`='Anti-HCV' THEN 1 ELSE 0 END) AS 'HCV',
    SUM(CASE WHEN `mdr_ctrl_param`='HIV' THEN 1 ELSE 0 END) AS 'HIV',
    SUM(CASE WHEN `mdr_ctrl_param`='Anti-TP' THEN 1 ELSE 0 END) AS 'TP'
    FROM `lis_pmi`.`mindray_control`
    WHERE  (STR_TO_DATE(CONCAT(MID(`mdr_ctrl_time`,7,4),'-',MID(`mdr_ctrl_time`,4,2),'-',MID(`mdr_ctrl_time`,1,2)),'%Y-%m-%d') BETWEEN '$tanggal1' AND '$tanggal2')
    GROUP BY 
    CONCAT(MID(`mdr_ctrl_time`,7,4),'-',MID(`mdr_ctrl_time`,4,2),'-',MID(`mdr_ctrl_time`,1,2))";
// echo $select_c;
$results = mysqli_query($dbi,$select_s);
$resultc = mysqli_query($dbi,$select_c);
if ($results){$jumdata_s=mysqli_num_rows($results);}
if ($resultc){$jumdata_c=mysqli_num_rows($resultc);}
$tot_b=$tot_c=$tot_i=$tot_s=$total=0;
?>
<div class="container-fluid">
    <div class="row" style="padding-top: 20px;">
        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
            <div class="panel panel-primary shadow">
            <div class="panel-heading">
                    <div class="panel-title pull-left" style="font-size:150%;">
                        Pengunaan Reagen Mindray Chlia
                    </div>
                    <div class="panel-title pull-right">
                        <a href="pmiimltd.php?module=mindraylottrace" class="btn btn-info shadow-xx"><span class="glyphicon glyphicon-zoom-in" style="font-size: 120%;"></span>&nbsp;&nbsp;Trace Lot</a>&nbsp;
                        <a href="pmiimltd.php?module=mindraykontrol" class="btn btn-danger shadow-xx"><span class="glyphicon glyphicon-barcode" style="font-size: 120%;"></span>&nbsp;&nbsp;Control Reagen</a>&nbsp;
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
                        <button type="submit" name="submit" class="btn btn-primary shadow-xx"><span class="glyphicon glyphicon-ok" style="font-size: 120%;"></span>&nbsp;Ok</button>
                    </form>
                </div>
            </div>
            
            
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <h4>Pengunaan untuk sample</h4>
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered">
                    <thead class="pmi">
                    <tr>
                        <th class="text-center" style="vertical-align: middle;" rowspan="2">No</th>
                        <th class="text-center" style="vertical-align: middle;" rowspan="2">Tanggal</th>
                        <th class="text-center" style="vertical-align: middle;" colspan="4">Parameter</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">HBsAg</th>
                        <th class="text-center" style="vertical-align: middle;">Anti-HCV</th>
                        <th class="text-center" style="vertical-align: middle;">Anti-HIV</th>
                        <th class="text-center" style="vertical-align: middle;">Sypilis/TP</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=0;
                        if ($jumdata_s>0){
                            while($row = mysqli_fetch_array($results)){
                                $no++;
                                $tot_b=$tot_b+$row['HBSAG'];
                                $tot_c=$tot_c+$row['HCV'];
                                $tot_i=$tot_i+$row['HIV'];
                                $tot_s=$tot_s+$row['TP'];
                                echo'
                                <tr>
                                    <td nowrap class="text-right">'.$no.'.</td>
                                    <td nowrap class="text-left">'.$row['Tanggal'].'</td>
                                    <td nowrap class="text-center">'.$row['HBSAG'].'</td>
                                    <td nowrap class="text-center">'.$row['HCV'].'</td>
                                    <td nowrap class="text-center">'.$row['HIV'].'</td>
                                    <td nowrap class="text-center">'.$row['TP'].'</td>
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
        <div class="col-xs-12 col-sm-6 col-md-4">
            <h4>Pengunaan untuk Control</h4>
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered">
                    <thead class="pmi">
                    <tr>
                        <th class="text-center" style="vertical-align: middle;" rowspan="2">No</th>
                        <th class="text-center" style="vertical-align: middle;" rowspan="2">Tanggal</th>
                        <th class="text-center" style="vertical-align: middle;" colspan="4">Parameter</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">HBsAg</th>
                        <th class="text-center" style="vertical-align: middle;">Anti-HCV</th>
                        <th class="text-center" style="vertical-align: middle;">Anti-HIV</th>
                        <th class="text-center" style="vertical-align: middle;">Sypilis/TP</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no1=0;
                        if ($jumdata_c>0){
                            while($row1 = mysqli_fetch_array($resultc)){
                                $no1++;
                                $tot_b=$tot_b+$row1['HBSAG'];
                                $tot_c=$tot_c+$row1['HCV'];
                                $tot_i=$tot_i+$row1['HIV'];
                                $tot_s=$tot_s+$row1['TP'];
                                echo'
                                <tr>
                                    <td nowrap class="text-right">'.$no1.'.</td>
                                    <td nowrap class="text-left">'.$row1['Tanggal'].'</td>
                                    <td nowrap class="text-center">'.$row1['HBSAG'].'</td>
                                    <td nowrap class="text-center">'.$row1['HCV'].'</td>
                                    <td nowrap class="text-center">'.$row1['HIV'].'</td>
                                    <td nowrap class="text-center">'.$row1['TP'].'</td>
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
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <h4>Total Penggunaan reagen</h4>
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered">
                    <thead class="pmi">
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">Parameter</th>
                        <th class="text-center" style="vertical-align: middle;">Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr><td>HBsAg</td>      <td class="text-center"> <?php echo number_format($tot_b,0,",",".");?> </td></tr>
                        <tr><td>Anti-HCV</td>   <td class="text-center"> <?php echo number_format($tot_c,0,",",".");?> </td></tr>
                        <tr><td>Anti-HIV</td>   <td class="text-center"> <?php echo number_format($tot_i,0,",",".");?> </td></tr>
                        <tr><td>Sypilis/TP</td> <td class="text-center"> <?php echo number_format($tot_s,0,",",".");?> </td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>