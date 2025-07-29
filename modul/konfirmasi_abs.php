<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/abs.js" type="text/javascript"> </script>
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
$lv0=$_SESSION['leveluser'];
$q_udd=mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu=$q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$hariini=date('Y-m-d H:i:s');
if (isset($_POST['simpan'])) { 
	//Generated NoTransaksi===============================================
	$sql	= mysqli_query($dbi,"SELECT MAX(CONVERT(abs_notrans, SIGNED INTEGER)) AS Kode FROM abs");
	$dta	= mysqli_fetch_assoc($sql);
	$int_no = (int)($dta['Kode']);
	$int_no_inc=(int)$int_no+1;
	$j_nol= 8-(strlen(strval($int_no_inc)));
	for ($i=0; $i<$j_nol; $i++){$no_tmp .="0";}
	$notrans = $no_tmp.$int_no_inc;
	//------------ END Generate no transaksi ---------------
	$v_gell_lot=$_POST['lot_gell'];
	$v_gell_ed=$_POST['ed_gell'];
	$v_cell1_lot=$_POST['lot_cell1'];
	$v_cell1_ed=$_POST['ed_cell1'];
	$v_cell2_lot=$_POST['lot_cell2'];
	$v_cell2_ed=$_POST['ed_cell2'];
	$v_pemeriksa=$_POST['pemeriksa'];
	$v_checker=$_POST['checker'];
	$v_pengesah=$_POST['pengesah'];
	for ($i=0; $i<sizeof($_POST['nokantong']); $i++) { 
		$v_sample=$_POST['nokantong'][$i];
		$v_golda=$_POST['gol_donor'][$i];
		$v_rh=$_POST['rh_donor'][$i];
		$v_reak1=$_POST['cell1'][$i];
		$v_reak2=$_POST['cell2'][$i];
		$v_result='Negatif';
		if ($v_reak1!=='Neg' || $v_reak2!=='Neg'){$v_result="Positif";}
		$q1="INSERT INTO `abs_gell`
			(`absg_trans`, `absg_tgl`, `absg_kantong`, `absg_sampleid`, `absg_golda`, `absg_rh`, 
			`absg_igg_lot`, `absg_igg_ed`, `absg_cell1_lot`, `absg_cell1_ed`, `absg_cell2_lot`, `absg_cell2_ed`, 
			`absg_cell_reac`, `absg_cell2_reac`, `absg_result`, 
			`absg_pemeriksa`, `absg_checker`, `absg_approve`) 
			VALUES ('$notrans','$hariini','$v_sample','$v_sample','$v_golda','$v_rh',
			'$v_gell_lot','$v_gell_ed','$v_cell1_lot','$v_cell1_ed','$v_cell2_lot','$v_cell2_ed',
			'$v_reak1','$v_reak2','$v_result',
			'$v_pemeriksa','$v_checker','$v_pengesah')";
		$q2="INSERT INTO `abs` (`abs_notrans`, `abs_tgl`, `abs_sample_id`, `abs_kode_sample`, `abs_metode`, `abs_result`, `abs_checker`, `abs_user`, `abs_supervisor`) 
			VALUES ('$notrans','$hariini','$v_sample','$v_sample','Gell Test','$v_result','$v_checker','$namauser','$v_pengesah')";
		$ins1=mysqli_query($dbi,$q1);
		if ($ins1){
			$ins2=mysqli_query($dbi,$q2);
			if ($ins2){
				echo "Sample No: ".$v_sample.' hasil: '.$v_result.' berhasil disimpan.<br>';
				//=======Audit Trail====================================================================================
				$log_mdl ='ABS';
				$log_aksi='ABS Sampel: '.$v_sample.', No: '.$notrans. ' hasil: '.$v_result;
				include('user_log.php');
				//=====================================================================================================
			}else{
				echo "Sample No: ".$v_sample.' hasil: '.$v_result.' berhasil disimpan.<br>';
			}
		}else{
			echo "Sample No: ".$v_sample.' hasil: '.$v_result.' GAGAL disimpan.<br>';
		}
		
	}
	echo '<META http-equiv="refresh" content="5; url=pmi'.$lv0.'.php?module=abs_mgell">';
} 
?>
	<body onLoad=setFocus()>
	<div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#1e90ff;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Antibody Screening - Gell Tes Manual</div>

	<form name="kantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
		<table cellpadding=1 cellspacing="0"class="bayangan">
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            	<td class="input" colspan="4" style="height:30px;font-weight:bold;">Reagensia</td>
            </tr>
			<tr style="background-color:mistyrose; font-size:12px; color:#000000;">
				<td class="input">Anti-IgG+C3d :<input type="text"  name="lot_gell" size='9' required placeholder="No Lot">
				    <input type="text"  name="ed_gell" size='9' required placeholder="yyyy-mm-dd"></td>
				<td class="input">Cell I :<input type="text"  name="lot_cell1" size='9' required placeholder="No Lot">
				    <input type="text"  name="ed_cell1" size='9' required placeholder="yyyy-mm-dd"></td>
				<td class="input">Cell II :<input type="text"  name="lot_cell2" size='9' required placeholder="No Lot">
				    <input type="text"  name="ed_cell2" size='9' required placeholder="yyyy-mm-dd"></td>
			</tr>
			<tr style="background-color:mistyrose; font-size:16px; color:#000000;">
				<td>Diperiksa oleh :<input type="hidden" value="<?php echo $namauser;?>" name="pemeriksa">
				<?php
				$pemeriksa=mysqli_fetch_assoc(mysqli_query($dbi,"select * from user where multi like '%laboratorium%' and id_user='$namauser'"));
				echo $pemeriksa['nama_lengkap'];
				?>
				</td>
				<td>Dicek Oleh :
				<select name="checker" > <?
					$pemeriksa=mysqli_query($dbi,"select * from user where multi like '%laboratorium%' order by nama_lengkap ASC");
					while($data2=mysqli_fetch_assoc($pemeriksa)) {
						echo '<option value="'.$data2['id_user'].'">'.$data2['nama_lengkap'].'</option>';
					} ?>
				</select></td>
				<td>Disahkan Oleh :
				<select name="pengesah" > <?
				$pemeriksa=mysqli_query($dbi,"select * from user where multi like '%laboratorium%' order by nama_lengkap ASC");
					while($data2=mysqli_fetch_assoc($pemeriksa)) {
						echo '<option value="'.$data2['id_user'].'">'.$data2['nama_lengkap'].'</option>';
				} ?>
				</select></td>
			</tr>
		</table><br>
		<div style="font-family:Arial;font-size:20px;">Kode Sampel : <input class="bayangan" style="height:35px;padding-left:10px;font-size:16px;font-weight:bold;"type="text"  name="nokantong" id="nokantong" style="width:4cm;" placeholder="Nomor Kantong" onkeydown="chang(event,this);" onchange="cari_kantong('tababs');"></div>
		<br>
		<table id="tababs" style="background-color:#FECCBF; font-size:14px; color:#000000; font-family:arial;border-collapse:collapse;width:50%;" >
			<tr style="background-color:mistyrose; font-size:16px; color:#000000;height:40px;" class="bayangan">
				<th>No</th>
				<th>Chk</th>
				<th>Sampel/Kantong</th>
				<th>Gol Darah</th>
				<th>Cell I</th>
				<th>Cell II</th>
			</tr>			
		</table><br>
		<input type="button" value="Hapus" onclick="hapusbaris('tababs')" class="swn_button_red">
		<input name="simpan" type="submit" value="Simpan" class="swn_button_blue">
		<a href="pmi<?php echo $lv0;?>.php?module=abs_gell_rekap" class="swn_button_blue">Rekap ABS</a>
</form>
<div style="font-size: 9px;color: #000000">Update 2021-01-25</div>

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
	.bayangan {
			border:0.2px solid red;
			padding: 1px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);"
		}
</style>
