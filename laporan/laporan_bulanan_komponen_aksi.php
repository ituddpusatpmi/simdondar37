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

    $bwb=mysql_fetch_assoc(mysql_query("SELECT COUNT(s.nokantong) as Jumlah FROM dpengolahan s
         WHERE substr(s.tgl,1,10)>='$sekarang' AND substr(s.tgl,1,10)<='$sekarang1' AND s.Produk='WB' "));
    $bprc=mysql_fetch_assoc(mysql_query("SELECT COUNT(s.nokantong) as Jumlah FROM dpengolahan s
         WHERE substr(s.tgl,1,10)>='$sekarang' AND substr(s.tgl,1,10)<='$sekarang1' AND s.Produk='PRC' "));
    $bprp=mysql_fetch_assoc(mysql_query("SELECT COUNT(s.nokantong) as Jumlah FROM dpengolahan s
         WHERE substr(s.tgl,1,10)>='$sekarang' AND substr(s.tgl,1,10)<='$sekarang1' AND s.produk='FP' "));
    $bffp=mysql_fetch_assoc(mysql_query("SELECT COUNT(s.nokantong) as Jumlah FROM dpengolahan s
         WHERE substr(s.tgl,1,10)>='$sekarang' AND substr(s.tgl,1,10)<='$sekarang1' AND s.produk='FFP' "));
    $btc=mysql_fetch_assoc(mysql_query("SELECT COUNT(s.nokantong) as Jumlah FROM dpengolahan s
         WHERE substr(s.tgl,1,10)>='$sekarang' AND substr(s.tgl,1,10)<='$sekarang1' AND s.produk='TC'  "));
    $bahf=mysql_fetch_assoc(mysql_query("SELECT COUNT(s.nokantong) as Jumlah FROM dpengolahan s
         WHERE substr(s.tgl,1,10)>='$sekarang' AND substr(s.tgl,1,10)<='$sekarang1' AND s.produk='AHF' "));
    $bbuff="0";//mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(u.nokantong)) as Jumlah FROM user_komponen u WHERE substr(u.tglpembuatan,1,10)>='$sekarang' AND substr(u.tglpembuatan,1,10)<='$sekarang1' AND u.komponen='WB' "));
    $bwe=mysql_fetch_assoc(mysql_query("SELECT COUNT(s.nokantong) as Jumlah FROM dpengolahan s
         WHERE substr(s.tgl,1,10)>='$sekarang' AND substr(s.tgl,1,10)<='$sekarang1' AND s.produk='WE' "));

//    $mwb=mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='WB' "));
//    $mprc=mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='PRC' "));
//    $mprp=mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='FP' "));
//    $mffp=mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='FFP' "));
//    $mtc=mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='TC' "));
//    $mahf=mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='AHF' "));
//    $mbuff="0";//mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='WB' "));
//    $mwe=mysql_fetch_assoc(mysql_query("SELECT COALESCE(SUM(d.Jumlah),0) as Jumlah FROM dtranspermintaan d WHERE d.TglPerlu>='$sekarang' AND d.TglPerlu<='$sekarang1' AND d.JenisDarah='WE' "));

    $mwb=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='WB'"));
    $mprc=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='PRC' "));
    $mprp=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='FP' "));
    $mffp=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='FFP' "));
    $mtc=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='TC' "));
    $mahf=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='AHF' "));
    $mbuff=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='BUFFYCOAT' "));
    $mwe=mysql_fetch_assoc(mysql_query("select ifnull(SUM(dt.Jumlah),0) as Jumlah from dtranspermintaan dt
          where dt.TglPerlu>='$sekarang' and dt.TglPerlu<='$sekarang1' AND dt.JenisDarah='WE' "));

//    $pwb=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='WB' "));
//    $pprc=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='PRC' "));
//    $pprp=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='FP' "));
//    $pffp=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='FFP' "));
//    $ptc=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='TC' "));
//    $pahf=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='AHF' "));
//    $pbuff="0";/*mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='BUFF' "));*/
//    $pwe=mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
//            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
//            AND d.JenisDarah='WE' "));

    $pwb=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(d.NoKantong)) as Jumlah from
          dtransaksipermintaan d where d.tgl_keluar>='$sekarang' and d.tgl_keluar<='$sekarang1' AND d.Status='0' AND d.produk_darah='WB'"));
    $pprc=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(d.NoKantong)) as Jumlah from
          dtransaksipermintaan d where d.tgl_keluar>='$sekarang' and d.tgl_keluar<='$sekarang1' AND d.Status='0' AND d.produk_darah='PRC' "));
    $pprp=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(d.NoKantong)) as Jumlah from
          dtransaksipermintaan d where d.tgl_keluar>='$sekarang' and d.tgl_keluar<='$sekarang1' AND d.Status='0' AND (d.produk_darah='FP' OR d.produk_darah='LP')"));
    $pffp=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(d.NoKantong)) as Jumlah from
          dtransaksipermintaan d where d.tgl_keluar>='$sekarang' and d.tgl_keluar<='$sekarang1' AND d.Status='0' AND d.produk_darah='FFP' "));
    $ptc=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(d.NoKantong)) as Jumlah from
          dtransaksipermintaan d where d.tgl_keluar>='$sekarang' and d.tgl_keluar<='$sekarang1' AND d.Status='0' AND d.produk_darah='TC' "));
    $pahf=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(d.NoKantong)) as Jumlah from
          dtransaksipermintaan d where d.tgl_keluar>='$sekarang' and d.tgl_keluar<='$sekarang1' AND d.Status='0' AND d.produk_darah='AHF' "));
    $pbuff="0";/*mysql_fetch_assoc(mysql_query("select COUNT(dt.NoKantong) as Jumlah from dtransaksipermintaan dt, dtranspermintaan d
            where substr(dt.tgl,1,10)>='$sekarang' and substr(dt.tgl,1,10)<='$sekarang1' AND dt.NoForm=d.NoForm
            AND d.JenisDarah='BUFF' "));*/
    $pwe=mysql_fetch_assoc(mysql_query("select COUNT(DISTINCT(d.NoKantong)) as Jumlah from
          dtransaksipermintaan d where d.tgl_keluar>='$sekarang' and d.tgl_keluar<='$sekarang1' AND d.Status='0' AND d.produk_darah='WE' "));

//    $jumprod=mysql_fetch_assoc(mysql_query("SELECT COUNT(DISTINCT(u.nokantong)) as Jumlah FROM user_komponen u WHERE substr(u.tglpembuatan,1,10)>='$sekarang' AND substr(u.tglpembuatan,1,10)<='$sekarang1' AND u.komponen!='' "));
    $jumprod=$bwb['Jumlah']+$bprc['Jumlah']+$bprp['Jumlah']+$bffp['Jumlah']+$btc['Jumlah']+$bahf['Jumlah']+$bbuff['Jumlah']+$bwe['Jumlah'];
    $jumperm=$mwb['Jumlah']+$mprc['Jumlah']+$mprp['Jumlah']+$mffp['Jumlah']+$mtc['Jumlah']+$mahf['Jumlah']+$mbuff['Jumlah']+$mwe['Jumlah'];
    $jumpemk=$pwb['Jumlah']+$pprc['Jumlah']+$pprp['Jumlah']+$pffp['Jumlah']+$ptc['Jumlah']+$pahf['Jumlah']+$pbuff['Jumlah']+$pwe['Jumlah'];

    $utd=mysql_fetch_assoc(mysql_query("SELECT nama FROM utd WHERE aktif='1'"));
    ?>
    <h2 style="text-align: center">LAPORAN KOMPONEN DARAH
    </br><?=strtoupper($utd['nama'])?>
    </br>BULAN <?=strtoupper($bulan)?></h2>
    <br>
<div style="display:table-cell">
<fieldset>
    <legend class="table">
        <h2><b>E. KOMPONEN DARAH</b></h2>
    </legend>
    <table><tr>
                <table class=form border=1 cellpadding=0 cellspacing=0>
<!--                    <th colspan=7></th>-->
                    <tr class="field">
                        <td style="text-align: center; width: 500px" rowspan="2" colspan="2">NAMA KOMPONEN</td>
                        <td style="text-align: center; width: 450px" colspan="3">JUMLAH</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; width: 120px">PRODUKSI</td>
                        <td style="text-align: center; width: 140px">PERMINTAAN</td>
                        <td style="text-align: center; width: 170px">PEMAKAIAN</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" rowspan="8">BIASA</td>
                        <td>WB</td>
                        <td style="text-align: center" class="input"><?=$bwb['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mwb['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$pwb['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td>PRC</td>
                        <td style="text-align: center" class="input"><?=$bprc['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mprc['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$pprc['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td>PLASMA/PRP</td>
                        <td style="text-align: center" class="input"><?=$bprp['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mprp['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$pprp['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td>FFP</td>
                        <td style="text-align: center" class="input"><?=$bffp['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mffp['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$pffp['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td>TC</td>
                        <td style="text-align: center" class="input"><?=$btc['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mtc['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$ptc['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td>C-P/AHF</td>
                        <td style="text-align: center" class="input"><?=$bahf['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mahf['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$pahf['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td>BUFFYCOAT</td>
                        <td style="text-align: center" class="input"><?=$bbuff['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mbuff['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$pbuff['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td>WE</td>
                        <td style="text-align: center" class="input"><?=$bwe['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$mwe['Jumlah']?></td>
                        <td style="text-align: center" class="input"><?=$pwe['Jumlah']?></td>
                    </tr>
                    <tr>
                        <td style="text-align: center" rowspan="4">LEUCODEPLETED</td>
                        <td>BUFFYCOAT REMOVAL</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                    </tr>
                    <tr>
                        <td>INLINE FILTER LEKOSIT</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                    </tr>
                    <tr>
                        <td>BEDSIDE FILTER LEKOSIT</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                    </tr>
                    <tr>
                        <td>LAB TYPE FILTER LEKOSIT</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                    </tr>
                    <tr>
                        <td style="text-align: center" rowspan="3">APHERESIS</td>
                        <td>PRC</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                    </tr>
                    <tr>
                        <td>TC</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                    </tr>
                    <tr>
                        <td>PLASMA</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                        <td style="text-align: center" class="input">0</td>
                    </tr>
                    <tr><td style="text-align: center" colspan="2"><b>JUMLAH</b></td>
                        <td style="text-align: center" class="input"><?=$jumprod?></td>
                        <td style="text-align: center" class="input"><?=$jumperm?></td>
                        <td style="text-align: center" class="input"><?=$jumpemk?></td>
                    </tr>
                </table>

        </tr>
    </table>
</fieldset>
</div>
</br>
    <div style="display:table-cell">
        <fieldset>
            <legend class="table">
                <h2><b>Keterangan :</b></h2>
            </legend>
<table>
    <tr>
    <td>WB</td>
        <td>:</td>
        <td><i>Whoole Blood</i></td>
    </tr>
    <tr>
    <td>PRC</td>
        <td>:</td>
        <td><i>Packed Red Cell</i></td>
    </tr>
    <tr>
    <td>FFP</td>
        <td>:</td>
        <td><i>FRESH FROZEN PLASMA</i></td>
    </tr>
    <tr>
    <td>TC</td>
        <td>:</td>
        <td><i>Trombocyte Concentrat</i></td>
    </tr>
    <tr>
    <td>C-P/AHF</td>
        <td>:</td>
        <td><i>Cryo-Precipitate / AHF</i></td>
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

