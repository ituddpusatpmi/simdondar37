<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<link type="text/css" href="../css/blitzer/suwena.css" rel="stylesheet" />
<?
if (isset($_POST[submit1])) {
echo "";
echo "<form method=post>
<table>
<tr><td valign=top>ISI Pesan</td><td valign=top>:</td><td><textarea rows=5 cols=50 wrap=physical name=pesan {font-family:Helvetica Neue, Helvetica, sans-serif; }></textarea></td></tr>
</table>

<input type=submit name=submit2 class=swn_button_blue value='Kirimkan Pesan'>
<a href=pmip2d2s.php?module=wa_staff class=swn_button_red>KEMBALI</a>
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
	  

	//kirim wa ke cloud design by nurdin
	$postData = array(
       "phone" => "$staf",
        "message" => "Yth. $nama[nama_lengkap], $_POST[pesan]",
	);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://region01.krmpesan.com/api/v2/message/send-text");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$headers = array();
	$headers[] = "Accept: application/json";
	$headers[] = "Authorization: Bearer yh4mKiyuBtRHMzIdnJoomIrOOimPTLHV93CLRF330r7rZnjQwZ2AvqpsSpooS1Rg8OXNGJ4vrCeBIgeN";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo "Error:" . curl_error($ch);
	}
	curl_close($ch);
	print_r($result);
	//akhir kirim wa ke cloud design by nurdin


}
    echo '<META http-equiv="refresh" content="2; url=../pmip2d2s.php?module=wa_staff">';
}
if (!isset($_POST[submit1]) and !isset($_POST[submit2])) {
?>
<h1>WhatsApp Broadcast Staff UDD PMI</h1>
<form method=post>
<table>
<tr><td>Nama</td><td>:</td><td><input name=nama type=text></td></tr>
<tr><td>Level</td><td>:</td><td><input name=level type=text></td></tr>
<tr><td>Bagian</td><td>:</td><td><input name=bagian type=text></td></tr>
<tr><td>Jabatan</td><td>:</td><td><input name=jabatan type=text></td></tr>
</table>
<input type=submit name=submit1 class=swn_button_blue value=Submit>
</form>
<? } ?>
