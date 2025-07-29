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
<script type="text/javascript" src="js/tgl_lahir.js"></script>
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
if (isset($_POST[submit])) {
	 $noktp 	= $_POST["noktp"];
	 $nama 		= mysql_real_escape_string($_POST["nama"]);		
	 $alamat	= mysql_real_escape_string($_POST["alamat"]);
	 $jk 		= $_POST["jk"];			$pekerjaan 	= mysql_real_escape_string($_POST["pekerjaan"]);
	 $telpa 	= $_POST["telp"]; 		$tempatlhr 	= mysql_real_escape_string($_POST["tempatlhr"]);
	 $tgllhr 	= $_POST["tgllhr"];		$status 	= $_POST["status"];
	 $goldarah 	= $_POST["goldarah"];		$rhesus 	= $_POST["rhesus"];
	 $call 		= $_POST["call"];		$kelurahan 	= mysql_real_escape_string($_POST["kelurahan"]);
	 $kecamatan = mysql_real_escape_string($_POST["kecamatan"]);
	 $kodepos 	= $_POST["kodepos"];		$wilayah 	= mysql_real_escape_string($_POST["wilayah"]);
	 $telp2a 	= $_POST["telp2"];		$umur 		= $_POST["umur"];
	 $mu		= $_POST["mu"];
	 $tglkembali	= date("Y-m-d",$donorlagi);	$ibukandung	= mysql_real_escape_string($_POST["ibukandung"]);
	 $jumdonor	= $_POST["jumdonor"];
	 $namauser 	= $_SESSION[namauser];
	 $donorlagi 	= mktime(0,0,0,date("m")+3,date("d"),date("Y"));
	 $apheresis	= $_POST['apheresis'];
	 //------------------------ set id pendonor ------------------------->
	 //digit pendonor 14 digit, 4kode utd, 3 nama, 2 tmpt aftap, 6 sequence, 
	 $q_utd	= mysql_query("select id from utd where aktif='1'",$con);			
	 $utd	= mysql_fetch_assoc($q_utd);
	 $nama1 = str_replace(".","",$nama);
	 $nama1 = str_replace(" ","",$nama1);
	 $nama1 = str_replace(",","",$nama1);
	 $nm=strtoupper(substr($nama1,0,3));
	 $idp	= mysql_query("select id,id1 from tempat_donor where active='1'",$con);
	 $idp1	= mysql_fetch_assoc($idp);
	 $kdtp	= $utd[id].$idp1[id1].$nm;
	 $idp	= mysql_query("select Kode from pendonor where Kode like '$kdtp%'
			      order by Kode DESC",$con);
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= substr($idp1[Kode],9,6);
	 if ($idp2<1) {
		  $idp2="00000";
	 }
	 $int_idp2=(int)$idp2+1;
	 $j_nol1= 6-(strlen(strval($int_idp2)));
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
	 $tambah_sql="insert into pendonor 
					(`Kode`,`NoKTP`,`Nama`,`Alamat`,`Jk`,`Pekerjaan`,
					`telp`,`TempatLhr`,`TglLhr`,`Status`,`GolDarah`,
					`Rhesus`,`Call`,`kelurahan`,`kecamatan`,`wilayah`,`KodePos`,`jumDonor`,`title`,
					`telp2`,`umur`,`tglkembali`,`ibukandung`,
					`pencatat`,`mu`,`cekal`,`up`,`waktu_update`,`apheresis`)
			   values ('$kode','$noktp','$nama','$alamat','$jk','$pekerjaan',
					'$telp','$tempatlhr','$tgllhr','$status','$goldarah',
					'$rhesus','$call','$kelurahan','$kecamatan','$wilayah','$kodepos','$jumdonor','-',
					'$telp2','$umur','$tglkembali','$ibukandung',
					'$namauser','$mu','0','1','$sekarang','$apheresis')";
	 $tambah=mysql_query($tambah_sql,$con);
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
		  echo "SESSION: $lv0 Data Telah berhasil dimasukkan<br> ";
		  print_r($_a);
		  $idp=mysql_query("select * from tempat_donor where active='1'",$con);
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") { 
			   mysql_query("update pendonor set mu='1' where Kode='$kode'",$con); 
			   $mu="1"; 
		  } else {
			   $mu="";
		  }	  
			mysql_close($con);
		  switch ($lv0){
			   case "mobile":
					?>
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=transaksi_donor&Kode=<?=$kode?>">
					<?
			   break;
			   case "kasir":
					?><META http-equiv="refresh" content="0; url=pmikasir.php?module=transaksi_donor&Kode=<?=$kode?>"><?
			   break;
			case "aftap":
					?><META http-equiv="refresh" content="0; url=pmiaftap.php?module=transaksi_donor&Kode=<?=$kode?>"><?
			   break;
                           case "bdrs":
					?><META http-equiv="refresh" content="0; url=pmibdrs.php?module=transaksi_donor&Kode=<?=$kode?>"><?

			   break;
			   case "admin":
					?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=transaksi_donor&Kode=<?=$kode?>"><?
			   break;
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 } else {
		echo "<div id=\"warning\">Maaf, data yang anda masukkan tidak dapat disimpan</div><br>$tambah_sql";
	 }
} 
switch ($lv0) {
	 case "mobile":
		  ?><form name="reg" autocomplete="off" method="post" action="pmimobile.php?module=registrasi"><?
	 break;
	 case "kasir":
		  ?><form name="reg" method="post" action="pmikasir.php?module=registrasi"><?
	 break;
	case "aftap":
		  ?><form name="reg" method="post" action="pmiaftap.php?module=registrasi"><?
	 break;
         case "bdrs":
		  ?><form name="reg" method="post" action="pmibdrs.php?module=registrasi"><?
	 break;
	 case "admin":
		  ?><form name="reg" method="post" action="pmiadmin.php?module=registrasi"><?
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

<? if ($_SESSION[leveluser]=='mobile') { ?>
<h1 class="table">FORM REGISTRASI PENDONOR ||
<input type="button" value="SEARCH PENDONOR" onClick="document.location.href='pmimobile.php?module=search_pendonor';"></h1>
<? } else if ($_SESSION[leveluser]=='aftap') { ?>
<h1 class="table">FORM REGISTRASI PENDONOR ||
<input type="button" value="SEARCH PENDONOR" onClick="document.location.href='pmiaftap.php?module=search_pendonor';"></h1>
<? } else { ?>
<h1 class="table">FORM REGISTRASI PENDONOR ||
<input type="button" value="SEARCH PENDONOR" onClick="document.location.href='pmikasir.php?module=search_pendonor';"></h1>
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
						 <input name="nama" type="text" size="30" placeholder="Nama lengkap" pattern="^[A-Za-z.,' ]{3,}$">
					</td>
			   </tr>
			   <tr>
					<td>Alamat</td>
					<td class="input">
						 <input name="alamat" type="textbox" size="30" placeholder="Jalan, RT/RW" value="<?php if($cek_tmpudd!=0){echo "$data_combo[alamat]";}?>">
					</td>
			   </tr>
			   <tr>
					<td>Kelurahan</td>
					<td class="input">
						 <input name="kelurahan" type="text" size="30" placeholder="Kelurahan/Desa" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kelurahan]";}?>">
					</td>
			   </tr>
			   <tr>
					<td>Kecamatan</td>
					<td class="input">
						 <input name="kecamatan" type="text" size="30" placeholder="Kecamatan" value="<?php if($cek_tmpudd!=0){echo "$data_combo[kecamatan]";}?>">
					</td>
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
						 <input name="tempatlhr" type="text" size="30" placeholder="Kabupaten">
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
					<td>Umur</td>
					<td class="input">
						 <input name="umur" type="text" size="2">
					</td>
			   </tr>
			   </table>
		  </td>
		  <td>
			   <table>
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
					<td>Nama Ibu Kandung</td>
					<td class="input">
						 <input name="ibukandung" type="text" size="30" placeholder="Nama lengkap">
					</td>
			   </tr>
			   <tr>
					<td>Status Nikah</td>
					<td class="input">
						 <input type="radio" name="status" value="1">
					Nikah
						 <input type="radio" name="status" value="0">
					Belum Nikah
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
					<td>Dapat dipanggil</td>
					<td class="input">
						 <select name="call">
							  <option value="1">Dapat</option>
							  <option value="0">Tidak</option></select>
					</td>
			   </tr>
			   <!--<tr>
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
			   <tr>
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
			   </tr>
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
