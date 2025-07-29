<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>

<?
  include('clogin.php');
  include('config/db_connect.php');
?>
<head>
<h2 class="list">LAPORAN STOK BARANG</h2>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
    <table class="form">
      <tr>
	   <td>Status Stok</td>
		<td class="input">
		  <select name="stok">
		    <option value="0">Semua barang</option>
		    <option value="1" selected>Barang ada stok</option>
		    <option value="2">Barang tidak ada stok</option>
		    <option value="3">Barang stok MINUS</option>		
		  </select>
		</td>
	  <td>Jenis barang </td>
		<td class="input">
		  <select name="jenis">
		    <option value="" selected>Semua jenis barang</option>
		    <option value="BAG">Kantong Darah</option>
		    <option value="REAG">Reagensia</option>
		    <option value="BHP">Bahan Habis Pakai</option>
		    <option value="AHP">Alat Habis Pakai</option>
		    <option value="APD">Alat Pelindung Diri</option>
		    <option value="ATK">Alat Tulis Kantor & Cetakan</option>
		    <option value="KEB">Kebersihan</option>
		    <option value="SOUV">Souvenir</option>
		    <option value="LAIN">Lain-lain</option>
		    <option value="INV">Inventaris</option>		
		  </select>
		</td>
	  <td>Status</td>
		<td class="input">
		  <select name="aktif">
		    <option value="0">Semua</option>
		    <option value="1"  selected>Barang Aktif</option>
 		    <option value="2">Barang tidak aktif</option>
		  </select>
		</td>
	  <td><input type=submit name=submit value="Tampilkan"></td>
      </tr>
    </table>
</form>
</head>

<body>

<?
if (isset($_POST[submit])){
  ?><?
  $statusstok=$_POST[stok];
  $jenistok=$_POST[jenis];
  $aktif=$_POST[aktif];
  $order=" order by status, namabrg asc ";
  switch ($statusstok){
	case "0" : $where="";Break;
	case "1" : $where=" AND (stoktotal>0) ";Break;
	case "2" : $where=" AND stoktotal=0   ";Break;
	case "3" : $where=" AND stoktotal<0   ";Break;
	default  : $where='';Break;	
  }	
  switch ($aktif){
	case "0" : $where1="";Break;
	case "1" : $where1=" AND aktif='0' ";Break;
	case "2" : $where1=" AND aktif='1' ";Break;
	default  : $where1='';Break;	
  }	
    $data=mysql_query("select * from hstok where status like '%$jenistok%' $where $where1 $order");
?>
<table class="list" cellpadding=3 cellspacing=0 border=1>
	<tr class="field">
		<td>No</td>
		<td>Jenis</td>
		<td>Kode</td>
		<td>Nama Barang</td>
		<td>Merk</td>
        <td>Stok<br> Minimal</td>
		<td>Jml Stok</td>
        <td>Satuan</td>
        <td>Harga<br> @Rp.</td>
		<td>Harga Total<br>Rp.</td>
	</tr>
	<?
	$no=0;
	$grandtotal=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
	$harga =number_format($data1['harga'],0,',','.');
	$stoktotal =number_format($data1['stoktotal'],0,',','.');
 	$jmlharga =$data1['harga'] * $data1['stoktotal'];
	$jumlahharga=number_format($jmlharga,0,',','.');
	$grandtotal=$grandtotal+$jmlharga;
	?>
	
	<tr class="record">
		<td align="right"><?=$no?>.</td>
		<?php
		switch($data1[status]){
		case "REAG":$jenis='Reagensia';Break;
		case "BAG" :$jenis='Kantong Darah';Break;
		case "BHP" :$jenis='Bahan Habis Pakai';Break;
		case "AHP" :$jenis='Alat Habis Pakai';Break;
		case "ATK" :$jenis='Alat Tulis Kantor & Cetakan';Break;
		case "APD" :$jenis='Alat Pelindung Diri';Break;
		case "INV" :$jenis='Inventaris';Break;
		case "KEB" :$jenis='Kebersihan';Break;
		case "SOUV" :$jenis='Souvenir';Break;
		case "LAIN":$jenis='Lain-lain';Break;
		default :$jenis='--';Break;
		} ?>
		<td align="left"><?=$jenis?></td>
		<td align="left"><a href=pmilogistik.php?module=kartu_stok&kode=<?=$data1[kode]?>><?=$data1[kode]?></a></td>
		<td align="left"><?=$data1[namabrg]?></td>
		<td align="left"><?=$data1[merk]?></td>
        <td align="right"><?=$data1[min]?></td>
        <? $min = $data1[min]; $max = $data1[stoktotal]; if ($max <= $min){?>
            <td align="right" bgcolor="RED"><?=$stoktotal?></td>
        <?}else{?>
            <td align="right"><?=$stoktotal?></td>
        <?}?>
        <td align="right"><?=$data1[satuan]?></td>
		<td align="right"><?=$harga?></td>
		<td align="right"><?=$jumlahharga?></td>
	</tr>
	<? } ?>
	<tr class="field">
		<td colspan="9">JUMLAH</td>
		<td align="right"><?=number_format($grandtotal,0,',','.');?></td>
	</tr>
</table>
</body>
<a href="javascript:window.print()">Cetak</a>
<?
}
?>
