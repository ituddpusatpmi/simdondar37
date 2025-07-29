
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
header("Content-Disposition: attachment; filename=rekap_donor_$today.xls");
header("Pragma: no-cache");
header("Expires: 0");

//$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));
?>
<h1 class="table">Tanggal Transaksi <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
<div>
<form name=sahdarah1 method=post> Mulai:
<input type=text name=terima1 id="datepicker" size=10>
Sampai:
<input type=text name=terima2 id="datepicker1" size=10>
<input type=submit name=submit value=Submit>
</form></div>
<?

//PENGAMBILAN BATAL DG

$jum_b=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'DG%'"));

$btl_11=mysql_fetch_assoc(mysql_query("select count(ketBatal) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='11' and NoTrans like 'DG%'"));

$btl_10=mysql_fetch_assoc(mysql_query("select count(ketBatal) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='10' and NoTrans like 'DG%'"));

$btl_9=mysql_fetch_assoc(mysql_query("select count(ketBatal) as C from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='9' and NoTrans like 'DG%'"));

$btl_8=mysql_fetch_assoc(mysql_query("select count(ketBatal) as D from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='8' and NoTrans like 'DG%'"));

$btl_7=mysql_fetch_assoc(mysql_query("select count(ketBatal) as E from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='7' and NoTrans like 'DG%'"));

$btl_6=mysql_fetch_assoc(mysql_query("select count(ketBatal) as F from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='6' and NoTrans like 'DG%'"));

$btl_5=mysql_fetch_assoc(mysql_query("select count(ketBatal) as G from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='5' and NoTrans like 'DG%'"));

$btl_4=mysql_fetch_assoc(mysql_query("select count(ketBatal) as H from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='4' and NoTrans like 'DG%'"));

$btl_3=mysql_fetch_assoc(mysql_query("select count(ketBatal) as I from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='3' and NoTrans like 'DG%'"));

$btl_2=mysql_fetch_assoc(mysql_query("select count(ketBatal) as J from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='2' and NoTrans like 'DG%'"));

$btl_1=mysql_fetch_assoc(mysql_query("select count(ketBatal) as K from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='1' and NoTrans like 'DG%'"));

$btl_0=mysql_fetch_assoc(mysql_query("select count(ketBatal) as L from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='0' and NoTrans like 'DG%'"));

?>
<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Dalam Gedung BATAL</b></th>
<tr class="field">
<td><b>Alasan Ditolak</b></td>
<td><b>Jumlah</b></td>
</tr>
<tr><td> Berat Badan Kurang (kurang dari 45 kg) </td>
<td class=input><?=$btl_5[G]?></td></tr>
<tr><td> Hb Mengapung </td>
<td class=input><?=$btl_2[J]?></td></tr>
<tr><td> Hb Melayang</td>
<td class=input><?=$btl_3[I]?></td></tr>
<tr><td><b>HB Tinggi</b></td>
<td class=input><?=$btl_4[H]?></td></tr>
<tr><td> Kondesi Medis Lain</td>
<td class=input><?=$btl_8[D]?></td></tr>
<tr><td>Perilaku Beresiko Tinggi</td>
<td class=input><?=$btl_9[C]?></td></tr>
<tr><td>Riwayat Bepergian</td>
<td class=input><?=$btl_7[E]?></td></tr>
<tr><td><b>Alasan Lain</b></td>
<td class=input><?=$btl_10[B]?></td></tr>
</table>
</td>
</tr>
</table>
</br>

<?

//Mobile BATAL

$jum_mb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'M%'"));

$btlm_11=mysql_fetch_assoc(mysql_query("select count(ketBatal) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='11' and NoTrans like 'M%'"));

$btlm_10=mysql_fetch_assoc(mysql_query("select count(ketBatal) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='10' and NoTrans like 'M%'"));

$btlm_9=mysql_fetch_assoc(mysql_query("select count(ketBatal) as C from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='9' and NoTrans like 'M%'"));

$btlm_8=mysql_fetch_assoc(mysql_query("select count(ketBatal) as D from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='8' and NoTrans like 'M%'"));

$btlm_7=mysql_fetch_assoc(mysql_query("select count(ketBatal) as E from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='7' and NoTrans like 'M%'"));

$btlm_6=mysql_fetch_assoc(mysql_query("select count(ketBatal) as F from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='6' and NoTrans like 'M%'"));

$btlm_5=mysql_fetch_assoc(mysql_query("select count(ketBatal) as G from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='5' and NoTrans like 'M%'"));

$btlm_4=mysql_fetch_assoc(mysql_query("select count(ketBatal) as H from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='4' and NoTrans like 'M%'"));

$btlm_3=mysql_fetch_assoc(mysql_query("select count(ketBatal) as I from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='3' and NoTrans like 'M%'"));

$btlm_2=mysql_fetch_assoc(mysql_query("select count(ketBatal) as J from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='2' and NoTrans like 'M%'"));

$btlm_1=mysql_fetch_assoc(mysql_query("select count(ketBatal) as K from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='1' and NoTrans like 'M%'"));

$btlm_0=mysql_fetch_assoc(mysql_query("select count(ketBatal) as L from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='0' and NoTrans like 'M%'"));



//BUS BATAL

$mjum_mb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'M%' and kendaraan='0'"));

$btlb_10=mysql_fetch_assoc(mysql_query("select count(ketBatal) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='10' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_9=mysql_fetch_assoc(mysql_query("select count(ketBatal) as C from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='9' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_8=mysql_fetch_assoc(mysql_query("select count(ketBatal) as D from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='8' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_7=mysql_fetch_assoc(mysql_query("select count(ketBatal) as E from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='7' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_6=mysql_fetch_assoc(mysql_query("select count(ketBatal) as F from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='6' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_5=mysql_fetch_assoc(mysql_query("select count(ketBatal) as G from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='5' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_4=mysql_fetch_assoc(mysql_query("select count(ketBatal) as H from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='4' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_3=mysql_fetch_assoc(mysql_query("select count(ketBatal) as I from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='3' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_2=mysql_fetch_assoc(mysql_query("select count(ketBatal) as J from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='2' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_1=mysql_fetch_assoc(mysql_query("select count(ketBatal) as K from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='1' and NoTrans like 'M%' and kendaraan='0'"));

$btlb_0=mysql_fetch_assoc(mysql_query("select count(ketBatal) as L from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and ketBatal='0' and NoTrans like 'M%' and kendaraan='0'"));

?>
<br>
<table><tr>
<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Mobile Unit BATAL</b></th>
<tr class="field">
<td><b>Alasan Ditolak</b></td>
<td><b>Jumlah </b></td>
</tr>
<tr><td> Berat Badan Kurang (kurang dari 45 kg) </td>
<td class=input><?=$btlm_5[G]?></td></tr>
<tr><td> Hb Mengapung </td>
<td class=input><?=$btlm_2[J]?></td></tr>
<tr><td> Hb Melayang</td>
<td class=input><?=$btlm_3[I]?></td></tr>
<tr><td><b>HB Tinggi</b></td>
<td class=input><?=$btlm_4[H]?></td></tr>
<tr><td> Kondesi Medis Lain</td>
<td class=input><?=$btlm_8[D]?></td></tr>
<tr><td>Perilaku Beresiko Tinggi</td>
<td class=input><?=$btlm_9[C]?></td></tr>
<tr><td>Riwayat Bepergian</td>
<td class=input><?=$btlm_7[E]?></td></tr>
<tr><td><b>Alasan Lain</b></td>
<td class=input><?=$btlm_10[B]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP BUS DONOR BATAL</b></th>
<tr class="field">
<td><b>Alasan Ditolak</b></td>
<td><b>Jumlah </b></td>
</tr>

<tr><td> Berat Badan Kurang (kurang dari 45 kg) </td>
<td class=input><?=$btlb_5[G]?></td></tr>
<tr><td> Hb Mengapung </td>
<td class=input><?=$btlb_2[J]?></td></tr>
<tr><td> Hb Melayang</td>
<td class=input><?=$btlb_3[I]?></td></tr>
<tr><td><b>HB Tinggi</b></td>
<td class=input><?=$btlb_4[H]?></td></tr>
<tr><td> Kondesi Medis Lain</td>
<td class=input><?=$btlb_8[D]?></td></tr>
<tr><td>Perilaku Beresiko Tinggi</td>
<td class=input><?=$btlb_9[C]?></td></tr>
<tr><td>Riwayat Bepergian</td>
<td class=input><?=$btlb_7[E]?></td></tr>
<tr><td><b>Alasan Lain</b></td>
<td class=input><?=$btlb_10[B]?></td></tr>
</table>
</td>
</tr>
</table>
</br>
