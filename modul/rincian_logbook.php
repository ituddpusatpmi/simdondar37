<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

<?
  include('clogin.php');
  include('config/db_connect.php');
?>
<?php
  $awalbulan=date("Y-m-01");
  $hariini = date("Y-m-d");
  
  
?>

<h2 class="list">RINCIAN TRANSAKSI LOGBOOK PERALATAN</h2>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
    <table>
    <tr>
        <td>Pilih Periode </td>
    <td>
        : <input name="waktu" id="datepicker"  value="<?=$awalbulan?>" type=text size=10> Sampai Dengan
        <input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10>
        <td>
<tr>
    <td>Fungsi</td>
    <td class="input">:
        <select name="fungsi">
            <option value="">Pilih Semua</option>
            <?php
            $q = "select * from logbook_f";
            $do = mysql_query($q, $con);
            while ($data = mysql_fetch_assoc($do)) {
                $select = "";
            ?>
                <option value="<?= $data[fungsi] ?>" <?= $select ?>><?= $data[fungsi] ?>
                </option>
            <? } ?>
        </select>
    </td>
</tr>
<tr>
    <td>Bagian</td>
    <td class="input">:
        <select name="bagian">
            <option value="">Semua Bagian</option>
            <option value="PPDDS">PPDDS</option>
            <option value="Logistik">Logistik</option>
            <option value="Seleksi Donor">Seleksi Donor</option>
            <option value="Aftap">Aftap</option>
            <option value="Mobile">Mobile Unit</option>
            <option value="KGD">Konfirmasi Golongan Darah</option>
            <option value="IMLTD">IMLTD</option>
            <option value="Komponen">Komponen</option>
            <option value="Karantina">Karantina</option>
            <option value="Pasien Service">Pasien service</option>
            <option value="Crossmatch">Crossmatch</option>
            <option value="Distribusi">Distribusi(BDRS)</option>
            <option value="HumasIT">Humas & IT</option>
            <option value="Pimpinan">Pimpinan</option>
            <option value="Konseling">Konseling</option>
            <option value="Administrator">Administrator</option>
            <option value="QA">QA</option>
            <option value="QC">QC</option>
            <option value="Keuangan">Keuangan</option>
            <option value="Umum">Umum</option>
            <option value="SDM">SDM</option>
            <option value="Aset Sarpras">Aset & Sarpras</option>
            <option value="Kasir CSO">Kasir & CSO</option>
            <option value="Poliklinik">Poliklinik</option>
            <option value="Koperasi">Koperasi</option>
            <option value="Hemodialisis">Hemodialisis</option>
            <option value="Poli Kandungan">Poli Kandungan</option>
            <option value="PB Satgana">PB/Satgana</option>
            <option value="Sekretariat">Sekretariat</option>
            <option value="Lab Klinik">Lab. Klinik</option>
            <option value="Mobile Unit">Mobile Unit</option>
        </select>
    </td>
</tr>
        
    </td>
        <td><input type=submit name=submit value="Submit"></td>
    </tr>
    </table>
</form>

<?
if (isset($_POST[submit])){

    $perbln=substr($_POST[waktu],5,2);
    $pertgl=substr($_POST[waktu],8,2);
    $perthn=substr($_POST[waktu],0,4);

    $perbln1=substr($_POST[waktu1],5,2);
    $pertgl1=substr($_POST[waktu1],8,2);
    $perthn1=substr($_POST[waktu1],0,4);
    $fungsi = $_POST['fungsi'];
    $bagian = $_POST['bagian'];
    if ($bagian !=""){ $sqlbag = " AND bagian ='$bagian'";}else{ $sqlbag ="";}
?>
<h3 class="list">Periode <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> s/d <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?></h3>

<?
    if ($fungsi ==""){
    $query = "SELECT
        pmi.logbook_d.*,
        pmi.logbook_h.nama_barang,
        pmi.logbook_h.fungsi,
        pmi.logbook_h.bagian
        FROM
        pmi.logbook_d
        JOIN pmi.logbook_h
        ON pmi.logbook_d.kode = pmi.logbook_h.kode
        where date(pmi.logbook_d.tgl)>='$_POST[waktu]' AND
        date(pmi.logbook_d.tgl)<='$_POST[waktu1]' $sqlbag";
    
        $data=mysql_query($query);
        //echo $query;
    } else {
        $query = "SELECT
            pmi.logbook_d.*,
            pmi.logbook_h.nama_barang,
            pmi.logbook_h.fungsi,
            pmi.logbook_h.bagian
            FROM
            pmi.logbook_d
            JOIN pmi.logbook_h
            ON pmi.logbook_d.kode = pmi.logbook_h.kode
            where date(pmi.logbook_d.tgl)>='$_POST[waktu]' AND
            date(pmi.logbook_d.tgl)<='$_POST[waktu1]' AND pmi.logbook_h.fungsi='$fungsi' $sqlbag";
        
            $data=mysql_query($query);
            //echo $query;
    }
?>
<table class="list" cellpadding=5 cellspacing=1 border=1 style="border-collapse:collapse">
    <tr class="field">
        <td>No</td>
        <td>Tanggal</td>
        <td>Kode Alat</td>
        <td>Nama Alat</td>
        <td>Fungsi</td>
        <td>Bagian</td>
        <td>Keterangan</td>
        <td>Status</td>
        <td>Pelaksana</td>
    </tr>
    <?
    $no=0;
    while ($data1=mysql_fetch_assoc($data)) {
    $no++;
    if($data1[status]=="0"){$stat ="Rusak";}else if($data1[status]=="1"){$stat ="Baik";}else if($data1[status]=="2"){$stat ="Dalam Proses Kalibrasi";}else{$stat ="Dalam Proses Perawatan";}
    ?>
    
    <tr class="record">
        <td align="right"><?=$no?>.</td>
        <td align="center"><?=$data1[tgl]?></td>
        <td align="center"><a href=pmiqc.php?module=history_logbook&kode=<?= $data1[kode] ?>><?=$data1[kode]?></a></td>
        <td align="left"><?=$data1[nama_barang]?></td>
        <td align="left"><?=$data1[fungsi]?></td>
        <td align="left"><?=$data1[bagian]?></td>
        <td align="left"><?=$data1[uraian]?></td>
        <td align="left"><?=$stat?></td>
        <td align="left"><?=$data1[petugas]?></td>
    </tr>
    <? } ?>
</table>
</form>
<a href="javascript:window.print()">Cetak</a>
<?
}

