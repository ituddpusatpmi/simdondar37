<!---
berat >=45 
tensi kosongi keputusan lewat centang
Harus isi berat, tensi
-->
<!-- HTML5 Shim, IE8 and bellow recognize HTML5 elements -->
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->		
<!-- Modernizr -->
<script src="js/modernizr-1.5.min.js"></script>
<!-- Webforms2 -->
<script src="webforms2/webforms2.js"></script>
<!-- cookies -->
<script src="js/cookies.js"></script>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<!-- Form layout -->
<script src="js/html5forms.fallback.js"></script>
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        document.periksa.berat_badan.focus();
      });
			function setCheckedValue(radioObj, newValue) {
				if(!radioObj)
					return;
				var radioLength = radioObj.length;
				if(radioLength == undefined) {
					radioObj.checked = (radioObj.value == newValue.toString());
					return;
				}
				for(var i = 0; i < radioLength; i++) {
					radioObj[i].checked = false;
					if(radioObj[i].value == newValue.toString()) {
						radioObj[i].checked = true;
					}
				}
			}
			function chb(hb){
				hb=parseFloat(hb)
				if(hb!=1){
					setCheckedValue(document.periksa.elements['h_medical'],'1');
					}
				else {
					if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
				}
				}
			function berat(hb){
				hb=parseFloat(hb)
				if(hb<45){
					setCheckedValue(document.periksa.elements['h_medical'],'1');
				}else{
					if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
				}
			}
			function sistol(hb){
				hb=parseFloat(hb)
				if(hb<90){
					setCheckedValue(document.periksa.elements['h_medical'],'1');
				}else{
					if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
				}
				if(hb>150){
					setCheckedValue(document.periksa.elements['h_medical'],'1');
				}else{
					if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
				}
			}
			function diastol(hb){
				hb=parseFloat(hb)
				if(hb<60){
					setCheckedValue(document.periksa.elements['h_medical'],'1');
				}else{
					if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
				}
				if(hb>100){
					setCheckedValue(document.periksa.elements['h_medical'],'1');
				}else{
					if (document.periksa.h_medical=='0') setCheckedValue(document.periksa.elements['h_medical'],'0');
				}
			}
			function cek(hb){
				hb=parseFloat(hb)
				if(hb<12.5){
					setCheckedValue(document.periksa.elements['cuso4'],'2');
				}else{
					setCheckedValue(document.periksa.elements['cuso4'],'1');
				}
			}
    </script>

<?
include ('config/db_connect.php');
include ('clogin.php');
session_start();
$lv0=$_SESSION[leveluser];
if ($_POST['periksa']=="1" ) { if ($_POST[berat_badan]!="" and $_POST[tensi_sistol]!="" and $_POST[tensi_diastol]!=""){
    //print_r($_POST);
	$kdl 		= mktime(0,0,0,date("m"),date("d")+35,date("Y"));
	$kembali0 	= mktime(0,0,0,date("m"),date("d")+75,date("Y"));
	$kembali 	= date('Y-m-d',$kembali0);
	$kadaluwarsa    = date("Y-m-d",$kdl);
	$tensi 		= $_POST['tensi_sistol']."/".$_POST['tensi_diastol'];
	$idp		= mysql_query("select * from tempat_donor where active='1'");
	$status_test    = 1;							
	$today 		= date('Y-m-d H:i:s');
	$kodependonor   = $_POST['kodependonor'];	
	$notrans	= $_POST['notrans'];
	$cuso4 		= $_POST['cuso4'];			
	$HCT 		= $_POST['HCT'];
	//if ($_POST[h_medical]=='1') $cuso4='4';
	$namauser 	= $_SESSION[namauser];
	$berat_badan	= $_POST['berat_badan'];	
	$id_dokter 	= $_POST['id_dokter'];
	$temperatur 	= $_POST['temperatur'];		
	$nadi 		= $_POST['nadi'];
	$gol_darah 	= $_POST['goldarah'];		
	$rhesus 	= $_POST['rhesus'];
	$id_tensi	= $_POST['id_tensi'];		
	$id_hb		= $_POST['id_hb'];
	$apheresis	= $_POST['apheresis1'];
	$idp1		= mysql_fetch_assoc($idp);
	$hb		= $_POST['hb'];
	$alasan		= $_POST['alasan'];
	if ($_POST[h_medical]=='1') {$pengambilan="1" and $status="-" and $jumHB="-";}else{$pengambilan='3' and $status="1" and $jumHB=$cuso4;}
	if ($_POST[h_medical]=='1') {$ketbatal=$alasan;}else{$ketbatal='-';}
	if (substr($idp1[id1],0,1)=="M") { 
		$mu="1";
	} else {
	$mu="";
	}
	$tambah_sql="UPDATE htransaksi
					SET namadokter='$id_dokter',petugasHB='$id_hb',petugasTensi='$id_tensi',beratbadan='$berat_badan',
						tensi='$tensi',suhu='$temperatur',nadi='$nadi',jumHB='$jumHB',Hb='$hb',
						hct='$HCT',status_test='1',Status='$status',Pengambilan='$pengambilan',ketBatal='$ketbatal',
						mu='$mu',gol_darah='$gol_darah',rhesus='$rhesus'
					WHERE (NoTrans='$notrans')";

	
	$tambah=mysql_query($tambah_sql);
	$tambah1=mysql_fetch_assoc(mysql_query("select Pengambilan from htransaksi where NoTrans='$notrans'"));
	
	//=======Audit Trial====================================================================================
	$log_mdl ='SELEKSI';
	$log_aksi='Check Up: '.$notrans.', Pendonor: '.$kodependonor.' Status: '.$status;
	include_once "user_log.php";
	//=====================================================================================================
	
	//disini ditambahkan sql penyimpanan data sementara
	//check apakah data temp sudah ada, jika ada, update data temp
	//yang disimpan : nama dokter, petugas tensi, petugas hb
	
	$cek_tmpudd=1;
	$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU CHECKUP'"));
	if ($cek_tmpudd==0) {
	   $tambah_tmp=mysql_query("INSERT INTO tempudd (modul,dokter,petugas2,petugas1)
				   values ('MU CHECKUP','$id_dokter','$id_hb','$id_tensi')");
	} else {
	   $tambah_tmp=mysql_query("UPDATE tempudd  SET dokter='$id_dokter',petugas1='$id_tensi', petugas2='$id_hb'
				   where modul='MU CHECKUP'");
	}
	
	//baru sampai disini
	$update_pendonor=mysql_query("UPDATE pendonor SET GolDarah='$gol_darah',Rhesus='$rhesus' WHERE Kode='$kodependonor'");
					//status_test->0=baru,1=med ok, 2=aftap `ok
					//Status->0=baru,1=med checkup, 2=aftap
	
		if ($tambah) {
			echo "Data Telah berhasil dimasukkan<br>";
				
			if ($tambah1[Pengambilan]=='3') {	
				
			switch ($lv0){
				case "aftap":
					if ($apheresis=='1'){
					?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=pengambilan_apheresis&NoTrans=<?=$notrans?>"> <?  
					}else{
					?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=pengambilan&NoTrans=<?=$notrans?>"> <?
					}
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="2; url=pmimobile.php?module=pengambilan&NoTrans=<?=$notrans?>"> <?
					break;
				case "p2d2s":
					?> <META http-equiv="refresh" content="2; url=pmip2d2s.php?module=pengambilan&NoTrans=<?=$notrans?>"> <?
					break;
				case "kasir":
					if ($apheresis=='1'){
					?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=pengambilan_apheresis&NoTrans=<?=$notrans?>"> <?  
					}else{
					?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=pengambilan&NoTrans=<?=$notrans?>"> <?
					}
					break;
	
				default:
					echo "Anda tidak memiliki hak akses";
				}
			} else {
			echo "Hasil Medical Checkup tidak memenuhi Syarat untuk Donor";
			switch ($lv0){
				case "aftap":
					?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=check"> <?
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="2; url=pmimobile.php?module=check"> <?
					break;
				case "p2d2s":
					?> <META http-equiv="refresh" content="2; url=pmip2d2s.php?module=check"> <?
					break;
				case "kasir":
					?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=check"> <?
					break;

				default:
					echo "Anda tidak memiliki hak akses";
				}
			}
		}
                
	$_POST['periksa']="";
} else  { echo "Data tidak lengkap!!!";
			switch ($lv0){
				case "aftap":
					?> <META http-equiv="refresh" content="1; url=pmiaftap.php?module=check"> <?
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="1; url=pmimobile.php?module=check"> <?
					break;
				case "p2d2s":
					?> <META http-equiv="refresh" content="1; url=pmip2d2s.php?module=check"> <?
					break;
				case "kasir":
					?> <META http-equiv="refresh" content="1; url=pmikasir.php?module=check"> <?
					break;				
				default:
					echo "Anda tidak memiliki hak akses";
				}
			}
}
if ($_POST['periksa']=="") {?>
<?php 
$cek_tmpudd=1;
	$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU CHECKUP'"));
	
	  $query_combo = "select * from tempudd where modul='MU CHECKUP'";
 		$hasil_combo = mysql_query($query_combo);
 		$data_combo = mysql_fetch_array($hasil_combo);
 		
?>
	<h1 class="table">FORM MEDICAL CHECKUP</h1>
	<form name="periksa" autocomplete="off" id="periksa" method="post" action="<?=$PHPSELF?>" >
	<table class="form" cellspacing="0" cellpadding="0">
	<tr>
	<? 
	  $notrans1=$_GET[NoTrans];
	  if ($_POST[NoTrans1]!="") $notrans1=$_POST[NoTrans1];
	    $check=mysql_query("select * from pmi.htransaksi where NoTrans='$notrans1' and Status<=1");
	  if (mysql_num_rows($check)==1) {
	    $check1=mysql_fetch_assoc($check); 
	    $apheresis=$check1['apheresis'];
	    $apheresis1=$check1['apheresis'];
	    if($apheresis1=='1'){$apheresis1='YA';}else{
	      $apheresis1='TIDAK';
	    }
	?>
	  <td bgcolor="blue">Donor Apheresis</td>
	  <td class="input" style="background:blue;"><font color="white">:<?=$apheresis1?></font></td>  
	</tr>
	<tr>
	  <td bgcolor="blue">Kode Pendonor</td>
	  <td class="input" style="background:blue;"><font color="white">:<?=$check1[KodePendonor]?></font></td>
	</tr>
	
	<? $check1[KodePendonor]=str_replace("'","\'",$check1[KodePendonor]);?>
	<?$data=mysql_query("select * from pendonor where Kode='$check1[KodePendonor]'");
	$data1=mysql_fetch_assoc($data);?>
	<tr>
	  	<td bgcolor="blue">No. Identitas</td>
	        <td class="input" style="background:blue;"><font color="white">:<?=$data1[NoKTP]?></font></td>
	</tr>
	<tr>
		<td bgcolor="blue">Nama Pendonor</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[Nama]?></font></td>
	</tr>

	<tr>
		<td bgcolor="blue">Tanggal Lahir</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[TglLhr]?></font></td>
	</tr>
	<tr>
		<td bgcolor="blue">Usia</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[umur]?></font></td>
	</tr>
	<tr>
		<td bgcolor="blue">Alamat</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[Alamat]?></font></td>
	</tr>
	<tr>
		<td bgcolor="blue">No.Hp</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[telp2]?></font></td>
	</tr>
	<tr>
		<td bgcolor="blue">Jumlah Donasi</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[jumDonor]?></font></td>
	</tr>
	<tr>
		<td bgcolor="blue">Gol Darah Awal</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[GolDarah]?></font></td>
	</tr>
	<tr>
		<td bgcolor="blue">Rhesus</td>
		<td class="input" style="background:blue;"><font color="white">:<?=$data1[Rhesus]?></font></td>
	</tr>
	<tr>
		<td>Nama Dokter/Penanggung Jawab</td>
		<td class="input">
				<select name="id_dokter">
					<?
					$dokter="select * from dokter_periksa order by nama";
					$idp=mysql_query("select * from tempat_donor where active='1'",$con);
					$idp1=mysql_fetch_assoc($idp);
					if (substr($idp1[id1],0,1)=="M") $dokter="select * from dokter_periksa where aktif='1' order by kode desc";
					
					$tmpdktr=mysql_query("select dokter from tempudd where modul='MU CHECKUP'");
					$doktertmp=$tmpdktr[dokter];
					
					$do=mysql_query($dokter);
					while($data=mysql_fetch_array($do)){
					if ($data[kode] == $data_combo[dokter]){
		  		  					echo "<option value=$data[kode] selected>$data[Nama]</option>";
		  						}else{
		  							echo "<option value=$data[kode]>$data[Nama]</option>";
		  						} ?>
					<? } ?>
				</select>
		</td>
	</tr>
	<tr>
		<td>Petugas Tensi</td>
		<td class="input">
				<select name="id_tensi"">
					<?
					$dokter="select * from user order by nama_lengkap";
					$do=mysql_query($dokter);
					while($data=mysql_fetch_array($do)){					
					if ($data[id_user] == $data_combo[petugas1]){
		  		  					echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
		  						}else{
		  							echo "<option value=$data[id_user]>$data[nama_lengkap]</option>";
		  						}
								?>
					<? } ?>
					<option value="--">-</option>
				</select>
		</td>
	</tr>
	<tr>
		<td>Petugas HB</td>
		<td class="input">
				<select name="id_hb">
					<?
					$dokter="select * from user order by nama_lengkap";
					$do=mysql_query($dokter);
					while($data=mysql_fetch_array($do)){
					
					if ($data[id_user] == $data_combo[petugas2]){
		  		  					echo "<option value=$data[id_user] selected>$data[nama_lengkap]</option>";
		  						}else{
		  							echo "<option value=$data[id_user]>$data[nama_lengkap]</option>";
		  						}?>
					<? } ?>
					<option value="--">-</option>
				</select>
		</td>
	</tr>
		

        <tr>
		<td>Berat Badan</td>
		<td class="input"><input name="berat_badan" required="" type="text" size="3" value="" onChange="berat(this.value)">kg</td>
	</tr>
        <tr>
		<td>Check</td>
		<td class="input">Tensi
			<input name="tensi_sistol" type="text"  required="" size="3" value="" onChange="sistol(this.value)">/
			<input name="tensi_diastol" type="text" required="" size="3" value="" onChange="diastol(this.value)">
			<br>Suhu &nbsp;<input name="temperatur" required="" type="text" value="" size="3">
			<br>Nadi &nbsp;<input name="nadi" required="" type="text" value="" size="3">
		<td>
	</tr>
<tr>
		<td>1. BJ1053</sub></td>
		<td class="input">
			<input type="radio" name="cuso4"  value="1" onclick="chb(this.value)">Tenggelam
			<input type="radio" name="cuso4" value="2" onclick="chb(this.value)">Melayang
			<input type="radio" name="cuso4" value="3" onclick="chb(this.value)">Mengapung
		</td>
	</tr>
<tr>
		<td>2. BJ1062</sub></td>
		<td class="input">
			<input type="radio" name="cuso41"  value="1" onclick="chb1(this.value)">Tenggelam
			<input type="radio" name="cuso41" value="2" onclick="chb1(this.value)">Melayang
			<input type="radio" name="cuso41" value="3" onclick="chb1(this.value)">Mengapung
		</td>
	</tr>
	<tr>
		<td>HB</td>
		<td class="input">
			<input type="text" name="hb" size="6" onKeyUp="cek(this.value)" >
			HCT &nbsp;&nbsp;&nbsp; <input name="HCT" type="text" size="3">%
		</td>
	</tr>
<tr>
		<td>Hasil</td>
		<td class="input">
			<input type="radio" required="" name="h_medical" value="0">Lolos
			<input type="radio" required="" name="h_medical" value="1">Tidak Lolos
		</td>
</tr>
	<tr>
		<td>Golongan Darah &nbsp;</td>
		<td class="input">
			<? 
			$sA='';$sB='';$sAB='';$sO='';
			if ($data1[GolDarah]=='A') $sA='selected';
			if ($data1[GolDarah]=='B') $sB='selected';
			if ($data1[GolDarah]=='AB') $sAB='selected';
			if ($data1[GolDarah]=='O') $sO='selected';
			//if ($data1[GolDarah]=='X') $sX='selected';
			?>

			<select name="goldarah" >
				<option value="A" <?=$sA?>>A</option>
				<option value="B" <?=$sB?>>B</option>
				<option value="AB" <?=$sAB?>>AB</option>
				<option value="O" <?=$sO?>>O</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Rhesus &nbsp; </td>
		<td class="input">
			<? 
			$rn='';$rp='';
			if ($data1[Rhesus]=="-") $rn='selected';
			if ($data1[Rhesus]=="+") $rp='selected';
				?>
			<select name="rhesus">
				<option value="+" <?=$rp?>>(+)</option>
				<option value="-" <?=$rn?>>(-)</option>
			</select>
		</td>
	</tr>


		<tr>
		<td>Alasan Tidak Lolos</td>
		<td class="input">
			<select name="alasan">
				<option value="">-</option>
				<option value="0">Tensi Rendah</option>
				<option value="1">Tensi Tinggi</option>
				<option value="2">HB Mengapung</option>
				<option value="3">HB Melayang</option>
				<option value="4">HB Tinggi</option>
				<option value="5">BB Kurang</option>
				<option value="6">Habis Minum Obat</option>
				<option value="7">Perjalanan dari Luar Negeri</option>
				<option value="8">Lain - lain</option>
			</select>
		</td>
		</tr> 
</table>

				

<input type="hidden" name="periksa" value="1">
<input type="hidden" name="apheresis1" value="<?=$apheresis?>">
<input type="hidden" name="paket" value="1">
<input type="hidden" name="notrans" value="<?=$notrans1?>">
<input type="hidden" name="kodependonor" value="<?=$check1[KodePendonor]?>">
<br>
<input type="submit" name="submit2" value="Simpan">
</form>
<?
} 
}
?>

