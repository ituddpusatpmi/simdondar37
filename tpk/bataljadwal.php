
<?php
include ('config/dbi_connect.php');
include ('clogin.php');
$namauser   =   $_SESSION['namauser'];
$lv0        =   'pmi'.$_SESSION['leveluser'];
$trans      =   $_GET['trx'];
$nama       =   $_GET['nama'];
$nohp       =   $_GET['nohp'];

    //HTRSANSAKSI
    $batal = mysqli_query($dbi,"UPDATE htransaksi set `pengambilan`='1',`Status`='1', `ketBatal`='10' where `NoTrans`='$trans'");
    //JADWAL
    $event = mysqli_query($dbi,"UPDATE events set `stat`='2' where `notrans`='$trans'");
    //WHATSAPP
    $pesan='Yth. '.$nama.', '.'Jadwal donor darah Plasma Anda telah dibatalkan. Untuk keterangan lebih lanjut silahkan menghubungi UDD PMI, Terima Kasih & Sehat Selalu';
    $kirim=mysqli_query($dbi,"INSERT into wagw.outbox(`wa_mode`,`wa_no`,`wa_text`) values('1','$nohp','$pesan')");
    
    
    if ($batal){
        $log_mdl ='AFTAP';
        $log_aksi='Jadwal Pengambilan Darah No : '.$trans.' atas nama '.$nama.' Dibatalkan';
        include('user_log.php');
        echo ("<font size=3>Pembatalan Pengambilan Berhasil Disimpan<br></font>
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmikasir.php?module=jadwalsampel\">");
    } else {
        echo ("<font size=3>Pembatalan Pengambilan Gagal Disimpan<br></font>
        <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmikasir.php?module=jadwalsampel\">");
    }
    ?>
