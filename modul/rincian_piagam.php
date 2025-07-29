<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="st    ylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});});
  </script>

<h1 class="table">Laporan Transaksi Donor Darah</h1>
<form name="dinstansi" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Jumlah Donor :</td>
<td>
<input class=input name="jumlah" type=text size=3> Sampai
<input class=input name="jumlah1" type=text size=3>
</td>
</tr>
<tr><td>Jenis Piagam:</td>	 <td> <select name="jenis">
							<option value="0">10x</option>
							<option value="1">25x</option>
							<option value="2">50x</option>
							<option value="3">75x</option>
							<option value="4">100x</option>  
					</td></tr>
<tr><td>Status:</td>	 <td> <select name="status">
							  <option value="0">Belum</option>
							  <option value="1">Sudah</option>
							  
					</td></tr>
</table>
<input type=submit name=submit value="Search">
</form>


<?if (isset($_POST[submit])) {
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));

?>


<?
$jenis1=mysql_fetch_assoc(mysql_query("select pendonor where jumDonor >'9' and jumDonor < '25' and p10='0'"));
if ($_POST[jenis]=="1") $jenis1=mysql_fetch_assoc(mysql_query("select pendonor where jumDonor >'24' and jumDonor < '50' and p25='0'"));
if ($_POST[jenis]=="2") $jenis1=mysql_fetch_assoc(mysql_query("select pendonor where jumDonor >'49' and jumDonor < '75' and p50='0' "));
if ($_POST[jenis]=="3") $jenis1=mysql_fetch_assoc(mysql_query("select pendonor where jumDonor >'74' and jumDonor < '100' and p75='0' "));
if ($_POST[jenis]=="4") $jenis1=mysql_fetch_assoc(mysql_query("select pendonor where jumDonor >'100' and p100='0'"));
?>


<h1 class="table">Tanggal Kegiatan <?=$pertgl?> - <?=$perbln?> - <?=$perthn?><br>
<?=$nama[Instansi]?></h1>
<table class=form border=1 cellpadding=0 cellspacing=0>
          <td>Tgl Donor</td>
          <td>Kode Pendonor</td>
          <td>Nama</td>
          <td>Alamat</td>
	  <td>Telp</td>
          <td>Jenis Donor</td>
          <td>Gol Darah</td>
	  <td>Rhesus</td>
	  <td>Donor Ke</td>
          
        </tr>
<?
$trans0=mysql_query("select pendonor where jumDonor='$jenis1'");
while ($trans=mysql_fetch_assoc($trans0)) {
$bln=substr($trans[Tgl],5,2);
$tgl=substr($trans[Tgl],8,2);
$thn=substr($trans[Tgl],0,4);
$tanggal=$pertgl."-". $perbln."-". $perthn;
?>
<tr class="record">

      	<td class=input><?=$tanggal?></td>
      	<td class=input><?=$jenis1[KodePendonor]?></td>
	<td class=input><?=$jenis1[Nama]?></td>
	<td class=input><?=$jenis1[Alamat]?></td>
	<td class=input><?=$jenis1[telp2]?></td>
<?
if ($trans[JenisDonor]=='0') { $jenis2="Sukarela"; } else { $jenis2="Pengganti"; }
?>
      	<td class=input><?=$jenis2?></td>
      	<td class=input><?=$jenis1[GolDarah]?></td>
<?
if ($trans[Rhesus]=='+') { $rhesus="Positif"; } else { $rhesus="Negatif"; }
?>

	<td class=input><?=$rhesus?></td>
	<td class=input><?=$jenis1[jumDonor]?></td>
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
   
	</tr>
<?

}
?>
</table>
<?
$jum=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='0'"));
$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]' and Pengambilan='2'"));
$golA=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$_POST[waktu]' and ht.Instansi='$_POST[instansi]' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor"));
$golB=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$_POST[waktu]' and ht.Instansi='$_POST[instansi]' and ht.Pengambilan='0' and pd.GolDarah='B' and pd.Kode=ht.KodePendonor"));
$golAB=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$_POST[waktu]' and ht.Instansi='$_POST[instansi]' and ht.Pengambilan='0' and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor"));
$golO=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$_POST[waktu]' and ht.Instansi='$_POST[instansi]' and ht.Pengambilan='0' and pd.GolDarah='O' and pd.Kode=ht.KodePendonor"));
$jkP=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$_POST[waktu]' and ht.Instansi='$_POST[instansi]' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor"));
$jkW=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$_POST[waktu]' and ht.Instansi='$_POST[instansi]' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor"));
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
<tr><td> Total Pendonor </td>
<td class=input><?=$jum[kod]?></td>
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
<td class=input><?=$jum[kod]?></td>
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
<form name=xls method=post action=modul/lap_transaksi_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=instansi value='<?=$_POST[instansi]?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=submit name=submit2 value='Print Lap Transaksi Donor (.XLS)'>
</form>
<?
}
?>
