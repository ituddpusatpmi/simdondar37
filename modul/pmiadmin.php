<?php
session_start();
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
  echo "<link href='config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php target=\"_top\"><b>LOGIN</b></a></center>";
}
if (($_SESSION[leveluser])=='admin'){
?>
<!doctype html>
<html>
<head>
<title>UTD PMI Jember</title>
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

$tgll=date("Ymd"); 
if ($_GET[module]=='home'){
          echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src=images/donate.jpg>";
}
elseif ($_GET[module]=='skantong'){
                 include "modul/skantong.php";
}
elseif ($_GET[module]=='musnah'){
                 include "modul/musnah.php";
}
elseif ($_GET[module]=='cek_pulsa'){
                 include "modul/cek_pulsa.php";
}
elseif ($_GET[module]=='keluar'){
                 include "modul/keluar.php";
}
elseif ($_GET[module]=='komponen'){
                 include "modul/komponen.php";
}
elseif ($_GET[module]=='penambahan_kantong'){
                 include "modul/penambahan_kantong.php";
}
elseif ($_GET[module]=='pengesahan_kantong'){
                 include "modul/pengesahan_kantong.php";
}
elseif ($_GET[module]=='reagen'){
                 include "modul/entry_reagen.php";
}
elseif ($_GET[module]=='dreagen'){
                 include "modul/daftar_pegawai.php";
}
elseif ($_GET[module]=='supplier'){
                 include "modul/entry_suplier.php";
}
elseif ($_GET[module]=='permintaan'){
                 include "modul/mod_permintaan.php";

}

elseif ($_GET[module]=='hasil_lab'){
                 include "modul/hasil_lab.php";

}

elseif ($_GET[module]=='shasil_labl'){
                 include "modul/label_lab.php";

}
elseif ($_GET[module]=='shasil_lab'){
                 include "modul/shasil_lab.php";

}
elseif ($_GET[module]=='hlab_bonus'){
                 include "modul/lab_bonus.php";

}
elseif ($_GET[module]=='pengesahan'){
                 include "modul/pengesahan_rapidtest.php";

}

elseif ($_GET[module]=='scrossmatch'){
                 include "modul/search_crossmatch.php";

}
elseif ($_GET[module]=='label_cross'){
                 include "modul/label_cross.php";
}
elseif ($_GET[module]=='sarancrossmatch'){
                 include "modul/mod_sarancross.php";

}
elseif ($_GET[module]=='crossmatch'){
                 include "modul/mod_crossmatch.php";

}
elseif ($_GET[module]=='user'){
                 include "modul/registrasi.php";

}
elseif ($_GET[module]=='cetak_idp'){
                 include "modul/cetak_idp.php";

}
elseif ($_GET[module]=='cetak_id'){
                 include "modul/cetak_id.php";

}
    elseif ($_GET[module]=='cabut_cekal'){
        include "modul/cabut_cekal.php";
    }
    elseif ($_GET[module]=='double_pendonor'){
        include "modul/double_pendonor.php";
    }
    elseif ($_GET[module]=='hapus_pendonor'){
        include "modul/hapus_pendonor.php";
    }
    elseif ($_GET[module]=='search_pendonor'){
        include "modul/search_pendonor.php";
    }
elseif ($_GET[module]=='transaksi'){
                 include "modul/search_pendonor.php";

}

elseif ($_GET[module]=='spendonor'){
                 include "modul/search_pendonor_edit.php";

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
elseif ($_GET[module]=='eregistrasi'){
                 include "modul/edit_registrasi.php";

}
elseif ($_GET[module]=='tambah_dokter_periksa'){
        include  "modul/tambah_dokter_periksa.php";
}
elseif ($_GET[module]=='transaksi_donor'){
                 include "modul/transaksi_donor.php";
}
elseif ($_GET[module]=='spengambilan'){
                 include "modul/search_transaksi.php";
}
elseif ($_GET[module]=='pengambilan'){
                 include "modul/pengambilan_darah.php";
}
elseif ($_GET[module]=='pengesahan_pengambilan'){
                 include "modul/pengesahan_ambil_darah.php";
}
elseif ($_GET[module]=='aturuser'){
                 include "modul/mod_user.php";

}
elseif ($_GET[module]=='aturagenda'){
   include  "modul/mod_agendamn.php";

  }

elseif ($_GET[module]=='agendaedit'){
   include  "modul/mod_agendamn1.php";

  }

elseif ($_GET[module]=='updateagenda'){
   include  "modul/mod_updateagenda.php";

  }
    elseif ($_GET[module]=='tambah_bdrs'){
        include  "modul/tambah_bdrs.php";
    }
elseif ($_GET[module]=='tambahagenda'){
   include  "modul/mod_agendamn2.php";

  }


elseif ($_GET[module]=='entryagenda'){
   include  "modul/mod_insertagenda.php";

  }

elseif ($_GET[module]=='agendahapus'){
   include  "modul/mod_hapusagenda.php";

  }
elseif ($_GET[module]=='agendalist'){
   include  "modul/mod_agendalist.php";

  }
elseif ($_GET[module]=='sms_inbox'){
   include  "modul/sms_inbox.php";
  }
elseif ($_GET[module]=='sms_pending'){
   include  "modul/sms_outbox.php";
  }
elseif ($_GET[module]=='sms_setting'){
   include  "modul/sms_setting.php";
  }
elseif ($_GET[module]=='sms_broadcast'){
   include  "modul/sms_broadcast.php";
  }
elseif ($_GET[module]=='rekap_sms'){
   include "modul/fungsi_indotgl.php";
   include  "modul/rekap_sms.php";
  }
elseif ($_GET[module]=='smsidi'){
   //include  "modul/sms2/sms2.php";
   include  "sms.php";

  }
elseif ($_GET[module]=='rtransaksi'){
   include  "modul/rtransaksi.php";

  }
elseif ($_GET[module]=='stock'){
   include  "modul/stock.php";

  }
elseif ($_GET[module]=='lacak_kantong'){
    include  "modul/lacak_kantong.php";
  }
elseif ($_GET[module]=='tambah_pengumuman'){
    include  "modul/tambah_pengumuman.php";
  }
elseif ($_GET[module]=='lacak_pasien'){
    include  "modul/lacak_pasien.php";
  }
elseif ($_GET[module]=='sejarah'){
    include  "modul/sejarah_pendonor.php";
  }
elseif ($_GET[module]=='list_sejarah'){
    include  "modul/sejarah.php";
  }
elseif ($_GET[module]=='admin_sms'){
    include  "admin_sms.php";
  }
elseif ($_GET[module]=='admin_laporan'){
    include  "admin_laporan.php";
  }
elseif ($_GET[module]=='admin_utility'){
    include  "admin_utility.php";
  }
elseif ($_GET[module]=='laporan_kegiatan'){
    include  "modul/lap_kegiatan.php";
}
elseif ($_GET[module]=='lpdr'){
    include  "lpdr_$tgll.html";
}
elseif ($_GET[module]=='lkr'){
    include  "lkr_$tgll.html";
}
elseif ($_GET[module]=='lusr'){
    include  "lusr_$tgll.html";
}
elseif ($_GET[module]=='laporan_peng_darah'){
    include  "modul/lap_peng_darah.php";
  }
elseif ($_GET[module]=='laporan_uji_sharing'){
    include  "modul/lap_uji_sharing.php";
  }
elseif ($_GET[module]=='aktif_udd'){
    include  "modul/aktif_udd.php";
  }
elseif ($_GET[module]=='laporan_buang_darah'){
    include  "modul/lap_buang_darah.php";
  }
elseif ($_GET[module]=='edit_harga'){
    include  "modul/edit_harga.php";
  }
elseif ($_GET[module]=='ganti_menu'){
        include  "ganti_menu.php";
    }
elseif ($_GET[module]=='laporan_lttd4'){
    include  "modul/laporan_lttd4.php";
  }
elseif ($_GET[module]=='lttd4'){
    include  "lttd4_$tgll.html";
}
elseif ($_GET[module]=='laporan_lttd5'){
    include  "modul/laporan_lttd5.php";
  }
elseif ($_GET[module]=='lttd5'){
    include  "lttd5_$tgll.html";
}
elseif ($_GET[module]=='laporan_lttd6'){
    include  "modul/laporan_lttd6.php";
  }
elseif ($_GET[module]=='lttd6'){
    include  "lttd6_$tgll.html";
}
elseif ($_GET[module]=='backup_data'){
    include  "modul/databackup.php";
}
elseif ($_GET[module]=='restore_data'){
    include  "modul/datarestore.php";
}

}
?>

<?php
}
?>
