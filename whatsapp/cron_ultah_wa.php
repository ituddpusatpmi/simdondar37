<?
include ("/var/www/simudda/config/koneksi.php");
    $q_utd	= mysql_query("select id from utd where aktif='1'");			
    $utd	= mysql_fetch_assoc($q_utd);
    $kembali    = date("Y-m-d",strtotime("-2 days"));
    $today	= date('m-d');
    $pengingat  = mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='2'"));
    $donor      = date("Y-m-d",strtotime("-1 day"));
    $dk         = mysql_query("select nama,Jk,Status, Kode, telp2 from pendonor where Kode like '$utd[id]%' and substring(TglLhr,6,6) like '$today' AND telp2 like '08%' and length(telp2)>9 and Cekal='0'");
    while ($dk1=mysql_fetch_assoc($dk)) {

	if ($dk1[Jk]=='0' and $dk1[Status]=='1') $sapa='Bpk';
	if ($dk1[Jk]=='0' and $dk1[Status]=='0') $sapa='Sdr';
	if ($dk1[Jk]=='1' and $dk1[Status]=='1') $sapa='Ibu';
	if ($dk1[Jk]=='1' and $dk1[Status]=='0') $sapa='Sdri';
        $telp   =$dk1[telp2];
        $pesan  ='Yth. '.$sapa.'. '.$dk1[nama].', '.$pengingat[pesan];
        
	$query="INSERT into wagw.outbox(`wa_mode`,`wa_no`,`wa_text`) values
		  	  ('1','$telp','$pesan')";	
           // jalankan query
           mysql_query($query);
        }
        //$kirim  = mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) values ('$telp','$pesan','1')");
    
