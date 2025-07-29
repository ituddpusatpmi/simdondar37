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
$g_prm=trim($_GET['prm']);
$g_lot=$_GET['lot'];
switch($g_prm){
    case "HBsAg"        : $p_sql=" m.`b_od` as `od` , m.`b_hasil` as `hasil`, m.`b_range` as `range`, m.`b_unit` as `unit`, ";$w_sql=" m.`b_lot_reag` ";break;
    case "Anti-HCV"     : $p_sql=" m.`c_od` as `od` , m.`c_hasil` as `hasil`, m.`c_range` as `range`, m.`c_unit` as `unit`, ";$w_sql=" m.`c_lot_reag` ";break;
    case "Anti-HIV"     : $p_sql=" m.`i_od` as `od` , m.`i_hasil` as `hasil`, m.`i_range` as `range`, m.`i_unit` as `unit`, ";$w_sql=" m.`i_lot_reag` ";break;
    case "Sifilis/TP"   : $p_sql=" m.`s_od` as `od` , m.`s_hasil` as `hasil`, m.`s_range` as `range`, m.`s_unit` as `unit`, ";$w_sql=" m.`s_lot_reag` ";break;
}
$sql="SELECT m.`no_trans`, m.`instr`, m.`id_tes`, ".$p_sql." date(m.`koonfirm_time`) as tglkonfirm FROM `mindray_confirm` m WHERE ".$w_sql." = '$g_lot'";
?>
<div class="container-fluid">
    
    <div class="row">
        <div class="col-lg-7 col-sm-8 col-xs-8">
            <h3>Rincian <i>trace</i> Lot Reagen Mindray Chlia</h3>
        </div>
        <div class="col-lg-3 col-sm-4 col-xs-4 text-right" style="padding-top: 20px;">
            <button type="button" class="btn btn-primary btn-sm shadow showModal" aria-label="Left Align" data-toggle="modal" data-target="#myModal" data-href="mindray/mindray_tracesamplelotrpt.php?prm=<?php echo $g_prm.'&lot='.$g_lot ;?>&#zoom=FitH&pagemode=none" title="Cetak Rincian Sample Mindray Chlia <?php echo $g_prm.', Lot:'.$g_lot ;?>"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;&nbsp;Cetak</button>
			<a href="pmiimltd.php?module=mindraylottrace" class="btn btn-sm btn-primary shadow-xx"><span class="glyphicon glyphicon-repeat"></span>&nbsp;&nbsp;Kembali</a>
            <a href="pmiimltd.php?module=mindray_menu" class="btn btn-sm btn-primary shadow-xx"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Menu</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-10 col-sm-12 col-xs-12">
            <div class="table-responsive shadow">
                <table class="table table-hover table-bordered table-sm">
                    <thead class="pmi">
                        <tr>
                            <th class="text-center" colspan="7"><h4><?php echo 'Parameter: '.$g_prm.',  Lot: '.$g_lot;?></h4></th>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;">No</th>
                            <th class="text-center" style="vertical-align: middle;">Tanggal</th>
                            <th class="text-center" style="vertical-align: middle;">No Transaksi</th>
                            <th class="text-center" style="vertical-align: middle;">No Sample/Kantong</th>
                            <th class="text-center" style="vertical-align: middle;">Instrument</th>
                            <th class="text-center" style="vertical-align: middle;">OD</th>
                            <th class="text-center" style="vertical-align: middle;">Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no=0;
                            $qry_sample=mysqli_query($dbi,$sql);
                            while($row=mysqli_fetch_assoc($qry_sample)){
                                $no++;
                                echo '<tr>
                                        <td class="text-right">'.$no.'.</td>
                                        <td class="text-center">'.$row['tglkonfirm'].'</td>
                                        <td class="text-center">'.$row['no_trans'].'</td>
                                        <td class="text-center">'.$row['id_tes'].'</td>
                                        <td class="text-center">'.$row['instr'].'</td>
                                        <td class="text-center">'.$row['od'].'</td>
                                        <td class="text-center">'.$row['hasil'].'</td>
                                      </tr>';
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
                <h4 class="modal-title" style="color:white;">Trace Lot Reagen Mindray</h4>
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
