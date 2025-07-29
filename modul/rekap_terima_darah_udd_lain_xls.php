<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Laporan_rekap_terima_darah.xls");
header("Pragma: no-cache");
header("Expires: 0");
include('../config/db_connect.php');
$pertgl=$_POST[pertgl];
$perbln=$_POST[perbln];
$perthn=$_POST[perthn];
$pertgl1=$_POST[pertgl1];
$perbln1=$_POST[perbln1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$_POST[today1];

?>
<h5 class="table">Rekap Terima Darah dari UDD lain Tangal :   <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?>
</h5>
<div>

</form></div>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<td>Tanggal Terima</td>
	<td>Asal UDD</td>
	<td>No Kantong</td>
	<td>Jenis Kantong</td>
        <td>Gol Darah</td>
        <td>Jenis Komponen</td>
        <td>Tgl Aftap</td>
	<td>Tgl Kadaluwarsa</td>
        <td>Tgl Periksa</td>
	<td>Petugas</td>
	
	
	</tr>

</tr>	
<?
//$trans0=mysql_query("select dt.NoForm,dt.NoKantong,dp.JenisDarah,dp.GolDarah,dp.Rhesus
//					from dtransaksipermintaan as dt, dtranspermintaan as dp, dpembayaran as dpem
//					where dpem.tgl='$today' and dt.NoForm=dp.NoForm and dpem.NoForm=dp.noForm and dt.Status='L' group by NoForm");
$no=1;
$q_dtransaksipermintaan=mysql_query("select noKantong,jenis,gol_darah,produk,RhesusDrh,tgl_Aftap,kadaluwarsa,tglperiksa,stat2,tgl_keluar,tglTerima,AsalUTD from stokkantong where CAST(tglTerima as date)>='$today' and CAST(tglTerima as date)<='$today1' and AsalUTD is not NULL order by tglTerima ASC");
$TRec=mysql_num_rows($q_dtransaksipermintaan);
while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	$q_stok=mysql_query("select gol_darah,produk,RhesusDrh from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
//	$q_dhasilcross=mysql_query("select Pemeriksa from dhasilcross where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
	$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$a_dtransaksipermintaan[NoKantong]') "));
	$waktu=mysql_fetch_assoc(mysql_query("(select tglPeriksa as tgl from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select tgl_tes as tgl from testrapid where nokantong='$a_dtransaksipermintaan[NoKantong]') "));
	$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
	$pembayaran=mysql_query("select namabrg,petugas,subTotal,shift from dpembayaranpermintaan where no_kantong='$a_dtransaksipermintaan[NoKantong]' and notrans='$a_dtransaksipermintaan[NoForm]' ");
	$shift=mysql_query("select shift,NamaOS,bagian,TglMinta,rs,jenis from htranspermintaan where NoForm='$a_dtransaksipermintaan[NoForm]' ");
	$utd1=mysql_query("select nama from utd where id='$a_dtransaksipermintaan[AsalUTD]'");
	$utd=mysql_fetch_assoc($utd1);
	$a_stok=mysql_fetch_assoc($q_stok);
	$a_bayar=mysql_fetch_assoc($pembayaran);
	$a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	$a_shift=mysql_fetch_assoc($shift);

	echo mysql_error();
	if($a_stok[produk]!=''){
		$produk=$a_stok[produk];
	}else{
		$produk='WB';
	}
	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td><?=$no++?></td>
<?
$tgl_form=$a_dtransaksipermintaan[tglTerima];
$tglf=date("d",strtotime($tgl_form));
$blnf=date("n",strtotime($tgl_form));
$thnf=date("Y",strtotime($tgl_form));
$bulanf=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$blnf1=$bulanf[$blnf];
$jamf = date("H:i:s",strtotime($tgl_form));

/*
$blnmin=substr($trans[TglMinta],5,2);
$tglmin=substr($trans[TglMinta],8,2);
$thnmin=substr($trans[TglMinta],0,4);*/
?>
      <td class=input><?=$tglf?> <?=$blnf1?> <?=$thnf?> <?=$jamf?></td>

	<td class=input><?=$utd[nama]?></td>    


	<td class=input><?=$a_dtransaksipermintaan[noKantong]?></td>
<?
$jenis='Double';
if ($a_dtransaksipermintaan[jenis]=='1') $jenis='Single';
if ($a_dtransaksipermintaan[jenis]=='3') $jenis='Triple';
if ($a_dtransaksipermintaan[jenis]=='4') $jenis='Quadruple';
if ($a_dtransaksipermintaan[jenis]=='6') $jenis='Pediatrik';
?>
	<td class=input><?=$jenis?></td>
	<td class=input><?=$a_dtransaksipermintaan[gol_darah]?> (<?=$a_dtransaksipermintaan[RhesusDrh]?>)</td>
	<td class=input><?=$a_dtransaksipermintaan[produk]?></td>
       	<td class=input><?=$a_dtransaksipermintaan[tgl_Aftap]?></td>
      	<td class=input><?=$a_dtransaksipermintaan[kadaluwarsa]?></td>
      	<td class=input><?=$a_dtransaksipermintaan[tglperiksa]?></td>
<?
$petugas=mysql_fetch_assoc(mysql_query("select * from terimaudd where nokantong='$a_dtransaksipermintaan[noKantong]'"));
?>

	<td class=input><?=$petugas[petugas]?></td>

	</tr>
<?
}
?>
</table>

<?
mysql_close();
?>
