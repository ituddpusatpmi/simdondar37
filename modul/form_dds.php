<script language=javascript src="js/utd.js" type="text/javascript"> </script>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/alert.js" type="text/javascript"> </script>
<script language=javascript src="js/jquery-1.4.2.min.js"></script>
<script language=javascript src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap_dds.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style type="text/css">
	.alert { font: 62.5% "Trebuchet MS", sans-serif; }
</style>
	</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
  $('#instansi').autocomplete({source:'modul/suggest_utd.php', minLength:2});});
  </script>
<?$today=date("Y-m-d");
$tgl1=date("d",strtotime($today));
$bln1=date("n",strtotime($today));
$thn1=date("Y",strtotime($today));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln11=$bulan[$bln1];

include('clogin.php');
include('config/db_connect.php');
require_once("modul/background_process.php");

$namauser=$_SESSION[namauser];
//------------------------------ Submit ----------------------------//
if (isset($_POST[submit])) {
	for ($i=0; $i<sizeof($_POST[udd]); $i++) {
		$udd=$_POST[udd]; 					
		$nama=$_POST[nama]; 					
		$alamat=$_POST[alamat];
		$jk=$_POST[jk];
		$lhr=$_POST[terima];			
		$gol=$_POST[goldarah];	
		$rh=$_POST[rh];	
		$status=$_POST[status];
		$nomor=$_POST[nomor];
		$cincin=$_POST[cincin];
		$tgl=$_POST[terima1];
		$today=date("Y-m-d");
			
			
        $tambah=mysql_query("insert into
				dds100 (asaludd,nama,alamat,kelamin,tgllahir,golda,rhesus,status,nopiagam,cincin,tglterima,tglinput,petugas) 
				values ('$udd','$nama','$alamat','$jk','$lhr','$gol','$rh','$status','$nomor','$cincin','$tgl','$today','$namauser') ");
	}
	if ($tambah) {
        echo "Data Telah berhasil dimasukkan. ";?>
	<?}
} ?>

<h1 class="table">INPUT DATA DDS 100 KALI </h1>
<br>
<form name="bdrs" id="bdrs" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
<table>
<tr><td>Asal UDD</td><td><input type=text name="udd" id="instansi">
	</td></tr>
<tr><td>Nama</td><td><input type=text name="nama">
	</td></tr>
<tr><td>Alamat</td><td><input type=text name="alamat">
	</td></tr>
<tr><td>Tgl Lahir</td><td>
<input type=text name=terima id="datepicker" size=10>
</td></tr>
<tr>
			<td>Jenis Kelamin</td>
			<td class="input">
				<select name="jk">
					<option value="0">Laki-laki</option>
					<option value="1">Perempuan</option>
					</select>
			</td>
		</tr>

<tr>
			<td>Golongan Darah</td>
			<td class="input">
				<select name="goldarah">
					<option value="O">O</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="AB">AB</option>
					</select>
			</td>
		</tr>

		<tr>
			<td>Rhesus Darah</td>
			<td class="input">
				<select name="rh">
					<option value="+">Positip</option>
					<option value="-">Negatip</option>
					</select>
			</td>
		</tr>
	<tr>
			<td>Status</td>
			<td class="input">
				<select name="status">
					<option value="0">Diajukan</option>
					<option value="1">Selesai</option>
					</select>
			</td>
		</tr>

<tr><td>No Piagam</td><td><input type=text name="nomor">
	</td></tr>
<tr>
			<td>Cincin Emas</td>
			<td class="input">
				<select name="cincin">
					<option value="0">Belum</option>
					<option value="1">Sudah</option>
					</select>
			</td>
		</tr>
<tr><td>Tgl Diberikan</td><td>
<input type=text name=terima1 id="datepicker1" size=10>
</td></tr>

</table>


				
<br>
	<input type="submit" value="Submit" name="submit">
</form>



<div class="alert" id="alert">
	<div id="pilih_tes" title="Pilih jenis tes..!">
		<p>Silahkan pilih jenis tes</p>
	</div>
	<div id="ganti_reagen" title="Waktu Ganti Reagen..!">
		<p>Silahkan isikan hasil test dan submit terlebih dahulu. Ganti reagen yang telah habis</p>
	</div>
	<div id="kantong_tdk_sesuai" title="Kantong tidak sesuai..!">
		<p>Silahkan cek kembali kantong yang anda masukkan, atau masukkan kantong lain</p>
	</div>
	<div id="pilih_reagen" title="Pilih reagen..!">
		<p>Silahkan pilih reagen terlebih dahulu sebelum memasukkan nomor kantong</p>
	</div>
	<div id="kantong_sudah_diinput" title="Kantong sudah diinput..!">
		<p>Silahkan masukkan kantong yang lain</p>
	</div>
	<div id="kantong_reaktif" title="Kantong sudah ditest...!">
		<p>Silahkan masukkan kantong yang lain</p>
	</div>
</div>
</body>
