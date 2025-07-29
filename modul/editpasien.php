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
		 	  
if (isset($_POST[submit])) {
	 $norm		= $_POST["norm"];		
	 $nama 		= mysql_real_escape_string($_POST[nama_pasien]);	
	 $jk 		= $_POST["jk"];
	 $alamat	= mysql_real_escape_string($_POST["alamat"]);
	 $telpa 	= $_POST["tlppasien"]; 		
	 $tgllhr 	= $_POST["tgllhr"];		
	 $goldarah 	= $_POST["golDrh"];
	 $rhesus 	= $_POST["rhesus"];		
	 $keluarga    	= mysql_real_escape_string($_POST["suami_istri"]);	
	 $namauser 	= $_SESSION[namauser];
	 $sekarang	= date("Y-m-d h:m:s");
	 
	
	 
	 function trimed($txt){
	  $txt = trim($txt);
	  while(strpos($txt, ' ') ){
	  $txt = str_replace(' ', '', $txt);
	  }
	  return $txt;
	  }
	  
	  $telp=trimed($telpa);
	  $telp2=trimed($telp2a);


	$tambah=mysql_query("UPDATE pasien SET 
		  nama='$nama',alamat='$alamat',gol_darah='$goldarah',
		  rhesus='$rhesus',kelamin='$jk',
		  keluarga='$keluarga',tgl_lahir='$tgllhr',tlppasien='$telpa'
		  where no_rm='$norm'");

		  //pencatat='$namauser',up=b'1',waktu_update='$sekarang'	
		
	if ($tambah) {
		//=======Audit Trial====================================================================================
		$log_mdl ='PASIEN SERVICE';
		$log_aksi='Edit pasien: '.$norm.', nama: '.$nama;
		include_once "user_log.php";
		//=====================================================================================================

		  echo "Data Telah berhasil di-Update <br> ";
		                 
		  switch ($lv0){
			   
			   case "kasir":
									   	
				?><META http-equiv="refresh" content="0; url=pmikasir.php?module=searchpasien"><?
				
				break;
			 
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}
if (isset($_GET[Kode])) {
	 $perintah=mysql_query("select * from pasien where no_rm='$_GET[Kode]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "No RM yang anda masukkan belum terdaftar";
		  ?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=searchpasien"><?
	 } else {	
?>
<form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<h2 class="table">B. Data Pasien</h2>
	<table class="form" width=65%  cellspacing="1" cellpadding="2">
		<tr> 
			<td>No RM</td>
				    <td class="input"><?=$row[no_rm]?></td>
		</tr>
		<tr> 
			<td>Nama Pasien</td>
			<td class="input">
				<input name="nama_pasien" type="text" size="20" value="<?=$row[nama]?>">
			</td>
		</tr>
		
		<tr>
			<td>Golongan Darah</td>
			   <td class="input">
			<? 
			$sA='';$sB='';$sAB='';$sO='';
			if ($row[gol_darah]=='A') $sA='selected';
			if ($row[gol_darah]=='B') $sB='selected';
			if ($row[gol_darah]=='AB') $sAB='selected';
			if ($row[gol_darah]=='O') $sO='selected';
			
			?>
			<select name="golDrh">
				<option value="A" <?=$sA?>>A</option>
				<option value="B" <?=$sB?>>B</option>
				<option value="AB" <?=$sAB?>>AB</option>
				<option value="O" <?=$sO?>>O</option>
				
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
				<option value="+" <?=$rp?>>(+)</option>
				<option value="-" <?=$rn?>>(-)</option>
			</select>
			    </td>
		<tr>
			<td>Jenis Kelamin</td>
			   <td class="input">
		  <?php
			   $type=$row[kelamin];
			   $checked[$type]="checked";
		  ?>
		  <input type="radio" name="jk" value="L" <?=$checked["L"]?>>
			   Laki-laki
		  <input type="radio" name="jk" value="P" <?=$checked["P"]?>>
		  Perempuan
		  </td>
		</tr>
		<tr> 
			<td>Nama Keluarga</td>
			<td class="input">
				<input name="suami_istri" type="text" size="20" value="<?=$row[keluarga]?>">
			</td>
		</tr>
		<tr> 
			<td>Tgl Lahir</td>
			<td class="input">
				<input TYPE="text" NAME="tgllhr" id="datepicker" SIZE="9" value="<?=$row[tgl_lahir]?>"
					onchange="document.permintaandarah.umur.value=Age(document.permintaandarah.datepicker.value);">
			</td>
		</tr>
		
		<tr> 
			<td>Alamat Pasien</td>
			<td class="input">
				<input name="alamat" type="text" size="20" value="<?=$row[alamat]?>">
			</td>
		</tr>
		<tr> 
			<td>No Telepon</td>
			<td class="input">
				<input name="tlppasien" type="text" size="13" value="<?=$row[tlppasien]?>">
			</td>
		</tr>
</table>
<input type="hidden" value="1" name="periksa">
<input type="hidden" value="<?=$row[no_rm]?>" name="norm">
<input type="submit" value="Update" name="submit">
<?
}}
?>
