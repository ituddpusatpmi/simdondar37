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

<body OnLoad="document.mintadarah1.minta1.focus();">
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
if (!empty($_POST[submit])) {
    $nkt=$_POST[minta1];
    $sq="select distinct `noKantong` , `tglPeriksa` from hasilelisa where `noKantong` like '%$nkt%'
         UNION
        select distinct `noKantong` , `tgl_tes` as tglPeriksa  from drapidtest where `noKantong` like '%$nkt%'";
    $komponen0=mysql_query($sq);
}?>


<color="blue" class="awesomeText"><b>PENCARIAN SAMPLE PEMERIKSAAN</b><br><BR>
<div>
    <form name=mintadarah1 method=post> Masukkan ID Sample : <INPUT type="text"  name="minta1"  size='23' required>
    <input type=submit name=submit value=Submit class="swn_button_blue">
</form></div>

<table  class="list" border=1 cellpadding="3" cellspacing="3" width="500px" style="border-collapse:collapse">
    <tr style="background-color:#FF6346; font-size:14px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<th>No</th>
    <th>Sample ID</th>
	<th>Tanggal<br>Pemeriksaan</th>
	<th>Aksi</th>
	</tr>
<?

$no=1;
while ($komponen=mysql_fetch_assoc($komponen0)) {
    ?>
    <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight';" onMouseOut="this.className='normal';">
	    <td class=input align="right"><?=$no++.'. '?></td>
        <td class=input><?=$komponen[noKantong]?></td>
        <td class=input><?=$komponen[tglPeriksa]?></td>
        <td class=input><a href="pmiimltd.php?module=sample_detail1&sample=<?=$komponen[noKantong]?>">Detil</a></td>
    <?
}
?>
</table>
<br>
<a href="pmiimltd.php?module=import_arc2000"class="swn_button_blue">Kembali ke Awal</a>
