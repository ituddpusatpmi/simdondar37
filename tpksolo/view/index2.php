<?php
  require_once('adm/config.php');


    $pass = '170945';
    $antri = '646505';


    if(isset($_POST['masuk'])) {
      $token = $_POST["token"];
      if ($_POST["token"] != $pass)  {
        header("location: ?page=index2");
       }
      else {
        header("location: ?page=frontantri");

      }}

     //sampel
     if(isset($_POST['masuk2'])) {
      $token = $_POST["token"];
      if ($_POST["token"] != $pass)  {
        header("location: ?page=index2");
       }
      else {
        header("location: ?page=hasilsampel");

      }}

    //antripk
    if(isset($_POST['masuk3'])) {
      $token = $_POST["token"];
      if ($_POST["token"] != $antri)  {
        header("location: ?page=index2");
       }
      else {
        header("location: ?page=frontmintapk");

      }}   

    //if($_GET['gagal'] == "1"){?>

      <div class="row">
        <div class="col-lg-12 col-lg-offset-3">
          <div class="alert alert-danger alert-dismissable" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <strong>TOKEN</strong> Tidak Terdaftar!!!
          </div>

        </div>

      </div>
    <?php//}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PMI KOTA SURAKARTA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<style>
.box{

	height: 100px;
	padding: 20px;
}
.box2{

	height: 50px;
	padding: 20px;
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
<body>


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <div class="box" align="center">
  </div>

  <div class="row" align="center">
    <div class="col-lg-12">
        <img src="dist/img/logPMI.png" width="100px">
      </div>
    </div>
<p>
  <div class="row" align="center">
    <div class="col-lg-12">
        <h4><b>INFORMASI PERMINTAAN DARAH TRANSFUSI<br>PMI KOTA SURAKARTA</b></h4>
      </div>
    </div>
<div class="box2">
</div>
    <div class="row" align="center">
    <div class="col-lg-4 col-4" align="center">
      <img src="dist/img/antripk.png" width="150px" data-toggle="modal" data-target="#antri">
          <!--a href="?page=frontmintapk"><img src="dist/img/antripk.png" width="150px"></a-->
        </div>
        <div class="col-lg-4 col-4" align="center">
            <img src="dist/img/mintapk.png" width="150px" data-toggle="modal" data-target="#rs">
          <!--a href="?page=frontantri"><img src="dist/img/mintapk.png" width="150px"></a-->
          </div>
          <div class="col-lg-4 col-4" align="center">
            <img src="dist/img/sampelpk.png" width="150px" data-toggle="modal" data-target="#sampel">
            <!--a href="?page=hasilsampel"><img src="dist/img/sampelpk.png" width="150px"></a-->
            </div>
      </div>
  </div>
<!-- /.login-box -->

<div id="rs" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>


      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="input-group mb-3">
              <input type="text" name="token" class="form-control" placeholder="Masukan Token Anda" required>
            </div>

        </div>

        <div class="modal-footer">
          <button type="reset" class="btn btn-danger" data-dismiss="modal">BATAL</button>
          <input type="submit" class="btn btn-success" name="masuk" id="tambah" value="LOGIN">
        </div>
        </form>



    </div>
  </div>
</div>

<!--SAMPEL DIALOG-->
<div id="sampel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>


      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="input-group mb-3">
              <input type="text" name="token" class="form-control" placeholder="Masukan Token Anda" required>
            </div>

        </div>

        <div class="modal-footer">
          <button type="reset" class="btn btn-danger" data-dismiss="modal">BATAL</button>
          <input type="submit" class="btn btn-success" name="masuk2" id="tambah" value="LOGIN">
        </div>
        </form>



    </div>
  </div>
</div>

<div id="antri" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">&times;</button>
      </div>


      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="input-group mb-3">
              <input type="text" name="token" class="form-control" placeholder="Masukan Token Anda" required>
            </div>

        </div>

        <div class="modal-footer">
          <button type="reset" class="btn btn-danger" data-dismiss="modal">BATAL</button>
          <input type="submit" class="btn btn-success" name="masuk3" id="tambah" value="LOGIN">
        </div>
        </form>



    </div>
  </div>
</div>



<div class="copyright">
  <p align="center">Copyright @ 2021 | PMI KOTA SURAKARTA</p>
</div>
<?php mysqli_close(); ?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
