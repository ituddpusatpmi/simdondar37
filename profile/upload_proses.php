<?php
session_start();
include('../config/dbi_connect.php');

$v_tahun    = $_POST['t'];
$v_bulan    = $_POST['b'];
$v_jenis    = $_POST['m'];
//prepare local database===========================================================================
$sqlconfig  = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT * from db_server where modul='laporan'"));
$sqludd     = mysqli_fetch_assoc(mysqli_query($dbi, "SELECT * from utd where aktif=1"));

$svr_lap_usr    = $sqlconfig['user'];
$svr_lap_ip     = $sqlconfig['ip'];
$svr_lap_db     = $sqlconfig['db'];
$svr_lap_pwd    = $sqlconfig['password'];
$svr_lap_mdl    = $sqlconfig['modul'];
$svr_lap_alias  = $sqlconfig['alias'];
$svr_lap_port   = $sqlconfig['port'];


if ($v_jenis=='T'){
    //LAPORAN TAHUNAN=========================
    $dt_lap     = "SELECT * FROM `rpt_data_umum`";
    $dt_lap     = mysqli_fetch_assoc(mysqli_query($dbi, $dt_lap));
    $q_bgn      = mysqli_query($dbi, "SELECT * FROM `rpt_data_bangunan`");
    $q_sdm      = mysqli_query($dbi, "SELECT * FROM `rpt_data_sdm`");
    $q_rtd      = mysqli_query($dbi, "SELECT * FROM `rpt_data_reaksi_td` WHERE `rtd_tahun`='$v_tahun'");
    //PENDONOR===========================================================
    $qd="select
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` <=17) THEN `KodePendonor` END )) AS dslk17,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` <=17) THEN `KodePendonor` END )) AS dspr17,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` <=17) THEN `KodePendonor` END )) AS dplk17,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` <=17) THEN `KodePendonor` END )) AS dppr17,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dslk18,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dspr18,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dplk18,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >17  and `umur`<=24) THEN `KodePendonor` END )) AS dppr18,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dslk24,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dspr24,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dplk24,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >24  and `umur`<=44) THEN `KodePendonor` END )) AS dppr24,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dslk44,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dspr44,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dplk44,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >44  and `umur`<=64) THEN `KodePendonor` END )) AS dppr44,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='0' and `umur` >64) THEN `KodePendonor` END )) AS dslk64,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' AND `jk`='1' and `umur` >64) THEN `KodePendonor` END )) AS dspr64,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='0' and `umur` >64) THEN `KodePendonor` END )) AS dplk64,
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='1' AND `jk`='1' and `umur` >64) THEN `KodePendonor` END )) AS dppr64
        from htransaksi where year(`Tgl`)='$v_tahun' AND `Pengambilan`='0'";
    $qd=mysqli_fetch_assoc(mysqli_query($dbi, $qd));
    $cekal="select
        COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' or `JenisDonor` IS NULL  or `JenisDonor`='') THEN `KodePendonor` END )) AS ds,
        COUNT(DISTINCT(CASE WHEN  `JenisDonor`='1' THEN `KodePendonor` END )) AS dp,
        COUNT(DISTINCT(CASE WHEN  `JenisDonor` NOT IN ('1','0') THEN `KodePendonor` END )) AS ll
        from `htransaksi` h inner join `pendonor` p on p.`Kode`=h.`KodePendonor`
        where year(h.`Tgl`)='$v_tahun' AND h.`Pengambilan`='0' and p.`Cekal`=1";
    $cekal=mysqli_fetch_assoc(mysqli_query($dbi, $cekal));
    $dsbaru="select
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='A' and `rhesus`='+')  THEN `KodePendonor` END )) AS brap,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='B' and `rhesus`='+')  THEN `KodePendonor` END )) AS brbp,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='O' and `rhesus`='+')  THEN `KodePendonor` END )) AS brop,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='AB' and `rhesus`='+')  THEN `KodePendonor` END )) AS brabp,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='A' and `rhesus`='-')  THEN `KodePendonor` END )) AS bran,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='B' and `rhesus`='-')  THEN `KodePendonor` END )) AS brbn,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='O' and `rhesus`='-')  THEN `KodePendonor` END )) AS bron,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='0' and `gol_darah`='AB' and `rhesus`='-')  THEN `KodePendonor` END )) AS brabn,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='A' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulap,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='B' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulbp,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='O' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulop,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='AB' and `rhesus`='+')  THEN `KodePendonor` END )) AS ulabp,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='A' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulan,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='B' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulbn,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='O' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulon,
        COUNT(DISTINCT(CASE WHEN (`donorbaru`='1' and `gol_darah`='AB' and `rhesus`='-')  THEN `KodePendonor` END )) AS ulabn
        from htransaksi
        where year(`Tgl`)='$v_tahun' AND `Pengambilan`='0'";
    $dsbr_ul=mysqli_fetch_assoc(mysqli_query($dbi, $dsbaru));
    $tot_donor= $qd['dslk17']+$qd['dspr17']+$qd['dslk18']+$qd['dspr18']+$qd['dslk24']+$qd['dspr24']+$qd['dslk44']+$qd['dspr44']+$qd['dslk64']+$qd['dspr64']+$qd['dplk17']+$qd['dppr17']+$qd['dplk18']+$qd['dppr18']+$qd['dplk24']+$qd['dppr24']+$qd['dplk44']+$qd['dppr44']+$qd['dplk64']+$qd['dppr64'];
    $tot_ds   = $qd['dslk17']+$qd['dspr17']+$qd['dslk18']+$qd['dspr18']+$qd['dslk24']+$qd['dspr24']+$qd['dslk44']+$qd['dspr44']+$qd['dslk64']+$qd['dspr64'];
    $tot_dp   = $qd['dplk17']+$qd['dppr17']+$qd['dplk18']+$qd['dppr18']+$qd['dplk24']+$qd['dppr24']+$qd['dplk44']+$qd['dppr44']+$qd['dplk64']+$qd['dppr64'];
    $tot_lk   = $qd['dslk17']+$qd['dplk17']+$qd['dslk18']+$qd['dplk18']+$qd['dslk24']+$qd['dplk24']+$qd['dslk44']+$qd['dplk44']+$qd['dslk64']+$qd['dplk64'];
    $tot_pr   = $qd['dspr17']+$qd['dppr17']+$qd['dspr18']+$qd['dppr18']+$qd['dspr24']+$qd['dppr24']+$qd['dspr44']+$qd['dppr44']+$qd['dspr64']+$qd['dppr64'];
    $tot_17   = $qd['dslk17']+$qd['dspr17']+$qd['dplk17']+$qd['dppr17'];
    $tot_18   = $qd['dslk18']+$qd['dspr18']+$qd['dplk18']+$qd['dppr18'];
    $tot_24   = $qd['dslk24']+$qd['dspr24']+$qd['dplk24']+$qd['dppr24'];
    $tot_44   = $qd['dslk44']+$qd['dspr44']+$qd['dplk44']+$qd['dppr44'];
    $tot_64   = $qd['dslk64']+$qd['dspr64']+$qd['dplk64']+$qd['dppr64'];
    $cekal_ds = $cekal['ds'];
    $cekal_dp = $cekal['dp']+$cekal['ll'];
    //for other value is direct from  query result
    //EOF PENDONOR
} else{
    //QUERY LAPORAN BULANAN
    //DONASI WB=====================
    $q_wb="SELECT
            sum(case when (h.`JenisDonor`='0' and h.`tempat`='0' and h.`donorbaru`='0') then 1 else 0 end ) as dg_ds_br,
            sum(case when (h.`JenisDonor`='0' and h.`tempat`='0' and h.`donorbaru`='1') then 1 else 0 end ) as dg_ds_ul,
            sum(case when (h.`JenisDonor`='1' and h.`tempat`='0') then 1 else 0 end ) as dg_dp,
            sum(case when (h.`tempat` in ('2','3','M') and h.`donorbaru`='0') then 1 else 0 end ) as mu_ds_br,
            sum(case when (h.`tempat` in ('2','3','M') and h.`donorbaru`='1') then 1 else 0 end ) as mu_ds_ul,
            sum(case when (h.`jk`='0') then 1 else 0 end ) as lk,
            sum(case when (h.`jk`='1') then 1 else 0 end ) as pr,
            sum(case when (h.`umur`<=17) then 1 else 0 end ) as u17,
            sum(case when (h.`umur`>=18 and h.`umur`<=24) then 1 else 0 end ) as u1824,
            sum(case when (h.`umur`>=25 and h.`umur`<=44) then 1 else 0 end ) as u2544,
            sum(case when (h.`umur`>=45 and h.`umur`<=64) then 1 else 0 end ) as u4564,
            sum(case when (h.`umur`>=65) then 1 else 0 end ) as u65,
            sum(case when (h.`gol_darah`='A' and h.`rhesus`='+') then 1 else 0 end ) as a_pos,
            sum(case when (h.`gol_darah`='B' and h.`rhesus`='+') then 1 else 0 end ) as b_pos,
            sum(case when (h.`gol_darah`='O' and h.`rhesus`='+') then 1 else 0 end ) as o_pos,
            sum(case when (h.`gol_darah`='AB' and h.`rhesus`='+') then 1 else 0 end ) as ab_pos,
            sum(case when (h.`gol_darah`='A' and h.`rhesus`='-') then 1 else 0 end ) as a_neg,
            sum(case when (h.`gol_darah`='B' and h.`rhesus`='-') then 1 else 0 end ) as b_neg,
            sum(case when (h.`gol_darah`='O' and h.`rhesus`='-') then 1 else 0 end ) as o_neg,
            sum(case when (h.`gol_darah`='AB' and h.`rhesus`='-') then 1 else 0 end ) as ab_neg,
            sum(case when (LENGTH(h.`KodePendonor`)>0) then 1 else 0 end ) as total
            FROM `htransaksi` h inner join `pendonor` p on p.`Kode`=h.`KodePendonor`
            WHERE
            year(h.`Tgl`)='$v_tahun' and month(h.`Tgl`)='$v_bulan' and h.`pengambilan`='0' and h.`caraAmbil`='0'";
    $q_wb=mysqli_fetch_assoc(mysqli_query($dbi, $q_wb));
    $q_btl_wb="SELECT
            count(case when (h.`pengambilan`='2') then 1 END) AS a7_gagal_aftap,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='0') then 1 END) AS a4_tensi_rendah,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='1') then 1 END) AS a4_tensi_tinggi,
            count(case when (h.`pengambilan`='1' and (h.`ketBatal`='2' or h.`ketBatal`='3')) then 1 END) AS a3_hb_rendah,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='4') then 1 END) AS a4_hb_tinggi,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='5') then 1 END) AS a1_bb_kurang,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='6') then 1 END) AS a4_obat,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='7') then 1 END) AS a6_bepergian,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='8') then 1 END) AS a4_medis,
            count(case when (h.`pengambilan`='1' and h.`ketBatal`='9') then 1 END) AS a5_prilaku,
            count(case when ((h.`ketBatal`='10' or h.`ketBatal`='') and h.`pengambilan`='1') then 1 END) AS a7_lain_lain
            FROM `htransaksi` h inner join `pendonor` p on p.`Kode`=h.`KodePendonor`
            where year(h.`Tgl`)='$v_tahun' and month(`Tgl`)='$v_bulan' and (h.`caraAmbil` NOT IN ('1','2','3','4','5'))";
    $q_btl_wb=mysqli_fetch_assoc(mysqli_query($dbi, $q_btl_wb));
    $wb_btl_hb          =$q_btl_wb['a3_hb_rendah'];
    $wb_btl_bb          =$q_btl_wb['a1_bb_kurang'];
    $wb_btl_medis       =$q_btl_wb['a4_tensi_rendah']+$q_btl_wb['a4_tensi_tinggi']+$q_btl_wb['a4_hb_tinggi']+$q_btl_wb['a4_obat']+$q_btl_wb['a4_medis'];
    $wb_btl_prilaku     =$q_btl_wb['a5_prilaku'];
    $wb_btl_bepergian   =$q_btl_wb['a6_bepergian'];
    $wb_btl_gagal       =$q_btl_wb['a7_gagal_aftap']+$q_btl_wb['a7_lain_lain'];

    $terimawb="SELECT t.`udd`, u.`nama`, count(t.`nokantong`) as jumlah
             FROM `terimaudd` t inner join `utd` u on u.`id`=t.`udd`
             INNER JOIN `stokkantong` s on s.`noKantong`=t.`nokantong`
             WHERE YEAR(t.`tgl`)='$v_tahun' and MONTH(t.`Tgl`)='$v_bulan' AND s.`produk` not like '%aph%'";
    $terima_wb=mysqli_query($dbi, $terimawb);
    //EOF DONASI WB=======================
    //DONASI APH ======
    $q_aph="SELECT
            sum(case when (h.`JenisDonor`='0' and h.`tempat`='0' and h.`donorbaru`='0') then 1 else 0 end ) as dg_ds_br,
            sum(case when (h.`JenisDonor`='0' and h.`tempat`='0' and h.`donorbaru`='1') then 1 else 0 end ) as dg_ds_ul,
            sum(case when (h.`JenisDonor`='1' and h.`tempat`='0') then 1 else 0 end ) as dg_dp,
            sum(case when (h.`tempat` in ('2','3','M') and h.`donorbaru`='0') then 1 else 0 end ) as mu_ds_br,
            sum(case when (h.`tempat` in ('2','3','M') and h.`donorbaru`='1') then 1 else 0 end ) as mu_ds_ul,
            sum(case when (h.`jk`='0') then 1 else 0 end ) as lk,
            sum(case when (h.`jk`='1') then 1 else 0 end ) as pr,
            sum(case when (h.`umur`<=17) then 1 else 0 end ) as u17,
            sum(case when (h.`umur`>=18 and h.`umur`<=24) then 1 else 0 end ) as u1824,
            sum(case when (h.`umur`>=25 and h.`umur`<=44) then 1 else 0 end ) as u2544,
            sum(case when (h.`umur`>=45 and h.`umur`<=64) then 1 else 0 end ) as u4564,
            sum(case when (h.`umur`>=65) then 1 else 0 end ) as u65,
            sum(case when (h.`gol_darah`='A' and h.`rhesus`='+') then 1 else 0 end ) as a_pos,
            sum(case when (h.`gol_darah`='B' and h.`rhesus`='+') then 1 else 0 end ) as b_pos,
            sum(case when (h.`gol_darah`='O' and h.`rhesus`='+') then 1 else 0 end ) as o_pos,
            sum(case when (h.`gol_darah`='AB' and h.`rhesus`='+') then 1 else 0 end ) as ab_pos,
            sum(case when (h.`gol_darah`='A' and h.`rhesus`='-') then 1 else 0 end ) as a_neg,
            sum(case when (h.`gol_darah`='B' and h.`rhesus`='-') then 1 else 0 end ) as b_neg,
            sum(case when (h.`gol_darah`='O' and h.`rhesus`='-') then 1 else 0 end ) as o_neg,
            sum(case when (h.`gol_darah`='AB' and h.`rhesus`='-') then 1 else 0 end ) as ab_neg,
            sum(case when (LENGTH(h.`KodePendonor`)>0) then 1 else 0 end ) as total
            FROM `htransaksi` h inner join `pendonor` p on p.`Kode`=h.`KodePendonor`
            WHERE
            year(h.`Tgl`)='$v_tahun' and month(h.`Tgl`)='$v_bulan' and h.`Pengambilan`='0' and h.`caraAmbil` in ('1','2','3','4')";
    $q_aph=mysqli_fetch_assoc(mysqli_query($dbi, $q_aph));
    $q_btl_aph="SELECT
             count(case when (h.`pengambilan`='2') then 1 END) AS a7_gagal_aftap,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='0') then 1 END) AS a4_tensi_rendah,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='1') then 1 END) AS a4_tensi_tinggi,
             count(case when (h.`pengambilan`='1' and (h.`ketBatal`='2' or h.`ketBatal`='3')) then 1 END) AS a3_hb_rendah,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='4') then 1 END) AS a4_hb_tinggi,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='5') then 1 END) AS a1_bb_kurang,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='6') then 1 END) AS a4_obat,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='7') then 1 END) AS a6_bepergian,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='8') then 1 END) AS a4_medis,
             count(case when (h.`pengambilan`='1' and h.`ketBatal`='9') then 1 END) AS a5_prilaku,
             count(case when ((h.`ketBatal`='10' or h.`ketBatal`='') and h.`pengambilan`='1') then 1 END) AS a7_lain_lain
             FROM `htransaksi` h inner join `pendonor` p on p.`Kode`=h.`KodePendonor`
             where year(h.`Tgl`)='$v_tahun' and month(`Tgl`)='$v_bulan' and (h.`caraAmbil` IN ('1','2','3','4'))";
    $q_btl_aph=mysqli_fetch_assoc(mysqli_query($dbi, $q_btl_aph));
    $aph_btl_hb          =$q_btl_aph['a3_hb_rendah'];
    $aph_btl_bb          =$q_btl_aph['a1_bb_kurang'];
    $aph_btl_medis       =$q_btl_aph['a4_tensi_rendah']+$q_btl_aph['a4_tensi_tinggi']+$q_btl_aph['a4_hb_tinggi']+$q_btl_aph['a4_obat']+$q_btl_aph['a4_medis'];
    $aph_btl_prilaku     =$q_btl_aph['a5_prilaku'];
    $aph_btl_bepergian   =$q_btl_aph['a6_bepergian'];
    $aph_btl_gagal       =$q_btl_aph['a7_gagal_aftap']+$q_btl_aph['a7_lain_lain'];
    $terimaaph="SELECT t.`udd`, u.`nama`, count(t.`nokantong`) as jumlah
             FROM `terimaudd` t inner join `utd` u on u.`id`=t.`udd`
             INNER JOIN `stokkantong` s on s.`noKantong`=t.`nokantong`
             WHERE YEAR(t.`tgl`)='$v_tahun' and MONTH(t.`Tgl`)='$v_bulan' AND s.`produk` like '%aph%'";
    $terima_aph=mysqli_query($dbi, $terimaaph);
    //EOF APH==========================

    //IMLTD ===========================
    $e_tot="SELECT
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='0'  THEN h.`noKantong` END )) AS hbv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='1'  THEN h.`noKantong` END )) AS hcv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='2'  THEN h.`noKantong` END )) AS hiv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='3'  THEN h.`noKantong` END )) AS syp
                                    from `hasilelisa` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                    where month(h.`tglPeriksa`)='$v_bulan' and year(h.`tglPeriksa`)='$v_tahun'";
    $e_tot=mysqli_fetch_assoc(mysqli_query($dbi, $e_tot));
    $r_tot="SELECT
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='0'  THEN h.`noKantong` END )) AS hbv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='1'  THEN h.`noKantong` END )) AS hcv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='2'  THEN h.`noKantong` END )) AS hiv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='3'  THEN h.`noKantong` END )) AS syp
                                    from `drapidtest` h INNER join `stokkantong` s on s.`noKantong`=h.`noKantong`
                                    where month(h.`tgl_tes`)='$v_bulan' and year(h.`tgl_tes`)='$v_tahun'";
    $r_tot=mysqli_fetch_assoc(mysqli_query($dbi, $r_tot));

    $e_ir="SELECT
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='0'  THEN h.`noKantong` END )) AS hbv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='1'  THEN h.`noKantong` END )) AS hcv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='2'  THEN h.`noKantong` END )) AS hiv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisPeriksa`='3'  THEN h.`noKantong` END )) AS syp
                                    from `hasilelisa` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                    where h.`Hasil`='1' AND month(h.`tglPeriksa`)='$v_bulan' AND year(h.`tglPeriksa`)='$v_tahun'";
    $e_ir=mysqli_fetch_assoc(mysqli_query($dbi, $e_ir));
    $r_ir="SELECT
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='0'  THEN h.`noKantong` END )) AS hbv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='1'  THEN h.`noKantong` END )) AS hcv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='2'  THEN h.`noKantong` END )) AS hiv,
                                    COUNT(DISTINCT(CASE WHEN h.`jenisperiksa`='3'  THEN h.`noKantong` END )) AS syp
                                    from `drapidtest` h INNER join `stokkantong` s on s.`noKantong`=h.`noKantong`
                                    where h.`Hasil`='0' AND month(h.`tgl_tes`)='$v_bulan' AND year(h.`tgl_tes`)='$v_tahun'";
    $r_ir=mysqli_fetch_assoc(mysqli_query($dbi, $r_ir));
    $e_rr_b ="SELECT h.`noKantong`, COUNT(*) as Pengulangan
                                  FROM `hasilelisa` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                  WHERE h.`jenisPeriksa`='0' AND  h.`Hasil`='1' AND month(h.`tglPeriksa`)='$v_bulan' AND year(h.`tglPeriksa`)='$v_tahun'
                                  GROUP BY h.`noKantong`
                                  HAVING  COUNT(h.`noKantong`) > 1";
    $e_rr_hbv = mysqli_num_rows(mysqli_query($dbi, $e_rr_b));

    $e_rr_c ="SELECT h.`noKantong`, COUNT(*) as Pengulangan
                                  FROM `hasilelisa` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                  WHERE h.`jenisPeriksa`='1' AND  h.`Hasil`='1' AND month(h.`tglPeriksa`)='$v_bulan' AND year(h.`tglPeriksa`)='$v_tahun'
                                  GROUP BY h.`noKantong`
                                  HAVING  COUNT(h.`noKantong`) > 1";
    $e_rr_hcv = mysqli_num_rows(mysqli_query($dbi, $e_rr_c));

    $e_rr_i ="SELECT h.`noKantong`, COUNT(*) as Pengulangan FROM
                                  `hasilelisa` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                  WHERE h.`jenisPeriksa`='2' AND  h.`Hasil`='1' AND month(h.`tglPeriksa`)='$v_bulan' AND year(h.`tglPeriksa`)='$v_tahun'
                                  GROUP BY h.`noKantong`
                                  HAVING  COUNT(h.`noKantong`) > 1";
    $e_rr_hiv = mysqli_num_rows(mysqli_query($dbi, $e_rr_i));

    $e_rr_s ="SELECT h.`noKantong`, COUNT(*) as Pengulangan
                                  FROM `hasilelisa` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                  WHERE h.`jenisPeriksa`='3' AND  h.`Hasil`='1' AND month(h.`tglPeriksa`)='$v_bulan' AND year(h.`tglPeriksa`)='$v_tahun'
                                  GROUP BY h.`noKantong`
                                  HAVING  COUNT(h.`noKantong`) > 1";
    $e_rr_syp = mysqli_num_rows(mysqli_query($dbi, $e_rr_s));

    $r_rr_b ="SELECT h.`noKantong`, COUNT(*) as Pengulangan
                                  FROM `drapidtest` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                  WHERE h.`jenisperiksa`='0' AND  h.`Hasil`='0' AND month(h.`tgl_tes`)='$v_bulan' AND year(h.`tgl_tes`)='$v_tahun'
                                  GROUP BY h.`noKantong`
                                  HAVING  COUNT(h.`noKantong`) > 1";
    $r_rr_hbv = mysqli_num_rows(mysqli_query($dbi, $r_rr_b));

    $r_rr_c ="SELECT h.`noKantong`, COUNT(*) as Pengulangan
                                  FROM `drapidtest` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                  WHERE h.`jenisperiksa`='1' AND  h.`Hasil`='0' AND month(h.`tgl_tes`)='$v_bulan' AND year(h.`tgl_tes`)='$v_tahun'
                                  GROUP BY h.`noKantong`
                                  HAVING  COUNT(h.`noKantong`) > 1";
    $r_rr_hcv = mysqli_num_rows(mysqli_query($dbi, $r_rr_c));    

    $r_rr_i ="SELECT `noKantong`, COUNT(*) as Pengulangan FROM `hasilelisa`
                                WHERE `jenisperiksa`='2' AND  `Hasil`='0' AND month(`tgl_tes`)='$v_bulan' AND year(`tgl_tes`)='$v_tahun'
                                GROUP BY `noKantong`
                                HAVING  COUNT(`noKantong`) > 1";
    $r_rr_hiv = mysqli_num_rows(mysqli_query($dbi, $r_rr_i));

    $r_rr_s ="SELECT h.`noKantong`, COUNT(*) as Pengulangan
                                  FROM `drapidtest` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                  WHERE h.`jenisperiksa`='2' AND  h.`Hasil`='0' AND month(h.`tgl_tes`)='$v_bulan' AND year(h.`tgl_tes`)='$v_tahun'
                                  GROUP BY h.`noKantong`
                                  HAVING  COUNT(h.`noKantong`) > 1";
    $r_rr_syp = mysqli_num_rows(mysqli_query($dbi, $r_rr_s));
    $hbv_tot= $e_tot['hbv']+$r_tot['hbv'];
    $hbv_ir= $e_ir['hbv']+$r_ir['hbv'];
    $hbv_rr= $e_rr_hbv+$r_rr_hbv;
    $hcv_tot= $e_tot['hcv']+$r_tot['hcv'];
    $hcv_ir= $e_ir['hcv']+$r_ir['hcv'];
    $hcv_rr= $e_rr_hcv+$r_rr_hcv;
    $hiv_tot= $e_tot['hiv']+$r_tot['hiv'];
    $hiv_ir= $e_ir['hiv']+$r_ir['hiv'];
    $hiv_rr= $e_rr_hiv+$r_rr_hiv;
    $syp_tot= $e_tot['syp']+$r_tot['syp'];
    $syp_ir= $e_ir['syp']+$r_ir['syp'];
    $syp_rr= $e_rr_syp+$r_rr_syp;

    $reag_elisa="select
                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='chlia' and h.`jenisPeriksa`='0' THEN h.`noKantong` end)) as chl_b,
                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='chlia' and h.`jenisPeriksa`='1' THEN h.`noKantong` end)) as chl_c,
                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='chlia' and h.`jenisPeriksa`='2' THEN h.`noKantong` end)) as chl_i,
                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='chlia' and h.`jenisPeriksa`='3' THEN h.`noKantong` end)) as chl_s,

                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='elisa' and h.`jenisPeriksa`='0' THEN h.`noKantong` end)) as eia_b,
                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='elisa' and h.`jenisPeriksa`='1' THEN h.`noKantong` end)) as eia_c,
                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='elisa' and h.`jenisPeriksa`='2' THEN h.`noKantong` end)) as eia_i,
                                    COUNT(DISTINCT(CASE WHEN h.`Metode`='elisa' and h.`jenisPeriksa`='3' THEN h.`noKantong` end)) as eia_s
                                    from `hasilelisa` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                    where
                                    month(h.`tglPeriksa`)='$v_bulan' and year(h.`tglPeriksa`)='$v_tahun'";
    $reag_elisa=mysqli_fetch_assoc(mysqli_query($dbi, $reag_elisa));
    $reag_rapid="SELECT
                                    count(DISTINCT(case when h.`jenisperiksa`='0' then h.`noKantong` end)) as rpd_b,
                                    count(DISTINCT(case when h.`jenisperiksa`='1' then h.`noKantong` end)) as rpd_c,
                                    count(DISTINCT(case when h.`jenisperiksa`='2' then h.`noKantong` end)) as rpd_i,
                                    count(DISTINCT(case when h.`jenisperiksa`='3' then h.`noKantong` end)) as rpd_s
                                    FROM `drapidtest` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`noKantong`
                                    where
                                    month(h.`tgl_tes`)='$v_bulan' and year(h.`tgl_tes`)='$v_tahun'";
    $reag_rapid=mysqli_fetch_assoc(mysqli_query($dbi, $reag_rapid));
    $nat="SELECT count(DISTINCT(h.`sample_id`)) as jml_nat
                              FROM `imltd_procleix_raw` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`sample_id`
                              where month(h.`date`)='$v_bulan' and  year(h.`date`)='$v_tahun'";
    $nat=mysqli_fetch_assoc(mysqli_query($dbi, $nat));
    $nm_chl="select e.`Metode`, e.`jenisPeriksa`, r.`Nama`,
                                 count(e.`noKantong`) as jml
                                 from hasilelisa e INNER JOIN `reagen` r on r.`kode`=e.`noLot`
                                      INNER JOIN `stokkantong` s on s.`noKantong`=e.`noKantong`
                                 where
                                 year(e.`tglPeriksa`)='$v_tahun' and
                                 month(e.`tglPeriksa`)='$v_bulan'
                                 group by e.`Metode`,e.`jenisPeriksa`,r.`Nama`";
    $reag_chl_hbv='';$reag_chl_hcv='';$reag_chl_hiv='';$reag_chl_syp='';
    $reag_eia_hbv='';$reag_eia_hcv='';$reag_eia_hiv='';$reag_eia_syp='';
    $result=mysqli_query($dbi, $nm_chl);
    while ($row=mysqli_fetch_assoc($result)){
        switch ($row['Metode']){
            case 'chlia' :
                switch($row['jenisPeriksa']){
                    case '0': if (strlen($reag_chl_hbv)==0){$reag_chl_hbv = $row['Nama'];}else{$reag_chl_hbv = $reag_chl_hbv.'; '.$row['Nama'];}break;
                    case '1': if (strlen($reag_chl_hcv)==0){$reag_chl_hcv = $row['Nama'];}else{$reag_chl_hcv = $reag_chl_hcv.'; '.$row['Nama'];}break;
                    case '2': if (strlen($reag_chl_hiv)==0){$reag_chl_hiv = $row['Nama'];}else{$reag_chl_hiv = $reag_chl_hiv.'; '.$row['Nama'];}break;
                    case '3': if (strlen($reag_chl_syp)==0){$reag_chl_syp = $row['Nama'];}else{$reag_chl_syp = $reag_chl_syp.'; '.$row['Nama'];}break;
                }
                break;
            case 'elisa' :
                switch($row['jenisPeriksa']){
                    case '0': if (strlen($reag_eia_hbv)==0){$reag_eia_hbv = $row['Nama'];}else{$reag_eia_hbv = $reag_eia_hbv.'; '.$row['Nama'];}break;
                    case '1': if (strlen($reag_eia_hcv)==0){$reag_eia_hcv = $row['Nama'];}else{$reag_eia_hcv = $reag_eia_hcv.'; '.$row['Nama'];}break;
                    case '2': if (strlen($reag_eia_hiv)==0){$reag_eia_hiv = $row['Nama'];}else{$reag_eia_hiv = $reag_eia_hiv.'; '.$row['Nama'];}break;
                    case '3': if (strlen($reag_eia_syp)==0){$reag_eia_syp = $row['Nama'];}else{$reag_eia_syp = $reag_eia_syp.'; '.$row['Nama'];}break;
                }
                break;
        }

    }
    $nm_nat="SELECT  h.`protocol`
                                 FROM `imltd_procleix_raw` h INNER JOIN `stokkantong` s on s.`noKantong`=h.`sample_id`
                                 WHERE year(h.`date`)='$v_tahun' and month(h.`date`)='$v_bulan'
                                 group by `protocol`";
    $nm_nat=mysqli_query($dbi, $nm_nat);
    $reagean_nat='';
    while ($row=mysqli_fetch_assoc($nm_nat)){
        if (strlen($reagean_nat)==0){$reagean_nat=$row['protocol'];}else{$reagean_nat=$reagean_nat.'; '.$row['protocol'];}
    }
    $nm_rapid="select e.`jenisperiksa`, r.`Nama`,
                                   count(e.`noKantong`) as jml
                                   from `drapidtest` e INNER JOIN `reagen` r on r.`kode`=e.`nolot`
                                        INNER JOIN `stokkantong` s on s.`noKantong`=e.`noKantong`
                                   where
                                   year(e.`tgl_tes`)='$v_tahun' AND MONTH(e.`tgl_tes`)='$v_bulan'
                                   group by e.`jenisperiksa`,r.`Nama`";
    $nm_rpd_hbv='';$nm_rpd_hcv='';$nm_rpd_hiv='';$nm_rpd_syp='';
    $nm_rapid=mysqli_query($dbi, $nm_rapid);
    while ($row=mysqli_fetch_assoc($nm_rapid)){
        switch ($row['jenisperiksa']){
            case '0'; if (strlen($nm_rpd_hbv)==0){$nm_rpd_hbv = $row['Nama'];}else{$nm_rpd_hbv = $nm_rpd_hbv.'; '.$row['Nama'];}break;
            case '1'; if (strlen($nm_rpd_hcv)==0){$nm_rpd_hcv = $row['Nama'];}else{$nm_rpd_hcv = $nm_rpd_hcv.'; '.$row['Nama'];}break;
            case '2'; if (strlen($nm_rpd_hiv)==0){$nm_rpd_hiv = $row['Nama'];}else{$nm_rpd_hiv = $nm_rpd_hiv.'; '.$row['Nama'];}break;
            case '3'; if (strlen($nm_rpd_syp)==0){$nm_rpd_syp = $row['Nama'];}else{$nm_rpd_syp = $nm_rpd_syp.'; '.$row['Nama'];}break;
        }
    }
    //EOF IMLTD ================================
    //Pemusnahan Darah==========================
    $q_musnah="SELECT
               COUNT( CASE WHEN `alasan_buang`='0' THEN 1 ELSE NULL END) AS  'gagal',
               COUNT( CASE WHEN `alasan_buang` in ('4','6','11') THEN 1 ELSE NULL END) AS  'reaktif',
               COUNT( CASE WHEN `alasan_buang`='2' THEN 1 ELSE NULL END) AS  'ed',
               COUNT( CASE WHEN `alasan_buang`='15' THEN 1 ELSE NULL END) AS  'produksi',
               COUNT( CASE WHEN `alasan_buang`='17' THEN 1 ELSE NULL END) AS  'penyimpanan',
               COUNT( CASE WHEN `alasan_buang` in ('1','3','5','7','8','9','10','12','13','14','16') THEN 1 ELSE NULL END) AS  'lainnya'
               FROM `ar_stokkantong`
               WHERE month(`tgl_buang`)='$v_bulan' AND year(`tgl_buang`)='$v_tahun'";
    $q_musnah=mysqli_fetch_assoc(mysqli_query($dbi, $q_musnah));
    //eof Pemusnahan Darah======================

    //Permintaan darah==========================
    //1. Permintaan
    $q_request="SELECT
          h.`rs` as rskode,
          SUM(CASE WHEN h.`bagian`='ANAK' THEN t.`Jumlah` ELSE  0 END ) as anak,
          SUM(CASE WHEN h.`bagian`='BEDAH' THEN t.`Jumlah` ELSE  0 END ) as bedah,
          SUM(CASE WHEN h.`bagian`='INTERNA' THEN t.`Jumlah` ELSE  0 END ) as interna,
          SUM(CASE WHEN h.`bagian`='KEBIDANAN' THEN t.`Jumlah` ELSE  0 END ) as keb,
          SUM(CASE WHEN h.`bagian`='THT' THEN t.`Jumlah` ELSE  0 END ) as tht,
          SUM(CASE WHEN h.`bagian`='LAIN-LAIN' THEN t.`Jumlah` ELSE  0 END ) as ll
          FROM `htranspermintaan` h
          left join `pasien` p on p.`no_rm`=h.`no_rm`
          left join `dtranspermintaan` t on t.`NoForm`=h.`noform` WHERE
          month(h.`tgl_register`)='$v_bulan' and year(h.`tgl_register`)='$v_tahun'";
    $req_anak=0;    $req_bedah=0;   $req_interna=0;
    $req_keb=0;     $req_tht=0;     $req_ll=0;      $req_row=0;
    $q_request  = mysqli_fetch_assoc(mysqli_query($dbi, $q_request));
    $req_anak   = $req_anak + $q_request['anak'];
    $req_bedah  = $req_bedah + $q_request['bedah'];
    $req_interna= $req_interna + $q_request['interna'];
    $req_keb    = $req_keb + $q_request['keb'];
    $req_tht    = $req_tht + $q_request['tht'];
    $req_ll     = $req_ll + $q_request['ll'] + $qraw1['tht'];
    //pemenuhan --dari data yang di crossmatch
    $q_crs="SELECT
            h.`rs` as rskode,
            SUM(CASE WHEN h.`bagian`='ANAK' THEN 1 ELSE  0 END ) as anak,
            SUM(CASE WHEN h.`bagian`='BEDAH' THEN 1 ELSE  0 END ) as bedah,
            SUM(CASE WHEN h.`bagian`='INTERNA' THEN 1 ELSE  0 END ) as interna,
            SUM(CASE WHEN h.`bagian`='KEBIDANAN' THEN 1 ELSE  0 END ) as keb,
            SUM(CASE WHEN h.`bagian`='THT' THEN 1 ELSE  0 END ) as tht,
            SUM(CASE WHEN h.`bagian`='LAIN-LAIN' THEN 1 ELSE  0 END ) as ll
            FROM `htranspermintaan` h
            inner join `pasien` p on p.`no_rm`=h.`no_rm`
            inner join `dtransaksipermintaan` d on d.`NoForm`=h.`noform`
            WHERE month(d.`tgl`)='$v_bulan' and year(d.`tgl`)='$v_tahun'";
    $q_crs=mysqli_fetch_assoc(mysqli_query($dbi, $q_crs));
    $crs_anak=0;
    $crs_bedah=0;
    $crs_interna=0;
    $crs_keb=0;
    $crs_tht=0;
    $crs_ll=0;
    $crs_anak   = $crs_anak + $q_crs['anak'];
    $crs_bedah  = $crs_bedah + $q_crs['bedah'];
    $crs_interna= $crs_interna + $q_crs['interna'];
    $crs_keb    = $crs_keb + $q_crs['keb'];
    $crs_tht    = $crs_tht + $q_crs['tht'];
    $crs_ll     = $crs_ll + $q_crs['ll'] + $q_crs['tht'];
    //Terpakai --> darah keluar
    $q_out="SELECT
            h.`rs` as rskode,
            SUM(CASE WHEN h.`bagian`='ANAK' THEN 1 ELSE  0 END ) as anak,
            SUM(CASE WHEN h.`bagian`='BEDAH' THEN 1 ELSE  0 END ) as bedah,
            SUM(CASE WHEN h.`bagian`='INTERNA' THEN 1 ELSE  0 END ) as interna,
            SUM(CASE WHEN h.`bagian`='KEBIDANAN' THEN 1 ELSE  0 END ) as keb,
            SUM(CASE WHEN h.`bagian`='THT' THEN 1 ELSE  0 END ) as tht,
            SUM(CASE WHEN h.`bagian`='LAIN-LAIN' THEN 1 ELSE  0 END ) as ll
            FROM `htranspermintaan` h
                inner join `pasien` p on p.`no_rm`=h.`no_rm`
                inner join `dtransaksipermintaan` d on d.`NoForm`=h.`noform`
            WHERE
            month(d.`tgl_keluar`)='$v_bulan' and year(d.`tgl_keluar`)='$v_tahun' AND d.`Status`='0'";

    $q_out=mysqli_fetch_assoc(mysqli_query($dbi, $q_out));
    $out_anak=0;
    $out_bedah=0;
    $out_interna=0;
    $out_keb=0;
    $out_tht=0;
    $out_ll=0;
    $out_anak   = $out_anak + $q_out['anak'];
    $out_bedah  = $out_bedah + $q_out['bedah'];
    $out_interna= $out_interna + $q_out['interna'];
    $out_keb    = $out_keb + $q_out['keb'];
    $out_tht    = $out_tht + $q_out['tht'];
    $out_ll     = $out_ll + $q_out['ll'] + $q_out['tht'];

    //rumah sakit yang dilayani
    $rs_dlm=mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(DISTINCT `rs`) AS rsd FROM `htranspermintaan` WHERE `wilayah`='0' AND
                        month(`tgl_register`)='$v_bulan' and year(`tgl_register`)='$v_tahun'"));
    $rs_dlm_kota=0;
    $rs_dlm_kota= $rs_dlm_kota + $rs_dlm['rsd'];

    $rs_luar=mysqli_fetch_assoc(mysqli_query($dbi, "SELECT COUNT(DISTINCT `rs`) AS rsl FROM `htranspermintaan` WHERE `wilayah`='1' AND
                        month(`tgl_register`)='$v_bulan' and year(`tgl_register`)='$v_tahun'"));
    $rs_luar_kota=0;
    $rs_luar_kota= $rs_luar_kota + $rs_luar['rsl'];

    //Droping
    $cari=mysqli_query("SELECT
                       SUM(CASE WHEN k.`status`='0' THEN 1 ELSE 0 END) as bdrs
                       FROM `kirimbdrs` k
                       inner join `bdrs` b on b.`kode`=k.`bdrs`
                       inner join `stokkantong` s on s.`noKantong`=k.`nokantong`
                       inner join `user` u on u.`id_user`= k.`petugas`
                       WHERE
                       k.`status`='0' and `tglkembali` is null and `tglbatal` is null and
                       month(k.`tgl`)='$v_bulan' AND year(k.`tgl`)='$v_tahun'");
    $hasil_cari=mysqli_fetch_assoc($dbi, $cari);
    $bdrs=0;
    $drop_bdrs=$bdrs + $hasil_cari['bdrs'];

    $cari1=mysqli_query($dbi, "SELECT COUNT(DISTINCT `nokantong`) AS udd FROM `kirimudd` WHERE `status`='0' AND month(`tgl`)='$v_bulan' and year (`tgl`)='$v_tahun'");
    $hasil_cari1=mysqli_fetch_assoc($cari1);
    $udd=0;
    $drop_udd=$udd + $hasil_cari1['udd'];

    //eof Permintaan darah======================

    //Komponen Darah============================
    $prod_biasa = "SELECT
                  COUNT(DISTINCT(CASE WHEN  `Produk`='WB' THEN `noKantong` END )) AS WB,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='PRC' THEN `noKantong` END )) AS PRC,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='LP' THEN `noKantong` END )) AS LP,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='FFP' THEN `noKantong` END )) AS FFP,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='TC' THEN `noKantong` END )) AS TC,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='AHF' THEN `noKantong` END )) AS AHF,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='WE' THEN `noKantong` END )) AS WE,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='Leucodepleted' THEN `noKantong` END )) AS LEUCO,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='TC Aferesis' THEN `noKantong` END )) AS TC_APH,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='Buffycoat Removal' THEN `noKantong` END )) AS BUF_R,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='Bedside Filter Leukosit' THEN `noKantong` END )) AS BF_LEUCO,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='Lab Type Filter Leukosit' THEN `noKantong` END )) AS LTF_LEUCO,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='PRC Aferesis' THEN `noKantong` END )) AS PRC_APH,
                  COUNT(DISTINCT(CASE WHEN  `Produk`='Plasma Aferesis' THEN `noKantong` END )) AS LP_APH
                  FROM `dpengolahan`
                  WHERE
                  month(`tgl`)='$v_bulan' and year(`tgl`)='$v_tahun'";
    $prod_biasa=mysqli_fetch_assoc(mysqli_query($dbi, $prod_biasa));
    $prod_aph = "SELECT
                 count(case when `caraAmbil`='1' then `NoKantong` END) as TC_Aph,
                 count(case when `caraAmbil`='3' then `NoKantong` END) as LP_Aph,
                 count(case when `caraAmbil`='4' then `NoKantong` END) as PRC_Aph
                 FROM `htransaksi`
                 WHERE year(`Tgl`)='$v_tahun' and month(`Tgl`)='$v_bulan' and  `Pengambilan`='0' and `caraAmbil` in ('1','2','3','4')";
    $prod_aph=mysqli_fetch_assoc(mysqli_query($dbi, $prod_aph));
    $prod_wb      = $prod_biasa['WB'];
    $prod_prc     = $prod_biasa['PRC'];
    $prod_lp      = $prod_biasa['LP'];
    $prod_ffp     = $prod_biasa['FFP'];
    $prod_tc      = $prod_biasa['TC'];
    $prod_ahf     = $prod_biasa['AHF'];
    $prod_we      = $prod_biasa['WE'];
    $prod_bufr    = $prod_biasa['BUF_R'];
    $prod_in_flt  = $prod_biasa['LEUCO'];
    $prod_bed_flt = $prod_biasa['BF_LEUCO'];
    $prod_lab_flt = $prod_biasa['LTF_LEUCO'];
    $prod_aph_prc = $prod_aph['PRC_Aph'];
    $prod_aph_tc  = $prod_biasa['TC_APH']+$prod_aph['TC_Aph'];;
    $prod_aph_lp  = $prod_aph['LP_Aph'];

    $kdrop_bdrs="SELECT
                SUM(CASE WHEN s.`produk`='PRC' THEN 1 ELSE 0 END) as prc,
                SUM(CASE WHEN s.`produk`='TC' THEN 1 ELSE 0 END) as tc,
                SUM(CASE WHEN s.`produk`='TC Aferesis' THEN 1 ELSE 0 END) as aph,
                SUM(CASE WHEN s.`produk`='AHF' THEN 1 ELSE 0 END) as ahf,
                SUM(CASE WHEN s.`produk`='FFP' THEN 1 ELSE 0 END) as ffp,
                SUM(CASE WHEN s.`produk`='WB' THEN 1 ELSE 0 END) as wb,
                SUM(CASE WHEN s.`produk`='WE' THEN 1 ELSE 0 END) as we,
                SUM(CASE WHEN s.`produk`='LP' THEN 1 ELSE 0 END) as lp,
                SUM(CASE WHEN s.`produk`='FP' THEN 1 ELSE 0 END) as fp,
                SUM(CASE WHEN s.`produk`='Leucodepleted' THEN 1 ELSE 0 END) as ld,
                SUM(CASE WHEN s.`produk`='Buffycoat Removal' THEN 1 ELSE 0 END) as br,
                SUM(CASE WHEN s.`produk`='Bedside Filter Leukosit' THEN 1 ELSE 0 END) as bfl,
                SUM(CASE WHEN s.`produk`='Lab Type Filter Leukosit' THEN 1 ELSE 0 END) as ltfl,
                SUM(CASE WHEN s.`produk`='PRC Aferesis' THEN 1 ELSE 0 END) as prcaph,
                SUM(CASE WHEN s.`produk`='Plasma Aferesis' THEN 1 ELSE 0 END) as lpaph
                FROM `kirimbdrs` k
                  inner join `bdrs` b on b.`kode`=k.`bdrs`
                  inner join `stokkantong` s on s.`noKantong`=k.`nokantong`
                WHERE month(k.`tgl`)='$v_bulan' AND year(k.`tgl`)='$v_tahun' AND k.`status`='0'";
    $kdrop_bdrs = mysqli_fetch_assoc(mysqli_query($dbi, $kdrop_bdrs));
    $req_wb     = $kdrop_bdrs['wb'];
    $req_prc    = $kdrop_bdrs['prc'];
    $req_lp     = $kdrop_bdrs['lp']+$drop_bdrs['fp'];
    $req_ffp    = $kdrop_bdrs['ffp'];
    $req_tc     = $kdrop_bdrs['tc'];
    $req_ahf    = $kdrop_bdrs['ahf'];
    $req_we     = $kdrop_bdrs['we'];
    $req_bufr   = $kdrop_bdrs['br'];
    $req_in_flt = $kdrop_bdrs['ld'];
    $req_bed_flt= $kdrop_bdrs['bfl'];
    $req_lab_flt= $kdrop_bdrs['ltfl'];
    $req_aph_prc= $kdrop_bdrs['prcaph'];
    $req_aph_tc = $kdrop_bdrs['aph'];
    $req_aph_lp = $kdrop_bdrs['lpaph'];

    $kdrop_udd="SELECT
                SUM(CASE WHEN s.`produk`='PRC' THEN 1 ELSE 0 END) as prc,
                SUM(CASE WHEN s.`produk`='TC' THEN 1 ELSE 0 END) as tc,
                SUM(CASE WHEN s.`produk`='TC Aferesis' THEN 1 ELSE 0 END) as aph,
                SUM(CASE WHEN s.`produk`='AHF' THEN 1 ELSE 0 END) as ahf,
                SUM(CASE WHEN s.`produk`='FFP' THEN 1 ELSE 0 END) as ffp,
                SUM(CASE WHEN s.`produk`='WB' THEN 1 ELSE 0 END) as wb,
                SUM(CASE WHEN s.`produk`='WE' THEN 1 ELSE 0 END) as we,
                SUM(CASE WHEN s.`produk`='LP' THEN 1 ELSE 0 END) as lp,
                SUM(CASE WHEN s.`produk`='FP' THEN 1 ELSE 0 END) as fp,
                SUM(CASE WHEN s.`produk`='Leucodepleted' THEN 1 ELSE 0 END) as ld,
                SUM(CASE WHEN s.`produk`='Buffycoat Removal' THEN 1 ELSE 0 END) as br,
                SUM(CASE WHEN s.`produk`='Bedside Filter Leukosit' THEN 1 ELSE 0 END) as bfl,
                SUM(CASE WHEN s.`produk`='Lab Type Filter Leukosit' THEN 1 ELSE 0 END) as ltfl,
                SUM(CASE WHEN s.`produk`='PRC Aferesis' THEN 1 ELSE 0 END) as prcaph,
                SUM(CASE WHEN s.`produk`='Plasma Aferesis' THEN 1 ELSE 0 END) as lpaph
                FROM `kirimudd` k
                  inner join `utd` b on b.`id`=k.`udd`
                  inner join `stokkantong` s on s.`noKantong`=k.`nokantong`
                WHERE month(k.`tgl`)='$v_bulan' AND year(k.`tgl`)='$v_tahun' AND k.`status`='0'";
    $kdrop_udd=mysqli_fetch_assoc(mysqli_query($dbi, $drop_udd));
    $req_wb     = $req_wb + $kdrop_udd['wb'];
    $req_prc    = $req_prc + $kdrop_udd['prc'];
    $req_lp     = $req_lp + $kdrop_udd['lp']+$drop_bdrs['fp'];
    $req_ffp    = $req_ffp + $kdrop_udd['ffp'];
    $req_tc     = $req_tc + $kdrop_udd['tc'];
    $req_ahf    = $req_ahf + $kdrop_udd['ahf'];
    $req_we     = $req_we + $kdrop_udd['we'];
    $req_bufr   = $req_bufr + $kdrop_udd['br'];
    $req_in_flt = $req_in_flt + $kdrop_udd['ld'];
    $req_bed_flt= $req_bed_flt + $kdrop_udd['bfl'];
    $req_lab_flt= $req_lab_flt + $kdrop_udd['ltfl'];
    $req_aph_prc= $req_aph_prc + $kdrop_udd['prcaph'];
    $req_aph_tc = $req_aph_tc + $kdrop_udd['aph'];
    $req_aph_lp = $req_aph_lp + $kdrop_udd['lpaph'];

    $kpermint_rs ="SELECT
                SUM(CASE WHEN d.`JenisDarah`='PRC' THEN d.`Jumlah` ELSE  0 END ) as prc,
                SUM(CASE WHEN d.`JenisDarah`='AHF' THEN d.`Jumlah` ELSE  0 END ) as ahf,
                SUM(CASE WHEN d.`JenisDarah`='FFP' THEN d.`Jumlah` ELSE  0 END ) as ffp,
                SUM(CASE WHEN d.`JenisDarah`='FP' THEN d.`Jumlah` ELSE  0 END ) as fp,
                SUM(CASE WHEN d.`JenisDarah`='Leucodepleted' THEN d.`Jumlah` ELSE  0 END )as ld,
                SUM(CASE WHEN d.`JenisDarah`='LP' THEN d.`Jumlah` ELSE  0 END ) as lp,
                SUM(CASE WHEN d.`JenisDarah`='TC' THEN d.`Jumlah` ELSE  0 END ) as tc,
                SUM(CASE WHEN (d.`JenisDarah`='TC Aferesis' or d.`JenisDarah`='TC Apheresis' or d.`JenisDarah`='TC-APH' ) THEN d.`Jumlah` ELSE  0 END ) as aph,
                SUM(CASE WHEN d.`JenisDarah`='WB' THEN d.`Jumlah` ELSE  0 END ) as wb,
                SUM(CASE WHEN (d.`JenisDarah`='WE' or d.`JenisDarah`='WRC') THEN d.`Jumlah` ELSE  0 END ) as we,
                SUM(CASE WHEN (d.`JenisDarah`='--Pilih-' or d.`JenisDarah`='' or d.`JenisDarah`='PRP') THEN d.`Jumlah` ELSE  0 END ) as ll,
                SUM(CASE WHEN d.`JenisDarah`='Buffycoat Removal' THEN d.`Jumlah` ELSE  0 END ) as br,
                SUM(CASE WHEN d.`JenisDarah`='Bedside Filter Leukosit' THEN d.`Jumlah` ELSE  0 END ) as bfl,
                SUM(CASE WHEN d.`JenisDarah`='Lab Type Filter Leukosit' THEN d.`Jumlah` ELSE  0 END ) as ltfl,
                SUM(CASE WHEN d.`JenisDarah`='PRC Aferesis' THEN d.`Jumlah` ELSE  0 END ) as prcaph,
                SUM(CASE WHEN d.`JenisDarah`='Plasma Aferesis' THEN d.`Jumlah` ELSE  0 END )as lpaph
                FROM `htranspermintaan` h
                  left join `pasien` p on p.`no_rm`=h.`no_rm`
                  left join `dtranspermintaan` d on d.`NoForm`=h.`noform`
                  left join `rmhsakit` r on r.`Kode`=h.`rs
                `WHERE month(h.`tgl_register`)='$v_bulan' and year(h.`tgl_register`)='$v_tahun'";
    $kpermint_rs=mysqli_fetch_assoc(mysqli_query($dbi, $kpermint_rs));
    $req_wb     = $req_wb + $kpermint_rs['wb'];
    $req_prc    = $req_prc + $kpermint_rs['prc'];
    $req_lp     = $req_lp + $kpermint_rs['lp']+$kpermint_rs['fp'];
    $req_ffp    = $req_ffp + $kpermint_rs['ffp'];
    $req_tc     = $req_tc + $kpermint_rs['tc'] +$kpermint_rs['ll'];
    $req_ahf    = $req_ahf + $kpermint_rs['ahf'];
    $req_we     = $req_we + $kpermint_rs['we'];
    $req_bufr   = $req_bufr + $kpermint_rs['br'];
    $req_in_flt = $req_in_flt + $kpermint_rs['ld'];
    $req_bed_flt= $req_bed_flt + $kpermint_rs['bfl'];
    $req_lab_flt= $req_lab_flt + $kpermint_rs['ltfl'];
    $req_aph_prc= $req_aph_prc + $kpermint_rs['prcaph'];
    $req_aph_tc = $req_aph_tc + $kpermint_rs['aph'];
    $req_aph_lp = $req_aph_lp + $kpermint_rs['lpaph'];

    $kout_rs="SELECT
              SUM(CASE WHEN d.`produk_darah`='PRC' THEN 1 ELSE  0 END ) as prc,
              SUM(CASE WHEN d.`produk_darah`='AHF' THEN 1 ELSE  0 END ) as ahf,
              SUM(CASE WHEN d.`produk_darah`='FFP' THEN 1 ELSE  0 END ) as ffp,
              SUM(CASE WHEN d.`produk_darah`='FP' THEN 1 ELSE  0 END ) as fp,
              SUM(CASE WHEN d.`produk_darah`='Leucodepleted' THEN 1 ELSE  0 END )as ld,
              SUM(CASE WHEN d.`produk_darah`='LP' THEN 1 ELSE  0 END ) as lp,
              SUM(CASE WHEN d.`produk_darah`='TC' THEN 1 ELSE  0 END ) as tc,
              SUM(CASE WHEN (d.`produk_darah`='TC Aferesis' or d.`produk_darah`='TC Apheresis' or d.`produk_darah`='TC-APH' ) THEN 1 ELSE  0 END ) as aph,
              SUM(CASE WHEN d.`produk_darah`='WB' THEN 1 ELSE  0 END ) as wb,
              SUM(CASE WHEN (d.`produk_darah`='WE' or d.`produk_darah`='WRC') THEN 1 ELSE  0 END ) as we,
              SUM(CASE WHEN (d.`produk_darah`='--Pilih-' or d.`produk_darah`='' or d.`produk_darah`='PRP') THEN 1 ELSE  0 END ) as ll,
              SUM(CASE WHEN d.`produk_darah`='Buffycoat Removal' THEN 1 ELSE  0 END ) as br,
              SUM(CASE WHEN d.`produk_darah`='Bedside Filter Leukosit' THEN 1 ELSE  0 END ) as bfl,
              SUM(CASE WHEN d.`produk_darah`='Lab Type Filter Leukosit' THEN 1 ELSE  0 END )as ltfl,
              SUM(CASE WHEN d.`produk_darah`='PRC Aferesis' THEN 1 ELSE  0 END ) as prcaph,
              SUM(CASE WHEN d.`produk_darah`='Plasma Aferesis' THEN 1 ELSE  0 END ) as lpaph
              FROM `htranspermintaan` h
                inner join `pasien` p on p.`no_rm`=h.`no_rm`
                inner join `dtransaksipermintaan` d on d.`NoForm`=h.`noform`
                inner join `rmhsakit` r on r.`Kode`=h.`rs`
              WHERE
              month(d.`tgl_keluar`)='$v_bulan' and year(d.`tgl_keluar`)='$v_tahun' and d.`Status`='0'";
    $out_kout_rs=mysqli_fetch_assoc(mysqli_query($dbi, $kout_rs));
    $out_wb     = $out_kout_rs['wb'] + $kdrop_bdrs['wb'] + $kdrop_udd['wb'];
    $out_prc    = $out_kout_rs['prc'] + $kdrop_bdrs['prc'] + $kdrop_udd['prc'] ;
    $out_lp     = $out_kout_rs['lp'] + $drop_bdrs['fp'] + $kdrop_bdrs['lp'] + $kdrop_bdrs['fp'] + $kdrop_udd['lp'] + $kdrop_udd['fp'];
    $out_ffp    = $out_kout_rs['ffp'] + $kdrop_bdrs['prc'] + $kdrop_udd['prc'] ;
    $out_tc     = $out_kout_rs['tc'] + $out_kout_rs['ll'] + $kdrop_bdrs['tc'] + $kdrop_bdrs['ll'] + $kdrop_udd['tc'] + $kdrop_udd['ll'];
    $out_ahf    = $out_kout_rs['ahf'] + $kdrop_bdrs['ahd'] + $kdrop_udd['ahf'];
    $out_we     = $out_kout_rs['we'] + $kdrop_bdrs['we'] + $kdrop_udd['we'];
    $out_bufr   = $out_kout_rs['br'] + $kdrop_bdrs['br'] + $kdrop_udd['br'];
    $out_in_flt = $out_kout_rs['ld'] + $kdrop_bdrs['ld'] + $kdrop_udd['ld'];
    $out_bed_flt= $out_kout_rs['bfl'] + $kdrop_bdrs['bfl'] + $kdrop_udd['bfl'];
    $out_lab_flt= $out_kout_rs['ltfl'] + $kdrop_bdrs['ltfl'] + $kdrop_udd['ltfl'];
    $out_aph_prc= $out_kout_rs['prcaph'] + $kdrop_bdrs['prcaph'] + $kdrop_udd['prcaph'];
    $out_aph_tc = $out_kout_rs['aph'] + $kdrop_bdrs['aph'] + $kdrop_udd['aph'];
    $out_aph_lp = $out_kout_rs['lpaph'] + $kdrop_bdrs['lpaph'] + $kdrop_udd['lpaph'];;
    //eof Komponen Darah========================
}

$id_udd     = $sqludd['id'];
$output     = 'None';

//PREPARE Server database==================================================================================
// Connection to server
$con_lap = mysqli_connect($svr_lap_ip, $svr_lap_usr, $svr_lap_pwd, $svr_lap_db, $svr_lap_port);

if (!$con_lap){
    echo "Koneksi gagal";
    exit;
} else {$output=  "Koneksi sukses";}

if ($v_jenis=='T'){
     //proses laporan tahunan
    //Data UMUM===================================
    $v_chk  = "SELECT `u_tahun`, `u_id_udd` FROM `data_umum` WHERE `u_id_udd`='$id_udd' AND `u_tahun`='$v_tahun'";
    $v_chk  = mysqli_query($con_lap, $v_chk);
    $v_chk  = mysqli_fetch_assoc($v_chk);
    if ($v_chk['u_id_udd']==$id_udd){
        $output=  'Upd proses';
        $v_upd0 = "UPDATE `data_umum` SET
                `u_nama`  = '$dt_lap[u_nama]',
                `u_alamat` = '$dt_lap[u_alamat]',
                `u_kab`   = '$dt_lap[u_kab]',
                `u_prov`  = '$dt_lap[u_prov]',
                `u_kpos`  = '$dt_lap[u_kpos]',
                `u_telp`  = '$dt_lap[u_telp]',
                `u_email` = '$dt_lap[u_email]',
                `u_ka_nama`= '$dt_lap[u_ka_nama]',
                `u_ka_hp`= '$dt_lap[u_ka_hp]',
                `u_ka_email`= '$dt_lap[u_ka_email]',
                `u_komite_mdk`= '$dt_lap[u_komite_mdk]',
                `u_distr_terbuka`= '$dt_lap[u_distr_terbuka]',
                `u_distr_cold_chain`= '$dt_lap[u_distr_cold_chain]',
                `u_jml_dokter_kompeten`= '$dt_lap[u_jml_dokter_kompeten]',
                `u_ptgs_komptn`= '$dt_lap[u_ptgs_komptn]',
                `u_inform_c`= '$dt_lap[u_inform_c]',
                `u_lbr_mon_td`= '$dt_lap[u_lbr_mon_td]',
                `u_jml_pasien_td`= '$dt_lap[u_jml_pasien_td]',
                `u_jml_pasien_rtd`= '$dt_lap[u_jml_pasien_rtd]',
                `u_periksa_kgd`= '$dt_lap[u_periksa_kgd]',
                `u_kgd_auto`= '$dt_lap[u_kgd_auto]',
                `u_kgd_semi`= '$dt_lap[u_kgd_semi]',
                `u_kgd_manual`= '$dt_lap[u_kgd_manual]',
                `u_periksa_abs`= '$dt_lap[u_periksa_abs]',
                `u_abs_auto`= '$dt_lap[u_abs_auto]',
                `u_abs_semi`= '$dt_lap[u_abs_semi]',
                `u_abs_manual`= '$dt_lap[u_abs_manual]',
                `u_periksa_iab`= '$dt_lap[u_periksa_iab]',
                `u_iab_auto`= '$dt_lap[u_iab_auto]',
                `u_iab_semi`= '$dt_lap[u_iab_semi]',
                `u_iab_manual`= '$dt_lap[u_iab_manual]',
                `u_periksa_cross`= '$dt_lap[u_periksa_cross]',
                `u_cross_auto`= '$dt_lap[u_cross_auto]',
                `u_cross_semi`= '$dt_lap[u_cross_semi]',
                `u_cross_manual`= '$dt_lap[u_cross_manual]',
                `on_update` =now()
               WHERE
                `u_tahun`='$v_tahun' AND `u_id_udd`='$id_udd'";
        $v_upd1 = mysqli_query($con_lap, $v_upd0);
        if ($v_upd1){
            $output=  'Sukses';
        }else{
            $output=  'Update Data Umum : Error';
        }
    } else {
        $output=  'Insert Proses';
        $v_inst0 = "INSERT INTO `data_umum`(
                `u_tahun`, `u_id_udd`, `u_nama`, `u_alamat`, `u_kab`, `u_prov`, `u_kpos`,
                `u_telp`, `u_email`, `u_ka_nama`, `u_ka_hp`, `u_ka_email`,
                `u_komite_mdk`, `u_distr_terbuka`, `u_distr_cold_chain`, `u_jml_dokter_kompeten`, `u_ptgs_komptn`,
                `u_inform_c`, `u_lbr_mon_td`, `u_jml_pasien_td`, `u_jml_pasien_rtd`,
                `u_periksa_kgd`, `u_kgd_auto`,`u_kgd_semi`, `u_kgd_manual`,
                `u_periksa_abs`, `u_abs_auto`, `u_abs_semi`, `u_abs_manual`,
                `u_periksa_iab`, `u_iab_auto`, `u_iab_semi`, `u_iab_manual`,
                `u_periksa_cross`, `u_cross_auto`, `u_cross_semi`, `u_cross_manual`)
               VALUES (
               '$v_tahun','$id_udd','$dt_lap[u_nama]','$dt_lap[u_alamat]','$dt_lap[u_kab]','$dt_lap[u_prov]','$dt_lap[u_kpos]',
               '$dt_lap[u_telp]','$dt_lap[u_email]','$dt_lap[u_ka_nama]','$dt_lap[u_ka_hp]','$dt_lap[u_ka_email]',
               '$dt_lap[u_komite_mdk]','$dt_lap[u_distr_terbuka]','$dt_lap[u_distr_cold_chain]','$dt_lap[u_jml_dokter_kompeten]','$dt_lap[u_ptgs_komptn]',
               '$dt_lap[u_inform_c]','$dt_lap[u_lbr_mon_td]','$dt_lap[u_jml_pasien_td]','$dt_lap[u_jml_pasien_rtd]',
               '$dt_lap[u_periksa_kgd]','$dt_lap[u_kgd_auto]','$dt_lap[u_kgd_semi]','$dt_lap[u_kgd_manual]',
               '$dt_lap[u_periksa_abs]','$dt_lap[u_abs_auto]','$dt_lap[u_abs_semi]','$dt_lap[u_abs_manual]',
               '$dt_lap[u_periksa_iab]','$dt_lap[u_iab_auto]','$dt_lap[u_iab_semi]','$dt_lap[u_iab_manual]',
               '$dt_lap[u_periksa_cross]','$dt_lap[u_cross_auto]','$dt_lap[u_cross_semi]','$dt_lap[u_cross_manual]')";
        $v_inst1 = mysqli_query($con_lap, $v_inst0);
        if ($v_inst1){
            $output= 'Sukses';
        }else{
            $output=  'Tambah Data Umum : Error'.$v_inst0;
        }
    }
    if ($output=='Sukses'){
        //Data Bangunan================================================
        while($dt=mysqli_fetch_assoc($q_bgn)){
            $i_bgn="INSERT INTO `data_bangunan`(`b_tahun`, `b_id_udd`, `b_kpemilikan`, `b_klasrs`, `b_klas_udd`,
                   `b_tingkat_udd`, `b_dana_bngunan`, `b_dana_alat`, `b_th_operasional`, `b_dana_apbd`, `b_jml_dana_apbd`,
                   `b_bppd`, `b_sk_bppd`,`b_no_bgn`)
                   VALUES (
                   '$v_tahun','$id_udd','$dt[b_kpemilikan]','$dt[b_klasrs]','$dt[b_klas_udd]',
                   '$dt[b_tingkat_udd]','$dt[b_dana_bngunan]','$dt[b_dana_alat]','$dt[b_th_operasional]','$dt[b_dana_apbd]','$dt[b_jml_dana_apbd]',
                   '$dt[b_bppd]','$dt[b_sk_bppd]','$dt[b_no_bgn]')";
            $u_bgn="UPDATE `data_bangunan` SET
                   `b_kpemilikan`='$dt[b_kpemilikan]', `b_klasrs`='$dt[b_klasrs]',
                   `b_klas_udd`='$dt[b_klas_udd]',
                   `b_tingkat_udd`='$dt[b_tingkat_udd]', `b_dana_bngunan`='$dt[b_dana_bngunan]', `b_dana_alat`='$dt[b_dana_alat]',
                   `b_th_operasional`='$dt[b_th_operasional]', `b_dana_apbd`='$dt[b_dana_apbd]', `b_jml_dana_apbd`='$dt[b_jml_dana_apbd]',
                   `b_bppd`='$dt[b_bppd]', `b_sk_bppd`='$dt[b_sk_bppd]', `on_update` =now()
                   WHERE `b_no_bgn`='$dt[b_no_bgn]' AND `b_id_udd`='$id_udd' AND `b_tahun`='$v_tahun'";
            $cek_bgn="SELECT `b_no_bgn`, `b_id_udd` FROM `data_bangunan` WHERE `b_no_bgn`='$dt[b_no_bgn]' AND `b_id_udd`='$id_udd' AND `b_tahun`='$v_tahun'";
            $chk_bgn=mysqli_query($con_lap, $cek_bgn);
            $num_rows = mysqli_num_rows($chk_bgn);
            if ($num_rows>0){

                $upd_bgn=mysqli_query($con_lap, $u_bgn);
                if ($upd_bgn){$output='Sukses';}else{$output='Update Bangunan : Error';}
            } else {
                $ins_bgn=mysqli_query($con_lap, $i_bgn);
                if ($ins_bgn){$output='Sukses';}else{$output='Tambah Bangunan : Error';}
            }
        }
    }

    if ($output=='Sukses'){
        //DATA SDM======================================================
        while($dt_sdm=mysqli_fetch_assoc($q_sdm)){
            $chk_sdm=mysqli_query($con_lap, "SELECT `sdm_id` FROM `data_sdm` WHERE `sdm_id_udd`='$id_udd' and `sdm_urutan`='$dt_sdm[sdm_urutan]'");
            $rsl_sdm=mysqli_num_rows($chk_sdm);
            if ($rsl_sdm>0){
                $upd_sdm="UPDATE `data_sdm` set
                 `sdm_tahun` = '$v_tahun',
                 `sdm_nama`='$dt_sdm[sdm_nama]',
                 `sdm_jbtn`='$dt_sdm[sdm_jbtn]',
                 `sdm_jenis_tng`='$dt_sdm[sdm_jenis_tng]',
                 `sdm_pendidikan`='$dt_sdm[sdm_pendidikan]',
                 `sdm_s2`='$dt_sdm[sdm_s2]',
                 `sdm_s1`='$dt_sdm[sdm_s1]',
                 `sdm_d3`='$dt_sdm[sdm_d3]',
                 `sdm_d1`='$dt_sdm[sdm_d1]',
                 `sdm_sma`='$dt_sdm[sdm_sma]',
                 `sdm_pns`='$dt_sdm[sdm_pns]',
                 `sdm_pmi`='$dt_sdm[sdm_pmi]',
                 `sdm_honor`='$dt_sdm[sdm_honor]',
                 `sdm_dpt_plthn`='$dt_sdm[sdm_dpt_plthn]',
                 `sdm_plthn`='$dt_sdm[sdm_plthn]',
                 `sdm_aktif`='$dt_sdm[sdm_aktif]',
                 `on_update` =now()
                 WHERE
                 `sdm_id_udd`='$id_udd' AND
                 `sdm_urutan`='$dt_sdm[sdm_urutan]'";
                $upd_sdm1=mysqli_query($con_lap, $upd_sdm);
                if ($upd_sdm1){$output='Sukses';}else{$output='Update SDM : Error ';}
            }else{
                $ins_sdm="INSERT INTO `data_sdm`(
                  `sdm_tahun`, `sdm_id_udd`, `sdm_urutan`, `sdm_nama`, `sdm_jbtn`, `sdm_jenis_tng`,
                  `sdm_pendidikan`, `sdm_s2`, `sdm_s1`, `sdm_d3`, `sdm_d1`, `sdm_sma`, `sdm_pns`, `sdm_pmi`, `sdm_honor`,
                  `sdm_dpt_plthn`, `sdm_plthn`,`sdm_aktif`)
                  VALUES (
                  '$v_tahun', '$id_udd', '$dt_sdm[sdm_urutan]', '$dt_sdm[sdm_nama]', '$dt_sdm[sdm_jbtn]', '$dt_sdm[sdm_jenis_tng]',
                  '$dt_sdm[sdm_pendidikan]', '$dt_sdm[sdm_s2]', '$dt_sdm[sdm_s1]', '$dt_sdm[sdm_d3]', '$dt_sdm[sdm_d1]', '$dt_sdm[sdm_sma]', '$dt_sdm[sdm_pns]', '$dt_sdm[sdm_pmi]', '$dt_sdm[sdm_honor]',
                  '$dt_sdm[sdm_dpt_plthn]', '$dt_sdm[sdm_plthn]','$dt_sdm[sdm_aktif]')";
                $ins_sdm1=mysqli_query($con_lap, $ins_sdm);
                if ($ins_sdm1){$output='Sukses';}else{$output='Tambah SDM : Error ';}
            }
        }
    }

    if ($output=='Sukses'){
        //DATA REAKSI TRANSFUSI===================================================
        while($dt_rtd=mysqli_fetch_assoc($q_rtd)){
            $chk_rtd=mysqli_query($con_lap, "SELECT * FROM `data_reaksi_td` WHERE `rtd_id_udd`='$id_udd' AND `rtd_tahun`='$v_tahun' and `rtd_jenis_rtd`='$dt_rtd[rtd_jenis_rtd]'");
            $num_rows=mysqli_num_rows($chk_rtd);
            if ($num_rows>0){
                $up_rtd="UPDATE `data_reaksi_td` SET
                        `rtd_jml`='$dt_rtd[rtd_jml]', `on_update` =now()
                        WHERE
                        `rtd_tahun`='$dt_rtd[rtd_tahun]' AND
                        `rtd_id_udd`='$dt_rtd[rtd_id_udd]' AND
                        `rtd_jenis_rtd`='$dt_rtd[rtd_jenis_rtd]'";
                $up_rtd1=mysqli_query($con_lap, $up_rtd);
                if ($up_rtd1){$output='Sukses';}else{$output='Update Data Reaksi Transfusi : Error ';}
            }else{
                $ins_rtd="INSERT INTO `data_reaksi_td`(`rtd_tahun`, `rtd_id_udd`, `rtd_jenis_rtd`, `rtd_jml`)
                  VALUES
                  ('$v_tahun','$id_udd','$dt_rtd[rtd_jenis_rtd]','$dt_rtd[rtd_jml]')";
                $ins_rtd1=mysqli_query($con_lap, $ins_rtd);
                if ($ins_rtd1){$output='Sukses';}else{$output='Tambah Data Reaksi Transfusi : Error ';}
            }

        }
    }

    If ($output=='Sukses'){
        //PENDONOR
        $chk_dnr="SELECT `p_id`,`p_tahun`,`p_bulan`,`p_id_udd` FROM `data_pendonor` WHERE `p_tahun`='$v_tahun' AND `p_id_udd`='$id_udd'";
        $chk_dnr=mysqli_num_rows(mysqli_query($con_lap, $chk_dnr));
        if ($chk_dnr>0){
            //Update data pendonor
            $upd_dnr="UPDATE `data_pendonor` SET
                 `p_ttl_donor`='$tot_donor', `p_ds`='$tot_ds', `p_dp`='$tot_dp',
                 `p_lk`='$tot_lk' , `p_pr`='$tot_pr' , `p_u17`='$tot_17' , `p_u1824`='$tot_18' , `p_u2544`='$tot_24' , `p_u4564`='$tot_44' , `p_u65`='$tot_64' ,
                 `p_cp_ds`='$cekal_ds' , `p_cp_dp`='$cekal_dp' ,
                 `p_cs_ds`='0' , `p_cs_dp`='0' , `p_cs_byr`='0' ,
                 `p_apos_ul`='$dsbr_ul[ulap]' , `p_bpos_ul`='$dsbr_ul[ulbp]' , `p_opos_ul`= '$dsbr_ul[ulop]', `p_abpos_ul`='$dsbr_ul[ulabp]',
                 `p_amin_ul`='$dsbr_ul[ulan]' , `p_bmin_ul`='$dsbr_ul[ulbn]' , `p_omin_ul`= '$dsbr_ul[ulon]', `p_abmin_ul`='$dsbr_ul[ulabn]',
                 `p_apos_br`='$dsbr_ul[brap]' , `p_bpos_br`='$dsbr_ul[brbp]' , `p_opos_br`= '$dsbr_ul[brop]', `p_abpos_br`='$dsbr_ul[brabp]',
                 `p_amin_br`='$dsbr_ul[bran]' , `p_bmin_br`='$dsbr_ul[brbn]' , `p_omin_br`= '$dsbr_ul[bron]', `p_abmin_br`='$dsbr_ul[brabn]',
                 `on_update` =now()
                 WHERE `p_tahun`='$v_tahun' AND `p_id_udd`='$id_udd'";
            $upd_dnr1=mysqli_query($con_lap, $upd_dnr);
            if ($upd_dnr1){$output='Sukses';}else{$output='Update Data Pendonors : Error '.$upd_dnr;}
        }else{
            //insert data pendonor
            $ins_dnr="INSERT INTO `data_pendonor`(`p_tahun`, `p_id_udd`, `p_ttl_donor`, `p_ds`, `p_dp`, `p_byr`,
                 `p_lk`, `p_pr`, `p_u17`, `p_u1824`, `p_u2544`, `p_u4564`, `p_u65`, `p_cp_ds`, `p_cp_dp`, `p_cp_byr`,
                 `p_cs_ds`, `p_cs_dp`, `p_cs_byr`,
                 `p_apos_ul`, `p_bpos_ul`, `p_opos_ul`, `p_abpos_ul`,
                 `p_amin_ul`, `p_bmin_ul`, `p_omin_ul`, `p_abmin_ul`,
                 `p_apos_br`, `p_bpos_br`, `p_opos_br`, `p_abpos_br`,
                 `p_amin_br`, `p_bmin_br`, `p_omin_br`, `p_abmin_br`)
                 VALUES (
                 '$v_tahun','$id_udd','$tot_donor','$tot_ds','$tot_dp','0',
                 '$tot_lk','$tot_pr','$tot_17','$tot_18','$tot_24','$tot_44','$tot_64','0','0','0',
                 '$cekal_ds','$cekal_dp','0',
                 '$dsbr_ul[ulap]','$dsbr_ul[ulbp]','$dsbr_ul[ulop]','$dsbr_ul[ulabp]',
                 '$dsbr_ul[ulan]','$dsbr_ul[ulbn]','$dsbr_ul[ulon]','$dsbr_ul[ulabn]',
                 '$dsbr_ul[brap]','$dsbr_ul[brbp]','$dsbr_ul[brop]','$dsbr_ul[brabp]',
                 '$dsbr_ul[bran]','$dsbr_ul[brbn]','$dsbr_ul[bron]','$dsbr_ul[brabn]')";
            $ins_dnr1=mysqli_query($con_lap, $ins_dnr);
            if ($ins_dnr1){$output='Sukses';}else{$output='Tambah Data Pendonor : Error '.$ins_dnr;}
        }
    }

}else {
    // mysql_select_db($svr_lap_db);
    //proses laporan bulanan
    //DONASI WB===================================================
    $q_chk="SELECT `d_jenis`,`d_tahun`,`d_bulan`,`d_id_udd` FROM `data_donasi` WHERE
            `d_jenis`='W' AND `d_tahun`='$v_tahun' AND `d_bulan`='$v_bulan' AND `d_id_udd`='$id_udd'";
    $q_chk=mysqli_num_rows(mysqli_query($con_lap, $q_chk));
    if ($q_chk>0){
        $q_upd="UPDATE `data_donasi` SET
                `d_gd_ds_br`='$q_wb[dg_ds_br]',  `d_gd_ds_ul`='$q_wb[dg_ds_ul]',  `d_gd_dp`='$q_wb[dg_dp]',  `d_gd_byr`='0',
                `d_mu_br`='$q_wb[mu_ds_br]',   `d_mu_ul`='$q_wb[mu_ds_ul]',  `d_ttl_donasi`= '$q_wb[total]',
                `d_lk`='$q_wb[lk]',   `d_pr`= '$q_wb[pr]',
                `d_u17`='$q_wb[u17]',   `d_u1824`='$q_wb[u1824]',  `d_u2544`='$q_wb[u2544]',  `d_u4564`='$q_wb[u4564]',  `d_u65`= '$q_wb[u65]',
                `d_apos`='$q_wb[a_pos]',   `d_bpos`='$q_wb[b_pos]',   `d_opos`='$q_wb[o_pos]',  `d_abpos`= '$q_wb[ab_pos]',
                `d_aneg`='$q_wb[a_neg]', `d_bneg`= '$q_wb[b_neg]',  `d_oneg`='$q_wb[o_neg]',  `d_abneg`= '$q_wb[ab_neg]',
                `d_tlk_bb`='$wb_btl_bb',  `d_tlk_umr`='0',  `d_tlk_hb`= '$wb_btl_hb', `d_tlk_med`='$wb_btl_medis',
                `d_tlk_prilaku`= '$wb_btl_prilaku',  `d_tlk_bepergian`='$wb_btl_bepergian',  `d_tlk_lain`='$wb_btl_gagal',
                `on_update` =now()
                WHERE
                `d_jenis`='W' AND `d_tahun`='$v_tahun' AND `d_bulan`='$v_bulan' AND `d_id_udd`='$id_udd'";
        $q_upd1=mysqli_query($con_lap, $q_upd);
        if ($q_upd1){$output='Sukses';}else{$output='Update Donasi WB : Error '.mysqli_error($con_lap);}
    }else{
        $q_inst="INSERT INTO `data_donasi`(
                `d_jenis`, `d_tahun`, `d_bulan`, `d_id_udd`,
                `d_gd_ds_br`, `d_gd_ds_ul`, `d_gd_dp`, `d_gd_byr`,
                `d_mu_br`, `d_mu_ul`, `d_ttl_donasi`,
                `d_lk`, `d_pr`,
                `d_u17`, `d_u1824`, `d_u2544`, `d_u4564`, `d_u65`,
                `d_apos`, `d_bpos`, `d_opos`, `d_abpos`, `d_aneg`,
                `d_bneg`, `d_oneg`, `d_abneg`,
                `d_tlk_bb`, `d_tlk_umr`, `d_tlk_hb`, `d_tlk_med`, `d_tlk_prilaku`, `d_tlk_bepergian`, `d_tlk_lain`
                ) VALUES (
                'W','$v_tahun','$v_bulan','$id_udd',
                '$q_wb[dg_ds_br]', '$q_wb[dg_ds_ul]', '$q_wb[dg_dp]','0',
                '$q_wb[mu_ds_br]', '$q_wb[mu_ds_ul]', '$q_wb[total]',
                '$q_wb[lk]', '$q_wb[pr]',
                '$q_wb[u17]', '$q_wb[u1824]', '$q_wb[u2544]','$q_wb[u4564]','$q_wb[u65]',
                '$q_wb[a_pos]', '$q_wb[b_pos]', '$q_wb[o_pos]','$q_wb[ab_pos]',
                '$q_wb[a_neg]', '$q_wb[b_neg]', '$q_wb[o_neg]','$q_wb[ab_neg]',
                '$wb_btl_bb','0','$wb_btl_hb','$wb_btl_medis', '$wb_btl_prilaku', '$wb_btl_bepergian','$wb_btl_gagal')";
        $q_inst1=mysqli_query($con_lap, $q_inst);
        if ($q_inst1){$output='Sukses';}else{$output='Tambah Donasi WB : Error '.mysqli_error($con_lap);}
    }
    //TERIMA WB dari UDD Lain
    if ($output=='Sukses'){
        while ($dt_wb=mysqli_fetch_assoc($terima_wb)){
            if ($dt_wb['jumlah']>'0'){
                $chk_terima="SELECT `td_id` FROM `data_terima_udd`
                            WHERE `td_jenis`='W' AND `td_tahun`='$v_tahun' AND `td_bulan`='$v_bulan' AND `td_id_udd`='$id_udd' AND `td_id_dariudd`='$dt_wb[udd]'";
                $rsl_terima=mysqli_num_rows(mysqli_query($con_lap, $chk_terima));
                if ($rsl_terima>0){
                    $q_upd="UPDATE `data_terima_udd` SET `td_jml`='$dt_wb[jumlah]',`on_update` =now()
                            WHERE
                            `td_jenis`='W' AND `td_tahun`='$v_tahun' AND `td_bulan`='$v_bulan' AND `td_id_udd`='$id_udd' AND  `td_id_dariudd`='$dt_wb[udd]'";
                    $q_upd1=mysqli_query($con_lap, $q_upd);
                    if ($q_upd1){$output='Sukses';}else{$output='Update Penerimaan WB : Error ';}

                }else{
                    $q_inst="INSERT INTO `data_terima_udd`(
                             `td_jenis`, `td_tahun`, `td_bulan`, `td_id_udd`, `td_id_dariudd`, `td_nm_dariudd`, `td_jml`)
                             VALUES ('W','$v_tahun','$v_bulan','$id_udd','$dt_wb[udd]','$dt_wb[nama]','$dt_wb[jumlah]')";
                    $q_inst1=mysqli_query($con_lap, $q_inst);
                    if ($q_inst1){$output='Sukses';}else{$output='Tambah Penerimaan WB : Error ';}
                }
            }
        }
    }
    //Apheresis
    if ($output=='Sukses'){
        $q_chk="SELECT `d_jenis`,`d_tahun`,`d_bulan`,`d_id_udd` FROM `data_donasi` WHERE
            `d_jenis`='A' AND `d_tahun`='$v_tahun' AND `d_bulan`='$v_bulan' AND `d_id_udd`='$id_udd'";
        $q_chk=mysqli_num_rows(mysqli_query($con_lap, $q_chk));
        if ($q_chk>0){
            //Update Donasi Aph
            $q_upd="UPDATE `data_donasi` SET
                `d_gd_ds_br`='$q_aph[dg_ds_br]',  `d_gd_ds_ul`='$q_aph[dg_ds_ul]',  `d_gd_dp`='$q_aph[dg_dp]',  `d_gd_byr`='0',
                `d_mu_br`='$q_aph[mu_ds_br]',   `d_mu_ul`='$q_aph[mu_ds_ul]',  `d_ttl_donasi`= '$q_aph[total]',
                `d_lk`='$q_aph[lk]',   `d_pr`= '$q_aph[pr]',
                `d_u17`='$q_aph[u17]',   `d_u1824`='$q_aph[u1824]',  `d_u2544`='$q_aph[u2544]',  `d_u4564`='$q_aph[u4564]',  `d_u65`= '$q_aph[u65]',
                `d_apos`='$q_aph[a_pos]',   `d_bpos`='$q_aph[b_pos]',   `d_opos`='$q_aph[o_pos]',  `d_abpos`= '$q_aph[ab_pos]',
                `d_aneg`='$q_aph[a_neg]', `d_bneg`= '$q_aph[b_neg]',  `d_oneg`='$q_aph[o_neg]',  `d_abneg`= '$q_aph[ab_neg]',
                `d_tlk_bb`='$aph_btl_bb',  `d_tlk_umr`='0',  `d_tlk_hb`= '$aph_btl_hb', `d_tlk_med`='$aph_btl_medis',
                `d_tlk_prilaku`= '$aph_btl_prilaku',  `d_tlk_bepergian`='$aph_btl_bepergian',  `d_tlk_lain`='$aph_btl_gagal',
                `on_update` =now()
                WHERE
                `d_jenis`='A' AND `d_tahun`='$v_tahun' AND `d_bulan`='$v_bulan' AND `d_id_udd`='$id_udd'";
            $q_upd1=mysqli_query($con_lap, $q_upd);
            if ($q_upd1){$output='Sukses';}else{$output='Update Donasi Aph : Error ';}
        }else{
            //Insert Donasi Aph
            $q_inst="INSERT INTO `data_donasi`(
                `d_jenis`, `d_tahun`, `d_bulan`, `d_id_udd`,
                `d_gd_ds_br`, `d_gd_ds_ul`, `d_gd_dp`, `d_gd_byr`,
                `d_mu_br`, `d_mu_ul`, `d_ttl_donasi`,
                `d_lk`, `d_pr`,
                `d_u17`, `d_u1824`, `d_u2544`, `d_u4564`, `d_u65`,
                `d_apos`, `d_bpos`, `d_opos`, `d_abpos`, `d_aneg`,
                `d_bneg`, `d_oneg`, `d_abneg`,
                `d_tlk_bb`, `d_tlk_umr`, `d_tlk_hb`, `d_tlk_med`, `d_tlk_prilaku`, `d_tlk_bepergian`, `d_tlk_lain`
                ) VALUES (
                'A','$v_tahun','$v_bulan','$id_udd',
                '$q_aph[dg_ds_br]', '$q_aph[dg_ds_ul]', '$q_aph[dg_dp]','0',
                '$q_aph[mu_ds_br]', '$q_aph[mu_ds_ul]', '$q_aph[total]',
                '$q_aph[lk]', '$q_aph[pr]',
                '$q_aph[u17]', '$q_aph[u1824]', '$q_aph[u2544]','$q_aph[u4564]','$q_aph[u65]',
                '$q_aph[a_pos]', '$q_aph[b_pos]', '$q_aph[o_pos]','$q_aph[ab_pos]',
                '$q_aph[a_neg]', '$q_aph[b_neg]', '$q_aph[o_neg]','$q_aph[ab_neg]',
                '$aph_btl_bb','0','$aph_btl_hb','$aph_btl_medis', '$aph_btl_prilaku', '$aph_btl_bepergian','$aph_btl_gagal')";
            $q_inst1=mysqli_query($con_lap, $q_inst);
            if ($q_inst1){$output='Sukses';}else{$output='Tambah Donasi Aph : Error '.mysqli_error($con_lap);}
        }
    }
    //TERIMA Aph dari UDD Lain================================
    if ($output=='Sukses'){
        while ($dt_aph=mysqli_fetch_assoc($terima_aph)){
            if ($dt_aph['jumlah']>'0'){
                $chk_terima="SELECT `td_id` FROM `data_terima_udd`
                             WHERE `td_jenis`='A' AND `td_tahun`='$v_tahun' AND `td_bulan`='$v_bulan' AND `td_id_udd`='$id_udd' AND `td_id_dariudd`='$dt_aph[udd]'";
                $rsl_terima=mysqli_num_rows(mysqli_query($con_lap, $chk_terima));
                if ($rsl_terima>0){
                    $q_upd="UPDATE `data_terima_udd` SET `td_jml`='$dt_aph[jumlah]',`on_update` =now()
                            WHERE
                            `td_jenis`='A' AND `td_tahun`'$v_tahun AND' `td_bulan`='$v_bulan'AND `td_id_udd`='$id_udd' AND  `td_id_dariudd`='$dt_aph[udd]'";
                    $q_upd1=mysqli_query($con_lap, $q_upd);
                    if ($q_upd1){$output='Sukses';}else{$output='Update Penerimaan Aph : Error ';}

                }else{
                    $q_inst="INSERT INTO `data_terima_udd`(
                             `td_jenis`, `td_tahun`, `td_bulan`, `td_id_udd`, `td_id_dariudd`, `td_nm_dariudd`, `td_jml`)
                             VALUES ('A','$v_tahun','$v_bulan','$id_udd','$dt_aph[udd]','$dt_aph[nama]','$dt_aph[jumlah]')";
                    $q_inst1=mysqli_query($con_lap, $q_inst);
                    if ($q_inst1){$output='Sukses';}else{$output='Tambah Penerimaan Aph : Error ';}
                }
            }
        }
    }//EOF Terima Aph udd lain

    //IMLTD================================
    if ($output=='Sukses'){
        $q_chk="SELECT `i_id_udd` FROM `data_imtd` WHERE `i_tahun`='$v_tahun' AND `i_bulan`='$v_bulan' AND `i_id_udd`='$id_udd'";
        $q_chk=mysqli_num_rows(mysqli_query($con_lap, $q_chk));
        if ($q_chk>0){
            $q_upd="UPDATE `data_imtd` SET
                    `i_hbv_ttl`= '$hbv_tot', `i_hbv_ir`= '$hbv_ir', `i_hbv_rr`= '$hbv_rr', `i_hcv_ttl`= '$hcv_tot', `i_hcv_ir`= '$hcv_ir', `i_hcv_rr`= '$hcv_rr',
                    `i_hiv_ttl`= '$hiv_tot', `i_hiv_ir`= '$hiv_ir', `i_hiv_rr`= '$hiv_rr', `i_syp_ttl`= '$syp_tot', `i_syp_ir`= '$syp_ir', `i_syp_rr`= '$syp_rr',
                    `i_jml_hbv_rpd`= '$reag_rapid[rpd_b]', `j_jml_hbv_chlia`= '$reag_elisa[chl_b]', `i_jml_hbv_eia`= '$reag_elisa[eia_b]',
                    `i_jml_hcv_rpd`= '$reag_rapid[rpd_c]', `i_jml_hcv_chlia`= '$reag_elisa[chl_c]', `i_jml_hcv_eia`= '$reag_elisa[eia_c]',
                    `i_jml_hiv_rpd`= '$reag_rapid[rpd_i]', `i_jml_hiv_chlia`= '$reag_elisa[chl_i]', `i_jml_hiv_eia`= '$reag_elisa[eia_i]',
                    `i_jml_syp_rpd`= '$reag_rapid[rpd_s]', `i_jml_syp_chlia`= '$reag_elisa[chl_s]', `i_jml_syp_eia`= '$reag_elisa[eia_s]',
                    `i_jml_nat`= '$nat[jml_nat]',
                    `i_nm_hbv_rpd`= '$nm_rpd_hbv', `i_nm_hbv_chlia`= '$reag_chl_hbv', `i_nm_hbv_eia`= '$reag_eia_hbv',
                    `i_nm_hcv_rpd`= '$nm_rpd_hcv', `i_nm_hcv_chlia`= '$reag_chl_hcv', `i_nm_hcv_eia`= '$reag_eia_hiv',
                    `i_nm_hiv_rpd`= '$nm_rpd_hiv', `i_nm_hiv_chlia`= '$reag_chl_hiv', `i_nm_hiv_eia`= '$reag_eia_hiv',
                    `i_nm_syp_rpd`= '$nm_rpd_syp', `i_nm_syp_chlia`= '$reag_chl_syp', `i_nm_syp_eia`= '$reag_eia_syp',
                    `i_nm_nat`='$reagean_nat', `on_update` =now()
                    WHERE `i_tahun`='$v_tahun' AND `i_bulan`='$v_bulan' AND `i_id_udd`='$id_udd'";
            $q_upd1=mysqli_query($con_lap, $q_upd);
            if ($q_upd1){$output='Sukses';}else{$output='Update Lap IMLTD : Error ';}
        }else{
            $q_inst="INSERT INTO `data_imtd`(`i_tahun`, `i_bulan`, `i_id_udd`,
            `i_hbv_ttl`, `i_hbv_ir`, `i_hbv_rr`, `i_hcv_ttl`, `i_hcv_ir`, `i_hcv_rr`,
            `i_hiv_ttl`, `i_hiv_ir`, `i_hiv_rr`, `i_syp_ttl`, `i_syp_ir`, `i_syp_rr`,
            `i_jml_hbv_rpd`, `j_jml_hbv_chlia`, `i_jml_hbv_eia`,
            `i_jml_hcv_rpd`, `i_jml_hcv_chlia`, `i_jml_hcv_eia`,
            `i_jml_hiv_rpd`, `i_jml_hiv_chlia`, `i_jml_hiv_eia`,
            `i_jml_syp_rpd`, `i_jml_syp_chlia`, `i_jml_syp_eia`,
            `i_jml_nat`,
            `i_nm_hbv_rpd`, `i_nm_hbv_chlia`, `i_nm_hbv_eia`,
            `i_nm_hcv_rpd`, `i_nm_hcv_chlia`, `i_nm_hcv_eia`,
            `i_nm_hiv_rpd`, `i_nm_hiv_chlia`, `i_nm_hiv_eia`,
            `i_nm_syp_rpd`, `i_nm_syp_chlia`, `i_nm_syp_eia`,
            `i_nm_nat`) VALUES (
            '$v_tahun', '$v_bulan', '$id_udd',
            '$hbv_tot', '$hbv_ir', '$hbv_rr', '$hcv_tot', '$hcv_ir', '$hcv_rr',
            '$hiv_tot', '$hiv_ir', '$hiv_rr', '$syp_tot', '$syp_ir', '$syp_rr',
            '$reag_rapid[rpd_b]', '$reag_elisa[chl_b]', '$reag_elisa[eia_b]',
            '$reag_rapid[rpd_c]', '$reag_elisa[chl_c]', '$reag_elisa[eia_c]',
            '$reag_rapid[rpd_i]', '$reag_elisa[chl_i]', '$reag_elisa[eia_i]',
            '$reag_rapid[rpd_s]', '$reag_elisa[chl_s]', '$reag_elisa[eia_s]',
            '$nat[jml_nat]',
            '$nm_rpd_hbv', '$reag_chl_hbv', '$reag_eia_hbv',
            '$nm_rpd_hcv', '$reag_chl_hcv', '$reag_eia_hiv',
            '$nm_rpd_hiv', '$reag_chl_hiv', '$reag_eia_hiv',
            '$nm_rpd_syp', '$reag_chl_syp', '$reag_eia_syp',
            '$reagean_nat'
            )";
            $q_inst1=mysqli_query($con_lap, $q_inst);
            if ($q_inst1){$output='Sukses';}else{$output='Tambah Lap IMLTD : Error '.$q_inst;}
        }
    }//EOF IMLTD

    //Pemusnahan Darah
    if ($output=='Sukses'){
            $chk="SELECT `m_id_udd` FROM `data_pemusnahan` WHERE `m_tahun`='$v_tahun' AND `m_bulan`='$v_bulan' AND `m_id_udd`='$id_udd'";
            $rsl=mysqli_num_rows(mysqli_query($con_lap, $chk));
            if ($rsl>0){
                $q_upd="UPDATE `data_pemusnahan` SET
                        `m_gagal`='$q_musnah[gagal]', `m_reaktif`='$q_musnah[reaktif]',
                        `m_kedaluarsa`='$q_musnah[ed]', `m_mslh_produksi`='$q_musnah[produksi]',
                        `m_mslh_simpan`='$q_musnah[penyimpanan]', `m_penyebab_lain`='$q_musnah[lainnya]', `on_update` =now()
                        WHERE
                        `m_tahun`='$v_tahun' AND `m_bulan`='$v_bulan' AND `m_id_udd`='$id_udd'";
                $q_upd1=mysqli_query($con_lap, $q_upd);
                if ($q_upd1){$output='Sukses';}else{$output='Update Lap Pemusnahan : Error ';}
            }else{
                $q_inst="INSERT INTO `data_pemusnahan`(`m_tahun`, `m_bulan`, `m_id_udd`, `m_gagal`, `m_reaktif`,
                        `m_kedaluarsa`, `m_mslh_produksi`, `m_mslh_simpan`, `m_penyebab_lain`) VALUES (
                        '$v_tahun', '$v_bulan', '$id_udd','$q_musnah[gagal]','$q_musnah[reaktif]',
                        '$q_musnah[ed]','$q_musnah[produksi]', '$q_musnah[penyimpanan]', '$q_musnah[lainnya]')";
                $q_inst1=mysqli_query($con_lap, $q_inst);
                if ($q_inst1){$output='Sukses';}else{$output='Tambah Lap Pemusnahan : Error ';}
            }
    }//EOF Pemusnahan Darah

    //PERMINTAAN DARAH ===================================================
    if ($output=='Sukses'){
        $chk="SELECT `r_id` FROM `data_permintaan` WHERE  `r_tahun`='$v_tahun' AND `r_bulan`='$v_bulan' AND `r_id_udd`='$id_udd'";
        $rsl=mysqli_num_rows(mysqli_query($con_lap, $chk));
        if ($rsl>0){
            $q_upd="UPDATE `data_permintaan` SET
                    `r_ank_req`='$req_anak', `r_ank_dipenuhi`='$crs_anak', `r_ank_dipakai`='$out_anak',
                    `r_bdh_req`='$req_bedah', `r_bdh_dipehuhi`='$crs_bedah', `r_bdh_dipakai`='$out_bedah',
                    `r_int_req`='$req_interna', `r_int_dipenuhi`='$crs_interna', `r_int_dipakai`='$out_interna',
                    `r_obg_req`='$req_keb', `r_obg_dipenuhi`='$crs_keb', `r_obg_dipakai`='$out_keb',
                    `r_ll_req`='$req_ll', `r_ll_dipenuhi`='$crs_ll', `r_ll_dipakai`='$out_ll',
                    `r_rs_dlm_kota`='$rs_dlm_kota', `r_rs_luar_kota`='$rs_luar_kota',
                    `r_dist_bdrs`='$drop_bdrs', `r_dist_udd_lain`='$drop_udd', `on_update` =now()
                    where
                    `r_tahun`='$v_tahun' AND `r_bulan`='$v_bulan' AND `r_id_udd`='$id_udd'";
            $q_upd1=mysqli_query($con_lap, $q_upd);
            if ($q_upd1){$output='Sukses';}else{$output='Update Lap Permintaan : Error ';}
        }else{
            $q_inst="INSERT INTO `data_permintaan`(
                    `r_tahun`, `r_bulan`, `r_id_udd`,
                    `r_ank_req`, `r_ank_dipenuhi`, `r_ank_dipakai`,
                    `r_bdh_req`, `r_bdh_dipehuhi`, `r_bdh_dipakai`,
                    `r_int_req`, `r_int_dipenuhi`, `r_int_dipakai`,
                    `r_obg_req`, `r_obg_dipenuhi`, `r_obg_dipakai`,
                    `r_ll_req`, `r_ll_dipenuhi`, `r_ll_dipakai`,
                    `r_rs_dlm_kota`, `r_rs_luar_kota`,
                    `r_dist_bdrs`, `r_dist_udd_lain`
                    ) VALUES (
                    '$v_tahun', '$v_bulan', '$id_udd',
                    '$req_anak', '$crs_anak', '$out_anak',
                    '$req_bedah', '$crs_bedah', '$out_bedah',
                    '$req_interna', '$crs_interna', '$out_interna',
                    '$req_keb', '$crs_keb', '$out_keb',
                    '$req_ll', '$crs_ll', '$out_ll',
                    '$rs_dlm_kota', '$rs_luar_kota',
                    '$drop_bdrs', '$drop_udd')";
            $q_inst1=mysqli_query($con_lap, $q_inst);
            if ($q_inst1){$output='Sukses';}else{$output='Tambah Lap Permintaan : Error ';}
        }
    } //permintaan darah

    //KOMPONEN
    if ($output=='Sukses'){
        $chk="SELECT `k_id` FROM `data_komponen` WHERE  `k_tahun`='$v_tahun'AND `k_bulan`='$v_bulan' AND `k_id_udd`='$id_udd'";
        $rsl=mysqli_num_rows(mysqli_query($chk));
        if ($rsl>0){
            $q_upd="UPDATE `data_komponen` SET
                     `k_prod_wb`= '$prod_wb', `k_prod_prc`= '$prod_prc', `k_prod_lp`= '$prod_lp', `k_prod_ffp`= '$prod_ffp',
                     `k_prod_tc`= '$prod_tc', `k_prod_ahf`= '$prod_ahf', `k_prod_we`= '$prod_we',
                     `k_prod_ld_br`= '$prod_bufr', `k_prod_ld_pre_strg`= '$prod_in_flt', `k_prod_ld_post_strg_bsf`= '$prod_bed_flt',
                     `k_prod_ld_post_strg_ltf`= '$prod_lab_flt',
                     `k_prod_aph_prc`= '$prod_aph_prc', `k_prod_aph_tc`= '$prod_aph_tc', `k_prod_aph_pls`= '$prod_aph_lp',
                     `k_req_wb`= '$req_wb', `k_req_prc`= '$req_prc', `k_req_lp`= '$req_lp', `k_req_ffp`= '$req_ffp',
                     `k_req_tc`= '$req_tc', `k_req_ahf`= '$req_ahf', `k_req_we`= '$req_we',
                     `k_req_ld_br`= '$req_bufr', `k_req_ld_pre_strg`= '$req_in_flt', `k_req_ld_post_strg_bsf`= '$req_bed_flt',
                     `k_req_ld_post_strg_ltf`= '$req_lab_flt',
                     `k_req_aph_prc`= '$req_aph_prc', `k_req_aph_tc`= '$req_aph_tc', `k_req_aph_pls`= '$req_aph_lp',
                     `k_use_wb`= '$out_wb', `k_use_prc`= '$out_prc', `k_user_lp`= '$out_lp', `k_use_ffp`= '$out_ffp',
                     `k_use_tc`= '$out_tc', `k_use_ahf`= '$out_ahf', `k_use_we`= '$out_we',
                     `k_use_ld_br`= '$out_bufr', `k_use_ld_pre_strg`= '$out_in_flt', `k_use_ld_post_strg_bsf`= '$out_bed_flt',
                     `k_use_ld_post_strg_ltf`= '$out_lab_flt',
                     `k_use_aph_prc`= '$out_aph_prc', `k_use_aph_tc`= '$out_aph_tc', `k_use_aph_pls`= '$out_aph_lp', `on_update` =now()
                     WHERE `k_tahun`='$v_tahun' AND `k_bulan`='$v_bulan' AND `k_id_udd`='$id_udd'";
            $q_upd1=mysqli_query($con_lap, $q_upd);
            if ($q_upd1){$output='Sukses';}else{$output='Update Lap Komponen : Error '.$q_upd;}
        }else{
            $q_inst="INSERT INTO `data_komponen`(
                     `k_tahun`, `k_bulan`, `k_id_udd`,
                     `k_prod_wb`, `k_prod_prc`, `k_prod_lp`, `k_prod_ffp`, `k_prod_tc`, `k_prod_ahf`, `k_prod_we`,
                     `k_prod_ld_br`, `k_prod_ld_pre_strg`, `k_prod_ld_post_strg_bsf`, `k_prod_ld_post_strg_ltf`,
                     `k_prod_aph_prc`, `k_prod_aph_tc`, `k_prod_aph_pls`,
                     `k_req_wb`, `k_req_prc`, `k_req_lp`, `k_req_ffp`, `k_req_tc`, `k_req_ahf`, `k_req_we`,
                     `k_req_ld_br`, `k_req_ld_pre_strg`, `k_req_ld_post_strg_bsf`, `k_req_ld_post_strg_ltf`,
                     `k_req_aph_prc`, `k_req_aph_tc`, `k_req_aph_pls`,
                     `k_use_wb`, `k_use_prc`, `k_user_lp`, `k_use_ffp`, `k_use_tc`, `k_use_ahf`, `k_use_we`,
                     `k_use_ld_br`, `k_use_ld_pre_strg`, `k_use_ld_post_strg_bsf`, `k_use_ld_post_strg_ltf`,
                     `k_use_aph_prc`, `k_use_aph_tc`, `k_use_aph_pls`
                     ) VALUES (
                     '$v_tahun','$v_bulan','$id_udd',
                     '$prod_wb','$prod_prc','$prod_lp','$prod_ffp','$prod_tc','$prod_ahf','$prod_we',
                     '$prod_bufr','$prod_in_flt','$prod_bed_flt','$prod_lab_flt',
                     '$prod_aph_prc','$prod_aph_tc','$prod_aph_lp',
                     '$req_wb','$req_prc','$req_lp','$req_ffp','$req_tc','$req_ahf','$req_we',
                     '$req_bufr','$req_in_flt','$req_bed_flt','$req_lab_flt',
                     '$req_aph_prc','$req_aph_tc','$req_aph_lp',
                     '$out_wb','$out_prc','$out_lp','$out_ffp','$out_tc','$out_ahf','$out_we',
                     '$out_bufr','$out_in_flt','$out_bed_flt','$out_lab_flt',
                     '$out_aph_prc','$out_aph_tc','$out_aph_lp'
                     )";
            $q_inst1=mysqli_query($con_lap, $q_inst);
            if ($q_inst1){$output='Sukses';}else{$output='Tambah Lap Komponen : Error '.$q_inst;}
        }

    }
}
if ($output=='Sukses'){$output='Pengiriman laporan BERHASIL';}
echo $output;
?>