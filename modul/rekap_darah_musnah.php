<?
$tgl=date("Y-m-d");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_musnah_$tgl.xls");
header("Pragma: no-cache");
header("Expires: 0");
$pertgl=substr($tgl,8,2);
$perbln=substr($tgl,5,2);
$perthn=substr($tgl,0,4);
$today=$perthn."-".$perbln."-".$pertgl;
?>
<table>
<tr><td></td><td>
<h3 class="table">Tanggal Pemusnahan &nbsp;<?=$pertgl?> - <?=$perbln?> - <?=$perthn?><br>
</h3>
</td></tr>
</table>
<table border=1>
<tr><th>No</th><th>No Kantong</th><th>Alasan</th></tr>
<? 
$nk1=explode(';',$_GET[nk1]);
$al1=explode(';',$_GET[al1]);
$no=0;
for ($i=1;$i<sizeof($nk1);$i++) {
	if ($al1[$i]=='0') $alasan='Gagal Aftap';
	if ($al1[$i]=='4') $alasan='Reaktif';
	if ($al1[$i]=='1') $alasan='Lisis';
	if ($al1[$i]=='2') $alasan='Kadaluarsa';
	if ($al1[$i]=='3') $alasan='Plebotomi';
$no++;
echo "<tr><td>$no</td><td>$nk1[$i]</td><td>$alasan</td></tr>";
}
?>
</table>
