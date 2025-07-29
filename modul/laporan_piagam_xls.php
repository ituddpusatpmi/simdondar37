<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Piagam.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
$today=date("Y-m-d");
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$piagam=$_POST[piagam];

switch ($piagam){
                       case "p10":
				$piagam1="10 kali";break;
                       case "p25":
				$piagam1="25 kali";break;
                            case "p50":
				$piagam1="50 kali";break;
                            case "p75":
				$piagam1="75 kali";break;
                            case "p100":
				$piagam1="100 kali";break;
                            case "psatya":
				$piagam1="Satya Lencana";break;
                            case "pprov":
				$piagam1="Provinsi";break;
		}
?>
<h3 class="list">Rekap Piagam <?=$piagam1?> Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<?
    $data=mysql_query("SELECT a.Kode, a.Nama,a.Alamat,a.Jk,a.GolDarah,a.Rhesus,a.jumDonor,a.p10, a.p25, a.p50, a.p75, a.p100, a.psatya, a.pprov,
                        date(b.tglDiajukan) as diajukan, date(b.tglDicetak) as dicetak, date(b.tglDiberikan) as diberikan, date(b.tglKembali) as kembali, b.nopiagam,b.jenispiagam
                        FROM pendonor a
                        INNER JOIN piagam b ON a.Kode = b.kodependonor
                        WHERE b.jenispiagam = '$piagam'
                        AND date(b.tglDiajukan)
                        BETWEEN  '$_POST[waktu]'
                        AND  '$_POST[waktu1]'
                        ORDER BY b.tglDiajukan ASC");
?>
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Kode Pendonor</td>
		<td>Nama Pendonor</td>
		<td>Alamat</td>
                <td>JK</td>
		<td>Gol Darah</td>
		<td>Donasi</td>
		<td>Tgl Diajukan</td>
                <td>Tgl Dicetak</td>
                <td>Tgl Diberikan</td>
                <td>Tgl Kembali</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) {
	$no++;
		switch ($data1[Jk]){
                       case "0":
				$jk="LK";break;
                       case "1":
				$jk="PR";break;
		}
	?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[Kode]?></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$data1[Alamat]?></td>
		<td><?=$jk?></td>
		<td><?=$data1[GolDarah]?></td>
		<td><?=$data1[jumDonor]?></td>
		<td><?=$data1[diajukan]?></td>
                <td><?=$data1[dicetak]?></td>
                <td><?=$data1[diberikan]?></td>
                <td><?=$data1[kembali]?></td>
	</tr>
	<?
	}
?>
</table>
