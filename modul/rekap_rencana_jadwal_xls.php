<?
//$tgl=date("Y-m-d");
include '../config/db_connect.php';
$perbln=$_POST[perbln];
$pertgl=$_POST[pertgl];
$perthn=$_POST[perthn];
$perbln1=$_POST[perbln1];
$pertgl1=$_POST[pertgl1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$perthn1."-".$perbln1."-".$pertgl1;
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_rencana_jadwal_mu_$today.xls");
header("Pragma: no-cache");
header("Expires: 0");


?>
<font size="4" color=red font-family="Arial">REKAP RENCANA JADWAL MOBIL UNIT </font><br>

<?
$sql_intsansidonor=mysql_query("select * from kegiatan where CAST(TglPenjadwalan as date) >= '$today' order by TglPenjadwalan ASC");
?>
	<table border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
		<tr>          
			<td rowspan="2" align="center">NO</td>
			<td rowspan="2" align="center">INSTANSI</td>
			<td rowspan="2" align="center">TANGGAL</td>
			<td rowspan="2" align="center">RENCANA<br>JUMLAH</td>
			<td colspan="6" align="center">PETUGAS</td>
			<td rowspan="2" align="center">KENDARAAN</td>
        </tr>
		<tr >          
			<td align="center">DOKTER</td>
			<td align="center">TENSI</td>
			<td align="center">HB</td>
			<td align="center">AFTAPER</td>
			<td align="center">ADMIN</td>
			<td align="center">SOPIR</td>
        </tr>
	<?
	$no=0;
	while($data=mysql_fetch_assoc($sql_intsansidonor)){
		$no++;
	$instansi=mysql_fetch_assoc(mysql_query("select nama from detailinstansi where KodeDetail='$data[kodeinstansi]'"));
		?>
		<tr >
			<td align="left"><?=$no?>.</td>
			<td align="left" class=input><?=$instansi[nama]?></td>
			<td align="left" class=input><?=$data[TglPenjadwalan]?></td>			
			<td align="left" class=input><?=$data[jumlah]?> Org</td>
			<td align="left" class=input><?=$data[dokter]?></td>
			<td align="left" class=input><?=$data[atd2]?></td>
			<td align="left" class=input><?=$data[atd1]?></td>
			<td align="left" class=input><?=$data[atd3]?></td>
			<td align="left" class=input><?=$data[admin]?></td>
			<td align="left" class=input><?=$data[sopir]?></td>
	<?
	$kendaraan='BUS MU';
	if ($data[kendaraan]=='1') $kendaraan='MOBIL MU';
		?>
			<td align="left" class=input><?=$kendaraan?></td>
		
		</tr>
	<?
	}?>
	</table>
