<?php
session_start();
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<link href='config/adminstyle.css' rel='stylesheet' type='text/css'>
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=index.php target=\"_top\"><b>LOGIN</b></a></center>";
}
if (($_SESSION['leveluser']) == 'aftap') { ?>
    <!doctype html>
    <html>
    <html>

    <head>
        <title>SIMDONDAR</title>
        <script language=javascript src="idcard.js" type="text/javascript"> </script>
        <script language=javascript src="util.js" type="text/javascript"> </script>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <?php
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    $rstock = isset($_GET['rstock']) ? $_GET['rstock'] : '';
    switch ($act) {
        default:
            if ($rstock == '1')
                include "modul/stock.php";
            if ($rstock == '3')
                include "modul/stock1.php";
            include "config/koneksi.php";
            include "config/fungsi_combobox.php";
            include "config/library.php";

            if ($_GET['module'] == 'home') {
                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src=images/donate.jpg>";
            } elseif ($_GET['module'] == 'spengambilan') {
                include "modul/search_transaksi.php";
            } elseif ($_GET['module'] == 'pengambilan') {
                include "modul/pengambilan_darah23.php";
            } elseif ($_GET['module'] == 'pengambilan_apheresis') {
                include "modul/pengambilan_darahaph23.php";
            } elseif ($_GET['module'] == 'pengesahan_kantong') {
                include "modul/pengesahan_kantong.php";
            } elseif ($_GET['module'] == 'rekap_transaksi') {
                include "modul/rekap_transaksi_harian.php";
            } elseif ($_GET['module'] == 'rekap_transaksi1') {
                include "modul/rekap_transaksi_donor.php";
            } elseif ($_GET['module'] == 'rekap_transaksi2') {
                include "modul/rekap_transaksi_donor1.php";
            } elseif ($_GET['module'] == 'pengambilan_gk') {
                include "modul/pengambilan_darah_ganti_kantong.php";
            } elseif ($_GET['module'] == 'gantikantong') {
                include "modul/search_transaksi_gk.php";
            } elseif ($_GET['module'] == 'pengesahan_pengambilan') {
                include "modul/pengesahan_ambil_darah.php";
            }
            // EDIT THEO VALIDASI KANTONG 030719
            elseif ($_GET['module'] == 'validasikantong') {
                include "validasi/validasiinput.php";
            } elseif ($_GET['module'] == 'cetakulang_barcode') {
                require_once('color.inc');
                include "modul/cetakulang_barcode.php";

            }
            //
            elseif ($_GET['module'] == 'aftap1') {
                include "aftap1.php";
            } elseif ($_GET['module'] == 'check') {
                include "modul/search_med_check.php";
            } elseif ($_GET['module'] == 'checkup') {
                include "modul/medical_checkup.php";
            } elseif ($_GET['module'] == 'ganti_menu') {
                include "ganti_menu.php";
            } elseif ($_GET['module'] == 'ganti_passwd') {
                include "modul/ganti_passwd.php";
             } elseif ($_GET['module'] == 'rekap_minta') {
                include "logistik/rekap_minta_barang.php";
            } elseif ($_GET['module'] == 'aftap_permintaan') {
                include "aftap_permintaan.php";
            } elseif ($_GET['module'] == 'form_minta') {
                include "modul/form_minta.php";
            } elseif ($_GET['module'] == 'daftar_permintaan_plebotomi') {
                include "modul/daftar_permintaan_plebotomi.php";
            } elseif ($_GET['module'] == 'pengambilan_plebotomi') {
                include "modul/pengambilan_darah_plebotomi.php";
            } elseif ($_GET['module'] == 'laporan_pasien_plebotomi') {
                include "modul/laporan_pasien_plebotomi.php";
            } elseif ($_GET['module'] == 'updatekantong') {
                include "modul/update_sah_kantong.php";
            } elseif ($_GET['module'] == 'deltransaksi') {
                include "modul/del_transaksi.php";
            } elseif ($_GET['module'] == 'delmedical') {
                include "modul/del_med_check.php";
            } elseif ($_GET['module'] == 'rincian_minta_barang') {
                include "logistik/rincian_transaksi_minta_barang.php";
            } elseif ($_GET['module'] == 'rekap_sisa_kantong_diaftap') {
                include "modul/rekap_kantong_aftap_belum_terpakai.php";
            }

            /*akses pendonor level aftap*/ elseif ($_GET['module'] == 'search_pendonor') {
                include "modul/search_pendonor.php";
            } elseif ($_GET['module'] == 'eregistrasi') {
                include "modul/edit_registrasi.php";
            } elseif ($_GET['module'] == 'eregistrasiluar') {
                include "modul/edit_registrasiluar.php";
            } elseif ($_GET['module'] == 'transaksi_donor') {
                include "modul/transaksi_donor.php";
            } elseif ($_GET['module'] == 'registrasi') {
                include "modul/registrasi.php";
            } elseif ($_GET['module'] == 'cetak_id') {
                include "color.inc";
                include "modul/cetak_id.php";
            } elseif ($_GET['module'] == 'sejarah') {
                include "modul/sejarah_pendonor.php";
            } elseif ($_GET['module'] == 'list_sejarah') {
                include "modul/sejarah.php";
            } elseif ($_GET['module'] == 'delhistory') {
                include "modul/del_history.php";
            }
            //history donor
            elseif ($_GET['module'] == 'history_luar') {
                include "modul/sejarah_donor_luar.php";
            } elseif ($_GET['module'] == 'rekap_sejarah') {
                include "modul/sejarah_donor_xls.php";
            }

            //history cetak kartu
            elseif ($_GET['module'] == 'historycetak') {
                include "modul/historycetak.php";
            }


            /*apheresis*/ elseif ($_GET['module'] == 'pengambilan_apheresis') {
                include "modul/pengambilan_darah_apheresis.php";
            } elseif ($_GET['module'] == 'epengambilan') {
                include "modul/edit_pengambilan.php";
            }

            //serahterima sampel dan kantong
            elseif ($_GET['module'] == 'pengesahan_pengambilan') {
                include "modul/pengesahan_ambil_darah.php";
            } elseif ($_GET['module'] == 'rekap_pengesahan') {
                include "modul/rekap_pengesahan.php";
            } elseif ($_GET['module'] == 'rekap_transaksi_sum') {
                include "modul/rekap_transaksi_harian_summary.php";
            }


            //formulir donor
            elseif ($_GET['module'] == 'form_donor') {
                include "modul/data_pendonor2.php";
            }
            //history donor
            elseif ($_GET['module'] == 'history') {
                include "modul/sejarah_donor.php";

            }
            //input transaksi  donor
            elseif ($_GET['module'] == 'transaksi_donor_lama') {
                include "modul/input_transaksi_donor.php";
            }

            //Cari Pendonor
            elseif ($_GET['module'] == 'cari_pendonor') {
                include "modul/cari_pendonor.php";
            }


            //pengesahan darah Aftap ke imltd
            elseif ($_GET['module'] == 'sahkan_kantong') {
                include "modul/sahkan_kantong_donor.php";
            }
            //pendonor
            elseif ($_GET['module'] == 'pendonor') {
                include "aftap_donor.php";
            }

            // donor baru
            elseif ($_GET['module'] == 'donor_baru') {
                include "modul/registrasi.php";
            }
            // donor ulang
            elseif ($_GET['module'] == 'donor_ulang') {
                include "modul/cari_pendonor2023.php";
            }
            // cari apheresis
            elseif ($_GET['module'] == 'cari_donor_apheresis') {
                include "modul/cari_pendonor_apheresis.php";
            }
            // cari Rhesus Negatif
            elseif ($_GET['module'] == 'cari_rhesus_neg') {
                include "modul/cari_pendonor_negatif.php";
            }
            //laporan aftap baru
            elseif ($_GET['module'] == 'laporan_aftap') {
                include "modul/rekap_transaksi_donorckep.php";
            } else if ($_GET['module'] == 'pmk_lap_donasi') {
                include "laporan/laporan_bulanan_wb.php";
            } else if ($_GET['module'] == 'pmk_lap_aphe') {
                include "laporan/laporan_bulanan_aph.php";
            }

            //=========SERAH TERIMA=======
            elseif ($_GET['module'] == 'serahterima') {
                include "aftap_serahterima.php";
            } elseif ($_GET['module'] == 'sr_aftap_pk') {
                include "serahterima/sr_aftap_komponenpk.php";
            } elseif ($_GET['module'] == 'sr_aftap') {
                include "serahterima/sr_aftap_komponen.php";
            } elseif ($_GET['module'] == 'delrow') {
                include "serahterima/sr_proces.php";
            } elseif ($_GET['module'] == 'batal') {
                include "serahterima/sr_proces.php";
            } elseif ($_GET['module'] == 'sr_aftap_list') {
                include "serahterima/sr_aftap_komponen_list_2025.php";
            } elseif ($_GET['module'] == 'sr_rpt_ktg') {
                include "serahterima/sr_aftap_komponen_print_ktg.php";
            } elseif ($_GET['module'] == 'sr_rpt_imltd') {
                include "serahterima/sr_aftap_komponen_print_imltd.php";
            } elseif ($_GET['module'] == 'sr_rpt_kgd') {
                include "serahterima/sr_aftap_komponen_print_kgd.php";
            } elseif ($_GET['module'] == 'sr_rpt_nat') {
                include "serahterima/sr_aftap_komponen_print_nat.php";
            } elseif ($_GET['module'] == 'sr_rpt_rilis') {
                include "serahterima/sr_aftap_komponen_print_rilis.php";
            } elseif ($_GET['module'] == 'sr_rpt_view') {
                include "serahterima/sr_aftap_komponen_view.php";
            }
            //Terima Konsolidasi
            elseif ($_GET['module'] == 'sr_aftap_kns') {
                include "serahterima/ksl_terima_list.php";
            } elseif ($_GET['module'] == 'sr_aftap_knsdt') {
                include "serahterima/ksl_terima_listdetail.php";
            } elseif ($_GET['module'] == 'hapus_knsdt') {
                include "serahterima/ksl_terima_hapus.php";
            }



            //rekap aftap=================================
            elseif ($_GET['module'] == 'rekap') {
                include "aftap_rekap.php";
            } elseif ($_GET['module'] == 'rekap_apheresis') {
                include "modul/rekap_apheresis.php";
            } elseif ($_GET['module'] == 'laporan') {
                include "laporan/filter_laporan.php";
            } elseif ($_GET['module'] == 'rekap_bus') {
                include "laporan/rekap_bus_donor.php";
            } elseif ($_GET['module'] == 'rekap_transaksi_sum') {
                include "modul/rekap_transaksi_harian_summary.php";
            } elseif ($_GET['module'] == 'rekap_donor_apheresis') {
                include "laporan/rekap_donor_aph.php";
            } elseif ($_GET['module'] == 'rekap_donor_apheresis_all') {
                include "laporan/rekap_donor_aph_all.php";
            } elseif ($_GET['module'] == 'rekap_batal') {
                include "modul/rekap_batal.php";
            }

            // dokumentasiaftap
            elseif ($_GET['module'] == 'manual_aftap') {
                include "dokumentasiaftap.php";
            } elseif ($_GET['module'] == 'luarkota') {
                include "modul/luar_kota.php";
            }
            //MOBILE APP
            //17-08-2020
            elseif ($_GET['module'] == 'mobile_app') {
                include "p2d2s_mobileapp.php";
            } elseif ($_GET['module'] == 'mobile_antrean') {
                include "mobile/mobile_list_antrean.php";
            } elseif ($_GET['module'] == 'mobile_antreanmu') {
                include "mobile/mobile_list_antrean_mu.php";
            } elseif ($_GET['module'] == 'mobile_transaksi') {
                include "mobile/mobile_antrekan.php";
            } elseif ($_GET['module'] == 'mobile_ubahstatus') {
                include "mobile/mobile_update_status_antrean.php";
            } elseif ($_GET['module'] == 'mobile_ubahstatusmu') {
                include "mobile/mobile_update_status_antreanmu.php";
            } elseif ($_GET['module'] == 'mobile_antrean_proses') {
                include "mobile/mobile_proses_antrean.php";
            } elseif ($_GET['module'] == 'mobile_transaksimu') {
                include "mobile/mobile_transaksimu.php";
            }

            //UPDATE MEDICAL CEHCK UP, APHERESIS
            //23-08-2020
            elseif ($_GET['module'] == 'labelsampel') {
                require_once('color.inc');
                include "modul/label_sample.php";
            } elseif ($_GET['module'] == 'checkup_aph') {
                include "tpk/medical_check_up_aph.php";
            } elseif ($_GET['module'] == 'swab') {
                include "tpk/pcr_covid_srcdonor.php";
            } elseif ($_GET['module'] == 'swab1') {
                include "tpk/pcr_covid_input.php";
            } elseif ($_GET['module'] == 'swabrekap') {
                include "tpk/pcr_covid_rekap.php";
            } elseif ($_GET['module'] == 'samplekode') {
                include "color.inc";
                include "tpk/kodesample.php";
            } elseif ($_GET['module'] == 'samplerekap') {
                include "color.inc";
                include "tpk/kodesample_rekap.php";
            } elseif ($_GET['module'] == 'ambilsampel') {
                include "color.inc";
                include "tpk/ambil_sampletpk.php";
            } elseif ($_GET['module'] == 'inputpengambilansample') {
                include "color.inc";
                include "tpk/ambil_sampleinput.php";
            } elseif ($_GET['module'] == 'hasilsampel') {
                include "color.inc";
                include "tpk/rekap_hasilsampel.php";
            } elseif ($_GET['module'] == 'verifsampel') {
                include "color.inc";
                include "tpk/verif_hasilsampel.php";
            } elseif ($_GET['module'] == 'sampellulus') {
                include "color.inc";
                include "tpk/sampel_lulus.php";
            } elseif ($_GET['module'] == 'sampelgagal') {
                include "color.inc";
                include "tpk/sampel_gagal.php";
            } elseif ($_GET['module'] == 'jadwalambil') {
                include "color.inc";
                include "jadwaltpk/jadwal.php";
            } elseif ($_GET['module'] == 'jadwalsampel') {
                include "color.inc";
                include "tpk/jadwalpengambilan.php";
            } elseif ($_GET['module'] == 'tpk_menu') {
                include "color.inc";
                include "tpk_transaksi.php";
            } elseif ($_GET['module'] == 'edit_transaksi_donor') {
                include "modul/edit_transaksi_donor.php";
            } elseif ($_GET['module'] == 'dokter') {
                include "modul/search_med_check2023.php";
            } elseif ($_GET['module'] == 'hb') {
                include "modul/search_med_check2023.php";
            } elseif ($_GET['module'] == 'check_up') {
                include "modul/medical_check_up.php";
            } elseif ($_GET['module'] == 'hb_gol') {
                include "modul/medical_hbgol.php";
            } elseif ($_GET['module'] == 'ceksampeldds') {
                include "tpk/cek_sampeldds.php";
            } elseif ($_GET['module'] == 'historynas') {
                include "modul/sejarah_donornas.php";
            }
            //rekap validasi kantong
            elseif ($_GET['module'] == 'rekap_validktg') {
                include "aftap/rekapvalidktg.php";
            }
            //Eksport validasi kantong excell
            elseif ($_GET['module'] == 'excell_validktg') {
                include "aftap/rekapvalidktgxls.php";
            }
            //Eksport validasi kantong print
            elseif ($_GET['module'] == 'cetak_validktg') {
                include "aftap/rekapvalidktgcetak.php";
            }


    }
}
?>
