<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script>
	function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMUDDA - Transaksi pengeluaran biaya kendaraan</title>
</head>

<?
require_once('clogin.php');
include('config/db_connect.php');	
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$hariini = date("Y-m-d");
if((isset($_POST[submit])) and ($_POST[nopol]!=="")){
	$sql="INSERT INTO `mobil_transaksi`(
		`nopol`, 
		`tgl`, 
		`jenis_transaksi`, 
		`uraian_transaksi`, 
		`petugas`, 
		`nominal`, 
		`referensi`, 
		`rekanan`, 
		`km`, 
		`keterangan`,
		`user_entry`)
	    VALUES (
		'$_POST[nopol]',
		'$_POST[waktu1]',
		'$_POST[jenis]',
		'$_POST[uraian]',
		'$_POST[petugas]',
		'$_POST[biaya]',
		'$_POST[referensi]',
		'$_POST[rekanan]',
		'$_POST[km]',
		'$_POST[keterangan]',
		'$namauser')";
	$sqladd=mysql_query($sql);
	if ($sqladd){
		echo "<br><br>Transaksi sudah di proses</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=../pmimobile.php?module=master_kendaraan\">";    	
	} else {
		echo "<br><br>Gagal</b><br>";
		echo "<meta http-equiv=\"refresh\" content=\"5; URL=../pmimobile.php?module=master_kendaraan\">";    
	}
}else{?>
    <font size="4" color="red" face="Trebuchet MS"><b>TRANSAKSI PEMBIAYAAN KENDARAAN</b></font>
	<form name="setting" method="post" action="<? $PHP_SELF ?>">
	<table class="form" cellspacing="1" cellpadding="5" border="0">
		<tr>
			<td>Nomor Polisi</td>
			<td class="styled-select" bgcolor="#ffa688">
				<select name="nopol">
				<?$sq=mysql_query("SELECT nopol from mobil");
				while($tmp=mysql_fetch_assoc($sq)){?>
					<option value="<?=$tmp[nopol]?>"><?=$tmp[nopol]?></option>
				<?}
				?>
				</select></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td class="input"><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
		</tr>
		<tr>
			<td>Jenis Transaksi</td>
			<td class="styled-select" bgcolor="#ffa688">
				<select name="jenis">
					<option value="BBM">Bahan Bakar Minyak</option>
					<option value="Pelumas">Pelumas</option>
					<option value="S Part">Pergantian Spare Part</option>
					<option value="S Rutin">Service Rutin</option>
					<option value="S Besar">Service Besar</option>
					<option value="Aksesoris">Aksesoris Kendaraan</option>
					<option value="Body Repair">Body Repair</option>
					<option value="Pajak">Pajak Kendaraan (Samsat dll)</option>
					<option value="Lain-lain">Lain-lain</option>
				</select>
				</td>
		</tr>
		<tr>
			<td>Uraian Transaksi</td>
			<td class="input"><input name="uraian" type="text" size="50" placeholder="uraian transaksi"></td>
		</tr>
		<tr>
			<td>Petugas</td>
			<td class="input"><input name="petugas" type="text" size="25" placeholder="petugas yang melaksanakan"></td>
		</tr>
		<tr>
			<td>Besaran Biaya</td>
			<td class="input"><input name="biaya" type="number" size="30" onkeypress="return isNumberKey(event)"></td>
		</tr>
		<tr>
			<td>Rekanan</td>
			<td class="input"><input name="rekanan" type="text" size="30" placeholder="dimana?"></td>
		</tr>
		<tr>
			<td>Referensi</td>
			<td class="input"><input name="referensi" type="text" size="30" placeholder="no faktur"></td>
		</tr>
		
		<tr>
			<td>KM</td>
			<td class="input"><input name="km" type="number" size="25" onkeypress="return isNumberKey(event)"></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td class="input"><input name="keterangan" type="text" size="50" placeholder="Keterangan lain"></td>
		</tr>
	</table>
	<button type="submit" value="Simpan" name="submit" class="swn_button_blue">Simpan</button>
	<a href="pmimobile.php?module=master_kendaraan"class="swn_button_blue">Batal</a>
    </form>
    
<?}
?>
