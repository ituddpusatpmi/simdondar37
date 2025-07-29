<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />    
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<script type="text/javascript" src="js/tgl_butuh.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>

<?php 

include('clogin.php');
include('config/db_connect.php');
$lv0=$_SESSION[leveluser];
		 	  
if (isset($_POST[submit])) {
	 $noid		= $_POST["id"];
	 $noform	= $_POST["noform"];
	 $no_rm	        = $_POST["no_rm"];		
	 $reg_rs	= $_POST["reg_rs"];	
	 $nama_rs 	= $_POST["nama_rs"];
	 $nama_bagian	= mysql_real_escape_string($_POST["nama_bagian"]);
	 $nama_kelas 	= mysql_real_escape_string($_POST["nama_kelas"]); 		
	 $nama_ruangan	= mysql_real_escape_string($_POST["nama_ruangan"]);		
	 $nama_dokter	= mysql_real_escape_string($_POST["nama_dokter"]);
	 $diagnosa	= mysql_real_escape_string($_POST["diagnosa"]);
	 $jenis		= $_POST["jenis"];
	 $noreglayanan	= $_POST["noreglayanan"];
	
	 $kode_biaya	= $_POST["kode_biaya"];
	 $harga		= $_POST["harga"];
	$jnspermintaan	= $_POST["jnspermintaan"];
	
	 $shift   	= $_POST["shift"];
	 $mintaid	= $_POST["idminta"];
	 $namauser 	= $_SESSION[namauser];
	 $sekarang	= date("Y-m-d h:m:s");
	
	 $tambah=mysql_query("UPDATE htranspermintaan SET 
		 bagian='$nama_bagian',kelas='$nama_kelas',namadokter='$nama_dokter',diagnosa='$diagnosa',jenis='$jenis',
rs='$nama_rs',regrs='$reg_rs',shift='$shift',tempat='$tempat',nojenis='$noreglayanan',
ruangan='$nama_ruangan',jenis_permintaan='$jnspermintaan'
		 
		 WHERE noform='$noform'");

//tabel pembayaran NoTrans 	Tgl 	Jumlah 
 // tabel dpembayran   noForm 	BiayaLD 	tgl 	TotPotongan 	TotDibayar 	totPeriksa
 //tabel kwitansi      NoForm 	jumlah 	Tgl 	petugas 	nokantong 	shift 	tempat 	kodebiaya
// notrans 	kodeBrg 	jum 	subTotal 	namabrg 	harga 	temphj 	no_kantong 	petugas 	shift 	tgl_keluar 	tempat
		$jenis_biaya1=mysql_query("select * from biaya where Kode='$kode_biaya'");
		$jenis_biaya=mysql_fetch_array($jenis_biaya1);
	 $tambahlagi=mysql_query("UPDATE dpembayaranpermintaan SET 		
	kodeBrg='$kode_biaya',namabrg='$jenis_biaya[NamaBiaya]',harga='$jenis_biaya[Harga]' where notrans='$noform' and harga !='0' ");
	$tambahlagi1=mysql_query("UPDATE kwitansi SET 		
	kodebiaya='$kode_biaya',jumlah='$jenis_biaya[Harga]', layanan='$jenis',rs='$reg_rs' where NoForm='$noform' ");
	$tambahlagi2=mysql_query("UPDATE dtransaksipermintaan set layanan='$jenis', rs='$reg_rs' where noform='$noform'");
	if ($tambahlagi) {
		  echo "Data Telah berhasil di-Update <br> ";
		  switch ($lv0){
			   case "kasir2":?><META http-equiv="refresh" content="0; url=pmikasir2.php?module=searchpasien"><?
			   default:echo "$lv0 ANDA tidak memiliki hak akses";
		  }
		
	 }
	 $_POST['periksa']="";
}
if (isset($_GET[kode])) {
	 $sql="SELECT a.*,b.* FROM dpembayaranpermintaan a INNER JOIN htranspermintaan b ON a.notrans=b.noform WHERE b.noform='$_GET[kode]'";
	 $perintah=mysql_query($sql);
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
		  $idminta=$_GET[id];
	 }
	 if ($row<1){
		  echo "No Form yang anda masukkan belum terdaftar";
		  ?> <META http-equiv="refresh" content="2; url=pmikasir2.php?module=searchpasien">
		  <?
	 } else {?>


   <?
   $r=mysql_fetch_assoc(mysql_query("SELECT * FROM htranspermintaan WHERE noform='$_GET[kode]'"));
   $p=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$r[no_rm]'"));
   ?>
   	<h1 class="table">DATA PASIEN</h1>
    	<h1 class="table">NO RM : <?=$p[no_rm]?> , Nama : <?=$p[nama]?> , Gol & Rh Darah   : <?=$p[gol_darah]?> (<?=$p[rhesus]?>)</h1>
	<br>
		  <form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
			   <h1 class="table">FORM EDIT LAYANAN DAN PEMBAYARAN</h1>
					<table border="0" cellpadding="0" cellspacing="0">
						 <tr><td valign="top">
							  <h2 class="table">A. Data Rumah Sakit</h2>
							  <table class="form" cellspacing="1" cellpadding="0">	
		<tr><td>No Form</td>
		<td class="input"><?=$row[noform]?></td></tr>
	<tr><td>No. Register RS</td>
		<td class="input"><input name="reg_rs" type="text" size="25" value="<?=$row[regrs]?>"></td></tr>
	<tr><td>Nama RS</td>
		<td class="input">
	<select name="nama_rs" >
		<?php $permintaan3="select * from rmhsakit";
		$do3=mysql_query($permintaan3);
		while($data3=mysql_fetch_assoc($do3)){
		if ($data3[Kode]==$row[rs]) $select='selected';
		?><option value="<?=$data3[Kode]?>"<?=$select?>><?=$data3[NamaRs]?></option>
		<? $select="";
		}?>
		</select></td>
		</tr>
	<tr><td>Medis(Bagian)</td>
		<td class="input">
		<select name="nama_bagian" >
		<?php
		$permintaan1="select * from bagian";
		$do1=mysql_query($permintaan1);
		while($data1=mysql_fetch_assoc($do1)){
		if ($data1[bagian]==$row[bagian]) $select='selected';?>
			<option value="<?=$data1[nama]?>"<?=$select?>><?=$data1[nama]?></option>
			<? $select="";
			}?></select></td></tr>
	<tr><td>Kelas</td>
		<td class="input"><input type=text name="nama_kelas" id="kelas" value="<?=$row[kelas]?>"></td></tr>
		<tr><td>Ruangan</td>
		<td class="input"><input type=text name="nama_ruangan" id="ruangan" value="<?=$row[ruangan]?>"></td></tr>
	<tr><td>Nama Dokter</td>
		<td class="input"><input type=text name="nama_dokter" id="dokter" value="<?=$row[namadokter]?>"></td></tr>
	<tr> <td>Diagnosa Klinis</td>
		<td class="input"><input name="diagnosa" type="text" size="30" value="<?=$row[diagnosa]?>"></td></tr>
	<tr> <td>Cara Bayar</td>
					
			
		<td class="input">
		<select name="jenis" >
		<?php $permintaan3="select * from jenis_layanan";
		$do3=mysql_query($permintaan3);
		while($data3=mysql_fetch_assoc($do3)){
		if ($data3[kode]==$row[jenis]) $select='selected';
		?><option value="<?=$data3[kode]?>"<?=$select?>><?=$data3[nama]?></option>
		<? $select="";
		}?>
		</select></td></td></tr>
		
	<tr><td>No. Reg. Pelayanan</td>
		<td class="input"><input name="noreglayanan" type="text" size="20" value="<?=$row[nojenis]?>"></td></tr>
	<tr><td>Jenis Permintaan</td>
		<td class="input">
		<? $sAminta='';$sBminta='';$sCminta='';$sDminta='';
		if ($row[jenis_permintaan]=='0') $sAminta='selected';
		if ($row[jenis_permintaan]=='1') $sBminta='selected';
		if ($row[jenis_permintaan]=='2') $sCminta='selected';
		if ($row[jenis_permintaan]=='3') $sDminta='selected';?>
		<select name="jnspermintaan">
		<option value="0" <?=$sAminta?>>Biasa</option>
		<option value="1" <?=$sBminta?>>Cadangan</option>
		<option value="2" <?=$sCminta?>>Siap Pakai</option>
		<option value="3" <?=$sDminta?>>Citto</option></select></td></tr>
<!--tr><td>Shift</td>
				<td class="styled-select" bgcolor="#ffa688">
					<? $s1='';$s2='';$s3='';$s4='';
						$waktu=date('H:i:s');
						$jam1=mysql_fetch_assoc(mysql_query("select * from shift where nama='I'"));
						$jam2=mysql_fetch_assoc(mysql_query("select * from shift where nama='II'"));	
						$jam3=mysql_fetch_assoc(mysql_query("select * from shift where nama='III'"));
						$jam4=mysql_fetch_assoc(mysql_query("select * from shift where nama='IV'"));
						
						$sh1=$jam1[jam]; $sh2=$jam2[jam]; $sh3=$jam3[jam];$sh4=$jam4[jam];
						if ($waktu >= $sh1 ){ $s1='selected';}
						if ($waktu >= $sh2 ){ $s2='selected';}
						if ($waktu >= $sh3 ){ $s3='selected';}
						if ($waktu < $sh1 ){ $s4='selected';}
					?>
					<select name="shift">
						<option value="1" <?=$s1?>>SHIFT I</option>
						<option value="2" <?=$s2?>>SHIFT II</option>
						<option value="3" <?=$s3?>>SHIFT III</option>
						<option value="4" <?=$s4?>>SHIFT IV</option>
						
					</select><---Harus Dipilih</td>  
			</tr-->
</table>
					 </td><td  valign="top">
	<h2 class="table">B. Data Pembayaran</h2>
	<table class="form" cellspacing="1" cellpadding="2">
	<tr><td>No. Form.</td><td class="input"><?=$row[notrans]?></td></tr>
	<tr><td>Jenis Biaya</td>
		<td class="input"><select name="kode_biaya" >
		<?php
		$permintaan="select * from biaya";
		$do=mysql_query($permintaan);
		while($data=mysql_fetch_assoc($do)){
	        if ($data[Kode]==$row[kodeBrg]) $select='selected';?>
		<option value="<?=$data[Kode]?>"<?=$select?>><?=$data[NamaBiaya]?></option><? $select="";}?></select></td></tr>
	<!--tr><td>Jenis Biaya Awal</font></td>
		<td class="input">
		<select name="kode_biaya" >
		<?php
		$permintaan="select * from biaya";
		$do=mysql_query($permintaan);
		$select="";
		while($data=mysql_fetch_assoc($do)){
		if ($data[NamaBiaya]==$row[namabrg]) $select='selected';?>
		<option value="<?=$data[NamaBiaya]?>"<?=$select?>><?=$data[Kode] ?>-<?=$data[NamaBiaya]?></option><?$select="";}?></select></td></tr-->
	<tr><td>Nominal Biaya</td>
									<td class="input">
		<select name="harga" >
		<?php
		$permintaan1="select * from biaya";
		$do1=mysql_query($permintaan1);
		$select="";
		while($data1=mysql_fetch_assoc($do1)){
		if ($data1[Harga]==$row[harga]) $select='selected';?>
		<option value="<?=$data1[Harga]?>"<?=$select?>><?=$data1[Harga]?></option><?$select="";}?></select></td></tr>
   
							</table>



							<input type="submit" value="Update" name="submit" class="swn_button_blue">
						</td>
					</tr>
				</table>
				<input type="hidden" value="1" name="periksa">
				<input type="hidden" value="<?=$row[noform]?>" name="noform">
				<input type="hidden" value="<?=$idminta?>" name="idminta">
				<input type="hidden" value="<?=$row[no_rm]?>" name="no_rm">
			</form><?
		}
	}?>
