<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_keluar_bdrs.xls");
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
<h5 colspan='10' class="table">Rekap Darah Keluar Ke BDRS Dari Tangal :   <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?>
<br></h5>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<!--td>Tanggal Keluar</td-->
	<td>Nama BDRS</td>
	<td>No Kantong</td>
        <td>Gol Darah</td>
        <td>Komponen</td>
        <td>Tgl Aftap</td>
	<td>Tgl Exp.</td>
        <td>Tgl Periksa</td>
	<td>Jenis</td>
	<td>Petugas</td>
	
	
	</tr>

</tr>	
<?
//$trans0=mysql_query("select dt.NoForm,dt.NoKantong,dp.JenisDarah,dp.GolDarah,dp.Rhesus
//					from dtransaksipermintaan as dt, dtranspermintaan as dp, dpembayaran as dpem
//					where dpem.tgl='$today' and dt.NoForm=dp.NoForm and dpem.NoForm=dp.noForm and dt.Status='L' group by NoForm");
$no=1;
$q_dtransaksipermintaan=mysql_query("select noKantong,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar from stokkantong where CAST(tgl_keluar as date) >='$today' and CAST(tgl_keluar as date) <='$today1' and Status='3' and stat2 like 'b%' order by tgl_keluar ASC");
$TRec=mysql_num_rows($q_dtransaksipermintaan);
while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	$q_stok=mysql_query("select gol_darah,produk,RhesusDrh from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
//	$q_dhasilcross=mysql_query("select Pemeriksa from dhasilcross where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
	$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$a_dtransaksipermintaan[NoKantong]') "));
	$waktu=mysql_fetch_assoc(mysql_query("(select tglPeriksa as tgl from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select tgl_tes as tgl from testrapid where nokantong='$a_dtransaksipermintaan[NoKantong]') "));
	$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
	$pembayaran=mysql_query("select namabrg,petugas,subTotal,shift from dpembayaranpermintaan where no_kantong='$a_dtransaksipermintaan[NoKantong]' and notrans='$a_dtransaksipermintaan[NoForm]' ");
	$shift=mysql_query("select shift,bagian,tglminta,rs,jenis from htranspermintaan where NoForm='$a_dtransaksipermintaan[NoForm]' ");
	$a_stok=mysql_fetch_assoc($q_stok);
	$a_bayar=mysql_fetch_assoc($pembayaran);
	$a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	$a_shift=mysql_fetch_assoc($shift);

	echo mysql_error();
	if($a_stok[produk]!=''){
		$produk=$a_stok[produk];
	}else{
		$produk='WB';
	}
	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td><?=$no++?></td>
<!--?
$tgl_form=$a_dtransaksipermintaan[tgl_keluar];
$tglf=date("d",strtotime($tgl_form));
$blnf=date("n",strtotime($tgl_form));
$thnf=date("Y",strtotime($tgl_form));
$bulanf=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnf1=$bulanf[$blnf];
$jamf = date("H:i:s",strtotime($tgl_form));

/*
$blnmin=substr($trans[TglMinta],5,2);
$tglmin=substr($trans[TglMinta],8,2);
$thnmin=substr($trans[TglMinta],0,4);*/
?-->
      
<?
$rmhskt=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode='$a_dtransaksipermintaan[stat2]'"));
?>
<td class=input><?=$rmhskt[nama]?></td>    


	<td class=input><?=$a_dtransaksipermintaan[noKantong]?></td>
	<td class=input><?=$a_dtransaksipermintaan[gol_darah]?> (<?=$a_dtransaksipermintaan[RhesusDrh]?>)</td>
	<td class=input><?=$a_dtransaksipermintaan[produk]?></td>
       	<td class=input><?=$a_dtransaksipermintaan[tgl_Aftap]?></td>
      	<td class=input><?=$a_dtransaksipermintaan[kadaluwarsa]?></td>
      	<td class=input><?=$a_dtransaksipermintaan[tglperiksa]?></td>
<?
$jns="Double";
if ($a_dtransaksipermintaan[jenis]=='1') $jns="Single";
if ($a_dtransaksipermintaan[jenis]=='3') $jns="Triple";
if ($a_dtransaksipermintaan[jenis]=='4') $jns="Quadruple";
if ($a_dtransaksipermintaan[jenis]=='6') $jns="Pediatrik";
?>

	<td class=input><?=$jns?></td>


<?
$petugas=mysql_fetch_assoc(mysql_query("select * from kirimbdrs where nokantong='$a_dtransaksipermintaan[noKantong]'"));
?>
	<td class=input><?=$petugas[petugas]?></td>

	</tr>
<?
}
?>
</table>
<br>
</br>

<tr class="record">
        <th colspan=14><b>Total =<?=mysql_num_rows($q_dtransaksipermintaan)?>  Kantong, dengan rincian :</b></th>
	
      </tr>
<br>
</br>
<!--tr class="record">
<?
$hbs=mysql_fetch_assoc(mysql_query("select count(noKantong) as hbs from stokkantong where gol_darah='A' and CAST(tgl_keluar as date) >='$today' and CAST(tgl_keluar as date) <='$today1' and Status='3' and stat2 like 'b%' "));
$hcv=mysql_fetch_assoc(mysql_query("select count(noKantong) as hcv from stokkantong where gol_darah='B' and CAST(tgl_keluar as date) >='$today' and CAST(tgl_keluar as date) <='$today1' and Status='3' and stat2 like 'b%' "));
$hiv=mysql_fetch_assoc(mysql_query("select count(noKantong) as hiv from stokkantong where gol_darah='O' and CAST(tgl_keluar as date) >='$today' and CAST(tgl_keluar as date) <='$today1' and Status='3' and stat2 like 'b%' "));
$syp=mysql_fetch_assoc(mysql_query("select count(noKantong) as syp from stokkantong where gol_darah='AB' and CAST(tgl_keluar as date) >='$today' and CAST(tgl_keluar as date) <='$today1' and Status='3' and stat2 like 'b%' "));
  ?>
<th colspan=14><b>dengan rincian : Gol A = <?=$hbs[hbs]?> Kantong, Gol B = <?=$hcv[hcv]?> Kantong, Gol O = <?=$hiv[hiv]?> Kantong, Gol AB = <?=$syp[syp]?> Kantong </b></th>
</tr-->

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr >
        <th rowspan=2>BDRS</th>
	<th colspan=8>Jenis Komponen</th>
	<th rowspan=2>Jumlah</th>
        <th colspan=6>Gol & Rh Darah</th>
        <th rowspan=2>Jumlah</th>
	</tr>
      <tr >
	<th>WB</th>
        <th>PRC</th>
        <th>TC</th>
        <th>LP</th>
	<th>FFP</th>
        <th>FP</th>
	<th>AHF</th>
	<th>WE</th>
        <th>A</th>
        <th>B</th>
        <th>AB</th>
        <th>O</th>
	<th>Pos</th>
        <th>Neg</th>
	
      </tr>


         <!--tr>
		 <td>Komponen</td>
          <td>Gol A</td>
          <td>Gol B</td>
          <td>Gol AB</td>
          <td>Gol O</td>
          <td>Rh Pos</td>
          <td>Rh Neg</td>
	  <td>Jumlah</td>
          <!--td>Jumlah Pendonor</td>
        </tr-->
<?
$komponen0=mysql_query("select noKantong as tgl,stat2 from stokkantong where status='3' and stat2 like 'b%' and produk!='' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' group by stat2 order by stat2 ASC");
while ($komponen=mysql_fetch_assoc($komponen0)) {

//$gola=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
//from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today' and stat2='$komponen[stat2]'"));
$wb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WB 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and produk='WB'"));

$prc=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as PRC 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where produk='PRC')"));

$tc=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TC 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where produk='TC')"));

$lp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where produk='LP')"));

$ffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where produk='FFP')"));

$fp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where produk='FP')"));

$ahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where produk='AHF')"));

$we=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where produk='WE')"));

$gola=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where gol_darah='A')"));

$golb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as B 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where gol_darah='B')"));

$golab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AB 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where gol_darah='AB')"));

$golo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as O 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where gol_darah='O')"));

$pos=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as POS 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where RhesusDrh='+')"));

$neg=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as NEG 
from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and stat2='$komponen[stat2]' and noKantong in 
(select noKantong from stokkantong where RhesusDrh='-')"));


$bdrs=mysql_fetch_assoc(mysql_query("select * from bdrs where kode='$komponen[stat2]'"));

?>
<tr class="record">

      <td class=input><?=$bdrs[nama]?></td>
	<td class=input><?=$wb[WB]?></td>
	<td class=input><?=$prc[PRC]?></td>
	<td class=input><?=$tc[TC]?></td>
	<td class=input><?=$lp[LP]?></td>
	<td class=input><?=$ffp[FFP]?></td>
	<td class=input><?=$fp[FP]?></td>
	<td class=input><?=$ahf[AHF]?></td>
	<td class=input><?=$we[WE]?></td>
	<td class=input><?=$wb[WB]+$prc[PRC]+$tc[TC]+$lp[LP]+$ffp[FFP]+$fp[FP]+$ahf[AHF]+$we[WE]?></td>
      <td class=input><?=$gola[A]?></td>
      <td class=input><?=$golb[B]?></td>
      <td class=input><?=$golab[AB]?></td>
      <td class=input><?=$golo[O]?></td>
      <td class=input><?=$pos[POS]?></td>
      <td class=input><?=$neg[NEG]?></td>
      <td class=input><?=$gola[A]+$golb[B]+$golab[AB]+$golo[O]?></td>
	</tr>
<?
}

?>
</table>

<?
mysql_close();
?>
