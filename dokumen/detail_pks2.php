<?php
	include "koneksi.php";
	//include "index.php";
	
	$detail = $_GET['detail'];
	
	$sql="select * from pks where nama1='$detail'";
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
			$("#datepicker").datepicker("option","dateFormat","dd M yy");
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
<style>
* {
    box-sizing: border-box;
}

.columns {
    float: center;
    width: 50%;
    padding: 8px;
	alignment-adjust:central;
}

.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
}

.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
    background-color: #111;
    color: white;
    font-size: 25px;
}

.price li {
    border-bottom: 1px solid #eee;
    padding: 20px;
    text-align: center;
}

.price .grey {
    background-color: #eee;
    font-size: 20px;
}


@media only screen and (max-width: 700px) {
    .columns {
        width: 100%;
    }
}
</style>
<style>
.button {
  padding: 10px 20px;
  font-size: 12px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 8px;
  box-shadow: 0 5px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 3px #666;
  transform: translateY(3px);
}
</style>
</head>

<body>
<br />
<p align="center" class="COOPER"><font size="5"><u>STANDAR PROSEDUR OPERASIONAL</u><br /><?php echo $data['nama1']; ?></font><br />
<?php echo $data['kontrol2']; ?></p>
  
  <div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#F99">Instruksi Kerja Manual</li>
    <br />
    <table align="center">
    <tr>
    	<td><strong>No</strong></td>
        <td><strong>Judul</strong></td>
        <td><strong>No. Dokumen</strong></td>
        <td><strong>Tgl Disetujui</strong></td>
        <td><strong>Tgl Berlaku</strong></td>
        <td><strong>Tgl Kaji Ulang</strong></td>
    </tr>
    <?php
	$donor = "select * from ik where terkait='$detail'";
	$proses = mysql_query($donor);

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

	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
        <tr>
    <td><?php echo $nourut; ?><br />
    <a href="detail_ik.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/ubah.png"></img></a>&nbsp;&nbsp;<a href="hapus_ik.php?hapus=<?php echo $data['kontrol2']; ?>"><img src="images/hapus.png"></img></a></td> 
	<td><?php echo $data['nama1']; ?></td>
    <td><?php echo $data['kontrol2']; ?></td>
    <td><?php echo format_indo($data['tgl_setuju']); ?></td>
    <td><?php echo format_indo($data['tgl_pelaksanaan']); ?></td>
    <td><?php echo format_indo($data['tgl_peninjauan']); ?></td>
    <?php
		}
		?>
        </tr>
        </table>
        <?php
        $sql="select * from pks where nama1='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <li class="grey"><a href="input_ik.php?detail=<?php echo $data['nama1']; ?>" class="button">Tambah Dokumen</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#F99">Instruksi Kerja Alat</li>
    <br />
    <table align="center">
    <tr>
    	<td><strong>No</strong></td>
        <td><strong>Judul</strong></td>
        <td><strong>No. Dokumen</strong></td>
        <td><strong>Tgl Disetujui</strong></td>
        <td><strong>Tgl Berlaku</strong></td>
        <td><strong>Tgl Kaji Ulang</strong></td>
    </tr>
    <?php
	$donor = "select * from ika where terkait='$detail'";
	$proses = mysql_query($donor);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
        <tr>
    <td><?php echo $nourut; ?><br />
    <a href="detail_ika.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/ubah.png"></img></a>&nbsp;&nbsp;<a href="hapus_ika.php?hapus=<?php echo $data['kontrol2']; ?>"><img src="images/hapus.png"></img></a></td> 
	<td><?php echo $data['nama1']; ?></td>
    <td><?php echo $data['kontrol2']; ?></td>
    <td><?php echo format_indo($data['tgl_setuju']); ?></td>
    <td><?php echo format_indo($data['tgl_pelaksanaan']); ?></td>
    <td><?php echo format_indo($data['tgl_peninjauan']); ?></td>
    <?php
		}
		?>
        </tr>
        </table>
        <?php
        $sql="select * from pks where nama1='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <li class="grey"><a href="input_ika.php?detail=<?php echo $data['nama1']; ?>" class="button">Tambah Dokumen</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#F99">Formulir</li>
    <br />
    <table align="center">
    <tr>
    	<td><strong>No</strong></td>
        <td><strong>Judul</strong></td>
        <td><strong>No. Dokumen</strong></td>
        <td><strong>Tgl Disetujui</strong></td>
        <td><strong>Tgl Berlaku</strong></td>
        <td><strong>Tgl Kaji Ulang</strong></td>
    </tr>
    <?php
	$donor = "select * from formulir where terkait='$detail'";
	$proses = mysql_query($donor);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
        <tr>
    <td><?php echo $nourut; ?><br />
    <a href="detail_formulir.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/ubah.png"></img></a>&nbsp;&nbsp;<a href="hapus_formulir.php?hapus=<?php echo $data['kontrol2']; ?>"><img src="images/hapus.png"></img></a></td> 
	<td><?php echo $data['nama1']; ?></td>
    <td><?php echo $data['kontrol2']; ?></td>
    <td><?php echo format_indo($data['tgl_setuju']); ?></td>
    <td><?php echo format_indo($data['tgl_pelaksanaan']); ?></td>
    <td><?php echo format_indo($data['tgl_peninjauan']); ?></td>
    <?php
		}
		?>
        </tr>
        </table>
        <?php
        $sql="select * from pks where nama1='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <li class="grey"><a href="input_formulir.php?detail=<?php echo $data['nama1']; ?>" class="button">Tambah Dokumen</a></li>
  </ul>
</div>
  
<!-- Terpisah
  <div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#F99">Dokumen Eksternal</li>
    <br />
    <table align="center">
    <tr>
    	<td><strong>No</strong></td>
        <td><strong>Judul</strong></td>
        <td><strong>No. Dokumen</strong></td>
        <td><strong>Tgl Disetujui</strong></td>
        <td><strong>Tgl Berlaku</strong></td>
        <td><strong>Tgl Kaji Ulang</strong></td>
    </tr>
    <?php
	$donor = "select * from eksternal where terkait='$detail'";
	$proses = mysql_query($donor);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
        <tr>
    <td><?php echo $nourut; ?><br />
    <a href="detail_eksternal.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/ubah.png"></img></a>&nbsp;&nbsp;<a href="hapus_eksternal.php?hapus=<?php echo $data['kontrol2']; ?>"><img src="images/hapus.png"></img></a></td> 
	<td><?php echo $data['nama1']; ?></td>
    <td><?php echo $data['kontrol2']; ?></td>
    <td><?php echo format_indo($data['tgl_setuju']); ?></td>
    <td><?php echo format_indo($data['tgl_pelaksanaan']); ?></td>
    <td><?php echo format_indo($data['tgl_peninjauan']); ?></td>
    <?php
		}
		?>
        </tr>
        </table>
        <?php
        $sql="select * from pks where nama1='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <li class="grey"><a href="input_eksternal.php?detail=<?php echo $data['nama1']; ?>" class="button">Tambah Dokumen</a></li>
  </ul>
</div>
-->
<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#F99">Dokumen Pendukung</li>
    <br />
    <table align="center">
    <tr>
    	<td><strong>No</strong></td>
        <td><strong>Judul</strong></td>
        <td><strong>No. Dokumen</strong></td>
        <td><strong>Tgl Disetujui</strong></td>
        <td><strong>Tgl Berlaku</strong></td>
        <td><strong>Tgl Kaji Ulang</strong></td>
    </tr>
    <?php
	$donor = "select * from pendukung where terkait='$detail'";
	$proses = mysql_query($donor);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
        <tr>
    <td><?php echo $nourut; ?><br />
    <a href="detail_pendukung.php?detail=<?php echo $data['kontrol2']; ?>"><img src="images/ubah.png"></img></a>&nbsp;&nbsp;<a href="hapus_pendukung.php?hapus=<?php echo $data['kontrol2']; ?>"><img src="images/hapus.png"></img></a></td> 
	<td><?php echo $data['nama1']; ?></td>
    <td><?php echo $data['kontrol2']; ?></td>
   <td><?php echo format_indo($data['tgl_setuju']); ?></td>
    <td><?php echo format_indo($data['tgl_pelaksanaan']); ?></td>
    <td><?php echo format_indo($data['tgl_peninjauan']); ?></td>
    <?php
		}
		?>
        </tr>
        </table>
        <?php
        $sql="select * from pks where nama1='$detail'";
	$proses=mysql_query($sql);
	$data=mysql_fetch_array($proses);
	?>
    <li class="grey"><a href="input_pendukung.php?detail=<?php echo $data['nama1']; ?>" class="button">Tambah Dokumen</a></li>
  </ul>
</div>

<br />
</body>
</html>
