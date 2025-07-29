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
$status1="";
$shift1="";
if ($_POST[status1]!='') $status1=$_POST[status1];
if ($_POST[shift1]!='')  $shift1=$_POST[shift1];

?>



<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
 //-->
</style>
<h1 class="table">Rincian Hasil Crossmatch <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>
Status 
<select name=status1>
	<option value="">-SEMUA-</option>
	<option value=1>Compatible</option>
	<option value=0>Incompatible Boleh Keluar</option>
	<option value=2>Incompatible Tidak Boleh Keluar</option>
</select>

<select name=shift1>
	<option value="">-SEMUA-</option>
	<option value=1>SHIFT 1</option>
	<option value=2>SHIFT 2</option>
	<option value=3>SHIFT 3</option>
	<option value=4>SHIFT 4</option>
</select>


<input type=submit name=submit value=Submit>

</form></div>
<?
$q_dtransaksipermintaan=mysql_query("select * from dtransaksipermintaan  where CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and statuscross like '%$status1%' and shift like '%$shift1%' order by NoForm,petugas ASC ");
$TRec=mysql_num_rows($q_dtransaksipermintaan);
?>
<h4>Jumlah kantong yang sudah di CROSSMATCH = <?=$TRec?> Kantong</h4>
<table class="list" id="box-table-b">
	<tr class='field'>          	
	<td rowspan='3'>No</td>
	<td rowspan='3'>Tgl Cross</td>
	<td rowspan='3'>No Formulir</td>
	<td rowspan='3'>Nama<br>Pasien</td>
	<td rowspan='3'>Tgl Lahir</td>
	<td rowspan='3'>Hasil</td>
	<td rowspan='3'>Status</td>
	<td rowspan='3'>Kode<br>Pendonor</td>
	<td rowspan='3'>No Kantong</td>
	<td rowspan='3'>Gol & Rh</td>
	<td rowspan='3'>Produk</td>
	<td rowspan='3'>Vol. CC</td>
	<td rowspan='3'>Tgl Aftap</td>
	<td rowspan='3'>Tgl Exp.</td>
	<td rowspan='3'>Tgl Keluar</td>
	<td rowspan='3'>Petugas</td>
	<td rowspan='3'>Cheker</td>
	<td rowspan='3'>Tempat</td> 
	<td rowspan='3'>Shift</td>  
	<td rowspan='3'>Metode</td>
	<td colspan='4'>Hasil</td>       
	</tr>
	<tr class="field">          
	<td rowspan='2' >Gel</td>
	<td colspan='3'>Fase</td>
	</tr>
	<tr class="field"> 
	<td>Fase I</td>  
	<td>Fase II</td>
	<td>Fase III</td>       
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


<h1 class="table">Rekap Hasil Crossmatch <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
<table  class="list" id="box-table-b">
<tr class="field">
        <th rowspan=2>Hasil Crossmatch</th>
	<th colspan=8>Jenis Komponen</th>
	<th rowspan=2>Jumlah</th>
        <th colspan=6>Gol & Rh Darah</th>
        <th rowspan=2>Jumlah</th>
	<th colspan=7>Keterangan</th>

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




<br>
<form name=xls method=post action=modul/rekap_hasil_crossmatch_xls.php>
<input type=hidden name=pertgl value="<?=$pertgl?>">
<input type=hidden name=perbln value="<?=$perbln?>">
<input type=hidden name=perthn value="<?=$perthn?>">
<input type=hidden name=pertgl1 value="<?=$pertgl1?>">
<input type=hidden name=perbln1 value="<?=$perbln1?>">
<input type=hidden name=perthn1 value="<?=$perthn1?>">
<input type=hidden name=today1 value="<?=$today1?>">
<input type=hidden name=today value="<?=$today?>">
<input type=hidden name=status1 value="<?=$status1?>">
<input type=hidden name=shift1 value="<?=$shift1?>">
<input type=submit name=submit2 value='Print Rekap Hasil Crossmatch (.XLS)'>
</form>

<?
mysql_close();
?>
