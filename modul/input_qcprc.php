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
	
if ($jkantong != PRC) {
	echo '<h2>Produk tidak sesuai Silakan Cek Stok Atau Masukkan Kantong Lain</h2> <a href="qcprc.php"> Klik di sini untuk kembali</a>';
	}
else {
echo
'<h2>INPUT HASIL KONTROL KUALITAS KOMPONEN SEL DARAH MERAH PEKAT (PRC)</h2>
<form name="form1" method="post" action="proses_inputqcprc.php">
  <table width="1000" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <th height="36" colspan="2" bgcolor="#FF0000" scope="row">IDENTITAS KANTONG</th>
      <th height="36" scope="row">&nbsp;</th>
      <th colspan="2" bgcolor="#FF0000">PEMERIKSAAN FISIK</th>
      <th>&nbsp;</th>
      <th colspan="2" bgcolor="#FF0000">PEMERIKSAAN KONTAMINASI BAKTERI</th>
    </tr>
    <tr>
      <th width="137" height="38" bgcolor="#FF9999" scope="row"><div align="left">No Kantong</div></th>
      <td width="210" bgcolor="#FF9999"><label>
        <input type="text" name="nokantong" id="nokantong" size="8" readonly="true" input value="'.$tampil['noKantong'].'">
      </label></td>
      <td width="10">&nbsp;</td>
      <td width="133" bgcolor="#FF9999">Berat</td>
      <td width="179" bgcolor="#FF9999"><label>
        <input type="text" name="berat" id="berat" size="4">Gram
      </label></td>
      <td width="10">&nbsp;</td>
      <td width="81" bgcolor="#FF9999">Aerob</td>
      <td width="240" bgcolor="#FF9999"><label>
       <select name="aerob">
       <option value="positif">Positif</option>
       <option value="negatif">Negatif</option>
       </select>
      </label></td>
    </tr>
    <tr>
      <th height="37" bgcolor="#FF9999" scope="row"><div align="left">Merk Kantong</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="merk" id="merk" size="8" readonly="true" input value="'.$tampil['merk'].'"></label>Produk 
	   <input type="text" name="produk" id="produk" size="2" readonly="true" input value="'.$jkantong.'">
      </td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Inspeksi Hemolisis</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="insp_hemolisis" id="insp_hemolisis" size="4"> < 0.8 %
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Anaerob</td>
      <td bgcolor="#FF9999"><label>
        <select name="anaerob">
        <option value="positif">Positif</option>
        <option value="negatif">Negatif</option>
        </select>
      </label></td>
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
      <td bgcolor="#FF9999">Volume</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="volume" id="volume" size="4">mL
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Petugas Input</td>
      <td bgcolor="#FF9999">
       <select name="petugas" id="petugas">';
  		while($tampil2 = mysql_fetch_array($petugas))
  		{
   	  echo     	'<option value="'.$tampil2['nama_lengkap'].'">'.$tampil2['nama_lengkap'].'</option>';
    	}  
		echo  '</select>
      </td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <th height="36" bgcolor="#FF9999" scope="row"><div align="left">Tgl Pembuatan</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_buat" id="tgl_buat" size="12" readonly="true" input value="'.$tampil['tglpengolahan'].'">
      </label></td>
      <td>&nbsp;</td>
      <td colspan="2" bgcolor="#FF9999">&nbsp;</td>
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
      <td>&nbsp;</td>
      <td>&nbsp;</td>   
    </tr>
    <tr>
      <th height="42" bgcolor="#FF9999" scope="row"><div align="left">Tgl Kedaluarsa</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_exp" id="tgl_exp" size="12" readonly="true" input value="'.$tampil['kadaluwarsa'].'">
      </label></td>
      <td>&nbsp;</td>
      <th colspan="2" bgcolor="#FF0000">PEMERIKSAAN HEMATOLOGI</th>
      <th>&nbsp;</th>
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

echo '</select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th height="38" bgcolor="#FF9999" scope="row"><div align="left">Tgl Periksa</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_periksa" id="tgl_periksa" size="8">YYYY-mm-dd
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Hematokrit</td>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="hematokrit" id="hematokrit" size="4"> 65-75 %
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Tgl Input</td>
      <td bgcolor="#FF9999">
      <select name="tanggal"><option value="'.date("Y-m-d").'">'.date("Y-m-d").'</option></select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th height="38" bgcolor="#FF9999" scope="row"><div align="left">&nbsp;</div></th>
      <td bgcolor="#FF9999"><label>
        &nbsp;</label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Hemoglobin</td>
      <td bgcolor="#FF9999"><label>

        <input type="text" name="hemoglobin" id="hemoglobin" size="4"> > 45g
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">&nbsp;</td>

      <td bgcolor="#FF9999">
      &nbsp;
      </td>
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
