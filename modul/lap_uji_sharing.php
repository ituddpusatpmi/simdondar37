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
<script type="text/javascript" src="js/tgl_lahir.js"></script>
<script type="text/javascript">
function makeFrame() {
	$('#lap_iframe iFrame').remove();
	ifrm = document.createElement("iFrame");
	ifrm.setAttribute("src", "pmiadmin.php?module=lusr");
	ifrm.style.width = 100+"%";
	ifrm.style.height = 620+"px";
	ifrm.style.border=0;
	document.getElementById('lap_iframe').appendChild(ifrm);
}
</script>
<?
$tgll=date("Ymd"); 
?>

<h3 class="list">Laporan Uji Saring Reaktif</h3>
<INPUT TYPE="button" name="lpdr" value="Update Terakhir" onClick="makeFrame()">
<INPUT TYPE="button" name="lpdrxls" value="(XLS)" onClick="parent.location='lusr.php'">
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table>
<tr>
<td>Pilih Periode : </td>
<td>
<input name="waktu" id="datepicker" type=text size=10> Sampai Dengan
<input name="waktu1" id="datepicker1" type=text size=10>
</td><td>
<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?if (isset($_POST[submit])) {
$today=date("Y-m-d");
include ('modul/lap_hbsag.php');
include ('modul/lap_sifilis.php');
include ('modul/lap_hiv.php');
include ('modul/lap_hcv.php');

$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);
?>
<h3 class="list">Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>
<table class="list">
<tr class="field"><th rowspan=4>No</th><th rowspan=4>Kelompok Umur</th>
<th colspan=10>Uji Saring HBsAg</th><th colspan=10>Uji Saring Syphilis</th></tr>
<tr class="field"><th colspan=5>Jumlah Pemeriksaan Non Reaktif</th><th colspan=5>Hasil Pemeriksaan Reaktif</th>
<th colspan=5>Jumlah Pemeriksaan Non Reaktif</td><td colspan=5>Hasil Pemeriksaan Reaktif</th></tr>
<tr class="field">
<th colspan=2>DS</th><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
<th colspan=2>DS</td><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
<th colspan=2>DS</td><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
<th colspan=2>DS</td><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
</tr>
<tr class="field">
<th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th>
<th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th>
</tr>
<tr class="field">
<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th>
<th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th>
<th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th>
<th>21</th><th>22</th></tr>

<tr class="record"><td>1</td><td>17 - 30 Tahun</td>
<td><?=$hbsag17sp[t17]?></td><td><?=$hbsag17sw[t17]?></td>
<td><?=$hbsag17gp[t17]?></td><td><?=$hbsag17gw[t17]?></td>
<?
$jum_hbsag17=$hbsag17sp[t17]+$hbsag17sw[t17]+$hbsag17gp[t17]+$hbsag17gw[t17];
?>
<td><?=$jum_hbsag17?></td>
<td><?=$hbsag17spr[t17]?></td><td><?=$hbsag17swr[t17]?></td>
<td><?=$hbsag17gpr[t17]?></td><td><?=$hbsag17gwr[t17]?></td>
<?
$jum_hbsagr17=$hbsag17spr[t17]+$hbsag17swr[t17]+$hbsag17gpr[t17]+$hbsag17gwr[t17];
?>
<td><?=$jum_hbsagr17?></td>

<td><?=$sipilis17sp[t17]?></td><td><?=$sipilis17sw[t17]?></td>
<td><?=$sipilis17gp[t17]?></td><td><?=$sipilis17gw[t17]?></td>
<?
$jum_sipilis17=$sipilis17sp[t17]+$sipilis17sw[t17]+$sipilis17gp[t17]+$sipilis17gw[t17];
?>
<td><?=$jum_sipilis17?></td>
<td><?=$sipilis17spr[t17]?></td><td><?=$sipilis17swr[t17]?></td>
<td><?=$sipilis17gpr[t17]?></td><td><?=$sipilis17gwr[t17]?></td>
<?
$jum_sipilisr17=$sipilis17spr[t17]+$sipilis17swr[t17]+$sipilis17gpr[t17]+$sipilis17gwr[t17];
?>
<td><?=$jum_sipilisr17?></td></tr>

<tr class="record"><td>2</td><td>31 - 40 Tahun</td>
<td><?=$hbsag31sp[t31]?></td><td><?=$hbsag31sw[t31]?></td>
<td><?=$hbsag31gp[t31]?></td><td><?=$hbsag31gw[t31]?></td>
<?
$jum_hbsag31=$hbsag31sp[t31]+$hbsag31sw[t31]+$hbsag31gp[t31]+$hbsag31gw[t31];
?>
<td><?=$jum_hbsag31?></td>
<td><?=$hbsag31spr[t31]?></td><td><?=$hbsag31swr[t31]?></td>
<td><?=$hbsag31gpr[t31]?></td><td><?=$hbsag31gwr[t31]?></td>
<?
$jum_hbsagr31=$hbsag31spr[t31]+$hbsag31swr[t31]+$hbsag31gpr[t31]+$hbsag31gwr[t31];
?>
<td><?=$jum_hbsagr31?></td>

<td><?=$sipilis31sp[t31]?></td><td><?=$sipilis31sw[t31]?></td>
<td><?=$sipilis31gp[t31]?></td><td><?=$sipilis31gw[t31]?></td>
<?
$jum_sipilis31=$sipilis31sp[t31]+$sipilis31sw[t31]+$sipilis31gp[t31]+$sipilis31gw[t31];
?>
<td><?=$jum_sipilis31?></td>
<td><?=$sipilis31spr[t31]?></td><td><?=$sipilis31swr[t31]?></td>
<td><?=$sipilis31gpr[t31]?></td><td><?=$sipilis31gwr[t31]?></td>
<?
$jum_sipilisr31=$sipilis31spr[t31]+$sipilis31swr[t31]+$sipilis31gpr[t31]+$sipilis31gwr[t31];
?>
<td><?=$jum_sipilisr31?></td></tr>

<tr class="record"><td>3</td><td>41 - 50 Tahun</td>
<td><?=$hbsag41sp[t41]?></td><td><?=$hbsag41sw[t41]?></td>
<td><?=$hbsag41gp[t41]?></td><td><?=$hbsag41gw[t41]?></td>
<?
$jum_hbsag41=$hbsag41sp[t41]+$hbsag41sw[t41]+$hbsag41gp[t41]+$hbsag41gw[t41];
?>
<td><?=$jum_hbsag41?></td>
<td><?=$hbsag41spr[t41]?></td><td><?=$hbsag41swr[t41]?></td>
<td><?=$hbsag41gpr[t41]?></td><td><?=$hbsag41gwr[t41]?></td>
<?
$jum_hbsagr41=$hbsag41spr[t41]+$hbsag41swr[t41]+$hbsag41gpr[t41]+$hbsag41gwr[t41];
?>
<td><?=$jum_hbsagr41?></td>

<td><?=$sipilis41sp[t41]?></td><td><?=$sipilis41sw[t41]?></td>
<td><?=$sipilis41gp[t41]?></td><td><?=$sipilis41gw[t41]?></td>
<?
$jum_sipilis41=$sipilis41sp[t41]+$sipilis41sw[t41]+$sipilis41gp[t41]+$sipilis41gw[t41];
?>
<td><?=$jum_sipilis41?></td>
<td><?=$sipilis41spr[t41]?></td><td><?=$sipilis41swr[t41]?></td>
<td><?=$sipilis41gpr[t41]?></td><td><?=$sipilis41gwr[t41]?></td>
<?
$jum_sipilisr41=$sipilis41spr[t41]+$sipilis41swr[t41]+$sipilis41gpr[t41]+$sipilis41gwr[t41];
?>
<td><?=$jum_sipilisr41?></td></tr>

<tr class="record"><td>4</td><td>51 - 60 Tahun</td>
<td><?=$hbsag51sp[t51]?></td><td><?=$hbsag51sw[t51]?></td>
<td><?=$hbsag51gp[t51]?></td><td><?=$hbsag51gw[t51]?></td>
<?
$jum_hbsag51=$hbsag51sp[t51]+$hbsag51sw[t51]+$hbsag51gp[t51]+$hbsag51gw[t51];
?>
<td><?=$jum_hbsag51?></td>
<td><?=$hbsag51spr[t51]?></td><td><?=$hbsag51swr[t51]?></td>
<td><?=$hbsag51gpr[t51]?></td><td><?=$hbsag51gwr[t51]?></td>
<?
$jum_hbsagr51=$hbsag51spr[t51]+$hbsag51swr[t51]+$hbsag51gpr[t51]+$hbsag51gwr[t51];
?>
<td><?=$jum_hbsagr51?></td>

<td><?=$sipilis51sp[t51]?></td><td><?=$sipilis51sw[t51]?></td>
<td><?=$sipilis51gp[t51]?></td><td><?=$sipilis51gw[t51]?></td>
<?
$jum_sipilis51=$sipilis51sp[t51]+$sipilis51sw[t51]+$sipilis51gp[t51]+$sipilis51gw[t51];
?>
<td><?=$jum_sipilis51?></td>
<td><?=$sipilis51spr[t51]?></td><td><?=$sipilis51swr[t51]?></td>
<td><?=$sipilis51gpr[t51]?></td><td><?=$sipilis51gwr[t51]?></td>
<?
$jum_sipilisr51=$sipilis51spr[t51]+$sipilis51swr[t51]+$sipilis51gpr[t51]+$sipilis51gwr[t51];
?>
<td><?=$jum_sipilisr51?></td></tr>

<tr class="record"><td>5</td><td> Lebih 60 Tahun</td>
<td><?=$hbsag61sp[t61]?></td><td><?=$hbsag61sw[t61]?></td>
<td><?=$hbsag61gp[t61]?></td><td><?=$hbsag61gw[t61]?></td>
<?
$jum_hbsag61=$hbsag61sp[t61]+$hbsag61sw[t61]+$hbsag61gp[t61]+$hbsag61gw[t61];
?>
<td><?=$jum_hbsag61?></td>
<td><?=$hbsag61spr[t61]?></td><td><?=$hbsag61swr[t61]?></td>
<td><?=$hbsag61gpr[t61]?></td><td><?=$hbsag61gwr[t61]?></td>
<?
$jum_hbsagr61=$hbsag61spr[t61]+$hbsag61swr[t61]+$hbsag61gpr[t61]+$hbsag61gwr[t61];
?>
<td><?=$jum_hbsagr61?></td>

<td><?=$sipilis61sp[t61]?></td><td><?=$sipilis61sw[t61]?></td>
<td><?=$sipilis61gp[t61]?></td><td><?=$sipilis61gw[t61]?></td>
<?
$jum_sipilis61=$sipilis61sp[t61]+$sipilis61sw[t61]+$sipilis61gp[t61]+$sipilis61gw[t61];
?>
<td><?=$jum_sipilis61?></td>
<td><?=$sipilis61spr[t61]?></td><td><?=$sipilis61swr[t61]?></td>
<td><?=$sipilis61gpr[t61]?></td><td><?=$sipilis61gwr[t61]?></td>
<?
$jum_sipilisr61=$sipilis61spr[t61]+$sipilis61swr[t61]+$sipilis61gpr[t61]+$sipilis61gwr[t61];
?>
<td><?=$jum_sipilisr61?></td></tr>
<?
$tot_hbsagsp=$hbsag17sp[t17]+$hbsag31sp[t31]+$hbsag41sp[t41]+$hbsag51sp[t51]+$hbsag61sp[t61];
$tot_hbsagsw=$hbsag17sw[t17]+$hbsag31sw[t31]+$hbsag41sw[t41]+$hbsag51sw[t51]+$hbsag61sw[t61];
$tot_hbsaggp=$hbsag17gp[t17]+$hbsag31gp[t31]+$hbsag41gp[t41]+$hbsag51gp[t51]+$hbsag61gp[t61];
$tot_hbsaggw=$hbsag17gw[t17]+$hbsag31gw[t31]+$hbsag41gw[t41]+$hbsag51gw[t51]+$hbsag61gw[t61];
$tot_hbsag=$jum_hbsag17+$jum_hbsag31+$jum_hbsag41+$jum_hbsag51+$jum_hbsag61;

$tot_hbsagspr=$hbsag17spr[t17]+$hbsag31spr[t31]+$hbsag41spr[t41]+$hbsag51spr[t51]+$hbsag61spr[t61];
$tot_hbsagswr=$hbsag17swr[t17]+$hbsag31swr[t31]+$hbsag41swr[t41]+$hbsag51swr[t51]+$hbsag61swr[t61];
$tot_hbsaggpr=$hbsag17gpr[t17]+$hbsag31gpr[t31]+$hbsag41gpr[t41]+$hbsag51gpr[t51]+$hbsag61gpr[t61];
$tot_hbsaggwr=$hbsag17gwr[t17]+$hbsag31gwr[t31]+$hbsag41gwr[t41]+$hbsag51gwr[t51]+$hbsag61gwr[t61];
$tot_hbsagr=$jum_hbsagr17+$jum_hbsagr31+$jum_hbsagr41+$jum_hbsagr51+$jum_hbsagr61;

$tot_sipilissp=$sipilis17sp[t17]+$sipilis31sp[t31]+$sipilis41sp[t41]+$sipilis51sp[t51]+$sipilis61sp[t61];
$tot_sipilissw=$sipilis17sw[t17]+$sipilis31sw[t31]+$sipilis41sw[t41]+$sipilis51sw[t51]+$sipilis61sw[t61];
$tot_sipilisgp=$sipilis17gp[t17]+$sipilis31gp[t31]+$sipilis41gp[t41]+$sipilis51gp[t51]+$sipilis61gp[t61];
$tot_sipilisgw=$sipilis17gw[t17]+$sipilis31gw[t31]+$sipilis41gw[t41]+$sipilis51gw[t51]+$sipilis61gw[t61];
$tot_sipilis=$jum_sipilis17+$jum_sipilis31+$jum_sipilis41+$jum_sipilis51+$jum_sipilis61;

$tot_sipilisspr=$sipilis17spr[t17]+$sipilis31spr[t31]+$sipilis41spr[t41]+$sipilis51spr[t51]+$sipilis61spr[t61];
$tot_sipilisswr=$sipilis17swr[t17]+$sipilis31swr[t31]+$sipilis41swr[t41]+$sipilis51swr[t51]+$sipilis61swr[t61];
$tot_sipilisgpr=$sipilis17gpr[t17]+$sipilis31gpr[t31]+$sipilis41gpr[t41]+$sipilis51gpr[t51]+$sipilis61gpr[t61];
$tot_sipilisgwr=$sipilis17gwr[t17]+$sipilis31gwr[t31]+$sipilis41gwr[t41]+$sipilis51gwr[t51]+$sipilis61gwr[t61];
$tot_sipilisr=$jum_sipilisr17+$jum_sipilisr31+$jum_sipilisr41+$jum_sipilisr51+$jum_sipilisr61;

?>
<tr class="field"><th colspan=2>JUMLAH</th>
<th><?=$tot_hbsagsp?></th><th><?=$tot_hbsagsw?></th>
<th><?=$tot_hbsaggp?></th><th><?=$tot_hbsaggw?></th>
<th><?=$tot_hbsag?></th>
<th><?=$tot_hbsagspr?></th><th><?=$tot_hbsagswr?></th>
<th><?=$tot_hbsaggpr?></th><th><?=$tot_hbsaggwr?></th>
<th><?=$tot_hbsagr?></th>
<th><?=$tot_sipilissp?></th><th><?=$tot_sipilissw?></th>
<th><?=$tot_sipilisgp?></th><th><?=$tot_sipilisgw?></th>
<th><?=$tot_sipilis?></th>
<th><?=$tot_sipilisspr?></th><th><?=$tot_sipilisswr?></th>
<th><?=$tot_sipilisgpr?></th><th><?=$tot_sipilisgwr?></th>
<th><?=$tot_sipilisr?></th>
</tr>
</table>
<br>
<table class="list">
<tr class="field"><th rowspan=4>No</th><th rowspan=4>Kelompok Umur</th>
<th colspan=10>Uji Saring HIV</th><th colspan=10>Uji Saring HCV</th></tr>
<tr class="field"><th colspan=5>Jumlah Pemeriksaan Non Reaktif</th><th colspan=5>Hasil Pemeriksaan Reaktif</th>
<th colspan=5>Jumlah Pemeriksaan Non Reaktif</th><th colspan=5>Hasil Pemeriksaan Reaktif</th></tr>
<tr class="field">
<th colspan=2>DS</th><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
<th colspan=2>DS</th><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
<th colspan=2>DS</th><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
<th colspan=2>DS</th><th colspan=2>DP</th><th rowspan=2>Jumlah</th>
</tr>
<tr class="field">
<th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th>
<th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th>
</tr>
<tr class="field">
<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th>
<th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th>
<th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th>
<th>21</th><th>22</th></tr>

<tr class="record"><td>1</td><td>17 - 30 Tahun</td>
<td><?=$hiv17sp[t17]?></td><td><?=$hiv17sw[t17]?></td>
<td><?=$hiv17gp[t17]?></td><td><?=$hiv17gw[t17]?></td>
<?
$jum_hiv17=$hiv17sp[t17]+$hiv17sw[t17]+$hiv17gp[t17]+$hiv17gw[t17];
?>
<td><?=$jum_hiv17?></td>
<td><?=$hiv17spr[t17]?></td><td><?=$hiv17swr[t17]?></td>
<td><?=$hiv17gpr[t17]?></td><td><?=$hiv17gwr[t17]?></td>
<?
$jum_hivr17=$hiv17spr[t17]+$hiv17swr[t17]+$hiv17gpr[t17]+$hiv17gwr[t17];
?>
<td><?=$jum_hivr17?></td>

<td><?=$hcv17sp[t17]?></td><td><?=$hcv17sw[t17]?></td>
<td><?=$hcv17gp[t17]?></td><td><?=$hcv17gw[t17]?></td>
<?
$jum_hcv17=$hcv17sp[t17]+$hcv17sw[t17]+$hcv17gp[t17]+$hcv17gw[t17];
?>
<td><?=$jum_hcv17?></td>
<td><?=$hcv17spr[t17]?></td><td><?=$hcv17swr[t17]?></td>
<td><?=$hcv17gpr[t17]?></td><td><?=$hcv17gwr[t17]?></td>
<?
$jum_hcvr17=$hcv17spr[t17]+$hcv17swr[t17]+$hcv17gpr[t17]+$hcv17gwr[t17];
?>
<td><?=$jum_hcvr17?></td></tr>

<tr class="record"><td>2</td><td>31 - 40 Tahun</td>
<td><?=$hiv31sp[t31]?></td><td><?=$hiv31sw[t31]?></td>
<td><?=$hiv31gp[t31]?></td><td><?=$hiv31gw[t31]?></td>
<?
$jum_hiv31=$hiv31sp[t31]+$hiv31sw[t31]+$hiv31gp[t31]+$hiv31gw[t31];
?>
<td><?=$jum_hiv31?></td>
<td><?=$hiv31spr[t31]?></td><td><?=$hiv31swr[t31]?></td>
<td><?=$hiv31gpr[t31]?></td><td><?=$hiv31gwr[t31]?></td>
<?
$jum_hivr31=$hiv31spr[t31]+$hiv31swr[t31]+$hiv31gpr[t31]+$hiv31gwr[t31];
?>
<td><?=$jum_hivr31?></td>

<td><?=$hcv31sp[t31]?></td><td><?=$hcv31sw[t31]?></td>
<td><?=$hcv31gp[t31]?></td><td><?=$hcv31gw[t31]?></td>
<?
$jum_hcv31=$hcv31sp[t31]+$hcv31sw[t31]+$hcv31gp[t31]+$hcv31gw[t31];
?>
<td><?=$jum_hcv31?></td>
<td><?=$hcv31spr[t31]?></td><td><?=$hcv31swr[t31]?></td>
<td><?=$hcv31gpr[t31]?></td><td><?=$hcv31gwr[t31]?></td>
<?
$jum_hcvr31=$hcv31spr[t31]+$hcv31swr[t31]+$hcv31gpr[t31]+$hcv31gwr[t31];
?>
<td><?=$jum_hcvr31?></td></tr>

<tr class="record"><td>3</td><td>41 - 50 Tahun</td>
<td><?=$hiv41sp[t41]?></td><td><?=$hiv41sw[t41]?></td>
<td><?=$hiv41gp[t41]?></td><td><?=$hiv41gw[t41]?></td>
<?
$jum_hiv41=$hiv41sp[t41]+$hiv41sw[t41]+$hiv41gp[t41]+$hiv41gw[t41];
?>
<td><?=$jum_hiv41?></td>
<td><?=$hiv41spr[t41]?></td><td><?=$hiv41swr[t41]?></td>
<td><?=$hiv41gpr[t41]?></td><td><?=$hiv41gwr[t41]?></td>
<?
$jum_hivr41=$hiv41spr[t41]+$hiv41swr[t41]+$hiv41gpr[t41]+$hiv41gwr[t41];
?>
<td><?=$jum_hivr41?></td>

<td><?=$hcv41sp[t41]?></td><td><?=$hcv41sw[t41]?></td>
<td><?=$hcv41gp[t41]?></td><td><?=$hcv41gw[t41]?></td>
<?
$jum_hcv41=$hcv41sp[t41]+$hcv41sw[t41]+$hcv41gp[t41]+$hcv41gw[t41];
?>
<td><?=$jum_hcv41?></td>
<td><?=$hcv41spr[t41]?></td><td><?=$hcv41swr[t41]?></td>
<td><?=$sipilis41gpr[t41]?></td><td><?=$sipilis41gwr[t41]?></td>
<?
$jum_hcvr41=$hcv41spr[t41]+$hcv41swr[t41]+$hcv41gpr[t41]+$hcv41gwr[t41];
?>
<td><?=$jum_hcvr41?></td></tr>

<tr class="record"><td>4</td><td>51 - 60 Tahun</td>
<td><?=$hiv51sp[t51]?></td><td><?=$hiv51sw[t51]?></td>
<td><?=$hiv51gp[t51]?></td><td><?=$hiv51gw[t51]?></td>
<?
$jum_hiv51=$hiv51sp[t51]+$hiv51sw[t51]+$hiv51gp[t51]+$hiv51gw[t51];
?>
<td><?=$jum_hiv51?></td>
<td><?=$hiv51spr[t51]?></td><td><?=$hiv51swr[t51]?></td>
<td><?=$hiv51gpr[t51]?></td><td><?=$hiv51gwr[t51]?></td>
<?
$jum_hivr51=$hiv51spr[t51]+$hiv51swr[t51]+$hiv51gpr[t51]+$hiv51gwr[t51];
?>
<td><?=$jum_hivr51?></td>

<td><?=$hcv51sp[t51]?></td><td><?=$hcv51sw[t51]?></td>
<td><?=$hcv51gp[t51]?></td><td><?=$hcv51gw[t51]?></td>
<?
$jum_hcv51=$hcv51sp[t51]+$hcv51sw[t51]+$hcv51gp[t51]+$hcv51gw[t51];
?>
<td><?=$jum_hcv51?></td>
<td><?=$hcv51spr[t51]?></td><td><?=$hcv51swr[t51]?></td>
<td><?=$hcv51gpr[t51]?></td><td><?=$hcv51gwr[t51]?></td>
<?
$jum_hcvr51=$hcv51spr[t51]+$hcv51swr[t51]+$hcv51gpr[t51]+$hcv51gwr[t51];
?>
<td><?=$jum_hcvr51?></td></tr>

<tr class="record"><td>5</td><td> Lebih 60 Tahun</td>
<td><?=$hiv61sp[t61]?></td><td><?=$hiv61sw[t61]?></td>
<td><?=$hiv61gp[t61]?></td><td><?=$hiv61gw[t61]?></td>
<?
$jum_hiv61=$hiv61sp[t61]+$hiv61sw[t61]+$hiv61gp[t61]+$hiv61gw[t61];
?>
<td><?=$jum_hiv61?></td>
<td><?=$hiv61spr[t61]?></td><td><?=$hiv61swr[t61]?></td>
<td><?=$hiv61gpr[t61]?></td><td><?=$hiv61gwr[t61]?></td>
<?
$jum_hivr61=$hiv61spr[t61]+$hiv61swr[t61]+$hiv61gpr[t61]+$hiv61gwr[t61];
?>
<td><?=$jum_hivr61?></td>

<td><?=$hcv61sp[t61]?></td><td><?=$hcv61sw[t61]?></td>
<td><?=$hcv61gp[t61]?></td><td><?=$hcv61gw[t61]?></td>
<?
$jum_hcv61=$hcv61sp[t61]+$hcv61sw[t61]+$hcv61gp[t61]+$hcv61gw[t61];
?>
<td><?=$jum_hcv61?></td>
<td><?=$hcv61spr[t61]?></td><td><?=$hcv61swr[t61]?></td>
<td><?=$hcv61gpr[t61]?></td><td><?=$hcv61gwr[t61]?></td>
<?
$jum_hcvr61=$hcv61spr[t61]+$hcv61swr[t61]+$hcv61gpr[t61]+$hcv61gwr[t61];
?>
<td><?=$jum_hcvr61?></td></tr>
<?
$tot_hivsp=$hiv17sp[t17]+$hiv31sp[t31]+$hiv41sp[t41]+$hiv51sp[t51]+$hiv61sp[t61];
$tot_hivsw=$hiv17sw[t17]+$hiv31sw[t31]+$hiv41sw[t41]+$hiv51sw[t51]+$hiv61sw[t61];
$tot_hivgp=$hiv17gp[t17]+$hiv31gp[t31]+$hiv41gp[t41]+$hiv51gp[t51]+$hiv61gp[t61];
$tot_hivgw=$hiv17gw[t17]+$hiv31gw[t31]+$hiv41gw[t41]+$hiv51gw[t51]+$hiv61gw[t61];
$tot_hiv=$jum_hiv17+$jum_hiv31+$jum_hiv41+$jum_hiv51+$jum_hiv61;

$tot_hivspr=$hiv17spr[t17]+$hiv31spr[t31]+$hiv41spr[t41]+$hiv51spr[t51]+$hiv61spr[t61];
$tot_hivswr=$hiv17swr[t17]+$hiv31swr[t31]+$hiv41swr[t41]+$hiv51swr[t51]+$hiv61swr[t61];
$tot_hivgpr=$hiv17gpr[t17]+$hiv31gpr[t31]+$hiv41gpr[t41]+$hiv51gpr[t51]+$hiv61gpr[t61];
$tot_hivgwr=$hiv17gwr[t17]+$hiv31gwr[t31]+$hiv41gwr[t41]+$hiv51gwr[t51]+$hiv61gwr[t61];
$tot_hivr=$jum_hivr17+$jum_hivr31+$jum_hivr41+$jum_hivr51+$jum_hivr61;

$tot_hcvsp=$hcv17sp[t17]+$hcv31sp[t31]+$hcv41sp[t41]+$hcv51sp[t51]+$hcv61sp[t61];
$tot_hcvsw=$hcv17sw[t17]+$hcv31sw[t31]+$hcv41sw[t41]+$hcv51sw[t51]+$hcv61sw[t61];
$tot_hcvgp=$hcv17gp[t17]+$hcv31gp[t31]+$hcv41gp[t41]+$hcv51gp[t51]+$hcv61gp[t61];
$tot_hcvgw=$hcv17gw[t17]+$hcv31gw[t31]+$hcv41gw[t41]+$hcv51gw[t51]+$hcv61gw[t61];
$tot_hcv=$jum_hcv17+$jum_hcv31+$jum_hcv41+$jum_hcv51+$jum_hcv61;

$tot_hcvspr=$hcv17spr[t17]+$hcv31spr[t31]+$hcv41spr[t41]+$hcv51spr[t51]+$hcv61spr[t61];
$tot_hcvswr=$hcv17swr[t17]+$hcv31swr[t31]+$hcv41swr[t41]+$hcv51swr[t51]+$hcv61swr[t61];
$tot_hcvgpr=$hcv17gpr[t17]+$hcv31gpr[t31]+$hcv41gpr[t41]+$hcv51gpr[t51]+$hcv61gpr[t61];
$tot_hcvgwr=$hcv17gwr[t17]+$hcv31gwr[t31]+$hcv41gwr[t41]+$hcv51gwr[t51]+$hcv61gwr[t61];
$tot_hcvr=$jum_hcvr17+$jum_hcvr31+$jum_hcvr41+$jum_hcvr51+$jum_hcvr61;

?>
<tr class="field"><th colspan=2>JUMLAH</th>
<th><?=$tot_hivsp?></th><th><?=$tot_hivsw?></th>
<th><?=$tot_hivgp?></th><th><?=$tot_hivgw?></th>
<th><?=$tot_hiv?></th>
<th><?=$tot_hivspr?></th><th><?=$tot_hivswr?></th>
<th><?=$tot_hivgpr?></th><th><?=$tot_hivgwr?></th>
<th><?=$tot_hivr?></th>
<th><?=$tot_hcvsp?></th><th><?=$tot_hcvsw?></th>
<th><?=$tot_hcvgp?></th><th><?=$tot_hcvgw?></th>
<th><?=$tot_hcv?></th>
<th><?=$tot_hcvspr?></th><th><?=$tot_hcvswr?></th>
<th><?=$tot_hcvgpr?></th><th><?=$tot_hcvgwr?></th>
<th><?=$tot_hcvr?></th>
</tr>
</table>
<br>
<form name=xls method=post action=modul/lap_uji_sharing_xls.php>
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
