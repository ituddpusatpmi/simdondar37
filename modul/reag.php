<?
include ('../config/db_connect.php');
 $query = mysql_query("SELECT * FROM master_reagen order by id ASC");	
?>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>ID</th>
		<th>Nama Reagen</th>
		<th>Jenis Reagen</th>
		<th>Metode</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td align="center"><?=$row->id?></td>
		<? $nama_reagen = "$row->nama_reagen"." "."$row->jenis_reagen".";"."$row->metode";?>
		<td><a href="javascript:selectReagen('<?=$nama_reagen?>')"><?=$row->nama_reagen?></a></td>
		<td align="center"><?=$row->jenis_reagen?></td>
		<td align="center"><?=$row->metode?></td>
	</tr>
	<? endwhile; ?>
</table>
