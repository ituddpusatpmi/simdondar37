<?
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$col1=mysql_query("SELECT * FROM `dtransaksipermintaan` where gol_darah is NULL");if ($col1){mysql_query("update `dtransaksipermintaan` as d, `stokkantong` as s set d.gol_darah=s.gol_darah where d.nokantong=s.nokantong and d.gol_darah is NULL");}
$col2=mysql_query("SELECT * FROM `dtransaksipermintaan` where rh_darah is NULL");if ($col2){mysql_query("update `dtransaksipermintaan` as d, `stokkantong` as s set d.rh_darah=s.RhesusDrh where d.nokantong=s.nokantong and d.rh_darah is NULL");}
$col3=mysql_query("SELECT * FROM `dtransaksipermintaan` where produk_darah is NULL");if ($col3){mysql_query("update `dtransaksipermintaan` as d, `stokkantong` as s set d.produk_darah=s.produk where d.nokantong=s.nokantong and d.produk_darah is NULL");}
$col4=mysql_query("SELECT * FROM `dtransaksipermintaan` where rs is NULL");if ($col4){mysql_query("update dtransaksipermintaan as d,htranspermintaan as h set d.rs=h.rs where  d.NoForm=h.NoForm and d.rs is NULL");}
$col5=mysql_query("SELECT * FROM `dtransaksipermintaan` where wil_rs is NULL");if ($col5){mysql_query("update dtransaksipermintaan as d,rmhsakit as r set d.wil_rs=r.wilayah where d.rs=r.Kode and (d.wil_rs='' or d.wil_rs is NULL)");}
$col6=mysql_query("SELECT * FROM `dtransaksipermintaan` where bagian is NULL");if ($col6){mysql_query("update `dtransaksipermintaan` as d, `htranspermintaan` as s set d.bagian=s.bagian where d.NoForm=s.NoForm and d.bagian is NULL");}
$col7=mysql_query("SELECT * FROM `dtransaksipermintaan` where layanan is NULL");if ($col7){mysql_query("update `dtransaksipermintaan` as d, `htranspermintaan` as s set d.layanan=s.jenis where d.NoForm=s.NoForm and d.layanan is NULL");}
$col8=mysql_query("SELECT * FROM `dtransaksipermintaan` where bagian is NULL");if ($col8){mysql_query("update `dtransaksipermintaan` as d, `htranspermintaan` as s set d.bagian=s.bagian where d.NoForm=s.NoForm and d.bagian='-'");}

?>
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

<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>
<input type=submit name=submit value=Submit>

</form></div>
<!--?
$a=mysql_query("select noKantong,Status,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar,tglpengolahan from stokkantong where  CAST(tgl_keluarpengolahan as date)>='$today' and CAST(tgl_keluarpengolahan as date)<='$today1' and Status != 0 and produk !='WB' order by tglpengolahan ASC");
	$TRec=mysql_num_rows($a);
?>
<h4>Total Hasil pembuatan komponen = <?=$TRec?> Kantong Produk darah </h4-->
<h1 style=font-size:12px;color:#008000;font-family:Verdana;">Rekap Darah Keluar Ke RS dengan status DIBAWA, Dari Tangal :   <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?>
</h1>

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#008000; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan=3>No</td>
        <th rowspan=3>Rumah Sakit</th>
	<th colspan=14>Jenis Komponen</th>
	<th rowspan=3>JML</th>
	<!--th rowspan=2>Metode pemisahan</th-->
	<th colspan=4>GOL DARAH</th>
	<th colspan=2>RH</th>
	<th rowspan=3>JML</th>
	<th colspan=5>BAGIAN</TH>
	<th rowspan=3>JML</th>  
	<th colspan=2>WIL. KOTA</TH>
	<th rowspan=3>JML</th>     
	</tr>

<tr tr style="background-color:#008000; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td colspan=10>Biasa</td>
        <th colspan=4>Apheresis</th>
	<th rowspan=2>A</th>
        <th rowspan=2>B</th>
        <th rowspan=2>O</th>
	<th rowspan=2>AB</th>
        <th rowspan=2>Pos</th>
	<th rowspan=2>Neg</th>
	
	<th rowspan=2>Anak</th>
        <th rowspan=2>Bedah</th>
        <th rowspan=2>Dalam</th>
	<!--th rowspan=2>HD</th-->
        <th rowspan=2>Kandungan</th>
	<th rowspan=2>Lain-lain</th>

	<th rowspan=2>Dalam</th>
	<th rowspan=2>Luar</th>
	
       
	</tr>

      <tr tr style="background-color:#008000; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
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
	<th>BC</th> 
	 <th>PRC</th>
	<th>LP</th>
	<th>TC</th>
	<th>LEKO</th> 
	
	
       
	
      </tr>

<?
$komponen0=mysql_query("select rs as rs,produk_darah,gol_darah,rh_darah,bagian,layanan,tgl from dtransaksipermintaan where status='0' and produk_darah!='' and rs!='' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' group by rs order by rs ASC ");
//$komponen1=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' group by pisah order by pisah ASC");

$no=1;

while ($komponen=mysql_fetch_assoc($komponen0)) {

$wb=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as WB 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='WB'"));

$prc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as PRC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='PRC'"));

$tc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as TC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='TC'"));

$lp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='LP'"));

$ffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='FFP'"));

$fp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='FP'"));

$ahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='AHF'"));

$we=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='WE'"));

$leu=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LEU 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='Leucodepleted'"));
$bc=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as BC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='BUFFYCOAT'"));



$aprc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as APRC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='PRC Aferesis'"));

$alp=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as ALP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='LP Aferesis'"));

$atc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as ATC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='TC Aferesis'"));

$aleko=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as ALEKO 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and Produk_darah='Lekosit Aferesis'"));

//goldarah
$a=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and gol_darah='A'"));

$b=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as B 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and gol_darah='B'"));

$o=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as O 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and gol_darah='O'"));

$ab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AB 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and gol_darah='AB'"));

$rhp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as POS
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and rh_darah='+'"));

$rhn=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as NEG 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and rh_darah='-'"));



//JML BAGIAN

$anak=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as ANAK 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and bagian='ANAK'"));

$bedah=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as BEDAH 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and bagian='BEDAH'"));

$dalam=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as DALAM 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and (bagian='DALAM' or bagian='HD') "));

//$hd=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as HD from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and bagian='HD'"));

$kandungan=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as KANDUNGAN 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and (bagian='KANDUNGAN' or bagian='KEBIDANAN') "));

$kosong=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as KOSONG 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and (bagian='-' or bagian='Lain - lain' or bagian is NULL)"));

//JML BAGIAN

$wild=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as WILD
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and wil_rs='0'"));

$will=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as WILL
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and wil_rs='1'"));

//JML TOTAL

$jwb=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JWB 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='WB'"));

$jprc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JPRC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='PRC'"));

$jtc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JTC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='TC'"));

$jlp=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JLP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='LP'"));

$jffp=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JFFP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='FFP'"));

$jfp=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JFP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='FP'"));

$jahf=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JAHF 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='AHF'"));

$jwe=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JWE 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='WE'"));

$jleu=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JLEU 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='Leucodepleted'"));

$jbc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JBC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='BUFFYCOAT'"));

$japrc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JAPRC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='PRC AFERESIS'"));

$jalp=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JALP 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='LP AFERESIS'"));

$jatc=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JATC 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='TC AFERESIS'"));

$jaleko=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as JALEKO 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and Produk_darah='Lekosit Aferesis'"));

$ja=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JA 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and gol_darah='A'"));

$jb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JB 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and gol_darah='B'"));

$jo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JO 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and gol_darah='O'"));

$jab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JAB
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and gol_darah='AB'"));

$jpos=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JPOS
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and rh_darah='+'"));

$jneg=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JNEG
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and rh_darah='-'"));

//JML TOTAL BAGIAN
$janak=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JANAK
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and bagian='Anak'"));

$jbedah=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JBEDAH
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and bagian='Bedah'"));

$jdalam=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JDALAM
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and bagian='Dalam'"));

$jhd=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JHD
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and bagian='HD'"));

$jobg=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JOBG
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and (bagian='KANDUNGAN' or bagian='KEBIDANAN') "));

$jkos=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JKOS
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and (bagian='-' or bagian='Lain - lain' or  bagian is NULL)"));

$jwild=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWILD
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and wil_rs='0'"));

$jwill=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWILL
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and wil_rs='1'"));

?>
<tr class="record" tr style="background-color:#90EE90; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
      
	<td style="background-color:#008000; font-size:12px; color:#FFFFFF;"><?=$no++?></td>
	<?
	$rs=mysql_fetch_assoc(mysql_query("select namars from rmhsakit where kode='$komponen[rs]' "));
	?>
        <td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$rs[namars]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$wb[WB]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$prc[PRC]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$tc[TC]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$lp[LP]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$ffp[FFP]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$fp[FP]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$ahf[AHF]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$we[WE]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$leu[LEU]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$bc[BC]?></td>

	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$aprc[APRC]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$alp[ALP]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$atc[ATC]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$aleko[ALEKO]?></td>

	<td style="background-color:#008000; font-size:12px; color:#FFFFFF;"><?=$wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$ffp[FFP]+$fp[FP]+$ahf[AHF]+$we[WE]+$leu[LEU]+$aprc[APRC]+$atc[ATC]+$alp[ALP]+$aleko[ALEKO]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$a[A]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$b[B]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$o[O]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$ab[AB]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$rhp[POS]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$rhn[NEG]?></td>
	<td style="background-color:#008000; font-size:12px; color:#FFFFFF;"><?=$rhp[POS]+$rhn[NEG]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$anak[ANAK]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$bedah[BEDAH]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$dalam[DALAM]?></td>
	<!--td style="background-color:#90EE90; font-size:12px; color:#000000;"><!-?=$hd[HD]?></td-->
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$kandungan[KANDUNGAN]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$kosong[KOSONG]?></td>
	<td style="background-color:#008000; font-size:12px; color:#FFFFFF;"><?=$anak[ANAK]+$bedah[BEDAH]+$dalam[DALAM]+$kandungan[KANDUNGAN]+$kosong[KOSONG]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$wild[WILD]?></td>
	<td style="background-color:#90EE90; font-size:12px; color:#000000;"><?=$will[WILL]?></td>
	<td style="background-color:#008000; font-size:12px; color:#FFFFFF;"><?=$wild[WILD]+$will[WILL]?></td>
	</tr>


<?
}

?>

<tr tr style="background-color:#008000; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<td colspan=2>Jumlah</td>
	<td ><?=$jwb[JWB]?></td>
	<td ><?=$jprc[JPRC]?></td>
	<td ><?=$jtc[JTC]?></td>
	<td ><?=$jlp[JLP]?></td>
	<td ><?=$jffp[JFFP]?></td>
	<td ><?=$jfp[JFP]?></td>
	<td ><?=$jahf[JAHF]?></td>
	<td ><?=$jwe[JWE]?></td>
	<td ><?=$jleu[JLEU]?></td>
	<td ><?=$jbc[JBC]?></td>
	<td ><?=$japrc[JAPRC]?></td>
	<td ><?=$jalp[JALP]?></td>
	<td ><?=$jatc[JATC]?></td>
	<td ><?=$jaleko[JALEKO]?></td>
	<td><?=$jwb[JWB]+$jprc[JPRC]+$jtc[JTC]+$jlp[JLP]+$jffp[JFFP]+$jfp[JFP]+$jahf[JAHF]+$jwe[JWE]+$jleu[JLEU]+$jbc[JBC]+$japrc[JAPRC]+$jalp[JALP]+$jatc[JATC]+$jaleko[JALEKO]?></td>

	<td ><?=$ja[JA]?></td>
	<td ><?=$jb[JB]?></td>
	<td ><?=$jo[JO]?></td>
	<td ><?=$jab[JAB]?></td>
	<td ><?=$jpos[JPOS]?></td>
	<td ><?=$jneg[JNEG]?></td>
	<td ><?=$jpos[JPOS]+$jneg[JNEG]?></td>
	
	<td ><?=$janak[JANAK]?></td>
	<td ><?=$jbedah[JBEDAH]?></td>
	<td ><?=$jdalam[JDALAM]?></td>
	<!--td ><!-?=$jhd[JHD]?></td-->
	<td ><?=$jobg[JOBG]?></td>
	<td ><?=$jkos[JKOS]?></td>
	<td ><?=$jdalam[JDALAM]+$jbedah[JBEDAH]+$janak[JANAK]+$jobg[JOBG]+$jkos[JKOS]?></td>
	<td ><?=$jwild[JWILD]?></td>
	<td ><?=$jwill[JWILL]?></td>
	<td ><?=$jwild[JWILD]+$jwill[JWILL]?></td>
	


</tr>


</table>

<br>
<form name=xls method=post action=modul/rekap_darah_keluar_xls1.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Darah Keluar (.XLS)'>
</form>


<?
mysql_close();
?>
