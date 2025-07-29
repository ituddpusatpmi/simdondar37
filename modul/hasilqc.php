<html>

<head>
</head>
<body>

Masukkan Bulan dan Tahun QC
<br></br>
<form id="form1" name="form1" method="post" action="modul/proses_hasilqc.php">
<table>
<tr>
<td>
BULAN
</td>
<td>
<select name="bulan">
<option value="01">Januari</option>
<option value="02">Februari</option>
<option value="03">Maret</option>
<option value="04">April</option>
<option value="05">Mei</option>
<option value="06">Juni</option>
<option value="07">Juli</option>
<option value="08">Agustus</option>
<option value="09">September</option>
<option value="10">Oktober</option>
<option value="11">November</option>
<option value="12">Desember</option>
</select>
</td>
<td>
TAHUN
</td>
<td>
<select name="tahun">
<?	$mulai= date('Y');
		for($i = $mulai - 5;$i<$mulai + 5;$i++){
		$sel = $i == date('Y') ? ' selected="selected"' : '';
		echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
		}
?>
</select>
</td>
<td><input type="submit" name="submit" id="submit" value="CARI"></td>
</tr>
</table>
</form>

</body>
</html>
