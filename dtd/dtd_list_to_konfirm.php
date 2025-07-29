<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem InforMasi DONor DARah</title>
    <link href="bootsrap337/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootsrap337/js/html5shiv.min.js"></script>
    <script src="bootsrap337/js/respond.min.js"></script>
    <link href="bootsrap337/bspmi.css" rel="stylesheet">
    <script src="bootsrap337/js/jquery.min.js"></script>
    <script src="bootsrap337/js/bootstrap.min.js"></script>
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    -->
</head>
<?php
$message='';
$init_kegiatan=$_POST['jadwal'];
include ('config/db_connect.php');
if (isset($_POST['simpan'])){
	$terkonfirmasi=0;
	$totaldata=0;
	$tgl_skr = date("Y/m/d H:i:s");
	$nama_user=$_SESSION['namauser'];
	for ($i=0; $i<sizeof($_POST['jenis']); $i++) {
		$dt_id=$_POST['id'][$i];
		$jenis_konfirmasi=$_POST['jenis'][$i];
		$totaldata++;
		if ($jenis_konfirmasi!=='-'){
			$terkonfirmasi++;
			$sql="UPDATE `dtd_list` SET
								`dtd_konfirm_stts`='$jenis_konfirmasi',
								`dtd_konfirm_date`='$tgl_skr',
								`dtd_konfirmby`='$nama_user'
								where
								`dtd_id`='$dt_id'";
			$q_konfirm=mysql_query($sql);
		};
		//dtd$message .='<br>'.$terkonfirmasi.' ID: '.$dt_id.' Konfirm: '.$jenis_konfirmasi.' Sql= '.$sql;
	}
	$message .= '<br>'.$terkonfirmasi.' Pendonor yang dikonfirmasi, dari '.$totaldata.' data pendonor dalam list';
}
?>
<body OnLoad="document.list_online.src.focus();" style="margin-top:30px;margin-left:10px;">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
      <div> <?php echo $message;?> </div>
			<div style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">List Pendonor untuk Konfirmasi</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<form class="form-horizontal" method="POST" action="pmip2d2s.php?module=dtd_konfirmasi">
				<div class="form-group">
			    <label class="control-label col-sm-2" for="mu">Pilih MU</label>
  	  		<div class="col-sm-10">
						<div class="input-group" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
							<select name="jadwal" class="form-control">
								<option value='-'>Semua Agenda</option>
							<?php
								$q_mu=mysql_query("SELECT distinct `dtd_agdid`,`TglPenjadwalan`, `Instansi` FROM `v_dtd_list` WHERE `dtd_konfirm_stts`='0'
																		group by `dtd_agdid`,`TglPenjadwalan`, `Instansi`");
							while ($mu=mysql_fetch_assoc($q_mu)){
                  $trans=$mu['dtd_agdid'];
                  if ($trans==$init_kegiatan){
                    echo '<option value="'.$mu['dtd_agdid'].'" selected>'.$mu['TglPenjadwalan'].' :  '.$mu['Instansi'].'</option>';
                  }else{
                    echo '<option value="'.$mu['dtd_agdid'].'">'.$mu['TglPenjadwalan'].' :  '.$mu['Instansi'].'</option>';
                  }
							}?>
							</select>
							<div class="input-group-btn">
                  <input type=submit name="cari" value="Tampilkan" class="btn btn-primary">
                </div>
						</div>
    			</div>
		  	</div>
		</div>
	</div>

<?php
if (isset($_POST['cari'])){
	$src=$_POST['jadwal'];
	if (!empty($src)){?>
    <div class="row">
    	<div class="col-lg- 12">
    		<div class="overflow-x:auto;">
    			<table class="table table-hover table-bordered table-condensed table-responsive">
            <thead  class="pmi">
                <tr>
                  <th>No</th>
                  <th>Konfirmasi</th>
                  <th>Kode</th>
                  <th>Nama</th>
									<th>No HP</th>
                  <th>Gol</th>
                  <th>Alamat</th>
                  <th>Agenda</th>
                </tr>
            </thead>
            <?php
							$sqlWhere='';
							if ($src=='-'){$sqlWhere=" WHERE `dtd_konfirm_stts`='0'";}else{$sqlWhere=" WHERE `dtd_konfirm_stts`='0' AND dtd_agdid='$src'";}
              $q_cari0="SELECT * FROM v_dtd_list".$sqlWhere;
              $q_cari1=mysql_query($q_cari0);
            	$no=0;
              while ($qp=mysql_fetch_assoc($q_cari1)){
                  $no++;
                  echo '<tr>';
                  echo '<td style="text-align:right;" nowrap>'.number_format($no,0,",",".").'.</td>';
                  echo '<td style="text-align:left;" nowrap>
													<select name="jenis[]" class="btn btn-mini">
														<option value="-">-</option>
														<option value="1">Ya</option>
														<option value="2">Tidak</option>
													</select>
													<input type="hidden" name="id[]" value="'.$qp['dtd_id'].'">
												</td>';
                  echo '<td style="text-align:left;"><a href="pmip2d2s.php?module=history&q='.$qp['dtd_kdonor'].'" target="_blank"/>'.$qp['dtd_kdonor'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['Nama'].'</td>';
									echo '<td style="text-align:left;">'.$qp['telp2'].'</td>';
                  echo '<td style="text-align:center;" nowrap>'.$qp['GolDarah'].' '.$qp['Rhesus'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['Alamat'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['TglPenjadwalan'].' : '.$qp['Instansi'].'</td>';
                  echo '</tr>';
              }
              echo '</table>';
              if ($no>0){
                echo '<input class="btn btn-primary" type=submit name="simpan" value="Simpan" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
              }
            
            }
            ?>
				</table>
			</div>
		<div>
  </div>
  </form>
<br><br><div style="font-size: 10px;color: #ff0000;">Update 2020-07-12</div>

<?php } ?>
</div> <!--container-->
<style>
select{
		border: 0.4px;
    width: 100%;
	}
select.btn-mini {
    height: auto;
		border: 0;
    width: 100%;
    line-height: 10px;
}

/* this is optional (see below) */
select.btn {
    -webkit-appearance: button;
       -moz-appearance: button;
            appearance: button;
    padding-right: 1px;
}

select.btn-mini + .caret {
    margin-left: -20px;
    margin-top: 0px;
}
</style>