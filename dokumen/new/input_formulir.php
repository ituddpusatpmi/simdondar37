<?php
	include "koneksi.php";
	include "index.php";
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
<script>
	$(function() {
		$( "#datepicker2" ).datepicker();
		$("#datepicker2").change(function(){
			$("#datepicker2").datepicker("option","dateFormat","dd M yy");
			});
	});
</script>
<script>
	$(function() {
		$( "#datepicker3" ).datepicker();
		$("#datepicker3").change(function(){
			$("#datepicker3").datepicker("option","dateFormat","dd M yy");
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
</head>

<body>
<br /><br />
<p align="center" class="COOPER"><font size="5"><u>INPUT FORMULIR</u></font></p>
<form action="exe_formulir.php" method="post" enctype="multipart/form-data">
<table align="center" border="1" cellpadding="10" cellspacing="1" bgcolor="#FFFFFF">
<tr>
	<td>
    <table align="center">
    <tr>
    	<td><strong>Bidang</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <select name="bidang">
          	<option></option>
            <option>Pelayanan</option>
            <option>Produksi</option>
            <option>Distribusi</option>
            <option>Sistem Kualitas</option>
            <option>Mobile Unit</option>
            <option>Logistik</option>
            <option>Kepegawaian</option>
            <option>Rumah Tangga</option>
            <option>Sistem Informasi</option>
            <option>Sekretaris</option>
          </select>
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Judul Dokumen</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <input type="text" name="nama1" size="50" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Judul Dokumen Sebelumnya</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <input type="text" name="nama2" size="50" value="N/A" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Tingkatan Dokumen</strong></td>
        <td><strong>:</strong></td>
    	<td><strong>
    	  <select name="tingkat">
    	    <option></option>
    	    <option>1</option>
    	    <option>2</option>
    	    <option>3</option>
    	    <option>4</option>
    	    <option>5</option>
  	    </select>
    	</strong></td>
    </tr>
    <tr>
    	<td><strong>No. Kontrol Dokumen</strong></td>
        <td><strong>:</strong></td>
        <?php
			$sql="select count(*)+1 as jumlah from formulir";
			$proses=mysql_query($sql);
			$data=mysql_fetch_array($proses);
		?>
        <td><strong>
			<select name="kontrol1">
                <option></option>
				<option>BK-L3/</option>
                <option>FORM-L3/</option>
                <option>LC-L3/</option>
				<option>LH-L3/</option>
				<option>LK-L3/</option>
                <option>REG-L3/</option>
            </select>
          <input type="text" name="kontrol2" value="" size="8" />
          																<select name="kontrol3">
		  																<option></option>
																		<option>/PEL</option>
																		<option>/PROD</option>
																		<option>/DIST</option>
																		<option>/SK</option>
																		<option>/MU</option>
																		<option>/LOG</option>
																		<option>/PEG</option>
																		<option>/RT</option>
																		<option>/SIM</option>
																		<option>/SEKRE</option>
																		</select>
																		<input type="text" name="kontrol4" value="-UTDPKU" size="5" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Periode Review (bulan)</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <input type="text" name="periode" size="5" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>No. Versi</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <input type="text" name="no_versi" size="10" placeholder="000" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Tanggal Disetujui</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <input type="text" name="tgl_setuju" id="datepicker" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Tanggal Dilaksanakan</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <input type="text" name="tgl_pelaksanaan" id="datepicker2" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Peninjauan Kembali</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <input type="text" name="tgl_peninjauan" id="datepicker3" />
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Dibuat Oleh</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <select name="pembuat">
            <option></option>
            <?php
    			$query = "select * from pegawai order by nama";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama]</option>";
    			}
			?>
          </select>
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Ditandatangani Oleh</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <select name="pemeriksa">
            <option></option>
            <?php
    			$query = "select * from pegawai order by nama";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama]</option>";
    			}
			?>
          </select>
        </strong></td>
    </tr>
    <tr>
    	<td><strong>Disahkan Oleh</strong></td>
        <td><strong>:</strong></td>
        <td><strong>
          <select name="pengesah">
            <option></option>
            <?php
    			$query = "select * from pegawai order by nama";
    			$hasil = mysql_query($query);
    			while($data=mysql_fetch_array($hasil)){
        		echo "<option>$data[nama]</option>";
    			}
			?>
          </select>
        </strong></td>
    </tr>
    <tr>
    	<td colspan="3"><strong>File 1 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
        				File 2 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 3 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 4 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 5 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 6 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 7 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 8 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 9 &nbsp;:&nbsp;&nbsp;<input type="file" name="fileku[]" /><br />
                        File 10 :&nbsp;<input type="file" name="fileku[]" /><br />
    	</strong></td>
    </tr>
    <tr>
    	<td colspan="3" align="right"><strong>
    	  <input type="submit" value="Simpan" />
    	</strong></td>
    </tr>
    </table>
    </td>
</tr>
</table>
</form>
<br />
</body>
</html>