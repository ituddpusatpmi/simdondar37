<?
include('../config/db_connect.php');

$ckt=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$_GET[nokan]'"));
switch($ckt[jenis]) {
case '1':
        $jenis='Single';
        break;
case '2':
        $jenis='Double';
        break;
case '3':
        $jenis='Triple';
        break;
case '4':
        $jenis='Quadruple';
        break;
case '6':
        $jenis='Pediatrik';
        break;
default:
        $jenis='';
}
?>
<table>
<tr><td colspan=3 align=center>Detail Kantong Reaktif</td></tr>
<tr><td>No Kantong </td><td>:</td><td><?=$ckt[noKantong]?></td></tr>
<tr><td>Jenis</td><td>:</td><td><?=$jenis?></td></tr>
<tr><td>Merk</td><td>:</td><td><?=$ckt[merk]?></td></tr>
<tr><td>Gol Darah</td><td>:</td><td><?=$ckt[gol_darah]?></td></tr>
<tr><td>Tgl Aftap</td><td>:</td><td><?=$ckt[tgl_Aftap]?></td></tr>
<?
$cpd=mysql_fetch_assoc(mysql_query("select pd.Kode,pd.Nama,pd.GolDarah,pd.Alamat,ht.Instansi,ht.tempat from pendonor as pd,htransaksi as ht where pd.Kode=ht.KodePendonor and ht.NoKantong='$ckt[noKantong]'"));
$tempat='Dalam Gedung';
if($cpd[tempat]='M') $tempat='Mobil Unit';
?>
<tr><td>Kode Pendonor</td><td>:</td><td><?=$cpd[Kode]?></td></tr>
<tr><td>Nama Pendonor</td><td>:</td><td><?=$cpd[Nama]?></td></tr>
<tr><td>Alamat Pendonor</td><td>:</td><td><?=$cpd[Alamat]?></td></tr>
<tr><td>Gol Darah Pendonor </td><td>:</td><td><?=$cpd[GolDarah]?></td></tr>
<tr><td>Tempat Donor </td><td>:</td><td><?=$tempat?></td></tr>
<tr><td>Instansi Donor </td><td>:</td><td><?=$cpd[Instansi]?></td></tr>
</table>


