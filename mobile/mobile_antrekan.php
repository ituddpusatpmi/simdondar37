<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem InforMasi DONor DARah</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
</head>

<?php
include ('config/dbi_connect.php');
$namaudd=$_SESSION['namaudd'];
$tempat = mysqli_fetch_assoc(mysqli_query($dbi,"select * from tempat_donor where active='1'"));
$shift = mysqli_fetch_assoc(mysqli_query($dbi,"SELECT nama,jam,sampai_jam FROM `shift` WHERE (time(jam)<=current_time and time(sampai_jam)>=current_time)"));
$shif = $shift['nama'];

$data = unserialize($_GET['id']);
//echo var_dump($data);

$namauser = $_SESSION['namauser'];
$lv0='pmi'.$_SESSION['leveluser'];
$today1=date("Y-m-d H:i:s");
$today2=date("Y-m-d");
$jam_donor=date("H:i:s");
$tipe_donor='0';
if ($data['pjk']=='0'){$kel="Laki-laki";}else{$kel="Perempuan";}
if ($data['pstatus']=='0'){$nikah="Belum Menikah";}else{$nikah="Sudah Menikah";}
?>
<body style="margin-top: 20px;">
<div class="container">
  <form action="<?=$lv0?>.php?module=mobile_antrean_proses" method="post">
    <input type="hidden" name="data" value="<?php echo htmlspecialchars(serialize($data));?>">
  <div class="row">
    
      <ul class="nav nav-tabs pmi2 text-light" role="tablist" id="shadow">
        <li role="presentation" class="active"><a href="#profile" aria-controls="home" role="tab" data-toggle="tab">Profile</a></li>
        <li role="presentation"><a href="#ic" aria-controls="profile" role="tab" data-toggle="tab">Inform Concent</a></li>
      </ul>
    
      <div class="tab-content" id="shadow1">
        <div role="tabpanel" class="tab-pane active" id="profile">
          <div class="row">
            <div class="col-lg-6">
              <div class="table-responsive">
                  <table class="table table-responsive table-hover table-condensed2">
                      <tr><td>Kode</td>           <td class="warning"><?php echo $data['pkode'];?></td></tr>
                      <tr><td>No KTP</td>         <td class="warning"><?php echo $data['pnoktp'];?></td></tr>
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
                <table class="table table-responsive table-hover table-condensed2">
                  <tr><td>Pekerjaan</td>      <td class="warning"><?php echo $data['ppekerjaan'];?></td></tr>
                  <tr><td>Status</td>         <td class="warning"><?php echo $nikah;?></td></tr>
                  <tr><td>Golongan Darah</td>   <td class="warning"><?php echo $data['pgoldarah'];?></td></tr>
                  <tr><td>Rhesus</td>           <td class="warning"><?php echo $data['rhesus'];?></td></tr>
                  <tr><td>Jumlah Donor</td>     <td class="warning"><?php echo $data['pjmldonor'].' Kali';?></td></tr>
                  <tr><td>Type Penyumbangan</td>
                      <td class="warning">
                        <select class="form-control input-sm" name="pengambilan" id="pengambilan">
                            <option value="0" >Biasa</option>
                            <option value="1" >Apheresis</option>
                            <option value="3" >Plasma Konvalesen</option>
                          </select>
                      </td>
                  </tr>
                  <tr><td>Tempat Donor</td>     <td class="warning">Dalam Gedung</td></tr>
                  <tr><td>Instansi</td>         <td class="warning"><?php echo $dtd['Instansi'];?></td></tr>
                  <tr><td>Jenis Donor</td>
                      <td class="warning">
                          <select class="form-control input-sm" name="jenisdonor" id="jenisdonor">
                            <option value="0" >Sukarela</option>
                            <option value="1" >Pengganti</option>
                            <option value="3" >Autologus</option>
                          </select>
                      </td>
                  </tr>
                  <tr><td>Shif</td>     <td class="warning"><?php echo $shif;?></td></tr>
                </table>
              </div>
            </div>
            <div class="col-lg-2">
                <div id="foto_profile" class="img-hover-zoom--slowmo">
                    <img src="https://dbdonor.pmi.or.id/pmi/image/<?php echo $data['userfoto']?>" style="max-width: 100%; height: auto;"> 
                </div>
            </div>
          </div>
        </div>
      
        <div role="tabpanel" class="tab-pane" id="ic">
          <div class="row">
            <div class="col-lg-6">
              <div class="table-responsive">
                  <table class="table table-responsive table-hover table-condensed  table-bordered">
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
                  <table class="table table-responsive table-hover table-condensed table-bordered">
                      
                      <tr><td>22</td><td>Apakah anda pernah berhubungan dengan penderita hepatitis?</td>
                          <td class="warning"><?=$data['duadua'];?></td></tr>
                      <tr><td>23</td><td>Apakah anda pernah tinggal bersama penderita hepatitis?</td>
                          <td class="warning"><?=$data['duatiga'];?></td></tr>
                      <tr><td>24</td><td>Apakah anda memiliki tatto></td>
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
        </div>
    </div>
  
  <br>
  <div class="row">
    <div class="col-lg-12">
      <input type=submit name="submit" value="Proses" class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">
      <a href="<?=$lv0?>.php?module=mobile_ubahstatus&id=<?php echo $data['id'].'&kode='.$data['pkode'].'&sts=3&mode=antrean';?>" class="btn btn-danger btn-sm"  style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">Batal</a>
      <a href="<?=$lv0?>.php?module=mobile_antrean" class="btn btn-info btn-sm"  style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">Kembali</a>
    </div>
  </div>
  <br>
  </form>
</div>
</body>

<style>
  .table-condensed{
    font-size: 10px;
  }
  .table-condensed2{
    font-size: 12px;
  }
  /* Slow-motion Zoom Container */
.img-hover-zoom--slowmo img {
  transform-origin: 100% 0%;
  transition: transform 5s, filter 3s ease-in-out;
  
}

/* The Transformation */
.img-hover-zoom--slowmo:hover img {
  filter: brightness(100%);
  transform: scale(2);
}
</style>
