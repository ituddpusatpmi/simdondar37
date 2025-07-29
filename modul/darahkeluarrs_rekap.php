<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d");
$hariini = date("Y-m-d");
?>
<!DOCTYPE html>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<script language=javascript src="util.js" type="text/javascript"> </script>

<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<html>

<style>
    tr { background-color: #ffffff;}
    .initial { background-color: #ffffff; color:#000000 }
    .normal { background-color: #ffffff; }
    .highlight { background-color: #7CFC00 }

    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid brown;
    }

body {font-family: "Lato", sans-serif;}
.tablink {
    background-color: salmon;
    color: #ffffff;
    float: left;
    border: 1px solid brown;
    border-radius: 1px 4px 10px 0px;
    box-shadow: 2px 2px 2px grey;
    outline: 4px;
    cursor: pointer;
    padding: 13px 10px;
    font-size: 15px;
    text-shadow: 1px 1px 2px #DCDCDC;
    width: 25%;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.tablink:hover {
    background-color: darksalmon;
    color: #ffff00;
    text-shadow: 1px 1px 2px white;
}
/* Style the tab content */
.tabcontent {
    color: red;
    display: none;
    padding: 30px 20px 20px 20px;
    border: 2px solid brown;
    box-shadow: 2px 2px 2px grey;
}
#golda {background-color:#ffffff;}
#produk {background-color:white;}
#diagnosa {background-color:white;}
#bagian {background-color:white;}
</style>

</head>
<body>
<?
if (isset($_POST[waktu])) {$tglawal=$_POST[waktu];$hariini=$hariini;}
if ($_POST[waktu1]!='') $hariini=$_POST[waktu1];
$status=$_POST['status'];
$petugas=$_POST['petugas'];
?>
<a name="atas" id="atas"></a>
<div style="background-color: #ffffff;font-size:24px; color:blue;text-shadow: 1px 1px 1px #000000; font-family:Verdana;"><b>REKAP PENGELUARAN DARAH  KE RUMAH SAKIT</b></div><br>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
    <table cellpadding=1 cellspacing="0" border="0">
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <td align="left" nowrap>Tanggal <input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size="10" style="font-family:monospace"></td>
            <td align="right" nowrap>s/d <input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size="10" style="font-family:monospace"></td>
            <td><input type=submit name=submit class="swn_button_blue" value="Tampilkan data">
        </tr>
    </table>
</form>
    <br>
    <button class="tablink" onclick="bukatab('golda', this, 'red')" id="defaultOpen">Per Golongan Darah</button>
    <button class="tablink" onclick="bukatab('produk', this, 'red')">Per Jenis Produk</button>
    <!--button class="tablink" onclick="bukatab('diagnosa', this, 'red')">Per Diagnosa</button-->
    <button class="tablink" onclick="bukatab('bagian', this, 'red')">Per Bagian RS</button>



    <div id="golda" class="tabcontent">
        <br><br><font size="4" color=00008B>Berdasarkan Golongan Darah Pasien</font><br>
        <table border=1 cellpadding=4  style="border-collapse:collapse" >
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th rowspan="2">NO.</th>
                <th rowspan="2">RUMAH SAKIT</th>
                <th colspan="5">RHESUS POS</th>
                <th colspan="5">RHESUS NEG</th>
                <th rowspan="2" width="45px">Gol X</th>
                <th rowspan="2">TOTAL</th>
            </tr>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th width="45px">A</th>
                <th width="45px">B</th>
                <th width="45px">O</th>
                <th width="45px">AB</th>
                <th width="45px">JML</th>
                <th width="45px">A</th>
                <th width="45px">B</th>
                <th width="45px">O</th>
                <th width="45px">AB</th>
                <th width="45px">JML</th>
            </tr>

            <?php
            $sql="SELECT
            r.`NamaRS` as rsnama,
            SUM(CASE WHEN p.`gol_darah`='A' and p.`rhesus`='+' THEN 1 ELSE 0 END) as Apos,
            SUM(CASE WHEN p.`gol_darah`='B' and p.`rhesus`='+' THEN 1 ELSE 0 END) as Bpos,
            SUM(CASE WHEN p.`gol_darah`='O' and p.`rhesus`='+' THEN 1 ELSE 0 END) as Opos,
            SUM(CASE WHEN p.`gol_darah`='AB' and p.`rhesus`='+' THEN 1 ELSE 0 END) as ABpos,
            SUM(CASE WHEN p.`gol_darah`='A' and p.`rhesus`='-' THEN 1 ELSE 0 END) as Aneg,
            SUM(CASE WHEN p.`gol_darah`='B' and p.`rhesus`='-' THEN 1 ELSE 0 END) as Bneg,
            SUM(CASE WHEN p.`gol_darah`='O' and p.`rhesus`='-' THEN 1 ELSE 0 END) as Oneg,
            SUM(CASE WHEN p.`gol_darah`='AB' and p.`rhesus`='-' THEN 1 ELSE 0 END) as ABneg,
            SUM(CASE WHEN p.`gol_darah`='X' THEN 1 ELSE 0 END) as x
            FROM `htranspermintaan` h
            inner join `pasien` p on p.`no_rm`=h.`no_rm`
            inner join `dtransaksipermintaan` d on d.`NoForm`=h.`noform`
            inner join `rmhsakit` r on r.`Kode`=h.`rs`
            WHERE date(d.`tgl_keluar`)>='$tglawal' AND date(d.`tgl_keluar`)<='$hariini'
            AND d.`Status`='0'
            GROUP by r.`NamaRS`";

            $no=0;
            //echo "$sql";
            $qraw=mysql_query($sql);
            $jml_apos=0;$jml_bpos=0;$jml_opos=0;$jml_abpos=0;
            $jml_amin=0;$jml_bmin=0;$jml_omin=0;$jml_abmin=0;
            $jml_x=0;
            $row_rhpos=0;
            $row_rhmin=0;
            $row_ttl=0;
            $ttl_rhpos=0;
            $ttl_rhmin=0;
            while($tmp=mysql_fetch_assoc($qraw)){$no++;
                $jml_x	    = $jml_x + $tmp['x'];
                $jml_apos	= $jml_apos + $tmp['Apos'];
                $jml_bpos	= $jml_bpos + $tmp['Bpos'];
                $jml_opos	= $jml_opos + $tmp['Opos'];
                $jml_abpos	= $jml_abpos + $tmp['ABpos'];
                $jml_amin	= $jml_amin + $tmp['Aneg'];
                $jml_bmin	= $jml_bmin + $tmp['Bneg'];
                $jml_omin	= $jml_omin + $tmp['Oneg'];
                $jml_abmin	= $jml_abmin + $tmp['ABneg'];
                $row_rhpos	= $tmp['Apos'] + $tmp['Bpos'] + $tmp['Opos'] +$tmp['ABpos'];
                $row_rhmin	= $tmp['Aneg'] + $tmp['Bneg'] + $tmp['Oneg'] +$tmp['ABneg'];
                $row_ttl	= $row_rhpos + $row_rhmin + $tmp['x'];
                ?>
                <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?=$no.'.'?></td>
                    <td align="left" nowrap><?=$tmp['rsnama']?></td>
                    <td align="center"><?=$tmp['Apos']?></td>
                    <td align="center"><?=$tmp['Bpos']?></td>
                    <td align="center"><?=$tmp['Opos']?></td>
                    <td align="center"><?=$tmp['ABpos']?></td>
                    <td style="background-color:mistyrose;" align="center"><?=$row_rhpos;?></td>
                    <td align="center"><?=$tmp['Aneg']?></td>
                    <td align="center"><?=$tmp['Bneg']?></td>
                    <td align="center"><?=$tmp['Oneg']?></td>
                    <td align="center"><?=$tmp['ABneg']?></td>
                    <td style="background-color:mistyrose;" align="center"><?=$row_rhmin;?></td>
                    <td align="center"><?=$tmp['x']?></td>
                    <td style="background-color:mistyrose;" align="center"><?=$row_ttl;?></td>
                </tr>
            <?}
            if ($no==0){?>
            <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td colspan=31 align="center">Tidak ada data pengeluaran darah ke Rumah Sakit</td>
                <?}
                $row_rhpos  = $jml_apos + $jml_bpos + $jml_opos + $jml_abpos;
                $row_rhmin  = $jml_amin + $jml_bmin + $jml_omin + $jml_abmin;
                $row_ttl    = $row_rhpos + $row_rhmin + $jml_x;
                ?>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th colspan="2"> TOTAL </th>
                <th> <?=$jml_apos;?> </th>
                <th> <?=$jml_bpos;?> </th>
                <th> <?=$jml_opos;?> </th>
                <th> <?=$jml_abpos;?> </th>
                <th> <?=$row_rhpos;?> </th>
                <th> <?=$jml_amin;?> </th>
                <th> <?=$jml_bmin;?> </th>
                <th> <?=$jml_omin;?> </th>
                <th> <?=$jml_abmin;?> </th>
                <th> <?=$row_rhmin;?> </th>
                <th> <?=$jml_x;?> </th>
                <th> <?=$row_ttl;?> </th>
            </tr>
        </table>

    </div>


    <div id="produk" class="tabcontent">
        <br><br><font size="4" color=00008B>Berdasarkan Jenis Darah/Komponen darah</font><br>
        <table border=1 cellpadding=4  style="border-collapse:collapse" >
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th rowspan="2">NO.</th>
                <th rowspan="2">RUMAH SAKIT</th>
                <th colspan="12">JENIS PRODUK</th>
                <th rowspan="2">TOTAL</th>
            </tr>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th width="45px">PRC</th>
                <th width="45px">TC</th>
                <th width="45px">TC APH</th>
                <th width="45px">AHF</th>
                <th width="45px">FFP</th>
                <th width="45px">WB</th>
                <th width="45px">WE</th>
                <th width="45px">LP</th>
                <th width="45px">FP</th>
                <th width="45px">PRC LD</th>
                <th width="45px">FFP PK</th>
                <th width="45px">LAIN2</th>
            </tr>

            <?php
            $sql="SELECT
                h.`rs` as rskode,
                r.`NamaRS` as rsnama,
                SUM(CASE WHEN d.`produk_darah`='PRC' THEN 1 ELSE  0 END ) as prc,
                SUM(CASE WHEN d.`produk_darah`='AHF' THEN 1 ELSE  0 END ) as ahf,
                SUM(CASE WHEN d.`produk_darah`='FFP' THEN 1 ELSE  0 END ) as ffp,
                SUM(CASE WHEN d.`produk_darah`='FP' THEN 1 ELSE  0 END ) as fp,
                SUM(CASE WHEN d.`produk_darah`='PRC Leucodepleted' THEN 1 ELSE  0 END )as ld,
                SUM(CASE WHEN d.`produk_darah`='FFP Konvalesen' THEN 1 ELSE  0 END )as pk,
                SUM(CASE WHEN d.`produk_darah`='LP' THEN 1 ELSE  0 END ) as lp,
                SUM(CASE WHEN d.`produk_darah`='TC' THEN 1 ELSE  0 END ) as tc,
                SUM(CASE WHEN (d.`produk_darah`='TC Aferesis' or d.`produk_darah`='TC Apheresis' or d.`produk_darah`='TC-APH' ) THEN 1 ELSE  0 END ) as aph,
                SUM(CASE WHEN d.`produk_darah`='WB' THEN 1 ELSE  0 END ) as wb,
                SUM(CASE WHEN (d.`produk_darah`='WE' or d.`produk_darah`='WRC') THEN 1 ELSE  0 END ) as we,
                SUM(CASE WHEN (d.`produk_darah`='--Pilih-' or d.`produk_darah`='' or d.`produk_darah`='PRP') THEN 1 ELSE  0 END ) as ll
                FROM `htranspermintaan` h
                inner join `pasien` p on p.`no_rm`=h.`no_rm`
                inner join `dtransaksipermintaan` d on d.`NoForm`=h.`noform`
                inner join `rmhsakit` r on r.`Kode`=h.`rs`
                WHERE
                DATE(d.`tgl_keluar`)>='$tglawal' and DATE(d.`tgl_keluar`)<='$hariini'
                and d.`Status`='0'
                GROUP by r.`NamaRS`";
            $no=0;
            //echo "$sql";
            $qraw=mysql_query($sql);
            $jml_prc=0;
            $jml_tc=0;
            $jml_tcaph=0;
            $jml_ahf=0;
            $jml_ffp=0;
            $jml_wb=0;
            $jml_we=0;
            $jml_lp=0;
            $jml_fp=0;
            $jml_ld=0;
            $jml_pk=0;
            $jml_ll=0;
            $jml_row=0;
            while($tmp=mysql_fetch_assoc($qraw)){$no++;
                $jml_prc   = $jml_prc + $tmp['prc'];
                $jml_tc    = $jml_tc + $tmp['tc'];
                $jml_tcaph = $jml_tcaph + $tmp['aph'];
                $jml_ahf   = $jml_ahf + $tmp['ahf'];
                $jml_ffp   = $jml_ffp + $tmp['ffp'];
                $jml_wb    = $jml_wb + $tmp['wb'];
                $jml_we    = $jml_we + $tmp['we'];
                $jml_lp    = $jml_lp + $tmp['lp'];
                $jml_fp    = $jml_fp + $tmp['fp'];
                $jml_ld    = $jml_ld + $tmp['ld'];
                $jml_pk    = $jml_pk + $tmp['pk'];
                $jml_ll    = $jml_ll + $tmp['ll'];
                $jml_row   = $tmp['prc']+$tmp['tc']+$tmp['aph']+$tmp['ahf']+$tmp['ffp']+$tmp['wb']+$tmp['we']+$tmp['lp']+$tmp['fp']+$tmp['ld']+$tmp['pk']+$tmp['ll'];;
                ?>
                <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?=$no.'.'?></td>
                    <td align="left" nowrap><?=$tmp['rsnama']?></td>
                    <td align="center"><?=$tmp['prc']?></td>
                    <td align="center"><?=$tmp['tc']?></td>
                    <td align="center"><?=$tmp['aph']?></td>
                    <td align="center"><?=$tmp['ahf']?></td>
                    <td align="center"><?=$tmp['ffp']?></td>
                    <td align="center"><?=$tmp['wb']?></td>
                    <td align="center"><?=$tmp['we']?></td>
                    <td align="center"><?=$tmp['lp']?></td>
                    <td align="center"><?=$tmp['fp']?></td>
                    <td align="center"><?=$tmp['ld']?></td>
                    <td align="center"><?=$tmp['pk']?></td>
                    <td align="center"><?=$tmp['ll']?></td>
                    <td style="background-color:mistyrose;" align="center"><?=$jml_row;?></td>
                </tr>
            <?}
            if ($no==0){?>
            <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td colspan=31 align="center">Tidak ada data pengeluaran darah ke Rumah Sakit</td>
                <?}
                $row_ttl    = $jml_prc + $jml_tc + $jml_tcaph + $jml_ahf + $jml_ffp + $jml_wb + $jml_we + $jml_lp + $jml_fp + $jml_ld + $jml_pk + $jml_ll;
                ?>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th colspan="2"> TOTAL </th>
                <th> <?=$jml_prc;?> </th>
                <th> <?=$jml_tc;?> </th>
                <th> <?=$jml_tcaph;?> </th>
                <th> <?=$jml_ahf;?> </th>
                <th> <?=$jml_ffp;?> </th>
                <th> <?=$jml_wb;?> </th>
                <th> <?=$jml_we;?> </th>
                <th> <?=$jml_lp;?> </th>
                <th> <?=$jml_fp;?> </th>
                <th> <?=$jml_ld;?> </th>
                <th> <?=$jml_pk;?> </th>
                <th> <?=$jml_ll;?> </th>
                <th> <?=$row_ttl;?> </th>
            </tr>
        </table>

    </div>

    <div id="diagnosa" class="tabcontent">
    <br><br><font size="4" color=00008B>Berdasarkan Diagnosa</font><br>
    <table border=1 cellpadding=4  style="border-collapse:collapse" >
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th rowspan="2">NO.</th>
            <th rowspan="2">RUMAH SAKIT</th>
            <th colspan="10">DIAGNOSA</th>
            <th rowspan="2">TOTAL</th>
        </tr>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th>Anemia Kronis</th>
            <th>Cidera/<br> Kecelakaan</th>
            <th>DBD</th>
            <th>Keganasan</th>
            <th>Pendarahan<br>Post Partum</th>
            <th>Pendarahan Lain<br> terkait kehamilan</th>
            <th>Pendarahan<br>Saluran Cerna</th>
            <th>Thalasemia</th>
            <th>CKD (HD)</th>
            <th>LAIN2</th>
        </tr>

        <?php
        $sql="SELECT
                h.`rs` as rskode,
                r.`NamaRS` as rsnama,
                SUM(CASE WHEN (h.`diagnosa`='Anemia Kronis' or h.`diagnosa`='Anemia') THEN 1 ELSE  0 END ) as anemia,
                SUM(CASE WHEN h.`diagnosa`='Cidera / Kecelakaan' THEN 1 ELSE  0 END ) as cidera,
                SUM(CASE WHEN h.`diagnosa`='DBD' THEN 1 ELSE  0 END ) as dbd,
                SUM(CASE WHEN h.`diagnosa`='Keganasan' THEN 1 ELSE  0 END ) as ganas,
                SUM(CASE WHEN h.`diagnosa`='Pendarahan Post Partum' THEN 1 ELSE  0 END ) as postp,
                SUM(CASE WHEN h.`diagnosa`='Pendarahan Lain terkait kehamilan' THEN 1 ELSE  0 END ) as perdl,
                SUM(CASE WHEN h.`diagnosa`='Pendarahan Saluran Cerna' THEN 1 ELSE  0 END ) as perdsc,
                SUM(CASE WHEN h.`diagnosa`='Thalasemia' THEN 1 ELSE  0 END ) as thalesemi,
                SUM(CASE WHEN h.`diagnosa`='Lain - lain' THEN 1 ELSE  0 END ) as ll,
                SUM(CASE WHEN h.`diagnosa`='CKD (HD)' THEN 1 ELSE  0 END ) as ckd
                FROM `htranspermintaan` h
                inner join `pasien` p on p.`no_rm`=h.`no_rm`
                inner join `dtransaksipermintaan` d on d.`NoForm`=h.`noform`
                inner join `rmhsakit` r on r.`Kode`=h.`rs`
                WHERE
                DATE(d.`tgl_keluar`)>='$tglawal' and DATE(d.`tgl_keluar`)<='$hariini'
                and d.`Status`='0'
                GROUP by r.`NamaRS`";
        $no=0;
        //echo "$sql";
        $qraw=mysql_query($sql);
        $jml_anemia=0;
        $jml_cidera=0;
        $jml_dbd=0;
        $jml_ganas=0;
        $jml_postp=0;
        $jml_perdl=0;
        $jml_perdsc=0;
        $jml_thalesemi=0;
        $jml_ll=0;
        $jml_ckd=0;
        $jml_row=0;
        while($tmp=mysql_fetch_assoc($qraw)){$no++;
            $jml_anemia     = $jml_anemia + $tmp['anemia'];
            $jml_cidera     = $jml_cidera + $tmp['cidera'];
            $jml_dbd        = $jml_dbd + $tmp['dbd'];
            $jml_ganas      = $jml_ganas + $tmp['ganas'];
            $jml_postp      = $jml_postp + $tmp['postp'];
            $jml_perdl      = $jml_perdl + $tmp['perdl'];
            $jml_perdsc     = $jml_perdsc + $tmp['perdsc'];
            $jml_thalesemi  = $jml_thalesemi + $tmp['thalesemi'];
            $jml_ckd        = $jml_ckd + $tmp['ckd'];
            $jml_ll         = $jml_ll + $tmp['ll'];
            $jml_row        = $tmp['anemia']+$tmp['cidera']+$tmp['dbd']+$tmp['postp']+$tmp['perdl']+$tmp['perdsc']+$tmp['thalesemi']+$tmp['ckd']+$tmp['ll']+$jml_ganas;
            ?>
            <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td align="right"><?=$no.'.'?></td>
                <td align="left" nowrap><?=$tmp['rsnama']?></td>
                <td align="center"><?=$tmp['anemia']?></td>
                <td align="center"><?=$tmp['cidera']?></td>
                <td align="center"><?=$tmp['dbd']?></td>
                <td align="center"><?=$tmp['ganas']?></td>
                <td align="center"><?=$tmp['postp']?></td>
                <td align="center"><?=$tmp['perdl']?></td>
                <td align="center"><?=$tmp['perdsc']?></td>
                <td align="center"><?=$tmp['thalesemi']?></td>
                <td align="center"><?=$tmp['ckd']?></td>
                <td align="center"><?=$tmp['ll']?></td>
                <td style="background-color:mistyrose;" align="center"><?=$jml_row;?></td>
            </tr>
        <?}
        if ($no==0){?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan=31 align="center">Tidak ada data pengeluaran darah ke Rumah Sakit</td>
            <?}
            $row_ttl    = $jml_anemia+$jml_cidera+$jml_dbd+$jml_postp+$jml_perdl+$jml_perdsc+$jml_thalesemi+$jml_ckd+$jml_ll+$jml_ganas;
            ?>
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th colspan="2"> TOTAL </th>
            <th> <?=$jml_anemia;?> </th>
            <th> <?=$jml_cidera;?> </th>
            <th> <?=$jml_dbd;?> </th>
            <th> <?=$jml_ganas;?> </th>
            <th> <?=$jml_postp;?> </th>
            <th> <?=$jml_perdl;?> </th>
            <th> <?=$jml_perdsc;?> </th>
            <th> <?=$jml_thalesemi;?> </th>
            <th> <?=$jml_ckd;?> </th>
            <th> <?=$jml_ll;?> </th>
            <th> <?=$row_ttl;?> </th>
        </tr>
    </table>

    </div>


    <div id="bagian" class="tabcontent">
        <br><br><font size="4" color=00008B>Berdasarkan Bagian Perawatan</font><br>
        <table border=1 cellpadding=4  style="border-collapse:collapse" >
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th rowspan="2">NO.</th>
                <th rowspan="2">RUMAH SAKIT</th>
                <th colspan="6">BAGIAN</th>
                <th rowspan="2" width="65px">TOTAL</th>
            </tr>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th width="87px">ANAK</th>
                <th width="87px">INTERNA</th>
                <th width="87px">KEBIDANAN</th>
                <th width="87px">BEDAH</th>
                <th width="87px">PARU</th>
                <th width="87px">LAIN2</th>
            </tr>

            <?php
            $sql="SELECT
                h.`rs` as rskode,
                r.`NamaRS` as rsnama,
                SUM(CASE WHEN h.`bagian`='ANAK' THEN 1 ELSE  0 END ) as anak,
                SUM(CASE WHEN h.`bagian`='BEDAH' THEN 1 ELSE  0 END ) as bedah,
                SUM(CASE WHEN h.`bagian`='Dalam' THEN 1 ELSE  0 END ) as interna,
                SUM(CASE WHEN h.`bagian`='Kandungan' THEN 1 ELSE  0 END ) as keb,
                SUM(CASE WHEN h.`bagian`='Paru' THEN 1 ELSE  0 END ) as tht,
                SUM(CASE WHEN h.`bagian`='LAIN-LAIN' THEN 1 ELSE  0 END ) as ll
                FROM `htranspermintaan` h
                inner join `pasien` p on p.`no_rm`=h.`no_rm`
                inner join `dtransaksipermintaan` d on d.`NoForm`=h.`noform`
                inner join `rmhsakit` r on r.`Kode`=h.`rs`WHERE
                DATE(d.`tgl_keluar`)>='$tglawal' and DATE(d.`tgl_keluar`)<='$hariini' AND d.`Status`='0'
                GROUP by r.`NamaRS`";
            $no=0;
            //echo "$sql";
            $qraw=mysql_query($sql);
            $jml_anak=0;
            $jml_bedah=0;
            $jml_interna=0;
            $jml_keb=0;
            $jml_tht=0;
            $jml_ll=0;
            $jml_row=0;
            while($tmp=mysql_fetch_assoc($qraw)){$no++;
                $jml_anak     = $jml_anak + $tmp['anak'];
                $jml_bedah    = $jml_bedah + $tmp['bedah'];
                $jml_interna  = $jml_interna + $tmp['interna'];
                $jml_keb      = $jml_keb + $tmp['keb'];
                $jml_tht      = $jml_tht + $tmp['tht'];
                $jml_ll       = $jml_ll + $tmp['ll'];
                $jml_row      = $tmp['anak']+$tmp['bedah']+$tmp['interna']+$tmp['keb']+$tmp['tht']+$tmp['ll'];
                ?>
                <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td align="right"><?=$no.'.'?></td>
                    <td align="left" nowrap><?=$tmp['rsnama']?></td>
                    <td align="center"><?=$tmp['anak']?></td>
                    <td align="center"><?=$tmp['interna']?></td>
                    <td align="center"><?=$tmp['keb']?></td>
                    <td align="center"><?=$tmp['bedah']?></td>
                    <td align="center"><?=$tmp['tht']?></td>
                    <td align="center"><?=$tmp['ll']?></td>
                    <td style="background-color:mistyrose;" align="center"><?=$jml_row;?></td>
                </tr>
            <?}
            if ($no==0){?>
            <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td colspan=31 align="center">Tidak ada data pengeluaran darah ke Rumah Sakit ke Rumah Sakit</td>
                <?}
                $row_ttl    = $jml_anak + $jml_bedah + $jml_interna + $jml_keb + $jml_tht + $jml_ll;
                ?>
            <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
                <th colspan="2"> TOTAL </th>
                <th> <?=$jml_anak;?> </th>
                <th> <?=$jml_interna;?> </th>
                <th> <?=$jml_keb;?> </th>
                <th> <?=$jml_bedah;?> </th>
                <th> <?=$jml_tht;?> </th>
                <th> <?=$jml_ll;?> </th>
                <th> <?=$row_ttl;?> </th>
            </tr>
        </table>

    </div>
    <br><div style="font-size: 10px;color: #ff0000;text-shadow: 0px 0px 1px #000000;">Update 2018-12-31</div>

<script>
function bukatab(namatab,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(namatab).style.display = "block";
    elmnt.style.backgroundColor = color;
}
document.getElementById("defaultOpen").click();
</script>
</body>
</html>
