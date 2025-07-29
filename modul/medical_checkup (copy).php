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
	if ($_POST[h_medical]=='1') $cuso4='4';
	$berat_badan	= $_POST['berat_badan'];	
	$id_dokter 	= $_POST['id_dokter'];
	$temperatur 	= $_POST['temperatur'];		
	$nadi 		= $_POST['nadi'];
	$gol_darah 	= $_POST['goldarah'];		
	$rhesus 	= $_POST['rhesus'];
	$id_tensi	= $_POST['id_tensi'];		
	$id_hb		= $_POST['id_hb'];
	$idp1		= mysql_fetch_assoc($idp);
	
	if (substr($idp1[id1],0,1)=="M") { 
		$mu="1";
	} else {
	$mu="";
	}
	$tambah_sql="UPDATE htransaksi
					SET namadokter='$id_dokter',petugasHB='$id_hb',petugasTensi='$id_tensi',beratbadan='$berat_badan',
						tensi='$tensi',suhu='$temperatur',nadi='$nadi',jumHB='$cuso4',
						hct='$HCT',status_test='1',Status='1',mu='$mu'
					WHERE (NoTrans='$notrans')";
	
	echo $tambah_sql;
	$tambah=mysql_query($tambah_sql);
	
	//disini ditambahkan sql penyimpanan data sementara
	//check apakah data temp sudah ada, jika ada, update data temp
	//yang disimpan : nama dokter, petugas tensi, petugas hb
	$cek_tmpudd=1;
	$cek_tmpudd=mysql_num_rows(mysql_query("Select * from tempudd where modul='MU CHECKUP'"));
	if ($cek_tmpudd==0) {
	   $tambah_tmp=mysql_query("INSERT INTO tempudd (modul,dokter,petugas1,petugas2)
				   values ('MU CHECKUP','$id_dokter','$id_hb','$id_tensi')");
	} else {
	   $tambah_tmp=mysql_query("UPDATE tempudd  SET dokter='$id_dokter',petugas1='$id_hb', petugas2='$id_tensi'
				   where modul='MU CHECKUP'");
	}
	
	//baru sampai disini
	$update_pendonor=mysql_query("UPDATE pendonor SET GolDarah='$gol_darah',Rhesus='$rhesus' WHERE Kode='$kodependonor'");
					//status_test->0=baru,1=med ok, 2=aftap `ok
					//Status->0=baru,1=med checkup, 2=aftap
	
		if ($tambah) {
			echo "Data Telah berhasil dimasukkan<br>";
			if ($cuso4=='1') {	
			switch ($lv0){
				case "aftap":
					?> <META http-equiv="refresh" content="2; url=pmiaftap.php?module=pengambilan&NoTrans=<?=$notrans?>"> <?
					break;
				case "mobile":
					?> <META http-equiv="refresh" content="2; url=pmimobile.php?module=pengambilan&NoTrans=<?=$notrans?>"> <?
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
				default:
					echo "Anda tidak memiliki hak akses";
				}
			}
}
if ($_POST['periksa']=="") {?>
	<h1 class="table">FORM MEDICAL CHECKUP</h1>
	<form name="periksa" autocomplete="off" id="periksa" method="post" action="<?=$PHPSELF?>" >
	<table class="form" cellspacing="0" cellpadding="0">
	<tr>
	<? 
	$notrans1=$_GET[NoTrans];
	if ($_POST[NoTrans1]!="") $notrans1=$_POST[NoTrans1];
	$check=mysql_query("select * from pmi.htransaksi where NoTrans='$notrans1' and Status<=1");
	if (mysql_num_rows($check)==1) {
    $check1=mysql_fetch_array($check); ?>
		<td>Kode Pendonor</td>
		<td class="input"><?=$check1[KodePendonor]?></td>
	</tr>
	<? $check1[KodePendonor]=str_replace("'","\'",$check1[KodePendonor]);?>
	<?$data=mysql_query("select * from pendonor where Kode='$check1[KodePendonor]'");
	$data1=mysql_fetch_assoc($data);?>
	<tr>
		<td>Nama Pendonor</td>
		<td class="input"><?=$data1[Nama]?></td>
	</tr>
        <tr>
		<td>Berat</td>
		<td class="input"><input name="berat_badan" type="text" size="3" value="50" onChange="berat(this.value)">kg</td>
	</tr>
        <tr>
		<td>Check</td>
		<td class="input">Tensi
			<input name="tensi_sistol" type="text"  size="3" value="70" onChange="sistol(this.value)">/
			<input name="tensi_diastol" type="text" size="3" value="120" onChange="diastol(this.value)">
			<br>Suhu &nbsp;<input name="temperatur" type="text" value="35" size="3">
			<br>Nadi &nbsp;<input name="nadi" type="text" value="80" size="3">
		<td>
	</tr>
	<tr>
		<td>CuSO<sub>4</sub></td>
		<td class="input">
			<input type="radio" name="cuso4" checked value="1" onclick="chb(this.value)">Tenggelam
			<input type="radio" name="cuso4" value="2" onclick="chb(this.value)">Melayang
			<input type="radio" name="cuso4" value="3" onclick="chb(this.value)">Mengapung
		</td>
	</tr>
	<tr>
		<td>HB</td>
		<td class="input">
			<input type="text" name="hb" size="6" onKeyUp="cek(this.value)">
			HCT &nbsp;&nbsp;&nbsp; <input name="HCT" type="text" size="3">%
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
			if ($data1[GolDarah]=='X') $sX='selected';
			?>
			<select name="goldarah">
				<option value="A" <?=$sA?>>A</option>
				<option value="B" <?=$sB?>>B</option>
				<option value="AB" <?=$sAB?>>AB</option>
				<option value="O" <?=$sO?>>O</option>
				<option value="X" <?=$sX?>>X</option>
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
		<td>Nama Dokter</td>
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
						$select="";
						if($data[kode]==$check1[NamaDokter]){
							$select="SELECTED";
							}
					?>
					<option value="<?=$data[kode]?>"<?=$select?>>
					<?=$data[Nama]?>
					</option>
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
					?>
					<option value="<?=$data[id_user]?>"<?=$select?>>
					<?=$data[nama_lengkap]?>
					</option>
					<? } ?>
					<option value="--" selected>-</option>
				</select>
		</td>
	</tr>
	<tr>
		<td>Petugas HB</td>
		<td class="input">
				<select name="id_hb"">
					<?
					$dokter="select * from user order by nama_lengkap";
					$do=mysql_query($dokter);
					while($data=mysql_fetch_array($do)){
					?>
					<option value="<?=$data[id_user]?>"<?=$select?>>
					<?=$data[nama_lengkap]?>
					</option>
					<? } ?>
					<option value="--" selected>-</option>
				</select>
		</td>
	</tr>
	<tr>
		<td>Hasil</td>
		<td class="input">
			<input type="radio" name="h_medical" checked value="0">Lolos
			<input type="radio" name="h_medical" value="1">Tidak Lolos
		</td></tr>
</table>
<input type="hidden" name="periksa" value="1">
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
