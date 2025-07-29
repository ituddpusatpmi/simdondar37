<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
?>

<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disable_enter.js"></script>
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="common.js"></SCRIPT>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>

</script>
<?
//include('../clogin.php');
include('../config/db_connect.php');
$namauser=$_SESSION[namauser];
$notrans=$_GET[notrans];
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
        $qrs=mysql_query("UPDATE `htranspermintaanRS` set `status`='2' WHERE `noformRS` = '$notrans' ");
        $dtrans=mysql_query("update `dtranspermintaan` set `status`='1' WHERE `NoForm` = '$notrans'");
        $dpasien=mysql_query("delete from `daftarpasien` WHERE `noform` = '$no'");

    //=======Audit Trial====================================================================================
    $log_mdl ='LOGBOOK';
    $log_aksi='Input Pembatalan Permintaan: '.$nama.' Catatan Permintaan : '.$uraian;
    include_once "user_log.php";
    //=====================================================================================================
            
            //Whatsapp
            $wa = "SELECT\n".
                "    htranspermintaanRS.noformRS, \n".
                "    rmhsakit.NamaRs, \n".
                "    rmhsakit.gateway, \n".
                "    pasien.nama, \n".
                "    pasien.gol_darah, \n".
                "    pasien.rhesus\n".
                "FROM\n".
                "    htranspermintaanRS\n".
                "    INNER JOIN\n".
                "    rmhsakit\n".
                "    ON \n".
                "        htranspermintaanRS.rs = rmhsakit.Kode\n".
                "    INNER JOIN\n".
                "    pasien\n".
                "    ON \n".
                "        htranspermintaanRS.no_rm = pasien.no_rm\n".
                "    WHERE \n".
                "    htranspermintaanRS.noformRS = '$notrans'";
            
            $cariwa=mysql_fetch_assoc(mysql_query($wa));
            if ($cariwa['gateway'] != ""){
            $sapa='Semangat Pagi';
            $form=$cariwa['noform'];
            $pesan=$sapa.' '.$cariwa[NamaRs].', kami informasikan Permintaan Darah Nomor : '.$cariwa[noformRS].' Atas nama Pasien '.$cariwa[nama].' | Gol. '.$cariwa[gol_darah].'/'.$cariwa[rhesus].' telah dibatalkan melalui PMI' ;
                                         
                                // WA Petugas
                                $kirim=mysql_query("insert into wagw.outbox (wa_mode,wa_no,wa_text) values ('0','$cariwa[gateway]','$pesan')");
                
                                //CURL CLoud
                                $postData = array("no_trans" => $notrans, "status" => "3");
                                
                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                  CURLOPT_URL => 'http://enigmeds.com/pmi_online/rs/valid.php',
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_ENCODING => '',
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 0,
                                  CURLOPT_FOLLOWLOCATION => true,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => 'POST',
                                  CURLOPT_POSTFIELDS =>json_encode($postData),
                                  CURLOPT_HTTPHEADER => array(
                                    'Content-Type: application/json'
                                  ),
                                ));

                                $response = curl_exec($curl);
                                curl_close($curl);
                                //Curl End
                              }
            //Whatsap=========> END

            if ($tambah) {
                echo "Pembatalan telah disimpan <script>parent.$.fn.colorbox.close();</script>";
            ?>
            <? if($_SESSION[leveluser]=='kasir2'){?>
            <META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_permintaan">
            <?} else {?>
             <META http-equiv="refresh" content="1; url=pmilaboratorium.php?module=rekap_permintaan">
                    <?}
            } else {
           if($_SESSION[leveluser]=='kasir2'){?>
                            
            echo "Data Log Pembatalan gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
            ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_permintaan">
                            <?} else {?>
                            echo "Data Log Pembatalan gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
                            ?><META http-equiv="refresh" content="1; url=pmilaboratorium.php?module=rekap_permintaan">
                            
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
    <form name="barang" method="POST" action="<?=$PHPSELF?>">
    <h1 align="center">CATATAN PEMBATALAN PERMINTAAN DARAH</h1><p>
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
        <td><select name="jnsbatal">
        <option value="5">- PILIH -</option>
        <option value="1">PASIEN SEMBUH</option>
        <option value="2">PASIEN MENINGGAL</option>
        <option value="3">PERMINTAAN RUMAH SAKIT</option>
        <option value="4">PERMINTAAN KELUARGA</option>
        <option value="5">LAIN-LAIN</option>
    </select></td>
    </tr>

    <tr>     <td>Keterangan</td>
        <td class="input"><textarea maxlenght="100"  rows="4" cols="57" wrap="physical" name="uraian" {font-family:"Helvetica Neue", Helvetica, sans-serif; } required></textarea></td>
        </tr>
    <tr><td height=50 colspan=2><input name="submit" type="submit" class="swn_button_blue" value="Tambah Data">

    </table>
</td>

    </tr>
</table></div>
    
</form>
