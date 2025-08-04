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
<script type="text/javascript">
  jQuery(document).ready(function(){
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});});
  </script>

<? $namauser=$_SESSION[namauser];?>
<h1 class="table">Laporan Transaksi Donor Darah</h1>
<form name="dinstansi" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Tanggal Transaksi : </td>
<td>
<input class=input name="waktu" id="datepicker" type=text size=10 autocomplete=off>
</td></tr>
<tr><td>Instansi:</td><td><input type='text' name="instansi" id='instansi'></td></tr>
</table>
<input type=submit name=submit value="Search">
</form>
<?if (isset($_POST[submit])) {
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);
$perbln1=substr($_POST[waktu],5,2);
$pertgl1=substr($_POST[waktu],8,2);
$perthn1=substr($_POST[waktu],0,4);
$date=$_POST[waktu];

$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));



$kegtgl=date("d",strtotime($date));
$kegbln=date("n",strtotime($date));
$kegth=date("Y",strtotime($date));
$nmbln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnkeg=$nmbln[$kegbln];


$namahari1 = date('l', strtotime($date));
if ($namahari1 == "Sunday") $namahari1 = "Minggu";
else if ($namahari1 == "Monday") $namahari1 = "Senin";
else if ($namahari1 == "Tuesday") $namahari1 = "Selasa";
else if ($namahari1 == "Wednesday") $namahari1 = "Rabu";
else if ($namahari1 == "Thursday") $namahari1 = "Kamis";
else if ($namahari1 == "Friday") $namahari1 = "Jumat";
else if ($namahari1 == "Saturday") $namahari1 = "Sabtu";
//$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
//$bln21=$bulan[$perbln];

?>
<h1 class="table">Kegiatan : <?=$namahari1?>, <?=$kegtgl?> - <?=$blnkeg?> - <?=$kegth?> <br> <br>
Instansi : <?=$nama[Instansi]?></h1>
<table class=form border=1 cellpadding=0 cellspacing=0>
          <td>No</td>
	  <td>Tgl Donor</td>
          <td>Kode Pendonor</td>
          <td>Nama</td>
          <td>Alamat</td>
	  <td>Telp</td>
          <td>Jenis Donor</td>
          <td>Gol Darah</td>
	  <td>Rhesus</td>
	  <td>Donor Ke</td>
          <td>Reaksi</td>
          <td>Catatan</td>
          <td>No Kantong</td>
        </tr>
<?
$no=1;
$trans0=mysql_query("select * from htransaksi
		where CAST(Tgl as date)='$_POST[waktu]' and 
		Instansi='$_POST[instansi]' order by gol_darah ASC");
while ($trans=mysql_fetch_assoc($trans0)) {

$bln=substr($trans[Tgl],5,2);
$tgl=substr($trans[Tgl],8,2);
$thn=substr($trans[Tgl],0,4);
$tanggal=$pertgl."-". $perbln."-". $perthn;
?>
<tr class="record">
	<td class=input><?=$no++?></td>
      	<td class=input><?=$tanggal?></td>
<?
$trans1=mysql_fetch_assoc(mysql_query("select Nama,Alamat,telp2 from pendonor where Kode='$trans[KodePendonor]'"));
?>
      	<td class=input><?=$trans[KodePendonor]?></td>
	<td class=input><?=$trans1[Nama]?></td>
	<td class=input><?=$trans1[Alamat]?></td>
	<td class=input><?=$trans1[telp2]?></td>
<?
if ($trans[JenisDonor]=='0') { $jenis="Sukarela"; } else { $jenis="Pengganti"; }
?>
      	<td class=input><?=$jenis?></td>
      	<td class=input><?=$trans[gol_darah]?></td>
<?
if ($trans[rhesus]=='+') { $rhesus="Positif"; } else { $rhesus="Negatif"; }
?>

	<td class=input><?=$rhesus?></td>
	<td class=input><?=$trans[donorke]?></td>
<?
if ($trans[Reaksi]=='3') { $reaksi="Lain-lain"; }
switch ($trans[Pengambilan]) {
	case "0":
		$pengambilan="Berhasil";
		break;
	case "1":
		$pengambilan="Batal";
		break;
	case "2":
		$pengambilan="Gagal";
		break;
	default:
		$pengambilan="-";
}
?>
      <td class=input><?=$reaksi?></td>
      <td class=input><?=$pengambilan?></td>
      <td class=input><?=$trans[NoKantong]?></td>
	</tr>
<?

}
?>
</table>
<?
$jum=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0'"));
$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='2'"));
$golA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0' and gol_darah='A'"));
$golB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0' and gol_darah='B'"));
$golAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0' and gol_darah='AB'"));
$golO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0' and gol_darah='O'"));
$golX=mysql_fetch_assoc(mysql_query("select count(gol_darah) as X from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0' and gol_darah='X'"));


$jkP=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0' and jk='0' "));

$jkW=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi  where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0' and jk='1'"));
?>
<br>
<table><tr>
<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr class="field">
<td>Gol Darah </td>
<td>Jum Pendonor </td>
</tr>
<tr><td> A </td>
<td class=input><?=$golA[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$golB[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$golAB[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$golO[O]?></td></tr>
<tr><td>X</td>
<td class=input><?=$golX[X]?></td></tr>
<tr><td> Total Pendonor </td>
<td class=input><?=$golA[A]+$golB[B]+$golAB[AB]+$golO[O]+$golX[X]?></td>
</tr>
</table>
</td>
<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr class="field">
<td>Jenis Kelamin </td>
<td>Jum Pendonor </td>
</tr>
<tr><td>Laki - Laki</td>
<td class=input><?=$jkP[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW[W]?></td></tr>
<tr><td> Total Pendonor </td>
<td class=input><?=$jkP[P]+$jkW[W]?></td>
</tr>
</table>
</td><td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr class="field">
<td>Keterangan </td>
<td>Jum Pendonor </td>
</tr>
<tr><td>Batal</td>
<td class=input><?=$jumbat[kod]?></td></tr>
<tr><td>Gagal</td>
<td class=input><?=$jumgal[kod]?></td></tr>
</table>
</td>
</tr>
</table>
</br>
<table>
<form name=xls method=post action=modul/lap_transaksi_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=instansi value='<?=$_POST[instansi]?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=user value='<?=$namauser?>'>
<input type=submit name=submit2 value='Print Lap Transaksi Mobile Unit (.XLS)'>
</form>
</table>
<table>
<form name=xls method=post action=modul/lap_transaksi_xls1.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=instansi value='<?=$_POST[instansi]?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=user value='<?=$namauser?>'>
<input type=submit name=submit3 value='Print Lap Transaksi MU Kirim Instansi (.XLS)'>
</form>
</table>
<?
}
?>
