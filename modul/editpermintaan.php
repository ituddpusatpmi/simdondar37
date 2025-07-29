<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
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
	 $alasan	= $_POST["alasan"];
	 $hb   		= $_POST["hb"];
	 $pernahtransfusi   		= $_POST["pernahtransfusi"];
	 $kapan  	= $_POST["kapan"];
	 $reaksitransfusi   		= $_POST["reaksitransfusi"];
	 $gejala   	= $_POST["gejala"];
	 $jnspermintaan = $_POST["jnspermintaan"];
	 $ket   	= $_POST["ket"];
	 $abortus   	= $_POST["abortus"];
	 $jmlkehamilan  = $_POST["jmlkehamilan"];
	 $jenis_darah	= $_POST["jenis_darah"];
	 $goldarah   	= $_POST["goldarah"];
	 $rhesus  	= $_POST["rhesus"];
	 $jmlper   	= $_POST["jumlah"];
	 $volume   	= $_POST["volume"];
	 $stattitip	= $_POST["stattitip"];
	 $keterangandrh	= $_POST["keterangandrh"];
	 $tgl_diperlukan = $_POST["tgl_diperlukan"];
	 $tempat   	= $_POST["tempat"];
	 $sahper   	= $_POST["sahper"];
	 $shift   	= $_POST["shift"];
	 $mintaid	= $_POST["idminta"];
	 $namauser 	= $_SESSION[namauser];
	 $sekarang	= date("Y-m-d h:m:s");
	
	 $tambah=mysql_query("UPDATE htranspermintaan SET 
		 bagian='$nama_bagian',kelas='$nama_kelas',namadokter='$nama_dokter',diagnosa='$diagnosa', tglminta='$tgl_diperlukan',
		 alasan='$alasan',hb='$hb',jenis='$jenis',stat='0',
		 rs='$nama_rs',regrs='$reg_rs',shift='$shift',tempat='$tempat',nojenis='$noreglayanan',petugas='$sahper',ruangan='$nama_ruangan',
		 pernah_transfusi='$pernahtransfusi',kapan='$kapan',jenis_permintaan='$jnspermintaan',reaksi_transfusi='$reaksitransfusi',
		 gejala='$gejala',jml_kehamilan='$jmlkehamilan',abortus='$abortus',ket='$ket'
		 WHERE noform='$noform'");
	 $tambahlagi=mysql_query("UPDATE dtranspermintaan SET 		
				 JenisDarah='$jenis_darah',GolDarah='$goldarah',Rhesus='$rhesus',Jumlah='$jmlper',Jtitip='$stattitip',cc='$volume',
				 Ket='$keterangandrh',TglPerlu='$tgl_diperlukan',
				 tempat='$tempat',no_rm='$no_rm'
				 WHERE ID='$_GET[ID]' ");
	if ($tambah) {
		  echo "Data Telah berhasil di-Update <br> ";
		  switch ($lv0){
			   case "kasir2":?><META http-equiv="refresh" content="0; url=pmikasir2.php?module=searchpasien"><?
			   default:echo "$lv0 ANDA tidak memiliki hak akses";
		  }
	 }
	 $_POST['periksa']="";
}
if (isset($_GET[ID])) {
	 $sql="SELECT a.*,b.* FROM dtranspermintaan a INNER JOIN htranspermintaan b ON a.NoForm=b.noform WHERE a.ID='$_GET[ID]'";
	 $perintah=mysql_query($sql);
	 $nrow=0;
	 if ($perintah) {
		  $nrow=mysql_num_rows($perintah);
		  $row=mysql_fetch_assoc($perintah);
		  $idminta=$_GET[id];
	 }
	 if ($row<1){
		  echo "No Form yang anda masukkan belum terdaftar";
		  ?> <META http-equiv="refresh" content="2; url=pmikasir.php?module=searchpasien">
		  <?
	 } else {?>


   <?
   $r=mysql_fetch_assoc(mysql_query("SELECT * FROM dtranspermintaan WHERE ID='$_GET[ID]'"));
   $p=mysql_fetch_assoc(mysql_query("select * from pasien where no_rm='$r[no_rm]'"));
   ?>
   	<h1 class="table">DATA PASIEN</h1>
    	<h1 class="table">NO RM : <?=$p[no_rm]?> , Nama : <?=$p[nama]?> , Gol & Rh Darah   : <?=$p[gol_darah]?> (<?=$p[rhesus]?>)</h1>
	<br>

		  <form name="reg" autocomplete="off" method="post" action="<?=$PHPSELF?>"> 
			   <h1 class="table">FORM EDIT PERMINTAAN DARAH</h1>
					<table border="0" cellpadding="0" cellspacing="0">
						 <tr><td valign="top">
							  <h2 class="table">A. Data Rumah Sakit</h2>
							  <table class="form" cellspacing="1" cellpadding="0">	
	<tr><td>No Form</td>
		<td class="input"><?=$row[noform]?></td>
		<td>Alasan Transfusi</td><td class="input"><input name="alasan" type="text" size="15" value="<?=$row[alasan]?>"></td>
	</tr>
		
	<tr><td>No. Register RS</td>
		<td class="input"><input name="reg_rs" type="text" size="25" value="<?=$row[regrs]?>"></td>
		<td>Jumlah HB</td><td class="input"><input name="hb" type="text" size="5" value="<?=$row[hb]?>">gr/dl</td>	
	</tr>
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
		</select>
		</td>
		<td>Pernah Transfusi</td><td class="input">
		<?
		$sApernah='';$sBpernah='';
		if ($row[pernah_transfusi]=='0') $sApernah='selected';
		if ($row[pernah_transfusi]=='1') $sBpernah='selected';
		?><select name="pernahtransfusi">
		<option value="0" <?=$sApernah?>>Tidak</option>
		<option value="1" <?=$sBpernah?>>Ya</option>
		</select>
		Kapan<input name="kapan" type="text" size="5" value="<?=$row[kapan]?>">
		</td>
	</tr>
	<tr><td>Medis(Bagian)</td>
		<td class="input">
		<select name="nama_bagian" >
		<?php
		$permintaan1="select * from bagian";
		$do1=mysql_query($permintaan1);
		while($data1=mysql_fetch_assoc($do1)){
		if ($data1[nama]==$row[bagian]) $select='selected';?>
		<option value="<?=$data1[nama]?>"<?=$select?>><?=$data1[nama]?></option>
		<? $select="";
		}?></select>
		</td>
	<td>Reaksi Transfusi</td>
		<td class="input"><?
		$sAreaksi='';$sBreaksi='';
		if ($row[reaksi_transfusi]=='0') $sAreaksi='selected';
		if ($row[reaksi_transfusi]=='1') $sBreaksi='selected';?>
		<select name="reaksitransfusi">
		<option value="0" <?=$sAreaksi?>>Tidak</option>
		<option value="1" <?=$sBreaksi?>>Ya</option>
		</select>
		Gejala<input name="gejala" type="text" size="10" value="<?=$row[gejala]?>">
		</td>

	</tr>
	<tr><td>Kelas</td>
		<td class="input"><input type=text name="nama_kelas" id="kelas" value="<?=$row[kelas]?>"></td>
	<td>Jenis Permintaan</td>
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
		<option value="3" <?=$sDminta?>>Citto</option></select></td>
	</tr>
	<tr><td>Ruangan</td>
		<td class="input"><input type=text name="nama_ruangan" id="ruangan" value="<?=$row[ruangan]?>"></td>
	    <td>Keterangan</td><td class="input"><input name="ket" type="text" size="15" value="<?=$row[ket]?>"></td>
	</tr>

	<tr><td>Nama Dokter</td><td class="input"><input type=text name="nama_dokter" id="dokter" value="<?=$row[namadokter]?>"></td>
		<td class="input" colspan="2" align="center">Khusus Pasien Wanita</td>	
	</tr>
	<tr> <td>Diagnosa Klinis</td>
		<td class="input"><input name="diagnosa" type="text" size="30" value="<?=$row[diagnosa]?>"></td>
	<td>Pernah Abortus</td>
		<td class="input"><?
		$sAbortus='';$sBbortus='';
		if ($row[abortus]=='0') $sAbortus='selected';
		if ($row[abortus]=='1') $sBbortus='selected';?>
		<select name="abortus">
		<option value="0" <?=$sAbortus?>>Tidak</option>
		<option value="1" <?=$sBbortus?>>Ya</option></select></td>
	</tr>
	<tr>

		 <td>Cara Bayar</td>
					
					<td class="input">
		<select name="jenis" >
		<?php $permintaan3="select * from jenis_layanan";
		$do3=mysql_query($permintaan3);
		while($data3=mysql_fetch_assoc($do3)){
		if ($data3[kode]==$row[jenis]) $select='selected';
		?><option value="<?=$data3[kode]?>"<?=$select?>><?=$data3[nama]?></option>
		<? $select="";
		}?>
		</select></td></td>

<!--
		<td>Jenis Darah</font></td>
			<td><select name="jenis1" >
		<?php $permintaan3="select * from jenis_layanan";
		$do3=mysql_query($permintaan3);
		while($data3=mysql_fetch_assoc($do3)){
		if ($data3[jenis]==$row[nama]) $select='selected';
		?><option value="<?=$data3[kode]?>"<?=$select?>><?=$data3[nama]?></option>
		<? $select="";
		}?>
		</select></td--></tr>

		<!--td>Cara Bayar</td>
		<td class="input"><select name="jenis" >
		<?php
		$permintaan2="select * from jenis_layanan";
		$do2=mysql_query($permintaan2);
		while($data2=mysql_fetch_assoc($do2)){
	        if ($data2[nama]==$row[jenis]) $select='selected';?>
		<option value="<?=$data2[kode]?>"<?=$select?>><?=$data2[nama]?></option><? $select="";}?></select></td-->

	<td>Jumlah Kehamilan</td>
		<td class="input"><input name="jmlkehamilan" type="text" size="10" value="<?=$row[jml_kehamilan]?>"></td>
		
	</tr>
									<tr><td>No. Reg. Pelayanan</td>
										<td class="input"><input name="noreglayanan" type="text" size="20" value="<?=$row[nojenis]?>"></td>
									</tr>

</table>
						
						 </td><td  valign="top">
							<h2 class="table">B. Data Darah Diminta</h2>
							<table class="form" cellspacing="1" cellpadding="2">
							<tr><td>No.Trans.</td><td class="input"><?=$row[ID]?></td></tr>
								<tr><td>Jenis Darah</font></td>
									<td class="input">
										<select name="jenis_darah" >
										<?php
										$permintaan="select * from produk";
										$do=mysql_query($permintaan);
										$select="";
										while($data=mysql_fetch_assoc($do)){
											if ($data[Nama]==$row[JenisDarah]) $select='selected';?>
											<option value="<?=$data[Nama]?>"<?=$select?>><?=$data[Nama]?></option><?
											$select="";
										}?>
										</select></td>
								</tr>
								<tr><td>Golongan Darah</td>
									<td class="input">
										<? $sA='';$sB='';$sAB='';$sO='';
										if ($row[GolDarah]=='A') $sA='selected';
										if ($row[GolDarah]=='B') $sB='selected';
										if ($row[GolDarah]=='AB') $sAB='selected';
										if ($row[GolDarah]=='O') $sO='selected';
										?>
										<select name="goldarah">
											<option value="A" <?=$sA?>>A</option>
											<option value="B" <?=$sB?>>B</option>
											<option value="AB" <?=$sAB?>>AB</option>
											<option value="O" <?=$sO?>>O</option>
										</select></td>
								</tr>
								<tr><td>Rhesus</td>
									<td class="input">
									<? $rn='';$rp='';
									if ($row[Rhesus]=='-') $rn='selected';
									if ($row[Rhesus]=='+') $rp='selected';?>
									<select name="rhesus">
										<option value="+" <?=$rp?>>(+)</option>
										<option value="-" <?=$rn?>>(-)</option>
									</select></td></tr>
								<tr><td>Jumlah Kantong</td>
									<td class="input"> <input name="jumlah" type="text" size="4" value="<?=$row[Jumlah]?>">kantong</td>
								</tr>
								<tr><td>Volume</td>
									<td class="input"><input name="volume" type="text" size="4" value="<?=$row[cc]?>">cc</td></tr>
								<tr><td>Titip</td>
									<td class="input"><input name="stattitip" type="text" size="4" value="<?=$row[JTitip]?>">kantong</td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td class="input"><input name="keterangandrh" type="text" size="20" value="<?=$row[Ket]?>"></td>
								</tr>
								<tr>
									<td>Tgl Diperlukan</td>
									<td class="input"><input type="text" name="tgl_diperlukan" id="butuh" value='<?=$row[tglminta]?>'size=12></td>
								</tr>
								<tr><td>Tempat Permintaan</td>
									<td class="input"><?
										$sAtempat='';$sBtempat='';
										if ($row[tempat]=='UDD') $sAtempat='selected';
										if ($row[tempat]=='BDRS') $sBtempat='selected';?>
										<select name="tempat">
											<option value="UDD" <?=$sAtempat?>>UDD</option>
											<option value="BDRS" <?=$sBtempat?>>BDRS</option>
										</select></td>
								</tr>
								<tr><td>Dicatat Oleh</td>
									<td class="input"><select name="sahper" > <?
											$user1="select * from user WHERE id_user <> 'ADMIN' order by nama_lengkap ASC";
											$do1=mysql_query($user1);
											while($data1=mysql_fetch_assoc($do1)) {
												if ($data1[id_user]==$row[petugas]) $select='selected';?>
												<option value="<?=$data1[id_user]?>"<?=$select?>><?=$data1[nama_lengkap]?></option><?
												$select="";
											}?></select></td>
								</tr>
								<tr><td>Shift</td>
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
						
					</select></td>  
			</tr>
							</table>



							<input type="submit" value="Update" name="submit">
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
