<?
session_start();
include ('../config/db_connect.php');
 $lv0=$_SESSION[leveluser];
   $notrans=mysql_real_escape_string($_GET[notrans]);
   $kode=mysql_real_escape_string($_GET[kode]);
   $status=mysql_real_escape_string($_GET[status]);

         if ($lv0=='admin') {
                    if ($status=="p10"){
                        $tambah=mysql_query("UPDATE pendonor SET
                                  p10='0'
                                  where kode='$kode'");
                    }  elseif ($status=="p25") {
                       $tambah=mysql_query("UPDATE pendonor SET
                                  p25='0'
                                  where kode='$kode'");
                    } elseif ($status=="p50") {
                       $tambah=mysql_query("UPDATE pendonor SET
                                  p50='0'
                                  where kode='$kode'");
                    } elseif ($status=="p75") {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  p75='0'
                                  where kode='$kode'");
                    } elseif ($status=="p100") {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  p100='0'
                                  where kode='$kode'");
                    } elseif ($status=="psatya") {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  psatya='0'
                                  where kode='$kode'");
                    } else {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  pprov='0'
                                  where kode='$kode'");
                    }

                     $tambah_sql=mysql_query("DELETE FROM piagam
                                  WHERE notrans='$notrans'");
                     ?>
<META http-equiv="refresh" content="0; url=../pmiadmin.php?module=piagam">

<?

         } else {
             if ($status=="p10"){
                        $tambah=mysql_query("UPDATE pendonor SET
                                  p10='0'
                                  where kode='$kode'");
                    }  elseif ($status=="p25") {
                       $tambah=mysql_query("UPDATE pendonor SET
                                  p25='0'
                                  where kode='$kode'");
                    } elseif ($status=="p50") {
                       $tambah=mysql_query("UPDATE pendonor SET
                                  p50='0'
                                  where kode='$kode'");
                    } elseif ($status=="p75") {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  p75='0'
                                  where kode='$kode'");
                    } elseif ($status=="p100") {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  p100='0'
                                  where kode='$kode'");
                    } elseif ($status=="psatya") {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  psatya='0'
                                  where kode='$kode'");
                    } else {
                        $tambah=mysql_query("UPDATE pendonor SET
                                  pprov='0'
                                  where kode='$kode'");
                    }

                     $tambah_sql=mysql_query("DELETE FROM piagam
                                  WHERE notrans='$notrans'");?>
<META http-equiv="refresh" content="0; url=../pmikasir.php?module=piagam">

<?


         }
 ?>
			





