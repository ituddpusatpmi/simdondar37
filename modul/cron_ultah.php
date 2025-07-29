<?
include ("/var/www/simudda/config/koneksi.php");
    $q_utd	= mysql_query("select id from utd where aktif='1'");			
    $utd	= mysql_fetch_assoc($q_utd);
    $kembali    = date("Y-m-d",strtotime("-2 days"));
    $today	= date('m-d');
    $pengingat  = mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='2'"));
    $donor      = date("Y-m-d",strtotime("-1 day"));
    $dk         = mysql_query("select nama,Jk,Status, Kode, telp2 from pendonor where Kode like '$utd[id]%' and substring(TglLhr,6,6) like '$today' and length(telp2)>9 and Cekal='0'");
    while ($dk1=mysql_fetch_assoc($dk)) {

	if ($dk1[Jk]=='0' and $dk1[Status]=='1') $sapa='Bpk';
	if ($dk1[Jk]=='0' and $dk1[Status]=='0') $sapa='Sdr';
	if ($dk1[Jk]=='1' and $dk1[Status]=='1') $sapa='Ibu';
	if ($dk1[Jk]=='1' and $dk1[Status]=='0') $sapa='Sdri';
        $telp   =$dk1[telp2];
        $pesan  ='Yth. '.$sapa.'. '.$dk1[nama].', '.$pengingat[pesan];
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
