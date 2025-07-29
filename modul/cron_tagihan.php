<?
include ("/var/www/simudda/config/koneksi.php");
    $q_utd	= mysql_query("select id from utd where aktif='1'");			
    $utd	= mysql_fetch_assoc($q_utd);
    $kembali    = date("Y-m-d",strtotime("-2 days"));
    $pengingat  = mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='1'"));
    $donor      = date("Y-m-d",strtotime("-1 day"));
    $dk         = mysql_query("select nama, Kode, telp2 from pendonor where Kode like '$utd[id]%' and tglkembali='$kembali' and length(telp2)>10 and cekal='0'");
    while ($dk1=mysql_fetch_assoc($dk)) {
        $telp   =$dk1[telp2];
        $pesan  ='Yth. '.$dk1[nama].', '.$pengingat[pesan];
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
