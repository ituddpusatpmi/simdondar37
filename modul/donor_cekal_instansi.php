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

<h1 class="table">Data Donor Cekal Per Instansi</h1>
<form name="dinstansi" method="POST" action="<?echo $PHPSELF?>">
  <table class="form" cellspacing="2" cellpadding="3">
    <tr><td>Masukkan Instansi:</td><td><input type='text' name="instansi" id='instansi'></td></tr>
  </table>
  <input type=submit name=submit value="Search">
</form>
<?if (isset($_POST[submit])) {
$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where Instansi='$_POST[instansi]'"));
?><h3>Daftar Pendonor Cekal di Instansi : <?=$nama[Instansi]?></h3>
<table class=form border=1 cellpadding=0 cellspacing=0>
          <td rowspan='2'>Nomor</td>
          <td rowspan='2'>Nama</td>
          <td rowspan='2'>Alamat</td>
	  <td rowspan='2'>Telp</td>
	  <td rowspan='2'>Tanggal_Lahir</td>
	  <td rowspan='2'>Jenis Kel</td>
          <td rowspan='2'>Gol Darah</td>
	  <td rowspan='2'>Rhesus</td>
	  <td rowspan='2'>Jml Donasi</td>
          <td rowspan='2'>Donasi</td>
	  <td rowspan='2'>Tgl Terakhir</td>
	
        </tr>
	<tr>
			
	</tr>
<?
//$trans0=mysql_query("select ht.KodePendonor,ht.JenisDonor,ht.Pengambilan,ht.Reaksi,ht.catatan,
//			ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Rhesus,pd.telp2,pd.jumDonor 
//		from htransaksi as ht,pendonor as pd 
//		where ht.Instansi='$_POST[instansi]' and 
//		ht.KodePendonor=pd.Kode order by pd.GolDarah");
$no=0;
$jumgolA=0;
$jumgolB=0;
$jumgolO=0;
$jumgolAB=0;
$jkp=0;
$jkl=0;
$trans0=mysql_query("select htransaksi.KodePendonor, htransaksi.Instansi, pendonor.nama, pendonor.alamat, pendonor.JK,
		    pendonor.Pekerjaan, pendonor.TglLhr, pendonor.GolDarah, pendonor.Rhesus, pendonor.jumDonor,pendonor.telp2,
		    pendonor.p10,pendonor.p25,pendonor.p50,pendonor.p75,pendonor.p100,
		    count(htransaksi.KodePendonor) as Jumlah, date(max(htransaksi.Tgl)) as terakhir
		    from htransaksi inner join pendonor on pendonor.kode=htransaksi.KodePendonor
		    where htransaksi.Instansi='$_POST[instansi]' AND pendonor.Cekal='1'
		    group by pendonor.nama,htransaksi.KodePendonor");
while ($trans=mysql_fetch_assoc($trans0)) {
  $no++;
  $bln=substr($trans[TglLhr],5,2);
  $tgl=substr($trans[TglLhr],8,2);
  $thn=substr($trans[TglLhr],2,2);
  $tanggal=$tgl."-". $bln."-". $thn;
  $bln1=substr($trans[terakhir],5,2);
  $tgl1=substr($trans[terakhir],8,2);
  $thn1=substr($trans[terakhir],2,2);
  $tanggal1=$tgl1."-". $bln1."-". $thn1;
  if ($trans[GolDarah]=='A'){
    $jumgolA++;
  }
  if ($trans[GolDarah]=='B'){
    $jumgolB++;
  }
  if ($trans[GolDarah]=='AB'){
    $jumgolAB++;
  }
  if ($trans[GolDarah]=='O'){
    $jumgolO++;
  }
  if ($trans[JK]=='0'){
    $jkl++;
  }
  if ($trans[JK]=='1'){
    $jkp++;
  }
  
  ?><tr class="record">
      	<td class=input><?=$no?></td>
	<td class=input><?=$trans[nama]?></td>
	<td class=input><?=$trans[alamat]?></td>
	<td class=input><?=$trans[telp2]?></td>
	<td class=input><?=$tanggal?></td>
  <?
  if ($trans[JK]=='0') { $jenis="Laki-laki"; } else { $jenis="Perempuan"; }
  ?>
      	<td class=input><?=$jenis?></td>
      	<td class=input align="center"><?=$trans[GolDarah]?></td>
  <?
  ?>	<td class=input align="center"><?=$trans[Rhesus]?></td>
	<td class=input align="right"><?=$trans[jumDonor]?></td>
        <td class=input align="right"><?=$trans[Jumlah]?> x</td>
	<td class=input align="right"><?=$tanggal1?></td>

  </tr>
<?

}
?>
</table>
<br>
<table><tr>
<td>
</td>
<td>

</td>
</tr>
</table>
</br>

<form name=xls method=post action=modul/donor_cekal_instansi_xls.php>
<input type=hidden name=instansi value='<?=$_POST[instansi]?>'>
<input type=submit name=submit2 value='Cetak (.XLS)'>
</form>
<?
}
?>
