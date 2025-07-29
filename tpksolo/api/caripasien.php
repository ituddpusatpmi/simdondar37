<?php
require_once('../adm/config.php');
    
$today=date('Y-m-d');
$key = '12131415';
$today1=$today;
$srcnama= $_POST['nama'];
$srcnik="";
$srctgllhr="";
$srcgol="";
$srcrh="";
$srcalamat="";
$srcjk="";
    
    $response = array("error" => FALSE);
      //Parameter
      $nama = $_POST['nama'];
      $tgl1 = $_POST['tgl1'];
      $tgl2 = $_POST['tgl2'];
      $token = $_POST['token'];
    
    
    if ($token == $key){
    if ($_POST['ktp']!='') {
                    $srcnik  = $_POST['ktp'];
                    $qnik       = " AND no_rm = '$srcnik' ";
                                } else {$qnik    ="";}
    if ($_POST['tgllhr']!='') {
                    $srctgllhr  = $_POST['tgllhr'];
                    $qtgllhr       = " AND date(tgl_lahir) = '$srctgllhr' ";
                                } else {$qtgllhr    ="";}
    if ($_POST['gol']!='') {
                    $srcgol  = $_POST['gol'];
                    $qgol       = " AND gol_darah = '$srcgol' ";
                                } else { $qgol    =""; }
    if ($_POST['rh']!='') {
                    $srcrh  = $_POST['rh'];
                    $qrh       = " AND rhesus = '$srcrh' ";
                                } else {$qrh    ="";}
    if ($_POST['alamat']!='') {
                    $srcalamat  = $_POST['alamat'];
                    $qalamat       = " AND alamat like '%$srcalamat%' ";
                                } else {$qalamat    ="";}
    if ($_POST['jk']!='') {
                    $srcjk  = $_POST['jk'];
                    $qjk       = " AND kelamin = '$srcjk' ";
                                } else {$qjk    ="";}
    
    
        $query =   "select * from pasien where nama like '%$nama%'".$qgol.$qrh.$qalamat.$qnik.$qjk.$qnik.$qtgllhr;
        
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
        } else {
            
            echo json_encode(array("error"=>TRUE));
        }
    
    
    
mysqli_close();
?>
