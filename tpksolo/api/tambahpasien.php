<?php
require_once('../adm/config.php');
    
$today=date('Y-m-d');
$today1=$today;
$key = '12131415';
$token = $_POST['token'];
    
    
    if ($token == $key){
    //------------------------ set id pasien ------------------------->
         //digit pendonor 14 digit, 4kode utd, 3 nama, 2 tmpt aftap, 6 sequence,
         $nama_pasien = $_POST['nama'];
         $nama1 = str_replace(".","",$nama_pasien);
         $nama1 = str_replace(" ","",$nama1);
         $nama1 = str_replace(",","",$nama1);
         $nm=strtoupper(substr($nama1,0,3));
        
        
         
         $kdtp      = "P3404".$nm;
         $idp       = mysqli_query($con,"select no_rm from pasien where no_rm like '$kdtp%' order by no_rm DESC");
         $idp1      = mysqli_fetch_array($idp);
         $idp2      = substr($idp1['no_rm'],9,6);
         if ($idp2<1) {
              $idp2="00000";
         }
         $int_idp2  =(int)$idp2+1;
         $j_nol1    = 6-(strlen(strval($int_idp2)));
         for ($i=0; $i<$j_nol1; $i++){
              $idp4 .="0";
         }
         $norm=$kdtp.$idp4.$int_idp2;
         //---------------------- END set id pasien ------------------------->
    
    
      //Parameter
        $jk       = $_POST['jk'];
        $tgllhr   = $_POST['tgllhr'];
        $gol      = $_POST['gol'];
        $rh       = $_POST['rh'];
        $alamat   = $_POST['alamat'];
        $ktp      = $_POST['ktp'];
        
        
        $thn       = date('Y-m-d', strtotime($tgllhr));
        $thnlhr    = new \DateTime($thn);
        $hrini     = new \DateTime("today");
        $y         = $hrini->diff($thnlhr)->y; //$hrini->diff($tgllhr)->y;
        
       
        $query =   "INSERT into pasien (no_rm,no_ktp,nama,alamat,gol_darah,rhesus,kelamin,keluarga,tgl_lahir,tlppasien,umur) VALUES ('$norm','$ktp','$nama_pasien','$alamat','$gol','$rh','$jk','-','$tgllhr','-','$y')";
        
        $response = array("error" => FALSE);
        $result = mysqli_query($con, $query);
        $number_of_rows = mysqli_num_rows($result);

        $response = array();

        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                    $response[] = $row;
            }
           $check = mysqli_fetch_array($result);
            echo $query;
            echo json_encode(array("data"=>"OK"));
        } else {
            echo $query;
            echo json_encode(array("error"=>TRUE));
        }
    } else {
        echo "KEY INVALID";
            }
    
    
mysqli_close();
?>

