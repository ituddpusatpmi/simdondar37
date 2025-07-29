
<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    include '../adm/config.php';
    $utd = mysqli_fetch_array(mysqli_query($con,"SELECT * from utd where `aktif`=1"));
    $id = $_SESSION['instansi'];
    $unit = $_SESSION['unit'];
    //echo "instansi =======>".$id;
    $ins = mysqli_fetch_array(mysqli_query($con,"SELECT * from v_webmu where `kode`='$id'"));
    $_SESSION['nmins'] = $ins['nama'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PALANG MERAH INDONESIA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--PMI STYLE-->
  <link rel="stylesheet" href="dist/css/bspmi.css">

</head>
<style type="text/css">
    .zoom {
      padding: 5px;
      transition: transform .2s; /* Animation */
      margin: 0 auto;
    }

    .zoom:hover {
      transform: scale(1.15); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
    .padding {
        
        background-image: url('dist/img/registrasi.png');
        background-size: cover;
    }
    .box{
    height: 100px;
    
    }
    .padd {
      padding-left: 10px;
      padding-top: 5px;
      padding-right: 225px;
      font-size: 12px;
    }

    .box2{

    height: 50px;

    }
    .copyright{
      bottom: 0;
      width: 100%;
      position: fixed;
      height:50px;
      line-height:50px;
      background:RED;
      color:#fff;
      padding-left: 10px;
    }
    </style>
<body class="padding">
  <div class="padd" align="right">
    <font style="font-size: 18px;"><b><u><?php echo $utd['nama'];?></u></b></font><br>
    <?php echo $utd['alamat'].', '.$namautd['daerah'];?><br>
    Telp. <?php echo $utd['telp'];?><br>
  </div>

    <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<p>
<div class="card-body" >
<h2 style="font-size:24px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;"><b>MOBILE UNIT DONOR PMI</b></h2>
    <?php echo $ins['nama']." | ".date('d M Y')." | Unit ".$unit;?>
</div>

  <div class="box" align="center">
  </div>

    <div class="card-body" align="center">
    <div class="row">
        <div class="col-lg-2">
            <div class="zoom"><a href="?page=caridonor"><img src="../images/cari_pendonor1.png"></a></div>
        </div>
        <div class="col-lg-2">
            <div class="zoom"><img src="../images/medical_checkup.png"></a></div>
        </div>
        <div class="col-lg-2">
            <div class="zoom"><img src="../images/aftap_pengambilandarah1.png"></a></div>
        </div>
        <div class="col-lg-2">
            <div class="zoom"><img src="../images/pergantian_kantong.png"></a></div>
        </div>
        <div class="col-lg-2">
            <div class="zoom"><img src="../images/rekap_transaksi0.png"></a></div>
        </div>
        <div class="col-lg-2">
            <div class="zoom"><a href="?page=logout"><img src="../images/signout.png"></a></div>
        </div>
    </div>
    </div>

  <div class="copyright">
      <p align="center"><a href="https://pmi.or.id"><font style="color:white">Copyright @ 2022 | PALANG MERAH INDONESIA</a>
  </div>


<?php //mysqli_close()?>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  </body>
  </html>
