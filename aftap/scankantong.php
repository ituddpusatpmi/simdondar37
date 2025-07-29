
<?php
    session_start();
    include ('../config/dbi_connect.php');
    $td0=php_uname('n');
    $td0=strtoupper($td0);
    $td0=substr($td0,0,2);
    $notrans    =   $_GET['trans'];
    //$query = ("SELECT *, DATE_FORMAT(Tgl,'%d %M %Y') as daftar FROM htransaksi where Status='1' and jumHB='1' and date(Tgl)>= current_date -7 and date(Tgl) <= current_date");
    //if (substr($td0,0,1)=='M')  $query = ("SELECT * FROM htransaksi where NoTrans like '$td0%' and Status='1' and jumHB='1' ");
    //$hasil = mysqli_query($dbi,$query);
    $kursi = $_SESSION['bed'];
    if ($kursi ==""){
       ?> <META http-equiv="refresh" content="0; url=../index.php"><?php
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

<!--div class="card-header">
<div align="center" style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">VALIDASI KANTONG DARAH</div>
  <a href="<?php echo $lvl;?>.php?module=donor_baru"><button name="baru" class="btn btn-warning float-right"><i class="nav-icon ion ion-ios-medkit"></i>  Donor Baru</button></a>
</div-->


<p class="box">
  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->

<div class="row" align="center">
    <div class="col-lg-12">
    <!--row1--->
        
        <div align="center" style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">VALIDASI KANTONG DARAH</div>
        <div class="login-box" align="center">
            <div id="wrapper">
                <div class="card">
                    <div class="card-body login-card-body">
                        <form action="validasi.php" method="post">
                          <div class="input-group mb-3">
                            <input type="text" name="kode" class="form-control" placeholder="ketik / scan nomor kantong" autocomplete="off" autofocus required >
                            <input type="hidden" name="trans" class="form-control" value="<?php echo $notrans; ?>">
                          </div>
                          
                          <div class="row">
                            <div class="col-6">
                                <input type="button" name="batal" value="BATAL" class="btn btn-danger btn-block" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);" onclick="history.back()">

                            </div>
                            <div class="col-6">
                                <input type="submit" name="submit" value="OK" class="btn btn-success btn-block" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);" onclick="history.back()">
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <!--row1--->
    </div>
</div>

<!-- JIKA SUBMIT1 -->



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


