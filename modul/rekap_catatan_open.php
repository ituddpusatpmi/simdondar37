<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$user=$_SESSION[namauser];
$id=$_GET['id'];
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

if (isset($_POST[submit])) {
    $ket=$_POST[ket];
    $sh=$_POST[shift];
    $id=$_GET['id'];
        
        $tambah=mysql_query("UPDATE catatan set ket='$ket', ptgs1='$namauser' where id='$id'");


            if ($tambah) {
                echo "Catatan telah berhasil <script>parent.$.fn.colorbox.close();</script>";
            ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_catatan"><?
            } else {
            echo "Catatan gagal dimasukkan <script>parent.$.fn.colorbox.close();</script>";
            ?><META http-equiv="refresh" content="1; url=pmikasir2.php?module=rekap_catatan"><?
                }
            
              }

if (isset($_POST[batal])) {

        ?><META http-equiv="refresh" content="0; url=pmikasir2.php?module=rekap_catatan"><?
            
        
          } ?>



    <form  method="POST" action="<?=$PHPSELF?>">
    <?
        $query = mysql_query("SELECT * FROM catatan where id='$id'");
        $row   = mysql_fetch_assoc($query);

    ?>
    <h1 align="center">EDIT DATA CATATAN </h1><p>
    <div>

    <table halign="top" border="0" width="100%">
    <tr>

        <td></td>
<td class="input"> Catatan : <br><textarea maxlenght="100"  rows="5" cols="100" wrap="physical" name=ket {font-family:"Helvetica Neue", Helvetica, sans-serif; } required><? echo $row[ket];?></textarea></td>
    </tr>
    
    <tr>
        
        <td></td>
        <td><input name="submit" type="submit" value="EDIT CATATAN" class="swn_button_red">
            <input name="batal" type="submit" value="BATAL" class="swn_button_red">
        </td>

    </tr>
    </table>
    </div>
    
</form>
