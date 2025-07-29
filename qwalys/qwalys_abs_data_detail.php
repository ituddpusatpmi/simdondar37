<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
$namauser=$_SESSION[namauser];
$namalengkap=$_SESSION[nama_lengkap];
$notransaksi=$_GET['notrs'];
?>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<style type="text/css">
	@import url("topstyle.css");tr { background-color: #FFF8DC}.initial { background-color: #FFF8DC; color:#000000 }
	.normal { background-color: #FFF8DC }.highlight { background-color: #7FFF00 }
</style>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SIMDONDAR</title>
</head>

<body>
	<table border=0><tr>
		<td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Detail Pemeriksaan Antibody screening - Qwalys<sup>&reg</sup> 3</td></tr>
        <td align="left" style="background-color: #ffffff;font-size:24px; color:#0099ff;text-shadow: 1px 1px 1px #000000; font-family:Verdana;">Nomor transaksi : <?php echo $notransaksi; ?></td></tr>
	</table>

	<table class="list" border=1 cellpadding=5 cellspacing=10 style="border-collapse:collapse">
		<tr class="field">
			<td rowspan="2">NO.</td>
            <td rowspan="2">Waktu Konfirmasi</td>
			<td rowspan="2">Sample ID<br>(No Kantong)</td>
			<td rowspan="2">Kode Pendonor</td>
			<td colspan="2">STATUS KANTONG</td>
            <td rowspan="2">Hasil<br>Pemeriksaan</td>
            <td rowspan="2">Aksi Konfirmasi</td>
            <td colspan="3">PETUGAS</td>
		</tr>
        <tr class="field">
            <td>Saat<br>Pemeriksaan</td>
            <td>Saat ini</td>
            <td>Operator Qwalys</td>
            <td>Konfirmasi</td>
            <td>Pengesahan</td>
        </tr>
	<?php
	$no=0;
	$jml=0;
	$sql="SELECT `id`, `version`, `sn`, `sample_id`, `parameter1`, `microplate`, `parameter2`, `runtime`, `result1`,
          `result_status`, `operator`, `wellplate`, `nl`, `nl_barcode`, `nl_batch`, `nl_ed`, `sd`, `sd_barcode`,
          `sd_batch`, `sd_ed`, `hsp`, `hsp_barcode`, `hsp_batch`, `hsp_ed`, `result_inter`, `result_grade`,
          `on_insert`, `confirm`, `confirm_user`, `ket` FROM `qwalys_abs_raw` WHERE `ket`='$notransaksi'
          ORDER BY `a`.`abs_id`";
	$qraw=mysql_query($sql);
	while($tmp=mysql_fetch_assoc($qraw)){
		$no++;
        if ($tmp['abs_result']=='Pos'){ ?>
            <tr style="font-size:13px; color:#ff0000; font-weight: bold; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td align="right"><?=$no.'.'?></td>
                <td><?=$tmp['abs_tgl']?></td>
                <td><?=$tmp['abs_sample_id']?></td>
                <td><?=$tmp['abs_id_donor']?></td>
                <td><?=$statuskantong_old?></td>
                <td><?=$statuskantong?></td>
                <td><?=$tmp['abs_result']?></td>
                <td><?=$aksi?></td>
                <td><?=$tmp['abs_user']?></td>
                <td><?=$tmp['abs_checker']?></td>
                <td><?=$tmp['abs_supervisor']?></td>
            </tr>
            <?php
        }else{?>
            <tr style="font-size:13px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                <td align="right"><?=$no.'.'?></td>
                <td><?=$tmp['abs_tgl']?></td>
                <td><?=$tmp['abs_sample_id']?></td>
                <td><?=$tmp['abs_id_donor']?></td>
                <td><?=$statuskantong_old?></td>
                <td><?=$statuskantong?></td>
                <td><?=$tmp['abs_result']?></td>
                <td><?=$aksi?></td>
                <td><?=$tmp['abs_user']?></td>
                <td><?=$tmp['abs_checker']?></td>
                <td><?=$tmp['abs_supervisor']?></td>
            </tr>
            <?php
        }
		?>

	<?}
	if ($no==0){?>
		<tr class="record">
			<td colspan=8>Tidak ada data</td></tr>
	<?} else {
		?><tr class="field">
			<td colspan=6>Jumlah Sample</td>
			<td><?=number_format($jml,0,',','.')?></td>
			<td colspan=4></td>
			</tr><?
	}?>
	</table><br>
    <a href="pmikonfirmasi.php?module=abs_to_data"class="swn_button_blue">Pilih Transaksi ABS</a>
    <a href="pmikonfirmasi.php?module=detail_abs_data"class="swn_button_blue">Detail Pemeriksaan</a>
	<a href="pmikonfirmasi.php?module=qwalys"class="swn_button_blue">Kembali ke Awal</a>
	<?
?>
</body>
</html>

