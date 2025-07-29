<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<?php
	include('clogin.php');
	include('config/db_connect.php');
	$sv="CREATE VIEW  `hasil_imltd` AS ( select drapidtest.NoTrans AS nomor, drapidtest.tgl_tes AS tanggal, drapidtest.noKantong AS nokantong,
		drapidtest.jenisperiksa AS jenis,drapidtest.nolot AS nomor_lot,drapidtest.Metode AS metode,'0' AS OD,'0' AS COV, drapidtest.Hasil AS hasilperiksa,case when drapidtest.Hasil='0' THEN 'R' ELSE 'NR' END as interpretasi,drapidtest.dicatatoleh AS pemeriksa,
		drapidtest.dicekOleh AS dicek,drapidtest.DisahkanOleh AS disahkan from drapidtest) union (select hasilelisa.notrans AS nomor,hasilelisa.tglPeriksa AS tanggal,hasilelisa.noKantong AS nokantong,hasilelisa.jenisPeriksa AS jenis,hasilelisa.noLot AS nomor_lot,
		hasilelisa.Metode AS metode,hasilelisa.OD AS OD,hasilelisa.COV AS COV,hasilelisa.Hasil AS hasilperiksa,	case when hasilelisa.Hasil='1' THEN 'R' ELSE 'NR' END as interpretasi,hasilelisa.dicatatOleh AS pemeriksa,
		hasilelisa.dicekOleh AS dicek,hasilelisa.DisahkanOleh AS disahkan from hasilelisa)";
	mysql_query($sv);
	$tglsebelum = mktime(0,0,0,date("m"),date("d")-7,date("Y"));
	$tglawal=date("Y-m-d",$tglsebelum);
	$hariini = date("Y-m-d");
?>
<body>
<font size="4" color="red" font-family="Arial">REKAP PEMERIKSAAN UJI SARING DARAH (IMLTD) HARIAN</font><br>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table class="list" cellpadding=1 cellspacing=1>
	<tr class="field">
		<td align="left">Dari tanggal :</td>
		<td><input name="waktu" id="datepicker"  value="<?=$tglawal?>" type=text size=10></td>
		<td align="left">sampai :</td>
		<td><input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10></td>
		<td><input type=submit name=submit class="swn_button_blue" value="Tampilkan"></td>
	</tr>
	</table>
	
</form>

<?
if (isset($_POST[submit])){

	$perbln=substr($_POST[waktu],5,2);
	$pertgl=substr($_POST[waktu],8,2);
	$perthn=substr($_POST[waktu],0,4);

	$perbln1=substr($_POST[waktu1],5,2);
	$pertgl1=substr($_POST[waktu1],8,2);
	$perthn1=substr($_POST[waktu1],0,4);
	$sql="select distinct hasil_imltd.`tanggal`, round(count(hasil_imltd.`nomor`)/4) as jumlah
		from hasil_imltd where (date(hasil_imltd.tanggal)>='$_POST[waktu]' and date(hasil_imltd.tanggal)<='$_POST[waktu1]') group by hasil_imltd.`tanggal`";
    $data=mysql_query($sql);
?>
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Tanggal</td>
		<td>Jumlah Pemeriksaan</td>
		<td>Aksi</td>
	</tr>
	<?php
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
	?>
	<tr class="record">
		<td align="right"><?=$no?>.</td>
		<td align="left"><?=$data1['tanggal']?></td>
		<td align="right"><?=$data1['jumlah']?></td>
		<td>
			<a href=pmilaboratorium.php?module=tampilhasil_imltd_harian&tanggal=<?=$data1[tanggal]?>>Tampilkan hasil</a>
		</td>
	</tr>
	<? } ?>
</table>
</form>
<?}?>
</body>