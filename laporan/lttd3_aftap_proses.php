<?php
include('/var/www/simudda/config/db_connect.php');
$no=0;
/*
$col=mysql_query("SELECT hasil_hbsag FROM htransaksi");if (!$col){
     mysql_query("ALTER TABLE  `htransaksi` ADD  `hasil_hbsag` VARCHAR( 1 ) NOT NULL DEFAULT  '0'");
     mysql_query("ALTER TABLE  `htransaksi` ADD  `hasil_hcv` VARCHAR( 1 ) NOT NULL DEFAULT  '0'");
     mysql_query("ALTER TABLE  `htransaksi` ADD  `hasil_hiv` VARCHAR( 1 ) NOT NULL DEFAULT  '0'");
     mysql_query("ALTER TABLE  `htransaksi` ADD  `hasil_syp` VARCHAR( 1 ) NOT NULL DEFAULT  '0'");
     mysql_query("ALTER TABLE  `htransaksi` ADD  `hasil_nat` VARCHAR( 1 ) NOT NULL DEFAULT  '0'");
     mysql_query("ALTER TABLE  `htransaksi` ADD  `tglperiksa` DATE NOT NULL");
     mysql_query("Update `htransaksi` set hasil_hbsag='0', `hasil_hcv`='0', `hasil_hiv`='0', `hasil_syp`='0', `hasil_nat`='0', `tglperiksa`='0000-00-00'");}
     mysql_query("ALTER TABLE  `drapidtest` CHANGE  `tgl_tes`  `tgl_tes` DATE NULL");
$col=mysql_num_rows(mysql_query("SHOW KEYS FROM `htransaksi`")); if ($col==0){mysql_query("ALTER TABLE  `pmi`.`htransaksi` ADD INDEX (  `NoTrans` ,  `KodePendonor`, `NoKantong` )");}
$col=mysql_num_rows(mysql_query("SHOW KEYS FROM `drapidtest` WHERE Key_name='noKantong'"));if ($col==0){mysql_query("ALTER TABLE  `pmi`.`drapidtest` ADD INDEX (  `noKantong` ,  `jenisperiksa` )");}
     mysql_query("update htransaksi inner join hasilelisa on (htransaksi.Nokantong=hasilelisa.nokantong) set htransaksi.tglperiksa=hasilelisa.tglPeriksa where (date(hasilelisa.tglPeriksa)>='$tanggalawal' and date(hasilelisa.tglPeriksa)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join drapidtest on (htransaksi.Nokantong=drapidtest.nokantong) set htransaksi.tglperiksa=drapidtest.tgl_tes where (date(drapidtest.tgl_tes)>='$tanggalawal' and date(drapidtest.tgl_tes)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join hasilelisa on (htransaksi.Nokantong=hasilelisa.nokantong) set hasil_hbsag='1' where hasilelisa.jenisPeriksa='0' and hasilelisa.Hasil='1' and (date(hasilelisa.tglPeriksa)>='$tanggalawal' and date(hasilelisa.tglPeriksa)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join hasilelisa on (htransaksi.Nokantong=hasilelisa.nokantong) set hasil_hcv='1' where hasilelisa.jenisPeriksa='1' and hasilelisa.Hasil='1' and (date(hasilelisa.tglPeriksa)>='$tanggalawal' and date(hasilelisa.tglPeriksa)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join hasilelisa on (htransaksi.Nokantong=hasilelisa.nokantong) set hasil_hiv='1' where hasilelisa.jenisPeriksa='2' and hasilelisa.Hasil='1' and (date(hasilelisa.tglPeriksa)>='$tanggalawal' and date(hasilelisa.tglPeriksa)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join hasilelisa on (htransaksi.Nokantong=hasilelisa.nokantong) set hasil_syp='1' where hasilelisa.jenisPeriksa='3' and hasilelisa.Hasil='1' and (date(hasilelisa.tglPeriksa)>='$tanggalawal' and date(hasilelisa.tglPeriksa)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join drapidtest on (htransaksi.Nokantong=drapidtest.noKantong) set hasil_hbsag='1' where drapidtest.jenisperiksa='0' and drapidtest.Hasil='0' and (date(drapidtest.tgl_tes)>='$tanggalawal' and date(drapidtest.tgl_tes)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join drapidtest on (htransaksi.Nokantong=drapidtest.noKantong) set hasil_hcv='1' where drapidtest.jenisperiksa='1' and drapidtest.Hasil='0' and (date(drapidtest.tgl_tes)>='$tanggalawal' and date(drapidtest.tgl_tes)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join drapidtest on (htransaksi.Nokantong=drapidtest.noKantong) set hasil_hiv='1' where drapidtest.jenisperiksa='2' and drapidtest.Hasil='0' and (date(drapidtest.tgl_tes)>='$tanggalawal' and date(drapidtest.tgl_tes)<='$tanggalakhir')");
     mysql_query("update htransaksi inner join drapidtest on (htransaksi.Nokantong=drapidtest.noKantong) set hasil_syp='1' where drapidtest.jenisperiksa='3' and drapidtest.Hasil='0' and (date(drapidtest.tgl_tes)>='$tanggalawal' and date(drapidtest.tgl_tes)<='$tanggalakhir')");
*/
$sql="SELECT CASE WHEN htransaksi.jenisdonor='0' THEN 'DS' ELSE 'DP' END AS dsdp, CASE WHEN pendonor.Jk='0' THEN 'LK' ElSE 'PR' END AS jk,
   CASE WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'u31' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'u41'  
   WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'u51' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) > 60 THEN 'u61'else 'u16' END AS Umur,
   htransaksi.hasil_hbsag as hbsag,htransaksi.hasil_hcv as hcv,htransaksi.hasil_hiv as hiv,htransaksi.hasil_syp as syp,count(htransaksi.Nokantong) as jumlah
   FROM htransaksi inner join pendonor on pendonor.Kode=htransaksi.KodePendonor where (date(htransaksi.tgl)>='$tanggalawal' and date(htransaksi.tgl)<='$tanggalakhir') and LENGTH(htransaksi.noKantong)>1
   group by case when htransaksi.jenisdonor='0' THEN 'DS' else 'DP' END, case when pendonor.Jk='0' THEN 'LK' ElSE 'PR' END, CASE WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) BETWEEN  31 AND 40 THEN 'u31' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) BETWEEN  41 AND 50 THEN 'u41'  
   WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) BETWEEN  51 AND 60 THEN 'u51' WHEN FLOOR((TO_DAYS(NOW())- TO_DAYS(pendonor.TglLhr)) / 365.25) > 60 THEN 'u61'else 'u16' END,
   htransaksi.hasil_hbsag,htransaksi.hasil_hcv,htransaksi.hasil_hiv,htransaksi.hasil_syp";

$jum_nr_17=0;           $jum_nr_31=0;           $jum_nr_41=0;           $jum_nr_51=0;           $jum_nr_61=0;
$jum_nr_17_ds_lk=0;     $jum_nr_31_ds_lk=0;     $jum_nr_41_ds_lk=0;     $jum_nr_51_ds_lk=0;     $jum_nr_61_ds_lk=0;
$jum_nr_17_ds_pr=0;     $jum_nr_31_ds_pr=0;     $jum_nr_41_ds_pr=0;     $jum_nr_51_ds_pr=0;     $jum_nr_61_ds_pr=0;
$jum_nr_17_dp_lk=0;     $jum_nr_31_dp_lk=0;     $jum_nr_41_dp_lk=0;     $jum_nr_51_dp_lk=0;     $jum_nr_61_dp_lk=0;
$jum_nr_17_dp_pr=0;     $jum_nr_31_dp_pr=0;     $jum_nr_41_dp_pr=0;     $jum_nr_51_dp_pr=0;     $jum_nr_61_dp_pr=0;
$jum_rb_17=0;           $jum_rb_31=0;           $jum_rb_41=0;           $jum_rb_51=0;           $jum_rb_61=0;
$jum_rb_17_ds_lk=0;     $jum_rb_31_ds_lk=0;     $jum_rb_41_ds_lk=0;     $jum_rb_51_ds_lk=0;     $jum_rb_61_ds_lk=0;
$jum_rb_17_ds_pr=0;     $jum_rb_31_ds_pr=0;     $jum_rb_41_ds_pr=0;     $jum_rb_51_ds_pr=0;     $jum_rb_61_ds_pr=0;
$jum_rb_17_dp_lk=0;     $jum_rb_31_dp_lk=0;     $jum_rb_41_dp_lk=0;     $jum_rb_51_dp_lk=0;     $jum_rb_61_dp_lk=0;
$jum_rb_17_dp_pr=0;     $jum_rb_31_dp_pr=0;     $jum_rb_41_dp_pr=0;     $jum_rb_51_dp_pr=0;     $jum_rb_61_dp_pr=0;
$jum_rc_17=0;           $jum_rc_31=0;           $jum_rc_41=0;           $jum_rc_51=0;           $jum_rc_61=0;
$jum_rc_17_ds_lk=0;     $jum_rc_31_ds_lk=0;     $jum_rc_41_ds_lk=0;     $jum_rc_51_ds_lk=0;     $jum_rc_61_ds_lk=0;
$jum_rc_17_ds_pr=0;     $jum_rc_31_ds_pr=0;     $jum_rc_41_ds_pr=0;     $jum_rc_51_ds_pr=0;     $jum_rc_61_ds_pr=0;
$jum_rc_17_dp_lk=0;     $jum_rc_31_dp_lk=0;     $jum_rc_41_dp_lk=0;     $jum_rc_51_dp_lk=0;     $jum_rc_61_dp_lk=0;
$jum_rc_17_dp_pr=0;     $jum_rc_31_dp_pr=0;     $jum_rc_41_dp_pr=0;     $jum_rc_51_dp_pr=0;     $jum_rc_61_dp_pr=0;
$jum_ri_17=0;           $jum_ri_31=0;           $jum_ri_41=0;           $jum_ri_51=0;           $jum_ri_61=0;
$jum_ri_17_ds_lk=0;     $jum_ri_31_ds_lk=0;     $jum_ri_41_ds_lk=0;     $jum_ri_51_ds_lk=0;     $jum_ri_61_ds_lk=0;
$jum_ri_17_ds_pr=0;     $jum_ri_31_ds_pr=0;     $jum_ri_41_ds_pr=0;     $jum_ri_51_ds_pr=0;     $jum_ri_61_ds_pr=0;
$jum_ri_17_dp_lk=0;     $jum_ri_31_dp_lk=0;     $jum_ri_41_dp_lk=0;     $jum_ri_51_dp_lk=0;     $jum_ri_61_dp_lk=0;
$jum_ri_17_dp_pr=0;     $jum_ri_31_dp_pr=0;     $jum_ri_41_dp_pr=0;     $jum_ri_51_dp_pr=0;     $jum_ri_61_dp_pr=0;
$jum_rs_17=0;           $jum_rs_31=0;           $jum_rs_41=0;           $jum_rs_51=0;           $jum_rs_61=0;
$jum_rs_17_ds_lk=0;     $jum_rs_31_ds_lk=0;     $jum_rs_41_ds_lk=0;     $jum_rs_51_ds_lk=0;     $jum_rs_61_ds_lk=0;
$jum_rs_17_ds_pr=0;     $jum_rs_31_ds_pr=0;     $jum_rs_41_ds_pr=0;     $jum_rs_51_ds_pr=0;     $jum_rs_61_ds_pr=0;
$jum_rs_17_dp_lk=0;     $jum_rs_31_dp_lk=0;     $jum_rs_41_dp_lk=0;     $jum_rs_51_dp_lk=0;     $jum_rs_61_dp_lk=0;
$jum_rs_17_dp_pr=0;     $jum_rs_31_dp_pr=0;     $jum_rs_41_dp_pr=0;     $jum_rs_51_dp_pr=0;     $jum_rs_61_dp_pr=0;
$dt=mysql_query($sql,$con);
while ($data0=mysql_fetch_assoc($dt)) {
	$no++;
    if ($data0['dsdp']=='DS'){
        if($data0['jk']=='LK'){
            switch ($data0['Umur']){
            case 'u16'  :   $jum_nr_17          = $jum_nr_17 + $data0['jumlah'];
                            $jum_nr_17_ds_lk    = $jum_nr_17_ds_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_17 = $jum_rb_17 + $data0['jumlah'];$jum_rb_17_ds_lk = $jum_rb_17_ds_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_17 = $jum_rc_17 + $data0['jumlah'];$jum_rc_17_ds_lk = $jum_rc_17_ds_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_17 = $jum_ri_17 + $data0['jumlah'];$jum_ri_17_ds_lk = $jum_ri_17_ds_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_17 = $jum_rs_17 + $data0['jumlah'];$jum_rs_17_ds_lk = $jum_rs_17_ds_lk + $data0['jumlah'];}
                            break;
            case 'u31'  :   $jum_nr_31          = $jum_nr_31 + $data0['jumlah'];
                            $jum_nr_31_ds_lk    = $jum_nr_31_ds_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_31 = $jum_rb_31 + $data0['jumlah'];$jum_rb_31_ds_lk = $jum_rb_31_ds_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_31 = $jum_rc_31 + $data0['jumlah'];$jum_rc_31_ds_lk = $jum_rc_31_ds_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_31 = $jum_ri_31 + $data0['jumlah'];$jum_ri_31_ds_lk = $jum_ri_31_ds_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_31 = $jum_rs_31 + $data0['jumlah'];$jum_rs_31_ds_lk = $jum_rs_31_ds_lk + $data0['jumlah'];}
                            break;
            case 'u41'  :   $jum_nr_41          = $jum_nr_41 + $data0['jumlah'];
                            $jum_nr_41_ds_lk    = $jum_nr_41_ds_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_41 = $jum_rb_41 + $data0['jumlah'];$jum_rb_41_ds_lk = $jum_rb_41_ds_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_41 = $jum_rc_41 + $data0['jumlah'];$jum_rc_41_ds_lk = $jum_rc_41_ds_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_41 = $jum_ri_41 + $data0['jumlah'];$jum_ri_41_ds_lk = $jum_ri_41_ds_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_41 = $jum_rs_41 + $data0['jumlah'];$jum_rs_41_ds_lk = $jum_rs_41_ds_lk + $data0['jumlah'];}
                            break;
            case 'u51'  :   $jum_nr_51          = $jum_nr_51 + $data0['jumlah'];
                            $jum_nr_51_ds_lk    = $jum_nr_51_ds_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_51 = $jum_rb_51 + $data0['jumlah'];$jum_rb_51_ds_lk = $jum_rb_51_ds_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_51 = $jum_rc_51 + $data0['jumlah'];$jum_rc_51_ds_lk = $jum_rc_51_ds_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_51 = $jum_ri_51 + $data0['jumlah'];$jum_ri_51_ds_lk = $jum_ri_51_ds_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_51 = $jum_rs_51 + $data0['jumlah'];$jum_rs_51_ds_lk = $jum_rs_51_ds_lk + $data0['jumlah'];}
                            break;
            case 'u61'  :   $jum_nr_61          = $jum_nr_61 + $data0['jumlah'];
                            $jum_nr_61_ds_lk    = $jum_nr_61_ds_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_61 = $jum_rb_61 + $data0['jumlah'];$jum_rb_61_ds_lk = $jum_rb_61_ds_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_61 = $jum_rc_61 + $data0['jumlah'];$jum_rc_61_ds_lk = $jum_rc_61_ds_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_61 = $jum_ri_61 + $data0['jumlah'];$jum_ri_61_ds_lk = $jum_ri_61_ds_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_61 = $jum_rs_61 + $data0['jumlah'];$jum_rs_61_ds_lk = $jum_rs_61_ds_lk + $data0['jumlah'];}
                            break;
            }
        }
        else {
            switch ($data0['Umur']){
            case 'u16'  :   $jum_nr_17          = $jum_nr_17 + $data0['jumlah'];
                            $jum_nr_17_ds_pr    = $jum_nr_17_ds_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_17 = $jum_rb_17 + $data0['jumlah'];$jum_rb_17_ds_pr = $jum_rb_17_ds_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_17 = $jum_rc_17 + $data0['jumlah'];$jum_rc_17_ds_pr = $jum_rc_17_ds_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_17 = $jum_ri_17 + $data0['jumlah'];$jum_ri_17_ds_pr = $jum_ri_17_ds_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_17 = $jum_rs_17 + $data0['jumlah'];$jum_rs_17_ds_pr = $jum_rs_17_ds_pr + $data0['jumlah'];}
                            break;
            case 'u31'  :   $jum_nr_31          = $jum_nr_31 + $data0['jumlah'];
                            $jum_nr_31_ds_pr    = $jum_nr_31_ds_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_31 = $jum_rb_31 + $data0['jumlah'];$jum_rb_31_ds_pr = $jum_rb_31_ds_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_31 = $jum_rc_31 + $data0['jumlah'];$jum_rc_31_ds_pr = $jum_rc_31_ds_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_31 = $jum_ri_31 + $data0['jumlah'];$jum_ri_31_ds_pr = $jum_ri_31_ds_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_31 = $jum_rs_31 + $data0['jumlah'];$jum_rs_31_ds_pr = $jum_rs_31_ds_pr + $data0['jumlah'];}
                            break;
            case 'u41'  :   $jum_nr_41          = $jum_nr_41 + $data0['jumlah'];
                            $jum_nr_41_ds_pr    = $jum_nr_41_ds_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_41 = $jum_rb_41 + $data0['jumlah'];$jum_rb_41_ds_pr = $jum_rb_41_ds_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_41 = $jum_rc_41 + $data0['jumlah'];$jum_rc_41_ds_pr = $jum_rc_41_ds_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_41 = $jum_ri_41 + $data0['jumlah'];$jum_ri_41_ds_pr = $jum_ri_41_ds_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_41 = $jum_rs_41 + $data0['jumlah'];$jum_rs_41_ds_pr = $jum_rs_41_ds_pr + $data0['jumlah'];}
                            break;
            case 'u51'  :   $jum_nr_51          = $jum_nr_51 + $data0['jumlah'];
                            $jum_nr_51_ds_pr    = $jum_nr_51_ds_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_51 = $jum_rb_51 + $data0['jumlah'];$jum_rb_51_ds_pr = $jum_rb_51_ds_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_51 = $jum_rc_51 + $data0['jumlah'];$jum_rc_51_ds_pr = $jum_rc_51_ds_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_51 = $jum_ri_51 + $data0['jumlah'];$jum_ri_51_ds_pr = $jum_ri_51_ds_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_51 = $jum_rs_51 + $data0['jumlah'];$jum_rs_51_ds_pr = $jum_rs_51_ds_pr + $data0['jumlah'];}
                            break;
            case 'u61'  :   $jum_nr_61          = $jum_nr_61 + $data0['jumlah'];
                            $jum_nr_61_ds_pr    = $jum_nr_61_ds_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_61 = $jum_rb_61 + $data0['jumlah'];$jum_rb_61_ds_pr = $jum_rb_61_ds_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_61 = $jum_rc_61 + $data0['jumlah'];$jum_rc_61_ds_pr = $jum_rc_61_ds_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_61 = $jum_ri_61 + $data0['jumlah'];$jum_ri_61_ds_pr = $jum_ri_61_ds_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_61 = $jum_rs_61 + $data0['jumlah'];$jum_rs_61_ds_pr = $jum_rs_61_ds_pr + $data0['jumlah'];}
                            break;
            } 
        }
    } 
    else {
        if($data0['jk']=='LK'){
            switch ($data0['Umur']){
            case 'u16'  :   $jum_nr_17          = $jum_nr_17 + $data0['jumlah'];
                            $jum_nr_17_dp_lk    = $jum_nr_17_dp_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_17 = $jum_rb_17 + $data0['jumlah'];$jum_rb_17_dp_lk = $jum_rb_17_dp_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_17 = $jum_rc_17 + $data0['jumlah'];$jum_rc_17_dp_lk = $jum_rc_17_dp_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_17 = $jum_ri_17 + $data0['jumlah'];$jum_ri_17_dp_lk = $jum_ri_17_dp_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_17 = $jum_rs_17 + $data0['jumlah'];$jum_rs_17_dp_lk = $jum_rs_17_dp_lk + $data0['jumlah'];}
                            break;
            case 'u31'  :   $jum_nr_31          = $jum_nr_31 + $data0['jumlah'];
                            $jum_nr_31_dp_lk    = $jum_nr_31_dp_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_31 = $jum_rb_31 + $data0['jumlah'];$jum_rb_31_dp_lk = $jum_rb_31_dp_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_31 = $jum_rc_31 + $data0['jumlah'];$jum_rc_31_dp_lk = $jum_rc_31_dp_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_31 = $jum_ri_31 + $data0['jumlah'];$jum_ri_31_dp_lk = $jum_ri_31_dp_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_31 = $jum_rs_31 + $data0['jumlah'];$jum_rs_31_dp_lk = $jum_rs_31_dp_lk + $data0['jumlah'];}
                            break;
            case 'u41'  :   $jum_nr_41          = $jum_nr_41 + $data0['jumlah'];
                            $jum_nr_41_dp_lk    = $jum_nr_41_dp_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_41 = $jum_rb_41 + $data0['jumlah'];$jum_rb_41_dp_lk = $jum_rb_41_dp_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_41 = $jum_rc_41 + $data0['jumlah'];$jum_rc_41_dp_lk = $jum_rc_41_dp_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_41 = $jum_ri_41 + $data0['jumlah'];$jum_ri_41_dp_lk = $jum_ri_41_dp_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_41 = $jum_rs_41 + $data0['jumlah'];$jum_rs_41_dp_lk = $jum_rs_41_dp_lk + $data0['jumlah'];}
                            break;
            case 'u51'  :   $jum_nr_51          = $jum_nr_51 + $data0['jumlah'];
                            $jum_nr_51_dp_lk    = $jum_nr_51_dp_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_51 = $jum_rb_51 + $data0['jumlah'];$jum_rb_51_dp_lk = $jum_rb_51_dp_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_51 = $jum_rc_51 + $data0['jumlah'];$jum_rc_51_dp_lk = $jum_rc_51_dp_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_51 = $jum_ri_51 + $data0['jumlah'];$jum_ri_51_dp_lk = $jum_ri_51_dp_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_51 = $jum_rs_51 + $data0['jumlah'];$jum_rs_51_dp_lk = $jum_rs_51_dp_lk + $data0['jumlah'];}
                            break;
            case 'u61'  :   $jum_nr_61          = $jum_nr_61 + $data0['jumlah'];
                            $jum_nr_61_dp_lk    = $jum_nr_61_dp_lk + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_61 = $jum_rb_61 + $data0['jumlah'];$jum_rb_61_dp_lk = $jum_rb_61_dp_lk + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_61 = $jum_rc_61 + $data0['jumlah'];$jum_rc_61_dp_lk = $jum_rc_61_dp_lk + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_61 = $jum_ri_61 + $data0['jumlah'];$jum_ri_61_dp_lk = $jum_ri_61_dp_lk + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_61 = $jum_rs_61 + $data0['jumlah'];$jum_rs_61_dp_lk = $jum_rs_61_dp_lk + $data0['jumlah'];}
                            break;
            }
        } 
        else {
            switch ($data0['Umur']){
            case 'u16'  :   $jum_nr_17          = $jum_nr_17 + $data0['jumlah'];
                            $jum_nr_17_dp_pr    = $jum_nr_17_dp_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_17 = $jum_rb_17 + $data0['jumlah'];$jum_rb_17_dp_pr = $jum_rb_17_dp_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_17 = $jum_rc_17 + $data0['jumlah'];$jum_rc_17_dp_pr = $jum_rc_17_dp_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_17 = $jum_ri_17 + $data0['jumlah'];$jum_ri_17_dp_pr = $jum_ri_17_dp_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_17 = $jum_rs_17 + $data0['jumlah'];$jum_rs_17_dp_pr = $jum_rs_17_dp_pr + $data0['jumlah'];}
                            break;
            case 'u31'  :   $jum_nr_31          = $jum_nr_31 + $data0['jumlah'];
                            $jum_nr_31_dp_pr    = $jum_nr_31_dp_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_31 = $jum_rb_31 + $data0['jumlah'];$jum_rb_31_dp_pr = $jum_rb_31_dp_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_31 = $jum_rc_31 + $data0['jumlah'];$jum_rc_31_dp_pr = $jum_rc_31_dp_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_31 = $jum_ri_31 + $data0['jumlah'];$jum_ri_31_dp_pr = $jum_ri_31_dp_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_31 = $jum_rs_31 + $data0['jumlah'];$jum_rs_31_dp_pr = $jum_rs_31_dp_pr + $data0['jumlah'];}
                            break;
            case 'u41'  :   $jum_nr_41          = $jum_nr_41 + $data0['jumlah'];
                            $jum_nr_41_dp_pr    = $jum_nr_41_dp_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_41 = $jum_rb_41 + $data0['jumlah'];$jum_rb_41_dp_pr = $jum_rb_41_dp_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_41 = $jum_rc_41 + $data0['jumlah'];$jum_rc_41_dp_pr = $jum_rc_41_dp_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_41 = $jum_ri_41 + $data0['jumlah'];$jum_ri_41_dp_pr = $jum_ri_41_dp_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_41 = $jum_rs_41 + $data0['jumlah'];$jum_rs_41_dp_pr = $jum_rs_41_dp_pr + $data0['jumlah'];}
                            break;
            case 'u51'  :   $jum_nr_51          = $jum_nr_51 + $data0['jumlah'];
                            $jum_nr_51_dp_pr    = $jum_nr_51_dp_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_51 = $jum_rb_51 + $data0['jumlah'];$jum_rb_51_dp_pr = $jum_rb_51_dp_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_51 = $jum_rc_51 + $data0['jumlah'];$jum_rc_51_dp_pr = $jum_rc_51_dp_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_51 = $jum_ri_51 + $data0['jumlah'];$jum_ri_51_dp_pr = $jum_ri_51_dp_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_51 = $jum_rs_51 + $data0['jumlah'];$jum_rs_51_dp_pr = $jum_rs_51_dp_pr + $data0['jumlah'];}
                            break;
            case 'u61'  :   $jum_nr_61          = $jum_nr_61 + $data0['jumlah'];
                            $jum_nr_61_dp_pr    = $jum_nr_61_dp_pr + $data0['jumlah'];
                            if ($data0['hbsag']=='1'){$jum_rb_61 = $jum_rb_61 + $data0['jumlah'];$jum_rb_61_dp_pr = $jum_rb_61_dp_pr + $data0['jumlah'];}
                            if ($data0['hcv']=='1')  {$jum_rc_61 = $jum_rc_61 + $data0['jumlah'];$jum_rc_61_dp_pr = $jum_rc_61_dp_pr + $data0['jumlah'];}
                            if ($data0['hiv']=='1')  {$jum_ri_61 = $jum_ri_61 + $data0['jumlah'];$jum_ri_61_dp_pr = $jum_ri_61_dp_pr + $data0['jumlah'];}
                            if ($data0['syp']=='1')  {$jum_rs_61 = $jum_rs_61 + $data0['jumlah'];$jum_rs_61_dp_pr = $jum_rs_61_dp_pr + $data0['jumlah'];}
                            break;
            } 
        } 
    } 
}
