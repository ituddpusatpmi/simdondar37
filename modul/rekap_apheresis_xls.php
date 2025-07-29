<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Donor_Apheresis.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];
$gol=$_POST[golongan];
$rh=$_POST[rhesus];
$mesin=$_POST[mesin_aph];

?>
<font size="4" color=red font-family="Arial">REKAP DONOR APHERESIS <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> SAMPAI <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?></font><br>
<table>
<tr>          
	<td align="center">NO</td>
	<td align="center">TANGGAL</td>
	<td align="center">JAM</td>
	<td align="center">KODE PENDONOR</td>
	<td align="center">NAMA DONOR</td>
	<td align="center">GOL<BR>ABO/RH</td>
	<td align="center">NO. KANTONG</td>
	<td align="center">VOL</td>
	<td align="center">HEMATO<br>KRIT</td>
	<td align="center">HB</td>
	<td align="center">TROMBO</td>
	<td align="center">LEUKO</td>
	<td align="center">AFTAP</td>
	<td align="center">STATUS</td>
	<td align="center">AFTAPER</td>
	<td align="center">MESIN<BR>APHERESIS</td>
        </tr>
<?
$no=1;
$sq="select * from htransaksi where apheresis='1' and date(tgl)>='$today' and date(tgl)<='$today1' and status=2
     and gol_darah like '$gol' and rhesus like '$rh' and mesin_apheresis like '$mesin' order by tgl";
$sq_aph=mysql_query($sq);
$rec=mysql_num_rows($sq_aph);
while($data=mysql_fetch_assoc($sq_aph)){
	$qdnr=mysql_query("select * from pendonor where kode='$data[KodePendonor]'");
	$dt_donor=mysql_fetch_assoc($qdnr);
	switch ($data[Pengambilan]){
		case '0':$pengambilan='Berhasil';break;
		case '1':$pengambilan='Batal';break;
		case '2':$pengambilan='Gagal';break;
	}
	switch ($data[caraAmbil]){
		case '0':$caraambil='Biasa';break;
		case '1':$caraambil='Tromboferesis';break;
		case '2':$caraambil='Leukaferesis';break;
		case '3':$caraambil='Plasmaferesis';break;
		case '4':$caraambil='Eritoferesis';break;
		case '5':$caraambil='Plebotomi';break;
	}
	?>
	<tr>
		<td align="right"><?=$no++?>.</td>
		<td class=input><?=substr($data['Tgl'],0,11)?></td>
		<td class=input><?=substr($data['Tgl'],11,5)?></td>
		<td class=input><?=$data[KodePendonor]?></td>
		<td class=input><?=$dt_donor[Nama]?></td>
		<td class=input align="center"><?=$data[gol_darah]?>(<?=$data[rhesus]?>)</td>
		<td class=input><?=$data[NoKantong]?></td>
		<td class=input align="center"><?=$data[Diambil]?></td>
		<td class=input align="center"><?=$data[hematokrit]?></td>
		<td class=input align="center"><?=$data[hemoglobin]?></td>
		<td class=input align="center"><?=$data[trombosit]?></td>
		<td class=input align="center"><?=$data[leukosit]?></td>
		<td class=input><?=$caraambil?></td>
		<td class=input><?=$pengambilan?></td>
		<td class=input><?=$data[petugas]?></td>
		<td class=input><?=$data[mesin_apheresis]?></td>
	</tr>
<?
}
?>
</table>
<?
mysql_close();
?>
