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
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 5px;font-size: 15px;cursor: pointer; }</style>
<STYLE>
  tr { background-color: #FFF8DC}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: ##FFF8DC }
  .highlight { background-color: #8888FF }
</style>
<?
include('config/db_connect.php');

$level_user=$_SESSION['leveluser'];
$today=date('Y-m-d');
$today1=$today;
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);

?>
<font size="4" color=red font-family="Arial">REKAP RENCANA JADWAL MOBIL UNIT </font><br>
<!--div>
	<form name=sahdarah1 method=post>
	<table class="form" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>Dari Tanggal :<input type=text name=terima1 id=datepicker size=10 value=<?=$today?>></td>
			<td>sampai : <input type=text name=terima2 id=datepicker1 size=10 value=<?=$today1?>></td>
			<td><input type=submit name=submit value=Tampilkan class="swn_button_blue">
		</tr>
	</table>
	</form>
</div-->

<?
$sql_intsansidonor=mysql_query("select * from kegiatan where CAST(TglPenjadwalan as date) >= '$today' order by TglPenjadwalan ASC");
?>
	<table border=1 cellpadding=5 cellspacing=1 width="100%" style="border-collapse:collapse">
		<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
			<td rowspan="2" align="center">NO</td>
			<td rowspan="2" align="center">INSTANSI</td>
			<td rowspan="2" align="center">TANGGAL</td>
			<td rowspan="2" align="center">RENCANA<br>JUMLAH</td>
			<!--td colspan="2" align="center">JENIS PENDONOR</td-->
			<td colspan="6" align="center">PETUGAS</td>
			<td rowspan="2" align="center">KENDARAAN</td>
        </tr>
		<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
			<td align="center">DOKTER</td>
			<td align="center">TENSI</td>
			<td align="center">HB</td>
			<td align="center">AFTAPER</td>
			<td align="center">ADMIN</td>
			<td align="center">SOPIR</td>
        </tr>
	<?
	$no=0;
	while($data=mysql_fetch_assoc($sql_intsansidonor)){
		$no++;
	$instansi=mysql_fetch_assoc(mysql_query("select nama from detailinstansi where KodeDetail='$data[kodeinstansi]'"));
		?>
		<tr style="font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
			<td align="left"><?=$no?>.</td>
			<td align="left" class=input><?=$instansi[nama]?></td>
			<td align="left" class=input><?=$data[TglPenjadwalan]?></td>
			<td align="left" class=input><?=$data[jumlah]?> Org</td>
			<!--dokter-->
			<?
			$dokter=mysql_fetch_array(mysql_query("select nama from petugasmu where NoTrans='$data[NoTrans]' AND jabatan='1'"));
			?>

			<td align="left" class=input><?=$dokter[nama]?></td>
			<td align="left" class=input><?=$data[atd2]?></td>
			<td align="left" class=input><?=$data[atd1]?></td>
			<td align="left" class=input><?=$data[atd3]?></td>
			<td align="left" class=input><?=$data[admin]?></td>
			<td align="left" class=input><?=$data[sopir]?></td>
	<?
	$kendaraan='BUS MU';
	if ($data[kendaraan]=='1') $kendaraan='MOBIL MU';
		?>
			<td align="left" class=input><?=$kendaraan?></td>
		
		</tr>
	<?
	}?>
	</table>
<br>
</br>

<form name=xls method=post action=modul/rekap_rencana_jadwal_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit value='Print Rekap rencana jadwal MU (.XLS)'>
</form>

