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
    <font size="4" color=00008B>Validasi Kantong <br> </font>
    <INPUT type="text"  name="noktg" style="text-transform:uppercase" minlength="5" required="">
    <input type=submit name=cari value=OK class="swn_button_blue">
    <a href="pmiaftap.php?module=aftap1"class="swn_button_blue">Kembali</a>
</form>
<?
if (isset($_POST[cari])) {
    $nkt=$_POST[noktg];
    $sql="select * from stokkantong where upper(nokantong)=upper('$nkt')";
    $stokkantong=mysql_fetch_assoc(mysql_query($sql));
    if (($stokkantong['Status']=='0') and ($stokkantong['StatTempat']=='1')){
        $URL="pmiaftap.php?module=validasi_kantongaftap&nokantong=$nkt&mode=2";
        header("Location: $URL");
    }else{
        switch ($stokkantong['Status']){
            case '0' :  $statuskantong='Kosong';
                        if ($stokkantong[StatTempat]==NULL) $statuskantong='Kosong - di Logistik';
                        if ($stokkantong[StatTempat]=='0')  $statuskantong='Kosong - di Logistik';                      
                        break;
	    case '1' : $statuskantong='Sudah Terisi';break;
	    case '2' : $statuskantong='Sudah Terisi';break;
            case '3' : $statuskantong='Keluar';break;
            case '4' : $statuskantong='Rusak';break;
            case '5' : $statuskantong='Rusak-Gagal';break;
            case '6' : $statuskantong='Dimusnahkan';break;
            default  : $statuskantong='-';
        }
        echo "<SCRIPT>alert('Kantong darah yang anda masukkan tidak dapat divalidasi, karena statusnya : $statuskantong.');</SCRIPT>";
    }
}?>
</body>
</html> 

