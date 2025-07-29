<?
if (isset($_GET[q])) {
include ('../config/db_connect.php');
$q=$_GET["q"];
$query = mysql_query("SELECT * FROM pendonor where Nama like '%$q%' ");	
?>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>Kode</th>
		<th>Nama Pendonor</th>
		<th>Alamat</th>
		<th>Tgl Lahir</th>
		<th>Donor Ke</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td><?=$row->Kode?></td>
		<td><?=$row->Nama?></td>
		<td><?=$row->Alamat?></td>
		<td><?=$row->TglLhr?></td>
		<td><?=$row->jumDonor?> Kali</td>
	</tr>
	<? endwhile; ?>
</table>
<? }

