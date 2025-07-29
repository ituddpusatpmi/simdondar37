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
session_start();
$level_user=$_SESSION['leveluser'];
$tgll=date("Ymd");
$awalbulan=date("Y-m-01");
$hariini = date("Y-m-d");
$jenis=$_GET['jenis'];
$filtertanggal=2;
switch ($jenis){
	case '1' : $lttd="LTTD I";$judul="Laporan Keadaan Donor";$filtertanggal=1;break;
	case '2' : $lttd="LTTD II";$judul="A. Laporan Pengambilan Darah<br>B. Penggunaan Kantong Darah";$filtertanggal=2;break;
	case '3' : $lttd="LTTD III";$judul="A. Laporan Uji Saring Darah<br>B. Laporan Penggunaan Reagensia<br>C. Rujukan Kasus Uji Saring IMLTD";$filtertanggal=2;break;
	case '4' : $lttd="LTTD IV";$judul="Laporan Pengadaan dan Pengeluaran Darah Lengkap serta Komponen Darah";break;
	case '5' : $lttd="LTTD V";$judul="A. Laporan Uji Silang Serasi dan Uji Saring Identifikasi Allo Antibodi<br>B. Laporan Kasus Rujukan Serologi Golongan Darah";break;
	case '6' : $lttd="LTTD VI";$judul="A. Laporan Kendali Mutu <br>B. Kalibrasi Alat";break;
	default : $lttd="?";$judul="?";
}
?>
<font size="6" color="red" font-family="Arial"><?=$lttd?></font><br>			
<font size="4" color="black" font-family="Arial"><?=$judul?></font><br>
<form name="filter" method="POST" action="<?echo $PHPSELF?>">
	<table class="form" cellspacing="0" cellpadding="0">
		<tr>
			<td>Pilih Periode Laporan : </td>
			<td class="input">
				<input class=text name="tgl1" id="datepicker" value="<?=$awalbulan?>" type=text size=10> sampai
				<input class=text name="tgl2" id="datepicker1" value="<?=$hariini?>" type=text size=10>
			</td>
			<td>
				<input type=submit name=submit value="Tampilkan" class="swn_button_blue">
			</td>
		</tr>
	</table>
</form>

<?php
if (isset($_POST[submit])) {
	$tanggalawal = $_POST['tgl1'];
	$tanggalakhir= $_POST['tgl2'];
	switch ($jenis){
		case '1' : $namalaporan="lap_lttd1";break;
		case '2' : $namalaporan="lap_lttd2";break;
		case '3' : $namalaporan="lap_lttd3";break;
		case '4' : $namalaporan="lap_lttd4";break;
		case '5' : $namalaporan="lap_lttd5";break;
		case '6' : $namalaporan="lap_lttd6";break;
	}
	header('location:pmi'.$level_user.'.php?module='.$namalaporan.'&tgl1='.$tanggalawal.'&tgl2='.$tanggalakhir);
}
?>