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
//$col=mysql_query("SELECT `status` FROM `kirimbdrs`");if(!$col){mysql_query("ALTER TABLE `kirimbdrs` ADD `status` INT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=keluar 1=kembali'");}
//$col1=mysql_query("SELECT `tglkembali` FROM `kirimbdrs`");if(!$col1){mysql_query("ALTER TABLE `kirimbdrs` ADD `tglkembali` DATETIME NULL DEFAULT NULL ");}
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
if ($_POST[bdrs]!='') $src_bdrs=$_POST[bdrs];
if ($_POST[produk]!='') $src_produk=$_POST[produk];
if ($_POST[status]!='') $src_status=$_POST[status];
if ($_POST[golongan]!='') $src_golongan=$_POST[golongan];
if ($_POST[rhesus]!='') $src_rhesus=$_POST[rhesus];

$bdrs=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode = '$src_bdrs' "));
$bdrspilih=$bdrs[nama];
?>
<a name="atas"></a>
<h1>RINCIAN DROPPING KOMPONEN DARAH <?=$bdrs[nama]?></h1>
<form method=post> Mulai: TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>><br>
    BDRS
    <select name="bdrs">
        <option value="b%" selected>-SEMUA-</option>
            <?php
            $ql= mysql_query("select * from bdrs ");
            while ($rowl1 = mysql_fetch_array($ql)){
                echo "<option value=$rowl1[kode]>$rowl1[nama]</option>";
            }
            ?>
    </select>
    PRODUK
    <select name="produk">
        <option value="" selected>- SEMUA -</option>
            <?php
            $qrs = mysql_query("select * from produk ");
            while ($rowrs1 = mysql_fetch_array($qrs)){
                echo "<option value=$rowrs1[Nama]>$rowrs1[Nama]</option>";
            }
            ?>
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
    STATUS
        <select name="status">
            <option value="" selected>- SEMUA -</option>
            <option value="0">Keluar</option>
            <option value="1">Kembali</option>
        </select>
    <input type="submit" name="submit" value="Tampilkan data" class="swn_button_blue">
</form>

<form name=xls method=post action=modul/rekap_darah_keluar_bdrs_new_xls.php>
    <input type=hidden name=today value='<?=$today?>'>
    <input type=hidden name=today1 value='<?=$today1?>'>
    <input type=hidden name=bdrs value='<?=$src_bdrs?>'>
    <input type=hidden name=produk value='<?=$src_produk?>'>
    <input type=hidden name=status value='<?=$src_status?>'>
    <input type=hidden name=golongan value='<?=$src_golongan?>'>
    <input type=hidden name=rhesus value='<?=$src_rhesus?>'>
    <input type=submit name=submit2 class="swn_button_blue" value='Print Rekap Darah Keluar BDRS (.XLS)'>

    <a href="#bawah" class="swn_button_blue">Ke bawah</a>
</form>


<?
$transaksipermintaan=mysql_query("select k.nokantong,k.tgl,s.noSelang,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.volume,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,k.bdrs,s.tgl_keluar,k.petugas,k.status,k.tglkembali from stokkantong as s, kirimbdrs as k where CAST(k.tgl as date) >='$today' and CAST(k.tgl as date) <='$today1' and s.noKantong=k.nokantong and k.bdrs like '%$src_bdrs%' and s.produk like '%$src_produk%' and s.gol_darah like '$src_golongan%' and RhesusDrh like '%$src_rhesus%' and k.status like '%$src_status%' order by k.tgl ASC  ");
$namabdrs=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode = '$src_bdrs' "));
?>
<table border=2 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
    <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	    <td align="center">No</td>
	    <td align="center">Tgl Keluar</td>
	    <td align="center">Nama BDRS</td>
	    <td align="center">No Barcode</td>
        <td align="center">No Selang</td>
	    <td align="center">Gol (Rh) Darah</td>
        <td align="center">Jenis<br> Komponen</td>
		<td align="center">Volume<br> (ml)</td>
        <td align="center">Tgl Aftap</td>
	    <td align="center">Tgl Exp.</td>
        <td align="center">Tgl Periksa</td>
	    <td align="center">Jenis<br>Kantong</td>
	    <td align="center">Petugas</td>
	    <td align="center">Status</td>
	    <td align="center">Tgl Kembali</td>
    </tr>
<?
$no=1;
$jmlGolA=0;     $jmlGolB=0;     $jmlGolO=0;     $jmlGolAB=0;    
$jmlPRC=0;      $jmlWB=0;       $jmlTC=0;       $jmlLP=0;   $jmlWE=0;   $jmlAPH=0;  $jmlAHF=0;  $jmlFP=0;   $jmlFFP=0;
$jmlRhpos=0;    $jmlRhneg=0;
$jml_b_GolA=0;     $jml_b_GolB=0;     $jml_b_GolO=0;     $jml_b_GolAB=0;
$jml_b_PRC=0;      $jml_b_WB=0;       $jml_b_TC=0;       $jml_b_LP=0;   $jml_b_WE=0;   $jml_b_APH=0;  $jml_b_AHF=0;  $jml_b_FP=0;   $jml_b_FFP=0;
$jml_b_Rhpos=0;    $jml_b_Rhneg=0;
$jmlkirim=0;
$jmlbalik=0;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
    <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	    <td align="center"><?=$no?></td>
	    <td align="center"><?=$datatransaksipermintaan['tgl']?></td>
		<? $bdrs=mysql_fetch_assoc(mysql_query("select * from bdrs where kode='$datatransaksipermintaan[bdrs]'"));?>
		<td align="center"><?=$bdrs['nama']?></td>
	    <td align="center"><?=$datatransaksipermintaan['nokantong']?></td>
        <td align="center"><?=$datatransaksipermintaan['noSelang']?></td>
	    <td align="center"><?=$datatransaksipermintaan['gol_darah']?> (<?=$datatransaksipermintaan['RhesusDrh']?> )</td>
	    <td align="center"><?=$datatransaksipermintaan['produk']?></td>
		<td align="center"><?=$datatransaksipermintaan['volume']?></td>
	    <td align="center"><?=$datatransaksipermintaan['tgl_Aftap']?></td>
	    <td align="center"><?=$datatransaksipermintaan['kadaluwarsa']?></td>
	    <td align="center"><?=$datatransaksipermintaan['tglperiksa']?></td>
	    <?
	    if ($datatransaksipermintaan['jenis']=='2') $jns="Double";
	    if ($datatransaksipermintaan['jenis']=='1') $jns="Single";
	    if ($datatransaksipermintaan['jenis']=='3') $jns="Tripple";
	    if ($datatransaksipermintaan['jenis']=='4') $jns="Quadruple";
	    if ($datatransaksipermintaan['jenis']=='6') $jns="Pediatrik";
		?>
	    <td align="center"><?=$jns?></td>
	    <td align="center"><?=$datatransaksipermintaan['petugas']?></td>
		<?
		if ($datatransaksipermintaan[status]=='0'){
            $status='keluar';$jmlkirim=$jmlkirim+1;
            switch ($datatransaksipermintaan['gol_darah']){
                case "A"    : $jmlGolA = $jmlGolA+1;Break;
                case "B"    : $jmlGolB = $jmlGolB+1;Break;
                case "O"    : $jmlGolO = $jmlGolO+1;Break;
                case "AB"   : $jmlGolAB = $jmlGolAB+1;Break;
                default     : break;
            }
            switch ($datatransaksipermintaan['RhesusDrh']){
                case "+"    : $jmlRhpos = $jmlRhpos+1;Break;
                case "-"    : $jmlRhneg = $jmlRhneg+1;Break;
                default     : break;
            }
            switch ($datatransaksipermintaan['produk']){
                case "WB"  : $jmlWB  = $jmlWB+1;Break;
                case "PRC" : $jmlPRC = $jmlPRC+1;Break;
                case "TC"  : $jmlTC  = $jmlTC+1;Break;
                case "LP"  : $jmlLP  = $jmlLP+1;Break;
                case "FFP" : $jmlFFP = $jmlFFP+1;Break;
                case "FP"  : $jmlFP  = $jmlFP+1;Break;
                case "TC Aferesis" : $jmlAPH = $jmlAPH+1;Break;
                case "AHF" : $jmlAHF = $jmlAHF+1;Break;
                case "WE"  : $jmlWE  = $jmlWE+1;Break;
                default    : break;
            }
        }
		if ($datatransaksipermintaan[status]=='1') {
            $status='Kembali';$jmlbalik=$jmlbalik+1;
            switch ($datatransaksipermintaan['gol_darah']){
                case "A"    : $jml_b_GolA = $jml_b_GolA+1;Break;
                case "B"    : $jml_b_GolB = $jml_b_GolB+1;Break;
                case "O"    : $jml_b_GolO = $jml_b_GolO+1;Break;
                case "AB"   : $jml_b_GolAB = $jml_b_GolAB+1;Break;
                default     : break;
            }
            switch ($datatransaksipermintaan['RhesusDrh']){
                case "+"    : $jml_b_Rhpos = $jml_b_Rhpos+1;Break;
                case "-"    : $jml_b_Rhneg = $jml_b_Rhneg+1;Break;
                default     : break;
            }
            switch ($datatransaksipermintaan['produk']){
                case "WB"  : $jml_b_WB  = $jml_b_WB+1;Break;
                case "PRC" : $jml_b_PRC = $jml_b_PRC+1;Break;
                case "TC"  : $jml_b_TC  = $jml_b_TC+1;Break;
                case "LP"  : $jml_b_LP  = $jml_b_LP+1;Break;
                case "FFP" : $jml_b_FFP = $jml_b_FFP+1;Break;
                case "FP"  : $jml_b_FP  = $jml_b_FP+1;Break;
                case "TC Aferesis" : $jml_b_APH = $jml_b_APH+1;Break;
                case "AHF" : $jml_b_AHF = $jml_b_AHF+1;Break;
                case "WE"  : $jml_b_WE  = $jml_b_WE+1;Break;
                default    : break;
            }
        }

		$tglkembali=$datatransaksipermintaan[tglkembali];
		if ($datatransaksipermintaan[tglkembali]==NULL) $tglkembali='-';
		?>
	    <td align="center"><?=$status?></td>
    	<td align="center"><?=$tglkembali?></td>
    </tr>
    <? $no++;
} ?>
</table>
<?
    $jmlABO=$jmlGolA+$jmlGolAB+$jmlGolB+$jmlGolO;
    $jmlRhesus=$jmlRhneg+$jmlRhpos;
    $jmlproduk=$jmlWB+$jmlPRC+$jmlTC+$jmlLP+$jmlFFP+$jmlFP+$jmlAPH+$jmlAHF+$jmlWE;

    $jml_b_ABO=$jml_b_GolA+$jml_b_GolAB+$jml_b_GolB+$jml_b_GolO;
    $jml_b_Rhesus=$jml_b_Rhneg+$jml_b_Rhpos;
    $jml_b_produk=$jml_b_WB+$jml_b_PRC+$jml_b_TC+$jml_b_LP+$jml_b_FFP+$jml_b_FP+$jml_b_APH+$jml_b_AHF+$jml_b_WE;
?>
<br>
<h2>REKAP DROPPING KOMPONEN DARAH <?=$bdrspilih?></h2>
<h3>Tanggal : <?=$today?> s/d <?=$today1?> </h3>
<table border="0">
    <tr>
        <td>
            <table border=3 cellpadding=5 cellspacing=1 style="border-collapse:collapse">
                <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td colspan="4" align="center"><b>JUMLAH PENGIRIMAN</b></td>
                </tr>
                <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td colspan="2"><b>GOLONGAN DARAH</b></td>
                    <td colspan="2"><b>JENIS KOMPONEN DARAH</b></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan A</td><td><?=$jmlGolA?></td>        <td>WB</td><td><?=$jmlWB?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan B</td><td><?=$jmlGolB?></td>        <td>PRC</td><td><?=$jmlPRC?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan O</td><td><?=$jmlGolO?></td>        <td>TC</td><td><?=$jmlTC?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan AB</td><td><?=$jmlGolAB?></td>      <td>FP</td><td><?=$jmlFP?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td><b>TOTAL</b></td><td><b><?=$jmlABO?></b></td>                      <td>FFP</td><td><?=$jmlFFP?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Rhesus (+)</td><td><?=$jmlRhpos?></td>   <td>AHF</td><td><?=$jmlAHF?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Rhesus (-)</td><td><?=$jmlRhneg?></td>   <td>LP</td><td><?=$jmlLP?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td><b>TOTAL Rhesus</b></td><td><b><?=$jmlRhesus?></b></td>                 <td>TC Apheresis</td><td><?=$jmlAPH?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td colspan="2"></td>                 <td><b>TOTAL</b></td><td><b><?=$jmlproduk?></b></td>
                </tr>
            </table>
        </td>
        <td>
            <table border=3 cellpadding=5 cellspacing=1 style="border-collapse:collapse">
                <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td colspan="4" align="center"><b>JUMLAH KEMBALI</b></td>
                </tr>
                <tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td colspan="2"><b>GOLONGAN DARAH</b></td>
                    <td colspan="2"><b>JENIS KOMPONEN DARAH</b></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan A</td><td><?=$jml_b_GolA?></td>        <td>WB</td><td><?=$jml_b_WB?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan B</td><td><?=$jml_b_GolB?></td>        <td>PRC</td><td><?=$jml_b_PRC?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan O</td><td><?=$jml_b_GolO?></td>        <td>TC</td><td><?=$jml_b_TC?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Golongan AB</td><td><?=$jml_b_GolAB?></td>      <td>FP</td><td><?=$jml_b_FP?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td><b>TOTAL</b></td><td><b><?=$jml_b_ABO?></b></td>                      <td>FFP</td><td><?=$jml_b_FFP?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Rhesus (+)</td><td><?=$jml_b_Rhpos?></td>   <td>AHF</td><td><?=$jml_b_AHF?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td>Rhesus (-)</td><td><?=$jml_b_Rhneg?></td>   <td>LP</td><td><?=$jml_b_LP?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td><b>TOTAL Rhesus</b></td><td><b><?=$jml_b_Rhesus?></b></td>                 <td>TC Apheresis</td><td><?=$jml_b_APH?></td>
                </tr>
                <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                    <td colspan="2"></td>                 <td><b>TOTAL</b></td><td><b><?=$jml_b_produk?></b></td>
                </tr>
            </table>
        </td>
    </tr>

</table>
<a href="#atas" class="swn_button_blue">Ke Atas</a>
<a name="bawah"></a>
<?
mysql_close();
?>
