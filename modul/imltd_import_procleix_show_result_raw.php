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
	<title>Import LIS Procleix(R) System Software</title>
</head>
<body>
<?php
	$run_number=$_GET['no'];
	$sql="SELECT `id`, `date_transfer`, `sample_id`, `interpretation`, `protocol`, `run_number`, `date`, `flag`, `internal_control_rlu`,
	     `internal_Control_result`, `analyte_rlu`, `analyte_s_co`, `kinetic_index`, `operator_name`, `internal_control_cutoff`, `analyte_cutoff`,
		 `neg_calibrator_analyte_avg`, `neg_calibrator_ic_avg`, `hiv_pos_analyte_avg`, `hiv_pos_calibrator_ic_avg`, `hcv_pos_analyte_avg`,
		 `hcv_pos_calibartor_ic_avg`, `lot_number`, `lot_date`, `procleix_sn`, `procleix_firmware`, `run_number_prefix`, `type_of_tube`,
		 `hbv_pos_calibrator_avg`, `hbv_pos_calibrator_ic_avg`, `userinput`, `konfirmasi`, `tgl_konfirmasi`, `userkonfirmasi`
		 FROM `imltd_procleix_raw` WHERE `run_number`='$run_number'";
	$qry=mysql_query($sql);
	$data=mysql_fetch_assoc($qry);
	?>
	<a name="atas" id="atas"></a>
	<font size="5">DATA HASIL PEMERIKSAAN NAT <b><u>"<?=$data['protocol']?>"</u></b></font>
	<table class="form" border=1 cellpadding=2 cellspacing=2 width=80% style="border-collapse:collapse">
		<tr>
			<td align="left" nowrap>Name of the Protocol</td>			<td nowrap  align="left" class="input"><?=$data['protocol']?></td>
			<td align="left" nowrap>Master Lot Number</td>				<td nowrap align="left" class="input"><?=$data['lot_number']?></td>
		</tr>
		<tr>
			<td align="left" nowrap>Run number</td>						<td nowrap align="left" class="input"><?=$data['run_number']?></td>
			<td align="left" nowrap>Master Lot Date	</td>				<td nowrap align="left" class="input"><?=$data['lot_date']?></td>
		</tr>
		<tr>
			<td align="left" nowrap>Run Date and Time</td>				<td nowrap align="left" class="input"><?=$data['date']?></td>			
			<td align="left" nowrap>PROCLEIX® HC+ S/N</td>				<td nowrap align="left" class="input"><?=$data['procleix_sn']?></td>
		</tr>
		<tr>
			<td align="left" nowrap>Operator’s Name	</td>				<td nowrap align="left" class="input"><?=$data['operator_name']?></td>
			<td align="left" nowrap>PROCLEIX® HC+ Firmware Revision</td><td nowrap align="left" class="input"><?=$data['procleix_firmware']?></td>
		</tr>
		<tr>
			<td align="left" nowrap>Kinetic Index</td>					<td nowrap align="left" class="input"><?=number_format($data['kinetic_index'],4,",",".")?></td>
			<td align="left" nowrap>Run Number Prefix</td>				<td nowrap align="left" class="input"><?=$data['run_number_prefix']?></td>
		</tr>
		<tr>
			<td align="left" nowrap>Internal Control Cutoff</td>		<td nowrap align="left" class="input"><?=number_format($data['internal_control_cutoff'],2,",",".")?></td>
			<td align="left" nowrap>Analyte Cutoff</td>					<td nowrap align="left" class="input"><?=number_format($data['analyte_cutoff'],2,",",".")?></td>
		</tr>
		<tr>
			<td align="left" nowrap>Negative Calibrator Analyte Average</td>		<td nowrap align="left" class="input"><?=number_format($data['neg_calibrator_analyte_avg'],2,",",".")?></td>
			<td align="left" nowrap>Negative Calibrator IC Average</td>	<td nowrap align="left" class="input"><?=number_format($data['neg_calibrator_ic_avg'],2,",",".")?></td>
		</tr>
		<tr>
			<td align="left" nowrap>HIV-1 or WNV Positive Calibrator Analyte Average</td>		<td nowrap align="left" class="input"><?=number_format($data['hiv_pos_analyte_avg'],2,",",".")?></td>
			<td align="left" nowrap>HIV-1 or WNV Positive Calibrator IC Average</td>		<td nowrap align="left" class="input"><?=number_format($data['hiv_pos_calibrator_ic_avg'],2,",",".")?></td>
		</tr>
		<tr>
			<td align="left" nowrap>HCV Positive Calibrator Analyte Average</td>		<td nowrap align="left" class="input"><?=number_format($data['hcv_pos_analyte_avg'],2,",",".")?></td>
			<td align="left" nowrap>HCV Positive Calibrator IC Average</td>		<td nowrap align="left" class="input"><?=number_format($data['hcv_pos_calibartor_ic_avg'],2,",",".")?></td>
		</tr>
		<tr>
			<td align="left" nowrap>HBV Positive Calibrator Analyte Average</td>		<td nowrap align="left" class="input"><?=number_format($data['hbv_pos_calibrator_avg'],2,",",".")?></td>
			<td align="left" nowrap>HBV Positive Calibrator IC Average</td>		<td nowrap align="left" class="input"><?=number_format($data['hbv_pos_calibrator_ic_avg'],2,",",".")?></td>
		</tr>
	</table>
	<a href="pmiimltd.php?module=import_nat_procleix"class="swn_button">Kembali</a><a href="#bawah" class="swn_button_blue">Ke bawah</a>
	<br>
	<table class="list" border="1" cellpadding="2" cellspacing="0" width=80% style="border-collapse:collapse">
		<tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="center">No</td>
			<td align="center">Sample ID</td>
			<td align="center">Overall<br>Interpretation</td>
			<td align="center">Status<br>Flags</td>
			<td align="center">Internal<br>Control RLU</td>
			<td align="center">Internal<br>Control Result</td>
			<td align="center">Analyte<br>RLU</td>
			<td align="center">Analyte<br>S/CO</td>
			<td align="center">Type of<br>tube</td>
		</tr>
	<?php
		$qry=mysql_query($sql);
		$jml=0;
		while($data=mysql_fetch_assoc($qry)){
			$jml++;?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td nowrap align="center"><?=$jml?></td>
					<td nowrap align="left"><?=$data['sample_id']?></td>
					<td nowrap align="center"><?=$data['interpretation']?></td>
					<td nowrap align="center"><?=$data['flag']?></td>
					<td nowrap align="right"><?=number_format($data['internal_control_rlu'],2,",",".")?></td>
					<td nowrap align="center"><?=$data['internal_Control_result']?></td>
					<td nowrap align="right"><?=number_format($data['analyte_rlu'],2,",",".")?></td>
					<td nowrap align="right"><?=number_format($data['analyte_s_co'],2,",",".")?></td>
					<td nowrap align="left"><?=$data['type_of_tube']?></td>
				</tr><?
		}?>
	</table>
	<a href="pmiimltd.php?module=import_nat_procleix"class="swn_button">Kembali</a><a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah"></a>
</body>
</html>

