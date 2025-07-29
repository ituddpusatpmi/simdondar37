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
<?
include('config/db_connect.php');
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
$namauser=$_SESSION[namauser];
$tahun=date("Y");
$bl=date("m");
if (isset($_POST[submit])) {
	$bln=$_POST['bulan'];	$tahun=$_POST['tahun'];
}
switch ($bl){
	case '1';$b1='Selected';break;case '2';$b2='Selected';break;case '3';$b3='Selected';break;case '4';$b4='Selected';break;case '5';$b5='Selected';break;
	case '6';$b6='Selected';break;case '7';$b7='Selected';break;case '8';$b8='Selected';break;case '9';$b9='Selected';break;case '10';$b10='Selected';break;
	case '11';$b11='Selected';break;case '12';$b12='Selected';break;}
?>
<h2>DAFTAR INSTANSI YANG SUDAH WAKTUNYA DONOR KEMBALI</h2>
<form method=post> 
  <table class="form" cellspacing="0" cellpadding="0">
	<tr><td>Bulan : </td>
		<td class="styled-select"">
			<select name="bulan">
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
				</select>
		<input class="text" style="font-size: 15px;" name="tahun" id="tahun" value="<?=$tahun?>" type="text" size=4 maxlength=4></td>
		<td><input type="submit" name="submit" value="Lihat" class="swn_button_blue"></td></tr>
  </table>
</form>
<?	
	$sq1="select kegiatan.kodeinstansi, detailinstansi.nama, detailinstansi.alamat, detailinstansi.cp, detailinstansi.telp, count(kegiatan.`NoTrans`) as jumlah,
	     max(kegiatan.`TglPenjadwalan`) as terakhir
	     from kegiatan inner join detailinstansi on detailinstansi.kodedetail=kegiatan.kodeinstansi
	     where 
	     YEAR(date_add(`TglPenjadwalan`, INTERVAL 75 DAY)) = '$tahun' AND
	     MONTH(date_add(`TglPenjadwalan`, INTERVAL 75 DAY)) = '$bln'
	     group by kegiatan.kodeinstansi, detailinstansi.nama, detailinstansi.alamat, detailinstansi.cp, detailinstansi.telp";
	//echo "$sq1";
	$ql=mysql_query($sq1);
	$countp=mysql_num_rows($ql);
	echo"<br>Jumlah Data: <b>$countp</b> data";
?>
<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">NAMA</td>
	<td rowspan='2' align="center">ALAMAT</td>
	<td colspan='2' align="center">CP</td>
	<td rowspan='2' align="center">JUMLAH<br>KEGIATAN</td>
        <td rowspan='2' align="center">TANGGAL <br> TERAKHIR DONOR</td>

</tr>
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">Nama</td>
	<td align="center">Telp</td>
</tr>

<?
$no=1;
while ($data=mysql_fetch_array($ql)){
	$qjml="select count(kodeinstansi) as jumlah from kegiatan where kodeinstansi='$data[kodeinstansi]'";
	$qdtjml=mysql_query($qjml);
	$qjmlkegiatan=mysql_fetch_assoc($qdtjml);
	?>
	<tr style="background-color:#FFFAF0; font-size:11px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
		<td align="center"><?=$no?></td>
		<td align="left"><?=$data['nama']?></td>
		<td align="left"><?=$data['alamat']?></td>
		<td align="left"><?=$data['cp']?></td>
		<td align="left"><?=$data['telp']?></td>
		<td align="center"><?=$qjmlkegiatan['jumlah']?> kali</td>
		<td align="left"><?=$data['terakhir']?></td>
	</tr>
	<? $no++;
} ?>
</table>
<br>
<form name=xls method=post action=modul/data_jadwal_mobil_now_new_xls.php>
<input type=hidden name=today value='<?=$today?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=hidden name=NoForm value='<?=$srcform?>'>
<input type=hidden name=produk value='<?=$produk?>'>
<input type=hidden name=user value='<?=$namauser?>'>
<input type=submit name=submit2 value='Print Jadwal Donor Instansi  (.XLS)'>
</form>
<?
mysql_close();
?>
