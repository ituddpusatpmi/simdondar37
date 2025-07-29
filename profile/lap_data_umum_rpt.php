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
        <td style="height: 40px;font-size: 16px;font-weight: bold; text-align: center; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;" colspan="7">
            DATA UMUM UDD PMI<br>
            <?php echo $dt_um['u_nama'];?><br>
            <?php echo 'TAHUN '.$v_tahun;?>
        </td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:bold; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td colspan="7"><strong>A. DATA UMUM</strong></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:bold; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td style="text-align: right;width: 25px;"><strong>I.&nbsp;</strong></td>
        <td colspan="6"><strong>Administrasi</strong></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td></td>
        <td>Alamat UDD PMI</td><td>:</td><td><?php echo $dt_um['u_alamat'];?></td>
        <td>Kode POS</td><td>:</td><td style="width: 30%;"><?php echo $dt_um['u_kpos'];?></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td></td>
        <td></td>
        <td></td>
        <td>Kabupaten/Kota : <?php echo $dt_um['u_kab'];?></td>
        <td>Provinsi</td><td>:</td><td><?php echo $dt_um['u_prov'];?></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td></td>
        <td>No. Telepon</td>
        <td>:</td>
        <td><?php echo $dt_um['u_telp'];?></td>
        <td></td><td></td><td></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td></td>
        <td>Email UDD</td>
        <td>:</td>
        <td><?php echo $dt_um['u_email'];?></td>
        <td></td><td></td><td></td>
    </tr>
    <tr><td colspan="7">&nbsp;&nbsp;</td></tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td style="text-align: right;"><strong>II.&nbsp;</strong></td>
        <td colspan="6"><strong>Kepala UDD PMI</strong></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td></td>
        <td>Nama</td>
        <td>:</td>
        <td><?php echo $dt_um['u_ka_nama'];?></td>
        <td></td><td></td><td></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td></td>
        <td>Ponsel</td>
        <td>:</td>
        <td><?php echo $dt_um['u_ka_hp'];?></td>
        <td></td><td></td><td></td>
    </tr>
    <tr style="background-color: #ffffff;font-wight:none; font-size:14px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <td></td>
        <td>Email</td>
        <td>:</td>
        <td><?php echo $dt_um['u_ka_email'];?></td>
        <td></td><td></td><td></td>
    </tr>
</table>
<br><br>
<table class="list" border="1" cellpadding="2" cellspacing="2" width="100%" style="border-collapse:collapse">
    <thead>
    <tr style="background-color: #ffffff;font-wight:bold; font-size:12px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Kepemilikan</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Kelas RS</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Kelas UTD</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Tingkatan</th>
        <th class="text-center" colspan="2" style="vertical-align: middle;">Asal Dana</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Operasional<br>Sejak<br>Tahun</th>
        <th class="text-center" colspan="2" style="vertical-align: middle;">Bantuan Anggaran</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">BPPD</th>
        <th class="text-center" rowspan="2" style="vertical-align: middle;">Dasar Hukum BPPD</th>
    </tr>
    <tr style="background-color: #ffffff;font-wight:bold; font-size:12px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
        <th class="text-center" style="vertical-align: middle;">Bangunan</th>
        <th class="text-center" style="vertical-align: middle;">Alat</th>
        <th class="text-center" style="vertical-align: middle;">Ya</th>
        <th class="text-center" style="vertical-align: middle;">Jumlah</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $select_query = "SELECT `b_id`, `b_tahun`, `b_id_udd`, `b_kpemilikan`, `b_klasrs`, `b_klas_udd`, `b_tingkat_udd`,
                                                    `b_dana_bngunan`, `b_dana_alat`, `b_th_operasional`, case when `b_dana_apbd`='0' then 'Tidak' ELSE 'Ya' END as b_dana_apbd, `b_jml_dana_apbd`, `b_bppd`,
                                                    `b_sk_bppd` FROM `rpt_data_bangunan` order by `b_id`";
    $result = mysql_query($select_query);
    $no=0;
    while($row = mysql_fetch_array($result)){
        $no++;
        if($row["b_tingkat_udd"]=="Kabupaten"){$kelas_utd="Kabupaten/Kota";}else{$kelas_utd=$row["b_tingkat_udd"];}
        if($row["b_kpemilikan"]=="0"){$milik="PMI";}else{$milik="Pemerintah";}
        ?>
        <tr style="background-color: #ffffff;font-wight:none; font-size:12px; color:#000000; font-family:'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
            <td nowrap align="center">&nbsp;<br><?php echo $milik;?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo $row["b_klasrs"];?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo $row["b_klas_udd"];?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo $kelas_utd;?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo $row["b_dana_bngunan"];?><br>&nbsp;</td>
            <td align="center">&nbsp;<br><?php echo $row["b_dana_alat"];?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo $row["b_th_operasional"];?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo $row['b_dana_apbd'];?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo number_format($row["b_jml_dana_apbd"],0,',','.');?><br>&nbsp;</td>
            <td nowrap align="center">&nbsp;<br><?php echo number_format($row["b_bppd"],0,',','.');?><br>&nbsp;</td>
            <td align="center">&nbsp;<br><?php echo $row["b_sk_bppd"];?><br>&nbsp;</td></tr>
    <?php }?>
    </tbody>
</table>
<p style="font-size: 11px;">* : Khusus untuk UDD di RS<br>
    ** : Sebutkan semua yang sesuai (APBN/DAK/APBD/sumber lain)</p>
<br>
<br><br><br>
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
<? echo "<meta http-equiv='refresh' content='2;url=pmitatausaha.php?module=lap_umum'";?>
</body>
