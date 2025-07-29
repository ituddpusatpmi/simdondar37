<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disable_enter.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>

<script language="javascript">
function selectReagen(nama_reagen,positif,negatif,greyzone){
	  $('input[@name=nama_reag]').val(nama_reagen);
		document.getElementById('nama_reagen').innerHTML = nama_reagen; 
	    tb_remove(); 
}
</script>


<?php 
include('clogin.php');
include('config/db_connect.php');
$lv0=$_SESSION[leveluser];


if (isset($_POST[submit])) {
  	 $kode 		= strtoupper($_GET[Kode]);
	 $reagenujs	= $_POST[reagenujs];
	 $nama_reagen	= explode(";",$_POST[nama_reag]);
	 $nama_reagenujs= $nama_reagen[0];
	 $metode	= $nama_reagen[1];
	 $namabarang	= strtoupper($_POST["namabrg"]);
	 $merk		= strtoupper($_POST["merk"]);
	 $satuan	= strtoupper($_POST["satuan"]);
 	 $status	= $_POST["status"];
	 $hbeli		= $_POST["harga"];
	 $hjual 	= $_POST["hjual"];
	 $ketsatuan 	= $_POST["ketsatuan"]; 
  	 $reorder 	= $_POST["reorder"];
	 $min		= $_POST["min"];
         $kategori	= $_POST["kategori"];

 	 $tambah=mysql_query("UPDATE hstok SET reagenujs='$reagenujs' ,nama_reagen='$nama_reagenujs', metode='$metode',
			     namabrg='$namabarang', harga='$hbeli', status='$status',  satuan='$satuan', 
			     min='$min',   ketsatuan='$ketsatuan',   merk='$merk',   hjual='$hjual',  reorder='$reorder', kategori='$kategori'  WHERE Kode='$_GET[Kode]'"); 
	
	if ($tambah) {
		  //echo "UPDATE hstok SET NamaBrg=$namabarang, Harga=$hbeli, status=$status,  satuan=$satuan, min=$min,   ketSatuan=$ketsatuan,   merk=$merk, hjual=$hjual,  reorder=$reorder  WHERE Kode=$_GET[Kode] <br>" ;
		  echo "<h3>Data barang $namabarang telah berhasil di-Update </h3><br> ";
		  switch ($lv0){
			   case "logistik":
				?><META http-equiv="refresh" content="2; url=pmilogistik.php?module=master_barang"><?
			   break;
			   case "admin":
				?><META http-equiv="refresh" content="2; url=pmiadmin.php?module=master_barang"><?
			   break;
			   default:
				echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
}
if (isset($_GET[Kode])) {
	 
	 $perintah=mysql_query("select * from hstok where kode='$_GET[Kode]'");
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
	 }
	 if ($row<1){
		  echo "Data yang anda inginkan tidak ada dalam database";
		  ?> <META http-equiv="refresh" content="2; url=pmilogistik.php?module=master_barang"><?
	 } else {	
?>
<h1 class="table">EDIT MASTER BARANG</h1>
<form name="reg" autocomplete="on" method="post" action="<?=$PHPSELF?>"> 
<table class="form" border="2">
	<tr> 	<td>Kode Barang</td>
		<td class="input" name="kode"><?=$row[kode]?></td>
		</tr>
	<tr> 	<td>Reagen IMLTD?</td>
		<td class="input">
		<? 
		$sA='';$sB='';
		if ($row[reagenujs]=='0') $sA='selected';
		if ($row[reagenujs]=='1') $sB='selected';
		?>
		<select name="reagenujs">
		        <option value="0" <?=$sA?>>Tidak</option>
		        <option value="1" <?=$sB?>>Reagen IMLTD</option>
		        </select>
	<tr> 	<td>Nama Reagen</td>
		<td class="input"><input name="nama_reag" type="hidden">
		<div id="nama_reagen" style="float:left"><?=$row[nama_reagen].';'.$row[metode]?>
		</div>&nbsp;&nbsp;<a href="modul/reag.php?&width=275&height=400" class="thickbox"><img src="images/button_search.png" border="0" /></a></td>
		</tr>
	<tr>
		<td>Nama Barang</td>
		<td class="input"><input name="namabrg" type="text" size="50" value="<?=$row[namabrg]?>"></td>
		</tr>
	<tr>
		<td>Merk</td>
		<td class="input"><input name="merk" type="text" size="15" value="<?=$row[merk]?>"></td>
		</tr>
	<tr>
		<td>Kategori Barang</td>
		<td class="input">
		<select name="kategori">
		        <option value="0">Barang Habis Pakai</option>
		        <option value="1">Barang Tidak Habis Pakai</option>
			
		        </select>
		</tr>
        <tr>
		<td>Jenis Barang</td>
		<td class="input">
		<? 
		$sA='';$sB='';$sAB='';$sO='';
		if ($row[status]=='ATK') $sA='selected';
		if ($row[status]=='LAB') $sB='selected';
		if ($row[status]=='INV') $sAB='selected';
		if ($row[status]=='LAIN') $sO='selected';
		?>
		<select name="status">
			<option value="ATK" <?=$sA?>>Alat Tulis kantor/Cetakan</option>
			<option value="LAB" <?=$sB?>>Laboratorium / Medis</option>
			<option value="INV" <?=$sAB?>>Inventaris UDD</option>
			<option value="LAIN" <?=$sO?>>Lainnya</option>
		</select>
		 </td>
        <tr>
		<td>Satuan</td>
		<td class="input"><input name="satuan" type="text" size="15" value="<?=$row[satuan]?>"</td>
		</tr>
        <tr>
		<td>Min Stok</td>
		<td class="input"><input name="min" type="text" size="5" value="<?=$row[min]?>"</td>
		</tr>
	<tr>
		<td>Re-Order</td>
		<td class="input"><input name="reorder" type="text" size="5" value="<?=$row[reorder]?>"</td>
		</tr>
	<tr>
		<td>Isi Satuan</td>
		<td class="input"><input name="ketsatuan" type="text" size="15" value="<?=$row[ketsatuan]?>"></td>
		</tr>
	<tr>
		<td>Harga Beli</td>
		<td class="input"><input name="harga" type="text" size="15" value="<?=$row[harga]?>"></td>
		</tr>
	<tr>
		<td>Harga Jual</td>
		<td class="input"><input name="hjual" type="text" size="15" value="<?=$row[hjual]?>"></td>
		</tr>
	
</table>

<br>

<input type="submit" value="Simpan Data" name="submit">
</form>
<?
}}
?>
