<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    include '../adm/config.php';
    $utd = mysqli_fetch_array(mysqli_query($con,"SELECT * from utd where `aktif`=1"));
    
    $id = $_SESSION['instansi'];
    $unit = $_SESSION['unit'];
    $user = $_SESSION['user'];
    
    $q  = $_GET['q'];
    $query = mysqli_query($con,"SELECT * FROM pendonor where Kode='$q' ");
    $query1 = mysqli_query($con,"SELECT * FROM htransaksi where KodePendonor='$q' order by Tgl ASC");
    
    if ($unit=="" || $id==="" || $user ==""){
        header("location: ?page=index");
    } else {
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



<script>
    jQuery(document).ready(function(){
      $('#instansi').autocomplete({source:'../../modul/suggest_udd.php', minLength:2});});
        function disabletext(val){
        if(val=='0'){
        document.getElementById('comments').hidden = true;
        } else {
            document.getElementById('comments').hidden = false;
        }
    }

</script>

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
    <img class="animation__shake" src="dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
<p>
<div class="card-header">
  <h4 class="text-center" style="font-size:24px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">HISTORY DONOR DARAH</h4>
    
    <!--a href="?page=caridonor"><button name="baru" class="btn btn-info float-right"><i class="nav-icon ion ion-android-arrow-back"></i>  Kembali</button></a-->
</div>

  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->
<table bgcolor="#000012" cellspacing="1" cellpadding="3">
    <tr bgcolor="#FF1000">
        <th colspan=4><b>INFO DATA PENDONOR</b></th></tr>
</table>
<table cellpadding="3" cellspacing="0" border="1" class="display"  width="100%">
    <tr align="center" bgcolor="#FAEBD7">
        <th rowspan='2'>Kode Pendonor</th>
        <th rowspan='2'>Nama Pendonor</th>
        <th rowspan='2'>Alamat</th>
        <th colspan='2' align="center">No. Telp</th>
        <th rowspan='2'>Gol Drh</th>
        <th rowspan='2'>Jml Donor</th>
        <th rowspan='2'>Tgl Donor Kembali</th>
        <th rowspan='2'>Status</th>
    </tr>
    <tr align="center" bgcolor="#FAEBD7">
        <th>Handphone</th>
        <th>Rumah/Ktr</th>

        <? while($row = mysqli_fetch_object($query)): ?>
<?
$cekal='OK';
if ($cekal1[cekal]=='1') $cekal='Confirm';
?>
    <tr bgcolor="#FFFFFF">
        <td><?=$row->Kode?></td>
        <td><?=$row->Nama?></td>
        <td><?=$row->Alamat?></td>
        <td><?=$row->telp2?></td>
        <td><?=$row->telp?></td>
        <td><?=$row->GolDarah?>(<?=$row->Rhesus?>)</td>
        <td align="center"><?=$row->jumDonor?> Kali</td>
        <td align="center"><?=$row->tglkembali?></td>
        <td align="center"><?=$cekal?></td>
    <? endwhile; ?>
</table>
<p>
<!--table history-->

<table cellpadding="3" cellspacing="0" border="1" class="display"  width="100%">
    <tr bgcolor="#FAEBD7">
        <td rowspan='2'>No.</td>
        <td rowspan='2'>Tanggal</td>
        <td rowspan='2'>Donor Ke</td>
        <td rowspan='2'>BB</td>
        <td rowspan='2'>Tensi</td>
        <td rowspan='2'>Jenis</td>
<td rowspan='2'>Tempat</td>
<td rowspan='2'>Instansi</td>
<td rowspan='2'>Nokantong</td>
<td rowspan='2'>Status<br>Aftap</td>
<td colspan='7' align="center">petugas</td>
    </tr>
<tr bgcolor="#FAEBD7">
<td>Input</td>
<td>HB</td>
<td>Tensi</td>
<td>Aftap</td>
<td align="center">Transaksi</td>
</tr>
<?
$no=1;
//$trans=mysql_query("select * from htransaksi where KodePendonor='$q' order by Tgl ASC");
/*SELECT fname, lname, addr FROM prospect
-> UNION
-> SELECT first_name, last_name, address FROM customer
-> UNION
-> SELECT company, '', street FROM vendor;
*/
$trans = mysqli_query($con, " SELECT Kodependonor,Tgl,NoTrans,Pengambilan,beratBadan,tensi,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas,donorke FROM htransaksi where KodePendonor='$q'
        UNION
            SELECT Kodependonor,Tgl,id,Pengambilan,beratBadan,tensi,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas,'' FROM htransaksilama where KodePendonor='$q' order by Tgl ASC ");

/*$trans=mysql_query(" SELECT Kodependonor,NoTrans,Tgl,Pengambilan,beratBadan,tensi,JenisDonor,tempat,Instansi,NoKantong,petugasHB,petugasTensi,user,petugas,donorke FROM htransaksi where KodePendonor='$q' order by Tgl DESC ");*/
     while ($dtrans = mysqli_fetch_assoc($trans)):
$notr=$dtrans[NoTrans];
$jenis='DS';
    if ($dtrans[JenisDonor]=='1') $jenis='DP';
$tempat='DG';
    if ($dtrans[tempat]=='M') $tempat='MU';

      
?>

    <tr bgcolor="#FFFFFF">
        <td><?=$no++?></td>
        <td><?=$dtrans[Tgl]?></td>
        <td><?=$dtrans[donorke]?> Kali</td>
        <td><?=$dtrans[beratBadan]?> kg</td>
        <td align="center"><?=$dtrans[tensi]?></td>
        <td align="center"><?=$jenis?></td>
        <td align="center"><?=$tempat?></td>
        <td align="center"><?=$dtrans[Instansi]?></td>
        <td align="center"><?=$dtrans[NoKantong]?></td>
<?
//$pengambilan=mysql_fetch_assoc(mysql_query("select Pengambilan from htransaksi where KodePendonor='$q'"));
    if ($dtrans[Pengambilan]=='0') $pengambilan1="Berhasil";
    if ($dtrans[Pengambilan]=='2') $pengambilan1="Gagal Aftap";
    if ($dtrans[Pengambilan]=='1') $pengambilan1="Batal";
?>
        <td align="center"><?=$pengambilan1?></td>
        <td align="center"><?=$dtrans[user]?></td>
        <td align="center"><?=$dtrans[petugasHB]?></td>
        <td align="center"><?=$dtrans[petugasTensi]?></td>
        <td align="center"><?=$dtrans[petugas]?></td>
        <td align="center"><?=$dtrans[NoTrans]?></td>
       
        
        
    </tr>

    <? endwhile; ?>
</table>


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
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="../tpksoloplugins/jquery/jquery.min.js"></script>

</body>
</html>
<?php } ?>

