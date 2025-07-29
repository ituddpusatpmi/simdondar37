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
  include('config/db_connect.php');
  $nomor=$_GET[notrans];
  $tanggal=$_GET[tanggal];
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=hasil_ujisaring_$nomor_$tanggal.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  $sql="select distinct  hasil_imltd.nokantong as nokantong, htransaksi.instansi as instansi from hasil_imltd inner join htransaksi on htransaksi.nokantong=hasil_imltd.nokantong
					where hasil_imltd.nomor='$nomor' and date(hasil_imltd.tanggal)='$tanggal'";
  $data=mysql_query($sql);
?>
<font size="4" color="red" font-family="Arial">HASIL PEMERIKSAAN UJIS SARING DARAH (IMLTD)</font><br>
<font size="3" color="black" font-family="Arial">Tanggal pemeriksaan: <?=$tanggal?></font><br>
<font size="3" color="black" font-family="Arial">Nomor Transaksi : <?=$nomor?></font><br>
<table class="list" border="1" cellspacing="2" cellpadding="2" style="border-collapse:collapse">
	<tr class="field">
		<td rowspan=2>No</td>
		<td rowspan=2>No. Kantong</td>
		<td rowspan=2>Asal Sample</td>
		<td colspan=4>HBsAg</td>
		<td colspan=4>HCV</td>
		<td colspan=4>HIV</td>
		<td colspan=4>Syphilis</td>
	</tr>
	<tr class="field">
		<td>Metode</td><td>OD</td><td>COV</td><td>Hasil</td>
		<td>Metode</td><td>OD</td><td>COV</td><td>Hasil</td>
		<td>Metode</td><td>OD</td><td>COV</td><td>Hasil</td>
		<td>Metode</td><td>OD</td><td>COV</td><td>Hasil</td>
	</tr>
	<?php
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
		$no++;
		$metode_b="";  	$metode_c="";  	$metode_i="";  	$metode_v="";
		$od_b="-";  		$od_c="-";  		$od_i="-";  		$od_v="-";
		$hasil_b="";  	$hasil_c="";  	$hasil_i="";  	$hasil_v="";
		$cov_b="-";		$cov_c="-";		$cov_i="-";		$cov_v="-";		
		
		$sq_b="select * from hasilelisa where noKantong='$data1[nokantong]' and notrans='$nomor' and jenisPeriksa='0'";
		$dt_b=mysql_fetch_assoc(mysql_query($sq_b));
		if ($dt_b['Hasil']!==''){
			$od_b=$dt_b['OD'];
			$hasil_b=$dt_b['Hasil'];
			$cov_b=$dt_b['COV'];
			if ($dt_b['Hasil']=='0'){$hasil_b="Negatif";}else {$hasil_b="Reaktif";}
			$metode_b="Elisa";
		} else{
			$sq_b="select * from drapidtest where noKantong='$data1[nokantong]' and NoTrans='$nomor' and jenisperiksa='0'";
			$dt_b=mysql_fetch_assoc(mysql_query($sq_b));
			$hasil_b=$dt_b['Hasil'];
			if ($dt_b['Hasil']=='0'){$hasil_b="Negatif";}else {$hasil_b="Reaktif";}
			$metode_b="Rapid";
		}
		
		$sq_c="select * from hasilelisa where noKantong='$data1[nokantong]' and notrans='$nomor' and jenisPeriksa='1'";
		$dt_c=mysql_fetch_assoc(mysql_query($sq_c));
		if ($dt_c['Hasil']!==''){
			$od_c=$dt_c['OD'];
			$hasil_c=$dt_c['Hasil'];
			$cov_c=$dt_c['COV'];
			if ($dt_c['Hasil']=='0'){$hasil_c="Negatif";}else {$hasil_c="Reaktif";}
			$metode_c="Elisa";
		} else{
			$sq_c="select * from drapidtest where noKantong='$data1[nokantong]' and NoTrans='$nomor' and jenisperiksa='1'";
			$dt_c=mysql_fetch_assoc(mysql_query($sq_c));
			$hasil_c=$dt_b['Hasil'];
			if ($dt_c['Hasil']=='1'){$hasil_c="Negatif";}else {$hasil_c="Reaktif";}
			$metode_c="Rapid";
		}
		
		$sq_i="select * from hasilelisa where noKantong='$data1[nokantong]' and notrans='$nomor' and jenisPeriksa='2'";
		$dt_i=mysql_fetch_assoc(mysql_query($sq_i));
		if ($dt_i['Hasil']!==''){
			$od_i=$dt_i['OD'];
			$cov_i=$dt_i['COV'];
			$hasil_i=$dt_i['Hasil'];
			if ($dt_i['Hasil']=='0'){$hasil_i="Negatif";}else {$hasil_i="Reaktif";}
			$metode_i="Elisa";
		} else{
			$sq_i="select * from drapidtest where noKantong='$data1[nokantong]' and NoTrans='$nomor' and jenisperiksa='2'";
			$dt_i=mysql_fetch_assoc(mysql_query($sq_i));
			$hasil_i=$dt_b['Hasil'];
			if ($dt_i['Hasil']=='1'){$hasil_i="Negatif";}else {$hasil_i="Reaktif";}
			$metode_i="Rapid";
		}
		
		$sq_v="select * from hasilelisa where noKantong='$data1[nokantong]' and notrans='$nomor' and jenisPeriksa='3'";
		$dt_v=mysql_fetch_assoc(mysql_query($sq_v));
		if ($dt_v['Hasil']=='0'){
			$od_v=$dt_v['OD'];
			$cov_v=$dt_v['COV'];
			$hasil_v=$dt_v['Hasil'];
			if ($dt_v['Hasil']=='0'){$hasil_v="Negatif";}else {$hasil_v="Reaktif";}
			$metode_v="Elisa";
		} else{
			$sq_v="select * from drapidtest where noKantong='$data1[nokantong]' and NoTrans='$nomor' and jenisperiksa='3'";
			$dt_v=mysql_fetch_assoc(mysql_query($sq_v));
			$hasil_v=$dt_b['Hasil'];
			if ($dt_v['Hasil']=='1'){$hasil_v="Negatif";}else {$hasil_v="Reaktif";}
			$metode_v="Rapid";
		}
		?>
		<tr class="record">
			<td align="right"><?=$no?>.</td>
			<td align="left"><?=$data1['nokantong']?></td>
			<td align="left"><?=$data1['instansi']?></td>
			
			<td align="center"><?=$metode_b?></td>
			<td align="right"><?=$od_b?></td>
			<td align="right"><?=$cov_b?></td>
			<td align="center"><?=$hasil_b?></td>
			
			<td align="center"><?=$metode_c?></td>
			<td align="right"><?=$od_c?></td>
			<td align="right"><?=$cov_c?></td>
			<td align="center"><?=$hasil_c?></td>
			
			<td align="center"><?=$metode_i?></td>
			<td align="right"><?=$od_i?></td>
			<td align="right"><?=$cov_i?></td>
			<td align="center"><?=$hasil_i?></td>
			
			<td align="center"><?=$metode_v?></td>
			<td align="right"><?=$od_v?></td>
			<td align="right"><?=$cov_v?></td>
			<td align="center"><?=$hasil_v?></td>
		</tr><?
	} ?>
</table>
