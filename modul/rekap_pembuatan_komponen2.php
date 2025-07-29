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
<h1 class="table">Rekap pembuatan Komponen Dari Tangal :   <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?>
</h1>
<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>
<input type=submit name=submit value=Submit>

</form></div>
<?
$a=mysql_query("select noKantong,Status,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar,tglpengolahan from stokkantong where  CAST(tglpengolahan as date)>='$today' and CAST(tglpengolahan as date)<='$today1' and Status != 0 and produk !='WB' order by tglpengolahan ASC");
	$TRec=mysql_num_rows($a);
?>
<h4>Total Hasil pembuatan komponen = <?=$TRec?> Kantong Produk darah </h4>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2'>No</td>
	<td rowspan='2'>Tanggal</td>
	<td rowspan='2'>No Kantong</td>
	<td rowspan='2'>Kantong</td>
        <td rowspan='2'>Gol Darah</td>
        <td rowspan='2'>Jenis</td>
        <td rowspan='2'>Tgl Aftap</td>
	<td rowspan='2'>Tgl Kadaluwarsa</td>
        <td rowspan='2'>Tgl Periksa</td>
	<td rowspan='2'>Status</td>
	<td rowspan='2'>petugas</td>
	<td colspan='2'>Metode</td>
	</tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<td>Pembuatan</td>
	<td>Pemisahan</td>
	</tr>
</tr>
<?
$no=1;


while($a_dtransaksipermintaan=mysql_fetch_assoc($a)){
	
?>

	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
 
<?
$pengolahan=$a_dtransaksipermintaan[tglpengolahan];
$tglkel=date("d",strtotime($pengolahan));
$blnkel=date("n",strtotime($pengolahan));
$thnkel=date("Y",strtotime($pengolahan));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam = date("H:i:s",strtotime($pengolahan));
?>
<td class=input><?=$tglkel?>-<?=$bln22?>-<?=$thnkel?> <?=$jam?></td>


<!--?
$blnkel=substr($a_dtransaksipermintaan[tglpengolahan],5,2);
$tglkel=substr($a_dtransaksipermintaan[tglpengolahan],8,2);
$thnkel=substr($a_dtransaksipermintaan[tglpengolahan],0,4);
?>
      	<td class=input><?=$tglkel?>-<?=$blnkel?>-<?=$thnkel?></td-->
	<td class=input><?=$a_dtransaksipermintaan[noKantong]?></td>
<?
$jenis=$a_dtransaksipermintaan[jenis];
switch ($jenis)
{

case 2:
	$jenis='Double';
	break;
case 3:
	$jenis='Triple';
	break;
case 4:
	$jenis='Quadruple';
	break;
case 6:
	$jenis='Pediatrik';
	break;
	
}
?>
	<td class=input><?=$jenis?></td>
	<td class=input><?=$a_dtransaksipermintaan[gol_darah]?> (<?=$a_dtransaksipermintaan[RhesusDrh]?>)</td>
	<td class=input><?=$a_dtransaksipermintaan[produk]?></td>
       	<td class=input><?=$a_dtransaksipermintaan[tgl_Aftap]?></td>
      	<td class=input><?=$a_dtransaksipermintaan[kadaluwarsa]?></td>
      	<td class=input><?=$a_dtransaksipermintaan[tglperiksa]?></td>
<?

$status=$a_dtransaksipermintaan[Status];
switch ($status)
{
case 0:
	$status='Kosong';
	break;
case 1:
	$status='Darah Karantina';
	break;
case 2:
	$status='Sehat';
	break;
case 3:
	$status='Keluar';
	break;
case 4:
	$status='Reaktif';
	break;
case 5:
	$status='Darah Rusak';
	break;
case 6:
	$status='Darah Dimusnahkan';
	break;
	
}

?>
	<td class=input><?=$status?></td>
<?$petugas=mysql_fetch_assoc(mysql_query("select petugas,cara,pisah from dpengolahan where noKantong='$a_dtransaksipermintaan[noKantong]'"));

$cara='RC';
if ($petugas[cara]=='1') $cara='Gravitasi';

$pisah='Manual';
if ($petugas[pisah]=='1') $pisah='Otomatis';
?>
	<td class=input><?=$petugas[petugas]?></td>
	<td class=input><?=$cara?></td>
	<td class=input><?=$pisah?></td>

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
        <th rowspan=2>Metode Pembuatan</th>
	<th colspan=7>Jenis Komponen</th>
	<th rowspan=2>Jumlah</th>
	<th rowspan=2>Metode pemisahan</th>
	<th colspan=7>Jenis Komponen</th>
	<th rowspan=2>Jumlah</th>
       
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
	<th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
         
	
      </tr>

<?
$komponen0=mysql_query("select noKantong as tgl,produk,cara from dpengolahan where Produk!='' and cara!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by cara order by cara ASC");
$komponen1=mysql_query("select noKantong as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");

while ($komponen=mysql_fetch_assoc($komponen0)) {


$prc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen[cara]' and Produk='PRC'"));

$tc=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TC 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen[cara]' and Produk='TC'"));

$lp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen[cara]' and Produk='LP'"));

$ffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen[cara]' and Produk='FFP'"));

$fp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen[cara]' and Produk='FP'"));

$ahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen[cara]' and Produk='AHF'"));

$we=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from dpengolahan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and `cara`='$komponen[cara]' and Produk='WE'"));
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

$carabuat="RC";
if($komponen[cara]=='1') $carabuat="Gravitasi";

$carapisah="Manual";
if($komponen2[pisah]=='1') $carapisah="Otomatis";

?>
<tr class="record">
      

      <td class=input><?=$carabuat?></td>
	<td class=input><?=$prc[PRC]?></td>
	<td class=input><?=$tc[TC]?></td>
	<td class=input><?=$lp[LP]?></td>
	<td class=input><?=$ffp[FFP]?></td>
	<td class=input><?=$fp[FP]?></td>
	<td class=input><?=$ahf[AHF]?></td>
	<td class=input><?=$we[WE]?></td>
	<td class=input><?=$prc[PRC]+$tc[TC]+$lp[LP]+$ffp[FFP]+$fp[FP]+$ahf[AHF]+$we[WE]?></td>
<td class=input><?=$carapisah?></td>
	<td class=input><?=$prc_p[PRC]?></td>
	<td class=input><?=$tc_p[TC]?></td>
	<td class=input><?=$lp_p[LP]?></td>
	<td class=input><?=$ffp_p[FFP]?></td>
	<td class=input><?=$fp_p[FP]?></td>
	<td class=input><?=$ahf_p[AHF]?></td>
	<td class=input><?=$we_p[WE]?></td>
	<td class=input><?=$prc_p[PRC]+$tc_p[TC]+$lp_p[LP]+$ffp_p[FFP]+$fp_p[FP]+$ahf_p[AHF]+$we_p[WE]?></td>
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
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Komponen (.XLS)'>
</form>

<?
mysql_close();
?>
