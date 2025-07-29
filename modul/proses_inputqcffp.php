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
$lekosit=$_POST['lekosit'];
$petugassah=$_POST['pengesah'];
$exp=$_POST['tgl_exp'];
$trombosit=$_POST['trombosit'];
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$tglperiksa=$_POST['tgl_periksa'];
$sdm=$_POST['sdm'];
$tanggal=$_POST['tanggal'];
$faktor=$_POST['faktor_viii'];

//validasi form
$query=mysql_query("SELECT * FROM qc") or die (mysql_error());
$cek=mysql_fetch_array($query);
$cek1=$cek['nokantong'];
	if ($kantong==$cek1) {
		echo 'No Kantong sudah Pernah Diinput<br><a href="qcffp.php">klik disini untuk kembali</a></br>';			
		}
	else if (empty($tglperiksa)){
		echo 'Tanggal Periksa Tidak Boleh Kosong<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if(empty($berat)) {
		echo 'Isian Berat Tidak Boleh Kosong<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';
		}
	else if (!preg_match("/^[0-9.]*$/",$berat)){
		echo 'Inputan Berat harus berupa angka<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if(empty($volume)) {
		echo 'Volume Tidak Boleh Kosong<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';
		}
	else if (!preg_match("/^[0-9.]*$/",$volume)) {
		echo 'Volume Harus Berupa Angka<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if (empty($lekosit)) {
		echo 'Lekosit Tidak Boleh Kosong<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';	
		}
	else if (!preg_match("/^[0-9.]*$/",$lekosit)) {
		echo 'Lekosit Harus Berupa Angka<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if (empty($trombosit)) {
		echo 'Trombosit Tidak Boleh Kosong<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if (!preg_match("/^[0-9.]*$/",$trombosit)) {
		echo 'Trombosit Harus Berupa Angka<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if (empty($sdm)) {
		echo 'SDM Tidak Boleh Kosong<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if (!preg_match("/^[0-9.]*$/",$sdm)) {
		echo 'SDM Harus Berupa Angka<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if (empty($faktor)) {
		echo 'Faktor VIII tidak boleh kosong<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}
	else if (!preg_match("/^[0-9.]*$/",$faktor)) {
		echo 'Faktor VIII Harus Berupa Angka<br><a href="javascript:history.go(-1)">klik disini untuk kembali</a></br>';		
		}		
		
//input data
	else {
		$input ="INSERT INTO qc (nokantong, merk, produk, gol_darah, RhesusDrh, tglpengolahan, kadaluwarsa, tglperiksa, berat, volume, lekosit, trombosit, sdm, vaktorviii, aerob, anaerob, inputer, pengesah, bulanqc, tahunqc, tgl_input)
		VALUES ('$kantong','$merk','$produk','$golda','$rh','$tglbuat','$exp','$tglperiksa','$berat','$volume','$lekosit','$trombosit','$sdm','$faktor','$aerob','$anaerob','$petugas','$petugassah','$bulan','$tahun','$tanggal')";
		$query_input=mysql_query($input);
		if ($query_input) {
			echo '<h3>Data Berhasil Dimasukkan (Anda akan dialihkan kembali dalam 3 detik)</h3><META http-equiv="refresh" content="3; URL=qcffp.php">';			
			}
		else {
			echo '<h3>Data Gagal Dimasukkan (Anda akan dialihkan kembali dalam 3 detik)</h3><META http-equiv="refresh" content="3; URL=qcffp.php">';			
			}
		}
?>

</html>
