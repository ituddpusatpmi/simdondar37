<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=darah_karantina.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
?>
<table>
<tr><td>No Kantong</td><td>Gol Darah</td><td> Produk </td><td> Tgl Aftap </td> <td> Durasi Aftap </td> <td> Kode Pendonor </td></tr>
<?
$t=mysql_query("SELECT s.noKantong,s.gol_darah,s.produk,s.tgl_Aftap,s.lama_pengambilan,s.kodePendonor  
FROM stokkantong as s where s.Status='1' order by gol_darah,produk,noKantong");
if (mysql_num_rows($t)!=0) $t=mysql_query("select * from stokkantong where Status='1' and sah='1' and kadaluwarsa > current_date order by gol_darah,produk,noKantong");
while ($t1=mysql_fetch_assoc($t)) {
echo "<tr><td>$t1[noKantong]</td><td>$t1[gol_darah]</td><td>$t1[produk]</td><td>$t1[tgl_Aftap]</td><td>$t1[lama_pengambilan] menit</td><td>$t1[kodePendonor]</td></tr>";
}
?>
</table>

