<?php
include('../config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$user=$_SESSION[namauser];
$id=$_GET['id'];
        
        $tambah=mysql_query("UPDATE catatan set stat='1',tgl_selesai=now(), ptgs2='$user' where id='$id'");


            if ($tambah) {
                echo "Catatan telah berhasil diselesaikan <script>parent.$.fn.colorbox.close();</script>";
            ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_catatan"><?
            } else {
            echo "Catatan gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
            ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_catatan"><?
                }
            
?>




