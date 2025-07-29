<head>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript"></script>

</head>
<?php
if (isset($_POST[submit2])) {
	$kdl 		= mktime(0,0,0,date("m"),date("d")+35,date("Y"));
	$kembali1 	= mktime(0,0,0,date("m"),date("d")+14,date("Y"));
	$kembali2 	= mktime(0,0,0,date("m"),date("d")+75,date("Y"));
	$today 		= date('Y-m-d H:i:s');
	$kembali 	= date('Y-m-d',$kembali2);
	$kadaluwarsa	= date('Y-m-d H:i:s',$kdl);
	$keberhasilan0  = $_POST['keberhasilan_awal'];
	$keberhasilan 	= $_POST['keberhasilan'];	
	$volume_darah 	= $_POST['volume_darah'];
	$catatan 	= $_POST['catatan'];
	$reaksi 	= $_POST['reaksi'];
	$caraambil 	= $_POST['caraambil'];
	$notrans 	= $_POST['notrans'];
	$kodependonor	= $_POST['kodependonor'];
	$nomorkantong = $_POST['nomorkantong'];
	$tanggalaftap = $_POST['tanggalaftap'];
	$nokantong0=substr($nomorkantong,0,-1);
	$ambil=$_POST['ambil'];
	$selesai=$_POST['selesai'];
	$golda=$_POST['golda'];
	//interval AFTAP-----------
		$jama=$ambil;
		$jamb=$selesai;
		$test1=substr($jama,0,2);
		$test2=substr($jama,3,2);
		$test3=substr($jama,6);
		$test4=substr($jamb,0,2);
		$test5=substr($jamb,3,2);
		$test6=substr($jamb,6);
		$waktua=mktime($test1,$test2,$test3);
		$waktub=mktime($test4,$test5,$test6);
		$selisih=$waktub-$waktua;
		$sisa=$selisih % 86400;
		$jam=floor($sisa/3600);
		$sisa=$sisa%3600;
		$menit=floor($sisa/60);
	//END INTERVAL---------------
	
	if ($keberhasilan==0){ //berhasil
		// update transaksi
		$sql="UPDATE htransaksi SET diambil='$volume_darah', reaksi='$reaksi', pengambilan='$keberhasilan',catatan='$catatan', jam_ambil='$ambil',gol_darah='$golda', 
		jam_selesai='$selesai' WHERE (NoKantong='$nomorkantong' and NoTrans='$notrans')";
		$upd_transaksi=mysql_query($sql);
		//echo "$sql<br>";
		// update stok kantong
		$sql="UPDATE stokkantong SET Status='1', pengambilan='$menit',lama_pengambilan='$menit',gol_darah='$golda', kadaluwarsa='$kadaluwarsa' WHERE noKantong='$nomorkantong'";
		$upd_stokktg=mysql_query($sql);
		// update serah terima
		$sql = "UPDATE serahterima_detail SET dst_golda='$golda', dst_volambil='$volume_darah', dst_statuspengambilan='$keberhasilan' WHERE (dst_nokantong='$nomorkantong' and dst_notrans='$notrans')";
		$std = mysql_query($sql);
		// update serah terima tmp
		$sql = "UPDATE serahterima_detail_tmp SET dst_golda='$golda', dst_volambil='$volume_darah', dst_statuspengambilan='$keberhasilan' WHERE (dst_nokantong='$nomorkantong' and dst_notrans='$notrans')";
		//echo "$sql<br>";
		//=======Audit Trial====================================================================================
		$log_mdl ='Pengambilan';
		$log_aksi='Edit Pengambilan Berhasil: '.$nomorkantong.' - '.$kodependonor;
		include_once "user_log.php";

	}elseif ($keberhasilan==2){//gagal
		$sql="UPDATE htransaksi SET diambil='$volume_darah',reaksi='$reaksi', 
					pengambilan='$keberhasilan',catatan='$catatan',	status_test='2',Status='2' WHERE (NoTrans='$notrans')";
		$tambah=mysql_query($sql);
		//echo "$sql<br>";
		$sql="UPDATE stokkantong SET Status='5',hasil='5' WHERE noKantong='$nomorkantong'";
		$tambah2=mysql_query($sql);
		//echo "$sql<br>";
		//=======Audit Trial====================================================================================
		$log_mdl ='Pengambilan';
		$log_aksi='Edit Pengambilan gagal: '.$nomorkantong.' - '.$kodependonor;
		include_once "user_log.php";
	}elseif ($keberhasilan==1){//batal
		$sql="UPDATE stokkantong  SET Status = '0',	gol_darah ='',	RhesusDrh='', kodePendonor='', kodependonor_lama='',
				StatKonfirmasi='0',tgl_Aftap='0000-00-00', kadaluwarsa='0000-00-00', tglpengolahan='0000-00-00', tglperiksa='0000-00-00', mu=''
				WHERE noKantong='$nomorkantong'";
		$tambah2=mysql_query($sql);
		//echo "$sql<br>";
		$sql="UPDATE htransaksi SET NoKantong='', reaksi='',pengambilan='$keberhasilan',catatan='$catatan',status_test='2',Status='2' WHERE (NoTrans='$notrans')";
		$tambah=mysql_query($sql);
		//echo "$sql<br>";
		$sql="UPDATE pendonor SET tglkembali='$tanggalaftap',jumDonor=jumDonor-1, up=b'1',tglkembali_apheresis='$tanggalaftap'	WHERE Kode='$kodependonor'";
		$kembali1=mysql_query($sql);
		//echo "$sql<br>";
	}
	?><script language="javascript">alert("Perubahan pengambilan darah telah disimpan.");</script><?
}
?>
<body OnLoad="document.inputkantong.nokantong.focus();">
	
<font size="4" color="red" font-family="Arial">PERUBAHAN TRANSAKSI PENGAMBILAN DARAH</font><br>
<font size="2" color="black" font-family="Arial">Khusus transaksi donor GAGAL atau BERHASIL dan TANGGAL hari ini</font>
<form name="inputkantong" method="POST" action="<?=$PHPSELF?>">
	<table class="list" border="0" cellpadding="2" cellspacing="1" width="600px">
		<tr class="field">
			<td align="left">Masukkan nomor Kantong<input name="nokantong" type="text"><input name="submit" type="submit" value="OK" class="swn_button_blue"></td>
		</tr>
	</table>
</form>
<?php
require_once('config/db_connect.php');

if (isset($_POST[submit])) {
	$nokantong=$_POST['nokantong'];
	$nokantongA=substr($nokantong,0,-1).'A';
	$stokktg=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$nokantongA' and (Status='1' or Status='5') and date(tgl_Aftap)=current_date limit 1"));
	if (($stokktg['Status']=='1') or ($stokktg['Status']=='5')){
		$sql="select * from htransaksi where NoKantong='$nokantongA' and date(Tgl)=current_date";
		$transaksi=mysql_fetch_assoc(mysql_query($sql));
		if ($transaksi['NoKantong']=$nokantongA){
			$nodonor  = $transaksi['KodePendonor'];
			$donor    =mysql_fetch_assoc(mysql_query("select * from pendonor where Kode='$nodonor'"));
			switch ($transaksi['Pengambilan']){
				case '0' : $berhasil="Berhasil";break;
				case '1' : $berhasil="Batal";break;
				case '2' : $berhasil="Gagal";break;
			}
			switch ($transaksi['caraAmbil']){
				case '0' : $caraambil1="Biasa";break;
				case '1' : $caraambil1="Tromboferesis";break;
				case '2' : $caraambil1="Leukoferesis";break;
				case '3' : $caraambil1="Plasmaferesis";break;
				case '4' : $caraambil1="Eritroferesis";break;
				case '5' : $caraambil1="Plebotomi";break;
			}
			switch ($transaksi['tempat']){
				case '0' : $tempat="UDD";break;
				case '1' : $tempat="Mobile Unit belum ditransfer";break;
				case '2' : $tempat="Mobil Unit";break;
				case '3' : $tempat="Mobil Unit dalam gedung";break;
			}
			?>
		<form name="editdata" method="POST" action="<?=$PHPSELF?>">	
			<table class="list" border=0 cellpadding="2" cellspacing="1" width="600px">
				<tr class="record">
					<td align="left">Nomor Kantong</td>
					<td align="left"><b><?=$transaksi['NoKantong']?></b><input type="hidden" name="nomorkantong" value="<?=$transaksi['NoKantong']?>"></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Nomor Transaksi</td>
					<td align="left"><?=$transaksi['NoTrans']?><input type="hidden" name="notrans" value="<?=$transaksi['NoTrans']?>"></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Tanggal</td>
					<td align="left"><?=$transaksi['Tgl']?><input type="hidden" name="tanggalaftap" value="<?=$transaksi['Tgl']?>"></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Kode Donor</td>
					<td align="left"><?=$transaksi['KodePendonor']?><input type="hidden" name="kodependonor" value="<?=$transaksi['KodePendonor']?>"></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Nama Donor</td>
					<td align="left"><?=$donor['Nama']?></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Status Pengambilan</td>
					<td align="left"><?=$berhasil?><input type="hidden" name="keberhasilan_awal" value="<?=$$berhasil?>"</td>
					<td class="input" align="left">
						<script>
							function disabletext(val){
								if(val=='0'){
									document.getElementById('comments').disabled = true;
									}
								if(val=='2'){
									document.getElementById('comments').disabled = true;
								}
								if(val=='1'){
									document.getElementById('comments').disabled = false;
									}
							}
						</script>
						<input type='radio' name='keberhasilan' value='0' checked onclick='disabletext(this.value);'>Berhasil
						<input type='radio' name='keberhasilan' value='2' onclick='disabletext(this.value);'>Gagal
						<input type='radio' name='keberhasilan' value='1' onclick='disabletext(this.value);'>Batal &nbsp;<br>
						<input name='catatan' id='comments' placeholder="Keterangan"></input>&nbsp;
					</td>
				</tr>
				<tr class="record">
					<td align="left">Cara Ambil</td>
					<td align="left"><?=$caraambil1?><input type="hidden" name="caraambil1" value="<?=$caraambil1?>"></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Diambil sebanyak</td>
					<td align="left"><?=$transaksi['Diambil']?>cc</td>
					<td align="left"><input length="5" name="volume_darah" value="350">CC</td>
				</tr>
				<tr class="record">
					<td align="left">Reaksi Donor</td>
					<td align="left"><?=$transaksi['Reaksi']?></td>
					<td class="input" align="left">
						<select name="reaksi" >
							<option value="Mual">Mual</option>
							<option value="Pusing">Pusing</option>
							<option value="Pingsan">Pingsan</option>
							<option selected value="Normal">Tidak Ada Keluhan</option>
						</select>
					</td>
				</tr>
				<tr class="record">
					<td align="left">Petugas Aftap</td>
					<td align="left"><?=$transaksi['petugas']?></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Tempat Pengambilan</td>
					<td align="left"><?=$tempat?></td>
					<td></td>
				</tr>
				<tr class="record">
					<td align="left">Golongan Darah</td>
					<td align="left"><?=$transaksi['gol_darah']?></td>
					<td class="input" align="left" value="<?=$transaksi['gol_darah']?>">
						<select name="golda" >
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="O">O</option>
							<option value="AB">AB</option>
						</select>
					</td>
				</tr>
				<tr class="record">
					<td align="left">Jam Ambil</td>
					<td align="left"><?=$transaksi['jam_ambil']?></td>
					<td align="left"><input length="8" name="ambil" value="<?=$transaksi['jam_ambil']?>">
					</td>
				
				</tr>
				<tr class="record">
					<td align="left">Jam Selesai</td>
					<td align="left"><?=$transaksi['jam_selesai']?></td>
					<td align="left"><input length="8" name="selesai" value="<?=$transaksi['jam_selesai']?>"></td>
				</tr>
			</table>
			<?php
		} else{
			?><script language="javascript">alert("Nomor kantong yang anda masukkan tidak ada dalam transaksi pengambilan darah!!!???");</script><?}
	}else {
		?><script language="javascript">alert("Nomor kantong yang anda masukkan bukan status 1 (BARU ISI) atau 5 (GAGAL AFTAP) atau tidak ada, tidak bisa dilakukan perubahan pengambilan darah");</script><?
	}
}
if (isset($nodonor)) {
	?>
	<input name="submit2" class="swn_button_red" type="submit" value="Simpan">
	<?
} ?>
</form>
</body>
