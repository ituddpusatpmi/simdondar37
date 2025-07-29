<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=pendonor_apheresis.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
?>
<font size="4" color=red font-family="Arial">DAFTAR PENDONOR APHERESIS</font><br>
<?
$sql_donor="SELECT pendonor.`Kode` , pendonor.`Nama` , pendonor.`Alamat` , pendonor.`Jk` , pendonor.`GolDarah` , pendonor.`Rhesus` , pendonor.`jumDonor` , pendonor.`telp` , pendonor.`telp2` , pendonor.`tglkembali` , pendonor.`tglkembali_apheresis` 
FROM pendonor WHERE pendonor.apheresis =1 ORDER BY tglkembali_apheresis ASC ";?>
	<table  border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
		<tr  style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
			<td align="center">NO</td>
			<td align="center">KODE</td>
			<td align="center">NAMA PENDONOR</td>
			<td align="center">GOLDA</td>
			<td align="center">ALAMAT</td>
			<td align="center">TELP</td>
			<td align="center">TGL KEMBALI</td>
			<td align="center">JML APHERESIS</td>
        </tr>
	<?
	$no=0;$jmlaph=0;
	$sq_sum=mysql_query($sql_donor);
	$rec=mysql_num_rows($sq_sum);
	while($data=mysql_fetch_assoc($sq_sum)){
		$no++;
		$jmlaph=0;
		$sql_jml="select count(KodePendonor) as jml from htransaksi where apheresis='1'and  Pengambilan='0' and KodePendonor='$data[Kode]'";
		$sql_jml1=mysql_query($sql_jml);
		$sql_dt=mysql_fetch_assoc($sql_jml1);
		$jmlaph=$sql_dt[jml];
		?>
		<tr  style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no?>.</td>
			<td align="left" class=input><?=$data[Kode]?></td>
			<td align="left" class=input><?=$data[Nama]?></td>
			<td align="left" class=input><?=$data[GolDarah].$data[Rhesus]?></td>
			<td align="left" class=input><?=$data[Alamat]?></td>
			<td align="left" class=input><?=$data[telp]?></td>
			<td align="left" class=input><?=$data[tglkembali_apheresis]?></td>
			<td align="right" class=input><?=$jmlaph?></td>
		</tr>
	<?
	}?>
	</table>
