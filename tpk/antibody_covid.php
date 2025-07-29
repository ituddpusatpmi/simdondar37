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
<script>
	$('.noEnterSubmit').keypress(functione){
    	if ( e.which == 13 ) return false;
	});
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
		
		$sql="INSERT INTO `covid`(`cov_trx`, `cov_kantong`, `cov_sampel`, `cov_tgl`, `cov_goldarah`, `cov_rhesus`, `cov_labperiksa`, `cov_titer`, `cov_hasil`, 
              `cov_namareagen`, `cov_pj_lab`, `cov_metode`, `cov_ket`, `user_input`)
              VALUES ('$v_trx','$v_nokantong','$v_nokantong','$v_tgl', '$v_goldarah', '$v_rhesus','$v_lab','$v_titer','$v_hasil',
              '$v_reagen','$v_pjlab','$v_metode','$v_ket','$namauser')";
		echo $sql.'<br>';
		$ins_cov=mysqli_query($dbi,$sql); 
		if ($ins_cov) {
			echo "<br>".$v_trx." - ".$v_nokantong." ".$v_goldarah.$v_rhesus.' -->SUKSES';
		}else{
			echo "<br>".$v_trx." - ".$v_nokantong." ".$v_goldarah.$v_rhesus.' -->ERROR';
		}
		//=======Audit Trail====================================================================================
		$log_mdl ='COVID-19';
		$log_aksi='Antibody Covid-19: '.$v_nokantong.', No: '.$v_trx. ', hasil:'.$v_hasil;
		include('user_log.php');
		//=====================================================================================================
	}
} 
    $today=date('Y:m:d')
    ?>
	<body onLoad=setFocus()>
	<div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Antibody Covid-19 Sampel Donor Plasma Konvalesen</div>
	<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
		<table cellpadding=1 cellspacing="0">
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th style="text-align:left;width:7cm;">Tanggal diperiksa</th>           <td style="text-align:left;"><input type="text" name="tgl_periksa" value ="<?php echo $today;?>" placeholder="yyyy-mm-dd" required style="width:5cm;"></td>
                <th style="text-align:left;width:7cm;">Nama Pemeriksaan/Reagen</th>     <td style="text-align:left;"><input type="text" name="reagen" required style="width:8cm;"></td>
            </tr>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th style="text-align:left;width:7cm;">Tempat diperiksa RS/Lab/Klinik/UTD</th>    <td style="text-align:left;"><input type="text" name="lab_periksa" value="<?php echo $namaudd;?>" required style="width:8cm;"></td>
                <th style="text-align:left;width:7cm;">Metode Pemeriksaan</th>    <td style="text-align:left;"><input type="text" name="metode" required style="width:8cm;"></td>
            </tr>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th style="text-align:left;width:7cm;">Penanggung Jawab Lab</th>    <td style="text-align:left;"><input type="text" name="pj_lab" required style="width:7cm;"></td>
                <th style="text-align:left;width:7cm;">Keterangan</th>    <td style="text-align:left;"><input type="text" name="ket" style="width:8cm;"></td>
            </tr>
	</table><br>
	<div style="font-family:Arial;font-size:20px;">Kode Sampel : <input type="text"  name="nokantong" id="nokantong" style="width:5cm;" placeholder="TPK20122900111" onkeydown="chang(event,this);" onchange="cari_kantong('samplecov');"></div>
		
	<br>
	<table id="samplecov" style="background-color:#FECCBF; font-size:14px; color:#000000; font-family:arial;border-collapse:collapse;" >
		<tr style="background-color:mistyrose; font-size:16px; color:#000000;height:40px;">
			<th>No</th>
			<th>Kode Sampel</th>
			<th>Gol & Rh Darah</th>
			<th>Nilai</th>
            <th>Interpretasi</th>
		</tr>			
	</table>
	<input name="simpan" type="submit" value="Simpan" class="swn_button_blue">
</form>
<div style="font-size: 10px;color: #000000">Update 2020-12-24</div>

<style>
    tr { background-color: #ffffff;}
    	.initial { background-color: #ffffff; color:#000000 }
    	.normal { background-color: #ffffff; }
    	.highlight { background-color: #7CFC00 }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid brown;
		font-family:Arial;
		font-size:14px;
		text-align:center;
	}
</style>
