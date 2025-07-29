<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=daftar_jadwal_donor_instansi.xls");
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
$namauser	=$_POST[user];


?>
<h2>DAFTAR JADWAL DONOR INSTANSI</h2>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>


<?$transaksipermintaan=mysql_query("SELECT * from detailinstansi where CAST(tgldonor_lagi as date)>='$today' and CAST(tgldonor_lagi as date)<='$today1' AND KodeHeader like '%$produk%' and nama like '%$srcform%'  order by nama ASC  ");
//$transaksipermintaan=mysql_query("select * from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and status like '%$src_status%' and rs like '%$src_rs%' and layanan like '%$src_lay' and shift like '%$src_shift%' and NoForm like '%$srcform%' and no_rm like '%$srcrm%' and StatusCross like '%$hasil%' and produk_darah like '%$produk%' and gol_darah like '%$gol_darah%' and rh_darah like '%$rh_darah%' and bagian like '%$bagian%' and wil_rs like '%$wilayah%' and tempat like '%$tempat%' order by NoForm ASC  ");



$countp=mysql_num_rows($transaksipermintaan);
echo"Total data sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " Instansi";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr>          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">KELOMPOK</td>
	
	<td rowspan='2' align="center">NAMA</td>
	<td rowspan='2' align="center">ALAMAT</td>
	<td colspan='2' align="center">CP</td>
	
	<td rowspan='2' align="center">JUMLAH<br>KEGIATAN</td>
        <td rowspan='2' align="center">TANGGAL <br> TERAKHIR <br>DONOR</td>
	<td rowspan='2' align="center">JADWAL <br> DONOR<br>KEMBALI</td>
        </tr>
	<tr>
	<td align="center">Nama</td>
	<td align="center">Telp</td>
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr>
	<td align="center"><?=$no?></td>
	<td align="left"><?=$datatransaksipermintaan['KodeHeader']?></td>
	<td align="left"><?=$datatransaksipermintaan['nama']?></td>
	<td align="left"><?=$datatransaksipermintaan['alamat']?></td>
	<td align="left"><?=$datatransaksipermintaan['cp']?></td>
	<td align="left"><?=$datatransaksipermintaan['telp']?></td>
	<td align="left"><?=$datatransaksipermintaan['jumdonor']?> x</td>
	<td align="left"><?=$datatransaksipermintaan['tglakhir_donor']?></td>
	<td align="left"><?=$datatransaksipermintaan['tgldonor_lagi']?></td>
	
</tr>
<? $no++;} ?>
</table>

<table>

<?

$sekarang=date("Y-m-d");
$perbln1=substr($sekarang,5,2);
$pertgl1=substr($sekarang,8,2);
$perthn1=substr($sekarang,0,4);
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$perbln1];
$jam = date("H:i:s");
$namahari=date("l");
if ($namahari == "Sunday") $namahari = "Minggu";
else if ($namahari == "Monday") $namahari = "Senin";
else if ($namahari == "Tuesday") $namahari = "Selasa";
else if ($namahari == "Wednesday") $namahari = "Rabu";
else if ($namahari == "Thursday") $namahari = "Kamis";
else if ($namahari == "Friday") $namahari = "Jumat";
else if ($namahari == "Saturday") $namahari = "Sabtu";
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
?>
<tr ><td></td><td></td><td align=center><?=$udd[nama]?></tr>
<tr><td></td><td></td><td align=center> <?=$namahari?>, <?=$pertgl1?> <?=$bln22?> <?=$perthn1?></td></tr>
<tr><td></td><td></td><td align="center">Yang Merekap</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td align="center"><?=$namauser?></td></tr>
</table>


<?
mysql_close();
?>
