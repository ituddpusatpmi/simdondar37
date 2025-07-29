<?php
    
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
  include '../adm/config.php';
  //session_destroy();
    
    //Tambahan fungsi untuk mencari ip client
    function getIP() {
      $ip;
      if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
      else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
      else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
      else
        $ip = "UNKNOWN";
      return $ip;
    }
    //end of function
    $client_ip    =getIP();

  //CARI USER & PASSWORD
  if(isset($_POST['cari'])) {
    if ($_POST["vercode"] != $_SESSION["vercode"])  {
       
        //=======Audit Trial====================================================================================
        $log_mdl = 'Login';
        $log_aksi= 'User Gagal masuk SIMDONDAR';
        $log= mysqli_query($con, "INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`,`tempat`, `keterangan`) VALUES
                           ('$client_ip', '$_POST[user]', '$log_mdl', '$log_aksi','$_POST[namaunit]', '')");
        //=====================================================================================================
       echo "<script>alert('Kode Captcha Salah');</script>";
       mysqli_close;
                           
     }
    else {
     //cari login user
    $user = trim(mysqli_real_escape_string($con, $_POST['user']));
    $pass = md5($_POST['pass']);
    $sql  = "SELECT * FROM user WHERE `id_user` = '$user' AND `password`='$pass' limit 1";
    //echo $sql;
    $sql_cari = mysqli_query($con, "SELECT * FROM user WHERE `id_user` = '$user' AND `password`='$pass' limit 1") or die (mysql_error($con));
    if (mysqli_num_rows($sql_cari)>0) {
        $_SESSION['unit']     = $_POST['namaunit'];
        $_SESSION['user']     = $_POST['user'];
        $_SESSION['instansi'] = $_POST['instansi'];
        $_SESSION['client_ip']= $client_ip;
                           
        //=======Audit Trial====================================================================================
        $log_mdl = 'Login';
        $log_aksi= 'User Berhasil masuk SIMDONDAR';
        $log= mysqli_query($con, "INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`,`tempat`, `keterangan`) VALUES
        ('$client_ip', '$_POST[user]', '$log_mdl', '$log_aksi','$_POST[namaunit]', '')");
        //=====================================================================================================
                   
      header("location: ?page=dash");
        
    } else { ?>
        <div class="row">
            <div class="col-lg-12 col-lg-offset-3">
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <strong>Login Gagal</strong> Data Tidak Ada!!!
                </div>
            </div>
        </div>
<?php
        //=======Audit Trial====================================================================================
        $log_mdl = 'Login';
        $log_aksi= 'User Gagal masuk SIMDONDAR';
        $log= mysqli_query($con, "INSERT INTO `user_log` (`komputer`, `user`, `modul`, `aksi_user`,`tempat`, `keterangan`) VALUES
                           ('$client_ip', '$_POST[user]', '$log_mdl', '$log_aksi','$_POST[namaunit]', '')");
        //=====================================================================================================
}
//cari pasien
}

           }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMDONDAR</title>

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
  <!--PMI STYLE-->
  <link rel="stylesheet" href="dist/css/bspmi.css">
  <link rel="shortcut icon" href="dist/img/simdondar.ico">
  
</head>
<style>
  .padding {
        
        background-image: url('../dist/img/registrasi.png');
        background-size: cover;
    }
.box{

    height: 50px;
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
        <h4><b>MOBILEUNIT UDD PMI</b></h4>
      </div>
    </div>

<center>
<div class="login-box" align="left">
  <!-- /.login-logo -->
  <div id="wrapper">
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><b>Login</b></p>

      <form action="" method="post">

        <div class="input-group mb-3">
          <input type="text" name="user" class="form-control" placeholder="Nama User" autocomplete="off" required>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="off" required>
        </div>

        <div class="input-group mb-3">
        <select class="form-control form-control-md" name="namaunit" required>
        <option value="">-- PILIH NAMA UNIT--</option>
        <?php $unit = mysqli_query($con,"SELECT id1 from tempat_donor where id1 != 'DG'");
            while ($unitm = mysqli_fetch_array($unit)){?>
            <option value=<?php echo $unitm['id1'];?>><?php echo $unitm['id1'];?></option>
            <?php } ?>
          </select>
        </div>

        <div class="input-group mb-3">
        <select class="form-control form-control-md" name="instansi" required>
        <option value="">-- PILIH INSTANSI--</option>
        <?php $unit = mysqli_query($con,"SELECT * from v_webmu");
            while ($unitm = mysqli_fetch_array($unit)){?>
            <option value="<?php echo $unitm['kode'];?>"><?php echo $unitm['nama'];?></option>
            <?php } ?>
          </select>
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
        </div>
      </form>

  




    </div>
    <!-- /.login-card-body -->
  </div>
  
</div>
</div>




<div class="copyright">
  <p align="center">Copyright @ 2021 | UNIT DONOR DARAH PMI</p>
</div>
<!--?php mysqli_close() ?-->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript" >
   function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};
</script>
</body>
</html>
