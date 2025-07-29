<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>

<?php 
include('clogin.php');
include('config/db_connect.php');

if (isset($_POST[submit])) {
  	$Kode		=strtoupper($_POST[Kode]);
	$Jenis		=strtoupper($_POST[Jenis]);
	$Nama		=strtoupper($_POST[Nama]);
	$Alamat		=strtoupper($_POST[Alamat]);
	$Telp1		=$_POST[Telp1];
        $namaCp		=strtoupper($_POST[namaCp]);
        $alamatcp	=strtoupper($_POST[alamatcp]);
	$telpcp1	=$_POST[telpcp1];
        $telpcp2	=$_POST[telpcp2];
        $Keterangan	=strtoupper($_POST[Keterangan]);

	 $sqlupdate=mysql_query("update supplier set
				Jenis='$Jenis',
				Nama='$Nama',
				Alamat='$Alamat',
				Telp1='$Telp1',
				namaCp='$namaCp',
				alamatcp='$alamatcp',
				telpcp1='$telpcp1',
				telpcp2='$telpcp2',
				Keterangan='$Keterangan'
				where
				Kode='$Kode'");
				
	if ($sqlupdate) {
		  echo "Data '$Nama' telah berhasil di-Update <br> ";
		  ?> <META http-equiv="refresh" content="1; url=pmilogistik.php?module=kontak"><?
		  } else echo "Ada kesalahan, data tidak bisa diupdate";
}

if (isset($_GET[Kode])) {
	 $ssql=mysql_query("select * from supplier where Kode='$_GET[Kode]'");
	 $nrow=0;
	 if ($ssql) {
		  $nrow=mysql_num_rows($ssql);
		  $row=mysql_fetch_assoc($ssql);
	 }
	 if ($row<1){
		  echo "Error loading data";
		  ?> <META http-equiv="refresh" content="1; url=pmilogistik.php?module=kontak"><?
	 } else {	
?>
<h1 class="table">EDIT DATA KONTAK</h1>
<form name="editdata" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
<table class="form" border="1" cellspacing="2" cellpadding="3">
	 <tr>
		 <td>Kode</td>
	 	 <td class="input"><?=$row[Kode]?>
		 </td></tr>
	 <tr>
		 <td>Jenis</td>
		 <td class="input">
		 <?php
		   $jenis		= $row[Jenis];
		   $selected[$jenis]	= "selected";
		  ?>
	 	 <select name="Jenis">
			   <option value="0" <?=$selected["0"]?>>Supplier</option>
			   <option value="1" <?=$selected["1"]?>>Customer</option>
			   <option value="2" <?=$selected["2"]?>>Bagian di UDD</option>
			   <option value="3" <?=$selected["3"]?>>Lain-lain</option>
			   <option value="4" <?=$selected["4"]?>>Pengelola Limbah</option>
		 </select>
	 	 </td></tr>
	 <tr>
		 <td>Nama Kontak</td>
		 <td class="input">
		 <input name="Nama" type="text" size="50" value="<?=$row[Nama]?>">
		 </td></tr>
	 <tr>
		 <td>Alamat</td>
		 <td class="input"><input name="Alamat" type="text" size="50" value="<?=$row[Alamat]?>"
		 </td></tr>
	 <tr>
		 <td>Telp</td>
		 <td class="input"><input name="Telp1" type="text" size="15" value="<?=$row[Telp1]?>"</td>
		 </tr>
	 <tr>
		 <td>Kontak Person</td>
		 <td class="input"><input name="namaCp" type="text" size="50" value="<?=$row[namaCp]?>"></td>
		 </tr>
	 <tr>
		 <td>Alamat Kontak Person</td>
		 <td class="input"><input name="alamatcp" type="text" size="50" value="<?=$row[alamatcp]?>"></td>
		 </tr>
	 <tr>
		 <td>Telp Kontak Person</td>
		 <td class="input"><input name="telpcp1" type="text" size="15" value="<?=$row[telpcp1]?>"></td>
		 </tr>
	 <tr>
		 <td>HP Kontak Person</td>
		 <td class="input"><input name="telpcp2" type="text" size="15" value="<?=$row[telpcp2]?>"></td>
		 </tr>
	 <tr>
		 <td>Keterangan</td>
		 <td class="input"><input name="Keterangan" type="text" size="50" value="<?=$row[keterangan]?>"></td>
		 </tr>
</table><br>
<input type="hidden" value="<?=$row[Kode]?>" name="Kode">
<input type="submit" value="Simpan perubahan" name="submit">
</form>
<?
}}
?>
