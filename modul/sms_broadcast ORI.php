<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<?
if (isset($_POST[submit1])) {
echo "<a href=pmiadmin.php?module=sms_broadcast>BACK</a>";
echo "<form method=post>
<table>
<tr><td valign=top>ISI Pesan</td><td valign=top>:</td><td><textarea name=pesan></textarea></td></tr>
</table>
<input type=submit name=submit2 value='Kirim SMS ke Semua Pendonor ini!'>
";
echo "<table>";
	 $q_utd	= mysql_query("select id from utd where aktif='1'");			
	 $utd	= mysql_fetch_assoc($q_utd);
$search=" WHERE Kode like '$utd[id]%' and LENGTH(telp2)>10 and tglkembali<=CURRENT_DATE() and Cekal='0'";
if ($_POST[tgl]!='') $search=" WHERE Kode like '$utd[id]%' and LENGTH(telp2)>10 and tglkembali<=CURRENT_DATE() and Cekal='0'";
if ($_POST[gol_darah]!='semua') $search.=" AND GolDarah='$_POST[gol_darah]'";
if ($_POST[rhesus]!='semua') $search.=" AND Rhesus='$_POST[rhesus]'";
if ($_POST[kelurahan]!='') $search.=" AND kelurahan like '%$_POST[kelurahan]%' ";
if ($_POST[kecamatan]!='') $search.=" AND kecamatan like '%$_POST[kecamatan]%' ";
if ($_POST[wilayah]!='') $search.=" AND wilayah like '%$_POST[wilayah]%' ";
$pd=mysql_query("select nama,GolDarah,alamat,telp2,concat(DATE_FORMAT(tglkembali,'%e '),ELT( MONTH(tglkembali), 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'),DATE_FORMAT(tglkembali,' %Y')) as tgl from pendonor $search");
$no=0;
while ($pd1=mysql_fetch_assoc($pd)) {
$no++;
if (strlen($pd1[telp2])>10) $telp=$pd1[telp2];
echo "<tr><td>$no</td><td>$pd1[nama]</td><td>$pd1[GolDarah]</td><td>$pd1[alamat]</td><td>$telp</td><td>$pd1[tgl]</td></tr>";
echo "<input type=hidden name=pendonor[] value=$telp>";
}
echo "</table></form>";
} 
if (isset($_POST[submit2])) {
for ($i=0;$i<sizeof($_POST[pendonor]);$i++) {
$pendonor=$_POST[pendonor][$i];
$kirim="insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
			values ('$pendonor','$_POST[pesan]','1')";
//echo "$kirim <br>";
$kirim1=mysql_query($kirim);
}
}
if (!isset($_POST[submit1]) and !isset($_POST[submit2])) {
?>
<h1>Broadcast SMS </h1>
<form method=post>
<table>
<tr><td>
Tanggal Kegiatan</td><td>:</td><td>
<input type=text name=tgl id="datepicker" size=10>
</td></tr>
<tr><td>
Golongan Darah</td><td>:</td><td><select name=gol_darah>
<option value='semua' selected>Semua</option>
<option value='A'>A</option>
<option value='B'>B</option>
<option value='AB'>AB</option>
<option value='O'>O</option>
</select></td></tr>
<tr><td>
Rhesus Darah</td><td>:</td><td><select name=rhesus>
<option value='semua' selected>Semua</option>
<option value='+'>Positif</option>
<option value='-'>Negatif</option>
</select></td></tr>
<tr><td>Kelurahan</td><td>:</td><td><input name=kelurahan type=text></td></tr>
<tr><td>Kecamatan</td><td>:</td><td><input name=kecamatan type=text></td></tr>
<tr><td>Wilayah</td><td>:</td><td><input name=wilayah type=text></td></tr>
</table>
<input type=submit name=submit1 value=Submit>
</form>
<? } ?>
