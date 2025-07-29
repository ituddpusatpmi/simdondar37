

<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    include '../adm/config.php';
    $utd = mysqli_fetch_array(mysqli_query($con,"SELECT * from utd where `aktif`=1"));
    $kodep = $_GET['id'];
    $id = $_SESSION['instansi'];
    $unit = $_SESSION['unit'];
    $user = $_SESSION['user'];
    
    if ($unit=="" || $id===""){
        header("location: ?page=index");
    } else {
    
    
    //CARI NAMA INSTANSI
    $ins = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama from detailinstansi where KodeDetail='$id'"));
    $namains = $ins['nama'];
    
      
      //Shift Petugas
      $shift  = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama,jam,sampai_jam FROM `shift` WHERE time(now()) between time(jam) AND time(sampai_jam)"));
      //$shif   = $shift['nama'];
      if ($shift['nama']=="1"){
        $shif   = "1";
      } else if ($shift['nama']=="2"){
        $shif   = "2";
      } else if ($shift['nama']=="3"){
        $shif   = "3";
      } else {
        $shif   = "4";
      }
    
    $query = ("SELECT * FROM htransaksi where Status='1' and jumHB='1' and instansi = '$namains' and (date(Tgl)BETWEEN curdate()-INTERVAL 1 DAY AND curdate())"); //0=baru, 1=med cheked, 2=aftap
    $hasil = mysqli_query($con,$query);
    $rowst = mysqli_num_rows($hasil);
    
    
                    
                    
   
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
  <h4 class="text-center" style="font-size:24px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">ANTRIAN PENYADAPAN (AFTAP)<br><?php echo $ins['nama'];?></h4>
<a href="?page=dash"><button name="baru" class="btn btn-info float-right"><i class="nav-icon ion ion-android-arrow-back"></i>  Kembali</button></a>
</div>

  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->
    
    <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <td>No</td>
            <td>No Registrasi</td>
            <td>Nama Pendonor</td>
            <td>Kode Pendonor</td>
            <td>Tgl Lahir</td>
            <td>Gol Darah</td>
            <td>Jenis Donor</td>
            <td>Donor Ulang/Baru</td>
            <td>Jenis Pengambilan</td>
            <td>Tindakan</td>
          </tr>
        </thead>
      <tbody>
        <?php
            // Hasil Cari
            if($rowst > 0){
              $a=0;
              
              $color="";
              while ($data = mysqli_fetch_array($hasil)){
                $a++;
                  $jenis_pemngambilan ='0';
                  if ($data['apheresis']=='1'){$jenis_pemngambilan='1';}
                  if ($data['donor_tpk']=='1'){$jenis_pemngambilan='2';}
                  switch ($jenis_pemngambilan){
                      case '0': $jenis_pemngambilan1='Biasa';break;
                      case '1': $jenis_pemngambilan1='Apheresis';break;
                      case '2': $jenis_pemngambilan1='Plasma Konvalesen';break;
                  }
                  
                  if ($data['JenisDonor']=='1'){$dsdp='Pengganti';}else{$dsdp='Sukarela';}
                  if ($data['donorbaru']=='1'){$lmbr='Ulang';}else{$lmbr='Baru';}
                  $data['KodePendonor']=str_replace("'","\'",$data['KodePendonor']);
                  $query1 = mysqli_query($con,"SELECT * FROM pendonor where Kode='$data[KodePendonor]'");
                  $hasil1 = mysqli_fetch_array($query1);
                  echo '<tr>';
                  echo "
                      <td  nowrap>".$a."</td>
                  <td>".$data['NoTrans']."</td>
                  <td nowrap>";
                      switch($jenis_pemngambilan){
                          case '0' :echo "<a href=?page=aftap&NoTrans=".$data['NoTrans']."&kodep=".$data['KodePendonor']." title='Klik untuk melanjutkan ke pengambilan DONOR BIASA'>".$hasil1['Nama']."</a>";break;
                      }
                  
                  echo "  </td>
                          <td >".$hasil1['Kode']."</td>
                          <td>".$hasil1['TglLhr']."</td>
                          <td>".$data['gol_darah'].$data['rhesus']."</td>
                          <td>".$dsdp."</td>
                          <td>".$lmbr."</td>
                          <td >".$jenis_pemngambilan1."</td>
                          <td><a href=pmi".$_SESSION['leveluser'].".php?module=deltransaksi&NoTrans=".$data['NoTrans']." title='Batalkan transaksi pengambilan'>Batalkan</a></td>
                       
                      </tr>";
              
                  
                  
                    
                  
                  
                  }
                
            }
                
        ?>
</tbody>
</table>




<!--content-->
    </div>
  </div>
<p class="box3">
<div class="copyright">
    <p align="center"><a href="https://pmi.or.id"><font style="color:white">Copyright @ 2022 | PALANG MERAH INDONESIA</a>
</div>





<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- Page specific script -->
<script>
    
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

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

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
<!-- Page specific script -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel", "pdf", "print"]
      //"buttons": ["pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
                      $(document).on("click", "#batal", function() {
                          var id = $(this).data('id');
                          
                          $("#batal-edit #id").val(id);
                          
                      })
                      </script>

</body>
</html>

<?php } ?>
