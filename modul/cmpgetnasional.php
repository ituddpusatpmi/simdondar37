<?php
include ('../config/dbi_connect.php');
$no='0';
session_start();
$Kodep = $_GET['kode'];
$lvl= 'pmi'.$_SESSION['leveluser'];
$udd = mysqli_fetch_assoc(mysqli_query($dbi,"select id from utd where aktif='1'"));
$idudd=$udd['id'];
    
//CARI PENDONOR LOKAL
$lokal = mysqli_fetch_assoc(mysqli_query($dbi,"select * from pendonor where Kode='$Kodep'"));
?>

<div class="row">
  <div class="col-lg-6">
    <h3> Data Server Simdondar</H3>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-condensed" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
            <tr>
            <td nowrap>Kode Pendonor </td> <td nowrap><b><?php echo $lokal['Kode'];?></b></td>
            </tr>
            <tr>
            <td nowrap>No. KTP</td> <td nowrap><?php echo $lokal['NoKTP'];?></td>
            </tr>
            <tr>
            <td nowrap>Nama Pendonor </td> <td nowrap><?php echo $lokal['Nama'];?></td>
            </tr>
            <tr>
            <?php if($lokal['Jk']=="0"){$jk="Laki-Laki";}else{$jk="Perempuan";}?>
            <td nowrap>Jenis Kelamin</td> <td nowrap><?php  echo $jk;?></td>
            </tr>
            <tr>
            <td nowrap>Tanggal Lahir</td> <td nowrap><?php echo $lokal['TempatLhr'].", ".$lokal['TglLhr'];?></td>
            </tr>
            <tr>
            <td nowrap>Alamat</td> <td nowrap><?php echo $lokal['Alamat']." ".$lokal['kelurahan']." ".$lokal['kecamatan']." ".$lokal['wilayah'];?></td>
            </tr>
            <tr>
            <td nowrap>No. HP</td> <td nowrap><?php echo $lokal['telp2'];?></td>
            </tr>
            <tr>
            <?php if($lokal['Status']=="0"){$st="Belum Menikah";}else{$st="Sudah Menikah";}?>
            <td nowrap>Status</td> <td nowrap><?php echo $st;?></td>
            </tr>
            <tr>
            <td nowrap>Gol. Darah</td> <td nowrap><?php echo $lokal['GolDarah']." (".$lokal['Rhesus'].")";?></td>
            </tr>
            <tr>
            <td nowrap><b>Jumlah Donor</b></td> <td nowrap><b><?php echo $lokal['jumDonor'];?></b></td>
            </tr>
<tr>
<td nowrap><b>Kembali Donor</b></td> <td nowrap><b><?php echo $lokal['tglkembali'];?></b></td>
</tr>
<tr>
<?php if($lokal['Cekal']=="0"){$ck="-";}else{$ck="Cekal";}?>
<td nowrap><b>Status IMLTD</b></td> <td nowrap><b><?php echo $ck;?></b></td>
</tr>
            
        </table>
    </div>
  </div>
  <div class="col-lg-6">
<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/getcomparependonor.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('udd' => $idudd, 'kode' => $Kodep),
));
$response = curl_exec($curl);
curl_close($curl);
//echo $response;
$tgl= date("Y/m/d");
$data = json_decode($response, true);
//echo var_dump($data);
//echo 'Count Data :'.count($data).'<br>';



echo '
    <h3> Data Server Nasional</H3>
<div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">';
  for($a=0; $a < count($data['data']); $a++){
    $no=$a+1;
    $chkdata=strlen($data['data'][$a]['pkode']);
    if ($chkdata>0){
      if ($data['data'][$a]['pjk']=='0'){$kelamin="Laki-laki";}else{$kelamin="Perempuan";}
      if ($data['data'][$a]['pcekal']=='0'){$cekal="-";}else{$cekal="Konfirm";}
      
      
          echo  "<tr>";
          echo  "<td nowrap>Kode Pendonor </td> <td nowrap><b>".$data['data'][$a]['pkode']."</b></td>";
          echo  "</tr>";
          echo  "<tr>";
          echo  "<td nowrap>No. KTP</td> <td nowrap>".$data['data'][$a]['pnoktp']."</td>";
          echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Nama Pendonor </td> <td nowrap>".$data['data'][$a]['pnama']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Jenis Kelamin </td> <td nowrap>".$kelamin."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Tanggal Lahir</td> <td nowrap>".$data['data'][$a]['ptempatlahir'].", ".$data['data'][$a]['ptgllahir']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Alamat </td> <td nowrap>".$data['data'][$a]['palamat']."  ".$data['data'][$a]['pkelurahan']."  ".$data['data'][$a]['pkecamatan']."  ".$data['data'][$a]['pwilayah']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>No. HP</td> <td nowrap>".$data['data'][$a]['ptelp2']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Status</td> <td nowrap>".$data['data'][$a]['pstatus']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap>Gol. Darah</td> <td nowrap>".$data['data'][$a]['pgoldarah']." (".$data['data'][$a]['prhesus'].")</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap><b>Jumlah Donor</td> <td nowrap><b>".$data['data'][$a]['pjmldonor']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap><b>Kembali Donor</td> <td nowrap><b>".$data['data'][$a]['ptglkembali']."</td>";
        echo  "</tr>";
        echo  "<tr>";
        echo  "<td nowrap><b>Status IMLTD</td> <td nowrap><b>".$cekal."</td>";
        echo  "</tr>";
        
    }
   }
   if ($no=='0'){
      echo '<tr>';
      echo '<td colspan="16" style="font-size:20px;" class="text-center">Tidak ada data Pendonor Nasional</td>';
      echo '</tr>';
   }
   echo '</tbody>
   </table>
   </div>';
?>

</div>
</div>
<form method="POST">
<div class="row">
    <div class="col-lg-4">
            <!--button name="check" id="check" class="btn btn-info " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">Check Server Nasional</button-->
            <input type="submit" class="btn btn-danger " value="Sinkron | Data Nasional" name="submit" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
    </div>
    <div class="col-lg-8">
            
    </div>
</div>

<p>
</form>
<?php
    if (isset($_POST['submit'])) {
        //VARIABLE Jumlah Donor
            $jmAD = $data['data'][0]['pjmldonor'];
            $jmLK = $lokal['jumDonor'];
            echo "Jumlah donor ===>".$jmAD." : ".$jmLK;
            if ($jmAD ==""){$new = "1";}else{$new = "0";}
        ?>
<META http-equiv="refresh" content="0; url=pmiaftap.php?module=search_pendonor">
    <?php }
?>
