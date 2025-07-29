<link type="text/css" href="css/table1.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?
//include('../clogin.php');
include('../config/db_connect.php');
$namauser=$_SESSION[namauser];
if (isset($_POST[submit])) {
	$Kode=$_POST[Kode];
	$Nama=$_POST[Nama];
	$status=$_POST[status];
	$min=$_POST[min];
	$satuan=$_POST[satuan];
	$ketsatuan=$_POST[ketsatuan];
        $sql="insert into hstok (Kode,NamaBrg,StokTotal,Harga,status,satuan,min,ketSatuan,snack) values ('$Kode','$Nama','','','$status','$satuan','$min','$ketsatuan','')";
	$tambah=mysql_query($sql);
	//echo $sql;
	if ($tambah) {
                echo "Data Barang Telah berhasil dientry 
                <script>parent.$.fn.colorbox.close();</script>"; 
	}
}
?>
	<form name="barang" method="POST" action="<?=$PHPSELF?>">
<h3>Entry Barang</h3>
	<table class="form" border="0">
	<tr>
	<td>Kode Barang1</td>
	<td class="input"><input name="Kode" type="text" size="15"></td>
	</tr>
	<tr>
	<td>Nama Barang</td>
	<td class="input"><input name="Nama" type="text" size="25"></td>
	</tr>
        <tr>
	<td>Status Barang</td>
	<td class="input">
	<select name="status">
                <option value="">Pilih Status</option>
                <option value="0">ATK</option>
                <option value="1">LAB</option>
                </select>
	</tr>
        <tr>
	<td>Satuan</td>
	<td class="input"><input name="satuan" type="text" size="15"</td>
	</tr>
        <tr>
	<td>Min</td>
	<td class="input"><input name="min" type="text" size="15"</td>
	</tr>
	<tr>
        <td>Ket Satuan</td>
        <td class="input"><input name="ketsatuan" type="text" size="15"></td>
        </tr>
</table>
	<input name="submit" type="submit" value="Simpan Data">
</form>
