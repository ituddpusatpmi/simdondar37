<script type="text/javascript" src="js/jquery-latest.js"></script>
<script src="js/modernizr-1.5.min.js"></script>
<!-- Webforms2 -->
<script src="webforms2/webforms2.js"></script>	
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<!-- disable enter -->
<script type="text/javascript" src="js/disable_enter.js"></script>
<!-- Form layout -->
<!--<link rel="stylesheet" href="css/html5forms.layout.css"> -->
<script src="js/html5forms.fallback.js"></script>
			<script>
			function disabletext(val){ // masih belum berfungsi
				if(val=='0')
					document.getElementById('comments').disabled = true;
				else
					document.getElementById('comments').disabled = false;
			}
			</script>
<?
include ('config/db_connect.php');

//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th	= substr(date("Y"),2,2);
$bl	= date("m");
$tgl	= date("d");
$kdtp	= "DD".$tgl.$bl.$th."-";
$idp	= mysql_query("select notrans from diklatpeg where notrans like '$kdtp%' order by notrans DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[notrans],9,4);
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
	$nik 		= $_POST['nik'];
	$tglawal 	= $_POST['tgldiklat'];
	$tglakhir 	= $_POST['tgldiklat1'];
	
	$tambah=mysql_query("insert into diklatpeg 
			(notrans,nik,Nama,jenis,penyelenggara,tempat,telp,telp2,tglawal,tglakhir,Status,pencatat,
			tanggal_entry,sertifikat,nosertifikat,biaya,sponsor)
	value ('$id_transaksi_baru','$nik','$_POST[nama]','$_POST[jenis]','$_POST[penyelenggara]','$_POST[tempat]','$_POST[telp]','$_POST[telp2]','$tglawal','$tglakhir','$_POST[status]','$namauser','$today1','$_POST[sertifikat]','$_POST[nosertifikat]','$_POST[biaya]','$_POST[sponsor]')");
	
	if ($tambah) {
		echo "Data Telah berhasil dimasukkan<br>";
					
		mysql_query("UPDATE diklatpeg set masadiklat=(TO_DAYS(tglakhir)- TO_DAYS(tglawal))");
		
		
	}
	switch ($lv0){
		case "kepegawaian":
			?><META http-equiv="refresh" content="1; url=pmikepegawaian.php?module=search_kepeg"><?

		break;
		case "admin":
			?><META http-equiv="refresh" content="1; url=pmiadmin.php?module=registrasi"><?
		break;
		default:
			echo "Anda tidak memiliki hak akses";
    }
}
?>

<body onload=disabletext(0)>
<h1 class="table">FORM INPUT DATA DIKLAT KARYAWAN</h1>
<form name="periksa" method="post" action="<?=$PHP_SELF?>" >
<table class="form" cellspacing="0" cellpadding="2">
	<tr>
    <?php
	$check=mysql_query("select * from pegawai where Kode='$_GET[Kode]'");
	$check1=mysql_fetch_assoc($check);
	$tempat=mysql_query("select * from tempat_donor where active='1'");
	$tempat1=mysql_fetch_assoc($tempat);
	?>
	<td><table>
	<tr><td colspan='2'>DATA KARYAWAN :</td></tr>
	<td>NIK</td>
		<td class="input">
			<input type=hidden name=nik value="<?=$check1[Kode]?>">
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
		<td>Tanggal Lahir</td>
		<td class="input"><?=$check1[TglLhr]?>
		</td>
	</tr>
	<tr>
		<td>Umur</td>
		<td class="input"><?=$check1[umur]?> Tahun
		</td>
	</tr>
	<tr>
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
		</td></tr>
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
		<td>Ijazah Terakhir</td>
		<td class="input">
			<?=$check1[ijasah]?>
		</td> </tr>

		<tr>
		<td>Golongan</td>
		<td class="input">
			<?=$check1[golongan]?>
		</td> </tr>
		
		<tr>
		<td>Jabatan</td>
		<td class="input">
			<?=$check1[jabatan]?>
		</td> </tr>

		<tr>
		<td>TMT</td>
		<td class="input">
			<?=$check1[tmt]?>
		</td> </tr>
		<tr>
		<td>Masa Kerja</td>
		<td class="input"><?=$check1[masakerja]?> tahun
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>

</table></td>
	
<td><table>
	<tr><td colspan='2'>DATA DIKLAT :</td></tr>
				   <tr>
					<td>Nama DIKLAT</td>
					<td class="input">
						 <input name="nama" type="text" size="30" placeholder="Nama Diklat" pattern="^[A-Za-z.,' ]{3,}$">
					</td>
			   </tr>
			
				<tr>
			      <td>Jenis</td>
			     <td class="input">
						 <select name="jenis">
							<option value="0">Pendidikan</option>
							<option value="1">Pelatihan</option>
							</select>
					</td>
			   </tr>


			   <tr>
					<td>Penyelenggara</td>
					<td class="input">
					<input name="penyelenggara" type="textbox" size="30" placeholder="nama instansi" value="<?php if($cek_tmpudd!=0){echo "$data_combo[penyelenggara]";}?>">
					</td>
			   </tr>

				<tr>
					<td>tempat</td>
					<td class="input">
						 <input name="tempat" type="textbox" size="30" placeholder="nama instansi/alamat" value="<?php if($cek_tmpudd!=0){echo "$data_combo[tempat]";}?>">
					</td>
			   </tr>

				 <tr>
					<td >Telepon</td>
					<td class="input">
						 <input name="telp" type="text" size="30" placeholder="Telepon Instansi (kode area-....)">
					</td>
			   </tr>
			   <tr>
					<td></td>
					<td class="input">
						 <input name="telp2" type="text" size="30" placeholder="Handphone Panitia(08....)">
						 
						
			   </tr>

				<tr> 
					<td>Tanggal DIKLAT</td>
					<td class="input">
						 <input type="text" name="tgldiklat" id="datepicker" placeholder="yyyy-mm-dd" size=11> s/d 
						 <input type="text" name="tgldiklat1" id="datepicker1" placeholder="yyyy-mm-dd" size=11>
					</td>
			   </tr>

				 <tr>
					<td>Status Hasil</td>
					<td class="input">
						 <input type="radio" name="status" value="0">
					Lulus
						 <input type="radio" name="status" value="1">
					Lulus Bersyarat
						<input type="radio" name="status" value="2">
					Tidak Lulus
						</td>
			   </tr>

				<tr>
					<td>Sertifikat</td>
					<td class="input">
						 <input type="radio" name="sertifikat" value="0">
					Ada
						 <input type="radio" name="sertifikat" value="1">
					Tidak Ada
						</td>
			   </tr>

			<tr>
					<td>No Sertifikat</td>
					<td class="input">
						 <input name="nosertifikat" type="textbox" size="30" placeholder="nomor ijazah/sertifikat">
					</td>
			   </tr>

			<tr>
			      <td>Biaya</td>
			     <td class="input">
						 <select name="biaya">
							<option value="0">UDDP</option>
							<option value="1">Pribadi</option>
							<option value="1">Sponsor</option>
							</select>
					</td>
			   </tr>

				<tr>
					<td>Sponsor</td>
					<td class="input">
						 <input name="sponsor" type="textbox" size="30" placeholder="Nama Sponsor">
					</td>
			   </tr>
			   
			   </table>
		  </td>





</tr>
</table>
<br>

<input type="submit" name="submit" value="Simpan">

</form>
