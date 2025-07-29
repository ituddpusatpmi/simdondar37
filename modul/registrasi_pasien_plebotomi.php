<!-- HTML5 Shim, IE8 and bellow recognize HTML5 elements -->
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->		
<!-- Modernizr -->
<script src="js/modernizr-1.5.min.js"></script>
<!-- Webforms2 -->
<script src="webforms2/webforms2.js"></script>	
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<!-- disable enter -->
<script type="text/javascript" src="js/disable_enter.js"></script>
<!-- Form layout -->
<!--<link rel="stylesheet" href="css/html5forms.layout.css"> -->
<script src="js/html5forms.fallback.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        document.reg.nama.focus();
      });
    </script>
<script>
	$(function() {
		$( "#radio" ).buttonset();
	});
</script>

<?php 
require_once('clogin.php');
require_once('modul/background_process.php');
require_once('config/db_connect.php');
		  $lv0=$_SESSION[leveluser];
if (isset($_POST[submit])) {
	 $nama 		= mysql_real_escape_string($_POST["nama"]);		
	 $alamat	= mysql_real_escape_string($_POST["alamat"]);
	 $kota		= mysql_real_escape_string($_POST["kota"]);
 	 $kelamin	= $_POST["kelamin"];
	 $lahir 	= $_POST["lahir"];
	 $golda 	= $_POST["golda"]; 
  	 $rhesus 	= $_POST["rhesus"];
	 $jumlah_plebotomi=$_POST["jumlah_plebotomi"];


	 //------------------------ SET KODE PASIEN ------------------------->
	 //digit pendonor 14 digit, 4kode utd, 3 nama, 2 tmpt aftap,6 sequence, 
	 $q_utd	= mysql_query("select id from utd where aktif='1'",$con);			
	 $utd	= mysql_fetch_assoc($q_utd);
	 $nama1 = str_replace(".","",$nama);
	 $nama1 = str_replace(" ","",$nama1);
	 $nama1 = str_replace(",","",$nama1);
	 $nm	=strtoupper(substr($nama1,0,3));

	 $idp	= mysql_query("select id,id1 from tempat_donor where active='1'",$con);
	 $idp1	= mysql_fetch_assoc($idp);
	 //$kdtp	= $utd[id].$idp1[id1].$nm;
 	 $kdtp	= $utd[id].'PB'.$nm;
	 $idp	= mysql_query("select Kode from pasien_plebotomi where Kode like '$kdtp%'
			      order by Kode DESC",$con);
	 $idp1	= mysql_fetch_assoc($idp);
	 $idp2	= substr($idp1[Kode],9,6);
	 if ($idp2<1) {
		  $idp2="00000";
	 }
	 $int_idp2=(int)$idp2+1;
	 $j_nol1= 6-(strlen(strval($int_idp2)));
	 for ($i=0; $i<$j_nol1; $i++){
		  $idp4 .="0";
	 }
	 $kode=$kdtp.$idp4.$int_idp2;
	 //---------------------- END set id pendonor ------------------------->

	//mysql_close($connection);
	 $_POST[submit]="";
	 $sekarang = date("Y-m-d h:m:s");
	 $tambah_sql="INSERT INTO `pmi`.`pasien_plebotomi` (`kode` ,`nama` ,`alamat` ,`kota` ,`kelamin` ,`lahir` ,`golda` ,`rhesus` ,`jumlah_plebotomi`)
			         values ('$kode','$nama','$alamat','$kota','$kelamin','$lahir','$golda','$rhesus','$jumlah_plebotomi')";

	 $tambah=mysql_query($tambah_sql,$con);
	if ($tambah) {
		  echo "Data pasien plebotomi atas nama $nama telah berhasil dimasukkan<br> ";
		  print_r($_a);
			mysql_close($con);
		  ?><form name="reg" method="post" action="pmikasir2.php?module=registrasi_pasien_plebotomi"><?
	 } else {
		echo "<div id=\"warning\">Maaf, data yang anda masukkan tidak dapat disimpan</div><br>$tambah_sql";
	 }
} 
switch ($lv0) {
	 case "kasir2":
		  ?><form name="reg" method="post" action="pmikasir2.php?module=registrasi_pasien_plebotomi"><?
	 break;
	 default:
		  echo "$lv0 OOO Anda tidak memiliki hak akses";
}
?>

<? if ($_SESSION[leveluser]=='mobile') { ?>
<h1 class="table">FORM MASTER PASIEN PLEBOTOMI ||
<input type="button" value="CARI PASIEN" onClick="document.location.href='pmimobile.php?module=pasien_plebotomi';"></h1>
<? } else { ?>
<h1 class="table">FORM MASTER PASIEN PLEBOTOMI ||
<input type="button" value="CARI PASIEN" onClick="document.location.href='pmikasir2.php?module=pasien_plebotomi';"></h1>
<? } ?>
<table class="form" width=380  cellspacing="1" cellpadding="2">
	<tr>
		<td>
		  	<table>
			   <tr>
				<td>Nama</td>
				<td class="input">
				<input name="nama" type="text" size="30" placeholder="Nama lengkap" pattern="^[A-Za-z.,' ]{3,}$">
				</td>
			   </tr>
			   <tr>
				<td>Alamat</td>
				<td class="input">
				<input name="alamat" type="textbox" size="30" placeholder="Jalan, RT/RW">
				</td>
			   </tr>
			   <tr>
				<td>Kota</td>
				<td class="input">
				<input name="kota" type="text" size="30" placeholder="Kota & / Provinsi" >
				</td>
			   </tr>
			   <tr>
				<td>Jenis Kelamin</td>
				<td class="input" >
					 <input type="radio" id="radio1" name="kelamin" value="LK" >
						  <label for="radio1">Laki-laki</label>
					 <input type="radio" id="radio2" name="kelamin" value="PR" >
						  <label for="radio2">Perempuan</label>
				</td>
			   </tr>		
			   <tr>
				<td>Tgl Lahir</td>
				<td class="input">
				<input type="date" name="lahir" id="datepicker" size=15 required
					  onchange="document.reg.umur.value=Age(document.reg.datepicker.value);">
				</td>
			   </tr>
			   <tr>
				<td>Golongan Darah</td>
				<td class="input">
				<select name="golda">
				  <option value="A">A</option>
				  <option value="B">B</option>
				  <option value="AB">AB</option>
				  <option value="O">O</option>
				  <option value="X" selected>X</option></select>
				</td>
			   </tr>
			   <tr>
				<td>Rhesus</td>
				<td class="input">
				<select name="rhesus">
				  <option value="+">Positif (+)</option>
				  <option value="-">Negatif (-)</option></select>
				</td>
			   </tr>
			   <tr>
			    	<td >Jumlah Plebotomi</td>
				<td class="input">
				 <input name="jumlah_plebotomi" type="text" size="4" >
				</td>
			   </tr>
			   </table>
		  </td>
	 </tr>
</table>
<br>
<input type="hidden" name="mu" value="<?=$mu?>">
<button type="submit" value="Simpan" name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
	<span class="ui-button-text">Simpan</span>
</button>
</form>
