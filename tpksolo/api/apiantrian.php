<?php


//require_once('adm/config.php');
require_once('../adm/config.php');

$d          = date('d');
$m          = date('m');
$y          = date('Y');
$key        =  "1213141503012023"; //12131415".$m.$d.$y;
$token      = $_POST['token'];
    
if ($token == $key){ //Token Boleh deh
    
  
  $response         = array("error" => FALSE);
  $KodePendonor     = $_POST['KodePendonor'];
  $telp             = $_POST['telp'];
  $tgl              = $_POST['tgl'];
    
    
    $query =   "SELECT max(`nomor`) as nomorakhir,(SELECT min(`nomor`) from `antrian`  WHERE `tgl`= CURRENT_DATE() AND `stat` is null) as nomorskrg FROM `antrian` WHERE `tgl`= CURRENT_DATE()";
    



    $result = mysqli_query($con, $query);
    $number_of_rows = mysqli_num_rows($result);

    $response = array();

    if($number_of_rows > 0) {
        $row        = mysqli_fetch_assoc($result);
        $nomoranda  = $row['nomorakhir'] + 1;
        $selisih    = $nomoranda - $row['nomorskrg'];
        $estimasi   = $selisih * 15 ;
        
        $pesan      = "Yth. Pendonor Darah Sukarela UDD PMI, kami informasikan bahwa saat ini antrian terakhir adalah di nomor ".$row['nomorskrg']." silahkan menuju Gedung PMI dan mencetak formulir donor dalam waktu +/- ".$estimasi." menit untuk mendapatkan nomor antrian ke-".$nomoranda;
        
        $kirimwa    = mysqli_query($con, "insert into wagw.outbox (wa_mode, wa_no, wa_text ) VALUES ('1', '$telp', '$pesan')");
        echo json_encode(array("status"=>"200",
                               "data"=>$pesan));
        
    } else {

        echo json_encode(array("error"=>TRUE));
    }

    
    
    } else { //Token Invalid
        header("location: ../../index.php");
    }
    //mysqli_close()
    ?>

