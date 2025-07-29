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
	 $kode 		= $_POST["kode"];		$noktp 		= $_POST["noktp"];
	 $nama 		= $_POST["nama"];		$alamat		= $_POST["alamat"];
	 $jk 		= $_POST["jk"];			$pekerjaan 	= $_POST["pekerjaan"];
	 $telp 		= $_POST["telp"]; 		$tempatlhr 	= $_POST["tempatlhr"];
	 $tgllhr 	= $_POST["tgllhr"];		$status 	= $_POST["status"];
	 $goldarah 	= $_POST["goldarah"];		$rhesus 	= $_POST["rhesus"];
	 $call 		= $_POST["call"];		$kelurahan 	= $_POST["kelurahan"];
	 $kecamatan     = $_POST["kecamatan"];		$wilayah        = $_POST["wilayah"];
	$kodepos 	= $_POST["kodepos"];
	 $jumdonor 	= $_POST["jumdonor"];		$telp2 		= $_POST["telp2"];
	 $umur 		= $_POST["umur"];		$ibukandung	=$_POST["ibukandung"];
	 $namauser 	= $_SESSION[namauser];		$sekarang	= date("Y-m-d h:m:s");
	 $tglkembali	= $_POST['tglkembali'];         $mu		=$_POST["mu"];

if ($lv0=='admin') {
	$tambah=mysql_query("UPDATE pendonor SET 
		  NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
		  Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',
		  TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
		  Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
		  kecamatan='$kecamatan',wilayah='$wilayah',KodePos='$kodepos',jumDonor='$jumdonor',
		  telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
		  pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali'
		  where Kode='$kode'");
} else {
	$tambah=mysql_query("UPDATE pendonor SET 
		  NoKTP='$noktp',Nama='$nama',Alamat='$alamat',Jk='$jk',
		  Pekerjaan='$pekerjaan',telp='$telp',TempatLhr='$tempatlhr',
		  TglLhr='$tgllhr',Status='$status',GolDarah='$goldarah',
		  Rhesus='$rhesus',`call`='$call',kelurahan='$kelurahan',
		  kecamatan='$kecamatan',wilayah='$wilayah',
		  KodePos='$kodepos',jumDonor='$jumdonor',
		  telp2='$telp2',umur='$umur',ibukandung='$ibukandung',mu='$mu',
		  pencatat='$namauser',up=b'1',waktu_update='$sekarang',tglkembali='$tglkembali'
		  where Kode='$kode'");

		  //pencatat='$namauser',up=b'1',waktu_update='$sekarang'
}	
	backgroundPost('http://localhost/simudda/modul/background_up_pendonor.php');
	
	if ($tambah) {
		  echo "Data Telah berhasil di-Update <br> ";
		  $idp=mysql_query("select * from tempat_donor where active='1'");
		  $idp1=mysql_fetch_assoc($idp);
		  if (substr($idp1[id1],0,1)=="M") mysql_query("update pendonor set mu='1' where Kode='$kode'"); 
                
		  switch ($lv0){
			   case "mobile":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
?>				
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=transaksi_donor&Kode=<?=$kode?>">
					<? 
				} else { ?>
				<META http-equiv="refresh" content="0; url=pmimobile.php?module=search_pendonor">
                                        <? }
			   break;
			   case "kasir":
				$cek=mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$kode'"));					
				if ($cek[Cekal]=="0") {
					?><META http-equiv="refresh" content="0; url=pmikasir.php?module=transaksi_donor&Kode=<?=$kode?>"><?
			   	} else {
				?><META http-equiv="refresh" content="0; url=pmikasir.php?module=search_pendonor"><?
				}
				break;
			   case "admin":
					?><META http-equiv="refresh" content="0; url=pmiadmin.php?module=search_pendonor"><?
			   break;
			   default:
					echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}
if (isset($_GET[Kode])) {
	 $perintah=mysql_query("select * from pendonor where Kode='$_GET[Kode]'");
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
<h1 class="table">EDIT DATA PENDONOR</h1>
<form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<table class="form" width=65%  cellspacing="1" cellpadding="2">
<tr>
	 <td>Kode Pendonor</td>
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
<td>Golongan Darah</td>
     <td class="input">
			<? 
			$sA='';$sB='';$sAB='';$sO='';
			if ($row[GolDarah]=='A') $sA='selected';
			if ($row[GolDarah]=='B') $sB='selected';
			if ($row[GolDarah]=='AB') $sAB='selected';
			if ($row[GolDarah]=='O') $sO='selected';
			if ($row[GolDarah]=='X') $sX='selected';
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
	 <td>Nama</td>
	 <td class="input">
		  <input name="nama" type="text" size="30" value="<?=$row[Nama]?>">
	 </td>
     <td>Rhesus</td>
     <td class="input">
			<? 
			$rn='';$rp='';
			if ($row[Rhesus]=='-') $rn='selected';
			if ($row[Rhesus]=='+') $rp='selected';
				?>
			<select name="rhesus">
				<option value="+" <?=$rp?>>(+)</option>
				<option value="-" <?=$rn?>>(-)</option>
			</select>
	 </td>

</tr>
<tr>
<td>Tempat Lahir</td>
	 <td class="input">
		  <input name="tempatlhr" type="text" size="30" value="<?=$row[TempatLhr]?>">
	 </td>
	 
<td >Telepon</td>
	 <td class="input">
		  <input name="telp" type="text" size="30" value="<?=$row[telp]?>">
	 </td>
</tr>
<tr>
<td>Tgl Lahir</td>
      <td class="input">
		  <INPUT TYPE="text" NAME="tgllhr" id="datepicker" VALUE="<?=$row[TglLhr]?>" SIZE=25  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
	 </td>

     
<td>HP</td>
	 <td class="input">
		  <input name="telp2" type="text" size="30" value="<?=$row[telp2]?>">
	 </td>

</tr>
<tr> 
<td>Umur</td>
	 <td class="input">
		  <input name="umur" type="text" size="2">
	 </td>					

 <td>Dapat dipanggil</td>
     <td class="input">
        <?php
		  $type=$row[Call];
		  $selected[$type]="selected";?>
	 <select name="call">
		  <option value="1" <?=$selected["1"]?>>Dapat</option>
		  <option value="0" <?=$selected["0"]?>>Tidak</option>
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
      
<td>Alamat</td>
	 <td class="input">
		  <input name="alamat" type="text" size="30" value="<?=$row[Alamat]?>">
	 </td>

    </tr>

<tr>
     <td>Status Nikah</td>
     <td class="input">
		  <?php
			   $type=$row[Status];
				$checked["0"]='';
				$checked["1"]='';
			   $checked[$type]="checked";?>
		  <input type="radio" name="status" value="0" <?=$checked["0"]?>>
			   Belum Nikah
		  <input type="radio" name="status" value="1" <?=$checked["1"]?>>
			   Nikah
	 </td>
<td>Kelurahan</td>
	 <td class="input">
		  <input name="kelurahan" type="text" size="30" value="<?=$row[kelurahan]?>">
	 </td>
</tr>



<? //if ($lv0=='admin' or $lv0=='mobile') { ?>
<tr>
	 <td>Jumlah Donor (*)</td>
	 <td class="input">
		  <input name="jumdonor" type="text" size="30" value="<?=$row[jumDonor]?>">
	 </td>
<td>Kecamatan</td>
	 <td class="input">
		  <input name="kecamatan" type="text" size="30" value="<?=$row[kecamatan]?>">
	 </td>
</tr>
<tr>
	 <td>Tanggal Kembali (*)</td>
	 <td class="input">
		  <input name="tglkembali" type="text" size="30" value="<?=$row[tglkembali]?>">
	 </td>
<td>Wilayah</td>
	 <td class="input">
		  <input name="wilayah" type="text" size="30" value="<?=$row[wilayah]?>">
	 </td>

</tr>
<? //} ?>

<tr>
<td>Pekerjaan</td>
					<td class="input">
						 <select name="pekerjaan" >
								   <?php
								   $q="select * from pekerjaan";
								   $do=mysql_query($q,$con);
										$select="";
								   while($data=mysql_fetch_assoc($do)){
									if ($data[Nama]==$row[Pekerjaan]) $select='selected';
								   ?>
							  <option value="<?=$data[Nama]?>"<?=$select?>>
								   <?=$data[Nama]?>
							  </option>
								   <?
										$select="";
									}?>
						 </select>
					</td>	
<td>Kode Pos</td>
	 <td class="input">
		  <input name="kodepos" type="text" size="30" value="<?=$row[KodePos]?>">
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
