
<?php
    session_start();
    include ('../config/dbi_connect.php');
    $td0=php_uname('n');
    $td0=strtoupper($td0);
    $td0=substr($td0,0,2);
    $notrans    =   $_GET['trans'];
    $nokantong  =   $_GET['kantong'];
    $check      =   mysqli_query($dbi,"select * from htransaksi where NoTrans='$notrans' limit 1");
    $check1     =   mysqli_fetch_assoc($check);
    $kodep      =   $check1['KodePendonor'];
    $kursi      =   $_SESSION['bed'];
    $lengan     =   $_SESSION['lengan'];
    //CARI KANTONG
    $kantong    = mysqli_query($dbi, "SELECT * from stokkantong where noKantong ='$nokantong' AND `Status`='0' and StatTempat='1' and kadaluwarsa_ktg >'$today1'");
    $stok1      = mysqli_fetch_assoc($kantong);
    
    $skode    = mysqli_query($dbi, "select * from pmi.samplekode where (sk_notrans='$_GET[trans]') limit 1");
    $sk       = mysqli_fetch_assoc($skode);
    $sample   = $sk['sk_kode'];
    
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

    if ($stok1['jenis']=='1'){
        $bcjum      = "10";
    } else if ($stok1['jenis']=='2'){
        $bcjum      = "12";
    } else if ($stok1['jenis']=='3'){
        $bcjum      = "14";
    } else {
        $bcjum      = "14";
    }

    $NoSelang = $stok1['noSelang'];
    
    $today1=date("Y-m-d H:i:s");
    $today2=date("Y-m-d");
    $jam_donor=date("H:i:s");
    $tipe_donor='0';
    

    //POST DATA ***********
    if (isset($_POST['simpan'])) {
        $keberhasilan   = $_POST['keberhasilan'];
        $catatan        = $_POST['catatan'];
        $today1          = date("Y-m-d");
        
        $kdl            = mktime(0,0,0,date("m"),date("d")+14,date("Y"));
        $kembali0       = mktime(0,0,0,date("m"),date("d")+60,date("Y"));
        //$tensi          = $_POST['tensi_diastol']."/".$_POST['tensi_sistol'];
        //$status_test    = "1";
        $today          = date('Y-m-d H:i:s');
        $kembali        = date('Y-m-d',$kembali0);
        $kadaluwarsa    = date('Y-m-d H:i:s',$kdl);
        $kodependonor   = $_POST['kodependonor'];
        $volume_darah   = $_POST['volume_darah'];
        $catatan        = $_POST['catatan'];
        $reaksi         = $_POST['reaksi'];
        $caraambil      = $_POST['caraambil'];
        $id_kantong     = $_POST['id_kantong11'];
        $GolDarah       = $_POST['goldarah'];
        $Rhesus         = $_POST['Rhesus'];
        $ambil          = $_POST['jamambil'];
        $selesai        = $_POST['jamstop'];
        $petugas        = $_POST['petugas'];
        $id_selang      = $_POST['id_selang'];
        $bc_jum         = $_POST['bc_jum'];
        $bc_pakai       = $_POST['bc_pakai'];
        $bc_buang       = $bc_jum - $bc_pakai;
        
        
        
        //INTERVAL AFTAP
        $jama=$ambil;
        $jamb=$selesai;
        $test1=substr($jama,0,2);
        $test2=substr($jama,3,2);
        $test3=substr($jama,6);
        $test4=substr($jamb,0,2);
        $test5=substr($jamb,3,2);
        $test6=substr($jamb,6);
        $waktua=mktime($test1,$test2,$test3);
        $waktub=mktime($test4,$test5,$test6);
        $selisih=$waktub-$waktua;
        $sisa=$selisih % 86400;
        $jam=floor($sisa/3600);
        $sisa=$sisa%3600;
        $menit=floor($sisa/60);

        $lama_pengambilan=$menit;
        $tglp1= $today1.' '.$ambil;
        $pendonor   = mysqli_query($dbi, "select * from pendonor where Kode='$kodependonor' ");
        $pendonor1  = mysqli_fetch_assoc($pendonor);
        $jumdonor   = $pendonor1['jumDonor']+1;
        
        if ($keberhasilan =="1"){//simpan gagal
            $tambah     =   "UPDATE htransaksi SET pengambilan='$keberhasilan',catatan='$catatan',ketBatal='Pendonor Pergi',petugas='$petugas', status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]', pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$jumdonor', `tempat`='0' WHERE (Status='1' and NoTrans='$notrans')";
            $tambah2    =   mysqli_query($dbi,$tambah);
            $tambah4    =   mysqli_query($dbi,"UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
            if ($tambah2){
                //=======Audit Trial====================================================================================
               $log_mdl ='PENGAMBILAN';
               $log_aksi='Pengambilan darah: '.$notrans.' Pendonor: '.$kodependonor.' Kantong: '.$id_kantong.' status: '.$keberhasilan;
               include_once "user_log.php";
               //=====================================================================================================
                
                if ($sample !=""){
                    //Ganti Sample menjadi No. Kantong (BadBoy151220)
                    $updatelisa     = mysqli_query($dbi,"UPDATE hasilelisa set noKantong='$id_kantong' where noKantong='$sample'");
                    $updatenat      = mysqli_query($dbi,"UPDATE hasilnat set noKantong='$id_kantong' where noKantong='$sample'");
                    $updatejadwal   = mysqli_query($dbi,"UPDATE events set stat= 1 where notrans='$notrans'");
                    $updatesampel   = mysqli_query($dbi,"UPDATE samplekode set sk_hasil= 4 where sk_notrans='$notrans'");
                }
                
                ?>
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-3">
                        <div class="alert alert-success alert-dismissable" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <strong>Data Aftap</strong> Berhasil Entry
                        </div>
                    </div>
                </div>
                <?php
                    $upantri = mysqli_query($dbi,"UPDATE antrian SET stat='1', panggil='1' WHERE NoTrans='$notrans'");
                    if ($lengan == "both"){?>
                        <META http-equiv="refresh" content="2; url=antripengambilan.php"><?php
                    } elseif ($lengan == "kiri"){?>
                        <META http-equiv="refresh" content="2; url=antriankiri.php"><?php
                    } elseif ($lengan == "kanan"){?>
                        <META http-equiv="refresh" content="2; url=antriankanan.php"><?php
                    }
                    
            }
            
        } elseif ($keberhasilan==2){
            $tambah     =   mysqli_query($dbi,"UPDATE htransaksi SET diambil='$volume_darah',reaksi='$reaksi', pengambilan='$keberhasilan',catatan='$catatan',ketBatal='12',jeniskantong='$stok1[jenis]',volumekantong='$volume_darah', nokantong='$id_kantong',petugas='$petugas', caraambil='$caraambil',status_test='2',Status='2',mu='$mu',gol_darah='$pendonor1[GolDarah]',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$jumdonor',`tempat`='0' WHERE (Status='1' and NoTrans='$notrans')");
            
            $kembali1   =   mysqli_query($dbi,"UPDATE pendonor SET tglkembali='$kembali',jumDonor='$jumdonor',mu='$mu',up=b'1',tglkembali_apheresis='$kembali' WHERE Kode='$kodependonor'");

            
            //$tambah2    =   mysqli_query($dbi,"UPDATE stokkantong SET noSelang='$id_selang' ,Status='5',hasil='5',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',sah='0', kodePendonor='$kodependonor',kadaluwarsa='$kadaluwarsa',mu='$mu' WHERE noKantong='$id_kantong'");
            
            $tambah2    =   mysqli_query($dbi,"UPDATE stokkantong SET Status='5',hasil='5',tgl_Aftap='$today',gol_darah='$GolDarah',RhesusDrh='$Rhesus',sah='0', kodePendonor='$kodependonor',kadaluwarsa='$kadaluwarsa',mu='$mu' WHERE noKantong='$id_kantong'");

            $tambah3    =   mysqli_query($dbi,"UPDATE htransaksi set donorke=donorke+1 where NoTrans='$notrans' ");
            $tambah4    =   mysqli_query($dbi,"UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke >'1' ");
            if ($tambah){
                //=======Audit Trial====================================================================================
               $log_mdl ='PENGAMBILAN';
               $log_aksi='Pengambilan darah: '.$notrans.' Pendonor: '.$kodependonor.' Kantong: '.$id_kantong.' status: '.$keberhasilan;
               include_once "user_log.php";
               //=====================================================================================================
                
                if ($sample !=""){
                    //Ganti Sample menjadi No. Kantong (BadBoy151220)
                    $updatelisa     = mysqli_query($dbi,"UPDATE hasilelisa set noKantong='$id_kantong' where noKantong='$sample'");
                    $updatenat      = mysqli_query($dbi,"UPDATE hasilnat set noKantong='$id_kantong' where noKantong='$sample'");
                    $updatejadwal   = mysqli_query($dbi,"UPDATE events set stat= 1 where notrans='$notrans'");
                    $updatesampel   = mysqli_query($dbi,"UPDATE samplekode set sk_hasil= 4 where sk_notrans='$notrans'");
                }
                ?>
                <div class="row">
                    <div class="col-lg-12 col-lg-offset-3">
                        <div class="alert alert-success alert-dismissable" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <strong>Data Aftap</strong> Berhasil Entry
                        </div>
                    </div>
                </div>
                <?php
                    $upantri = mysqli_query($dbi,"UPDATE antrian SET stat='1', panggil='1' WHERE NoTrans='$notrans'");
                    if ($lengan == "both"){?>
                        <META http-equiv="refresh" content="2; url=antripengambilan.php"><?php
                    } elseif ($lengan == "kiri"){?>
                        <META http-equiv="refresh" content="2; url=antriankiri.php"><?php
                    } elseif ($lengan == "kanan"){?>
                        <META http-equiv="refresh" content="2; url=antriankanan.php"><?php
                    }
                    
            }
            
        } elseif  ($keberhasilan =="0"){ //jika berhasil
            //Update Htransaksi
                $tambah= "UPDATE htransaksi SET diambil='$volume_darah',reaksi='$reaksi', pengambilan='$keberhasilan',catatan='$catatan',ketBatal='-',jeniskantong='$stok1[jenis]',volumekantong='$stok1[volumeasal]', nokantong='$id_kantong',petugas='$petugas', caraambil='$caraambil',status_test='2',Status='2',mu='',gol_darah='$pendonor1[GolDarah]',jam_ambil='$ambil', jam_selesai='$selesai',rhesus='$pendonor1[Rhesus]',jk='$pendonor1[Jk]',pekerjaan='$pendonor1[Pekerjaan]',umur='$pendonor1[umur]',donorke='$jumdonor', `tempat`='0' WHERE (Status='1' and NoTrans='$notrans')";
                //echo $tambah."<br>";
                    $htquery    = mysqli_query($dbi, $tambah);
                    //Update Htransaksi
                    $kembali1   = "UPDATE pendonor SET tglkembali='$kembali',jumDonor='$jumdonor',mu='$mu',up='1',up_data='2',tglkembali_apheresis='$kembali' WHERE Kode='$kodependonor'";
                    //echo $kembali1."<br>";
                    $pdquery    = mysqli_query($dbi, $kembali1);
                    $ono_kantong0=substr($id_kantong,0,-1);
                    //$tambah2    = "UPDATE stokkantong SET noSelang='$id_selang', Status='1',tgl_Aftap='$tglp1',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='WB',sah='0',kodePendonor='$kodependonor',statKonfirmasi='0',kadaluwarsa=(tgl_aftap + interval 35 day),mu='$mu',lama_pengambilan='$lama_pengambilan' WHERE noKantong='$id_kantong'";
            
                    $tambah2    = "UPDATE stokkantong SET  Status='1',tgl_Aftap='$tglp1',gol_darah='$GolDarah',RhesusDrh='$Rhesus',produk='WB',sah='0',kodePendonor='$kodependonor',statKonfirmasi='0',kadaluwarsa=(tgl_aftap + interval 35 day),mu='$mu',lama_pengambilan='$lama_pengambilan' WHERE noKantong='$id_kantong'";
            
                    //echo $tambah2."<br>";
                    $skquery    = mysqli_query($dbi, $tambah2);
            
                    $tambah4    = "UPDATE htransaksi set donorbaru='1' where NoTrans='$notrans' and donorke > 1 ";
                    $upvalidktg = "update ValidKantong set jum_bc='$bc_jum', jum_bcpakai='$bc_pakai', jum_bcmusnah='$bc_buang', meja='$kursi' where noKantong='$id_kantong'";
                    $updatevalid = mysqli_query($dbi, $upvalidktg);
                    //echo $tambah4."<br>";
            
            
                    //$tambah5    = "UPDATE stokkantong set noSelang='$id_selang',lama_pengambilan='$lama_pengambilan' WHERE noKantong like '$ono_kantong0%'";
                    $tambah5    = "UPDATE stokkantong set lama_pengambilan='$lama_pengambilan' WHERE noKantong like '$ono_kantong0%'";
                    $sk2query    = mysqli_query(dbi, $tambah5);
                    //echo $tambah5."<br>";
                    if ($skquery){
                        //=======Audit Trial====================================================================================
                       $log_mdl ='PENGAMBILAN';
                       $log_aksi='Pengambilan darah: '.$notrans.' Pendonor: '.$kodependonor.' Kantong: '.$id_kantong.' status: '.$keberhasilan;
                       include_once "user_log.php";
                       //=====================================================================================================
                        
                        if ($sample !=""){
                            //Ganti Sample menjadi No. Kantong (BadBoy151220)
                            $updatelisa     = mysqli_query($dbi,"UPDATE hasilelisa set noKantong='$id_kantong' where noKantong='$sample'");
                            $updatenat      = mysqli_query($dbi,"UPDATE hasilnat set noKantong='$id_kantong' where noKantong='$sample'");
                            $updatejadwal   = mysqli_query($dbi,"UPDATE events set stat= 1 where notrans='$notrans'");
                            $updatesampel   = mysqli_query($dbi,"UPDATE samplekode set sk_hasil= 4 where sk_notrans='$notrans'");
                        }
                        ?>
                        <div class="row">
                            <div class="col-lg-12 col-lg-offset-3">
                                <div class="alert alert-success alert-dismissable" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <strong>Data Aftap</strong> Berhasil Entry
                                </div>
                            </div>
                        </div>

                        <?php
                            $upantri = mysqli_query($dbi,"UPDATE antrian SET stat='1', panggil='1' WHERE NoTrans='$notrans'");
                            if ($lengan == "both"){?>
                                <META http-equiv="refresh" content="2; url=antripengambilan.php"><?php
                            } elseif ($lengan == "kiri"){?>
                                <META http-equiv="refresh" content="2; url=antriankiri.php"><?php
                            } elseif ($lengan == "kanan"){?>
                                <META http-equiv="refresh" content="2; url=antriankanan.php"><?php
                            }
                            
                    }
        
        }
    }
    //POST DATA ***********
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
  
  <link rel="stylesheet" href="../tpksolo/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css" title="currentStyle">
            @import "css/dt_page.css";
            @import "css/dt_table.css";
            @import "css/dt_table_jui.css";
        </style>
        <link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        <link type="text/css" href="../css/TableTools_JUI.css" rel="stylesheet" />
        <script type="text/javascript" language="javascript" src="../js/jquery-1.5.2.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="../js/jquery-ui-1.8.9.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
<script>
    jQuery(document).ready(function(){
      $('#instansi').autocomplete({source:'../modul/suggest_ptgsaftap.php', minLength:2});});
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
.spasi{

    width: 20px;
    
}
.spasi2{

    width: 10px;
    
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
.result{
    font-size: 24pt;
    color: black;
    #padding: 30px 10px;
    #margin-bottom: 20px;
    border-radius: 5px;
    background-color: red;
}

.button button{
    background-color: red;
    margin: 1rem;
    border: none;
    outline: none;
    height: 43px;
    width: 100px;
    font-weight: bold;
    font-size: 16px;
    border-radius: 3px;
    cursor: pointer;
    color: white;
    
}

.bgimage {
    
    background-image: url('white.jpg');
    background-size: cover;
}


</style>
<body class="bgimage">


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../tpksolo/dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

<img class="img-responsive" src="../tpksolo/dist/img/coorporatepmi.png" />

<div class="card-header">
<div align="center" style="font-size:23px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">PENYADAPAN DONOR DARAH SUKARELA</div>
  <!--a href="<?php echo $lvl;?>.php?module=donor_baru"><button name="baru" class="btn btn-warning float-right"><i class="nav-icon ion ion-ios-medkit"></i>  Donor Baru</button></a-->
</div>



  <div class="col-12 col-sm-12">
    <div class="card-body">
<!--content-->





<div class="row" align="center">
    <div class="col-lg-12">
        <!--content-->

        <form name="periksa" method="post" action="" onkeydown="return event.key != 'Enter';" >
            <div class="row">
                <div class="col-lg-12" align="right">
                    <input type=submit id="save" name="simpan" value="SIMPAN" class="btn btn-success">
                </div>
            </div>
            <p>
            <div class="row">
                <div class="col-12 col-sm-12">
                <!--row1--->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">No. Registrasi</span>
                            </div>
                            <input type="text" name="kode" class="form-control" id="iddonor" placeholder="ID KARTU DONOR" value="<?php echo $notrans;?>" onchange='disabletext(this.value);' readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Nomor Kantong</span>
                            </div>
                            <input name="id_kantong11"  id="id_kantong11" value="<?php echo $nokantong;?>" onkeydown="chang(event,this);" class="form-control" autocomplete="off" placeholder="Nomor Kantong" readonly>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Nomor Selang</span>
                            </div>
                            <input name="id_selang" id="id_selang" onkeydown="chang(event,this);" class="form-control" value="<?php echo $NoSelang;?>" autocomplete="off" placeholder="Nomor Selang" required>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Jumlah Barcode</span>
                            </div>
                            
                            <div class="spasi2"></div>
                            <input name="bc_jum" value="<?php echo $bcjum;?>" id="bc_jum" size="2" required>
                            <div class="spasi2"></div>
                            <label >Barcode<br>Digunakan</label>
                            <div class="spasi2"></div>
                            <input name="bc_pakai" id="bc_pakai" size="3" required>
                            <div class="spasi2"></div>
                            <!--label >Musnah</label>
                            <div class="spasi2"></div>
                            <input name="bc_buang" id="bc_buang" size="3" required-->
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Pengambilan</span>
                            </div>
                            <script>
                                function disabletext(val){
                                    if(val=='0'){
                                        document.getElementById('comments').disabled = true;
                                        document.getElementById('id_kantong11').disabled = false;
                                document.getElementById('id_kantong11').type = 'text';
                                        }
                                    if(val=='2'){
                                document.getElementById('id_kantong11').type = 'text';
                                        document.getElementById('comments').disabled = false;
                                    }
                                    if(val=='1'){
                                document.getElementById('comments').disabled = false;
                                document.getElementById('id_kantong11').type = 'hidden';
                                
                                        }
                                }
                            </script>
                            <div class="spasi"></div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="keberhasilan" id="inlineRadio1" value="0" checked>
                              <label class="form-check-label" for="inlineRadio1">Berhasil</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="keberhasilan" id="inlineRadio2" value="2">
                              <label class="form-check-label" for="inlineRadio2">Gagal</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="keberhasilan" id="inlineRadio3" value="1"
                              <label class="form-check-label" for="inlineRadio3">Batal</label>
                            </div>&nbsp;
                            
                            <select name="catatan" class="form-control">
                            <option value="">Pilih Jika Gagal</option>
                            <option value="Mislek">Mislek</option>
                            <option value="Saran Dokter">Saran Dokter</option>
                            <option value="Permintaan Pendonor">Permintaan Pendonor</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Diambil Sebanyak (cc)</span>
                            </div>
                            <input type="text" id="volume_darah" name="volume_darah" class="form-control" id="iddonor" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Reaksi Donor</span>
                            </div>
                            <select name="reaksi" class="form-control">
                                <option value="Mual">Mual</option>
                                <option value="Pusing">Pusing</option>
                                <option value="Pingsan">Pingsan</option>
                                <option selected value="Normal">Tidak Ada Keluhan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Cara Ambil</span>
                            </div>
                            <select name="caraambil" class="form-control">
                                <option selected value="0">Biasa</option>
                                <option value="1">Tromboferesis</option>
                                <option value="2">Leukaferesis</option>
                                <option value="3">Plasmaferesis</option>
                                <option value="4">Eritoferesis</option>
                                <option value="5">Aferesis</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">Petugas Aftap</span>
                            </div>
                                <!--input type="text"  class="form-control" name="udd" id="instansi" value="" placeholder="Kab / Kota" required-->
                                <select name="petugas" class="form-control" required>
                                    <?php
                                    $usr=mysqli_query($dbi,"select * from user where bagian like '%aftap%' order by nama_lengkap ASC");

                                    while($data = mysqli_fetch_array($usr)){
                                            echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
                                    } ?>
                                </select>
                            
                        </div>
                    </div>
                <!--row1--->
                </div>
                
            </div>
        
        <input type="hidden" id="jamambil" name="jamambil">
        <input type="hidden" id="jamstop" name="jamstop">
        <input type="hidden" name="paket" value="1">
        <input type="hidden" name="notrans" value="<?=$_GET[trans]?>">
        <input type="hidden" name="kodependonor" value="<?=$check1[KodePendonor]?>">
        <input type="hidden" name="goldarah" value="<?=$check1[gol_darah]?>">
        <input type="hidden" name="Rhesus" value="<?=$check1[rhesus]?>">
        
        </form>
        
<div align="center" style="font-size:20px; font-weight:bold;color:#000000;text-shadow: 1px 1px 1px #adaaaa; font-family:Helvetica, Arial, san-serif;">DURASI PENYADAPAN </div>
        <div class="result">
            <span id="jamskr" style="background-color: red;font-size:28px; font-weight:bold;color:yellow;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;"></span>
            <span id="spasi" style="background-color: red;font-size:28px; font-weight:bold;color:#ffffff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;"></span>
            <span id="hours" style="background-color: red;font-size:28px; font-weight:bold;color:#ffffff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">00</span>
            <span id="minutes" style="background-color: red;font-size:28px; font-weight:bold;color:#ffffff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">00</span>
            <span id="seconds" style="background-color: red;font-size:28px; font-weight:bold;color:#ffffff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">00</span>
        </div>
        <div class="button">
            <button id="start">START</button>
            <button id="stop">STOP</button>
            <button id="reset">RESET</button>
        </div>
        <!--content-->
    </div>
</div>



    </div>
</div>


<!--div class="copyright">
<p align="center">Copyright @ 2023 | UNIT DONOR DARAH PMI</p>
</div-->


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
    $(document).ready(function () {
                      $("#id_selang").keyup(function(event) {
                        if (event.keyCode === 13) {
                            document.getElementById("bc_jum").focus();
                        }
                      });
                      $("#bc_jum").keyup(function(event) {
                        if (event.keyCode === 13) {
                            document.getElementById("bc_pakai").focus();
                        }
                      });
                      $("#bc_pakai").keyup(function(event) {
                        if (event.keyCode === 13) {
                            document.getElementById("volume_darah").focus();
                        }
                      });
                      
        });
//TIMER
    window.onload = () => {
        var x = document.getElementById("save");
        var y = document.getElementById('start');
        x.disabled = true;
        
        
        let hour = 0;let minute = 0;let seconds = 0;let totalSeconds = 0;let intervalId = null;
        function startTimer() {
            ++totalSeconds;hour = Math.floor(totalSeconds /3600);minute = Math.floor((totalSeconds - hour*3600)/60);seconds = totalSeconds - (hour*3600 + minute*60);
            if(hour < 10){
                document.getElementById("hours").innerHTML ='0'+hour;
            }else{
                document.getElementById("hours").innerHTML =hour;
            }
        
            if(minute < 10){
                document.getElementById("minutes").innerHTML ='0'+minute;
            }else{
                document.getElementById("minutes").innerHTML =minute;
            }
                
            if(seconds < 10){
                document.getElementById("seconds").innerHTML ='0'+seconds;
            }else{
                document.getElementById("seconds").innerHTML =seconds;
            }
            
        }
        document.getElementById('start').addEventListener('click', () => {
            intervalId = setInterval(startTimer, 1000);
            var today = new Date();
            function addZero(i) {
                if (i < 10) {i = "0" + i}
                    return i;
            }
            var curr_hour = addZero(today.getHours());
            var curr_minute = addZero(today.getMinutes());
            var curr_second = addZero(today.getSeconds());
                                                          
            document.getElementById('jamskr').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second;
            document.getElementById('spasi').innerHTML=" | ";
            document.periksa.jamambil.value=curr_hour + ":" + curr_minute;
            y.disabled = true;
        })
        document.getElementById('stop').addEventListener('click', () => {
            if (intervalId)
            clearInterval(intervalId);
            var today = new Date();
function addZero(i) {
if (i < 10) {i = "0" + i}
return i;
}
var curr_hour = addZero(today.getHours());
var curr_minute = addZero(today.getMinutes());
            
            document.periksa.jamstop.value=curr_hour + ":" + curr_minute;
x.disabled = false;
        });
        document.getElementById('reset').addEventListener('click', () => {
            totalSeconds = 0;
            document.getElementById("hours").innerHTML = '00';
            document.getElementById("minutes").innerHTML = '00';
            document.getElementById("seconds").innerHTML = '00';
            x.disabled = true;
        });
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

<script>
function search(event) {
  let value= event.which;
  if(value === 13){
      //onkeydown="return event.key != 'Enter';"
      //call your function or anything else
      
      getkantong = document.getElementById("id_kantong11").value;
      
      
      $.ajax({
          method:"POST",
          url:"carinoselang.php",
          data: {ktg : getkantong},
          success:function(server_response){
             document.ambildarah.no_selang.value = server_response;
                          
       }
      });
      //alert('Nomor Kantong : ' + getkantong);
      document.getElementById("no_selang").focus();
  }
}
    
</script>
<!-- Bootstrap 4 -->
<script src="../tpksolo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../tpksolo/dist/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="../tpksoloplugins/jquery/jquery.min.js"></script>

</body>
</html>



