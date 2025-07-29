<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
include('config/db_connect.php');
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') $today1=$_POST[minta2];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);



?>



<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
 //-->
</style>
<h1 class="table">Rekap Darah Buang <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
<div>
<form name=mintadarah1 method=post> Mulai:
<input type=text name=minta1 id=datepicker size=10>
Sampai :
<input type=text name=minta2 id=datepicker1 size=10>
<input type=submit name=submit value=Submit>

</form></div>
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
if ($a_dtransaksipermintaan[alasan_buang]=='4') $alasan='Reaktif Dibuang';
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
if ($a_dtransaksipermintaan[alasan_buang]=='15') $alasan='Produk Rusak';
if ($a_dtransaksipermintaan[alasan_buang]=='16') $alasan='Produk Sampel QC';


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
$jam = date("H:i:s",strtotime($kadaluwarsa));

/*
$tgl_buang1=$a_dtransaksipermintaan[tgl_buang];
$blnkel=substr($a_dtransaksipermintaan[tgl_buang],5,2);
$tglkel=substr($a_dtransaksipermintaan[tgl_buang],8,2);
$thnkel=substr($a_dtransaksipermintaan[tgl_buang],0,4);
$bulan=array(01=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam = date("H:i:s",strtotime($tgl_buang1));*/
?>
<td class=input><?=$tglkel?>-<?=$bln22?>-<?=$thnkel?> <?=$jam?></td>
<!--td class=input><?=$a_dtransaksipermintaan[tgl_buang]?></td-->
<td class=input><?=$alasan?></td>
<td class=input><?=$a_dtransaksipermintaan[user]?></td>
<td class=input><?=$a_dtransaksipermintaan[kodePendonor]?></td>

	</tr>
	<?
}
?>
</table>
<br>
<form name=xls method=post action=modul/rekap_darah_buang_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit2 value='Print Rekap Darah buang (.XLS)'>
</form>

<?
mysql_close();
?>
