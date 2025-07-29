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
$init_kegiatan=$_POST['jadwal'];
$src=$_POST['src'];
include ('config/db_connect.php');
if (isset($_POST['konfirmasi'])){
	$kegiatan=$_POST['jadwal'];
	$init_kegiatan=$kegiatan;
	$berhasil=0;
	$dipilih=0;
	$tgl_skr = date("Y/m/d");
	$nama_user=$_SESSION['namauser'];
	for ($i=0; $i<sizeof($_POST['chk']); $i++) {
		$kode_list=$_POST['chk'][$i];
		$dipilih++; 
		$q_i_dtdlist=mysql_query("INSERT INTO `dtd_list`(`dtd_kdonor`, `dtd_tgl_list`, `dtd_user_add`, `dtd_konfirm_stts`,`dtd_agdid`) 
								VALUES ('$kode_list','$tgl_skr','$nama_user','0','$kegiatan')
                ON DUPLICATE KEY
                UPDATE
                `dtd_user_add`='$nama_user',
                `dtd_agdid`='$kegiatan'");
	  if ($q_i_dtdlist>0){$berhasil++;};
	}
	$message= $berhasil.' Pendonor dimasukkan dalam list dari '.$dipilih.' data pendonor yang dipilih';
}
?>
<body OnLoad="document.list_online.src.focus();" style="margin-top:30px;margin-left:10px;">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
      <div> <?php echo $message;?> </div>
			<div style="background-color: #ffffff;font-size:20px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Donor Darah ke rumah</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<form class="form-horizontal" method="POST" action="pmip2d2s.php?module=dtd_caridonor">
				<div class="form-group">
			    <label class="control-label col-sm-2" for="mu">Kegiatan</label>
  	  		<div class="col-sm-10">
  	  		  <select name="jadwal" class="form-control" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
						<?php
							$q_mu=mysql_query("SELECT k.`NoTrans`, date_format(k.`TglPenjadwalan`,'%d-%m-%Y') tgl, d.nama as nama_instansi
									 FROM `kegiatan` k  inner join detailinstansi d on d.KodeDetail=k.`kodeinstansi`
									 WHERE  cast(k.TglPenjadwalan as date)>=current_date and k.Status < 4  ORDER BY k.TglPenjadwalan ASC");
						while ($mu=mysql_fetch_assoc($q_mu)){
							$trans=$mu['NoTrans'];
							if ($trans==$init_kegiatan){
								echo '<option value="'.$mu['NoTrans'].'" selected>'.$mu['tgl'].' :  '.$mu['nama_instansi'].'</option>';
							}else{
								echo '<option value="'.$mu['NoTrans'].'">'.$mu['tgl'].' :  '.$mu['nama_instansi'].'</option>';
							}
						}?>
						</select>
    			</div>
		  	</div>
				
				<div class="form-group">
			    <label class="control-label col-sm-2" for="mu">Cari</label>
  	  		<div class="col-sm-10">
              <div class="input-group" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);">
                <input class="form-control" type="text" name="src" value="<?php echo $src; ?>" placeholder="Alamat, wilayah" autocomplete=off autofocus >
                <div class="input-group-btn">
                  <input type=submit name="cari" value="Cari Pendonor" class="btn btn-primary">
                </div>
              </div>
    			</div>
		  	</div>

			
		</div>
	</div>

<?php
if (isset($_POST['cari'])){
	$src=$_POST['src'];
	if (!empty($src)){?>
    <div class="row">
    	<div class="col-lg- 12">
    		<div class="overflow-x:auto;">
    			<table class="table table-hover table-bordered table-condensed table-responsive">
            <thead  class="pmi">
                <tr>
                  <th>No</th>
                  <th>Chk</th>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Gol</th>
                  <th>Alamat</th>
                  <th>Kelurahan</th>
                  <th>Kecamatan</th>
                  <th>Kabupaten</th>
                  <th>No HP</th>
                  <th>Donasi</th>
                  <th>Tgl Kembali</th>
                  <th>Setahun</th>
                </tr>
            </thead>
            <?php
              $q_cari0="SELECT p.*,d.Jml 
                        FROM `pendonor` p left join `donasi_oneyear_byid` d on d.KodePendonor=p.Kode 
                        WHERE p.jumDonor>=1 AND date(p.`tglkembali`)<=current_date and p.Cekal='0' AND (LENGTH(p.telp2)>5) AND (p.`Alamat` like '%$src%'  or 
                        p.`kelurahan` like '%$src%' OR p.`kecamatan`  like '%$src%' OR p.`wilayah` like '%$src%') order by d.Jml DESC, p.ALamat ASC, p.Nama ASC";
              $q_cari1=mysql_query($q_cari0);
            	$no=0;
              while ($qp=mysql_fetch_assoc($q_cari1)){
                  $no++;
                  echo '<tr>';
                  echo '<td style="text-align:right;" nowrap>'.number_format($no,0,",",".").'.</td>';
                  echo '<td style="text-align:center;" nowrap><input class="checkbox" type="checkbox" id="chk1" name="chk[]" value="'.$qp['Kode'].'"></td>';
                  echo '<td style="text-align:left;"><a href="pmip2d2s.php?module=history&q='.$qp['Kode'].'" target="_blank"/>'.$qp['Kode'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['Nama'].'</td>';
                  echo '<td style="text-align:center;" nowrap>'.$qp['GolDarah'].' '.$qp['Rhesus'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['Alamat'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['kelurahan'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['kecamatan'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['wilayah'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['telp2'].'</td>';
                  echo '<td style="text-align;center;">'.$qp['jumDonor'].'</td>';
                  echo '<td style="text-align:left;">'.$qp['tglkembali'].'</td>';
                  echo '<td style="text-align:center;">'.$qp['Jml'].'</td>';
                  echo '</tr>';
              }
              if ($no=='0'){
                  echo '<tr>';
                  echo '<td align=center colspan="20">Tidak ada data pendonor yang anda cari</td>';
                  echo '</tr>';
              }
              echo '</table>';
              if ($no>0){
                echo '<input class="btn btn-primary" type=submit name="konfirmasi" value="Masukkan yang dipilih ke dalam list" style=";box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
              }
            
            }
            ?>
				</table>
			</div>
		<div>
  </div>
  </form>
<div style="font-size: 10px;color: #ff0000;">Update 2020-07-12</div>

<?php } ?>
</div> <!--container-->
