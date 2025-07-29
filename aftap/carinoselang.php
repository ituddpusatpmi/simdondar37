<?php
/**
 * Created by PhpStorm.
 * Date: 4/14/14
 * Time: 10:28 AM
 */

include ('../config/dbi_connect.php');

if(isset($_POST['ktg']))
{
    $no_selang  = mysqli_real_escape_string($dbi,$_POST['ktg']);
    
    $test ="SELECT noSelang FROM stokkantong WHERE noKantong='$no_selang'";
    $check_selang = mysqli_query($dbi,"SELECT noSelang FROM stokkantong WHERE noKantong='$no_selang'");


    if(mysql_num_rows($check_selang))
    {
        $noselang = mysqli_fetch_assoc($check_selang);
        echo $noselang['noSelang'];
    }
    else
    {
        echo $_POST['ktg'];
    }

}
//echo $test;

?>
