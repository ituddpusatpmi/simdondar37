<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style>
    .awesomeText {
        color: #000;
        font-size: 150%;
    }
</style>
<style type="text/css">
    @import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
    .normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>

<body OnLoad="document.sample_id.sample.focus();">
<?
include('config/db_connect.php');
$mode="0";
if (!empty($_POST['submit'])) {
    $mode="1";
    $nkt=$_POST['sample'];
    $sqa="SELECT `id`, `sample_id`, `runtime`, `operator`,`on_insert` FROM `qwalys_abs_raw` WHERE `sample_id` like '%$nkt%'";
    $abs=mysql_query($sqa);
    $sqb="SELECT `id`, `sample_id`, `runtime`, `operator`, `on_insert` FROM `qwalys_abd_raw` WHERE `sample_id` like '%$nkt%'";
    $abd=mysql_query($sqb);
}?>

<a name="atas" id="atas"></a>
<div style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Pencarian Data Pemeriksaan Qwalys<sup>&reg</sup> 3</div>

    <form name=sample_id method=post class="awesomeText"> Masukkan ID Sample :<br> <INPUT type="text" name="sample" required autofocus>
    <input type=submit name=submit value=Submit class="swn_button_blue">
    <a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali</a>
</form>

<?
if ($mode=="1"){
    $jmlrow=mysql_fetch_row($abs);
    $jmlrow1=mysql_fetch_row($abd);
    if (($jmlrow>0) or ($jmlrow1>0)){?>
        <table  class="list" border=1 cellpadding="5" cellspacing="5" style="border-collapse:collapse">
            <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	            <th>No</th>
                <th>Sample ID</th>
	            <th>Tanggal<br>Pemeriksaan</th>
                <th>Tanggal<br>Konfirmasi</th>
                <th>Parameter</th>
	            <th>Aksi</th>
	        </tr>
        <?
        $no=1;
        $abs=mysql_query($sqa);
        while ($absdata=mysql_fetch_assoc($abs)) {
            ?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
	            <td class=input align="right"><?=$no++.'. '?></td>
                <td class=input><?=$absdata['sample_id']?></td>
                <td class=input><?=$absdata['runtime']?></td>
                <td class=input><?=$absdata['on_insert']?></td>
                <td class=input>Antibody Screening</td>
                <td class=input><a href="pmikonfirmasi.php?module=sample_detail_abs&sample=<?=$absdata[sample_id]?>&tgl=<?=$absdata[runtime]?>">Detil</a></td>
            </tr>
            <?
        }
        $jmlrow1=mysql_fetch_row(mysql_query($sqb));
        if ($jmlrow1>0){
            $abd=mysql_query($sqb);
            while ($abddata=mysql_fetch_assoc($abd)) { ?>
                <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
                    <td class=input align="right"><?=$no++.'. '?></td>
                    <td class=input><?=$abddata['sample_id']?></td>
                    <td class=input><?=$abddata['runtime']?></td>
                    <td class=input><?=$abddata['on_insert']?></td>
                    <td class=input>ABD Grouping</td>
                    <td class=input><a href="pmikonfirmasi.php?module=sample_detail_abd&sample=<?=$abddata[sample_id]?>&tgl=<?=$abddata[runtime]?>">Detil</a></td>
                </tr>
            <?
             }
        }
        ?>
        </table>
        <?
        if ($no>25){
            ?><a href="#atas" class="swn_button_blue">Ke Atas</a><a name="bawah" id="bawah"><?
        }
    } else {
        echo "<div style='font-size: 15px; color: #ff0000'>Sample<b> $nkt</b> tidak ditemukan</div>";
    }
}
?>
<br>

