<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_transaksi_pembayaran.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
?>
<table border=0><tr><td>
Rekap Transaksi Pembayaran </td></tr>
<tr><td>Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></td></tr>
<tr><td></td></tr></table>

<table class=form border=1 cellpadding=0 cellspacing=0>
          <tr><td rowspan=3></th>
          <th colspan=7>Jenis Biaya</th>
          <!--th rowspan=3>Gol Darah B</th>
          <th rowspan=3>Gol Darah AB</th>
          <th rowspan=3>Gol Darah O</th-->
         
        </tr>
	<tr>

				<th><b>BPPD</b></th>
				<th><b>MOU RS Karya Husada</b></th>
				<th><b>MOU RS Islam Karawang</b></th>
				<th><b>MOU RS Bayukarta</b></th>
				<th><b>MOU RSIA Dr Djoko Pramono</b></th>
				<th><b>MOU RS Cito Karawang</b></th>
				<th><b>MOU RS Dewi Sri</b></th>
	</tr>
	<tr>

				<th><b>250000</b></th>
				<th><b>250000</b></th>
				<th><b>250000</b></th>
				<th><b>250000</b></th>
				<th><b>250000</b></th>
				<th><b>250000</b></th>
				<th><b>250000</b></th>
	</tr>
<?
/*$tgldonor0=mysql_query("select CAST(tgl_keluar as date) ,namabrg,harga from dpembayaranpermintaan where cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]' group by namabrg order by tgl_keluar");
while ($tgldonor=mysql_fetch_assoc($tgldonor0)) */
{

$gola=mysql_fetch_assoc(mysql_query("select count(namabrg)as A
from dpembayaranpermintaan where namabrg='BPPD' and cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]'"));
$golb=mysql_fetch_assoc(mysql_query("select count(namabrg)as B
from dpembayaranpermintaan where namabrg='MOU RS Karya Husada' and cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]'"));
$golc=mysql_fetch_assoc(mysql_query("select count(namabrg)as C
from dpembayaranpermintaan where namabrg='MOU RS Islam Karawang' and cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]'"));
$gold=mysql_fetch_assoc(mysql_query("select count(namabrg)as D
from dpembayaranpermintaan where namabrg='MOU RS Bayukarta' and cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]'"));
$gole=mysql_fetch_assoc(mysql_query("select count(namabrg)as E
from dpembayaranpermintaan where namabrg='MOU RSIA Dr Djoko Pramono' and cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]'"));
$golf=mysql_fetch_assoc(mysql_query("select count(namabrg)as F
from dpembayaranpermintaan where namabrg='MOU RS Cito Karawang' and cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]'"));
$golg=mysql_fetch_assoc(mysql_query("select count(namabrg)as G
from dpembayaranpermintaan where namabrg='MOU RS Dewi Sri' and cast(tgl_keluar as date)>='$_POST[waktu]' and cast(tgl_keluar as date)<='$_POST[waktu1]'"));

?>
<tr class="record">
<?
$perbln2=substr($tgldonor[tgl],5,2);
$pertgl2=substr($tgldonor[tgl],8,2);
$perthn2=substr($tgldonor[tgl],0,4);
$tanggal=$pertgl2."-".$perbln2."-".$perthn2;
?>
     	<td class=input>Jumlah</td>  
	<td class=input><?=$gola[A]?></td>
      	<td class=input><?=$golb[B]?></td>
 	<td class=input><?=$golc[C]?></td>
	<td class=input><?=$gold[D]?></td>
      	<td class=input><?=$gole[E]?></td>
	<td class=input><?=$golf[F]?></td>
	<td class=input><?=$golg[G]?></td>
	</tr>
<tr>
<td class=input>Jumlah Uang</td>  
	<th class=input><?=$gola[A]*250000?></th>
	<th class=input><?=$golb[B]*250000?></th>
	<th class=input><?=$golc[C]*250000?></th>
	<th class=input><?=$gold[D]*250000?></th>
	<th class=input><?=$gole[E]*250000?></th>
	<th class=input><?=$golf[F]*250000?></th>
	<th class=input><?=$golg[G]*250000?></th>
</tr>
<?
}
?>
</table>
