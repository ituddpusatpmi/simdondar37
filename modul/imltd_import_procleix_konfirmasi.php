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
	$('a[href*=#]:not([href=#])').click(function(){
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {$('html,body').animate({scrollTop: target.offset().top}, 5000);return false;}
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
$today=date("Y-m-d");
if(isset($_POST['Button']))  {
	$runnumber=$_POST['runnumber'];
	$sno=0;
	echo "PROSES KONFIRMASI RUN NUMBER : <b>$runnumber</b><br><br>";
	for ($i=0;$i<count($_POST[kantong]);$i++) {
		$no++;
		$nktg			= $_POST['kantong'][$i];
		$iternalctrl	= $_POST['internal_Control_result'][$i];
		$status_kantong = $_POST['status_kantong'][$i];
		$hasil			= $_POST['interpretation'][$i];
		$jnssample		= $_POST['jenis_sample'][$i];
		$centang		= $_POST['pilihan'][$i];
		if ( (($status_kantong!=='Tidak ada()') or ($status_kantong!=="Kosong(0)") )and ($hasil!=='Invalid') ){
			//Update field hasilNAT pada stokkantong
			switch ($hasil){
				case 'NonReactive' 	:$hasilnat='1';break;
				case 'Reactive' 	:$hasilnat='2';break;
				default : $hasilnat='3';break;
			}
			$no_kantong0=substr($nktg,0,-1);
			$sql="UPDATE stokkantong set hasilNAT='$hasilnat' WHERE NoKantong like '$no_kantong0%'";
			$qry=mysql_query($sql);
			if ($hasil=="NonReactive"){
				echo "Kantong $no_kantong0 $hasil - hasil NAT $hasilnat status kantong : $status_kantong<br>";
			}
			if ($hasil=="Reactive"){
				$pendonor=mysql_query("select ht.kodePendonor as kp, st.gol_darah as gd from htransaksi as ht,stokkantong as st
								where ht.NoKantong='$nktg' and st.noKantong='$nktg'");
				$datapendonor=mysql_fetch_assoc($pendonor);
				$idpendonor=$datapendonor[kp];
				$upd_donor_cekal=mysql_query("UPDATE pendonor SET cekalNAT='1' WHERE Kode='$idpendonor'");
				echo "Kantong $no_kantong0 $hasil hasil NAT $hasilnat- kantong sudah tidak sehat--> Donor dicekal NAT<br>";
				//jika hasil positif dan statuskantong sehat--> Status dijadikan 4 (Rusak-Reaktif)
				if ($status_kantong=='Sehat(2)'){
					$sql="UPDATE stokkantong set Status='4' WHERE NoKantong like '$no_kantong0%'";
					$qry=mysql_query($sql);
					echo "Kantong $no_kantong0 $hasil kantong sehat dijadikan Rusak-Reaktif(4)-hasil NAT $hasilnat --> Donor dicekal NAT<br>";
				}
			}
		} else{
			echo "SampleID $nktg tidak diproses : $hasil atau $status_kantong<br>";
		}
	}
	$sql="UPDATE `imltd_nat_lis` SET `konfirmasi`='1', `userkonfirmasi`='$namauser', `waktukonfirmasi`=now() WHERE `runnumber`='$runnumber'";
	$qry=mysql_query($sql);
	$sql=" UPDATE `imltd_procleix_raw` SET `konfirmasi` ='1', `tgl_konfirmasi`=now(), `userkonfirmasi`='$namauser' where `run_number`='$runnumber'";
	$qry=mysql_query($sql);
	?><META http-equiv="refresh" content="10; url=../pmiimltd.php?module=import_nat_procleix"><?
} else {
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
	<form name="konfirmasi_import" id="konfirmasi_import" align="left" method="post">
	<font size="5" color="red">KONFIRMASI HASIL PEMERIKSAAN NAT <b>"<u><?=$data['protocol']?></u>"</b></font>
	<table class="form" border=1 cellpadding=2 cellspacing=2 width=80% style="border-collapse:collapse">
		<tr>
			<td align="left" nowrap>Name of the Protocol</td>			<td nowrap  align="left" class="input"><?=$data['protocol']?></td>
			<td align="left" nowrap>Master Lot Number</td>				<td nowrap align="left" class="input"><?=$data['lot_number']?></td>
		</tr>
		<tr>
			<td align="left" nowrap>Run number</td>						<td nowrap align="left" class="input"><?=$data['run_number']?><input type="hidden" size=50 name="runnumber" value=<?=$data[run_number]?>></td>
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
			<td align="center">Status<br>kantong</td>
		</tr>
	<?php
		$qry=mysql_query($sql);
		$jml=0;$jmldiproses=0;$jmlkantong=0;
		while($data=mysql_fetch_assoc($qry)){
			$jml++;
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
			}?>
			<tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
					<td nowrap align="right">
					<?
					if (($status_ktg=='2') and ($data['internal_Control_result']=="Valid")){
						$jmldiproses++;
						?>
						<div align="right"><font size="2"><?=$jml?>.<input type=checkbox name=pilihan[] checked="checked" value="1"></div>
					<?}else{?>
						<div align="right"><font size="2"><?=$jml?>.<input type=checkbox name=pilihan[]  disabled="disabled" value="0"></div>	
					<?}?></td>
					<td nowrap align="left">
						<input type="hidden" name=analyzer[] value="Procleix">
						<input type="hidden" size=20 name=kantong[] value=<?=$data[sample_id]?>>
						<?=$data['sample_id']?>
						</td>
					<?if($data['interpretation']=="Reactive"){?>
						<td nowrap align="center" style="color:red;font-wieght:bold;">
						<input type="hidden" name=interpretation[] value=<?=$data[interpretation]?>>
						<?=$data['interpretation']?></td>
					<?} elseif($data['interpretation']=="Invalid"){?>
						<td nowrap align="center" style="color:blue;font-wieght:bold;">
						<input type="hidden" name=interpretation[] value=<?=$data[interpretation]?>>
						<?=$data['interpretation']?></td>
					<?} else {?>
						<td nowrap align="center" style="color:black;">
						<input type="hidden" name=interpretation[] value=<?=$data[interpretation]?>>
						<?=$data['interpretation']?></td>
					<?}?>	
					<td nowrap align="center"><?=$data['flag']?></td>
					<td nowrap align="right"><?=number_format($data['internal_control_rlu'],2,",",".")?></td>
					<td nowrap align="center">
						<input type="hidden" name=internal_Control_result[] value=<?=$data[internal_Control_result]?>>
						<?=$data['internal_Control_result']?></td>
					<td nowrap align="right"><?=number_format($data['analyte_rlu'],2,",",".")?></td>
					<td nowrap align="right"><?=number_format($data['analyte_s_co'],2,",",".")?></td>
					<td nowrap align="left">
						<input type="hidden" name=jenis_sample[] value=<?=$data['type_of_tube']?>>
						<?=$data['type_of_tube']?></td>
					<td nowrap align="left">
						<input type="hidden" name=status_kantong[] value='<?=$statuskantong?>'>
						<?if ($data['type_of_tube']=="Sample"){
							$jmlkantong++;?>
							<?=$statuskantong?>
						<?}?>
							</td>
				</tr><?
		}?>
		<tr class="record">
			<td colspan="2" align="left">Dicatat Oleh </td>
			<input type="hidden" name="namalengkap" value=<?=$namalengkap?>>
			<td colspan="14" align="left"> <?echo $namalengkap;?></td>
		</tr>
		<tr class="record">
			<td colspan="2" align="left">Dicek Oleh</td>
			<td colspan="14" align="left"> 
				<select name="dicek_oleh" > <?
				$user1="select * from user where nama_lengkap not like '%$namalengkap%' order by nama_lengkap";
				$do1=mysql_query($user1);
				while($data1=mysql_fetch_assoc($do1)) {
					$select1=""; ?>
					<option value="<?=$data1[nama_lengkap]?>"<?=$select1?>><?=$data1[nama_lengkap]?></option><?
				}?>
				</select>
			</td>
		</tr>
			<tr class="record">
				<td colspan="2" align="left">Disahkan Oleh</td>
				<td colspan="14" align="left">
					<select name="disahkan_oleh" > <?
						$user="select * from dokter_periksa order by Nama";
						$do=mysql_query($user);
						while($data=mysql_fetch_assoc($do)) {
							$select=""; ?>
							<option value="<?=$data[Nama]?>"<?=$select?>><?=$data[Nama]?></option>
						<? } ?>
					</select>
				</td>
			</tr>
	</table>
	<font size=2"><b>Catatan :</b>
		<ol>
			<li>Kantong darah yang diproses adalah kantong darah dengan status sehat (sudah diskrining IMLTD) dan hasil NAT Valid</li>
			<li>Terhadap kantong yang reaktif IMLTD metode Elisa atau Rapid, tidak lagi di proses, tetapi hasil NAT masih bisa ditelusuri</li>
			<li>Jumlah yang akan diproses adalah : <?=$jmldiproses?> kantong dari <?=$jmlkantong?> kantong yang diperiksa.</li>
		</ol>
		</font>
	<a href="pmiimltd.php?module=import_nat_procleix"class="swn_button">Kembali</a>
	<a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah">
	<input type="submit" name="Button" value="Konfirmasi" title="Proses kantong" class="swn_button"></a>
	</form>
<?}?>
</body>
</html>

