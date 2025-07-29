<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=titip.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
?>
<table>
<tr><td>No Kantong</td><td>Gol Darah</td><td> Produk </td><td> Tgl Aftap </td> <td> Kode Pendonor </td></tr>
<?
$t=mysql_query("SELECT s.noKantong,s.gol_darah,s.produk,s.tgl_Aftap,s.kodePendonor  
FROM stokkantong as s,dtransaksipermintaan as d where s.Status='3' and 
d.NoKantong=s.noKantong and d.Status='1' and s.kadaluwarsa > current_date  order by gol_darah,produk,noKantong");
while ($t1=mysql_fetch_assoc($t)) {
echo "<tr><td>$t1[noKantong]</td><td>$t1[gol_darah]</td><td>$t1[produk]</td><td>$t1[tgl_Aftap]</td><td>$t1[kodePendonor]</td></tr>";
}
?>
</table>

