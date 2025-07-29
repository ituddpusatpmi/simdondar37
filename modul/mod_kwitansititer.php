<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<script type="text/javascript" src="js/disable_enter.js"></script>

<script language="javascript">
function selectBayar(Kode){
    $('input[name=kodeBia]').val(Kode);
    tb_remove();
}
</script>
<body OnLoad="document.cari.no_form.focus();">

<?
include ("config/db_connect.php");
require_once("modul/background_process.php");
$rs=mysql_query("select rs from kwitansilain");
if (!$rs){
    mysql_query("ALTER TABLE `kwitansilain` ADD `no_rm` VARCHAR( 15 ) NULL DEFAULT NULL ,
ADD `rs` VARCHAR( 7 ) NULL DEFAULT NULL ,
ADD `layanan` VARCHAR( 7 ) NULL DEFAULT NULL ");
mysql_query("update kwitansilain as kw,dtransaksipermintaan dt set kw.no_rm=dt.no_rm,kw.rs=dt.rs,kw.layanan=dt.layanan where kw.noform=dt.noform");

}

$petugas = $_SESSION[nama_lengkap];
$namauser=$_SESSION[namauser];
$tgl_permintaan=date("Y-m-d H:i:s");
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$tgl_yesterday=date("Y-m-d",$yesterday);
$td0=php_uname('n');
$td0=substr($td0,0,3);
if (!isset($_POST[submit1])){
?>
    <h1 class="table">PEMBAYARAN PEMERIKSAAN SAMPEL</h1>
    <form name="cari" method="post" action="<?echo $PHPSELF?>">
    <table class="form" cellspacing="0" cellpadding="0">
        <tr>
            <td> No Formulir Donor </td>
            <td class="input">
                <input name="no_form" type="text" size="20" value="<?=$_GET[noform]?>" onChange="checkform()">
            </td>
        </tr>
    </table>
    <br>
    <input name="submit1" type="submit" value="Cari">
    </form>
<?}


if (isset($_POST[submit1])) {
    $noform=$_POST['no_form'];
    $trans = mysql_fetch_assoc(mysql_query("SELECT KodePendonor,id_permintaan from htransaksi where NoTrans='$noform' limit 1"));
    $idminta = $trans['id_permintaan'];
    $notrans = $trans['KodePendonor'];
    $pendonor = mysql_fetch_assoc(mysql_query("SELECT Nama,GolDarah,Rhesus from pendonor where Kode='$notrans' limit 1"));
                $htrans = mysql_fetch_assoc(mysql_query("SELECT\n".
                            "pmi.htranspermintaan.no_rm,\n".
                            "pmi.pasien.nama,\n".
                            "pmi.pasien.kelamin,\n".
                            "pmi.pasien.umur,\n".
                            "pmi.pasien.gol_darah,\n".
                            "pmi.pasien.rhesus,\n".
                            "pmi.rmhsakit.NamaRs\n".
                            "FROM\n".
                            "pmi.htranspermintaan\n".
                            "JOIN pmi.pasien\n".
                            "ON pmi.htranspermintaan.no_rm = pmi.pasien.no_rm \n".
                            "JOIN pmi.rmhsakit\n".
                            "ON pmi.htranspermintaan.rs = pmi.rmhsakit.Kode\n".
                            "where noform='$idminta'\n".
                            "limit 1"));
                
                ?>
    
    <table border="0" cellpadding="10">
        <tr valign="top">
            <td>
            <form name=periksa method="post" action="<?=$PHP_SELF?>">
            <table class="form" width="100%" cellspacing="1" cellpadding="2" align="left">
                <tr>
                    <td>No.</td>
                    <td>Nama Pendonor</td>
                    <td>Golongan Darah</td>
                    <td>Nomor Permintaan</td>
                    <td>Nama Pasien</td>
                    <td>Rumah Sakit</td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>
                        <?=$pendonor['Nama']?>
                        
                    </td>
                    <td>
                        <?=$pendonor['GolDarah'].' ('.$pendonor['Rhesus'].')'?>
                        
                    </td>
                    <td>
                        <?=$htrans['no_rm']?>
                        
                    </td>
                    <td>
                        <?=$htrans['nama'].' ('.$htrans['umur'].' Thn)'?>
                        
                    </td>
                    <td>
                        <?=$htrans['NamaRs']?>
                       
                    </td>
                </tr>
                
            </table>
                <a href="notatiter.php?noform=<?=$trans[KodePendonor]?>&yby=<?=$idminta?>"><input name=cetak type=button value="Cetak Nota"></a>
                
                </form>
                <?}?>




