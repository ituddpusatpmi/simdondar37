<?php
	include "koneksi.php";
	
	$today=date("Y-m-d H:i:s");
	$nomor = $_POST['nomor'];
	$bidang = $_POST['bidang'];
	$nama1 = $_POST['nama1'];
	$kontrol2 = $_POST['kontrol2'];
	$no_versi = $_POST['no_versi'];
	$tujuan1 = $_POST['tujuan1'];
	$jumlah1 = $_POST['jumlah1'];
	$pengantar1 = $_POST['pengantar1'];
	$tgl_keluar1 = $_POST['tgl_keluar1'];
	$petugas1 = $_POST['petugas1'];
	$ImageName       = $_FILES['fileupload']['name'];

	
	$riwayat="insert into riwayat_keluar
(bidang,nama1,kontrol2,no_versi,tujuan,jumlah,nomor_pengantar,tgl_keluar,petugas,on_insert) values
('$bidang','$nama1','$kontrol2','$no_versi','$tujuan1','$jumlah1','$pengantar1','$tgl_keluar1','$petugas1','$today')";

	$riwayat2="insert into dokumen_keluar
(bidang,nama1,kontrol2,no_versi,tujuan,jumlah,nomor_pengantar,tgl_keluar,petugas,on_insert) values
('$bidang','$nama1','$kontrol2','$no_versi','$tujuan1','$jumlah1','$pengantar1','$tgl_keluar1','$petugas1','$today')";
	
	
	
	
$result1 =mysql_query($riwayat);
$result2 =mysql_query($riwayat2);



if($result1)
{
echo "Pengeluaran Dokumen Berhasil ...<br/> ";
include "formulir.php";
}
else
{
echo "Gagal ... ";
}

if($result2)
{
echo "Pengeluaran Dokumen Berhasil ...<br/> ";
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
