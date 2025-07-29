
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
  if ($data['pjk']=='0'){$kel="Laki-laki";}else{$kel="Perempuan";}
  if ($data['pstatus']=='0'){$nikah="Belum Menikah";}else{$nikah="Sudah Menikah";}
  if ($data['prhesus']=='-'){$rhes="Negatif";}else{$rhes="Positif";}
  
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!--PMI STYLE-->
  <link rel="stylesheet" href="../dist/css/bspmi.css">
</head>
<style type="text/css">
    .padding {
        
        background-image: url('../dist/img/polos.png');
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
  
        tr:nth-child(even) {
            background-color: #f0f0f0;
        }
    </style>
<body class="padding">
  <p class="box2">

<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>


  <!--isi-->
  <div class="padding2">
  <div class="row" align="center">
					<div class="col-lg-12">
          <img src="../dist/img/registrasidonor.png" width="500px">
						<!--h4><font color="black"><b>DATA PENDONOR DARAH SUKARELA<br>PMI KABUPATEN PEKALONGAN</b></font></h4--><br>
					</div>
				</div>
        <div class="row">
    <div class="col-12 col-sm-12">
    <!--form input-->
    
      <p>
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#pasien" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">DATA PENDONOR</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#ic" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">INFORMED CONSENT</a>
            </li>

          </ul>
        </div>
        <div class="card-body">
          <!--************************************TAB PAGE-->
          <div class="tab-content" id="custom-tabs-one-tabContent">
            <!--************************************TAB PAGE pendonor-->
            <div class="tab-pane fade show active" id="pasien" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
              <!--************************************cari data pendonor-->
              <div class="row">
            <div class="col-lg-4">
              <div class="table-responsive">
                  <table width=100%>
                      <tr><td>Kode Pendonor</td>           <td class="warning"><?php echo $data['pkode'];?></td></tr>
                      <tr><td>No. KTP</td>         <td class="warning"><?php echo $data['pnoktp'];?></td></tr>
                      <tr><td>Nama Pendonor</td>  <td class="warning text-danger"><strong><?php echo $data['pnama'];?></strong></td></tr>
                      <tr><td>Alamat</td>         <td class="warning"><?php echo $data['palamat'];?></td></tr>
                      <tr><td>Keluarahan</td>     <td class="warning"><?php echo $data['pkelurahan'];?></td></tr>
                      <tr><td>Kecamatan</td>      <td class="warning"><?php echo $data['pkecamatan'];?></td></tr>
                      <tr><td>Wilayah</td>        <td class="warning"><?php echo $data['pwilayah'];?></td></tr>
                      <tr><td>Kode Pos</td>       <td class="warning"><?php echo $data['pkodepos'];?></td></tr>
                      <tr><td>Jenis Kelamin</td>  <td class="warning"><?php echo $kel;?></td></tr>
                      <tr><td>Kelahiran</td>      <td class="warning"><?php echo $data['ptempatlahir'].', '.$data['ptgllahir'];?></td></tr>    
                      <tr><td>Telp</td>           <td class="warning"><?php echo $data['ptelp2'];?></td></tr> 
                    </table>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="table-responsive">
                <table width=100%>
                  <tr><td>Pekerjaan</td>      <td class="warning"><?php echo $data['ppekerjaan'];?></td></tr>
                  <tr><td>Status</td>         <td class="warning"><?php echo $nikah;?></td></tr>
                  <tr><td>Golongan Darah</td>   <td class="warning"><?php echo $data['pgoldarah'];?></td></tr>
                  <tr><td>Rhesus</td>           <td class="warning"><?php echo $rhes;?></td></tr>
                  <tr><td>Jumlah Donor</td>     <td class="warning"><?php echo $data['pjmldonor'].' Kali';?></td></tr>
                  <tr><td>Type Penyumbangan</td>
                      <td class="warning">
                        <?php if ($data['metode']=="1"){
                          echo "Biasa";
                        } else if ($data['metode']=="2"){
                          echo "Apheresis";
                        } else {
                          echo "Plasma Konvalesen";
                        }?>
                      </td>
                  </tr>
                  <tr><td>Tempat Donor</td>     <td class="warning">Dalam Gedung</td></tr>
                  <tr><td>Instansi</td>         <td class="warning">UDD PMI</td></tr>
                  <tr><td>Jenis Donor</td>
                      <td class="warning">
                          Sukarela
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
                  <tr><td>Shift</td>     <td class="warning"><?php echo $shif;?></td></tr>
                </table>
              </div>
            </div>
            <div class="col-lg-4">
            <center>
                      <div id="camera">Capture</div>                    
                            <div id="webcam">
                                <!--input type=button value="Capture" onClick="preview()"-->
                            </div>
                            <!--div id="simpan" style="display:none">
                                <input type=button value="Remove" onClick="batal()">
                                <input type=button value="Save" onClick="simpan()" style="font-weight:bold;">
                            </div-->
                            <div id="hasil"></div>
                            <p>
                              
                            <div class="row">
                              <div class="col-lg-6" align="right">
                                <button  class="btn btn-danger btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onclick="javascript:history.back()">BATALKAN</button>
                              </div>
                              <div class="col-lg-6" align="left">
                              <form action="simpandata.php" method="post">
                                  <input type="hidden" name="data" value="<?php echo htmlspecialchars(serialize($data));?>">
                                  <input type=submit  name="submit" value="CETAK FORM" class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19); height:50px;width:100px" onClick="simpan()">
                              </form>
                              </div>
                              
                            </div>
      
            </div>
          </div>              

              <!--************************************cari data pendonor-->
            </div>
            <!--************************************TAB PAGE IC-->
            <div class="tab-pane fade" id="ic" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
             <!--************************************cari data pendonor-->
             <div class="row">
            <div class="col-lg-6">
              <div class="table-responsive">
                  <table >
                      <tr><td>1</td><td>Merasa sehat pada hari ini? (tidak sedang flue/batuk/demam/pusing)</td>
                          <td class="warning"><?=$data['satu'];?></td></tr>
                      <tr><td>2</td><td>Apakah anda semalam tidur minimal 4 jam?</td>
                          <td class="warning"><?=$data['dua'];?></td></tr>
                      <tr><td>3</td><td>Apakah anda sedang minum obat?</td>
                          <td class="warning"><?=$data['tiga'];?></td></tr>
                      <tr><td>4</td><td>Apakah anda minum jamu?</td>
                          <td class="warning"><?=$data['empat'];?></td></tr>
                      <tr><td>5</td><td>Apakah anda mencabut gigi?</td>
                          <td class="warning"><?=$data['lima'];?></td></tr>
                      <tr><td>6</td><td>Apakah anda mengalami deman lebih dari 38 derajat celcius?</td>
                          <td class="warning"><?=$data['enam'];?></td></tr>
                      <tr><td>7</td><td>Apakah anada sedang hamil?</td>
                          <td class="warning"><?=$data['tujuh'];?></td></tr>
                      <tr><td>8</td><td>Apakah anda mendonorkan darah trombosit atau plasma?</td>
                          <td class="warning"><?=$data['delapan'];?></td></tr>
                      <tr><td>9</td><td>Apakah anda menerima vaksinasi atau suntikan lain?</td>
                          <td class="warning"><?=$data['sembilan'];?></td></tr>
                      <tr><td>10</td><td>Apakah anda oernah kontak dengan orang yang pernah menerima vaksinasi smallpox?</td>
                          <td class="warning"><?=$data['sepuluh'];?></td></tr>
                      <tr><td>11</td><td>Apakah anda mendonorkan 2 kantong sel darah merah melalui proses aferesis?</td>
                          <td class="warning"><?=$data['sebls'];?></td></tr>
                      <tr><td>12</td><td>Apakah anda saat ini menyusui?</td>
                          <td class="warning"><?=$data['duabls'];?></td></tr>
                      <tr><td>13</td><td>Apakah penah anda menerima transfusi darah?</td>
                          <td class="warning"><?=$data['tigabls'];?></td></tr>
                      <tr><td>14</td><td>Apakah anda pernah mendapat transplantasi, organ, jaringan atau sumsum tulang?</td>
                          <td class="warning"><?=$data['empatbls'];?></td></tr>
                      <tr><td>15</td><td>Apakah anda pernah cangkok tulang untuk kulit?</td>
                          <td class="warning"><?=$data['limabls'];?></td></tr>
                      <tr><td>16</td><td>Apakah anda pernah tertusuk jarum medis?</td>
                          <td class="warning"><?=$data['enambls'];?></td></tr>
                      <tr><td>17</td><td>Apakah anda pernah berhubungan seks dengan orang dengan HIV/AIDS?</td>
                          <td class="warning"><?=$data['tujuhbls'];?></td></tr>
                      <tr><td>18</td><td>Apakah anda pernah berhubungan seks dengan pekerja seks komersial?</td>
                          <td class="warning"><?=$data['delapanbls'];?></td></tr>
                      <tr><td>19</td><td>Apakah anda pernah berhubungan seks dengan penggunaan narkoba jarum suntik?</td>
                          <td class="warning"><?php echo $data['sembilanbls'];?></td></tr>
                      <tr><td>20</td><td>Apakah anda pernah berhubungan seks dengan pengguna konsentrat faktor pembekuan?</td>
                          <td class="warning"><?=$data['duapuluh'];?></td></tr>
                      <tr><td>21</td><td>Donor Wanita, Apakah anda pernah berhububgan seks dengan laki-laki biseksual?</td>
                          <td class="warning"><?=$data['duasatu'];?></td></tr>
		      
                    </table>
			
              </div>
            </div>
            <div class="col-lg-6">
              <div class="table-responsive">
                  <table>
                      
                      <tr><td>22</td><td>Apakah anda pernah berhubungan dengan penderita hepatitis?</td>
                          <td class="warning"><?=$data['duadua'];?></td></tr>
                      <tr><td>23</td><td>Apakah anda pernah tinggal bersama penderita hepatitis?</td>
                          <td class="warning"><?=$data['duatiga'];?></td></tr>
                      <tr><td>24</td><td>Apakah anda memiliki tatto?</td>
                          <td class="warning"><?=$data['duaempat'];?></td></tr>
                      <tr><td>25</td><td>Apakah anda menindik telinga atau bagian tubuh lainnya?</td>
                          <td class="warning"><?=$data['dualima'];?></td></tr>
                      <tr><td>26</td><td>Apakah anda sedang atau pernah mendapatkan pengobatan Sifilis atau GO (Kencing Nanah)?</td>
                          <td class="warning"><?=$data['duaenam'];?></td></tr>
                      <tr><td>27</td><td>Apakah anda pernah ditahan/dipenjara dalam waktu 72 jam?</td>
                          <td class="warning"><?=$data['duatujuh'];?></td></tr>
                      <tr><td>28</td><td>Apakah anda pernah berada diluar wilayah Indonesia?</td>
                          <td class="warning"><?=$data['duadelapan'];?></td></tr>
                      <tr><td>29</td><td>Apakah anda menerima uang, obat, atau pembayaran lainnya untuk seks?</td>
                          <td class="warning"><?=$data['duasembilan'];?></td></tr>
                      <tr><td>30</td><td>Laki-laki : Apakah anda pernah berhubungan seksual dengan laki-laki, walaupun sekali?</td>
                          <td class="warning"><?=$data['tigapuluh'];?></td></tr>
                      <tr><td>31</td><td>Apakah anda tinggal selama 5 tahun atau lebih di Eropa?</td>
                          <td class="warning"><?=$data['tigasatu'];?></td></tr>
                      <tr><td>32</td><td>Apakah anda pernah menerima transfusi darah di Inggris?</td>
                          <td class="warning"><?=$data['tigadua'];?></td></tr>
                      <tr><td>33</td><td>Apakah anda tinggal selama 3 bulan atau lebih di Inggris?</td>
                          <td class="warning"><?=$data['tigatiga'];?></td></tr>
                      <tr><td>34</td><td>Apakah anda pernah mendapat hasil Positif untuk test HIV/AIDS?</td>
                          <td class="warning"><?=$data['tigaempat'];?></td></tr>
                      <tr><td>35</td><td>Apakah anda menggunakan jarum suntik untuk obat-obatan?</td>
                          <td class="warning"><?=$data['tigalima'];?></td></tr>
                      <tr><td>36</td><td>Apakah anda menggunakan konsentrat pembekuan?</td>
                          <td class="warning"><?=$data['tigaenam'];?></td></tr>
                      <tr><td>37</td><td>Apakah anda menderita Hepatitis?</td>
                          <td class="warning"><?=$data['tigatujuh'];?></td></tr>
                      <tr><td>38</td><td>Apakah anda menderita Malaria?</td>
                          <td class="warning"><?=$data['tigadelapan'];?></td></tr>
                      <tr><td>39</td><td>Apakah anda menderita Kanker?</td>
                          <td class="warning"><?=$data['tigasembilan'];?></td></tr>
                      <tr><td>40</td><td>Apakah anda bermasalah dengan jantung dan atau paru?</td>
                          <td class="warning"><?=$data['empatpuluh'];?></td></tr>
                      <tr><td>41</td><td>Apakah anda menderita perdarahan atau penyakit berhubungan dengan darah?</td>
                          <td class="warning"><?=$data['empatsatu'];?></td></tr>
                      <tr><td>42</td><td>Apakah anda pernah berhubungan seksual dengan orang-orang tinggal di Afrika?</td>
                          <td class="warning"><?=$data['empatdua'];?></td></tr>
                       <tr><td>43</td><td>Apakah anda pernah tinggal di Afrika?</td>
                          <td class="warning"><?=$data['empattiga'];?></td></tr>
                    </table>
              </div>
            </div>	
			
			<!--div class="col-lg-12" >
                  	<table class="table table-responsive table-hover">
			<tr ><td align=center><a href="../formulir_donor_PDF.php?kp=<?php echo $data['pkode']?>" class="btn btn-danger btn-sm"  style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">Cetak Formulir<br>Donor</a></td></tr>
			</table>
			</div-->

          </div>

              <!--************************************cari data pendonor-->   
                
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


<?php //mysqli_close()?>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!--webcam-->
<script src="../dist/js/webcam.min.js"></script>
<script language="Javascript">
        // konfigursi webcam
        Webcam.set({
            width: 320,
            height: 240,
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
                Webcam.upload( data_uri, 'upload.php?id=<?php echo $data['pkode'];?>', function(code, text) {} );
 
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
  </body>
  </html>
