<?php
  require_once('tpksolo/adm/config.php');
    
    $namauser=$_SESSION[namauser];
    $notrans=$_GET[form];
    $now = date('Y-m-d');
    if (isset($_POST[submit])) {
        $tgl=$_POST[tgl];
        $uraian=$_POST[uraian];
        $batal=$_POST[jnsbatal];
        $petugas=$_POST[user];
            if ($notrans !=="") {
            $tambah=mysql_query("insert into book_permintaan (notrans, uraian, petugas,detail)
                values ('$notrans','$uraian','$petugas','$batal')");
            $q=mysql_query("UPDATE `htranspermintaan` set `status`='2' WHERE `noform` = '$notrans' ");
            $dtrans=mysql_query("update `dtranspermintaan` set `status`='1' WHERE `NoForm` = '$notrans'");
            $dpasien=mysql_query("delete from `daftarpasien` WHERE `noform` = '$no'");

        //=======Audit Trial====================================================================================
        $log_mdl ='LOGBOOK';
        $log_aksi='Input Pembatalan Permintaan: '.$nama.' Catatan Permintaan : '.$uraian;
        include_once "user_log.php";
        //=====================================================================================================

                if ($tambah) {
                    echo "Pembatalan telah disimpan <script>parent.$.fn.colorbox.close();</script>";
                ?>
                <? if($_SESSION[leveluser]=='kasir2'){?>
                <META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_permintaan_tpkbelum">
                <?} else {?>
                 <META http-equiv="refresh" content="1; url=pmilaboratorium.php?module=rekap_permintaan_tpkbelum">
                        <?}
                } else {
               if($_SESSION[leveluser]=='kasir2'){?>
                                
                echo "Data Log Pembatalan gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
                ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_permintaan_tpkbelum">
                                <?} else {?>
                                echo "Data Log Pembatalan gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
                                ?><META http-equiv="refresh" content="1; url=pmilaboratorium.php?module=rekap_permintaan_tpkbelum">
                                
                                <?}?>
                    <?}
                }
                  }
                                
        $cari = mysql_fetch_assoc(mysql_query("SELECT\n".
        "pmi.htranspermintaan.noform,\n".
        "pmi.htranspermintaan.tglminta,\n".
        "pmi.dtranspermintaan.JenisDarah,\n".
        "pmi.dtranspermintaan.GolDarah,\n".
        "pmi.dtranspermintaan.Rhesus,\n".
        "pmi.dtranspermintaan.Jumlah,\n".
        "pmi.pasien.nama,\n".
        "pmi.pasien.umur,\n".
        "pmi.rmhsakit.NamaRs\n".
        "FROM\n".
        "pmi.dtranspermintaan\n".
        "JOIN pmi.htranspermintaan\n".
        "ON pmi.dtranspermintaan.NoForm = pmi.htranspermintaan.noform \n".
        "JOIN pmi.pasien\n".
        "ON pmi.htranspermintaan.no_rm = pmi.pasien.no_rm \n".
        "JOIN pmi.rmhsakit\n".
        "ON pmi.htranspermintaan.rs = pmi.rmhsakit.Kode\n".
        "WHERE\n".
        "pmi.htranspermintaan.noform='$notrans'"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PMI KOTA SURAKARTA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../tpksolo/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../tpksolo/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../tpksoloplugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../tpksolo/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../tpksolo/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../tpksolo/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../tpksolo/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../tpksolo/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../tpksolo/code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<style>
.box{

    height: 50px;
    padding: 20px;
}
.box2{

    height: 25px;
    padding: 20px;
}
.copyright{
        bottom: 0;
    width: 100%;
    position: fixed;
    height:40px;
    line-height:50px;
    background:RED;
    color:#fff;
    padding-left: 10px;
  }
  .input-tanggal{
    padding: 10px;
    font-size: 14pt;
}
</style>
<body>


  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../tpksolo/dist/img/logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <div class="box" align="center">
  </div>

  <?php
  
  //echo $namadonor;
  //echo 'Count Data :'.count($data).'<br>';
  ?>
  <div class="row" align="center">
    <div class="col-lg-12">
      <h4><font color="black"><b>PEMBATALAN PERMINTAAN DARAH</b></font></h4><br>
    </div>
  </div>
  <div class="col-12 col-sm-12">
  <div class="card-body">
        
    <form name="barang" method="POST" action="<?=$PHPSELF?>">
        <div>

        <table  border="0" width="100%">
    <tr>
    <td>
        <table class="form" align="center" border="2">
        <tr>     <td>Nomor Transaksi</td>
            <td class="input">
            <input type="hidden" name="kode" value="<?=$cari[noform]?>"><?=$cari[noform]?></td>
                </td>
        </tr>
        <tr>     <td>Nama Pasien</td>
            <td class="input">
                                <input type="hidden" name="nama" value="<?=$cari[nama]?>"><?=$cari[nama].' ('.$cari[umur].' thn)'?></td>
            <input type="hidden" name="user" value="<?=$_SESSION['namauser']?>">
            
                </td>
        </tr>

        <tr>
            <td>Tgl Permintaan</td>
            <td class="input"> <input type="hidden" name="tgl" id="datepicker" placeholder="yyyy-mm-dd" size=11 value="<?=$cari[tglminta]?>"><?=$cari[tglminta]?></td>
            </tr>
        <tr>
            <td>Rumah Sakit</td>
            <td class="input"> <input type="hidden" name="rs" value="<?=$cari[NamaRs]?>"><?=$cari[NamaRs]?></td>
        </tr>
        <tr>
            <td>Jenis Produk</td>
                                <td class="input"> <input type="hidden" name="produk" value="<?=$cari[JenisDarah]?>"><?=$cari[JenisDarah].' ('.$cari[GolDarah].$cari[Rhesus].')'?></td>
        </tr>
        <tr>
            <td>Jumlah Minta</td>
                                <td class="input"> <input type="hidden" name="jml" value="$cari[Jumlah]"><?=$cari[Jumlah].' Kolf'?></td>
        </tr>
         

        <tr><td>Alasan</td>
        <td>
        <input type="radio" name="jnsbatal" value="4"> PASIEN SEMBUH<br>
        <input type="radio" name="jnsbatal" value="3"> PASIEN MENINGGAL<br>
        <input type="radio" name="jnsbatal" value="2"> PERMINTAAN RUMAH SAKIT<br>
        <input type="radio" name="jnsbatal" value="1"> PERMINTAAN KELUARGA<br>
        <input type="radio" name="jnsbatal" value="5"> LAIN-LAIN<br>
        </td>
        </tr>
        
        <!--tr><td>Alasan</td>
            <td><select name="jnsbatal">
            <option value="5">- PILIH -</option>
            <option value="1">PASIEN SEMBUH</option>
            <option value="2">PASIEN MENINGGAL</option>
            <option value="3">PERMINTAAN RUMAH SAKIT</option>
            <option value="4">PERMINTAAN KELUARGA</option>
            <option value="5">LAIN-LAIN</option>
        </select></td>
        </tr-->

        <tr>     <td>Keterangan</td>
            <td class="input"><textarea maxlenght="100"  rows="4" cols="57" wrap="physical" name="uraian" {font-family:"Helvetica Neue", Helvetica, sans-serif; } required></textarea></td>
            </tr>
        <tr><td height=50><input name="submit" type="submit" class="swn_button_blue" value="Tambah Data"></td>
            <td><button onclick="goBack()">Batal</button></td>

        </table>
    </td>

        </tr>
    </table></div>
        
    </form>
  </div>
</div>



<!-- /.content-box -->



<!--div class="copyright">
  <p align="center">Copyright @ 2021 | PMI KOTA SURAKARTA</p>
</div-->

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  $("#datepicker").datepicker({
         dateFormat:"yy-mm-dd",
      });
} );
</script>
<script>
$( function() {
  $("#datepicker2").datepicker({
         dateFormat:"yy-mm-dd",
      });
} );
</script>
<script>
function goBack() {
  window.history.back();
}
</script>
<!-- Bootstrap 4 -->
<script src="../tpksolo/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../tpksolo/dist/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="../tpksoloplugins/jquery/jquery.min.js"></script>

</body>
</html>
