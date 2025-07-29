<?
    /***********************************************
     * Author 	: suwena 
     * Date 	: 9 Juni 2019
     ***********************************************/
session_start();
require_once('config/db_connect.php');
$tahun      = date("Y");
$v_tahun    = $_GET['t'];
if (empty($v_tahun)){$v_tahun=$tahun;}

$utd            = mysql_fetch_assoc(mysql_query("select * from `utd` where `aktif`='1'"));
$dt_um          = "SELECT `u_id`, `u_tahun`, `u_id_udd`, `u_nama`, `u_alamat`, `u_kab`, `u_prov`, `u_kpos`, `u_telp`,
                   `u_email`, `u_ka_nama`, `u_ka_hp`, `u_ka_email`,
                   `u_komite_mdk`, `u_distr_terbuka`, `u_distr_cold_chain`,
                   `u_jml_dokter_kompeten`, `u_ptgs_komptn`, `u_inform_c`, `u_lbr_mon_td`, `u_jml_pasien_td`, `u_jml_pasien_rtd`,
                   `u_periksa_kgd`, `u_kgd_auto`, `u_kgd_semi`, `u_kgd_manual`, `u_periksa_abs`, `u_abs_auto`, `u_abs_semi`,
                   `u_abs_manual`, `u_periksa_iab`, `u_iab_auto`, `u_iab_semi`, `u_iab_manual`, `u_periksa_cross`, `u_cross_auto`,
                   `u_cross_semi`, `u_cross_manual`,day(`u_tgl_laporan`) as tgl_lap, month(`u_tgl_laporan`) as bln_lap, year(`u_tgl_laporan`) as thn_lap
                   FROM `rpt_data_umum` WHERE `u_id_udd`='$utd[id]'";
$dt_um          = mysql_fetch_assoc(mysql_query($dt_um));
switch($dt_um['bln_lap']){
    case '1'  : $bln_lap='Januari';break;
    case '2'  : $bln_lap='Februari';break;
    case '3'  : $bln_lap='Maret';break;
    case '4'  : $bln_lap='April';break;
    case '5'  : $bln_lap='Mei';break;
    case '6'  : $bln_lap='Juni';break;
    case '7'  : $bln_lap='Juli';break;
    case '8'  : $bln_lap='Agustus';break;
    case '9'  : $bln_lap='September';break;
    case '10' : $bln_lap='Oktober';break;
    case '11' : $bln_lap='Nopember';break;
    case '12' : $bln_lap='Desember';break;
}

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
                                from htransaksi
                                where year(`Tgl`)='$v_tahun' AND `Pengambilan`='0'";
                        $qd=mysql_fetch_assoc(mysql_query($qd));
                        $cekal="select
                                COUNT(DISTINCT(CASE WHEN (`JenisDonor`='0' or `JenisDonor` IS NULL  or `JenisDonor`='') THEN `KodePendonor` END )) AS ds,
                                COUNT(DISTINCT(CASE WHEN  `JenisDonor`='1' THEN `KodePendonor` END )) AS dp,
                                COUNT(DISTINCT(CASE WHEN  `JenisDonor` NOT IN ('1','0') THEN `KodePendonor` END )) AS ll
                                from `htransaksi` h inner join `pendonor` p on p.`Kode`=h.`KodePendonor`
                                where year(h.`Tgl`)='$v_tahun' AND h.`Pengambilan`='0' and p.`Cekal`=1";
                        $cekal=mysql_fetch_assoc(mysql_query($cekal));
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
                        $dsbaru=mysql_fetch_assoc(mysql_query($dsbaru));

?>

<title>Laporan UDD</title>
<head>
<style type="text/css" media="print">
    @page
    {
        size: landscape;
        margin-bottom: 20mm;
        margin-left: 0mm;
        margin-right: 0mm;
        margin-top: 15mm;
        header : {display: none !important;}
    }
    html
    {
        background-color: #ffffff;
        margin: 3px;  /* this affects the margin on the html before sending to printer */
    }
    body
    {
        border: solid 0px #ffffff ;
        margin: 0mm 15mm 10mm 10mm; /* margin you want for the content */
    }
    table th td {text-align: left;}
</style>
</head>
<body onload="window.print()">
<table class="list" border="0" cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <tr>
        <td style="height: 40px;font-size: 16px;font-weight: bold; text-align: center; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
            LAPORAN JUMLAH PENDONOR<br>
            <?php echo $dt_um['u_nama'];?><br>
            <?php echo 'TAHUN '.$v_tahun;?>
        </td>
    </tr>
</table>
<div style="font-size: 13px;font-weight: bold; text-align: left; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
    <br><br>B.1 JUMLAH PENDONOR DARAH (Jumlah orang yang mendonorkan darahnya)
</div>


<table class="list" border="1" cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <thead class="pmi">
    <tr>
        <th rowspan="2" align="center">Jumlah Total Pendonor</th>
        <th colspan="3" align="center">Jenis Pendonor</th>
        <th colspan="2" align="center">Jenis Kelamin</th>
        <th colspan="5" align="center">Kelompok Umur</th>
    </tr>
    <tr>
        <th align="center">Sukarela</th>
        <th align="center">Pengganti</th>
        <th align="center">Bayaran</th>
        <th align="center">Laki-Laki</th>
        <th align="center">Perempuan</th>
        <th align="center">17 Tahun</th>
        <th align="center">18-24 Tahun</th>
        <th align="center">25-44 Tahun</th>
        <th align="center">45-64 Tahun</th>
        <th align="center">>=65 Tahun </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td align="center">&nbsp;<br><?php echo $qd['dslk17']+$qd['dspr17']+$qd['dslk18']+$qd['dspr18']+$qd['dslk24']+$qd['dspr24']+$qd['dslk44']+$qd['dspr44']+$qd['dslk64']+$qd['dspr64']+$qd['dplk17']+$qd['dppr17']+$qd['dplk18']+$qd['dppr18']+$qd['dplk24']+$qd['dppr24']+$qd['dplk44']+$qd['dppr44']+$qd['dplk64']+$qd['dppr64'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dslk17']+$qd['dspr17']+$qd['dslk18']+$qd['dspr18']+$qd['dslk24']+$qd['dspr24']+$qd['dslk44']+$qd['dspr44']+$qd['dslk64']+$qd['dspr64'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dplk17']+$qd['dppr17']+$qd['dplk18']+$qd['dppr18']+$qd['dplk24']+$qd['dppr24']+$qd['dplk44']+$qd['dppr44']+$qd['dplk64']+$qd['dppr64'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br>0<br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dslk17']+$qd['dplk17']+$qd['dslk18']+$qd['dplk18']+$qd['dslk24']+$qd['dplk24']+$qd['dslk44']+$qd['dplk44']+$qd['dslk64']+$qd['dplk64'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dspr17']+$qd['dppr17']+$qd['dspr18']+$qd['dppr18']+$qd['dspr24']+$qd['dppr24']+$qd['dspr44']+$qd['dppr44']+$qd['dspr64']+$qd['dppr64'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dslk17']+$qd['dspr17']+$qd['dplk17']+$qd['dppr17'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dslk18']+$qd['dspr18']+$qd['dplk18']+$qd['dppr18'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dslk24']+$qd['dspr24']+$qd['dplk24']+$qd['dppr24'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dslk44']+$qd['dspr44']+$qd['dplk44']+$qd['dppr44'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $qd['dslk64']+$qd['dspr64']+$qd['dplk64']+$qd['dppr64'];?><br>&nbsp;</td>
    </tr>
    </tbody>
</table>

<div style="font-size: 13px;font-weight: bold; text-align: left; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
    <br><br>B.2 JUMLAH PENDONOR DARAH YANG DICEKAL
</div>

<table class="list" border="1" cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <thead class="pmi">
    <tr>
        <th colspan="3" align="center">Jumlah Pendonor yang dicekal Permanen</th>
        <th colspan="3" align="center">Jumlah Pendonor yang dicekal Sementara</th>
    </tr>
    <tr>
        <th align="center">Sukarela</th>
        <th align="center">Pengganti</th>
        <th align="center">Bayaran</th>
        <th align="center">Sukarela</th>
        <th align="center">Pengganti</th>
        <th align="center">Bayaran</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td align="center">&nbsp;<br>0<br>&nbsp;</td>
        <td align="center">&nbsp;<br>0<br>&nbsp;</td>
        <td align="center">&nbsp;<br>0<br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $cekal['ds'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $cekal['dp']+$cekal['ll'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br>0<br>&nbsp;</td>
    </tr>
    </tbody>
</table>


<div style="font-size: 13px;font-weight: bold; text-align: left; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
    <br><br>B.3 JUMLAH PENDONOR BARU DAN ULANG
</div>

<table class="list" border="1" cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <thead class="pmi">
    <tr>
        <th colspan="8" align="center">Jumlah Pendonor Darah Baru menurut Golongan dan Rhesus Darah</th>
        <th colspan="8" align="center">Jumlah Pendonor Darah Ulang menurut Golongan dan Rhesus Darah</th>
    </tr>
    <tr>
        <th colspan="2" align="center">A</th>
        <th colspan="2" align="center">B</th>
        <th colspan="2" align="center">O</th>
        <th colspan="2" align="center">AB</th>
        <th colspan="2" align="center">A</th>
        <th colspan="2" align="center">B</th>
        <th colspan="2" align="center">O</th>
        <th colspan="2" align="center">AB</th>
    </tr>
    <tr>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
        <th align="center">Pos</th>
        <th align="center">Neg</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td align="center">&nbsp;<br><?php echo $dsbaru['brap'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['bran'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['brbp'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['brbn'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['brop'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['bron'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['brabp'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['brabn'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulap'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulan'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulbp'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulbn'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulop'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulon'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulabp'];?><br>&nbsp;</td>
        <td align="center">&nbsp;<br><?php echo $dsbaru['ulabn'];?><br>&nbsp;</td>
    </tr>
    </tbody>
</table>
<br><br>

<table border="0" width="100%">
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td width="25%"></td>
        <td width="25%"></td>
        <td width="25%" nowrap>
            <?php echo $dt_um['u_kab'].', '.$dt_um['tgl_lap'].' '.$bln_lap.' '.$dt_um['thn_lap'];?>
            <br>KEPALA <?php echo $dt_um['u_nama'].',';?><br><br><br><br>
        </td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:bold; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td width="25%"></td>
        <td width="25%"></td>
        <td width="25%" nowrap>
            <?php echo $dt_um['u_ka_nama'];?>
        </td>
    </tr>
</table>
<? echo "<meta http-equiv='refresh' content='2;url=pmitatausaha.php?module=pendonor&t=$v_tahun'";?>
</body>
