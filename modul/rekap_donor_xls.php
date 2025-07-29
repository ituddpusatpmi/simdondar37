<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Pengajuan_Piagam.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
                            
				$data=mysql_query("SELECT * FROM pendonor where JumDonor >='$_POST[dari]' and JumDonor <='$_POST[sampai]' order by JumDonor ASC ");
                           
		$dari1=$_POST[dari];
		$sampai1=$_POST[sampai];

?>
<h4>Rekap jumlah donor dari : <?=$dari1?> kali, sampai dengan : <?=$sampai1?> kali</h4>
<h3 class="list">Berjumlah : <?=mysql_num_rows($data)?> Orang</h3>

<!--?
    $data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' ");
$data2=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' ");
?-->
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Kode Pendonor</td>
		<td>Nama Pendonor</td>
		<td>Alamat</td>
		<td>Tgl Lahir</td>
                <td>JK</td>
		<td>Gol Darah</td>
		<td>Rhesus</td>
		<td>Handphone</td>
		<td>Donor Ke</td>
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
		<td><?=$data1[TglLhr]?></td>
		<td><?=$jk?></td>
		<td><?=$data1[GolDarah]?></td>
		<td><?=$data1[Rhesus]?></td>
		<td><?=$data1[telp2]?></td>
		<td><?=$data1[jumDonor]?></td>
		</tr>
	<? } ?>
</table>
