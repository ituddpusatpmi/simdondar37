
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style></head>
<body>
<? include('../config/db_connect.php'); ?>
<?
if ((isset($_POST['submit2'])) AND ($_POST['cari']<>"")){
	$cari=$_POST['cari'];
	$sql=mysql_query("SELECT * FROM stokkantong WHERE noKantong LIKE '%$cari%'") or die(mysql_error());
	$tampil= mysql_fetch_array($sql);
	$kantong= $tampil['noKantong'];
	$jkantong= $tampil['produk'];
	}
	
	$petugas=mysql_query("SELECT nama_lengkap FROM user") or die (mysql_error());
	$petugas1=mysql_query("SELECT nama_lengkap FROM user") or die (mysql_error());
	
if ($jkantong != FFP) {
	echo '<h2>Produk tidak sesuai Silakan Cek Stok Atau Masukkan Kantong Lain</h2> <a href="qcffp.php"> Klik di sini untuk kembali</a>';
	}
	
else {
echo 
'<h2 align="left">INPUT HASIL KONTROL KUALITAS KOMPONEN PLASMA SEGAR BEKU (FFP)</h2>';

echo '<form name="form1" method="post" action="proses_inputqcffp.php">
<table width="1000" border="0" align="left" cellpadding="0" cellspacing="0">
<tr>
		<th height="36" colspan="2" bgcolor="#FF0000" scope="row">IDENTITAS KANTONG</th>
		<th height="36" scope="row">&nbsp;</th>
		<th colspan="2" bgcolor="#FF0000">PEMERIKSAAN FISIK</th>
      <th>&nbsp;</th>
      <th colspan="2" bgcolor="#FF0000">PEMERIKSAAN KONTAMINASI BAKTERI</th>
</tr>

<tr>
		   <th width="133" height="38" bgcolor="#FF9999" scope="row"><div align="left">No Kantong</div></th>
		   <td width="198" bgcolor="#FF9999"><input type="text" name="nokantong" id="nokantong" size="10" readonly="true" input value="'.$tampil['noKantong'].'"</td> 
			<td width="13">&nbsp;</td>
			<td width="107" bgcolor="#FF9999">Berat</td>
			<td width="207" bgcolor="#FF9999"><label>
	      <input type="text" name="berat" id="berat" size="4"></label> Gram</td>
	      <td width="15">&nbsp;</td>
	      <td width="62" bgcolor="#FF9999">Aerob</td>
	      <td width="265" bgcolor="#FF9999"><label>
	      <select name="aerob">
	      <option value="negatif">Negatif</option>
	      <option value="positif">Positif</option>
	      </select></label></td>
</tr>

<tr>
		<th height="37" bgcolor="#FF9999" scope="row"><div align="left">Merk Kantong</div></th>
		<td bgcolor="#FF9999"><label>
	   <input type="text" name="merk" id="merk" size="6" readonly="true" input value="'.$tampil['merk'].'"></label>Produk 
	   <input type="text" name="produk" id="produk" size="2" readonly="true" input value="'.$jkantong.'"></td>
		<td>&nbsp;</td>
		<td bgcolor="#FF9999">Volume</td>
      <td bgcolor="#FF9999"><label>
      <input type="text" name="volume" id="volume" size="4"></label> CC</td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Anaerob</td>
      <td bgcolor="#FF9999"><label>
      <select name="anaerob">
      <option value="negatif">Negatif</option>
      <option Value="positif">Positif</option>
      </select></label></td>
</tr>

<tr>
      <th height="39" bgcolor="#FF9999" scope="row"><div align="left">Golongan Darah</div></th>
      <td bgcolor="#FF9999"><label>
        <select name="golda" id="golda">
          <option value="'.$tampil['gol_darah'].'">'.$tampil['gol_darah'].'</option>
             </select>
        Rhesus
        <select name="rh" id="rh">
          <option value="'.$tampil['RhesusDrh'].'">'.$tampil['RhesusDrh'].'</option>
                  </select>
      </label></td>
      <td>&nbsp;</td>
      <th colspan="2" bgcolor="#FF0000"><label>PEMERIKSAAN HEMATOLOGI</label></th>
      <th>&nbsp;</th>
      <td bgcolor="#FF9999">Petugas Input</td>
      <td bgcolor="#FF9999">
      <select name="petugas" id="petugas">';
  		while($tampil2 = mysql_fetch_array($petugas))
  		{
   	  echo     	'<option value="'.$tampil2['nama_lengkap'].'">'.$tampil2['nama_lengkap'].'</option>';
    	}  
		echo  '</select>
      </td>
      
</tr>

<tr>
      <th height="36" bgcolor="#FF9999" scope="row"><div align="left">Tgl Pembuatan</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_buat" id="tgl_buat" readonly="true" size="12" input value="'.$tampil['tglpengolahan'].'">
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Lekosit</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="lekosit" id="lekosit" size="4">
      </label>< 0,1 X 10 <sup>9</sup>/L</td>
      
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Yang Mengesahkan</td>
      <td bgcolor="#FF9999">
      <select name="pengesah" id="pengesah">';
      while($tampil3 = mysql_fetch_array($petugas1)) 
      {
      	echo'<option value="'.$tampil3['nama_lengkap'].'">'.$tampil3['nama_lengkap'].'</option>';
      }
      
		 echo '</select>
      </td>
		<td colspan="2">&nbsp;</td>
      
 </tr>';
 
 echo   '<tr>
      <th height="38" bgcolor="#FF9999" scope="row"><div align="left">Tgl Kedaluarsa</div></th>
		<td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_exp" id="tgl_exp"  size="12" readonly="true" input value="'.$tampil['kadaluwarsa'].'" >
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Trombosit</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="trombosit" id="trombosit" size="4">
      </label>< 50 X 10<sup>9</sup>/L</td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Bulan QC</td>
      <td bgcolor="#FF9999"><select name="bulan">
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
		Tahun
		<select name="tahun">';
		$mulai= date('Y');
		for($i = $mulai;$i<$mulai + 10;$i++){
		$sel = $i == date('Y') ? ' selected="selected"' : '';
		echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
		}

echo '</select>
		</td>
</tr>


 
 <tr>
      <th height="34" scope="row"><div align="left"></div></th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Faktor VIII</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="faktor_viii" id="faktor_viii" size="4">
      </label>> 0,70 IU/mL</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
</tr>

<tr>
      <th height="38" scope="row"><div align="left">
        <label>
        <input type="submit" name="submit" id="submit" value="Simpan">
        </label>
      </div></th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>';
} ?>

</body>

</html>
