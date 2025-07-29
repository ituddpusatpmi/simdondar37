<?php


require_once('adm/config.php');

$response = array("error" => FALSE);
  $nama = $_POST['nama'];
  $tgl1 = $_POST['tgl1'];
  $tgl2 = $_POST['tgl2'];
    if($nama==''){
      $query =   "select *,case when sampel='0' then 'Belum Diterima' else 'Sudah Diterima' end AS `sampel`, case when `status`='2' then 'Batal' when `status`='3' then 'Selesai' else 'Dalam Proses' end AS `status`  from v_caripasien where (date(tgl_register) between '$tgl1' AND '$tgl2') order by tgl_register DESC limit 100 ";
    }else {
      $query =   "select *,case when sampel='0' then 'Belum Diterima' else 'Sudah Diterima' end AS `sampel`,case when `status`='2' then 'Batal' when `status`='3' then 'Selesai' else 'Dalam Proses' end AS `status`  from v_caripasien where (date(tgl_register) between '$tgl1' AND '$tgl2') AND `nama` like '%$nama%' order by tgl_register DESC limit 100 ";
    }



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
