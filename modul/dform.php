
<?php
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];

    $noform = $_GET['noform'];
    $nama   = $_GET['nama'];
    $gol    = $_GET['gol'];
    $rs     = $_GET['rs'];
    
    
    $update = mysql_query("UPDATE htranspermintaan set `sampel`='1',`tgl_sampel`=NOW() where `noform`='$noform'");
    $insert = mysql_query("INSERT `terima_sampel` (`noform`,`pasien`,`goldrh`,`rs`,`petugas`) values ('$noform','$nama','$gol','$rs','$namauser')");
    
    if ($update){
        if($_SESSION[leveluser]=='kasir2'){
        echo ("<font size=3>Sampel Darah Pasien <b>'$noform'</b> telah diterima !!<br></font>
                <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmikasir.php?module=rekap_permintaan\">");
        } else if($_SESSION[leveluser]=='laboratorium') {
            echo ("<font size=3>Sampel Darah Pasien <b>'$noform'</b> telah diterima !!<br></font>
            <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=pmilaboratorium.php?module=rekap_permintaan\">");
        }
        } else {
                echo "<font size=3>Gagal Menyimpan</font><br>";
    }
    
?>
