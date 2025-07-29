<?php
/**
 * Created by PhpStorm.
 * Date: 4/14/14
 * Time: 10:28 AM
 */

include ("config/koneksi.php");

if(isset($_POST['ktg']))
{
    $no_selang  = mysql_real_escape_string($_POST['ktg']);
    
    $test ="SELECT noSelang FROM stokkantong WHERE noKantong='$no_selang'";
    $check_selang = mysql_query("SELECT noSelang FROM stokkantong WHERE noKantong='$no_selang'");


    if(mysql_num_rows($check_selang))
    {
        $noselang = mysql_fetch_assoc($check_selang);
        echo $noselang['noSelang'];
    }
    else
    {
        echo $_POST['ktg'];
    }

}
//echo $test;

?>
