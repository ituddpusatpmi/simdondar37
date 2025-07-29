<?php
session_start();
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
  echo "<link href='config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php target=\"_top\"><b>LOGIN</b></a></center>";
}
if (($_SESSION[leveluser])=='saranaprasarana'){?>
<!doctype html>
<html>
<head>
  <title>SIMDONDAR</title>
  <script language=javascript src="idcard.js" type="text/javascript"> </script>
  <script language=javascript src="util.js" type="text/javascript"> </script>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<?php

//require_once('color.inc');
switch($_GET[act]){

default:
if ($_GET['rstock']=='1') include "modul/stock.php";
include "config/koneksi.php";
include "config/fungsi_combobox.php";
include "config/library.php";

if ($_GET[module]=='home'){
          echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src=images/donate.jpg>";
}
elseif ($_GET[module]=='penambahan_kantong'){ 
		include "color.inc";
                 include "modul/penambahan_kantong.php";
}
elseif ($_GET[module]=='pengesahan_kantong'){ 
                 include "modul/pengesahan_kantong.php";
}
elseif ($_GET[module]=='penghapusan_kantong'){ 
                 include "modul/penghapusan_kantong.php";
}
elseif ($_GET[module]=='reagen'){
                 include "modul/entry_reagen.php";
}
elseif ($_GET[module]=='master_reagen'){
                 include "modul/master_reagen.php";
}
elseif ($_GET[module]=='pindah_ke_lab'){
                 include "modul/reagen_ke_lab.php";
}
elseif ($_GET[module]=='buang_reagen'){
                 include "modul/reagen_buang.php";
}
elseif ($_GET[module]=='dreagen'){
                 include "modul/daftar_pegawai.php";
}
elseif ($_GET[module]=='ganti_menu'){
        include  "ganti_menu.php";
    }
elseif ($_GET[module]=='master_stok'){
                 include "modul/master_stok.php";
}
elseif ($_GET[module]=='master_paket'){
                 include "modul/master_paket.php";
}
elseif ($_GET[module]=='distribusi_paket'){
                 include "distribusi_paket.php";
}
elseif ($_GET[module]=='formulir'){
                 include "modul/entry_formulir.php";
}
elseif ($_GET[module]=='rekap_kantong_baru'){
                 include "modul/rekap_pembuatan_kantong.php";
}
elseif ($_GET[module]=='ganti_passwd'){
                 include "modul/ganti_passwd.php";
}
elseif ($_GET[module]=='klik'){
                 include "modul/klik_sah_kantong.php";
}
elseif ($_GET[module]=='rekap_pindahan_kantong'){
                 include "modul/rekap_pindahan_kantong.php";
}
elseif ($_GET[module]=='pindahan_kantong'){
                 include "modul/klik_sah_kantong.php";
}
//edit untuk logistik
elseif ($_GET[module]=='master_barang'){
		include "modul/master_barang_list.php";
}
elseif ($_GET[module]=='entry_barang'){
                 include "modul/entry_barang.php";
}
elseif ($_GET[module]=='edit_master_barang'){
                 include "modul/edit_barang.php";
}
elseif ($_GET[module]=='kartu_stok'){
                 include "logistik/kartu_stok_barang.php";
}
elseif ($_GET[module]=='transaksi_beli'){
                 "logistik/transaksi_beli.php";
}
elseif ($_GET[module]=='transaksi_bantuan'){
                 include "logistik/transaksi_bantuan.php";
}
elseif ($_GET[module]=='kontak'){
        include "modul/master_kontak.php";
}
elseif ($_GET[module]=='entry_kontak'){
        include "modul/master_kontak_entry.php";
}
elseif ($_GET[module]=='edit_kontak'){
        include "modul/master_kontak_edit.php";
}
elseif ($_GET[module]=='koreksi_stok'){
                 include "modul/koreksi_stok_barang.php";
}
elseif ($_GET[module]=='logistik1'){
                 include "logistik1_master_reagen.php";
}
elseif ($_GET[module]=='logistik2'){
                 include "logistik2_transaksi.php";
}
elseif ($_GET[module]=='logistik3'){
                 include "logistik3_rekap.php";
}
elseif ($_GET[module]=='rekap_beli'){
                 include "logistik/rekap_pembelian_barang.php";
}
elseif ($_GET[module]=='rekap_bantuan'){
                 include "logistik/rekap_bantuan_barang.php";
}
elseif ($_GET[module]=='rekap_jual'){
                 include "logistik/rekap_penjualan_barang.php";
}
elseif ($_GET[module]=='rekap_pemakaian'){
                 include "logistik/rekap_pemakaian_barang.php";
}
elseif ($_GET[module]=='rekap_koreksi'){
                 include "logistik/rekap_koreksi_barang.php";
}
elseif ($_GET[module]=='rekap_keluar'){
                 include "logistik/rekap_keluar_barang.php";
}
elseif ($_GET[module]=='rekap_masuk'){
                 include "logistik/rekap_masuk_barang.php";
}
elseif ($_GET[module]=='rekap_hutang'){
                 include "logistik/rekap_hutang_pembelian_barang.php";
}
elseif ($_GET[module]=='rekap_piutang'){
                 include "logistik/rekap_piutang_penjualan_barang.php";
}
elseif ($_GET[module]=='rincian_transaksi_beli'){
                 include "logistik/rincian_transaksi_pembelian.php";
}
elseif ($_GET[module]=='rincian_transaksi_jual'){
                 include "logistik/rincian_transaksi_penjualan.php";
}
elseif ($_GET[module]=='rincian_transaksi_bantuan'){
                 include "logistik/rincian_transaksi_bantuan.php";
}
elseif ($_GET[module]=='rincian_transaksi_keluar'){
                 include "logistik/rincian_transaksi_pemakaian.php";
}
elseif ($_GET[module]=='cetak_rincian_transaksi_beli'){
                 include "logistik/print_rincian_transaksi_pembelian.php";
}
elseif ($_GET[module]=='rekap_order_beli'){
                 include "logistik/rekap_order_pembelian_barang.php";
}
elseif ($_GET[module]=='rincian_order_beli'){
                 include "logistik/rincian_transaksi_order_pembelian.php";
}
elseif ($_GET[module]=='rekap_stok'){
                 include "logistik/rekap_stok_barang.php";
}
elseif ($_GET[module]=='rincian_minta_barang'){
                 include "logistik/rincian_transaksi_minta_barang.php";
}
elseif ($_GET[module]=='rekap_minta'){
                 include "logistik/rekap_minta_barang.php";
}
elseif ($_GET[module]=='rekap_minta_proses'){
                 include "logistik/rekap_minta_belum_selesai.php";
}
elseif ($_GET[module]=='close_minta_barang'){
                 include "logistik/close_permintaan_barang.php";
}
elseif ($_GET[module]=='transaksi_penuhi_barang'){
                 include "logistik/transaksi_penuhi_permintaan.php";
}

elseif ($_GET[module]=='rekap_sisa_kantong_diaftap'){
                 include "modul/rekap_kantong_aftap_belum_terpakai.php";
}
elseif ($_GET[module]=='cetakulang_barcode'){
		include "color.inc";
                 include "modul/cetakulang_barcode.php";
}

//kantong apheresis
elseif ($_GET[module]=='penambahan_kantong_apheresis'){ 
		include "color.inc";
                include "modul/penambahan_kantong_apheresis.php";
}



}

?>
<?php
}
?>
