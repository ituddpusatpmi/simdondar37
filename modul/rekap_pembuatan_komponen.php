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
<?php
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
$shift=$_POST[gol_shift];
//$trs=$_POST[transaksi];
if ($_POST['transaksi']!='') $trs=$_POST['transaksi'];
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
<h1 class="table">Rekap pembuatan Komponen Dari Tangal :   <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?> shift <?=$shift?><br>
No. Transaksi <?=$trs?>
</h1>
<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>
No. Transaksi :<select name='transaksi'>
	<option value="" selected="selected">SEMUA</option>
	<option value="1" >1</option>
	<option value="2" >2</option>
	<option value="3" >3</option>
	<option value="4" >4</option>
	<option value="5" >5</option>
	<option value="6" >6</option>
	<option value="7" >7</option>
	<option value="8" >8</option>
	<option value="9" >9</option>
	<option value="10" >10</option>
	<option value="11" >11</option>
	<option value="12" >12</option>
	<option value="13" >13</option>
	<option value="14" >14</option>
	<option value="15" >15</option>
	<option value="16" >16</option>
	<option value="17" >17</option>
	<option value="18" >18</option>
	<option value="19" >19</option>
	<option value="20" >20</option>
	<option value="21" >21</option>
	<option value="22" >22</option>
	<option value="23" >23</option>
	<option value="24" >24</option>
	<option value="25" >25</option>
</select>
SHIFT<select name="gol_shift">
	<option value="">-SEMUA-</option>
	<option value="1">SHIFT I</option>
	<option value="2">SHIFT II</option>
	<option value="3">SHIFT III</option>
	<option value="4">SHIFT IV</option>
	</select>
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
        <th rowspan=2>Tanggal Pembuatan</th>
	<th colspan=10>Jenis Komponen</th>
	<th rowspan=2>JML</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<th colspan=4>GOL DARAH</th>
	<th colspan=2>RH</th>
	<th rowspan=2>JML</th>
       
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>BC</th>
	<th>PRC LEUCO</th>
	<th>TC POOL</th> 
	<th>A</th>
        <th>B</th>
        <th>O</th>
	<th>AB</th>
        <th>Pos</th>
	<th>Neg</th>
	
       
	
      </tr>

<?php
$komponen0=mysql_query("select DATE(tgl) as tgl,produk,cara,goldarah,rhesus from dpengolahan where Produk!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and trans like '%$trs%' group by DATE(tgl) order by DATE(tgl) ASC ");
//$komponen1=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

$no=1;

while ($komponen=mysql_fetch_assoc($komponen0)) {

$prc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC 
from dpengolahan where DATE(tgl)>='$today' and DATE(tgl)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]' and trans like '%$trs%' and Produk='PRC'"));

$tc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as TC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and Produk='TC'"));

$lp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%'  and Produk='LP'"));

$ffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and Produk='FFP'"));

$fp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%'  and Produk='FP'"));

$ahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%'  and Produk='AHF'"));

$we=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and Produk='WE'"));

$bc=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as BC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and Produk='BC'"));

$leu=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LEU 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and Produk='PRC Leucodepleted'"));

$tcpool=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TCP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and Produk='TC Pooled'"));

//goldarah
$a=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and goldarah='A'"));

$b=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as B 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and goldarah='B'"));

$o=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as O 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and goldarah='O'"));

$ab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and goldarah='AB'"));

$rhp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as POS
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and rhesus='+'"));

$rhn=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as NEG 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and DATE(`tgl`)='$komponen[tgl]'  and trans like '%$trs%' and rhesus='-'"));

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
	<td class=input><?=$bc[BC]?></td>
	<td class=input><?=$leu[LEU]?></td>
	<td class=input><?=$tcpool[TCP]?></td>
	<td class=input><?=$wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$ffp[FFP]+$fp[FP]+$ahf[AHF]+$we[WE]+$bc[BC]+$leu[LEU]+$tcpool[TCP]?></td>
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
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan='2'>No</td>
        <th rowspan=2>Alat Pemisahan</th>
	<th colspan=10>Jenis Komponen</th>
	<th rowspan=2>JML</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<!--th colspan=4>GOL DARAH</th>
	<th colspan=2>RH</th>
	<th rowspan=2>JML</th-->
       
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>BC</th>
	<th>PRC LEUCO</th> 
	<th>TC POOL</th>
	<!--th>A</th>
        <th>B</th>
        <th>O</th>
	<th>AB</th>
        <th>Pos</th>
	<th>Neg</th!-->
	
       
	
      </tr>

<?
$komponen2=mysql_query("select hpengolahan.Pisah,komponen,pemisahan,gd,rh
			FROM
			hpengolahan
			INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
			where komponen!='' and hpengolahan.Pisah!='' 
			and CAST(hpengolahan.tglpembuatan as date)>='$today' and 
			CAST(hpengolahan.tglpembuatan as date)<='$today1' AND 
			dpengolahan.shift like '%$shift%'  and 
			dpengolahan.trans like '%$trs%'
			group by Pisah");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");
$no='1';

while ($komponen4=mysql_fetch_assoc($komponen2)) {


$prc1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as PRC1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='PRC'"));

$tc1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as TC1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='TC'"));

$lp1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as LP1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='LP'"));

$ffp1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as FFP1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='FFP'"));

$fp1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as FP1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='FP'"));

$ahf1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as AHF1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='AHF'"));

$we1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as WE1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='WE'"));

$bc1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as BC1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='BC'"));

$leu1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as LEU1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='PRC Leucodepleted'"));

$tcp1=mysql_fetch_assoc(mysql_query("select count(distinct hpengolahan.nokantong) as TCP1
				FROM
				hpengolahan
				INNER JOIN dpengolahan ON hpengolahan.nokantong = dpengolahan.noKantong
				where CAST(tglpembuatan as date)>='$today' 
				and CAST(tglpembuatan as date)<='$today1' 
				AND dpengolahan.shift like '%$shift%' 
				and hpengolahan.Pisah='$komponen4[Pisah]'  
				and dpengolahan.trans like '%$trs%' 
				and komponen='TC Pooled'"));

$carabuat="RC1";
if ($komponen4[RC]=='RC1') $carabuat='Centrifuge 1';
if ($komponen4[RC]=='RC2') $carabuat='Centrifuge 2';
if ($komponen4[RC]=='RC3') $carabuat='Centrifuge 3';
if ($komponen4[RC]=='RC4') $carabuat='Centrifuge 4';
if ($komponen4[RC]=='RC5') $carabuat='Centrifuge 5';
if ($komponen4[RC]=='SD') $carabuat='Sedimentasi';

$carapisah="Manual";
if($komponen2[pisah]=='1') $carapisah="Otomatis";

?>
<tr class="record">
      
	<td><?=$no++?></td>
        <td class=input><?=$komponen4[Pisah]?></td>
	<td class=input><?=$prc1[PRC1]?></td>
	<td class=input><?=$tc1[TC1]?></td>
	<td class=input><?=$lp1[LP1]?></td>
	<td class=input><?=$ffp1[FFP1]?></td>
	<td class=input><?=$fp1[FP1]?></td>
	<td class=input><?=$ahf1[AHF1]?></td>
	<td class=input><?=$we1[WE1]?></td>
	<td class=input><?=$bc1[BC1]?></td>
	<td class=input><?=$leu1[LEU1]?></td>
	<td class=input><?=$tcp1[TCP1]?></td>
	<td class=input><?=$wb1[WB1]+$prc1[PRC1]+$tc1[TC1]+$lp1[LP1]+$ffp1[FFP1]+$fp1[FP1]+$ahf1[AHF1]+$we1[WE1]+$bc1[BC1]+$leu1[LEU1]+$tcp1[TCP1]?></td>
	

	</tr>

<?
}

?>


</table>



<br>
</br>


<table>
 <tr tr style="background-color:#008000; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<th>Gol. Darah</th>    
	   <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
	<th>PRC Leuco</th> 
	<th>TC Pool</th>
        <th>Pos</th>
	<th>Neg</th>

	
       
	
      </tr>

<?
$komponen5=mysql_query("select cara ,produk,cara,goldarah,rhesus from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' group by cara order by cara ASC ");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");


//GOLONGAN A THEO 010318

$jprc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='PRC'  and trans like '%$trs%' and goldarah='A'"));

$jtc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='TC'  and trans like '%$trs%' and goldarah='A'"));

$jlp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='LP'  and trans like '%$trs%' and goldarah='A'"));

$jffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='FFP'  and trans like '%$trs%' and goldarah='A'"));

$jfp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='FP'  and trans like '%$trs%' and goldarah='A'"));

$jahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHF 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='AHF'  and trans like '%$trs%' and goldarah='A'"));

$jwe=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWE 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='WE'  and trans like '%$trs%' and goldarah='A'"));

$jleu=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEU 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='PRC Leucodepleted'  and trans like '%$trs%' and goldarah='A'"));

$jtcp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTCP
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='TC Pooled'  and trans like '%$trs%' and goldarah='A'"));

//goldarah

$jrhp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOS
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and goldarah='A' and  trans like '%$trs%' and  rhesus='+'"));

$jrhn=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEG
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and goldarah='A' and  trans like '%$trs%' and rhesus='-'"));

$carabuat="RC1";
if($komponen4[cara]=='1') $carabuat="Gravitasi";
if($komponen4[cara]=='2') $carabuat="RC2";
if($komponen4[cara]=='3') $carabuat="RC3";
if($komponen4[cara]=='4') $carabuat="RC4";
if($komponen4[cara]=='5') $carabuat="RC5";

$carapisah="Manual";
if($komponen2[pisah]=='1') $carapisah="Otomatis";

//GOLONGAN B THEO 010318

$jprcb=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRCB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='PRC'  and trans like '%$trs%' and goldarah='B'"));

$jtcb=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTCB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='TC'  and trans like '%$trs%' and goldarah='B'"));

$jlpb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLPB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='LP'  and trans like '%$trs%' and goldarah='B'"));

$jffpb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='FFP'  and trans like '%$trs%' and goldarah='B'"));

$jfpb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='FP'  and trans like '%$trs%' and goldarah='B'"));

$jahfb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHFB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='AHF'  and trans like '%$trs%' and goldarah='B'"));

$jweb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWEB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='WE'  and trans like '%$trs%' and goldarah='B'"));

$jleub=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEUB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='PRC Leucodepleted' and goldarah='B'"));

$jtcpb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTCPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='TC Pooled' and goldarah='B'"));

//goldarah

$jrhpb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOSB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and goldarah='B' and rhesus='+'"));

$jrhnb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEGB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and goldarah='B' and rhesus='-'"));

//GOLONGAN O THEO 010318

$jprco=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRCB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='PRC' and goldarah='O'"));

$jtco=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTCB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='TC' and goldarah='O'"));

$jlpo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLPB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='LP' and goldarah='O'"));

$jffpo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='FFP' and goldarah='O'"));

$jfpo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='FP' and goldarah='O'"));

$jahfo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHFB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='AHF' and goldarah='O'"));

$jweo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWEB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='WE' and goldarah='O'"));

$jleuo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEUB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%'  and Produk='PRC Leucodepleted' and goldarah='O'"));

$jtcpo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTCPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%'  and Produk='TC Pooled' and goldarah='O'"));

//goldarah

$jrhpo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOSB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and goldarah='O'  and trans like '%$trs%' and rhesus='+'"));

$jrhno=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEGB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and goldarah='O'  and trans like '%$trs%' and rhesus='-'"));

//GOLONGAN AB THEO 010318

$jprcab=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRCB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='PRC'  and trans like '%$trs%' and goldarah='AB'"));

$jtcab=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTCB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='TC'  and trans like '%$trs%' and goldarah='AB'"));

$jlpab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLPB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='LP'  and trans like '%$trs%' and goldarah='AB'"));

$jffpab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='FFP'  and trans like '%$trs%' and goldarah='AB'"));

$jfpab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='FP'  and trans like '%$trs%' and goldarah='AB'"));

$jahfab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHFB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='AHF'  and trans like '%$trs%' and goldarah='AB'"));

$jweab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWEB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' and Produk='WE'  and trans like '%$trs%' and goldarah='AB'"));

$jleuab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEUB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='PRC Leucodepleted' and goldarah='AB'"));

$jtcpab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTCPB 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='TC Pooled' and goldarah='AB'"));

//goldarah

$jrhpab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOSB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and goldarah='AB' and rhesus='+'"));

$jrhnab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEGB
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' and goldarah='AB' and rhesus='-'"));

?>
 <tr class="record" tr style="background-color:#98FB98; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
 	<td>A</td>       
	<td class=input><?=$jprc[JPRC]?></td>
	<td class=input><?=$jtc[JTC]?></td>
	<td class=input><?=$jlp[JLP]?></td>
	<td class=input><?=$jffp[JFFP]?></td>
	<td class=input><?=$jfp[JFP]?></td>
	<td class=input><?=$jahf[JAHF]?></td>
	<td class=input><?=$jwe[JWE]?></td>
	<td class=input><?=$jleu[JLEU]?></td>
	<td class=input><?=$jtcp[JTCP]?></td>
	<td class=input><?=$jrhp[JPOS]?></td>
	<td class=input><?=$jrhn[JNEG]?></td>
 <tr class="record" tr style="background-color:#98FB98; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
 	<td>B</td>       
	<td class=input><?=$jprcb[JPRCB]?></td>
	<td class=input><?=$jtcb[JTCB]?></td>
	<td class=input><?=$jlpb[JLPB]?></td>
	<td class=input><?=$jffpb[JFFPB]?></td>
	<td class=input><?=$jfpb[JFPB]?></td>
	<td class=input><?=$jahfb[JAHFB]?></td>
	<td class=input><?=$jweb[JWEB]?></td>
	<td class=input><?=$jleub[JLEUB]?></td>
	<td class=input><?=$jtcpb[JTCPB]?></td>
	<td class=input><?=$jrhpb[JPOSB]?></td>
	<td class=input><?=$jrhnb[JNEGB]?></td>
 <tr class="record" tr style="background-color:#98FB98; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
 	<td>O</td>       
	<td class=input><?=$jprco[JPRCB]?></td>
	<td class=input><?=$jtco[JTCB]?></td>
	<td class=input><?=$jlpo[JLPB]?></td>
	<td class=input><?=$jffpo[JFFPB]?></td>
	<td class=input><?=$jfpo[JFPB]?></td>
	<td class=input><?=$jahfo[JAHFB]?></td>
	<td class=input><?=$jweo[JWEB]?></td>
	<td class=input><?=$jleuo[JLEUB]?></td>
	<td class=input><?=$jtcpo[JTCPB]?></td>
	<td class=input><?=$jrhpo[JPOSB]?></td>
	<td class=input><?=$jrhno[JNEGB]?></td>	
 <tr class="record" tr style="background-color:#98FB98; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
 	<td>AB</td>       
	<td class=input><?=$jprcab[JPRCB]?></td>
	<td class=input><?=$jtcab[JTCB]?></td>
	<td class=input><?=$jlpab[JLPB]?></td>
	<td class=input><?=$jffpab[JFFPB]?></td>
	<td class=input><?=$jfpab[JFPB]?></td>
	<td class=input><?=$jahfab[JAHFB]?></td>
	<td class=input><?=$jweab[JWEB]?></td>
	<td class=input><?=$jleuab[JLEUB]?></td>
	<td class=input><?=$jtcpab[JTCPB]?></td>
	<td class=input><?=$jrhpab[JPOSB]?></td>
	<td class=input><?=$jrhnab[JNEGB]?></td>
 <tr class="record" tr style="background-color:#32CD32; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
 	<td>JUMLAH</td>       
	<td class=input><?=$jprcab[JPRCB]+$jprcb[JPRCB]+$jprco[JPRCB]+$jprc[JPRC]?></td>
	<td class=input><?=$jtcab[JTCB]+$jtcb[JTCB]+$jtco[JTCB]+$jtc[JTC]?></td>
	<td class=input><?=$jlpab[JLPB]+$jlpb[JLPB]+$jlpo[JLPB]+$jlp[JLP]?></td>
	<td class=input><?=$jffpab[JFFPB]+$jffpb[JFFPB]+$jffpo[JFFPB]+$jffp[JFFP]?></td>
	<td class=input><?=$jfpab[JFPB]+$jfpb[JFPB]+$jfpo[JFPB]+$jfp[JFP]?></td>
	<td class=input><?=$jahfab[JAHFB]+$jahfb[JAHFB]+$jahfo[JAHFB]+$jahf[JAHF]?></td>
	<td class=input><?=$jweab[JWEB]+$jweb[JWEB]+$jweo[JWEB]+$jwe[JWE]?></td>
	<td class=input><?=$jleuab[JLEUB]+$jleub[JLEUB]+$jleuo[JLEUB]+$jleu[JLEU]?></td>
	<td class=input><?=$jtcpab[JTCPB]+$jtcpb[JTCPB]+$jtcpo[JTCPB]+$jtcp[JTCP]?></td>
	<td class=input><?=$jrhpab[JPOSB]+$jrhpb[JPOSB]+$jrhpo[JPOSB]+$jrhp[JPOS]?></td>
	<td class=input><?=$jrhnab[JNEGB]+$jrhnb[JNEGB]+$jrhno[JNEGB]+$jrhn[JNEG]?></td>	

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
$komponen6=mysql_query("select jenis ,cara ,produk,cara,goldarah,rhesus from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%'  and trans like '%$trs%' group by jenis order by jenis ASC ");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");
$no='1';

while ($komponen7=mysql_fetch_assoc($komponen6)) {


$jprc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRC1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='PRC'"));

$jtc1=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTC1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='TC'"));

$jlp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='LP'"));

$jffp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFFP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='FFP'"));

$jfp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JFP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='FP'"));

$jahf1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAHF1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='AHF'"));

$jwe1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWE1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='WE'"));

$jleu1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JLEU1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='PRC Leucodepleted'"));

$jtcp1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTCP1 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%'  and trans like '%$trs%' and Produk='TC Pooled'"));

$jtotj=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JTOTJ 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `jenis`='$komponen7[jenis]' AND shift like '%$shift%' and trans like '%$trs%' "));
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

<br>
<form name=xls method=post action=modul/rekap_pembuatan_komponen_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=trs1 value='<?=$trs?>'>
<input type=hidden name=shift value='<?=$shift?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Komponen (.XLS)'>
</form>

<?
mysql_close();
?>
