<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

<?php
ini_set('display_errors', 'On');
$mtime = microtime(); $mtime = explode (" ", $mtime); $mtime = $mtime[1] + $mtime[0]; $tstart = $mtime;
$level_user=$_SESSION['leveluser'];
$tanggalawal=$_GET['tgl1'];
$tanggalakhir=$_GET['tgl2'];
$namaperiode=$_GET['namaperiode'];
$bln1=substr($tanggalawal,5,2);
$tgl1=substr($tanggalawal,8,2);
$thn1=substr($tanggalawal,0,4);
$periode1=$tgl1.'/'.$bln1.'/'.$thn1;
$bln2=substr($tanggalakhir,5,2);
$tgl2=substr($tanggalakhir,8,2);
$thn2=substr($tanggalakhir,0,4);
$periode2=$tgl2.'/'.$bln2.'/'.$thn2;
$labelperiode="Periode : ".$namaperiode." ".$thn1." (".$periode1." s/d ".$periode2.")";
$utd= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
include('laporan/lttd3_proses.php');
?>
<table width="1200px" border="0">
	<tr><td colspan=23 align="center" valign="middle"><font size="5" color=black font-family="Arial">LAPORAN KEGIATAN TEKNIS <?=$utd['nama']?></font></td></tr>
	<tr><td colspan=23 align="center" valign="middle"><font size="4" color=black font-family="Arial"><?=$labelperiode?><br><br></font></td></tr>
	<tr>
		<td colspan=11 align="left"><font size="3" color="black" font-family="Arial">I. LAPORAN UJI SARING DARAH</font>
		<td colspan=12 align="right"><font size="3" color="black" font-family="Arial">LTTD III</font>
	</tr>
</table>

<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="2" width="1200px">
	<tr class=field>
		<th rowspan="4">No</th>
		<th rowspan="4">Keterangan</th>
		<th rowspan="4">Jumlah<br>Donasi</th>
		<th colspan="10">UJI SARING HBsAg</th>
		<th colspan="10">UJI SARING SIFILIS</th>
	</tr>
    <tr class=field>
		<th colspan="4">Jumlah Pemeriksaan</th>
        <th rowspan="3">Jumlah</th>
		<th colspan="4">Hasil Pemeriksaan Reaktif</th>
        <th rowspan="3">Jumlah</th>
        <th colspan="4">Jumlah Pemeriksaan</th>
        <th rowspan="3">Jumlah</th>
		<th colspan="4">Hasil Pemeriksaan Reaktif</th>
        <th rowspan="3">Jumlah</th>
	</tr>
    <tr class=field>
		<th colspan="2">DS</th><th colspan="2">DP</th><th colspan="2">DS</th><th colspan="2">DP</th><th colspan="2">DS</th>
        <th colspan="2">DP</th><th colspan="2">DS</th><th colspan="2">DP</th>
	</tr>
    <tr class=field>
		<th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th><th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th><th>LK</th><th>PR</th>
	</tr>
    <tr class=field>
		<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
        <td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td>
        <td>21</td><td>22</td><td>23</td>
	</tr>
    <tr class=record>
		<td class=input align="left"></td>
        <td class=input align="left">Kelompok Umur</td><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
	</tr>
    <tr class=record>
		<td class=input align="centre">1</td>
        <td class=input align="left">17 - 30 Tahun</td>
        <td class=input align="right"><?=$jum_nr_17?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17?></td>
        <td class=input align="right"><?=$jum_rb_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_rb_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_rb_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_rb_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_rb_17?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17?></td>
        <td class=input align="right"><?=$jum_rs_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_rs_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_rs_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_rs_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_rs_17?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">2</td>
        <td class=input align="left">31 - 40 Tahun</td>
        <td class=input align="right"><?=$jum_nr_31?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_31?></td>
        <td class=input align="right"><?=$jum_rb_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_rb_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_rb_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_rb_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_rb_31?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_31?></td>
        <td class=input align="right"><?=$jum_rs_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_rs_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_rs_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_rs_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_rs_31?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">3</td>
        <td class=input align="left">41 - 50 Tahun</td>
        <td class=input align="right"><?=$jum_nr_41?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_41?></td>
        <td class=input align="right"><?=$jum_rb_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_rb_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_rb_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_rb_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_rb_41?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_41?></td>
        <td class=input align="right"><?=$jum_rs_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_rs_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_rs_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_rs_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_rs_41?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">4</td>
        <td class=input align="left">51 - 60 Tahun</td>
        <td class=input align="right"><?=$jum_nr_51?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_51?></td>
        <td class=input align="right"><?=$jum_rb_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_rb_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_rb_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_rb_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_rb_51?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_51?></td>
        <td class=input align="right"><?=$jum_rs_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_rs_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_rs_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_rs_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_rs_51?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">5</td>
        <td class=input align="left"> > 60 Tahun</td>
        <td class=input align="right"><?=$jum_nr_61?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_61?></td>
        <td class=input align="right"><?=$jum_rb_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_rb_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_rb_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_rb_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_rb_61?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_61?></td>
        <td class=input align="right"><?=$jum_rs_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_rs_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_rs_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_rs_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_rs_61?></td>
	</tr>
    
    <tr class=field>
		<td class=input align="centre"></td>
        <td class=input align="left">JUMLAH</td>
        <td class=input align="right"><?=$jum_nr_17 + $jum_nr_31 + $jum_nr_41 + $jum_nr_51 + $jum_nr_61 ?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk + $jum_nr_31_ds_lk + $jum_nr_41_ds_lk + $jum_nr_51_ds_lk + $jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr + $jum_nr_31_ds_pr + $jum_nr_41_ds_pr + $jum_nr_51_ds_pr + $jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk + $jum_nr_31_dp_lk + $jum_nr_41_dp_lk + $jum_nr_51_dp_lk + $jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr + $jum_nr_31_dp_pr + $jum_nr_41_dp_pr + $jum_nr_51_dp_pr + $jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17 +       $jum_nr_31 +       $jum_nr_41 +       $jum_nr_51 +       $jum_nr_61?></td>
        <td class=input align="right"><?=$jum_rb_17_ds_lk + $jum_rb_31_ds_lk + $jum_rb_41_ds_lk + $jum_rb_51_ds_lk + $jum_rb_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_rb_17_ds_pr + $jum_rb_31_ds_pr + $jum_rb_41_ds_pr + $jum_rb_51_ds_pr + $jum_rb_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_rb_17_dp_lk + $jum_rb_31_dp_lk + $jum_rb_41_dp_lk + $jum_rb_51_dp_lk + $jum_rb_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_rb_17_dp_pr + $jum_rb_31_dp_pr + $jum_rb_41_dp_pr + $jum_rb_51_dp_pr + $jum_rb_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_rb_17       + $jum_rb_31       + $jum_rb_41       + $jum_rb_51       + $jum_rb_61?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk + $jum_nr_31_ds_lk + $jum_nr_41_ds_lk + $jum_nr_51_ds_lk + $jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr + $jum_nr_31_ds_pr + $jum_nr_41_ds_pr + $jum_nr_51_ds_pr + $jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk + $jum_nr_31_dp_lk + $jum_nr_41_dp_lk + $jum_nr_51_dp_lk + $jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr + $jum_nr_31_dp_pr + $jum_nr_41_dp_pr + $jum_nr_51_dp_pr + $jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17       + $jum_nr_31       + $jum_nr_41       + $jum_nr_51       + $jum_nr_61?></td>
        <td class=input align="right"><?=$jum_rs_17_ds_lk + $jum_rs_31_ds_lk + $jum_rs_41_ds_lk + $jum_rs_51_ds_lk + $jum_rs_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_rs_17_ds_pr + $jum_rs_31_ds_pr + $jum_rs_41_ds_pr + $jum_rs_51_ds_pr + $jum_rs_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_rs_17_dp_lk + $jum_rs_31_dp_lk + $jum_rs_41_dp_lk + $jum_rs_51_dp_lk + $jum_rs_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_rs_17_dp_pr + $jum_rs_31_dp_pr + $jum_rs_41_dp_pr + $jum_rs_51_dp_pr + $jum_rs_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_rs_17       + $jum_rs_31       + $jum_rs_41       + $jum_rs_51       + $jum_rs_61?></td>
	</tr>
</table>
<br>
<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="2" width="1200px">
	<tr class=field>
		<th rowspan="4">No</th>
		<th rowspan="4">Keterangan</th>
		<th rowspan="4">Jumlah<br>Donasi</th>
		<th colspan="10">UJI SARING ANTI - HIV / 1/2</th>
		<th colspan="10">UJI SARING Anti-HCV</th>
	</tr>
    <tr class=field>
		<th colspan="4">Jumlah Pemeriksaan</th>
        <th rowspan="3">Jumlah</th>
		<th colspan="4">Hasil Pemeriksaan Reaktif</th>
        <th rowspan="3">Jumlah</th>
        <th colspan="4">Jumlah Pemeriksaan</th>
        <th rowspan="3">Jumlah</th>
		<th colspan="4">Hasil Pemeriksaan Reaktif</th>
        <th rowspan="3">Jumlah</th>
	</tr>
    <tr class=field>
		<th colspan="2">DS</th>
        <th colspan="2">DP</th>
		<th colspan="2">DS</th>
        <th colspan="2">DP</th>
        <th colspan="2">DS</th>
        <th colspan="2">DP</th>
		<th colspan="2">DS</th>
        <th colspan="2">DP</th>
	</tr>
    <tr class=field>
		<th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th>
        <th>LK</th><th>PR</th>
	</tr>
    <tr class=field>
		<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
        <td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td>
        <td>21</td><td>22</td><td>23</td>
	</tr>
    <tr class=record>
		<td class=input align="left"></td>
        <td class=input align="left">Kelompok Umur</td>
        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
        <th></th><th></th><th></th>
	</tr>
    <tr class=record>
		<td class=input align="centre">1</td>
        <td class=input align="left">17 - 30 Tahun</td>
        <td class=input align="right"><?=$jum_nr_17?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17?></td>
        <td class=input align="right"><?=$jum_ri_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_ri_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_ri_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_ri_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_ri_17?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17?></td>
        <td class=input align="right"><?=$jum_rc_17_ds_lk?></td>
        <td class=input align="right"><?=$jum_rc_17_ds_pr?></td>
        <td class=input align="right"><?=$jum_rc_17_dp_lk?></td>
        <td class=input align="right"><?=$jum_rc_17_dp_pr?></td>
        <td class=input align="right"><?=$jum_rc_17?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">2</td>
        <td class=input align="left">31 - 40 Tahun</td>
        <td class=input align="right"><?=$jum_nr_31?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_31?></td>
        <td class=input align="right"><?=$jum_ri_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_ri_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_ri_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_ri_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_ri_31?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_31?></td>
        <td class=input align="right"><?=$jum_rc_31_ds_lk?></td>
        <td class=input align="right"><?=$jum_rc_31_ds_pr?></td>
        <td class=input align="right"><?=$jum_rc_31_dp_lk?></td>
        <td class=input align="right"><?=$jum_rc_31_dp_pr?></td>
        <td class=input align="right"><?=$jum_rc_31?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">3</td>
        <td class=input align="left">41 - 50 Tahun</td>
        <td class=input align="right"><?=$jum_nr_41?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_41?></td>
        <td class=input align="right"><?=$jum_ri_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_ri_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_ri_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_ri_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_ri_41?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_41?></td>
        <td class=input align="right"><?=$jum_rc_41_ds_lk?></td>
        <td class=input align="right"><?=$jum_rc_41_ds_pr?></td>
        <td class=input align="right"><?=$jum_rc_41_dp_lk?></td>
        <td class=input align="right"><?=$jum_rc_41_dp_pr?></td>
        <td class=input align="right"><?=$jum_rc_41?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">4</td>
        <td class=input align="left">51 - 60 Tahun</td>
        <td class=input align="right"><?=$jum_nr_51?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_51?></td>
        <td class=input align="right"><?=$jum_ri_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_ri_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_ri_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_ri_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_ri_51?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_51?></td>
        <td class=input align="right"><?=$jum_rc_51_ds_lk?></td>
        <td class=input align="right"><?=$jum_rc_51_ds_pr?></td>
        <td class=input align="right"><?=$jum_rc_51_dp_lk?></td>
        <td class=input align="right"><?=$jum_rc_51_dp_pr?></td>
        <td class=input align="right"><?=$jum_rc_51?></td>
	</tr>
    <tr class=record>
		<td class=input align="centre">5</td>
        <td class=input align="left"> > 60 Tahun</td>
        <td class=input align="right"><?=$jum_nr_61?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_61?></td>
        <td class=input align="right"><?=$jum_ri_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_ri_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_ri_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_ri_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_ri_61?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_61?></td>
        <td class=input align="right"><?=$jum_rc_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_rc_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_rc_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_rc_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_rc_61?></td>
	</tr>
    
    <tr class=field>
		<td class=input align="centre"></td>
        <td class=input align="left">JUMLAH</td>
        <td class=input align="right"><?=$jum_nr_17 + $jum_nr_31 + $jum_nr_41 + $jum_nr_51 + $jum_nr_61 ?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk + $jum_nr_31_ds_lk + $jum_nr_41_ds_lk + $jum_nr_51_ds_lk + $jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr + $jum_nr_31_ds_pr + $jum_nr_41_ds_pr + $jum_nr_51_ds_pr + $jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk + $jum_nr_31_dp_lk + $jum_nr_41_dp_lk + $jum_nr_51_dp_lk + $jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr + $jum_nr_31_dp_pr + $jum_nr_41_dp_pr + $jum_nr_51_dp_pr + $jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17 +       $jum_nr_31 +       $jum_nr_41 +       $jum_nr_51 +       $jum_nr_61?></td>
        <td class=input align="right"><?=$jum_ri_17_ds_lk + $jum_ri_31_ds_lk + $jum_ri_41_ds_lk + $jum_ri_51_ds_lk + $jum_ri_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_ri_17_ds_pr + $jum_ri_31_ds_pr + $jum_ri_41_ds_pr + $jum_ri_51_ds_pr + $jum_ri_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_ri_17_dp_lk + $jum_ri_31_dp_lk + $jum_ri_41_dp_lk + $jum_ri_51_dp_lk + $jum_ri_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_ri_17_dp_pr + $jum_ri_31_dp_pr + $jum_ri_41_dp_pr + $jum_ri_51_dp_pr + $jum_ri_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_ri_17       + $jum_ri_31       + $jum_ri_41       + $jum_ri_51       + $jum_ri_61?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_lk + $jum_nr_31_ds_lk + $jum_nr_41_ds_lk + $jum_nr_51_ds_lk + $jum_nr_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_ds_pr + $jum_nr_31_ds_pr + $jum_nr_41_ds_pr + $jum_nr_51_ds_pr + $jum_nr_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_lk + $jum_nr_31_dp_lk + $jum_nr_41_dp_lk + $jum_nr_51_dp_lk + $jum_nr_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_nr_17_dp_pr + $jum_nr_31_dp_pr + $jum_nr_41_dp_pr + $jum_nr_51_dp_pr + $jum_nr_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_nr_17       + $jum_nr_31       + $jum_nr_41       + $jum_nr_51       + $jum_nr_61?></td>
        <td class=input align="right"><?=$jum_rc_17_ds_lk + $jum_rc_31_ds_lk + $jum_rc_41_ds_lk + $jum_rc_51_ds_lk + $jum_rc_61_ds_lk?></td>
        <td class=input align="right"><?=$jum_rc_17_ds_pr + $jum_rc_31_ds_pr + $jum_rc_41_ds_pr + $jum_rc_51_ds_pr + $jum_rc_61_ds_pr?></td>
        <td class=input align="right"><?=$jum_rc_17_dp_lk + $jum_rc_31_dp_lk + $jum_rc_41_dp_lk + $jum_rc_51_dp_lk + $jum_rc_61_dp_lk?></td>
        <td class=input align="right"><?=$jum_rc_17_dp_pr + $jum_rc_31_dp_pr + $jum_rc_41_dp_pr + $jum_rc_51_dp_pr + $jum_rc_61_dp_pr?></td>
        <td class=input align="right"><?=$jum_rc_17       + $jum_rc_31       + $jum_rc_41       + $jum_rc_51       + $jum_rc_61?></td>
	</tr>
</table>
<br>
<table width="1200px" border="0"><tr><td colspan=11 align="left"><font size="3" color="black" font-family="Arial">II. LAPORAN PENGGUNAAN REAGENSIA</font></tr></table>
<table class=list border="0" width="1200px">
   <tr><td>
   <table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="2" width="600px">
      <tr class=field><th rowspan="2">No</th><th rowspan="2">Jenis Pemeriksaan</th><th rowspan="2">Jenis Reagensia</th><th rowspan="2" colspan="2">Nama merk reagensia</th><th colspan="5">Keadaan Reagensia</th></tr>
      <tr class=field><th>Sisa Lalu</th><th>Peng<br>gunaan</th><th>Sisa Sekarang</th><th colspan="2">Kadaluarsa</th></tr>
      <tr class=field><th>1</th><th>2</th><th>3</th><th colspan="2">4</th><th>5</th><th>6</th><th>7</th><th colspan="2">8</th></tr>
      <tr class=record><td class=input>1</td><td class=input align="left">HBsAg</td><td class=input align="left">Eia</td><td class=input colspan="2"></td><td class=input></td><td class=input></td><td class=input></td><td class=input colspan="2"></td></tr>
      <tr class=record><td class=input> </th><td class=input align="left"></th><td class=input align="left">Rapid test</th><td class=input colspan="2"></th><td class=input></th><td class=input></th><td class=input></th><td class=input colspan="2"></th></tr>
      <tr class=record><td class=input>2</td><td class=input align="left">Sifilis</td><td class=input align="left">Eia</td><td class=input colspan="2"></td><td class=input></td><td class=input></td><td class=input></td><td class=input colspan="2"></td></tr>
      <tr class=record><td class=input> </th><td class=input align="left"></th><td class=input align="left">Rapid test</th><td class=input colspan="2"></th><td class=input></th><td class=input></th><td class=input></th><td class=input colspan="2"></th></tr>
      <tr class=record><td class=input>3</td><td class=input align="left">Anti HIV 1/2</td><td class=input align="left">Eia</td><td class=input colspan="2"></td><td class=input></td><td class=input></td><td class=input></td><td class=input colspan="2"></td></tr>
      <tr class=record><td class=input> </th><td class=input align="left"></th><td class=input align="left">Rapid test</th><td class=input colspan="2"></th><td class=input></th><td class=input></th><td class=input></th><td class=input colspan="2"></th></tr>
      <tr class=record><td class=input>4</td><td class=input align="left">Anti HCV</td><td class=input align="left">Eia</td><td class=input colspan="2"></td><td class=input></td><td class=input></td><td class=input></td><td class=input colspan="2"></td></tr>
      <tr class=record><td class=input> </th><td class=input align="left"></th><td class=input align="left">Rapid test</th><td class=input colspan="2"></th><td class=input></th><td class=input></th><td class=input></th><td class=input colspan="2"></th></tr>
      <tr class=field><td class=input></td><td class=input align="left">Jumlah</td><td class=input align="left"></td><td class=input colspan="2"></td><td class=input></td><td class=input></td><td class=input></td><td class=input colspan="2"></td></tr>
   </table></td>
   <td class=input align="left"><font size="2" color="black" font-family="Arial">
   Cara pembuangan darah sero positif ( pilih yang sesuai )<br>
   1. Incinerator<br>
   2. Titip RS<br>
   3. Dibakar<br>
   4. Septik tank<br>
   5. Washtafel<br>
   6. Dikubur<br>
   7. Lain-lain, sebutkan : ..................<br></font></td>
   </tr>
</table>
<br>
<table width="1200px" border="0"><tr><td colspan=11 align="left"><font size="3" color="black" font-family="Arial">III. RUJUKAN KASUS UJI SARING IMLTD</font></tr></table>
<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="2" width="600px">
	<tr class=field><th rowspan="2">No</th><th rowspan="2">Jenis Rujukan</th><th rowspan="2">Jumlah</th><th colspan="5">Tempat Rujukan</th><th colspan="2" rowspan="2">Keterangan</th></tr>
    <tr class=field><th>Intern UDD</th><th>UDDC Lain</th><th>UDDD</th><th>UDDP</th><th>BLK/<br>BBLK</th></tr>
    <tr class=field><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th colspan="2">9</th></tr>
    <tr class=record><td>1</td><td align="left">HBsAg</td>	<td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"></td></tr>
    <tr class=record><td>2</td><td align="left">Sifilis</td>	<td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"></td></tr>
    <tr class=record><td>3</td><td align="left">Anti-HCV</td>	<td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"></td></tr>
    <tr class=record><td>4</td><td align="left">Anti HIV</td>	<td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"></td></tr>
    <tr class=record><td>5</td><td align="left">Malaria</td>	<td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"></td></tr>
    <tr class=record><td>6</td><td align="left">Lain-lain</td>	<td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"></td></tr>
    <tr class=field><td></td><td align="left">Jumlah</td>	<td></td><td></td><td></td><td></td><td></td><td></td><td colspan="2"></td></tr>
</table>
<form name=xls method=post action=laporan/lttd3_xls.php>
   <input type=hidden name=tgl1 value='<?=$tanggalawal?>'>
   <input type=hidden name=tgl2 value='<?=$tanggalakhir?>'>
   <input type=hidden name=namaperiode value='<?=$namaperiode?>'>
   <input type=submit name=submit value="Unduh Laporan (.XLS)" class="swn_button_blue">
   <a href="pmi<?=$level_user?>.php?module=laporan&jenis=3" class='swn_button_blue'>Kembali</a>
</form>
<?
$mtime = microtime(); $mtime = explode (" ", $mtime); $mtime = $mtime[1] + $mtime[0]; $tend = $mtime;  $totaltime = ($tend - $tstart);
printf ("Waktu : %.4f detik.", $totaltime); ?>