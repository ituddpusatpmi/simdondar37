<?php
/**
 * Created by PhpStorm.
 * User: irawandb
 * Date: 5/11/16
 * Time: 10:14 AM
 */
?>
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/calender.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<?php
//include('clogin.php');
include('../config/db_connect.php');
//$sekarang=DATE('Y-m-d');
//$sekarang1=$sekarang;
$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
?>
<!--<form name="cari" method="POST" action="modul/laporan_donasi_bulanan_wb_aksi.php">-->
<!--<table>-->
    <?
    if (isset($_POST['waktu'])) {$sekarang=$_POST['waktu'];}
$bulan0=substr($sekarang,5,2);
$bulan=(int)$bulan0;
$bulan=$array_bulan[$bulan];
$tahun=substr($sekarang,0,4);

    $rowone1=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0'"));
    $rowone2=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='0'"));
    $rowone3=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='1'"));
    $rowone4=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='2'"));
    $rowone5=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.Jk='0'"));
    $rowone6=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND p.Jk='1'"));
    $rowone7=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor FROM pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND ($tahun - YEAR(p.TglLhr)) < 18"));
    $rowone8=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor FROM pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 18 AND 24 "));
    $rowone9=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor FROM pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 25 AND 44"));
    $rowone10=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor FROM pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND ($tahun - YEAR(p.TglLhr)) BETWEEN 45 AND 64"));
    $rowone11=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor FROM pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND ($tahun - YEAR(p.TglLhr)) > 64"));
    

    $rowtwo1=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='0' AND p.Cekal='1'"));
    $rowtwo2=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='1' AND p.Cekal='1'"));
    $rowtwo3=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='2' AND p.Cekal='1'"));
    $rowtwo4=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='0' AND p.Cekal='2'"));
    $rowtwo5=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='1' AND p.Cekal='2'"));
    $rowtwo6=mysql_fetch_assoc(mysql_query("select count(DISTINCT(p.Kode)) as Jumlah, h.JenisDonor from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND h.Pengambilan='0' AND h.JenisDonor='2' AND p.Cekal='2'"));
    

    $rowthree1=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree2=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree3=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree4=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree5=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree6=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree7=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree8=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='0'"));
    $rowthree9=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1'"));
    $rowthree10=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='O' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1'"));
    $rowthree11=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1'"));
    $rowthree12=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='A' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1'"));
	$rowthree13=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1'"));
	$rowthree14=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='B' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1'"));
	$rowthree15=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='+' AND h.Pengambilan='0' AND h.donorbaru='1'"));
	$rowthree16=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(p.Kode)) as Jumlah from pendonor p, htransaksi h where substr(h.Tgl,1,4)='$sekarang' AND h.KodePendonor=p.Kode AND p.GolDarah='AB' AND p.Rhesus='-' AND h.Pengambilan='0' AND h.donorbaru='1'"));

    

    $utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
    ?>
    <h2 style="text-align: center">LAPORAN JUMLAH PENDONOR (ORANG)
    </br><?=strtoupper($utd['nama'])?>
    </br>TAHUN <?=$sekarang?></h2>
    <br>
<div style="display:table-cell">
<fieldset>
<legend class="table">
    <h2><b>C.1. JUMLAH (Jumlah Orang yang mendonorkan darahnya)</b></h2>
</legend>
               
        <table class=form border=1 cellpadding=0 cellspacing=0>
<!--      -->
                    <tr class="field">
                        <td style="text-align: center; width: 150px" rowspan="2">Jumlah Total Pendonor(a)</td>
                        <td style="text-align: center; width: 100px" colspan="3">Jenis Pendonor (b)</td>
                        <td style="text-align: center; width: 100px" colspan="2">Jenis Kelamin (c)</td>
                        <td style="text-align: center; width: 100px" colspan="5">Kelompok Umur (d)</td>
                        
                    </tr>
                    
                    <tr>
                        <td style="text-align: center" >Sukarela</td>
                        <td style="text-align: center" >Pengganti</td>
                        <td style="text-align: center" >Bayaran</td>
                        <td style="text-align: center" >Laki-laki</td>
                        <td style="text-align: center" >Perempuan</td>
                        <td style="text-align: center" >17 Tahun</td>
                        <td style="text-align: center" >18-24 Tahun</td>
                        <td style="text-align: center" >25-44 Tahun</td>
                        <td style="text-align: center" >45-64 Tahun</td>
                        <td style="text-align: center" >>65 Tahun</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" class="input"><?=$rowone1['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone2['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone3['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone4['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone5['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone6['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone7['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone8['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone9['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone10['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowone11['Jumlah']?></td>
                        
                    </tr>
                    
                    
                </table>




    </fieldset>
    </div>
</br>

<div style="display:table-cell">
<fieldset>
<legend class="table">
    <h2><b>C.2. JUMLAH PENDONOR YANG DICEKAL</b></h2>
</legend>
               
        <table class=form border=1 cellpadding=0 cellspacing=0>
<!--                    <th colspan=7></th>-->
                    <tr class="field">
                        <td style="text-align: center; width: 400px" colspan="3">Jumlah Pendonor yang dicekal<br>Permanen</td>
                        <td style="text-align: center; width: 400px" colspan="3" >Jumlah Pendonor yang dicekal<br>Sementara</td>
                    </tr>
                    
                    <tr>
                        <td style="text-align: center" >Sukarela</td>
                        <td style="text-align: center" >Pengganti</td>
                        <td style="text-align: center" >Bayaran</td>
                        <td style="text-align: center" >Sukarela</td>
                        <td style="text-align: center" >Pengganti</td>
                        <td style="text-align: center" >Bayaran</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" class="input"><?=$rowtwo1['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowtwo2['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowtwo3['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowtwo4['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowtwo5['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$rowtwo6['Jumlah']?></td>
                        
                        
                    </tr>
                    
                    
                </table>


                <br>

    </fieldset>
    </div>
<br>
<!-- BARU ULANG-->

<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>C.3. JUMLAH PENDONOR BARU DAN ULANG</b></h2>
        </legend>
        <table class=form border=1 cellpadding=0 cellspacing=0>
            <!--                    <th colspan=7></th>-->
            <tr class="field">                
                <td style="text-align: center; width: 500px" colspan="8">Jumlah Pendonor Darah Baru Menurut Golongan dan Rh Darah</td>
                <td style="text-align: center; width: 500px" colspan="8">Jumlah Pendonor Darah Baru Menurut Golongan dan Rh Darah</td>
            </tr>
            
            <tr>
                <td style="text-align: center" colspan="2">O</td>
                <td style="text-align: center" colspan="2">A</td>
                <td style="text-align: center" colspan="2">B</td>
                <td style="text-align: center" colspan="2">AB</td>
                <td style="text-align: center" colspan="2">O</td>
                <td style="text-align: center" colspan="2">A</td>
                <td style="text-align: center" colspan="2">B</td>
                <td style="text-align: center" colspan="2">AB</td>
            </tr>
            <tr>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
                <td style="text-align: center">Pos</td>
                <td style="text-align: center">Neg</td>
            </tr>
            <tr>
                <td style="text-align: center" class="input"><?=$rowthree1['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree2['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree3['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree4['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree5['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree6['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree7['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree8['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree9['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree10['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree11['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree12['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree13['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree14['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree15['Jumlah']?></td>
                <td style="text-align: center" class="input"><?=$rowthree16['Jumlah']?></td>
            </tr>
            
            
        </table>
    </fieldset>
</div>
</br>

<!--BARU ULANG-->
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>CATATAN</b></h2>
        </legend>
<table>
    <tr>
    <td>1</td>
    <td>Laporan dilaporkan dalam periode tahunan.</td>
    </tr>
    <tr>
    <td style="vertical-align: top">2</td>
    <td>Penghitungan pendonor diambil dari status penyumbangan terakhir dalam tahun laporan.</td>
    </tr>
    <tr>
    <td style="vertical-align: top">3</td>
    <td>Jumlah total pendonor (a) = jumlah donor berdasarkan jenis pendonor (b) = jumlah pendonor berdasarkan <br> jenis kelamin (c) = jumlah pendonor berdasarkan kelompok umur (d)</td>
    </tr>
    
</table>
        </fieldset>
    </div>
<!--<form name=xls method=post action=modul/rekap_pembuatan_kantong_xls.php>-->
<!--<input type=hidden name=pertgl value='--><?//=$pertgl?><!--'>-->
<!--<input type=hidden name=perbln value='--><?//=$perbln?><!--'>-->
<!--<input type=hidden name=perthn value='--><?//=$perthn?><!--'>-->
<!--<input type=hidden name=pertgl1 value='--><?//=$pertgl1?><!--'>-->
<!--<input type=hidden name=perbln1 value='--><?//=$perbln1?><!--'>-->
<!--<input type=hidden name=perthn1 value='--><?//=$perthn1?><!--'>-->
<!--<input type=hidden name=waktu value='--><?//=$sekarang?><!--'>-->
<!--<input type=hidden name=waktu1 value='--><?//=$sekarang1?><!--'>-->
<!--<input type=submit name=submit value='Download Rekap (.XLS)'>-->
<!--</form>-->


