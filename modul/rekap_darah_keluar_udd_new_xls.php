<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_keluar_UDD_LAIN.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');


$today      =$_POST[today];
$today1     =$_POST[today1];
$src_bdrs 	=$_POST[bdrs];
$src_produk    	=$_POST[produk];
$src_status  	=$_POST[status];

?>
<h1>REKAP DARAH KELUAR KE UDD LAIN</h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>

<?
$transaksipermintaan=mysql_query("select s.noKantong,s.jenis,s.gol_darah,s.produk,s.RhesusDrh,s.tgl_Aftap,s.kadaluwarsa,s.tglperiksa,s.stat2,s.tgl_keluar,k.petugas,k.status from stokkantong as s, kirimudd as k where CAST(s.tgl_keluar as date) >='$today' and CAST(s.tgl_keluar as date) <='$today1' and s.noKantong=k.nokantong and s.Status='3' and s.stat2 like '%$src_bdrs%' and s.produk like '%$src_produk%' and k.status like '%$src_status%' order by s.tgl_keluar ASC  ");

//select noKantong,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar from stokkantong where CAST(tgl_keluar as date) >='$today' and CAST(tgl_keluar as date) <='$today1' and Status='3' and stat2 like 'b%' order by tgl_keluar ASC



$countp=mysql_num_rows($transaksipermintaan);
$namabdrs=mysql_fetch_assoc(mysql_query("select nama from utd where id = '$src_bdrs' "));
echo"<br><br>";
echo"Total Darah keluar $namabdrs[nama] sebanyak ";
echo"<b>";
echo $countp;
echo"</b>";
echo " kantong";
?>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<td>Nama UDD</td>
	<td>No Kantong</td>
        <td>Gol (Rh) Darah</td>
        <td>Komponen</td>
        <td>Tgl Aftap</td>
	<td>Tgl Exp.</td>
        <td>Tgl Periksa</td>
	<td>Jenis</td>
	<td>Petugas</td>
	<td>Status</td>	
        </tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>
<tr style="background-color:#FF6346; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	
	
	<? 	
	$bdrs=mysql_fetch_assoc(mysql_query("select * from utd where id='$datatransaksipermintaan[stat2]'"));
	
	?>
	<td align="left"><?=$bdrs['nama']?></td>
	<td align="center"><?=$datatransaksipermintaan['noKantong']?></td>
	<td align="center"><?=$datatransaksipermintaan['gol_darah']?> (<?=$datatransaksipermintaan['RhesusDrh']?> )</td>
	<td align="center"><?=$datatransaksipermintaan['produk']?></td>
	<td align="center"><?=$datatransaksipermintaan['tgl_Aftap']?></td>
	<td align="center"><?=$datatransaksipermintaan['kadaluwarsa']?></td>
	<td align="center"><?=$datatransaksipermintaan['tglperiksa']?></td>
	<?
	$jns="Double";
	if ($a_dtransaksipermintaan[jenis]=='1') $jns="Single";
	if ($a_dtransaksipermintaan[jenis]=='3') $jns="Threeple";
	if ($a_dtransaksipermintaan[jenis]=='4') $jns="Quadruple";
	if ($a_dtransaksipermintaan[jenis]=='6') $jns="Pediatrik";

		?>
	<td align="center"><?=$jns?></td>
	<td align="center"><?=$datatransaksipermintaan['petugas']?></td>
			<?
			if ($datatransaksipermintaan[status]=='0') $status='keluar';
			if ($datatransaksipermintaan[status]=='1') $status='Kembali';	
			 ?>
	<td align="center"><?=$status?></td>
</tr>
<? $no++;} ?>
</table>
