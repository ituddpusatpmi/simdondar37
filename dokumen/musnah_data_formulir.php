<?php
	include "koneksi.php";
	
	
	$nomor = $_POST['nomor'];
	$bidang = $_POST['bidang'];
	$nama1 = $_POST['nama1'];
	$kontrol2 = $_POST['kontrol2'];
	$no_versi = $_POST['no_versi'];
	$ket1=$_POST['ket1'];
	$tgl_musnah1=$_POST['tgl_musnah1'];
	$petugas1=$_POST['petugas1'];
	$ImageName       = $_FILES['fileupload']['name'];


	$sql = "update formulir set 
	aktif='1', tgl_pemusnahan='$tgl_musnah1', petugas_musnah='$petugas1', ket='$ket1'
	 where nomor='$nomor'";

	$result  =mysql_query($sql);


if($result)
{
echo "Pemusnahan Dokumen Berhasil ...<br/> ";
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
	
        echo "<script>alert('Berhasil diupload'); location='eksternal.php'</script>";
      }
  }
?>
