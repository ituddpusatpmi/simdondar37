<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Pengajuan_Piagam.xls");
header("Pragma: no-cache");
header("Expires: 0");
include '../config/db_connect.php';
        $piagam 	= $_POST[piagam];
	        switch ($piagam){
                       	case "p10":
				$piagam1="10 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>='10' and JumDonor < '25' and p10='0' order by Nama ASC");break;
                        case "p25":
				$piagam1="25 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>='25' and JumDonor < '50' and p25='0' order by Nama ASC");break;
                     	case "p50":
				$piagam1="50 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>='50' and JumDonor < '75' and p50='0' order by Nama ASC");break;
                        case "p75":
				$piagam1="75 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>='75' and JumDonor < '100' and p75='0' order by Nama ASC");break;
                        case "p100":
				$piagam1="100 kali";
				$data=mysql_query("SELECT Kode, Nama,Alamat,Jk,GolDarah,Rhesus,jumDonor,telp2,Rhesus,TglLhr FROM pendonor where JumDonor>='100' and p100='0' order by Nama ASC");break;
                           
		}

?>
<h3 class="list">Daftar Pendonor Yang Belum terima Piagam <?=$piagam1?> sebanyak <?=mysql_num_rows($data)?> Orang</h3>

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
