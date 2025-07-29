<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>

<h1 class="table">Rekap Transaksi Pembayaran</h1>
<form name="dinstansi" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Bulan Transaksi : </td>
<td>
<input class=input name="waktu" id="datepicker" type=text size=10> Sampai
<input class=input name="waktu1" id="datepicker1" type=text size=10>
</td></tr>
</table>
<input type=submit name=submit value="Search">
</form>
<?if (isset($_POST[submit])) {
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);

?>
<h1 class="table">Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h1>
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
      <!--td class=input><?=$golo[O]?></td>
      <td class=input><?=$laki[P]?></td>
      <td class=input><?=$perem[W]?></td>
      <td class=input><?=$jum[donor]?></td-->
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
</br>
<form name=xls method=post action=modul/rekap_transaksi_pembayaran_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=waktu1 value='<?=$_POST[waktu1]?>'>
<input type=submit name=submit2 value='Print Rekap Transaksi Pembayaran (.XLS)'>
</form>
<?
}
?>
