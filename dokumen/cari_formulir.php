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
<br />
<p align="center" class="COOPER"><font size="5"><u>FORMULIR</u></font></p>
<table align="center" bgcolor="#FFFFFF">
<tr>
	<td><a href="input_formulir.php"><input type="button" value="Tambah Formulir" /></a></td>
    <form method="post" action="cari_formulir.php">
    <td align="right"><input type="text" name="cari" placeholder="masukkan kata kunci" size="40" />&nbsp;<input type="submit" value="search" />
    </td>
    </form>
</tr>
<tr>
	<td colspan="2">
	<table align="center" border="1" cellpadding="1" cellspacing="1">
        <tr class="coper">
        	<td><div align="center">No.</div></td>
            <td><div align="center">Bidang</div></td>
            <td><div align="center">Judul Dokumen</div></td>
            <td><div align="center">Identitas Dokumen<br />Sebelumnya</div></td>
            <td><div align="center">Tingkat Dokumen</div></td>
            <td><div align="center">No. Kontrol<br />Dokumen</div></td>
            <td><div align="center">Periode Review<br />(bln)</div></td>
            <td><div align="center">No. Versi</div></td>
            <td><div align="center">Tanggal<br />Disetujui</div></td>
            <td><div align="center">Tanggal<br />Dilaksanakan</div></td>
            <td><div align="center">Peninjauan<br />Kembali</div></td>
            <td><div align="center">Aksi</div></td>
        </tr>
        <?php
		$cari = $_POST['cari'];
	$donor = "select * from formulir where bidang like '%$cari%' or nama1 like '%$cari%' or nama2 like '%$cari%' or tingkat like '%$cari%' or kontrol like '%$cari%' or kontrol2 like '%$cari%' or kontrol3 like '%$cari%' or tgl_setuju like '%$cari%' or tgl_pelaksanaan like '%$cari%' or tgl_peninjauan like '%$cari%' order by kontrol2";
	$proses = mysql_query($donor);
	$nourut = 0;
	while($data = mysql_fetch_array($proses)){ 
	$nourut++;
		?>
        <tr>
        	<td><div align="center"><?php echo $nourut; ?></div></td>
            <td><div align="left"><?php echo $data['bidang']; ?></div></td>
            <td><div align="left"><?php echo $data['nama1']; ?></div></td>
            <td><div align="center"><?php echo $data['nama2']; ?></div></td>
            <td><div align="center"><?php echo $data['tingkat']; ?></div></td>
            <td><div align="center"><?php echo $data['kontrol']; ?><?php echo $data['kontrol2']; ?><?php echo $data['kontrol3']; ?></div></td>
            <td><div align="center"><?php echo $data['periode']; ?></div></td>
            <td><div align="center"><?php echo $data['no_versi']; ?></div></td>
            <td><div align="center"><?php echo $data['tgl_setuju']; ?></div></td>
            <td><div align="center"><?php echo $data['tgl_pelaksanaan']; ?></div></td>
            <td><div align="center"><?php echo $data['tgl_peninjauan']; ?></div></td>
            <td><a href="detail_formulir.php?detail=<?php echo $data['nomor']; ?>"><img src="images/ubah.png"></img></a>&nbsp;&nbsp;<a href="hapus_formulir.php?hapus=<?php echo $data['nomor']; ?>"><img src="images/hapus.png"></img></a></td>
        </tr>
        <?php
		}
		?>
	</table>
	</td>
</tr>
</table>
<br />
</body>
</html>
