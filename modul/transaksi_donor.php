<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/instansi.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/disable_enter.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
    $('#rmhsakit').autocomplete({source:'modul/suggest_rs.php', minLength:2});
	});
</script>
<script>
	function disabletext(val){ // masih belum berfungsi
		if(val=='0'){
			document.getElementById('comments').disabled = true;
			document.getElementById('comments1').disabled = true;
			document.getElementById('comments2').disabled = true;}
		else {
			document.getElementById('comments').disabled = false;
			document.getElementById('comments1').disabled = false;
			document.getElementById('comments2').disabled = false;}
		}
</script>
<?php
include ('config/dbi_connect.php');
include ('clogin.php');
$q_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu=$q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
session_start();
$namaudd=$_SESSION['namaudd'];

//------------------------ set id transaksi ------------------------->
$udd1   = mysqli_query($dbi,"select id from utd where aktif='1'");
$udd    = mysqli_fetch_assoc($udd1);
$idp	= mysqli_query($dbi,"select * from tempat_donor where active='1'");
$idp1	= mysqli_fetch_assoc($idp);
$th		= substr(date("Y"),2,2);
$bl		= date("m");
$tgl	= date("d");
$kdtp	= substr($idp1['id1'],0,2).$tgl.$bl.$th."-".$udd['id']."-";
$idp	= mysqli_query($dbi,"select NoTrans from htransaksi where NoTrans like '$kdtp%' order by NoTrans DESC");
$idp1	= mysqli_fetch_assoc($idp);
$idp2	= substr($idp1['NoTrans'],14,4);
if ($idp2<1) {$idp2="0000";}
$idp3	= (int)$idp2+1;
$id31	= strlen($idp2)-strlen($idp3);
$idp4	= "";
for ($i=0; $i<$id31; $i++){
	$idp4 .="0";
}
$id_transaksi_baru=$kdtp.$idp4.$idp3;
//------------------------ END set id transaksi ------------------------->

$namauser 	= $_SESSION['namauser'];
$lv0		= $_SESSION['leveluser'];
$today1		= date("Y-m-d H:i:s");
$jam_donor	=date("H:i:s");
if (isset($_POST['submit'])){
	$id = $_POST['Kode'];
	$id1 = $_POST['Kode_lama'];
	$donor_aph='0';
	$donor_tpk='0';
	$jenis_donasi="Donor Biasa";
	$apheresisfix=$_POST['apheresis'];
	switch ($apheresisfix){
		case "0" : $donor_aph='0';$donor_tpk='0';$jenis_donasi="Donor Biasa";break;
		case "1" : $donor_aph='1';$donor_tpk='0';$jenis_donasi="Donor Apheresis";break;
		case "2" : $donor_aph='1';$donor_tpk='1';$jenis_donasi="Donor Plasma Konvalesen";break;
	}
	$status_antrian=1;
	$nopol="-";
	$tmpt=explode("-",$_POST['tempat']);
	if ($tmpt[0]=='1') $nopol=$tmpt[1];
	echo "Check $id";
	echo "Check $id1";
	$idtrans=substr($id_transaksi_baru,0,8);
	$instansifix=$_POST['instansi'];
	$shift=$_POST['shift'];
	$rs1=$_POST['rs'];
	$kendaraanfix=$_POST['kendaraan'];
	$kota=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
	$umur=mysqli_fetch_assoc(mysqli_query($dbi,"select * from pendonor where Kode='$id'"));
	if (strlen($_POST['instansi'])<=4){
		$b=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT nama FROM detailinstansi where KodeDetail='$_POST[instansi]'"));
		$instansifix=$b['nama'];
	}
	$check_p=mysqli_num_rows(mysqli_query($dbi,"select KodePendonor from htransaksi where NoTrans like '$idtrans%' and KodePendonor='$id'"));
	if ($check_p==0) {
		if ($umur['jumDonor']>0){$donorbaru='1';}else{$donorbaru='0';}
        $donorke = $umur['jumDonor']+1;
		$tambah=mysqli_query($dbi,"insert into htransaksi  (NoTrans,KodePendonor,KodePendonor_lama,Tgl,Pengambilan,ketBatal,tempat,Instansi,
				JenisDonor,id_permintaan,Status,Nopol,apheresis,donor_tpk,kendaraan,shift,kota,umur,jk,gol_darah,rhesus,pekerjaan,donorke,donorbaru,user,jam_mulai,rs) 
				value ('$id_transaksi_baru','$id','$id1','$today1','-','-','$tmpt[0]','$instansifix',
				'$_POST[JenisDonor]','$_POST[id_permintaan]','0','$nopol','$donor_aph', '$donor_tpk', '$kendaraanfix','$shift','$kota[id]','$umur[umur]','$umur[Jk]',
				'$umur[GolDarah]','$umur[Rhesus]','$umur[Pekerjaan]','$donorke', '$donorbaru','$namauser','$jam_donor','$rs1')");
		if ($tambah) {
			$idp=mysqli_query($dbi,"select * from tempat_donor where active='1'");
			$idp1=mysqli_fetch_assoc($idp);
			if (substr($idp1[id1],0,1)=="M") mysqli_query($dbi,"update htransaksi set mu='1' where NoTrans='$id_transaksi_baru'"); 
			$_POST['periksa']="";
			$check_i=mysqli_num_rows(mysqli_query($dbi,"select Kode from pendonor where Kode='$id' and instansi=''"));
			if ($check_i>=1) {			
				$updatedonor=mysqli_query($dbi,"UPDATE pendonor SET instansi='$instansifix' WHERE Kode='$id'");
			}
			$instansi=mysqli_query($dbi,"select instansi from pendonor where Kode='$id'");
			$instansi1=mysqli_fetch_assoc($instansi);
			if ($instansi1['instansi'] <> $instansifix){
				$updatedonor2=mysqli_query($dbi,"UPDATE pendonor SET instansi='$instansifix' WHERE Kode='$id'");
				$tglkembali=mysqli_query($dbi,"UPDATE pendonor SET tglkembali='$today1' WHERE Kode='$id'");
			}
			//=======Audit Trial====================================================================================
			$log_mdl ='REGISTRASI';
			$log_aksi='Registrasi: '.$id_transaksi_baru.' Donor: '.$id.' '.$jenis_donasi;
			include_once "user_log.php";
			//=====================================================================================================
			echo "Data Telah berhasil dimasukkan, isikan inform concent pendonor<br>";?>
			<META http-equiv="refresh" content="1; url=formulir_donor_PDF2.php?kp=<?=$id?>">
			
		<?php }
	}?>
	<META http-equiv="refresh" content="1; url=formulir_donor_PDF2.php?kp=<?=$id?>">
<?php };
$kode=$_GET['Kode'];
?>
<body onload=disabletext(0)>
	<div style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">FORMULIR ANTREAN DONOR DARAH</div>
	<form name="periksa" method="post" action="<?=$PHP_SELF?>">
		<?php
		$qp="select * from pendonor where Kode='$kode'";
		$check=mysqli_query($dbi,$qp);
		$check1=mysqli_fetch_assoc($check);
		$tempat=mysqli_query($dbi,"select * from tempat_donor where active='1'");
		$tempat1=mysqli_fetch_assoc($tempat);
		?>
		<table class="form" cellspacing="1" cellpadding="4" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
			<tr>
				<td>Kode</td>
				<td class="input"><input type=hidden name=Kode value="<?=$check1['Kode']?>"><?php echo $check1['Kode'];?></td>
			</tr>
			<tr>
				<td>Nama Pendonor</td>
				<td class="input" style="font-size:150%;font-weight:bold;">
					<?=$check1['Nama']?>
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td class="input">
					<?=$check1['Alamat']?>
				</td>
			<tr>
				<td>Golongan Darah</td>
				<td class="input" style="font-size:150%;font-weight:bold;"><?php echo $check1['GolDarah'].' Rh ('.$check1['Rhesus'].')';?>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamim</td>
				<?php 
				($check1['Jk']=='0')?$kelamin="Laki-laki":$kelamin="Perempuan";
				?>
				<td class="input"><?php echo $kelamin;?>
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<?php 
				($check1['Status']=='0')?$status="Belum menikah":$status="Sudah menikah";
				?>
				<td class="input"><?php echo $status;?>
				</td>
			</tr>
			<tr>
				<td>Tgl Kembali</td>
				<td class="input">Donor Biasa: <?php echo ' <b>'.$check1['tglkembali'].'</b>, Aph: <b>'.$check1['tglkembali_apheresis'].'</b>';?>
			</tr>
			<tr>
				<td>Jenis Pengambilan</td>
				<td class="input">
					<select name="apheresis">
						<?php
						$tgl_skr=date('Y-m-d');
						$jenis_pengambilan=$_GET['apheresis'];
						$tglkembali_biasa=$check1['tglkembali'];
						$tglkembali_aph=$check1['tglkembali_apheresis'];
						if (empty($tglkembali_aph)){$tglkembali_aph=$tgl_skr;}
						$sel1='';$sel2='';$sel3='';
						switch ($jenis_pengambilan){
							case '0' : $sel1='selected';break;
							case '1' : $sel2='selected';break;
							case '2' : $sel3='selected';break;
						}
						if ($tglkembali_aph<=$tgl_skr){
							echo '
								<option value="0"'.$sel1.'>Donor Biasa</option>
								<option value="1"'.$sel2.'>Donor Apheresis</option>
								<option value="2"'.$sel3.'>Donor Plasma Konvalesen</option>';
						}else{
							echo '
								<option value="0"'.$sel1.'>Donor Biasa</option>
                                <option value="1"'.$sel2.'>Donor Apheresis</option>
                                <option value="2"'.$sel3.'>Donor Plasma Konvalesen</option>';
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Tempat</td>
				<td class="input">
			<?php
			$mu1=mysqli_fetch_assoc(mysqli_query($dbi,"select * from tempat_donor where active='1'"));
			if (substr($mu1['id1'],0,1)=="M") {
				echo $mu1['tempat'];
				?>
				<input type="hidden" name="tempat" value="<?=$mu1['tempat']?>">
				</td>
				</tr>
				<tr>
					<td>Instansi</td>
					<td class="input">
						<?php
						$rs1=mysqli_fetch_assoc(mysqli_query($dbi,"select * from detailinstansi where aktif='1'"));
						echo $rs1['nama'];
						?>
						<input type="hidden" name="instansi" value="<?=$rs1['nama']?>">
					</td>
				</tr>
				<?php			
				$kendaraan1=mysqli_fetch_assoc(mysqli_query($dbi,"select k.kendaraan, d.KodeDetail,d.aktif from kegiatan as k, detailinstansi as d where k.kodeinstansi=d.KodeDetail and d.aktif='1'"));	
				if ($rs1['aktif'] =="1") $kendaraan2=$kendaraan1['kendaraan'];
					?>		
					<input type="hidden" name="kendaraan" value="<?=$kendaraan2?>">
				<?php
			} else { ?>
				<select name="tempat" onChange="dinstansi();">
				<?php
					$rs="select * from tempat_donor where id not like '1'";
					$do=mysqli_query($dbi,$rs);
					while($data=mysqli_fetch_assoc($do)){
						$select="";
						echo '<option value="'.$data['id'].'-'.$data['tempat'].'" '.$select.'>'.$data['tempat'].'</option>';
					}
					?>
				</select>
			</td>
				</td>
			<tr>
				<td>Instansi</td>
				<td class="input">
					<select name="instansi" id="instansi">
					<option></option>
					</select>
				</td>
				</td>
			</tr>
		<? } ?>
			<tr>
				<td>Jenis Donor</td>
				<td class="input">
					<select name="JenisDonor" onchange='disabletext(this.value);'>
						<option value="0" >Sukarela</option>
						<option value="1" >Pengganti</option>
						<option value="3" >Autologus</option>
					</select>
			<tr>
				<td>Nama Pasien/Noform permintaan</td>
				<td class="input">
					<input name="id_permintaan" type="text" size="20" id='comments1' placeholder="Nama Pasien/No Permintaan"></font>
				</td>
			</tr>
			<tr><td>Nama Rumah Sakit</td>
						<td class='input'>
							<select name="rs" id='comments2'>
								<?php
								$do1=mysqli_query($dbi,"SELECT Kode,NamaRS from rmhsakit order by NamaRS ASC");
								echo '<option>-</option>';
								while($rs=mysqli_fetch_assoc($do1)){
									echo '<option value="'.$rs['Kode'].'">'.$rs['NamaRS'].'</option>';
								}?>
							</select>
						</td>
					</tr>
			
			<tr><td class="form">Shift</td>
				<td class="input">
					<?php $s1='';$s2='';$s3='';$s4='';
						$waktu=date('H:i:s');
						$jam1=mysqli_fetch_assoc(mysqli_query($dbi,"select * from shift where nama='I'"));
						$jam2=mysqli_fetch_assoc(mysqli_query($dbi,"select * from shift where nama='II'"));	
						$jam3=mysqli_fetch_assoc(mysqli_query($dbi,"select * from shift where nama='III'"));
						$jam4=mysqli_fetch_assoc(mysqli_query($dbi,"select * from shift where nama='IV'"));
						
						$sh1=$jam1[jam]; $sh2=$jam2[jam]; $sh3=$jam3[jam];$sh4=$jam4[jam];
						if ($waktu >= $sh1 ){ $s1='selected';}
						if ($waktu >= $sh2 ){ $s2='selected';}
						if ($waktu >= $sh3 ){ $s3='selected';}
						if ($waktu < $sh1 ){ $s4='selected';}
					
		$td0=php_uname('n');
		$td0=strtoupper($td0);
		$td0=substr($td0,0,1);
		if ($td0!="M") { ?>
					<select name="shift">
						<option value="1" <?=$s1?>>SHIFT I</option>
						<option value="2" <?=$s2?>>SHIFT II</option>
						<option value="3" <?=$s3?>>SHIFT III</option>
						<option value="4" <?=$s4?>>SHIFT IV</option>
						
					</select>
		<?php } else {?>
		
			<select name="shift" >
				<option value="MU"   >Mobile Unit</option>
			</select>
			<?php }?>
				</td></tr>	
		</table>
<br>
<input type="submit" name="submit"  class="swn_button_blue" value="Lanjutkan ke Antrian Donor???" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
</form>
