<? include ('config/db_connect.php'); ?>
<script language="javascript">
function setFocus(){document.sehat.kode.focus();}
</script>
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
$sehatup1=mysql_query("update stokkantong set Status='$_POST[status]',volume='$_POST[volume]',produk='$_POST[produk]',sah='1',gol_darah='$_POST[gol_darah]',tgl_Aftap='$_POST[tgl_aftap]',kadaluwarsa='$_POST[tgl_kadaluarsa]',tglpengolahan='$_POST[tgl_pengolahan]',tglperiksa='$_POST[tgl_periksa]' where noKantong='$_POST[kode]'");
//$sehatup1=mysql_query("update stokkantong set volume='$_POST[volume]',produk='$_POST[produk]',sah='1',gol_darah='$_POST[gol_darah]',kadaluwarsa='$_POST[tgl_kadaluarsa]' where noKantong='$_POST[kode]'");
$total=mysql_num_rows(mysql_query("select noKantong from stokkantong where gol_darah='$_POST[gol_darah]' and Status='$_POST[status]' and produk='$_POST[produk]' and sah='1'"));
if ($sehatup1) echo "Kantong dengan nomor : $_POST[kode]  telah diupdate, untuk info klik  CHECK STOK dibagian atas";
//<br>Total Golongan Darah $_POST[gol_darah]  Komponen $_POST[produk] sekarang: <b>$total</b>";
}
?>
	<body onLoad=setFocus()>
<!--b>Pengosongan Stok</b>:<br>
<form name=kosong method=POST>
<input type=submit name=submit0 value='KOSONGKAN !!!!'-->
</form>
<br>
<b>Update Stock</b>:<br>
<form name=sehat method=POST>
<table>
<tr><td>
Golongan Darah </td><td>:</td><td> <input type=text name=gol_darah size=3 value=<?=$_POST[gol_darah]?>>
</td></tr>
<tr><td>Jenis Produk (WB,PRC,TC,LP,FP,FFP)</td><td>:</td><td>  <input type=text name=produk size=3 value=<?=$_POST[produk]?>>
</td></tr>
<tr><td>Volume</td><td>:</td><td>  <input type=text name=volume size=3 value=<?=$_POST[volume]?>>
</td></tr>
<tr><td>Status (karantina=1,sehat=2)</td><td>:</td><td>  <input type=text name=status size=3 value=<?=$_POST[status]?>>
</td></tr>
<tr><td>Tanggal Aftap (th-bln-tgl)</td><td>:</td><td>  <input type=text name=tgl_aftap size=7 value=<?=$_POST[tgl_aftap]?>>
</td></tr>
<tr><td>Tanggal Kadaluarsa (th-bln-tgl)</td><td>:</td><td>  <input type=text name=tgl_kadaluarsa size=7 value=<?=$_POST[tgl_kadaluarsa]?>>
</td></tr>
<tr><td>Tanggal Pengolahan (th-bln-tgl)</td><td>:</td><td>  <input type=text name=tgl_pengolahan size=7 value=<?=$_POST[tgl_pengolahan]?>>
</td></tr>
<tr><td>Tanggal Periksa (th-bln-tgl)</td><td>:</td><td>  <input type=text name=tgl_periksa size=7 value=<?=$_POST[tgl_periksa]?>>
</td></tr>
<tr><td>No Kantong </td><td>:</td><td>  <input type=text name=kode id=kode>
</td></tr>
</table>
<input type=submit name=submit value=Submit>
</form>
<? } ?>
</body>
