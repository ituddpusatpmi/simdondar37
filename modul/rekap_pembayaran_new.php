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
<style>
    tr { background-color: #FDF5E6}
    .initial { background-color: #FDF5E6; color:#000000 }
    .normal { background-color: #FDF5E6 }
    .highlight { background-color: #7FFF00 }
</style>
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
$rs1="";
$shift1="";
$layanan="";
if ($_POST[rs1]!='') 		$rs1=$_POST[rs1];
if ($_POST[shift1]!='')  	$shift1=$_POST[shift1];
if ($_POST[layanan]!='')  	$layanan=$_POST[layanan];
 
function rupiah($angka){
    $hasil_rupiah = number_format($angka,0,',','.');
    return $hasil_rupiah;
    }
?>


<a name="atas"></a>
<h1 >Rincian transaksi cetak kwitansi dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
<br>
</br>
<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>

RS
<select name="rs1">
<option value="" selected>- SEMUA -</option>
<?php
$qrs = mysql_query("select * from rmhsakit ");

while ($rowrs1 = mysql_fetch_array($qrs)){
  echo "<option value=$rowrs1[Kode]>$rowrs1[NamaRs]</option>";
}
?>
</select>

LAYANAN
<select name="layanan">
<option value="" selected>-SEMUA-</option>
<?php
$ql= mysql_query("select * from jenis_layanan ");

while ($rowl1 = mysql_fetch_array($ql)){
  echo "<option value=$rowl1[kode]>$rowl1[nama]</option>";
}
?>
</select>
SHIFT
<select name=shift1>
	<option value="">-SEMUA-</option>
	<option value=1>SHIFT 1</option>
	<option value=2>SHIFT 2</option>
	<option value=3>SHIFT 3</option>
	<option value=4>SHIFT 4</option>
</select>
<input type=submit class="swn_button_blue" name=submit value=Submit>
<br></br><br></br>
<!--br>
<h1>Rekap transaksi cetak kwitansi dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
</br>
<!--form rekap>


<br>

</td>



</tr>
<!--batas form rekap -->

</form></div>
        
        <form name=xls method=post action=modul/rekap_pembayaran_new_xls.php>
        <input type=hidden name=pertgl value='<?=$pertgl?>'>
        <input type=hidden name=perbln value='<?=$perbln?>'>
        <input type=hidden name=perthn value='<?=$perthn?>'>
        <input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
        <input type=hidden name=perbln1 value='<?=$perbln1?>'>
        <input type=hidden name=perthn1 value='<?=$perthn1?>'>
        <input type=hidden name=today1 value='<?=$today1?>'>
        <input type=hidden name=rs1 value='<?=$rs1?>'>
        <input type=hidden name=layanan value='<?=$layanan?>'>
        <input type=hidden name=shift1 value='<?=$shift1?>'>

        <input type=submit name=submit2  class="swn_button_blue" value='Print Rekap Transaksi Pembayaran (.XLS)'>
        <a href="#bawah" class="swn_button_blue">Ke bawah</a>
        </form>
<?
$q_dtransaksipermintaan=mysql_query("select * from v_pembayaran where date(insert_on)>='$today' and date(insert_on)<='$today1' and jenis like '%$layanan%' and shift like '%$shift1%' and rs like '%$rs1%' order by insert_on ASC");
$TRec=mysql_num_rows($q_dtransaksipermintaan);
?>
<th colspan=12 align="right"><b>Total = <?=$TRec?> data</b></th></tr>
        <tr class="field">

<table border=2 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<b>
	<td align="center">No</td>
	<td align="center">Tanggal Cetak</td>
    <td align="center">Jam</td>
	<td align="center">No Formulir</td>
    <td align="center">No Kwitansi</td>
    <td align="center">No RM(RS)</td>
	<td align="center">Nama Pasien</td>
	<td align="center">Gol. Darah</td>
	<td align="center">Rumah Sakit</td>
	<td align="center">Jumlah <br>Pembayaran</td>
	<td align="center">Jenis<br>Biaya</td>
    <td align="center">Petugas</td>
	<td align="center">Shift</td>
	<td align="center">Tempat</td>
        </b>
	 </tr>

</tr>	

<?
$no=1;

while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){

    
	?>
	 <tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
<?
$jam   =substr($a_dtransaksipermintaan[insert_on],11,5);
$blnkel=substr($a_dtransaksipermintaan[insert_on],5,2);
$tglkel=substr($a_dtransaksipermintaan[insert_on],8,2);
$thnkel=substr($a_dtransaksipermintaan[insert_on],0,4);
?>
<td class=input><?=$tglkel?>-<?=$blnkel?>-<?=$thnkel?></td>
<td class=input><?=$jam?></td>
<td class=input><?=$a_dtransaksipermintaan[noForm]?></td>
<td class=input><?=$a_dtransaksipermintaan[nomer]?></td>
<td class=input><?=$a_dtransaksipermintaan[regrs]?></td>
<td class=input><?=$a_dtransaksipermintaan[nama]?></td>
<td class=input align=center><?=$a_dtransaksipermintaan[gol_darah].'/'.$a_dtransaksipermintaan[rhesus]?></td>
<td class=input><?=$a_dtransaksipermintaan[NamaRs]?></td>
<td class=input name='jumtot' align="right"><? echo rupiah($a_dtransaksipermintaan[TotDibayar]);?></td>
<td class=input><?=$a_dtransaksipermintaan[carabyr]?></td>
<td class=input><?=$a_dtransaksipermintaan[petugas]?></td>
<td class=input><?=$a_dtransaksipermintaan[shift]?></td>
<td class=input>UDD</td>
      
	</tr>
	<?
}
?>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=14><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->
        <td colspan='9' align='right'><b>Jumlah Rp. </b></td>
	<?
	$jum=mysql_fetch_assoc(mysql_query("select sum(TotDibayar) as jum from v_pembayaran
where date(insert_on)>='$today' and date(insert_on)<='$today1' and jenis like '%$layanan%' and shift like '%$shift1%' and rs like '%$rs1%' "));
	?>
    <td align="right"><? echo rupiah($jum[jum]);?></td>
	<td></td>
    <td></td>
	<td></td>
	<td></td>
    </tr>

</tr>	
</table>
<br>

<a href="#atas" class="swn_button_blue">Ke Atas</a>
<a name="bawah"></a>
<?
mysql_close();
?>
