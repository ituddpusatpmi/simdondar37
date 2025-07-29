
<?php
    session_start();
    include ('../config/dbi_connect.php');
    $td0=php_uname('n');
    $td0=strtoupper($td0);
    $td0=substr($td0,0,2);
    $kursi = $_SESSION['bed'];
    if ($kursi ==""){
       ?> <META http-equiv="refresh" content="0; url=../index.php"><?php
    }
    
    if(isset($_POST['find'])) {
            $trans1 = $_POST['kode'];
            $query = ("SELECT *, DATE_FORMAT(Tgl,'%d %M %Y') as daftar FROM htransaksi where Status='1' and NoTrans='$trans1'");
            if (substr($td0,0,1)=='M')  $query = ("SELECT * FROM htransaksi where NoTrans like '$td0%' and Status='1' and jumHB='1' ");
        
        }else{
            $query = ("SELECT *, DATE_FORMAT(Tgl,'%d %M %Y') as daftar FROM htransaksi where Status='1' and jumHB='1' and date(Tgl)>= current_date -5 and date(Tgl) <= current_date order by NoTrans ASC");
            if (substr($td0,0,1)=='M')  $query = ("SELECT * FROM htransaksi where NoTrans like '$td0%' and Status='1' and jumHB='1' ");
            
        }
    
    $hasil = mysqli_query($dbi,$query);
    
    
    
    
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
  <!-- Voice -->
    <script type="text/javascript" >
      $(document).ready(function(){
        $("#play").click(function(){
          document.getElementById('suarabel').play();
        });
      });
    </script>

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

    height: 25px;
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

<!--voice-->
        <audio id="suarabel" src="../tpksolo/dist/sound/in.wav"></audio>
        <audio id="suarabelnomorurut" src="../tpksolo/dist/sound/NomorAntrian.mp3"  ></audio>
        <audio id="suarabelsuarabelloket" src="../tpksolo/dist/sound/Ruangdaftar.mp3"  ></audio>
        <audio id="suarakursidonor" src="../tpksolo/dist/sound/kursidonor.mp3"  ></audio>
        <audio id="belas" src="../tpksolo/dist/sound/belas.mp3"  ></audio>
        <audio id="sebelas" src="../tpksolo/dist/sound/sebelas.mp3"  ></audio>
        <audio id="puluh" src="../tpksolo/dist/sound/puluh.mp3"  ></audio>
        <audio id="sepuluh" src="../tpksolo/dist/sound/sepuluh.mp3"  ></audio>
        <audio id="ratus" src="../tpksolo/dist/sound/ratus.mp3"  ></audio>
        <audio id="seratus" src="../tpksolo/dist/sound/seratus.mp3"  ></audio>

    
<!--voice-->


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../tpksolo/dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<img class="img-responsive" src="../tpksolo/dist/img/coorporatepmi.png" />

<div class="card-header">
<div align="center" style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">DATA ANTRIAN AFTAP (PENGAMBILAN DARAH)</div>
  <a href="antripengambilan.php"><button name="baru" class="btn btn-warning float-right"><i class="nav-icon ion ion-ios-reload"></i> RELOAD</button></a>
</div>





  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->




<b>KURSI DONOR NO.  <?php echo $kursi;?></b>
<div class="row" align="center">
        <form action="" method="post">
          <div class="input-group mb-12">
            <input type="text" name="kode" class="form-control" placeholder="Scan Nomor Transaksi" autocomplete="off" autofocus required >
            <input type="submit" name="find" class="btn btn-success float-right"  value="cari" >
          </div>
        </form>
</div>
<div class="row" align="center">
    <div class="col-lg-12">
    <!--row1--->
        <br>

        <table width=80% class="table table-bordered table-hover table-striped">
            <tr class="field" style="height:40px;">
                <th>No</th>
                <th>Nama Pendonor</th>
                <th>Keterangan Donor</td>
                <th>Tindakan</th>
            </tr>
            <?
            $no=0;
            while ($data = mysqli_fetch_assoc($hasil)){
                $no++;
                $jenis_pemngambilan ='0';
                if ($data['apheresis']=='1'){$jenis_pemngambilan='1';}
                if ($data['donor_tpk']=='1'){$jenis_pemngambilan='2';}
                switch ($jenis_pemngambilan){
                    case '0': $jenis_pemngambilan1='- Metode Biasa';break;
                    case '1': $jenis_pemngambilan1='- Metode Apheresis';break;
                    case '2': $jenis_pemngambilan1='- Metode PK';break;
                }
                
                if ($data['JenisDonor']=='1'){$dsdp='- Donor Pengganti';}else{$dsdp='- Donor Sukarela';}
                if ($data['donorbaru']=='1'){$lmbr='- Pendonor Ulang';}else{$lmbr='- Pendonor Baru';}
                $data['KodePendonor']=str_replace("'","\'",$data['KodePendonor']);
                $query1 = mysqli_query($dbi,"SELECT * FROM pendonor where Kode='$data[KodePendonor]'");
                $hasil1 = mysqli_fetch_array($query1);
                
                $query2 = mysqli_query($dbi,"SELECT * FROM antrian where transaksi='$data[NoTrans]' limit 1");
                $hasil2 = mysqli_fetch_array($query2);
                echo "
                    <tr class='record' style='height:30px;'>
                        <td>".$no."</td>
                        <td align=left nowrap>
                        <table class='table table-bordered table-hover table-striped'><tr>
                        <td>";
                        echo "<H5><b>".strtoupper($hasil1['Nama'])."</b></H5>";
                
                    //Pemeriksaan Awal
                    $tcounter = $hasil2['nomor'];
                          $panjang=strlen($tcounter);
                          $antrian=$tcounter;
        
                          for($i=0;$i<$panjang;$i++){
                              ?>
                            <audio id="suarabel<?php echo $i; ?>" src="../tpksolo/dist/sound/<?php echo substr($tcounter,$i,1); ?>.MP3" ></audio>
                          <?php
                          }
                    
                    //Pemeriksaan Awal
                    $bed = $kursi;
                          $panjangbed = strlen($bed);
                          $beddonor = $bed;
                          
                          for($i=0;$i<$panjangbed;$i++){
                              ?>
                            <audio id="suarabed<?php echo $i; ?>" src="../tpksolo/dist/sound/<?php echo substr($bed,$i,1); ?>.MP3" ></audio>
                              
                            
                          <?php
                          }
            
                echo "  <br>
                        Tgl. Lahir : ".$hasil1['TglLhr']."<br>
                        Donor Ke ".$data['donorke']." Kali<br>
                        <!--button  class='btn btn-warning btn-sm style=';box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px' onclick='mulai();'>PANGGIL</button><p-->
                               
                        </td><td align='center'><H2>".$data['gol_darah'].$data['rhesus']."</H2></td><tr>
                        </table>
                        </td>
                        <td align=left>
                        <H4><strong> No. Antrian : ".$hasil2['nomor']."</strong></H4>
                        <font style='color:blue'>Tgl. Register :<br>".$data['daftar']."</font><br>
                        ".$jenis_pemngambilan1."<br>
                        ".$dsdp."
                        </td>
                        <td>
                
                <a href='scankantong.php?trans=$data[NoTrans]'><button  class='btn btn-success btn-block style=';box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px' >AFTAP</button></a><br><br>
                <a href='batal.php?trans=$data[NoTrans]&asal=both'><button  class='btn btn-danger btn-block style=';box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px' onclick='return confirm('Batalkan Pengambilan Donor ?')'>BATAL</button></a></td>
                        
                    </tr>";
            }
        echo "</table>";
        ?>
    <!--row1--->
    </div>
    
</div>

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
function mulai(){
    //MAINKAN SUARA BEL PADA SAAT AWAL
    document.getElementById('suarabel').pause();
    document.getElementById('suarabel').currentTime=0;
    document.getElementById('suarabel').play();
            
    //SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT
    totalwaktu=document.getElementById('suarabel').duration*1000;

    //MAINKAN SUARA NOMOR URUT
    setTimeout(function() {
            document.getElementById('suarabelnomorurut').pause();
            document.getElementById('suarabelnomorurut').currentTime=0;
            document.getElementById('suarabelnomorurut').play();
    }, totalwaktu);
    totalwaktu=totalwaktu+1000;
    
    <?php
        //JIKA KURANG DARI 10 MAKA MAIKAN SUARA ANGKA1
        if($antrian<10){
    ?>
            
            setTimeout(function() {
                    document.getElementById('suarabel0').pause();
                    document.getElementById('suarabel0').currentTime=0;
                    document.getElementById('suarabel0').play();
                }, totalwaktu);
            
            totalwaktu=totalwaktu+1000;
    <?php
        }elseif($antrian ==10){
            //JIKA 10 MAKA MAIKAN SUARA SEPULUH
    ?>
                setTimeout(function() {
                        document.getElementById('sepuluh').pause();
                        document.getElementById('sepuluh').currentTime=0;
                        document.getElementById('sepuluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
            }elseif($antrian ==11){
                //JIKA 11 MAKA MAIKAN SUARA SEBELAS
        ?>
                setTimeout(function() {
                        document.getElementById('sebelas').pause();
                        document.getElementById('sebelas').currentTime=0;
                        document.getElementById('sebelas').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
            }elseif($antrian ==100){
                //JIKA 100 MAKA MAIKAN SUARA SERATUS
        ?>
                setTimeout(function() {
                        document.getElementById('seratus').pause();
                        document.getElementById('seratus').currentTime=0;
                        document.getElementById('seratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
            }elseif($antrian < 20){
                //JIKA 12-20 MAKA MAIKAN SUARA ANGKA2+"BELAS"
        ?>
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('belas').pause();
                        document.getElementById('belas').currentTime=0;
                        document.getElementById('belas').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
            } elseif ($antrian < 100){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('suarabel0').pause();
                        document.getElementById('suarabel0').currentTime=0;
                        document.getElementById('suarabel0').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                
        <?php
        
            } elseif ($antrian < 100){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('suarabel0').pause();
                        document.getElementById('suarabel0').currentTime=0;
                        document.getElementById('suarabel0').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                
        <?php
        
            } elseif ($antrian > 100 && $antrian < 120 ){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('seratus').pause();
                        document.getElementById('seratus').currentTime=0;
                        document.getElementById('seratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime=0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('belas').pause();
                        document.getElementById('belas').currentTime=0;
                        document.getElementById('belas').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
        
            }elseif ($antrian > 120 && $antrian < 200 ){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('seratus').pause();
                        document.getElementById('seratus').currentTime=0;
                        document.getElementById('seratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime=0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                
        <?php
        
            } elseif ($antrian > 199 && $antrian < 1000 ){
                //JIKA PULUHAN MAKA MAINKAN SUARA ANGKA1+PULUH+AKNGKA2
        ?>
                setTimeout(function() {
                        document.getElementById('suarabel0').pause();
                        document.getElementById('suarabel0').currentTime=0;
                        document.getElementById('suarabel0').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('ratus').pause();
                        document.getElementById('ratus').currentTime=0;
                        document.getElementById('ratus').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel1').pause();
                        document.getElementById('suarabel1').currentTime=0;
                        document.getElementById('suarabel1').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('puluh').pause();
                        document.getElementById('puluh').currentTime=0;
                        document.getElementById('puluh').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
                setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime=0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                totalwaktu=totalwaktu+1000;
        <?php
        
            }else{
                //JIKA LEBIH DARI 100
                //Karena aplikasi ini masih sederhana maka logina konversi hanya sampai 100
                //Selebihnya akan langsung disebutkan angkanya saja
                //tanpa kata "RATUS", "PULUH", maupun "BELAS"
        ?>
        
        <?php
            for($i=0;$i<$panjang;$i++){
        ?>
        
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
                        document.getElementById('suarabel<?php echo $i; ?>').pause();
                        document.getElementById('suarabel<?php echo $i; ?>').currentTime=0;
                        document.getElementById('suarabel<?php echo $i; ?>').play();
                    }, totalwaktu);
        <?php
            }
            }
        ?>
        
        
        totalwaktu=totalwaktu+1000;
        setTimeout(function() {
                        document.getElementById('suarakursidonor').pause();
                        document.getElementById('suarakursidonor').currentTime=0;
                        document.getElementById('suarakursidonor').play();
                    }, totalwaktu);
    
        totalwaktu=totalwaktu+3000;
        setTimeout(function() {
                        document.getElementById('suarabed0').pause();
                        document.getElementById('suarabed0').currentTime=0;
                        document.getElementById('suarabed0').play();
                    }, totalwaktu);
          <?php
            $updatepanggil = mysqli_query($con,"UPDATE antrian set panggil=1 where nomor='$tcounter' AND tgl=curdate()");
          ?>
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

