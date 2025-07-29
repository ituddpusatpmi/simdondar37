<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style>
    tr { background-color: #FDF5E6}
    .initial { background-color: #FDF5E6; color:#000000 }
    .normal { background-color: #FDF5E6 }
    .highlight { background-color: #7FFF00 }
</style>
<?php

require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
?>


<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
$src_rs="";
$src_lay="";
$src_shift="";
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
if ($_POST[produk]!='') $src_produk=$_POST[produk];
if ($_POST[status]!='') $src_status=$_POST[status];
if ($_POST[golongan]!='') $src_golongan=$_POST[golongan];
if ($_POST[rhesus]!='') $src_rhesus=$_POST[rhesus];
if ($_POST[utd]!='') $src_utd=$_POST[utd];


?>
<a name="atas"></a>
<h2>RINCIAN PENERIMAAN SAMPLE QC PRODUK KOMPONEN DARAH</h2>
<form method=post> Mulai: TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>><br>
    
    PRODUK
    <select name="produk">
            <option value="" selected>- SEMUA -</option>
            <option value="WB">WB</option>
            <option value="PRC">PRC</option>
            <option value="TC">TC</option>
            <option value="FFP">FFP</option>
	    <option value="AHF">AHF</option>
	    <option value="TC Aferesis">TC Aferesis</option>
    </select>
    GOL Darah
        <select name="golongan">
            <option value="" selected>- SEMUA -</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="O">O</option>
            <option value="AB">AB</option>
        </select>
    Rh Darah
        <select name="rhesus">
            <option value="" selected>- SEMUA -</option>
            <option value="+">Positif</option>
            <option value="-">Negatif</option>
        </select>
    Asal Sampel
    <select name="utd">
        <option value="" selected>-SEMUA-</option>
            <?php
            $ql= mysql_query("select * from utd order by daerah ASC");
            while ($rowl1 = mysql_fetch_array($ql)){
                echo "<option value='$rowl1[id]'>$rowl1[nama]</option>";
            }
            ?>
            
    </select>
   
    <input type="submit" name="submit" value="Tampilkan data" class="swn_button_blue">
</form>

<form name=xls method=post action=QC/rekap_register_xls.php>
    <input type=hidden name=today value='<?=$today?>'>
    <input type=hidden name=today1 value='<?=$today1?>'>
    <input type=hidden name=bdrs value='<?=$src_bdrs?>'>
    <input type=hidden name=produk value='<?=$src_produk?>'>
    <input type=hidden name=status value='<?=$src_status?>'>
    <input type=hidden name=golongan value='<?=$src_golongan?>'>
    <input type=hidden name=rhesus value='<?=$src_rhesus?>'>
    <input type=hidden name=utd value='<?=$src_utd?>'>
    <input type=submit name=submit2 class="swn_button_blue" value='Print Rekap Penerimaan Sample QC'>

    
</form>


<?
$transaksipermintaan=mysql_query("select k.nokantong,k.goldarah,k.rhesus,k.produk,k.tglaftap,k.kadaluwarsa,k.tgl,k.petugas_terima,k.petugas_serah,k.asal_utd from stokkantong as s, registrasi_qc as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and s.produk like '%$src_produk%' and s.gol_darah like '$src_golongan%' and s.RhesusDrh like '%$src_rhesus%' 
and k.asal_utd like '%$src_utd%' order by k.tgl ASC  ");
?>
<table border=2 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	    <td align="center">No</td>
	    <td align="center">No. Kantong</td>
	    <td align="center">Gol Darah</td>
	    <td align="center">Rhesus</td>
	    <td align="center">Produk</td>
	    <td align="center">Tgl Aftap</td>
	    <td align="center">Tgl Kadaluwarsa</td>
	    <td align="center">Tgl Penerimaan Sampel</td>
	    <td align="center">Petugas Yg Menyerahkan</td>
	    <td align="center">Petugas Yg Menerima</td>
	    <td align="center">Asal Sampel</td>
    </tr>
<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){

$asalutd=mysql_fetch_assoc(mysql_query("select nama from utd where id='$datatransaksipermintaan[asal_utd]'"));
$utd=$asalutd[nama];
?>
    <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	    <td align="center"><?=$no?></td>
	    <td align="center"><?=$datatransaksipermintaan['nokantong']?></td>
	    <td align="center"><?=$datatransaksipermintaan['goldarah']?></td>
	    <td align="center"><?=$datatransaksipermintaan['rhesus']?></td>
	    <td align="center"><?=$datatransaksipermintaan['produk']?></td>
	    <td align="center"><?=$datatransaksipermintaan['tglaftap']?></td>
	    <td align="center"><?=$datatransaksipermintaan['kadaluwarsa']?></td>
	    <td align="center"><?=$datatransaksipermintaan['tgl']?></td>
	    <td align="center"><?=$datatransaksipermintaan['petugas_terima']?></td>
	    <td align="center"><?=$datatransaksipermintaan['petugas_serah']?></td>
	    <td align="center"><?=$utd?></td>
    </tr>
    <? $no++;
} ?>
</table>

<?
mysql_close();
?>
