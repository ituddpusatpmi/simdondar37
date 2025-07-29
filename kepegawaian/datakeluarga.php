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
$kdtp	= "DK".$tgl.$bl.$th."-";
$idp	= mysql_query("select notrans from keluargapeg where notrans like '$kdtp%' order by notrans DESC");
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
	  $tgllhr 	= $_POST["tgllhr"];
	
	$tambah=mysql_query("insert into keluargapeg 
			(notrans,nik,NoKTP,Nama,Alamat,Jk,telp,
			TempatLhr,TglLhr,Status,telp2,pencatat,tanggal_entry,ijasah,keluarga,pekerjaan)
	value ('$id_transaksi_baru','$nik','$_POST[noktp]','$_POST[nama]','$_POST[alamat]','$_POST[jk]','$_POST[telp]','$_POST[tptlhr]','$tgllhr',
		'$_POST[status]','$_POST[telp2]','$namauser','$today1','$_POST[ijasah]','$_POST[keluarga]','$_POST[pekerjaan]')");
	
	if ($tambah) {
		echo "Data Telah berhasil dimasukkan<br>";
					
		mysql_query("UPDATE keluargapeg set umur=(TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25");
		
		
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
<h1 class="table">FORM INPUT DATA KELUARGA KARYAWAN</h1>
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
	<!--tr>
		<td>Tanggal Lahir</td>
		<td class="input"><?=$check1[TglLhr]?>
		</td>
	</tr>
	<tr>
		<td>Donor Apheresis</td>
		<?
		$apheresis1=$_GET[apheresis];
		$apheresis=$apheresis1;
		if ($apheresis1=='1'){
			$apheresis1='Ya';}
		else{$apheresis1='Tidak';
		}
		?>
		<td class="input">
		<input type="text" name="apheresis2" value="<?=$apheresis1?>" id="comments"><?$apheresis1?>
		<input type="hidden" name="apheresis" value="<?=$apheresis?>">
		</td>
	</tr-->
<td><table>
	<tr><td colspan='2'>DATA KELUARGA :</td></tr>
	 <tr>
					<td>No. KTP/SIM</td>
					<td class="input">
						 <input name="noktp" type="text" size="30" placeholder="Nomor KTP/SIM/KP/KTM" >
					</td>
			   </tr>
			   <tr>
					<td>Nama</td>
					<td class="input">
						 <input name="nama" type="text" size="30" placeholder="Nama lengkap" pattern="^[A-Za-z.,' ]{3,}$">
					</td>
			   </tr>
			   <tr>
					<td>Alamat</td>
					<td class="input">
						 <input name="alamat" type="textbox" size="30" placeholder="Jalan, RT/RW" value="<?php if($cek_tmpudd!=0){echo "$data_combo[alamat]";}?>">
					</td>
			   </tr>
			   <!--tr>
					<td>Kelurahan</td>
					<td class1="input">
						 <!--input name="kelurahan" type="text" size="30" placeholder="Kelurahan/Desa" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kelurahan]";}?>">
					</td>
						<input name="kelurahan" type="text" size="30" placeholder="Kelurahan/Desa" id='kelurahan' >
					</td>
			   </tr>
			   <tr>
					<td>Kecamatan</td>
					<td class="input">
						 <!--input name="kecamatan" type="text" size="30" placeholder="Kecamatan" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kecamatan]";}?>">
					</td>
						<input name="kecamatan" type="text" size="30" placeholder="Kecamatan" id='kecamatan'>
			   </tr>		
			   <tr>
					<td>Wilayah</td>
					<td class="input">
						 <input name="wilayah" type="text" size="30" placeholder="Wilayah" value="<?php if($cek_tmpudd!=0){echo "$data_combo[wilayah]";}?>">
					</td>
			   </tr>		
			   <tr>
					<td>Kode Pos</td>
					<td class="input">
						 <input name="kodepos" type="text" size="30" placeholder="Lima Digit" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kodepos]";}?>">
					</td>
			   </tr-->
			   <tr>
					<td>Jenis Kelamin</td>
					<td class="input" >
						 <input type="radio" id="radio1" name="jk" value="0" >
							  <label for="radio1">Laki-laki</label>
						 <input type="radio" id="radio2" name="jk" value="1" >
							  <label for="radio2">Perempuan</label>
					</td>
			   </tr>
			   <tr>
					<td>Tempat Lahir</td>
					<td class="input">
						 <input name="tptlhr" type="text" size="30" placeholder="Kabupaten">
					</td>
			   </tr>

			  <tr> 
					<td>Tgl Lahir</td>
					<td class="input">
						 <input type="text" name="tgllhr" id="datepicker" placeholder="yyyy-mm-dd" size=11 required
							  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
					</td>
			   </tr>
						   
			   <!--tr>
					<td>Umur</td>
					<td class="input">
						 <input name="umur" type="float" size="4"> Tahun
					</td>
			   </tr>

			<tr> 
					<td>TMT</td>
					<td class="input">
						 <input type="text" name="tmt" id="datepicker1" placeholder="yyyy-mm-dd" size=11 
						required onchange="document.reg.masakerja.value=Age(document.reg.datepicker1.value);">
					</td>
			   </tr>
				<tr> 
					<td>Tgl KGB terakhir</td>
					<td class="input">
						 <input type="text" name="tglkgb" id="datepicker2" placeholder="yyyy-mm-dd" size=11>
					</td>
			   </tr>
						   <tr> 
					<td>Tgl KP terakhir</td>
					<td class="input">
						 <input type="text" name="tglkp" id="datepicker3" placeholder="yyyy-mm-dd" size=11>
					</td-->
	
				 <tr>
			      <td>Pendidikan</td>
			     <td class="input">
						 <select name="ijasah">
							<option value="BALITA">BALITA</option>
							<option value="PAUD">PAUD</option>
							<option value="TK">TK</option>
							<option value="SD">SD</option>  
							<option value="SMP">SMP</option>
							  <option value="SMA" selected>SMA</option>
							  <option value="D1">D1</option>
							  <option value="D3">D3</option>
							  <option value="S1">S1</option>
								<option value="S2">S2</option>
								<option value="S3">S3</option>
								<option value="S4">S4</option></select>
					</td>
			   </tr>
				<!--tr>
			      <td>Jabatan</td>
			     <td class="input">
						 <select name="jabatan">
							  <option value="staff" selected>Staff</option>
							  <option value="kaTU">Ka. TU</option>
							  <option value="sekretaris">Sekretaris</option>
							  <option value="kabig">Kabig</option>
							  <option value="wadir" >Wadir</option>
								<option value="direktur">Direktur</option>
								</select>
					</td>
			   </tr-->
			   <tr> 
					<td>Pekerjaan</td>
					<td class="input">
						 <select name="pekerjaan" >
							  <option value="" selected>--Pilih--</option>
								   <?php
								   $q="select * from pekerjaan";
								   $do=mysql_query($q,$con);
								   while($data=mysql_fetch_assoc($do)){
										$select="";
								   ?>
							  <option value="<?=$data[Nama]?>"<?=$select?>>
								   <?=$data[Nama]?>
							  </option>
								   <?}?>
						 </select>
					</td>
			   </tr>

				 <tr>
			      <td>Hubungan Keluarga</td>
			     <td class="input">
						 <select name="keluarga">
							  <option value="s" >Suami</option>
							  <option value="i" selected>Istri</option>
							  <option value="a1" >Anak ke-1</option>
							  <option value="a2">Anak ke-2</option>
							  <option value="a3">Anak ke-3</option>
							  </select>
					</td>
			   </tr>
				<tr>
			      <!--td>Status</td>
			     <td class="input">
						 <select name="statuspeg">
							  <option value="0" selected>Menikah</option>
							  <option value="1" >Bujang Sekolah</option>
							  <option value="2" >Bujang Bekerja</option>
						</select>
					</td>
			   </tr>

				<!--tr>
					<td>Nama Ibu Kandung</td>
					<td class="input">
						 <input name="ibukandung" type="text" size="30" placeholder="Nama lengkap">
					</td>
			   </tr-->
			   <tr>
					<td>Status Nikah</td>
					<td class="input">
						 <input type="radio" name="status" value="0">
					Menikah
						 <input type="radio" name="status" value="1">
					Sekolah/Kuliah
						<input type="radio" name="status" value="2">
					Bekerja
						<input type="radio" name="status" value="3">
					Cerai
						<input type="radio" name="status" value="4">
					Meninggal Dunia
					</td>
			   </tr>
			   <!--tr>
					<td>Golongan Darah</td>
					<td class="input">
						 <select name="goldarah">
							  <option value="A">A</option>
							  <option value="B">B</option>
							  <option value="AB">AB</option>
							  <option value="O">O</option>
							  <option value="X" selected>X</option></select>
					</td>
			   </tr>
			   <tr>
					<td>Rhesus</td>
					<td class="input">
						 <select name="rhesus">
							  <option value="+">Positif (+)</option>
							  <option value="-">Negatif (-)</option></select>
					</td>
			   </tr>
			   <!--tr>
					<td>Dapat dipanggil</td>
					<td class="input">
						 <select name="call">
							  <option value="1">Dapat</option>
							  <option value="0">Tidak</option></select>
					</td>
			   </tr>
			   <tr>
					<td>Jumlah Donor</td>
					<td class="input">
						 <input name="jumdonor" type="text" size="30">
					</td>
			   </tr>-->
			   <tr>
					<td >Telepon</td>
					<td class="input">
						 <input name="telp" type="text" size="30" placeholder="Telepon rumah/kantor(kode area-....)">
					</td>
			   </tr>
			   <tr>
					<td></td>
					<td class="input">
						 <input name="telp2" type="text" size="30" placeholder="Handphone(08....)">
						 
						
			   </tr>
				  

			   <!--tr>
			    <td >Jumlah Donor</td>
					<td class="input">
						 <input name="jumdonor" type="text" size="4" >
					</td>
			   </tr>
			   <tr>
			      <td>Donor Apheresis?</td>
			      <td class="input">
				<? 
				$apheresis_no='';$apheresis_ya='';
				if ($row[apheresis]=='0') $apheresis_no='selected';
				if ($row[apheresis]=='1') $apheresis_ya='selected';
				?>
				<select name="apheresis">
				  <option value="0" <?=$apheresis_no?>>Tidak Bersedia</option>
				  <option value="1" <?=$apheresis_ya?>>Bersedia</option>
				</select>
			      </td>
			   </tr-->
			   </table>
		  </td>





</tr>
</table>
<br>

<input type="submit" name="submit" value="Simpan">

</form>
