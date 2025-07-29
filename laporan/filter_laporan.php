<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
<?php
function lastday($month = '', $year = '') {
   if (empty($month)) {$month = date('m');}
   if (empty($year)) {$year = date('Y');}
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('Y-m-d', $result);}
function firstDay($month = '', $year = ''){
   if (empty($month)) {$month = date('m');}
   if (empty($year)) {$year = date('Y');}
   $result = strtotime("{$year}-{$month}-01");
   return date('Y-m-d', $result);}
session_start();$b1='';$b2='';$b3='';$b4='';$b5='';$b6='';$b7='';$b8='';$b8='';$b10='';$b11='';$b12='';
$level_user=$_SESSION['leveluser'];$tgll=date("Ymd");$tahun=date("Y");$bl=date("m");$awalbulan=date("Y-m-01");$hariini = date("Y-m-d");$jenis=$_GET['jenis'];$filtertanggal=2;
switch ($bl){
	case '01';$b1='Selected';break;case '02';$b2='Selected';break;case '03';$b3='Selected';break;case '04';$b4='Selected';break;case '05';$b5='Selected';break;
	case '06';$b6='Selected';break;case '07';$b7='Selected';break;case '08';$b8='Selected';break;case '09';$b9='Selected';break;case '10';$b10='Selected';break;
	case '11';$b11='Selected';break;case '12';$b12='Selected';break;}
switch ($jenis){
	case '1' : $lttd="LTTD I";$judul="Laporan Keadaan Donor";$filtertanggal=1;break;
	case '2' : $lttd="LTTD II";$judul="A. Laporan Pengambilan Darah<br>B. Penggunaan Kantong Darah";$filtertanggal=2;break;
	case '3' : $lttd="LTTD III";$judul="A. Laporan Uji Saring Darah<br>B. Laporan Penggunaan Reagensia<br>C. Rujukan Kasus Uji Saring IMLTD";$filtertanggal=2;break;
	case '4' : $lttd="LTTD IV";$judul="Laporan Pengadaan dan Pengeluaran Darah Lengkap serta Komponen Darah";break;
	case '5' : $lttd="LTTD V";$judul="A. Laporan Uji Silang Serasi dan Uji Saring Identifikasi Allo Antibodi<br>B. Laporan Kasus Rujukan Serologi Golongan Darah";break;
	case '6' : $lttd="LTTD VI";$judul="A. Laporan Kendali Mutu <br>B. Kalibrasi Alat";break;
        case '7' : $lttd="Laporan";$judul="PEMAKAIAN BUS DONOR PMI";break;
	default : $lttd="?";$judul="?";}
?>
<font size="6" color="red" font-family="Arial"><?=$lttd?></font><br>			
<font size="4" color="black" font-family="Arial"><?=$judul?></font><br>
<form name="filter" method="POST" action="<?echo $PHPSELF?>">
	<table class="form" cellspacing="0" cellpadding="0">
		<tr><td>Pilih Periode Laporan : </td>
			<td class="styled-select"">
				<select name="modelperiod">
					<option value="1" <?=$b1?>>Bulan Januari</option>
					<option value="2" <?=$b2?>>Bulan Februari</option>
					<option value="3" <?=$b3?>>Bulan Maret</option>
					<option value="4" <?=$b4?>>Bulan April</option>
					<option value="5" <?=$b5?>>Bulan Mei</option>
					<option value="6" <?=$b6?>>Bulan Juni</option>
					<option value="7" <?=$b7?>>Bulan Juli</option>
					<option value="8" <?=$b8?>>Bulan Agustus</option>
					<option value="9" <?=$b9?>>Bulan September</option>
					<option value="10" <?=$b10?>>Bulan Oktober</option>
					<option value="11" <?=$b11?>>Bulan November</option>
					<option value="12" <?=$b12?>>Bulan Desember</option>
					<option value="31">Triwulan I</option>
					<option value="32">Triwulan II</option>
					<option value="33">Triwulan III</option>
					<option value="34">Triwulan IV</option>
					<option value="61">Semester I</option>
					<option value="62">Semester II</option>
					<option value="121">Tahun</option>
					</select>
				<input class="text" style="font-size: 15px;" name="tahun" id="tahun" value="<?=$tahun?>" type="text" size=4 maxlength=4></td>
			<td><input type=submit name=submit value="Tampilkan" class="swn_button_blue"></td></tr>
	</table>
</form>
<?php
if (isset($_POST[submit])) {
	$model=$_POST['modelperiod'];	$tahun=$_POST['tahun'];	$namaperiode="";
	switch ($model){
		case '1' : $tanggalawal=firstDay(1,$tahun);$tanggalakhir=lastday(1,$tahun);$namaperiode="Bulan Januari";break;
		case '2' : $tanggalawal=firstDay(2,$tahun);$tanggalakhir=lastday(2,$tahun);$namaperiode="Bulan Februari";break;
		case '3' : $tanggalawal=firstDay(3,$tahun);$tanggalakhir=lastday(3,$tahun);$namaperiode="Bulan Maret";break;
		case '4' : $tanggalawal=firstDay(4,$tahun);$tanggalakhir=lastday(4,$tahun);$namaperiode="Bulan April";break;
		case '5' : $tanggalawal=firstDay(5,$tahun);$tanggalakhir=lastday(5,$tahun);$namaperiode="Bulan Mei";break;
		case '6' : $tanggalawal=firstDay(6,$tahun);$tanggalakhir=lastday(6,$tahun);$namaperiode="Bulan Juni";break;
		case '7' : $tanggalawal=firstDay(7,$tahun);$tanggalakhir=lastday(7,$tahun);$namaperiode="Bulan Juli";break;
		case '8' : $tanggalawal=firstDay(8,$tahun);$tanggalakhir=lastday(8,$tahun);$namaperiode="Bulan Agustus";break;
		case '9' : $tanggalawal=firstDay(9,$tahun);$tanggalakhir=lastday(9,$tahun);$namaperiode="Bulan September";break;
		case '10' : $tanggalawal=firstDay(10,$tahun);$tanggalakhir=lastday(10,$tahun);$namaperiode="Bulan Oktober";break;
		case '11' : $tanggalawal=firstDay(11,$tahun);$tanggalakhir=lastday(11,$tahun);$namaperiode="Bulan November";break;
		case '12' : $tanggalawal=firstDay(12,$tahun);$tanggalakhir=lastday(12,$tahun);$namaperiode="Bulan Desember";break;
		case '31' : $tanggalawal=firstDay(1,$tahun);$tanggalakhir=lastday(3,$tahun);$namaperiode="Triwulan I Tahun";break;
		case '32' : $tanggalawal=firstDay(4,$tahun);$tanggalakhir=lastday(6,$tahun);$namaperiode="Triwulan II Tahun";break;
		case '33' : $tanggalawal=firstDay(7,$tahun);$tanggalakhir=lastday(9,$tahun);$namaperiode="Triwulan III Tahun";break;
		case '34' : $tanggalawal=firstDay(10,$tahun);$tanggalakhir=lastday(12,$tahun);$namaperiode="Triwulan IV Tahun";break;
		case '61' : $tanggalawal=firstDay(1,$tahun);$tanggalakhir=lastday(6,$tahun);$namaperiode="Semester I Tahun";break;
		case '62' : $tanggalawal=firstDay(7,$tahun);$tanggalakhir=lastday(12,$tahun);$namaperiode="Semester II Tahun";break;
		case '121' : $tanggalawal=firstDay(1,$tahun);$tanggalakhir=lastday(12,$tahun);$namaperiode="Tahun";break;}
	switch ($jenis){
		case '1' : $namalaporan="lap_lttd1";break;
		case '2' : $namalaporan="lap_lttd2";break;
		case '3' : $namalaporan="lap_lttd3";break;
		case '4' : $namalaporan="lap_lttd4";break;
		case '5' : $namalaporan="lap_lttd5";break;
		case '6' : $namalaporan="lap_lttd6";break;
		case '7' : $namalaporan="rekap_bus";break;}
	header('location:pmi'.$level_user.'.php?module='.$namalaporan.'&tgl1='.$tanggalawal.'&tgl2='.$tanggalakhir.'&namaperiode='.$namaperiode);
}
?>