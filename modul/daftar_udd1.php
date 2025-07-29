<?

include ('../config/db_connect.php');
$q=$_GET["q"];
 $query = mysql_query("SELECT nama,id,alamat from utd where nama like '%$q%'");	
?>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>Kode</th>
		<th>Nama</th>
		<th>Alamat</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td><!--a href="javascript:selectutd('<?=$row->id?>')"><?=$row->id?></a--><?=$row->id?></td>
<!--td><a href=pmilaboratorium.php?module=terima_dari_utd_lain&kodeSup='$row[id]'><?=$kodeSup=$row->id?></a></td-->
		<td><?=$row->nama?></td>
		<td><?=$row->alamat?></td>
	</tr>
	<? endwhile; ?>
</table>
<? 
