<html>
<? include('../config/db_connect.php'); ?>
<?
$kantong=$_POST['nokantong'];
$berat=$_POST['berat'];
$aerob=$_POST['aerob'];
$merk=$_POST['merk'];
$produk=$_POST['produk'];
$volume=$_POST['volume'];
$anaerob=$_POST['anaerob'];
$golda=$_POST['golda'];
$rh=$_POST['rh'];
$petugas=$_POST['petugas'];
$tglbuat=$_POST['tgl_buat'];
$swirling=$_POST['swirling'];
$petugassah=$_POST['pengesah'];
$exp=$_POST['tgl_exp'];
$trombosit=$_POST['trombosit'];
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$tglperiksa=$_POST['tgl_periksa'];
$ph=$_POST['ph'];
$tanggal=$_POST['tanggal'];


//validasi form
$query=mysql_query("SELECT * FROM qc") or die (mysql_error());
$cek=mysql_fetch_array($query);
$cek1=$cek['nokantong'];
	if ($kantong==$cek1) {
		echo 'No Kantong sudah Pernah Diinput<br><a href="qctc.php">klik disini untuk kembali</a></br>';			
		}
	else if (empty($tglperiksa)){
		echo 'Tanggal Periksa Tidak Boleh Kosong<br><a href="qctc.php">klik disini untuk kembali</a></br>';		
		}
	else if(empty($berat)) {
		echo 'Isian Berat Tidak Boleh Kosong<br><a href="qctc.php">klik disini untuk kembali</a></br>';
		}
	else if (!preg_match("/^[0-9.]*$/",$berat)) {
		echo 'Berat Harus Berupa Angka<br><a href="qctc.php">klik disini untuk kembali</a></br>';		
		}
	else if(empty($volume)) {
		echo 'Volume Tidak Boleh Kosong<br><a href="qctc.php">klik disini untuk kembali</a></br>';
		}
	else if (!preg_match("/^[0-9.]*$/",$volume)) {
		echo 'Volume Harus Berupa Angka<br><a href="qctc.php">klik disini untuk kembali</a></br>';		
		}
	else if (empty($ph)) {
		echo 'PH Tidak Boleh Kosong<br><a href="qctc.php">klik disini untuk kembali</a></br>';	
		}
	else if (!preg_match("/^[0-9.]*$/",$ph)) {
		echo 'PH Harus Berupa Angka<br><a href="qctc.php">klik disini untuk kembali</a></br>';		
		}
	else if (empty($trombosit)) {
		echo 'Trombosit Tidak Boleh Kosong<br><a href="qctc.php">klik disini untuk kembali</a></br>';		
		}
	else if (!preg_match("/^[0-9.]*$/",$trombosit)) {
		echo 'Trombosit Harus Berupa Angka<br><a href="qctc.php">klik disini untuk kembali</a></br>';		
		}
//input data
	else {
		$input ="INSERT INTO qc (nokantong, merk, produk, gol_darah, RhesusDrh, tglpengolahan, kadaluwarsa, tglperiksa, berat, volume, jmltrombosit, swirling, ph, aerob, anaerob, inputer, pengesah, bulanqc, tahunqc, tgl_input)
		VALUES ('$kantong','$merk','$produk','$golda','$rh','$tglbuat','$exp','$tglperiksa','$berat','$volume','$trombosit','$swirling','$ph','$aerob','$anaerob','$petugas','$petugassah','$bulan','$tahun','$tanggal')";
		$query_input=mysql_query($input);
		if ($query_input) {
			echo '<h3>Data Berhasil Dimasukkan (Anda akan dialihkan kembali dalam 3 detik)</h3><META http-equiv="refresh" content="3; URL=qctc.php">';			
			}
		else {
			echo '<h3>Data Gagal Dimasukkan (Anda akan dialihkan kembali dalam 3 detik)</h3><META http-equiv="refresh" content="3; URL=qctc.php">';			
			}
		}
?>

</html>
