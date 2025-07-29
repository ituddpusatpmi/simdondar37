<?php
require_once('../adm/config.php');
    
$today=date('Y-m-d');
$key = '12131415';

    
    $response = array("error" => FALSE);
      //Parameter
    $noformbatal = $_POST['noformbatal'];
    $alasan = $_POST['alasan'];
    $ket = $_POST['ket'];
    $user = $_POST['user'];
    $dokumen = $_POST['dokumen'];
    $namaps = $_POST['namaps'];
    $namars = $_POST['namars'];
    $token = $_POST['token'];
            
    
    if ($token == $key ){
            //------------------------ DELETE HTRANSPERMINTAANRS -------------------->
    
            $permintaan = "UPDATE `htranspermintaanRS` set `status`='2' where noformRS='$noformbatal'";
            $permintaan2 = "UPDATE `htranspermintaan` set `status`='2' where noform='$noformbatal'";
            $book = "insert into book_permintaan (notrans, uraian, petugas,detail,lampiran) values ('$noformbatal','$ket','$user','$alasan','$dokumen')";
            $dtrans = "update `dtranspermintaan` set `status`='1' WHERE `NoForm` = '$noformbatal'";
            $daftarps = "delete from `daftarpasien` WHERE `noform` = '$noformbatal'";
   
        
        $result  = mysqli_query($con, $permintaan);
        //$result2  = mysqli_query($con, $qwb);
        //$result1 = mysqli_query($con, $qtc);
        //$number_of_rows = mysqli_num_rows($result);

        //$response = array();

        if (!$result) {
            $arr = array();
            $arr['info'] = 'error';
            $arr['msg'] = 'Data tidak berhasil diproses.';
            echo json_encode($arr);
            echo $permintaan;
            exit();
        } else {
            $result2  = mysqli_query($con, $permintaan2);
            $delbook  = mysqli_query($con, $book);
            $deltrans  = mysqli_query($con, $dtrans);
            $deldaftarps  = mysqli_query($con, $daftarps);
            
            
            $conwa = mysqli_connect('203.190.53.38', 'root', 'F201603907', 'wagw');
            
            //Whatsapp PMI
            $sapa ="Semangat Pagi";
            $pesan= $sapa.', Info Pembatalan Permintaan Darah Online '.$namars.' dengan nomor formulir : '.$noformbatal.', atas nama pasien '.$namaps.' petugas RS : '.$user;
            
            $wa ="insert into wagw.outbox (wa_mode,wa_no,wa_text) values ('1','082226403672','$pesan')";
                       
            //WA petugas
            $kirim2 =mysqli_query($conwa,$wa);
            
        $arr = array();
        $arr['info'] = 'success';
        $arr['msg'] = 'Data berhasil diproses.';
        echo json_encode($arr);
        echo $permintaan.$wa;
            }
        } else {
            $arr = array();
            $arr['info'] = 'INVALID';
            $arr['msg'] = 'ACCESS DENIED';
            echo json_encode($arr);
        }
    
    
        mysqli_close();
?>


