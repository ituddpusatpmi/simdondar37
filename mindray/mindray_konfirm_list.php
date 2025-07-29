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
(empty($_POST['tgl1'])) ? $tanggal1=date("Y-m-d") : $tanggal1=$_POST['tgl1'];
(empty($_POST['tgl2'])) ? $tanggal2=date("Y-m-d") : $tanggal2=$_POST['tgl2'];
(empty($_POST['petugas'])) ? $petugas="" : $petugas=$_POST['petugas'];
$select_query = "SELECT  DISTINCT `no_trans`, `instr`,`rpt_created`, `rpt_type`, DATE_FORMAT(`koonfirm_time`,'%d/%m/%Y') as konfirm_time, `konfirmer`, count(`id`) as jml FROM `mindray_confirm` WHERE (DATE(`koonfirm_time`) BETWEEN '$tanggal1' AND '$tanggal2') AND (`konfirmer` like '%$petugas%') GROUP by `no_trans`,`instr`,`rpt_created`,`rpt_type`,DATE_FORMAT(`koonfirm_time`,'%d/%m/%Y'),`konfirmer`";
$jumlah = mysqli_query($dbi,"SELECT  count(`id`) as jml FROM `mindray_confirm` WHERE (DATE(`koonfirm_time`) BETWEEN '$tanggal1' AND '$tanggal2') AND (`konfirmer` like '%$petugas%')");
$result = mysqli_query($dbi,$select_query);
$count  = mysqli_fetch_array($jumlah);
if ($result){$jumdata=mysqli_num_rows($result);}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-sm-9 col-xs-9">
            <h3>Rekap Konfirmasi Hasil Mindray CHLIA</h3>
        </div>
        <div class="col-lg-2 col-sm-2 col-xs-2 text-right" style="padding-top: 20px;">
            <a href="pmiimltd.php?module=mindray_menu" class="btn btn-sm btn-primary shadow-xx"><span class="glyphicon glyphicon-home" style="font-size: 120%;"></span>&nbsp;&nbsp;Kembali</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10  col-md-11 col-sm-11 col-xs-12">
            <div class="panel panel-primary shadow">
                <div class="panel-body" style="padding-bottom:2px;padding-top:10px;">
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
                            <label class="control-label" for="src2">Petugas</label>
                            <input name="petugas"  value="<?=$petugas?>" type="text" class="form-control">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary shadow-xx"><span class="glyphicon glyphicon-ok" style="font-size: 120%;"></span>&nbsp;Ok</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-10  col-md-11 col-sm-11 col-xs-12">
            <h4>Terdapat <b><?php echo $count['jml'];?></b> Pemeriksaan</h4>
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered table-sm">
                    <thead class="pmi">
                    <tr style="height: 40px;">
                        <th class="text-center" style="vertical-align: middle;">NO</th>
                        <th class="text-center" style="vertical-align: middle;">NO KONFIRMASI</th>
                        <th class="text-center" style="vertical-align: middle;">INSTRUMENT</th>
                        <th class="text-center" style="vertical-align: middle;">TGL KONFIRMASI</th>
                        <th class="text-center" style="vertical-align: middle;">TGL OUTPUT</th>
                        <th class="text-center" style="vertical-align: middle;">JENIS OUTPUT</th>
                        <th class="text-center" style="vertical-align: middle;">JUMLAH</th>
                        <th class="text-center" style="vertical-align: middle;">PETUGAS</th>
                        <th class="text-center" style="vertical-align: middle;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=0;
                        if ($jumdata>0){
                            while($row = mysqli_fetch_array($result)){
                                $no++;
                                $param='i='.$row['mdr_out_created'].'&j='.$row['mdr_report_type'];
                                echo'
                                <tr>
                                    <td nowrap class="text-right">'.$no.'.</td>
                                    <td nowrap class="text-center">'.$row['no_trans'].'</td>
                                    <td nowrap class="text-center">'.$row['instr'].'</td>
                                    <td nowrap class="text-center">'.$row['konfirm_time'].'</td>
                                    <td nowrap class="text-center">'.$row['rpt_created'].'</td>
                                    <td nowrap class="text-center">'.$row['rpt_type'].'</td>
                                    <td nowrap class="text-center">'.$row['jml'].'</td>
                                    <td nowrap class="text-center">'.$row['konfirmer'].'</td>
                                    <td nowrap class="text-center">
                                        <button type="button" class="btn btn-success btn-sm shadow-xx showModal" aria-label="Left Align" data-toggle="modal" data-target="#myModal" data-href="mindray/mindray_konfirm_rpt.php?notrans='.$row['no_trans'].'&#zoom=FitH&pagemode=none" title="Cetak Hasil IMLTD Mindray CHLIA No. '.$row['no_trans'].'"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                                    </td>
                                </tr>';
                            }
                        }else{
                            echo'<tr><td nowrap class="text-center" colspan="8">TIDAK ADA DATA</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">   
        <div class="modal-content">
            <div class="modal-header shadow">
                <button type="button" class="close btn-sm btn-default" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:white;">Cetak Hasil Konfirmasi</h4>
            </div>
            <div class="modal-body">
            <div class="container-frame"> 
                <iframe class="responsive-iframe" src="mindray/mindray_konfirm_rpt.php"  frameborder="0" allowtransparency="true">Your browser doesn't support iframes</iframe>
            </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
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
