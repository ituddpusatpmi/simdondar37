<?php
	include "koneksi.php";
	
	
	$nomor = $_POST['nomor'];
	$bidang = $_POST['bidang'];
	$nama1 = $_POST['nama1'];
	$nama2 = $_POST['nama2'];
	$tingkat = $_POST['tingkat'];
	$kontrol1 = $_POST['kontrol1'];
	$kontrol2 = $_POST['kontrol2'];
	$kontrol3 = $_POST['kontrol3'];
	$periode = $_POST['periode'];
	$no_versi = $_POST['no_versi'];
	$tgl_setuju = $_POST['tgl_setuju'];
	$tgl_pelaksanaan = $_POST['tgl_pelaksanaan'];
	$tgl_peninjauan = $_POST['tgl_peninjauan'];
	$pembuat = $_POST['pembuat'];
	$pemeriksa = $_POST['pemeriksa'];
	$pengesah = $_POST['pengesah'];
	$pengesah2 = $_POST['pengesah2'];
	$ImageName       = $_FILES['fileupload']['name'];
	
	$bidang_riwayat = $_POST['bidang_riwayat'];
	$nama1_riwayat = $_POST['nama1_riwayat'];
	$nama2_riwayat = $_POST['nama2_riwayat'];
	$tingkat_riwayat = $_POST['tingkat_riwayat'];
	$kontrol_riwayat = $_POST['kontrol_riwayat'];
	$kontrol2_riwayat = $_POST['kontrol2_riwayat'];
	$kontrol3_riwayat = $_POST['kontrol3_riwayat'];
	$periode_riwayat = $_POST['periode_riwayat'];
	$versi_riwayat = $_POST['versi_riwayat'];
	$setuju_riwayat = $_POST['setuju_riwayat'];
	$pelaksanaan_riwayat = $_POST['pelaksanaan_riwayat'];
	$peninjauan_riwayat = $_POST['peninjauan_riwayat'];
	$pembuat_riwayat = $_POST['pembuat_riwayat'];
	$pemeriksa_riwayat = $_POST['pemeriksa_riwayat'];
	$pengesah_riwayat = $_POST['pengesah_riwayat'];
	$pengesah_riwayat2 = $_POST['pengesah_riwayat2'];

	$tgl1 = "$tgl_peninjauan";
	$tgl2 = date('Y-m-d', strtotime('-60 days', strtotime($tgl1)));
	
	$riwayat="insert into riwayat(bidang,nama1,nama2,tingkat,kontrol,kontrol2,kontrol3,periode,no_versi,tgl_setuju,tgl_pelaksanaan,tgl_peninjauan,pembuat,pemeriksa,pengesah,pengesah2,terkait,fileku) values('$bidang_riwayat','$nama1_riwayat','$nama2_riwayat','$tingkat_riwayat','$kontrol_riwayat','$kontrol2_riwayat','$kontrol3_riwayat','$periode_riwayat','$versi_riwayat','$setuju_riwayat','$pelaksanaan_riwayat','$peninjauan_riwayat','$pembuat_riwayat','$pemeriksa_riwayat',
'$pengesah_riwayat','$pengesah_riwayat2','$nama1_riwayat','$ImageName')";
	
	$riwayat2="update riwayat set terkait='$nama1' where terkait='$nama_ubah'";
	
	$sql = "update formulir set bidang='$bidang',nama1='$nama1',nama2='$nama2',tingkat='$tingkat',kontrol='$kontrol1',kontrol2='$kontrol2',kontrol3='$kontrol3',periode='$periode',no_versi='$no_versi',tgl_setuju='$tgl_setuju',tgl_pelaksanaan='$tgl_pelaksanaan',tgl_peninjauan='$tgl_peninjauan',pembuat='$pembuat',pemeriksa='$pemeriksa',
pengesah='$pengesah',pengesah2='$pengesah2',tgl_notif='$tgl2',fileku='$ImageName' where nomor='$nomor'";
		
$result  =mysql_query($sql);
$result2 =mysql_query($riwayat);
$result3 =mysql_query($riwayat2);

if($result)
{
echo "update formulir berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result2)
{
echo "input riwayat perubahan formulir berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result3)
{
echo "penyesuaian riwayat perubahan formulir berhasil ...<br/> ";
include "formulir.php";
}
else
{
echo "Gagal ... ";
}

?>

<!--upload file-->
<?php
  if(isset($_POST["upload"]))
  {
      $temp = "upload/";
      if (!file_exists($temp))
        mkdir($temp);
 
      $fileupload      = $_FILES['fileupload']['tmp_name'];
      $ImageName       = $_FILES['fileupload']['name'];
      $ImageType       = $_FILES['fileupload']['type'];
      $namafile = $_POST['fileku'];
      $type ='pdf';
 
      if (!empty($fileupload)){
        // mengacak angka untuk nama file
        //$acak = rand(00000000, 99999999);
 
        //$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt       = str_replace('.','',$ImageExt); // Extension
        //$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
        $NewImageName   = $ImageName.''.$ImageExt;
 
        move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewImageName); // Menyimpan file
	
        echo "<script>alert('Berhasil diupload'); location='formulir.php'</script>";
      }
  }
?>
