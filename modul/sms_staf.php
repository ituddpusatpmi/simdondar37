<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<?
if (isset($_POST[submit1])) {
echo "<a href=pmiadmin.php?module=sms_staf>KEMBALI</a>";
echo "<form method=post>
<table>
<tr><td valign=top>ISI Pesan</td><td valign=top>:</td><td><textarea rows=5 cols=50 wrap=physical name=pesan {font-family:Helvetica Neue, Helvetica, sans-serif; }></textarea></td></tr>
</table>

<input type=submit name=submit2 value='Kirimkan SMS!'>
";
echo "<table>";
$search=" WHERE length(telp)>9 ";
if ($_POST[nama_lengkap]!='') $search.=" AND nama_lengkap like '$_POST[nama_lengkap]'";
if ($_POST[level]!='') $search.=" AND level='$_POST[level]'";
if ($_POST[bagian]!='') $search.=" AND bagian like '$_POST[bagian]'";
if ($_POST[jabatan]!='') $search.=" AND jabatan like '$_POST[jabatan]'";
echo "<tr><td>|</td><td>NOMOR</td><td>|</td><td>NAMA STAF</td><td>|</td><td>TELP</td><td>|</td><td>LEVEL</td><td>|</td><td>BAGIAN</td><td>|</td><td>JABATAN</td><td>|</td></tr>";
echo " ";
$pd=mysql_query("SELECT nama_lengkap,telp,level,bagian,jabatan FROM `user` $search");
$no=0;
while ($pd1=mysql_fetch_assoc($pd)) {
    $no++;
    if (strlen($pd1[telp])>8) $telp=$pd1[telp];
    echo "<tr><td>|</td><td>$no</td><td>|</td><td>$pd1[nama_lengkap]</td><td>|</td><td>$pd1[telp]</td><td>|</td><td>$pd1[level]</td><td>|</td><td>$pd1[bagian]</td><td>|</td><td>$pd1[jabatan]</td><td>|</td></tr>";
    echo "<input type=hidden name=staf[] value='$pd1[telp]'>";
}
echo "</table></form>";
} 
if (isset($_POST[submit2])) {
    echo "Mengirimkan sms broadcast ke staf UDD......";
    for ($i=0;$i<sizeof($_POST[staf]);$i++) {
        $staf=$_POST[staf][$i];
	$nama=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where telp='$staf'"));     
 	$pesan1='Yth. '.$nama[nama_lengkap].', '.$_POST[pesan];
	  $kirim="insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
			values ('$staf','$pesan1','1')";
        //echo "$kirim <br>";
        $kirim1=mysql_query($kirim);
}
    echo '<META http-equiv="refresh" content="2; url=../pmip2d2s.php?module=sms_pending">';
}
if (!isset($_POST[submit1]) and !isset($_POST[submit2])) {
?>
<h1>Broadcast SMS ke STAF</h1>
<form method=post>
<table>
<tr><td>Nama</td><td>:</td><td><input name=nama type=text></td></tr>
<tr><td>Level</td><td>:</td><td><input name=level type=text></td></tr>
<tr><td>Bagian</td><td>:</td><td><input name=bagian type=text></td></tr>
<tr><td>Jabatan</td><td>:</td><td><input name=jabatan type=text></td></tr>
</table>
<input type=submit name=submit1 value=Submit>
</form>
<? } ?>
