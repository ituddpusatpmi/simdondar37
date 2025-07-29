<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/cov_sample.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
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

if (isset($_POST['simpan'])) { 
	// generate kode transaksi==========================================
	$k_today="C".date("dmy")."-";
	$idp	= mysqli_fetch_assoc(mysqli_query($dbi,"select `cov_trx` from `covid` where `cov_trx` like '$k_today%'order by `cov_trx` DESC limit 1"));
	$idp2	= substr($idp['cov_trx'],8,3);
	if ($idp2<1) {$idp2="000";}
	$int_idp2=(int)$idp2+1;
	$j_nol1= 3-(strlen(strval($int_idp2)));
	$idp4='';
	for ($n=0; $n<$j_nol1; $n++){$idp4 .="0";}
	$v_trx=$k_today.$idp4.$int_idp2;

	for ($i=0; $i<sizeof($_POST['nokantong']); $i++) { 
        $v_tgl      = $_POST['tgl_periksa'];
        $v_reagen   = $_POST['reagen'];
        $v_lab      = $_POST['lab_periksa'];
        $v_metode   = $_POST['metode'];
        $v_pjlab    = $_POST['pj_lab'];
        $v_ket      = $_POST['ket'];
        $v_nokantong= $_POST['nokantong'][$i];
        $v_goldarah = $_POST['gol_donor'][$i];
        $v_rhesus   = $_POST['rh_donor'][$i];
        $v_titer    = $_POST['titer'][$i];
        $v_hasil    = $_POST['hasil'][$i];
        $v_vol    = $_POST['vol'][$i];
	
		$sql="INSERT INTO `covid`(`cov_trx`, `cov_kantong`, `cov_sampel`, `cov_tgl`, `cov_goldarah`, `cov_rhesus`, `cov_labperiksa`, `cov_titer`, `cov_hasil`, 
              `cov_namareagen`, `cov_pj_lab`, `cov_metode`, `cov_ket`, `user_input`,`cov_vol`)
              VALUES ('$v_trx','$v_nokantong','$v_nokantong','$v_tgl', '$v_goldarah', '$v_rhesus','$v_lab','$v_titer','$v_hasil',
              '$v_reagen','$v_pjlab','$v_metode','$v_ket','$namauser','$v_vol')";
		//echo $sql.'<br>';
		if (!empty($v_nokantong) and (!empty($v_titer)) ){
			$ins_cov=mysqli_query($dbi,$sql); 
			if ($ins_cov) {
				echo "<br>".$v_trx." - ".$v_nokantong." ".$v_goldarah.$v_rhesus.' -->SUKSES';
			}else{
				echo "<br>".$v_trx." - ".$v_nokantong." ".$v_goldarah.$v_rhesus.' -->ERROR';
			}
			//=======Audit Trail====================================================================================
			$log_mdl ='COVID-19';
			$log_aksi='Antibody Covid-19: '.$v_kantong.', No: '.$v_trx. ', hasil: '.$v_hasil.' titer:'.$v_titer;
			include('user_log.php');
			//=====================================================================================================
            echo '<META http-equiv="refresh" content="2; url=pmi'.$lv0.'.php?module=rekapcovid">';
		}
	}
} 
    $today=date('Y:m:d')
    ?>
	<body onLoad=setFocus()>
    <div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Titer Antibody Covid-19 Calon Donor Plasma Konvalesen</div>
	<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
		<table style="border:0px solid brown;" cellpadding="1" cellspacing="5">
			<tr>
				<td style="vertical-align: top;">
					<table cellpadding="4" cellspacing="1" style="border: 1px solid brown;" class="form bayangan">
						<tr><td>Tanggal diperiksa</td>           <td class="input"><input type="text" name="tgl_periksa" value ="<?php echo $today;?>" placeholder="yyyy-mm-dd" required style="width:5cm;"></td></tr>
						<tr><td>Tempat diperiksa RS/Lab/Klinik/UTD</td>    <td class="input"><input type="text" name="lab_periksa" value="<?php echo $namaudd;?>" required style="width:8cm;"></td></tr>
						<tr><td>Penanggung Jawab Lab</td>    <td class="input"><input type="text" name="pj_lab" required style="width:7cm;"></td></tr>
						<tr><td>Nama Pemeriksaan/Reagen</td>     <td class="input"><input type="text" name="reagen" required style="width:8cm;"></td></tr>
						<tr><td>Metode Pemeriksaan</th>    <td class="input"><input type="text" name="metode" required style="width:8cm;"></td></tr>
						<tr><td>Keterangan</th>    <td class="input"><input type="text" name="ket" style="width:8cm;"></td></tr>
					</table>
					<table style="border:0px solid brown;" cellpadding="1" cellspacing="5">
					<tr></td>
					<br>
						<input name="simpan" type="submit" value="Simpan" class="swn_button_blue"><a href="pmi<?php echo $lv0;?>.php?module=rekapcovid" class="swn_button_blue">Rekap Pemeriksaan Covid-19</a>
						<div style="font-size: 10px;color: #000000">Update 2020-12-24</div>
					</td></tr>
					</table>
				</td>
				<td style="vertical-align: top;">
					<table cellpadding="4" cellspacing="1" style="border: 1px solid brown;" class="form bayangan">
						<tr>
							<td class="input">
								<div style="font-family:Arial;font-size:18px;">Kode Sampel  <input type="text"  name="nokantong" id="nokantong" style="width:5cm;" placeholder="TPK20122900111" onkeydown="chang(event,this);" onchange="cari_kantong('samplecov');"></div>
							</td>
						</tr>
					</table>
					<br>
					<table id="samplecov" class="bayangan" style="background-color:#FECCBF; font-size:14px; color:#000000; font-family:arial;border-collapse:collapse;min-width:500px;" border="1">
						<tr style="background-color:mistyrose; font-size:16px; color:#000000;height:40px;">
							<th>No</th>
							<th>Kode Sampel</th>
                            <th>Vol. Sampel</th>
							<th>Gol & Rh Darah</th>
							<th>Nilai</th>
							<th>Kesimpulan</th>
						</tr>			
					</table>
				<td>
		</tr>
	</table>
	
</form>


<style>
	.bayangan {
		border:0.2px solid red;
		padding: 1px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
	}
</style>
