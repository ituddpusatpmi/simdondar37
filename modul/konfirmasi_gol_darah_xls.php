<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_konfirmasi_goldarah.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$perthn1=$_POST[perthn1];

$tg=$pertgl.$perbln.$perthn1;
?>
<h3 class="table">Rekap Konfirmasi Gol Darah <?=$pertgl?> - <?=$perbln?> - <?=$perthn?><br>
</h3>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
        <td>No Konfirmasi</td>
        <td>No Kantong</td>
        <td>Gol Darah</td>
        <td>Kode Pendonor</td>
        <td>Nama Pendonor</td>
	<td>Alamat</td>
	<td>Hasil</td>
        </tr>
</tr>
<?
$rekon0=mysql_query("select dk.NoKonfirmasi,dk.NoKantong,dk.GolDarah,dk.Rhesus,dk.Cocok,ht.KodePendonor from dkonfirmasi as dk, htransaksi as ht where dk.NoKantong=ht.NoKantong and substring(dk.NoKonfirmasi,2,6)='$tg'");
while ($rekon=mysql_fetch_assoc($rekon0)) {
?>
<tr class="record">
      <td class=input><?=$rekon[NoKonfirmasi]?></td>
      <td class=input><?=$rekon[NoKantong]?></td>
      <td class=input><?=$rekon[GolDarah]?> (<?=$rekon[Rhesus]?>)</td>
      <td class=input><?=$rekon[KodePendonor]?></td>
<?
$nm=mysql_fetch_assoc(mysql_query("select Nama from pendonor where Kode='$rekon[KodePendonor]'"));
$almt=mysql_fetch_assoc(mysql_query("select Alamat from pendonor where Kode='$rekon[KodePendonor]'"));
?>
	<td class=input><?=$nm[Nama]?></td>
	<td class=input><?=$almt[Alamat]?></td>
<?
$hasil='Cocok';
if ($rekon[Cocok]=='1') $hasil='Tidak Cocok';
?>
	<td class=input><?=$hasil?></td>

        </tr>
<?
}
?>
</table>

