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
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
	$('#instansi').autocomplete({source:'modul/suggest_zip.php', minLength:2});
	});
</script>
</head>

<?php
$lanjut='0';
include ('config/dbi_connect.php');
$namaudd=$_SESSION['namaudd'];
$level = 'pmi'.$_SESSION['leveluser'];
$id_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where nama='$namaudd'"));
$id_udd=$id_udd['id'];
$data = unserialize($_GET['id']);
//echo var_dump($data);
$namauser = $_SESSION['namauser'];
$tgl_skr=date("Y-m-d H:i:s");
$jam_skr=date("Y-m-d");
$msg='';
if (isset($_POST['submit'])){
  $msg .='Proses kegiatan mobile unit<br>';
  $v_id   = $_POST['id_trans'];
  $v_tgl  = $_POST['tgl'];
  $v_jam  = $_POST['jam'];
  $v_jml  = $_POST['jml'];
  $v_lat  = $_POST['lat'];
  $v_lng  = $_POST['lng'];
  $v_inst_mobile = $_POST['inst_mobile'];
  $v_inst_pilih  = $_POST['inst_lokal'];
  $v_inst_kategori=$_POST['inst_kategori'];
  $v_alamat = $_POST['alamat'];
  $v_kel    = $_POST['kel'];
  $v_kec    = $_POST['kec'];
  $v_kab    = $_POST['kab'];
  $v_prov   = $_POST['prov'];
  $v_cp     = $_POST['cp'];
  $v_hp     = $_POST['hp'];
  if ($v_inst_pilih=='-'){
    $msg .= 'Penambahan data instansi<br>';
    //=====generated kode=============
    $prefik =substr($v_inst_mobile,0,2);
    $kode=mysqli_query($dbi,"select cast(substring(KodeDetail,3) as unsigned) as kd from detailinstansi where KodeDetail like '$prefik%' order by kd DESC");
    $kode=mysqli_fetch_assoc($kode);
    $kode=$kode['kd'];
    $int_kode = (int)$kode;
    $next_int=$int_kode+1;
    $j_nol1= 4-(strlen(strval($next_int)));
    $nol='';
	  for ($i=0; $i<$j_nol1; $i++){$nol .="0";}
    $kodedetail=$prefik.$nol.$next_int;
    //==================================
    $ins_inst="INSERT INTO `detailinstansi`(`KodeDetail`, `KodeHeader`, `nama`, `alamat`, `telp`, `cp`) 
               VALUES ('$kodedetail', '$v_inst_kategori', '$v_inst_mobile', '$v_alamat', '$v_hp', '$v_cp')";
    $result=mysqli_query($dbi,$ins_inst);
    if ($result){
      $v_inst_pilih = $kodedetail;
        $msg .='Penambahan data baru instansi berhasil<br>';
    }else{
        $msg .='Penambahan instansi GAGAL<br>';
        $lanjut='1';
    }
  } else {
        $msg .='Instansi : '.$v_inst_pilih.'<br>';
  }
  //tambah kegiatan
  $tgl_pelaksanaan= $v_tgl.' '.$v_jam;
  $mu="INSERT INTO kegiatan (kodeinstansi, jumlah, lat, lng, TglPenjadwalan, tempat, id_udd, cp,hpcp,jammulai, TglPelaksanaan)
        VALUES ('$v_inst_pilih','$v_jml', '$v_lat', '$v_lng', '$v_tgl','$v_inst_pilih', '$id_udd', '$v_cp', '$v_hp','$v_jam','$tgl_pelaksanaan')";
  $result=mysqli_query($dbi,$mu);
  if ($result){
    $msg .='Penambahan data kegiatan mobile unit berhasil<br>';
  }else{
    $msg .='Penambahan data kegiatan mobile unit GAGAL<br>';
    $lanjut='1';
  }
  if ($lanjut=='0'){
    $curl = curl_init();
    $idtransaksi=$v_id;
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/update_antrean_mu.php",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => array('idtransaksi' => $idtransaksi,'status' => '1', 'pesan' => 'Pengajuan kegiatan donor Anda sudah diverifikasi', 'statinbox' => '3'),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $msg .= 'Update Antrean Mobile Unit<br>';
  }
  echo '
  <div class="container" style="margin-top: 50px;">
  <div class="row">
    <div class="col-lg-6">
      <h4>'.$msg.'</h4>
    </div>
  </div>
</div>';
?><META http-equiv="refresh" content="5; url=<?=$level?>.php?module=mobile_antreanmu"><?php
 
} else {
?>
<body style="margin-top: 20px;">
<div class="container">
  <form action="<?=$level?>.php?module=mobile_transaksimu" method="POST">
    <input type="hidden" name="data" value="<?php echo htmlspecialchars(serialize($data));?>">
  <div class="row">
    
      <ul class="nav nav-tabs pmi2 text-light" role="tablist" id="shadow">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Permintaan MU</a></li>
        <li role="presentation"><a href="#peta" aria-controls="peta" role="tab" data-toggle="tab">Peta Lokasi</a></li>
      </ul>
    
      <div class="tab-content" id="shadow1">
        <div role="tabpanel" class="tab-pane active" id="home">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-10">
              <div class="table-responsive">
                  <table class="table table-responsive table-hover table-condensed2">
                      <tr><td>Transaksi</td>        <td class="warning"><?php echo $data['id'];?><input type="hidden" name="id_trans" value="<?php echo $data['id'];?>"></td></tr>
                      <tr><td>Tanggal</td>          <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="tgl" value="<?php echo $data['tgl'];?>"></td></tr>
                      <tr><td>Jam</td>              <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="jam" value="<?php echo $data['jam'];?>"></td></tr>
                      <tr><td>Target</td>           <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="jml" value="<?php echo $data['jml'];?>"></td></tr>
                      <tr><td>Instansi</td>         <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="inst_mobile" value="<?php echo $data['nama'];?>"></td></tr>
                      <tr><td>Kategori</td>         <td class="warning select-grid">
                        <select class="form-control input-sm" name="inst_kategori" id="ints_kategori">
                            <?php 
                                $inst=mysqli_query($dbi,"SELECT `kode`,`Nama` FROM `headerinstansi` order by `nama` ASC");
                                while ($dt=mysqli_fetch_assoc($inst)){
                                    if (strtoupper($data['kategori'])==strtoupper($dt['Nama'])){
                                        echo '<option value="'.$dt['kode'].'" selected>'.$dt['Nama'].'</option>';
                                    }else{
                                        echo '<option value="'.$dt['kode'].'">'.$dt['Nama'].'</option>';
                                    }
                                }
                            ?>
                          </select>
                      </td>
                      <tr><td>Konfirmasi Instansi</td>         
                        <td class="warning select-grid">
                        <select class="form-control input-sm" name="inst_lokal" id="ints_lokal">
                                <option value='-'>Instansi Baru</option>
                            <?php 
                                $cr_instansi='';
                                $qsrc=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `KodeDetail`,`nama` FROM `detailinstansi` WHERE `nama` like '%$data[nama]%'"));
                                $cr_instansi=$qsrc['nama'];
                                $inst=mysqli_query($dbi,"SELECT `KodeDetail`,`nama` FROM `detailinstansi` order by `nama` ASC");
                                while ($dt=mysqli_fetch_assoc($inst)){
                                  if (strtoupper($cr_instansi)==strtoupper($dt['nama'])){
                                    echo '<option value="'.$dt['KodeDetail'].'" selected>'.$dt['nama'].'</option>';
                                  }else{
                                    echo '<option value="'.$dt['KodeDetail'].'">'.$dt['nama'].'</option>';
                                  }
                                }
                            ?>
                          </select>
                      </td>
                      </tr>
                      <tr><td>Alamat</td>           <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="alamat" value="<?php echo $data['alamat'];?>"></td></tr>
                      <tr><td>Keluarahan</td>       <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="kel" value="<?php echo $data['nama_kelurahan'];?>"></td></tr>
                      <tr><td>Kecamatan</td>        <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="kec" value="<?php echo $data['nama_kecamatan'];?>"></td></tr>
                      <tr><td>Kab/Kota</td>         <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="kab" value="<?php echo $data['nama_kabkota'];?>"></td></tr>
                      <tr><td>Provinsi</td>         <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="prov" value="<?php echo $data['nama_propinsi'];?>"></td></tr>
                      <tr><td>Contact Person</td>   <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="cp" value="<?php echo $data['cp'];?>"></td></tr>
                      <tr><td>Mobile CP</td>        <td class="warning input-grid" style="margin:0px;"><input class="form-control" type="text" name="hp" value="<?php echo $data['hp'];?>"></td></tr>
                      <tr><td>Pendaftar</td>   <td class="warning"><?php echo $data['pelapor'].' '.$data['pnama'];?></td></tr>
                    </table>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2">
                <h4>Foto Tempat Kegiatan</h4>
                <div id="foto_profile" class="img-hover-zoom--slowmo">
                    <img src="https://dbdonor.pmi.or.id/pmi/api/mobileunit/<?php echo $data['foto'];?>" style="max-width: 100%; height: auto;"> 
                </div>
            </div>
          </div>
        </div>
      
        <div role="tabpanel" class="tab-pane" id="peta">
          <div class="row">
            <div class="col-lg-10">
	<?
		$lat=$data['lat'];
		$lng=$data['lng'];
	?>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAxfJQlGpCqxwpHPZCQKc9NFkJb32zPJs&callback=initialize" async defer></script>
                <script type="text/javascript">
                var marker;
  
                function buatMarker(peta, posisiTitik){
                    if( marker ){
                      marker.setPosition(posisiTitik);
                    } else {
                      marker = new google.maps.Marker({
                        position: posisiTitik,
                        map: peta
                      });
                    }
                    document.getElementById("lat").value = posisiTitik.lat();
                    document.getElementById("lng").value = posisiTitik.lng();
                    
                }
               
                function initialize() {
                  
                  var propertiPeta = {
                    center: new google.maps.LatLng(<?php echo $lat;?>,<?php echo $lng;?>),
                    zoom: 18,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                  };

                  
                  
                  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
                  google.maps.event.addListener(peta, 'click', function(event) {
                    buatMarker(this, event.latLng);
                  });
                  
                }
                function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                  infoWindow.setPosition(pos);
                  infoWindow.setContent(
                    browserHasGeolocation
                      ? "Error: The Geolocation service failed."
                      : "Error: Your browser doesn't support geolocation."
                  );
                  infoWindow.open(peta);
                }

		
                
                </script>
		
                <div id="googleMap" style="width:100%;height:500px;"></div>
            </div>
            <div class="col-lg-2">
              <input type="text" class="form-control input-sm" id="lat" name="lat" value="<?php echo $data['lat']?>">
              <input type="text" class="form-control input-sm" id="lng" name="lng" value="<?php echo $data['lng']?>">
            </div>
          </div>
        </div>
    </div>
  
  <br> 
  <div class="row">
    <div class="col-lg-12">
      <input type=submit name="submit" value="Proses" class="btn btn-success btn-sm" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">
      <a href="<?=$level?>.php?module=mobile_ubahstatusmu&id=<?php echo $data['id'].'&kode='.$data['pkode'].'&sts=3&mode=antrean';?>" class="btn btn-danger btn-sm"  style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">Batal</a>
      <a href="<?=$level?>.php?module=mobile_antreanmu" class="btn btn-info btn-sm"  style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);">Kembali</a>
    </div>
  </div>
  <br>
  </form>
</div>
</body>
<?php } ?>

<style>
.table td.input-grid input {
    font-size:12px;
    background-color : white; 
    position: absolute;
    display: block;
    top:0;
    left:0;
    margin: 0;
    height: 100%;
    width: 100%;
    border: solid 0.5;
    padding: 1;
    box-sizing: border-box;
    text-align:left;
}
.table td.select-grid select{
    position: absolute;
    display: block;
    top:0;
    left:0;
    margin: 0;
    border: none;
    width: 100%;
    height: 100%;
    padding: 0px;
    border-radius: 0;
    border: 1px solid #CCC;
    box-sizing: border-box;
    background-color : #FFFAF0;  
}
table td {
  position: relative;
}
  .table-condensed{
    font-size: 12px;
    
  }
  .table-condensed2{
    font-size: 13px;
  }
.img-hover-zoom--slowmo img {
  transform-origin: 100% 0%;
  transition: transform 5s, filter 3s ease-in-out;
}
.img-hover-zoom--slowmo:hover img {
  filter: brightness(100%);
  transform: scale(2);
}
</style>
