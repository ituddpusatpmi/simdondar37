<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_pembuatan_barcode_kantong.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';

$perbln=substr($_POST['waktu'],5,2);
$pertgl=substr($_POST['waktu'],8,2);
$perthn=substr($_POST['waktu'],0,4);

$perbln1=substr($_POST['waktu1'],5,2);
$pertgl1=substr($_POST['waktu1'],8,2);
$perthn1=substr($_POST['waktu1'],0,4);

$today      = $_POST['waktu'];
$today1     = $_POST['waktu1'];
$nokan      = "";
$jenis      = "";
$metoda     = "";
$merk       = "";
$namauser   = $_POST['user'];
$tempat     = "";

if ($_POST['nokan1']!='')   $nokan=$_POST['nokan1'];
if ($_POST['jenis2']!='')   $jenis=$_POST['jenis2'];
if ($_POST['metoda2']!='')  $metoda=$_POST['metoda2'];
if ($_POST['merk1']!='')    $merk=$_POST['merk1'];
if ($_POST['tempat2']!='')  $tempat=$_POST['tempat2'];
?>
<h3 class="list">REKAP PEMBUATAN BARCODE KANTONG  : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> s/d Tgl:
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<!--form rekap-->
<?
if($tempat==''){
        $jum=mysql_fetch_assoc(mysql_query("select count(noKantong) as kod from stokkantong where cast(tglTerima as date) >='$today' and cast(tglTerima as date) <='$today1' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%'   and AsalUTD is NULL"));
        $golA=mysql_fetch_assoc(mysql_query("select count(jenis) as S from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='1' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%'   and AsalUtd is NULL"));
        $golB=mysql_fetch_assoc(mysql_query("select count(jenis) as D from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='2' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%'   and AsalUTD is NULL"));
        $golAB=mysql_fetch_assoc(mysql_query("select count(jenis) as T from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1' and jenis='3' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%'   and AsalUTD is NULL"));
        $golO=mysql_fetch_assoc(mysql_query("select count(jenis) as Q from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1' and jenis='4' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%'   and AsalUTD is NULL"));
        $jkP=mysql_fetch_assoc(mysql_query("select count(jenis) as P from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1' and jenis='6' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%'   and AsalUTD is NULL"));
}else{
    $jum=mysql_fetch_assoc(mysql_query("select count(noKantong) as kod from stokkantong where cast(tglTerima as date) >='$today' and cast(tglTerima as date) <='$today1' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%'   and AsalUTD is NULL"));
    $golA=mysql_fetch_assoc(mysql_query("select count(jenis) as S from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='1' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%'   and AsalUtd is NULL"));
    $golB=mysql_fetch_assoc(mysql_query("select count(jenis) as D from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1'   and jenis='2' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%'   and AsalUTD is NULL"));
    $golAB=mysql_fetch_assoc(mysql_query("select count(jenis) as T from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1' and jenis='3' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%'   and AsalUTD is NULL"));
    $golO=mysql_fetch_assoc(mysql_query("select count(jenis) as Q from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1' and jenis='4' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%'   and AsalUTD is NULL"));
    $jkP=mysql_fetch_assoc(mysql_query("select count(jenis) as P from stokkantong where cast(tglTerima as date)>=' $today' and cast(tglTerima as date)<=' $today1' and jenis='6' and noKantong like '%A' and noKantong like '%$nokan%' and jenis like '%$jenis%' and merk like '%$merk%' and statTempat like '%$tempat%'   and AsalUTD is NULL"));
}
?>

<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap Jumlah Kantong Yang Baru di cetak barcode</b></th>
<tr class="field">
<td><b>Jenis Kantong</b></td>
<td><b>Jumlah </b></td>
</tr>
<tr><td>Single</td>
<td class=input><?=$golA['S']?></td></tr>
<tr><td>Double</td>
<td class=input><?=$golB['D']?></td></tr>
<tr><td>Triple</td>
<td class=input><?=$golAB['T']?></td></tr>
<tr><td>Quadruple</td>
<td class=input><?=$golO['Q']?></td></tr>
<tr><td>Pediatrik</td>
<td class=input><?=$jkP['P']?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum['kod']?></td></tr>
</table>
</td>

</tr>
</table>
</br>
<!--batas form rekap -->
<br>
<br>
<br>
<br>
<br>
<br>

<?
if($tempat==''){
    $data=mysql_query("select * from stokkantong where cast(tglTerima as date)>='$today' and cast(tglTerima as date)<='$today1' and noKantong like '%A' and noKantong like '%$nokan%' and merk like '%$merk%' and jenis like '%$jenis%'     and AsalUTD is NULL");
}else{
    $data=mysql_query("select * from stokkantong where cast(tglTerima as date)>='$today' and cast(tglTerima as date)<='$today1' and noKantong like '%A' and noKantong like '%$nokan%' and merk like '%$merk%' and jenis like '%$jenis%'   and statTempat like '%$tempat%'   and AsalUTD is NULL");
}?>

<table class="list" cellpadding=5>
	<tr class="field">
		<td>No</td>
		<td>Merk</td>
		<td>Tanggal Input</td>
		<td>No Kantong</td>
		<td>Jenis</td>
		<td>Status</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		if ($data1['StatTempat']==NULL) $tempat1="Logistik";
		if ($data1['StatTempat']=='0') $tempat1="Logistik";
		if ($data1['StatTempat']=='1' and $data1['Status']=='0') $tempat1="Aftap";
		if ($data1['StatTempat']=='1' and $data1['Status']=='1') $tempat1="Lab(Karantina)";
		if ($data1['StatTempat']=='1' and $data1['Status']=='2') $tempat1="Lab(Sehat)";
		if ($data1['StatTempat']=='1' and $data1['Status']=='3') $tempat1="Keluar";
		if ($data1['StatTempat']=='1' and $data1['Status']=='6') $tempat1="Rusak";

        switch ($data1['metoda']){
//            case "BS":  $metkantong ="BIASA";        break;
//            case "FT":  $metkantong ="FILTER";       break;
            case "TTB":  $metkantong ="TOP & TOP (Biasa)";    break;
            case "TTF":  $metkantong ="TOP & TOP (Filter)";    break;
            case "TBB":  $metkantong ="TOP & BOTTOM (Biasa)"; break;
            case "TBF":  $metkantong ="TOP & BOTTOM (Filter)"; break;
        }

		switch ($data1['jenis']){
                       case "1":
				$jenis1="Single";
				break;
                       case "2":
				$jenis1="Double";
				break;
                       case "3":
				$jenis1="Triple";
				break;
                       case "4":
				$jenis1="Quadruple"." ($metkantong)";
				break;
                       case "6":
				$jenis1="Pediatrik";
				break;
		}
		?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1['merk']?></td>
		<td><?=$data1['tglTerima']?></td>
		<td><?=$data1['noKantong']?></td>
		<td><?=$jenis1?></td>
		<td><?=$tempat1?></td>
	</tr>
<? } ?>
</table>

<table>

<?
$sekarang=date("Y-m-d");
$perbln1=substr($sekarang,5,2);
$pertgl1=substr($sekarang,8,2);
$perthn1=substr($sekarang,0,4);
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$perbln1];
$jam = date("H:i:s");
$namahari=date("l");
if ($namahari == "Sunday") $namahari = "Minggu";
else if ($namahari == "Monday") $namahari = "Senin";
else if ($namahari == "Tuesday") $namahari = "Selasa";
else if ($namahari == "Wednesday") $namahari = "Rabu";
else if ($namahari == "Thursday") $namahari = "Kamis";
else if ($namahari == "Friday") $namahari = "Jumat";
else if ($namahari == "Saturday") $namahari = "Sabtu";
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
?>
<tr ><td></td><td></td><td align=center><?=$udd[nama]?></tr>
<tr><td></td><td></td><td align=center> <?=$namahari?>, <?=$pertgl1?> <?=$bln22?> <?=$perthn1?></td></tr>
<tr><td></td><td></td><td align="center">Yang Merekap</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td align="center"><?=$namauser?></td></tr>
</table>

