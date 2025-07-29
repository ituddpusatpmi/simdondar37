<? include ('config/db_connect.php'); ?>
<script language="javascript">
function setFocus(){document.sehat.kode.focus();}
</script>
<?
$today1=date("Y-m-d");
?>
<?
if ($_POST[konfirmasi]=='1') {
mysql_query("update stokkantong set status='3' where (status='1' or status='2')");
mysql_query("update dtransaksipermintaan set status='0' where status='1'");
}
if (isset($_POST[submit0])) {
?>
Anda Yakin akan mengosong seluruh STOK Darah ???
<br>
<form name=konfirm method=post>
<input type=hidden name=konfirmasi value='1'>
<input type=submit name=submit01 value='Klik Disini jika Ya'>
</form>
<?
} else {
if (isset($_POST[submit])) {

$sehatup1=mysql_query("update stokkantong set Status='1',sah='1',stattempat='1',produk='WB' where noKantong='$_POST[kode]' and Status != '0'");
$total=mysql_num_rows(mysql_query("select noKantong from stokkantong"));
$ulang=mysql_fetch_assoc(mysql_query("select Status from stokkantong where noKantong ='$_POST[kode]'"));
if ($ulang[Status]=='0') {echo "Kantong: $_POST[kode] Belum diinput data pendonor, silahkan input data pendonor dan data IMLTD";}
else{ echo "Kantong: $_POST[kode]  Telah diubah menjadi darah KARANTINA";}
}
?>
	<body onLoad=setFocus()>
<!--b>Pengosongan Stok</b>:<br>
<form name=kosong method=POST>
<input type=submit name=submit0 value='KOSONGKAN !!!!'-->
</form>
<br>
<b>Update stock menjadi sehat</b>:<br>
<form name=sehat method=POST>
<table>
<tr><td>No Kantong </td><td>:</td><td>  <input type=text name=kode id=kode>
</td></tr>
</table>
<input type=submit name=submit value=Submit>
</form>
<? } ?>
</body>
