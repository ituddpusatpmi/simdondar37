<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 5px;font-size: 15px;cursor: pointer; }</style>
<STYLE>
  tr { background-color: #FFF8DC}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: ##FFF8DC }
  .highlight { background-color: #8888FF }
</style>
<?php
include('config/db_connect.php');
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
where 
pendonor.apheresis=1 and
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
<form name=xls method=post action=laporan/rekap_donor_aph_xls.php>
<input class="swn_button_blue" type=submit name=submit value='Transfer data ke XLS'>
</form>
