
<SCRIPT LANGUAGE="JavaScript" SRC="js/rs.js"></SCRIPT>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_antara.js"></script>
<script type="text/javascript" src="js/tgl_butuh.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
   // $('#dokter').autocomplete({source:'modul/suggest_dokter.php', minLength:2}),
    //$('#ruangan').autocomplete({source:'modul/suggest_ruangan.php', minLength:2}),
    //$('#jenis').autocomplete({source:'modul/suggest_jenis.php', minLength:2}),
    $('#nik').autocomplete({source:'kepegawaian/suggest_pegawai.php', minLength:2});});
</script>


<table border=0 width=50% align=left>
  <tr><td>
  <link type="text/css" href="css/stok_darah.css" rel="stylesheet" />
  <?
  include('clogin.php');
  include('config/db_connect.php');
  $bl_thn=date("m").date("y");
  $tgl_skr=date("Y-m-d");
  ?>
  <form name="checkkantong" method="POST">
    <table id="background-image" summary="Check kantong" width="80%">
    <tr><td><input type=text name=nokantong1 required id="nik" placeholder='ketik nama karyawan' size='25'>klik pada nama yang sesuai dan klik --><input type=submit name=submit1 value="Submit"></td></tr>
    </table>
  </form>
<?
if (isset($_POST[submit1]))?>
<? {

//------------------------ set id transaksi ------------------------->
$idp	= mysql_query("select * from tempat_donor where active='1'");
$idp1	= mysql_fetch_assoc($idp);
$th	= substr(date("Y"),2,2);
$bl	= date("m");
$tgl	= date("d");
$kdtp	= "MUT".$tgl.$bl.$th."-";
$idp	= mysql_query("select notrans from mutasipeg where notrans like '$kdtp%' order by notrans DESC");
$idp1	= mysql_fetch_assoc($idp);
$idp2	= substr($idp1[notrans],10,4);
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
//$today1=gmdate("Y-m-d H:i:s",time()+60*60*7);
$today1=date("Y-m-d H:i:s");
if (isset($_POST['submit'])){
	$nik 		= $_POST['nik'];
	$tglawal 	= $_POST['tglajukan'];
	$tglakhir 	= $_POST['tglsk'];
	$bagianlama	= $_POST['bagianlama'];
	$bagianbaru	= $_POST['bagianbaru'];
	$masakerja	= $_POST['masakerja'];
	$alasan		= $_POST['alasan'];

	//$tambah=mysql_query("insert into mutasipeg (notrans,nik,tglajukan,Status,tglsk,nosk,tanggal_entry,tanggal_update,ijasah,bagianlama,bagianbaru,jabatan,pencatat,up)
	//value ('$id_transaksi_baru','$nik','$tglawal','$_POST[status]','$tglakhir','$_POST[nosk]','$today1','$today1','$_POST[ijasah]','$bagianlama','$bagianbaru','$_POST[jabatan]','$namauser','1')");
	$tambah=mysql_query("insert into mutasipeg 
		(notrans,nik,tglajukan,Status,tglsk,nosk,tanggal_entry,
		 tanggal_update,ijasah,bagianlama,bagianbaru,jabatan,golongan,pencatat,up,masakerja,alasan)
	value ('$id_transaksi_baru','$nik','$tglawal','2','$tglakhir','$_POST[nosk]','$today1','$today1','$_POST[ijasah]','$bagianlama','$bagianbaru','$_POST[jabatan]','$_POST[golongan]','$namauser','1','$masakerja','$alasan')");

			
	if ($tambah) {
		echo "Data Telah berhasil dimasukkan<br>";
		$up0=mysql_query(" update pegawai set bagian='$bagianbaru' where Kode='$nik'");			
		mysql_query("UPDATE mutasipeg set lamaproses=(TO_DAYS(tglsk)- TO_DAYS(tglajukan))");		
	
		
		
			
}
			//$up=mysql_fetch_assoc(mysql_query("select * from kgbpeg where up='1' and Status='2' "));
			
			//if($up0){$up1=mysql_query("update kgbpeg set up='2' where up='1' ");}


		
	switch ($lv0){
		case "kepegawaian":
			?><META http-equiv="refresh" content="1; url=pmikepegawaian.php?module=mutasi"><?

		break;
		case "admin":
			?><META http-equiv="refresh" content="1; url=pmiadmin.php?module=mutasi"><?
		break;
		default:
			echo "Anda tidak memiliki hak akses";
    }
}
?>

<body onload=disabletext(0)>

<h1 class="table">FORM INPUT DATA MUTASI KARYAWAN</h1>
<form name="periksa" method="post" action="<?=$PHP_SELF?>" >
<!--table class="form" cellspacing="0" cellpadding="2">
<table border=1 cellpadding="5" cellspacing="1" style="border-collapse:collapse" width="100%"-->
<table class="form" width=100%  cellspacing="1" cellpadding="2">

<tr border=1 cellpadding="5" cellspacing="1" style="background-color:#FF6700; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"> 
	<!--tr-->
    <?php
	$check=mysql_query("select * from pegawai where Kode='$_POST[nokantong1]'");
	$check1=mysql_fetch_assoc($check);
	$tempat=mysql_query("select * from tempat_donor where active='1'");
	$tempat1=mysql_fetch_assoc($tempat);
	?>
	<td><table>
	<tr><td colspan='2'>DATA KARYAWAN :</td></tr>
	<td>NIK</td>
		<td class="input">
			<input type=hidden name=nik value="<?=$check1[Kode]?>">
			<?=$check1[Kode]?>
		</td>
		</tr>
		
	<tr>
		<td>Nama Karyawan</td>
		<td class="input">
			<?=$check1[Nama]?>
		</td>
	</tr>
	<tr>
		<td>Tanggal Lahir</td>
		<td class="input"><?=$check1[TglLhr]?>
		</td>
	</tr>
	<tr>
		<td>Umur</td>
		<td class="input"><?=$check1[umur]?> Tahun
		</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td class="input">
			<?=$check1[Alamat]?>
		</td> </tr>
	<tr>
		<td>Status</td>
		<? 
		$ini="Bujang";
		if ($check1[Status]=="1")$ini="Menikah";
		?>
		<td class="input">
			<?=$ini?>
		</td></tr>
	<tr>
		<td>Status Karyawan</td>
		<? 
		$ini1="Resign";
		if ($check1[statuspeg]=="0")$ini1="Paruh Waktu";
		if ($check1[statuspeg]=="1")$ini1="Kontrak";
		if ($check1[statuspeg]=="2")$ini1="Tetap";
		if ($check1[statuspeg]=="3")$ini1="PNS Diperbantukan";
		?>
		<td class="input">
			<?=$ini1?>
		</td></tr>
<tr>
		<td>Ijazah Terakhir</td>
		<td class="input">
			<?=$check1[ijasah]?>
		</td> </tr>

		<tr>
		<td>Golongan</td>
		<td class="input">
			<?=$check1[golongan]?>
		</td> </tr>
		
		<tr>
		<td>Jabatan</td>
		<td class="input">
			<?=$check1[jabatan]?>
		</td> </tr>

		<tr>
		<td>TMT</td>
		<td class="input">
			<?=$check1[tmt]?>
		</td> </tr>
		<tr>
		<td>Masa Kerja</td>
		<td class="input"><input type=hidden name=masakerja value="<?=$check1[masakerja]?>">
			<?=$check1[masakerja]?> tahun
		<!--td class="input"><?=$check1[masakerja]?> tahun-->
		</td>
	</tr>
		<tr>
	<td>Bagian Lama</td>
		<td class="input">
			<?$bagian=mysql_fetch_assoc(mysql_query("select nama from bagianpeg where kode='$check1[bagian]'"));?>
			<input type=hidden name=bagianlama value="<?=$check1[bagian]?>">
			<?=$bagian[nama]?>
		</td>
		</tr>
	<!--tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr-->

</table></td>
	
<td><table>
	<tr><td colspan='2'>DATA MUTASI:</td></tr>
				   <tr> 
					<td>Alasan Mutasi</td>
			     <td class="input">
						 <select name="alasan">
							  <option value="0">Rotasi</option>
							  <option value="1">Promosi</option>
							  <option value="2">Dismosi</option>
							  
					</td>
			   </tr>
			<tr>
	
					<td>Tanggal Diajukan</td>
					<td class="input">
						 <input type="text" name="tglajukan" id="datepicker" placeholder="yyyy-mm-dd" size=11>
				</tr>

				<tr>
			      <!--td>Status</td>
			     <td class="input">
						 <select name="status">
							<option value="0">Diajukan</option>
							<option value="1">Menunggu Proses</option>
							<option value="2">Selesai</option>
							</select>
					</td>
			   </tr-->

				<tr>
					<td>Tanggal SK</td>
					<td>
						 <input type="text" name="tglsk" id="datepicker1" placeholder="yyyy-mm-dd" size=11>
					</td>
			   </tr>
			
				<tr>
					<td>No. SK</td>
					<td class="input">
					<input name="nosk" type="textbox" size="30" placeholder="Nomor SK" value="<?php if($cek_tmpudd!=0){echo "$data_combo[nosk]";}?>">
					</td>
			   </tr>
				


			   

				<!--tr>
					<td>Gaji Lama</td>
					<td class="input">
						 <input name="gajilama" type="text" size="10" placeholder="Nominal Gaji Lama" > tanpa titik dan koma
					</td>
			   </tr>

				 <tr>
					<td>Gaji Baru</td>
					<td class="input">
						 <input name="gajibaru" type="text" size="10" placeholder="Nominal Gaji Baru"> tanpa titik dan koma
					</td>
			   </tr-->

				<tr>
					<td>Ijazah Terakhir</td>
			     <td class="input">
						 <select name="ijasah">
							  <option value="SMP">SMP</option>
							  <option value="SMA">SMA</option>
							  <option value="D1">D1</option>
							  <option value="D3">D3</option>
							  <option value="S1" selected>S1</option>
								<option value="S2">S2</option>
								<option value="S3">S3</option>
								<option value="S4">S4</option></select>
					</td>
			   </tr>
			
			<!--tr>
					<td>Bagian Lama</td>
					<td class="input">
						 <select name="bagianlama" >
							  <option value="" selected>--Pilih--</option>
								   <?php
								   $q="select * from bagianpeg";
								   $do=mysql_query($q,$con);
								   while($data=mysql_fetch_assoc($do)){
										$select="";
								   ?>
							  <option value="<?=$data[nama]?>"<?=$select?>>
								   <?=$data[nama]?>
							  </option>
								   <?}?>
						 </select>
					</td>
			   </tr-->
			<tr>
					<td>Bagian Baru</td>
					<td class="input">
						 <select name="bagianbaru" >
							  <option value="" selected>--Pilih--</option>
								   <?php
								   $q="select * from bagianpeg";
								   $do=mysql_query($q,$con);
								   while($data=mysql_fetch_assoc($do)){
										$select="";
								   ?>
							  <option value="<?=$data[kode]?>"<?=$select?>>
								   <?=$data[nama]?>
							  </option>
								   <?}?>
						 </select>
					</td>
			   </tr>
			<tr>
					<td>Golongan</td>
					<td class="input">
						 <select name="golongan" >
							  <option value="" selected>--Pilih--</option>
								   <?php
								   $q="select * from golonganpeg";
								   $do=mysql_query($q,$con);
								   while($data=mysql_fetch_assoc($do)){
										$select="";
								   ?>
							  <option value="<?=$data[golongan]?>"<?=$select?>>
								   <?=$data[golongan]?>
							  </option>
								   <?}?>
						 </select>
					</td>
			   </tr>

			<tr>
			       <td>Jabatan</td>
			     <td class="input">
						 <select name="jabatan">
							  <option value="staff" selected>Staff</option>
							  <option value="kaTU">Ka. TU</option>
							  <option value="sekretaris">Sekretaris</option>
							  <option value="kabig">Kabig</option>
							  <option value="wadir" >Wadir</option>
								<option value="direktur">Direktur</option>
								</select>
					</td>
			   </tr>
				<tr><td></td><td></td></tr>
 
			   </table>
		  </td>





</tr>
</table>
<br>

<input type="submit" name="submit" value="Simpan">

</form>
<? 

} ?>
