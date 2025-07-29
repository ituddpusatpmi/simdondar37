<?php
$db_user = 'root';
$db_pass = 'F201603907';
$db_host = 'localhost';
$db_name='sms';
$con=mysql_connect($db_host,"root","$db_pass");
mysql_select_db($db_name);
if (!$con)
{
     echo "tidak dapat connect ke database";
        exit;
}
?>

