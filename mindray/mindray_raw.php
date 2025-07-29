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
$select_query = "SELECT `mdr_instrument`,`mdr_report_type`, `mdr_out_created`, `mdr_date1` as tgl,  count(DISTINCT (`mdr_sample_id`)) as jml  FROM lis_pmi.`mindray_result`  WHERE `mdr_konfirm`='0' GROUP BY  `mdr_instrument`, `mdr_out_created`,`mdr_report_type`,`mdr_date1`";
$result = mysqli_query($dbi,$select_query);
if ($result){
    $jumdata=mysqli_num_rows($result);}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 col-sm-8 col-xs-8">
            <h3>Hasil Mindray Chlia belum dikonfirmasi</h3>
        </div>
        <div class="col-lg-3 col-sm-4 col-xs-4 text-right" style="padding-top: 20px;">
						<a href="pmiimltd.php?module=mindray_before_raw" class="btn btn-sm btn-primary shadow-xx"><span class="glyphicon glyphicon-repeat" style="font-size: 120%;"></span>&nbsp;&nbsp;Refresh</a>
            <a href="pmiimltd.php?module=mindray_menu" class="btn btn-sm btn-primary shadow-xx"><span class="glyphicon glyphicon-home" style="font-size: 120%;"></span>&nbsp;&nbsp;Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-sm-12 col-xs-12">
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered table-sm">
                    <thead class="pmi">
                    <tr style="height: 40px;">
                        <th class="text-center" style="vertical-align: middle;">NO</th>
                        <th class="text-center" style="vertical-align: middle;">INSTRUMENT</th>
                        <th class="text-center" style="vertical-align: middle;">TGL</th>
                        <th class="text-center" style="vertical-align: middle;">JENIS OUTPUT</th>
                        <th class="text-center" style="vertical-align: middle;">JUMLAH</th>
                        <th class="text-center" style="vertical-align: middle;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=0;
                        if ($jumdata>0){
                            while($row = mysqli_fetch_array($result)){
                                $no++;
                                $param='i='.$row['mdr_out_created'].'&j='.$row['mdr_report_type'].'&ints='.$row['mdr_instrument'];
                                echo'
                                <tr>
                                    <td nowrap class="text-right">'.$no.'.</td>
                                    <td nowrap class="text-center">'.$row['mdr_instrument'].'</td>
                                    <td nowrap class="text-center">'.$row['mdr_out_created'].'</td>
                                    <td nowrap class="text-center">'.$row['mdr_report_type'].'</td>
                                    <td nowrap class="text-center">'.$row['jml'].'</td>
                                    <td nowrap class="text-center">
                                        <a href="pmiimltd.php?module=mindray_raw_konf&'.$param.'" class="btn btn-primary btn-sm shadow-xx"><span class="glyphicon glyphicon-check"></a>
                                        <a onclick=\'return confirm("Apakah yakin data ini akan dihapus?")\' href=\'pmiimltd.php?module=mindrayrejectlist&'.$param.'\' class="btn btn-danger btn-sm shadow-xx"><span class="glyphicon glyphicon-trash"></a>
                                    </td>
                                </tr>';
                            }
                        }else{
                            echo'<tr><td nowrap class="text-center" colspan="5">Semua data pemeriksaan Mindray Chlia sudah dikonfirmasi</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
