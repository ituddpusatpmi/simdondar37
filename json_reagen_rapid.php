<?
include "config/db_connect.php";
$dokter=mysql_query("select * from reagen where Nama like '%$_GET[jenistest]%' and aktif='1'");
$ndokter=mysql_num_rows($dokter);
echo '{"reagen": [';
$n=0;
while($dokter1=mysql_fetch_assoc($dokter))
{
$nr=strtoupper($dokter1[Nama]);
$jenistest=strtoupper($_GET[jenistest]);
$merk=str_replace("$jenistest","",$nr);
$merk=str_replace(" ","",$merk);
$merk1=mysql_num_rows(mysql_query("select jenis_reagen from master_reagen where nama_reagen='$merk'"));
if ($merk1==0) {
$n++;
$kode=$dokter1['noLot'];
$nama=$dokter1['Nama'];
echo '{';
echo '"kode":"'.$kode.'",';
echo '"nama":"'.$nama.'"';
if ($n<$ndokter) { echo '},';} else { echo '}'; }
}
}
echo ']}';
?>
