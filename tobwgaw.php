<?php

/** 
This is an example of Bot. Please modify according to your needs..
The concept is simple, just trap variable wa_no and wa_text
Do Your Query, then insert the result to Outbox table

For demo please text "INFO" to your WhatsApp Number
 */

include "connection.php";
//include "dbcnntwgaw.php";
$hariini=DATE("Y-m-d");
$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
$tg1=substr($hariini,8,2);
$bl1=substr($hariini,5,2);
$bl1=(INT)$bl1;
$th1=substr($hariini,0,4);
$tgl1=$tg1.' '.$array_bulan[$bl1].' '.$th1;
$pukul=DATE("H:i");


@$wa_no = $_GET['wa_no'];
@$wa_text0 = $_GET['wa_text'];
@$wa_text = strtoupper($_GET['wa_text']);
if ($wa_no . $wa_text == '') {
	exit;
}

switch ($wa_text) {

	case 'INFO PMI':
		$msg = "*SALAM KEMANUSIAAN*
KETIK & KIRIM PILIHAN DI BAWAH INI,
UNTUK INFORMASI PMI KOTA PADANG
CONTOH : *INFO DONOR*
------------------------------------

(_untuk mengetahui informasi Data Donor Anda, silahkan ketik_)
*INFO DONOR*

(_untuk mengetahui informasi Stok Darah yang tersedia, silahkan ketik_)
*INFO STOK DARAH*

(_untuk mengetahui informasi Kegiatan Donor Darah MU, silahkan ketik_)
*INFO JADWAL DONOR*

Untuk kemudahan dalam mengakses informasi seputar donor darah Anda silahkan menggunakan Aplikasi *AYODONOR* yang dapat diunduh di 
*Playstore* (untuk Pengguna Android)
di http://bit.ly/2MOLU6C  
dan
*AppStore* (untuk Pengguna iOS).
di http://apple.co/369TCPB
";

		//KIRIM PESAN
		sendMessage($wa_no, $msg);
		break;

//Info Donor--------------------------------------------

	case 'INFO DONOR':
		//Cari Pendonor
		$newno = str_replace('62 ', '0', $wa_no);
		$newno1 = str_replace('-', '', $newno);
		$query = mysql_query("SELECT\n" .
			"pmi.pendonor.Kode,\n" .
			"pmi.pendonor.Nama,\n" .
			"pmi.pendonor.telp2,\n" .
			"pmi.pendonor.GolDarah,\n" .
			"pmi.pendonor.Rhesus,\n" .
			"pmi.pendonor.jumDonor,\n" .
			"DATE_FORMAT(pmi.pendonor.tglkembali,'%d-%m-%Y') as tglkembali \n" .
			"FROM\n" .
			"pmi.pendonor\n" .
			"where pmi.pendonor.telp2=$newno1 LIMIT 1");
		if (mysql_num_rows($query) > 0) {
			$detail = mysql_fetch_assoc($query);
			$msg = "Yth. " . $detail['Nama'] .
				"
**************************************
Kode Donor : " . $detail['Kode'] .
				"
Gol. Darah : " . $detail['GolDarah'] . $detail['Rhesus'] .
				"
Jml Donor : " . $detail['jumDonor'] . " kali" .
				"
Nomor HP : " . $detail['telp2'] .
				"
Silahkan Donor setelah : " . $detail['tglkembali'] .
				"

Untuk kemudahan donor darah Anda silahkan menggunakan Aplikasi *AYODONOR* yang dapat diunduh di Playstore & AppStore
			";
		} else {
			$msg = "Maaf No. Handphone Anda belum terdaftar di sistem kami";
		}
		//KIRIM PESAN
		sendMessage($wa_no, $msg);
		break;
		
		
//INFO STOK DARAH--------------------------------------------------------------

	case 'INFO STOK DARAH':
	$query = mysql_query("SELECT * FROM pmi.v_bot_stokdarah");
		if (mysql_num_rows($query) > 0) {
			$detail = mysql_fetch_assoc($query);
			$total	= $detail['Total'];	
		
//-------------------------------------------------- 

$hasil = "*STOK DARAH SEHAT PMI PMI KOTA PADANG* 
UPDATE : ".$tgl1." - Jam : ".$pukul."
		
	Gol. Darah A   : ".$detail['GOLA']."
	Gol. Darah B   : ".$detail['GOLB']."
	Gol. Darah O   : ".$detail['GOLO']."
	Gol. Darah AB  : ".$detail['GOLAB']."
	
	*Jumlah     : $total*		
	
ket: Jumlah Stok Darah Dapat berubah sewaktu-waktu, untuk info lebih lanjut silahkan menghubungi UDD PMI Terdekat.

		";
		} else {
			$hasil = "Maaf Informasi Stok Darah Tidak Tersedia";
		}

		$msg = $hasil;
		//echo 	$msg ;
		sendMessage($wa_no, $msg);
		break;

//----------------------------------------------------------------

// INFORMASI PELAYANAN PLASMA KONVALESEN--------------------------

	case 'INFO PK':
	$pk=mysql_fetch_assoc(mysql_query("SELECT pesan FROM wa_setting WHERE id='7'"));
	$query = mysql_query("SELECT * FROM pmi.v_bot_stokdarah");
		if (mysql_num_rows($query) > 0) {
			$detail = mysql_fetch_assoc($query);
			$total	= $detail['Total'];	
		
//-------------------------------------------------- 

$hasil = $pk['pesan']."
per ".$tgl1." - Jam: ".$pukul." 
	Daftar Antrian Pasien yang masuk :	
	Gol. Darah A   : ".$detail['GOLA']."
	Gol. Darah B   : ".$detail['GOLB']."
	Gol. Darah O   : ".$detail['GOLO']."
	Gol. Darah AB  : ".$detail['GOLAB']."
	
	*Jumlah     : $total*		
	
ket: Jumlah Stok Darah Dapat berubah sewaktu-waktu, untuk info lebih lanjut silahkan menghubungi UDD PMI Terdekat.

		";
		} else {
			$hasil = "Maaf Informasi Stok Darah Tidak Tersedia";
		}

		$msg = $hasil;
		//echo 	$msg ;
		sendMessage($wa_no, $msg);
		break;

//----------------------------------------------------------------



//INFO JADWAL DONOR--------------------------------------------------------------
case 'INFO JADWAL DONOR':
		//Cari Jadwal
		$query = mysql_query("select * from pmi.v_jadwal_mu");
		while($row = mysql_fetch_assoc($query))
			 {
		   $hasil="Jadwal Kegiatan Donor Darah Hari ini
( $tgl1 )
		   ".$row['jadwal'];
					
		  }
		  $msg = $hasil;
				//echo 	$msg ;
				sendMessage($wa_no, $msg);
				break;
}


//---  Using IF
if (substr($wa_text, 0, 3) == 'WA|') {
	echo $wa_text;
	$pecah = explode('|', $wa_text0);
	$no = $pecah[1];
	$txt = $pecah[2];
	sendMessage($no, $txt);
}


if (substr($wa_text, 0, 4) == 'DAY ') {
	$pecah = explode(' ', $wa_text);
	$date = $pecah[1];
	$nameOfDay = date('l', strtotime($date));
	$msg =  $date . '  is  ' . $nameOfDay;
	sendMessage($wa_no, $msg);
}


function sendMessage($wa_no, $wa_text)
{
	//  if ( $wa_no * 1 == 0)  {$wa_mode = 2;} else {$wa_mode = 1;}  ;
	mysql_query("INSERT INTO outbox (wa_mode, wa_no, wa_text ) VALUES ('0', '$wa_no', '$wa_text' )");
	//mysql_query("INSERT INTO outbox (wa_mode, wa_no, wa_text ) VALUES ('1', '$wa_no', '$wa_text' )");
}
