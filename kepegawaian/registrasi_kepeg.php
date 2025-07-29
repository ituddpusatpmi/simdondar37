<!-- HTML5 Shim, IE8 and bellow recognize HTML5 elements -->
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->		
<!-- Modernizr -->
<script src="js/modernizr-1.5.min.js"></script>
<!-- Webforms2 -->
<script src="webforms2/webforms2.js"></script>	
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<!-- disable enter -->
<script type="text/javascript" src="js/disable_enter.js"></script>
<!-- Form layout -->
<!--<link rel="stylesheet" href="css/html5forms.layout.css"> -->
<script src="js/html5forms.fallback.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        document.reg.noktp.focus();
      });
    </script>
<script type="text/javascript">
  jQuery(document).ready(function(){	
  	$('#kelurahan').autocomplete({source:'modul/suggest_kelurahan.php', minLength:2});});
</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
	$('#kecamatan').autocomplete({source:'modul/suggest_kecamatan.php', minLength:2});});
  </script>
<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
</script>

<?php 
require_once('clogin.php');
require_once('modul/background_process.php');
require_once('config/db_connect.php');
		  $lv0=$_SESSION[leveluser];
$today=date("Y-m-d");
if (isset($_POST[submit])) {
	$noktp 		= $_POST["noktp"];
	$nama 		= mysql_real_escape_string($_POST["nama"]);		
	$alamat		= mysql_real_escape_string($_POST["alamat"]);
	$jk 		= $_POST["jk"];						$golongan 	= mysql_real_escape_string($_POST["golongan"]);
	$telpa 		= $_POST["telp"]; 					$tptlhr 	= mysql_real_escape_string($_POST["tptlhr"]);
	$tgllhr 	= $_POST["tgllhr"];					$status 	= $_POST["status"];
	$tmt   		= $_POST["tmt"];
	$goldarah 	= $_POST["goldarah"];					$rhesus 	= $_POST["rhesus"];
	$call 		= $_POST["call"];					$kelurahan 	= mysql_real_escape_string($_POST["kelurahan"]);
	$kecamatan 	= mysql_real_escape_string($_POST["kecamatan"]);
	$kodepos 	= $_POST["kodepos"];					$wilayah 	= mysql_real_escape_string($_POST["wilayah"]);
	$telp2a 	= $_POST["telp2"];					$umur 		= $_POST["umur"];
	$mu		= $_POST["mu"];
	$tglkembali	= date("Y-m-d",$donorlagi);				$ibukandung	= mysql_real_escape_string($_POST["ibukandung"]);
	$jumdonor	= $_POST["jumdonor"];
	$namauser 	= $_SESSION[namauser];
	$donorlagi 	= mktime(0,0,0,date("m")+3,date("d"),date("Y"));
	$donorlagi 	= mktime(0,0,0,date("m")+3,date("d"),date("Y"));
	$apheresis	= $_POST['apheresis'];
	$ijasah		= $_POST["ijasah"];					$statuspeg	= $_POST["statuspeg"];	
	$kgb		= $_POST["tglkgb"];					$kp		= $_POST["tglkp"];						
	$golongan	= $_POST["golongan"];					$masakerja	= $_POST["masakerja"];	$jabatan=$_POST["jabatan"];	
	$cuti		=$_POST["cuti"];					$tglkontrak	= $_POST["tglkontrak"];
	$tmt80		=$_POST["tmt80"];					$tglcuti	= $_POST["tglcuti"];
	
	 //------------------------ set id pendonor ------------------------->
	 //digit pendonor 14 digit, 4kode utd, 3 nama, 2 tmpt aftap, 6 sequence, 
	 $q_utd	= mysql_query("select id from utd where aktif='1'",$con);			
	 $utd	= mysql_fetch_assoc($q_utd);
	 $nama1 = str_replace("-","",$tgllhr);
	 $nama1 = str_replace(" ","",$nama1);
	 $nama1 = str_replace(",","",$nama1);
	 
	 $tmt1 = str_replace("-","",$tmt);
	 $tmt1 = str_replace(" ","",$tmt1);
	 $tmt1 = str_replace(",","",$tmt1);

	 $nm=strtoupper(substr($nama1,2,8));
	 $tm=strtoupper(substr($tmt1,2,8));
	 $idp	= mysql_query("select id,id1 from tempat_donor where active='1'",$con);
	 $idp1	= mysql_fetch_assoc($idp);

	 $jk1='1';
	if ($jk=='1')$jk1='2';
	 $kdtp	= $utd[id].'.'.$nm.'.'.$tm.'.'.$jk1.'.';
	 $idp	= mysql_query("select Kode from pegawai  
			      order by waktu_update DESC",$con);
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= substr($idp1[Kode],21,3);
	
	// if ($idp2<1) {
	//	  $idp2="00";
	 //}
	 $int_idp2=(int)$idp2+1;
	 $j_nol1= 3-(strlen(strval($int_idp2)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode=$kdtp.$idp4.$int_idp2;
	 //---------------------- END set id pendonor ------------------------->
	//mysql_close($connection);
	 $_POST[submit]="";
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }
	 
	  $telp=trimed($telpa);
	  $telp2=trimed($telp2a);
	$sekarang = date("Y-m-d h:m:s");
	
	 $tambah_sql="insert into pegawai 
					(`Kode`,`NoKTP`,`Nama`,`Alamat`,`Jk`,`telp`,`TempatLhr`,`TglLhr`,`Status`,`GolDarah`,
					`Rhesus`,`kelurahan`,`kecamatan`,`wilayah`,`KodePos`,`title`,`telp2`,`ibukandung`,`pencatat`,`waktu_update`,
					`tanggal_entry`,`tmt`,`ijasah`,`statuspeg`,`kgb`,`kp`,`golongan`,`jabatan`,`sisacuti`,`tmtkontrak`,`tmt80`,`tglcuti`)
			   values ('$kode','$noktp','$nama','$alamat','$jk','$telp','$tptlhr','$tgllhr','$status','$goldarah','$rhesus',
					'$kelurahan','$kecamatan','$wilayah','$kodepos','$title','$telp2','$ibukandung',
					'$namauser','$sekarang','$sekarang','$tmt','$ijasah','$statuspeg','$kgb','$kp','$golongan','$jabatan','$cuti','$tglkontrak','$tmt80','$tglcuti')";
	 $tambah=mysql_query($tambah_sql,$con);
	$kelurahan=mysql_query("insert into kelurahan (Nama) values ('$kelurahan')");
	$kecamatan=mysql_query("insert into kecamatan (Nama) values ('$kecamatan')");
	//echo $tambah_sql;	
	backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
	
	//disini ditambahkan sql penyimpanan data sementara
	//check apakah data temp sudah ada, jika ada, update data temp
	//yang disimpan : nama dokter, petugas tensi, petugas hb
	$cek_tmpudd=1;
	$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU DAFTAR'"));
	if ($cek_tmpudd==0) {
	   $tambah_tmp=mysql_query("INSERT INTO tempudd (modul,alamat,kelurahan,kecamatan,wilayah,kodepos)
				   values ('MU DAFTAR','$alamat','$kelurahan','$kecamatan','$wilayah','$kodepos')");
	} else {
	   $tambah_tmp=mysql_query("UPDATE tempudd  SET alamat='$alamat',kelurahan='$kelurahan', kecamatan='$kecamatan',wilayah='$wilayah',
				   kodepos='$kodepos'
				   where modul='MU DAFTAR'");
	}

	//baru sampai disini
	
	if ($tambah) {
			mysql_query("update pegawai set kgb1=(kgb + interval 2 year)");
			mysql_query("update pegawai set kp1=(kp + interval 4 year)");
			mysql_query("update pegawai set tglpensiun=(tglLhr + interval 56 year)");
			mysql_query("UPDATE pegawai set umur=(TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25");
			mysql_query("UPDATE pegawai set masakerja=(TO_DAYS(NOW())- TO_DAYS(tmt)) / 365.25");
			mysql_query("UPDATE pegawai set sisacuti='0' where tglcuti < '$today'");
			mysql_query("update pegawai set tmt80=(tmtkontrak + interval 1 year) where statuspeg='1'");
			mysql_query("update pegawai set tmt=(tmt80 + interval 1 year) where statuspeg='1'");
		  echo "SESSION: $lv0 Data Telah berhasil dimasukkan<br> ";
		  print_r($_a);
		  $idp=mysql_query("select * from tempat_donor where active='1'",$con);
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") { 
			   mysql_query("update pegawai set mu='1' where Kode='$kode'",$con); 
			   $mu="1"; 
		  } else {
			   $mu="";
		  }	  
			mysql_close($con);
		 switch ($lv0){
			   case "kepegawaian":
					?>
				<META http-equiv="refresh" content="0; url=pmikepegawaian.php?module=search_kepeg">
					<?
			   break;
			  default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 } else {
		echo "<div id=\"warning\">Maaf, data yang anda masukkan tidak dapat disimpan</div><br>$tambah_sql";
	 }
} 
switch ($lv0) {
	 case "kepegawaian":
		  ?><form name="reg" autocomplete="off" method="post" action="pmikepegawaian.php?module=registrasi"><?
	 break;
        case "admin":
		  ?><form name="reg" method="post" action="pmiadmin.php?module=registrasi_kepeg"><?
	 break;
	 default:
		  echo "$lv0 OOO Anda tidak memiliki hak akses";
}
?>
<? $cek_tmpudd=1;
	$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU DAFTAR'"));
	
	  $query_combo = "select * from tempudd where modul='MU DAFTAR'";
 		$hasil_combo = mysql_query($query_combo);
 		$data_combo = mysql_fetch_array($hasil_combo);
		?>

<? if ($_SESSION[leveluser]=='kepegawaian') { ?>
<h1 class="table">FORM INPUT DATA KARYAWAN ||
<input type="button" value="SEARCH DATA KARYAWAN" onClick="document.location.href='pmikepegawaian.php?module=search_kepeg';"></h1>
<? } else if ($_SESSION[leveluser]=='kepegawaian') { ?>
<h1 class="table">FORM INPUT DATA KARYAWAN ||
<input type="button" value="SEARCH DATA KARYAWAN" onClick="document.location.href='pmikepegawaian.php?module=search_kepeg';"></h1>
<? } else { ?>
<h1 class="table">FORM INPUT DATA KARYAWAN ||
<input type="button" value="SEARCH DATA KARYAWAN" onClick="document.location.href='pmikasir.php?module=search_kepeg';"></h1>
<? } ?>
<table class="form" width=70%  cellspacing="1" cellpadding="2">
	 <tr>
		  <td>
			   <table>
			   <tr>
					<td>No. KTP/SIM</td>
					<td class="input">
						 <input name="noktp" type="text" size="30" placeholder="Nomor KTP/SIM/KP/KTM" >
					</td>
			   </tr>
			   <tr>
					<td>Nama</td>
					<td class="input">
						 <input name="nama" type="text" size="30" required placeholder="Nama lengkap" pattern="^[A-Za-z.,' ]{3,}$">
					</td>
			   </tr>
			   <tr>
					<td>Alamat</td>
					<td class="input">
						 <input name="alamat" type="textbox" size="30" required placeholder="Jalan, RT/RW" value="<?php if($cek_tmpudd!=0){echo "$data_combo[alamat]";}?>">
					</td>
			   </tr>
			   <tr>
					<td>Kelurahan</td>
					<td class1="input">
						 <!--input name="kelurahan" type="text" size="30" placeholder="Kelurahan/Desa" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kelurahan]";}?>">
					</td-->
						<input name="kelurahan" type="text" size="30" required placeholder="Kelurahan/Desa" id='kelurahan' >
					</td>
			   </tr>
			   <tr>
					<td>Kecamatan</td>
					<td class="input">
						 <!--input name="kecamatan" type="text" size="30" placeholder="Kecamatan" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kecamatan]";}?>">
					</td-->
						<input name="kecamatan" type="text" size="30" required placeholder="Kecamatan" id='kecamatan'>
			   </tr>		
			   <tr>
					<td>Wilayah</td>
					<td class="input">
						 <input name="wilayah" type="text" size="30" required placeholder="Wilayah" value="<?php if($cek_tmpudd!=0){echo "$data_combo[wilayah]";}?>">
					</td>
			   </tr>		
			   <tr>
					<td>Kode Pos</td>
					<td class="input">
						 <input name="kodepos" type="text" size="30" placeholder="Lima Digit" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kodepos]";}?>">
					</td>
			   </tr>
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
						 <input name="tptlhr" type="text" size="30" required placeholder="Kabupaten">
					</td>
			   </tr>

			   <tr> 
					<td>Tgl Lahir</td>
					<td class="input">
						 <input type="text" name="tgllhr" id="datepicker" placeholder="yyyy-mm-dd" size=11 required
							  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
					</td>
			   </tr>
				<tr> 
					<td>TMT CAPEG (Kontrak)</td>
					<td class="input">
						 <input type="text" name="tglkontrak" id="datepicker5" required placeholder="yyyy-mm-dd" size=11>
					</td>
			   </tr>		   
			   <!--tr>
					<td>Umur</td>
					<td class="input">
						 <input name="umur" type="float" size="4"> Tahun
					</td>
			   </tr-->

			<tr> 
					<td>TMT CAPEG Tetap 80%</td>
					<td class="input">
						 <input type="text" name="tmt80" id="datepicker1" required placeholder="yyyy-mm-dd" size=11>
					</td>
			   </tr>
			<tr> 
					<td>TMT PEG Tetap 100%</td>
					<td class="input">
						 <input type="text" name="tmt" id="datepicker6" required placeholder="yyyy-mm-dd" size=11>
					</td>
			   </tr>
			<tr> 
					<td>Tgl KGB terakhir</td>
					<td class="input">
						 <input type="text" name="tglkgb" id="datepicker2" required placeholder="yyyy-mm-dd" size=11>
					</td>
			</tr>
				<!--tr>
					<td>Masa Kerja</td>
					<td class="input">
						 <input name="masakerja" type="float" size="4"> Tahun
					</td>
			   </tr-->
			   </table>
		  </td>
		  <td>
			   <table>
			
						   <tr> 
					<td>Tgl KP terakhir</td>
					<td class="input">
						 <input type="text" name="tglkp" id="datepicker3" required placeholder="yyyy-mm-dd" size=11>
					</td>
			</tr>
			<tr>
			      <td>Ijazah Terakhir</td>
			     <td class="input">
						 <select name="ijasah">
							  <option value="SMP">SMP</option>
							  <option value="SMA">SMA</option>
							  <option value="D1">D1</option>
							  <option value="D3">D3</option>
							  <option value="S1" selected>S1</option>
								<option value="S2">S2</option>
								<option value="S3">S3</option>
								<option value="S4">S4</option></select>
					</td>
			   </tr>
				<tr>
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
			   </tr>
			   <tr> 
					<td>Golongan</td>
					<td class="input">
						 <select name="golongan" >
							  <option value="" selected>--Pilih--</option>
								   <?php
								   $q="select * from golonganpeg";
								   $do=mysql_query($q,$con);
								   while($data=mysql_fetch_assoc($do)){
										$select="";
								   ?>
							  <option value="<?=$data[golongan]?>"<?=$select?>>
								   <?=$data[golongan]?>
							  </option>
								   <?}?>
						 </select>
					</td>
			   </tr>

				 <tr>
			      <td>Status Pegawai</td>
			     <td class="input">
						 <select name="statuspeg">
							  <option value="0">Paruh Waktu</option>
							  <option value="1">Kontrak</option>
							  <option value="7">Tetap 80%</option>
							  <option value="2" selected>Tetap 100%</option>
							  <option value="3">PNS Diperbantukan</option>
							  <option value="4">Resign</option>
							  <option value="5">Pindah UDD</option>
							  <option value="6">Meninggal</option>
							  </select>
					</td>
			   </tr>

				<tr>
					<td>Nama Ibu Kandung</td>
					<td class="input">
						 <input name="ibukandung" type="text" size="30" placeholder="Nama lengkap">
					</td>
			   </tr>
			   <tr>
					<td>Status Perkawinan</td>
					<td class="input">
						 <input type="radio" name="status" value="0">
					Bujang
						 <input type="radio" name="status" value="1">
					Menikah 
						<input type="radio" name="status" value="2">
					Duda  <br>
						<input type="radio" name="status" value="3">
					Janda
						<input type="radio" name="status" value="4">
					Suami Karyawan
						<input type="radio" name="status" value="5">
					Istri Karyawan
					</td>
			   </tr>
			   <tr>
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
			  
			   <tr>
					<td >Telepon</td>
					<td class="input">
						 <input name="telp" type="text" size="30" placeholder="Telepon rumah/kantor(kode area-....)">
					</td>
			   </tr>
			   <tr>
					<td></td>
					<td class="input">
						 <input name="telp2" type="text" size="30" required placeholder="Handphone(08....)">
						 
						
			   </tr>
				  

			   <tr>
			    <td >Sisa Cuti Th ini</td>
					<td class="input">
						 <input name="cuti" type="text" size="4" > Hari
					</td>
			   </tr>
			<tr> 
					<td>Tgl Habis Cuti</td>
					<td class="input">
						 <input type="text" name="tglcuti" id="datepicker4" required placeholder="yyyy-mm-dd" size=11>
					</td>
			   </tr>	

			   <!--tr>
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
<input type="hidden" name="mu" value="<?=$mu?>">
<button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
	<span class="ui-button-text">Simpan</span>
</button>
</form>
