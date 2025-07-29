<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>
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
$today=date('Y-m-d');
$namalab=$namaudd;

if (isset($_POST['simpan'])) { 
		// generate kode transaksi==========================================
		$k_today="N".date("dmy")."-";
		$idp	= mysqli_query($dbi,"select dl_trx from hematologi where dl_trx like '$k_today%'order by dl_trx DESC limit 1");
		$idp1	= mysqli_fetch_assoc($idp);
		$idp2	= substr($idp1['dl_trx'],8,3);
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

		$v_tgl		= $_POST['tgl'];
		$v_tempat	= $_POST['lab'];
		$v_pj		= $_POST['pj'];
		$v_sample	= $_POST['sample'];
		$v_hb		= $_POST['hb'];
		$v_plt		= $_POST['plt'];
		$v_hct		= $_POST['hct'];
		$v_leu		= $_POST['leu'];
        $v_vol      = $_POST['vol'];
        $v_hasil    = $_POST['hasil'];
		$qinst="INSERT INTO `hematologi`(`dl_trx`, `dl_kantong`, `dl_sampel`, `dl_tgl`,`dl_labperiksa`, `dl_pj_lab`, `dl_hb`, `dl_hct`, `dl_plt`, `dl_leu`, `user_input`,`dl_hasil`)
						VALUES ('$v_notransaksi', '$v_sample', '$v_sample', '$v_tgl', '$v_tempat', '$v_pj', '$v_hb', '$v_hct', '$v_plt', '$v_leu', '$namauser','$v_hasil')";
		$inst=mysqli_query($dbi,$qinst);
		if ($inst){
			$log_mdl ='HEMATOLOGI';
            $log_aksi='Pemeriksaan Darah Lengkap Sample/Kantong : '.$v_sample.', No: '.$v_notransaksi. ', HB:'.$v_hb.', PLT:'.$v_plt.', HCT:'.$v_hct.', LEUKO:'.$v_leu.' Hasil :'.$v_hasil;
			include('user_log.php');
			echo 'Data pemeriksaan sample '.$v_sample.' sudah berhasil disimpan<br>';
		} else{
			echo 'GAGAL, dalam penyimpanan hasil<br>';
		}

} 
	
    ?>
	<body>
    	<div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Pemeriksaan HEMATOLOGI</div>
		<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
        	<table class="bayangan" style="background-color:#FECCBF; font-size:14px; color:#000000; font-family:arial;border-collapse:collapse;min-width:500px;" border="1">
				<tr><th> Tanggal periksa</th><td class="input"><input type="text" name="tgl" id="datepicker" value ="<?php echo $today;?>" placeholder="yyyy-mm-dd" required style="width:5cm;"></td></tr>
				<tr><th> Tempat RS/Lab/Klinik/UTD</th>    <td class="input"><input type="text" name="lab" value="<?php echo $namalab;?>" required style="width:8cm;"></td></tr>
				<tr><th> Penanggung Jawab</th>    <td class="input"><input type="text" name="pj" required style="width:8cm;"></td></tr>
				<tr><th> Kode Sample</th><td class="input"><input type="text"  name="sample" id="sample" style="width:5cm;" placeholder="TPK20122900111" required></td></tr>
            
				<tr><th> Hemoglobin</th><td><input type="text"  name="hb" style="width:3cm;" autocomplete="off" required></td></tr>
				<tr><th> Hematokrit</th><td><input type="text"  name="hct" style="width:3cm;" autocomplete="off" required></td></tr>
				<tr><th> Trombosit</th><td><input type="text"  name="plt" style="width:3cm;" autocomplete="off" required></td></tr>
				<tr><th> Leukosit</th><td><input type="text"  name="leu" style="width:3cm;" autocomplete="off" required></td></tr>
                <tr><th> Hasil</th><td><select name="hasil" id="hasil" required>
                  <option value="">Pilih</option>
                  <option value="0">Tidak Lulus</option>
                  <option value="1">Lulus</option>
                  <option value="2">Cek Ulang</option>
                </select></td></tr>
			</table>
			<input name="simpan" type="submit" value="Simpan" class="swn_button_blue">
			<a href="pmikonfirmasi.php?module=hematologir" class="swn_button_blue">Rekap Pemeriksaan</a>
		</form>
	</body>

<style>
	.bayangan {
		border:0.2px solid red;
		padding: 1px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
	}
	tr {
		background-color:mistyrose; 
		font-size:16px; color:#000000;
		height:40px;
		text-align:left;
	}
</style>
