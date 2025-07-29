<head>
<script type="text/javascript" src="js/disable_enter.js"></script>
<link rel="stylesheet" href="bootsrap337/bspmi.css">
<link rel="stylesheet" href="bootsrap337/w3.css">
<link rel="stylesheet" href="puf/puf.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<style>
	.form-group{
		margin-bottom:2px;
	}
</style>
</head>
<?php
require_once('config/dbi_connect.php');
require_once('clogin.php');
$namauser	= $_SESSION['namauser'];
$lv0		= $_SESSION['leveluser'];
$q_udd		= mysqli_fetch_assoc(mysqli_query($dbi,"select * from utd where aktif='1'"));
$zona_waktu	= $q_udd['zonawaktu'];
date_default_timezone_set($zona_waktu);
$namaudd	= $q_udd['nama'];
$namalab	= $namaudd;
$v_tgl	=date('Y-m-d H:i');
if($_GET['op']=='del'){
	$mode_edit='1';
	$nat_id=$_GET['id'];
	mysqli_query($dbi, "DELETE FROM `hasilnat` WHERE `natid`='$nat_id'");
}
if (isset($_POST['simpan2'])) {
	$mode_edit=$_POST['mode'];
	if ( (!empty($_POST['sample'])) and (!empty($_POST['od'])) ){
		$v_tgl		= $_POST['tanggal'];
		$namalab	= $_POST['tempat_periksa'];
		$v_reagen	= $_POST['reagennat'];
		$v_lot		= $_POST['lotnat'];
		$v_metode	= $_POST['metodenat'];
		$v_ed 		= $_POST['ednat'];
		$v_sample	= strtoupper($_POST['sample']);
		$v_kantong   = $v_sample; 
		$v_od 		= $_POST['od'];
		$v_hasil	= $_POST['t_hasil'];
		$v_notran	= '-';
		$stok=mysqli_fetch_assoc(mysqli_query($dbi,"select `noKantong`,`gol_darah`, `RhesusDrh` from `stokkantong` where upper(`noKantong`)='$v_kantong'"));
		$nokantong=$stok['noKantong'];
		if (!empty($nokantong)){
			$gol_darah = $stok['gol_darah'];
			$rhesus_darah = $stok['RhesusDrh'];
		}else{
			$stok=mysqli_fetch_assoc(mysqli_query($dbi,"select `sk_kode`,`sk_gol`, `sk_rh` from `samplekode` where upper(`sk_kode`)='$v_kantong'"));
            $gol_darah = $stok['sk_gol'];
            $rhesus_darah = $stok['sk_rh'];
		}
		$i_sample="INSERT INTO `hasilnat`(`idsample`, `tempat_periksa`, `noKantong`, `OD`, `COV`, `nat_goldarah`, `nat_rhesus`, 
								`Hasil`, `notrans`, `tglPeriksa`, `dicatatOleh`, `noLot`,`ed`, `reagen`,`Metode`) 
								VALUES  ('$v_sample','$namalab', '$v_kantong','$v_od', '1','$gol_darah', '$rhesus_darah', 
								'$v_hasil','-', '$v_tgl', '$namauser','$v_lot', '$v_ed','$v_reagen','$v_metode')";
		mysqli_query($dbi,$i_sample);
	}
}

if (isset($_POST['simpan'])) { 
		$v_tgl		= $_POST['tgl'];
		// generate kode transaksi==========================================
		$k_today="N".date("dmy")."-";
		$idp	= mysqli_query($dbi,"select notrans from hasilnat where notrans like '$k_today%'order by notrans DESC limit 1");
		$idp1	= mysqli_fetch_assoc($idp);
		$idp2	= substr($idp1['notrans'],8,3);
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
		$upd=mysqli_query($dbi,"UPDATE `hasilnat` SET `notrans`='$v_notransaksi' WHERE (`notrans`='-' AND `dicatatOleh`='$namauser')");
		$mode_edit='0';

		//=======Audit Trail====================================================================================
		$selnat=mysqli_query($dbi,"select `idsample`, case when `Hasil`='0' THEN 'Non Reaktif' WHEN `hasil`='1' THEN 'Reaktif' WHEN `hasil`='2' THEN 'Greyzone' END AS `hasil` from `hasilnat` WHERE `notrans`='$v_notransaksi'");
		while ($dt=mysqli_fetch_assoc($selnat)){
			$log_mdl ='IMLTD';
			$log_aksi='IMLTD NAT Sample/Kantong : '.$dt['idsample'].', No: '.$v_notransaksi. ', hasil: '.$dt['hasil'];
			include('user_log.php');
		}
		//=====================================================================================================
} 
if ($mode_edit!=='1'){
	mysqli_query($dbi,"DELETE FROM `hasilnat` WHERE `notrans`='-' and `dicatatOleh`='$namauser'");
	mysqli_query($dbi,"OPTIMIZE TABLE `hasilnat`");
}
	$nat0="SELECT *,date(tglPeriksa) as tanggal FROM `hasilnat` WHERE `notrans`='-' and `dicatatOleh`='$namauser'";
	$nat=mysqli_fetch_assoc(mysqli_query($dbi,$nat0));
	if(!empty($nat['tanggal'])){
		$today=$nat['tanggal'];
		$namalab=$nat['tempat_periksa'];
	}else{
		$today=date('Y-m-d');
		$namalab=$namaudd;
	}
    ?>
	<body onLoad=setFocus() style="margin:30px;">
		<form name="kantong" onsubmit="return ok()" method="POST" action="" class="form-horizontal">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-primary">
							<div class="panel-heading w3-theme-d5">
									<h3 class="panel-title">Pemeriksaan ABS </h3>
							</div>
							<div class="panel-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-3 control-label" for="tanggal">Tanggal Periksa:</label>
												<div class="col-sm-9">
													<div class="input-group date">
														<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $v_tgl;?>">
														<span class="input-group-addon">
															<i class="glyphicon glyphicon-calendar"></i>
														</span>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label" for="tempat_periksa" >Tempat periksa:</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="tempat_periksa" name="tempat_periksa" value="<?php echo $namalab;?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label" for="reagennat">Nama Reagen:</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="reagennat" name="reagennat" value="<?php echo @$v_reagen;?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label" for="metodenat">Metode Pemeriksaan:</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="metodenat" name="metodenat" value="<?php echo @$v_metode;?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label" for="lotnat">No Lot Reagen:</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="lotnat" name="lotnat" value="<?php echo @$v_lot;?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label" for="ednat">Tgl ED Reagen:</label>
												<div class="col-sm-9">
													<div class="input-group date">
														<input type="text" class="form-control" id="ednat" name="ednat" value="<?php echo @$v_ed;?>">
														<span class="input-group-addon">
															<i class="glyphicon glyphicon-calendar"></i>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<table class="table table-responsive table-bordered">
												<tr class="w3-theme-d2">
													<th>Sample</th>
													<th>Ration/OD</th>
													<th>Hasil</th>
												</tr>
												<tr>
													<td class="input"><input type="text"  name="sample" id="sample" style="width:5cm;"></td>
													<td><input type="text"  name="od" id="od" style="width:3cm;" autocomplete="off" value="0.001"></td>
													<td>
														<select name="t_hasil" style="width:3cm;">
															<option value='0'>Non Reaktif</option>
															<option value='1'>Reaktif</option>
															<option value='2'>Grayzone</option>
														</select>
														<input type="hidden" name="mode" value="1">
														<input name="simpan2" type="submit" value="Ok" class="swn_button_blue">
													</td>
													</tr>
											</table>

											<table id="samplecov" class="table table-responsive table-bordered" id="samplecov">
												<tr class="w3-theme-d4">
													<th>No</th>
													<th>Sampel</th>
													<th>Gol & Rh</th>
													<th>Ratio/OD</th>
													<th>Hasil</th>
													<th>Aksi</th>
												</tr>
													<?php 
													$natd=mysqli_query($dbi,$nat0);
													$no=0;
													while ($row=mysqli_fetch_assoc($natd)){
														switch($row['Hasil']){
															case "0";$hasil='Non Reaktif';break;
															case "1";$hasil='Reaktif';break;
															case "2";$hasil='Greyzone';break;
															default : $hasil='?';	
														}
														$no++;
														echo '
															<tr>
																<td style="text-align:right;">'.$no.'.</td>
																<td style="text-align:left;">'.$row['idsample'].'</td>
																<td style="text-align:center;">'.$row['nat_goldarah'].$row['nat_rhesus'].'</td>
																<td style="text-align:center;">'.$row['OD'].'</td>
																<td style="text-align:left;">'.$hasil.'</td>';?>
																<td><a href="?module=nat_manual&op=del&id=<?php echo $row['natid'];?>">Hapus</a></td>
															</tr><?php
													}?>
											</table>

										</div>
									</div>
							</div>
							<div class="panel-footer text-center">
								<button name="simpan" type="submit" class="w3-btn w3-theme-d4 w3-hover-yellow w3-border-theme"><i class="glyphicon glyphicon-floppy-save"></i>Simpan</button>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</form>
</body>
	<script>
        $(document).ready(function(){
			$('#tanggal').datetimepicker({
				format: 'YYYY-MM-DD HH:mm',
				icons: {
					time: 'glyphicon glyphicon-time',
					date: 'glyphicon glyphicon-calendar',
					up: 'glyphicon glyphicon-chevron-up',
					down: 'glyphicon glyphicon-chevron-down',
					previous: 'glyphicon glyphicon-chevron-left',
					next: 'glyphicon glyphicon-chevron-right',
					today: 'glyphicon glyphicon-crosshair',
					clear: 'glyphicon glyphicon-trash',
					close: 'glyphicon glyphicon-remove'
				}
			});
			$('#ednat').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true
			});
			$(document).on('keypress', '.noEnterSubmit', function(e) {
                if (e.which == 13) return false;
            });
			function setFocus(){document.kantong.nokantong.focus();}
		});
    </script>