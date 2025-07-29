<?
session_start();
$namabdrs=$_SESSION[bdrs];
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Stok_Darah_BDRS_$namabdrs.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';

$idbdrs=mysql_fetch_assoc(mysql_query("select kode from bdrs where nama='$namabdrs' limit 1")); 
?>
<table>
    <tr>
        <td>No Kantong</td>
        <td>Gol Darah</td>
        <td>Rhesus</td>
        <td>Produk </td>
        <td>Tgl Aftap </td>
        <td>Tgl Kadaluarsa </td>
        <td>Kode Pendonor </td>
    </tr>
<?
$t=mysql_query("SELECT noKantong,gol_darah,produk,tgl_Aftap,kadaluwarsa,kodePendonor  
                FROM stokkantong
                where Status='2' and
                (length(gol_darah)>0) and
                (length(produk)>0) and
                kadaluwarsa > current_date and
		(produk is not null) and
                (stat2='$idbdrs[kode]') and
                sah='1'
                order by gol_darah,produk,noKantong");

if (mysql_num_rows($t)==0) $t=mysql_query("select * from stokkantong  where Status='2' and (stat2='$idbdrs[kode]') order by gol_darah,produk,noKantong");
while ($t1=mysql_fetch_assoc($t)) {
    echo "
        <tr>
            <td>$t1[noKantong]</td>
            <td>$t1[gol_darah]</td>
            <td>$t1[RhesusDrh]</td>
            <td>$t1[produk]</td>
            <td>$t1[tgl_Aftap]</td>
            <td>$t1[kadaluwarsa]</td>
            <td>$t1[kodePendonor]</td>
        </tr>";
}
?>
</table>

