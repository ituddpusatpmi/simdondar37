<?php
	include "koneksi.php";
	
	$nama_ubah = $_POST['nama_ubah'];
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
	
	$riwayat="insert into riwayat(bidang,nama1,nama2,tingkat,kontrol2,periode,no_versi,tgl_setuju,tgl_pelaksanaan,tgl_peninjauan,pembuat,pemeriksa,pengesah,pengesah2,terkait,fileku) values('$bidang_riwayat','$nama1_riwayat','$nama2_riwayat','$tingkat_riwayat','$kontrol2_riwayat','$periode_riwayat','$versi_riwayat','$setuju_riwayat','$pelaksanaan_riwayat','$peninjauan_riwayat','$pembuat_riwayat','$pemeriksa_riwayat',
'$pengesah_riwayat','$pengesah_riwayat2','$nama1_riwayat','$ImageName')";
	
	$riwayat2="update riwayat set terkait='$nama1' where terkait='$nama_ubah'";

	$sql = "update pks set bidang='$bidang',nama1='$nama1',nama2='$nama2',tingkat='$tingkat',kontrol2='$kontrol2',periode='$periode',no_versi='$no_versi',tgl_setuju='$tgl_setuju',tgl_pelaksanaan='$tgl_pelaksanaan',tgl_peninjauan='$tgl_peninjauan',pembuat='$pembuat',pemeriksa='$pemeriksa',
pengesah='$pengesah',pengesah2='$pengesah2',tgl_notif='$tgl2' where nomor='$nomor'";

	// cek isi file upload ada atau tidak
	if($ImageName != ''){
			$updateFile = mysql_query("UPDATE `pks` set `fileku`='$ImageName' where `nomor`='$nomor'");
	}

	$sql2="update ik set terkait='$nama1' where terkait='$nama_ubah'";
	
	$sql3="update ika set terkait='$nama1' where terkait='$nama_ubah'";
	
	$sql4="update formulir set terkait='$nama1' where terkait='$nama_ubah'";
	
	$sql5="update pendukung set terkait='$nama1' where terkait='$nama_ubah'";
	
	$sql6="update eksternal set terkait='$nama1' where terkait='$nama_ubah'";

$result = mysql_query($sql);
$result2 = mysql_query($sql2);
$result3 = mysql_query($sql3);
$result4 = mysql_query($sql4);
$result5 = mysql_query($sql5);
$result6 = mysql_query($sql6);
$result7 = mysql_query($riwayat);
$result8 = mysql_query($riwayat2);

if($result)
{
echo "update PKS berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result2)
{
echo "update IKM berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result3)
{
echo "update IKA berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result4)
{
echo "update Formulir berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result5)
{
echo "update Dokumen Eksternal berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result6)
{
echo "update Dokumen Pendukung berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result7)
{
echo "input riwayat perubahan PKS berhasil ...<br/> ";
}
else
{
echo "Gagal ... ";
}

if($result8)
{
echo "penyesuaian riwayat perubahan PKS berhasil ...<br/> ";
include "pks.php";
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
	
        echo "<script>alert('Berhasil diupload'); location='pks.php'</script>";
      }
  }
?>
