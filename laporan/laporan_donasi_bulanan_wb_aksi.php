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

    $rowone1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND JenisDonor=0 AND Pengambilan='0' AND donorbaru='0' AND NoTrans LIKE 'D%' AND caraAmbil='0'"));
    $rowone2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND JenisDonor=0 AND Pengambilan='0' AND donorbaru='1' AND NoTrans LIKE 'D%' AND caraAmbil='0'"));
    $rowone3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND JenisDonor=1 AND Pengambilan='0' AND NoTrans LIKE 'D%' AND caraAmbil='0'"));
    $rowone4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND JenisDonor=2 AND Pengambilan='0' AND NoTrans LIKE 'D%' AND caraAmbil='0'"));
    $rowone5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND donorbaru=0 AND JenisDonor=0 AND Pengambilan='0' AND NoTrans LIKE 'M%' AND caraAmbil='0'"));
    $rowone6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND donorbaru=1 AND JenisDonor=0 AND Pengambilan='0' AND NoTrans LIKE 'M%' AND caraAmbil='0'"));
    $rowone7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan=0 AND caraAmbil=0"));
    $rowone8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND jk=0 AND caraAmbil='0'"));
    $rowone9=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND jk=1 AND caraAmbil='0'"));
    $rowone10=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND umur < 18"));
    $rowone11=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND umur BETWEEN 18 AND 24 "));
    $rowone12=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND umur BETWEEN 25 AND 44 "));
    $rowone13=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND umur BETWEEN 45 AND 64 "));
    $rowone14=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND umur >64"));
    $rowone15=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='O' AND rhesus='+'"));
    $rowone16=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='O' AND rhesus='-'"));
    $rowone17=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='A' AND rhesus='+'"));
    $rowone18=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='A' AND rhesus='-'"));
    $rowone19=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='B' AND rhesus='+'"));
    $rowone20=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='B' AND rhesus='-'"));
    $rowone21=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='AB' AND rhesus='+'"));
    $rowone22=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as baru from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND  Pengambilan='0' AND caraAmbil=0 AND gol_darah='AB' AND rhesus='-'"));


    $utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
    ?>
    <h2 style="text-align: center">LAPORAN DONASI DARAH LENGKAP (<i>WHOLE BLOOD/WB</i>)
    </br><?=strtoupper($utd['nama'])?>
    </br>BULAN <?=strtoupper($bulan)?> TAHUN <?=$perthn1?></h2>
    <br>
<div style="display:table-cell">
<fieldset>
<legend class="table">
    <h2><b>A.1.a. DONASI (Jumlah Kantong darah yang didapatkan dari para donor darah)</b></h2>
</legend>
    <table><tr>
                <table class=form border=1 cellpadding=0 cellspacing=0>
<!--                    <th colspan=7></th>-->
                    <tr class="field">
                           <td style="text-align: center; width: 120px" colspan="4">Jumlah Donasi dalam Gedung yang Berasal dari </br>(a)</td>
                        <td style="text-align: center; width: 100px" colspan="2">Jumlah Donasi Sukarela dari Kegiatan Mobile Unit </br>(b) </br></td>
                        <td style="text-align: center; width 100px" rowspan="3">Jumlah Total Donasi<br>(c)</br></td>
                        <td style="text-align: center; width: 120px" colspan="2">Jumlah Donasi Darah menurut Jenis Kelamin<br>(d)</br></td>
                        <td style="text-align: center; width: 120px" colspan="5">Jumlah Donasi Darah Menurut Kelompok Umur<br>(e)</br></td>
                        <td style="text-align: center; width: 400px" colspan="8">Jumlah Donasi Darah Menurut Golongan Darah dan Rhesus<br>(f)</br></td>
                    </tr>
                    <tr>
                        <td style="text-align: center" colspan="2">Pendonor Sukarela</td>
                        <td style="text-align: center; width: 70px" rowspan="2">Pendonor</br>Pengganti</td>
                        <td style="text-align: center; width: 70px" rowspan="2">Pendonor</br>Bayaran</td>
                        <td style="text-align: center; width: 50px" rowspan="2">Pendonor</br>Baru</td>
                        <td style="text-align: center; width: 50px" rowspan="2">Pendonor</br>Ulang</td>
                        <td style="text-align: center; width: 50px" rowspan="2">Laki-laki</td>
                        <td style="text-align: center; width: 50px" rowspan="2">Perempuan</td>
                        <td style="text-align: center; width: 50px" rowspan="2" >17<br>Tahun</td>
                        <td style="text-align: center; width: 50px" rowspan="2" >18 - 24 <br>Tahun</td>
                        <td style="text-align: center; width: 50px" rowspan="2" >25 - 44 <br>Tahun</td>
                        <td style="text-align: center; width: 50px" rowspan="2" >45 - 64 <br>Tahun</td>
                        <td style="text-align: center; width: 50px" rowspan="2" >> 65 <br>Tahun</td>
                        
                        <td style="text-align: center; width: 50px" colspan="2">O</td>
                        <td style="text-align: center; width: 50px" colspan="2">A</td>
                        <td style="text-align: center; width: 50px" colspan="2" >B</td>
                        <td style="text-align: center; width: 50px" colspan="2" >AB</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; width: 80px" >Baru</td>
                        <td style="text-align: center; width: 80px" >Ulang</td>                        
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
                        <td style="text-align: center" >Pos</td>
                        <td style="text-align: center" >Neg</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" class="input"><?=$rowone1['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone2['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone3['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone4['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone5['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone6['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone7['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone8['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone9['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone10['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone11['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone12['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone13['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone14['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone15['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone16['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone17['baru']?></td>
            		<td style="text-align: center" class="input"><?=$rowone18['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone19['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone20['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone21['baru']?></td>
                        <td style="text-align: center" class="input"><?=$rowone22['baru']?></td>

                    </tr>
    </table>
                    

<br>
<?
$b1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where caraAmbil=0 AND DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='1' AND ketBatal='5'"));
$b2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where caraAmbil=0 AND DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='1' AND ketBatal between '2' AND '3'"));
$b3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where caraAmbil=0 AND DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='1' AND (ketBatal='4' OR ketBatal='6' OR ketBatal='8'  OR ketBatal='0'  OR ketBatal='1')"));
$b4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where caraAmbil=0 AND DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='1' AND ketBatal='9'"));
//$b5=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND "));
//$b6=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan!='0' AND "));
$b7=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where caraAmbil=0 AND DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='1' AND ketBatal='7'"));
$b8=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as Jumlah from htransaksi where caraAmbil=0 AND DATE(Tgl)>='$sekarang' and DATE(Tgl)<='$sekarang1' AND Pengambilan='1' AND ketBatal='10'"));
?>
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>A.1.b. JUMLAH DONOR YANG DITOLAK BERDASARKAN ALASAN PENOLAKAN</b></h2>
        </legend>
            <table class=form border=1 cellpadding=0 cellspacing=0>
                <!--                    <th colspan=7></th>-->
                <tr class="field">
                    <td style="text-align: center" >No.</td>
                    <td style="text-align: center; width: 700px" colspan="9">Alasan Penolakan</td>
                    <td style="text-align: center; width: 90px">Jumlah </br>(kantong)</td>
                </tr>
                <tr>
                    <td style="text-align: center">1</td>
                    <td colspan="9"><?="Berat Badan Kurang ( < 45 Kg)"?></td>
                    <td style="text-align: center" class="input"><?=$b1['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">2</td>
                    <td colspan="9"><?="Usia < 17 Tahun"?></td>
                    <td style="text-align: center" class="input">0</td>
                </tr>
                <tr>
                    <td style="text-align: center">3</td>
                    <td colspan="9"><?="Kadar Hb Rendah ( < 12,5 Gr/dl)"?></td>
                    <td style="text-align: center" class="input"><?=$b2['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">4</td>
                    <td colspan="9"><?="Riwayat Medis Lain (Hipertensi, Hipotensi, Minum Obat,
                    Pasca Operasi, Kadar Hb Tinggi > 17 Gr/dl)"?></td>
                    <td style="text-align: center" class="input"><?=$b3['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">5</td>
                    <td colspan="9"><?="Perilaku Beresiko Tinggi (Homo Seksual, Tato/Tindik Kurang Dari 6 Bulan,
                    Sex Bebas, Penasun, Napi"?></td>
                    <td style="text-align: center" class="input"><?=$b4['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">6</td>
                    <td colspan="9"><?="Riwayat Bepergian ( Daerah Endemis Malaria, Negara Dengan Kasus HIV Tinggi,
                    Negara Dengan Kasus Sapi Gila)"?></td>
                    <td style="text-align: center" class="input"><?=$b7['Jumlah']?></td>
                </tr>
                <tr>
                    <td style="text-align: center">7</td>
                    <td colspan="9"><?="Alasan Lain (Gagal pengambilan darah, dan lain-lain)"?></td>
                    <td style="text-align: center" class="input"><?=$b8['Jumlah']?></td>
                </tr>
            </table>
        </fieldset>
    </div>

    
<div style="display:table-cell">
    <fieldset>
        <legend class="table">
            <h2><b>A.1.c. TERIMA DARI UTD LAIN</b></h2>
        </legend>
            <table class=form border=1 cellpadding=0 cellspacing=0>
                <!--                    <th colspan=7></th>-->
                <tr class="field">
                    <td style="text-align: center; width: 50px" >No.</td>
                    <td style="text-align: center; width: 120px" colspan="5">Nama UTD</td>
                    <td style="text-align: center; width: 90px">Jumlah </br>(kantong)</td>
                </tr>

    <?
    			$drop = mysql_query("SELECT utd.nama,COUNT(terimaudd.nokantong) as jumlah FROM terimaudd INNER JOIN utd ON utd.id = terimaudd.udd  WHERE DATE(terimaudd.tgl)>='$sekarang' and DATE(terimaudd.tgl)<='$sekarang1' GROUP BY terimaudd.udd");

    $no=1;
      while ($utdlain = mysql_fetch_array($drop)){
      ?>
        <tr>
                    <td style="text-align: center"><?=$no++?></td>
                    <td colspan="5"><?=$utdlain['nama']?></td>
                    <td style="text-align: center" class="input"><?=$utdlain['jumlah']?></td>
                </tr>

        <?}?>    
		<?
    $jmldrop=mysql_fetch_assoc(mysql_query("SELECT\n".
					"COUNT(nokantong) as jml\n".
					"FROM\n".
					"terimaudd\n".
					"WHERE DATE(terimaudd.tgl)>='$sekarang' and DATE(terimaudd.tgl)<='$sekarang1'"));
    ?>
                <tr>
                    <td style="text-align: center" colspan="6">JUMLAH</td>
                    <td style="text-align: center" class="input"><?=$jmldrop['jml']?></td>
                </tr>
             
        </table>
        </td>

    </tr>
</table>
        </fieldset>
    </div>
</br>

<form name=xls method=post action=modul/rekap_pembuatan_kantong_xls.php>
<!--<input type=hidden name=pertgl value='--><?//=$pertgl?><!--'>-->
<!--<input type=hidden name=perbln value='--><?//=$perbln?><!--'>-->
<!--<input type=hidden name=perthn value='--><?//=$perthn?><!--'>-->
<!--<input type=hidden name=pertgl1 value='--><?//=$pertgl1?><!--'>-->
<!--<input type=hidden name=perbln1 value='--><?//=$perbln1?><!--'>-->
<!--<input type=hidden name=perthn1 value='--><?//=$perthn1?><!--'>-->
<!--<input type=hidden name=waktu value='--><?//=$sekarang?><!--'>-->
<!--<input type=hidden name=waktu1 value='--><?//=$sekarang1?><!--'>-->
<input type=submit name=submit value='Upload Laporan ke Server'>
</form>


