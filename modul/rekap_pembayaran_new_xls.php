<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_rincian_transaksi_pembayaran.xls");
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
$rs1=$_POST[rs1];
$layanan=$_POST[layanan];
$shift1=$_POST[shift1];

?>

<br>
<h3 class="table">Rekap transaksi cetak kwitansi dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h3>
</br>
<!--form rekap>
<?
$jum=mysql_fetch_assoc(mysql_query("select count(NoKantong) as kod from dtransaksipermintaan where CAST(tgl_keluar as date)>='$today' and CAST(tgl_keluar as date)<='$today1' and Status='0'  "));
/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendono) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
//$umum=mysql_fetch_assoc(mysql_query("select count(dt.NoKantong) as A from dtransaksipermintaan as dt , htranspermintaan as ht where CAST(dt.tgl_keluar as date)>='$today' and CAST(dt.tgl_keluar as date)<='$today1' and ht.jenis='umum' and ht.NoForm=dt.NoForm and dt.Status='0'"));

//"select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"
 
$pagi=mysql_fetch_assoc(mysql_query("select sum(jumlah) as A from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and shift='1' and tempat='UDD'"));
$sore=mysql_fetch_assoc(mysql_query("select sum(jumlah) as B from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and shift='2' and tempat='UDD'"));
$malam=mysql_fetch_assoc(mysql_query("select sum(jumlah) as C from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and shift='3' and tempat='UDD'"));

$pagi1=mysql_fetch_assoc(mysql_query("select sum(jumlah) as A1 from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and shift='1' and tempat='BDRS'"));
$sore1=mysql_fetch_assoc(mysql_query("select sum(jumlah) as B1 from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and shift='2' and tempat='BDRS'"));
$malam1=mysql_fetch_assoc(mysql_query("select sum(jumlah) as C1 from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and shift='3' and tempat='BDRS'"));
?>

<br>
<table>
<tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap Cetak Kwitansi Pada Shift dan Tempat Transaksi</b></th>
<tr class="field">
<td rowspan=2 ><b>Jenis Shift</b></td>
<td colspan=2><b>Jumlah Uang</b></td>
<tr><td alight=center>UDD</td><td>BDRS</td></tr>
<tr><td>Shift 1</td>
<td class=input><?=$pagi[A]?></td><td class=input><?=$pagi1[A1]?></td></tr>
<tr><td>Shift 2</td>
<td class=input><?=$sore[B]?><td class=input><?=$sore1[B1]?></td></td></tr>
<tr><td>Shift 3</td>
<td class=input><?=$malam[C]?><td class=input><?=$malam1[C1]?></td></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$pagi[A]+$sore[B]+$malam[C]?></td><td class=input><?=$pagi1[A1]+$sore1[B1]+$malam1[C1]?></td></tr>
<tr><td><b>Jml Total UDD & BDRS</b></td>
<td class=input colspan=2><?=$pagi[A]+$sore[B]+$malam[C]+$pagi1[A1]+$sore1[B1]+$malam1[C1]?></td></tr>
</table>
</td>



</tr>
</table>
</br>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<td rowspan=4>No</td>
        <th rowspan=4>Jenis Biaya</th>
	<th colspan=12>Jumlah Cetak Kwitansi</th>
</tr>
<tr>
	<th colspan=4>UDD</th>
	<th colspan=4>BDRS 1</th>
	<th colspan=4>BDRS 2</th>
</tr>
<tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center" >
	<th colspan=3>SHIFT</th>
	<!--th rowspan=2>Metode pemisahan</th>
	<th rowspan=2>JML</th>
	
	<th colspan=3>SHIFT</th>
	<!--th rowspan=2>Metode pemisahan</th>
	<th rowspan=2>JML</th>
       
	<th colspan=3>SHIFT</th>
	<!--th rowspan=2>Metode pemisahan</th>
	<th rowspan=2>JML</th>
	</tr>
      <tr tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" align="center">
	<th>1</th>
        <th>2</th>
        <th>3</th>
	
	<th>1</th>
        <th>2</th>
        <th>3</th>

	<th>1</th>
        <th>2</th>
        <th>3</th>
       </tr>

<?
$komponen6=mysql_query("select kodebiaya ,jumlah,NoForm,nomer,shift,tempat from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' group by kodebiaya order by kodebiaya ASC ");
//$komponen3=mysql_query("select tgl as tgl,produk,pisah from dpengolahan where Produk!='' and pisah!='' and CAST(tgl as date)>='$today' and CAST(tgl as date)<='$today1' group by pisah order by pisah ASC");
$no='1';

while ($komponen7=mysql_fetch_assoc($komponen6)) {
//UTD
$utd1=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as UTD1 
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='1' and tempat='UDD'"));

$utd2=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as UTD2 
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='2' and tempat='UDD'"));

$utd3=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as UTD3  
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='3' and tempat='UDD'"));

$jumudd=mysql_fetch_assoc(mysql_query("select sum(jumlah) as JUMUDD  
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and tempat='UDD'"));

//BDRS1
$bdrs1=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as BDRS11
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='1' and tempat='BDRS'"));

$bdrs12=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as BDRS12 
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='2' and tempat='BDRS'"));

$bdrs13=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as BDRS13  
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='3' and tempat='BDRS'"));

$jumbdrs1=mysql_fetch_assoc(mysql_query("select sum(jumlah) as JUMBDRS1  
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and tempat='BDRS'"));

//BDRS2
$bdrs2=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as BDRS21
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='1' and tempat='BDRS2'"));

$bdrs22=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as BDRS22 
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='2' and tempat='BDRS2'"));

$bdrs23=mysql_fetch_assoc(mysql_query("select count(distinct nomer) as BDRS23  
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and shift='3' and tempat='BDRS2'"));

$jumbdrs2=mysql_fetch_assoc(mysql_query("select sum(jumlah) as JUMBDRS2  
from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and `kodebiaya`='$komponen7[kodebiaya]' and tempat='BDRS2'"));


$jenis=mysql_fetch_assoc(mysql_query("select NamaBiaya,Harga from biaya where Kode='$komponen7[kodebiaya]' "));

?>
<tr class="record">
      
	<td><?=$no++?></td>
        <td class=input><?=$jenis[NamaBiaya]?></td>
	<!--td class=input><?=$jenis[Harga]?></td>
	<td class=input><?=$utd1[UTD1]?></td>
	<td class=input><?=$utd2[UTD2]?></td>
	<td class=input><?=$utd3[UTD3]?></td>
	<td class=input style="background-color:#FF6346; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"><?=$jumudd[JUMUDD]?></td>

	<td class=input><?=$bdrs1[BDRS11]?></td>
	<td class=input><?=$bdrs12[BDRS12]?></td>
	<td class=input><?=$bdrs13[BDRS13]?></td>
	<td class=input style="background-color:#FF6346; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"><?=$jumbdrs1[JUMBDRS1]?></td>

	<td class=input><?=$bdrs2[BDRS21]?></td>
	<td class=input><?=$bdrs22[BDRS22]?></td>
	<td class=input><?=$bdrs23[BDRS23]?></td>
	<td class=input style="background-color:#FF6346; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"><?=$jumbdrs2[JUMBDRS2]?></td>
	
	
	
	</tr>

<?
}

?>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field">	
	<td style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" colspan='2'>JUMLAH TOTAL</td>
	<?
	$jump=mysql_fetch_assoc(mysql_query("select sum(jumlah) as jump from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='UDD' and shift='1'"));
	$jums=mysql_fetch_assoc(mysql_query("select sum(jumlah) as jums from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='UDD' and shift='2'"));
	$jumm=mysql_fetch_assoc(mysql_query("select sum(jumlah) as jumm from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='UDD' and shift='3'"));
	?>
	<td ><?=$jump[jump]?></td>
	<td><?=$jums[jums]?></td>
	<td><?=$jumm[jumm]?></td>
	<?
	$jum1=mysql_fetch_assoc(mysql_query("select sum(jumlah) as jum1 from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='UDD'"));
	?>
	<td style="background-color:#FF6346; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"><?=$jum1[jum1]?></td>


<!--BDRS1>
	<?
	$bdrs1p=mysql_fetch_assoc(mysql_query("select sum(jumlah) as bdrs1p from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS' and shift='1'"));
	$bdrs1s=mysql_fetch_assoc(mysql_query("select sum(jumlah) as bdrs1s from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS' and shift='2'"));
	$bdrs1m=mysql_fetch_assoc(mysql_query("select sum(jumlah) as bdrs1m from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS' and shift='3'"));
	?>
	<td><?=$bdrs1p[bdrs1p]?></td>
	<td><?=$bdrs1s[bdrs1s]?></td>
	<td><?=$bdrs1m[bdrs1m]?></td>
	<?
	$jum11=mysql_fetch_assoc(mysql_query("select sum(jumlah) as jum11 from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS'"));
	?>
	<td style="background-color:#FF6346; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"><?=$jum11[jum11]?></td>
	 

<!--BDRS2>
	<?
	$bdrs2p=mysql_fetch_assoc(mysql_query("select sum(jumlah) as bdrs2p from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS2' and shift='1'"));
	$bdrs2s=mysql_fetch_assoc(mysql_query("select sum(jumlah) as bdrs2s from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS2' and shift='2'"));
	$bdrs2m=mysql_fetch_assoc(mysql_query("select sum(jumlah) as bdrs2m from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS2' and shift='3'"));
	?>
	<td><?=$bdrs2p[bdrs2p]?></td>
	<td><?=$bdrs2s[bdrs2s]?></td>
	<td><?=$bdrs2m[bdrs2m]?></td>
	<?
	$jum12=mysql_fetch_assoc(mysql_query("select sum(jumlah) as jum12 from kwitansi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat='BDRS2'"));
	?>
	<td style="background-color:#FF6346; font-size:12px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'"><?=$jum12[jum12]?></td>
	 </tr>

</table>

<!--batas form rekap -->

</form></div>
<?
//$q_dtransaksipermintaan=mysql_query("select nomer,NoForm,nokantong,Tgl,petugas,tempat,jumlah,shift,rs,no_rm,layanan,kodebiaya from kwitansi where Tgl>='$today' and Tgl<='$today1' and layanan like '%$layanan%' and shift like '%$shift1%' and rs like '%$rs1%' order by Tgl,layanan ASC");
//===TAMBAH NO_REGRS THEO 01 03 18

$q_dtransaksipermintaan=mysql_query("select * from v_pembayaran where date(insert_on)>='$today' and date(insert_on)<='$today1' and jenis like '%$layanan%' and shift like '%$shift1%' and rs like '%$rs1%' order by insert_on ASC");

$TRec=mysql_num_rows($q_dtransaksipermintaan);
?>
<th colspan=13><b>Total = <?=$TRec?> data</b></th></tr><tr class="field">
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
		
	<td align="center">No</td>
    <td align="center">Tanggal Cetak</td>
    <td align="center">Jam</td>
    <td align="center">No Formulir</td>
    <td align="center">No Kwitansi</td>
    <td align="center">No RM(RS)</td>
                                        
    <td align="center">Nama Pasien</td>
    <td align="center">Gol. Darah</td>
    <td align="center">Rumah Sakit</td>
    <td align="center">Jumlah <br>Pembayaran</td>
    <td align="center">Jenis<br>Biaya</td>
    <td align="center">Petugas</td>
    <td align="center">Shift</td>
    <td align="center">Tempat</td>
	 </tr>

</tr>	

<?
//$trans0=mysql_query("select dt.NoForm,dt.NoKantong,dp.JenisDarah,dp.GolDarah,dp.Rhesus
//					from dtransaksipermintaan as dt, dtranspermintaan as dp, dpembayaran as dpem
//					where dpem.tgl='$today' and dt.NoForm=dp.NoForm and dpem.NoForm=dp.noForm and dt.Status='L' group by NoForm");
$no=1;

while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
	$q_stok=mysql_query("select gol_darah,produk,RhesusDrh from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
//	$q_dhasilcross=mysql_query("select Pemeriksa from dhasilcross where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
	$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$a_dtransaksipermintaan[NoKantong]') "));
	$waktu=mysql_fetch_assoc(mysql_query("(select tglPeriksa as tgl from hasilelisa where noKantong='$a_dtransaksipermintaan[NoKantong]') UNION (select tgl_tes as tgl from testrapid where nokantong='$a_dtransaksipermintaan[NoKantong]') "));
	$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
	$pembayaran=mysql_query("select namabrg,petugas,subTotal,shift from dpembayaranpermintaan where no_kantong='$a_dtransaksipermintaan[NoKantong]' and notrans='$a_dtransaksipermintaan[NoForm]' ");
	$shift=mysql_query("select shift,bagian,tglminta,rs,jenis,nojenis,no_rm from htranspermintaan where NoForm='$a_dtransaksipermintaan[NoForm]' order by jenis ASC ");
	$biaya1=mysql_query("select NamaBiaya from biaya where kode='$a_dtransaksipermintaan[kodebiaya]' ");
	$a_stok=mysql_fetch_assoc($q_stok);
	$a_bayar=mysql_fetch_assoc($pembayaran);
	$a_dhasilcross=mysql_fetch_assoc($q_dhasilcross);
	$a_shift=mysql_fetch_assoc($shift);
	$biaya=mysql_fetch_assoc($biaya1);

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
$jam   =substr($a_dtransaksipermintaan[insert_on],11,5);
$blnkel=substr($a_dtransaksipermintaan[insert_on],5,2);
$tglkel=substr($a_dtransaksipermintaan[insert_on],8,2);
$thnkel=substr($a_dtransaksipermintaan[insert_on],0,4);
?>
<td class=input><?=$tglkel?>-<?=$blnkel?>-<?=$thnkel?></td>
<td class=input><?=$jam?></td>
<td class=input><?=$a_dtransaksipermintaan[noForm]?></td>
<td class=input><?=$a_dtransaksipermintaan[nomer]?></td>
<td class=input><?=$a_dtransaksipermintaan[regrs]?></td>
<td class=input><?=$a_dtransaksipermintaan[nama]?></td>
<td class=input align=center><?=$a_dtransaksipermintaan[gol_darah].'/'.$a_dtransaksipermintaan[rhesus]?></td>
<td class=input><?=$a_dtransaksipermintaan[NamaRs]?></td>
<td class=input name='jumtot' align="right"><?=$a_dtransaksipermintaan[TotDibayar]?></td>
<td class=input><?=$a_dtransaksipermintaan[carabyr]?></td>
<td class=input><?=$a_dtransaksipermintaan[petugas]?></td>
<td class=input><?=$a_dtransaksipermintaan[shift]?></td>
<td class=input>UDD</td>
      
	</tr>
	<?
}
?>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=14><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->
	<td colspan='9'>Jumlah</td>
	<?
	$jum=mysql_fetch_assoc(mysql_query("select sum(TotDibayar) as jum from v_pembayaran
    where date(insert_on)>='$today' and date(insert_on)<='$today1' and jenis like '%$layanan%' and shift like '%$shift1%' and rs like '%$rs1%' "));
	?>
	<td><?=$jum[jum]?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
	 </tr>

</tr>	
</table>
<?
mysql_close();

?>
