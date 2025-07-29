
<?php


require_once('../adm/config.php');


$response = array("error" => FALSE);
/*   $query  = "SELECT\n" .
    "UPPER(detailinstansi.nama) AS nama,\n" .
    "tempat,\n" .
    "DATE_FORMAT(TglPenjadwalan + interval 1 hour ,'%H:%i') AS jam\n" .
    "FROM\n" .
    "kegiatan\n" .
    "INNER JOIN detailinstansi ON kegiatan.kodeinstansi = detailinstansi.KodeDetail\n" .
    "where cast(TglPenjadwalan as date)\n" .
    "= curdate()  AND kegiatan.Status=1 AND DATE_FORMAT(TglPenjadwalan,'%H:%i') not like '00:00' ORDER BY TglPenjadwalan ASC";*/

$query = "SELECT UPPER( detailinstansi.nama ) AS nama, tempat, jenisdonor, DATE_FORMAT( jammulai, '%H:%i' ) AS jam\n" .
    "FROM kegiatan\n" .
    "INNER JOIN detailinstansi ON kegiatan.kodeinstansi = detailinstansi.KodeDetail\n" .
    "WHERE CAST( TglPenjadwalan AS DATE ) = CURDATE( )\n" .
    "AND kegiatan.Status =1\n" .
    "AND DATE_FORMAT( jammulai, '%H:%i' ) NOT LIKE '00:00'\n" .
    "ORDER BY TglPenjadwalan ASC\n" .
    "LIMIT 0 , 30";


$result = mysqli_query($con, $query);
$number_of_rows = mysqli_num_rows($result);

$response = array();

if ($number_of_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }


    $check = mysqli_fetch_array($result);


    echo json_encode(array("data" => $response));
} else {

    echo json_encode(array("error" => TRUE));
}
mysqli_close()
?>