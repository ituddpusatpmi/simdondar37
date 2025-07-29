<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />    
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<!--<script type="text/javascript" src="js/disable_enter.js"></script>-->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_butuh.js"></script>

<?php
include ("config/db_connect.php");
$tgl_permintaan=date("Y-m-d");
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$tgl_yesterday=date("Y-m-d",$yesterday);
$td0=php_uname('n');
$td0=substr($td0,0,3);
if (!isset($_POST[submit1])){
?>
    <h1 class="table">Permintaan Tambah Darah</h1>
	<form name="cari" method="post" action="<?echo $PHPSELF?>">
	<table class="form" cellspacing="0" cellpadding="0">
		<tr>
			<td>No Formulir</td>
			<td class="input">
                <input name="no_form" type="text" size="20">
			</td>
		</tr>
	</table>
	<br>
	<input name="submit1" type="submit" value="Cari">
	</form>
<?php }
if ($_POST['periksa']=="1") {
	//$cekjum=mysql_fetch_assoc(mysql_query("select Jumlah from dtranspermintaan where NoForm='$_POST[noform]'"));
	//$upjum=$cekjum+$_POST[jumlah];
	//$permintaan="update dtranspermintaan set Jumlah=$_POST[jumlahlama]+$_POST[jumlah],JTitip=$_POST[jtitiplama]+$_POST[stattitip],TglPerlu='$_POST[tgl_diperlukan]' where NoForm='$_POST[noform]'";
	//$permintaan1=mysql_query($permintaan);
			
	//echo "NO FORM: $_POST[noform] $_POST[tgl_diperlukan] $_POST[jumlah]";
	$permintaan="insert into dtranspermintaan(`NoForm`,`JenisDarah`,`GolDarah`,
						`Rhesus`,`Jumlah`,`JTitip`,`cc`,`Ket`,`TglPerlu`,`tempat`)
               values ('$_POST[noform]','$_POST[jenis_darah]','$_POST[goldarah]',
						'$_POST[rhesus]','$_POST[jumlah]','$_POST[stattitip]','$_POST[volume]',
						'$_POST[keterangandrh]','$_POST[tgl_diperlukan]','$_POST[tempat]')";
	$permintaan1=mysql_query($permintaan);
	$permintaan=base64_encode($permintaan.';');
$myfile="bdrs/dari-$td0-$tgl_permintaan.zip";
if (file_exists($myfile)) { $fh=fopen($myfile,'a') or die ("Cant open file"); } else { $fh=fopen($myfile,'w') or die ("Cant open file"); }
fwrite($fh,$permintaan);
fwrite($fh,";\n");
fclose($fh);
$myfile="bdrs/dari-$td0-$tgl_yesterday.zip";
if (file_exists($myfile)) { $fh=fopen($myfile,'a') or die ("Cant open file"); } else { $fh=fopen($myfile,'w') or die ("Cant open file"); }
fwrite($fh,$permintaan);
fwrite($fh,";\n");
fclose($fh);
	if ($permintaan1){ 
		$noform1=str_replace("/","-",$_POST[noform]);
		echo ("Tambah Periksa darah No. <b>'$_POST[noform]'</b> telah diproses !!
		<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"2; URL=pmikasir.php?module=cetak_minta&noform=$noform1&jenisdarah=$_POST[jenis_darah]&jmlkntng=$_POST[jumlah]\">");
	}
	$_POST['periksa']="";
}

if (isset($_POST[submit1])) {
	$tambah=mysql_query("select * from htranspermintaan where noform='$_POST[no_form]'");
	$nrow=0;
	if ($tambah) {
		$nrow=mysql_num_rows($tambah);
		$tambah1=mysql_fetch_assoc($tambah);
		$norm=$tambah1[no_rm];
		$tambahpasien=mysql_query("select * from pasien where no_rm='$norm'");
		$tambahpasien1=mysql_fetch_assoc($tambahpasien);
	}	
	if ($tambah1<1){echo "Nomor formulir belum terdaftar, isi form permintaan dahulu";
		?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=permintaan">
	<?} else {
	$jlama=mysql_fetch_assoc(mysql_query("select * from dtranspermintaan where noform='$tambah1[NoForm]'"));
?>
	<h1 class="table">FORM PERMINTAAN DARAH</h1>
	<form name=periksa method="post" action="<?=$PHP_SELF?>"> 
	<table class="form" cellspacing="1" cellpadding="2">
		<tr> 
			<td>No. Formulir</td>
			<td class="input"><?=$tambah1[noform]?></td>
		</tr>
		<tr> 
			<td>Nama Pasien</td>
			<td class="input"><?=$tambahpasien1[nama]?></td>
		</tr>
		<tr> 
			<td>Alamat Pasien</td>
			<td class="input"><?=$tambahpasien1[alamat]?></td>
		</tr>
		<tr> 
			<td>Jenis Darah</td>
			<td class="input">
				<select name="jenis_darah" >
					<option selected>--Pilih--</option>
					<?php
						$permintaan="select * from produk";
						$do=mysql_query($permintaan);
						while($data=mysql_fetch_assoc($do)){
							$select="";?>
					<option value="<?=$data[Nama]?>"<?=$select?>>
						<?=$data[Nama]?>
					</option>
						<?}?>
				</select>

</td>
		</tr>
		<tr>
			<td>Golongan Darah</td>
			<td class="input">
				<? 
				$sA='';$sB='';$sAB='';$sO='';
				if ($tambahpasien1[gol_darah]=='A') $sA='selected';
				if ($tambahpasien1[gol_darah]=='B') $sB='selected';
				if ($tambahpasien1[gol_darah]=='AB') $sAB='selected';
				if ($tambahpasien1[gol_darah]=='O') $sO='selected';
				?>
				<select name="goldarah">
					<option value="A" <?=$sA?>>A</option>
					<option value="B" <?=$sB?>>B</option>
					<option value="AB" <?=$sAB?>>AB</option>
					<option value="O" <?=$sO?>>O</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Rhesus</td>
			<td class="input">
			<? 
			$rn='';$rp='';
			if ($tambahpasien1[rhesus]=='-') $rn='selected';
			if ($tambahpasien1[rhesus]=='+') $rp='selected';
			?>
				<select name="rhesus">
					<option value="+" <?=$rp?>>Positif (+)</option>
					<option value="-" <?=$rn?>>Negatif (-)</option>
				</select>
			</td>
		</tr>
		<tr> 
			<td>Jumlah Kantong</td>
			<td class="input"> 
				<input type="text" name="jumlah" id="jumlah" size=12>
			</td>
		</tr>
		<tr>
			<td>Volume</td>
			<td class="input">
				<input type="text" name="volume" id="volume" size=12>
			</td>
		</tr>
		<tr>
			<td>Status Titip</td>
			<td class="input">
				<select name="stattitip">
				<? for ($i=0;$i<6;$i++) { ?>
				<option value="<?=$i?>"><?=$i?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr> 
			<td>Keterangan</td>
			<td class="input">
				<input name="keterangandrh" type="text" size="20">
			</td>
		</tr>
		<tr>
			<td>Tempat Permintaan</td>
			<td class="input">
				<select name="tempat">
					<option value="UDD">UDD</option>
					<option value="BDRS">BDRS</option>
				</select>
			</td>
		</tr>
		<tr> 
			<td>Tgl Diperlukan</td>
			<td class="input">
				<input type="text" name="tgl_diperlukan" id="butuh" size=12>
			</td>
		</tr>
	</table>
	<br>
  	<input type="hidden" value="1" name="periksa">
  	<input type="hidden" value="<?=$tambah1[noform]?>" name="noform">
  	<input type="hidden" value="<?=$jlama[Jumlah]?>" name="jumlahlama">
  	<input type="hidden" value="<?=$jlama[JTitip]?>" name="jtitiplama">
	<input type="submit" name="submit2" value="Tambah">
</form>
<?
}}
?>
