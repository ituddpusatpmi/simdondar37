<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_rekap_Pembuatan_Komponen.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];

?>
<h5 colspan='9' class="table">Rekap Pembuatan Komponen Dari Tanggal :   <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?>
<br></h5>
<?
$a=mysql_query("select tgl as tgl,produk,cara,goldarah,rhesus,tgl from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by tgl order by tgl ASC ");
	//$TRec=mysql_num_rows($a);
?>
<!--h4>Total Hasil pembuatan komponen = <?=$TRec?> Kantong Produk darah </h4-->
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
	<td rowspan='2'>No</td>
        <th rowspan=2>Tanggal Pembuatan</th>
	<th colspan=9>Jenis Komponen</th>
	<th rowspan=2>JML</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<th colspan=4>GOL DARAH</th>
	<th colspan=2>RH</th>
	<th rowspan=2>JML</th>
       
	</tr>
      <tr>
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>PRC LEUCO</th> 
	<th>TC POOL</th>
	<th>A</th>
        <th>B</th>
        <th>O</th>
	<th>AB</th>
        <th>Pos</th>
	<th>Neg</th>
	
       
	
      </tr>

<?
$komponen0=mysql_query("select tgl as tgl,produk,cara,goldarah,rhesus,tgl from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by tgl order by tgl ASC ");
//$komponen1=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

$no=1;

while ($komponen=mysql_fetch_assoc($komponen0)) {



$prc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='PRC'"));

$tc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as TC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='TC'"));

$lp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='LP'"));

$ffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='FFP'"));

$fp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='FP'"));

$ahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='AHF'"));

$we=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='WE'"));

$leu=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LEU 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='PRC Leucodepleted'"));

$tcp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TCP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and Produk='TC Pooled'"));

//goldarah
$a=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and goldarah='A'"));

$b=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as B 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and goldarah='B'"));

$o=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as O 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and goldarah='O'"));

$ab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and goldarah='AB'"));

$rhp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as POS
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and rhesus='+'"));

$rhn=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as NEG 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `tgl`='$komponen[tgl]' and rhesus='-'"));

?>
<tr class="record">
      
	<td><?=$no++?></td>
        <td class=input><?=$komponen[tgl]?></td>
	<td class=input><?=$prc[PRC]?></td>
	<td class=input><?=$tc[TC]?></td>
	<td class=input><?=$lp[LP]?></td>
	<td class=input><?=$ffp[FFP]?></td>
	<td class=input><?=$fp[FP]?></td>
	<td class=input><?=$ahf[AHF]?></td>
	<td class=input><?=$we[WE]?></td>
	<td class=input><?=$leu[LEU]?></td>
	<td class=input><?=$tcp[TCP]?></td>
	<td class=input><?=$prc[PRC]+$tc[TC]+$lp[LP]+$ffp[FFP]+$fp[FP]+$ahf[AHF]+$we[WE]+$leu[LEU]+$tcp[TCP]?></td>
	<td class=input><?=$a[A]?></td>
	<td class=input><?=$b[B]?></td>
	<td class=input><?=$o[O]?></td>
	<td class=input><?=$ab[AB]?></td>
	<td class=input><?=$rhp[POS]?></td>
	<td class=input><?=$rhn[NEG]?></td>
	<td class=input><?=$rhp[POS]+$rhn[NEG]?></td>
	</tr>

<?
}

?>


</table>

<br>
</br>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
	<td rowspan='2'>No</td>
        <th rowspan=2>Metode Pembuatan</th>
	<th colspan=9>Jenis Komponen</th>
	<th rowspan=2>JML</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<th colspan=4>GOL DARAH</th>
	<th colspan=2>RH</th>
	<th rowspan=2>JML</th>
       
	</tr>
      <tr>
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>PRC LEUCO</th> 
	<th>TC POOL</th>
	<th>A</th>
        <th>B</th>
        <th>O</th>
	<th>AB</th>
        <th>Pos</th>
	<th>Neg</th>
	
       
	
      </tr>

<?
$komponen2=mysql_query("select cara ,produk,cara,goldarah,rhesus from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by cara order by cara ASC ");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");
$no='1';

while ($komponen4=mysql_fetch_assoc($komponen2)) {


$prc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='PRC'"));

$tc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as TC1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='TC'"));

$lp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='LP'"));

$ffp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='FFP'"));

$fp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='FP'"));

$ahf1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='AHF'"));

$we1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='WE'"));

$leu1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LEU1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='PRC Leucodepleted'"));

$tcp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TCP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and Produk='TC Pooled'"));

//goldarah
$a1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and goldarah='A'"));

$b1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as B1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and goldarah='B'"));

$o1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as O1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and goldarah='O'"));

$ab1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AB1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and goldarah='AB'"));

$rhp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as POS1
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and rhesus='+'"));

$rhn1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as NEG1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen4[cara]' and rhesus='-'"));

$carabuat="RC1";
if($komponen4[cara]=='1') $carabuat="Gravitasi";
if($komponen4[cara]=='2') $carabuat="RC2";
if($komponen4[cara]=='3') $carabuat="RC3";
if($komponen4[cara]=='4') $carabuat="RC4";
if($komponen4[cara]=='5') $carabuat="RC5";

$carapisah="Manual";
if($komponen2[pisah]=='1') $carapisah="Otomatis";

?>
<tr class="record">
      
	<td><?=$no++?></td>
        <td class=input><?=$carabuat?></td>
	<td class=input><?=$prc1[PRC1]?></td>
	<td class=input><?=$tc1[TC1]?></td>
	<td class=input><?=$lp1[LP1]?></td>
	<td class=input><?=$ffp1[FFP1]?></td>
	<td class=input><?=$fp1[FP1]?></td>
	<td class=input><?=$ahf1[AHF1]?></td>
	<td class=input><?=$we1[WE1]?></td>
	<td class=input><?=$leu1[LEU1]?></td>
	<td class=input><?=$tcp1[TCP1]?></td>
	<td class=input><?=$prc1[PRC1]+$tc1[TC1]+$lp1[LP1]+$ffp1[FFP1]+$fp1[FP1]+$ahf1[AHF1]+$we1[WE1]+$leu1[LEU1]+$tcp1[TCP1]?></td>
	<td class=input><?=$a1[A1]?></td>
	<td class=input><?=$b1[B1]?></td>
	<td class=input><?=$o1[O1]?></td>
	<td class=input><?=$ab1[AB1]?></td>
	<td class=input><?=$rhp1[POS1]?></td>
	<td class=input><?=$rhn1[NEG1]?></td>
	<td class=input><?=$rhp1[POS1]+$rhn1[NEG1]?></td>

	</tr>

<?
}

?>


</table>



<br>
</br>


<table class=form border=1 cellpadding=0 cellspacing=0>
 <tr >
	<th rowspan="2">Total Produk</th>     
	   <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>PRC LEUCO</th> 
	<th>TC LEUCO</th>
	<th>A</th>
        <th>B</th>
        <th>O</th>
	<th>AB</th>
        <th>Pos</th>
	<th>Neg</th>
	<th>Total</th>
	
       
	
      </tr>
<?
$komponen5=mysql_query("select cara ,produk,cara,goldarah,rhesus from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by cara order by cara ASC ");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");


$jprc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='PRC'"));

$jtc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='TC'"));

$jlp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='LP'"));

$jffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='FFP'"));

$jfp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='FP'"));

$jahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHF 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='AHF'"));

$jwe=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWE 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='WE'"));

$jleu=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEU 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='PRC Leucodepleted'"));

$jtcp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTCP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and Produk='TC Pooled'"));

//goldarah
$ja=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JA 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and goldarah='A'"));

$jb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and goldarah='B'"));

$jo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JO 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and goldarah='O'"));

$jab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and goldarah='AB'"));

$jrhp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOS
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and rhesus='+'"));

$jrhn=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEG
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and rhesus='-'"));

$jtot=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTOT
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1'"));
/*

$komponen2=mysql_fetch_assoc($komponen1);

$prc_p=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='PRC'"));

$tc_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='TC'"));

$lp_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='LP'"));

$ffp_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='FFP'"));

$fp_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='FP'"));

$ahf_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='AHF'"));

$we_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='WE'"));
*/
$carabuat="RC1";
if($komponen4[cara]=='1') $carabuat="Gravitasi";
if($komponen4[cara]=='2') $carabuat="RC2";
if($komponen4[cara]=='3') $carabuat="RC3";
if($komponen4[cara]=='4') $carabuat="RC4";
if($komponen4[cara]=='5') $carabuat="RC5";

$carapisah="Manual";
if($komponen2[pisah]=='1') $carapisah="Otomatis";

?>
 <tr>
	<td class=input><?=$jprc[JPRC]?></td>
	<td class=input><?=$jtc[JTC]?></td>
	<td class=input><?=$jlp[JLP]?></td>
	<td class=input><?=$jffp[JFFP]?></td>
	<td class=input><?=$jfp[JFP]?></td>
	<td class=input><?=$jahf[JAHF]?></td>
	<td class=input><?=$jwe[JWE]?></td>
	<td class=input><?=$jleu[JLEU]?></td>
	<td class=input><?=$jtcp[JTCP]?></td>
	<td class=input><?=$ja[JA]?></td>
	<td class=input><?=$jb[JB]?></td>
	<td class=input><?=$jo[JO]?></td>
	<td class=input><?=$jab[JAB]?></td>
	<td class=input><?=$jrhp[JPOS]?></td>
	<td class=input><?=$jrhn[JNEG]?></td>
	<td class=input><?=$jtot[JTOT]?></td>
	


</table>

<br>
</br>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
	<td rowspan='2'>No</td>
        <th rowspan=2>Jenis Kantong</th>
	<th colspan=9>Jenis Komponen</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<th rowspan=2>JML</th>
       
	</tr>
      <tr >
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>PRC LEUCO</th> 
	<th>TC POOL</th>
	
       
	
      </tr>

<?
$komponen6=mysql_query("select jenis ,cara ,produk,cara,goldarah,rhesus from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by jenis order by jenis ASC ");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");
$no='1';

while ($komponen7=mysql_fetch_assoc($komponen6)) {


$jprc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRC1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='PRC'"));

$jtc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTC1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='TC'"));

$jlp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='LP'"));

$jffp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='FFP'"));

$jfp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='FP'"));

$jahf1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHF1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='AHF'"));

$jwe1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWE1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='WE'"));

$jleu1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEU1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='PRC Leucodepleted'"));

$jtcp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTCP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='TC Pooled'"));

$jtotj=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTOTJ 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and noKantong like '%A'"));
/*

//goldarah
$ja1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JA1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and goldarah='A'"));

$jb1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JB1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and goldarah='B'"));

$jo1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JO1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and goldarah='O'"));

$jab1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAB1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and goldarah='AB'"));

$jrhp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOS1
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and rhesus='+'"));

$jrhn1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEG1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' and rhesus='-'"));


/*

$komponen2=mysql_fetch_assoc($komponen1);

$prc_p=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='PRC'"));

$tc_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='TC'"));

$lp_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='LP'"));

$ffp_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='FFP'"));

$fp_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='FP'"));

$ahf_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='AHF'"));

$we_p=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `pisah`='$komponen2[pisah]' and Produk='WE'"));
*/
$jenis="Double";
if($komponen7[jenis]=='3') $jenis="Triple";
if($komponen7[jenis]=='4') $jenis="Quadruple";
if($komponen7[jenis]=='6') $jenis="Pediatrik";


$carapisah="Manual";
if($komponen2[pisah]=='1') $carapisah="Otomatis";

?>
<tr class="record">
      
	<td><?=$no++?></td>
        <td class=input><?=$jenis?></td>
	<td class=input><?=$jprc1[JPRC1]?></td>
	<td class=input><?=$jtc1[JTC1]?></td>
	<td class=input><?=$jlp1[JLP1]?></td>
	<td class=input><?=$jffp1[JFFP1]?></td>
	<td class=input><?=$jfp1[JFP1]?></td>
	<td class=input><?=$jahf1[JAHF1]?></td>
	<td class=input><?=$jwe1[JWE1]?></td>
	<td class=input><?=$jleu1[JLEU1]?></td>
	<td class=input><?=$jtcp1[JTCP1]?></td>
	<td class=input><?=$jtotj[JTOTJ]?></td>
	<!--td class=input><?=$ja1[JA1]?></td>
	<td class=input><?=$jb1[JB1]?></td>
	<td class=input><?=$jo1[JO1]?></td>
	<td class=input><?=$jab1[JAB1]?></td>
	<td class=input><?=$jrhp1[JPOS1]?></td>
	<td class=input><?=$jrhn1[JNEG1]?></td>
	
	<!--td class=input><?=$lp_p[LP]?></td>
	<td class=input><?=$ffp_p[FFP]?></td>
	<td class=input><?=$fp_p[FP]?></td>
	<td class=input><?=$ahf_p[AHF]?></td>
	<td class=input><?=$we_p[WE]?></td>
	<td class=input><?=$prc_p[PRC]+$tc_p[TC]+$lp_p[LP]+$ffp_p[FFP]+$fp_p[FP]+$ahf_p[AHF]+$we_p[WE]?></td-->
	</tr>

<?
}

?>


</table>

<?
mysql_close();
?>
