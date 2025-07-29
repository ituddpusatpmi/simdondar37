<?php
include ('../config/dbi_connect.php');
$no='0';
session_start();
$lvl= 'pmi'.$_SESSION['leveluser'];
$udd = mysqli_fetch_assoc(mysqli_query($dbi,"select id from utd where aktif='1'"));
$idudd=$udd['id'];
$query = mysqli_query($dbi,"select * from v_rs_minta_pending");
$count = mysqli_num_rows($query);
    
    
echo '
<div class="table-responsive">
    			<table class="table table-hover table-bordered table-condensed" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
            <thead  class="pmi">
            <tr>
              <th>No</th>
              <th>Aksi</th>
              <th>No Registrasi</th>
              <th>Asal Rumah Sakit</th>
              <th>Tgl Permintaan</th>
              <th>Nama Pasien</th>
              <th>Tgl Lahir</th>
              <th>Alamat</th>
              <th>Gol Darah</th>
              <th>Produk Permintaan</th>
              <th>Jenis Permintaan</th>
              <th>SPDT</th>
            </tr>
            </thead>
            <tbody>';
    $a=1;
    while ($data = mysqli_fetch_assoc($query)){
      if ($count > 0){
          if ($data['kelamin']=="L"){$kel="Laki-laki";}else{$kel="Perempuan";}
          if(($data['rhesus']=="P") OR ($data['rhesus']=="+")){
                  $rhesus = "+";
              }else{
                  $rhesus = "-";
              }
          echo  "<td>".$a++."</td>";?>
          <td nowrap><a href="pmikasir2.php?module=verifantrirs&rs=<?php echo $data['rs'];?>&kode=<?php echo $data['noformRS'];?>&norm=<?php echo $data['no_rm'];?>"><input type="button" class="swn_button_red" onclick="return confirm('Validasi Permintaan Darah? ')" value="VALIDASI"></a>
          </td>
          <?php
          echo  "<td nowrap>".$data['noformRS']."</td>";
          echo  "<td nowrap>".$data['NamaRs']."</td>";
          echo  "<td nowrap>".$data['tgl_register']."</td>";
          echo  "<td nowrap><b>".strtoupper($data['nama'])."</b><br>".$kel." (".$data['umur']." Thn)</td>";
          echo  "<td nowrap>".$data['tgl_lahir']."</td>";
          echo  "<td nowrap>".$data['alamat']."</td>";
          echo  "<td nowrap>".$data['gol_darah']." (".$rhesus.")</td>";
          echo  "<td nowrap>".$data['produk']."</td>";
              if ($data['jenis_permintaan']=="Cyto/Segera"){
          echo  "<td nowrap style='color: red;'>".$data['jenis_permintaan']."</td>";
                  } else {
          echo  "<td nowrap>".$data['jenis_permintaan']."</td>";
                  }
          echo  "<td><a href='https://enigmeds.com/pmi_online/rs/view_all.php?no_trans=$data[noformRS]&token=111213' target='_blank'><input type='button' class='swn_button_red' value='LIHAT'></a></td>";
          
      
      echo  "</tr>";
    }else{
        echo '<tr>';
        echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data pendaftaran via mobile</td>';
        echo '</tr>';
    }
   }
   
   echo '</tbody>
   </table>
   </div>';
?>
