<?php
session_start();
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
  echo "<link href='config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php target=\"_top\"><b>LOGIN</b></a></center>";
}
if ($_SESSION[leveluser]=='kepegawaian' or $_SESSION[leveluser]=='bdrs'){?>
<!doctype html>

<html>
<head>
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
        include "kepegawaian_rekap.php";
    }
    elseif ($_GET[module]=='rekap_transaksi'){ 
        include "modul/rekap_transaksi_harian.php";
    }
    elseif ($_GET[module]=='cetak_minta'){
	include ('color.inc');
        include "modul/mod_cetak_minta.php";
    }
    elseif ($_GET[module]=='cuti'){
        include "kepegawaian/datacuti.php";
    }
    elseif ($_GET[module]=='sejarahcuti'){
        include "kepegawaian/sejarah_cuti.php";
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
    elseif ($_GET[module]=='kgb'){
   	include  "kepegawaian/kgb.php";
    }
    elseif ($_GET[module]=='penghargaan10'){
   	include  "kepegawaian/penghargaan_p10.php";
    }
    elseif ($_GET[module]=='penghargaan20'){
   	include  "kepegawaian/penghargaan_p20.php";
    }
    elseif ($_GET[module]=='penghargaan30'){
   	include  "kepegawaian/penghargaan_p30.php";
    }
     elseif ($_GET[module]=='penghargaanpp'){
   	include  "kepegawaian/penghargaan_pp.php";
    }
    elseif ($_GET[module]=='sejarahpenghargaan'){
   	include  "kepegawaian/sejarah_penghargaan.php";
    }
    elseif ($_GET[module]=='kp'){
   	include  "kepegawaian/kp.php";
    }
    elseif ($_GET[module]=='registrasi'){
        include "kepegawaian/registrasi_kepeg.php";
    }
     elseif ($_GET[module]=='registrasi_kontrak'){
        include "kepegawaian/registrasi_kepeg_kontrak.php";
    }
    elseif ($_GET[module]=='mutasi'){
   	include  "kepegawaian/mutasi.php";
    }
    elseif ($_GET[module]=='tambah_bagian'){
   	include  "kepegawaian/tambah_bagian_peg.php";
    }elseif ($_GET[module]=='tambah_direktorat'){
   	include  "kepegawaian/tambah_direktorat_peg.php";
    }
    elseif ($_GET[module]=='rekap_pegawai'){
   	include  "kepegawaian/rekap_pegawai.php";
    }
	elseif ($_GET[module]=='grafik_pegawai'){
   	include  "kepegawaian/graph_pegawai.php";
    }
    elseif ($_GET[module]=='cetak_id'){
	include "color.inc";
        include "modul/cetak_id.php";
    }
    elseif ($_GET[module]=='search_kepeg'){
        include "kepegawaian/search_kepeg.php";
    }
     elseif ($_GET[module]=='search_kepeg_kontrak'){
        include "kepegawaian/search_kepeg_kontrak.php";
    }
    elseif ($_GET[module]=='double_pendonor'){
        include "modul/double_pendonor.php";
    }
    elseif ($_GET[module]=='eregistrasi'){
        include "kepegawaian/edit_registrasi_kepeg.php";
    }
    elseif ($_GET[module]=='eregistrasi_kontrak'){
        include "kepegawaian/edit_registrasi_kepeg_kontrak.php";
    }
    elseif ($_GET[module]=='datakeluarga'){
        include "kepegawaian/datakeluarga.php";
    }
elseif ($_GET[module]=='datadiklat'){
        include "kepegawaian/datadiklatpeg.php";
    }
elseif ($_GET[module]=='datatugas'){
        include "kepegawaian/datatugaspeg.php";
    }
    elseif ($_GET[module]=='rekap_pensiun'){
        include "kepegawaian/rekap_pensiun.php";
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
    elseif ($_GET[module]=='kepeg_transaksi'){
        include  "kepeg_transaksi.php";
    }elseif ($_GET[module]=='pengajuan_piagam'){ 
        include "kepegawaian/rekap_pengajuan_piagam.php";
    }elseif ($_GET[module]=='receptionis_cetak'){
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
    elseif ($_GET[module]=='rekap_kgb'){
    	include  "kepegawaian/rekap_kgb.php";
   }	
elseif ($_GET[module]=='rekap_kp'){
    	include  "kepegawaian/rekap_kp.php";
   }
elseif ($_GET[module]=='laporan_kp'){
    	include  "kepegawaian/hasil_rekap_kp.php";
   }
elseif ($_GET[module]=='laporan_kgb'){
    	include  "kepegawaian/hasil_rekap_kgb.php";
   }
elseif ($_GET[module]=='editkp'){
    	include  "kepegawaian/edit_kp.php";
   }
elseif ($_GET[module]=='ubah_ijasah'){
    	include  "kepegawaian/ijasah.php";
   }
elseif ($_GET[module]=='dp2'){
    	include  "kepegawaian/form_dp2.php";
   }
elseif ($_GET[module]=='skp'){
    	include  "kepegawaian/form_dp3.php";
   }
	
    elseif ($_GET[module]=='sejarahkgb'){
    	include  "kepegawaian/sejarah_kgb.php";
   }
    elseif ($_GET[module]=='sejarahkp'){
    	include  "kepegawaian/sejarah_kp.php";
   }
    elseif ($_GET[module]=='sejarahpeg'){
    	include  "kepegawaian/sejarah_kepegawaian.php";
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
