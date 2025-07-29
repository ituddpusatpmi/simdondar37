<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_rekap_Pembuatan_Komponen.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$shift=$_POST[shift];
$produk1=$_POST[produk1];
$trs=$_POST[trs];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];

?>
<h5 colspan='9' class="table">Pengiriman Komponen Darah Dari Tanggal :   <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?> <br>
Transaksi Ke <?=$trs?> Shift :<?=$shift?>
<br></h5>
<?
$a=mysql_query("select noKantong,tgl,produk,cara,goldarah,rhesus,tgl,jenis,pisah,petugas from dpengolahan where  CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' AND shift like '%$shift%' AND trans like '%$trs%' and Produk like '%$produk%' order by tgl,goldarah ASC");
	$TRec=mysql_num_rows($a);
?>
<h4>Total Hasil pembuatan komponen = <?=$TRec?> Kantong Produk darah </h4>
<table border=1 cellpadding=0 cellspacing=0>
<tr>          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2'>No</td>
	<td rowspan='2'>Tanggal</td>
	<td rowspan='2'>No Kantong</td>
	<td rowspan='2'>Kantong</td>
        <td rowspan='2'>Gol Darah</td>
        <td rowspan='2'>Jenis</td>
        <td rowspan='2'>Tgl Aftap</td>
	<td rowspan='2'>Tgl Kadaluwarsa</td>
        <td rowspan='2'>Tgl Periksa</td>
	<td rowspan='2'>Status</td>
	<td rowspan='2'>petugas</td>
	<td colspan='2'>Alat</td>
	</tr>
	<tr>
	<td>Pemutaran</td>
	<td>Pemisahan</td>
	</tr>
</tr>
<?
$no=1;


while($a_dtransaksipermintaan=mysql_fetch_assoc($a)){

$ktg=mysql_fetch_assoc(mysql_query("select * from stokkantong where noKantong='$a_dtransaksipermintaan[noKantong]'"));
	
?>

	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
 
<?
$pengolahan=$ktg[tglpengolahan];
$tglkel=date("d",strtotime($pengolahan));
$blnkel=date("n",strtotime($pengolahan));
$thnkel=date("Y",strtotime($pengolahan));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam = date("H:i:s",strtotime($pengolahan));
?>
<td class=input><?=$tglkel?>-<?=$bln22?>-<?=$thnkel?> <?=$jam?></td>


<!--?
$blnkel=substr($a_dtransaksipermintaan[tglpengolahan],5,2);
$tglkel=substr($a_dtransaksipermintaan[tglpengolahan],8,2);
$thnkel=substr($a_dtransaksipermintaan[tglpengolahan],0,4);
?>
      	<td class=input><?=$tglkel?>-<?=$blnkel?>-<?=$thnkel?></td-->
	<td class=input><?=$a_dtransaksipermintaan[noKantong]?></td>
<?
$jenis=$a_dtransaksipermintaan[jenis];
switch ($jenis)
{

case 2:
	$jenis='Double';
	break;
case 3:
	$jenis='Triple';
	break;
case 4:
	$jenis='Quadruple';
	break;
case 6:
	$jenis='Pediatrik';
	break;
	
}
?>
	<td class=input><?=$jenis?></td>
	<td class=input><?=$a_dtransaksipermintaan[goldarah]?> (<?=$ktg[RhesusDrh]?>)</td>
	<td class=input><?=$a_dtransaksipermintaan[produk]?></td>
       	<td class=input><?=$ktg[tgl_Aftap]?></td>
      	<td class=input><?=$ktg[kadaluwarsa]?></td>
      	<td class=input><?=$ktg[tglperiksa]?></td>
<?

$status=$ktg[Status];
switch ($status)
{
case 0:
	$status='Kosong';
	break;
case 1:
	$status='Darah Karantina';
	break;
case 2:
	$status='Sehat';
	break;
case 3:
	$status='Keluar';
	break;
case 4:
	$status='Reaktif';
	break;
case 5:
	$status='Darah Rusak';
	break;
case 6:
	$status='Darah Dimusnahkan';
	break;
	
}

?>
	<td class=input><?=$status?></td>
<?$petugas=mysql_fetch_assoc(mysql_query("select petugas,cara,pisah from dpengolahan where noKantong='$a_dtransaksipermintaan[noKantong]'"));

$petugas1=mysql_fetch_assoc(mysql_query("select Pisah, Putar from hpengolahan where nokantong='$a_dtransaksipermintaan[noKantong]'"));



?>
	<td class=input><?=$a_dtransaksipermintaan[petugas]?></td>
	<td class=input><?=$petugas1[Putar]?></td>
	<td class=input><?=$petugas1[Pisah]?></td>

	</tr>
<?
}
?>



</table>
<h5 colspan='9' align='right'>Yang Menyerahkan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Yang Menerima</h5>
<br>
<p>
<h5 colspan='9' align='right'>........................&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;........................<br></h5>
<?
mysql_close();
?>
