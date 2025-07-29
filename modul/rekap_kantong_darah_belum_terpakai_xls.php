<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_kantong_belum_terpakai_diAFTAP.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$today=date("d-m-y");
$namauser=$_SESSION[namauser];
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);
?>
<h3 class="list">Rincian Kantong Belum terpakai di AFTAP dari Tgl : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> s/d Tgl:
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<!--form rekap-->

<?
$jum=mysql_fetch_assoc(mysql_query("select count(noKantong) as kod from stokkantong where noKantong like '%A' and StatTempat='1' and status='0'"));
/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendono) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
$golA=mysql_fetch_assoc(mysql_query("select count(jenis) as S from stokkantong where StatTempat='1' and jenis='1' and noKantong like '%A' and status='0' "));
$golB=mysql_fetch_assoc(mysql_query("select count(jenis) as D from stokkantong where StatTempat='1' and jenis='2' and noKantong like '%A'  and status='0'"));
$golAB=mysql_fetch_assoc(mysql_query("select count(jenis) as T from stokkantong where StatTempat='1' and jenis='3' and noKantong like '%A' and status='0'"));
$golO=mysql_fetch_assoc(mysql_query("select count(jenis) as Q from stokkantong where StatTempat='1' and jenis='4' and noKantong like '%A'and status='0' "));
$jkP=mysql_fetch_assoc(mysql_query("select count(jenis) as P from stokkantong where StatTempat='1' and jenis='6' and noKantong like '%A' and status='0'"));
?>

<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap Jumlah Kantong Yang belum terpakai di AFTAP</b></th>
<tr class="field">
<td><b>Jenis Kantong</b></td>
<td><b>Jumlah </b></td>
</tr>
<tr><td>Single</td>
<td class=input><?=$golA[S]?></td></tr>
<tr><td>Double</td>
<td class=input><?=$golB[D]?></td></tr>
<tr><td>Triple</td>
<td class=input><?=$golAB[T]?></td></tr>
<tr><td>Quadruple</td>
<td class=input><?=$golO[Q]?></td></tr>
<tr><td>Pediatrik</td>
<td class=input><?=$jkP[P]?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum[kod]?></td></tr>
</table>
</td>

</tr>
</table>
</br>
<!--batas form rekap -->


<br></br>
<br></br>
<br></br>
<br></br>



<?
$data=mysql_query("select * from stokkantong where noKantong like '%A' and StatTempat='1' and status='0' "); ?>
<table class="list" cellpadding=5>
	<tr class="field">
		<td>No</td>
		<td>Merk</td>
		<td>Tanggal Input</td>
		<td>No Kantong</td>
		<td>Jenis</td>
		<td>Tempat</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		if ($data1[StatTempat]=='') $tempat="Logistik";
		if ($data1[StatTempat]=='1') $tempat="Lab";
		switch ($data1[jenis]){
                       case "1":
				$jenis="Single";
				break;
                       case "2":
				$jenis="Double";
				break;
                       case "3":
				$jenis="Triple";
				break;
                       case "4":
				$jenis="Quadruple";
				break;
                       case "6":
				$jenis="Pediatrik";
				break;
		}
		?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[merk]?></td>
		<td><?=$data1[tglTerima]?></td>
		<td><?=$data1[noKantong]?></td>
		<td><?=$jenis?></td>
		<td><?=$tempat?></td>
	</tr>
<? } ?>
</table>

<table>

<?
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
?>
<tr><td></td><td></td><td><?=$udd[nama]?>, <?=$today?></td></tr>
<tr><td></td><td>Yang Menerima</td><td>Yang Menyerahkan</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td>(.......................)</td><td>(.......................)</td></tr>
</table>
