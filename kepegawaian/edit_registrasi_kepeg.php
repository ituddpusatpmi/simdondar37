<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
   
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>


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


<?php 
include('clogin.php');
include('config/db_connect.php');
		  $lv0=$_SESSION[leveluser];
require_once('modul/background_process.php');
$today=date("Y-m-d");	  
if (isset($_POST[submit])) {
	$kode		=$_POST["kode"];
	 $noktp 	= $_POST["noktp"];
	$nama 		= $_POST["nama"];		
	$alamat		= mysql_real_escape_string($_POST["alamat"]);
	$jk 		= $_POST["jk"];					
	$telpa 		= $_POST["telp"]; 					$tptlhr 	= $_POST["tptlhr"];
	$tgllhr 	= $_POST["tgllhr"];					$status 	= $_POST["status"];
	$tmt   		= $_POST["tmt"];
	$goldarah 	= $_POST["goldarah"];					$rhesus 	= $_POST["rhesus"];
	$call 		= $_POST["call"];					$kelurahan 	= mysql_real_escape_string($_POST["kelurahan"]);
	$kecamatan 	= mysql_real_escape_string($_POST["kecamatan"]);
	$kodepos 	= $_POST["kodepos"];					$wilayah 	= mysql_real_escape_string($_POST["wilayah"]);
	$telp2a 	= $_POST["telp2"];					$umur 		= $_POST["umur"];
	$mu		= $_POST["mu"];
	$sekarang	= date("Y-m-d H:i:s");					$ibukandung	= mysql_real_escape_string($_POST["ibukandung"]);
	$namauser 	= $_SESSION[namauser];
	$ijasah		= $_POST["ijasah"];					$statuspeg	= $_POST["statuspeg"];	
	$kgb		= $_POST["tglkgb"];					$kp		= $_POST["tglkp"];	
	$golongan	= $_POST["golongan"];					$jabatan 	= $_POST["jabatan"];
	$cuti		= $_POST["cuti"];					$tglcuti	= $_POST["tglcuti"];
	
	 
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }
	  
	  $telp=trimed($telpa);
	  $telp2=trimed($telp2a);

	$tambah=mysql_query("UPDATE pegawai SET 
		  NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
		  telp='$telp',TempatLhr='$tptlhr',
		  TglLhr='$tgllhr',Status='$status',kelurahan='$kelurahan',
		  kecamatan='$kecamatan',wilayah='$wilayah',KodePos='$kodepos',
		  telp2='$telp2',ibukandung='$ibukandung',
		  pencatat='$namauser',waktu_update='$sekarang',
		  golongan='$golongan',ijasah='$ijasah',golongan='$_POST[golongan]',jabatan='$jabatan',statuspeg='$statuspeg',kgb='$kgb',kp='$kp',sisacuti='$cuti',tglcuti='$tglcuti'
		  where Kode='$kode'");

	//backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
	
	if ($tambah) {
		echo "Data Telah berhasil Diedit<br>";
			mysql_query("update pegawai set kgb1=(kgb + interval 2 year)");
			mysql_query("update pegawai set kp1=(kp + interval 4 year)");
			mysql_query("update pegawai set tglpensiun=(tglLhr + interval 56 year)");
			mysql_query("UPDATE pegawai set umur=(TO_DAYS(NOW())- TO_DAYS(TglLhr)) / 365.25");
			mysql_query("UPDATE pegawai set masakerja=(TO_DAYS(NOW())- TO_DAYS(tmt)) / 365.25");
			mysql_query("UPDATE pegawai set sisacuti='0' where tglcuti < '$today'");
		
	}
	switch ($lv0){
		case "kepegawaian":
			?><META http-equiv="refresh" content="1; url=pmikepegawaian.php?module=search_kepeg"><?

		break;
		default:
			echo "Anda tidak memiliki hak akses";
    }
	
}
if (isset($_GET[Kode])) {
	 $perintah=mysql_query("select * from pegawai where Kode='$_GET[Kode]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Nomor formulir yang anda masukkan belum terdaftar";
		  ?> <META http-equiv="refresh" content="2; url=pmiadmin.php?module=eregistrasi"><?
	 } else {	
?>
<h1 class="table">EDIT DATA KARYAWAN</h1>
<form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<table class="form" width=65%  cellspacing="1" cellpadding="2">
<tr>
	 <td>NIK</td>
	 <td class="input"><?=$row[Kode]?></td>
<td>Nama Ibu Kandung</td>
	 <td class="input">
		  <input name="ibukandung" type="text" size="30" value="<?=$row[ibukandung]?>">
	 </td>
</tr>
<tr>
	 <td>No. KTP</td>
	 <td class="input">
		  <input name="noktp" type="text" size="30" value="<?=$row[NoKTP]?>">
	 </td>
<td>Ijazah Terakhir</td>
     <td class="input">



			<? 
			$A='';$B='';$C='';$D='';$E='';$F='';$G='';$H='';
			if ($row[ijasah]=='SMP') $A='selected';
			if ($row[ijasah]=='SMA') $B='selected';
			if ($row[ijasah]=='D1')  $C='selected';
			if ($row[ijasah]=='D3')  $D='selected';
			if ($row[ijasah]=='S1')  $E='selected';
			if ($row[ijasah]=='S2')  $F='selected';
			if ($row[ijasah]=='S3')  $G='selected';
			if ($row[ijasah]=='S4')  $H='selected';
			?>
			 <select name="ijasah">
							<option value="SMP" <?=$A?> >SMP</option>
							<option value="SMA" <?=$B?> >SMA</option>
							<option value="D1"  <?=$C?> >D1</option>
							<option value="D3"  <?=$D?> >D3</option>
							<option value="S1"  <?=$E?> >S1</option>
							<option value="S2"  <?=$F?> >S2</option>
							<option value="S3"  <?=$G?> >S3</option>
							<option value="S4"  <?=$H?> >S4</option>
			</select>
	 </td>

</tr>
<tr>
	 <td>Nama</td>
	 <td class="input">
		  <input name="nama" type="text" size="30" value="<?=$row[Nama]?>">
	 </td>
     <td>Golongan</td>
					<td class="input">
						 <select name="golongan" >
								   <?php
								   $q="select * from golonganpeg";
								   $do=mysql_query($q,$con);
										$select="";
								   while($data=mysql_fetch_assoc($do)){
									if ($data[golongan]==$row[golongan]) $select='selected';
								   ?>
							  <option value="<?=$data[golongan]?>"<?=$select?>>
								   <?=$data[golongan]?>
							  </option>
								   <?
										$select="";
									}?>
						 </select>
					</td>	

</tr>
<tr>
	<td>Tempat Lahir</td>
	 <td class="input">
		  <input name="tptlhr" type="text" size="30" value="<?=$row[TempatLhr]?>">
	 </td>
	 
	<td>Jabatan</td>
    		 <td class="input">



			<? 
			$A2='';$B2='';$C2='';$D2='';$E2='';$F2='';
			if ($row[jabatan]=='staff') 	$A2='selected';
			if ($row[jabatan]=='kaTU') 	$B2='selected';
			if ($row[jabatan]=='sekretaris') $C2='selected';
			if ($row[jabatan]=='kabig')  	$D2='selected';
			if ($row[jabatan]=='wadir')  	$E2='selected';
			if ($row[jabatan]=='direktur')  $F='selected';
			
			?>
			 <select name="jabatan">
							  <option value='staff'      <?=$A2?> >Staff</option>
							  <option value='kaTU'       <?=$B2?> >Ka. TU</option>
							  <option value='sekretaris' <?=$C2?> >Sekretaris</option>
							  <option value='kabig'      <?=$D2?> >Kabig</option>
							  <option value='wadir'      <?=$E2?> >Wadir</option>
							  <option value='direktur'   <?=$F2?> >Direktur</option>
			</select>
	 </td>


</tr>
<tr>
	<td>Tgl Lahir</td>
      <td class="input">
		  <INPUT TYPE="text" NAME="tgllhr" id="datepicker" VALUE="<?=$row[TglLhr]?>" SIZE=25  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
	 </td>

     <td>Status Pegawai</td>
    		 <td class="input">



			<? 
			$A3='';$B3='';$C3='';$D3='';$E3='';$F3='';$G3='';$H3='';
			if ($row[statuspeg]=='0') 	   $A3='selected';
			if ($row[statuspeg]=='1') 	   $B3='selected';
			if ($row[statuspeg]=='2') 	   $C3='selected';
			if ($row[statuspeg]=='3')  	   $D3='selected';
			if ($row[statuspeg]=='4')  	   $E3='selected';
			if ($row[statuspeg]=='5')  	   $F3='selected';
			if ($row[statuspeg]=='6')  	   $G3='selected';
			if ($row[statuspeg]=='7')  	   $H3='selected';
			
			
			?>
			 <select name="statuspeg">
							  <option value="0" <?=$A3?> >Paruh Waktu</option>
							  <option value="1" <?=$B3?> >Kontrak</option>
							  <option value="2" <?=$H3?> >Tetap 80%</option>
							  <option value="2" <?=$C3?> >Tetap 100%s</option>
							  <option value="3" <?=$D3?> >PNS Diperbantukan</option>
							  <option value="4" <?=$E3?> >resign</option>
							  <option value="5" <?=$F3?> >Pindah UDD</option>
							  <option value="6" <?=$G3?> >Meninggal</option>
							  </select>
	 </td>
	

</tr>
<tr> 
	<td>Jenis Kelamin</td>
     <td class="input">
		  <?php
			   $type=$row[Jk];
			   $checked[$type]="checked";
		  ?>
		  <input type="radio" name="jk" value="0" <?=$checked["0"]?>>
			   Laki-laki
		  <input type="radio" name="jk" value="1" <?=$checked["1"]?>>
		  Perempuan
	 </td>
      
	<td>TMT</td>
		<td>
	<INPUT TYPE="text" NAME="tmt" id="datepicker1" VALUE="<?=$row[tmt]?>" SIZE=10>
		</td>
</tr>

<tr>
     <td>Status Nikah</td>
     <td class="input">
		  <?php
			   $type=$row[Status];
				$checked["0"]='';
				$checked["1"]='';
				$checked["2"]='';
				$checked["3"]='';
				$checked["4"]='';
				$checked["5"]='';
			   $checked[$type]="checked";?>
		  	<input type="radio" name="status" value="0" <?=$checked["0"]?>>
			   Bujang
		  	<input type="radio" name="status" value="1" <?=$checked["1"]?>>
			   Nikah
			<input type="radio" name="status" value="2" <?=$checked["2"]?>>
			   Duda <br>
			<input type="radio" name="status" value="3" <?=$checked["3"]?>>
			   Janda
			<input type="radio" name="status" value="4" <?=$checked["4"]?>>
			   Suami Karyawan
			<input type="radio" name="status" value="5" <?=$checked["5"]?>>
			   Istri Karyawan
	 </td>

	<td>KGB terakhir</td>
		<td>
	<INPUT TYPE="text" NAME="tglkgb" id="datepicker2" VALUE="<?=$row[kgb]?>" SIZE=10>
		</td>

</tr>


<tr>
	<td>Alamat</td>
	 <td class="input">
		  <input name="alamat" type="text" size="30" value="<?=$row[Alamat]?>">
	 </td>

	<td>KP terakhir</td>
		<td>
	<INPUT TYPE="text" NAME="tglkp" id="datepicker3" VALUE="<?=$row[kp]?>" SIZE=10>
		</td>

</tr>


<tr>
	<td>Kelurahan</td>
	 <td class="input">
		  <input name="kelurahan" type="text" size="30" value="<?=$row[kelurahan]?>">
	 </td>
	
	<td >Telepon</td>
	 <td class="input">
		  <input name="telp" type="text" size="30" value="<?=$row[telp]?>">
	 </td> 


</tr>
<? //} ?>

<tr>
	<td>Kecamatan</td>
	 <td class="input">
		  <input name="kecamatan" type="text" size="30" value="<?=$row[kecamatan]?>">
	 </td>
	
	<td>HP</td>
	 <td class="input">
		  <input name="telp2" type="text" size="30" value="<?=$row[telp2]?>">
	 </td>

</tr>
	<td>Kode Pos</td>
	 <td class="input">
		  <input name="kodepos" type="text" size="30" value="<?=$row[KodePos]?>">
	 </td>

	<td>Sisa Cuti Tahun ini</td>
	 <td class="input">
		  <input name="cuti" type="text" size="4" value="<?=$row[sisacuti]?>"> Hari
	 </td>
</tr>

<tr>
	<td>Wilayah</td>
	 <td class="input">
		  <input name="wilayah" type="text" size="30" value="<?=$row[wilayah]?>">
	 </td>
	<td>Tgl Habis Cuti</td>
					<td class="input">
						 <input type="text" name="tglcuti" id="datepicker4" required placeholder="yyyy-mm-dd" size=11 VALUE="<?=$row[tglcuti]?>">
					</td>
	
</tr>
</table><br>
<input type="hidden" value="1" name="periksa">
<input type="hidden" name="mu" value="<?=$mu?>">
<input type="hidden" value="<?=$row[Kode]?>" name="kode">
<input type="submit" value="Update" name="submit">
</form>
<?
}}
?>
