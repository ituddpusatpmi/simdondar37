<?

include ('../config/db_connect.php');
?>
<form> 
Ketik Nama Instansi : <input type="text" name='q1' onkeyup="showHint(this.value)" size="40" />
</form>
<?
if (isset($_POST[q1])) {
$query = mysql_query("SELECT * FROM detailinstansi where nama like '%$q1%' ");	
?>
<table bgcolor="#000000" cellspacing="1" cellpadding="3">	
	<tr bgcolor="#DDDDDD">
		<th>Kode Header</th>
		<th>Nama Instansi</th>
		<th>Alamat</th>
		<th>Telp</th>
		<th>CP</th>
	</tr>
	<? while($row = mysql_fetch_object($query)): ?>
	<tr bgcolor="#FFFFFF">
		<td align="center"><?=$row->KodeHeader?></a></td>
		<td><a href="javascript:selectKode('<?=$row->nama?>')"><?=$row->nama?></td>
		<td align="center"><?=$row->alamat?></td>
		<td align="center"><?=$row->telp?></td>
		<td align="center"><?=$row->cp?></td>
	</tr>
	<? endwhile; ?>
</table>
<? }

