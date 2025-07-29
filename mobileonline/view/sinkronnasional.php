<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    include '../adm/config.php';
    $id = $_SESSION['instansi'];
    $unit = $_SESSION['unit'];
    $user = $_SESSION['user'];
    if ($unit=="" || $id===""){
        header("location: ?page=index");
    } else {
   
    $no='0';
    $Kodep = $_GET['Kode'];
    
    $udd = mysqli_fetch_assoc(mysqli_query($con,"select id from utd where aktif='1'"));
    $idudd=$udd['id'];
        
    //CARI PENDONOR LOKAL
    $lokal = mysqli_fetch_assoc(mysqli_query($con,"select * from pendonor where Kode='$Kodep'"));
    
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

  <link rel="stylesheet" href="code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css" title="currentStyle">
            @import "./../css/dt_page.css";
            @import "./../css/dt_table.css";
            @import "./../css/dt_table_jui.css";
        </style>
        <link type="text/css" href="../../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <link type="text/css" href="./../css/TableTools_JUI.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="./../js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="./../js/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="./../js/jquery.dataTables.js"></script>





</head>

<style>
.body{
    font-size:12px;
}
.padding {
    
    background-image: url('dist/img/white.jpg');
    background-size: cover;
}
.box{

    height: 25px;
    padding: 20px;
}
.box2{

    height: 25px;
    padding: 20px;
}
.box3{

    height: 100px;
    
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
<body class="padding">


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../tpksolo/dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <p class="box">

  <div class="row" align="center">
    <div class="col-lg-12">
      <h4><font color="black"><b>SINKRON DATA PENDONOR</font></b></h4>
<a href="?page=dash"><button name="baru" class="btn btn-info float-right"><i class="nav-icon ion ion-android-arrow-back"></i>  Kembali</button></a>
    </div>
  </div>
  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->
<div class="row">
  <div class="col-lg-6">

    <h3> Data Server Simdondar</H3>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-condensed" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
            <tr>
            <td nowrap>Kode Pendonor </td> <td nowrap><b><?php echo $lokal['Kode'];?></b></td>
            </tr>
            <tr>
            <td nowrap>No. KTP</td> <td nowrap><?php echo $lokal['NoKTP'];?></td>
            </tr>
            <tr>
            <td nowrap>Nama Pendonor </td> <td nowrap><?php echo $lokal['Nama'];?></td>
            </tr>
            <tr>
            <?php if($lokal['Jk']=="0"){$jk="Laki-Laki";}else{$jk="Perempuan";}?>
            <td nowrap>Jenis Kelamin</td> <td nowrap><?php  echo $jk;?></td>
            </tr>
            <tr>
            <td nowrap>Tanggal Lahir</td> <td nowrap><?php echo $lokal['TempatLhr'].", ".$lokal['TglLhr'];?></td>
            </tr>
            <tr>
            <td nowrap>Alamat</td> <td nowrap><?php echo $lokal['Alamat']." ".$lokal['kelurahan']." ".$lokal['kecamatan']." ".$lokal['wilayah'];?></td>
            </tr>
            <tr>
            <td nowrap>No. HP</td> <td nowrap><?php echo $lokal['telp2'];?></td>
            </tr>
            <tr>
            <?php if($lokal['Status']=="0"){$st="Belum Menikah";}else{$st="Sudah Menikah";}?>
            <td nowrap>Status</td> <td nowrap><?php echo $st;?></td>
            </tr>
            <tr>
            <td nowrap>Gol. Darah</td> <td nowrap><?php echo $lokal['GolDarah']." (".$lokal['Rhesus'].")";?></td>
            </tr>
            <tr>
            <td nowrap><b>Jumlah Donor</b></td> <td nowrap><b><?php echo $lokal['jumDonor'];?></b></td>
            </tr>
<tr>
<td nowrap><b>Kembali Donor</b></td> <td nowrap><b><?php echo $lokal['tglkembali'];?></b></td>
</tr>
<tr>
<?php if($lokal['Cekal']=="0"){$ck="-";}else{$ck="Cekal";}?>
<td nowrap><b>Status IMLTD</b></td> <td nowrap><b><?php echo $ck;?></b></td>
</tr>
            
        </table>
    </div>
  </div>
  <div class="col-lg-6">
<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/getcomparependonor.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('udd' => $idudd, 'kode' => $Kodep),
));
$response = curl_exec($curl);
curl_close($curl);
//echo $response;
$tgl= date("Y/m/d");
$data = json_decode($response, true);
//echo var_dump($data);
//echo 'Count Data :'.count($data).'<br>';



echo '
    <h3> Data Server Nasional</H3>
<div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">';
  for($a=0; $a < count($data['data']); $a++){
    $no=$a+1;
    $chkdata=strlen($data['data'][$a]['pkode']);
    if ($chkdata>0){
      if ($data['data'][$a]['pjk']=='0'){$kelamin="Laki-laki";}else{$kelamin="Perempuan";}
      if ($data['data'][$a]['pcekal']=='0'){$cekal="-";}else{$cekal="Konfirm";}
      if ($data['data'][$a]['pstatus']=='0'){$st="Belum Menikah";}else{$st="Sudah Menikah";}
      
      
          echo  "<tr>";
          echo  "<td nowrap>Kode Pendonor </td> <td nowrap><b>".$data['data'][$a]['pkode']."</b></td>";
          echo  "</tr>";
          echo  "<tr>";
          echo  "<td nowrap>No. KTP</td> <td nowrap>".$data['data'][$a]['pnoktp']."</td>";
          echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Nama Pendonor </td> <td nowrap>".$data['data'][$a]['pnama']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Jenis Kelamin </td> <td nowrap>".$kelamin."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Tanggal Lahir</td> <td nowrap>".$data['data'][$a]['ptempatlahir'].", ".$data['data'][$a]['ptgllahir']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Alamat </td> <td nowrap>".$data['data'][$a]['palamat']."  ".$data['data'][$a]['pkelurahan']."  ".$data['data'][$a]['pkecamatan']."  ".$data['data'][$a]['pwilayah']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>No. HP</td> <td nowrap>".$data['data'][$a]['ptelp2']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Status</td> <td nowrap>".$st."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Gol. Darah</td> <td nowrap>".$data['data'][$a]['pgoldarah']." (".$data['data'][$a]['prhesus'].")</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap><b>Jumlah Donor</td> <td nowrap><b>".$data['data'][$a]['pjmldonor']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap><b>Kembali Donor</td> <td nowrap><b>".$data['data'][$a]['ptglkembali']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap><b>Status IMLTD</td> <td nowrap><b>".$cekal."</td>";
        echo  "</tr>";
        
    }
   }
   if ($no=='0'){
      echo '<tr>';
      echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data Pendonor Nasional</td>';
      echo '</tr>';
   }
   echo '</tbody>
   </table>
   </div>';
?>

</div>
</div>
<!--form-->
<form method="POST">
<div class="row">
    <div class="col-lg-4" align="right">
            <?php
                //VARIABLE Jumlah Donor
                    $jmAD = $data['data'][0]['pjmldonor'];
                    $jmLK = $lokal['jumDonor'];
                    $nohp = $data['data'][0]['ptelp2'];
                    //echo "Jumlah donor ===>".$jmAD." : ".$jmLK;
                    if ($jmAD ==""){$new = "1";}else{$new = "0";}
                //echo $new;
                if (($new=="1") || ($jmAD != $jmLK) || ($nohp=="")|| ($nohp=="-")){?>
            <input type="submit" class="btn btn-danger " value="Sinkron | Data Nasional" name="submit" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
                <?php } ?>

    </div>
    <div class="col-lg-8">
            
    </div>
</div>

<p>
</form>
<?php
    if (isset($_POST['submit'])) {
        // Var Lokal
        $iddonor    = $lokal['Kode'];
        $noktp      = $lokal['NoKTP'];
        $nama       = $lokal['Nama'];
        $alamat     = $lokal['Alamat'];
        $jk         = $lokal['Jk'];
        $pekerjaan  = $lokal['Pekerjaan'];
        $tmptlahir  = $lokal['TempatLhr'];
        $tgllahir   = $lokal['TglLhr'];
        $status     = $lokal['Status'];
        $kelurahan  = $lokal['kelurahan'];
        $kecamatan  = $lokal['kecamatan'];
        $wilayah    = $lokal['wilayah'];
        $telp2      = $lokal['telp2'];
        $gol        = $lokal['GolDarah'];
        $rh         = $lokal['Rhesus'];
        $jumdonor   = $lokal['jumDonor'];
        $call       = $lokal['Call'];
        $cekal      = $lokal['Cekal'];
        $tglkembali = $lokal['tglkembali'];
        $umur       = $lokal['umur'];
        
        // Var dbdonor.pmi.or.id (PMI PUSAT)
        $iddonorO    = $data['data'][0]['pkode'];
        $noktpO      = $data['data'][0]['pnoktp'];
        $namaO       = $data['data'][0]['pnama'];
        $alamatO     = $data['data'][0]['palamat'];
        $jkO         = $data['data'][0]['pjk'];
        $pekerjaanO  = $data['data'][0]['ppekerjaan'];
        $tmptlahirO  = $data['data'][0]['ptempatlahir'];
        $tgllahirO   = $data['data'][0]['ptgllahir'];
        $statusO     = $data['data'][0]['pstatus'];
        $kelurahanO  = $data['data'][0]['pkelurahan'];
        $kecamatanO  = $data['data'][0]['pkecamatan'];
        $wilayahO    = $data['data'][0]['pwilayah'];
        $telp2O      = $data['data'][0]['ptelp2'];
        $golO        = $data['data'][0]['pgoldarah'];
        $rhO         = $data['data'][0]['prhesus'];
        $jumdonorO   = $data['data'][0]['pjmldonor'];
        $callO       = $data['data'][0]['pcall'];
        $cekalO      = $data['data'][0]['pcekal'];
        $tglkembaliO = $data['data'][0]['ptglkembali'];
        $umurO       = $data['data'][0]['pumur'];
        
        //jika jumlah donor = 0 ==> insert API
        if ($new == "1"){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/simdondar/insertpendonor.php",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('idudd' => $idudd, 'Kode' => $iddonor, 'NoKTP' => $noktp, 'Nama' => $nama, 'Alamat' => $alamat, 'Jk' => $jk, 'Pekerjaan' => $pekerjaan, 'TempatLhr' => $tmptlahir, 'TglLhr' => $tgllahir, 'Status' => $status, 'kelurahan' => $kelurahan, 'kecamatan' => $kecamatan, 'wilayah' => $wilayah, 'telp2' => $telp2,  'GolDarah' => $gol, 'Rhesus' => $rh, 'jumDonor' => $jumdonor, 'Call' => $call, 'Cekal' => $cekal, 'tglkembali' => $tglkembali, 'umur' => $umur, 'metode' => 'insert' ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            //echo $response;
            $tgl= date("Y/m/d");
            $respon = json_decode($response, true);
            
        } else if (($jmLK > $jmAD) || ($telp2O =="")){
            //jika jumlah donor lokal > jumlah donor nasional
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/simdondar/insertpendonor.php",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => array('idudd' => $idudd, 'Kode' => $iddonor, 'NoKTP' => $noktp, 'Nama' => $nama, 'Alamat' => $alamat, 'Jk' => $jk, 'Pekerjaan' => $pekerjaan, 'TempatLhr' => $tmptlahir, 'TglLhr' => $tgllahir, 'Status' => $status, 'kelurahan' => $kelurahan, 'kecamatan' => $kecamatan, 'wilayah' => $wilayah, 'telp2' => $telp2,  'GolDarah' => $gol, 'Rhesus' => $rh, 'jumDonor' => $jumdonor, 'Call' => $call, 'Cekal' => $cekal, 'tglkembali' => $tglkembali, 'umur' => $umur, 'metode' => 'update' ),
            ));
            
            
            
            
            $response = curl_exec($curl);
            curl_close($curl);
            //echo $response;
            $tgl= date("Y/m/d");
            $respon = json_decode($response, true);
            } else if ($jmAD > $jmLK){
                //jika jumlah donor nasional > jumlah donor lokal
                $up = "UPDATE pendonor set NoKTP='$noktpO', Nama='$namaO', Alamat='$alamatO',Jk='$jkO',Pekerjaan='$pekerjaanO',TempatLhr='$tmptlahirO',TglLhr='$tgllahirO',Status='$statusO',GolDarah='$golO',Rhesus='$rhO',`Call`='$callO',Cekal='$cekalO',kelurahan='$kelurahanO',kecamatan='$kecamatanO',wilayah='$wilayahO',jumDonor='$jumdonorO',telp2='$telp2O',umur='$umurO',tglkembali='$tglkembaliO' where Kode = '$iddonorO'";
                //echo $up;
                $qUP = mysqli_query($con,$up);
                }
            
        ?>
        <META http-equiv="refresh" content="0; url=?page=dash">
    <?php
        
        }
        
?>
<!--form-->




<!--content-->
    </div>
  </div>


<p class="box3">
<div class="copyright">
    <p align="center"><a href="https://pmi.or.id"><font style="color:white">Copyright @ 2022 | PALANG MERAH INDONESIA</a>
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
<script src="../tpksolo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../tpksolo/dist/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="../tpksoloplugins/jquery/jquery.min.js"></script>

</body>
</html>

<?php } ?>
