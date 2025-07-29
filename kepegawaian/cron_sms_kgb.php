<?
include ("/var/www/simudda/config/koneksi.php");
    $q_utd	= mysql_query("select id from utd where aktif='1'");			
    $utd	= mysql_fetch_assoc($q_utd);
    $kembali    = date("Y-m-d",strtotime("-2 days"));
    $today	= date("y-m-d");
    $pengingat  = mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='1'"));
    $donor      = date("Y-m-d");
    $dk         = mysql_query("select nik,tglsk,nosk,gajilama,gajibaru,tglberlaku,tglawalrapel,tglakhirrapel,jmlbulanrapel,nilairapel,jmlrapel,hp from kgbpeg where status='2' and tanggal_entry='$donor'  and length(hp)>9 ");

    while ($dk1=mysql_fetch_assoc($dk)) {
		$kgb=mysql_query("select * from pegawai where Kode='$dk1[nik]'");
			$kgb1=mysql_fetch_assoc($kgb);
	if ($kgb1[Jk]=='0' and $kgb1[Status]!='0') $sapa='Bpk';
	if ($kgb1[Jk]=='0' and $kgb1[Status]=='0') $sapa='Sdr';
	if ($kgb1[Jk]=='1' and $kgb1[Status]!='0') $sapa='Ibu';
	if ($kgb1[Jk]=='1' and $kgb1[Status]=='0') $sapa='Sdri';
        $telp   =$dk1[hp];
        $pesan  ='Yth. '.$sapa.'. '.$kgb1[Nama].',KGB anda sudah selesai diproses dengan data no SK :'.$dk1[nosk].', berlaku mulai tgl: '.$dk1[tglberlaku].',rapel anda berjumlah:'.$dk1[jmlbulanrapel].' bulan, dari tgl:'.$dk1[tglawalrapel].',s/d :'.$dk1[tglakhirrapel].' dengan nilai rapel/bulan :Rp.'.$dk1[nilairapel].', nilai total rapel anda Rp. '.$dk1[jmlrapel].'. terima kasih';
        $jmlSMS = ceil(strlen($pesan)/153);
        $pecah  = str_split($pesan, 153);
        $query  = "SHOW TABLE STATUS FROM sms LIKE 'outbox'";
        $hasil  = mysql_query($query);
        $data   = mysql_fetch_array($hasil);
        $newID  = $data['Auto_increment'];
        for ($i=1; $i<=$jmlSMS; $i++) {
            // membuat UDH untuk setiap pecahan, sesuai urutannya
            $udh = "050003A7".sprintf("%02s", $jmlSMS).sprintf("%02s", $i);
           // membaca text setiap pecahan
           $msg = $pecah[$i-1];
           if ($i == 1){
                // jika merupakan pecahan pertama, maka masukkan ke tabel OUTBOX
                $query = "INSERT INTO sms.outbox (DestinationNumber, UDH, TextDecoded, ID, MultiPart, CreatorID)
                          VALUES ('$telp', '$udh', '$msg', '$newID', 'true', '1')";
            } else {
                // jika bukan merupakan pecahan pertama, simpan ke tabel OUTBOX_MULTIPART
                $query = "INSERT INTO sms.outbox_multipart(UDH, TextDecoded, ID, SequencePosition)
                  VALUES ('$udh', '$msg', '$newID', '$i')";
            }
           // jalankan query
           mysql_query($query);
        }
        //$kirim  = mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) values ('$telp','$pesan','1')");
    }
