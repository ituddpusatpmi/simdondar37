<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
<script language="javascript">
	function setFocus(){document.kantong.nokantong.focus();}
</script>
</head>
<?

require_once('config/dbi_connect.php');
require_once('clogin.php');
$namauser=$_SESSION['namauser'];
$lv0=$_SESSION['leveluser'];
$q_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu=$q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$namaudd=$q_udd['nama'];
$kodependonor=$_GET['kode'];

if (isset($_POST['simpan'])) { 
		$v_tgl		= $_POST['tgl'];
		$v_kodependonor=$_POST['pendonor'];
		$v_parameter= $_POST['pemeriksaan'];
		$v_lab		= $_POST['lab'];
		$v_pjab		= $_POST['pjlab'];
		$v_genrdrp	= $_POST['genrdrp'];
		$v_genN		= $_POST['genN'];
		$v_hasil	= $_POST['hasil'];
		$v_ket		= $_POST['ket'];
		// generate kode transaksi==========================================
		$k_today="N".date("dmy")."-";
		$idp	= mysqli_query($dbi,"select pcr_trx from covid_pcr where pcr_trx like '$k_today%'order by pcr_trx DESC limit 1");
		$idp1	= mysqli_fetch_assoc($idp);
		$idp2	= substr($idp1['pcr_trx'],8,3);
		if ($idp2<1) {
			$idp2="000";
		}
		$int_idp2=(int)$idp2+1;
		$j_nol1= 3-(strlen(strval($int_idp2)));
		$idp4='';
		for ($n=0; $n<$j_nol1; $n++){
			$idp4 .="0";
		}
		$v_notransaksi=$k_today.$idp4.$int_idp2;

		$pcrinsert=mysqli_query($dbi,"INSERT INTO `covid_pcr`
				(`pcr_trx`, `pcr_pendonor`, `pcr_tglperiksa`, `pcr_RdRp_gen`, `pcr_N_gen`,`pcr_labperiksa`,  `pcr_hasil`, `pcr_metode`, `pcr_pj_lab`, `pcr_ket`, `user_input`) 
		VALUES ('$v_notransaksi','$v_kodependonor','$v_tgl','$v_genrdrp','$v_genN','$v_lab','$v_hasil', '$v_parameter','$v_pjab','$v_ket','$namauser')");
		if($pcrinsert){
			echo 'Input Pemeriksaan hasil swab BERHASIL';
			//=======Audit Trail===================================================================================
			$log_mdl ='COVID-19';
			$log_aksi='Hasil Pemeriksaan Swab, Pendonor '.$v_kodependonor.', No: '.$v_notransaksi. ', hasil: '.$v_hasil;
			include('user_log.php');
			//=====================================================================================================
			echo "<meta http-equiv='refresh' content='0;url=pmikasir.php?module=swabrekap'>";
		}else{
			echo 'Input Pemeriksaan hasil swab GAGAL!!!';
			echo "<meta http-equiv='refresh' content='2;url=pmikasir.php?module=swabrekap'>";
		}
} 

	$today=date('Y-m-d');
	$qdnr=mysqli_fetch_assoc(mysqli_query($dbi,"SELECT `NoKTP`, `Pekerjaan`,`TempatLhr`, `jumDonor`, CONCAT_WS(',', `telp2`,`telp` ) AS `tlp`,`Kode`,`Nama`,`Alamat`, case when `Jk`='0' THEN 'Laki-laki' ELSE 'Perempuan' END AS Kelamin,`GolDarah`,`Rhesus`,DATE_FORMAT(TglLhr, '%d-%m-%Y') as tgllahir  FROM `pendonor` WHERE `Kode` = '$kodependonor'"));
    ?>
	<body onLoad=setFocus()>
    <div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Pengambilan Sample Donor</div>
	<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
		<table style="border:0px solid brown;" cellpadding="1" cellspacing="5">
			<tr>
				<td style="vertical-align: top;">
					<table cellpadding="10" cellspacing="1" style="border: 1px solid brown;" class="form bayangan">
						<tr><td colspan="2"><strong>DATA PENDONOR</strong></td></tr>
						<tr><td>Kode Pendonor</td>    <td class="input"><input type="hidden" name="pendonor" value="<?php echo $qdnr['Kode'];?>"><?php echo $qdnr['Kode'];?></tr>
						<tr><td>Nama</td><td class="input" style="white-space:nowrap;font-size:150%;"><?php echo $qdnr['Nama'];?></tr>
						<tr><td>Gol Darah</td><td class="input" style="white-space:nowrap;font-size:150%;"><?php echo $qdnr['GolDarah'].$qdnr['Rhesus'];?></td></tr>
						<tr><td>Lahir</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['TempatLhr'].', '.$qdnr['tgllahir'];?></td></tr>
						<tr><td>Kelamin</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['Kelamin'];?></td></tr>
						<tr><td>Telp</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['tlp'];?></td></tr>
						<tr><td>Alamat</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['Alamat'];?></td></tr>
						<tr><td>Donasi</td><td class="input" style="white-space:nowrap;"><?php echo $qdnr['jumDonor'].' Kali';?></td></tr>
					</table>
					
					
				</td>
				<td style="vertical-align: top;">
					<table cellpadding="4" cellspacing="1" style="border: 1px solid brown;" class="form bayangan">
						
						<tr>
							<td>Nama Pemeriksaan</td>    
							<td class="input"><input type="text" name="pemeriksaan" value="rRT-PCR SARS Cov-2" style="width:5cm;" required placeholder="rRT-PCR SARS Cov-2"></td>
						</tr>
						<tr>
							<td>Tanggal periksa</td>           
							<td class="input"><input type="text" name="tgl" id="datepicker" value ="<?php echo $today;?>" placeholder="yyyy-mm-dd" required style="width:2.5cm;"></td>
						</tr>
						<tr>
							<td>Tempat Periksa</td>    
							<td class="input"><input type="text" name="lab" required style="width:8cm;"></td>
						</tr>
						<tr>
							<td>Penanggung Jawab</td>    
							<td class="input"><input type="text" name="pjlab"  required style="width:8cm;"></td>
						</tr>
						<tr>
							<td>Gen RdRp SARS CoV-2</td>     
							<td class="input"><input type="text" name="genrdrp"  required style="width:5cm;"></td>
						</tr>
						<tr>
							<td>Gen N SARS CoV-2</td>    
							<td class="input"><input type="text" name="genN"  required  style="width:5cm;"></td>
						</tr>
						<tr>
							<td>Hasil Pemeriksaan</td>    
							<td class="input">
							<select name="hasil" style="width:5cm;">
								<option value="-">-</option>
								<option value="Positif">Positif</option>
								<option value="Negatif">Negatif</option>
							</select>
							</td>
						</tr>
						<tr>
							<td>Keterangan</td>    
							<td class="input"><input type="text" name="ket"  style="width:5cm;"></td>
						</tr>
					</table>
					<table style="border:0px solid brown;" cellpadding="1" cellspacing="5">
						<tr></td><input name="simpan" type="submit" value="Simpan" class="swn_button_blue">
						<div style="font-size: 10px;color: #000000">Update 2020-12-24</div>
						</td></tr>
					</table>
				
				</td>
			</tr>
        
</form>


<style>
	.bayangan {
		border:0.2px solid red;
		padding: 1px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
	}
</style>
