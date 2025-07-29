<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/kgd_sample.js" type="text/javascript"> </script>
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
include('clogin.php');
include('config/dbi_connect.php');
session_start();
$namauser=$_SESSION['namauser'];
$q_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu=$q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$today3=date('Y-m-d H:i:s');
if (isset($_POST['simpan'])) { 
	// generate kode konfirmasi==========================================
	$k_today="K".date("dmy")."-";
	$idp	= mysqli_query($dbi,"select NoKonfirmasi from dkonfirmasi where NoKonfirmasi like '$k_today%'order by NoKonfirmasi DESC limit 1");
	$idp1	= mysqli_fetch_assoc($idp);
	$idp2	= substr($idp1['NoKonfirmasi'],8,3);
	if ($idp2<1) {
		$idp2="000";
	}
	$int_idp2=(int)$idp2+1;
	$j_nol1= 3-(strlen(strval($int_idp2)));
	$idp4='';
	for ($n=0; $n<$j_nol1; $n++){
		$idp4 .="0";
	}
	$no_konfirmasi=$k_today.$idp4.$int_idp2;
	for ($i=0; $i<sizeof($_POST['goldarah']); $i++) { 
		$kode=$_POST['kodep'][$i];
		$goldarah=$_POST['goldarah'][$i]; 		
		$rhesus=$_POST['rhesus'][$i]; 		
		$nkt=$_POST['nokantong'][$i];
		$goldarahasal=$_POST['gol_donor'][$i];
		$rhesusasal=$_POST['rh_donor'][$i];
		$metode=$_POST['metode'];
		$sel=$_POST['sel'][$i];
		$antiA=$_POST['antia'][$i];
		$antiB=$_POST['antib'][$i];
		$antiO=$_POST['antio'][$i];
		$serum=$_POST['serum'][$i];
		$tA=$_POST['ta'][$i];
		$tB=$_POST['tb'][$i];
		$ac=$_POST['ac'][$i];
		$ba=$_POST['ba'][$i];
		$ser=$_POST['anti'][$i];
		$antiD=$_POST['antid'][$i];
		
		$stcocok="";
		if (($goldarahasal==$goldarah) and ($rhesusasal==$rhesus)){
			$Cocok=0;$stcocok="Cocok";
		}else{
			$Cocok=1;$stcocok="Tidak Cocok";
		}
		$sql="insert into dkonfirmasi ( NoKonfirmasi, idsample,NoKantong,GolDarah,Rhesus,ket,tgl,petugas,Cocok,goldarah_asal,
			rhesus_asal,metode,sel,antiA,antiB,antiO,serum,tA,tB,`tsO`,`antiD`,`ac`,`ba`,`nolot_aa`,`expa`,`nolot_ab`,`expb`,`nolot_ad`,`expd`)
			value ('$no_konfirmasi','$nkt','$nkt','$goldarah','$rhesus','$_POST[ket]','$today3','$namauser','$Cocok','$goldarahasal',
			'$rhesusasal','$metode','0','$antiA','$antiB','-','0','$tA','$tB','$ser','$antiD','$ac','$ba','$_POST[nolota]','$_POST[expa]','$_POST[nolotb]','$_POST[expb]','$_POST[nolotd]','$_POST[expd]')";
        $sqlup=mysqli_query($dbi,"UPDATE samplekode set sk_gol='$goldarah', sk_rh='$rhesus' where sk_kode='$nkt'");
        $sqldonor  = "UPDATE pendonor set GolDarah='$goldarah', Rhesus='$rhesus' where Kode='$kode'";
        $sqlup2 = mysqli_query($dbi,$sqldonor);
		//echo $sqldonor.'<br>';
		$tambah2=mysqli_query($dbi,$sql); 
		if ($tambah2) {
			echo "<br>".$no_konfirmasi." - ".$nkt." ".$goldarahasal.$rhesusasal." ".$goldarah.$rhesus." Status: ".$stcocok.' -->INSERT OK';
		}else{
			echo "<br>".$no_konfirmasi." - ".$nkt." ".$goldarahasal.$rhesusasal." ".$goldarah.$rhesus." Status: ".$stcocok.' --> INSERT ERROR';
		}
		//=======Audit Trail====================================================================================
		$log_mdl ='KONFIRMASI';
		$log_aksi='KGD Sampel: '.$nkt.', No: '.$no_konfirmasi. ' Gol. Awal: '.$goldarahasal.$rhesusasal.', Hasil: '.$goldarah.$rhesus.' Ket: '.$stcocok;
		include('user_log.php');
		//=====================================================================================================
	}
} ?>
	<body onLoad=setFocus()>
	<div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Konfirmasi Golongan Darah Sampel<br>Apheresis & Plasma Konvalesen</div>
	<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
		<table cellpadding=1 cellspacing="0">
			<tr style="background-color:mistyrose; font-size:12px; color:#000000;">
				<td>METODE<select name="metode">
						<option value="Bioplat">Bioplat</option>
						<option value="Auto-Immucor">Auto-Immucor</option>
						<option value="Auto-Qwalys">Auto-Qwalys</option>
						<option value="Tube Test">Tube Test</option>
				</select></td>
				<td class="input">No Lot ANTI-A<INPUT type="text"  name="nolota" size='9' required placeholder="No Lot"></td>
				<td class="input">ED. ANTI-A<INPUT type="text"  name="expa" size='9' required placeholder="yyyy-mm-dd"></td>
				<td class="input">No. Lot ANTI-B<INPUT type="text"  name="nolotb" size='9' required placeholder="No Lot"></td>
				<td class="input">ED. ANTI-B<INPUT type="text"  name="expb" size='9' required placeholder="yyyy-mm-dd"></td>
				<td class="input">No. Lot ANTI-D<INPUT type="text"  name="nolotd" size='9' required placeholder="No Lot"></td>
				<td class="input">ED. ANTI-D<INPUT type="text"  name="expd" size='9' required placeholder="yyyy-mm-dd"></td>
			</tr>
	</table><br>
	<div style="font-family:Arial;font-size:20px;">Kode Sampel : <input type="text"  name="nokantong" id="nokantong" style="width:4cm;" placeholder="TPK200711001" onkeydown="chang(event,this);" onchange="cari_kantong('box-table-b');"></div>
		
	<br>
	<table id="box-table-b" style="background-color:#FECCBF; font-size:14px; color:#000000; font-family:arial;border-collapse:collapse;width:100%;" >
		<tr style="background-color:mistyrose; font-size:16px; color:#000000;height:40px;">
			<th>No</th>
			<th>Kode Sampel</th>
			<th>Pendonor</th>
			<th>Gol & Rh Darah<br>Pendonor</th>
			<th>Hasil ABO</th>
			<th>Hasil Rhesus</th>			
			<th>Anti A</th>			
			<th>Anti B</th>
			<th>TA</th>
			<th>TB</th>
			<th>TO</th>
			<th>AC</th>
			<th>Anti D</th>
			<th>BA 6%</th>
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
