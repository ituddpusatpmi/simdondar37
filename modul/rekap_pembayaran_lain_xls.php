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
<h3 class="table">Rekap transaksi cetak kwitansi lain-lain dari Tgl :  <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h3>
</br>
<!--form rekap>


<br>

</td>



</tr>
</table>
</br>


<!--batas form rekap -->

</form></div>
<?
//$q_dtransaksipermintaan=mysql_query("select nomer,NoForm,nokantong,Tgl,petugas,tempat,jumlah,shift,rs,no_rm,layanan,kodebiaya from kwitansi where Tgl>='$today' and Tgl<='$today1' and layanan like '%$layanan%' and shift like '%$shift1%' and rs like '%$rs1%' order by Tgl,layanan ASC");
//===TAMBAH NO_REGRS THEO 01 03 18

$q_dtransaksipermintaan=mysql_query("select kw.nomer as nomer,kw.NoForm as NoForm,kw.nokantong as nokantong,kw.Tgl as Tgl,kw.petugas as petugas,kw.tempat as tempat,kw.jumlah as jumlah,kw.shift as shift,kw.rs as rs,kw.no_rm as no_rm,kw.layanan as layanan,kw.kodebiaya as kodebiaya,ht.regrs as regrs from kwitansilain as kw, htranspermintaan as ht where kw.Tgl>='$today' and kw.Tgl<='$today1' and kw.NoForm=ht.noform and kw.layanan like '%$layanan%' and kw.shift like '%$shift1%' and kw.rs like '%$rs1%' order by kw.insert_on ASC");

$TRec=mysql_num_rows($q_dtransaksipermintaan);
?>
<th colspan=13><b>Total = <?=$TRec?> data</b></th></tr><tr class="field">
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
        
    <td>No</td>
    <td>Tanggal Cetak</td>
    <td>No Kwitansi</td>
    <td>No Formulir</td>
    <td>Nama Pasien</td>
    <td>Gol. Darah</td>
    <td>No. RM</td>
    <td>Rumah Sakit</td>
    <!--td>Jml Ktg <br>Diminta</td-->
    <td>Jumlah <br>Pembayaran</td>

    <td>Jenis<br>Biaya</td>
    <td>Layanan</td>
        <td>Petugas</td>
    <td>Shift</td>
    <td>Tempat</td>
     </tr>

</tr>

<?
//$trans0=mysql_query("select dt.NoForm,dt.NoKantong,dp.JenisDarah,dp.GolDarah,dp.Rhesus
//                    from dtransaksipermintaan as dt, dtranspermintaan as dp, dpembayaran as dpem
//                    where dpem.tgl='$today' and dt.NoForm=dp.NoForm and dpem.NoForm=dp.noForm and dt.Status='L' group by NoForm");
$no=1;

while($a_dtransaksipermintaan=mysql_fetch_assoc($q_dtransaksipermintaan)){
    $q_stok=mysql_query("select gol_darah,produk,RhesusDrh from stokkantong where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
//    $q_dhasilcross=mysql_query("select Pemeriksa from dhasilcross where noKantong='$a_dtransaksipermintaan[NoKantong]' ");
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

<!--td class=input><?=$a_dtransaksipermintaan[Tgl]?></td-->
<?
$blnkel=substr($a_dtransaksipermintaan[Tgl],5,2);
$tglkel=substr($a_dtransaksipermintaan[Tgl],8,2);
$thnkel=substr($a_dtransaksipermintaan[Tgl],0,4);
?>
<td class=input><?=$tglkel?>-<?=$blnkel?>-<?=$thnkel?></td>
<td class=input><?=$a_dtransaksipermintaan[nomer]?></td>
<?
$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$a_dtransaksipermintaan[rs]'"));
?>
<td class=input><?=$a_dtransaksipermintaan[NoForm]?></td>
<?
$pasien=mysql_fetch_assoc(mysql_query("select nama, gol_darah from pasien where no_rm='$a_dtransaksipermintaan[no_rm]'"));
$jl=mysql_fetch_assoc(mysql_query("select nama from jenis_layanan where kode='$a_dtransaksipermintaan[layanan]'"));
$rm=mysql_fetch_assoc(mysql_query("select regrs from htranspermintaan where noform='$a_dtransaksipermintaan[NoForm]'"));
?>
<td class=input><?=$pasien[nama]?></td>
<td class=input align=center><?=$pasien[gol_darah]?></td>
<td class=input><?=$rm[regrs]?></td>
<td class=input><?=$rmhskt[NamaRs]?></td>
<td class=input name='jumtot'><?=$a_dtransaksipermintaan[jumlah]?></td>
<td class=input><?=$biaya[NamaBiaya]?></td>
<td class=input><?=$jl[nama]?></td>

      
      <td class=input><?=$a_dtransaksipermintaan[petugas]?></td>
      <td class=input><?=$a_dtransaksipermintaan[shift]?></td>
      <td class=input><?=$a_dtransaksipermintaan[tempat]?></td>
      
    </tr>
    <?
}
?>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
    <!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->
    <td colspan='8'>Jumlah</td>
    <?
    $jum=mysql_fetch_assoc(mysql_query("select sum(jumlah) as jum from kwitansilain
where Tgl>='$today' and Tgl<='$today1' and layanan like '%$layanan%' and rs like '%$rs1%' and shift like '%$shift1%' "));
    ?>
    <td><?=$jum[jum]?></td>
    <td></td>
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

