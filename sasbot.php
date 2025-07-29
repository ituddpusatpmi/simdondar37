<?php

/** 
This is an example of Bot. Please modify according to your needs..
The concept is simple, just trap variable wa_no and wa_text
Do Your Query, then insert the result to Outbox table

For demo please text "INFO" to your WhatsApp Number
 */

include "sasconn.php";

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
UNTUK INFORMASI PMI KAB. JOMBANG
CONTOH : INFO DONOR
------------------------------------

1. *INFO DONOR*
2. *INFO STOK DARAH*
3. *INFO JADWAL DONOR*

Untuk kemudahan donor darah, Anda dapat menggunakan aplikasi Ayodonor:
di *AppStore* (untuk Pengguna IOS) 
dan
di *PlayStore* *(untuk Pengguna Android).
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
		
		
//-------------------------------------------------- 

$hasil = "*STOK DARAH SEHAT PMI KAB. JOMBANG* 
Update ". $detail['TGL']."
		
	Golda A   : ". $detail['GOLA']."
	Golda B   : ". $detail['GOLB']."
	Golda O   : ". $detail['GOLO']."
	Golda AB  : ". $detail['GOLAB']."
			
	*Jumlah     : ". $detail['Total']."
	
ket:
1. Stok Darah diatas merupakan akumulasi komponen darah WB (whoole blood), PRC (packed red cell), TC (thrombocyte) dan FFP (fresh frozen plasma).
2. Jumlah Stok Darah Dapat berubah sewaktu-waktu, untuk info lebih lanjut silahkan menghubungi UDD PMI.

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
		   $hasil="Jadwal Donor Darah Hari ini
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
}
