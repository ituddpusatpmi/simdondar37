<?php
	include "koneksi.php";
	//include "index.php";
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
</head>

<body>
<br /><br />
<p align="center" class="COOPER"><font size="5"><u>INPUT PETUGAS TERKAIT<br> DENGAN PEMBUATAN DOKUMEN</u></font></p>
<form action="exe_petugas.php" method="post" enctype="multipart/form-data">
<table align="center" border="1" cellpadding="10" cellspacing="1" bgcolor="#FFFFFF">
<tr>
	<td>
    <table align="center">
    <tr>
    	<td><div align="right"><strong>Nama Petugas</strong></div></td>
        <td><strong>:</strong></td>
        <td><div align="left"><strong>
          <input type="text" name="nama_petugas" size="50" />
        </strong></div></td>
    </tr>

    <tr>
    	<td><div align="right"><strong>Bidang</strong></div></td>
        <td><strong>:</strong></td>
        <td><div align="left"><strong>
          <select name="bidang">
            <option></option>
            <option>Penyediaan Donor</option>
            <option>Kerjasama Hukum dan Humas</option>
            <option>Simdondar</option>
            <option>Penyediaan Darah</option>
            <option>Rujukan IMLTD</option>
            <option>Serologi Golongan Darah</option>
            <option>Produksi</option>
            <option>Pengawasan Mutu</option>
	    <option>Kalibrasi</option>
            <option>Penelitian dan Pengembangan</option>
            <option>Pembinaan Kualitas</option>
	    <option>Perencanaan dan Keuangan</option>
	    <option>Kepegawaian</option>
	    <option>Diklat</option>
	    <option>Logistik</option>
	    <option>Rumah Tangga</option>
	    <option>Penunjang</option>
	    <option>Manajemen Kualitas</option>
	    <option>Litbang dan Produksi</option>
	    <option>Pelayanan</option>
	    <option>Rekrutment dan Pembinaan Donor</option>
          </select>
        </strong></div></td>
    </tr>

    <tr>
    	<td><div align="right"><strong>Jabatan</strong></div></td>
        <td><strong>:</strong></td>
        <td><div align="left"><strong>
          <input type="text" name="jabatan" size="50" />
        </strong></div></td>
    </tr>

    <tr>
    	<td><div align="right"><strong>Email</strong></div></td>
        <td><strong>:</strong></td>
        <td><div align="left"><strong>
          <input type="text" name="email" size="50" />
        </strong></div></td>
    </tr>

    <tr>
    	<td><div align="right"><strong>No. Hp</strong></div></td>
        <td><strong>:</strong></td>
        <td><div align="left"><strong>
          <input type="text" name="telp" size="50" />
        </strong></div></td>
    </tr>
   
    <tr>
    	<td colspan="3" align="right"><strong>
    	  <input type="submit" name="upload" value="Simpan" />
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
