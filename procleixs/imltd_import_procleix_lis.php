<?php
//Prepared for NAT2 EXPORT FROM Procleix Software System
//Author	: I Kadek Suwena
//			  Apr, 2014
//=====================================================================
//0		Sample ID
//1		Overall Interpretation
//2		Name of the Protocol				header
//3		Run number							header
//4		Run Date and Time					header
//5		Status Flags (if any)
//6		Internal Control RLU
//7		Internal Control Result
//8		Analyte RLU
//9		Analyte S/CO
//10	Kinetic Index						header
//11	Operator’s Name						header
//12	Internal Control Cutoff				header
//13	Analyte Cutoff						header
//14	Negative Calibrator Analyte Average					header
//15	Negative Calibrator IC Average						header
//16	HIV-1 or WNV Positive Calibrator Analyte Average	header
//17	HIV-1 or WNV Positive Calibrator IC Average			header
//18	HCV Positive Calibrator Analyte Average				header
//19	HCV Positive Calibrator IC Average					header
//20	Master Lot Number					header
//21	Master Lot Date						header
//22	PROCLEIX® HC+ S/N					header
//23	PROCLEIX® HC+ Firmware Revision		header
//24	Run Number Prefix					header
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
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #8888FF }
</style>
<style type="text/css">.styled-select select {background-color: #F7D7D7; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<script>
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {
			$('html,body').animate({
			scrollTop: target.offset().top
        }, 5000);
        return false;
      }
    }
  });
});
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Import LIS Panther Procleix<sup>&reg</sup> Ultrio Elite System Software</title>
</head>
<body>
<?php
if (!empty($_FILES["filecsv"]["tmp_name"])) {
	$tipe_file_lis=$_POST['tipefile'];
	if ($tipe_file_lis==2){
	$namafile = $_FILES['filecsv']['tmp_name'];
	//$pemisah=","; for NAT Export
	$pemisah="\t"; //for NAT2 & NAT 3 export
	$endcrc='[end]';
	$datacsv = fopen($namafile, "r");
	$jml=0;
	$run_number_check="";
	$adadata=0;
	$tipefilenat=$_POST['tipefile'];
	$emptytmp=mysql_query("TRUNCATE TABLE  `imltd_procleix_tmp`");
	?>
	<a name="atas" id="atas"></a><h2>File : <?=$_FILES['filecsv']['name']?></h2></a>
	<?
	$namafilenat=$_FILES['filecsv']['name'];
	$data = fgetcsv($datacsv, 1000, $pemisah);
	$data = fgetcsv($datacsv, 1000, $pemisah);
	$run_number_check=$data[2];
	$date = str_replace('/', '-', $data[35]);
	$tanggal= date('Y-m-d');
	$detik = substr($data[35],-2);
	$menit = substr($data[35],-5,2);
	$jam = substr($data[35],-8,2);

	$timetf = $tanggal.' '.$jam.':'.$menit.':'.$detik;

	//ED REAGEN
	
	$tahunr = substr($data[16],-13,4);
	$tglr = substr($data[16],-16,2);
	$bulanr = substr($data[16],-19,1);
	

	$timetfr = $tahunr.'-'.$bulanr.'-'.$tglr;
	
	//
	$sql="select run_number from imltd_procleix_raw where run_number='$run_number_check'";
	$qry=mysql_query($sql);$adadata=mysql_numrows($qry);
	$sqltmp="INSERT INTO `pmi`.`imltd_procleix_tmp`
			(`sample_id`, `interpretation`, `protocol`, `run_number`, `date`, `flag`, `internal_control_rlu`, `internal_Control_result`,
			`analyte_rlu`, `analyte_s_co`, `kinetic_index`, `operator_name`, `internal_control_cutoff`, `analyte_cutoff`, `neg_calibrator_analyte_avg`,
			`neg_calibrator_ic_avg`, `hiv_pos_analyte_avg`, `hiv_pos_calibrator_ic_avg`, `hcv_pos_analyte_avg`, `hcv_pos_calibartor_ic_avg`, `lot_number`,
			`lot_date`, `procleix_sn`, `procleix_firmware`, `run_number_prefix`, `type_of_tube`, `hbv_pos_calibrator_avg`, `hbv_pos_calibrator_ic_avg`,`userinput`)
			VALUES
			('$data[0]', '$data[1]', '$data[1]', '$data[2]', '$timetf', '$data[3]', '$data[4]', '$data[5]',
			 '$data[8]', '$data[7]', '$data[10]', '$data[14]', '$data[38]', '$data[37]', '$data[14]',
			 '$data[15]', '$data[16]', '$data[17]', '$data[18]', '$data[19]', '$data[15]',
			 '$timetfr', '$data[17]', '$data[22]', '$data[24]', '$data[25]', '$data[26]', '$data[27]', '$namauser')";
	$inserttmp=mysql_query($sqltmp);
	?>
	<table class="form" border=1 cellpadding=2 cellspacing=2 width=50% style="border-collapse:collapse">
		<tr>
			<td align="left" nowrap>Serial Number</td>			<td nowrap  align="left" class="input"><?=$data[17]?></td>
			
		</tr>
		<tr>
			<td align="left" nowrap>Software Version</td>						<td nowrap align="left" class="input"><?=$data[22]?></td>
			
		</tr>
		<tr>
			<td align="left" nowrap>Assay</td>				<td nowrap align="left" class="input">Ultrio Elite</td>			
			
		</tr>
		<tr>
			<td align="left" nowrap>Worklist IDs</td>				<td nowrap align="left" class="input"><?=$data[2]?></td>
			
		</tr>
		<tr>
			<td align="left" nowrap>Operator</td>					<td nowrap align="left" class="input"><?=$data[14]?></td>
			
		</tr>
		
	</table>
	<a href="pmiimltd.php?module=import_nat_panther"class="swn_button">Kembali</a>
	<a href="#bawah" class="swn_button_blue">Ke bawah</a>
	<?	if ($adadata==0){?>
		<a href="pmiimltd.php?module=import_nat_panther_rawlist"class="swn_button">Konfirmasi</a><?
	}else{?>
		<font size="3"><b>HASIL INI SUDAH PERNAH DITRANSFER</b></font><?
	}?>
	<br>
	<table class="list" border="1" cellpadding="2" cellspacing="0" width=80% style="border-collapse:collapse">
		<tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="center">No</td>
			<td align="center">Tgl. Pemeriksaan</td>
			<td align="center">No. Sample</td>
			<td align="center">Rack<br>Tube</td>
			<td align="center">IC-RLU</td>
			<td align="center">IC-Result</td>
			<td align="center">RLU</td>
			<td align="center">S/CO</td>
			<td align="center">Result</td>
			<td align="center">Flag</td>
		</tr>
	<?php
		$jml=1;?>
				<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td nowrap align="center"><?=$jml?></td>
					<td nowrap align="left"><?=$timetf?></td>
					<td nowrap align="center"><?=$data[0]?></td>
					<td nowrap align="center"><?=$data[21]?></td>
					<td nowrap align="center"><?=$data[4]?></td>
					<td nowrap align="center"><?=$data[5]?></td>
					<td nowrap align="center"><?=$data[6]?></td>
					<td nowrap align="center"><?=$data[7]?></td>
					<td nowrap align="center"><?=$data[8]?></td>
					<td nowrap align="center"><?=$data[3]?></td>
					
				</tr><?
		while (($data = fgetcsv($datacsv, 1000, $pemisah)) !== FALSE){
			if (substr($data[0],0,5)!=='[end]'){
				
				$sqltmp="INSERT INTO `pmi`.`imltd_procleix_tmp`
						(`sample_id`, `interpretation`, `protocol`, `run_number`, `date`, `flag`, `internal_control_rlu`, `internal_Control_result`,
						`analyte_rlu`, `analyte_s_co`, `kinetic_index`, `operator_name`, `internal_control_cutoff`, `analyte_cutoff`, `neg_calibrator_analyte_avg`,
						`neg_calibrator_ic_avg`, `hiv_pos_analyte_avg`, `hiv_pos_calibrator_ic_avg`, `hcv_pos_analyte_avg`, `hcv_pos_calibartor_ic_avg`, `lot_number`,
						`lot_date`, `procleix_sn`, `procleix_firmware`, `run_number_prefix`, `type_of_tube`, `hbv_pos_calibrator_avg`, `hbv_pos_calibrator_ic_avg`,`userinput`)
						VALUES
						('$data[0]', '$data[1]', '$data[1]', '$data[2]', '$timetf', '$data[3]', '$data[4]', '$data[5]',
						 '$data[8]', '$data[7]', '$data[10]', '$data[14]', '$data[12]', '$data[13]', '$data[14]',
						 '$data[15]', '$data[16]', '$data[17]', '$data[18]', '$data[19]', '$data[15]',
						 '$timetfr', '$data[17]', '$data[22]', '$data[24]', '$data[25]', '$data[26]', '$data[27]', '$namauser')";
				$inserttmp=mysql_query($sqltmp);
//insert 
	$insertnat = mysql_query("INSERT into imltd_nat_panther_raw (run_number,tgl_periksa,sample_id,rack,ic_rlu,ic_result,rlu,sco,result,flag,username) VALUES ('$data[2]','$timetf','$data[0]','$data[21]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[3]','$data[14]')");
//


				$jml++;?>
				<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td nowrap align="center"><?=$jml?></td>
<? $date = str_replace('/', '-', $data[35]);
$tanggal= date('Y-m-d');
$detik = substr($data[35],-2);
$menit = substr($data[35],-5,2);
$jam = substr($data[35],-8,2);

$timetf = $tanggal.' '.$jam.':'.$menit.':'.$detik;
?>
					<td nowrap align="left"><?=$timetf?></td>
					<td nowrap align="center"><?=$data[0]?></td>
					<td nowrap align="center"><?=$data[21]?></td>
					<td nowrap align="center"><?=$data[4]?></td>
					<td nowrap align="center"><?=$data[5]?></td>
					<td nowrap align="center"><?=$data[6]?></td>
					<td nowrap align="center"><?=$data[7]?></td>
					<td nowrap align="center"><?=$data[8]?></td>
					<td nowrap align="center"><?=$data[3]?></td>
				</tr><?
			}
		}
		fclose($datacsv);
		$sql="SELECT count(namafile) as jumlah from imltd_nat_lis where namafile='$namafilenat'";
		$cek=mysql_fetch_assoc(mysql_query($sql));
		if ($cek[jumlah]==0){
			$sql="INSERT INTO `imltd_nat_lis`(`namafile`, `runnumber`, `tipe_lis`) VALUES ('$namafilenat','$run_number_check','$tipefilenat')";
			$qry=mysql_query($sql);
		}?>
	</table>
	<a href="pmiimltd.php?module=import_nat_panther"class="swn_button">Kembali</a>
	<a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah"></a>
	<?	if ($adadata==0){?>
		<a href="pmiimltd.php?module=import_nat_panther_rawlist"class="swn_button">Konfirmasi</a><?
	}else{?>
		<font size="3"><b>HASIL INI SUDAH PERNAH DITRANSFER!!</b></font><?
	}?>
	<?
	} else {
		?><font size="3"><b>Tipe file selain NAT2 LIS masih dalam proses</b></font>
		<META http-equiv="refresh" content="3; url=../pmiimltd.php?module=import_nat_panther"><?
	}
} else{?>
<form action="" method="post" enctype="multipart/form-data" name="UploadCSV" id="UploadCSV">
	<font size="4">Import manual file dari LIS-Panther Procleix<sup>&reg</sup> Ultrio Elite System Software</font><br><br>
	<table class="form" border="1" cellpadding="2" cellspacing="2" style="border-collapse:collapse" width="525px">
		<tr class="record">
			<td align="left"><font size="2">Tentukan tipe file LIS</font></td>
			<td align="left" class="styled-select">
				<select name='tipefile' id='tipefile'>
					<option value='0'>Default NAT LIS</option>
					<option value='1'>NAT LIS</option>
					<option value='2' selected>NAT2 LIS</option>
					<option value='3'>NAT3 LIS</option>
				</select><br>Rekomendasi tipe file : NAT2 LIS
			</td>
		</tr>
		<tr class="record">
			<td align="left"><font size="2">File LIS</font></td>
			<td align="left"><input type="file" name="filecsv" id="filecsv" class="swn_button" /></td>
		</tr>
	</table>
	<a href="pmiimltd.php?module=import_nat_panther"class="swn_button_blue">Kembali</a>
	<input type="submit" name="button" id="button" value="Proses Import" class="swn_button"/>
</form>
<? }?>
</body>
</html>

