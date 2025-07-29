<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$col=mysql_query("SELECT `hari` FROM `utd`");if (!$col){mysql_query("ALTER TABLE `utd` 
ADD `hari` varchar (20)  null AFTER `zonawaktu`, 
ADD `jam` varchar (20)  null AFTER `hari`");}

$col1=mysql_query("SELECT `telp` FROM `utd`");if (!$col1){mysql_query("ALTER TABLE `utd` ADD `telp` VARCHAR( 12 ) NULL ,
ADD `fax` VARCHAR( 12 ) NULL ");}

?>

<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
  $('#instansi').autocomplete({source:'modul/suggest_udd.php', minLength:2});});
</script>

<?
$today=date("Y");
if (isset($_POST[submit])) {
	$id=$_POST[udd];
	$zonawaktu=$_POST[zonawaktu];
	$hari=$_POST[hari];
	$jam=$_POST[jam];
	$telp=$_POST[telp];
	$fax=$_POST[fax];
	$cek=mysql_fetch_assoc(mysql_query("select id from utd where down='1' and aktif='1'"));
	if ($cek) {
	  $non=mysql_query("update utd set down=0,aktif=0");
	}
	$ak=mysql_query("update utd set down=1, aktif=1, zonawaktu='$zonawaktu', hari='$hari', jam='$jam', telp='$telp', fax='$fax' where id='$id'");
	//=======Audit Trial====================================================================================
	$log_mdl ='Utility';
	$log_aksi='Melakukan Update UTD ID '.$id;
	include_once "user_log.php";
	//=====================================================================================================
	if ($ak) echo ("UDD telah diaktifkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
}
?>
<form name="dinstansi" method="POST" action="<?=$PHPSELF?>">
<table class="form" border="0">
<h1 class="table">Aktifkan UDD</h1>        
	<tr><td>Nama UDD :</td><td><input type='text' name="udd" required id='instansi'></td></tr>
	<tr><td>Zona Waktu :</td>
		<td><select name="zonawaktu" required id="zonawaktu">
		  <option value="Asia/Jakarta">Asia/Jakarta (WIB)</option>
		  <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
		  <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
		</select>
		</td>
	</tr>
	<tr><td>Hari Konsul :</td><td><input type='text' name="hari" required placeholder="Senin - Sabtu"></td></tr>
	<tr><td>Jam Konsul :</td><td><input type='text' name="jam" required placeholder="00.00 - 00.00 WIB/WITA/WIT "></td></tr>
	<tr><td>Telphone :</td><td><input type='text' name="telp" required placeholder="telphone"></td></tr>
	<tr><td>Faximile :</td><td><input type='text' name="fax" required placeholder="Faximile "></td></tr>
</table>
<input name="submit" type="submit" value="Simpan">
</form>
