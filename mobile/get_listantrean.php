<?php
include ('../config/dbi_connect.php');
$no='0';
session_start();
$lvl= 'pmi'.$_SESSION['leveluser'];
$udd = mysqli_fetch_assoc(mysqli_query($dbi,"select id from utd where aktif='1'"));
$idudd=$udd['id'];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/getantriandonor_udd.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('udd' => $idudd),
));
$response = curl_exec($curl);
curl_close($curl);
//echo $response;
$tgl= date("Y/m/d");
$data = json_decode($response, true);
//echo var_dump($data);
//echo 'Count Data :'.count($data).'<br>';
echo '
<div class="table-responsive">
    			<table class="table table-hover table-bordered table-condensed" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
            <thead  class="pmi">
            <tr>
              <th>No</th>
              <th>Aksi</th>
              <th>No Transaksi</th>
              <th>Tgl Daftar</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Gol Darah</th>
              <th>Tgl Kembl<br>(Cloud)</th>
              <th>Tgl Kembl<br>(Lokal)</th>
              <th>Donasi</th>
              <th>Kel</th>
              <th>Tmpt Lahir</th>
              <th>Tgl Lahir</th>
              <th>HP</th>
              <th>Status</th>
              <th>Update Profile</th>
            </tr>
            </thead>
            <tbody>';
  for($a=0; $a < count($data['data']); $a++){
    $no=$a+1;
    $chkdata=strlen($data['data'][$a]['id']);
    if ($chkdata>0){
      if ($data['data'][$a]['pjk']=='0'){$kelamin="Laki-laki";}else{$kelamin="Perempuan";}
      if ($data['data'][$a]['pcekal']=='0'){$cekal="-";}else{$cekal="Konfirm";}
      //cek di lokal server
      $kodependonor=$data['data'][$a]['pkode'];
      $plokal=mysqli_fetch_assoc(mysqli_query($dbi, "select * from pendonor where `Kode`='$kodependonor'"));
      $tglkembali_lokal=$plokal['tglkembali'];
      echo  "<tr>";
      echo  "<td class='text-right' nowrap>".$no.".</td>";
      echo  '<td><a href="'.$lvl.'.php?module=mobile_ubahstatus&id='.$data['data'][$a]['id'].'&kode='.$data['data'][$a]['pkode'].'&sts=3&mode=antrean" title="Batalkan" onclick="return confirm("Are you sure to delete this item?");">X</a></td>';
      if ($cekal=='-'){
        echo  '<td nowrap> <a href="'.$lvl.'.php?module=mobile_transaksi&id='.htmlspecialchars(serialize($data['data'][$a])).'">'.$data['data'][$a]['id'].'</a></td>';
      }else{
        echo  "<td nowrap>".$data['data'][$a]['id']."</td>";
      }      
      echo  "<td>".$data['data'][$a]['tgl']."</td>";
      echo  "<td nowrap>".$data['data'][$a]['pkode']."</td>";
      echo  "<td nowrap>".$data['data'][$a]['pnama']."</td>";
      echo  "<td nowrap class='text-center'>".$data['data'][$a]['pgoldarah']." (".$data['data'][$a]['rhesus'].")</td>";
      echo  "<td nowrap>".$data['data'][$a]['ptglkembali']."</td>";
      echo  "<td nowrap>".$tglkembali_lokal."</td>";
      echo  "<td nowrap class='text-center'>".$data['data'][$a]['pjmldonor']."</td>";
      echo  "<td nowrap>".$kelamin."</td>";
      echo  "<td nowrap>".$data['data'][$a]['ptempatlahir']."</td>";
      echo  "<td nowrap>".$data['data'][$a]['ptgllahir']."</td>";
      echo  "<td nowrap>".$data['data'][$a]['ptelp2']."</td>";
      echo  "<td nowrap>".$cekal."</td>";
      echo  "<td>".$data['data'][$a]['on_update_pendonor']."</td>";
      echo  "</tr>";
    }
   }
   if ($no=='0'){
      echo '<tr>';
      echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data pendaftaran via mobile</td>';
      echo '</tr>';
   }
   echo '</tbody>
   </table>
   </div>';
?>
