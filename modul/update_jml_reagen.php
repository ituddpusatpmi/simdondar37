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
$sehatup1=mysql_query("update reagen set jumTest='$_POST[id]'  where kode='$_POST[kode]' and noLot='$_POST[nokantong]' and jumTest='$_POST[id1]' and aktif='1' ");
//$sehatup2=mysql_query("update htransaksi set kodependonor='$_POST[id]'  where NoKantong='$_POST[nokantong]' ");
//$sehatup3at=mysql_query("update stokkantong set kodependonor='$_POST[id1]'  where noKantong='$_POST[nokantong1]' ");
//$sehatup4=mysql_query("update htransaksi set kodependonor='$_POST[id1]'  where NoKantong='$_POST[nokantong1]' ");
//$total=mysql_num_rows(mysql_query("select noKantong from stokkantong where gol_darah='$_POST[gol_darah]' and Status='$_POST[status]' and produk='$_POST[produk]' and sah='1'"));
if ($sehatup1) echo "Data Jumlah Reagen Dengan kode: $_POST[kode] telah diupdate dan ";
//if ($sehatup2) echo "Data transaksi pendonor dengan Kode: $_POST[id] dan $_POST[id1] telah diupdate";
}
?>


	<body onLoad=setFocus()>
<!--b>Pengosongan Stok</b>:<br>
<form name=kosong method=POST>
<input type=submit name=submit0 value='KOSONGKAN !!!!'-->
</form>
<br>
<b>UPDATE JUMLAH TEST REAGEN</b><br>
<br>
<b>Masukkan Kode reagen beserta Nomor Lot reagen yang sesuai dengan jumlah atau sisa testnya</b><br>
<form name=sehat method=POST>
<table>
<tr><td>Kode Reagen</td><td>:</td><td> <input type=text name=kode size=15 value=<?=$_POST[kode]?>>
</td></tr>
<tr><td>Nomor Lot Ragen</td><td>:</td><td> <input type=text name=nokantong size=15 value=<?=$_POST[nokantong]?>>
<tr><td>Jumlah Test Sebelumnya</td><td>:</td><td>  <input type=text name=id1 size=20 value=<?=$_POST[id1]?>>
<tr><td>Jumlah Test Sekarang</td><td>:</td><td>  <input type=text name=id size=20 value=<?=$_POST[id]?>>
</td></tr>
<!--tr><td>Nomor Kantong 2</td><td>:</td><td> <input type=text name=nokantong1 size=15 value=<?=$_POST[nokantong1]?>>
</td></tr-->
</td></tr-->
</table>
<input type=submit name=submit value=Submit>
<br/><br/><br/>



<? $data=mysql_query("select * from reagen where jumTest>'0' and aktif='1' order by tglKad"); 
$jml=mysql_num_rows($data);
echo "<b> Jumlah reagen yang sudah diaktifkan : $jml kit</b>";
?>
<table class="list" cellpadding=5>
	<tr class="field">
				<td>No.</td>
		<td>Kode</td>
		<td>Nama Reagen</td>
		<td>No. Lot</td>
		<td>Jumlah Test</td>
		<td>Tgl Kadaluwarsa</td>
		
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		if ($data1[StatTempat]=='') $tempat="Logistik Belum Dipindahkan";
		if ($data1[StatTempat]=='1') $tempat="Aftap Belum Terpakai";
		switch ($data1[jenis]){
                       case "1":
				$jenis="Single";
				break;
                       case "2":
				$jenis="Double";
				break;
                       case "3":
				$jenis="Triple";
				break;
                       case "4":
				$jenis="Quadruple";
				break;
                       case "6":
				$jenis="Pediatrik";
				break;
		}
		?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[kode]?></td>
		<td><?=$data1[Nama]?></td>
		<td><?=$data1[noLot]?></td>
		<td><?=$data1[jumTest]?></td>
		<td><?=$data1[tglKad]?></td>
		
	</tr>
<? } ?>
</table>




</form>
<? } ?>



</body>
