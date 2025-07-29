<?
include ('../config/db_connect.php');
 $query = mysql_query("SELECT * FROM biaya");	
?>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>Kode</th>
		<th>NamaBiaya</th>
		<th>Harga</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td align="center"><a href="javascript:selectBayar('<?=$row->Kode?>')"><?=$row->Kode?></a></td>
		<td><?=$row->NamaBiaya?></td>
		<td align="center"><?=$row->Harga?></td>
	</tr>
	<? endwhile; ?>
</table>
