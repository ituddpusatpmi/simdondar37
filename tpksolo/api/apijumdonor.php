<?php


require_once('../adm/config.php');


    $response = array("error" => FALSE);
        $query  = "select COUNT(case when Pengambilan='0' AND gol_darah='A' THEN 1 END) As GolA,\n".
        "COUNT(case when Pengambilan='0' AND gol_darah='B' THEN 1 END) As GolB,\n".
        "COUNT(case when Pengambilan='0' AND gol_darah='O' THEN 1 END) As GolO,\n".
        "COUNT(case when Pengambilan='0' AND gol_darah='AB' THEN 1 END) As GolAB\n".
        "from htransaksi where date(Tgl)=curdate()";


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
