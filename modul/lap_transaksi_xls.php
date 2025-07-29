<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=lap_transaksi_mobile.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$date=$_POST[waktu];

$pertgl0=date("d",strtotime($date));
$perbln0=date("n",strtotime($date));
$perthn0=date("Y",strtotime($date));
$bulan0=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln21=$bulan0[$perbln0];

$namauser=$_POST[user];
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
$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));
?>

<h3 class="table">Kegiatan : <?=$namahari1?>, <?=$pertgl?> - <?=$bln21?> - <?=$perthn?><br>
<?=$nama[Instansi]?></h3>
<table class=form border=1 cellpadding=0 cellspacing=0>
           
	  <td>No</td>
	<td>Tgl Donor</td>
          <td>Kode Pendonor</td>
          <td>Nama</td>
	  <td colspan='2'>Tempat & Tgl Lhr</td>
          <td>Alamat</td>
	  <td>Pekerjaan</td>
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
$trans1=mysql_fetch_assoc(mysql_query("select Nama,Alamat,telp2,TempatLhr,TglLhr from pendonor where Kode='$trans[KodePendonor]'"));
?>
      	<td class=input><?=$trans[KodePendonor]?></td>
	<td class=input><?=$trans1[Nama]?></td>
	<td class=input><?=$trans1[TempatLhr]?></td>
	<td class=input><?=$trans1[TglLhr]?></td>
	<td class=input><?=$trans1[Alamat]?></td>
	<td class=input><?=$trans[pekerjaan]?></td>
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
</td>
<td>
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

<table>

<?

$sekarang=date("Y-m-d");

$pertgl1=date("d",strtotime($sekarang));
$perbln1=date("n",strtotime($sekarang));
$perthn1=date("Y",strtotime($sekarang));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$perbln1];
$jam = date("H:i:s");

//$perbln1=substr($sekarang,6,2);
///$pertgl1=substr($sekarang,8,2);
//$perthn1=substr($sekarang,0,4);
//$bulan1=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
//$bln22=$bulan1[$perbln1];
//$jam = date("H:i:s");
$namahari=date("l");
if ($namahari == "Sunday") $namahari = "Minggu";
else if ($namahari == "Monday") $namahari = "Senin";
else if ($namahari == "Tuesday") $namahari = "Selasa";
else if ($namahari == "Wednesday") $namahari = "Rabu";
else if ($namahari == "Thursday") $namahari = "Kamis";
else if ($namahari == "Friday") $namahari = "Jumat";
else if ($namahari == "Saturday") $namahari = "Sabtu";
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
?>
<tr ><td></td><td></td><td align=center><?=$udd[nama]?></tr>
<tr><td></td><td></td><td align=center> <?=$namahari?>, <?=$pertgl1?> <?=$bln22?> <?=$perthn1?></td></tr>
<tr><td></td><td></td><td align="center">Yang Merekap</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td align="center"><?=$namauser?></td></tr>
</table>

