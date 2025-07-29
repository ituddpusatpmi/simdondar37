<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<link href="modul/thickbox/thickbox.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="modul/thickbox/thickbox.js"></script>
<script type="text/javascript" src="js/kantong.js"></script>


<?
  include('clogin.php');
  include('config/db_connect.php');
?>
<?php
  $hariini = date("Y-m-d");;
?>

<h3 class="list">REKAP PASIEN PLEBOTOMI</h3>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
	<td>Pilih Periode : </td>
	<td>
	<input name="waktu" id="datepicker"  value="<?=$hariini?>" type=text size=10> Sampai Dengan
	<input name="waktu1" id="datepicker1" value="<?=$hariini?>" type=text size=10>
	</td><td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>

<?
if (isset($_POST[submit])){

	$perbln=substr($_POST[waktu],5,2);
	$pertgl=substr($_POST[waktu],8,2);
	$perthn=substr($_POST[waktu],0,4);

	$perbln1=substr($_POST[waktu1],5,2);
	$pertgl1=substr($_POST[waktu1],8,2);
	$perthn1=substr($_POST[waktu1],0,4);
?>
<h3 class="list">Periode <?=$pertgl?>-<?=$perbln?>-<?=$perthn?> sampai dengan <?=$pertgl1?>-<?=$perbln1?>-<?=$perthn1?></h3>

<?
    $data=mysql_query("select transaksi_plebotomi.notransaksi, date(transaksi_plebotomi.tgltransaksi) as tgltransaksi, transaksi_plebotomi.tglaftap, transaksi_plebotomi.rumahsakit,
		   transaksi_plebotomi.dokterpasien, transaksi_plebotomi.diagnosa, transaksi_plebotomi.bagian, transaksi_plebotomi.petugaspenerima,
		   transaksi_plebotomi.aftaper, transaksi_plebotomi.dokterudd, transaksi_plebotomi.biaya, transaksi_plebotomi.nokantong,
		   transaksi_plebotomi.status, transaksi_plebotomi.catatan, transaksi_plebotomi.diambil, pasien_plebotomi.kode, pasien_plebotomi.nama,
		   pasien_plebotomi.alamat, pasien_plebotomi.kota, pasien_plebotomi.kelamin, pasien_plebotomi.lahir, pasien_plebotomi.golda,
		   pasien_plebotomi.rhesus, pasien_plebotomi.jumlah_plebotomi
		   FROM transaksi_plebotomi inner join pasien_plebotomi on pasien_plebotomi.kode=transaksi_plebotomi.kodepasien
		   where date(transaksi_plebotomi.tgltransaksi)>='$_POST[waktu]' and date(transaksi_plebotomi.tgltransaksi)<='$_POST[waktu1]'
		   order by transaksi_plebotomi.tgltransaksi asc");
?>
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>No. Transaksi</td>
		<td>Tanggal</td>
		<td>Kode Pasien</td>
		<td>Nama Pasien</td>
		<td>Diagnosa</td>
		<td>No. Kantong</td>
		<td>Dokter Pasien</td>
		<td>Penerima</td>
		<td>Dokter UDD</td>
		<td>Aftaper</td>
		<td>Status</td>
		<td>Aksi</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		switch ($data1[status]){
                       case "0":
				$status="Belum diambil";break;
                       case "1":
				$status="Berhasil";break;
                       case "2":
				$status="Batal";break;
                       case "3":
				$status="Gagal";break;
		}
	?>
	<tr class="record">
		<td nowrap><?=$no?></td>
		<td nowrap><?=$data1[notransaksi]?></td>
		<td nowrap><?=$data1[tgltransaksi]?></td>
		<td nowrap><?=$data1[kode]?></td>
		<td nowrap align='left'><?=$data1[nama]?></td>
		<td nowrap align='left'><?=$data1[diagnosa]?></td>
		<td nowrap><?=$data1[nokantong]?></td>
		<td nowrap align='left'><?=$data1[dokterpasien]?></td>
		<td nowrap align='left'><?=$data1[petugaspenerima]?></td>
		<td nowrap align='left'><?=$data1[dokterudd]?></td>
		<td nowrap align='left'><?=$data1[aftaper]?></td>
		<td nowrap><?=$status?></td>
		<!--td nowrap><?=$data1[catatan]?></td-->
		<!--td nowrap><input type="button" value="Kwitansi" onClick="document.location.href='pmikasir2.php?module=laporan_pasien_plebotomi';"></td-->
		<td nowrap><a href=notaplebotomy.php?noform=<?=$data1[notransaksi]?>>Kwitansi</a></td>
	</tr>
	<? } ?>
</table>
<br>
<form name=xls method=post action=modul/laporan_pasien_plebotomi_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=waktu1 value='<?=$_POST[waktu1]?>'>
<input type=submit name=submit value='Eksport ke file (.XLS)'>
</form>

<?
}
?>
