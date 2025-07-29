<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<?
if (isset($_POST[submit1])) {
echo "<a href=pmimobile.php?module=sms_broadcast_ultah>BACK</a>";
echo "<form method=post>
<table>
<tr><td valign=top>ISI Pesan</td><td valign=top>:</td><td><textarea name=pesan></textarea></td></tr>
</table>
<input type=submit name=submit2 value='Kirim SMS ke Semua Pendonor ini!'>";
echo"
<table>
<tr><td>Daftar nama-nama pendonor yang berulang tahun hari ini dan tidak termasuk daftar cekal</td></tr>
</table>";
echo "<table>";
	 $q_utd	= mysql_query("select id from utd where aktif='1'");			
	 $utd	= mysql_fetch_assoc($q_utd);
$today=date('m-d');
$search=" WHERE Kode like '$utd[id]%' and LENGTH(telp2)>9 and substring(TglLhr,6,6) like '$today'  and Cekal='0'";
if ($_POST[tgl]!='') $search=" WHERE Kode like '$utd[id]%' and LENGTH(telp2)>9 and substring(TglLhr,6,6) like '$today' and Cekal='0'";
if ($_POST[gol_darah]!='semua') $search.=" AND GolDarah='$_POST[gol_darah]'";
if ($_POST[rhesus]!='semua') $search.=" AND Rhesus='$_POST[rhesus]'";
if ($_POST[kelurahan]!='') $search.=" AND kelurahan like '%$_POST[kelurahan]%' ";
if ($_POST[kecamatan]!='') $search.=" AND kecamatan like '%$_POST[kecamatan]%' ";
if ($_POST[wilayah]!='') $search.=" AND wilayah like '%$_POST[wilayah]%' ";
$pd=mysql_query("select nama,GolDarah,alamat,telp2,TglLhr,Jk,Status from pendonor $search");
$no=0;
while ($pd1=mysql_fetch_assoc($pd)) {
	if ($pd1[Jk]=='0' and $pd1[Status]=='1') $sapa='Bpk';
	if ($pd1[Jk]=='0' and $pd1[Status]=='0') $sapa='Sdr';
	if ($pd1[Jk]=='1' and $pd1[Status]=='1') $sapa='Ibu';
	if ($pd1[Jk]=='1' and $pd1[Status]=='0') $sapa='Sdri';
    $no++;
	if (strlen($pd1[telp2])>9) $telp=$pd1[telp2];
    echo "<tr><td>|</td><td>$no</td><td>|</td><td>$pd1[nama]</td><td>|</td><td>$pd1[GolDarah]($pd1[rhesus])</td><td>|</td><td>$pd1[alamat]</td><td>|</td><td>$pd1[instansi]</td><td>|</td><td>$telp</td><td>|</td><td>$pd1[tgl]</td><td>|</td></tr>";
    echo "<input type=hidden name=pendonor[] value=$telp>";
    echo "<input type=hidden name=namadonor[] value='$sapa, $pd1[nama]'>";
}
echo "</table></form>";
} 
if (isset($_POST[submit2])) {
    echo "Mengirimkan sms broadcast ultah......";
    for ($i=0;$i<sizeof($_POST[pendonor]);$i++) {
        $pendonor=$_POST[pendonor][$i];
        $namanya=$_POST[namadonor][$i];
	
        $kirim="insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
			values ('$pendonor','Yth. $namanya, $_POST[pesan]','1')";
$kirim1=mysql_query($kirim);
}
    echo '<META http-equiv="refresh" content="2; url=../pmip2d2s.php?module=sms_pending">';
}
if (!isset($_POST[submit1]) and !isset($_POST[submit2])) {
?>
<h1>Broadcast SMS Selamat Ulang Tahun</h1>
<form method=post>
<table>
<!--tr><td>
Tanggal Kegiatan</td><td>:</td><td>
<input type=text name=tgl id="datepicker" size=10>
</td></tr-->
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
