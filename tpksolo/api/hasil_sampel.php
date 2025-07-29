<?php
  require_once('adm/config.php');

  $today=date('Y-m-d');
  $today1=$today;

  if (isset($_POST['namadonor'])) {$namadonor=$_POST['namadonor'];}
  if (isset($_POST['tgl1'])) {$today=$_POST['tgl1'];$today1=$today;}
  if ($_POST['tgl2']!='') $today1=$_POST['tgl2'];
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

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <div class="box" align="center">
  </div>

  <?php
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "localhost/tpksolo/?page=apisampel",
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
  //echo $namadonor;
  //echo $today;
  //echo $today1;
  //echo 'Count Data :'.count($data).'<br>';
  ?>
  <div class="row" align="center">
    <div class="col-lg-12">
      <h4><font color="black"><b>DATA PEMERIKSAAN DARAH PMI KOTA SURAKARTA</b></font></h4><br>
    </div>
  </div>
  <div class="col-12 col-sm-12">
  <div class="card-body">
  <div class="tab-content" id="custom-tabs-one-tabContent">
  <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
  <div class="table-responsive">
  <div class="awesomeText">
       <table>
         <form method=post>
         <tr>
           <td class="input"><h6>TGl. SAMPEL : </h6></td>
           <td class="input"><input type="text" name="tgl1" id="datepicker" style="width:4cm;height:0.75cm" value="<?php echo $today;?>"></td>
           <td> S/D </td>
           <td class="input"><input type="text" name="tgl2" id="datepicker2" value="<?php echo $today1;?>" style="width:4cm;height:0.75cm">

            <td class="input"><h6>NAMA DONOR : </h6></td>
            <td class="input"><input type="text" name="namadonor" style="width:4cm;height:0.75cm"></td>
            <td><input type="submit" class="btn btn-success btn-block" value="CARI"></td>
            </form>
            <td><a href="?page=index"><button type="submit" name="cari" class="btn btn-danger btn-block">KEMBALI</button></td>
          <tr>

         </table>
<?php
  echo '

           </div>
      			<table class="table table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Sampel</th>
                <th>Nama Pendonor</th>
                <th>Nomor Sampel</th>
                <th>Gol. Darah</th>
                <th>No. Telp</th>
                <th>Tempat Pengambilan</th>
                <th>Status Sampel</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>';
    for($a=0; $a < count($data['data']); $a++){
      $no=$a+1;
      $chkdata=strlen($data['data'][$a]['Nama']);
      if ($chkdata>0){
        $noform = $data['data'][$a]['sk_kode'];
        echo  "<tr>";
        echo  "<td class='text-right' nowrap>".$no.".</td>";
        echo  "<td>".$data['data'][$a]['sk_tgl_plebotomi']."</td>";
        echo  "<td>".$data['data'][$a]['Nama']."</td>";
        echo  "<td>".$data['data'][$a]['sk_kode']."</td>";
        echo  "<td>".$data['data'][$a]['sk_gol'].' / '.$data['data'][$a]['sk_rh']."</td>";
        echo  "<td>". substr($data['data'][$a]['telp2'], 0, -5).'xxxxx'."</td>";
        echo  "<td>".$data['data'][$a]['sk_tmp_plebotomi']."</td>";
        echo  "<td>".$data['data'][$a]['hasil']."</td>";
        echo  "<td><a href='?page=sampeldnr&form=". $data['data'][$a]['sk_kode']."'><input type='button' class='btn btn-danger btn-block' value='DETAIL'></a></td>";



        echo  "</tr>";
      }
     }
     if ($no=='0'){
        echo '<tr>';
        echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data pendaftaran </td>';
        echo '</tr>';
     }
     echo '</tbody>
     </table>
     </div>
     </div>
     </div>
     </div>
     </div>';
  ?>




<!-- /.content-box -->



<div class="copyright">
  <p align="center">Copyright @ 2021 | PMI KOTA SURAKARTA</p>
</div>

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
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>


</body>
</html>
