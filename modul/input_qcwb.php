<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" ><style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style></head>

<body>
<? include ('../config/db_connect.php'); ?>
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
	
if ($jkantong != WB) {
	echo '<h2>Produk tidak sesuai Silakan Cek Stok Atau Masukkan Kantong Lain</h2> <a href="qcwb.php"> Klik di sini untuk kembali</a>';
	}
else {
echo
'<br><h2>INPUT HASIL KONTROL KUALITAS KOMPONEN DARAH LENGKAP (WB)</h2></br>
<form name="form1" method="post" action="proses_inputqcwb.php">
  <table width="1000" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <th height="36" colspan="2" bgcolor="#FF0000" scope="row">IDENTITAS KANTONG</th>
      <th height="36" scope="row">&nbsp;</th>
      <th colspan="2" bgcolor="#FF0000">PEMERIKSAAN FISIK</th>
      <th>&nbsp;</th>
      <th colspan="2" bgcolor="#FF0000">PEMERIKSAAN KONTAMINASI BAKTERI</th>
    </tr>
    <tr>
      <th width="128" height="38" bgcolor="#FF9999" scope="row"><div align="left">&nbsp No Kantong</div></th>
      <td width="192" bgcolor="#FF9999"><label>
        <input type="text" name="no_kantong" id="no_kantong" size="8" readonly="true" input value="'.$tampil['noKantong'].'">
      </label></td>
      <td width="10">&nbsp;</td>
      <td width="125" bgcolor="#FF9999">&nbsp Berat</td>
      <td width="203" bgcolor="#FF9999"><label>
        <input type="text" name="berat" id="berat" size="4">Gram
      </label></td>
      <td width="15">&nbsp;</td>
      <td width="75" bgcolor="#FF9999">&nbsp Aerob</td>
      <td width="252" bgcolor="#FF9999"><label>
       <select name="aerob">
       <option value="positif">Positif</option>
       <option value="negatif">Negatif</option>
       </select>
      </label></td>
    </tr>
    <tr>
      <th height="37" bgcolor="#FF9999" scope="row"><div align="left">&nbsp Merk Kantong</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="merk" id="merk" size="6" readonly="true" input value="'.$tampil['merk'].'">
      </label>Produk<input type="text" name="produk" id="produk" size="2" readonly="true" input value="'.$tampil['produk'].'"</td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp Inspeksi Hemolisis</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="insp_hemolisis" id="insp_hemolisis" size="4">< 0,8%
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp Anaerob</td>
      <td bgcolor="#FF9999"><label>
       <select name="anaerob">
			<option value="positif">Positif</option>
			<option value="negatif">Negatif</option>       
       </select>
      </label></td>
    </tr>
    <tr>
      <th height="39" bgcolor="#FF9999" scope="row"><div align="left">&nbsp Golongan Darah</div></th>
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
      <td bgcolor="#FF9999">&nbsp Volume</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="volume" id="volume" size="4"> mL
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp Petugas</td>
      <td bgcolor="#FF9999">
       <select name="petugas" id="petugas">';
  		while($tampil2 = mysql_fetch_array($petugas))
  		{
   	  echo '<option value="'.$tampil2['nama_lengkap'].'">'.$tampil2['nama_lengkap'].'</option>';
    	}  
		echo  '</select>
      </td>
    </tr>
    <tr>
      <th height="36" bgcolor="#FF9999" scope="row"><div align="left">&nbsp Tgl Pengambilan</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_aftap" id="tgl_buat" size="20" readonly="true" input value="'.$tampil['tgl_Aftap'].'">
      </label></td>
      <td>&nbsp;</td>
      <td colspan="2" bgcolor="#FF9999">&nbsp;</td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp Pemeriksa</td>
      <td bgcolor="#FF9999">
      <select name="pengesah" id="pengesah" >';
      while($tampil3 = mysql_fetch_array($petugas1)) 
      {
      	echo'<option value="'.$tampil3['nama_lengkap'].'">'.$tampil3['nama_lengkap'].'</option>';
      }
      
		 echo '</select>
      </td>
    </tr>
    <tr>
      <th height="42" bgcolor="#FF9999" scope="row"><div align="left">&nbsp Tgl Kedaluarsa</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_exp" id="tgl_exp" size="20" readonly="true" input value="'.$tampil['kadaluwarsa'].'">
      </label></td>
      <td>&nbsp;</td>
      <th colspan="2" bgcolor="#FF0000">PEMERIKSAAN HEMATOLOGI</th>
      <th>&nbsp;</th>
      <td bgcolor="#FF9999">&nbsp Bulan QC</td>
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

echo '</select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th height="38" bgcolor="#FF9999" scope="row"><div align="left">Tgl Periksa</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_periksa" id="tgl_periksa" size="20" readonly="true" value="'.$tampil['tglperiksa'].'">
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp Hemoglobin</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="hemoglobin" id="hemoglobin" size="4">>45 g/unit
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp Tgl Input</td>
      <td bgcolor="#FF9999">
      <select name="tanggal"><option value="'.date("Y-m-d").'">'.date("Y-m-d").'</option></select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row"><div align="left"></div></th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row"><div align="left">
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
}
?>
</body>
</html>
