<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_darah_buang.xls");
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
<h5 class="table">Rekap Pembuangan Darah dari Tgl : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai Tgl: <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h5>

<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td>No</td>
	<td>No Kantong</td>
	<td>Gol & Rh</td>
	<td>Produk</td>
	<td>Volume</td>
	<td>Tgl Aftap</td>
	<td>Tgl Kadaluarsa</td>
        <td>Tgl Buang</td>
	<td>Alasan Buang</td> 
	<td>Petugas Buang</td>
	<td>Kode Pendonor</td>
        </tr>

<?
//$trans0=mysql_query("select dt.NoForm,dt.NoKantong,dp.JenisDarah,dp.GolDarah,dp.Rhesus
//					from dtransaksipermintaan as dt, dtranspermintaan as dp, dpembayaran as dpem
//					where dpem.tgl='$today' and dt.NoForm=dp.NoForm and dpem.NoForm=dp.noForm and dt.Status='L' group by NoForm");
$no=1;
$q_dtransaksipermintaan=mysql_query("select noKantong,user,tgl_buang,volume,produk,tgl_Aftap,kadaluwarsa,gol_darah, RhesusDrh,kodePendonor,alasan_buang from ar_stokkantong where CAST(tgl_buang as date)>='$today' and CAST(tgl_buang as date)<='$today1' order by tgl_buang ASC ");
$TRec=mysql_num_rows($q_dtransaksipermintaan);

while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	$q_stok=mysql_query("select gol_darah,produk,RhesusDrh from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
//	$q_dhasilcross=mysql_query("select Pemeriksa from dhasilcross where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
//	$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$a_dtransaksipermintaan[NoKantong]') "));
//	$waktu=mysql_fetch_assoc(mysql_query("(select tglPeriksa as tgl from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select tgl_tes as tgl from testrapid where noKantong='$a_dtransaksipermintaan[NoKantong]') "));
//	$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
//	$pembayaran=mysql_query("select namabrg,petugas,subTotal,shift from dpembayaranpermintaan where no_kantong='$a_dtransaksipermintaan[NoKantong]' and notrans='$a_dtransaksipermintaan[NoForm]' ");
//	$shift=mysql_query("select shift,NamaOS,bagian,TglMinta,rs,jenis from htranspermintaan where NoForm='$a_dtransaksipermintaan[NoForm]' ");
	$a_stok=mysql_fetch_assoc($q_stok);
	$a_bayar=mysql_fetch_assoc($pembayaran);
	$a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	$a_shift=mysql_fetch_assoc($shift);
$alasan='Kadaluarsa';
if ($a_dtransaksipermintaan[alasan_buang]=='0') $alasan='Gagal Aftap';
if ($a_dtransaksipermintaan[alasan_buang]=='3') $alasan='Plebotomi';
if ($a_dtransaksipermintaan[alasan_buang]=='4') $alasan='Reaktif diBuang';
if ($a_dtransaksipermintaan[alasan_buang]=='5') $alasan='Lifemik';
if ($a_dtransaksipermintaan[alasan_buang]=='6') $alasan='Greyzone';
if ($a_dtransaksipermintaan[alasan_buang]=='7') $alasan='DCT Positif';
if ($a_dtransaksipermintaan[alasan_buang]=='8') $alasan='Kantong Bocor';
if ($a_dtransaksipermintaan[alasan_buang]=='1') $alasan='Lisis';
if ($a_dtransaksipermintaan[alasan_buang]=='9') $alasan='Satelit Rusak';
if ($a_dtransaksipermintaan[alasan_buang]=='10') $alasan='Bekas Pembuatan WE';
if ($a_dtransaksipermintaan[alasan_buang]=='11') $alasan='Reaktif Rujuk keUDDP';
if ($a_dtransaksipermintaan[alasan_buang]=='12') $alasan='Hematokrit Tinggi';
if ($a_dtransaksipermintaan[alasan_buang]=='13') $alasan='Limbah Sisa PRC';
if ($a_dtransaksipermintaan[alasan_buang]=='14') $alasan='Leukosit Tinggi';
 /*
	echo mysql_error();


	if($a_dtransaksipermintaan[alasan_buang]=='0'){
		$alasan='Gagal Aftap';
	}
	if($a_dtransaksipermintaan[alasan_buang]=='3'){
		$alasan='Plebotomi';
	}
	if($a_dtransaksipermintaan[alasan_buang]=='4'){
		$alasan='Reaktif';
	}
	if($a_dtransaksipermintaan[alasan_buang]=='5'){
		$alasan='Lifemik';
	}
	if($a_dtransaksipermintaan[alasan_buang]=='6'){
		$alasan='Greyzone';
	}
	if($a_dtransaksipermintaan[alasan_buang]=='7'){
		$alasan='DCT Positif';
	}
	if($a_dtransaksipermintaan[alasan_buang]=='8'){
		$alasan='Kantong Bocor';
	}
	if($a_dtransaksipermintaan[alasan_buang]=='1'){
		$alasan='Lisis';
	}	
	else{
		$alasan='Kadaluarsa';
	} */
	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>
<td class=input><?=$a_dtransaksipermintaan[noKantong]?></td>    
<td class=input><?=$a_dtransaksipermintaan[gol_darah]?> (<?=$a_dtransaksipermintaan[RhesusDrh]?>)</td>
<td class=input><?=$a_dtransaksipermintaan[produk]?></td>
<td class=input><?=$a_dtransaksipermintaan[volume]?></td>
<td class=input><?=$a_dtransaksipermintaan[tgl_Aftap]?></td>
<td class=input><?=$a_dtransaksipermintaan[kadaluwarsa]?></td>
<?
$kadaluwarsa=$a_dtransaksipermintaan[tgl_buang];
$tglkel=date("d",strtotime($kadaluwarsa));
$blnkel=date("n",strtotime($kadaluwarsa));
$thnkel=date("Y",strtotime($kadaluwarsa));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam2 = date("H:i:s",strtotime($kadaluwarsa));


/*$tgl_buang=$a_dtransaksipermintaan[tgl_buang];
$blnkel=substr($a_dtransaksipermintaan[tgl_buang],5,2);
$tglkel=substr($a_dtransaksipermintaan[tgl_buang],8,2);
$thnkel=substr($a_dtransaksipermintaan[tgl_buang],0,4);
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam = date("H:i:s",strtotime($tgl_buang));*/
?>
<td class=input><?=$tglkel?>-<?=$bln22?>-<?=$thnkel?> <?=$jam?></td>
<td class=input><?=$alasan?></td>
<td class=input><?=$a_dtransaksipermintaan[user]?></td>
<td class=input><?=$a_dtransaksipermintaan[kodePendonor]?></td>

	</tr>
	<?
}
?>
</table>

<?
mysql_close();
?>
