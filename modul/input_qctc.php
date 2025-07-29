<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style><head>
</head>
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
	
if ($jkantong != TC) {
	echo '<h2>Produk tidak sesuai Silakan Cek Stok Atau Masukkan Kantong Lain</h2> <a href="qctc.php"> Klik di sini untuk kembali</a>';
	}
else {
	echo
'<h2> INPUT HASIL KONTROL KUALITAS KOMPONEN SEL TROMBOSIT (TC)</h2>
<form id="form1" name="form1" method="post" action="proses_inputqctc.php">
  <table width="981" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th height="36" colspan="2" bgcolor="#FF0000" scope="row">IDENTITAS KANTONG</th>
        <th height="36" scope="row">&nbsp;</th>
        <th colspan="2" bgcolor="#FF0000" scope="col"><div align="center">PEMERIKSAAN FISIK</div></th>
        <th scope="col">&nbsp;</th>
        <th colspan="3" bgcolor="#FF0000" scope="col">PEMERIKSAAN KONTAMINASI BAKTERI<div align="center">
          </div>
        <label></label></th>
      </tr>
    <tr>
      <th width="137" height="38" bgcolor="#FF9999" scope="row"><div align="left">No Kantong</div></th>
      <td width="205" bgcolor="#FF9999"><label>
        <input type="text" name="nokantong" id="nokantong" size="8" readonly="true" input value="'.$tampil['noKantong'].'">
      </label></td>
      <td width="10">&nbsp;</td>
      <td bgcolor="#FF9999"><label>Berat</label></td>
      <th bgcolor="#FF9999" scope="col"><div align="left">
        <input type="text" name="berat" id="berat" size="4">Gram
      </div></th>
      <th scope="col">&nbsp;</th>
      <td bgcolor="#FF9999" scope="col">Aerob</td>
      <td width="211" bgcolor="#FF9999" scope="col">
      <select name="aerob">
      <option value="positif">Positif</option>
      <option value="negatif">Negatif</option>
      </select>
      </td>
      <td colspan="2" bgcolor="#FF9999" scope="col"></td>
    </tr>
    <tr>
      <th height="37" bgcolor="#FF9999" scope="row"><div align="left">Merk Kantong</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="merk" id="merk" size="8" readonly="true" input value="'.$tampil['merk'].'">Produk
        <input type="text" name="produk" id="produk" size="2" readonly="true" input value="'.$tampil['produk'].'">
      </label></td>
      <td>&nbsp;</td>
      <td width="101" bgcolor="#FF9999" scope="col"><div align="left">Swirling</div></td>
      <td width="196" bgcolor="#FF9999" scope="col">
      <select name="swirling">
      <option value="ada">Ada</option>
      <option value="tidak">Tidak</option>
      </select>
      </td>
      <td width="9" scope="col">&nbsp;</td>
      <td bgcolor="#FF9999">Anaerob</td>
      <td colspan="2" bgcolor="#FF9999"><label>
       <select name="anaerob">
       <option value="positif">Positif</option>
       <option value="negatif">Negatif</option>
       </select></td>
    </tr>
    <tr>
      <th height="39" bgcolor="#FF9999" scope="row"><div align="left">Golongan Darah</div></th>
      <td bgcolor="#FF9999"><label>
        <select name="golda" id="golda">
          <option value="'.$tampil[gol_darah].'">'.$tampil['gol_darah'].'</option>
        </select>
        Rhesus
  <select name="rh" id="rh">
    <option value="'.$tampil['RhesusDrh'].'">'.$tampil['RhesusDrh'].'</option>
  </select>
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Volume</td>
      <td bgcolor="#FF9999"><input type="text" name="volume" id="volume" size="4"> > 40mL</td>
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
    </tr>
    <tr>
      <th height="36" bgcolor="#FF9999" scope="row"><div align="left">Tgl Pembuatan</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_buat" id="tgl_buat" size="12" readonly="true" input value="'.$tampil['tglpengolahan'].'">
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999">Ph</td>
      <td bgcolor="#FF9999"><input type="text" name="ph" id="ph" size="4"> > 6.4</td>
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

    </tr>
    <tr>
      <th height="42" bgcolor="#FF9999" scope="row"><div align="left">Tgl Kedaluarsa</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_exp" id="tgl_exp" size="12" readonly="true" input value="'.$tampil['kadaluwarsa'].'">
      </label></td>
      <td></td>
      <td colspan="2" bgcolor="#FF0000" align="center"><label>PEMERIKSAAN HEMATOLOGI</label></td>
      <td rowspan="2">&nbsp;</td>
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
      <td bgcolor="#FF9999">

      </td>
 </tr>

    </tr>
    <tr>
      <th height="38" bgcolor="#FF9999" scope="row"><div align="left">Tgl Periksa</div></th>
      <td bgcolor="#FF9999"><label>
        <input type="text" name="tgl_periksa" id="tgl_periksa" size="10">YYYY-mm-dd
      </label></td>
      <td>&nbsp;</td>
      <td bgcolor="#FF9999"><label></label>Trombosit/Unit <label></label></td>
      <td bgcolor="#FF9999">
      <input type="text" name="trombosit" id="trombosit" size="4"> > 60 X 10<sup>9
      </td>
      <td bgcolor="#FF9999">Tgl Input</td>
      <td bgcolor="#FF9999">
		<select name="tanggal"><option value="'.date("Y-m-d").'">'.date("Y-m-d").'</option></select>      
      </td>
      <td>
      </td>
    </tr>
    <tr>
      <td><label></label></td>
      <td><label></label></td>
      <td>&nbsp;</td>
      <td><label></label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="submit" id="submit" value="Simpan" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><label></label></td>
    </tr>
  </table>
</form>';
}
?>
</body>

