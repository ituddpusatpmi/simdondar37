
<?php
  //session_start();
  error_reporting (E_ALL ^ E_NOTICE);
  include '../adm/config.php';

  if ($_SESSION['ipserver']==''){?>
    <META http-equiv="refresh" content="0; url=index.php">
    <?php
  }

  $namautd            = mysqli_fetch_assoc(mysqli_query($con,"SELECT id,nama,alamat,daerah,telp from utd where aktif='1' limit 1"));
  $utd                = strtoupper($namautd['nama']);
  $_SESSION['idudd']  = $namautd['id'];
  $ip	              	= $_SESSION['ipserver'];

  //UPLOAD VIDEO
  if (isset($_POST['upload'])){
    $name=$_FILES['file_video']['name'];
    $type=$_FILES['file_video']['type'];
    $size=$_FILES['file_video']['size'];
    $nama_file=str_replace(" ","_","video1.mp4");
    $tmp_name=$_FILES['file_video']['tmp_name'];
    $nama_folder="../display/video/";
    $file_baru=$nama_folder.basename($nama_file);
    if ((($type == "video/mp4") || ($type == "video/3gpp")) && ($size < 8000000 )){
       move_uploaded_file($tmp_name,$file_baru);
       $pesan="Upload file video $nama_file berhasil diupload";
    }
    else{
        $pesan="File Video Terlalu Besar Atau Format Video Salah!";
    }
    echo "<p style='color:green;'>$pesan</p>";
}
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
  <link rel="stylesheet" href="../../tpksolo/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../tpksolo/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../tpksolo/dist/css/adminlte.min.css">
  <!--PMI STYLE-->
  <link rel="stylesheet" href="../../tpksolo/dist/css/bspmi.css">
  <link rel="shortcut icon" href="../../tpksolo/dist/img/simdondar.ico">
</head>
<style type="text/css">
    .padding {
        
        background-image: url('../../tpksolo/dist/img/registrasi.png');
        background-size: cover;
        font-size: 14px;
    }
    .box{
      height: 50px;
      padding-left: 10px;
      padding-right: 10px;  
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
    <font style="font-size: 18px;"><b><u><?php echo $utd;?></u></b></font><br>
    <?php echo $namautd['alamat'].', '.$namautd['daerah'];?><br>
    Telp. <?php echo $namautd['telp'];?><br>
</div>

<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../tpksolo/dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <div class="box"></div>
  <div class="box">
  
  <!-- Contennt-->
  <p id="spasi2">
  <div class="row">
        	

          <div class="col-lg-4 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div >
              <img src="../../tpksolo/dist/img/monitor.png" width="75">
              </div><p>
              <h3>DISPLAY TV MONITOR</h3>
              <p class="mb-4">Halaman untuk menampilkan nomor antrian dan informasi UDD PMI
              <form enctype="multipart/form-data" method="post">
                  <input type="file" name="file_video" >
                  <input type="submit" name="upload" value="Upload Video" >
                </form>  <br>           
                <button  onclick="monitor()" class="btn btn-danger rounded-pill px-4 py-2"  >Tampilkan</button>
              </a>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div >
              <img src="../../tpksolo/dist/img/web.png" width="75">
              </div><p>
              <h3>REGISTRASI DONOR DARAH</h3>
              <p class="mb-4">Halaman registrasi digunakan pendonor untuk mendaftarkan donor darah dan mengambil nomor antrian.<p><p>
              <br>      
              <a href="donordarah.php"><button  class="btn btn-success rounded-pill px-4 py-2"  >Tampilkan</button>
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <div >
              <img src="../../tpksolo/dist/img/volume.png" width="75">
              </div><p>
              <h3>PEMANGGIL ANTRIAN</h3>
              <p class="mb-4">Halaman digunakan administrator untuk memanggil antrian pendonor yang sudah terdaftar.<p><p>
              <br>      
              <a href="panggilantrian.php"><button  class="btn btn-dark rounded-pill px-4 py-2"  >Tampilkan</button>
              </a>
            </div>
          </div>
        </div>

          
  </div>

  <p >
  <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4" align="center">
        
        
        
        <a href="logout.php"><button  class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" >KELUAR AKUN</button></a>
        
      </div>
      <div class="col-lg-4"></div>
  </div>

  <!-- Content -->
  </div>
  <div class="copyright">
      <p align="center"><a href="https://pmi.or.id"><font style="color:white">Copyright @ 2021 | PALANG MERAH INDONESIA</a>
  </div>



  <!-- jQuery -->
  <script src="../../tpksolo/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../tpksolo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../tpksolo/dist/js/adminlte.min.js"></script>
  <script>
      function monitor() {
        window.open("../display/");
      }
  </script>
  </body>
  </html>
