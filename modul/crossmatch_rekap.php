<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser   = $_SESSION['namauser'];
$namalengkap= $_SESSION['nama_lengkap'];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal    = date("Y-m-d");
$hariini    = date("Y-m-d");

if (isset($_POST['tgl1'])) {$tglawal=$_POST['tgl1'];$hariini=$hariini;}
if ($_POST['tgl2']!='') {$hariini=$_POST['tgl2'];}
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
<div style="background-color: #ffffff;font-size:24px; color:blue;text-shadow: 1px 1px 1px #000000; font-family:Verdana;"><b>REKAP HASIL UJI SILANG SERASI/<i>CROSSMATCH</i></b></div><br>
<form name=flt_tgl method=post>
    <table>
        <tr style="font-size:14px; background-color: ghostwhite;">
            <td>Dari tanggal</td><td><input type=text name=tgl1 id=datepicker size=10 value="<?=$tglawal?>"></td>
            <td>sampai tanggal</td><td><input type=text name=tgl2 id=datepicker1 size=10 value="<?=$hariini?>"></td>
            <td><input type="submit" name="submit" value="Tampikan data" class="swn_button_blue"></td>
        </tr>
    </table>
</form>
<br>
<button class="tablink" onclick="bukatab('golda', this, 'red')" id="defaultOpen">Per Golongan Darah</button>
<button class="tablink" onclick="bukatab('produk', this, 'red')">Per Jenis Produk</button>

<div id="golda" class="tabcontent">
<br><br>
<?
$q_gol="SELECT `MetodeCross`,
        SUM(CASE WHEN `gol_darah`='A' and `rh_darah`='+' THEN 1 ELSE 0 END) as Apos,
        SUM(CASE WHEN `gol_darah`='B' and `rh_darah`='+' THEN 1 ELSE 0 END) as Bpos,
        SUM(CASE WHEN `gol_darah`='O' and `rh_darah`='+' THEN 1 ELSE 0 END) as Opos,
        SUM(CASE WHEN `gol_darah`='AB' and `rh_darah`='+' THEN 1 ELSE 0 END) as ABpos,
        SUM(CASE WHEN `gol_darah`='A' and `rh_darah`='-' THEN 1 ELSE 0 END) as Aneg,
        SUM(CASE WHEN `gol_darah`='B' and `rh_darah`='-' THEN 1 ELSE 0 END) as Bneg,
        SUM(CASE WHEN `gol_darah`='O' and `rh_darah`='-' THEN 1 ELSE 0 END) as Oneg,
        SUM(CASE WHEN `gol_darah`='AB' and `rh_darah`='-' THEN 1 ELSE 0 END) as ABneg,
        SUM(CASE WHEN `gol_darah`='X' THEN 1 ELSE 0 END) as x
        FROM `dtransaksipermintaan`
        WHERE
        Date(`tgl`)>='$tglawal' and Date(`tgl`)<='$hariini'
        Group by `MetodeCross`";
?>
<br><font size="4" color=00008B>METODE PEMERIKSAAN UJI SILANG SERASI/<i>CROSSMATCH</i></font>
<table border=1 cellpadding=4  style="border-collapse:collapse" >
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th rowspan="2">NO.</th>
        <th rowspan="2" width="300px">METODE PEMERIKSAAN</th>
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
    <?
    $no=0;
    $jml_apos=0;$jml_bpos=0;$jml_opos=0;$jml_abpos=0;
    $jml_aneg=0;$jml_bneg=0;$jml_oneg=0;$jml_abneg=0;
    $jml_x=0;
    $jml_pos=0;$jml_neg=0;
    $jml_ttl=0;
    $qraw=mysql_query($q_gol);
    while($tmp=mysql_fetch_assoc($qraw)){
        $no++;
        $jml_apos  = $jml_apos + $tmp['Apos'];
        $jml_bpos  = $jml_bpos + $tmp['Bpos'];
        $jml_opos  = $jml_opos + $tmp['Opos'];
        $jml_abpos = $jml_abpos + $tmp['ABpos'];
        $jml_pos   = $tmp['Apos'] + $tmp['Bpos'] +$tmp['Opos'] +$tmp['ABpos'];
        $jml_aneg  = $jml_aneg + $tmp['Aneg'];
        $jml_bneg  = $jml_bneg + $tmp['Bneg'];
        $jml_oneg  = $jml_oneg + $tmp['Oneg'];
        $jml_abneg = $jml_abneg + $tmp['ABneg'];
        $jml_neg   = $tmp['Aneg'] + $tmp['Bneg'] +$tmp['Oneg'] +$tmp['ABneg'];
        $jml_ttl   = $jml_neg + $jml_pos + $tmp['x'];
        $jml_x     = $jml_x +  $tmp['x'];
        ?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td align="right"><?=$no.'.'?></td>
        <td align="left" nowrap><?=$tmp['MetodeCross']?></td>
        <td align="center"><?=$tmp['Apos']?></td>
        <td align="center"><?=$tmp['Bpos']?></td>
        <td align="center"><?=$tmp['Opos']?></td>
        <td align="center"><?=$tmp['ABpos']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_pos;?></td>
        <td align="center"><?=$tmp['Aneg']?></td>
        <td align="center"><?=$tmp['Bneg']?></td>
        <td align="center"><?=$tmp['Oneg']?></td>
        <td align="center"><?=$tmp['ABneg']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_neg;?></td>
        <td align="center"><?=$tmp['x']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_ttl;?></td>
        </tr><?
    }
    if ($no==0){?>
    <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td colspan=31 align="center">Tidak ada data uji silang serasi/crossmatch</td>
        <?}
        $jml_pos    = $jml_apos + $jml_bpos + $jml_opos + $jml_abpos;
        $jml_neg    = $jml_aneg + $jml_bneg + $jml_oneg + $jml_abneg;
        $jml_ttl    = $jml_pos + $jml_neg+$jml_x;
        ?>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th colspan="2"> TOTAL </th>
        <th> <?=$jml_apos;?> </th>
        <th> <?=$jml_bpos;?> </th>
        <th> <?=$jml_opos;?> </th>
        <th> <?=$jml_abpos;?> </th>
        <th> <?=$jml_pos;?> </th>
        <th> <?=$jml_aneg;?> </th>
        <th> <?=$jml_bneg;?> </th>
        <th> <?=$jml_oneg;?> </th>
        <th> <?=$jml_abneg;?> </th>
        <th> <?=$jml_neg;?> </th>
        <th> <?=$jml_x;?> </th>
        <th> <?=$jml_ttl;?> </th>
    </tr>
</table>

<?
$q_gol="SELECT `stat2`,
        SUM(CASE WHEN `gol_darah`='A' and `rh_darah`='+' THEN 1 ELSE 0 END) as Apos,
        SUM(CASE WHEN `gol_darah`='B' and `rh_darah`='+' THEN 1 ELSE 0 END) as Bpos,
        SUM(CASE WHEN `gol_darah`='O' and `rh_darah`='+' THEN 1 ELSE 0 END) as Opos,
        SUM(CASE WHEN `gol_darah`='AB' and `rh_darah`='+' THEN 1 ELSE 0 END) as ABpos,
        SUM(CASE WHEN `gol_darah`='A' and `rh_darah`='-' THEN 1 ELSE 0 END) as Aneg,
        SUM(CASE WHEN `gol_darah`='B' and `rh_darah`='-' THEN 1 ELSE 0 END) as Bneg,
        SUM(CASE WHEN `gol_darah`='O' and `rh_darah`='-' THEN 1 ELSE 0 END) as Oneg,
        SUM(CASE WHEN `gol_darah`='AB' and `rh_darah`='-' THEN 1 ELSE 0 END) as ABneg,
        SUM(CASE WHEN `gol_darah`='X' THEN 1 ELSE 0 END) as x
        FROM `dtransaksipermintaan`
        WHERE
        Date(`tgl`)>='$tglawal' and Date(`tgl`)<='$hariini'
        Group by `stat2`";
?>
<br><font size="4" color=00008B>HASIL PEMERIKSAAN UJI SILANG SERASI/<i>CROSSMATCH</i></font>
<table border=1 cellpadding=4  style="border-collapse:collapse" >
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th rowspan="2">NO.</th>
        <th rowspan="2" width="300px">HASIL UJI SILANG SERASI</th>
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
    <?
    $no=0;
    $jml_apos=0;$jml_bpos=0;$jml_opos=0;$jml_abpos=0;
    $jml_aneg=0;$jml_bneg=0;$jml_oneg=0;$jml_abneg=0;
    $jml_x=0;
    $jml_pos=0;$jml_neg=0;
    $jml_ttl=0;
    $qraw=mysql_query($q_gol);
    while($tmp=mysql_fetch_assoc($qraw)){
        $no++;
        $jml_apos  = $jml_apos + $tmp['Apos'];
        $jml_bpos  = $jml_bpos + $tmp['Bpos'];
        $jml_opos  = $jml_opos + $tmp['Opos'];
        $jml_abpos = $jml_abpos + $tmp['ABpos'];
        $jml_pos   = $tmp['Apos'] + $tmp['Bpos'] +$tmp['Opos'] +$tmp['ABpos'];
        $jml_aneg  = $jml_aneg + $tmp['Aneg'];
        $jml_bneg  = $jml_bneg + $tmp['Bneg'];
        $jml_oneg  = $jml_oneg + $tmp['Oneg'];
        $jml_abneg = $jml_abneg + $tmp['ABneg'];
        $jml_neg   = $tmp['Aneg'] + $tmp['Bneg'] +$tmp['Oneg'] +$tmp['ABneg'];
        $jml_ttl   = $jml_neg + $jml_pos + $tmp['x'];
        $jml_x     = $jml_x +  $tmp['x'];
        ?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td align="right"><?=$no.'.'?></td>
        <td align="left" nowrap><?=$tmp['stat2']?></td>
        <td align="center"><?=$tmp['Apos']?></td>
        <td align="center"><?=$tmp['Bpos']?></td>
        <td align="center"><?=$tmp['Opos']?></td>
        <td align="center"><?=$tmp['ABpos']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_pos;?></td>
        <td align="center"><?=$tmp['Aneg']?></td>
        <td align="center"><?=$tmp['Bneg']?></td>
        <td align="center"><?=$tmp['Oneg']?></td>
        <td align="center"><?=$tmp['ABneg']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_neg;?></td>
        <td align="center"><?=$tmp['x']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_ttl;?></td>
        </tr><?
    }
    if ($no==0){?>
    <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td colspan=31 align="center">Tidak ada data uji silang serasi/crossmatch</td>
        <?}
        $jml_pos    = $jml_apos + $jml_bpos + $jml_opos + $jml_abpos;
        $jml_neg    = $jml_aneg + $jml_bneg + $jml_oneg + $jml_abneg;
        $jml_ttl    = $jml_pos + $jml_neg+$jml_x;
        ?>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th colspan="2"> TOTAL </th>
        <th> <?=$jml_apos;?> </th>
        <th> <?=$jml_bpos;?> </th>
        <th> <?=$jml_opos;?> </th>
        <th> <?=$jml_abpos;?> </th>
        <th> <?=$jml_pos;?> </th>
        <th> <?=$jml_aneg;?> </th>
        <th> <?=$jml_bneg;?> </th>
        <th> <?=$jml_oneg;?> </th>
        <th> <?=$jml_abneg;?> </th>
        <th> <?=$jml_neg;?> </th>
        <th> <?=$jml_x;?> </th>
        <th> <?=$jml_ttl;?> </th>
    </tr>
</table>

<?
$q_gol="SELECT CASE
        WHEN `StatusCross`='1' THEN 'Compatible'
        WHEN `StatusCross`='0' THEN 'Incompatible Boleh Keluar'
        WHEN `StatusCross`='2' THEN 'Incompatible tdk Boleh Keluar'
        END AS `StatusCross`,
        SUM(CASE WHEN `gol_darah`='A' and `rh_darah`='+' THEN 1 ELSE 0 END) as Apos,
        SUM(CASE WHEN `gol_darah`='B' and `rh_darah`='+' THEN 1 ELSE 0 END) as Bpos,
        SUM(CASE WHEN `gol_darah`='O' and `rh_darah`='+' THEN 1 ELSE 0 END) as Opos,
        SUM(CASE WHEN `gol_darah`='AB' and `rh_darah`='+' THEN 1 ELSE 0 END) as ABpos,
        SUM(CASE WHEN `gol_darah`='A' and `rh_darah`='-' THEN 1 ELSE 0 END) as Aneg,
        SUM(CASE WHEN `gol_darah`='B' and `rh_darah`='-' THEN 1 ELSE 0 END) as Bneg,
        SUM(CASE WHEN `gol_darah`='O' and `rh_darah`='-' THEN 1 ELSE 0 END) as Oneg,
        SUM(CASE WHEN `gol_darah`='AB' and `rh_darah`='-' THEN 1 ELSE 0 END) as ABneg,
        SUM(CASE WHEN `gol_darah`='X' THEN 1 ELSE 0 END) as x
        FROM `dtransaksipermintaan`
        WHERE
        Date(`tgl`)>='$tglawal' and Date(`tgl`)<='$hariini'
        Group by `StatusCross`";
?>
<br><font size="4" color=00008B>KESIMPULAN HASIL UJI SILANG SERASI/<i>CROSSMATCH</i></font>
<table border=1 cellpadding=4  style="border-collapse:collapse" >
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th rowspan="2">NO.</th>
        <th rowspan="2" width="300px">HASIL UJI SILANG SERASI</th>
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
    <?
    $no=0;
    $jml_apos=0;$jml_bpos=0;$jml_opos=0;$jml_abpos=0;
    $jml_aneg=0;$jml_bneg=0;$jml_oneg=0;$jml_abneg=0;
    $jml_x=0;
    $jml_pos=0;$jml_neg=0;
    $jml_ttl=0;
    $qraw=mysql_query($q_gol);
    while($tmp=mysql_fetch_assoc($qraw)){
        $no++;
        $jml_apos  = $jml_apos + $tmp['Apos'];
        $jml_bpos  = $jml_bpos + $tmp['Bpos'];
        $jml_opos  = $jml_opos + $tmp['Opos'];
        $jml_abpos = $jml_abpos + $tmp['ABpos'];
        $jml_pos   = $tmp['Apos'] + $tmp['Bpos'] +$tmp['Opos'] +$tmp['ABpos'];
        $jml_aneg  = $jml_aneg + $tmp['Aneg'];
        $jml_bneg  = $jml_bneg + $tmp['Bneg'];
        $jml_oneg  = $jml_oneg + $tmp['Oneg'];
        $jml_abneg = $jml_abneg + $tmp['ABneg'];
        $jml_neg   = $tmp['Aneg'] + $tmp['Bneg'] +$tmp['Oneg'] +$tmp['ABneg'];
        $jml_ttl   = $jml_neg + $jml_pos + $tmp['x'];
        $jml_x     = $jml_x +  $tmp['x'];
        ?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td align="right"><?=$no.'.'?></td>
        <td align="left" nowrap><?=$tmp['StatusCross']?></td>
        <td align="center"><?=$tmp['Apos']?></td>
        <td align="center"><?=$tmp['Bpos']?></td>
        <td align="center"><?=$tmp['Opos']?></td>
        <td align="center"><?=$tmp['ABpos']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_pos;?></td>
        <td align="center"><?=$tmp['Aneg']?></td>
        <td align="center"><?=$tmp['Bneg']?></td>
        <td align="center"><?=$tmp['Oneg']?></td>
        <td align="center"><?=$tmp['ABneg']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_neg;?></td>
        <td align="center"><?=$tmp['x']?></td>
        <td style="background-color:mistyrose;" align="center"><?=$jml_ttl;?></td>
        </tr><?
    }
    if ($no==0){?>
    <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        <td colspan=31 align="center">Tidak ada data uji silang serasi/crossmatch</td>
        <?}
        $jml_pos    = $jml_apos + $jml_bpos + $jml_opos + $jml_abpos;
        $jml_neg    = $jml_aneg + $jml_bneg + $jml_oneg + $jml_abneg;
        $jml_ttl    = $jml_pos + $jml_neg+$jml_x;
        ?>
    <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
        <th colspan="2"> TOTAL </th>
        <th> <?=$jml_apos;?> </th>
        <th> <?=$jml_bpos;?> </th>
        <th> <?=$jml_opos;?> </th>
        <th> <?=$jml_abpos;?> </th>
        <th> <?=$jml_pos;?> </th>
        <th> <?=$jml_aneg;?> </th>
        <th> <?=$jml_bneg;?> </th>
        <th> <?=$jml_oneg;?> </th>
        <th> <?=$jml_abneg;?> </th>
        <th> <?=$jml_neg;?> </th>
        <th> <?=$jml_x;?> </th>
        <th> <?=$jml_ttl;?> </th>
    </tr>
</table>
</div>

<div id="produk" class="tabcontent">
    <br><br><br><font size="4" color=00008B>METODE PEMERIKSAAN UJI SILANG SERASI/<i>CROSSMATCH</i></font>
    <table border=1 cellpadding=4  style="border-collapse:collapse" >
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th rowspan="2">NO.</th>
            <th rowspan="2" width="300px">NAMA METODE</th>
            <th colspan="11">JENIS PRODUK</th>
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
            <th width="45px">LAIN2</th>
        </tr>

        <?php
        $sql="SELECT
                `MetodeCross`,
                SUM(CASE WHEN `produk_darah`='PRC' THEN 1 ELSE  0 END ) as prc,
                SUM(CASE WHEN `produk_darah`='AHF' THEN 1 ELSE  0 END ) as ahf,
                SUM(CASE WHEN `produk_darah`='FFP' THEN 1 ELSE  0 END ) as ffp,
                SUM(CASE WHEN `produk_darah`='FP' THEN 1 ELSE  0 END ) as fp,
                SUM(CASE WHEN `produk_darah`='Leucodepleted' THEN 1 ELSE  0 END )as ld,
                SUM(CASE WHEN `produk_darah`='LP' THEN 1 ELSE  0 END ) as lp,
                SUM(CASE WHEN `produk_darah`='TC' THEN 1 ELSE  0 END ) as tc,
                SUM(CASE WHEN (`produk_darah`='TC Aferesis' or `produk_darah`='TC Apheresis' or `produk_darah`='TC-APH' ) THEN 1 ELSE  0 END ) as aph,
                SUM(CASE WHEN `produk_darah`='WB' THEN 1 ELSE  0 END ) as wb,
                SUM(CASE WHEN (`produk_darah`='WE' or `produk_darah`='WRC') THEN 1 ELSE  0 END ) as we,
                SUM(CASE WHEN (`produk_darah`='--Pilih-' or `produk_darah`='' or `produk_darah`='PRP') THEN 1 ELSE  0 END ) as ll
                FROM `dtransaksipermintaan`
                WHERE
                Date(`tgl`)>='$tglawal' and Date(`tgl`)<='$hariini'
                Group by `MetodeCross`";
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
            $jml_ll    = $jml_ll + $tmp['ll'];
            $jml_row   = $tmp['prc']+$tmp['tc']+$tmp['aph']+$tmp['ahf']+$tmp['ffp']+$tmp['wb']+$tmp['we']+$tmp['lp']+$tmp['fp']+$tmp['ld']+$tmp['ll'];;
            ?>
            <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td align="right"><?=$no.'.'?></td>
                <td align="left" nowrap><?=$tmp['MetodeCross']?></td>
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
                <td align="center"><?=$tmp['ll']?></td>
                <td style="background-color:mistyrose;" align="center"><?=$jml_row;?></td>
            </tr>
        <?}
        if ($no==0){?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan=31 align="center">Tidak ada data uji silang serasi/crossmatch</td>
            <?}
            $row_ttl    = $jml_prc + $jml_tc + $jml_tcaph + $jml_ahf + $jml_ffp + $jml_wb + $jml_we + $jml_lp + $jml_fp + $jml_ld + $jml_ll;
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
            <th> <?=$jml_ll;?> </th>
            <th> <?=$row_ttl;?> </th>
        </tr>
    </table>

    <br><font size="4" color=00008B>HASIL PEMERIKSAAN UJI SILANG SERASI/<i>CROSSMATCH</i></font>
    <table border=1 cellpadding=4  style="border-collapse:collapse" >
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th rowspan="2">NO.</th>
            <th rowspan="2" width="300px">HASIL PEMERIKSAAN</th>
            <th colspan="11">JENIS PRODUK</th>
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
            <th width="45px">LAIN2</th>
        </tr>

        <?php
        $sql="SELECT
                `stat2`,
                SUM(CASE WHEN `produk_darah`='PRC' THEN 1 ELSE  0 END ) as prc,
                SUM(CASE WHEN `produk_darah`='AHF' THEN 1 ELSE  0 END ) as ahf,
                SUM(CASE WHEN `produk_darah`='FFP' THEN 1 ELSE  0 END ) as ffp,
                SUM(CASE WHEN `produk_darah`='FP' THEN 1 ELSE  0 END ) as fp,
                SUM(CASE WHEN `produk_darah`='Leucodepleted' THEN 1 ELSE  0 END )as ld,
                SUM(CASE WHEN `produk_darah`='LP' THEN 1 ELSE  0 END ) as lp,
                SUM(CASE WHEN `produk_darah`='TC' THEN 1 ELSE  0 END ) as tc,
                SUM(CASE WHEN (`produk_darah`='TC Aferesis' or `produk_darah`='TC Apheresis' or `produk_darah`='TC-APH' ) THEN 1 ELSE  0 END ) as aph,
                SUM(CASE WHEN `produk_darah`='WB' THEN 1 ELSE  0 END ) as wb,
                SUM(CASE WHEN (`produk_darah`='WE' or `produk_darah`='WRC') THEN 1 ELSE  0 END ) as we,
                SUM(CASE WHEN (`produk_darah`='--Pilih-' or `produk_darah`='' or `produk_darah`='PRP') THEN 1 ELSE  0 END ) as ll
                FROM `dtransaksipermintaan`
                WHERE
                Date(`tgl`)>='$tglawal' and Date(`tgl`)<='$hariini'
                Group by `stat2`";
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
            $jml_ll    = $jml_ll + $tmp['ll'];
            $jml_row   = $tmp['prc']+$tmp['tc']+$tmp['aph']+$tmp['ahf']+$tmp['ffp']+$tmp['wb']+$tmp['we']+$tmp['lp']+$tmp['fp']+$tmp['ld']+$tmp['ll'];;
            ?>
            <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td align="right"><?=$no.'.'?></td>
                <td align="left" nowrap><?=$tmp['stat2']?></td>
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
                <td align="center"><?=$tmp['ll']?></td>
                <td style="background-color:mistyrose;" align="center"><?=$jml_row;?></td>
            </tr>
        <?}
        if ($no==0){?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan=31 align="center">Tidak ada data uji silang serasi/crossmatch</td>
            <?}
            $row_ttl    = $jml_prc + $jml_tc + $jml_tcaph + $jml_ahf + $jml_ffp + $jml_wb + $jml_we + $jml_lp + $jml_fp + $jml_ld + $jml_ll;
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
            <th> <?=$jml_ll;?> </th>
            <th> <?=$row_ttl;?> </th>
        </tr>
    </table>

    <br><font size="4" color=00008B>KESIMPULAN HASIL UJI SILANG SERASI/<i>CROSSMATCH</i></font>
    <table border=1 cellpadding=4  style="border-collapse:collapse" >
        <tr style="background-color:mistyrose; font-size:12px; color:#000000;">
            <th rowspan="2">NO.</th>
            <th rowspan="2" width="300px">KESIMPULAN HASIL</th>
            <th colspan="11">JENIS PRODUK</th>
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
            <th width="45px">LAIN2</th>
        </tr>

        <?php
        $sql="SELECT
                CASE
                WHEN `StatusCross`='1' THEN 'Compatible'
                WHEN `StatusCross`='0' THEN 'Incompatible Boleh Keluar'
                WHEN `StatusCross`='2' THEN 'Incompatible tdk Boleh Keluar'
                END AS `StatusCross`,
                SUM(CASE WHEN `produk_darah`='PRC' THEN 1 ELSE  0 END ) as prc,
                SUM(CASE WHEN `produk_darah`='AHF' THEN 1 ELSE  0 END ) as ahf,
                SUM(CASE WHEN `produk_darah`='FFP' THEN 1 ELSE  0 END ) as ffp,
                SUM(CASE WHEN `produk_darah`='FP' THEN 1 ELSE  0 END ) as fp,
                SUM(CASE WHEN `produk_darah`='Leucodepleted' THEN 1 ELSE  0 END )as ld,
                SUM(CASE WHEN `produk_darah`='LP' THEN 1 ELSE  0 END ) as lp,
                SUM(CASE WHEN `produk_darah`='TC' THEN 1 ELSE  0 END ) as tc,
                SUM(CASE WHEN (`produk_darah`='TC Aferesis' or `produk_darah`='TC Apheresis' or `produk_darah`='TC-APH' ) THEN 1 ELSE  0 END ) as aph,
                SUM(CASE WHEN `produk_darah`='WB' THEN 1 ELSE  0 END ) as wb,
                SUM(CASE WHEN (`produk_darah`='WE' or `produk_darah`='WRC') THEN 1 ELSE  0 END ) as we,
                SUM(CASE WHEN (`produk_darah`='--Pilih-' or `produk_darah`='' or `produk_darah`='PRP') THEN 1 ELSE  0 END ) as ll
                FROM `dtransaksipermintaan`
                WHERE
                Date(`tgl`)>='$tglawal' and Date(`tgl`)<='$hariini'
                Group by `StatusCross`";
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
            $jml_ll    = $jml_ll + $tmp['ll'];
            $jml_row   = $tmp['prc']+$tmp['tc']+$tmp['aph']+$tmp['ahf']+$tmp['ffp']+$tmp['wb']+$tmp['we']+$tmp['lp']+$tmp['fp']+$tmp['ld']+$tmp['ll'];;
            ?>
            <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td align="right"><?=$no.'.'?></td>
                <td align="left" nowrap><?=$tmp['StatusCross']?></td>
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
                <td align="center"><?=$tmp['ll']?></td>
                <td style="background-color:mistyrose;" align="center"><?=$jml_row;?></td>
            </tr>
        <?}
        if ($no==0){?>
        <tr style="font-size:14px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
            <td colspan=31 align="center">Tidak ada data uji silang serasi/crossmatch</td>
            <?}
            $row_ttl    = $jml_prc + $jml_tc + $jml_tcaph + $jml_ahf + $jml_ffp + $jml_wb + $jml_we + $jml_lp + $jml_fp + $jml_ld + $jml_ll;
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
            <th> <?=$jml_ll;?> </th>
            <th> <?=$row_ttl;?> </th>
        </tr>
    </table>
</div>
<br>
<div style="font-size: 10px;color: #ff0000;text-shadow: 0px 0px 1px #000000;">Update 2018-12-31</div>
</body>


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
