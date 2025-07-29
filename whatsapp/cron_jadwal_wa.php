<?php
include ("/var/www/simudda/config/koneksi.php");
    $q_utd	= mysql_query("select id from utd where aktif='1'");			
    $utd	= mysql_fetch_assoc($q_utd);
    $kembali    = date("Y-m-d",strtotime("-2 days"));
    $today	= date("y-m-d");

    $donor      = date("Y-m-d");
    //$dk         = mysql_query("select nama,Jk,Status, Kode, telp2 from pendonor where Kode like '$utd[id]%' and tglkembali='$donor'  and length(telp2)>9 and cekal='0' and umur<'60'");
  
   //UPDATE 070718THEO
    $dk         = mysql_query("select title,jam,telp2 from v_jadwal_apheresis WHERE tgl='$donor'  and telp2 like '08%' ");


    while ($dk1=mysql_fetch_assoc($dk)) {
        $telp   =$dk1['telp2'];
        $pesan  ='Yth. '.$dk1['title'].', Anda dijadwalkan Donor Darah Plasma Konvalesen hari ini, pada pukul '.$dk1['jam'].' WIB di PMI Kota Surakarta. Terima Kasih telah membantu sesama. Doa kami, semoga sehat selalu dalam lindungan Tuhan Yang Maha Esa. Amin #PMI Solo

Keterangan :
- DS = Donor Sukarela
- DP = Donor Pengganti
- Cek Ulang = Perlu dilakukan cek hematologi sebelum proses donor darah';
        
	   $query="INSERT into wagw.outbox(`wa_mode`,`wa_no`,`wa_text`) values
		  	  ('0','$telp','$pesan')";
           // jalankan query
           mysql_query($query);
        }
       
    mysql_close();
?>
