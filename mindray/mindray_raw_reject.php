    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
<style>
.blink_me {font-size: 200%;animation: blinker 1s linear infinite;}
  @keyframes blinker {50% {opacity: 0;}}
</style>
<?php 
  $rptTime=$_GET['i'];
  $rptType=$_GET['j'];
  $rptInst=$_GET['ints'];
  include('config/dbi_connect.php');
  echo '<div class="container" style="padding-top:50px;"><div class="row"><div class="xol-xs-12 text-center">';
  echo '  <div class="blink_me text-danger">Menghapus data Mindray Chlia......<br>'.$rptInst.' '.$rptType.' '.$rptTime.'</div>';
  echo '</div></div></div>';
  $delete=mysqli_query($dbi, "DELETE FROM `lis_pmi`.`mindray_result` WHERE  `mdr_out_created`='$rptTime' AND `mdr_report_type`='$rptType' AND `mdr_instrument`='$rptInst'");
  echo "<meta http-equiv='refresh' content='2;url=pmiimltd.php?module=mindray_before_raw'>";
?>
