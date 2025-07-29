<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$tglsebelum = mktime(0,0,0,date("m"),1,date("Y"));
$tglawal=date("Y-m-d");
$hariini = date("Y-m-d");
?>
<!DOCTYPE html>
<link type="text/css" href="../css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<link type="text/css" href="../css/style.css" rel="stylesheet" />
<html>

<head>
<style>
    body {font-family: "Lato", sans-serif;}
</style>

<script type="text/javascript" language="JavaScript">
  document.forms['prolis'].elements['noktg'].focus();
</script>

</head>
<body OnLoad="document.prolis.noktg.focus();">
<form name="prolis" method=post>
    <font size="4" color=00008B>KODE ALAT<br> </font>
    <INPUT type="text"  name="noktg" style="text-transform:uppercase" minlength="2" required="">
    <input type=submit name=cari value=OK class="swn_button_blue">
    <a href="pmiqc.php?module=qc_logbook"class="swn_button_blue">Kembali</a>
</form>
<?
if (isset($_POST[cari])) {
    $nkt=$_POST[noktg];
    $sql="select * from logbook_h where kode='$nkt'";
    $jml = mysql_num_rows(mysql_query($sql));
    if ($jml > 0){
        $URL="pmiqc.php?module=entry_aksilogbook&ID=$nkt";
        header("Location: $URL");
    }else{
        
        echo "<SCRIPT>alert('Data Alat tidak ada / belum terdaftar');</SCRIPT>";
    }
}?>
</body>
</html>


