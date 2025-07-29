<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type="text/javascript" language="javascript">
function roundNumber(num, dec) {
  var result = String(Math.round(num*Math.pow(10,dec))/Math.pow(10,dec));
  if(result.indexOf('.')<0) {result+= '.';}
  while(result.length- result.indexOf('.')<=dec) {result+= '0';}
  return result;
}

function hasil_test(masukan,baris){
	var absorbance = document.getElementById('od'+baris).value;
	var varhasil="hasil"+baris;
	var jum_od=0;
	var co	= document.getElementById('cut_off').value;
	var co_fix = co.replace(",", ".");
	var v_reaktif = document.getElementById('reaktif_id').value;
	var v_nonreaktif = document.getElementById('nonreaktif_id').value;
	var v_greyzone = document.getElementById('greyzone_id').value;
	var absorbance_fix = absorbance.replace(",", ".");
	var ratio=0;
	var hasil="";
	ratio=absorbance_fix;
	if (co_fix>0) ratio=absorbance_fix/co_fix;
	if(ratio<(v_nonreaktif)){hasil='Non Reaktif';val_hasil=0;}
	if (v_greyzone>0) {if(ratio>=v_greyzone){hasil='Grey Zone';val_hasil=2;}}
	if(ratio>=(v_reaktif)){hasil='Reaktif';val_hasil=1;}
	ratio=roundNumber(ratio, 3);
	document.getElementById('prn_ratio'+baris).innerHTML=ratio;
	document.getElementById('ratio'+baris).value=ratio;
	document.getElementById('prn_hasil'+baris).innerHTML=hasil;
	document.getElementById('hasil'+baris).value=hasil;
}

</script>
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
if(isset($_POST['Button_rapid']))  { //Metode Rapid======
	$parameter 	= $_GET['parameter'];
	$kode_reagen= $_GET['kode_reagen'];
	for ($i=0;$i<count($_POST[nomor_rapid]);$i++){
		$no=$i;$no++;
		$nktg	= $_POST["nomorkantong_rapid"][$i];
		$hasiltest	= ($_POST['hasil_rapid'][$i]);
		if ($hasiltest=="Reaktif"){$od="0";}else{$od="1";}
		switch ($parameter){
			case "HBSAG":
				$sql="update imltd_import_temp set hbsag_result='$hasiltest', reagen_hbsag='$kode_reagen', hbsag_metode='rapid', hbsag_od='$od'
							where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
			case "HCV":
				$sql="update imltd_import_temp set hcv_result='$hasiltest', reagen_hcv='$kode_reagen', hcv_metode='rapid', hcv_od='$od'
							where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
			case "HIV":
				$sql="update imltd_import_temp set hiv_result='$hasiltest', reagen_hiv='$kode_reagen', hiv_metode='rapid', hiv_od='$od'
							where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
			case "SYPHILIS":
				$sql="update imltd_import_temp set syp_result='$hasiltest', reagen_syp='$kode_reagen', syp_metode='rapid', syp_od='$od'
							where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
		}
	}
	echo "<SCRIPT>alert('Manual input $parameter metode Rapid  sudah disimpan.');</SCRIPT>";?>
	<META http-equiv="refresh" content="0; url=pmiimltd.php?module=import_davincikonfirmasi"><?
} //End of Submit Rapid==================================
else
{ if(isset($_POST['Button_elisa']))  { //Metode ELISA====
	$parameter 	= $_GET['parameter'];
	$kode_reagen= $_GET['kode_reagen'];
	$cutoff		= $_POST['cut_off'];
	for ($i=0;$i<count($_POST[nomor_elisa]);$i++){
		$no=$i;$no++;
		$nktg		= $_POST['nokantong'.$no];
		$absorbance	= $_POST['od'.$no];
		$ratio		= $_POST['ratio'.$no];
		$hasiltest	= $_POST['hasil'.$no];
		switch ($parameter){
			case "HBSAG":
				$sql="update imltd_import_temp set hbsag_cut_off = '$cutoff', hbsag_quanti = '$ratio', hbsag_reader = '$absorbance',
					  hbsag_result = '$hasiltest', hbsag_metode = 'elisa', reagen_hbsag = '$kode_reagen', hbsag_od = '$ratio'
					  where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
			case "HCV":
				$sql="update imltd_import_temp set hcv_cut_off = '$cutoff', hcv_quanti = '$ratio', hcv_reader = '$absorbance',
					  hcv_result = '$hasiltest', hcv_metode = 'elisa', reagen_hcv = '$kode_reagen', hcv_od = '$ratio'
					  where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
			case "HIV":
				$sql="update imltd_import_temp set hiv_cut_off = '$cutoff', hiv_quanti = '$ratio', hiv_reader = '$absorbance',
					  hiv_result = '$hasiltest', hiv_metode = 'elisa', reagen_hiv = '$kode_reagen', hiv_od = '$ratio'
					  where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
			case "SYPHILIS":
				$sql="update imltd_import_temp set syp_cut_off = '$cutoff', syp_quanti = '$ratio', syp_reader = '$absorbance',
					  syp_result = '$hasiltest', syp_metode = 'elisa', reagen_syp = '$kode_reagen', syp_od = '$ratio'
					  where nokantong='$nktg'";
					$tambah=mysql_query($sql,$con);
				break;
		}
	}
	echo "Elisa  : $no kantong";
	"<SCRIPT>alert('Manual input $parameter metode ELISA  sudah disimpan.');</SCRIPT>";?>
	<META http-equiv="refresh" content="0; url=pmiimltd.php?module=import_davincikonfirmasi"><?
	}
}

?>
<head>
<title>Input Manual hasil IMLTD bioM&eacuterieux DaVinci Quatro</title>
</head>
<body>
<?php
$parameter 	= $_GET['parameter'];
$lot_number	= $_GET['nolot'];
$metode		= $_GET['metode'];
$kode_reagen= $_GET['kode_reagen'];
$sisa_tes	= $_GET['sisa_tes'];
$reaktif	= $_GET['reaktif'];
$nonreaktif	= $_GET['nonreaktif'];
$greyzone	= $_GET['greyzone'];
switch ($parameter){
	case "HBSAG": $reagenidnama="HBsAg";$reagendijenis="HBSAG";$paramkode="hbsag";
		$sq="SELECT nokantong, hbsag_cut_off, hbsag_quanti, hbsag_reader, hbsag_result from imltd_import_temp order by id";
		?><script language="javascript">idreag=0;</script><?
		break;
	case "HCV": $reagenidnama="Anti-HCV";$reagendijenis="HCV";$paramkode="hcv";
		$sq="SELECT nokantong, hcv_cut_off, hcv_quanti, hcv_reader, hcv_result from imltd_import_temp order by id";
		?><script language="javascript">idreag=1;</script><?
		break;
	case "HIV": $reagenidnama="Anti-HIV";$reagendijenis="HIV";$paramkode="hiv";
		$sq="SELECT nokantong, hiv_cut_off, hiv_quanti, hiv_reader, hiv_result from imltd_import_temp order by id";
		?><script language="javascript">idreag=2;</script><?
		break;
	case "SYPHILIS": $reagenidnama="Syphilis";$reagendijenis="SYPHILIS";$paramkode="syp";
		$sq="SELECT nokantong, syp_cut_off, syp_quanti, syp_reader, syp_result from imltd_import_temp order by id";
		?><script language="javascript">idreag=3;</script><?
		break;
}
?>
<h2>Input Manual hasil IMLTD <u><?=$reagenidnama?></u></h2>
<form name="info" align="left" method="" action="">
	<table class="list" border="1" cellpadding="3" cellspacing="1">
		<tr class="record">
			<td align="left">Parameter : <b><?=$parameter?></b></td>
			<td align="left">Metode : <b><?=$metode?></b></td>
			<td align="left">Kode Reagen : <b><?=$kode_reagen?></b></td>
			<td align="left">Nomor Lot : <b><?=$lot_number?></b></td>
			<td align="left">Sisa tes : <b><?=$sisa_tes?></b></td></tr>
		<tr class="record">
			<td align="center" colspan="2">Non Reaktif < <b><?=$nonreaktif?></b>
				<input type='hidden' id='nonreaktif_id' value=<?=$nonreaktif?>>
				</td>
			<td align="center">Greyzone >= <b><?=$greyzone?></b>
				<input type='hidden' id='greyzone_id' value=<?=$greyzone?>>
				</td>
			<td align="center" colspan="2">Reaktif >= <b><?=$reaktif?></b>
				<input type='hidden' id='reaktif_id' value=<?=$reaktif?>>
				</td>
		</tr>
	</table>
</form>
<?
if ($metode=="elisa"){
	//METODE ELISA
	?>
	<form name="input_elisa" method="post">
	<?
	$sql=mysql_query($sq);
	$no=1;
	?>
	<table class="list" border="1" cellpadding="0" cellspacing="1">
		<tr class="field">
			<td colspan=2>Cut-Off</td>
			<td colspan=3 align="left"><input type="text" size="5" name="cut_off" id="cut_off" value=0> </td>
		</tr>
		<tr class="field">
			<td>No</td>
			<td width="100px">Nomor<br>Kantong</td>
			<td width="100px">Absorbance</td>
			<td width="100px">Ratio</td>
			<td width="150px">Hasil</td>
		</tr>
		<?
		while($baris=mysql_fetch_row($sql)){
			$id_od="od".$no;
			$id_hasil="hasil".$no;
			$id_prn_hasil="prn_hasil".$no;
			$id_ratio='ratio'.$no;
			$id_prn_ratio="prn_ratio".$no;
			$id_nokantong="nokantong".$no;
			if ($baris[4]==""){
				$hasil="Non Reaktif";
			}else{
				$hasil=$baris[4];
			}?>
			<tr class='record'>
				<td><?=$no?>.</td><input type='hidden' name='nomor_elisa[]'.<?=$no?> value='<?=$baris[0]?>'>
				<td><?=$baris[0]?></td><input type='hidden' name='<?=$id_nokantong?>' value='<?=$baris[0]?>'>
				<td><input type='text' size='5' name='<?=$id_od?>' id='<?=$id_od?>' onkeyup='hasil_test(this.value,<?=$no?>)' value=<?=$baris[3]?>></td>
				<td><input type='hidden' name='<?=$id_ratio?>' id='<?=$id_ratio?>' value=<?=$baris[2]?>><div id='<?=$id_prn_ratio?>'><?=$baris[2]?></div></td>
				<td><input type='hidden' name='<?=$id_hasil?>' id='<?=$id_hasil?>' value='Non Reaktif'><div id='<?=$id_prn_hasil?>'>Non Reaktif</div></td>
			</tr><?
			$no++;
		}?>
	</table>
	<input type="submit" name="Button_elisa" value="Simpan hasil" class="swn_button_blue">
	<a href="pmiimltd.php?module=import_davincikonfirmasi"class="swn_button_blue">Kembali ke hasil import</a>
	<a href="pmiimltd.php?module=import_davinci"class="swn_button_blue">Kembali ke awal</a>
	</form><?
	//END OF ELISA
}else{
	// METODE RAPID======================================
	?>
	<form name="input_rapid" method="post">
	<?
	$sql=mysql_query($sq);
	$no=1;
	?>
	<table class="list" border=0 cellpadding=1 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Nomor Kantong</td>
		<td>Hasil</td>
	</tr>
	<?
	while($baris=mysql_fetch_row($sql)){?>
		<tr class='record'>
		<td><?=$no?>.</td><input type='hidden' name='nomor_rapid[]' value=<?=$baris[0]?>>
		<td><?=$baris[0]?></td><input type='hidden' name='nomorkantong_rapid[]' value="<?=$baris[0]?>">
		<td class='input'>
				<?
				$nr="";$r="Non Reaktif";
				if ($baris[5]=="Reaktif"){$r="selected";}else{$nr="selected";}
				?>
				<select name='hasil_rapid[]' STYLE='width: 150px'>
					<option value='Non Reaktif' <?=$nr?>>Non Reaktif</option>
					<option value='Reaktif' <?=$r?>>Reaktif</option>
				</select>
				</td>
		</tr><?
		$no++;
	}
	?>
	</table>
	<input type="submit" name="Button_rapid" value="Simpan hasil" class="swn_button_blue">
	<a href="pmiimltd.php?module=import_davincikonfirmasi"class="swn_button_blue">Kembali ke hasil import</a>
	<a href="pmiimltd.php?module=import_davinci" class="swn_button_blue">Kembali ke awal</a>
</form><?
//END OF RAPID
}
?>

</body>
</html>
