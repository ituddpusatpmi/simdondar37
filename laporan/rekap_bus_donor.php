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
<STYLE>
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
</style>
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
$sqlkegiatan="select  DATE_FORMAT( Tgl,  '%d/%m/%Y' ) AS tanggal, `Instansi`,`kendaraan`, count(`NoTrans`) as jml from htransaksi where kendaraan='0' and date(Tgl)>='$tanggalawal' and date(Tgl)<='$tanggalakhir' group by date(Tgl), `Instansi`,`kendaraan`";
$sq_bus=mysql_query($sqlkegiatan);
$utd= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
$no=0;
?>
<font size="4" color=red font-family="Arial">LAPORAN PEMAKAIAN BUS DONOR, <?=$utd['nama']?><BR></font>
<font size="4" color=black font-family="Arial"><?=$labelperiode?><br></font>

<table class=list cellspacing="2" cellpadding="2" style="border-collapse:collapse" border="1" width="900px">
	<tr class=field>
		<th>NO</th>
		<th>TANGGAL</th>
		<th>INSTANSI KEGIATAN</th>
		<th>ALAMAT </th>
		<th>JUMLAH<br>DONOR</th>
	</tr>
	<?
	while($data=mysql_fetch_assoc($sq_bus)){
		$no++;
		$instansi=mysql_fetch_assoc(mysql_query("select alamat from detailinstansi where nama='$data[Instansi]' limit 1"));
	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	    <td class=input align="right"><?=$no?>.</td>
	    <td class=input align="center"><?=$data['tanggal']?></td>
	    <td class=input align="left"><?=$data['Instansi']?></td>
	    <td class=input align="left"><?=$instansi['alamat']?></td>
	    <td class=input align="right"><?=$data['jml']?></td>
	</tr>
    <?}?>
</table>

<form name=xls method=post action=laporan/laporan_pemakaian_bus_donor.php>
<input type=hidden name=tgl1 value='<?=$tanggalawal?>'>
<input type=hidden name=tgl2 value='<?=$tanggalakhir?>'>
<input type=hidden name=namaperiode value='<?=$namaperiode?>'>
<input type=submit name=submit value="Unduh Laporan (.XLS)" class="swn_button_blue">
</form>
<?php
$mtime = microtime(); $mtime = explode (" ", $mtime); $mtime = $mtime[1] + $mtime[0]; $tend = $mtime;  $totaltime = ($tend - $tstart);
printf ("Waktu : %.4f detik.", $totaltime); ?>