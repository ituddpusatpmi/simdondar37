<html>
<head>
<style type="text/css">
.tabel {
font-size: 11px;
font-family:"verdana";	
border:1px solid #999;
	}
</style>
</head>
<? include ('../config/db_connect.php');?>
<body>
<?
if(isset($_POST['submit'])){
$bulanffpa=$_POST['bulan'];
$tahunffpa=$_POST['tahun'];
$produk=$_POST['produk'];
$queryffpa= "SELECT * FROM qc WHERE bulanqc=$bulanffpa AND tahunqc=$tahunffpa AND produk='FFP'";
$sql=mysql_query($queryffpa) or die(mysql_error());
//$query=mysql_fetch_assoc($sql);
}
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];

if($bulan==01) $tmplbulan=JANUARI;
if($bulan==02) $tmplbulan=FEBRUARI;
if($bulan==03) $tmplbulan=MARET;
if($bulan==04) $tmplbulan=APRIl;
if($bulan==05) $tmplbulan=MEI;
if($bulan==06) $tmplbulan=JUNI;
if($bulan==07) $tmplbulan=JULI;
if($bulan==08) $tmplbulan=AGUSTUS;
if($bulan==09) $tmplbulan=SEPTEMBER;
if($bulan==10) $tmplbulan=OKTOBER;
if($bulan==11) $tmplbulan=NOVEMBER;
if($bulan==12) $tmplbulan=DESEMBER;
?>
HASIL QC BULAN <? echo ''.$tmplbulan.''?> TAHUN <? echo''.$tahun.''?>
<br></br>
HASIL QC FFP
<table class="tabel" cellpadding="1" border="1" >
<tr bgcolor="#FF0000">
<td align="center">No</td>
<td align="center">Jenis Kantong</td>
<td align="center">No Kantong</td>
<td align="center">Gol. Darah</td>
<td align="center">Tgl Pembuatan</td>
<td align="center">Kadaluwarsa</td>
<td align="center">Berat</td>
<td align="center">Volume<br>(135 - 165 ml)</br></td>
<td align="center">Lekosit<br><0.1 x 10<sup>9</sup>/L</br></td>
<td align="center">&#8721Trombosit<br>< 50 X 10<sup>10</sup>/L</br></td>
<td align="center">SDM<br>< 4.67 X 10<sup>9</sup>/L</br></td>
<td align="center">Faktor VIII<br>> 0.70 IU/mL</br></td>
<td align="center">Aerob</td>
<td align="center">Anaerob</td>
</tr>
<?
$s=0;
while($lihat=mysql_fetch_assoc($sql)) {
	$s++;
echo'<tr bgcolor="#FF9999">
<td>
'.$s.'
</td>
<td>'.$lihat['merk'].'</td>
<td>
'.$lihat['nokantong'].'
</td>
<td>'.$lihat['gol_darah'].'('.$lihat['RhesusDrh'].')</td>
<td>
'.$lihat['tglpengolahan'].'
</td>
<td>'.$lihat['kadaluwarsa'].'</td>
<td>'.$lihat['berat'].'</td>
<td>'.$lihat['volume'].'</td>
<td>'.$lihat['lekosit'].'</td>
<td>'.$lihat['trombosit'].'</td>
<td>'.$lihat['sdm'].'</td>
<td>'.$lihat['vaktorviii'].'</td>
<td>'.$lihat['aerob'].'</td>
<td>'.$lihat['anaerob'].'</td>
</tr>';
}
?>
<tr>
<td colspan="7" align="right">Persen Lulus</td>
<td align="center">100%</td>
<td colspan="4" align="center">100%</td>
<td colspan="2" align="center">100%</td>
</tr>
<?
$bulanffp=$_POST['bulan'];
$tahunffp=$_POST['tahun'];
$sqlffp=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp AND tahunqc=$tahunffp AND produk='FFP'") or die(mysql_error());
$jumbarisffp=mysql_num_rows($sqlffp);

$bulanffp1=$_POST['bulan'];
$tahunffp1=$_POST['tahun'];
$sqlffp1=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp1 AND tahunqc=$tahunffp1 AND produk='FFP' AND volume > 165") or die(mysql_error());
$volffplebih=mysql_num_rows($sqlffp1);

$bulanffp2=$_POST['bulan'];
$tahunffp2=$_POST['tahun'];
$sqlffp2=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp2 AND tahunqc=$tahunffp2 AND produk='FFP' AND volume < 135") or die(mysql_error());
$volffpkrng=mysql_num_rows($sqlffp2);

$bulanffp3=$_POST['bulan'];
$tahunffp3=$_POST['tahun'];
$sqlffp3=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp3 AND tahunqc=$tahunffp3 AND produk='FFP' AND lekosit > 0.1") or die(mysql_error());
$lekositffp=mysql_num_rows($sqlffp3);

$bulanffp4=$_POST['bulan'];
$tahunffp4=$_POST['tahun'];
$sqlffp4=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp4 AND tahunqc=$tahunffp4 AND produk='FFP' AND trombosit > 50") or die(mysql_error());
$tcffp=mysql_num_rows($sqlffp4);

$bulanffp5=$_POST['bulan'];
$tahunffp5=$_POST['tahun'];
$sqlffp5=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp5 AND tahunqc=$tahunffp5 AND produk='FFP' AND sdm > 4.67") or die(mysql_error());
$sdmffp=mysql_num_rows($sqlffp5);

$bulanffp6=$_POST['bulan'];
$tahunffp6=$_POST['tahun'];
$sqlffp6=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp6 AND tahunqc=$tahunffp6 AND produk='FFP' AND vaktorviii < 0.70") or die(mysql_error());
$fakviii=mysql_num_rows($sqlffp6);

$bulanffp7=$_POST['bulan'];
$tahunffp7=$_POST['tahun'];
$sqlffp7=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp7 AND tahunqc=$tahunffp7 AND produk='FFP' AND aerob='positif'") or die(mysql_error());
$ffpaerob=mysql_num_rows($sqlffp7);

$bulanffp8=$_POST['bulan'];
$tahunffp8=$_POST['tahun'];
$sqlffp8=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanffp8 AND tahunqc=$tahunffp8 AND produk='FFP' AND anaerob='positif'") or die(mysql_error());
$ffpanaerob=mysql_num_rows($sqlffp8);

$persenffp= 100;
$jumkolomffp1=2;
$jumkolomffp2=4;
//volume
$bagivolffp=$persenffp / $jumbarisffp;
$kaliffplbh=$bagivolffp * $volffplebih;
$kaliffpkrg=$bagivolffp * $volffpkrng;
$hslvolkurang=$persenffp - $kaliffpkrg;
$hslvolffp=$hslvolkurang - $kaliffplbh; 

//hematologi
$persenpembagiffp=$jumbarisffp * $jumkolomffp2;
$persenminus=$persenffp / $persenpembagiffp;
$minuslekosit=$persenminus * $lekositffp;
$minustrombo=$persenminus * $tcffp;
$minussdm=$persenminus * $sdmffp;
$minusfakviii=$persenminus * $fakviii;

$hsllekosit=$persenffp - $minuslekosit;
$hsltrombosit=$hsllekosit - $minustrombo;
$hslsdm=$hsltrombosit - $minussdm;
$hslakhrhema=$hslsdm - $minusfakviii;

//kontaminasi bakteri
$persenpembagi1=$jumbarisffp * $jumkolomffp1;
$persenminuskonbak=$persenffp / $persenpembagi1;
$minuskonbak=$persenminuskonbak * $ffpaerob;
$minuskonbak1=$persenminuskonbak * $ffpanaerob;
$aerobffp=$persenffp - $minuskonbak;
$hasilkonbakffp=$aerobffp - $minuskonbak1;

?>
<tr>
<td colspan="7" align="right">Hasil</td>
<td align="center"><? echo $hslvolffp?></td>
<td colspan="4" align="center"><? echo $hslakhrhema ?></td>
<td colspan="2" align="center"><? echo $hasilkonbakffp ?></td>
</tr>
</table>
<br></br>
<? 
$bulantc=$_POST['bulan'];
$tahuntc=$_POST['tahun'];
$sqltc="SELECT * FROM qc WHERE bulanqc=$bulantc AND tahunqc=$tahuntc AND produk='TC'";
$sql1=mysql_query($sqltc)  or die(mysql_error());
?>
HASIL QC TC
<table class="tabel" cellpadding="1" border="1">
<tr bgcolor="#FF0000">
<td align="center">No</td>
<td align="center">Jenis Kantong</td>
<td align="center">No Kantong</td>
<td align="center">Gol. Darah</td>
<td align="center">Tgl Pembuatan</td>
<td align="center">Kadaluwarsa</td>
<td align="center">Berat</td>
<td align="center">Swirling</td>
<td align="center">Volume<br>40 - 60 mL<br></td>
<td align="center">Ph<br>>6.4</br></td>
<td align="center">&#8721Trombosit Per Unit<br>>46 X 10<sup>9</sup></br></td>
<td align="center">Aerob</td>
<td align="center">Anaerob</td>
</tr>
<?
$s1=0;
while($lihat1=mysql_fetch_assoc($sql1)) {
	$s1++;
echo'<tr bgcolor="#FF9999">
<td>'.$s1.'</td>
<td>'.$lihat1['merk'].'</td>
<td>'.$lihat1['nokantong'].'</td>
<td>'.$lihat1['gol_darah'].'('.$lihat1['RhesusDrh'].')</td>
<td>'.$lihat1['tglpengolahan'].'</td>
<td>'.$lihat1['kadaluwarsa'].'</td>
<td>'.$lihat1['berat'].'</td>
<td>'.$lihat1['swirling'].'</td>
<td>'.$lihat1['volume'].'</td>
<td>'.$lihat1['ph'].'</td>
<td>'.$lihat1['jmltrombosit'].'</td>
<td>'.$lihat1['aerob'].'</td>
<td>'.$lihat1['anaerob'].'</td>
</tr>';
}
?>
<tr>
<td colspan="7" align="right">Persen lulus</td>
<td colspan="3" align="center">100%</td>
<td align="center">&#8805 75%</td>
<td colspan="2" align="center">100%</td>
</tr>
<?
$bulantc=$_POST['bulan'];
$tahuntc=$_POST['tahun'];
$sqltc=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc AND tahunqc=$tahuntc AND produk='TC'") or die(mysql_error());
$jumbaristc=mysql_num_rows($sqltc);

$bulantc1=$_POST['bulan'];
$tahuntc1=$_POST['tahun'];
$sqltc1=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc1 AND tahunqc=$tahuntc1 AND produk='TC' AND volume > 60 ") or die(mysql_error());
$voltclebih=mysql_num_rows($sqltc1);

$bulantc2=$_POST['bulan'];
$tahuntc2=$_POST['tahun'];
$sqltc2=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc2 AND tahunqc=$tahuntc2 AND produk='TC' AND volume < 40") or die(mysql_error());
$voltckrng=mysql_num_rows($sqltc2);

$bulantc3=$_POST['bulan'];
$tahuntc3=$_POST['tahun'];
$sqltc3=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc3 AND tahunqc=$tahuntc3 AND produk='TC' AND swirling='tidak'") or die(mysql_error());
$swirling=mysql_num_rows($sqltc3);

$bulantc4=$_POST['bulan'];
$tahuntc4=$_POST['tahun'];
$sqltc4=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc4 AND tahunqc=$tahuntc4 AND produk='TC' AND jmltrombosit < 46") or die(mysql_error());
$jmltrom=mysql_num_rows($sqltc4);

$bulantc5=$_POST['bulan'];
$tahuntc5=$_POST['tahun'];
$sqltc5=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc5 AND tahunqc=$tahuntc5 AND produk='TC' AND ph < 6.4 ") or die(mysql_error());
$phtc=mysql_num_rows($sqltc5);

$bulantc7=$_POST['bulan'];
$tahuntc7=$_POST['tahun'];
$sqltc7=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc7 AND tahunqc=$tahuntc7 AND produk='TC' AND aerob='positif'") or die(mysql_error());
$tcaerob=mysql_num_rows($sqltc7);

$bulantc8=$_POST['bulan'];
$tahuntc8=$_POST['tahun'];
$sqltc8=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulantc8 AND tahunqc=$tahuntc8 AND produk='TC' AND anaerob='positif'") or die(mysql_error());
$tcanaerob=mysql_num_rows($sqltc8);

$jumkolomtc1=2;
$jumkolomtc2=3;
$persentc=100;

$kaliswirling= $jumkolomtc2 * $jumbaristc;
$pembagitc=$persentc / $kaliswirling;
$persenswirling=$pembagitc * $swirling;
$persenvolplus=$pembagitc * $voltclebih;
$persenvolmin=$pembagitc * $voltckrng;
$persenphtc=$pembagitc * $phtc;


$bagijmltrom=$persentc / $jumbaristc;
$persenjmltrom=$jmltrom * $bagijmltrom;
$hsljumtrom=$persentc - $persenjmltrom;



$hslphtc=$persentc - $persenphtc;
$hslswirling=$hslphtc - $persenswirling;
$hslvoltcmin=$hslswirling - $persenvolmin;

$kon1= (float)$hslvoltcmin;
$kon2= (float)$persenvolplus;

$hslkon=$kon1 - $kon2;
$hslkon2=floatval($hslkon);
if($hslkon < 0) $hslkon2 = 0;

//kontaminasi bakteri
$pembagitckonbak=$jumbaristc * $jumkolomtc1;
$pembagitckonbak=$persentc / $pembagitckonbak;
$tcaerob1=$pembagitckonbak * $tcaerob;
$tcanaerob1=$pembagitckonbak * $tcanaerob;
$aerobtc=$persentc - $tcaerob1;
$hslakrhkonbak=$aerobtc - $tcanaerob1;

?>
<tr>
<td colspan="7" align="right">Hasil</td>
<td colspan="3" align="center"><?=$hslkon2?></td>
<td align="center"><?=$hsljumtrom ?></td>
<td colspan="2" align="center"><? echo $hslakrhkonbak ?></td>
</tr>
</table>
<br></br>
<? 
$bulan2=$_POST['bulan'];
$tahun2=$_POST['tahun'];
$sql2=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulan2 AND tahunqc=$tahun2 AND produk='PRC'") or die(mysql_error());
?>
HASIL QC PRC
<table class="tabel" cellpadding="1" border="1">
<tr bgcolor="#FF0000">
<td align="center">No</td>
<td align="center">Jenis Kantong</td>
<td align="center">No Kantong</td>
<td align="center">Gol. Darah</td>
<td align="center">Tgl Pembuatan</td>
<td align="center">Kadaluwarsa</td>
<td align="center">Berat</td>
<td align="center">Inspeksi Hemolisis<br><0.8%</br></td>
<td align="center">Volume<br>218 &plusmn 39 mL</br></td>
<td align="center">Hematokrit<br>65 - 75 %</br></td>
<td align="center">Aerob</td>
<td align="center">Anaerob</td>
</tr>
<?
$s2=0;
while($lihat2=mysql_fetch_assoc($sql2)) {
	$s2++;
echo
'<tr bgcolor="#FF9999">
<td>'.$s2.'</td>
<td>'.$lihat2['merk'].'</td>
<td>'.$lihat2['nokantong'].'</td>
<td>'.$lihat2['gol_darah'].'('.$lihat2['RhesusDrh'].')</td>
<td>'.$lihat2['tglpengolahan'].'</td>
<td>'.$lihat2['kadaluwarsa'].'</td>
<td>'.$lihat2['berat'].'</td>
<td>'.$lihat2['inspeksihemolisis'].'</td>
<td>'.$lihat2['volume'].'</td>
<td>'.$lihat2['hematokrit'].'</td>
<td>'.$lihat2['aerob'].'</td>
<td>'.$lihat2['anaerob'].'</td>
</tr>';
}
?>
<tr>
<td colspan="7" align="right"> Persen Lulus</td>
<td colspan="2" align="center" > 100%</td>
<td align="center">100%</td>
<td colspan="2" align="center">100%</td>
</tr>
<? 
$bulanprc=$_POST['bulan'];
$tahunprc=$_POST['tahun'];
$sqlprc=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanprc AND tahunqc=$tahunprc AND produk='PRC'") or die(mysql_error());
$jumbaris=mysql_num_rows($sqlprc);

$bulanprc1=$_POST['bulan'];
$tahunprc1=$_POST['tahun'];
$sqlprc1=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanprc1 AND tahunqc=$tahunprc1 AND produk='PRC' AND inspeksihemolisis > 0.8") or die(mysql_error());
$prc1=mysql_num_rows($sqlprc1);

$bulanprc2=$_POST['bulan'];
$tahunprc2=$_POST['tahun'];
$sqlprc2=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanprc2 AND tahunqc=$tahunprc2 AND produk='PRC' AND volume > 257") or die(mysql_error());
$vollebih=mysql_num_rows($sqlprc2);

$bulanprc3=$_POST['bulan'];
$tahunprc3=$_POST['tahun'];
$sqlprc3=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanprc3 AND tahunqc=$tahunprc3 AND produk='PRC' AND volume < 179") or die(mysql_error());
$volkurang=mysql_num_rows($sqlprc3);

$bulanprc4=$_POST['bulan'];
$tahunprc4=$_POST['tahun'];
$sqlprc4=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanprc4 AND tahunqc=$tahunprc4 AND produk='PRC' AND hematokrit >= 75") or die(mysql_error());
$hematokrit=mysql_num_rows($sqlprc4);

$bulanprc5=$_POST['bulan'];
$tahunprc5=$_POST['tahun'];
$sqlprc5=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanprc5 AND tahunqc=$tahunprc5 AND produk='PRC' AND aerob='positif'") or die(mysql_error());
$aerob=mysql_num_rows($sqlprc5);

$bulanprc6=$_POST['bulan'];
$tahunprc6=$_POST['tahun'];
$sqlprc6=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanprc6 AND tahunqc=$tahunprc6 AND produk='PRC' AND anaerob='positif'") or die(mysql_error());
$anaerob=mysql_num_rows($sqlprc6);

$jumkolom=2;
$persen=100;

$kali=$jumbaris * $jumkolom;//
$bagi= $persen / $kali;//

$ih=$prc1 * $bagi;
$hslih=$persen - $ih;
$vol1=$vollebih * $bagi;
$vol2=$volkurang * $bagi;
$hsl1=$hslih - $vol1;
$hslakhr=$hsl1-$vol2;

$persenhct=$persen / $jumbaris;
$pengurang= $persenhct * $hematokrit;
$hslhct=$persen - $pengurang;

$aerob1=$aerob * $bagi;
$anaerob1=$anaerob * $bagi;
$hslaerob=$persen - $aerob1;
$konbak=$hslaerob - $anaerob1;

?>
<tr>
<td colspan="7" align="right">Hasil</td>
<td colspan="2" align="center"><? echo $hslakhr; ?></td>
<td align="center"><? echo $hslhct?></td>
<td colspan="2" align="center"><? echo $konbak?></td>
</tr>
</table>
<br></br>
<? 
$bulan3=$_POST['bulan'];
$tahun3=$_POST['tahun'];
$sql3=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulan3 AND tahunqc=$tahun3 AND produk='WB'") or die(mysql_error());

?>
HASIL QC WB
<table class="tabel" cellpadding="1" border="1">
<tr bgcolor="#FF0000">
<td align="center">No</td>
<td align="center">Jenis Kantong</td>
<td align="center">No Kantong</td>
<td align="center">Gol. Darah</td>
<td align="center">Tgl Pembuatan</td>
<td align="center">Kadaluwarsa</td>
<td align="center">Berat</td>
<td align="center">Inspeksi Hemolisis<br>< 0.8%</br></td>
<td align="center">Volume<br>350 &plusmn 10%</br></td>
<td align="center">Hemoglobin<br>> 45 g/unit</br></td>
<td align="center">Aerob</td>
<td align="center">Anaerob</td>
</tr>
<?
$s3=0;
while($lihat3=mysql_fetch_assoc($sql3)) {
	$s3++;
echo'<tr bgcolor="#FF9999">
<td>'.$s3.'</td>
<td>'.$lihat3['merk'].'</td>
<td>'.$lihat3['nokantong'].'</td>
<td>'.$lihat3['gol_darah'].'('.$lihat3['RhesusDrh'].')</td>
<td>'.$lihat3['tglpengolahan'].'</td>
<td>'.$lihat3['kadaluwarsa'].'</td>
<td>'.$lihat3['berat'].'</td>
<td>'.$lihat3['inspeksihemolisis'].'</td>
<td>'.$lihat3['volume'].'</td>
<td>'.$lihat3['hemoglobin'].'</td>
<td>'.$lihat3['aerob'].'</td>
<td>'.$lihat3['anaerob'].'</td>
</tr>';
}
?>
<tr>
<td colspan="7" align="right"> Persen Lulus</td>
<td colspan="2" align="center" > 100%</td>
<td align="center">100%</td>
<td colspan="2" align="center">100%</td>
</tr>
<?
$bulanwb=$_POST['bulan'];
$tahunwb=$_POST['tahun'];
$sqlwb=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanwb AND tahunqc=$tahunwb AND produk='WB'") or die(mysql_error());
$jumbariswb=mysql_num_rows($sqlwb);

$bulanwb1=$_POST['bulan'];
$tahunwb1=$_POST['tahun'];
$sqlwb1=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanwb1 AND tahunqc=$tahunwb1 AND produk='WB' AND inspeksihemolisis > 0.8") or die(mysql_error());
$wb1=mysql_num_rows($sqlwb1);

$bulanwb2=$_POST['bulan'];
$tahunwb2=$_POST['tahun'];
$sqlwb2=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanwb2 AND tahunqc=$tahunwb2 AND produk='WB' AND volume > 385") or die(mysql_error());
$vollebihwb=mysql_num_rows($sqlwb2);

$bulanwb3=$_POST['bulan'];
$tahunwb3=$_POST['tahun'];
$sqlwb3=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanwb3 AND tahunqc=$tahunwb3 AND produk='WB' AND volume < 315") or die(mysql_error());
$volkurangwb=mysql_num_rows($sqlwb3);

$bulanwb4=$_POST['bulan'];
$tahunwb4=$_POST['tahun'];
$sqlwb4=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanwb4 AND tahunqc=$tahunwb4 AND produk='WB' AND hemoglobin < 45") or die(mysql_error());
$hemoglobin=mysql_num_rows($sqlwb4);

$bulanwb5=$_POST['bulan'];
$tahunwb5=$_POST['tahun'];
$sqlwb5=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanwb5 AND tahunqc=$tahunwb5 AND produk='WB' AND aerob='positif'") or die(mysql_error());
$aerobwb=mysql_num_rows($sqlwb5);

$bulanwb6=$_POST['bulan'];
$tahunwb6=$_POST['tahun'];
$sqlwb6=mysql_query("SELECT * FROM qc WHERE bulanqc=$bulanwb6 AND tahunqc=$tahunwb6 AND produk='WB' AND anaerob='positif'") or die(mysql_error());
$anaerobwb=mysql_num_rows($sqlwb6);

$jumkolomwb=2;
$persenwb=100;

$kaliwb=$jumbariswb * $jumkolomwb;//
$bagiwb= $persenwb / $kaliwb;//

$ihwb=$wb1 * $bagiwb;
$hslihwb=$persenwb - $ihwb;
$volwb1=$vollebihwb * $bagiwb;
$volwb2=$volkurangwb * $bagiwb;
$hslwb1=$hslihwb - $volwb1;
$hslakhrwb=$hslwb1-$volwb2;

$persenhgb=$persenwb / $jumbariswb;
$pengurangwb= $persenhgb * $hemoglobin;
$hslhgb=$persenwb - $pengurangwb;

$aerobwb1=$aerobwb * $bagiwb;
$anaerobwb1=$anaerobwb * $bagiwb;
$hslaerobwb=$persenwb - $aerobwb1;
$konbakwb=$hslaerobwb - $anaerobwb1;


?>
<tr>
<td colspan="7" align="right">Hasil</td>
<td colspan="2" align="center"><? echo $hslakhrwb; ?></td>
<td align="center"><? echo $hslhgb?></td>
<td colspan="2" align="center"><? echo $konbakwb?></td>
</tr>
</table>
<p>
<form name="xls" method="post" action="export.php">
<input type="hidden" name="bulan" value='<?=$bulan?>'>
<input type="hidden" name="tahun" value='<?=$tahun?>'>
<input type="submit" name="submit2" id="submit" value='Ekspor ke XLS'>
</form>
</p>

</body>
</html>
