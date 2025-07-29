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
?>
<table width="1000px" border="0">
	<tr><td colspan=2 align="center" valign="middle"><font size="5" color=black font-family="Arial">LAPORAN KEGIATAN <?=$utd['nama']?></font></td></tr>
	<tr><td colspan=2 align="center" valign="middle"><font size="4" color=black font-family="Arial"><?=$labelperiode?><br><br></font></td></tr>
	<tr>
		<td align="left"><font size="4" color="black" font-family="Arial">A. PENGAMBILAN DARAH DONOR</font>
		<td align="right"><font size="4" color="black" font-family="Arial">LTTD II</font>
	</tr>
</table>
<?php
include('laporan/lttd2_proses.php');
?>

<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="2" width="1000px">
	<tr class=field>
		<th rowspan="3">No</th>
		<th rowspan="3">Cara / Tempat Pengambilan</th>
		<th colspan="2">Donasi (Kantong)</th>
		<th rowspan="3">Jumlah</th>
		<th colspan="8">Golongan Darah (Kantong)</th>
	</tr>
	<tr class=field>
		<th rowspan="2">Sukarela</th>
		<th rowspan="2">Pengganti</th>
		<th colspan="2">A</th>
		<th colspan="2">B</th>
		<th colspan="2">O</th>
		<th colspan="2">AB</th>
	</tr>
	<tr class=field>
		<th>Rh Pos</th>
		<th>Rh Neg</th>
		<th>Rh Pos</th>
		<th>Rh Neg</th>
		<th>Rh Pos</th>
		<th>Rh Neg</th>
		<th>Rh Pos</th>
		<th>Rh Neg</th>
	</tr>
	<tr class=field>
		<th>1</th>
		<th>2</th>
		<th>3</th>
		<th>4</th>
		<th>5</th>
		<th>6</th>
		<th>7</th>
		<th>8</th>
		<th>9</th>
		<th>10</th>
		<th>11</th>
		<th>12</th>
		<th>13</th>
	</tr>
	<tr class=record>
		<td class=input rowspan="5" align="center">1</td>
		<td class=input align="left">Pengambilan darah cara biasa</td>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr class=record>
		<td class=input align="left">a. Di UDD</td>
		<td class=input align="right"><?=$ds_udd?></td>
		<td class=input align="right"><?=$dp_udd?></td>
		<td class=input align="right"><b><?=$tot_udd?></td>
		<td class=input align="right"><?=$udd_a_pos?></td>
		<td class=input align="right"><?=$udd_a_neg?></td>
		<td class=input align="right"><?=$udd_b_pos?></td>
		<td class=input align="right"><?=$udd_b_neg?></td>
		<td class=input align="right"><?=$udd_o_pos?></td>
		<td class=input align="right"><?=$udd_o_neg?></td>
		<td class=input align="right"><?=$udd_ab_pos?></td>
		<td class=input align="right"><?=$udd_ab_neg?></td>
	</tr>
	<tr class=record>
		<td class=input align="left">b. Mobil Unit (<?=$jml_mu?> kegiatan)</td>
		<td class=input align="right"><?=$ds_mu?></td>
		<td class=input align="right"><?=$dp_mu?></td>
		<td class=input align="right"><b><?=$tot_mu?></b></td>
		<td class=input align="right"><?=$mu_a_pos?></td>
		<td class=input align="right"><?=$mu_a_neg?></td>
		<td class=input align="right"><?=$mu_b_pos?></td>
		<td class=input align="right"><?=$mu_b_neg?></td>
		<td class=input align="right"><?=$mu_o_pos?></td>
		<td class=input align="right"><?=$mu_o_neg?></td>
		<td class=input align="right"><?=$mu_ab_pos?></td>
		<td class=input align="right"><?=$mu_ab_neg?></td>
	</tr>
	<tr class=record>
		<td class=input align="left">c. Lain-lain</td>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr class=field>
		<td class=input align="left"><b>Jumlah</b></td>
		<td class=input align="right"><b><?=$ds_udd + $ds_mu?></b></td>
		<td class=input align="right"><b><?=$dp_udd + $dp_mu?></b></td>
		<td class=input align="right"><b><?=$ds_udd + $ds_mu + $dp_udd + $dp_mu?></b></td>
		<td class=input align="right"><b><?=$udd_a_pos + $mu_a_pos?></b></td>
		<td class=input align="right"><b><?=$udd_a_neg + $mu_a_neg?></b></td>
		<td class=input align="right"><b><?=$udd_b_pos + $mu_b_pos?></b></td>
		<td class=input align="right"><b><?=$udd_b_neg + $mu_b_neg?></b></td>
		<td class=input align="right"><b><?=$udd_o_pos + $mu_o_pos?></b></td>
		<td class=input align="right"><b><?=$udd_o_neg + $mu_o_neg?></b></td>
		<td class=input align="right"><b><?=$udd_ab_pos + $mu_ab_pos?></b></td>
		<td class=input align="right"><b><?=$udd_ab_neg + $mu_ab_neg?></b></td>
	</tr>
	<tr class=record>
		<td class=input rowspan="7" align="center">2</td>
		<td class=input align="left"> Pengambilan darah cara Aferesis</td>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr class=record>
		<td class=input align="left">Jenis:</td>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr class=record>
		<td class=input align="left">a. Tromboferesis</td>
		<td class=input align="right"><?=$tro_ds?></td>
		<td class=input align="right"><?=$tro_dp?></td>
		<td class=input align="right"><b><?=$tro_ds + $tro_dp?></b></td>
		<td class=input align="right"><?=$tro_a_pos?></td>
		<td class=input align="right"><?=$tro_a_neg?></td>
		<td class=input align="right"><?=$tro_b_pos?></td>
		<td class=input align="right"><?=$tro_b_neg?></td>
		<td class=input align="right"><?=$tro_o_pos?></td>
		<td class=input align="right"><?=$tro_o_neg?></td>
		<td class=input align="right"><?=$tro_ab_pos?></td>
		<td class=input align="right"><?=$tro_ab_neg?></td>
	</tr>
	<tr class=record>
		<td class=input align="left">b. Leukoferesis</td>
		<td class=input align="right"><?=$leu_ds?></td>
		<td class=input align="right"><?=$leu_dp?></td>
		<td class=input align="right"><b><?=$leu_ds + $leu_dp?></b></td>
		<td class=input align="right"><?=$leu_a_pos?></td>
		<td class=input align="right"><?=$leu_a_neg?></td>
		<td class=input align="right"><?=$leu_b_pos?></td>
		<td class=input align="right"><?=$leu_b_neg?></td>
		<td class=input align="right"><?=$leu_o_pos?></td>
		<td class=input align="right"><?=$leu_o_neg?></td>
		<td class=input align="right"><?=$leu_ab_pos?></td>
		<td class=input align="right"><?=$leu_ab_neg?></td>
	</tr>
	<tr class=record>
		<td class=input align="left">c. Plasmaferesis</td>
		<td class=input align="right"><?=$plas_ds?></td>
		<td class=input align="right"><?=$plas_dp?></td>
		<td class=input align="right"><b><?=$plas_ds + $plas_dp?></b></td>
		<td class=input align="right"><?=$plas_a_pos?></td>
		<td class=input align="right"><?=$plas_a_neg?></td>
		<td class=input align="right"><?=$plas_b_pos?></td>
		<td class=input align="right"><?=$plas_b_neg?></td>
		<td class=input align="right"><?=$plas_o_pos?></td>
		<td class=input align="right"><?=$plas_o_neg?></td>
		<td class=input align="right"><?=$plas_ab_pos?></td>
		<td class=input align="right"><?=$plas_ab_neg?></td>
	</tr>
	<tr class=record>
		<td class=input align="left">d. Eritroferesis</td>
		<td class=input align="right"><?=$eri_ds?></td>
		<td class=input align="right"><?=$eri_dp?></td>
		<td class=input align="right"><b><?=$eri_ds + $eri_dp?></b></td>
		<td class=input align="right"><?=$eri_a_pos?></td>
		<td class=input align="right"><?=$eri_a_neg?></td>
		<td class=input align="right"><?=$eri_b_pos?></td>
		<td class=input align="right"><?=$eri_b_neg?></td>
		<td class=input align="right"><?=$eri_o_pos?></td>
		<td class=input align="right"><?=$eri_o_neg?></td>
		<td class=input align="right"><?=$eri_ab_pos?></td>
		<td class=input align="right"><?=$eri_ab_neg?></td>
	</tr>
	<tr class=field>
		<td class=input align="left"><b>Jumlah</b></td>
		<td class=input align="right"><b><?=$tro_ds + $leu_ds + $plas_ds + $eri_ds?></b></td>
		<td class=input align="right"><b><?=$tro_dp + $leu_dp + $plas_dp + $eri_dp?></b></td>
		<td class=input align="right"><b><?=$tro_ds + $leu_ds + $plas_ds + $eri_ds + $tro_dp + $leu_dp + $plas_dp + $eri_dp?></b></td>
		<td class=input align="right"><b><?=$tro_a_pos + $leu_a_pos + $plas_a_pos + $eri_a_pos?></b></td>
		<td class=input align="right"><b><?=$tro_a_neg + $leu_a_neg + $plas_a_neg + $eri_a_neg?></b></td>
		<td class=input align="right"><b><?=$tro_b_pos + $leu_b_pos + $plas_b_pos + $eri_b_pos?></b></td>
		<td class=input align="right"><b><?=$tro_b_neg + $leu_b_neg + $plas_b_neg + $eri_b_neg?></b></td>
		<td class=input align="right"><b><?=$tro_o_pos + $leu_o_pos + $plas_o_pos + $eri_o_pos?></b></td>
		<td class=input align="right"><b><?=$tro_o_neg + $leu_o_neg + $plas_o_neg + $eri_o_neg?></b></td>
		<td class=input align="right"><b><?=$tro_ab_pos + $leu_ab_pos + $plas_ab_pos + $eri_ab_pos?></b></td>
		<td class=input align="right"><b><?=$tro_ab_neg + $leu_ab_neg + $plas_ab_neg + $eri_ab_neg?></b></td>
	</tr>
	<tr class=record>
		<td class=input align="center">3</td>
		<td class=input align="left">Pengambilan Darah yang Gagal</td>
		<td class=input align="right"><?=$gagal_ds?></td>
		<td class=input align="right"><?=$gagal_dp?></td>
		<td class=input align="right"><b><?=$gagal_ds + $gagal_dp?></b></td>
		<td class=input align="right"><?=$gagal_a_pos?></td>
		<td class=input align="right"><?=$gagal_a_neg?></td>
		<td class=input align="right"><?=$gagal_b_pos?></td>
		<td class=input align="right"><?=$gagal_b_neg?></td>
		<td class=input align="right"><?=$gagal_o_pos?></td>
		<td class=input align="right"><?=$gagal_o_neg?></td>
		<td class=input align="right"><?=$gagal_ab_pos?></td>
		<td class=input align="right"><?=$gagal_ab_neg?></td>
	</tr>
	<tr class=record>
		<td class=input align="center">4</td>
		<td class=input align="left">Pengambilan Darah Plebotomi</td>
		<td class=input align="right"><?=$plebo_ds?></td>
		<td class=input align="right"><?=$plebo_dp?></td>
		<td class=input align="right"><b><?=$plebo_ds + $plebo_dp?></b></td>
		<td class=input align="right"><?=$plebo_a_pos?></td>
		<td class=input align="right"><?=$plebo_a_neg?></td>
		<td class=input align="right"><?=$plebo_b_pos?></td>
		<td class=input align="right"><?=$plebo_b_neg?></td>
		<td class=input align="right"><?=$plebo_o_pos?></td>
		<td class=input align="right"><?=$plebo_o_neg?></td>
		<td class=input align="right"><?=$plebo_ab_pos?></td>
		<td class=input align="right"><?=$plebo_ab_neg?></td>
	</tr>
	<tr class=field>
		<td class=input align="center"></td>
		<td class=input align="left"><b>Jumlah Donasi</b></td>
		<td class=input align="right"><b><?=$ds_udd + $ds_mu +$tro_ds + $leu_ds + $plas_ds + $eri_ds + $gagal_ds + $plebo_ds?></b></td>
		<td class=input align="right"><b><?=$dp_udd + $dp_mu +$tro_dp + $leu_dp + $plas_dp + $eri_dp + $gagal_dp + $plebo_dp?></b></td>
		<td class=input align="right"><b><?=$ds_udd + $ds_mu + $tro_ds + $dp_udd + $dp_mu +$tro_dp + $leu_ds + $plas_ds + $eri_ds + $tro_dp + $leu_dp + $plas_dp + $eri_dp + $gagal_ds + $gagal_dp + $plebo_ds + $plebo_dp?></b></td>
		<td class=input align="right"><b><?=$udd_a_pos + $mu_a_pos + $tro_a_pos + $leu_a_pos + $plas_a_pos + $eri_a_pos + $plebo_a_pos + $gagal_a_pos?></b></td>
		<td class=input align="right"><b><?=$udd_a_neg + $mu_a_neg + $tro_a_neg + $leu_a_neg + $plas_a_neg + $eri_a_neg + $plebo_a_neg + $gagal_a_neg?></b></td>
		<td class=input align="right"><b><?=$udd_b_pos + $mu_b_pos + $tro_b_pos + $leu_b_pos + $plas_b_pos + $eri_b_pos + $plebo_b_pos + $gagal_b_pos?></b></td>
		<td class=input align="right"><b><?=$udd_b_neg + $mu_b_neg + $tro_b_neg + $leu_b_neg + $plas_b_neg + $eri_b_neg + $plebo_b_neg + $gagal_b_neg?></b></td>
		<td class=input align="right"><b><?=$udd_o_pos + $mu_o_pos + $tro_o_pos + $leu_o_pos + $plas_o_pos + $eri_o_pos + $plebo_o_pos + $gagal_o_pos?></b></td>
		<td class=input align="right"><b><?=$udd_o_neg + $mu_o_neg + $tro_o_neg + $leu_o_neg + $plas_o_neg + $eri_o_neg + $plebo_o_neg + $gagal_o_neg?></b></td>
		<td class=input align="right"><b><?=$udd_ab_pos + $mu_ab_pos + $tro_ab_pos + $leu_ab_pos + $plas_ab_pos + $eri_ab_pos + $plebo_ab_pos + $gagal_ab_pos?></b></td>
		<td class=input align="right"><b><?=$udd_ab_neg + $mu_ab_neg + $tro_ab_neg + $leu_ab_neg + $plas_ab_neg + $eri_ab_neg + $plebo_ab_neg + $gagal_ab_neg?></b></td>
	</tr>
</table>
<br><br>
<font size="4" color="black" font-family="Arial">B. PENGGUNAAN KANTONG DARAH</font><br>
<table class=list cellspacing="2" cellpadding="5" style="border-collapse:collapse" border="2" width="1000px">
	<tr class=field>
		<th rowspan=2>No</th>
		<th rowspan=2>Tempat Pengambilan</th>
		<th colspan=2>Kantong Single</th>
		<th colspan=2>Kantong Double</th>
		<th colspan=2>Kantong Triple</th>
		<th colspan=2>Kantong Quadruple</th>
		<th rowspan=2>Kantong<br>Pediatrik</th>
		<th rowspan=2>Kantong<br>Apheresis</th>
		<th rowspan=2>Jumlah</th>
	</tr>
	<tr class=field>
		<th>250 cc</th>
		<th>350 cc</th>
		<th>350 cc</th>
		<th>450 cc</th>
		<th>350 cc</th>
		<th>450 cc</th>
		<th>350 cc</th>
		<th>450 cc</th>
	</tr>
	<tr class=record>
		<td class=input align="centre">1</td>
		<td class=input align="left">Di UDD</td>
		<td class=input align="right"><?=$ktg_udd_250_s?></td>
		<td class=input align="right"><?=$ktg_udd_350_s?></td>
		<td class=input align="right"><?=$ktg_udd_350_d?></td>
		<td class=input align="right"><?=$ktg_udd_450_d?></td>
		<td class=input align="right"><?=$ktg_udd_350_t?></td>
		<td class=input align="right"><?=$ktg_udd_450_t?></td>
		<td class=input align="right"><?=$ktg_udd_350_q?></td>
		<td class=input align="right"><?=$ktg_udd_450_q?></td>
		<td class=input align="right"><?=$ktg_udd_ped?></td>
		<td class=input align="right"><?=$ktg_udd_aph?></td>
		<td class=input align="right"><?=$ktg_udd_250_s + $ktg_udd_350_s + $ktg_udd_350_d + $ktg_udd_450_d + $ktg_udd_350_t + $ktg_udd_450_t +$ktg_udd_450_t + $ktg_udd_350_q + $ktg_udd_450_q + $ktg_udd_ped + $ktg_udd_aph?></td>
	</tr>
	<tr class=record>
		<td class=input align="centre">2</td>
		<td class=input align="left">Di Mobile Unit</td>
		<td class=input align="right"><?=$ktg_mu_250_s?></td>
		<td class=input align="right"><?=$ktg_mu_350_s?></td>
		<td class=input align="right"><?=$ktg_mu_350_d?></td>
		<td class=input align="right"><?=$ktg_mu_450_d?></td>
		<td class=input align="right"><?=$ktg_mu_350_t?></td>
		<td class=input align="right"><?=$ktg_mu_450_t?></td>
		<td class=input align="right"><?=$ktg_mu_350_q?></td>
		<td class=input align="right"><?=$ktg_mu_450_q?></td>
		<td class=input align="right"><?=$ktg_mu_ped?></td>
		<td class=input align="right"><?=$ktg_mu_aph?></td>
		<td class=input align="right"><?=$ktg_mu_250_s + $ktg_mu_350_s + $ktg_mu_350_d + $ktg_mu_450_d + $ktg_mu_350_t + $ktg_mu_450_t +$ktg_mu_450_t + $ktg_mu_350_q + $ktg_mu_450_q + $ktg_mu_ped + $ktg_mu_aph?></td>
	</tr>
	<tr class=record>
		<td class=input align="centre">3</td>
		<td class=input align="left">Lain - lain</td>
		<td class=input align="right"><?=$ktg_ll_250_s?></td>
		<td class=input align="right"><?=$ktg_ll_350_s?></td>
		<td class=input align="right"><?=$ktg_ll_350_d?></td>
		<td class=input align="right"><?=$ktg_ll_450_d?></td>
		<td class=input align="right"><?=$ktg_ll_350_t?></td>
		<td class=input align="right"><?=$ktg_ll_450_t?></td>
		<td class=input align="right"><?=$ktg_ll_350_q?></td>
		<td class=input align="right"><?=$ktg_ll_450_q?></td>
		<td class=input align="right"><?=$ktg_ll_ped?></td>
		<td class=input align="right"><?=$ktg_ll_aph?></td>
		<td class=input align="right"><?=$ktg_ll_250_s + $ktg_ll_350_s + $ktg_ll_350_d + $ktg_ll_450_d + $ktg_ll_350_t + $ktg_ll_450_t +$ktg_ll_450_t + $ktg_ll_350_q + $ktg_ll_450_q + $ktg_ll_ped + $ktg_ll_aph?></td>
	</tr>
	<tr class=field>
		<td class=input align="centre"></td>
		<td class=input align="left">Jumlah Penggunaan</td>
		<td class=input align="right"><?=$ktg_udd_250_s + $ktg_mu_250_s + $ktg_ll_250_s?></td>
		<td class=input align="right"><?=$ktg_udd_350_s + $ktg_mu_350_s + $ktg_ll_350_s?></td>
		<td class=input align="right"><?=$ktg_udd_350_d + $ktg_mu_350_d + $ktg_ll_350_d?></td>
		<td class=input align="right"><?=$ktg_udd_450_d + $ktg_mu_450_d + $ktg_ll_450_d?></td>
		<td class=input align="right"><?=$ktg_udd_350_t + $ktg_mu_350_t + $ktg_ll_350_t?></td>
		<td class=input align="right"><?=$ktg_udd_450_t + $ktg_mu_450_t + $ktg_ll_450_t?></td>
		<td class=input align="right"><?=$ktg_udd_350_q + $ktg_mu_350_q + $ktg_ll_350_q?></td>
		<td class=input align="right"><?=$ktg_udd_450_q + $ktg_mu_450_q + $ktg_ll_450_q?></td>
		<td class=input align="right"><?=$ktg_udd_ped + $ktg_mu_ped + $ktg_ll_ped?></td>
		<td class=input align="right"><?=$ktg_udd_aph + $ktg_mu_aph + $ktg_ll_aph?></td>
		<td class=input align="right"><?=$ktg_udd_250_s + $ktg_udd_350_s + $ktg_udd_350_d + $ktg_udd_450_d + $ktg_udd_350_t + $ktg_udd_450_t +$ktg_udd_450_t + $ktg_udd_350_q + $ktg_udd_450_q + $ktg_udd_ped + $ktg_udd_aph + $ktg_mu_250_s + $ktg_mu_350_s + $ktg_mu_350_d + $ktg_mu_450_d + $ktg_mu_350_t + $ktg_mu_450_t +$ktg_mu_450_t + $ktg_mu_350_q + $ktg_mu_450_q + $ktg_mu_ped + $ktg_mu_aph + $ktg_ll_250_s + $ktg_ll_350_s + $ktg_ll_350_d + $ktg_ll_450_d + $ktg_ll_350_t + $ktg_ll_450_t +$ktg_ll_450_t + $ktg_ll_350_q + $ktg_ll_450_q + $ktg_ll_ped + $ktg_ll_aph?></td>
	</tr>
</table>
<form name=xls method=post action=laporan/lttd2_xls.php>
<input type=hidden name=tgl1 value='<?=$tanggalawal?>'>
<input type=hidden name=tgl2 value='<?=$tanggalakhir?>'>
<input type=hidden name=namaperiode value='<?=$namaperiode?>'>
<input type=submit name=submit value="Unduh Laporan (.XLS)" class="swn_button_blue">
	<a href="pmi<?=$level_user?>.php?module=laporan&jenis=2" class='swn_button_blue'>Kembali</a>
</form><?php
$mtime = microtime(); $mtime = explode (" ", $mtime); $mtime = $mtime[1] + $mtime[0]; $tend = $mtime;  $totaltime = ($tend - $tstart);
printf ("Waktu : %.4f detik.", $totaltime); ?>