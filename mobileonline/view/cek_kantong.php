

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
  <h4 class="text-center" style="font-size:24px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">CEK STATUS KANTONG PENDONOR<br><?php echo $ins['nama'];?></h4>
<a href="?page=dash"><button name="baru" class="btn btn-info float-right"><i class="nav-icon ion ion-android-arrow-back"></i>  Kembali</button></a>
</div>

  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->
<div>
    <form name=mintadarah1 method=post onsubmit="return validasikantong()"><font size="3"> Masukkan Nomor Kantong / Sampel </font><br>
    <INPUT type="text"  name="minta1"  id="minta1" size='23' placeholder="Nomor Selang / Kantong" required>
    <input type="submit" name="submit" value="CARI">
    </form>
</div><br>
<?php
    
if(isset($_POST['submit'])){
    $nkt        =   $_POST['minta1'];
    $lastnkt    =   substr($nkt, -1);
    
    if($lastnkt=='A' && $lastnkt=='B' && $lastnkt=='C' && $lastnkt=='D' && $lastnkt=='E' && $lastnkt=='F' && $lastnkt=='G' && $lastnkt=='H'){
        $no_kantong0=substr($nkt,0,-1);
    }else{
        $no_kantong0=$nkt;
    }
    $komponen0      = mysqli_query($con, "select * from stokkantong where noKantong = '$no_kantong0' order by noKantong ASC");
    $distribusi0    = mysqli_query($con, "select * from dtransaksipermintaan where NoKantong like '$no_kantong0%' order by NoKantong ASC");
    $donasi0        = mysqli_query($con, "select * from htransaksi where nokantong ='$nkt'");
    $donasi1        = mysqli_fetch_assoc(mysqli_query($con, "select kantongAsal from stokkantong where noKantong = '$nkt'"));
    $donasi2        = mysqli_query($con, "select * from htransaksi where nokantong = '$donasi1[kantongAsal]'");
    
    //Jika Ada
    if(mysqli_num_rows($komponen0) > 0){
      while ($komponen = mysqli_fetch_assoc($komponen0)) {?>
        <br><H3 align="center"><font size="4">DATA KANTONG / SAMPEL</font></H3>
        <table  class="table table-bordered table-striped" width="50%">
        <!--table class=form border=1 cellpadding=0 cellspacing=0 width="80%"-->
        <thead>
            <tr tr style="background-color:RED; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
                <td rowspan=2>No</td>
                <th rowspan=2>No Kantong</th>
                <th rowspan=2>Asal</th>
                <th rowspan=2>Merk</th>
                <th rowspan=2>Jenis</th>
                <th rowspan=2>Produk</th>
                <th rowspan=2>Vol/CC</th>
                <th rowspan=2>Darah</th>
                <th rowspan=2>Nolot</th>
                <th colspan=2>Status</th>
                <th colspan=3>Tanggal</th>
                
            </tr>
                <tr tr style="background-color:RED; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >

                <th> </th>
                <th> </th>
                <th>ED.Ktg</th>
                <th>Aftap</th>
                <th>Durasi</th>
                
                
                  </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo "1.";?></td>
                    <td class=input><?php echo $komponen['noKantong'];?></td>
                <?
                $asalutd=mysqli_fetch_assoc(mysqli_query($con,"select nama from utd where id='$komponen[AsalUTD]'"));
                $utdintern=mysqli_fetch_assoc(mysqli_query($con,"select nama from utd where aktif='1'"));
                $bawa=mysqli_fetch_assoc(mysqli_query($con,"select Status from dtransaksipermintaan where nokantong='$komponen[noKantong]'"));
                $utd = $asalutd['nama'];
                if ($komponen['AsalUTD']==NULL) $utd=$utdintern['nama'];
                ?>
                <td class=input><?php echo $utd;?></td>
                <td class=input><?php echo $komponen['merk'];?></td>
                <?
                switch ($komponen['Status']) {
                case 0:    $ckt_status="Kosong";
                    if($komponen['StatTempat']==NULL) $ckt_status="Kosong Di logistik";
                    if($komponen['StatTempat']=='0') $ckt_status="Kosong DI Logistik";
                    if($komponen['StatTempat']=='1') $ckt_status="Kosong Di Aftap";
                    break;
                case 1:    $ckt_status="Aftap";
                    if ($komponen['sah']=='1') $ckt_status="Baru Isi/Karantina";break;
                case 2:    $ckt_status="Sehat";
                    if (substr($komponen['stat2'],0,1)=='b') $tempat=" (BDRS)";break;
                case 3:    $ckt_status="Keluar_Bawa";
                    if ($bawa['Status']=='1') $ckt_status="Keluar_Titip";break;
                case 4:    $ckt_status="Rusak";break;
                case 5:    $ckt_status="Rusak-Gagal";break;
                case 6:    $ckt_status="Dimusnahkan";break;
                case 7: $ckt_status="Reaktif";break;
                }
            
            switch ($komponen['hasilNAT']) {
                case '0':    $ckt_nat="-";
                    break;
                case '1':    $ckt_nat="NR";
                    break;
                case '2':    $ckt_nat="R";
                    break;
                case '3':    $ckt_nat="Invalid";
                    break;
                }

                switch ($komponen['metoda']){
        //            case "BS":  $metkantong ="BIASA";        break;
        //            case "FT":  $metkantong ="FILTER";       break;
                    case "TTB":  $metkantong ="TOP & TOP (Biasa)";    break;
                    case "TTF":  $metkantong ="TOP & TOP (Filter)";    break;
                    case "TBB":  $metkantong ="TOP & BOTTOM (Biasa)"; break;
                    case "TBF":  $metkantong ="TOP & BOTTOM (Filter)"; break;
                }
                switch($komponen['jenis']) {
                case '1':$jenis='Single';break;
                case '2':$jenis='Double';break;
                case '3':$jenis='Triple';break;
                case '4':$jenis='Quadruple ('.$metkantong.')';break;
                case '6':$jenis='Pediatrik';break;
                default:$jenis='';
                }
                switch ($komponen['hasil_release']) {
                case 'o':$release='-';break;
                case '1':$release='LULUS';break;
                case '2':$release='REJECT';break;
                case '3':$release='LULUS dgn CATATAN';break;
                default:$release='';
                }
                ?>
                <td class=input><?php echo $jenis;?></td>
                <td class=input><?php echo $komponen['produk'];?></td>
                <td class=input align="right"><?php echo $komponen['volume'];?></td>
                <td class=input><?php echo $komponen['gol_darah'];?>(<?php echo $komponen['RhesusDrh'];?>)</td>
                <td class=input><?php echo $komponen['nolot_ktg'];?></td>
                <td class=input><?php echo $ckt_status;?></td>
        <?
            $bdrs=mysqli_fetch_assoc(mysqli_query($con,"select nama from bdrs where kode='$komponen[stat2]'"));
            $tujuan=mysqli_fetch_assoc(mysqli_query($con,"select nama from utd where id='$komponen[stat2]'"));
            $tujuan1=mysqli_fetch_assoc(mysqli_query($con,"select nama from bdrs where kode='$komponen[stat2]'"));
            $rmhskt=mysqli_fetch_assoc(mysqli_query($con,"select NamaRs from rmhsakit where Kode='$ttp1[rs]'"));
            //if ($komponen[stat2]==NULL and $komponen[Status]==3) $ckt_tujuan="Rumah Sakit";
            if ($komponen['stat2']==NULL and $komponen['Status']==3) $rs="RS";
            if ($komponen['stat2']==NULL and $komponen['Status']!=3) $rs="";
            $buang=mysqli_fetch_assoc(mysqli_query($con,"select * from ar_stokkantong where noKantong='$komponen[noKantong]'"));
        ?>
            <td class=input><?php echo $tujuan1['nama'];?><?php echo $tujuan['nama'];?><?php echo $rs;?></td>

            <td class=input><?php echo $komponen['kadaluwarsa_ktg'];?></td>
            <td class=input><?php echo $komponen['tgl_Aftap'];?></td>
            <td class=input><?php echo $komponen['lama_pengambilan'];?> menit</td>
            
            
            </tr>
            <tbody>
        
        </table>

        <!--DONASI-->
        <br><H3 align="center"><font size="4">DATA DONASI</font></H3>
            <table  class="table table-bordered table-striped" width="50%">
            <thead>
            <tr tr style="background-color:RED; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
                <td rowspan='2'>No</td>
                    <th rowspan=2>No Kantong</th>
                <th colspan=10 align="center">Pendonor</th>
                <th colspan=6>Aftap</th>
                
            </tr>
                <tr tr style="background-color:RED; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
                <th>ID</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Umur</th>
                <th>Gol</th>
                <th>Donor</th>
                <th>BB</th>
                <th>Tensi</th>
                <th>HB</th>
                <th>Ket</th>
                <th>Jam<br>Ambil</th>
                <th>Jam <br>selesai</th>
                <th>Jenis</th>
                <th>Asal</th>
                <th>Instansi</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    while ($donasi = mysqli_fetch_assoc($donasi0)) {
                    ?>
                    <tr class="record">
                        <?
                        $asalktg = mysqli_fetch_assoc(mysqli_query($con, "select kantongAsal from stokkantong where noKantong='$donasi[NoKantong]'"));
                        ?>
                        <td><?=$no++?></td>
                            <td class=input><?php echo $donasi['NoKantong'];?></td>
                        <td class=input><?php echo $donasi['KodePendonor'];?></td>
                        <?
                        $pendonor = mysqli_fetch_assoc(mysqli_query($con,"select Nama from pendonor where Kode='$donasi[KodePendonor]'"));
                        ?>
                        <td class=input><?php echo $pendonor['Nama'];?></td>
                        <?
                        if ($donasi['jk']=='0') $jk='Laki-laki';
                        if ($donasi['jk']=='1') $jk='Perempuan';
                        if ($donasi['jumHB']=='1') $hb='tenggelam';
                        if ($donasi['jumHB']=='2') $hb='Melayang';
                        if ($donasi['jumHB']=='3') $hb='Mengapung';
                        if ($donasi['donorbaru']=='0') $baru='Baru';
                        if ($donasi['donorbaru']=='1') $baru='Ulang';
                        ?>
                        <td class=input><?php echo $jk?></td>
                        <td class=input><?php echo $donasi['umur'];?>th</td>
                        <td class=input><?php echo $donasi['gol_darah'];?>(<?php echo $donasi['rhesus'];?>)</td>
                        <td class=input><?php echo $donasi['donorke'];?> kali</td>
                        <td class=input><?php echo $donasi['beratBadan'];?></td>
                        <td class=input><?php echo $donasi['tensi'];?></td>
                        <td class=input><?php echo $donasi['Hb'];?> (<?php echo $hb;?>)</td>
                        <td class=input><?php echo $baru;?></td>
                        <td class=input><?php echo $donasi['jam_ambil'];?></td>
                        <td class=input><?php echo $donasi['jam_selesai'];?></td>

                        <?
                        if ($donasi['JenisDonor']=='0') $ds='DS';
                        if ($donasi['JenisDonor']=='1') $ds='DP';
                        if ($donasi['JenisDonor']=='2') $ds='Autologus';
                        if ($donasi['tempat']=='M') $tempat1='MU';
                        if ($donasi['tempat']!='M') $tempat1='DG';
                        ?>
                        <td class=input><?php echo $ds?></td>
                        <td class=input><?php echo $tempat1;?></td>
                        <td class=input><?php echo $donasi['Instansi'];?></td>
                        <?
                        if ($donasi['Pengambilan']=='0') $status='Berhasil';
                        if ($donasi['Pengambilan']=='2') $status='Gagal/Mislek';
                        ?>
                        <td class=input><?php echo $status;?></td>
                      
                        </tr>
                        <?php } ?>
            </tbody>
            </table>
        
     <?php }
    }
    //ISSET SUBMIT
    }
?>
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

