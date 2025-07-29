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
$sekarang=DATE('Y-m-d');
$sekarang1=$sekarang;
$array_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
?>
<!--<form name="cari" method="POST" action="modul/laporan_donasi_bulanan_wb_aksi.php">-->
<!--<table>-->
<?
if (isset($_POST['waktu'])) {$sekarang=$_POST['waktu'];$sekarang1=$sekarang;}
if ($_POST['waktu1']!='') $sekarang1=$_POST['waktu1'];
$bulan0=substr($sekarang,5,2);
$bulan=(int)$bulan0;
$bulan=$array_bulan[$bulan];

$perbln=substr($sekarang,5,2);
$pertgl=substr($sekarang,8,2);
$perthn=substr($sekarang,0,4);

$perbln1=substr($sekarang1,5,2);
$pertgl1=substr($sekarang1,8,2);
$perthn1=substr($sekarang1,0,4);

//$rowone1=mysql_fetch_assoc(mysql_query("select COALESCE(SUM(d.Jumlah),0) as Jumlah from htranspermintaan h, dtranspermintaan d where h.TglMinta>='$sekarang' and h.TglMinta<='$sekarang1' AND h.NoForm=d.NoForm AND h.bagian LIKE '%Anak%' "));
//$rowone2=mysql_fetch_assoc(mysql_query("select COUNT(h.Nokan) as Jumlah from hasilcross h, htranspermintaan ht
//            where substr(h.tgl_cross,1,10)>='$sekarang' and substr(h.tgl_cross,1,10)<='$sekarang1' AND h.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Anak%' AND h.Hasil='1' AND h.Pakai='1' "));
//$rowone3=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, htranspermintaan ht
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Anak%' "));
//$rowone4=$rowone2['Jumlah']/$rowone1['Jumlah']*100;
//$rowone5=$rowone3['Jumlah']/$rowone2['Jumlah']*100;
//
//$rowtwo1=mysql_fetch_assoc(mysql_query("select COALESCE(SUM(d.Jumlah),0) as Jumlah from htranspermintaan h, dtranspermintaan d where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.NoForm=d.NoForm AND h.bagian LIKE '%Bedah%' "));
//$rowtwo2=mysql_fetch_assoc(mysql_query("select COUNT(h.Nokan) as Jumlah from hasilcross h, htranspermintaan ht
//            where substr(h.tgl_cross,1,10)>='$sekarang' and substr(h.tgl_cross,1,10)<='$sekarang1' AND h.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Bedah%' AND h.Hasil='1' AND h.Pakai='1' "));
//$rowtwo3=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, htranspermintaan ht
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Bedah%' "));
//$rowtwo4=$rowtwo2['Jumlah']/$rowtwo1['Jumlah']*100;
//$rowtwo5=$rowtwo3['Jumlah']/$rowtwo2['Jumlah']*100;
//
//$rowthree1=mysql_fetch_assoc(mysql_query("select COALESCE(SUM(d.Jumlah),0) as Jumlah from htranspermintaan h, dtranspermintaan d where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.NoForm=d.NoForm AND h.bagian LIKE '%Dalam%' "));
//$rowthree2=mysql_fetch_assoc(mysql_query("select COUNT(h.Nokan) as Jumlah from hasilcross h, htranspermintaan ht
//            where substr(h.tgl_cross,1,10)>='$sekarang' and substr(h.tgl_cross,1,10)<='$sekarang1' AND h.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Dalam%' AND h.Hasil='1' AND h.Pakai='1' "));
//$rowthree3=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, htranspermintaan ht
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Dalam%' "));
//$rowthree4=$rowthree2['Jumlah']/$rowthree1['Jumlah']*100;
//$rowthree5=$rowthree3['Jumlah']/$rowthree2['Jumlah']*100;
//
//$rowfour1=mysql_fetch_assoc(mysql_query("select COALESCE(SUM(d.Jumlah),0) as Jumlah from htranspermintaan h, dtranspermintaan d where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.NoForm=d.NoForm AND h.bagian LIKE '%Kandungan%' "));
//$rowfour2=mysql_fetch_assoc(mysql_query("select COUNT(h.Nokan) as Jumlah from hasilcross h, htranspermintaan ht
//            where substr(h.tgl_cross,1,10)>='$sekarang' and substr(h.tgl_cross,1,10)<='$sekarang1' AND h.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Kandungan%' AND h.Hasil='1' AND h.Pakai='1' "));
//$rowfour3=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, htranspermintaan ht
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=ht.NoForm
//            AND ht.bagian LIKE '%Kandungan%' "));
//$rowfour4=$rowfour2['Jumlah']/$rowfour1['Jumlah']*100;
//$rowfour5=$rowfour3['Jumlah']/$rowfour2['Jumlah']*100;
//
//$rowfive1=mysql_fetch_assoc(mysql_query("select COALESCE(SUM(d.Jumlah),0) as Jumlah from htranspermintaan h, dtranspermintaan d
//            where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.NoForm=d.NoForm
//            AND (h.bagian NOT LIKE '%Anak%' AND h.bagian NOT LIKE '%Bedah%' AND h.bagian NOT LIKE '%Dalam%'
//            AND h.bagian NOT LIKE '%Kandungan%') "));
//$rowfive2=mysql_fetch_assoc(mysql_query("select COUNT(h.Nokan) as Jumlah from hasilcross h, htranspermintaan ht
//            where substr(h.tgl_cross,1,10)>='$sekarang' and substr(h.tgl_cross,1,10)<='$sekarang1' AND h.NoForm=ht.NoForm
//            AND (ht.bagian NOT LIKE '%Anak%' AND ht.bagian NOT LIKE '%Bedah%' AND ht.bagian NOT LIKE '%Dalam%'
//            AND ht.bagian NOT LIKE '%Kandungan%') AND h.Hasil='1' AND h.Pakai='1' "));
//$rowfive3=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, htranspermintaan ht
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=ht.NoForm
//            AND (ht.bagian NOT LIKE '%Anak%' AND ht.bagian NOT LIKE '%Bedah%' AND ht.bagian NOT LIKE '%Dalam%'
//            AND ht.bagian NOT LIKE '%Kandungan%') "));
//$rowfive4=$rowfive2['Jumlah']/$rowfive1['Jumlah']*100;
//$rowfive5=$rowfive3['Jumlah']/$rowfive2['Jumlah']*100;
//
//$rowjum1=mysql_fetch_assoc(mysql_query("select COALESCE(SUM(d.Jumlah),0) as Jumlah from htranspermintaan h, dtranspermintaan d
//            where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.NoForm=d.NoForm "));
//$rowjum2=mysql_fetch_assoc(mysql_query("select COUNT(h.Nokan) as Jumlah from hasilcross h, htranspermintaan ht
//            where substr(h.tgl_cross,1,10)>='$sekarang' and substr(h.tgl_cross,1,10)<='$sekarang1' AND h.NoForm=ht.NoForm "));
//$rowjum3=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, htranspermintaan ht
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=ht.NoForm "));
//$rowjum4=$rowjum2['Jumlah']/$rowjum1['Jumlah']*100;
//$rowjum5=$rowjum3['Jumlah']/$rowjum2['Jumlah']*100;
//
//$jum=mysql_fetch_assoc(mysql_query("select count(noKantong) as kod from user_komponen where substr(tglpembuatan,1,10)>='$sekarang' and substr(tglpembuatan,1,10)<='$sekarang1' AND user='$_POST[usname]'"));

$utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
?>
<h2 style="text-align: center">LAPORAN PERMINTAAN DARAH
    </br><?=strtoupper($utd['nama'])?>
    </br>BULAN <?=strtoupper($bulan)?></h2>
<br>
<div style="display:table-cell">
<!--    <fieldset>-->
<!--        <legend class="table">-->
<!--            <h2><b>D.1. JUMLAH PERMINTAAN DARAH DAN JUMLAH DARAH YANG TIDAK TERPAKAI</b></h2>-->
<!--        </legend>-->
<!--        <table><tr>-->
<!--                <table class=form border=1 cellpadding=0 cellspacing=0>-->
<!--                    <!--                    <th colspan=7></th>-->-->
<!--                    <tr class="field">-->
<!--                        <td style="text-align: center" rowspan="2">No.</td>-->
<!--                        <td style="text-align: center; width: 170px" rowspan="2">Bagian Perawat di RS</td>-->
<!--                        <td style="text-align: center; width: 300px" rowspan="2">Jumlah Total Permintaan Darah (kantong)</td>-->
<!--                        <td style="text-align: center; width: 170px" rowspan="2">Jumlah Permintaan Darah</br>-->
<!--                            Yang Dapat Dipenuhi</br>-->
<!--                            (kantong)</td>-->
<!--                        <td style="text-align: center; width: 170px" rowspan="2">Jumlah Permintaan</br>-->
<!--                            Darah Yang Terpakai</br>-->
<!--                            (kantong)</td>-->
<!--                        <td style="text-align: center" colspan="2">PERSENTASE</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="text-align: center">Pemenuhan</td>-->
<!--                        <td style="text-align: center">Terpakai</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="text-align: center">1</td>-->
<!--                        <td>Anak</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowone1['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowone2['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowone3['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowone4,0,4)." %";?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowone5,0,4)." %";?><!--</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="text-align: center">2</td>-->
<!--                        <td>Bedah</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowtwo1['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowtwo2['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowtwo3['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowtwo4,0,4)." %";?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowtwo5,0,4)." %";?><!--</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="text-align: center">3</td>-->
<!--                        <td>Penyakit Dalam</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowthree1['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowthree2['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowthree3['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowthree4,0,4)." %";?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowthree5,0,4)." %";?><!--</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="text-align: center">4</td>-->
<!--                        <td>Kandungan</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowfour1['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowfour2['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowfour3['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowfour4,0,4)." %";?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowfour5,0,4)." %";?><!--</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td style="text-align: center">5</td>-->
<!--                        <td>Lain-lain</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowfive1['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowfive2['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowfive3['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowfive4,0,4)." %";?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowfive5,0,4)." %";?><!--</td>-->
<!--                    </tr>-->
<!--                    <tr><td style="text-align: center" colspan="2"><b>JUMLAH</b></td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowjum1['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowjum2['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=$rowjum3['Jumlah']?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowjum4,0,4)." %"?><!--</td>-->
<!--                        <td style="text-align: center" class="input">--><?//=substr($rowjum5,0,4)." %"?><!--</td>-->
<!--                    </tr>-->
<!--                </table>-->
<!--                </td>-->
<!---->
<!--            </tr>-->
<!--        </table>-->
<!--    </fieldset>-->
<!--</div>-->
<!--</br>-->
<!--batas form rekap -->

<br>
<?
$b1=mysql_fetch_assoc(mysql_query("select count(s.NoKantong) as Jumlah from stokkantong s where substr(s.tglpengolahan,1,10)>='$sekarang' and substr(s.tglpengolahan,1,10)<='$sekarang1' AND s.Status='5' "));
//$b2=mysql_fetch_assoc(mysql_query("select count(s.NoKantong) as Jumlah from stokkantong s where substr(s.tglpengolahan,1,10)>='$sekarang' and substr(s.tglpengolahan,1,10)<='$sekarang1' AND s.NoKantong LIKE '%A' AND (s.Status='4' OR s.Status='6' OR s.Status='11' OR s.Status='12')"));
//$b3=mysql_fetch_assoc(mysql_query("select count(s.NoKantong) as Jumlah from stokkantong s where substr(s.kadaluwarsa,1,10)>='$sekarang' and substr(s.kadaluwarsa,1,10)<='$sekarang1' AND (s.Status='2' OR s.NoKantong='4')"));
//$b4=mysql_fetch_assoc(mysql_query("select count(s.NoKantong) as Jumlah from stokkantong s where substr(s.tglpengolahan,1,10)>='$sekarang' and substr(s.tglpengolahan,1,10)<='$sekarang1' AND s.Status='9' "));
//$b5=mysql_fetch_assoc(mysql_query("select count(s.NoKantong) as Jumlah from stokkantong s where substr(s.tglpengolahan,1,10)>='$sekarang' and substr(s.tglpengolahan,1,10)<='$sekarang1' AND s.Status='8' "));
//$b6=mysql_fetch_assoc(mysql_query("select count(s.NoKantong) as Jumlah from stokkantong s where substr(s.tglpengolahan,1,10)>='$sekarang' and substr(s.tglpengolahan,1,10)<='$sekarang1' AND s.Status='10' "));
?>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>D.2. JUMLAH KANTONG DARAH YANG DIMUSNAHKAN BERDASARKAN PENYEBAB</b></h2>
        </legend>
        <table class=form border=1 cellpadding=0 cellspacing=0>
            <!--                    <th colspan=7></th>-->
            <tr class="field">
                <td style="text-align: center">No.</td>
                <td style="text-align: center; width: 470px">Penyebab Darah Dimusnahkan</td>
                <td style="text-align: center; width: 340px">Jumlah Kantong Darah Yang Dimusnahkan</td>
            </tr>
            <tr>
                <td style="text-align: center">1</td>
                <td>Gagal Pengambilan Darah</td>
                <td style="text-align: center" class="input"><?=$b1['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">2</td>
                <td>IMLTD Reaktif Elisa</td>
                <?
                $b20=mysql_query("SELECT h.NoKantong Jumlah
             FROM htransaksi h, pendonor p, hasilelisa e
             WHERE h.KodePendonor=p.Kode AND e.noKantong=h.NoKantong AND substr(h.Tgl,1,10)>='$sekarang'
             AND substr(h.Tgl,1,10)<='$sekarang1' AND (e.jenisPeriksa='0' OR e.jenisPeriksa='1' OR e.jenisPeriksa='2' OR e.jenisPeriksa='3') AND e.Hasil='1' GROUP BY h.NoKantong");
                while($b2=mysql_fetch_assoc($b20)){
                ?>
                <tr>
                <td style="text-align: center" class="input"><?=$b2['Jumlah'].'<br>'?></td>
                </tr>
                <?}?>
            <tr>
                <td style="text-align: center">2</td>
                <td>IMLTD Reaktif Rapid</td>
                <?
                $b210=mysql_query("SELECT h1.NoKantong as Jumlah
             FROM pendonor p1, htransaksi h1, testrapid t1
             WHERE p1.Kode=h1.KodePendonor AND h1.NoKantong=t1.nokantong AND substr(h1.Tgl,1,10)>='$sekarang'
             AND substr(h1.Tgl,1,10)<='$sekarang1' AND (t1.jenisPeriksa='0' OR t1.jenisPeriksa='1' OR t1.jenisPeriksa='2' OR t1.jenisPeriksa='3') AND t1.Hasil='0' GROUP BY h1.NoKantong");
                while($b21=mysql_fetch_assoc($b210)){
                ?>
                <tr>
                <td style="text-align: center" class="input"><?=$b21['Jumlah']?></td>
                </tr>
                <?}?>
            <tr>
                <td style="text-align: center">3</td>
                <td>Kadaluwarsa</td>
                <td style="text-align: center" class="input"><?=$b3['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">4</td>
                <td>Masalah dalam proses Produksi</td>
                <td style="text-align: center" class="input"><?=$b4['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">5</td>
                <td>Masalah dalam proses Penyimpanan</td>
                <td style="text-align: center" class="input"><?=$b5['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">6</td>
                <td>Penyebab Lain :</td>
                <td style="text-align: center" class="input"><?=$b6['Jumlah']?></td>
            </tr>
        </table>
    </fieldset>
</div>
</br>
<?
$d3one=mysql_fetch_assoc(mysql_query("select count(h.NoForm) as Jumlah from htranspermintaan h, rmhsakit rs where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.rs=rs.Kode AND rs.AlamatRS LIKE '%Jember%' "));
$d3two=mysql_fetch_assoc(mysql_query("select count(h.NoForm) as Jumlah from htranspermintaan h, rmhsakit rs where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.rs=rs.Kode AND rs.AlamatRS NOT LIKE '%Jember%' "));
$d3jum=mysql_fetch_assoc(mysql_query("select count(h.NoForm) as Jumlah from htranspermintaan h, rmhsakit rs where substr(h.TglMinta,1,10)>='$sekarang' and substr(h.TglMinta,1,10)<='$sekarang1' AND h.rs=rs.Kode "));
?>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>D.3. JUMLAH RS YANG DILAYANI</b></h2>
        </legend>
        <table class=form border=1 cellpadding=0 cellspacing=0>
            <tr class="field">
                <td style="text-align: center" >No.</td>
                <td style="text-align: center; width: 170px">Jumlah RS Yang Dilayani</td>
                <td style="text-align: center; width: 300px">Jumlah</td>
            </tr>
            <tr>
                <td style="text-align: center">1</td>
                <td>Dalam Kota</td>
                <td style="text-align: center" class="input"><?=$d3one['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">2</td>
                <td>Luar Kota</td>
                <td style="text-align: center" class="input"><?=$d3two['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center" colspan="2">JUMLAH</td>
                <td style="text-align: center" class="input"><?=$d3jum['Jumlah']?></td>
            </tr>
        </table>
    </fieldset>
</div>
</br>
<?
$d4one=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(k.nokantong)) as Jumlah FROM kirim_bdrs k, bdrs b WHERE k.bdrs=b.kode AND (b.nama NOT LIKE 'UTD%' OR b.nama NOT LIKE 'UDD%') AND k.tgl_kirim>='$sekarang' AND k.tgl_kirim<='$sekarang1' "));
$d4two=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(k.nokantong)) as Jumlah FROM kirim_bdrs k, bdrs b WHERE k.bdrs=b.kode AND (b.nama LIKE 'UTD%' OR b.nama LIKE 'UDD%') AND k.tgl_kirim>='$sekarang' AND k.tgl_kirim<='$sekarang1' "));
$d4jum=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(k.nokantong)) as Jumlah FROM kirim_bdrs k, bdrs b WHERE k.bdrs=b.kode AND k.tgl_kirim>='$sekarang' AND k.tgl_kirim<='$sekarang1' "));
?>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>D.4. DISTRIBUSI KOMPONEN DARAH</b></h2>
        </legend>
        <table class=form border=1 cellpadding=0 cellspacing=0>
            <tr class="field">
                <td style="text-align: center" >No.</td>
                <td style="text-align: center; width: 170px">Tujuan</td>
                <td style="text-align: center; width: 300px">Jumlah</td>
            </tr>
            <tr>
                <td style="text-align: center">1</td>
                <td>BDRS</td>
                <td style="text-align: center" class="input"><?=$d4one['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center">2</td>
                <td>UTD Lain</td>
                <td style="text-align: center" class="input"><?=$d4two['Jumlah']?></td>
            </tr>
            <tr>
                <td style="text-align: center" colspan="2">JUMLAH</td>
                <td style="text-align: center" class="input"><?=$d4jum['Jumlah']?></td>
            </tr>
        </table>
    </fieldset>
</div>