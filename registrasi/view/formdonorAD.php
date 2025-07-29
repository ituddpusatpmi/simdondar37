
<?php
  error_reporting (E_ALL ^ E_NOTICE);
  session_start();
  include '../adm/config.php';
  $idudd    = $_SESSION['idudd'];
  $idunit   = $_SESSION['unit'];
  $iduser   = $_SESSION['user'];

  $data = unserialize($_GET['id']);
  //echo var_dump($data);
  $today1=date("Y-m-d H:i:s");
  $today2=date("Y-m-d");
  $jam_donor=date("H:i:s");
  $tipe_donor='0';
  
  /*if ($data['Jk']=='0'){$kel="Laki-laki";}else{$kel="Perempuan";}
  if ($data['Status']=='0'){$nikah="Belum Menikah";}else{$nikah="Sudah Menikah";}
  if ($data['Rhesus']=='-'){$rhes="Negatif";}else{$rhes="Positif";}*/
  
  //Shift Petugas
  $shift  = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama,jam,sampai_jam FROM `shift` WHERE time(now()) between time(jam) AND time(sampai_jam)"));
  $shif   = $shift['nama'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PALANG MERAH INDONESIA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../tpksolo/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../tpksolo/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../tpksolo/dist/css/adminlte.min.css">
  <!--PMI STYLE-->
  <link rel="stylesheet" href="../../tpksolo/dist/css/bspmi.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../tpksolo/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../tpksolo/../plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<style type="text/css">
    .padding {
        
        background-image: url('../../tpksolo/dist/img/polos.png');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .padding2 {
        padding: 10px 10px 10px 10px;
        font-size: 14px;
    }
    .box{
    height: 200px;
    
    }
    .box2{

    height: 15px;

    }
    .box3{

      height: 10px;

      }
    .copyright{
      bottom: 0;
      width: 100%;
      position: fixed;
      height:50px;
      line-height:50px;
      background:RED;
      color:#fff;
      padding-left: 10px;
    }
    .button3 {
      border-radius: 8px;
      background-color: #159404;
      color: white;
      padding: 15px 12px;
    }

    .button4 {
      border-radius: 8px;
      background-color: #f44336;
      color: white;
      padding: 15px 12px;
    }
    table {
            margin-left: auto;
            margin-right: auto;
            font-size: 14px;
            
            table-layout:fixed;
        }
  
        td {
            border: 1px #f0f0f0;
            padding: 5px;
        }

        .diva {
            height: 425px;
            font-size: 16px;
        }

        .divb {
            height: 425px;
            font-size: 15px;
        }
  
        tr:nth-child(even) {
            background-color: #f0f0f0;
        }
    </style>
<body class="padding">
  <p class="box2">

<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../tpksolo/dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>


  <!--isi-->
  <div class="padding2">
  <div class="row" align="center">
					<div class="col-lg-12">
          <img src="../../tpksolo/dist/img/registrasidonor.png" width="500px">
						<!--h4><font color="black"><b>DATA PENDONOR DARAH SUKARELA<br>PMI KABUPATEN PEKALONGAN</b></font></h4--><br>
					</div>
				</div>
        <div class="row">
    <div class="col-12 col-sm-12">
    <!--form input-->
    
      <p>
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          
        </div>
        <div class="card-body">
        <form action="simpandataAD.php" method="post">
          <!--************************************TAB PAGE-->
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <!--************************************TAB PAGE pendonor-->
            <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <!--************************************cari data pendonor-->
              <div class="row">
            <div class="col-lg-6">
              <div class="table-responsive">
                  <table width=100%>
                      <tr><td>Kode Pendonor</td>   <td class="warning"><input type="text" name="kodep" class="form-control" value=<?php echo $data['pkode'];?> readonly></td></tr>
                      <tr><td>No. KTP</td>         <td class="warning"><input type="text" name="ktp" class="form-control" value=<?php echo $data['pnoktp'];?> required>
                              <input type="hidden" name="gol" value=<?php echo $data['pgoldarah'];;?>> 
                              <input type="hidden" name="rh" value=<?php echo $data['prhesus'];;?>>
                              <input type="hidden" name="jmldnr" value=<?php echo $data['pjmldonor'];?>>
                              <input type="hidden" name="umur" value=<?php echo $data['pumur'];?>>
                              <input type="hidden" name="tglkembali" value=<?php echo $data['ptglkembali'];?>>
                              
                      </td></tr>
                      <tr><td>Nama Pendonor</td>  <td class="warning text-danger"><strong><input type="text" name="namap" class="form-control" value="<?php echo $data['pnama'];?>" required></strong></td></tr>
                      <tr><td>Jenis Kelamin</td>  <td class="warning">
                            <?php
                                $type=$data['pjk'];
                                $checked[$type]="checked";
                            ?>
                            <input type="radio" name="jk" value="0" <?=$checked["0"]?>>
                            Laki-laki &nbsp;
                            <input type="radio" name="jk" value="1" <?=$checked["1"]?>>
                            Perempuan
                        </td></tr>
                      <tr><td>Alamat</td>         <td class="warning"><input type="text" name="alamat" class="form-control" value="<?php echo $data['palamat'];?>" required></td></tr>
                      <tr><td>Keluarahan</td>     <td class="warning"><input type="text" name="kel" class="form-control" value="<?php echo $data['pkelurahan'];?>" required></td></tr>
                      <tr><td>Kecamatan</td>      <td class="warning"><input type="text" name="kec" class="form-control" value="<?php echo $data['pkecamatan'];?>" required></td></tr>
                      <tr><td>Wilayah</td>        <td class="warning"><input type="text" name="wil" class="form-control" value="<?php echo $data['pwilayah'];?>" required></td></tr>
                      
                      
                    </table>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="table-responsive">
                <table width=100%>
                  <tr><td>No. Handphone</td>  <td class="warning"><input type="text" name="telp" class="form-control" value="<?php echo $data['ptelp2'];?>" required></td></tr>   
                  <tr><td>Tempat Lahir</td>   <td class="warning"><input type="text" name="tmp_lhr" class="form-control" value="<?php echo $data['ptempatlahir'];?>" required></td></tr>     
                  <tr><td>Tanggal Lahir</td>  <td class="warning"><input type="text" name="tgl_lhr" id="datepicker" style="width:4cm;height:0.75cm" class="form-control" value="<?php echo $data['ptgllahir'];?>" required></td></tr>     
                  <tr><td>Pekerjaan</td>      <td class="warning">
                        <select name="pekerjaan" class="form-control">
                                <?php
                                    $q="select * from pekerjaan";
                                    $do=mysqli_query($con,$q);
                                    $select="";
                                        while($datap = mysqli_fetch_assoc($do)){
                                            if ($datap['Nama']==$data['ppekerjaan']) $select='selected';
                                ?>
                                    <option value="<?=$datap['Nama']?>"<?php echo $select?>>
                                        <?php echo $datap['Nama']?>
                                    </option>
                                    <?php
                                        $select="";
                                    }?>
                        </select>

                        </td></tr>
                  <tr><td>Status Nikah</td>         <td class="warning">
                        <?php
                                    $type=$data['pstatus'];
                                    $checked["0"]='';
                                    $checked["1"]='';
                                    $checked[$type]="checked";?>
                            <input type="radio" name="nikah" value="0" <?=$checked["0"]?>>
                                Belum Nikah &nbsp;
                            <input type="radio" name="nikah" value="1" <?=$checked["1"]?>>
                                Nikah
                
                 </td></tr>
                  
                  <tr><td>Jenis Donor</td>
                      <td class="warning">
                        <select name="jenis_donor" class="form-control">
                            <option value="0">Sukarela</option>
                            <option value="1">Pengganti</option>
                        </select>
                      </td>
                  </tr>
                  
                  <tr><td>Metode Donor</td>
                      <td class="warning">
                        <select name="metode" class="form-control">
                            <option value="1">Donor Biasa</option>
                            <option value="2">Donor Apheresis</option>
                            <option value="3">Donor Plasma Konvalesen</option>
                        </select>
                      </td>
                  </tr>
                  <tr><td>Pilih Lengan Donor</td>
                      <td class="warning">
                        <select name="lengan" class="form-control">
                            <option value="0">Keduanya</option>
                            <option value="1">Kiri</option>
                            <option value="2">Kanan</option>
                        </select>
                      </td>
                  </tr>
                </table>
              </div>
            </div>
            
              <div class="col-lg-12">  
              <center>
                  <p>
                                <div class="row">
                                    <div class="col-lg-6" align="right">
                                    <input type="button" value="BATALKAN" class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onclick="history.back()">
                                    </div>
                                    <div class="col-lg-6" align="left">
                                    <!--form action="simpandata.php" method="post"-->
                                        
                                        <button class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" data-toggle="pill" href="#ic" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">LANJUTKAN</button></a>
                                        
                                    <!--/form-->
                                    </div>
                                
                                </div> 
                                    
                </div>
            </div>              

              <!--************************************cari data pendonor-->
            </div>
            <!--************************************Kuesioner1-->
            <div class="tab-pane fade" id="ic" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
             <?php 
                                function switchvalue($asal){
                                    if ($asal=="YA"||$asal=="1"){
                                        return "checked";
                                    }else{
                                        return "";
                                    }
                                }?>
                                            
             <div class="row">
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="diva">
                                        <tr><td colspan=3 style="color:blue"><b>Dalam Hari ini</b></td></tr>
                                        <tr><td width="30px">1</td><td>Merasa sehat pada hari ini? </td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no1" value="TIDAK">
                                                    <input type="checkbox" name="no1" class="onoffswitch-checkbox" id="no1" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no1"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">2</td><td>Sedang minum antibiotik?</td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no2" value="TIDAK">
                                                    <input type="checkbox" name="no2" class="onoffswitch-checkbox" id="no2" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no2"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">3</td><td>Sedang minum obat lain untuk infeksi?</td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no3" value="TIDAK">
                                                    <input type="checkbox" name="no3" class="onoffswitch-checkbox" id="no3" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no3"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 48 jam terakhir</b></td></tr>
                                        <tr><td width="30px">4</td><td>Apakah anda sedang minum aspirin atau obat yang mengandung aspirin?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no4" value="TIDAK">
                                                    <input type="checkbox" name="no4" class="onoffswitch-checkbox" id="no4" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no4"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 1 minggu terakhir</b></td></tr>     
                                        <tr><td width="30px">5</td><td>Apakah anda mengalami sakit kepala dan demam bersamaan?</td>
                                        <td><div class="onoffswitch">   
                                                    <input type="hidden" name="no5" value="TIDAK">
                                                    <input type="checkbox" name="no5" class="onoffswitch-checkbox" id="no5" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no5"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam 6 minggu terakhir</b></td></tr>
                                        <tr><td width="30px">6</td><td>Untuk donor darah wanita : apakah anda saat ini sedang hamil?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no6" value="TIDAK">
                                                    <input type="checkbox" name="no6" class="onoffswitch-checkbox" id="no6" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no6"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="diva">
                                    <tr><td colspan=3 style="color:blue"><b>Dalam waktu 8 minggu terakhir</b></td></tr>
                                        <tr><td width="30px">7</td><td>Apakah anda mendonorkan darah lengkap?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no7" value="TIDAK">
                                                    <input type="checkbox" name="no7" class="onoffswitch-checkbox" id="no7" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no7"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">8</td><td>Apakah anda menerima vaksinasi satau suntikan lainnya?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no8" value="TIDAK">
                                                    <input type="checkbox" name="no8" class="onoffswitch-checkbox" id="no8" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no8"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">9</td><td>Apakah anda pernah kontak dengan orang yang menerima vaksinasi smallpox/cacar air?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no9" value="TIDAK">
                                                    <input type="checkbox" name="no9" class="onoffswitch-checkbox" id="no9" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no9"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 16 minggu terakhir</b></td></tr>
                                        <tr><td width="30px">10</td><td>Apakah anda mendonorkan 2 kantong sel darah merah melalui proses aferesis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no10" value="TIDAK">
                                                    <input type="checkbox" name="no10" class="onoffswitch-checkbox" id="no10" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no10"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 6 bulan terakhir</b></td></tr>
                                        <tr><td width="30px">11</td><td>Apakah anda pernah mengunjungi daerah endemis malaria?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no11" value="TIDAK">
                                                    <input type="checkbox" name="no11" class="onoffswitch-checkbox" id="no11" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no11"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 12 bulan terakhir</b></td></tr>
                                        <tr><td width="30px">12</td><td>Apakah anda pernah menerima transfusi darah?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no12" value="TIDAK">
                                                    <input type="checkbox" name="no12" class="onoffswitch-checkbox" id="no12" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no12"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        
                                    
                                    </table>
                                </div>
                            </div>
                </div>
                            <p>
                            <div class="row">
                              <div class="col-lg-6" align="right">
                              <input type="button" value="BATALKAN" class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onclick="history.back()">
                              </div>
                              <div class="col-lg-6" align="left">
                              <!--form action="simpandata.php" method="post"-->
                                  
                              <button class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" data-toggle="pill" href="#ic2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">LANJUTKAN</button>
                                  
                              <!--/form-->
                              </div>
                              
                            </div>                      
          </div>

              <!--************************************Kuesioner2-->   
                <div class="tab-pane fade" id="ic2" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="row">
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="diva">
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 12 bulan terakhir</b></td></tr>
                                        <tr><td width="30px">13</td><td>Apakah anda pernah mendapat transplantasi, organ, jaringan atau sumsum tulang?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no13" value="TIDAK">
                                                    <input type="checkbox" name="no13" class="onoffswitch-checkbox" id="no13" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no13"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">14</td><td>Apakah anda pernah cangkok organ?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no14" value="TIDAK">
                                                    <input type="checkbox" name="no14" class="onoffswitch-checkbox" id="no14" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no14"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">15</td><td>Apakah anda pernah tertusuk jarum medis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no15" value="TIDAK">
                                                    <input type="checkbox" name="no15" class="onoffswitch-checkbox" id="no15" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no15"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">16</td><td>Apakah anda pernah berhubungan seks dengan orang dengan HIV/AIDS?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no16" value="TIDAK">
                                                    <input type="checkbox" name="no16" class="onoffswitch-checkbox" id="no16" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no16"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">17</td><td>Apakah anda pernah berhubungan seks dengan pekerja seks komersial?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no17" value="TIDAK">
                                                    <input type="checkbox" name="no17" class="onoffswitch-checkbox" id="no17" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no17"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">18</td><td>Apakah anda pernah berhubungan seks dengan penggunaan narkoba jarum suntik?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no18" value="TIDAK">
                                                    <input type="checkbox" name="no18" class="onoffswitch-checkbox" id="no18" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no18"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="diva">
                                    <tr><td colspan=3 style="color:blue"><b>Dalam waktu 12 bulan terakhir</b></td></tr>
                                        <tr><td width="30px">19</td><td>Apakah anda pernah berhubungan seks dengan pengguna konsentrat faktor pembekuan?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no19" value="TIDAK">
                                                    <input type="checkbox" name="no19" class="onoffswitch-checkbox" id="no19" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no19"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">20</td><td>Donor Wanita, Apakah anda pernah berhububgan seks dengan laki-laki biseksual?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no20" value="TIDAK">
                                                    <input type="checkbox" name="no20" class="onoffswitch-checkbox" id="no20" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no20"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">21</td><td>Apakah anda pernah berhubungan dengan penderita hepatitis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no21" value="TIDAK">
                                                    <input type="checkbox" name="no21" class="onoffswitch-checkbox" id="no21" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no21"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                            <tr><td width="30px">22</td><td>Apakah anda pernah tinggal bersama penderita hepatitis?</td>
                                            <td><div class="onoffswitch">
                                                    <input type="hidden" name="no22" value="TIDAK">
                                                    <input type="checkbox" name="no22" class="onoffswitch-checkbox" id="no22" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no22"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">23</td><td>Apakah anda memiliki tatto?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no23" value="TIDAK">
                                                    <input type="checkbox" name="no23" class="onoffswitch-checkbox" id="no23" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no23"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">24</td><td>Apakah anda menindik telinga atau bagian tubuh lainnya</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no24" value="TIDAK">
                                                    <input type="checkbox" name="no24" class="onoffswitch-checkbox" id="no24" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no24"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                    </table>
                                </div>
                            </div>
                </div>
                            <p>
                            <div class="row">
                              <div class="col-lg-6" align="right">
                              <input type="button" value="BATALKAN" class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onclick="history.back()">
                              </div>
                              <div class="col-lg-6" align="left">
                              <!--form action="simpandata.php" method="post"-->
                                  
                              <button class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" data-toggle="pill" href="#ic3" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">LANJUTKAN</button>
                                  
                              <!--/form-->
                              </div>
                              
                            </div>   
                </div><!--selesai-->    
                <!------------------Kuesioner 3-->
                <div class="tab-pane fade" id="ic3" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="row">
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="diva">
                                    <tr><td width="30px">25</td><td>Apakah anda sedang atau pernah mendapatkan pengobatan Sifilis atau GO (Kencing Nanah)?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no25" value="TIDAK">
                                                    <input type="checkbox" name="no25" class="onoffswitch-checkbox" id="no25" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no25"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">26</td><td>Apakah anda pernah ditahan/dipenjara dalam waktu 72 jam?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no26" value="TIDAK">
                                                    <input type="checkbox" name="no26" class="onoffswitch-checkbox" id="no26" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no26"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 1 tahun</b></td></tr>
                                        <tr><td width="30px">27</td><td>Apakah anda menetap diberbagai alamat yang berbeda?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no27" value="TIDAK">
                                                    <input type="checkbox" name="no27" class="onoffswitch-checkbox" id="no27" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no27"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dalam waktu 3 tahun</b></td></tr>
                                        <tr><td width="30px">28</td><td>Apakah anda pernah berada diluar wilayah Indonesia?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no28" value="TIDAK">
                                                    <input type="checkbox" name="no28" class="onoffswitch-checkbox" id="no28" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no28"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Dari tahun 1980 sampai dengan sekarang</b></td></tr>
                                        <tr width="30px"><td width="30px">29</td><td>Apakah anda tinggal selama 5 tahun atau lebuh di Eropa?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no29" value="TIDAK">
                                                    <input type="checkbox" name="no29" class="onoffswitch-checkbox" id="no29" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no29"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr width="30px"><td>30</td><td>Apakah anda menerima transfusi darah di Inggris?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no30" value="TIDAK">
                                                    <input type="checkbox" name="no30" class="onoffswitch-checkbox" id="no30" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no30"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="diva">
                                    <tr><td colspan=3 style="color:blue"><b>Dari tahun 1980 sampai dengan 1996</b></td></tr>
                                        <tr width="30px"><td>31</td><td>Apakah anda tinggal selama 3 bulan atau lebih di Inggris?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no31" value="TIDAK">
                                                    <input type="checkbox" name="no31" class="onoffswitch-checkbox" id="no31" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no31"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td colspan=3 style="color:blue"><b>Apakah anda pernah</b></td></tr>
                                        <tr><td width="30px">32</td><td>Apakah anda menerima uang, obat atau pembayaran lain untuk seks?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no32" value="TIDAK">
                                                    <input type="checkbox" name="no32" class="onoffswitch-checkbox" id="no32" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no32"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">33</td><td>Laki-laki : Apakah anda pernah berhubungan seksual dengan laki-laki, walaupun sekali?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no33" value="TIDAK">
                                                    <input type="checkbox" name="no33" class="onoffswitch-checkbox" id="no33" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no33"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">34</td><td>Mendapat hasil positif untuk tes HIV/AIDS?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no34" value="TIDAK">
                                                    <input type="checkbox" name="no34" class="onoffswitch-checkbox" id="no34" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no34"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">35</td><td>Apakah anda pernah melakukan bekam/fasdhu?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no35" value="TIDAK">
                                                    <input type="checkbox" name="no35" class="onoffswitch-checkbox" id="no35" tabindex="1" value="YA">
                                                    <label class="onoffswitch-label" for="no35"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr width="30px"><td>36</td><td>Apakah anda menggunakan jarum suntik untuk obat-obatan, Steroid yang tidak diresepkan dokter?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no36" value="TIDAK">
                                                    <input type="checkbox" name="no36" class="onoffswitch-checkbox" id="no36" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no36"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                    </table>
                                </div>
                            </div>
                </div>
                            <p>
                            <div class="row">
                              <div class="col-lg-6" align="right">
                              <input type="button" value="BATALKAN" class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onclick="history.back()">
                              </div>
                              <div class="col-lg-6" align="left">
                              <!--form action="simpandata.php" method="post"-->
                                  
                              <button class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" data-toggle="pill" href="#ic4" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">LANJUTKAN</button>
                                  
                              <!--/form-->
                              </div>
                              
                            </div>   
                </div><!--selesai-->  
                <!--------------------------Kuesioner 4---->
                <!------------------Kuesioner 3-->
                <div class="tab-pane fade" id="ic4" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                <div class="row">
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="diva">
                                    <tr><td width="30px">37</td><td>Apakah anda menggunakan konsentrat pembekuan?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no37" value="TIDAK">
                                                    <input type="checkbox" name="no37" class="onoffswitch-checkbox" id="no37" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no37"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">38</td><td>Apakah anda menderita Hepatitis?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no38" value="TIDAK">
                                                    <input type="checkbox" name="no38" class="onoffswitch-checkbox" id="no38" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no38"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">39</td><td>Apakah anda menderita Malaria?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no39" value="TIDAK">
                                                    <input type="checkbox" name="no39" class="onoffswitch-checkbox" id="no39" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no39"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">40</td><td>Apakah anda menderita Kanker termasuk leukimia?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no40" value="TIDAK">
                                                    <input type="checkbox" name="no40" class="onoffswitch-checkbox" id="no40" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no40"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                            <tr><td width="30px">41</td><td>Apakah anda bermasalah dengan jantung dan atau paru?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no41" value="TIDAK">
                                                    <input type="checkbox" name="no41" class="onoffswitch-checkbox" id="no41" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no41"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">42</td><td>Apakah anda menderita perdarahan atau penyakit berhubungan dengan darah?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no42" value="TIDAK">
                                                    <input type="checkbox" name="no42" class="onoffswitch-checkbox" id="no42" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no42"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">43</td><td>Apakah anda pernah berhubungan seksual dengan orang-orang tinggal di Afrika?</td>
                                        <td><div class="onoffswitch">
                                                    <input type="hidden" name="no43" value="TIDAK">
                                                    <input type="checkbox" name="no43" class="onoffswitch-checkbox" id="no43" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no43"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                        <tr><td width="30px">44</td><td>Apakah anda pernah tinggal di Afrika?</td>
                                                    <td><div class="onoffswitch">
                                                    <input type="hidden" name="no43" value="TIDAK">
                                                    <input type="checkbox" name="no43" class="onoffswitch-checkbox" id="no43" tabindex="1" value="YA" >
                                                    <label class="onoffswitch-label" for="no43"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>
                                            </div></td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="table-responsive" id="shadow1">
                                    <table class="divb">
                                    <tr><td align="center">
                                     <!---camera-->
                                <div id="camera">Capture</div>                    
                                    <div id="webcam">
                                    </div>
                                    
                                    <div id="hasil"></div>
                                    
                                    </td></tr>    
                                    <tr><td>Saya telah mendapatkan dan membaca semua informasi yang diberikan serta menjawab pertanyaan dengan jujur. Saya mengerti dan bersedia
                                            meyumbangkan darah dengan volume sesuai standar yang diberlakukan dan setuju diambil contoh darahnya untuk keperluan pemeriksaan
                                            laboratorium berupa uji golongan darah, HIV, Hepatitis B, Hepatitis C, Sifilis dan infeksi lainnya yang diperlukan saya serta untuk kepentingan
                                            penelitian. Bila ternyata hasil pemeriksaan laboratorium perlu ditindaklanjuti, maka saya setuju untuk diberi kabar tertulis. Jika komponen plasma
                                            tidak terpakai untuk transfusi, saya setuju dapat dijadikan produk plasma untuk pengobatan</td></tr>
                                    <tr><td>
                                    <div class="row">
                                    <div class="col-lg-6" align="right">
                                        <input type="button" value="BATAL" class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onclick="history.back()">
                                    </div>
                                    <div class="col-lg-6" align="left">
                                    <!--form action="simpandata.php" method="post"-->
                                        
                                        <input type="submit" name="setuju" value="SETUJU" class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onClick="simpan()">
                                        
                                    </form>
                                    </div>
                                
                                    </div>
                                    </td></tr>
                                    </table>
                                </div>
                            </div>
                </div>
                            
                </div>  
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>

    </div>

  </div>
  </div>
  <!--isi-->





<!--div class="copyright">
  <p align="center">Copyright @ 2021 | PALANG MERAH INDONESIA
</div-->


<?php//mysqli_close()?>
  <!-- jQuery -->
  <script src="../../tpksolo/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../tpksolo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../tpksolo/dist/js/adminlte.min.js"></script>
  <!--webcam-->
<script src="../../tpksolo/dist/js/webcam.min.js"></script>
<script language="Javascript">
        // konfigursi webcam
        Webcam.set({
            width: 300,
            height: 200,
            image_format: 'jpg',
            jpeg_quality: 80
        });
        Webcam.attach( '#camera' );
 
        function preview() {
            // untuk preview gambar sebelum di upload
            Webcam.freeze();
            // ganti display webcam menjadi none dan simpan menjadi terlihat
            document.getElementById('webcam').style.display = 'none';
            document.getElementById('simpan').style.display = '';
        }
        
        function batal() {
            // batal preview
            Webcam.unfreeze();
            
            // ganti display webcam dan simpan seperti semula
            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
        }
        
        function simpan() {
            // ambil foto
            Webcam.freeze();

            Webcam.snap( function(data_uri) {
                
                // upload foto
                Webcam.upload( data_uri, 'upload.php?id=<?php echo $data['Kode'];?>', function(code, text) {} );
 
                // tampilkan hasil gambar yang telah di ambil
                document.getElementById('hasil').innerHTML = 
                    '<p>Hasil : </p>' + 
                    '<img src="'+data_uri+'"/>';
                
                Webcam.unfreeze();
            
                document.getElementById('webcam').style.display = '';
                document.getElementById('simpan').style.display = 'none';
            } );
        }
    </script>
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
  </body>
  </html>
