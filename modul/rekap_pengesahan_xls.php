<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_serahterima_sampelkantongdarah.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$id=$_POST[id1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];

?>
<?
$utd=mysql_fetch_assoc(mysql_query("select * from utd where aktif='1'"));
?>
<h3 colspan='18' class="table"><?=$utd[nama]?></h3>
<h5 colspan='18' class="table">Formulir Serah Terima Sampel dan Kantong darah Dari Tanggal :   <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?>
<br></h5>							  
<?
$a=mysql_query("select nokantong,tgl,shift,jns,ket,ygmenyerahkan,ygmengesahkan,penerimaktg from pengesahan where  CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' and up='1' and trans like '%$id%' order by tgl ASC");
	$TRec=mysql_num_rows($a);
?>
<h4>Jumlah sampel dan kantong darah yang diserahkan dari aftap = <?=$TRec?> Kantong </h4>            
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td rowspan='2' align='center'>No</td>
	<td rowspan='2' align='center'>Tanggal</td>
	<td rowspan='2' align='center'>No Kantong</td>
	<td rowspan='2' align='center'>Jenis</td>
        <td rowspan='2' align='center'>Gol & Rh<br>Darah</td>
        <td rowspan='2' align='center'>Tgl aftap</td>
	<td rowspan='2' align='center'>Status <br>Pengambilan</td>
        <td rowspan='2' align='center'>Shift</td>
	<td rowspan='2' align='center'>Asal</td>
	<td rowspan='2' align='center'>Instansi</td>
	<td rowspan='2' align='center'>Yang <br>Menyerahkan</td>
	<td rowspan='2' align='center'>Penerima <br>Sampel Darah</td>
	<td rowspan='2' align='center'>Penerima <br>Kantong Darah</td>
        <td colspan='9' align='center'>Hasil Konfirmasi <br> Gol Darah </td>	
	</tr>
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;">
		<td>-A</td>
		<td>-B</td>
		<td>TA</td>
		<td>TB</td>
		<td>TO</td>
		<td>AK</td>
		<td>-D</td>
		<td>BA</td>
		<td>Hasil</td>
	</tr>

</tr>
<?
$no=1;


while($a_dtransaksipermintaan=mysql_fetch_assoc($a)){
	
?>

	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
 
<?
$pengolahan=$a_dtransaksipermintaan[tgl];
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
	<td class=input><?=$a_dtransaksipermintaan[nokantong]?></td>
<?
$jenis=$a_dtransaksipermintaan[jns];
switch ($jenis)
{
case 1:
	$jenis='Single';
	break;
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
<?
$a_dtransaksipermintaan1=mysql_fetch_assoc(mysql_query("select gol_darah,RhesusDrh,tgl_Aftap from stokkantong where noKantong='$a_dtransaksipermintaan[nokantong]'"));
?>
	<td class=input><?=$a_dtransaksipermintaan1[gol_darah]?> (<?=$a_dtransaksipermintaan1[RhesusDrh]?>)</td>
       	<td class=input><?=$a_dtransaksipermintaan1[tgl_Aftap]?></td>
<?
$a_dtransaksipermintaan2=mysql_fetch_assoc(mysql_query("select Pengambilan,tempat,instansi from htransaksi where noKantong='$a_dtransaksipermintaan[nokantong]'"));
if ($a_dtransaksipermintaan[ket]=='0') $peng='Berhasil';
if ($a_dtransaksipermintaan[ket]=='2') $peng='Gagal';
if ($a_dtransaksipermintaan[ket]=='1') $peng='Batal';
if ($a_dtransaksipermintaan2[tempat]=='M') {$peng1='Mobile Unit';}else{$peng1='Dalam Gedung';}
?>
<?
$instansi=mysql_fetch_assoc(mysql_query("select nama from detailinstansi where KodeDetail='$a_dtransaksipermintaan2[instansi]'"));
?>
      	<td class=input><?=$peng?></td>
      	<td class=input><?=$a_dtransaksipermintaan[shift]?></td>
	<td class=input><?=$peng1?></td>
	<td class=input><?=$a_dtransaksipermintaan2[instansi]?></td>	
	<td class=input><?=$a_dtransaksipermintaan[ygmenyerahkan]?></td>
	<td class=input><?=$a_dtransaksipermintaan[ygmengesahkan]?></td>
	<td class=input><?=$a_dtransaksipermintaan[penerimaktg]?></td>
	<td></td>
	<td></td>	
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	</tr>
<?
}
?>



</table>
<?
mysql_close();
?>
