
<SCRIPT LANGUAGE="JavaScript" SRC="js/rs.js"></SCRIPT>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_antara.js"></script>
<script type="text/javascript" src="js/tgl_butuh.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
   // $('#dokter').autocomplete({source:'modul/suggest_dokter.php', minLength:2}),
    //$('#ruangan').autocomplete({source:'modul/suggest_ruangan.php', minLength:2}),
    //$('#jenis').autocomplete({source:'modul/suggest_jenis.php', minLength:2}),
    $('#nik').autocomplete({source:'kepegawaian/suggest_pegawai.php', minLength:2}),
	$('#nik1').autocomplete({source:'kepegawaian/suggest_pegawai.php', minLength:2}),
	$('#nik2').autocomplete({source:'kepegawaian/suggest_pegawai.php', minLength:2});});
</script>


<table border=0 width=50% align=left>
  <tr><td>
  <link type="text/css" href="css/stok_darah.css" rel="stylesheet" />
  <?
  include('clogin.php');
  include('config/db_connect.php');
  $bl_thn=date("m").date("y");
  $tgl_skr=date("Y-m-d");
  ?>
  <form name="checkkantong" method="POST">
    <table  summary="Check kantong" width="100%">
	<tr><td><input type=text name=nokantong1 required id="nik" placeholder='ketik nama karyawan Yg dinilai' size='35' style="color:#007700"></td>
	<td><input type=text name=nokantong2 required id="nik1" placeholder='ketik nama Pejabat Penilai' size='35' style="color:#007700"></td>
	<td><input type=text name=nokantong3 required id="nik2" placeholder='ketik nama Atasan Pejabat Penilai' size='35' style="color:#007700"></td>
<td><input type=submit name=submit1 value="Submit"></td></tr>
    </table>
  </form>
<?
if (isset($_POST[submit1]))?>
<? {

//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th	= substr(date("Y"),2,2);
$bl	= date("m");
$tgl	= date("d");
$kdtp	= "SKP".$tgl.$bl.$th."-";
$idp	= mysql_query("select notrans from skppeg where notrans like '$kdtp%' order by notrans DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[notrans],10,4);
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

$namauser = $_SESSION[namauser];
$lv0=$_SESSION[leveluser];
//$today1=gmdate("Y-m-d H:i:s",time()+60*60*7);
$today1=date("Y-m-d H:i:s");
if (isset($_POST['submit'])){
	$nikstaff	= $_POST['nikstaff'];		$nikpenilai		= $_POST['nikpenilai'];			$nikatasan		= $_POST['nikatasan'];
	$golstaff	= $_POST['golstaff'];		$golpenilai		= $_POST['golpenilai'];			$golatasan		= $_POST['golatasan'];
	$jabstaff	= $_POST['jabstaff'];		$jabpenilai		= $_POST['jabpenilai'];			$jabatasan		= $_POST['jabatasan'];
	$dirstaff	= $_POST['dirstaff'];		$dirpenilai		= $_POST['dirpenilai'];			$diratasan		= $_POST['diratasan'];
	$bagstaff	= $_POST['bagstaff'];		$bagpenilai		= $_POST['bagpenilai'];			$bagatasan		= $_POST['bagatasan'];
	$masakerjastaff	= $_POST['masakerjastaff'];	$masakerjaspenilai	= $_POST['masakerjapenilai'];		$masakerjaatasan	= $_POST['masakerjaatasan'];
	$ijasahstaff	= $_POST['ijasahstaff'];	$ijasahpenilai		= $_POST['ijasahpenilai'];		$ijasahatasan		= $_POST['ijasahatasan'];

	$angka1 	= $_POST['angka1'];	$angka2 = $_POST['angka2'];	$angka3 = $_POST['angka3'];  $angka4 = $_POST['angka4']; $angka5 = $_POST['angka5'];
	$angka6 	= $_POST['angka6'];  	$angka7 = $_POST['angka7'];
	
//$jumlahstaff = $_GET['testResult']; $jumlahpimpinan = $_POST['jumlahpimpinan']; $rataratastaff = $_POST['rataratastaff']; $rataratapimpinan = $_POST['rataratapimpinan'];
$keberatan   = $_POST['keberatan'];   $tgl1  	      = $_POST['tgl1'];           $tanggapan	 = $_POST['tanggapan'];     $tgl2             = $_POST['tgl2'];
$keputusan   = $_POST['keputusan'];   $tgl3           = $_POST['tgl3'];           $keterangan    = $_POST['keterangan'];    $tgl4	      = $_POST['tgl4'];
$tgl5        = $_POST['tgl5'];        $tgl6	      = $_POST['tgl6'];           $tgl7		 = $_POST['tgl7'];          $tgl8             = $_POST['tgl8'];
$tgl9        = $_POST['tgl9'];   	  

	//$tambah=mysql_query("insert into mutasipeg (notrans,nik,tglajukan,Status,tglsk,nosk,tanggal_entry,tanggal_update,ijasah,bagianlama,bagianbaru,jabatan,pencatat,up)
	//value ('$id_transaksi_baru','$nik','$tglawal','$_POST[status]','$tglakhir','$_POST[nosk]','$today1','$today1','$_POST[ijasah]','$bagianlama','$bagianbaru','$_POST[jabatan]','$namauser','1')");
	$tambah=mysql_query("insert into skppeg
(notrans,nikpeg,nikpenilai,nikatasan,golpeg,golpenilai,golatasan,jabpeg,jabpenilai,jabatasan,dirpeg,dirpenilai,diratasan,orientasipel,integritas,
komitmen,disiplin,kerjasama,kepemimpinan,skp,keberatan,tgl1,tanggapan,tgl2,keputusan,tgl3,
keterangan,tgl4,tglterima,tgldibuat,tglterimaatasan,tglawal,tglakhir,tanggal_entry,tanggal_update,pencatat)
	value ('$id_transaksi_baru','$nikstaff','$nikpenilai','$nikatasan','$golstaff','$golpenilai','$golatasan','$jabstaff','$jabpenilai','$jabatasan','$dirstaff','$dirpenilai',
	'$diratasan','$angka1','$angka2','$angka3','$angka4','$angka5','$angka6','$angka7','$keberatan','$tgl1',
	'$tanggapan','$tgl2','$keputusan','$tgl3','$keterangan','$tgl4','$tgl5','$tgl6','$tgl7','$tgl8','$tgl9','$today1','$today1','$namauser')");

			
	if ($tambah) {
		echo "Data Telah berhasil dimasukkan<br>";
		//$up0=mysql_query(" update pegawai set ijasah='$ijasahbaru',golongan='$_POST[golongan]' where Kode='$nik'");			
		//mysql_query("UPDATE ijasahpeg set lamaproses=(TO_DAYS(tglsk)- TO_DAYS(tglajukan))");
		mysql_query("UPDATE skppeg set jumlah=(orientasipel + integritas + komitmen + disiplin + kerjasama) where (kepemimpinan='' or kepemimpinan='0')");
		mysql_query("UPDATE skppeg set ratarata=(jumlah/5) where (kepemimpinan='' or kepemimpinan='0')");
		mysql_query("UPDATE skppeg set jumlah=(orientasipel + integritas + komitmen + disiplin + kerjasama + kepemimpinan ) where kepemimpinan >'0'");
		mysql_query("UPDATE skppeg set ratarata=(jumlah/6) where kepemimpinan >'0'");
		mysql_query("UPDATE skppeg set perilaku=((ratarata*40)/100)");
		mysql_query("UPDATE skppeg set prestasi=(skp + perilaku)");

		
		
			
}
			//$up=mysql_fetch_assoc(mysql_query("select * from kgbpeg where up='1' and Status='2' "));
			
			//if($up0){$up1=mysql_query("update kgbpeg set up='2' where up='1' ");}


		
	switch ($lv0){
		case "kepegawaian":
			?><META http-equiv="refresh" content="1; url=pmikepegawaian.php?module=skp"><?

		break;
		case "admin":
			?><META http-equiv="refresh" content="1; url=pmiadmin.php?module=skp"><?
		break;
		default:
			echo "Anda tidak memiliki hak akses";
    }
}
?>

<body onload=disabletext(0)>
<?
$tempat=mysql_query("select * from utd where aktif='1'");
	$tempat1=mysql_fetch_assoc($tempat);
?>
<h1 style="color:#007700;">FORM INPUT SKP KARYAWAN <?=$tempat1[nama]?></h1>
<form name="periksa" method="post" action="<?=$PHP_SELF?>" >
<!--table class="form" cellspacing="0" cellpadding="2">
<table border=1 cellpadding="5" cellspacing="1" style="border-collapse:collapse" width="100%"-->
<table cellspacing="1" cellpadding="2" style="background-color:#007700;">

<tr border=1 cellpadding="5" cellspacing="1" style="background-color:#007700; font-size:12px; color:#FFFFFF; font-family:Verdana;" >
	<!--tr-->
    <?php
	$check=mysql_query("select * from pegawai where Kode='$_POST[nokantong1]'");
	$check1=mysql_fetch_assoc($check);
	$check2=mysql_query("select * from pegawai where Kode='$_POST[nokantong2]'");
	$check3=mysql_fetch_assoc($check2);
	$check4=mysql_query("select * from pegawai where Kode='$_POST[nokantong3]'");
	$check5=mysql_fetch_assoc($check4);
	
	?>
<!--Data karyawan yg dinilai-->
	<td>
	<table border=1 cellpadding="5" cellspacing="1">
	<tr><td colspan='2' style="font-weight: bold;">1. DATA KARYAWAN YANG DINILAI</td></tr>
	<td>NIK</td>
		<td class="input">
			<input type=hidden name=nikstaff value="<?=$check1[Kode]?>">
			<?=$check1[Kode]?>
		</td>
		</tr>
		
	<tr>
		<td>Nama Karyawan</td>
		<td class="input">
			<?=$check1[Nama]?>
		</td>
	</tr>
	
	<tr>
		<td>Status Karyawan</td>
		<? 
		$ini1="Resign";
		if ($check1[statuspeg]=="0")$ini1="Paruh Waktu";
		if ($check1[statuspeg]=="1")$ini1="Kontrak";
		if ($check1[statuspeg]=="2")$ini1="Tetap";
		if ($check1[statuspeg]=="3")$ini1="PNS Diperbantukan";
		?>
		<td class="input">
			<?=$ini1?>
		</td></tr>


		<tr>
		<td>Golongan</td>
		<td class="input">
		<input type=hidden name=golstaff value="<?=$check1[golongan]?>">
			<?=$check1[golongan]?>
		</td> </tr>
		
		<tr>
		<td>Jabatan</td>
		<td class="input">
		<input type=hidden name=jabstaff value="<?=$check1[jabatan]?>">
			<?=$check1[jabatan]?>
		</td> </tr>
		<tr>		
		<td>Direktorat</td>
		<td class="input">
			<?$direktorat=mysql_fetch_assoc(mysql_query("select nama from direktoratpeg where kode='$check1[direktorat]'"));?>
			<input type=hidden name=dirstaff value="<?=$check1[direktorat]?>">
			<?=$direktorat[nama]?>
		</td></tr>
		<tr>		
		<td>Bagian</td>
		<td class="input">
			<?$bagian=mysql_fetch_assoc(mysql_query("select nama from bagianpeg where kode='$check1[bagian]'"));?>
			<input type=hidden name=bagstaff value="<?=$check1[bagian]?>">
			<?=$bagian[nama]?>
		</td></tr>

		<!--tr>
		<td>TMT</td>
		<td class="input">
			<?=$check1[tmt]?>
		</td> </tr-->
		<tr>
		<td>Masa Kerja</td>
		<td class="input"><input type=hidden name=masakerjastaff value="<?=$check1[masakerja]?>">
			<?=$check1[masakerja]?> tahun
		<!--td class="input"><?=$check1[masakerja]?> tahun-->
		</td>
	</tr>
		<tr>
		<td>Ijazah</td>
		<td class="input"><input type=hidden name=ijasahstaff value="<?=$check1[ijasah]?>">
			<?=$check1[ijasah]?>
		</td> </tr>
		<tr>
	
		</tr>


</table></td>

<!--DATA pejabat penilai-->

	<td>
	<table border=1 cellpadding="5" cellspacing="1">
	<tr><td colspan='2' style="font-weight: bold;">2. DATA PEJABAT PENILAI</td></tr>
	<td>NIK</td>
		<td class="input">
			<input type=hidden name=nikpenilai value="<?=$check3[Kode]?>">
			<?=$check1[Kode]?>
		</td>
		</tr>
		
	<tr>
		<td>Nama Karyawan</td>
		<td class="input">
			<?=$check3[Nama]?>
		</td>
	</tr>
	<!--tr>
		<td>Tanggal Lahir</td>
		<td class="input"><?=$check3[TglLhr]?>
		</td>
	</tr>
	<tr>
		<td>Umur</td>
		<td class="input"><?=$check3[umur]?> Tahun
		</td>
	</tr>
	<!--tr>
		<td>Alamat</td>
		<td class="input">
			<?=$check1[Alamat]?>
		</td> </tr>
	<tr>
		<td>Status</td>
		<? 
		$ini="Bujang";
		if ($check1[Status]=="1")$ini="Menikah";
		?>
		<td class="input">
			<?=$ini?>
		</td></tr-->
	<tr>
		<td>Status Karyawan</td>
		<? 
		$ini2="Resign";
		if ($check3[statuspeg]=="0")$ini2="Paruh Waktu";
		if ($check3[statuspeg]=="1")$ini2="Kontrak";
		if ($check3[statuspeg]=="2")$ini2="Tetap";
		if ($check3[statuspeg]=="3")$ini2="PNS Diperbantukan";
		?>
		<td class="input">
			<?=$ini2?>
		</td></tr>


		<tr>
		<td>Golongan</td>
		<td class="input">
			<input type=hidden name=golpenilai value="<?=$check3[golongan]?>">
			<?=$check3[golongan]?>
		</td> </tr>
		
		<tr>
		<td>Jabatan</td>
		<td class="input">
			<input type=hidden name=jabpenilai value="<?=$check3[jabatan]?>">
			<?=$check3[jabatan]?>
		</td> </tr>
		<tr>		
		<td>Direktorat</td>
		<td class="input">
			<?$direktorat2=mysql_fetch_assoc(mysql_query("select nama from direktoratpeg where kode='$check1[direktorat]'"));?>
			<input type=hidden name=dirpenilai value="<?=$check3[direktorat]?>">
			<?=$direktorat2[nama]?>
		</td></tr>
		<tr>		
		<td>Bagian</td>
		<td class="input">
			<?$bagian2=mysql_fetch_assoc(mysql_query("select nama from bagianpeg where kode='$check3[bagian]'"));?>
			<input type=hidden name=bagpenilai value="<?=$check3[bagian]?>">
			<?=$bagian2[nama]?>
		</td></tr>

		<!--tr>
		<td>TMT</td>
		<td class="input">
			<?=$check1[tmt]?>
		</td> </tr-->
		<tr>
		<td>Masa Kerja</td>
		<td class="input"><input type=hidden name=masakerjapenilai value="<?=$check3[masakerja]?>">
			<?=$check3[masakerja]?> tahun
		<!--td class="input"><?=$check1[masakerja]?> tahun-->
		</td>
	</tr>
		<tr>
		<td>Ijazah</td>
		<td class="input"><input type=hidden name=ijasahpenilai value="<?=$check3[ijasah]?>">
			<?=$check3[ijasah]?>
		</td> </tr>
		<tr>
	
		</tr>


</table></td>

<!--DATA atasan penilai-->


	<td>
	<table border=1 cellpadding="5" cellspacing="1">
	<tr><td colspan='2' style="font-weight: bold;">3. DATA ATASAN PEJABAT PENILAI</td></tr>
	<td>NIK</td>
		<td class="input">
			<input type=hidden name=nikatasan value="<?=$check5[Kode]?>">
			<?=$check5[Kode]?>
		</td>
		</tr>
		
	<tr>
		<td>Nama Karyawan</td>
		<td class="input">
			<?=$check5[Nama]?>
		</td>
	</tr>
	<!--tr>
		<td>Tanggal Lahir</td>
		<td class="input"><?=$check5[TglLhr]?>
		</td>
	</tr>
	<tr>
		<td>Umur</td>
		<td class="input"><?=$check5[umur]?> Tahun
		</td>
	</tr>
	<!--tr>
		<td>Alamat</td>
		<td class="input">
			<?=$check1[Alamat]?>
		</td> </tr>
	<tr>
		<td>Status</td>
		<? 
		$ini="Bujang";
		if ($check1[Status]=="1")$ini="Menikah";
		?>
		<td class="input">
			<?=$ini?>
		</td></tr-->
	<tr>
		<td>Status Karyawan</td>
		<? 
		$ini3="Resign";
		if ($check5[statuspeg]=="0")$ini3="Paruh Waktu";
		if ($check5[statuspeg]=="1")$ini3="Kontrak";
		if ($check5[statuspeg]=="2")$ini3="Tetap";
		if ($check5[statuspeg]=="3")$ini3="PNS Diperbantukan";
		?>
		<td class="input">
			<?=$ini3?>
		</td></tr>


		<tr>
		<td>Golongan</td>
		<td class="input">
			<input type=hidden name=golatasan value="<?=$check5[golongan]?>">
			<?=$check5[golongan]?>
		</td> </tr>
		
		<tr>
		<td>Jabatan</td>
		<td class="input">
			<input type=hidden name=jabatasan value="<?=$check5[jabatan]?>">
			<?=$check5[jabatan]?>
		</td> </tr>
		<tr>		
		<td>Direktorat</td>
		<td class="input">
			<?$direktorat3=mysql_fetch_assoc(mysql_query("select nama from direktoratpeg where kode='$check5[direktorat]'"));?>
			<input type=hidden name=diratasan value="<?=$check5[direktorat]?>">
			<?=$direktorat3[nama]?>
		</td></tr>
		<tr>		
		<td>Bagian</td>
		<td class="input">
			<?$bagian3=mysql_fetch_assoc(mysql_query("select nama from bagianpeg where kode='$check5[bagian]'"));?>
			<input type=hidden name=bagatasan value="<?=$check5[bagian]?>">
			<?=$bagian3[nama]?>
		</td></tr>

		<!--tr>
		<td>TMT</td>
		<td class="input">
			<?=$check1[tmt]?>
		</td> </tr-->
		<tr>
		<td>Masa Kerja</td>
		<td class="input"><input type=hidden name=masakerjaatasan value="<?=$check5[masakerja]?>">
			<?=$check5[masakerja]?> tahun
		<!--td class="input"><?=$check1[masakerja]?> tahun-->
		</td>
	</tr>
		<tr>
		<td>Ijazah</td>
		<td class="input"><input type=hidden name=ijasahatasan value="<?=$check5[ijasah]?>">
			<?=$check5[ijasah]?>
		</td> </tr>
		<tr>
	
		</tr>


</table></td>


</tr>
</table>




<table>


<tr>
<td><table cellspacing="1" cellpadding="2" style="background-color:#007700;">

<tr border=1 cellpadding="5" cellspacing="1" style="background-color:#007700; font-size:12px; color:#FFFFFF; font-family:Verdana;" >
<td>
	<table border=1 cellpadding="5" cellspacing="1">
<tr><td colspan='5' style="font-weight: bold;">Waktu penilaian dari <input type="text" name="tgl8" id="datepicker7" placeholder="yyyy-mm-dd" size=11> sampai <input type="text" name="tgl9" id="datepicker8" placeholder="yyyy-mm-dd" size=11></td>
			</tr>


		<td colspan='4' style="font-weight: bold;">4. UNSUR YANG DINILAI</td>
		<td style="font-weight: bold;">JUMLAH</td></tr>
				   <tr> 
					<td colspan='4'>a. Sasaran Kerja Pegawai (SKP)</td>
					<td class='input'> <input name="angka7" id="varG" type="textbox" size="4" placeholder="Angka"></td>
					
<script>
function addNumbers(elem1, elem2, elem3, elem4, elem5, elem6, elem7) {
  var a = document.getElementById(elem1).value;
  var b = document.getElementById(elem2).value;
  var c = document.getElementById(elem3).value;
  var d = document.getElementById(elem4).value;
  var e = document.getElementById(elem5).value;
  var f = document.getElementById(elem6).value;
  var g = document.getElementById(elem7).value;
 // var h = document.getElementById(elem8).value;
  //var i = document.getElementById(elem9).value;
  //var j = document.getElementById(elem10).value;
 // var i = (Number(a) + Number(b) + Number(c) + Number(d) + Number(e)+ Number(f)+ Number(g))/5;
  var j = (Number(a) + Number(b) + Number(c) + Number(d) + Number(e)+ Number(f)+ Number(g))/6;
  var k = Number(a) + Number(b) + Number(c) + Number(d) + Number(e)+ Number(f);
  var l = (((Number(a) + Number(b) + Number(c) + Number(d) + Number(e)+ Number(f)+ Number(g))/6)*40)/100;
  var m = Number(g)+ Number(l);
 // var k = ((((Number(a) + Number(b) + Number(c) + Number(d) + Number(e)+ Number(f)+ Number(g)+ Number(h))/8)*40)/100;
 document.getElementById("testResult").innerHTML =j;
 document.getElementById("testResult1").innerHTML =k;
 document.getElementById("testResult5").innerHTML =l;
 document.getElementById("testResult6").innerHTML =m;
}

function addNumbers1(elem1, elem2, elem3, elem4, elem5, elem7) {
  var a = document.getElementById(elem1).value;
  var b = document.getElementById(elem2).value;
  var c = document.getElementById(elem3).value;
  var d = document.getElementById(elem4).value;
  var e = document.getElementById(elem5).value;
 // var f = document.getElementById(elem6).value;
  var g = document.getElementById(elem7).value;
 // var h = document.getElementById(elem8).value;
  //var i = document.getElementById(elem9).value;
  //var j = document.getElementById(elem10).value;
  var i = (Number(a) + Number(b) + Number(c) + Number(d) + Number(e))/5;
  var j = (((Number(a) + Number(b) + Number(c) + Number(d) + Number(e))/5)*40)/100;
  var k = Number(a) + Number(b) + Number(c) + Number(d) + Number(e);
  var l = Number(j) + Number(g);
 document.getElementById("testResult2").innerHTML =k;
 document.getElementById("testResult3").innerHTML =i;
 document.getElementById("testResult4").innerHTML =j;
 document.getElementById("testResult7").innerHTML =l;
}
</script>



				<tr>
					<td rowspan='11'>b. Perilaku Kerja</td>
					<td>Orientasi Pelayanan</td>
					<td class="input">
					<input name="angka1" id="varA" type="textbox" size="5" placeholder="Angka" value="<?php if($cek_tmpudd!=0){echo "$data_combo[angka]";}?>">
					</td>
					<td class="input">
						 <select name="kategori">
							  <option value="0">Sangat Baik</option>
							  <option value="1" selected>Baik</option>
							  <option value="2">Cukup</option>
							  <option value="3">Kurang</option>
							  <option value="4">Sangat Kurang</option>
					</td>
					
					
			   	</tr>
				<tr>
					<td>Integritas</td>
					<td class="input">
					<input name="angka2" id="varB" type="textbox" size="5" placeholder="Angka" value="<?php if($cek_tmpudd!=0){echo "$data_combo[angka0]";}?>">
					</td>
					<td class="input">
						 <select name="kategori0">
							  <option value="0">Sangat Baik</option>
							  <option value="1" selected>Baik</option>
							  <option value="2">Cukup</option>
							  <option value="3">Kurang</option>
							  <option value="4">Sangat Kurang</option>
					</td>
					
					
			   	</tr>

				<tr>
					<td>Komitmen</td>
					<td class="input">
					<input name="angka3" id="varC" type="textbox" size="5" placeholder="Angka" value="<?php if($cek_tmpudd!=0){echo "$data_combo[angka1]";}?>">
					</td>
					<td class="input">
						 <select name="kategori1">
							  <option value="0">Sangat Baik</option>
							  <option value="1" selected>Baik</option>
							  <option value="2">Cukup</option>
							  <option value="3">Kurang</option>
							  <option value="4">Sangat Kurang</option>
					</td>
					
			   	</tr>

				<tr>
					<td>Disiplin</td>
					<td class="input">
					<input name="angka4" id="varD" type="textbox" size="5" placeholder="Angka" value="<?php if($cek_tmpudd!=0){echo "$data_combo[angka2]";}?>">
					</td>
					<td class="input">
						 <select name="kategori2">
							  <option value="0">Sangat Baik</option>
							  <option value="1" selected>Baik</option>
							  <option value="2">Cukup</option>
							  <option value="3">Kurang</option>
							  <option value="4">Sangat Kurang</option>
					</td>
					
			   	</tr>

				<tr>
					<td>Kerjasama</td>
					<td class="input">
					<input name="angka5" id="varE" type="textbox" size="5" placeholder="Angka" value="<?php if($cek_tmpudd!=0){echo "$data_combo[angka3]";}?>">
					</td>
					<td class="input">
						 <select name="kategori3">
							  <option value="0">Sangat Baik</option>
							  <option value="1" selected>Baik</option>
							  <option value="2">Cukup</option>
							  <option value="3">Kurang</option>
							  <option value="4">Sangat Kurang</option>
					</td>
				
			   	</tr>

				<tr>
					<td>Kepemimpinan</td>
					<td class="input">
					<input name="angka6" id="varF"  type="textbox" size="5" placeholder="Angka" value="<?php if($cek_tmpudd!=0){echo "$data_combo[angka4]";}?>">
					</td>
					<td class="input">
						 <select name="kategori4">
							  <option value="0">Sangat Baik</option>
							  <option value="1" selected>Baik</option>
							  <option value="2">Cukup</option>
							  <option value="3">Kurang</option>
							  <option value="4">Sangat Kurang</option>
					</td>
					
			   	</tr>


			
<tr>
				<td>
				
				</td>
					<td>
					<input type="button"  value="Hitung Nilai staf"     onclick="addNumbers1('varA', 'varB', 'varC', 'varD', 'varE', 'varG')"></input></td>
					<td>
					<input type="button"  value="Hitung Nilai pemimpin" onclick="addNumbers('varA', 'varB', 'varC', 'varD', 'varE', 'varF', 'varG')"></input>
					</td>
</tr>
<tr>
		
<td>Jumlah</td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult2"></td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult1"></td>
</tr>
<tr>
<td>Nilai Rata-rata</td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult3"></td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult"></td>
</tr>
<tr>
<td colspan='3'>Nilai Perilaku Kerja Staff</td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult4"></td>
</tr>
<tr>
<td colspan='3'>Nilai Perilaku Kerja Pemimpin</td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult5"></td>
</tr>
<tr>
<td colspan='4'>NILAI PRESTASI KERJA STAFF</td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult7"></td>
</tr>
<tr>
<td colspan='4'>NILAI PRESTASI KERJA PEMIMPIN</td>
<td class="input" name="nilai" style="font-weight: bold;" size="5" id="testResult6"></td>
</tr>

	
					
				
 
			   </table>
		  </td>





</tr>
</table>


<td border=1 cellpadding="5" cellspacing="1" style="background-color:#007700; font-size:12px; color:#FFFFFF; font-family:Verdana;">
	<table border=1 cellpadding="5" cellspacing="1">
	<tr > 
			<td style="font-weight: bold;">5. Keberatan pegawai yang dinilai (kalau ada)</td>
			<td align='center'>Tgl Keberatan</td>
			</tr>
			<tr>
				   
					<td class="input"><input type="text" name="keberatan" placeholder='Isikan detail keberatan' size='45' ></td>
				<td><input type="text" name="tgl1" id="datepicker" placeholder="yyyy-mm-dd" size=11></td>
				
				</tr>

	<tr > 
			<td style="font-weight: bold;">6. Tanggapan Pejabat Penilai Atas Keberatan</td>
			<td align='center'>Tgl Tanggapan</td>
			</tr>
			<tr>
				   
					<td class="input"><input type="text" name="tanggapan" placeholder='Isikan detail keberatan' size='45' ></td>
				<td><input type="text" name="tgl2" id="datepicker1" placeholder="yyyy-mm-dd" size=11></td>
				
				</tr>
	<tr > 
			<td style="font-weight: bold;">7. Keputusan Atasan Pejabat Penilai Keberatan</td>
			<td align='center'>Tgl Keputusan</td>
			</tr>
			<tr>
				   
					<td class="input"><input type="text" name="keputusan" placeholder='Isikan detail keberatan' size='45' ></td>
				<td><input type="text" name="tgl3" id="datepicker2" placeholder="yyyy-mm-dd" size=11></td>
				
				</tr>
	<tr > 
			<td style="font-weight: bold;">8. Keterangan Lain-lain Atas Keberatan</td>
			<td align='center'>Tgl Keterangan</td>
			</tr>
			<tr>
				   
					<td class="input"><input type="text" name="keterangan" placeholder='Isikan detail keberatan' size='45' ></td>
				<td><input type="text" name="tgl4" id="datepicker3" placeholder="yyyy-mm-dd" size=11></td>
				
				</tr>
			<tr><td style="font-weight: bold;">9. Tgl Diterima Karyawan</td>
				<td class="input"><input type="text" name="tgl5" id="datepicker4" placeholder="yyyy-mm-dd" size=11></td>
			</tr>
			 <tr><td style="font-weight: bold;">10. Tgl Dibuat Penilai</td>
				<td class="input"><input type="text" name="tgl6" id="datepicker5" placeholder="yyyy-mm-dd" size=11></td>
			</tr>
			<tr><td style="font-weight: bold;">11. Tgl Diterima Atasan</td>
				<td class="input"><input type="text" name="tgl7" id="datepicker6" placeholder="yyyy-mm-dd" size=11></td>
			</tr>
			
				
 
			   </table>
		  </td>





</tr>
</table>



<br>

<input type="submit" name="submit" value="Simpan">

</form>
<? 

} ?>
