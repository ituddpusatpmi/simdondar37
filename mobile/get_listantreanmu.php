<?php
include ('../config/dbi_connect.php');
$no='0';
session_start();
$lvl='pmi'.$_SESSION['leveluser'];
$udd = mysqli_fetch_assoc(mysqli_query($dbi,"select id from utd where aktif='1'"));
$idudd=$udd['id'];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/getmu_udd.php",
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
//echo 'Count Data :'.count($data['data']).'<br>';
echo '
<div class="table-responsive">
    <table class="table table-hover table-bordered table-condensed" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
        <thead  class="pmi">
            <tr>
              <th>No</th>
              <th>Aksi</th>
              <th>No Transaksi</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Nama</th>
              <th>Jumlah</th>
              <th>Alamat</th>
              <th>Contact Person</th>
              <th>Nomor HP CP</th>
              <th>Tgl Daftar</th>
              <th>Kode Pendaftar</th>
              <th>Nama Pendaftar</th>
              <th>HP Pendaftar</th>
            </tr>
            </thead>
            <tbody>';
  for($a=0; $a < count($data['data']); $a++){
    $no=$a+1;
    $chkdata=strlen($data['data'][$a]['id']);
    if ($chkdata>0){
        echo  "<tr>";
        echo  "<td class='text-right' nowrap>".$no.".</td>";
        echo  '<td><a href="'.$lvl.'.php?module=mobile_ubahstatusmu&id='.$data['data'][$a]['id'].'&sts=3&mode=antrean" title="Batalkan" onclick="return confirm("Anda yakin membatalkan transaksi ini?");">X</a></td>';
        echo  '<td nowrap> <a href="'.$lvl.'.php?module=mobile_transaksimu&id='.htmlspecialchars(serialize($data['data'][$a])).'">'.$data['data'][$a]['id'].'</a></td>';
        echo  "<td nowrap>".$data['data'][$a]['tgl']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['jam']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['nama']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['jml']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['alamat']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['cp']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['hp']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['on_insert']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['pkode']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['pnama']."</td>";
        echo  "<td nowrap>".$data['data'][$a]['ptelp2']."</td>";
        echo  "</tr>";
    }
   }
   if ($no=='0'){
      echo '<tr>';
      echo '<td colspan="13" style="font-size:20px;" class="text-center">Tidak ada data permintaan MU via mobile</td>';
      echo '</tr>';
   }
   echo '</tbody>
   </table>
   </div>';
?>