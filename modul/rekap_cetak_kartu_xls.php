<?
//$tgl=date("Y-m-d");
include '../config/db_connect.php';
$perbln=$_POST[perbln];
$pertgl=$_POST[pertgl];
$perthn=$_POST[perthn];
$perbln1=$_POST[perbln1];
$pertgl1=$_POST[pertgl1];
$perthn1=$_POST[perthn1];
$today=$perthn."-".$perbln."-".$pertgl;
$today1=$perthn1."-".$perbln1."-".$pertgl1;
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_donor_$today.xls");
header("Pragma: no-cache");
header("Expires: 0");

//$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));
?>

<h3 class="table">Rekap Cetak Kartu DONOR DARAH dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h3>
</br>
<!--form rekap-->
<?
$jum=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from idcard where CAST(tglcetak as date)>='$today' and CAST(tglcetak as date)<='$today1' "));
/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendono) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
//$umum=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as A from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis='umum' and ht.NoForm=dt.NoForm and dt.Status='0'"));

//"select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"

$baru=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as A from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor='1' and ht.Kode=dt.kodependonor "));
$satu=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as B from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor > '1' and ht.jumDonor < '10' and ht.Kode=dt.kodependonor "));
$dua=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as C from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor >= '10' and ht.jumDonor < '25' and ht.Kode=dt.kodependonor "));
$tiga=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as D from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor >= '25' and ht.jumDonor < '50' and ht.Kode=dt.kodependonor "));
$empat=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as E from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor >= '25' and ht.jumDonor < '50' and ht.Kode=dt.kodependonor "));
$lima=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as F from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor >= '50' and ht.jumDonor < '75' and ht.Kode=dt.kodependonor "));
$enam=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as G from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor >= '75' and ht.jumDonor < '100' and ht.Kode=dt.kodependonor "));
$tujuh=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as H from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.jumDonor >= '100' and ht.Kode=dt.kodependonor "));
$dg=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as I from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and dt.tempat='0' and ht.Kode=dt.kodependonor "));
$mu=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as J from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and dt.tempat<>'0' and ht.Kode=dt.kodependonor "));



$a=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as A from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.GolDarah='A' and ht.Kode=dt.kodependonor "));
$b=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as B from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.GolDarah='B' and ht.Kode=dt.kodependonor "));
$ab=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as AB from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.GolDarah='AB' and ht.Kode=dt.kodependonor "));
$o=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as O from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.GolDarah='O' and ht.Kode=dt.kodependonor "));
$noket1=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as J1 from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and (ht.GolDarah='' or GolDarah='X') and ht.Kode=dt.kodependonor "));
$pos=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as POS from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.Rhesus='+' and ht.Kode=dt.kodependonor "));
$neg=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as NEG from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.Rhesus='-' and ht.Kode=dt.kodependonor "));
$noket2=mysql_fetch_assoc(mysql_query("select count(dt.kodependonor) as J2 from idcard as dt , pendonor as ht where CAST(dt.tglcetak as date)>='$today' and CAST(dt.tglcetak as date)<='$today1' and ht.Rhesus='' and ht.Kode=dt.kodependonor "));

?>

<br>
<table>
<tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap Pencetakan Kartu Donor</b></th>
<tr class="field" rowspan='2'>
<td><b>Kelompok Donor</b></td>
<td><b>Jumlah Cetak</b></td>
</tr>
<tr><td>1 kali</td>
<td class=input><?=$baru[A]?></td></tr>
<tr><td>> 1 kali</td>
<td class=input><?=$satu[B]?></td></tr>
<tr><td>>= 10 kali</td>
<td class=input><?=$dua[C]?></td></tr>
<tr><td>>= 25 kali</td>
<td class=input><?=$tiga[D]?></td></tr>
<tr><td>>= 50 kali</td>
<td class=input><?=$empat[E]?></td></tr>
<tr><td>>= 75 kali</td>
<td class=input><?=$lima[F]?></td></tr>
<tr><td>>= 100 kali</td>
<td class=input><?=$enam[G]?></td></tr>
<tr><td>Belum pernah donor</td>
<td class=input><?=$tujuh[H]?></td></tr>
<tr><td>Dalam Gedung</td>
<td class=input><?=$dg[I]?></td></tr>
<tr><td>Mobil Unit</td>
<td class=input><?=$mu[J]?></td></tr>
<tr rowspan='2'><td><b>Jumlah Total</b></td>
<td class=input ><?=$jum[kod]?></td></tr>
</table>
</td>


<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap Pencetakan kartu dari gol darah</b></th>
<tr class="field">
<td><b>Gol Darah</b></td>
<td><b>Jumlah Cetak</b></td>
</tr>
<tr><td>A</td>
<td class=input><?=$a[A]?></td></tr>
<tr><td>B</td>
<td class=input><?=$b[B]?></td></tr>
<tr><td>AB</td>
<td class=input><?=$ab[AB]?></td></tr>
<tr><td>O</td>
<td class=input><?=$o[O]?></td></tr>
<tr><td>Tdk Ada Ket.</td>
<td class=input><?=$noket1[J1]?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input ><?=$a[A]+$b[B]+$ab[AB]+$o[O]+$noket1[J1]?></td></tr>
<tr class="field">
<td><b>Rh Darah</b></td>
<td colspan=2><b>Jumlah Cetak</b></td>
</tr>
<tr><td>Positip</td>
<td class=input><?=$pos[POS]?></td></tr>
<tr><td>Negatip</td>
<td class=input><?=$neg[NEG]?></td></tr>
<tr><td>Tdk Ada Ket.</td>
<td class=input><?=$noket2[J2]?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$pos[POS]+$neg[NEG]+$noket2[J2]?></td></tr>
</table>
</td>


</tr>
</table>
</br>

<!--batas form rekap -->

</form></div>


<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<table>
<h3 class="table">Rincian proses cetak kartu dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h3>
</table>
</br>

<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->	
	<td><b>No</b></td><td><b>Kode Pendonor</b></td><td><b>Nama</b></td><td><b>Alamat</b></td><td><b>Jumlah Donor</b></td><td><b>Gol & Rh Darah</b></td><td><b>Tgl Cetak</b></td><td><b>Tempat Cetak</b></td><td><b>Petugas</b></td>
	</tr>

</tr>	
<?
$no=1;
$q_dtransaksipermintaan=mysql_query("select kodependonor,tglcetak,petugas,tempat from idcard where tglcetak>='$today' and tglcetak<='$today1' order by kodependonor ASC ");
$TRec=mysql_num_rows($q_dtransaksipermintaan);
while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	$q_stok=mysql_query("select * from pendonor where Kode='$a_dtransaksipermintaan[kodependonor]' ");
	$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$a_dtransaksipermintaan[NoKantong]') "));
	$waktu=mysql_fetch_assoc(mysql_query("(select tglPeriksa as tgl from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select tgl_tes as tgl from testrapid where nokantong='$a_dtransaksipermintaan[NoKantong]') "));
	$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
	//$pembayaran=mysql_query("select namabrg,petugas,subTotal,shift from dpembayaranpermintaan where no_kantong='$a_dtransaksipermintaan[NoKantong]' and notrans='$a_dtransaksipermintaan[NoForm]' ");
	
	$a_stok=mysql_fetch_assoc($q_stok);
	//$a_bayar=mysql_fetch_assoc($pembayaran);
	//$a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	
//kartu
$tempat1=mysql_fetch_assoc(mysql_query("select * from detailinstansi where KodeDetail='$a_dtransaksipermintaan[tempat]'"));
$tempat='Dalam Gedung';
if ($a_dtransaksipermintaan[tempat]!='0'){ $tempat=$tempat1[nama];}
//
	
	echo mysql_error();
	if($a_stok[produk]!=''){
		$produk=$a_stok[produk];
	}else{
		$produk='WB';
	}
	?>
	<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
<td><?=$no++?></td>    
<td class=input><?=$a_dtransaksipermintaan[kodependonor]?></td>
<td class=input><?=$a_stok[Nama]?></td>
<td class=input><?=$a_stok[Alamat]?></td>
<td class=input><?=$a_stok[jumDonor]?></td>
<td class=input><?=$a_stok[GolDarah]?> (<?=$a_stok[Rhesus]?>)</td>
<?
$blnkel=substr($a_dtransaksipermintaan[tglcetak],5,2);
$tglkel=substr($a_dtransaksipermintaan[tglcetak],8,2);
$thnkel=substr($a_dtransaksipermintaan[tglcetak],0,4);
?>
      <td class=input><?=$tglkel?>-<?=$blnkel?>-<?=$thnkel?></td>
<?

?>
	<td class=input><?=$tempat?></td>
      <td class=input><?=$a_dtransaksipermintaan[petugas]?></td>
<?
}
?>
    
</table>
<br>

