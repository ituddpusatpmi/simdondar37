<?php
	include "koneksi.php";
	//include "index.php";
	
	$detail = $_GET['detail'];
	
	$sql="select * from ik where kontrol2='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
	<script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="jquery-ui-1.10.3/demos.css">
<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$("#datepicker").change(function(){
			$("#datepicker").datepicker("option","dateFormat","dd MM yy");
			});
	});
</script>
<script>
	$(function() {
		$( "#datepicker2" ).datepicker();
		$("#datepicker2").change(function(){
			$("#datepicker2").datepicker("option","dateFormat","dd MM yy");
			});
	});
</script>
<script>
	$(function() {
		$( "#datepicker3" ).datepicker();
		$("#datepicker3").change(function(){
			$("#datepicker3").datepicker("option","dateFormat","dd MM yy");
			});
	});
</script>
<style type="text/css">
		.ui-datepicker {
				font-family:Garamond;
				font-size:12px;
				margin-left:10px
				}
.COOPER {
	font-family: Cooper Black;
}
.coper {
	font-family: Cooper Black;
}
</style>
<style>
.button1 {
  padding: 10px 20px;
  font-size: 12px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #556B2F;
  border: none;
  border-radius: 8px;
  box-shadow: 0 5px #999;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
	font-size:12px;
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}


</style>
</head>

<body>
<br />
<p align="center" class="COOPER"><font size="5"><u>FORM PENGELUARAN DOKUMEN IK<br /><?php echo $data['nama1']; ?></u></font></p>
<?php
	$sql="select ik.terkait as nama, pks.kontrol as kontrol, pks.kontrol2 as kontrol2, pks.kontrol3 as kontrol3  from pks,ik where pks.nama1=ik.terkait and ik.nomor='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
?>
<p align="center"><?php echo $data['nama']; ?><?php echo $data['kontrol']; ?><?php echo $data['kontrol2']; ?><?php echo $data['kontrol3']; ?></p>
<?php
	$sql="select * from ik where kontrol2='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
?>
  <form method="post" action="keluar_data_ik.php" enctype="multipart/form-data">
  
  
<input type="text" name="bidang_riwayat" value="<?php echo $data['bidang']; ?>" style="display:none" />
<input type="text" name="nama1_riwayat" value="<?php echo $data['nama1']; ?>" style="display:none" />
<input type="text" name="kontrol2_riwayat" value="<?php echo $data['kontrol2']; ?>" style="display:none" />
<input type="text" name="versi_riwayat" value="<?php echo $data['no_versi']; ?>" style="display:none" />
<input type="text" name="keluar_riwayat" value="<?php echo $data['tgl_keluar1']; ?>" style="display:none" />

  
  <table align="center" border="1" cellpadding="10" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td valign="top">
      <table align="center">
        <tr>
          <td><div align="right"><strong>Bidang</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <select name="bidang">
              <option><?php echo $data['bidang']; ?></option>	    
            </select>
          </strong></div>            <strong><text style="display:none">
              <div align="left">
                <input type="text" name="nomor" value="<?php echo $data['nomor']; ?>" />
              </div>
            </text>
            </strong></td>
        </tr>

        <tr>
          <td><div align="right"><strong>Judul Dokumen</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <input type="text" name="nama1" size="50" readonly="readonly" value="<?php echo $data['nama1']; ?>" />
          </strong></div></td>
          </tr>
        
        <tr>
          <td><div align="right"><strong>No. Kontrol Dokumen</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <input type="text" style="background:yellow;" readonly="readonly" name="kontrol2" size="20" value="<?php echo $data['kontrol2']; ?>" />	
          </div></td>
          </tr>

	<tr>
          <td><div align="right"><strong>No. Versi</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <input type="text" name="no_versi" size="10" readonly="readonly" value="<?php echo $data['no_versi']; ?>" />
          </strong></div></td>
          </tr>
        
	 <tr>
          <td><div align="right"><strong>Tujuan</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <input type="text" name="tujuan1" size="50" required="" />
          </strong></div></td>
          </tr>

	<tr>
          <td><div align="right"><strong>Jumlah Dokumen Yang Dikeluarkan</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <input type="text" name="jumlah1" size="10" required="" />
          </strong></div></td>
          </tr>

	<tr>
          <td><div align="right"><strong>No. Surat Pengantar</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <input type="text" name="pengantar1" size="20" required="" />
          </strong></div></td>
          </tr>

        <tr>
          <td><div align="right"><strong>Tanggal Keluar</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <input type="text" name="tgl_keluar1" required="" placeholder="Tahun-Bulan-Tanggal"  />
          </strong></div></td>
          </tr>
        <tr>
          <td><div align="right"><strong>Petugas Yang Mengeluarkan</strong></div></td>
          <td><strong>:</strong></td>
          <td><div align="left"><strong>
            <select name="petugas1">
              <option></option>
              <?php
    			$query = "select * from user order by nama_lengkap";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama_lengkap]</option>";
    			}
			?>
            </select>
          </strong></div></td>
          </tr>
        
	

	<!--awal upload
    <tr>
    	<td><div align="right"><strong>Upload Dokumen</strong></div></td>
        <td><strong>:</strong></td>
        <td><div align="left"><strong>
          
		<input type="file" name="fileupload" id="fileupload" class="form-control" />
        </strong></div></td>
    </tr>
	akhir upload-->

        <tr>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td colspan="3" align="right"><input class="button1" type="submit" name="upload" value="Simpan" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table>
      </td>
  </tr>
  </table>
  </form>
<br />
<p align="center"><b> Riwayat Pengeluaran Dokumen IK</b></p>
<table align="center">
<tr>
	<td><strong>No</strong></td>
    <td><strong>Bidang</strong></td>
    <td><strong>Judul Dokumen</strong></td>
    <td><strong>No. Kontrol Dokumen</strong></td>
    <td><strong>No. Versi</strong></td>
    <td><strong>Tujuan</strong></td>
    <td><strong>Jumlah Dokumen Yang Dikeluarkan</strong></td>
    <td><strong>No. Surat Pengantar</strong></td>
    <td><strong>Tanggal Keluar</strong></td>
    <td><strong>Petugas Yang Mengeluarkan</strong></td>
    
</tr>
<?php
	$detail = $_GET['detail'];
 	$donor="select * from riwayat_keluar where kontrol2='$detail' order by tgl_keluar ASC";
	//$donor = "select * from riwayat where nama1 like '%IKM%' order by nomor desc";
	
	// awal Konversi tanggal ke bahasa indonesia
	function format_indo($date){
    	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    	$tahun = substr($date, 0, 4);               
    	$bulan = substr($date, 5, 2);
    	$tgl   = substr($date, 8, 2);
    	$result = $tgl . " " . $BulanIndo[(int)$bulan-1]. " ". $tahun;
    	return($result);
	}
	// akhir Konversi tanggal ke bahasa indonesia

	$proses = mysql_query($donor);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
<tr>
	<td><?php echo $nourut; ?></td>
    <td><?php echo $data['bidang']; ?></td>
    <td><?php echo $data['nama1']; ?></td>
    <td><?php echo $data['kontrol2']; ?></td>
    <td><?php echo $data['no_versi']; ?></td>
    <td><?php echo $data['tujuan']; ?></td>
    <td><?php echo $data['jumlah']; ?></td>
    <td><?php echo $data['nomor_pengantar']; ?></td>
    <td><?php echo format_indo($data['tgl_keluar']); ?></td>
    <td><?php echo $data['petugas']; ?></td>
    
</tr>
<?php
		}
		?>
</table>
<br />
</body>
</html>
