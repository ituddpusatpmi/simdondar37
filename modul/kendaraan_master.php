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
<html xmlns="http://www.w3.org/1999/xhtml">
<?
require_once('clogin.php');
include('config/db_connect.php');

if((isset($_POST[submit])) and ($_POST[nopol]!=="")){
	$sql="INSERT INTO
	`mobil`(`nopol`,
	`tahun`,
	`asal`,
	`tipe`,
	`merk`,
	`bbm`,
	`tgl_samsat`,
	`sopir`,
	`nama_mobil`,
	`no_bpkb`,
	`no_mesin`,
	`no_rangka`,
	`roda`,
	`biaya_samsat`)
	    VALUES (
		'$_POST[nopol]',
		'$_POST[tahun]',
		'$_POST[asal]',
		'$_POST[tipe]',
		'$_POST[merk]',
		'$_POST[bbm]',
		'$_POST[samsat]',
		'$_POST[sopir]',
		'$_POST[nama]',
		'$_POST[bpkb]',
		'$_POST[mesin]',
		'$_POST[rangka]',
		'$_POST[jenis]',
		'$_POST[biayasamsat]')";
	$sqladd=mysql_query($sql);
	
	if ($sqladd){
		echo "<br><br>Penambahan data berhasil</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmimobile.php?module=master_kendaraan\">";    	
	} else {
		echo "<br><br>Update Sukses!</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmimobile.php?module=master_kendaraan\">";    
	}
}else{?>
    <font size="4" color="red" face="Trebuchet MS"><b>TAMBAH MASTER KENDARAAN KANTOR</b></font>
	<form name="setting" method="post" action="<? $PHP_SELF ?>">
	<table class="form" cellspacing="1" cellpadding="0" border="1">
		<tr>
			<td>Nomor Polisi</td>
			<td class="input"><input name="nopol" type="text" size="10" placeholder="nomor polisi">Harus diisi</td>
		</tr>
		<tr>
			<td>Jenis Kendaraan</td>
			<td class="input">
				<select name="jenis">
					<option value="2">Roda Dua</option>
					<option value="4">Roda Empat</option>
					<option value="6">Roda Enam</option>
				</select>
				</td>
		</tr>
		<tr>
			<td>Nama Kendaraan</td>
			<td class="input"><input name="nama" type="text" size="30" placeholder="nama mobil"></td>
		</tr>
		<tr>
			<td>Tahun Kendaraan</td>
			<td class="input"><input name="tahun" type="text" size="4" placeholder="tahun"></td>
		</tr>
		<tr>
			<td>Asal Kendaraan</td>
			<td class="input"><input name="asal" type="text" size="30" placeholder="password"></td>
		</tr>
		<tr>
			<td>Type</td>
			<td class="input"><input name="tipe" type="text" size="30" placeholder="tipe"></td>
		</tr>
		<tr>
			<td>Merk</td>
			<td class="input"><input name="merk" type="text" size="30" placeholder="merk"></td>
		</tr>
		<tr>
			<td>Bahan Bakar</td>
			<td class="input">
				<select name="bbm">
					<option value="Premium">Premium</option>
					<option value="Pertamax">Pertamax</option>
					<option value="Solar">Solar</option>
				</select>
				</td>
		</tr>
		<tr>
			<td>Tanggal Samsat</td>
			<td class="input"><input name="samsat" type="text" size="5" placeholder="dd/mm">TG/BL</td>
		</tr>
		<tr>
			<td>Biaya Pajak (Samsat)</td>
			<td class="input"><input name="biayasamsat" type="number" size="30" onkeypress="return isNumberKey(event)"></td>
		</tr>
		<tr>
			<td>No. BPKB</td>
			<td class="input"><input name="bpkb" type="text" size="30" placeholder="Nomor BPKB"></td>
		</tr>
		<tr>
			<td>No. Rangka</td>
			<td class="input"><input name="rangka" type="text" size="30" placeholder="Nomor Rangka"></td>
		</tr>
		<tr>
			<td>No. Mesin</td>
			<td class="input"><input name="mesin" type="text" size="30" placeholder="Nomor Mesin"></td>
		</tr>
		<tr>
			<td>Sopir</td>
			<td class="input"><input name="sopir" type="text" size="30" placeholder="pengemudi"></td>
		</tr>
	</table>
	<button type="submit" value="Simpan" name="submit" class="swn_button_blue">Simpan</button>
	<a href="pmimobile.php?module=master_kendaraan"class="swn_button_blue">Batal</a>
    </form>
    
<?}
?>
