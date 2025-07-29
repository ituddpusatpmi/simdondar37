<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Pemakaian_Bus_Donor.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');
$tanggalawal=$_POST['tgl1'];
$tanggalakhir=$_POST['tgl2'];
$namaperiode=$_POST['namaperiode'];

$bln1=substr($tanggalawal,5,2);
$tgl1=substr($tanggalawal,8,2);
$thn1=substr($tanggalawal,0,4);
$periode1=$tgl1.'/'.$bln1.'/'.$thn1;
$bln2=substr($tanggalakhir,5,2);
$tgl2=substr($tanggalakhir,8,2);
$thn2=substr($tanggalakhir,0,4);
$periode2=$tgl2.'/'.$bln2.'/'.$thn2;
$labelperiode="Periode : ".$namaperiode." ".$thn1." (".$periode1." s/d ".$periode2.")";
$sqlkegiatan="select  DATE_FORMAT( Tgl,  '%d/%m/%Y' ) AS tanggal, `Instansi`,`kendaraan`, count(`NoTrans`) as jml from htransaksi where kendaraan='1' and date(Tgl)>='$tanggalawal' and date(Tgl)<='$tanggalakhir' group by date(Tgl), `Instansi`,`kendaraan`";
$sq_bus=mysql_query($sqlkegiatan);
$utd= mysql_fetch_assoc(mysql_query("select * from utd where aktif=1"));
$no=0;
?>
<font size="4" color=red font-family="Arial">LAPORAN PEMAKAIAN BUS DONOR <?=$utd['nama']?><BR></font>
<font size="4" color=black font-family="Arial"><?=$labelperiode?><br></font>
<table width="900px">
	<tr>
		<td>NO</td>
		<td>TANGGAL</td>
		<td>INSTANSI KEGIATAN</td>
		<td>ALAMAT </td>
		<td>JUMLAH<br>DONOR</td>
	</tr>
	<?
	while($data=mysql_fetch_assoc($sq_bus)){
		$no++;
		$instansi=mysql_fetch_assoc(mysql_query("select alamat from detailinstansi where nama='$data[Instansi]' limit 1"));
	?>
	<tr>
	    <td align="right"><?=$no?>.</td>
	    <td align="center"><?=$data['tanggal']?></td>
	    <td align="left"><?=$data['Instansi']?></td>
	    <td align="left"><?=$instansi['alamat']?></td>
	    <td align="right"><?=$data['jml']?></td>
	</tr>
    <?}?>
</table>
<?
mysql_close();
?>