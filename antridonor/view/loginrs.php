<?php
  require_once('adm/config.php');

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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
<body class="hold-transition login-page">
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <div class="row" align="center">
    <div class="col-lg-12">
        <img src="dist/img/logPMI.png" width="100px">
      </div>
    </div>
    <p>


<div class="login-box">
  <div align="center">
    <b></b>
  </div>
  <!-- /.login-logo -->
  <div id="wrapper">
    <?php
      if(isset($_POST['cari'])) {

                       if ($_POST["vercode"] != $_SESSION["vercode"])  {
                          echo "<script>alert('Kode Captcha Salah');</script>" ;

                          //mysql_close($con);
                        }
                       else {
                        //cari pasien
        $idrs = trim(mysqli_real_escape_string($con, $_POST['idrs']));
        $user = trim(mysqli_real_escape_string($con, $_POST['user']));
        $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));
        $sql_cari = mysqli_query($con, "SELECT * FROM rmhsakit WHERE `Kode` = '$idrs' AND `user`='$user' AND `pass`='$pass' limit 1") or die (mysql_error($con));
        if (mysqli_num_rows($sql_cari)>0) {
        //  echo "<script>alert('PASIEN ADA');</script>" ;
        //session_start();
          $_SESSION['RS'] = $idrs;
          $_SESSION['user'] = $user;
          header("location: ?page=rs");
          //echo "<script>window.location='".base_url()."'</script>";
        } else { ?>
          <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
              <div class="alert alert-danger alert-dismissable" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <strong>LOGIN GAGAL</strong> RS belum terdaftar!!!
              </div>

            </div>

          </div>
          <?php
        }
        //cari pasien
      }

                              }
    ?>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>Informasi Permintaan Darah</b></p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="idrs" class="form-control" placeholder="ID Rumah Sakit" required>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="user" class="form-control" placeholder="Nama User" required>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Password" required>
        </div>

        <div class="input-group mb-3">
              <span class="form-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
              <input type="text" class="form-control" name="vercode" placeholder="Ketik angka disamping" maxlength="5" autocomplete="off" required >
              <img src="pages/captcha.php">
          </div>

        <div class="row">

          <div class="col-12">
            <button type="submit" name="cari" class="btn btn-success btn-block">MASUK</button>

          </div>
          <!-- /.col -->
        </div>
      </form><br>

      <a href=?page=index><button type="submit" name="cari" class="btn btn-danger btn-block">BATAL</button></a>




    </div>
    <!-- /.login-card-body -->
  </div>
  
</div>
</div>
<!-- /.login-box -->
<div class="copyright">
  <p align="center">Copyright @ 2021 | PMI KOTA SURAKARTA</p>
</div>
<?php mysqli_close() ?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
