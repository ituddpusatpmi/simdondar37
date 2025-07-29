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
<style>
 .awesomeText{
  color : #000;
  font-size : 150%;	
}
</style>
<STYLE>
  tr { background-color: #FFF8DC}
  .initial { background-color: #FFF8DC; color:#000000 }
  .normal { background-color: #FFF8DC }
  .highlight { background-color: #7CFC00 }
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
?>
<h1 style="color:red;font-weight:bold;">REKAP PEMERIKSAAN KONFIRMASI GOLONGAN DARAH (Tgl:<?=$pertgl?>-<?=$perbln?>-<?=$perthn?> s/d <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?>)</h1>
<div class="awesomeText">
	<form name=mintadarah1 method=post> Mulai:
		<input type=text name=minta1 id=datepicker size=10> Sampai :
		<input type=text name=minta2 id=datepicker1 size=10>
		<input type=submit name=submit value=Submit>
	</form>
</div>
<?
$a=mysql_query("select * from dkonfirmasi where  CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' order by NoKonfirmasi ASC");
$jumcocok   =mysql_fetch_assoc(mysql_query("select count(NoKonfirmasi) as cocok    from dkonfirmasi where Cocok='0'  and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' "));
$jumtdkcocok=mysql_fetch_assoc(mysql_query("select count(NoKonfirmasi) as tdkcocok from dkonfirmasi where Cocok='1'  and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' "));
	$TRec=mysql_num_rows($a);
echo "<div class='awesomeText'>Jumlah Konfirmasi = ".$TRec." Kantong</div>";
echo "<div class='awesomeText'>KGD hasil COCOK = ".$jumcocok[cocok]." Kantong</div>";
echo "<div class='awesomeText'>KGD hasil TIDAK COCOK = ".$jumtdkcocok[tdkcocok]." Kantong</div><br>";
?>

<table border=1 cellpadding=3 cellspacing=5 style="border-collapse:collapse" >
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>          
	<td rowspan='3'>No</td>
	<td rowspan='3'>Tanggal</td>
	<td rowspan='3'>No Konfirmasi</td>
	<td rowspan='3'>No Kantong</td>
        <td rowspan='3'>Gol(Rh)<br>Darah Asal</td>
        <td rowspan='3'>Gol(Rh)<br>Darah Baru</td>
        <td rowspan='3'>Hasil<br>Konfirmasi</td>
	<td rowspan='3'>Antibody<br>Screening</td>
	<td rowspan='3'>Metode</td>
	<td colspan='3'>Anti A</td>
	<td colspan='3'>Anti B</td>
	<td colspan='3'>Anti D</td>
	<td rowspan='3'>TS-A</td>
	<td rowspan='3'>TS-B</td>
	<td rowspan='3'>TS-O</td>	
	<td rowspan='3'>AC</td>
	<td rowspan='3'>BA 6%</td>
	<td rowspan='3'>Petugas</td>
	</tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>
	<td rowspan='2'>Nilai</td>
	<td rowspan='2'>Nolot</td>
	<td rowspan='2'>ED.</td>

	<td rowspan='2'>Nilai</td>
	<td rowspan='2'>Nolot</td>
	<td rowspan='2'>ED.</td>

	<td rowspan='2'>Nilai</td>
	<td rowspan='2'>Nolot</td>
	<td rowspan='2'>ED.</td>
	</tr>
</tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align='center'>
	</tr>
</tr>
<?
$no=1;
while($a_dtransaksipermintaan=mysql_fetch_assoc($a)){
?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align="right"><?=$no++?>.</td>
			<? 
			$cocok1='-';
			if ($a_dtransaksipermintaan[Cocok]=='0') $cocok1='Cocok';
			if ($a_dtransaksipermintaan[Cocok]=='1') $cocok1='Tidak Cocok';
			if ($a_dtransaksipermintaan[sel]=='0') $sel='Ya';
			if ($a_dtransaksipermintaan[sel]=='1') $sel='Tidak';
			if ($a_dtransaksipermintaan[serum]=='0') $serum='Ya';
			if ($a_dtransaksipermintaan[serum]=='1') $serum='Tidak';
			if ($a_dtransaksipermintaan[ac]=='0') $ac='Pos';
			if ($a_dtransaksipermintaan[ac]=='1') $ac='Neg';
			if ($a_dtransaksipermintaan[ba]=='0') $ba='Pos';
			if ($a_dtransaksipermintaan[ba]=='1') $ba='Neg';
			$pengolahan=$a_dtransaksipermintaan[tgl];
			$tglkgd = date("Y-m-d",strtotime($pengolahan));
	?>
	<td class=input nowrap><?=$tglkgd?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[NoKonfirmasi]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[NoKantong]?></td>
	<td class=input align="center" nowrap><?=$a_dtransaksipermintaan[goldarah_asal]?>(<?=$a_dtransaksipermintaan[rhesus_asal]?>)</td>
	<td class=input align="center" nowrap><?=$a_dtransaksipermintaan[GolDarah]?>(<?=$a_dtransaksipermintaan[Rhesus]?>)</td>
	<?
	if ($cocok1=="Tidak Cocok") {
	   echo '<td nowrap class=input style="color:red;font-weight:bold;">'.$cocok1.'</td>';
	} else {
	   echo"<td class=input>".$cocok1."</td>";	
	}
	?>
	<?
		$abs = mysql_fetch_assoc(mysql_query("SELECT abs from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]'"));
		$absfix='Negatif';
			if ($abs[abs]=='negative') $absfix='Negatif';
			if ($abs[abs]=='negatif') $absfix='Negatif';
			if ($abs[abs]=='positive') $absfix='Positif';
			if ($abs[abs]=='positif') $absfix='Positif';
	if ($absfix=="Positif") {
	   echo '<td nowrap class=input style="color:red;font-weight:bold;">'.$absfix.'</td>';
	} else {
	   echo"<td class=input>".$absfix."</td>";	
	}
	?>

       	<td class=input nowrap><?=$a_dtransaksipermintaan[metode]?></td>
      	<td class=input nowrap><?=$a_dtransaksipermintaan[antiA]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[nolot_aa]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[expa]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[antiB]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[nolot_ab]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[expb]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[antiD]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[nolot_ad]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[expd]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[tA]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[tB]?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[tsO]?></td>
	<td class=input nowrap><?=$ac?></td>
	<td class=input nowrap><?=$ba?></td>
	<td class=input nowrap><?=$a_dtransaksipermintaan[petugas]?></td>
	</tr>
<?}?>
</table>
<br>
<form name=xls method=post action=modul/rekap_konfirmasi_xls.php>
	<input type=hidden name=pertgl value='<?=$pertgl?>'>
	<input type=hidden name=perbln value='<?=$perbln?>'>
	<input type=hidden name=perthn value='<?=$perthn?>'>
	<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
	<input type=hidden name=perbln1 value='<?=$perbln1?>'>
	<input type=hidden name=perthn1 value='<?=$perthn1?>'>
	<input type=hidden name=today1 value='<?=$today1?>'>
	<input type=submit name=submit2 value='Print Rekap Konfirmasi GOLDAR (.XLS)'>
</form>
<?
mysql_close();
?>
