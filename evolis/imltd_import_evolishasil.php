<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
<script src="bootsrap337/js/html5shiv.min.js"></script>
<script src="bootsrap337/js/respond.min.js"></script>
<link href="bootsrap337/bspmi.css" rel="stylesheet">
<script src="bootsrap337/js/jquery.min.js"></script>
<script src="bootsrap337/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="bootsrap337/fonts/font-awesome.min.css" />
<link type="text/css" href="css/calender.css" rel="stylesheet" /> 
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style>
    .sdw{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>

<body style="margin: 20px;">
<?php 
	$tanggal=date('Y-m-d');
  	if (isset($_POST['ok'])){
		$tablecontent ="";
		$sel1=$sel2=$sel3=$sel4;
		$v_parameter=$_POST['pilihanParameter'];
		$namafile = $_FILES['filehbsag']['tmp_name'];
		if ($namafile==""){
			$tablecontent= '<h3 class="text-danger">File hasil Evolis belum dimasukkan!!!</h3>';
		}else{
			$pemisah="|";
			$filehasil = fopen($namafile, "r");
			$tablecontent  ='  <div class="table-responsive">';
			$tablecontent .='    <table class="table table-responsive table-bordered table-hover table-condensed">';
			$tablecontent .='      <thead class="bg-primary">';
			$tablecontent .='        <th>No</th>';
			$tablecontent .='        <th>Sample</th>';
			$tablecontent .='        <th>Parameter</th>';
			$tablecontent .='        <th>Well</th>';
			$tablecontent .='        <th>Flag</th>';
			$tablecontent .='        <th>Value</th>';
			$tablecontent .='        <th>S/CO</th>';
			$tablecontent .='        <th>Result</th>';
			$tablecontent .='        <th>Ket</th>';
			$tablecontent .='        <th>Qry</th>';
			$tablecontent .='      </thead>';
			$tablecontent .='      <tbody>';
			$no=0;
			$startsamplerow=0;
			while (($data = fgetcsv($filehasil, 200, $pemisah)) !== FALSE){
			$msg="";
			$startsamplerow++;
			if ($startsamplerow>4){
				if ( ($data[0]!=="") AND ($data[0]!=="[End Of Results]")){
					$no++;
					$tablecontent .= '<tr>';
					$tablecontent .= '<td>'.$no.'</td>';
					$tablecontent .= '<td>'.$data[0].'</td>';
					$tablecontent .= '<td>'.$data[1].'</td>';
					$tablecontent .= '<td>'.$data[2].'</td>';
					$tablecontent .= '<td>'.$data[3].'</td>';
					$tablecontent .= '<td>'.$data[4].'</td>';
					$tablecontent .= '<td>'.$data[5].'</td>';
					$tablecontent .= '<td>'.$data[6].'</td>';
					$tablecontent .= '<td>'.$data[7].'</td>';
					$nosample=$data[0];
					$flag=$data[3];
					$value=$data[4];
					$sco=$data[5];
					$result=$data[6];
					$ket=$data[7];
					$msg="";
					if ($nosample!=="[End Of Results]"){
						switch($v_parameter){
							case "0" :
								$sel1='selected';
								$qryi = "INSERT INTO `imltd_import_temp` (`tanggal`, `nokantong`, `hbsag_od`, `hbsag_cut_off`, `hbsag_result`, `hbsag_reader`) VALUES ('$tanggal','$nosample', '$value', '$sco', '$result', '$flag')";
								$qryu = "UPDATE `imltd_import_temp` SET `tanggal`='$tanggal',  `hbsag_od`='$value', `hbsag_cut_off`='$sco', `hbsag_result`='$result', `hbsag_reader`='$flag' WHERE`nokantong`='$nosample'";break;
							case "1" :
								$sel2='selected';
								$qryi = "INSERT INTO `imltd_import_temp` (`tanggal`, `nokantong`, `hcv_od`, `hcv_cut_off`, `hcv_result`, `hcv_reader`) VALUES ('$tanggal','$nosample', '$value', '$sco', '$result', '$flag')";
								$qryu = "UPDATE `imltd_import_temp` SET `tanggal`='$tanggal',  `hcv_od`='$value', `hcv_cut_off`='$sco', `hcv_result`='$result', `hcv_reader`='$flag' WHERE`nokantong`='$nosample'";break;
							case "2" :
								$sel3='selected';
								$qryi = "INSERT INTO `imltd_import_temp` (`tanggal`, `nokantong`, `hiv_od`, `hiv_cut_off`, `hiv_result`, `hiv_reader`) VALUES ('$tanggal','$nosample', '$value', '$sco', '$result', '$flag')";
								$qryu = "UPDATE `imltd_import_temp` SET `tanggal`='$tanggal',  `hiv_od`='$value', `hiv_cut_off`='$sco', `hiv_result`='$result', `hiv_reader`='$flag' WHERE`nokantong`='$nosample'";break;
							case "3" :
								$sel4='selected';
								$qryi = "INSERT INTO `imltd_import_temp` (`tanggal`, `nokantong`, `syp_od`, `syp_cut_off`, `syp_result`, `syp_reader`) VALUES ('$tanggal','$nosample', '$value', '$sco', '$result', '$flag')";
								$qryu = "UPDATE `imltd_import_temp` SET `tanggal`='$tanggal',  `syp_od`='$value', `syp_cut_off`='$sco', `syp_result`='$result', `syp_reader`='$flag' WHERE`nokantong`='$nosample'";break;
						}
						$chk="SELECT `nokantong` from `imltd_import_temp` WHERE `nokantong`='$nosample'";
						$chkkantong =mysqli_query($dbi,"SELECT `nokantong` from `imltd_import_temp` WHERE `nokantong`='$nosample'");
						if(mysqli_num_rows($chkkantong)>0){
							$msg="U";
							$qry=mysqli_query($dbi,$qryu);
						}else{
							$qry=mysqli_query($dbi,$qryi);
							$msg="I";
						}
					}
					$tablecontent .= '<td>'.$msg.'</td>';
					$tablecontent .= '</tr>';
				}
			}
			}
			$tablecontent .= '<tbody></table></div>';
		}
    }
  ?>
<div class="container-fluid">
  	<h3 class="text-success">Evolis Biorad - Import hasil</h3>
  	<div class="row">
      	<div class="col-sm-8">
		  	<div class="panel panel-danger sdw">
				  	<div class="panel-body">
						<form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-sm-3">Parameter Pemeriksaan</label>
								<div class="col-xs-9">
								<select name="pilihanParameter" id="pilihanParameter" class="form-control">
									<option value="0" <?php echo $sel1;?> >Parameter Hbsag</option>
									<option value="1" <?php echo $sel2;?> >Parameter HCV</option>
									<option value="2" <?php echo $sel3;?> >Parameter HIV</option>
									<option value="3" <?php echo $sel4;?> >Parameter Sypilis/TPHA</option>
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">File Hasil Pemeriksaan</label>
								<div class="col-xs-9">
									<div class="input-group">
										<input type="file" id="filehbsag" name="filehbsag" class="btn btn-default form-control">
										<div class="input-group-btn">
											<input type="submit" class="btn btn-primary" name="ok" value="Upload">
										</div>
									</div>
								</div>
							</div>
						</form>
				  	</div>
					<div class="panel-footer text-center">
					  	<div class="btn-group btn-block">
			  				<a href="?module=import_evolisproses&op=del&m=import" class="btn btn-danger sdw">Clear Temporary</a> 
							<a href="?module=import_evoliskonfirmasi" class="btn btn-success sdw">Konfirmasi Hasil</a>
							<a href="?module=evolisbiorad" class="btn btn-primary sdw">Kembali</a>
			  			</div>
					</div>
			  	</div>
		  	</div>
      	</div>
  	</div>
	<div class="row">
		<div class="col-sm-8">
			<div class="panel">
				<div class="panel-body"><?php echo $tablecontent;?>	
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>