<?php
require("../config/koneksi.php");
function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 


// Select all the rows in the markers table
$today=date("Y-m-d");


/**

* @author adhit

* @copyright 2008

*/
//Array Hari

$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');

//$hari = $array_hari[date('N')];

//Format Tanggal

$tanggal = date ('j');

//Array Bulan

$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');

//$bulan = $array_bulan[date('n')];

//Format Tahun

//$tahun = date('Y');

//Menampilkan hari dan tanggal

//echo $hari . "," . $tanggal . $bulan . $tahun;

//$query = "SELECT * FROM mobile_markers where tgl='$today'";
$query = "SELECT * FROM kegiatan where cast(TglPenjadwalan as date)>='$today'";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
	$tgl=explode(' ',$row[TglPenjadwalan]);
	$utd=mysql_fetch_assoc(mysql_query("select nama from detailinstansi where KodeDetail='$row[kodeinstansi]'"));
  // ADD TO XML DOCUMENT NODE
$ttglnya=$row[TglPenjadwalan];
$jenis=udd;
$tgl1=substr($tgl[0],8);
$tgl1=(int)$tgl1;
$tgl10=substr($tgl[0],5,2);
$tgl10=(int)$tgl10;
$bulan=$array_bulan[$tgl10];
$thn=substr($tgl[0],0,4);
$tgl2=$tgl1.' '.$bulan.' '.$thn;
$tglbiasa = date("Y-n-j", strtotime($ttglnya));
  echo '<marker ';
  echo 'name="' . parseToXML($utd['nama']) . '" ';
  echo 'kodeinstansi="' . parseToXML($row['kodeinstansi']) . '" ';
  echo 'jumlah="' . parseToXML($row['jumlah']) . '" ';
  echo 'tgl="' . parseToXML($tgl2) . '" ';
  echo 'tgla="' . parseToXML($tglbiasa) . '" ';
  echo 'jam_mulai="' . parseToXML(substr($tgl[1],0,5)) . '" ';
  echo 'id_mu="' . parseToXML($row['NoTrans']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'dokter="' . $row['dokter'] . '" ';
  echo 'sopir="' . $row['sopir'] . '" ';
  echo 'admin="' . $row['admin'] . '" ';
  echo 'atd1="' . $row['atd1'] . '" ';
  echo 'atd2="' . $row['atd2'] . '" ';
  echo 'atd3="' . $row['atd3'] . '" ';
  echo 'kendaraan="' . $row['kendaraan'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
