<?php
  require_once('tpksolo/adm/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PLASMA KONVALESEN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../tpksolo/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../tpksolo/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../tpksoloplugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../tpksolo/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../tpksolo/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../tpksolo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../tpksolo/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../tpksolo/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../tpksolo/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<style>
.box{

	height: 50px;
	padding: 20px;
}
.box2{

	height: 25px;
	padding: 20px;
}
.copyright{
		bottom: 0;
    width: 100%;
    position: fixed;
    height:40px;
    line-height:50px;
    background:RED;
    color:#fff;
    padding-left: 10px;
  }
  .input-tanggal{
	padding: 10px;
	font-size: 14pt;
}
</style>
<body>


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../tpksolo/dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <div class="box" align="center">
  </div>

  <?php
  
  //echo $namadonor;
  //echo 'Count Data :'.count($data).'<br>';
  ?>
  <div class="row" align="center">
    <div class="col-lg-12">
      <h4><font color="black"><b>DATA ANTRIAN PERMINTAAN PERMINTAAN DARAH</font></h4><br>
    </div>
  </div>
  <div class="col-12 col-sm-12">
  <div class="card-body">
  <div class="tab-content" id="custom-tabs-one-tabContent">
  <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
  <div class="table-responsive">
  <div class="awesomeText">

  <div class="row">
    <div class="col-12 col-sm-12">
      <!--div class="col-3 col-sm-3">
        <a href="?page=frontmintapk"><button type="submit" name="cari" class="btn btn-success btn-block">KEMBALI</button>
      </div-->
<p>
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#gola" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">GOLONGAN DARAH A</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#golb" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">GOLONGAN DARAH B</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#golo" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">GOLONGAN DARAH O</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#golab" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">GOLONGAN DARAH AB</a>
            </li>

          </ul>
        </div> 
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="gola" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <!--************************************cari data pasien-->
            <?php
             $curl = curl_init();
             curl_setopt_array($curl, array(
               CURLOPT_URL => "localhost/tpksolo/?page=apimintapkgol",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => array('nama' => $namadonor, 'tgl1' => $today, 'tgl2' => $today1),
             ));
             $response = curl_exec($curl);
             curl_close($curl);
             //echo $response;
             $tgl= date("Y/m/d");
             $data = json_decode($response, true);
             $count = count($data['data']);

             echo '
           <p>
            <h6><b><font color="red"> TERDAPAT '.$count.' ANTRIAN PERMINTAAN</font></b></h6>
      			<table class="table table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Registrasi</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Gol. Darah</th>
                <th>Rumah Sakit</th>
                <th>Bagian</th>
                <th>Permintaan Produk</th>
                <th>Sampel Darah Pasien</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>';
    for($a=0; $a < count($data['data']); $a++){
      $no=$a+1;
      $chkdata=strlen($data['data'][$a]['nama']);
      if ($chkdata>0){
        if ($data['data'][$a]['kelamin']=='L'){$kelamin="Laki-laki";}else{$kelamin="Perempuan";}
        
        $noform = $data['data'][$a]['noform'];
        echo  "<tr>";
        echo  "<td class='text-right' nowrap>".$no.".</td>";
        echo  "<td>".$data['data'][$a]['tgl_register']."</td>";
        echo  "<td>".$data['data'][$a]['nama']."</td>";
        echo  "<td>".$kelamin."</td>";
        echo  "<td>".$data['data'][$a]['gol_darah'].' / '.$data['data'][$a]['rhesus']."</td>";
        echo  "<td>".$data['data'][$a]['NamaRs']."</td>";
        echo  "<td>".$data['data'][$a]['bagian']."</td>";
        echo  "<td>".$data['data'][$a]['JenisDarah']."</td>";
        echo  "<td>".$data['data'][$a]['sampel']."</td>";?>
        <td><a href="?module=pasienpmi&form=<?php echo $data['data'][$a]['noform'];?>"><input type="button" class="btn btn-success btn-block" value="DETAIL"></a><br><a href="?module=batalkan&form=<?php echo $data['data'][$a]['noform'];?>"><input type="button" class="btn btn-danger btn-block" value="BATAL"></a></td>






<?php
      echo  "</tr>";
      }
     }
     if ($no=='0'){
        echo '<tr>';
        echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data pasien </td>';
        echo '</tr>';
         ?>


<?php
     }
     echo '</tbody>
     </table>
     ';
             ?>
            </div>
            <div class="tab-pane fade" id="golb" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <!--************************************cari data pasien-->
              <?php
             $curl = curl_init();
             curl_setopt_array($curl, array(
               CURLOPT_URL => "localhost/tpksolo/?page=apimintapkgolb",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => array('nama' => $namadonor, 'tgl1' => $today, 'tgl2' => $today1),
             ));
             $response = curl_exec($curl);
             curl_close($curl);
             //echo $response;
             $tgl= date("Y/m/d");
             $data = json_decode($response, true);
             $count = count($data['data']);

             echo '
           <p>
            <h6><b><font color="red"> TERDAPAT '.$count.' ANTRIAN PERMINTAAN</font></b></h6>
      			<table class="table table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Registrasi</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Gol. Darah</th>
                <th>Rumah Sakit</th>
                <th>Bagian</th>
                <th>Permintaan Produk</th>
                <th>Sampel Darah Pasien</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>';
    for($a=0; $a < count($data['data']); $a++){
      $no=$a+1;
      $chkdata=strlen($data['data'][$a]['nama']);
      if ($chkdata>0){
        if ($data['data'][$a]['kelamin']=='L'){$kelamin="Laki-laki";}else{$kelamin="Perempuan";}
        $noform = $data['data'][$a]['noform'];
        echo  "<tr>";
        echo  "<td class='text-right' nowrap>".$no.".</td>";
        echo  "<td>".$data['data'][$a]['tgl_register']."</td>";
        echo  "<td>".$data['data'][$a]['nama']."</td>";
        echo  "<td>".$data['data'][$a]['kelamin']."</td>";
        echo  "<td>".$data['data'][$a]['gol_darah'].' / '.$data['data'][$a]['rhesus']."</td>";
        echo  "<td>".$data['data'][$a]['NamaRs']."</td>";
        echo  "<td>".$data['data'][$a]['bagian']."</td>";
        echo  "<td>".$data['data'][$a]['JenisDarah']."</td>";
        echo  "<td>".$data['data'][$a]['sampel']."</td>";
        echo  "<td><a href='?module=pasienpmi&form=". $data['data'][$a]['noform']."'><input type='button' class='btn btn-success btn-block' value='DETAIL'></a><br><a href='#'><input type='button' class='btn btn-danger btn-block' value='BATAL'></a></td>";



        echo  "</tr>";
      }
     }
     if ($no=='0'){
        echo '<tr>';
        echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data pasien </td>';
        echo '</tr>';
     }
     echo '</tbody>
     </table>
     ';
             ?>
            </div>
            <div class="tab-pane fade" id="golo" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <!--************************************cari data pasien-->
              <?php
             $curl = curl_init();
             curl_setopt_array($curl, array(
               CURLOPT_URL => "localhost/tpksolo/?page=apimintapkgolo",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => array('nama' => $namadonor, 'tgl1' => $today, 'tgl2' => $today1),
             ));
             $response = curl_exec($curl);
             curl_close($curl);
             //echo $response;
             $tgl= date("Y/m/d");
             $data = json_decode($response, true);
             $count = count($data['data']);

             echo '
           <p>
            <h6><b><font color="red"> TERDAPAT '.$count.' ANTRIAN PERMINTAAN</font></b></h6>
      			<table class="table table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Registrasi</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Gol. Darah</th>
                <th>Rumah Sakit</th>
                <th>Bagian</th>
                <th>Permintaan Produk</th>
                <th>Sampel Darah Pasien</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>';
    for($a=0; $a < count($data['data']); $a++){
      $no=$a+1;
      $chkdata=strlen($data['data'][$a]['nama']);
      if ($chkdata>0){
        if ($data['data'][$a]['kelamin']=='L'){$kelamin="Laki-laki";}else{$kelamin="Perempuan";}
        $noform = $data['data'][$a]['noform'];
        echo  "<tr>";
        echo  "<td class='text-right' nowrap>".$no.".</td>";
        echo  "<td>".$data['data'][$a]['tgl_register']."</td>";
        echo  "<td>".$data['data'][$a]['nama']."</td>";
        echo  "<td>".$data['data'][$a]['kelamin']."</td>";
        echo  "<td>".$data['data'][$a]['gol_darah'].' / '.$data['data'][$a]['rhesus']."</td>";
        echo  "<td>".$data['data'][$a]['NamaRs']."</td>";
        echo  "<td>".$data['data'][$a]['bagian']."</td>";
        echo  "<td>".$data['data'][$a]['JenisDarah']."</td>";
        echo  "<td>".$data['data'][$a]['sampel']."</td>";
        echo  "<td><a href='?module=pasienpmi&form=". $data['data'][$a]['noform']."'><input type='button' class='btn btn-success btn-block' value='DETAIL'></a><br><a href='#'><input type='button' class='btn btn-danger btn-block' value='BATAL'></a></td>";



        echo  "</tr>";
      }
     }
     if ($no=='0'){
        echo '<tr>';
        echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data pasien </td>';
        echo '</tr>';
     }
     echo '</tbody>
     </table>
     ';
             ?>
            </div>
            <div class="tab-pane fade" id="golab" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <!--************************************cari data pasien-->
              <?php
             $curl = curl_init();
             curl_setopt_array($curl, array(
               CURLOPT_URL => "localhost/tpksolo/?page=apimintapkgolab",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => "",
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => array('nama' => $namadonor, 'tgl1' => $today, 'tgl2' => $today1),
             ));
             $response = curl_exec($curl);
             curl_close($curl);
             //echo $response;
             $tgl= date("Y/m/d");
             $data = json_decode($response, true);
             $count = count($data['data']);

             echo '
           <p>
            <h6><b><font color="red"> TERDAPAT '.$count.' ANTRIAN PERMINTAAN</font></b></h6>
      			<table class="table table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Registrasi</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Gol. Darah</th>
                <th>Rumah Sakit</th>
                <th>Bagian</th>
                <th>Permintaan Produk</th>
                <th>Sampel Darah Pasien</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>';
    for($a=0; $a < count($data['data']); $a++){
      $no=$a+1;
      $chkdata=strlen($data['data'][$a]['nama']);
      if ($chkdata>0){
        if ($data['data'][$a]['kelamin']=='L'){$kelamin="Laki-laki";}else{$kelamin="Perempuan";}
        $noform = $data['data'][$a]['noform'];
        echo  "<tr>";
        echo  "<td class='text-right' nowrap>".$no.".</td>";
        echo  "<td>".$data['data'][$a]['tgl_register']."</td>";
        echo  "<td>".$data['data'][$a]['nama']."</td>";
        echo  "<td>".$data['data'][$a]['kelamin']."</td>";
        echo  "<td>".$data['data'][$a]['gol_darah'].' / '.$data['data'][$a]['rhesus']."</td>";
        echo  "<td>".$data['data'][$a]['NamaRs']."</td>";
        echo  "<td>".$data['data'][$a]['bagian']."</td>";
        echo  "<td>".$data['data'][$a]['JenisDarah']."</td>";
        echo  "<td>".$data['data'][$a]['sampel']."</td>";
        echo  "<td><a href='?module=pasienpmi&form=". $data['data'][$a]['noform']."'><input type='button' class='btn btn-success btn-block' value='DETAIL'></a><br><a href='#'><input type='button' class='btn btn-danger btn-block' value='BATAL'></a></td>";



        echo  "</tr>";
      }
     }
     if ($no=='0'){
        echo '<tr>';
        echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data pasien </td>';
        echo '</tr>';
     }
     echo '</tbody>
     </table>
     ';
             ?>
            </div>
          </div>
        </div>
<!--************************************cari data pasien-->

<!--SAMPEL DIALOG-->
<div id="hapus" class="modal fade" role="dialog">
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



<!-- /.content-box -->



<!--div class="copyright">
  <p align="center">Copyright @ 2021 | PMI KOTA SURAKARTA</p>
</div-->

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  $("#datepicker").datepicker({
		 dateFormat:"yy-mm-dd",
	  });
} );
</script>
<script>
$( function() {
  $("#datepicker2").datepicker({
		 dateFormat:"yy-mm-dd",
	  });
} );
</script>
<!-- Bootstrap 4 -->
<script src="../tpksolo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../tpksolo/dist/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="../tpksoloplugins/jquery/jquery.min.js"></script>

</body>
</html>
