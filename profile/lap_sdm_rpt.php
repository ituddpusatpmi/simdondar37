<?
    /***********************************************
     * Author 	: suwena 
     * Date 	: 9 Juni 2019
     ***********************************************/
session_start();
require_once('config/db_connect.php');
$tahun      = date("Y");
$v_tahun    = $_GET['t'];;
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
        <td style="height: 40px;font-size: 16px;font-weight: bold; text-align: center; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
            LAPORAN KETENAGAAN<br>
            <?php echo $dt_um['u_nama'];?><br>
            <?php echo 'TAHUN '.$v_tahun;?>
        </td>
    </tr>
</table>
<div style="font-size: 13px;font-weight: bold; text-align: left; font-family: 'trebuchet ms', Impact, Arial, Helvetica, sans-serif;">
    <br><br>D. KETENAGAAN
</div>


<table class="list" border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse">
    <thead class="pmi">
    <tr>
        <th align="center" rowspan="2" style="vertical-align: middle;">No</th>
        <th align="center" rowspan="2" style="vertical-align: middle;">Nama</th>
        <th align="center" rowspan="2" style="vertical-align: middle;">Jenis Jabatan</th>
        <th align="center" rowspan="2" style="vertical-align: middle;">Jenis Tenaga</th>
        <th align="center" rowspan="2" style="vertical-align: middle;">Jenis Pendidikan</th>
        <th align="center" colspan="5" style="vertical-align: middle;">Pendidikan</th>
        <th align="center" colspan="3" style="vertical-align: middle;">Status Kepegawaian</th>
        <th align="center" colspan="2" style="vertical-align: middle;;">Pelatihan Tekhnis Pelayanan Darah</th>
    </tr>
    <tr>
        <th align="center" style="vertical-align: middle;">S2</th>
        <th align="center" style="vertical-align: middle;">S1</th>
        <th align="center" style="vertical-align: middle;">D3</th>
        <th align="center" style="vertical-align: middle;">D1</th>
        <th align="center" style="vertical-align: middle;">SMA<a href="#" data-toggle="tooltip" data-placement="top" title="SMA/Sederajat atau dibawahnya"><sup>*)</sup></a></th>
        <th align="center" style="vertical-align: middle;">PNS</th>
        <th align="center" style="vertical-align: middle;">PMI</th>
        <th align="center" style="vertical-align: middle;">Honor</th>
        <th align="center" style="vertical-align: middle;">Ya/<br>Tidak</th>
        <th align="center" style="vertical-align: middle;">Jenis</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $select_query = "SELECT `sdm_id`, `sdm_tahun`, `sdm_id_udd`, `sdm_urutan`,
                                                        `sdm_nama`, `sdm_jbtn`, `sdm_jenis_tng`, `sdm_pendidikan`,
                                                        `sdm_s2`, `sdm_s1`, `sdm_d3`, `sdm_d1`, `sdm_sma`, `sdm_pns`,
                                                        `sdm_pmi`, `sdm_honor`, `sdm_dpt_plthn`, `sdm_plthn`, `sdm_aktif`
                                                        FROM `rpt_data_sdm`
                                                        WHERE
                                                        ( `sdm_nama` like '%$v_src%') OR
                                                        ( `sdm_jbtn` like '%$v_src%') OR
                                                        ( `sdm_jenis_tng` like '%$v_src%') OR
                                                        ( `sdm_pendidikan` like '%$v_src%') OR
                                                        ( `sdm_plthn` like '%$v_src%')

                                                        order BY `sdm_id`
                                                        ";
    $result = mysql_query($select_query);
    $no=0;
    while($row = mysql_fetch_array($result)){
        $no++;
        ?>
        <tr>
            <td nowrap align="right"><?php echo $no;?></td>
            <td nowrap><?php echo $row["sdm_nama"];?></td>
            <td ><?php echo $row["sdm_jbtn"];?></td>
            <td ><?php echo $row["sdm_jenis_tng"];?></td>
            <td ><?php echo $row["sdm_pendidikan"];?></td>
            <td align="center"><?php
                if ($row["sdm_s2"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_s1"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_d3"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_d1"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_sma"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_pns"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_pmi"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_honor"]=='1'){
                    ?> &radic;<?php
                }?>
            </td>
            <td align="center"><?php
                if ($row["sdm_dpt_plthn"]=='1'){
                    echo "Ya";
                } else {echo "Tidak";}?>
            </td>
            <td  style="white-space: pre;"><?php echo $row["sdm_plthn"];?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
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
<? echo "<meta http-equiv='refresh' content='2;url=pmitatausaha.php?module=lap_personalia&t=$v_tahun'";?>
</body>
