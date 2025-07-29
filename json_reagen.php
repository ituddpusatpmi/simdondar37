<?
include "config/db_connect.php";
$dokter=mysql_query("select * from reagen where Nama like '%$_GET[jenistest]%' and aktif='1'");
$ndokter=mysql_num_rows($dokter);
echo '{"reagen": [';
$n=0;
while($dokter1=mysql_fetch_assoc($dokter))
{
$n++;
$kode=$dokter1['noLot'];
$nama=$dokter1['Nama'];
echo '{';
echo '"kode":"'.$kode.'",';
echo '"nama":"'.$nama.'"';
if ($n<$ndokter) { echo '},';} else { echo '}'; }
}
echo ']}';
?>
