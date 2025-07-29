<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_data_pendonor.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');

$kode		=$_POST[kode];
$nama		=$_POST[nama];
$jk		=$_POST[jk];
$alamat		=$_POST[alamat];
$hp		=$_POST[hp];
$lhr		=$_POST[lhr];
$kelurahan	=$_POST[kelurahan];
$kecamatan	=$_POST[kecamatan];
$goldar		=$_POST[goldar];
$rhesus		=$_POST[rhesus];
$cekal		=$_POST[cekal];


?>
<h1>REKAP DATA PENDONOR</h1>


<?
$transaksipermintaan=mysql_query("select * from pendonor where Kode like '%$kode%' and Nama like '%$nama%' and Jk like '%$jk%' and Alamat like '%$alamat%' and telp2 like '%$hp%' and TglLhr like '%$lhr%' and kelurahan like '$kelurahan%' and kecamatan like '$kecamatan%' and GolDarah like '$goldar%' and Rhesus like '%$rh%' and Cekal like '%$cekal%' order by GolDarah ASC  ");



$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Total Data Yang terpilih ";
echo"<b>";
echo $countp;
echo"</b>";
echo " Data";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">Kode</td>
	
	<td rowspan='2' align="center">Nama</td>
	<td rowspan='2' align="center">Alamat</td>
	<td rowspan='2' align="center">JK</td>
	
	<td colspan='2' align="center">Darah</td>
       <td rowspan='2' align="cemter">Donasi</td>
        <td rowspan='2' align="center">Handphone</td>
	<td rowspan='2' align="center">Kelurahan</td>
	<td rowspan='2' align="center">Kecamatan</td>
	<td rowspan='2' align="center">Tgl Kembali</td>  
	<td colspan='2' align="center">Status</td>      
	</tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">Gol</td>
	<td align="center">Rh</td>
	<td align="center">IMLTD</td>
	<td align="center">DONOR</td>
	
	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF6346; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	<td align="left"><?=$datatransaksipermintaan['Kode']?></td>
	<td align="left"><?=$datatransaksipermintaan['Nama']?></td>
	<td align="left"><?=$datatransaksipermintaan['Alamat']?></td>
			<?
			if ($datatransaksipermintaan[Jk]=='0') $kelamin='Laki-Laki';
			if ($datatransaksipermintaan[Jk]=='1') $kelamin='Perempuan';
			?>
	
	<td align="left"><?=$kelamin?></td>
	<td align="center"><?=$datatransaksipermintaan['GolDarah']?></td>
	<td align="center"><?=$datatransaksipermintaan['Rhesus']?></td>
	<td align="center"><?=$datatransaksipermintaan['jumDonor']?>x</td>
	<td align="left"><?=$datatransaksipermintaan['telp2']?></td>
	<td align="left"><?=$datatransaksipermintaan['kelurahan']?></td>
	<td align="left"><?=$datatransaksipermintaan['kecamatan']?></td>

			<?
			if ($datatransaksipermintaan[Cekal]=='0') $status='-';
			if ($datatransaksipermintaan[Cekal]=='1') $status='Confirm';
			 ?>
	
	<td class=input align=center><?=$datatransaksipermintaan['tglkembali']?></td>
	<td class=input align=center><?=$status?></td>
			<?
			if ($datatransaksipermintaan[tglkembali] <= $today) $donor='Tiba Saat Donor';
			if ($datatransaksipermintaan[tglkembali] > $today) $donor='Belum Saat Donor';
			if ($datatransaksipermintaan[Cekal] == '1')  $donor='Tidak Boleh Donor' ;
			?>
	
	<td class=input align=left><?=$donor?></td>
</tr>
<? $no++;} ?>
</table>

<?
mysql_close();
?>
