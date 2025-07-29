<?php


require_once('../adm/config.php');

$response = array("error" => FALSE);
  $nama = $_POST['nama'];
  $tgl1 = $_POST['tgl1'];
  $tgl2 = $_POST['tgl2'];
    
      $query =   "select * from v_stok_release_all";



    $result = mysqli_query($con, $query);
    $number_of_rows = mysqli_num_rows($result);

    $response = array();

    if($number_of_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
                $response[] = $row;
        }


        $check = mysqli_fetch_array($result);


        echo json_encode(array("data"=>$response));

    } else {

        echo json_encode(array("error"=>TRUE));
    }
mysqli_close() ?>

