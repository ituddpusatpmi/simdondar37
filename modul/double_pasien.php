<h1>Hapus Data Pasien Ganda </h1>
<form name=doublependonor method=post>
<table>
<tr><td>Kode 1 </td><td>:</td><td><input type=text name='kode[]'></td></tr>
<tr><td>Kode 2 </td><td>:</td><td><input type=text name='kode[]'></td></tr>
<tr><td>Kode 3 </td><td>:</td><td><input type=text name='kode[]'></td></tr>
<tr><td>Kode 4 </td><td>:</td><td><input type=text name='kode[]'></td></tr>
<tr><td>Kode 5 </td><td>:</td><td><input type=text name='kode[]'></td></tr>
<tr><td>Kode 6 </td><td>:</td><td><input type=text name='kode[]'></td></tr>
</table>
<input type=submit name=submit value="Submit">
</form>

<? 
if (isset($_POST[submit])) {
$kode1=mysql_escape_string($_POST[kode][0]);
for ($i=1;$i<6;$i++) {
$kode=mysql_escape_string($_POST[kode][$i]);
$d=mysql_query("SELECT count(nokantong) as jumlahdonor FROM `htransaksi` WHERE kodependonor='$kode' AND pengambilan='0' ");
$e=mysql_fetch_array($d);
$jumlahdonor=$e[jumlahdonor];
if ($kode!='') {
$jd=mysql_fetch_assoc(mysql_query("select jumDonor from pendonor where kode='$kode'"));
mysql_query("update pendonor set jumDonor=jumDonor+$jumlahdonor where kode='$kode1'");
mysql_query("delete from pendonor where kode='$kode'");
mysql_query("update htransaksi set KodePendonor='$kode1' where KodePendonor='$kode'");
mysql_query("update stokkantong set kodePendonor='$kode1' where kodePendonor='$kode'");
echo "<br>Data pendonor dengan Kode $kode telah dihapus dan diupdate";
}
}
}
?>
