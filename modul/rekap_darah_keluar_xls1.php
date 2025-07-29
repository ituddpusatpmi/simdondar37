<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_rekap_darah_keluar.xls");
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
<h3 >Rekap Darah Keluar Ke RS dengan status DIBAWA, Dari Tangal :   <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?>
</h3>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr  align="center" >
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

<tr  align="center" >
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

      <tr  align="center">
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
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and (bagian='DALAM' or bagian='HD')"));

//$hd=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as HD from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and bagian='HD'"));

$kandungan=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as KANDUNGAN 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and (bagian='KANDUNGAN' or bagian='KEBIDANAN')"));

$kosong=mysql_fetch_assoc(mysql_query("select count(distinct noKantong) as KOSONG 
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and `rs`='$komponen[rs]' and (bagian='-' or bagian='Lain-lain' or bagian is NULL)"));

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
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and (bagian='-' or bagian='Lain-lain' or  bagian is NULL)"));

$jwild=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWILD
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and wil_rs='0'"));

$jwill=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as JWILL
from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status='0' and wil_rs='1'"));

?>
<tr class="record"  align="center">
      
	<td ><?=$no++?></td>
	<?
	$rs=mysql_fetch_assoc(mysql_query("select namars from rmhsakit where kode='$komponen[rs]' "));
	?>
        <td align=left><?=$rs[namars]?></td>
	<td ><?=$wb[WB]?></td>
	<td ><?=$prc[PRC]?></td>
	<td ><?=$tc[TC]?></td>
	<td ><?=$lp[LP]?></td>
	<td ><?=$ffp[FFP]?></td>
	<td ><?=$fp[FP]?></td>
	<td ><?=$ahf[AHF]?></td>
	<td ><?=$we[WE]?></td>
	<td ><?=$leu[LEU]?></td>
	<td ><?=$bc[BC]?></td>

	<td ><?=$aprc[APRC]?></td>
	<td ><?=$alp[ALP]?></td>
	<td ><?=$atc[ATC]?></td>
	<td ><?=$aleko[ALEKO]?></td>

	<td ><?=$wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$ffp[FFP]+$fp[FP]+$ahf[AHF]+$we[WE]+$leu[LEU]+$aprc[APRC]+$atc[ATC]+$alp[ALP]+$aleko[ALEKO]?></td>
	<td ><?=$a[A]?></td>
	<td ><?=$b[B]?></td>
	<td ><?=$o[O]?></td>
	<td ><?=$ab[AB]?></td>
	<td ><?=$rhp[POS]?></td>
	<td ><?=$rhn[NEG]?></td>
	<td ><?=$rhp[POS]+$rhn[NEG]?></td>
	<td ><?=$anak[ANAK]?></td>
	<td ><?=$bedah[BEDAH]?></td>
	<td ><?=$dalam[DALAM]?></td>
	<!--td style="background-color:#90EE90; font-size:12px; color:#000000;"><!-?=$hd[HD]?></td-->
	<td ><?=$kandungan[KANDUNGAN]?></td>
	<td ><?=$kosong[KOSONG]?></td>
	<td ><?=$anak[ANAK]+$bedah[BEDAH]+$dalam[DALAM]+$kandungan[KANDUNGAN]+$kosong[KOSONG]?></td>
	<td ><?=$wild[WILD]?></td>
	<td ><?=$will[WILL]?></td>
	<td ><?=$wild[WILD]+$will[WILL]?></td>
	</tr>


<?
}

?>

<tr align="center">
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
	<!--td ><!?=$jhd[JHD]?></td-->
	<td ><?=$jobg[JOBG]?></td>
	<td ><?=$jkos[JKOS]?></td>
	<td ><?=$jdalam[JDALAM]+$jbedah[JBEDAH]+$janak[JANAK]+$jobg[JOBG]+$jkos[JKOS]?></td>
	<td ><?=$jwild[JWILD]?></td>
	<td ><?=$jwill[JWILL]?></td>
	<td ><?=$jwild[JWILD]+$jwill[JWILL]?></td>
	


</tr>


</table>

<?
mysql_close();
?>
