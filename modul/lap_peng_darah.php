<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

<script type="text/javascript">
function makeFrame() {
	$('#lap_iframe iFrame').remove();
	ifrm = document.createElement("iFrame");
	ifrm.setAttribute("src", "pmiadmin.php?module=lpdr");
	ifrm.style.width = 100+"%";
	ifrm.style.height = 620+"px";
	ifrm.style.border=0;
	document.getElementById('lap_iframe').appendChild(ifrm);
}
</script>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<?
$tgll=date("Ymd"); 
?>
<h3 class="list">Laporan Kegiatan UTD</h3>
<INPUT TYPE="button" name="lpdr" value="Update Terakhir" onClick="makeFrame()">
<INPUT TYPE="button" name="lpdrxls" value="(XLS)" onClick="parent.location='lpdr.php'">
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table>
<tr>
<td>Pilih Periode Laporan : </td>
<td class="input">
<input class=text name="waktu" id="datepicker" type=text size=10>Sampai Dengan
<input class=text name="waktu1" id="datepicker1" type=text size=10>
</td><td>
<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?if (isset($_POST[submit])) {
$today=date("Y-m-d");
?>
<table class=list>
<?
include ('modul/lap_utd.php');
include ('modul/lap_mobile.php');
include ('modul/lap_tromba.php');
include ('modul/lap_leuka.php');
include ('modul/lap_plasma.php');
include ('modul/lap_erito.php');
include ('modul/lap_gagal.php');
include ('modul/lap_plebo.php');
include ('modul/lap_kantong_utd.php');
include ('modul/lap_kantong_mobile.php');

$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);
?>
<h3 class=list>Laporan Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br><br>I. Pengambilan Darah</h3>

<tr class=field><th rowspan="3">No</th><th rowspan="3">Cara / Tempat Pengambilan</th><th colspan="2">Donasi (Kantong)</th>
<th rowspan="3">Jumlah</th><th colspan="8">Golongan Darah (Kantong)</th></tr>
<tr class=field><th rowspan="2">Sukarela</th><th rowspan="2">Pengganti</th><th colspan="2">A</th><th colspan="2">B</th><th colspan="2">O</th><th colspan="2">AB</th></tr>
<tr class=field><th>Rh Pos</th><th>Rh Neg</th><th>Rh Pos</th><th>Rh Neg</th><th>Rh Pos</th><th>Rh Neg</th><th>Rh Pos</th><th>Rh Neg</th></tr>
<tr class=field><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th>
<th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th></tr>

<?$jum1=$utds+$utdp;?>
<tr class="record"><td class=input rowspan="4" align="center">1</td>
<td class=input>Pengambilan Darah cara biasa</td><td class=input colspan="11"></td></tr>
<tr class="record">
<td class=input>Di UTD</td><td class=input><?=$utds?></td><td class=input><?=$utdp?></td><td class=input><?=$jum1?></td>
<td class=input><?=$utdAplus[A]?></td><td class=input><?=$utdAmin[A]?></td>
<td class=input><?=$utdBplus[B]?></td><td class=input><?=$utdBmin[B]?></td>
<td class=input><?=$utdOplus[O]?></td><td class=input><?=$utdOmin[O]?></td>
<td class=input><?=$utdABplus[AB]?></td><td class=input><?=$utdABmin[AB]?></td></tr>
<tr class="record">
<?$jum2=$mobiles+$mobilep;?>
<td class=input>Mobile Unit</td><td class=input><?=$mobiles?></td><td class=input><?=$mobilep?></td><td class=input><?=$jum2?></td>
<td class=input><?=$mobileAplus[A]?></td><td class=input><?=$mobileAmin[A]?></td>
<td class=input><?=$mobileBplus[B]?></td><td class=input><?=$mobileBmin[B]?></td>
<td class=input><?=$mobileOplus[O]?></td><td class=input><?=$mobileOmin[O]?></td>
<td class=input><?=$mobileABplus[AB]?></td><td class=input><?=$mobileABmin[AB]?></td></tr>
<?
$tot_s=$utds+$mobiles;
$tot_p=$utdp+$mobilep;
$tot_jum=$jum1+$jum2;
$tot_Aplus=$utdAplus[A]+$mobileAplus[A];
$tot_Amin=$utdAmin[A]+$mobileAmin[A];
$tot_Bplus=$utdBplus[B]+$mobileBplus[B];
$tot_Bmin=$utdBmin[B]+$mobileBmin[B];
$tot_Oplus=$utdOplus[O]+$mobileOplus[O];
$tot_Omin=$utdOmin[O]+$mobileOmin[O];
$tot_ABplus=$utdABplus[AB]+$mobileABplus[AB];
$tot_ABmin=$utdABmin[AB]+$mobileABmin[AB];
?>
<tr class="record">
<td class=input>Jumlah</td>
<td class=input><?=$tot_s?></td><td class=input><?=$tot_p?></td><td class=input><?=$tot_jum?></td>
<td class=input><?=$tot_Aplus?></td><td class=input><?=$tot_Amin?></td>
<td class=input><?=$tot_Bplus?></td><td class=input><?=$tot_Bmin?></td>
<td class=input><?=$tot_Oplus?></td><td class=input><?=$tot_Omin?></td>
<td class=input><?=$tot_ABplus?></td><td class=input><?=$tot_ABmin?></td></tr>

<?$jum_tromba=$trombas+$trombap;?>
<tr class="record"><td class=input rowspan="6" align="center">2</td>
<td class=input>Pengambilan Darah cara Aferesis</td><td class=input colspan="11"></td></tr>
<tr class="record">
<td class=input>Trombaferesis</td><td class=input><?=$trombas?></td><td class=input><?=$trombap?></td><td class=input><?=$jum_tromba?></td>
<td class=input><?=$trombaAplus[A]?></td><td class=input><?=$trombaAmin[A]?></td>
<td class=input><?=$trombaBplus[B]?></td><td class=input><?=$trombaBmin[B]?></td>
<td class=input><?=$trombaOplus[O]?></td><td class=input><?=$trombaOmin[O]?></td>
<td class=input><?=$trombaABplus[AB]?></td><td class=input><?=$trombaABmin[AB]?></td></tr>

<?$jum_leuka=$leukas+$leukap;?>
<tr class="record">
<td class=input>Leukaferesis</td><td class=input><?=$leukas?></td><td class=input><?=$leukap?></td><td class=input><?=$jum_leuka?></td>
<td class=input><?=$leukaAplus[A]?></td><td class=input><?=$leukaAmin[A]?></td>
<td class=input><?=$leukaBplus[B]?></td><td class=input><?=$leukaBmin[B]?></td>
<td class=input><?=$leukaOplus[O]?></td><td class=input><?=$leukaOmin[O]?></td>
<td class=input><?=$leukaABplus[AB]?></td><td class=input><?=$leukaABmin[AB]?></td></tr>

<?$jum_plasma=$plasmas+$plasmap;?>
<tr class="record">
<td class=input>Plasmaferesis</td><td class=input><?=$plasmas?></td><td class=input><?=$plasmap?></td><td class=input><?=$jum_plasma?></td>
<td class=input><?=$plasmaAplus[A]?></td><td class=input><?=$plasmaAmin[A]?></td>
<td class=input><?=$plasmaBplus[B]?></td><td class=input><?=$plasmaBmin[B]?></td>
<td class=input><?=$plasmaOplus[O]?></td><td class=input><?=$plasmaOmin[O]?></td>
<td class=input><?=$plasmaABplus[AB]?></td><td class=input><?=$plasmaABmin[AB]?></td></tr>

<?$jum_erito=$eritos+$eritop;?>
<tr class="record">
<td class=input>Eritoferesis</td><td class=input><?=$eritos?></td><td class=input><?=$eritop?></td><td class=input><?=$jum_erito?></td>
<td class=input><?=$eritoAplus[A]?></td><td class=input><?=$eritoAmin[A]?></td>
<td class=input><?=$eritoBplus[B]?></td><td class=input><?=$eritoBmin[B]?></td>
<td class=input><?=$eritoOplus[O]?></td><td class=input><?=$eritoOmin[O]?></td>
<td class=input><?=$eritoABplus[AB]?></td><td class=input><?=$eritoABmin[AB]?></td></tr>
<?
$tot_fer_s=$trombas+$leukas+$plasmas+$eritos;
$tot_fer_p=$trombap+$leukap+$plasmap+$eritop;
$tot_fer_jum=$jum_tromba+$jum_leuka+$jum_plasma+$jum_erito;
$tot_fer_Aplus=$trombaAplus[A]+$leukaAplus[A]+$plasmaAplus[A]+$eritoAplus[A];
$tot_fer_Amin=$trombaAmin[A]+$leukaAmin[A]+$plasmaAmin[A]+$eritoAmin[A];
$tot_fer_Bplus=$trombaBplus[B]+$leukaBplus[B]+$plasmaBplus[B]+$eritoBplus[B];
$tot_fer_Bmin=$trombaBmin[B]+$leukaBmin[B]+$plasmaBmin[B]+$eritoBmin[B];
$tot_fer_Oplus=$trombaOplus[O]+$leukaOplus[O]+$plasmaOplus[O]+$eritoOplus[O];
$tot_fer_Omin=$trombaOmin[O]+$leukaOmin[O]+$plasmaOmin[O]+$eritoOmin[O];
$tot_fer_ABplus=$trombaABplus[AB]+$leukaABplus[AB]+$plasmaABplus[AB]+$eritoAplus[AB];
$tot_fer_ABmin=$trombaABmin[AB]+$leukaABmin[AB]+$plasmaABmin[AB]+$eritoABmin[AB];
?>
<tr class="record">
<td class=input>Jumlah</td>
<td class=input><?=$tot_fer_s?></td><td class=input><?=$tot_fer_p?></td><td class=input><?=$tot_fer_jum?></td>
<td class=input><?=$tot_fer_Aplus?></td><td class=input><?=$tot_fer_Amin?></td>
<td class=input><?=$tot_fer_Bplus?></td><td class=input><?=$tot_fer_Bmin?></td>
<td class=input><?=$tot_fer_Oplus?></td><td class=input><?=$tot_fer_Omin?></td>
<td class=input><?=$tot_fer_ABplus?></td><td class=input><?=$tot_fer_ABmin?></td></tr>

<?$jum_gagal=$gagals+$gagalp;?>
<tr class="record"><td class=input align="center">3</td>
<td class=input>Pengambilan Darah Gagal</td><td class=input><?=$gagals?></td><td class=input><?=$gagalp?></td><td class=input><?=$jum_gagal?></td>
<td class=input><?=$gagalAplus[A]?></td><td class=input><?=$gagalAmin[A]?></td>
<td class=input><?=$gagalBplus[B]?></td><td class=input><?=$gagalBmin[B]?></td>
<td class=input><?=$gagalOplus[O]?></td><td class=input><?=$gagalOmin[O]?></td>
<td class=input><?=$gagalABplus[AB]?></td><td class=input><?=$gagalABmin[AB]?></td></tr>
<?
$tot_donasi_s=$tot_s+$tot_fer_s+$gagals;
$tot_donasi_p=$tot_p+$tot_fer_p+$gagalp;
$tot_donasi_jum=$tot_jum+$tot_fer_jum+$jum_gagal;
$tot_donasi_Aplus=$tot_Aplus+$tot_fer_Aplus+$gagalAplus[A];
$tot_donasi_Amin=$tot_Amin+$tot_fer_Amin+$gagalAmin[A];
$tot_donasi_Bplus=$tot_Bplus+$tot_fer_Bplus+$gagalBplus[B];
$tot_donasi_Bmin=$tot_Bmin+$tot_fer_Bmin+$gagalBmin[B];
$tot_donasi_Oplus=$tot_Oplus+$tot_fer_Oplus+$gagalOplus[O];
$tot_donasi_Omin=$tot_Omin+$tot_fer_Omin+$gagalOmin[O];
$tot_donasi_ABplus=$tot_ABplus+$tot_fer_ABplus+$gagalABplus[AB];
$tot_donasi_ABmin=$tot_ABmin+$tot_fer_ABmin+$gagalABmin[AB];
?>

<?$jum_plebo=$plebos+$plebop;?>
<tr class="record"><td class=input align="center">4</td>
<td class=input>Pengambilan Darah Plebotomi</td><td class=input><?=$plebos?></td><td class=input><?=$plebop?></td><td class=input><?=$jum_plebo?></td>
<td class=input><?=$pleboAplus[A]?></td><td class=input><?=$pleboAmin[A]?></td>
<td class=input><?=$pleboBplus[B]?></td><td class=input><?=$pleboBmin[B]?></td>
<td class=input><?=$pleboOplus[O]?></td><td class=input><?=$pleboOmin[O]?></td>
<td class=input><?=$pleboABplus[AB]?></td><td class=input><?=$pleboABmin[AB]?></td></tr>
<?
$tot_donasi_s=$tot_s+$tot_fer_s+$plebos;
$tot_donasi_p=$tot_p+$tot_fer_p+$plebop;
$tot_donasi_jum=$tot_jum+$tot_fer_jum+$jum_plebo;
$tot_donasi_Aplus=$tot_Aplus+$tot_fer_Aplus+$pleboAplus[A];
$tot_donasi_Amin=$tot_Amin+$tot_fer_Amin+$pleboAmin[A];
$tot_donasi_Bplus=$tot_Bplus+$tot_fer_Bplus+$pleboBplus[B];
$tot_donasi_Bmin=$tot_Bmin+$tot_fer_Bmin+$pleboBmin[B];
$tot_donasi_Oplus=$tot_Oplus+$tot_fer_Oplus+$pleboOplus[O];
$tot_donasi_Omin=$tot_Omin+$tot_fer_Omin+$pleboOmin[O];
$tot_donasi_ABplus=$tot_ABplus+$tot_fer_ABplus+$pleboABplus[AB];
$tot_donasi_ABmin=$tot_ABmin+$tot_fer_ABmin+$pleboABmin[AB];
?>

<tr class="field">
<th class=input colspan=2>Jumlah Donasi</td>
<th class=input><?=$tot_donasi_s?></th><th class=input><?=$tot_donasi_p?></th><th class=input><?=$tot_donasi_jum?></th>
<th class=input><?=$tot_donasi_Aplus?></th><th class=input><?=$tot_donasi_Amin?></th>
<th class=input><?=$tot_donasi_Bplus?></th><th class=input><?=$tot_donasi_Bmin?></th>
<th class=input><?=$tot_donasi_Oplus?></th><th class=input><?=$tot_donasi_Omin?></th>
<th class=input><?=$tot_donasi_ABplus?></th><th class=input><?=$tot_donasi_ABmin?></th></tr>

</table>
<br>
<h3 class=list>II. Penggunaan Kantong Darah</h3>
<table class=list>
<tr class=field><th rowspan=2>No</th><th rowspan=2>Tempat Pengambilan</th><th colspan=3>Kantong Single</th><th colspan=2>Kantong Double</th><th colspan=2>Kantong Triple</th><th colspan=2>Kantong Quadruple</th><th rowspan=2>Kantong Prediatik</th></tr>
<tr class=field><th>250 cc</th><th>350 cc</th><th>450 cc</th><th>350 cc</th><th>450 cc</th><th>350 cc</th><th>450 cc</th><th>350 cc</th><th>450 cc</th></tr>

<tr class=record><td class=input>1</td><td class=input>Di UTD</td>
<td class=input><?=$utdsingle250[single250]?></td>
<td class=input><?=$utdsingle350[single350]?></td>
<td class=input><?=$utdsingle450[single450]?></td>
<td class=input><?=$utddouble350[double350]?></td>
<td class=input><?=$utddouble450[double450]?></td>
<td class=input><?=$utdtriple350[triple350]?></td>
<td class=input><?=$utdtriple450[triple450]?></td>
<td class=input><?=$utdquadruple350[quadruple350]?></td>
<td class=input><?=$utdquadruple450[quadruple450]?></td>
<td class=input><?=$utdpediatrik[pediatrik]?></td></tr>

<tr class=record><td class=input>2</td><td class=input>Mobile Unit</td>
<td class=input><?=$mobilesingle250[single250]?></td>
<td class=input><?=$mobilesingle350[single350]?></td>
<td class=input><?=$mobilesingle450[single450]?></td>
<td class=input><?=$mobiledouble350[double350]?></td>
<td class=input><?=$mobiledouble450[double450]?></td>
<td class=input><?=$mobiletriple350[triple350]?></td>
<td class=input><?=$mobiletriple450[triple450]?></td>
<td class=input><?=$mobilequadruple350[quadruple350]?></td>
<td class=input><?=$mobilequadruple450[quadruple450]?></td>
<td class=input><?=$mobilepediatrik[pediatrik]?></td></tr>
<?
$jum_single250=$utdsingle250[single250]+$mobilesingle250[single250];
$jum_single350=$utdsingle350[single350]+$mobilesingle350[single350];
$jum_single450=$utdsingle450[single450]+$mobilesingle450[single450];
$jum_double350=$utddouble350[double350]+$mobiledouble350[double350];
$jum_double450=$utddouble450[double450]+$mobiledouble450[double450];
$jum_triple350=$utdtriple350[triple350]+$mobiletriple350[triple350];
$jum_triple450=$utdtriple450[triple450]+$mobiletriple450[triple450];
$jum_quadruple350=$utdquadruple350[quadruple350]+$mobilequadruple350[quadruple350];
$jum_quadruple450=$utdquadruple450[quadruple450]+$mobilequadruple450[quadruple450];
$jum_pediatrik=$utdpediatrik[pediatrik]+$mobilepediatrik[pediatrik];
?>
<tr class=field><th colspan=2 class=input>Jumlah</th>
<th class=input><?=$jum_single250?></th><th class=input><?=$jum_single350?></th><th class=input><?=$jum_single450?></th>

<th class=input><?=$jum_double350?></th><th class=input><?=$jum_double450?></th>
<th class=input><?=$jum_triple350?></th><th class=input><?=$jum_triple450?></th>
<th class=input><?=$jum_quadruple350?></th><th class=input><?=$jum_quadruple450?></th>
<th class=input><?=$jum_pediatrik?></th></tr>

</table>
<br>
<form name=xls method=post action=modul/lap_peng_darah_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=waktu1 value='<?=$_POST[waktu1]?>'>
<input type=submit name=submit value='Download Laporan (.XLS)'>
</form>
<?
}
?>

<div id="lap_iframe">
</div>
