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
<h1 class="table">Tanggal Transaksi <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?><br>
</h1>
<b><font size=3>Dalam Gedung</b><br></font>
<STYLE>
<!--
  tr { background-color: #FFA688}
  .initial { background-color: #FFA688; color:#000000 }
  .normal { background-color: #FFA688 }
  .highlight { background-color: #8888FF }
 //-->
</style>
<?
$trans0_sql="select ht.NoTrans,ht.KodePendonor,ht.JenisDonor,ht.Reaksi,ht.catatan,ht.Pengambilan,ht.caraAmbil,
		ht.jumHB,ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Rhesus,pd.Nama,pd.telp2,ht.petugas,ht.petugasHB,ht.petugasTensi,ht.NamaDokter,ht.Instansi,ht.JenisDonor,ht.NoForm, ht.umur 
		from htransaksi as ht,pendonor as pd 
		where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and 
		ht.KodePendonor=pd.Kode and ht.NoTrans like 'DG%' order by NoTrans";
//echo $trans0_sql;
?>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

          <td>No.</td>
	  <td>No Transaksi</td>
          <td>Nama Pendonor</td>
	  <td>Alamat</td>
	<td>Umur</td>
          <td>Handphone</td>
	  <td>Jam Antri</td>
          <td>Petugas Tensi</td>
          <td>Petugas HB</td>
          <td>Gol&Rh Darah</td>
          <td>Keterangan</td>
          <td>Aftap</td>
          <td>Petugas Aftap</td>
          <td>Nama Dokter</td>
          <td>No Kantong</td>
          <td>Serah Terima</td>
          <td>Status</td>
          <!--td>Petugas Lab</td-->
          <td>Konfirmasi</td>
	  <td>Cara Ambil</td>
	  <td>Jenis</td>
	  <td>NoForm</td>
        </tr>
<?
$no=1;
$trans0=mysql_query($trans0_sql);
while ($trans=mysql_fetch_assoc($trans0)) {
//$stk='';
$jamaftap='-';
//$cocok1='-';
$jamantri=substr($trans[Tgl],11);
if ($trans[NoKantong]!='') {
$carambil=mysql_fetch_assoc(mysql_query("select * from htransaksi where noKantong='$trans[NoKantong]'"));
$stk=mysql_fetch_assoc(mysql_query("select Status,sah,tgl_Aftap from stokkantong where noKantong='$trans[NoKantong]'"));
$cocok=mysql_fetch_assoc(mysql_query("select cocok from dkonfirmasi where noKantong='$trans[NoKantong]'"));
$cocok1='-';
if ($cocok[cocok]=='0') $cocok1='Cocok';
if ($cocok[cocok]=='1') $cocok1='Tidak Cocok';
$jamaftap=substr($stk[tgl_Aftap],11);
}
$stk1='-';
$sah1='Belum';
if ($stk[sah]=='1') $sah1='Sudah';
if ($stk[Status]=='1') $stk1='Belum IMLTD';
if ($stk[Status]=='2') $stk1='Sehat';
if ($stk[Status]=='3') $stk1='Keluar/Titip';
if ($stk[Status]=='4') $stk1='Rusak';
if ($stk[Status]=='5') $stk1='Gagal';

$peng='Antri';
if ($trans['jumHB']=='1') $peng='Lolos MCU';
if ($trans['jumHB']=='2') $peng='Gagal MCU';
if ($trans['jumHB']=='3') $peng='Gagal MCU';
if ($trans['jumHB']=='4') $peng='Gagal MCU';
if ($trans[Pengambilan]=='0') $peng='Berhasil';
if ($trans[Pengambilan]=='2') $peng='Gagal';
if ($trans[Pengambilan]=='1') $peng='Batal';
$cara='-';
if ($trans[caraAmbil]=='0') $cara='Biasa';
if ($trans[caraAmbil]=='1') $cara='Tromboferesis';
if ($trans[caraAmbil]=='2') $cara='Leukaferesis';
if ($trans[caraAmbil]=='3') $cara='Plasmaferesis';
if ($trans[caraAmbil]=='4') $cara='Eritoferesis';
$jenis='DS';
if($trans[JenisDonor]=='1') $jenis='DP';



//$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$trans[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$trans[NoKantong]') "));
$petugas_aftap=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugas]'"));
$petugas_hb=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasHB]'"));
$petugas_tensi=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasTensi]'"));
//$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
$dr=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa where kode='$trans[NamaDokter]'"));

?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td><?=$no++?></td>
	<td class=input><?=$trans[NoTrans]?></td>
	<td class=input><?=$trans[Nama]?></td>
	<td class=input><?=$trans[Alamat]?></td>
	<td class=input><?=$trans[umur]?> th</td>
	<td class=input><?=$trans[telp2]?></td>
	<td class=input><?=$jamantri?></td>
	<td class=input><?=$petugas_tensi[nama_lengkap]?></td>
	<td class=input><?=$petugas_hb[nama_lengkap]?></td>
	<td class=input><?=$trans[GolDarah]?>(<?=$trans[Rhesus]?>)</td>
	<td class=input><?=$peng?></td>
	<td class=input><?=$jamaftap?></td>
	<td class=input><?=$petugas_aftap[nama_lengkap]?></td>
	<td class=input><?=$dr[Nama]?></td>
	      <? echo "<td class=input><a href=pmi".$_SESSION[leveluser].".php?module=updatekantong&noKantong=".$trans[NoKantong].">".$trans[NoKantong]."</a></td>"; ?>
	<td class=input><?=$sah1?></td>
	<td class=input><?=$stk1?></td>
	<!--td class=input><?=$petugas_imltd[nama_lengkap]?></td-->
	<td class=input><?=$cocok1?></td>
	<td class=input><?=$cara?></td>
	<td class=input><?=$jenis?></td>
	<td class=input><?=$trans[NoForm]?></td>
	</tr>
<?

}
?>
</table>
<?
$jum=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and NoTrans like 'DG%'"));

//PENGAMBILAN BERHASIL DG

$golA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and NoTrans like 'DG%'"));
$golB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and NoTrans like 'DG%'"));
$golAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and NoTrans like 'DG%'"));
$golO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and NoTrans like 'DG%'"));
$jkP=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and NoTrans like 'DG%'"));
$jkW=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and NoTrans like 'DG%'"));


//baru
$rhposA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and rhesus='+' and NoTrans like 'DG%'"));
$rhposB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and rhesus='+' and NoTrans like 'DG%'"));
$rhposAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and rhesus='+' and NoTrans like 'DG%'"));
$rhposO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and rhesus='+' and NoTrans like 'DG%'"));


$rhnegA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and rhesus='-' and NoTrans like 'DG%'"));

$rhposP=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and rhesus='+' and NoTrans like 'DG%'"));
$rhposW=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and rhesus='+' and NoTrans like 'DG%'"));
$rhnegP=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegW=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and rhesus='-' and NoTrans like 'DG%'"));

$rhpos=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and rhesus='+' and NoTrans like 'DG%'"));
$rhneg=mysql_fetch_assoc(mysql_query("select count(rhesus) as neg from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and rhesus='-' and NoTrans like 'DG%'"));

//PENGAMBILAN GAGAL DG

$jum_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and NoTrans like 'DG%'"));
$golA_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and NoTrans like 'DG%'"));
$golB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and NoTrans like 'DG%'"));
$golAB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and NoTrans like 'DG%'"));
$golO_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='O' and NoTrans like 'DG%'"));
$jkP_g=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and NoTrans like 'DG%'"));
$jkW_g=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and NoTrans like 'DG%'"));


$rhposA_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and rhesus='+' and NoTrans like 'DG%'"));
$rhposB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and rhesus='+' and NoTrans like 'DG%'"));
$rhposAB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and rhesus='+' and NoTrans like 'DG%'"));
$rhposO_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='O' and rhesus='+' and NoTrans like 'DG%'"));

$rhnegA_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegAB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegO_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='Os' and rhesus='-' and NoTrans like 'DG%'"));

$rhposP_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and rhesus='+' and NoTrans like 'DG%'"));
$rhposW_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='1' and rhesus='+' and NoTrans like 'DG%'"));
$rhnegP_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegW_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='1' and rhesus='-' and NoTrans like 'DG%'"));



$rhpos_g=mysql_fetch_assoc(mysql_query("select count(pd.Rhesus) as pos from pendonor as pd,htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and pd.Rhesus='+' and pd.Kode=KodePendonor and NoTrans like 'DG%'"));
$rhneg_g=mysql_fetch_assoc(mysql_query("select count(pd.Rhesus) as neg from pendonor as pd,htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and pd.Rhesus='-' and pd.Kode=KodePendonor and NoTrans like 'DG%'"));


//PENGAMBILAN BATAL DG

$jum_b=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'DG%'"));

$golA_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='A' and NoTrans like 'DG%'"));
$golB_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='B' and NoTrans like 'DG%'"));
$golAB_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='AB' and NoTrans like 'DG%'"));
$golO_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='O' and NoTrans like 'DG%'"));
$jkP_b=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and jk='0' and NoTrans like 'DG%'"));
$jkW_b=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and jk='1' and NoTrans like 'DG%'"));


//CARA PENGAMBILAN
$biasa=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and caraAmbil='0' and NoTrans like 'DG%'"));
$tromboferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and caraAmbil='1' and NoTrans like 'DG%'"));
$leukoferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and caraAmbil='2' and NoTrans like 'DG%'"));
$plasmaferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and caraAmbil='3' and NoTrans like 'DG%'"));
$eritoferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and caraAmbil='4' and NoTrans like 'DG%'"));





$dspos=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='0' and rhesus='+' and NoTrans like 'DG%'"));
$dsneg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='0' and rhesus='-' and NoTrans like 'DG%'"));
$dppos=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='1' and rhesus='+' and NoTrans like 'DG%'"));
$dpneg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='1' and rhesus='-' and NoTrans like 'DG%'"));


//Jenis Kantong DG

$single=mysql_fetch_assoc(mysql_query("select count(kodependonor) as S from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='1' and Pengambilan='0' and NoTrans like 'DG%'"));
$double=mysql_fetch_assoc(mysql_query("select count(kodependonor) as D from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='2' and Pengambilan='0' and NoTrans like 'DG%'"));
$triple=mysql_fetch_assoc(mysql_query("select count(kodependonor) as T from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='3' and Pengambilan='0' and NoTrans like 'DG%'"));
$quadruple=mysql_fetch_assoc(mysql_query("select count(kodependonor) as Q from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='4' and Pengambilan='0' and NoTrans like 'DG%'"));
$pediatrik=mysql_fetch_assoc(mysql_query("select count(kodependonor) as P from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='6' and Pengambilan='0' and NoTrans like 'DG%'"));

$single_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as S from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='1' and Pengambilan='2' and NoTrans like 'DG%'"));
$double_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as D from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='2' and Pengambilan='2' and NoTrans like 'DG%'"));
$triple_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as T from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='3' and Pengambilan='2' and NoTrans like 'DG%'"));
$quadruple_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as Q from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='4' and Pengambilan='2' and NoTrans like 'DG%'"));
$pediatrik_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as P from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='6' and Pengambilan='2' and NoTrans like 'DG%'"));

//BARU dan ULANG MU
$db=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and donorbaru='0' and NoTrans like 'DG%'"));
$du=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and donorbaru='1' and NoTrans like 'DG%'"));

$db_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and donorbaru='0' and NoTrans like 'DG%'"));
$du_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and donorbaru='1' and NoTrans like 'DG%'"));

$db_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or pengambilan='-') and donorbaru='0' and NoTrans like 'DG%'"));
$du_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or pengambilan='-') and donorbaru='1' and NoTrans like 'DG%'"));

//DS dan DP
$ds=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='0' and NoTrans like 'DG%'"));
$dsb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and JenisDonor='0' and NoTrans like 'DG%'"));
$dsg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and JenisDonor='0' and NoTrans like 'DG%'"));

$dp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='1' and NoTrans like 'DG%'"));
$dpb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and JenisDonor='1' and NoTrans like 'DG%'"));
$dpg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and JenisDonor='1' and NoTrans like 'DG%'"));

?>
<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Dalam Gedung BERHASIL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>JML </b></td>
<td><b>Rhesus </b></td>
</tr>
<tr><td><b> A </td>
<td class=input><?=$golA[A]?></td><td>Pos: <?=$rhposA[A]?>   Neg: <?=$rhnegA[A]?></td></tr>
<tr><td><b> B </td>
<td class=input><?=$golB[B]?></td><td>Pos: <?=$rhposB[B]?>   Neg: <?=$rhnegB[B]?></td></tr>
<tr><td><b> AB </td>
<td class=input><?=$golAB[AB]?></td><td>Pos: <?=$rhposAB[AB]?>  Neg: <?=$rhnegAB[AB]?></td></tr>
<tr><td><b> O </td>
<td class=input><?=$golO[O]?></td><td>Pos: <?=$rhposO[O]?>   Neg: <?=$rhnegO[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP[P]?></td><td>Pos: <?=$rhposP[P]?>   Neg: <?=$rhnegP[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW[W]?></td><td>Pos: <?=$rhposW[W]?>   Neg: <?=$rhnegW[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum[kod]?></td><td><b>Pos: <?=$rhpos[pos]?>  Neg: <?=$rhneg[neg]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Dalam Gedung GAGAL</b></th>
<tr class=field>
<td align=center><b>Gol Darah</b></td>
<td align=center><b>JML</b></td>
<td align=center><b>Rhesus</b></td>
</tr>
<tr><td><b> A </td>
<td class=input ><?=$golA_g[A]?></td><td>Pos: <?=$rhposA_g[A]?>   Neg: <?=$rhnegA_g[A]?></tr>
<tr><td><b> B </td>
<td class=input><?=$golB_g[B]?></td><td>Pos: <?=$rhposB_g[B]?>   Neg: <?=$rhnegB_g[B]?></tr>
<tr><td><b> AB </td>
<td class=input><?=$golAB_g[AB]?></td><td>Pos: <?=$rhposAB_g[AB]?>   Neg: <?=$rhnegAB_g[AB]?></tr>
<tr><td><b> O </td>
<td class=input><?=$golO_g[O]?></td><td>Pos: <?=$rhposO_g[O]?>   Neg: <?=$rhnegO_g[O]?></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_g[P]?></td><td>Pos: <?=$rhposP_g[P]?>   Neg: <?=$rhnegP_g[P]?></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_g[W]?></td><td>Pos: <?=$rhposW_g[W]?>  Neg: <?=$rhnegW_g[W]?></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum_g[kod]?></b></td><td><b>Pos: <?=$rhpos_g[pos]?>  Neg: <?=$rhneg_g[neg]?></b></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Dalam Gedung BATAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td class=input><?=$golA_b[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$golB_b[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$golAB_b[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$golO_b[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_b[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_b[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td class=input><?=$jum_b[kod]?></td></tr>
</table>
</td>


<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Dalam Gedung CARA AMBIL</b></th>
<tr class="field">
<td><b>Cara Ambil</b></td>
<td><b>Jumlah </b></td>
</tr>
<tr><td> Biasa </td>
<td class=input><?=$biasa[kod]?></td></tr>
<th colspan='2' >AFERESIS</th>
<tr><td> Tromboferesis </td>
<td class=input><?=$tromboferesis[kod]?></td></tr>
<tr><td> Leukaferesis </td>
<td class=input><?=$leukoferesis[kod]?></td></tr>
<tr><td> Plasmaferesis </td>
<td class=input><?=$plasmaferesis[kod]?></td></tr>
<tr><td>Eritoferesis</td>
<td class=input><?=$eritoferesis[kod]?></td></tr>
<tr><td>JML TTL</td>
<td class=input><?=$eritoferesis[kod]+$plasmaferesis[kod]+$leukoferesis[kod]+$tromboferesis[kod]+$biasa[kod]?></td></tr>
</table>
</td>


<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap JENIS KANTONG yang terpakai DG</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Kantong</b></td>
<th class ="field" colspan='2'><b>Jumlah </b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal Aftap</b></th>

<tr><td>Single</td>
<td class=input><?=$single[S]?></td><td class=input><?=$single_g[S]?></td></tr>
<tr><td>Double</td>
<td class=input><?=$double[D]?></td><td class=input><?=$double_g[D]?></td></tr>
<tr><td>Triple</td>
<td class=input><?=$triple[T]?></td><td class=input><?=$triple_g[T]?></td></tr>
<tr><td>Quadruple</td>
<td class=input><?=$quadruple[Q]?><td class=input><?=$quadruple_g[Q]?></td></td></tr>
<tr><td>Pediatrik</td>
<td class=input><?=$pediatrik[P]?><td class=input><?=$pediatrik_g[P]?></td></td></tr>
<tr><td>JML TTL</td>
<td class=input><?=$single[S]+$double[D]+$triple[T]+$quadruple[Q]+$pediatrik[P]?></td><td class=input><?=$single_g[S]+$double_g[D]+$triple_g[T]+$quadruple_g[Q]+$pediatrik_g[P]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=4><b>Rekap JENIS PENDONOR DG</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Pendonor</b></td>
<th class ="field" colspan='3'><b>Jumlah Aftap</b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal</b></th><th><b>Batal</b></th>

<tr><td>Baru</td>
<td class=input><?=$db[B]?></td><td class=input><?=$db_g[B]?></td><td class=input><?=$db_b[B]?></td></tr>
<tr><td>Ulang</td>
<td class=input><?=$du[U]?></td><td class=input><?=$du_g[U]?></td><td class=input><?=$du_b[U]?></td></tr>
<tr><td>DS</td>
<td class=input><?=$ds[P]?></td><td class=input><?=$dsg[P]?></td><td class=input><?=$dsb[P]?></td></tr>
<tr><td>DP</td>
<td class=input><?=$dp[W]?><td class=input><?=$dpg[W]?></td><td class=input><?=$dpb[W]?></td>
<tr><td>JML TTL</td><td class=input><?=$db[B]+$du[U]?></td><td class=input><?=$db_g[B]+$du_g[U]?></td><td class=input><?=$db_b[B]+$du_b[U]?></td></tr>
</table>
</td>


</tr>
</table>

</br>
<br>
</br>
<br>
</br>
<br>
</br>
<br>
</br>
<b><font size=3>Mobile Unit</b><br></font>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	  <td>No.</td>
          <td>No Transaksi</td>
          <td>Nama Pendonor</td>
	  <td>Alamat</td>
	<td>Umur</td>
	  <td>Handphone</td>
          <td>Jam Antri</td>
          <td>Petugas Tensi</td>
          <td>Petugas HB</td>
          <td>Gol Darah</td>
          <td>Keterangan</td>
          <td>Aftap</td>
          <td>Petugas Aftap</td>
          <td>Nama Dokter</td>
          <td>No Kantong</td>
          <td>Serah Terima</td>
          <td>Status</td>
          <!--td>Petugas Lab</td-->
          <td>Konfirmasi Gol Darah</td>
	<td>Instansi</td>        
	</tr>
<?
$no1=1;
$trans0=mysql_query("select ht.NoTrans,ht.KodePendonor,ht.JenisDonor,ht.Reaksi,ht.catatan,ht.Pengambilan,ht.caraAmbil,
		ht.jumHB,ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Rhesus,pd.Nama,pd.telp2,ht.petugas,ht.petugasHB,ht.petugasTensi,ht.NamaDokter,ht.Instansi,ht.JenisDonor,ht.NoForm, ht.umur  
		from htransaksi as ht,pendonor as pd 
		where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and 
		ht.KodePendonor=pd.Kode and ht.NoTrans like 'M%' order by NoTrans");
//$trans0=mysql_query("select ht.NoTrans,ht.KodePendonor,ht.JenisDonor,ht.Reaksi,ht.catatan,ht.Pengambilan,
//		ht.jumHB,ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Rhesus,pd.Nama,pd.telp2,ht.petugas,ht.petugasHB,ht.petugasTensi,ht.NamaDokter,ht.Instansi  
//		from htransaksi as ht,pendonor as pd 
//		where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and 
//		ht.KodePendonor=pd.Kode and ht.NoTrans like 'M%' order by NoTrans");
while ($trans=mysql_fetch_assoc($trans0)) {
//$stk2='';
$jamaftap1='-';
if ($trans[NoKantong]!='') {
$jamantri1=substr($trans[Tgl],11);
$stk2=mysql_fetch_assoc(mysql_query("select Status,sah,tgl_Aftap from stokkantong where noKantong='$trans[NoKantong]'"));
$cocok2=mysql_fetch_assoc(mysql_query("select cocok from dkonfirmasi where noKantong='$trans[NoKantong]'"));
$cocok3='-';
if ($cocok2[cocok]=='0') $cocok3='Cocok';
if ($cocok2[cocok]=='1') $cocok3='Tidak Cocok';
$jamaftap1=substr($stk2[tgl_Aftap],11);
}
$stk3='-';
$sah3='Belum';
if ($stk2[sah]=='1') $sah3='Sudah';
if ($stk2[Status]=='1') $stk3='Belum IMLTD';
if ($stk2[Status]=='2') $stk3='Sehat';
if ($stk2[Status]=='3') $stk3='Titip/Keluar';
if ($stk2[Status]=='4') $stk3='Rusak';
if ($stk2[Status]=='5') $stk3='Gagal';

$peng='Antri';
if ($trans['jumHB']=='1') $peng='Lolos MCU';
if ($trans['jumHB']=='2') $peng='Gagal MCU';
if ($trans['jumHB']=='3') $peng='Gagal MCU';
if ($trans['jumHB']=='4') $peng='Gagal MCU';
if ($trans[Pengambilan]=='0') $peng='Berhasil';
if ($trans[Pengambilan]=='2') $peng='Gagal';
if ($trans[Pengambilan]=='1') $peng='Batal';

//$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$trans[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$trans[NoKantong]') "));
$petugas_aftap=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugas]'"));
$petugas_hb=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasHB]'"));
$petugas_tensi=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasTensi]'"));
//$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
$dr=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa where kode='$trans[NamaDokter]'"));
/*$instansi=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where id_user='$trans[Instansi]'"));*/
?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

	<td><?=$no1++?></td>
      <td class=input><?=$trans[NoTrans]?></td>
      <td class=input><?=$trans[Nama]?></td>
	<td class=input><?=$trans[Alamat]?></td>
	<td class=input><?=$trans[umur]?> th</td>
	<td class=input><?=$trans[telp2]?></td>
      <td class=input><?=$jamantri1?></td>
	<td class=input><?=$petugas_tensi[nama_lengkap]?></td>
	<td class=input><?=$petugas_hb[nama_lengkap]?></td>
      <td class=input><?=$trans[GolDarah]?>(<?=$trans[Rhesus]?>)</td>
      <td class=input><?=$peng?></td>
      <td class=input><?=$jamaftap1?></td>
	<td class=input><?=$petugas_aftap[nama_lengkap]?></td>
	<td class=input><?=$dr[Nama]?></td>
        <? echo "<td class=input><a href=pmi".$_SESSION[leveluser].".php?module=updatekantong&noKantong=".$trans[NoKantong].">".$trans[NoKantong]."</a></td>"; ?>
      <td class=input><?=$sah3?></td>
      <td class=input><?=$stk3?></td>
	<!--td class=input><?=$petugas_imltd[nama_lengkap]?></td-->
      <td class=input><?=$cocok3?></td>
	<td class=input><?=$trans[Instansi]?></td>

	</tr>
<?
}
?>
</table>
<?
//PENGAMBILAN BERHASIL MU
$jum_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and NoTrans like 'M%'"));
$golA_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and NoTrans like 'M%'"));
$golB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and NoTrans like 'M%'"));
$golAB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and NoTrans like 'M%'"));
$golO_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and NoTrans like 'M%'"));
$jkP_m=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and NoTrans like 'M%'"));
$jkW_m=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and NoTrans like 'M%'"));

$rhposA_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and rhesus='+' and NoTrans like 'M%'"));
$rhposB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and rhesus='+' and NoTrans like 'M%'"));
$rhposAB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and rhesus='+' and NoTrans like 'M%'"));
$rhposO_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and rhesus='+' and NoTrans like 'M%'"));


$rhnegA_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and rhesus='-' and NoTrans like 'M%'"));
$rhnegB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and rhesus='-' and NoTrans like 'M%'"));
$rhnegAB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and rhesus='-' and NoTrans like 'M%'"));
$rhnegO_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and rhesus='-' and NoTrans like 'M%'"));

$rhposP_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and rhesus='+' and NoTrans like 'M%'"));
$rhposW_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and rhesus='+' and NoTrans like 'M%'"));
$rhnegP_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and rhesus='-' and NoTrans like 'M%'"));
$rhnegW_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and rhesus='-' and NoTrans like 'M%'"));

$rhpos_m=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and rhesus='+' and NoTrans like 'M%'"));
$rhneg_m=mysql_fetch_assoc(mysql_query("select count(rhesus) as neg from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and rhesus='-' and NoTrans like 'M%'"));

//MOBILE GAGAL

$jum_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and NoTrans like 'M%'"));

$golA_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and NoTrans like 'M%'"));
$golB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and NoTrans like 'M%'"));
$golAB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and NoTrans like 'M%'"));
$golO_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='O' and NoTrans like 'M%'"));
$jkP_mg=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and NoTrans like 'M%'"));
$jkW_mg=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='1' and NoTrans like 'M%'"));

$rhposA_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and rhesus='+' and NoTrans like 'M%'"));
$rhposB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and rhesus='+' and NoTrans like 'M%'"));
$rhposAB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and rhesus='+' and NoTrans like 'M%'"));
$rhposO_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='O' and rhesus='+' and NoTrans like 'M%'"));


$rhnegA_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and rhesus='-' and NoTrans like 'M%'"));
$rhnegB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and rhesus='-' and NoTrans like 'M%'"));
$rhnegAB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and rhesus='-' and NoTrans like 'M%'"));
$rhnegO_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='O' and rhesus='-' and NoTrans like 'M%'"));

$rhposP_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and rhesus='+' and NoTrans like 'M%'"));
$rhposW_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='1' and rhesus='+' and NoTrans like 'M%'"));
$rhnegP_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and rhesus='-' and NoTrans like 'M%'"));
$rhnegW_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='1' and rhesus='-' and NoTrans like 'M%'"));

$rhpos_mg=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and rhesus='+' and NoTrans like 'M%'"));
$rhneg_mg=mysql_fetch_assoc(mysql_query("select count(rhesus) as neg from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and rhesus='-' and NoTrans like 'M%'"));


//Mobile BATAL

$jum_mb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'M%'"));

$golA_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='A' and NoTrans like 'M%'"));
$golB_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='B' and NoTrans like 'M%'"));
$golAB_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='AB' and NoTrans like 'M%'"));
$golO_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='O' and NoTrans like 'M%'"));
$jkP_mb=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and jk='0' and NoTrans like 'M%'"));
$jkW_mb=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and jk='1' and NoTrans like 'M%'"));


//REKAP HASIL BUS MU
//BUS BERHASIL
$mjum_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and NoTrans like 'M%' and kendaraan='0'"));

$mgolA_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and kendaraan='0' and NoTrans like 'M%' "));
$mgolB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and kendaraan='0' and NoTrans like 'M%' "));
$mgolAB_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and kendaraan='0' and NoTrans like 'M%' "));
$mgolO_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and kendaraan='0' and NoTrans like 'M%' "));
$mjkP_m=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and kendaraan='0' and NoTrans like 'M%'"));
$mjkW_m=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and kendaraan='0' and NoTrans like 'M%'"));
$mrhpos_m=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and rhesus='+' and kendaraan='0' and NoTrans like 'M%' "));
$mrhneg_m=mysql_fetch_assoc(mysql_query("select count(rhesus) as neg from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and rhesus='+' and kendaraan='0' and NoTrans like 'M%' "));

//BUS GAGAL
$mjum_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and NoTrans like 'M%' and kendaraan='0'"));

$mgolA_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and NoTrans like 'M%' and kendaraan='0'"));
$mgolB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and NoTrans like 'M%' and kendaraan='0'"));
$mgolAB_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and NoTrans like 'M%' and kendaraan='0'"));
$mgolO_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='O' and NoTrans like 'M%' and kendaraan='0'"));
$mjkP_mg=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and NoTrans like 'M%' and kendaraan='0'"));
$mjkW_mg=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and NoTrans like 'M%' and kendaraan='0'"));

$mrhpos_mg=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and rhesus='+' and NoTrans like 'M%' and kendaraan='0'"));
$mrhneg_mg=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and rhesus='+' and NoTrans like 'M%' and kendaraan='0'"));

//BUS BATAL

$mjum_mb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'M%' and kendaraan='0'"));

$mgolA_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='A' and NoTrans like 'M%' and kendaraan='0'"));
$mgolB_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='B' and NoTrans like 'M%' and kendaraan='0'"));
$mgolAB_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='AB' and NoTrans like 'M%' and kendaraan='0'"));
$mgolO_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and gol_darah='O' and NoTrans like 'M%' and kendaraan='0'"));
$mjkP_mb=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and jk='0' and NoTrans like 'M%' and kendaraan='0'"));
$mjkW_mb=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and jk='0' and NoTrans like 'M%' and kendaraan='0'"));

$mrhpos_mb=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and pd.Rhesus='+' and NoTrans like 'M%' and kendaraan='0'"));
$mrhneg_mb=mysql_fetch_assoc(mysql_query("select count(rhesus) as neg from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and pd.Rhesus='-' and NoTrans like 'M%' and kendaraan='0'"));

//Jenis Kantong MU

$single_m=mysql_fetch_assoc(mysql_query("select count(kodependonor) as S from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='1' and Pengambilan='0' and NoTrans like 'M%'"));
$double_m=mysql_fetch_assoc(mysql_query("select count(kodependonor) as D from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='2' and Pengambilan='0' and NoTrans like 'M%'"));
$triple_m=mysql_fetch_assoc(mysql_query("select count(kodependonor) as T from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='3' and Pengambilan='0' and NoTrans like 'M%'"));
$quadruple_m=mysql_fetch_assoc(mysql_query("select count(kodependonor) as Q from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='4' and Pengambilan='0' and NoTrans like 'M%'"));
$pediatrik_m=mysql_fetch_assoc(mysql_query("select count(kodependonor) as P from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='6' and Pengambilan='0' and NoTrans like 'M%'"));

$single_mg=mysql_fetch_assoc(mysql_query("select count(kodependonor) as S from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='1' and Pengambilan='2' and NoTrans like 'M%'"));
$double_mg=mysql_fetch_assoc(mysql_query("select count(kodependonor) as D from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='2' and Pengambilan='2' and NoTrans like 'M%'"));
$triple_mg=mysql_fetch_assoc(mysql_query("select count(kodependonor) as T from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='3' and Pengambilan='2' and NoTrans like 'M%'"));
$quadruple_mg=mysql_fetch_assoc(mysql_query("select count(kodependonor) as Q from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='4' and Pengambilan='2' and NoTrans like 'M%'"));
$pediatrik_mg=mysql_fetch_assoc(mysql_query("select count(kodependonor) as P from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jeniskantong='6' and Pengambilan='2' and NoTrans like 'M%'"));


//BARU dan ULANG MU
$db_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and donorbaru='0' and NoTrans like 'M%'"));
$du_m=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and donorbaru='1' and NoTrans like 'M%'"));

$db_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and donorbaru='0' and NoTrans like 'M%'"));
$du_mg=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and donorbaru='1' and NoTrans like 'M%'"));

$db_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or pengambilan='-') and donorbaru='0' and NoTrans like 'M%'"));
$du_mb=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or pengambilan='-') and donorbaru='1' and NoTrans like 'M%'"));

?>
<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Mobile Unit BERHASIL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>JML</b></td>
<td><b>Rhesus</b></td>
</tr>
<tr><td> <b> A </td>
<td class=input><?=$golA_m[A]?></td><td>Pos: <?=$rhposA_m[A]?>   Neg: <?=$rhnegA_m[A]?></td></tr>
<tr><td> <b>B </td>
<td class=input><?=$golB_m[B]?></td><td>Pos: <?=$rhposB_m[B]?>   Neg: <?=$rhnegB_m[B]?></td></tr>
<tr><td> <b>AB </td>
<td class=input><?=$golAB_m[AB]?></td><td>Pos: <?=$rhposAB_m[AB]?>   Neg: <?=$rhnegAB_m[AB]?></td></tr>
<tr><td> <b>O </td>
<td class=input><?=$golO_m[O]?></td><td>Pos: <?=$rhposO_m[O]?>   Neg: <?=$rhnegO_m[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_m[P]?></td><td>Pos: <?=$rhposP_m[P]?>   Neg: <?=$rhnegP_m[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_m[W]?></td><td>Pos: <?=$rhposW_m[W]?>   Neg: <?=$rhnegW_m[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum_m[kod]?></b></td><td><b>Pos: <?=$rhpos_m[pos]?>   Neg: <?=$rhneg_m[neg]?></b></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Mobile Unit GAGAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>JML</b></td>
<td><b>Rhesus</b></td>
</tr>
<tr><td> <b> A </td>
<td class=input><?=$golA_mg[A]?></td><td>Pos: <?=$rhposA_mg[A]?>   Neg: <?=$rhnegA_mg[A]?></td></tr>
<tr><td> <b>B </td>
<td class=input><?=$golB_mg[B]?></td><td>Pos: <?=$rhposB_mg[B]?>   Neg: <?=$rhnegB_mg[B]?></td></tr>
<tr><td> <b>AB </td>
<td class=input><?=$golAB_mg[AB]?></td><td>Pos: <?=$rhposAB_mg[AB]?>   Neg: <?=$rhnegAB_mg[AB]?></td></tr>
<tr><td> <b>O </td>
<td class=input><?=$golO_mg[O]?></td><td>Pos: <?=$rhposO_mg[O]?>   Neg: <?=$rhnegO_mg[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_mg[P]?></td><td>Pos: <?=$rhposP_mg[P]?>   Neg: <?=$rhnegP_g[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_mg[W]?></td><td>Pos: <?=$rhposW_mg[W]?>   Neg: <?=$rhnegW_mg[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum_mg[kod]?></td><td>Pos: <?=$rhpos_mg[pos]?>   Neg: <?=$rhneg_mg[neg]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Mobile Unit BATAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td class=input><?=$golA_mb[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$golB_mb[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$golAB_mb[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$golO_mb[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_mb[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_mb[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td class=input><?=$jum_mb[kod]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=4><b>Rekap Transaksi BUS MU</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Berhasil </b></td>
<td><b>Gagal </b></td>
<td><b>Batal </b></td>
</tr>
<tr><td> A </td>
<td class=input><?=$mgolA_m[A]?></td><td class=input><?=$mgolA_mg[A]?></td><td class=input><?=$mgolA_mb[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$mgolB_m[B]?></td><td class=input><?=$mgolB_mg[B]?></td><td class=input><?=$mgolB_mb[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$mgolAB_m[AB]?></td><td class=input><?=$mgolAB_mg[AB]?></td><td class=input><?=$mgolAB_mb[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$mgolO_m[O]?></td><td class=input><?=$mgolO_mg[O]?></td><td class=input><?=$mgolO_mb[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$mjkP_m[P]?></td><td class=input><?=$mjkP_mg[P]?></td><td class=input><?=$mjkP_mb[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$mjkW_m[W]?></td><td class=input><?=$mjkW_mg[W]?></td><td class=input><?=$mjkW_mb[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td class=input><?=$mjum_m[kod]?></td><td class=input><?=$mjum_mg[kod]?></td><td class=input><?=$mjum_mb[kod]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap JENIS KANTONG yang terpakai MU</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Kantong</b></td>
<th class ="field" colspan='2'><b>Jumlah </b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal Aftap</b></th>

<tr><td>Single</td>
<td class=input><?=$single_m[S]?></td><td class=input><?=$single_mg[S]?></td></tr>
<tr><td>Double</td>
<td class=input><?=$double_m[D]?></td><td class=input><?=$double_mg[D]?></td></tr>
<tr><td>Triple</td>
<td class=input><?=$triple_m[T]?></td><td class=input><?=$triple_mg[T]?></td></tr>
<tr><td>Quadruple</td>
<td class=input><?=$quadruple_m[Q]?><td class=input><?=$quadruple_mg[Q]?></td></td></tr>
<tr><td>Pediatrik</td>
<td class=input><?=$pediatrik_m[P]?><td class=input><?=$pediatrik_mg[P]?></td></td></tr>
<tr><td>JML TTL</td>
<td class=input><?=$single_m[S]+$double_m[D]+$triple_m[T]+$quadruple_m[Q]+$pediatrik_m[P]?></td><td class=input><?=$single_mg[S]+$double_mg[D]+$triple_mg[T]+$quadruple_mg[Q]+$pediatrik_mg[P]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=4><b>Rekap JENIS PENDONOR MU</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Pendonor</b></td>
<th class ="field" colspan='3'><b>Jumlah Aftap</b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal</b></th><th><b>Batal</b></th>

<tr><td>Baru</td>
<td class=input><?=$db_m[B]?></td><td class=input><?=$db_mg[B]?></td><td class=input><?=$db_mb[B]?></td></tr>
<tr><td>Ulang</td>
<td class=input><?=$du_m[U]?></td><td class=input><?=$du_mg[U]?></td><td class=input><?=$du_mb[U]?></td></tr>
<tr><td>JML TTL</td><td class=input><?=$db_m[B]+$du_m[U]?></td><td class=input><?=$db_mg[B]+$du_mg[U]?></td><td class=input><?=$db_mb[B]+$du_mb[U]?></td></tr>
</table>
</td>


</tr>
</table>
</br>
