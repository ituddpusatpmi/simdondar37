<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />    
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>

<?php 
include('clogin.php');
include('config/db_connect.php');
		  $lv0=$_SESSION[leveluser];
require_once('modul/background_process.php');
		  $idp=mysql_query("select * from tempat_donor where active='1'",$con);
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") { 
			   mysql_query("update pendonor set mu='1' where Kode='$kode'",$con); 
			   $mu="1"; 
		  } else {
			   $mu="";
		  }	  
if (isset($_POST[submit])) {
  	 $kode 		= $_POST["kode"];
	 $nama 		= mysql_real_escape_string($_POST["nama"]);		
	 $alamat	= mysql_real_escape_string($_POST["alamat"]);
	 $kota		= mysql_real_escape_string($_POST["kota"]);
 	 $kelamin	= $_POST["kelamin"];
	 $lahir 	= $_POST["lahir"];
	 $golda 	= $_POST["golda"]; 
  	 $rhesus 	= $_POST["rhesus"];
	 $jumlah_plebotomi=$_POST["jumlah_plebotomi"];	

if ($lv0=='admin') {
	$tambah=mysql_query("UPDATE pasien_plebotomi SET 
		  nama='$nama',alamat='$alamat',kota='$kota',
		  kelamin='$kelamin',lahir='$lahir',golda='$golda',
		  rhesus='$rhesus',jumlah_plebotomi='$jumlah_plebotomi'
		  where kode='$kode'");
} else {
	$tambah=mysql_query("UPDATE pasien_plebotomi SET 
		  nama='$nama',alamat='$alamat',kota='$kota',
		  kelamin='$kelamin',lahir='$lahir',golda='$golda',
		  rhesus='$rhesus',jumlah_plebotomi='$jumlah_plebotomi'
		  where kode='$kode'");

}	
	
	if ($tambah) {
		  echo "Data pasien $nama Telah berhasil di-Update <br> ";
		  $idp=mysql_query("select * from tempat_donor where active='1'");
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") mysql_query("update pendonor set mu='1' where Kode='$kode'"); 
                
		  switch ($lv0){
			   case "mobile":
				$cek=mysql_fetch_assoc(mysql_query("select * from pasien_plebotomi where kode='$kode'"));					
				?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=search_pasien_plebotomi"><?
			   break;
			   case "kasir2":
				$cek=mysql_fetch_assoc(mysql_query("select * from pasien_plebotomi where Kode='$kode'"));					
				?><META http-equiv="refresh" content="0; url=pmikasir2.php?module=transaksi_plebotomi&kode=<?=$kode?>"><?
				break;
			   case "admin":
				?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=search_pasien_plebotomi"><?
			   break;
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}
if (isset($_GET[kode])) {
	 $perintah=mysql_query("select * from pasien_plebotomi where kode='$_GET[kode]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Data yang anda inginkan tidak ada dalam database";
		  ?> <META http-equiv="refresh" content="2; url=pmiadmin.php?module=eregistrasi_pasien_plebotomi"><?
	 } else {	
?>
<h1 class="table">EDIT DATA PASIEN PLEBOTOMI</h1>
<form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<table class="form" width=380  cellspacing="1" cellpadding="2">
<tr>
	 <td>Kode Pasien</td>
	 <td class="input"><?=$row[kode]?></td>
</tr>
<tr>
	 <td>Nama Pasien</td>
	 <td class="input">
	 <input name="nama" type="text" size="30" value="<?=$row[nama]?>">
	 </td>
</tr>
<tr>
	 <td>Alamat</td>
	 <td class="input">
	 <input name="alamat" type="text" size="30" value="<?=$row[alamat]?>">
	 </td>
</tr>
<tr>
	 <td>Kota</td>
	 <td class="input">
	 <input name="kota" type="text" size="30" value="<?=$row[kota]?>">
	 </td>

</tr>
<tr>
	<td>Jenis Kelamin</td>
	<td class="input" >
	<?php
		$type=$row[kelamin];
		$checked[$type]="checked";
  	?>
  	<input type="radio" name="kelamin" value="LK" <?=$checked["LK"]?>>Laki-laki
  	<input type="radio" name="kelamin" value="PR" <?=$checked["PR"]?>>Perempuan</td>

</tr>
<tr> 
	<td>Tgl Lahir</td>
	<td class="input">
	<input type="date" name="lahir" id="datepicker" VALUE="<?=$row[lahir]?>" size=15 required
		  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);"></td>
</tr> 
<tr>
	<td>Golongan Darah</td>
     	<td class="input">
		<? 
		$sA='';$sB='';$sAB='';$sO='';
		if ($row[golda]=='A') $sA='selected';
		if ($row[golda]=='B') $sB='selected';
		if ($row[golda]=='AB') $sAB='selected';
		if ($row[golda]=='O') $sO='selected';
		if ($row[golda]=='X') $sX='selected';
		?>
		<select name="golda">
			<option value="A" <?=$sA?>>A</option>
			<option value="B" <?=$sB?>>B</option>
			<option value="AB" <?=$sAB?>>AB</option>
			<option value="O" <?=$sO?>>O</option>
			<option value="X" <?=$sX?>>X</option>
		</select>
	</td>
</tr>
<tr>
<td>Rhesus</td>
     	<td class="input">
	<? 
	$rn='';$rp='';
	if ($row[rhesus]=='-') $rn='selected';
	if ($row[rhesus]=='+') $rp='selected';
	?>
	<select name="rhesus">
		<option value="+" <?=$rp?>>Positif (+)</option>
		<option value="-" <?=$rn?>>Negatif (-)</option>
	</select>
	</td>
</tr>
<tr>
	<td>Jumlah Plebotomi</td>
	<td class="input">
	<input name="jumlah_plebotomi" type="text" size="5" value="<?=$row[jumlah_plebotomi]?>">
	</td>
</tr>
</table><br>
<input type="hidden" value="1" name="periksa">
<input type="hidden" name="mu" value="<?=$mu?>">
<input type="hidden" value="<?=$row[kode]?>" name="kode">
<input type="submit" value="Simpan perubahan" name="submit">
</form>
<?
}}
?>
