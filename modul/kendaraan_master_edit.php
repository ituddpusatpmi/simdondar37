<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script>
	function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
<?php
require_once('clogin.php');
include('config/db_connect.php');
if((isset($_POST[submit])) and ($_POST[nopol]!=="")){
	$sql="UPDATE `mobil` SET
	`tahun` = '$_POST[tahun]',
	`asal`  = '$_POST[asal]',
	`tipe`  = '$_POST[tipe]',
	`merk`  = '$_POST[merk]',
	`bbm`   = '$_POST[bbm]',
	`tgl_samsat` = '$_POST[samsat]',
	`sopir` = '$_POST[sopir]',
	`nama_mobil` = '$_POST[nama]',
	`no_bpkb`= '$_POST[bpkb]',
	`no_mesin`= '$_POST[mesin]',
	`no_rangka`= '$_POST[rangka]',
	`roda`= '$_POST[jenis]',
	`biaya_samsat`= '$_POST[biayasamsat]'
	WHERE `nopol` = '$_POST[nopolisi]'";
	$sqladd=mysql_query($sql);
	
	if ($sqladd){
		echo "<br><br>Edit data berhasil</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmimobile.php?module=master_kendaraan\">";    	
	} else {
		echo "<br><br>Gagal!</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmimobile.php?module=master_kendaraan\">";    
	}
}else{
	$nopol=$_GET[nopol];
	$sql="SELECT nopol, tahun, asal, tipe, merk, bbm, tgl_samsat, sopir, nama_mobil, no_bpkb, no_mesin, no_rangka, roda, biaya_samsat FROM mobil WHERE nopol='$nopol'";
	$qraw=mysql_query($sql);
	$tmp=mysql_fetch_assoc($qraw);
	?>
    <font size="4" color="red" face="Trebuchet MS"><b>TAMBAH MASTER KENDARAAN KANTOR</b></font>
	<form name="setting" method="post" action="<? $PHP_SELF ?>">
	<table class="form" cellspacing="1" cellpadding="0" border="1">
		<tr>
			<td>Nomor Polisi</td>
			<td class="input"><input name="nopol" type="text" size="15" disabled="disabled" value="<?=$tmp['nopol']?>">
			<input type="hidden" name="nopolisi" type="text" value="<?=$tmp['nopol']?>"></td>
		</tr>
		<tr>
			<td>Jenis Kendaraan</td>
			<td class="input"><?
				switch ($tmp['roda']){
					case "1" : $satu="Selected";break;
					case "4" : $empat="Selected";break;
					case "6" : $enam="Selected";break;
				}?>
				<select name="jenis">
					<option value="2" <?=$satu?>>Roda Dua</option>
					<option value="4" <?=$empat?>>Roda Empat</option>
					<option value="6" <?=$enam?>>Roda Enam</option>
				</select>
				</td>
		</tr>
		<tr>
			<td>Nama Kendaraan</td>
			<td class="input"><input name="nama" type="text" size="30" value="<?=$tmp['nama_mobil']?>"></td>
		</tr>
		<tr>
			<td>Tahun Kendaraan</td>
			<td class="input"><input name="tahun" type="text" size="4" value="<?=$tmp['tahun']?>"></td>
		</tr>
		<tr>
			<td>Asal Kendaraan</td>
			<td class="input"><input name="asal" type="text" size="30" value="<?=$tmp['asal']?>"></td>
		</tr>
		<tr>
			<td>Type</td>
			<td class="input"><input name="tipe" type="text" size="30" value="<?=$tmp['tipe']?>"></td>
		</tr>
		<tr>
			<td>Merk</td>
			<td class="input"><input name="merk" type="text" size="30" value="<?=$tmp['merk']?>"></td>
		</tr>
		<tr>
			<td>Bahan Bakar</td>
			<td class="input"><?
				switch ($tmp['bbm']){
					case "Premium" : $premium="Selected";break;
					case "Pertamax" : $pertamax="Selected";break;
					case "Solar" : $solar="Selected";break;
				}?>
				<select name="bbm">
					<option value="Premium" <?=$premium?>>Premium</option>
					<option value="Pertamax" <?=$pertamax?>>Pertamax</option>
					<option value="Solar" <?=$solar?>>Solar</option>
				</select>
				</td>
		</tr>
		<tr>
			<td>Tanggal Samsat</td>
			<td class="input"><input name="samsat" type="text" size="5" value="<?=$tmp['tgl_samsat']?>">TG/BL</td>
		</tr>
		<tr>
			<td>Biaya Pajak (Samsat)</td>
			<td class="input"><input name="biayasamsat" type="number" size="30" onkeypress="return isNumberKey(event)" value="<?=$tmp['biaya_samsat']?>"></td>
		</tr>
		<tr>
			<td>No. BPKB</td>
			<td class="input"><input name="bpkb" type="text" size="30" value="<?=$tmp['no_bpkb']?>"></td>
		</tr>
		<tr>
			<td>No. Rangka</td>
			<td class="input"><input name="rangka" type="text" size="30" value="<?=$tmp['no_rangka']?>"></td>
		</tr>
		<tr>
			<td>No. Mesin</td>
			<td class="input"><input name="mesin" type="text" size="30" value="<?=$tmp['no_mesin']?>"></td>
		</tr>
		<tr>
			<td>Sopir</td>
			<td class="input"><input name="sopir" type="text" size="30" value="<?=$tmp['sopir']?>"></td>
		</tr>
	</table>
	<button type="submit" value="Simpan" name="submit" class="swn_button_blue">Simpan</button>
	<a href="pmimobile.php?module=master_kendaraan"class="swn_button_blue">Batal</a>
    </form>
    
<?}
?>
