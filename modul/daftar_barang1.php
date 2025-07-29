<?
if (isset($_GET[q])) {
include ('../config/db_connect.php');
$q=$_GET["q"];
$query = mysql_query("SELECT * FROM hstok where namabrg like '%$q%' ");	
?>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>Kode</th>
		<th>Nama Barang</th>
		<th>Stok</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td align="center"><a href="javascript:selectKode('<?=$row->kode?>')"><?=$row->kode?></a></td>
		<td><?=$row->namabrg?></td>
		<td align="center"><?=$row->stoktotal?></td>
	</tr>
	<? endwhile; ?>
</table>
<? }

