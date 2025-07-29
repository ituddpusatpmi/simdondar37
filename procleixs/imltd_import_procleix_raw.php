<?php
//=====================================================================
//0		Sample ID
//1		Overall Interpretation
//2		Name of the Protocol								header
//3		Run number											header
//4		Run Date and Time									header
//5		Status Flags (if any)
//6		Internal Control RLU
//7		Internal Control Result
//8		Analyte RLU
//9		Analyte S/CO
//10	Kinetic Index										header
//11	Operator’s Name										header
//12	Internal Control Cutoff								header
//13	Analyte Cutoff										header
//14	Negative Calibrator Analyte Average					header
//15	Negative Calibrator IC Average						header
//16	HIV-1 or WNV Positive Calibrator Analyte Average	header
//17	HIV-1 or WNV Positive Calibrator IC Average			header
//18	HCV Positive Calibrator Analyte Average				header
//19	HCV Positive Calibrator IC Average					header
//20	Master Lot Number									header
//21	Master Lot Date										header
//22	PROCLEIX® HC+ S/N									header
//23	PROCLEIX® HC+ Firmware Revision						header
//24	Run Number Prefix									header
//25	Type of tube
//26	HBV Positive Calibrator Analyte Average				header
//27	HBV Positive Calibrator IC Average					header
//===============================================================

require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Import LIS Procleix(R) System Software</title>
</head>
<body>
<?php
	$sqtmp="SELECT `sample_id`, `interpretation`, `protocol`, `run_number`, `date`, `flag`, `internal_control_rlu`, `internal_Control_result`, `analyte_rlu`, `analyte_s_co`, `kinetic_index`, `operator_name`, `internal_control_cutoff`, `analyte_cutoff`, `neg_calibrator_analyte_avg`, `neg_calibrator_ic_avg`, `hiv_pos_analyte_avg`, `hiv_pos_calibrator_ic_avg`, `hcv_pos_analyte_avg`, `hcv_pos_calibartor_ic_avg`, `lot_number`, `lot_date`, `procleix_sn`, `procleix_firmware`, `run_number_prefix`, `type_of_tube`, `hbv_pos_calibrator_avg`, `hbv_pos_calibrator_ic_avg`, `userinput`, `date_import` FROM `imltd_procleix_tmp`";
	$qtmp=mysql_query($sqtmp);
	while($tmp=mysql_fetch_assoc($qtmp)){
		$sqlraw="INSERT INTO `pmi`.`imltd_procleix_raw`
				(`sample_id`, `interpretation`, `protocol`, `run_number`, `date`, `flag`, `internal_control_rlu`, `internal_Control_result`,
				`analyte_rlu`, `analyte_s_co`, `kinetic_index`, `operator_name`, `internal_control_cutoff`, `analyte_cutoff`, `neg_calibrator_analyte_avg`,
				`neg_calibrator_ic_avg`, `hiv_pos_analyte_avg`, `hiv_pos_calibrator_ic_avg`, `hcv_pos_analyte_avg`, `hcv_pos_calibartor_ic_avg`, `lot_number`,
				`lot_date`, `procleix_sn`, `procleix_firmware`, `run_number_prefix`, `type_of_tube`, `hbv_pos_calibrator_avg`, `hbv_pos_calibrator_ic_avg`,`userinput`)
				VALUES
				('$tmp[sample_id]', '$tmp[interpretation]','$tmp[protocol]','$tmp[run_number]','$tmp[date]','$tmp[flag]','$tmp[internal_control_rlu]','$tmp[internal_Control_result]',
				 '$tmp[analyte_rlu]','$tmp[analyte_s_co]','$tmp[kinetic_index]','$tmp[operator_name]','$tmp[internal_control_cutoff]','$tmp[analyte_cutoff]','$tmp[neg_calibrator_analyte_avg]',
				 '$tmp[neg_calibrator_ic_avg]','$tmp[hiv_pos_analyte_avg]','$tmp[hiv_pos_calibrator_ic_avg]','$tmp[hcv_pos_analyte_avg]','$tmp[hcv_pos_calibartor_ic_avg]','$tmp[lot_number]',
				 '$tmp[lot_date]','$tmp[procleix_sn]','$tmp[procleix_firmware]','$tmp[run_number_prefix]','$tmp[type_of_tube]','$tmp[hbv_pos_calibrator_avg]','$tmp[hbv_pos_calibrator_ic_avg]','$tmp[userinput]')";
		$insertraw=mysql_query($sqlraw);
		$run_number=$tmp[run_number];
	}
	$emptytmp=mysql_query("TRUNCATE TABLE  `imltd_procleix_tmp`");
	?>
	<font size="4" color="blue"><b>PROSES TRANSFER DATA SUDAH BERHASIL DILAKUKAN<br></b>LAKUKAN KONFIRMASI KANTONG</b></font>
	<META http-equiv="refresh" content="10; url=../pmiimltd.php?module=import_nat_procleix"><br><br><br>
	<a href="pmiimltd.php?module=import_nat_procleix"class="swn_button">Kembali</a>
	<a href="pmiimltd.php?module=import_nat_procleix_konfirm&no=<?=$run_number?> "class="swn_button_green">Konfirm</a>
	<?
?>
</body>
</html>

