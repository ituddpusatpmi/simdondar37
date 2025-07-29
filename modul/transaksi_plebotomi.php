<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/instansi.js"></script>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="modul/thickbox/thickbox.js"></script>

			<script>
			function disabletext(val){ // masih belum berfungsi
				if(val=='0')
					document.getElementById('comments').disabled = true;
				else
					document.getElementById('comments').disabled = false;
			}

			function selectBayar(Kode){
			$('input[name=biaya]').val(Kode);
			tb_remove(); 
			}
			</script>
<?
include ('config/db_connect.php');

//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th	= substr(date("Y"),2,2);
$bl	= date("m");
$tgl	= date("d");
//$kdtp	= substr($idp1[id1],0,2).$tgl.$bl.$th."-";
$kdtp	= substr('PB',0,2).$th.$bl.$tgl."-";
$idp	= mysql_query("select notransaksi from transaksi_plebotomi where notransaksi like '$kdtp%' order by notransaksi DESC");
$idp1	= mysql_fetch_assoc($idp);
//$idp2	= substr($idp1[notransaksi],9,4);-->
$idp2	= substr($idp1[notransaksi],9,4);
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

$namauser = $_SESSION[namauser];
$lv0=$_SESSION[leveluser];
$today1=date("Y-m-d H:i:s");
$tanggal=date("Y-m-d");
if (isset($_POST['submit'])){
	 $kodepasien 	= $_POST['kodepasien'];
	 $rumahsakit	= mysql_real_escape_string($_POST["rumahsakit"]);
	 $dokterpasien	= mysql_real_escape_string($_POST["dokterpasien"]);
	 $diagnosa	= mysql_real_escape_string($_POST["diagnosa"]);
	 $bagian	= mysql_real_escape_string($_POST["bagian"]);
	 $biaya		= mysql_real_escape_string($_POST["biaya"]);
 	 $tgltransaksi	= $_POST["tgltransaksi"];
	 $petugaspenerima= $_POST["petugaspenerima"];

	echo "Check $kodepasien";
	$idtrans=substr($id_transaksi_baru,0,8);
	$check_p=mysql_num_rows(mysql_query("select kodepasien from transaksi_plebotomi where notransaksi like '$idtrans%' and kodepasien='$kodepasien'"));
        // SATU PASIEN BOLEH MELAKUKAN PLEBOTOMI LEBIH DARI 1 KALI DLM 1 HARI
	$check_p=0;
	if ($check_p==0) {
	$tambah=mysql_query("insert into transaksi_plebotomi 
			     (notransaksi, kodepasien, tgltransaksi, rumahsakit, dokterpasien, diagnosa, bagian, petugaspenerima, biaya, status) 
	                     value 
			     ('$id_transaksi_baru','$kodepasien','$today1','$rumahsakit', '$dokterpasien', '$diagnosa', '$bagian',
			      '$petugaspenerima','$biaya','0')"); 
	if ($tambah) {
		echo "Data permintaan plebotomi atas nama $nama telah berhasil dimasukkan<br>";
		$idp=mysql_query("select * from tempat_donor where active='1'");
		$idp1=mysql_fetch_assoc($idp);
	}
	}
	switch ($lv0){
		case "kasir":
			?><META http-equiv="refresh" content="1; url=pmikasir.php?module=registrasi_pasien_plebotomi"><?
		break;
		case "bdrs":
			?><META http-equiv="refresh" content="1; url=pmikasir.php?module=registrasi_pasien_plebotomi"><?

		break;
		case "admin":
			?><META http-equiv="refresh" content="1; url=pmikasir.php?module=registrasi_pasien_plebotomi"><?
		break;
		case "kasir2":
			?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=registrasi_pasien_plebotomi"><?
		break;
		default:
			echo "Anda tidak memiliki hak akses";
    }
}
?>

<body onload=disabletext(0)>
<h1 class="table">FORM PERMINTAAN PLEBOTOMI</h1>
<form name="periksa" method="post" action="<?=$PHP_SELF?>" >
<table class="form"   cellspacing="3" cellpadding="3">

<tr>
<td>
<table>
    <tr>
    	<?php
    	$check=mysql_query("select * from pasien_plebotomi where kode='$_GET[kode]'");
    	$check1=mysql_fetch_assoc($check);
    	$tempat=mysql_query("select * from tempat_donor where active='1'");
    	$tempat1=mysql_fetch_assoc($tempat);
    	?>
	<td>Kode Pasien</td>
	<td class="input">
	<input type=hidden name=kodepasien value="<?=$check1[kode]?>"> <?=$check1[kode]?>
	</td>
    </tr>

    <tr>
	<td>Nama Pasien</td>
	<td class="input">
	<input type=hidden name=nama value="<?=$check1[nama]?>"> <?=$check1[nama]?>
	</td>
    </tr>
    <tr>
	   <td>Alamat</td>
	   <td class="input">
	   <?=$check1[alamat]?>
	   </td>
    </tr>
    <tr>
	   <td>Kota</td>
	   <td class="input">
	   <?=$check1[kota]?>
	   </td>
    </tr>	
    <tr>
	   <td>Golongan Darah</td>
	   <td class="input"><?=$check1[golda]?>
	   </td>
    </tr>
    <tr>
	   <td>Rhesus</td>
	   <td class="input"><?=$check1[rhesus]?>
	   </td>
    </tr>
    <tr>
	   <td>Jenis Kelamin</td>
	   <td class="input"><?=$check1[kelamin]?>
	   </td>
    </tr>
    <tr>
	   <td>Tanggal Lahir</td>
	   <td class="input"><?=$check1[lahir]?>
	   </td>
    </tr>
    <tr>
	   <td>Jumlah Plebotomi</td>
	   <td class="input"><?=$check1[jumlah_plebotomi]?>
	   </td>
    </tr>

</td>
</table>

<td>
<table>
    <tr>
	   <td>Tanggal Permintaan</td>
	   <td class="input"><?=$today1?>
	   </td>
    </tr>
    <tr>
	   <td>Rumah Sakit</td>
	   <td class="input">
	   <input name="rumahsakit" type="text" size="30" placeholder="Nama rumah sakit pasien dirawat" >
	   </td>
    </tr>	
    <tr>
	   <td>Bagian</td>
	   <td class="input">
	   <input name="bagian" type="text" size="30" placeholder="Bagian di rumah sakit" >
	   </td>
    </tr>
    <tr>
	   <td>Dokter yang merawat</td>
	   <td class="input">
	   <input name="dokterpasien" type="text" size="30" placeholder="Dokter yang merawat" >
	   </td>
    </tr>
    <tr>
	   <td>Diagnosa</td>
	   <td class="input">
      	   <input name="diagnosa" type="text" size="30" placeholder="Diagnosa pasien" >
	   </td>
    </tr>
    <tr>
	   <td>Biaya</td>
	   <td class="input">
	   <input name="biaya" type="text" size="30" placeholder="Total biaya plebotomi" >
		<!-- BIaya-->
		<a href="modul/daftar_bayar.php?&width=500&height=400" class="thickbox">
						<img src="images/button_search.png" border="0" />

	   </td>
    </tr>
    <tr>
	  <td> </td>
    </tr>	
    <tr>
	  <td>Petugas yg menerima</td>
	  <td class="input">
	  <select name="petugaspenerima"">
	    <?
	       $petugaspenerima="select * from user order by nama_lengkap";
	       $do=mysql_query($petugaspenerima);
	       while($data=mysql_fetch_array($do)){
	    ?>
	    <option value="<?=$data[nama_lengkap]?>">
	       <?=$data[nama_lengkap]?>
	    </option>
	    <? } ?>
	  </select>
	  </td>
    </tr>

</table>
</td>
</tr>

</table>
<br>

<input type="submit" name="submit" value="Simpan permintaan plebotomi">

</form>
