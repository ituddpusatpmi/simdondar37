<?
#$db_engine = 'mysql';
$db_user = 'root';
$db_user0 = 'pmimu';
$db_pass = 'F201603907';
//$db_pass = 'dewa';
$db_host = 'localhost';
$server0 = '192.168.28.7';
$db_name='pmi';
$con=mysql_connect("localhost","root","$db_pass");
mysql_select_db("$db_name");
if (!$con)
{
     echo "tidak dapat connect ke database";
        exit;
}
?>

