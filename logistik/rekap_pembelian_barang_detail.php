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

<h2 class="list">REKAP PEMBELIAN BARANG</h2>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
    <table>
    <tr>
    <td>Pilih Periode : </td>
    <td>
    <input name="waktu" id="datepicker"  value="<?=$awalbulan?>" type=text size=10> Sampai Dengan
    <input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10>
    </td><td>
    <input type=submit name=submit value="Submit"></td></tr></table>
</form>

<?
if (isset($_POST[submit])){

    $perbln=substr($_POST[waktu],5,2);
    $pertgl=substr($_POST[waktu],8,2);
    $perthn=substr($_POST[waktu],0,4);

    $perbln1=substr($_POST[waktu1],5,2);
    $pertgl1=substr($_POST[waktu1],8,2);
    $perthn1=substr($_POST[waktu1],0,4);
?>
<h3 class="list">Periode <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> s/d <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?></h3>

<?
    $data=mysql_query("SELECT
                      *,
                      pmi.hstok.namabrg as nama
                      FROM
                      pmi.hstok_transaksi_detail
                      JOIN pmi.hstok
                      ON pmi.hstok_transaksi_detail.kode = pmi.hstok.kode
                      WHERE
                      qtymasuk >=0 and hstok_transaksi_detail.harga > 1 and date(hstok_transaksi_detail.insert_on) between '$_POST[waktu]' AND '$_POST[waktu1]'
                      GROUP BY
                      hstok_transaksi_detail.kode");
    
?>
<table class="list" cellpadding=5 cellspacing=1>
    <tr class="field">
        <td>No</td>
        <td>Nama Barang</td>
        <td>Kode</td>
        <td>Jumlah Beli</td>
        <td>Harga Satuan</td>
        <td>Total</td>
        
    </tr>
    <?
    $no=0;
    while ($data1=mysql_fetch_assoc($data)) {
    $no++;
    /*$subtotal =number_format($data1['subtotal'],0,',','.');
    $potongan =number_format($data1['potongan'],0,',','.');
    $bayar =number_format($data1['bayar'],0,',','.');
    $sisa =number_format($data1['sisa'],0,',','.');
    $total =number_format($data1['total'],0,',','.');
    $biayalain =number_format($data1['biayalain'],0,',','.');
    $ppnrupiah=($data1['subtotal'] - $data1['potongan'])*$data1['ppn']/100;
    $ppnrupiah=number_format($ppnrupiah,0,',','.');*/
    ?>
    
    
    <tr class="record">
        <td align="right"><?=$no?>.</td>
        <td align="left"><?=$data1[nama]?></td>
        <td align="left"><a href=pmilogistik.php?module=kartu_stok&kode=<?=$data1[kode]?>><?=$data1[kode]?></a></td>
        <?
            $detail=mysql_fetch_assoc(mysql_query("select sum(qtymasuk) as qtymasuk, harga, sum(subtotal) as subtotal
                                                  from hstok_transaksi_detail where kode='$data1[kode]'  and date(insert_on) between '$_POST[waktu]' AND '$_POST[waktu1]'"));
            $harga =number_format($detail['harga'],0,',','.');
            $subtotal = $detail['harga'] * $detail['qtymasuk'];
            $total = number_format($subtotal,0,',','.');
        ?>
        <td align="right"><?=$detail[qtymasuk]?></td>
        <td align="right"><?=$harga?></td>
        <td align="right"><?=$total?></td>
                                                  
        
    </tr>
    <? } ?>
</table>
</form>

<?
}
?>

