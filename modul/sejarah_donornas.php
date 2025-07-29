<?php
if (isset($_GET['q'])) {


$today  =   date('Y-m-d H:i:s');
$q      =   $_GET['q'];
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://dbdonor.pmi.or.id/pmi/api/simdondar/historidonor.php",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => array('KodePendonor' => $q),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    //echo $response;
    $tgl    = date("Y/m/d");
    $data   = json_decode($response, true);
    //echo "<pre>"; print_r($response); echo "</pre>";
    //echo "Kode Pendonor  => ".$q;
?>

<table class="table table-hover dataTable table-striped w-full table-bordered dt-responsive nowrap table-sm" id="exampleTableSearch">
<tr>
    <th colspan=4><b>INFO HISTORY DONOR</b></th>
</tr>
</table>

<table width="100%" border="1" class="table table-hover dataTable table-striped w-full table-bordered dt-responsive nowrap table-sm" id="exampleTableSearch">
    <tr style="background-color:#FF6346;  color:#FFFFFF; font-family:Verdana;">
        <td>No.</td>
        <td>Tanggal</td>
        <td>Berat Badan </td>
        <td>Tensi</td>
        <td>Hemmoglobin</td>
        <td>Tempat</td>
        <td>Status</td>
    </tr>
    <?php
    for($a=0; $a < count($data['data']); $a++){
    $no=$a+1;
    $chkdata=strlen($data['data'][$a]['tgl1']);
        if ($chkdata>0){
            if ($data['data'][$a]['Pengambilan']=='Dibatalkan'){$style = "style=background-color:#f7d9a6; font-size:12px;";}else{$style = "style=background-color:#FFFFFF; font-size:12px;";}
            ?>
        <tr <?php echo $style;?> onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td><?php echo $no;?></td>
            <td><?php echo $data['data'][$a]['Tgl']; ?></td>
            <td><?php echo $data['data'][$a]['beratBadan']; ?></td>
            <td><?php echo $data['data'][$a]['tensi']; ?></td>
            <td><?php echo $data['data'][$a]['Hb']; ?></td>
            <td><?php echo $data['data'][$a]['Instansi']; ?></td>
            <td><?php echo $data['data'][$a]['Pengambilan']; ?></td>
        </tr>
    <?php
        }else{
            echo '<tr>';
            echo '<td colspan="7" style="font-size:20px;" class="text-center">Tidak ada data histori tercatat</td>';
            echo '</tr>';
        }
    }
    ?>
</table>
    

<?php
}?>


