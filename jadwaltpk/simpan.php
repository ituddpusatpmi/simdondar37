<?php
//call $koneksi
include "koneksi.php";
$namauser=$_SESSION['namauser'];

if(isset($_POST['title'])){
  $title = $_POST['title'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $trans = $_POST['trans'];
  $gol = $_POST['gol'];
  $pasien = $_POST['pasien'];
  $sampel = $_POST['sampel'];
    
  $simpan= mysqli_query($koneksi, "INSERT into events (title,start_event,end_event,notrans,gol_drh,pasien,kd_sample)values('$title','$start','$end','$trans','$gol','$pasien','$sampel') ");
    
    
  $update = mysqli_query($koneksi,"UPDATE samplekode set sk_hasil='4' where sk_kode='$sampel'");
  
  
    
}
