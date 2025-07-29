<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rincian_darah_keluar.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');


$today      =$_POST[today];
$today1     =$_POST[today1];
$src_status =$_POST[status];
$src_lay    =$_POST[layanan];
$src_shift  =$_POST[shift2];
$srcrm      =$_POST[norm];
$srcform    =$_POST[NoForm];
$src_rs     =$_POST[rs];
$hasil      =$_POST[hasil];

$produk 	=$_POST[produk];
$gol_darah 	=$_POST[gol_darah];
$rh_darah 	=$_POST[rh_darah];
$bagian 	=$_POST[bagian];
$wilayah 	=$_POST[wilayah];
$tempat 	=$_POST[tempat];


?>
<h1>REKAP DARAH KELUAR KE RUMAH SAKIT</h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>


<?
$transaksipermintaan=mysql_query("select * from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status like '%$src_status%' and rs like '%$src_rs%' and layanan like '%$src_lay' and shift_keluar like '%$src_shift%' and NoForm like '%$srcform%' and no_rm like '%$srcrm%' and StatusCross like '%$hasil%' and produk_darah like '%$produk%' and gol_darah like '%$gol_darah%' and rh_darah like '%$rh_darah%' and bagian like '%$bagian%' and wil_rs like '%$wilayah%' and tempat like '%$tempat%' order by NoForm ASC  ");



$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Total Darah keluar Ke Rumah sakit sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " kantong";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr>          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">No Formulir</td>
	
	<td colspan='6' align="center">DATA PASIEN</td>
	<td colspan='4' align="center">DATA RS</td>
	<td colspan='5' align="center">DATA PERMINTAAN</td>
	
	<td colspan='3' align="center">DATA KTG/DARAH</td>
        <td colspan='4' align="center">CROSSMATCH</td>
	<td colspan='6' align="center">PEMBAYARAN</td>
        </tr>
	<tr>
	<td align="center">No RM</td>
	<td align="center">Nama</td>
	<td align="center">Tgl. Lahir</td>
	<td align="center">Alamat</td>
	<td align="center">JK</td>
	<td align="center">Gol&Rh</td>

	<td align="center">Nama RS</td>
	<td align="center">Bagian</td>
	<td align="center">Klas</td>
	<td align="center">Ruangan</td>

	<td align="center">Jenis</td>
        <td align="center">Layanan</td>
	<td align="center">No Layanan</td>
	<td align="center">Tgl Minta</td>
	<td align="center">Shift</td>

	<td align="center">Nomor</td>
        <td align="center">Gol&Rh</td>
        <td align="center">Produk</td>

	<td align="center">Hasil</td>
	<td align="center">Petugas</td>
	<td align="center">Tgl</td>
	<td align="center">Shift</td>

	<td align="center">jenis<br>Biaya</td>
	<td align="center">Status</td>
	<td align="center">Tgl</td>
	<td align="center">Kasir</td>
	<td align="center">Shift</td>
	<td align="center">No Kwitansi</td>
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr>
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['NoForm']?></td>
	<td align="center"><?=$datatransaksipermintaan['no_rm']?></td>
	
	<? 	
	$pasien1=mysql_query("select * from pasien where no_rm='$datatransaksipermintaan[no_rm]'");
	$ambilpasien=mysql_fetch_array($pasien1);
	//$permintaan1=mysql_query("select * from htranspermintaan where no_rm='$datatransaksipermintaan[no_rm]'");
	//$permintaan=mysql_fetch_array($permintaan1);
	
	?>
	<td align="center"><?=$ambilpasien['nama']?></td>
	<td align="center"><?=$ambilpasien['tgl_lahir']?></td>
	<td align="center"><?=$ambilpasien['alamat']?></td>
	<td align="center"><?=$ambilpasien['kelamin']?></td>
	<td align="center"><?=$ambilpasien['gol_darah']?> (<?=$ambilpasien['rhesus']?> )</td>
	
	<? 	
	$rs1=mysql_query("select * from rmhsakit where Kode='$datatransaksipermintaan[rs]'");
	$ambilrs1=mysql_fetch_array($rs1);
	$layanan=mysql_query("select * from jenis_layanan where kode='$datatransaksipermintaan[layanan]'");
	$layanan1=mysql_fetch_array($layanan);
	$layanan2=mysql_query("select * from htranspermintaan where noform='$datatransaksipermintaan[NoForm]'");
	$layanan3=mysql_fetch_array($layanan2);
	?>
	<td align="center"><?=$ambilrs1['NamaRs']?></td>
	<td align="center"><?=$datatransaksipermintaan[bagian]?></td>
	<td align="center"><?=$layanan3['kelas']?></td>
	<td align="center"><?=$layanan3['ruangan']?></td>

			<?
			if ($layanan3[jenis_permintaan]=='0') $jenisminta='Biasa';
			if ($layanan3[jenis_permintaan]=='1') $jenisminta='Cadangan';
			if ($layanan3[jenis_permintaan]=='2') $jenisminta='Siap Pakai';
			if ($layanan3[jenis_permintaan]=='3') $jenisminta='Cyto';	
			 ?>
	<td class=input align=center><? echo $jenisminta?></td>
	<td align="center"><?=$layanan1['nama']?></td> 
	<td align="center"><?=$layanan3['nojenis']?></td> 
	<td align="center"><?=$layanan3['tglminta']?></td>
	<td align="center"><?=$layanan3['shift']?></td>

        <td align="center"><?=$datatransaksipermintaan['NoKantong']?></td>
	<? 	
	$kantong1=mysql_query("select * from stokkantong where NoKantong='$datatransaksipermintaan[NoKantong]'");
	$ambilkantong1=mysql_fetch_array($kantong1);
	
	?>
	<td align="center"><?=$datatransaksipermintaan['gol_darah']?>(<?=$datatransaksipermintaan['rh_darah']?>)</td>
	<td align="center"><?=$datatransaksipermintaan['produk_darah']?></td>
	<?
	$hasilcross='Compatible';
	if ($datatransaksipermintaan['StatusCross']=="0") $hasilcross='inCompatible Blh Klr';
	if ($datatransaksipermintaan['StatusCross']=="2") $hasilcross='inCompatible Tdk Blh Klr';
	$statuscross='DiBawa';
	if ($datatransaksipermintaan['Status']=="1") $statuscross='Titip';
	if ($datatransaksipermintaan['Status']=="B") $statuscross='Batal';
	?>

	<td align="center"><?=$hasilcross?></td>
	<td align="center"><?=$datatransaksipermintaan['petugas']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl']?></td>
	<td align="center"><?=$datatransaksipermintaan['shift']?></td>
	<? 	
	$pembayaran1=mysql_query("select * from dpembayaranpermintaan where notrans='$datatransaksipermintaan[NoForm]'");
	$pembayaran=mysql_fetch_array($pembayaran1);
	
	?>
	<td align="center"><?=$pembayaran['namabrg']?></td>
	
	<td align="center"><?=$statuscross?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_keluar']?></td>
	<td align="center"><?=$pembayaran['petugas']?></td>
	<td align="center"><?=$datatransaksipermintaan['shift_keluar']?></td>
	<? 	
	$kwitansi1=mysql_query("select * from kwitansi where NoForm='$datatransaksipermintaan[NoForm]'");
	$kwitansi=mysql_fetch_array($kwitansi1);
	?>
	<td align="center"><?=$kwitansi['nomer']?></td>
</tr>
<? $no++;} ?>
</table>

<?
mysql_close();
?>
