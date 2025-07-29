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
	$sql="SELECT  *,DATE(`tgl_periksa` ) AS tgl
		FROM  `imltd_nat_panther_raw`  
		WHERE `run_number`='$run_number'";
	$qry=mysql_query($sql);
	$data=mysql_fetch_assoc($qry);
	?>
	<a name="atas" id="atas"></a>
	<font size="5">DATA HASIL PEMERIKSAAN NAT <b><u>"PANTHER PROCLEIXS"</u></b></font><br>
	
	<a href="pmiimltd.php?module=import_nat_panther"class="swn_button_red">Kembali</a><a href="#bawah" class="swn_button_blue">Ke bawah</a>
	<br>
	<table class="list" border="1" cellpadding="2" cellspacing="0" width=80% style="border-collapse:collapse">
		<tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="center">No</td>
			<td align="center">No. Sample</td>
			<td align="center">Rack<br>Tube</td>
			<td align="center">IC-RLU</td>
			<td align="center">IC-Result</td>
			<td align="center">RLU</td>
			<td align="center">S/CO</td>
			<td align="center">Result</td>
			<td align="center">Flag</td>
			<td align="center">Status<br>kantong</td>
		</tr>
	<?php
		$qry=mysql_query($sql);
		$jml=0;$jmldiproses=0;$jmlkantong=0;
		while($data=mysql_fetch_assoc($qry)){
			$cek_ktg=mysql_query("select Status, sah from stokkantong where noKantong='$data[sample_id]'");
			$c_ktg=mysql_fetch_assoc($cek_ktg);
			$status_ktg=$c_ktg['Status'];
			$kantong_sah=$c_ktg['sah'];
			switch ($status_ktg){
				case '0' : $statuskantong='Kosong('.$status_ktg.')';break;
				case '1' :
						if ($c_ktg['sah']=="1"){
							$statuskantong='Karantina('.$status_ktg.')';
						} else{
							$statuskantong='Belum disahkan('.$status_ktg.')';
						}
						break;
				case '2' : $statuskantong='Sehat('.$status_ktg.')';break;
				case '3' : $statuskantong='Keluar('.$status_ktg.')';break;
				case '4' : $statuskantong='Rusak-reaktif('.$status_ktg.')';break;
				case '5' : $statuskantong='Rusak-gagal('.$status_ktg.')';break;
				case '6' : $statuskantong='Buang-Kadaluwarsa('.$status_ktg.')';break;
				default : $statuskantong='Tidak ada('.$status_ktg.')';
			}
			$jml++;?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td nowrap align="left">
					<?=$jml?>
					</td>
					<td nowrap align="left">
						<input type="hidden" size=50 name="runnumber" value=<?=$data[run_number]?>>
						<input type="hidden" name=analyzer[] value="Procleix">
						<input type="hidden" size=20 name=kantong[] value=<?=$data[sample_id]?>>
						<input type="hidden" name=tglperiksa[] value='<?=$data[tgl_periksa]?>'>
						<?=$data['sample_id']?>
						</td>
					<td nowrap align="center" style="color:black;"><?=$data['rack']?></td>
					<td nowrap align="right"><?=$data['ic_rlu']?></td>
					<td nowrap align="center">
						<input type="hidden" name=internal_Control_result[] value=<?=$data[ic_result]?>>
						<?=$data['ic_result']?></td>
					<td nowrap align="right"><?=$data['rlu']?>
					<input type="hidden" name=reagen[] value=<?=$reag[lot_number]?>>
					<input type="hidden" name=edreagen[] value=<?=$reag[lot_date]?>></td>
					<td nowrap align="right"><?=$data['sco']?>
					<input type="hidden" name=sco[] value=<?=$data[sco]?>></td>
					<?if($data['result']=="Reactive"){ $cov=1;?>
						<td nowrap align="center" style="color:red;font-wieght:bold;">
						<input type="hidden" name=result[] value=<?=$data[result]?>>
						<input type="hidden" name=hasil[] value='<?=$cov?>'>
						<?=$data['rack']?></td>
					<?} elseif($data['result']=="Invalid"){  $cov=2;?>
						<td nowrap align="center" style="color:blue;font-wieght:bold;">
						<input type="hidden" name=result[] value=<?=$data[result]?>>
						<input type="hidden" name=hasil[] value='<?=$cov?>'>
						<?=$data['result']?></td>
					<?} else {  $cov=0;?>
						<td nowrap align="center" style="color:black;">
						<input type="hidden" name=result[] value=<?=$data[result]?>>
						<input type="hidden" name=hasil[] value='<?=$cov?>'>
						<?=$data['result']?></td>
					<?}?>
					<td nowrap align="left">
						<input type="hidden" name=jenis_sample[] value=<?=$data['type_of_tube']?>>
						<?=$data['flag']?></td>
					<td nowrap align="left">
						<input type="hidden" name=status_kantong[] value='<?=$statuskantong?>'>
						<?=$statuskantong?></td>
							</td>
		</tr><?
		}?>
	</table>
	<a href="pmiimltd.php?module=import_nat_panther"class="swn_button">Kembali</a><a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah"></a>
</body>
</html>

