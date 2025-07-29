<?
    /***********************************************
     * Author 	: suwena 
     * Date 	: 9 Juni 2019
     ***********************************************/
session_start();
require_once('config/db_connect.php');
$tahun      = date("Y");
$v_tahun    = $_GET['thn'];
if (empty($v_tahun)){$v_tahun=$tahun;}

$utd    = mysql_fetch_assoc(mysql_query("select * from `utd` where `aktif`='1'"));
$qlap  = "SELECT `u_id`, `u_tahun`, `u_id_udd`, `u_nama`, `u_alamat`, `u_kab`, `u_prov`, `u_kpos`, `u_telp`,
           `u_email`, `u_ka_nama`, `u_ka_hp`, `u_ka_email`,
           `u_komite_mdk`, `u_distr_terbuka`, `u_distr_cold_chain`,
           `u_jml_dokter_kompeten`, `u_ptgs_komptn`, `u_inform_c`, `u_lbr_mon_td`, `u_jml_pasien_td`, `u_jml_pasien_rtd`,
           `u_periksa_kgd`, `u_kgd_auto`, `u_kgd_semi`, `u_kgd_manual`, `u_periksa_abs`, `u_abs_auto`, `u_abs_semi`,
           `u_abs_manual`, `u_periksa_iab`, `u_iab_auto`, `u_iab_semi`, `u_iab_manual`, `u_periksa_cross`, `u_cross_auto`,
           `u_cross_semi`, `u_cross_manual`, day(`u_tgl_laporan`) as tgl_lap, month(`u_tgl_laporan`) as bln_lap, year(`u_tgl_laporan`) as thn_lap
           FROM `rpt_data_umum` WHERE `u_id_udd`='$utd[id]'";
$qlap    = mysql_fetch_assoc(mysql_query($qlap));
switch($qlap['bln_lap']){
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
?>

<title>Laporan UDD</title>
<head>
<style type="text/css" media="print">
    @page
    {
        size: portrait;
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
            LAPORAN PEMERIKSAAN IMUNOHEMATOLOGI<br>
            <?php echo $qlap['u_nama'];?><br>
            <?php echo 'TAHUN '.$v_tahun;?>
        </td>
    </tr>
</table>
<div style="font-size: 13px;font-weight: bold; text-align: left; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
    <br><br>E. PEMERIKSAAN IMUNOHEMATOLOGI
</div>
<table class="list" border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse">
    <thead class="pmi">
    <tr>
        <th align="center" rowspan="2" style="vertical-align: middle;">No</th>
        <th align="center" rowspan="2" style="vertical-align: middle;">Jenis Pemeriksaan</th>
        <th align="center" rowspan="2" style="vertical-align: middle;">Dilakukan/<br>Tidak</th>
        <th align="center" colspan="3" style="vertical-align: middle;">Metode dan Nama Alat yang digunakan</th>
    </tr>
    <tr>
        <th align="center" style="vertical-align: middle;">Fully Automatic</th>
        <th align="center" style="vertical-align: middle;">Semi Automatic/Gell Test</th>
        <th align="center" style="vertical-align: middle;">Convensional/Tabung</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td align="center">1.</td><td>Konfirmasi Golongan Darah</td>
        <td align="center"><?php if ($qlap['u_periksa_kgd']=='1'){echo 'Dilakukan';}else{echo 'Tidak Dilakukan';}?></td>
        <td align="center"><?php echo $qlap['u_kgd_auto']; ?></td>
        <td align="center"><?php echo $qlap['u_kgd_semi']; ?></td>
        <td align="center"><?php echo $qlap['u_kgd_manual']; ?></td>
    </tr>
    <tr>
        <td align="center">2.</td><td>Skrining Antibodi</td>
        <td align="center"><?php if ($qlap['u_periksa_abs']=='1'){echo 'Dilakukan';}else{echo 'Tidak Dilakukan';}?></td>
        <td align="center"><?php echo $qlap['u_abs_auto']; ?></td>
        <td align="center"><?php echo $qlap['u_abs_semi']; ?></td>
        <td align="center"><?php echo $qlap['u_abs_manual']; ?></td>
    </tr>
    <tr>
        <td align="center">3</td><td>Identifikasi Antibodi</td>
        <td align="center"><?php if ($qlap['u_periksa_iab']=='1'){echo 'Dilakukan';}else{echo 'Tidak Dilakukan';}?></td>
        <td align="center"><?php echo $qlap['u_iab_auto']; ?></td>
        <td align="center"><?php echo $qlap['u_iab_semi']; ?></td>
        <td align="center"><?php echo $qlap['u_iab_manual']; ?></td>
    </tr>
    <tr>
        <td align="center">4.</td><td>Uji Silang Serasi</td>
        <td align="center"><?php if ($qlap['u_periksa_cross']=='1'){echo 'Dilakukan';}else{echo 'Tidak Dilakukan';}?></td>
        <td align="center"><?php echo $qlap['u_cross_auto']; ?></td>
        <td align="center"><?php echo $qlap['u_cross_semi']; ?></td>
        <td align="center"><?php echo $qlap['u_cross_manual']; ?></td>
    </tr>
    </tbody>
</table>

<br>
<br><br><br>
<table border="0" width="100%">
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td width="25%"></td>
        <td width="25%"></td>
        <td width="25%" nowrap>
            <?php echo $qlap['u_kab'].', '.$qlap['tgl_lap'].' '.$bln_lap.' '.$qlap['thn_lap'];?>
            <br>KEPALA <?php echo $qlap['u_nama'].',';?><br><br><br><br>
        </td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:bold; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td width="25%"></td>
        <td width="25%"></td>
        <td width="25%" nowrap>
            <?php echo $qlap['u_ka_nama'];?>
        </td>
    </tr>
</table>
<? echo "<meta http-equiv='refresh' content='2;url=pmitatausaha.php?module=lap_immunohematologi'";?>
</body>
