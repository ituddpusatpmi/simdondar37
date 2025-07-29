<?
include ("/var/www/simudda/config/koneksi.php");
    $q_utd	= mysql_query("select id from utd where aktif='1'");			
    $utd	= mysql_fetch_assoc($q_utd);
    $kembali    = date("Y-m-d",strtotime("-2 days"));
    $today	= date("y-m-d");
    $pengingat  = mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='1'"));
    $donor      = date("Y-m-d");
    $dk         = mysql_query("select nama,Jk,Status, Kode, telp2 from pendonor where Kode like '$utd[id]%' and tglkembali='$donor'  and length(telp2)>9 and cekal='0' and umur<'60'");
$ubahtabel=mysql_query("ALTER TABLE `kegiatan` CHANGE `TglPenjadwalan` `TglPenjadwalan` DATE NULL DEFAULT NULL ");
?>
