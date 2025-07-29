<?php
session_start();
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<link href='config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=index.php target=\"_top\"><b>LOGIN</b></a></center>";
}
if (($_SESSION['leveluser']) == 'keuangan') { ?>
    <html>

    <head>
        <title>SIMDONDAR</title>
        <script language=javascript src="idcard.js" type="text/javascript"> </script>
        <script language=javascript src="util.js" type="text/javascript"> </script>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
    switch ($_GET['act']) {
        default:
            if ($_GET['rstock'] == '1')
                include "modul/stock.php";
            include "config/koneksi.php";
            include "config/fungsi_combobox.php";
            include "config/library.php";

            if ($_GET['module'] == 'home') {
                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src=images/donate.jpg>";
            } elseif ($_GET['module'] == 'keuangan1') {
                include "keuangan1_transaksi.php";
            } elseif ($_GET['module'] == 'keuangan2') {
                include "keuangan2_rekap.php";
            } elseif ($_GET['module'] == 'ganti_menu') {
                include "ganti_menu.php";
            } elseif ($_GET['module'] == 'ganti_passwd') {
                include "modul/ganti_passwd.php";
            } elseif ($_GET['module'] == 'rekap_beli') {
                include "logistik/rekap_pembelian_barang.php";
            } elseif ($_GET['module'] == 'rekap_jual') {
                include "logistik/rekap_penjualan_barang.php";
            } elseif ($_GET['module'] == 'rekap_hutang') {
                include "logistik/rekap_hutang_pembelian_barang.php";
            } elseif ($_GET['module'] == 'rekap_piutang') {
                include "logistik/rekap_piutang_penjualan_barang.php";
            } elseif ($_GET['module'] == 'rincian_minta_barang') {
                include "logistik/rincian_transaksi_minta_barang.php";
            }
    }
?>
<?php
}
?>