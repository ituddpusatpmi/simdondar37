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
    $petugas=$_POST[user];
        if ($notrans !=="") {
        $tambah=mysql_query("insert into book_permintaan (notrans, uraian, petugas)
        values ('$notrans','$uraian','$petugas')");
        
        $updatebook=mysql_query("UPDATE htranspermintaan set `status`=1 where noform='$notrans'");
        $updatetrans=mysql_query("UPDATE dtranspermintaan set `status`=1 where NoForm='$notrans'");

    //=======Audit Trial====================================================================================
    $log_mdl ='LOGBOOK';
    $log_aksi='Input Logbook Permintaan: '.$nama.' Catatan Permintaan : '.$uraian;
    include_once "user_log.php";
    //=====================================================================================================

            if ($tambah) {
                echo "Logbook telah disimpan <script>parent.$.fn.colorbox.close();</script>";
            ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=bookminta&notrans=<?=$notrans?>"><?
            } else {
            echo "Data Log Permintaan gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
            ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=bookminta&notrans=<?=$notrans?>"><?
                }
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
    <h1 align="center">DATA CATATAN PERMINTAAN DARAH</h1><p>
    <div>

    <table halign="top" border="0" width="100%">
<tr>
<td>
    <table class="form" border="2">
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
        <td class="input"> <input type="text" name="tgl" id="datepicker" placeholder="yyyy-mm-dd" size=11 value="<?=$cari[tglminta]?>"></td>
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

    <tr>     <td>Catatan</td>
        <td class="input"><textarea maxlenght="100"  rows="4" cols="57" wrap="physical" name=uraian {font-family:"Helvetica Neue", Helvetica, sans-serif; } required></textarea></td>
        </tr>
    <tr><td height=50 colspan=2><input name="submit" type="submit" class="swn_button_blue" value="Tambah Data">

    </table>
</td>

    <td style="vertical-align: top;">
        <table bgcolor="#000012" cellspacing="1" cellpadding="3">
            <tr bgcolor="#ede9e8">
                <th colspan=4 color="#DDDDDD"><b>HISTORY CATATAN</b></th>
                
            </tr>
        </table>

        <table class="list" border=1 cellspacing=1 cellpadding=3 style="border-collapse:collapse">
           <tr class="field">
             <td>No</td>
             <td>Tanggal</td>
             <td>Catatan</td>
             <td>Petugas</td>
             <td>Aksi</td>

            </tr>
          <?
          $no=0;
          $sqllbk=mysql_query("select * from book_permintaan where notrans='$notrans' order by tgl DESC");
           while ($dtrans = mysql_fetch_assoc($sqllbk)){
              $no++;
              ?>
                  <tr>
                  <td><?=$no?></td>
                <td><?=$dtrans[tgl]?></td>
                <td><?=$dtrans[uraian]?></td>
                <td><?=$dtrans[petugas]?></td>
                <? switch ($_SESSION[leveluser]){
    case "kasir2":
            ?><td><form name="kirim" method="post" action="del_logpendonor.php?Kode=<? echo $dtrans['Kode'] ?>&id=<? echo $dtrans['id']?>&nama=<? echo $nama?>" target="_blank"><input type=submit name=submit4 value='Hapus'></form></td><?
            break;
    case "laboratorium":
    ?><td><form name="kirim" method="post" action="del_logpendonor.php?Kode=<? echo $dtrans['Kode'] ?>&id=<? echo $dtrans['id']?>&nama=<? echo $nama?>" target="_blank"><input type=submit name=submit4 value='Hapus'></form></td><?
    break;
        default:
            echo "Anda tidak memiliki hak akses";
    }?></td>
                  </tr>
            <?}?>
    
              </table>
            
    </td></tr>
</table></div>
    
</form>
