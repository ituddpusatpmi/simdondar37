<?
include ("/var/www/simudda/config/koneksi.php");
    $q_utd	= mysql_query("select id from utd where aktif='1'");			
    $utd	= mysql_fetch_assoc($q_utd);
    $kembali    = date("Y-m-d",strtotime("-2 days"));
	$today  = date("Y-m-d");
    $pengingat  = mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='1'"));
    $donor      = date("Y-m-d",strtotime("-1 day"));
    $dk         = mysql_query("select nama,tlp,cp,jumlah,jatuhtempo,nofaktur,sisa from detailpiutang where (jatuhtempo='$today' or jatuhtempo='$donor') and status='0' ");
    while ($dk1=mysql_fetch_assoc($dk)) {
        $telp   =$dk1[tlp];
        $pesan  ='Yth. sdr. Bendahara/Direktur '.$dk1[nama].' Sudah tiba jatuh tempo pembayaran faktur nomor : '.$dk1[nofaktur].' sejumlah Rp. '.$dk1[sisa].' , Bila sudah melakukan pembayaran mohon konfirmasi kebagian keuangan UDDP, Terima Kasih';
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
