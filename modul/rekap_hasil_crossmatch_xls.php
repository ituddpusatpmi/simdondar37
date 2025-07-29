<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_hasil_crossmatch.xls");
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
$today1=$perthn1."-".$perbln1."-".$pertgl1;
$status1=$_POST[status1];
$shift1=$_POST[shift1];
//$today1=$_POST[today1];

?>
<h5 class="table">Rincian Hasil Crossmatch <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h5>
<?
$q_dtransaksipermintaan=mysql_query("select * from dtransaksipermintaan  where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross like '%$status1%' and shift like '%$shift1%' order by NoForm,petugas ASC ");
$TRec=mysql_num_rows($q_dtransaksipermintaan);
?>
<h4>Jumlah kantong yang sudah di CROSSMATCH = <?=$TRec?> Kantong</h4>
<table class="list" id="box-table-b" border='1' >
	<tr class='field'>          	
	<td rowspan='3' align=center>No</td>
	<td rowspan='3' align=center>Tgl Cross</td>
	<td rowspan='3' align=center>No Formulir</td>
	<td rowspan='3' align=center>Nama<br>Pasien</td>
	<td rowspan='3' align=center>Tgl Lahir</td>
	<td rowspan='3' align=center>Hasil</td>
	<td rowspan='3' align=center>Status</td>
	<td rowspan='3' align=center>Kode<br>Pendonor</td>
	<td rowspan='3' align=center>No Kantong</td>
	<td rowspan='3' align=center>Gol & Rh</td>
	<td rowspan='3' align=center>Produk</td>
	<td rowspan='3' align=center>Vol. CC</td>
	<td rowspan='3' align=center>Tgl Aftap</td>
	<td rowspan='3' align=center>Tgl Exp.</td>
	<td rowspan='3' align=center>Tgl Keluar</td>
	<td rowspan='3' align=center>Petugas</td>
	<td rowspan='3' align=center>Cheker</td>
	<td rowspan='3' align=center>Tempat</td> 
	<td rowspan='3' align=center>Shift</td>  
	<td rowspan='3' align=center>Metode</td>
	<td colspan='4' align=center>Hasil</td>       
	</tr>
	<tr class="field">          
	<td rowspan='2' align=center>Gel</td>
	<td colspan='3'align=center>Fase</td>
	</tr>
	<tr class="field"> 
	<td align=center>Fase I</td>  
	<td align=center>Fase II</td>
	<td align=center>Fase III</td>       
	</tr>


<?

$no=1;


while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	$q_stok=mysql_query("select gol_darah,produk,RhesusDrh,kodePendonor,kadaluwarsa,tgl_Aftap,volume from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");

	$a_stok=mysql_fetch_assoc($q_stok);
$pasien=mysql_fetch_assoc(mysql_query("select shift,no_rm from htranspermintaan where NoForm='$a_dtransaksipermintaan[NoForm]'"));

	$a_bayar=mysql_fetch_assoc($pembayaran);
	$a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	$a_shift=mysql_fetch_assoc($shift);
$hasil='Compatible';
if ($a_dtransaksipermintaan[StatusCross]=='0') $hasil='Incompatible Keluar';
if ($a_dtransaksipermintaan[StatusCross]=='2') $hasil='Incompatible Tdk Keluar';
$status='Titip';
if ($a_dtransaksipermintaan[Status]=='0') $status='Dibawa';
if ($a_dtransaksipermintaan[Status]=='B') $status='Batal';


	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
<td><?=$a_dtransaksipermintaan[tgl]?></td>
<td><?=$a_dtransaksipermintaan[NoForm]?></td>
<?
$pasien1=mysql_fetch_assoc(mysql_query("select Nama, tgl_lahir from pasien where no_rm='$pasien[no_rm]'"));

?>
<td class=input><?=$pasien1[Nama]?></td>
<td class=input><?=$pasien1[tgl_lahir]?></td>
<td class=input><?=$hasil?></td>
<td class=input><?=$status?></td>
<td class=input><?=$a_stok[kodePendonor]?></td>
<td class=input><?=$a_dtransaksipermintaan[NoKantong]?></td>  
<td class=input><?=$a_stok[gol_darah]?> (<?=$a_stok[RhesusDrh]?>)</td>
<td class=input><?=$a_stok[produk]?></td>
<td class=input><?=$a_stok[volume]?></td>
<td class=input><?=$a_stok[tgl_Aftap]?></td>
<td class=input><?=$a_stok[kadaluwarsa]?></td>
<td class=input><?=$a_dtransaksipermintaan[tgl_keluar]?></td>

<td class=input><?=$a_dtransaksipermintaan[petugas]?></td>
<td class=input><?=$a_dtransaksipermintaan[cheker]?></td>
<td class=input><?=$a_dtransaksipermintaan[tempat]?></td>
<td class=input><?=$a_dtransaksipermintaan[shift]?></td>
<td class=input><?=$a_dtransaksipermintaan[MetodeCross]?></td>
<td class=input><?=$a_dtransaksipermintaan[aglutinasi]?></td>
<td class=input><?=$a_dtransaksipermintaan[fase1]?></td>
<td class=input><?=$a_dtransaksipermintaan[fase2]?></td>
<td class=input><?=$a_dtransaksipermintaan[fase3]?></td>

	</tr>
	<?
}
?>
</table>

<br></br>


<h5 class="table">Rekap Hasil Crossmatch <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h5>
<br>
<table  class="list" id="box-table-b" border='1'>
<tr class="field">
        <th rowspan=2>Hasil Crossmatch</th>
	<th colspan=8>Jenis Komponen</th>
	<th rowspan=2>Jumlah</th>
        <th colspan=6>Gol & Rh Darah</th>
        <th rowspan=2>Jumlah</th>
	<th colspan=6>Keterangan</th>

	</tr>
      <tr class="field" >
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
	<th>Cocok</th>
	<th>Minor Pos</th>
	<th>Mayor Pos</th>
        <th>Mayor Minor <br> AK Pos</th>
	<th>Mayor Minor <br> AK DCT Pos</th>
	<th>Minor AK <br> DCT Positif </th>
	<th>May Min Neg<br>AK DCT Pos</th>
      </tr>
	
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
$komponen0=mysql_query("select tgl,StatusCross,shift from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross like '%$status1%' and shift like '%$shift1%' group by StatusCross order by StatusCross ASC");
while ($komponen=mysql_fetch_assoc($komponen0)) {

//$gola=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
//from stokkantong where stat2 like 'b%' and CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today' and stat2='$komponen[stat2]'"));
$wb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WB 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='WB')"));

$prc=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as PRC 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='PRC')"));

$tc=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as TC 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='TC')"));

$lp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as LP 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='LP')"));

$ffp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FFP 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='FFP')"));

$fp=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as FP 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='FP')"));

$ahf=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AHF 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='AHF')"));

$we=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as WE 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where produk='WE')"));

$gola=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as A 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where gol_darah='A')"));

$golb=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as B 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where gol_darah='B')"));

$golab=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as AB 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where gol_darah='AB')"));

$golo=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as O 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where gol_darah='O')"));

$pos=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as POS 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where RhesusDrh='+')"));

$neg=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as NEG 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and noKantong in (select noKantong from stokkantong where RhesusDrh='-')"));

$cocok=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as cocok 
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and stat2='Cocok' "));
$incom1=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as minpos
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and stat2='Minor Positif' "));
$incom2=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as maypos
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and stat2='Mayor Positif' "));
$incom3=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as mayminakpos
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and stat2='Mayor Minor AK Positif' "));
$incom4=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as mayminakdctpos
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and stat2='Mayot Minor AK DCT Positif' "));
$incom5=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as minakdctpos
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and stat2='Minor AK DCT Positif' "));
$incom6=mysql_fetch_assoc(mysql_query("select count(distinct nokantong) as mayminnegakdctpos
from dtransaksipermintaan where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross='$komponen[StatusCross]' and shift='$komponen[shift]' and stat2='May Min Positif AK DCT Negatif' "));

//Mayor positif
//Mayor Minor AK Positif
//Mayor Minor AK DCT Positif
//Minor AK DCT Positif
$statuscross='Compatible';
if ($komponen[StatusCross]=='0') $statuscross='InCompatible Boleh Keluar';
if ($komponen[StatusCross]=='2') $statuscross='InCompatible tidak Boleh Keluar';

?>
<tr class="record">

      <td class=input><?=$statuscross?></td>
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
	<td class=input><?=$cocok[cocok]?></td>	
	<td class=input><?=$incom1[minpos]?></td>	
	<td class=input><?=$incom2[maypos]?></td>
	<td class=input><?=$incom3[mayminakpos]?></td>
	<td class=input><?=$incom4[mayminakdctpos]?></td>
	<td class=input><?=$incom5[minakdctpos]?></td>
	<td class=input><?=$incom6[mayminnegakdctpos]?></td>
	</tr>
<?
}

?>
</table>
<?
mysql_close();
?>
