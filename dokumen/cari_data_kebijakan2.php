<?
if (isset($_GET[q])) {
include ('koneksi.php');
$q=$_GET["q"];
$query = mysql_query("SELECT * FROM kebijakan where bidang like '%$q%' order by kontrol DESC");	
?>
<table bgcolor="#000000" cellspacing="2" cellpadding="3" align="center">	
	<tr bgcolor="#DDDDDD">
		<th align="center">Bidang</th>
		<th align="center">Nama SPO</th>
		<th align="center">No. SPO</th>
		
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td align="left"><a href="javascript:selectKode('<?=$row->bidang?>')"><?=$row->bidang?></a></td>
		<td><?=$row->nama1?></td>
		<td><?=$row->kontrol?></td>
		
		
	</tr>
	<? endwhile; ?>
</table>
<? }
