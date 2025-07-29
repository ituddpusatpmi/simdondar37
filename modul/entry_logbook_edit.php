<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
?>

<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disable_enter.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>

</script>
<?
//include('../clogin.php');
include('../config/db_connect.php');
$namauser=$_SESSION[namauser];
if (isset($_POST[submit])) {
	$kode=strtoupper($_GET[Kode]);
	$nama_barang=strtoupper($_POST[nama_barang]);
	$tipe=$_POST[tipe];
	$jenis=$_POST[jenis];
	$sn=$_POST[sn];
	$no_inventarisasi=$_POST[no_inventarisasi];
	$tempat=$_POST[tempat];
	$bagian=$_POST[bagian];
	$tahun=$_POST[tahun];
	$tgl_kalibrasi=$_POST[tgl_kalibrasi];
	$suplier=$_POST[suplier];
	$jenis_pengadaan=$_POST[jenis_pengadaan];
	$asal=$_POST[asal];
	$harga=$_POST[harga];
	$status=$_POST[status];
	$fungsi=$_POST[fungsi];

	$tambah=mysql_query("UPDATE logbook_h SET nama_barang='$nama_barang',tipe='$tipe',status='$status', fungsi='$fungsi',jenis='$jenis', 
		sn='$sn', no_inventarisasi='$no_inventarisasi', tempat='$tempat', bagian='$bagian', tahun='$tahun',
		tgl_kalibrasi='$tgl_kalibrasi', suplier='$suplier',jenis_pengadaan='$jenis_pengadaan',asal='$asal',harga='$harga' Where 
		kode='$kode'"); 	


	 //=======Audit Trial====================================================================================
	$log_mdl ='LOGBOOK';
	$log_aksi='Edit Logbook Kode: '.$kode.' Nama barang: '.$nama_barang.' Bagian: '.$bagian.' status: '.$status;
	include_once "user_log.php";
	//=====================================================================================================

			if ($tambah) {
		        echo "Data Barang Telah berhasil diupdate <script>parent.$.fn.colorbox.close();</script>";
			?><META http-equiv="refresh" content="1; url=pmilogistik.php?module=list_logbook"><?
			} else {
			echo "Data Barang gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
			?><META http-equiv="refresh" content="1; url=pmilogistik.php?module=list_logbook"><?
		}
	}	

if (isset($_GET[Kode])) {
	 
	 $perintah=mysql_query("select * from logbook_h where kode='$_GET[Kode]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Data yang anda inginkan tidak ada dalam database";
		  ?> <META http-equiv="refresh" content="2; url=pmilogistik.php?module=entry_logbook_edit"><?
	 } else {	

?>
	<form name="barang" method="POST" action="<?=$PHPSELF?>">
	<h1>Entry Master Log Book</h1>
	<table class="form" border="2">
	<tr> 	<td>Kode Barang</td>
		<td class="input"><input name="Kode" type="text" size="15" value="<?=$row[kode]?>"></td>
		</tr>
	
	<tr> 	<td>Nama Barang</td>
		<td class="input"><input name="nama_barang" type="text" size="30" value="<?=$row[nama_barang]?>"></td>
		</tr>
	<tr>
		<td>Tipe</td>
		<td class="input"><input name="tipe" type="text" size="15" value="<?=$row[tipe]?>" ></td>
		</tr>
	<tr>
		<td>Jenis</td>
		<td class="input">
		<? 
		$sA='';$sB='';
		if ($row[jenis]=='0')  $sA='selected';
		if ($row[jenis]=='1') $sB='selected';
		?>		
		<select name="jenis">
		
		        <option value="0" <?=$sA?>>Manual</option>
		        <option value="1" <?=$sB?>>otomatis</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Fungsi</td>
		<td class="input">
		<? 
		$sA='';$sB='';$sC='';$sD='';$sE='';$sF='';$sG='';$sH='';
		if ($row[fungsi]=='AC')  $sA='selected';
		if ($row[fungsi]=='Aftap') $sB='selected';
		if ($row[fungsi]=='HB')  $sC='selected';
		if ($row[fungsi]=='Penyimpanan') $sD='selected';
		if ($row[fungsi]=='Tensi')  $sE='selected';
		if ($row[fungsi]=='Timbangan Badan') $sF='selected';
		if ($row[fungsi]=='Timbangan Darah')  $sG='selected';
		if ($row[fungsi]=='Komputerisasi') $sH='selected';
		?>		
				<select name="fungsi" >
				<option value="AC" <?=$sA?>>AC</option>
		        	<option value="Aftap" <?=$sB?>>Aftap</option>
				<option value="HB" <?=$sC?>>HB</option>
		        	<option value="Penyimpanan" <?=$sD?>>Penyimpanan</option>
				<option value="Tensi" <?=$sE?>>Tensi</option>
		        	<option value="Timbangan Badan" <?=$sF?>>Timbangan Badan</option>
				<option value="Timbangan Darah" <?=$sG?>>Timbangan Darah</option>
		        	<option value="Komputerisasi" <?=$sH?>>Komputerisasi</option>
			</select>
		</td>
	</tr>

	<tr>
		<td>No. Seri</td>
		<td class="input"><input name="sn" type="text" size="20"  value="<?=$row[sn]?>"></td>
	</tr>

        <tr>
		<td>No. Inventarisasi</td>
		<td class="input"><input name="no_inventarisasi" type="text" size="20" value="<?=$row[no_inventarisasi]?>"></td>
	</tr>

        <tr>
		<td>Tempat</td>
		<td class="input"><input name="tempat" type="text" size="15" value="<?=$row[tempat]?>"></td>
		</tr>
        <tr>
		<td>Bagian</td>
		<td class="input">
			<? 
		$sA='';$sB='';$sC='';$sD='';$sE='';$sF='';$sG='';$sH='';
		$sI='';$sJ='';$sK='';$sL='';$sM='';$sN='';$sO='';$sP='';
		$sQ='';$sR='';$sS='';
		if ($row[bagian]=='PPDDS')  $sA='selected';
		if ($row[bagian]=='Logistik') $sB='selected';
		if ($row[bagian]=='Seleksi Donor')  $sC='selected';
		if ($row[bagian]=='Aftap') $sD='selected';
		if ($row[bagian]=='Mobile')  $sE='selected';
		if ($row[bagian]=='KGD') $sF='selected';
		if ($row[bagian]=='IMLTD')  $sG='selected';
		if ($row[bagian]=='Komponen') $sH='selected';
		if ($row[bagian]=='Karantina')  $sI='selected';
		if ($row[bagian]=='Pasien Service') $sJ='selected';
		if ($row[bagian]=='Crossmatch')  $sK='selected';
		if ($row[bagian]=='Pimpinan') $sL='selected';
		if ($row[bagian]=='Konseling')  $sM='selected';
		if ($row[bagian]=='Administrator') $sN='selected';
		if ($row[bagian]=='QA')  $sO='selected';
		if ($row[bagian]=='QC') $sP='selected';
		if ($row[bagian]=='Keuangan')  $sQ='selected';
		if ($row[bagian]=='Umum') $sR='selected';
		if ($row[bagian]=='SDM')  $sS='selected';
		?>
		        <select name="bagian">
		        <option value="PPDDS" <?=$sA?>>PPDDS</option>
		        <option value="Logistik" <?=$sB?>>Logistik</option>
		        <option value="Seleksi Donor"<?=$sC?>>Seleksi Donor</option>
		        <option value="Aftap" <?=$sD?>>Aftap</option>
		        <option value="Mobile" <?=$sE?>>Mobile Unit</option>
		        <option value="KGD" <?=$sF?>>Konfirmasi Golongan Darah</option>
		        <option value="IMLTD" <?=$G?>>IMLTD</option>
		        <option value="Komponen" <?=$sH?>>Komponen</option>
			<option value="Karantina" <?=$sI?>>Karantina</option>
		        <option value="Pasien Service" <?=$sJ?>>Pasien service</option>
		        <option value="Crossmatch" <?=$sK?>>Crossmatch</option>
		        <option value="Pimpinan" <?=$sL?>>Pimpinan</option>
		        <option value="Konseling" <?=$sM?>>Konseling</option>
		        <option value="Administrator" <?=$sN?>>Administrator</option>
		        <option value="QA" <?=$sO?>>QA</option>
		        <option value="QC" <?=$sP?>>QC</option>
		        <option value="Keuangan" <?=$sQ?>>Keuangan</option>
		        <option value="Umum" <?=$sR?>>Umum</option>
		        <option value="SDM" <?=$sS?>>SDM</option>

		        </select>
		</tr>
	<tr>
		<td>Tahun</td>
		<td class="input"><input name="tahun" type="text" size="5" value="<?=$row[tahun]?>"></td>
		</tr>
	<tr>
		<td>Tgl Kalibrasi</td>
		<td class="input"> <input type="text" name="tgl_kalibrasi" id="datepicker" placeholder="yyyy-mm-dd" size=11 value="<?=$row[tgl_kalibrasi]?>" ></td>
		</tr>
	<tr>
		<td>Suplier</td>
		<td class="input"><input name="suplier" type="text" size="20" value="<?=$row[suplier]?>"></td>
		</tr>
	<tr>
		<td>Jenis Pengadaan</td>
		<td class="input">
		<? 
		$sA='';$sB='';
		if ($row[jenis_pengadaan]=='0')  $sA='selected';
		if ($row[jenis_pengadaan]=='1') $sB='selected';
		?>		
		<select name="jenis_pengadaan">
		        <option value="0" <?=$sA?>>Pembelian Alat Baru</option>
		        <option value="1" <?=$sB?>>Bantuan</option>
			
		        </select>
		</tr>
	<tr>
		<td>Asal</td>
		<td class="input"><input name="asal" type="text" size="15" value="<?=$row[asal]?>"></td>
		</tr>
	<tr>
		<td>Nilai (Harga)</td>
		<td class="input"><input name="harga" type="text" size="10"value="<?=$row[harga]?>"></td>
		</tr>
	<tr>
		<td>Status (Keadaan)</td>
		<td class="input">
		<? 
		$sA='';$sB='';$sC='';$sD='';
		if ($row[status]=='1')  $sA='selected';
		if ($row[status]=='0') $sB='selected';
		if ($row[status]=='2')  $sC='selected';
		if ($row[status]=='3') $sD='selected';
		?>		
			<select name="status">
		        <option value="1" <?=$sA?>>Baik</option>
		        <option value="0" <?=$sB?>>Rusak</option>
		        <option value="2" <?=$sC?>>Dalam Proses Kalibrasi</option>
		        <option value="3" <?=$sD?>>Dalam Proses Perawatan</option>			
		        </select></td>
		</tr>
</table>
	<input name="submit" type="submit" value="UPDATE">
</form>
<?
}}
?>
