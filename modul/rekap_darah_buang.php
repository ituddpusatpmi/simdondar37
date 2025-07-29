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
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />

<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);
$alasan="";
$produk="";
$drh="";
$rh="";
$srcrm="";
$srcform="";
$jenis="";
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') 	$today1=$_POST[minta2];
if ($_POST[alasan]!='') 	$alasan=$_POST[alasan];
if ($_POST[produk]!='') 	$produk=$_POST[produk];
if ($_POST[drh]!='') 		$drh=$_POST[drh];
if ($_POST[rh]!='') 		$rh=$_POST[rh];
if ($_POST[rm]!='') 		$srcrm=$_POST[rm];
if ($_POST[nomorf]!='') 	$srcform=$_POST[nomorf];
if ($_POST[jenis]!='') 		$jenis=$_POST[jenis];

?>
<h1>RINCIAN PEMUSNAHAN DARAH</h1>
<form method=post>
TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>><br></br>
NO.KANTONG <input type=text name=nomorf id=nomorf size=10 value=<?=$srcform?>>
	PETUGAS <input type=text name=rm id=rm size=10 value=<?=$srcrm?>> <br>

ALASAN BUANG<select name="alasan">
	<option value="">-SEMUA-</option>
	<option value="0">GAGAL AFTAP</option>
	<option value="1">LISIS</option>
	<option value="2">KADALUARSA</option>
	<option value="3">PLEBOTOMI</option>
	<option value="4">REAKTIF BUANG</option>
	<option value="5">LIFEMIK</option>
	<option value="6">GREYZONE</option>
	<option value="7">DCT POSITIF</option>
	<option value="8">KANTONG BOCOR</option>
	<option value="9">SATELIT RUSAK</option>
    <option value="10">BEKAS PEMBUATAN TPK</option>
	<option value="10">BEKAS PEMBUATAN WE</option>
	<option value="11">REAKTIF RUJUK KE UTDP</option>
	<option value="12">HEMATOKRIT TINGGI</option>
	<option value="13">LIMBAH SISA PRC</option>
	<option value="14">LEUKOSIT TINGGI</option>
	<option value="15">PRODUK RUSAK</option>
	<option value="16">PRODUK SAMPEL QC</option>
	</select>
<!--RS
<select name="gol_rs">
<option value="" selected>- SEMUA -</option>
<?php
$qrs = mysql_query("select * from rmhsakit ");

while ($rowrs1 = mysql_fetch_array($qrs)){
  echo "<option value=$rowrs1[Kode]>$rowrs1[NamaRs]</option>";
}
?>
</select>
<br-->
PRODUK
<select name="produk">
<option value="" selected>-SEMUA-</option>
<?php
$ql= mysql_query("select * from produk ");

while ($rowl1 = mysql_fetch_array($ql)){
  echo "<option value=$rowl1[Nama]>$rowl1[Nama]</option>";
}
?>
</select>

GOL DARAH<select name="drh">
	<option value="">-SEMUA-</option>
	<option value="A">A</option>
	<option value="B">B</option>
	<option value="O">O</option>
	<option value="AB">AB</option>
	</select>

RH<select name="rh">
						<option value="">-SEMUA-</option>
						<option value="+">POS</option>
						<option value="-">NEG</option>

					</select>

JENIS<select name="jenis">
						<option value="">-SEMUA-</option>
						<option value="1">SINGLE</option>
						<option value="2">DOUBLE</option>
						<option value="3">TRIPLE</option>
						<option value="4">QUADRUPLE</option>
						<option value="5">PEDIATRIK</option>

					</select>

<input type="submit" name="submit" value="Lihat" class="swn_button_blue">
</form>
<h1 class="table">Rincian Pemusnahan Darah Dari Tangal :   <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?>
<?
$transaksipermintaan=mysql_query("select * from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' and noKantong like '%$srcform%' and user like '%$srcrm%' and alasan_buang like '%$alasan%' and produk like '%$produk%' and gol_darah like '$drh%' and RhesusDrh like '%$rh%' and jenis like '%$jenis%' order by tgl_buang ");



$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " kantong";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr tr style="background-color:#8E006B; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<td>No Kantong</td>
	<td>Jenis</td>
	<td>Gol & Rh</td>
	<td>Produk</td>
	<td>Volume</td>
	<td>Tgl Aftap</td>
	<td>Tgl Kadaluarsa</td>
        <td>Tgl Buang</td>
	<td>Alasan Buang</td> 
	<td>Petugas Buang</td>
	
        </tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr tr style="background-color:#FECCBF; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['noKantong']?></td>
<?
$jenis1='Single';
if ($datatransaksipermintaan[jenis]=='2') $jenis1='Double';
if ($datatransaksipermintaan[jenis]=='3') $jenis1='Triple';
if ($datatransaksipermintaan[jenis]=='4') $jenis1='Quadruple';
if ($datatransaksipermintaan[jenis]=='6') $jenis1='Pediatrik';
?>
	<td align="center"><?=$jenis1?></td>
	<td align="center"><?=$datatransaksipermintaan['gol_darah']?>(<?=$datatransaksipermintaan['RhesusDrh']?>)</td>
	<td align="center"><?=$datatransaksipermintaan['produk']?></td>
	<td align="center"><?=$datatransaksipermintaan['volume']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_Aftap']?></td>
	<td align="center"><?=$datatransaksipermintaan['kadaluwarsa']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_buang']?></td>
<?
if ($datatransaksipermintaan[alasan_buang]=='2') $alasan1='Kadaluwarsa';
if ($datatransaksipermintaan[alasan_buang]=='0') $alasan1='Gagal Aftap';
if ($datatransaksipermintaan[alasan_buang]=='3') $alasan1='Plebotomi';
if ($datatransaksipermintaan[alasan_buang]=='4') $alasan1='Reaktif Dibuang';
if ($datatransaksipermintaan[alasan_buang]=='5') $alasan1='Lifemik';
if ($datatransaksipermintaan[alasan_buang]=='6') $alasan1='Greyzone';
if ($datatransaksipermintaan[alasan_buang]=='7') $alasan1='DCT Positif';
if ($datatransaksipermintaan[alasan_buang]=='8') $alasan1='Kantong Bocor';
if ($datatransaksipermintaan[alasan_buang]=='1') $alasan1='Lisis';
if ($datatransaksipermintaan[alasan_buang]=='9') $alasan1='Satelit Rusak';
if ($datatransaksipermintaan[alasan_buang]=='10') $alasan1='Bekas Pembuatan WE';
if ($datatransaksipermintaan[alasan_buang]=='11') $alasan1='Reaktif Rujuk keUDDP';
if ($datatransaksipermintaan[alasan_buang]=='12') $alasan1='Hematokrit Tinggi';
if ($datatransaksipermintaan[alasan_buang]=='13') $alasan1='Limbah Sisa PRC';
if ($datatransaksipermintaan[alasan_buang]=='14') $alasan1='Leukosit Tinggi';
if ($datatransaksipermintaan[alasan_buang]=='15') $alasan1='Produk Rusak';
if ($datatransaksipermintaan[alasan_buang]=='16') $alasan1='Produk Sampel QC';

?>

	<td align="center"><?=$alasan1?></td>
	<td align="center"><?=$datatransaksipermintaan['user']?></td>

</tr>
<? $no++;} ?>
</table>
<br>
<form name=xls method=post action=modul/rekap_darah_buang_xls.php>
<input type=hidden name=today 	value='<?=$today?>'>
<input type=hidden name=today1 	value='<?=$today1?>'>
<input type=hidden name=alasan 	value='<?=$alasan?>'>
<input type=hidden name=jenis 	value='<?=$jenis?>'>
<input type=hidden name=produk 	value='<?=$produk?>'>
<input type=hidden name=drh 	value='<?=$drh?>'>
<input type=hidden name=rh 	value='<?=$rh?>'>
<input type=hidden name=rm 	value='<?=$srcrm?>'>
<input type=hidden name=nomorf 	value='<?=$srcform?>'>

<input type=submit name=submit2 value='Print Rincian Pemusnahan Darah (.XLS)'>
</form>

<?
mysql_close();
?>
