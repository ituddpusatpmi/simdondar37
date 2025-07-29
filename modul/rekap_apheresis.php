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
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<STYLE>
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
</style>
<?
include('config/db_connect.php');
$today=date('Y-m-01');
$today1=date('Y-m-d');


if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];

if ($_POST[gol]!=''){$gol=$_POST[gol];}else{$gol='%%';}
if ($_POST[rh]!=''){$rh=$_POST[rh];}else{$rh='%%';}
if ($_POST[mesin1]!=''){$mesin=$_POST[mesin1];}else{$mesin='%';}
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);
?>
<font size="5" color=red font-family="Arial">REKAP DONOR APHERESIS <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> s/d <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?></font><br>
<div>
	<form namme=rekap method=post>
	<table class="form" border="0" cellspacing="0" cellpadding="0">
		<tr">
			<td>Dari Tanggal :<input type=text name=minta1 id=datepicker size=10 value=<?=$today?>></td>
			<td>sampai : <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>></td>
			<td class="styled-select">Gol : <select name="gol">
				<option value="%%">Semua</option>
				<option value="%A%">A</option>
				<option value="%B%">B</option>
				<option value="%AB%">AB</option>
				<option value="%O%">O</option>
			</select></td>
			<td class="styled-select">Rh : <select name="rh">
				<option value="%%">Semua</option>
				<option value="%-%">Rh(-)</option>
				<option value="%+%">Rh(+)</option>
			</select></td>
			<td class="styled-select">Mesin :<select name="mesin1">
				<option value="%%">Semua</option>
				<option value="%Amicus%">Amicus</option>				
				<option value="%Com.Tech%">Com.Tech</option>
				<option value="%Trima.Acell%">Trima.Acell</option>
			</select></td>
			<td><input type=submit name=submit value=Tampilkan class="swn_button_blue"></td>
		</tr>
	</table>
	</form>
</div>
<br>
<table border=1 cellpadding=3 cellspacing=1 width="100%">
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<td align="center">NO</td>
	<td align="center">TANGGAL</td>
	<td align="center">JAM</td>
	<td align="center">KODE PENDONOR</td>
	<td align="center">NAMA DONOR</td>
	<td align="center">GOL<BR>ABO/RH</td>
	<td align="center">NO. KANTONG</td>
	<td align="center">VOL</td>
	<td align="center">HEMATO<br>KRIT</td>
	<td align="center">HB</td>
	<td align="center">TROMBO</td>
	<td align="center">LEUKO</td>
	<td align="center">AFTAP</td>
	<td align="center">STATUS</td>
	<td align="center">AFTAPER</td>
	<td align="center">MESIN<BR>APHERESIS</td>
        </tr>
<?
$no=1;
$sq="select * from htransaksi where apheresis='1' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and status=2
	and gol_darah like '$gol' and rhesus like '$rh' and mesin_apheresis like '$mesin' order by tgl";
$sq_aph=mysql_query($sq);
$rec=mysql_num_rows($sq_aph);
while($data=mysql_fetch_assoc($sq_aph)){
	$qdnr=mysql_query("select * from pendonor where kode='$data[KodePendonor]'");
	$dt_donor=mysql_fetch_assoc($qdnr);
	switch ($data[Pengambilan]){
		case '0':$pengambilan='Berhasil';break;
		case '1':$pengambilan='Batal';break;
		case '2':$pengambilan='Gagal';break;
	}
	switch ($data[caraAmbil]){
		case '0':$caraambil='Biasa';break;
		case '1':$caraambil='Tromboferesis';break;
		case '2':$caraambil='Leukaferesis';break;
		case '3':$caraambil='Plasmaferesis';break;
		case '4':$caraambil='Eritoferesis';break;
		case '5':$caraambil='Plebotomi';break;
	}
	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align="right"><?=$no++?>.</td>
		<td class=input><?=substr($data['Tgl'],0,11)?></td>
		<td class=input><?=substr($data['Tgl'],11,5)?></td>
		<td class=input><?=$data[KodePendonor]?></td>
		<td class=input><?=$dt_donor[Nama]?></td>
		<td class=input align="center"><?=$data[gol_darah]?>(<?=$data[rhesus]?>)</td>
		<td class=input><?=$data[NoKantong]?></td>
		<td class=input align="center"><?=$data[Diambil]?></td>
		<td class=input align="center"><?=$data[hematokrit]?></td>
		<td class=input align="center"><?=$data[hemoglobin]?></td>
		<td class=input align="center"><?=$data[trombosit]?></td>
		<td class=input align="center"><?=$data[leukosit]?></td>
		<td class=input><?=$caraambil?></td>
		<td class=input><?=$pengambilan?></td>
		<td class=input><?=$data[petugas]?></td>
		<td class=input><?=$data[mesin_apheresis]?></td>
	</tr>
<?
}
?>
</table>
<form name=xls method=post action=modul/rekap_apheresis_xls.php>
	<input type=hidden name=pertgl value='<?=$pertgl?>'>
	<input type=hidden name=perbln value='<?=$perbln?>'>
	<input type=hidden name=perthn value='<?=$perthn?>'>
	<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
	<input type=hidden name=perbln1 value='<?=$perbln1?>'>
	<input type=hidden name=perthn1 value='<?=$perthn1?>'>
	<input type=hidden name=today1 value='<?=$today1?>'>
	<input type=hidden name=golongan value='<?=$gol?>'>
	<input type=hidden name=rhesus value='<?=$rh?>'>
	<input type=hidden name=mesin_aph value='<?=$mesin?>'>
	<input type=submit name=submit2 value='Ekspor ke XLS' class="swn_button_blue">
</form>
<?
mysql_close();
?>
