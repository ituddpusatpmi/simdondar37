<?php
session_start();
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
  echo "<link href='config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php target=\"_top\"><b>LOGIN</b></a></center>";
}
if ($_SESSION[leveluser]=='monev' or $_SESSION[leveluser]=='bdrs'){?>
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
    elseif ($_GET[module]=='rekap'){ 
        include "receptionis_rekap.php";
    }
    elseif ($_GET[module]=='rekap_transaksi'){ 
        include "modul/rekap_transaksi_harian.php";
    }
    elseif ($_GET[module]=='cetak_minta'){
	include ('color.inc');
        include "modul/mod_cetak_minta.php";
    }
    elseif ($_GET[module]=='formdds'){
        include "modul/form_dds.php";
    }
    elseif ($_GET[module]=='tambah_permintaan'){
        include "modul/mod_tambah_permintaan.php";
    }
    elseif ($_GET[module]=='rekap_darah_keluar'){
        include "modul/rekap_darah_keluar.php";
    }
	elseif ($_GET[module]=='rekap_darah_keluar_bdrs'){
        include "modul/rekap_darah_keluar_bdrs.php";
    }
    elseif ($_GET[module]=='rekap_darah_keluar_udd'){
        include "modul/rekap_darah_keluar_udd.php";
    }

    elseif ($_GET[module]=='rekap_permintaan'){
        include "modul/rekap_permintaan_harian.php";
    }
    elseif ($_GET[module]=='rekap_transaksi'){
        include "modul/rekap_transaksi_harian.php";
    }
    elseif ($_GET[module]=='piagam'){
   	include  "modul/piagam.php";
    }
    elseif ($_GET[module]=='registrasi'){
        include "modul/registrasi.php";
    }
    elseif ($_GET[module]=='cetak_id'){
	include "color.inc";
        include "modul/cetak_id.php";
    }
    elseif ($_GET[module]=='search_pendonor_calling'){
        include "modul/search_pendonor_calling.php";
    }
    elseif ($_GET[module]=='search_dds'){
        include "modul/search_dds100.php";
    }
    elseif ($_GET[module]=='double_pendonor'){
        include "modul/double_pendonor.php";
    }
    elseif ($_GET[module]=='eregistrasi'){
        include "modul/edit_registrasi.php";
    }
    elseif ($_GET[module]=='transaksi_donor'){
        include "modul/transaksi_donor.php";
    }
elseif ($_GET[module]=='transaksi_donor_edit'){
        include "modul/transaksi_donor_edit.php";
    }
    elseif ($_GET[module]=='nota1'){
        include "nota1.php";
    }
    elseif ($_GET[module]=='bayar'){
	include "color.inc";
        include "modul/mod_cetak_pembayaran.php";
    }
    elseif ($_GET[module]=='pembayaran'){
	include "color.inc";
        include "modul/mod_pembayaran.php";
    }
    elseif ($_GET[module]=='kembali'){
        include "modul/mod_kembali.php";
    }
    elseif ($_GET[module]=='stock'){
        include  "modul/stock.php";
    }
    elseif ($_GET[module]=='tambah_dokter'){
        include  "modul/tambah_dokter.php";
    }
    elseif ($_GET[module]=='tambah_dokter_periksa'){
        include  "modul/tambah_dokter_periksa.php";
    }
    elseif ($_GET[module]=='tambah_bagian'){
        include  "modul/tambah_bagian.php";
    }
    elseif ($_GET[module]=='tambah_layanan'){
        include  "modul/tambah_jenislayanan.php";
    }
    elseif ($_GET[module]=='tambah_rs'){
        include  "modul/tambah_rmhsakit.php";
    }
    elseif ($_GET[module]=='tambah_bdrs'){
        include  "modul/tambah_bdrs_kasir.php";
    }

    elseif ($_GET[module]=='receptionis_pendonor'){
        include  "receptionis_pendonor.php";
    }
    elseif ($_GET[module]=='monev_transaksi'){
        include  "monev_transaksi.php";
    }
    elseif ($_GET[module]=='receptionis_cetak'){
        include  "receptionis_cetak.php";
    }
    elseif ($_GET[module]=='ganti_menu'){
        include  "ganti_menu.php";
    }
    elseif ($_GET[module]=='ganti_passwd'){
       include "modul/ganti_passwd.php";
    }
    elseif ($_GET[module]=='ganti_shift'){
       include "modul/ganti_shift.php";
    }
    elseif ($_GET[module]=='sejarah'){
    	include  "modul/sejarah_pendonor.php";
   }
   elseif ($_GET[module]=='list_sejarah'){
    	include  "modul/sejarah.php";
   }
   elseif ($_GET[module]=='upload_foto'){
    	include  "modul/upload_foto.php";
   }
   elseif ($_GET[module]=='edit_harga'){
    	include  "modul/edit_harga.php";
   }
   elseif ($_GET[module]=='pasien_plebotomi'){
       include  "modul/search_pasien_plebotomi.php";
    }
   elseif ($_GET[module]=='registrasi_pasien_plebotomi'){
       include  "modul/registrasi_pasien_plebotomi.php";
   }
   elseif ($_GET[module]=='eregistrasi_pasien_plebotomi'){
        include "modul/edit_registrasi_pasien_plebotomi.php";
   }
   elseif ($_GET[module]=='transaksi_plebotomi'){
        include "modul/transaksi_plebotomi.php";
    }
    elseif ($_GET[module]=='sejarah_pasien_plebotomi'){
        include "modul/sejarah_pasien_plebotomi.php";
    }
    elseif ($_GET[module]=='laporan_pasien_plebotomi'){
        include "modul/laporan_pasien_plebotomi.php";
    }
    elseif ($_GET[module]=='piagam'){
        include  "modul/piagam.php";
    }
    elseif ($_GET[module]=='ajukan_piagam'){
      include  "modul/ajukan_piagam.php";
    }
    elseif ($_GET[module]=='edit_piagam'){
       include  "modul/edit_piagam.php";
    }
    elseif ($_GET[module]=='edit_piagam1'){
       include  "modul/edit_piagam1.php";
    }
    elseif ($_GET[module]=='laporan_piagam'){
       include  "modul/laporan_piagam.php";
    }
    elseif ($_GET[module]=='rekap_pembayaran'){
       include  "modul/rekap_pembayaran.php";
    }
    elseif ($_GET[module]=='updatekantong'){
    	include  "modul/update_sah_kantong.php";
    }
    elseif ($_GET[module]=='rincian_minta_barang'){
                 include "logistik/rincian_transaksi_minta_barang.php";
    }

//aftap level kasir
elseif ($_GET[module]=='aftap1'){ 
        include "aftap2.php";
    }
elseif ($_GET[module]=='check'){ 
        include "modul/search_med_check.php";
    }
elseif ($_GET[module]=='spengambilan'){ 
        include "modul/search_transaksi.php";
    }
elseif ($_GET[module]=='gantikantong'){ 
        include "modul/search_transaksi_gk.php";
    }
elseif ($_GET[module]=='checkup'){ 
        include "modul/medical_checkup.php";
    }
 elseif ($_GET[module]=='pengambilan'){ 
        include "modul/pengambilan_darah.php";
    }
elseif ($_GET[module]=='pengambilan_plebotomi'){
    include  "modul/pengambilan_darah_plebotomi.php";
    }
elseif ($_GET[module]=='laporan_pasien_plebotomi'){
    include "modul/laporan_pasien_plebotomi.php";
    }
elseif ($_GET[module]=='daftar_permintaan_plebotomi'){
    include  "modul/daftar_permintaan_plebotomi_1.php";
    }
elseif ($_GET[module]=='rekap_sejarah'){
    include  "modul/sejarah_donor_xls.php";
}
   
   elseif ($_GET[module]=='deltransaksi'){
    	include  "modul/del_transaksi.php";
   }
   elseif ($_GET[module]=='delmedical'){
    	include  "modul/del_med_check.php";
   }


elseif ($_GET[module]=='rekap_pembayaran1'){
       include  "modul/rekap_pembayaran_new.php";
      }
	elseif ($_GET[module]=='rekap_piagam'){
       include  "modul/rekap_piagam.php";
      }
	elseif ($_GET[module]=='laporan_cetak_kartu'){
       include  "modul/rekap_cetak_kartu.php";
      }



  elseif ($_GET[module]=='historycetak'){
    	include  "modul/historycetak.php";
   }


elseif ($_GET[module]=='edit_datapasien'){
                 include "modul/edit_permintaan.php";

}


elseif ($_GET[module]=='pengambilan_apheresis'){ 
        include "modul/pengambilan_darah_apheresis.php";
    }


    
}
?>

<?php
}
?>
