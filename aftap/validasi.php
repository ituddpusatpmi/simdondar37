
<?php
    session_start();
    include ('../config/dbi_connect.php');
    $td0=php_uname('n');
    $td0=strtoupper($td0);
    $td0=substr($td0,0,2);
    $nokantong  =   $_POST['kode'];
    $notrans    =   $_POST['trans'];
    $today1=date("Y-m-d H:i:s");
    $today2=date("Y-m-d");
    $jam_donor=date("H:i:s");
    $kursi = $_SESSION['bed'];
    $lengan = $_SESSION['lengan'];
    if ($kursi ==""){
       ?> <META http-equiv="refresh" content="0; url=../index.php"><?php
    }
    
    $query = "SELECT * from stokkantong where noKantong='$nokantong' AND `Status`='0' and StatTempat='1' and kadaluwarsa_ktg >'$today1' limit 1";
    
    //if (substr($td0,0,1)=='M')  $query = ("SELECT * FROM htransaksi where NoTrans like '$td0%' and Status='1' and jumHB='1' ");
    $hasil = mysqli_query($dbi,$query);
    $data  = mysqli_fetch_array($hasil);
    
    //Shift Petugas
    $shift  = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT nama,jam,sampai_jam FROM `shift` WHERE time(now()) between time(jam) AND time(sampai_jam)"));
    //$shif   = $shift['nama'];
    if ($shift['nama']=="I"){
      $shif   = "1";
    } else if ($shift['nama']=="II"){
      $shif   = "2";
    } else if ($shift['nama']=="III"){
      $shif   = "3";
    } else {
      $shif   = "4";
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
  <link rel="stylesheet" href="../tpksolo/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../tpksolo/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../tpksolo/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
    <!--PMI STYLE-->
    <link rel="stylesheet" href="../tpksolo/dist/css/bspmi.css">
  
  <link rel="stylesheet" href="../tpksolo/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css" title="currentStyle">
            @import "css/dt_page.css";
            @import "css/dt_table.css";
            @import "css/dt_table_jui.css";
        </style>
        <link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <link type="text/css" href="css/TableTools_JUI.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>


</head>

<style>
.body{
    font-size:12px;
}
.img-responsive {
    width: 100%;
    display:block;
    height: auto;
}
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

<img class="img-responsive" src="../tpksolo/dist/img/coorporatepmi.png" />

<div class="card-header">
<div align="center" style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">VALIDASI KANTONG DARAH</div>
  <!--a href="<?php echo $lvl;?>.php?module=donor_baru"><button name="baru" class="btn btn-warning float-right"><i class="nav-icon ion ion-ios-medkit"></i>  Donor Baru</button></a-->
</div>



  <div class="col-12 col-sm-12">
    <div class="card-body">
        <!--content OK -->
        <?php
            if(isset($_POST['cari'])) {
                $v_no1         = $_POST['no1'];
                $v_no2         = $_POST['no2'];
                $v_no3         = $_POST['no3'];
                $v_no4         = $_POST['no4'];
                $v_no5         = $_POST['no5'];
                $v_no6         = $_POST['no6'];
                $v_no7         = $_POST['no7'];
                $v_no8         = $_POST['no8'];
                $v_no9         = $_POST['no9'];
                $nokantong  =   $_POST['nokantong'];
                $notrans    =   $_POST['notrans'];
                $jkantong   =   $_POST['jenis'];
                $merk       =   $_POST['merk'];
                $shif       =   $_POST['shift'];
                $vol        =   $_POST['volume'];
                
                
                if (($v_no1=="1") AND  ($v_no2=="1") AND ($v_no3=="1") AND ($v_no4=="1") AND ($v_no5=="1") AND ($v_no6=="1") AND ($v_no7=="1") AND ($v_no8=="1") AND ($v_no9=="1")){
                    $cariktg = "SELECT * from ValidKantong where noKantong='$nokantong' limit 1";
                    $numktg  = mysqli_num_rows(mysqli_query($dbi,$cariktg));
                    
                    if ($numktg > 0){
                        $query = "UPDATE ValidKantong set v_1='1', v_2='1', v_3='1', v_4='1', v_5='1', v_6='1', v_7='1', v_8='1', v_9='1',keterangan='1',vol='$vol', shift='$shif' where noKantong='$nokantong'";
                        $exec = mysqli_query($dbi,$query);
                    } else {
                        $query = "INSERT INTO ValidKantong (noKantong, NoTrans, merk, jenis, v_1, v_2, v_3, v_4, v_5, v_6, v_7, v_8, v_9,keterangan,vol, shift) VALUES ('$nokantong','$notrans','$merk','$jkantong','1','1','1','1','1','1','1','1','1','1','$vol','$shif')";
                        $exec = mysqli_query($dbi,$query);
                    }
                    //echo $query;
                    //echo "ket = 1";
                    ?>
                <meta http-equiv="refresh" content="0; url=prosespengambilan.php?trans=<?php echo $notrans ?>&kantong=<?php echo $nokantong ?>">
                <?php
                } else{
                    $query = "INSERT INTO ValidKantong (noKantong, NoTrans, merk, jenis, v_1, v_2, v_3, v_4, v_5, v_6, v_7, v_8, v_9,keterangan,vol,shift) VALUES ('$nokantong','$notrans','$merk','$jkantong','$v_no1','$v_no2','$v_no3','$v_no4','$v_no5','$v_no6','$v_no7','$v_no8','$v_no9','0','$vol','$shif')";
                    $exec = mysqli_query($dbi,$query);
                    //echo $query;
                    //echo "ket = 1";
                    ?>
                    <div class="row" align="center">
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-dismissable" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <strong>Kantong Darah Tidak Lulus Validasi</strong><br>Masukan Nomor Kantong Berikutnya
                            </div>
                        </div>
                    </div>
                    <meta http-equiv="refresh" content="2; url=scankantong.php?trans=<?php echo $notrans ?>">
                    <?php
                }
            
            }
            
            
            if (mysqli_num_rows($hasil)>0) {?>
        <div class="row" align="center">
            <div class="col-lg-12">
            <!--row1--->
                    <?php
                        function switchvalue($asal){
                            if ($asal=="YA"||$asal=="1"){
                                return "checked";
                        }else{
                            return "";
                        }
                    }?>
                    <form action="" method="post">
                    <div class="row">
                                   <div class="col-lg-12">
                                        <h4>NO. KANTONG <?php echo $nokantong;?></h4>
                                       <div class="table-responsive" id="shadow1">
                                            <input type="hidden" name="nokantong" value=<?php echo $nokantong;?>>
                                            <input type="hidden" name="notrans" value=<?php echo $notrans;?>>
                                           <table class="diva">
                                               
                                               <tr><td width="30px">1.</td><td>Nomor Barcode Kantong identik dengan nomor selang</td>
                                                   <td><div class="onoffswitch">
                                                           <input type="hidden" name="no1" value="0">
                                                           <input type="checkbox" name="no1" class="onoffswitch-checkbox" id="no1" tabindex="1" value="1" >
                                                           <label class="onoffswitch-label" for="no1"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                   </div></td></tr>
                                               <tr><td width="30px">2.</td><td>Kantong Darah belum melewati tanggal kadaluwarsa</td>
                                                   <td><div class="onoffswitch">
                                                           <input type="hidden" name="no2" value="0">
                                                           <input type="checkbox" name="no2" class="onoffswitch-checkbox" id="no2" tabindex="1" value="1" >
                                                           <label class="onoffswitch-label" for="no2"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                   </div></td></tr>
                                               
                                               <tr><td width="30px">3.</td><td>Tidak ada tanda kebocoran kantong dan selang</td>
                                                   <td><div class="onoffswitch">
                                                           <input type="hidden" name="no3" value="0">
                                                           <input type="checkbox" name="no3" class="onoffswitch-checkbox" id="no3" tabindex="1" value="1" >
                                                           <label class="onoffswitch-label" for="no3"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                   </div></td></tr>
                                               <tr><td width="30px">4.</td><td>Volume Antikoagulan cukup dan tidak keruh</td>
                                               <td><div class="onoffswitch">
                                                           <input type="hidden" name="no4" value="0">
                                                           <input type="checkbox" name="no4" class="onoffswitch-checkbox" id="no4" tabindex="1" value="1">
                                                           <label class="onoffswitch-label" for="no4"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                   </div></td></tr>
                                               
                                               <tr><td width="30px">5.</td><td>Selang dan Kantong darah tidak memiliki cacat fisik (terlipat, dll)</td>
                                               <td><div class="onoffswitch">
                                                           <input type="hidden" name="no5" value="0">
                                                           <input type="checkbox" name="no5" class="onoffswitch-checkbox" id="no5" tabindex="1" value="1" >
                                                           <label class="onoffswitch-label" for="no5"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                   </div></td></tr>
                                               
                                               <tr><td width="30px">6.</td><td>Terdapat keterangan volume kantong</td>
                                               <td><div class="onoffswitch">
                                                           <input type="hidden" name="no6" value="0">
                                                           <input type="checkbox" name="no6" class="onoffswitch-checkbox" id="no6" tabindex="1" value="1" >
                                                           <label class="onoffswitch-label" for="no6"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                   </div></td></tr>
                                                
                                                <tr><td width="30px">7.</td><td>Terdapat keterangan jenis Antikoagulan</td>
                                                <td><div class="onoffswitch">
                                                            <input type="hidden" name="no7" value="0">
                                                            <input type="checkbox" name="no7" class="onoffswitch-checkbox" id="no7" tabindex="1" value="1" >
                                                            <label class="onoffswitch-label" for="no7"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                    </div></td></tr>
                                                
                                                <tr><td width="30px">8.</td><td>Terdapat keterangan nomor lot</td>
                                                <td><div class="onoffswitch">
                                                            <input type="hidden" name="no8" value="0">
                                                            <input type="checkbox" name="no8" class="onoffswitch-checkbox" id="no8" tabindex="1" value="1" >
                                                            <label class="onoffswitch-label" for="no8"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                    </div></td></tr>
                                                <tr><td width="30px">9.</td><td>Jarum pada kantong darah dalam kondisi baik dan tajam</td>
                                                <td><div class="onoffswitch">
                                                            <input type="hidden" name="no9" value="0">
                                                            <input type="checkbox" name="no9" class="onoffswitch-checkbox" id="no9" tabindex="1" value="1" >
                                                            <label class="onoffswitch-label" for="no9"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                                    </div></td></tr>
                                                <tr><td width="30px">10.</td><td>Jenis dan merk kantong darah</td>
                                                <td><div class="onoffswitch" style="font-size:11px; font-weight:bold;color:#ff0000; font-family:Helvetica, Arial, san-serif;">
                                                            <?php
                                                              if ($data['jenis']==1 AND $data['volume']==350){
                                                                  $jenis ="1";$jk ="Single";
                                                              } elseif ($data['jenis']==2 AND $data['volume']==350){
                                                                  $jenis ="2";$jk ="Double";
                                                              } elseif ($data['jenis']==3 AND $data['volume']==350){
                                                                  $jenis ="3";$jk ="Triple";
                                                              } elseif ($data['jenis']==4 AND $data['volume']==350){
                                                                  $jenis ="4";$jk ="Quadriple";
                                                              }
                                                              echo $data['merk'].' '.strtoupper($jk).' '.$data['volume'];
                                                            ?>
                                                            <input type="hidden" name="jenis" value=<?php echo $data['jenis'];?>>
                                                            <input type="hidden" name="merk" value=<?php echo $data['merk'];?>>
                                                            <input type="hidden" name="shift" value=<?php echo $shif;?>>
                                                            <input type="hidden" name="volume" value=<?php echo $data['volume'];?>>

                                                            
                                                    </div></td></tr>
                                           </table>

                                        
                                       </div>
                                        <p>
                                        <div class="col-4">
                                          <button type="submit" name="cari" class="btn btn-success btn-block" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); ">VALIDASI</button>
                                        </div>

                                   </div>

                                   
                       </div>
                                   <p>
                                   <div class="row">
                                     
                                     
                                   </div>
                    </div>
                    </form>
            <!--row1--->
            </div>
        </div>
        <!--content OK -->
        <?php } else { ?>
<div class="row" align="center">
    <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <strong>INVALID</strong> Nomor Kantong Darah Tidak ditemukan!!!<br>****************
                    </div>
                </div>
            </div>
            <?php
            if ($lengan =='both'){?>
                <meta http-equiv="refresh" content="3; url=antripengambilan.php">
            <?php } elseif($lengan =='kanan'){?>
                <meta http-equiv="refresh" content="3; url=antriankanan.php">
            <?php }elseif($lengan =='kiri'){?>
                <meta http-equiv="refresh" content="3; url=antriankiri.php">
                <?php }
         } ?>
        <!--content FALSE -->
    </div>
</div>


<div class="copyright">
<p align="center">Copyright @ 2023 | UNIT DONOR DARAH PMI</p>
</div>





<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  //Date picker
  
  $("#datepicker").datepicker({
         dateFormat:"yy-mm-dd",
      });
} );
</script>
<script type="text/javascript">
    function validasiregistrasi()
    {
        if (document.getElementById('iddonor').value == '')
        {
            if (document.getElementById('nama').value.length < 3)
            {
                    alert('Pencarian Nama harus diisi/minimal 3 Karakter!');return false;
            }
        }
//        if (document.getElementById('alamat').value.length == 0)
//        {
//            alert('Alamat diisi dengan jelas dan lengkap ..');return false;
//        }
    }


</script>
<script>
$( function() {
  //Date picker
  $('#reservationdate').datetimepicker({
      format: 'yyyy-MM-DD'
  });

  //Date picker
  $('#reservationdate2').datetimepicker({
      format: 'yyyy-MM-DD'
  });

  //Date and time picker
  $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
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



