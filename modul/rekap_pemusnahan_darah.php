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
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);

?>



<STYLE>
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
</style>
<h1 class="table">Rekap Pemusnahan Darah Dari Tangal :   <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?>
</h1>
<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>
<input type=submit name=submit value=Submit>

</form></div>
<!--?
$a=mysql_query("select noKantong,Status,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar,tglpengolahan from stokkantong where  CAST(tglpengolahan as date)>='$today' and CAST(tglpengolahan as date)<='$today1' and Status != 0 and produk !='WB' order by tglpengolahan ASC");
	$TRec=mysql_num_rows($a);
?>
<h4>Total Hasil pembuatan komponen = <?=$TRec?> Kantong Produk darah </h4-->

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan='2'>No</td>
        <th rowspan=2>Alasan Pemusnahan</th>
	<th colspan=9>Jenis Komponen</th>
	<th rowspan=2>JML</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<th colspan=4>GOL DARAH</th>
	<th colspan=2>RH</th>
	<th rowspan=2>JML</th>
       
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<th>WB</th>
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>LEUCO</th> 
	<th>A</th>
        <th>B</th>
        <th>O</th>
	<th>AB</th>
        <th>Pos</th>
	<th>Neg</th>
	
       
	
      </tr>
	
	 
<?
$komponen0=mysql_query("select tgl_buang as tgl,noKantong,user,tgl_buang,volume,Produk,tgl_Aftap,kadaluwarsa,gol_darah, RhesusDrh,kodePendonor,alasan_buang from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' group by alasan_buang order by tgl_buang ASC ");
//$komponen1=mysql_query("select tgl as tgl,produk,pisah from ar_stokkantong where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

$no=1;

while ($komponen=mysql_fetch_assoc($komponen0)) {

$wb=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as WB 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='WB'"));

$prc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='PRC'"));

$tc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as TC 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='TC'"));

$lp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='LP'"));

$ffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='FFP'"));

$fp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='FP'"));

$ahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='AHF'"));

$we=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='WE'"));

$leu=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LEU 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and Produk='Leucodepleted'"));

//goldarah
$a=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and gol_darah='A'"));

$b=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as B 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and gol_darah='B'"));

$o=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as O 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and gol_darah='O'"));

$ab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AB 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and gol_darah='AB'"));

$rhp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as POS
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and RhesusDrh='+'"));

$rhn=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as NEG 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `alasan_buang`='$komponen[alasan_buang]' and RhesusDrh='-'"));


//jumlah
$jwb=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JWB 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='WB'"));

$jprc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRC 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='PRC'"));

$jtc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTC 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='TC'"));

$jlp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLP 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='LP'"));

$jffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFP 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='FFP'"));

$jfp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFP 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='FP'"));

$jahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHF 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='AHF'"));

$jwe=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWE 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='WE'"));

$jleu=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEU 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and Produk='Leucodepleted'"));

//gol_darah
$ja=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JA 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and gol_darah='A'"));

$jb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JB 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and gol_darah='B'"));

$jo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JO 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and gol_darah='O'"));

$jab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAB
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and gol_darah='AB'"));

$jrhp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOS
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and RhesusDrh='+'"));

$jrhn=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEG
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and RhesusDrh='-'"));

$jtot=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTOT
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1'"));



?>
<tr class="record">
      
	<td><?=$no++?></td>
<?
if ($komponen[alasan_buang]=='2') $alasan='Kadaluwarsa';
if ($komponen[alasan_buang]=='0') $alasan='Gagal Aftap';
if ($komponen[alasan_buang]=='3') $alasan='Plebotomi';
if ($komponen[alasan_buang]=='4') $alasan='Reaktif Dibuang';
if ($komponen[alasan_buang]=='5') $alasan='Lifemik';
if ($komponen[alasan_buang]=='6') $alasan='Greyzone';
if ($komponen[alasan_buang]=='7') $alasan='DCT Positif';
if ($komponen[alasan_buang]=='8') $alasan='Kantong Bocor';
if ($komponen[alasan_buang]=='1') $alasan='Lisis';
if ($komponen[alasan_buang]=='9') $alasan='Satelit Rusak';
if ($komponen[alasan_buang]=='10') $alasan='Bekas Pembuatan WE';
if ($komponen[alasan_buang]=='11') $alasan='Reaktif Rujuk keUDDP';
if ($komponen[alasan_buang]=='12') $alasan='Hematokrit Tinggi';
if ($komponen[alasan_buang]=='13') $alasan='Limbah Sisa PRC';
if ($komponen[alasan_buang]=='14') $alasan='Leukosit Tinggi';
if ($komponen[alasan_buang]=='15') $alasan='Produk Rusak';
if ($komponen[alasan_buang]=='16') $alasan='Produk Sampel QC';

?>
        <td class=input><?=$alasan?></td>
	<td class=input><?=$wb[WB]?></td>
	<td class=input><?=$prc[PRC]?></td>
	<td class=input><?=$tc[TC]?></td>
	<td class=input><?=$lp[LP]?></td>
	<td class=input><?=$ffp[FFP]?></td>
	<td class=input><?=$fp[FP]?></td>
	<td class=input><?=$ahf[AHF]?></td>
	<td class=input><?=$we[WE]?></td>
	<td class=input><?=$leu[LEU]?></td>
	<td td style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" class=input ><?=$wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$ffp[FFP]+$fp[FP]+$ahf[AHF]+$we[WE]+$leu[LEU]?></td>
	<td class=input><?=$a[A]?></td>
	<td class=input><?=$b[B]?></td>
	<td class=input><?=$o[O]?></td>
	<td class=input><?=$ab[AB]?></td>
	<td class=input><?=$rhp[POS]?></td>
	<td class=input><?=$rhn[NEG]?></td>
	<td td style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" class=input><?=$rhp[POS]+$rhn[NEG]?></td>
	</tr>



<?
}

?>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	
	<th colspan=2 class=input>Jumlah</th>
	<th class=input><?=$jwb[JWB]?></th>
	<th class=input><?=$jprc[JPRC]?></th>
	<th class=input><?=$jtc[JTC]?></th>
	<th class=input><?=$jlp[JLP]?></th>
	<th class=input><?=$jffp[JFFP]?></th>
	<th class=input><?=$jfp[JFP]?></th>
	<th class=input><?=$jahf[JAHF]?></th>
	<th class=input><?=$jwe[JWE]?></th>
	<th class=input><?=$jleu[JLEU]?></th>
	<th class=input><?=$jwb[JWB]+$jprc[JPRC]+$jtc[JTC]+$jlp[JLP]+$jffp[JFFP]+$jfp[JFP]+$jahf[JAHF]+$jwe[JWE]+$jleu[JLEU]?> </th>
	<th class=input><?=$ja[JA]?></th>
	<th class=input><?=$jb[JB]?></th>
	<th class=input><?=$jo[JO]?></th>
	<th class=input><?=$jab[JAB]?></th>
	<th class=input><?=$jrhp[JPOS]?></th>
	<th class=input><?=$jrhn[JNEG]?></th>
	<th class=input><?=$jtot[JTOT]?></th>
	</tr>

</table>
<table>

</table>
<br>
</br>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan='2'>No</td>
        <th rowspan=2>Jenis Kantong</th>
	<th colspan=9>Jenis Komponen</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<th rowspan=2>JML</th>
       
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<th>WB</th>
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>LEUCO</th> 
	
       
	
      </tr>

<?
$komponen6=mysql_query("select tgl_buang as tgl,noKantong,jenis,user,tgl_buang,volume,Produk,tgl_Aftap,kadaluwarsa,gol_darah, RhesusDrh,kodePendonor,alasan_buang from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' group by jenis order by jenis ASC ");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from ar_stokkantong where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");
$no='1';

while ($komponen7=mysql_fetch_assoc($komponen6)) {

$jwb1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JWB1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='WB'"));

$jprc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRC1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='PRC'"));

$jtc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTC1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='TC'"));

$jlp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLP1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='LP'"));

$jffp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFP1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='FFP'"));

$jfp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFP1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='FP'"));

$jahf1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHF1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='AHF'"));

$jwe1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWE1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='WE'"));

$jleu1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEU1 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' and Produk='Leucodepleted'"));
$jtotj=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTOTJ 
from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and `jenis`='$komponen7[jenis]' "));

$jenis="Single";
if($komponen7[jenis]=='2') $jenis="Double";
if($komponen7[jenis]=='3') $jenis="Triple";
if($komponen7[jenis]=='4') $jenis="Quadruple";
if($komponen7[jenis]=='6') $jenis="Pediatrik";


$carapisah="Manual";
if($komponen2[pisah]=='1') $carapisah="Otomatis";

?>
<tr class="record">
      
	<td><?=$no++?></td>
        <td class=input><?=$jenis?></td>
	<td class=input><?=$jwb1[JWB1]?></td>
	<td class=input><?=$jprc1[JPRC1]?></td>
	<td class=input><?=$jtc1[JTC1]?></td>
	<td class=input><?=$jlp1[JLP1]?></td>
	<td class=input><?=$jffp1[JFFP1]?></td>
	<td class=input><?=$jfp1[JFP1]?></td>
	<td class=input><?=$jahf1[JAHF1]?></td>
	<td class=input><?=$jwe1[JWE1]?></td>
	<td class=input><?=$jleu1[JLEU1]?></td>
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

<br>
<form name=xls method=post action=modul/rekap_pemusnahan_darah_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Pemusnahan Darah (.XLS)'>
</form>

<?
mysql_close();
?>
