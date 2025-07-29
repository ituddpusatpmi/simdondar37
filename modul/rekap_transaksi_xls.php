<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_transaksi_mobile.xls");
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
<table border=0><tr><td colspan='5'>
Rekap Transaksi Kegiatan Donor Darah Mobil Unit</td></tr>
<tr><td colspan='5'>Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></td></tr>
<tr><td></td></tr></table>

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
	  <td rowspan='4' align=center>No</td>
          <td rowspan='4' align="center">TGL DONOR</td>
          <td rowspan='4' align="center">NAMA INSTANSI</td>
	<td colspan='10' align=center>DONOR BERHASIL</td>
	<td colspan='10' align=center>DONOR GAGAL</td>
	<td colspan='10' align=center>DONOR BATAL</td>
	<td rowspan='4'  align=center>JML <br>PENDONOR</td>
</tr>
<tr>
	<td colspan='7'>DARAH</td>
	<td colspan='2' rowspan='2' align="center">JK</td>
	<td rowspan='3' align="center">JML</td>

	<td colspan='7' align="center">DARAH</td>
	<td colspan='2' rowspan='2' align="center">JK</td>
	<td rowspan='3' align="center">JML</td>

	<td colspan='7' align="center">DARAH</td>
	<td colspan='2' rowspan='2' align="center">JK</td>
	<td rowspan='3' align="center">JML</td>
</tr>
<tr>	
	<td colspan='5' align="center">GOLONGAN</td>
	<td colspan='2' align="center">RHESUS</td>
	
	<td colspan='5' align="center">GOLONGAN</td>
	<td colspan='2' align="center">RHESUS</td>

	<td colspan='5' align="center">GOLONGAN</td>
	<td colspan='2' align="center">RHESUS</td>	
</tr>

<tr>
          <td>A</td>
          <td>B</td>
          <td>AB</td>
          <td>O</td>
	  <td>X</td>
		<td>POS</td>
		<td>NEG</td>
          <td >Laki<br>laki</td>
          <td >Perem<br>puan</td>

	<td>A</td>
          <td>B</td>
          <td>AB</td>
          <td>O</td>
	  <td>X</td>
		<td>POS</td>
		<td>NEG</td>
          <td>Laki<br>laki</td>
          <td>Perem<br>puan</td>

	<td>A</td>
          <td>B</td>
          <td>AB</td>
          <td>O</td>
	  <td>X</td>
		<td>POS</td>
		<td>NEG</td>
          <td>Laki<br>laki</td>
          <td>Perem<br>puan</td>
          
</tr>
<?
$no=1;
$tgldonor0=mysql_query("select CAST(Tgl as date) as tgl,Instansi from htransaksi where NoTrans like 'M%' and instansi!='' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' group by Instansi order by Tgl");
while ($tgldonor=mysql_fetch_assoc($tgldonor0)) {
//Berhasil
$gola=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as A 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and gol_darah='A'"));
$golb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as B 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and gol_darah='B'"));
$golab=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as AB 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and gol_darah='AB'"));
$golo=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as O 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and gol_darah='O'"));
$golx=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as X 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and gol_darah='X'"));
$rhp=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as POS 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and rhesus='+'"));
$rhn=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as NEG 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and rhesus='-'"));
$laki=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as P 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and jk='0'"));
$perem=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as W 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' and jk='1'"));
$jum=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as donor 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='0' and Instansi='$tgldonor[Instansi]' "));

//GAGAL
$golag=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as A 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and gol_darah='A'"));
$golbg=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as B 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and gol_darah='B'"));
$golabg=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as AB 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and gol_darah='AB'"));
$golog=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as O 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and gol_darah='O'"));
$golxg=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as X 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and gol_darah='X'"));
$rhpg=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as POS 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and rhesus='+'"));
$rhng=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as NEG 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and rhesus='-'"));
$lakig=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as P 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and jk='0'"));
$peremg=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as W 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' and jk='1'"));
$jumg=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as donor 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='2' and Instansi='$tgldonor[Instansi]' "));

//Batal
$gola_b=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as A 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and gol_darah='A'"));
$golbb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as B 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and gol_darah='B'"));
$golabb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as AB 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and gol_darah='AB'"));
$golob=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as O 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and gol_darah='O'"));
$golxb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as X 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and gol_darah='X'"));
$rhpb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as POS 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and rhesus='+'"));
$rhnb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as NEG 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and rhesus='-'"));
$lakib=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as P 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and jk='0'"));
$peremb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as W 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' and jk='1'"));
$jumb=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as donor 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and 
Pengambilan='1' and Instansi='$tgldonor[Instansi]' "));

$jumtot=mysql_fetch_assoc(mysql_query("select count(distinct KodePendonor) as total 
from htransaksi where NoTrans like 'M%' and cast(Tgl as date)>='$_POST[waktu]' and cast(Tgl as date)<='$_POST[waktu1]' and Instansi='$tgldonor[Instansi]' "));

?>
<tr class="record">
<?
$perbln2=substr($tgldonor[tgl],5,2);
$pertgl2=substr($tgldonor[tgl],8,2);
$perthn2=substr($tgldonor[tgl],0,4);
$tanggal=$pertgl2."-".$perbln2."-".$perthn2;
?>
	<td class=input><?=$no++?></td>
      <td class=input><?=$tanggal?></td>
      <td class=input><?=$tgldonor[Instansi]?></td>
      <td class=input><?=$gola[A]?></td>
      <td class=input><?=$golb[B]?></td>
      <td class=input><?=$golab[AB]?></td>
      <td class=input><?=$golo[O]?></td>
      <td class=input><?=$golx[X]?></td>
	<td class=input><?=$rhp[POS]?></td>
      	<td class=input><?=$rhn[NEG]?></td>
      <td class=input><?=$laki[P]?></td>
      <td class=input><?=$perem[W]?></td>
      <td class=input><?=$jum[donor]?></td>

	<td class=input><?=$golag[A]?></td>
      <td class=input><?=$golbg[B]?></td>
      <td class=input><?=$golabg[AB]?></td>
      <td class=input><?=$golog[O]?></td>
      <td class=input><?=$golxg[X]?></td>
	<td class=input><?=$rhpg[POS]?></td>
      	<td class=input><?=$rhng[NEG]?></td>
      <td class=input><?=$lakig[P]?></td>
      <td class=input><?=$peremg[W]?></td>
      <td class=input><?=$jumg[donor]?></td>

	<td class=input><?=$gola_b[A]?></td>
      <td class=input><?=$golbb[B]?></td>
      <td class=input><?=$golabb[AB]?></td>
      <td class=input><?=$golob[O]?></td>
      <td class=input><?=$golxb[X]?></td>
	<td class=input><?=$rhpb[POS]?></td>
      	<td class=input><?=$rhnb[NEG]?></td>
      <td class=input><?=$lakib[P]?></td>
      <td class=input><?=$peremb[W]?></td>
      <td class=input><?=$jumb[donor]?></td>

	<td class=input><?=$jumtot[total]?></td>
	</tr>
<?
}

?>
</table>
