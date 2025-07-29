<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Donor_Apheresis_Aktif.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$level_user=$_SESSION['leveluser'];

?>
<font size="4" color=red font-family="Arial">DAFTAR PENDONOR APHERESIS AKTIF</font><br>
<?
$sql_donor="select 
pendonor.`Kode`,
pendonor.`Nama`,
pendonor.`Alamat`,
pendonor.`Jk`,
pendonor.`GolDarah`,
pendonor.`Rhesus`,
pendonor.`jumDonor`,
pendonor.`telp`,
pendonor.`telp2`,
pendonor.`tglkembali`,
pendonor.`tglkembali_apheresis`, 
count(htransaksi.KodePendonor) as JmlApheresis
from pendonor left join htransaksi
on pendonor.Kode=htransaksi.KodePendonor
where pendonor.apheresis=1 and
htransaksi.apheresis=1 and
htransaksi.Pengambilan='0'
group by
pendonor.`Kode`,
pendonor.`Nama`,
pendonor.`Alamat`,
pendonor.`Jk`,
pendonor.`GolDarah`,
pendonor.`Rhesus`,
pendonor.`jumDonor`,
pendonor.`telp`,
pendonor.`telp2`,
pendonor.`tglkembali`,
pendonor.`tglkembali_apheresis`
order by count(htransaksi.KodePendonor) desc";?>
	<table border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
		<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
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
	$no=0;
	$sq_sum=mysql_query($sql_donor);
	$rec=mysql_num_rows($sq_sum);
	while($data=mysql_fetch_assoc($sq_sum)){
		$no++;
		?>
		<tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="right"><?=$no?>.</td>
			<td align="left" class=input><?=$data[Kode]?></td>
			<td align="left" class=input><?=$data[Nama]?></td>
			<td align="left" class=input><?=$data[GolDarah].$data[Rhesus]?></td>
			<td align="left" class=input><?=$data[Alamat]?></td>
			<td align="left" class=input><?=$data[telp]?></td>
			<td align="left" class=input><?=$data[tglkembali_apheresis]?></td>
			<td align="right" class=input><?=$data[JmlApheresis]?></td>
		</tr>
	<?
	}?>
	</table>
<br>
</br>
