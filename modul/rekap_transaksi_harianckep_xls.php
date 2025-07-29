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
<div>
<form name=sahdarah1 method=post> Mulai:
<input type=text name=terima1 id="datepicker" size=10>
Sampai:
<input type=text name=terima2 id="datepicker1" size=10>
<input type=submit name=submit value=Submit>
</form></div>
<? 
if (($_SESSION[leveluser]=='laboratorium') or ($_SESSION[leveluser]=='kasir') or ($_SESSION[leveluser]=='aftap')){ ?>
<div>
</div>
<? } ?>

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
		ht.jumHB,ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Rhesus,pd.Nama,pd.telp2,ht.petugas,ht.petugasHB,ht.petugasTensi,ht.NamaDokter,ht.Instansi,ht.JenisDonor,ht.NoForm  
		from htransaksi as ht,pendonor as pd 
		where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and 
		ht.KodePendonor=pd.Kode and ht.NoTrans like 'DG%' order by NoTrans";
//echo $trans0_sql;
?>
<table border=1 cellpadding=0 cellspacing=0>

<?
$trans0=mysql_query($trans0_sql);
while ($trans=mysql_fetch_assoc($trans0)) {
$stk='';
$jamaftap='-';
$cocok1='-';
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



$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$trans[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$trans[NoKantong]') "));
$petugas_aftap=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugas]'"));
$petugas_hb=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasHB]'"));
$petugas_tensi=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasTensi]'"));
$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
$dr=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa where kode='$trans[NamaDokter]'"));

?>

<?

}
?>
</table>
<?



//RH POS
$rhposAu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposBu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposABu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposOu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposxu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhposA18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposAB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposO18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposx18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhposA25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposB25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposAB25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposO25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposx25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhposA45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposAB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposO45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposx45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhposA60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposAB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposO60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhposx60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//RH NEG
$rhnegAu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegBu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegABu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegOu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegxu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhnegA18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd,umur<25) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd,umur<25) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegAB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd,umur<25) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegO18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd,umur<25) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegx18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd,umur<25) and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhnegA25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd,umur<45) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegB25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd,umur<45) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegA25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd,umur<45) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegO25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd,umur<45) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegx25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd,umur<45) and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhnegA45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd,umur<60) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd,umur<60) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegAB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd,umur<60) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegO45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd,umur<60) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegx45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd,umur<60) and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhnegA60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegAB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegO60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhnegx60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//
$dsu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='0' and pd.umur < 18 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dpu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='1' and pd.umur < 18 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dsposu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='0' and pd.umur<18 and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dsnegu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='0' and pd.umur<18 and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));


//Jns Kel
$jkPu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkWu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkP18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkP25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkP45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkP60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//Jumlah Total
$totu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));


//DS Baru & Lama
//$dsbru18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.JumDonor ='1' and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
//$dslmu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.JumDonor >1 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$dsbru18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.JumDonor ='1' and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dslmu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur <18 and pd.JumDonor >1 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dsbr18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.JumDonor ='1' and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dslm18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.JumDonor >1 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dsbr25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.JumDonor ='1' and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dslm25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.JumDonor >1 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dsbr45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.JumDonor ='1' and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dslm45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.JumDonor >1 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dsbr60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.JumDonor ='1' and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dslm60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur >59 and pd.JumDonor >1 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));


//Dp
$dpu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur < 18 and ht.JenisDonor='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dp18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='1' and (pd.umur >17 and pd.umur <25) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dp25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='1' and (pd.umur >24 and pd.umur <45) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dp45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='1' and (pd.umur >44 and pd.umur <60) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dp60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.JenisDonor='1' and pd.umur >59 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//total apheresis
$tot_apu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur <18 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot_ap18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >17 and pd.umur <25) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot_ap25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >24 and pd.umur <45) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot_ap45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >44 and pd.umur <60) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$tot_ap60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur >59 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//DS/Dp Apheresis
$dsapu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur <18 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dpapu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur <18 and ht.JenisDonor='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$dsap18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >17 and pd.umur <25) and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dpap18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >17 and pd.umur <25) and ht.JenisDonor='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$dsap25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >24 and pd.umur <45) and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dpap25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >24 and pd.umur <45) and ht.JenisDonor='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$dsap45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >44 and pd.umur <60) and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dpap45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >44 and pd.umur <60)  and ht.JenisDonor='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$dsap60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur >59 and ht.JenisDonor='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$dpap60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur >59 and ht.JenisDonor='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//JK apheresis
$jkP_apu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur <18 and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW_apu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur <18 and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$jkP_ap18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >17 and pd.umur <25) and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW_ap18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >17 and pd.umur <25) and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$jkP_ap25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >24 and pd.umur <45) and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW_ap25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >24 and pd.umur <45) and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$jkP_ap45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >44 and pd.umur <60) and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW_ap45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and (pd.umur >44 and pd.umur <60) and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$jkP_ap60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur >59 and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW_ap60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil='1' and pd.umur >59 and pd.jk='1'  and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//rh pos aphereis
$rhpos_apAu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur<18 and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apBu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur<18 and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apABu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur<18 and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apOu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur<18 and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhpos_apA18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apAB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apO18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur <25) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhpos_apA25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apB25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apAB25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apO25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur <45) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhpos_apA45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apAB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apO45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur <60) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhpos_apA60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apAB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhpos_apO60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

//rh neg apheresis
$rhneg_apAu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur <18 and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apBu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur <18 and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apABu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur <18 and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apOu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur <18 and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhneg_apA18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur<25) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur<25) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apAB18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur<25) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apO18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >17 and pd.umur<25) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhneg_apA25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur<45) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apB25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur<45) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apAB25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur<45) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apO25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >24 and pd.umur<45) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhneg_apA45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur<60) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur<60) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apAB45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur<60) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apO45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and (pd.umur >44 and pd.umur<60) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$rhneg_apA60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apAB60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$rhneg_apO60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and ht.caraAmbil ='1' and pd.umur >59 and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

?>
<br>

<?
$trans0=mysql_query("select ht.NoTrans,ht.KodePendonor,ht.JenisDonor,ht.Reaksi,ht.catatan,ht.Pengambilan,
		ht.jumHB,ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Rhesus,pd.Nama,pd.telp2,ht.petugas,ht.petugasHB,ht.petugasTensi,ht.NamaDokter,ht.Instansi  
		from htransaksi as ht,pendonor as pd 
		where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and 
		ht.KodePendonor=pd.Kode and ht.NoTrans like 'M%' order by NoTrans");
while ($trans=mysql_fetch_assoc($trans0)) {
$stk='';
$jamaftap='-';
if ($trans[NoKantong]!='') {
$jamantri=substr($trans[Tgl],11);
$stk=mysql_fetch_assoc(mysql_query("select Status,sah,tgl_Aftap from stokkantong where noKantong='$trans[NoKantong]'"));
$cocok=mysql_fetch_assoc(mysql_query("select cocok from dkonfirmasi where noKantong='$trans[NoKantong]'"));
$cocok1='-';
if ($cocok[cocok]=='0') $cocok1='Cocok';
if ($cocok[cocok]=='1') $cocok1='Tidak Cocok';
$jamaftap=substr($stk[tgl_Aftap],11);
}
$stk1='-';
$sah1='-';
if ($stk[sah]=='1') {$sah1='Karantina';
if ($stk[Status]=='1') $stk1='Belum IMLTD';
if ($stk[Status]=='2') $stk1='Sehat';
if ($stk[Status]=='3') $stk1='Titip/Keluar';
if ($stk[Status]=='4') $stk1='Rusak';
if ($stk[Status]=='5') $stk1='Gagal';
}
$peng='Antri';
if ($trans['jumHB']=='1') $peng='Lolos MCU';
if ($trans['jumHB']=='2') $peng='Gagal MCU';
if ($trans['jumHB']=='3') $peng='Gagal MCU';
if ($trans['jumHB']=='4') $peng='Gagal MCU';
if ($trans[Pengambilan]=='0') $peng='Berhasil';
if ($trans[Pengambilan]=='2') $peng='Gagal';
if ($trans[Pengambilan]=='1') $peng='Batal';

$pet=mysql_fetch_assoc(mysql_query("(select dicatatOleh as imltd from hasilelisa where noKantong='$trans[NoKantong]') UNION (select dicatatoleh as imltd from drapidtest where noKantong='$trans[NoKantong]') "));
$petugas_aftap=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugas]'"));
$petugas_hb=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasHB]'"));
$petugas_tensi=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$trans[petugasTensi]'"));
$petugas_imltd=mysql_fetch_assoc(mysql_query("select nama_lengkap from user where id_user='$pet[imltd]'"));
$dr=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa where kode='$trans[NamaDokter]'"));
/*$instansi=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where id_user='$trans[Instansi]'"));*/
?>

<?
}
?>
</table>
<?
$jum_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and NoTrans like 'M%'"));
//$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
//$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));
$golA_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golB_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golAB_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golO_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_m=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
//$jkP_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_m=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
//$jkW_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhposA_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposB_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposAB_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposO_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhnegA_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegB_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegAB_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegO_m=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhposP_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='0' and pd.Jk='0' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposW_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='0' and pd.Jk='1' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhnegP_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='0' and pd.Jk='0' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegW_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='0' and pd.Jk='1' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));





$jum_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and NoTrans like 'M%'"));
//$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
//$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));
$golA_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golAB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golO_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='2' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='2' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhposA_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposAB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposO_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhnegA_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegAB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegO_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhposP_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='2' and pd.Jk='0' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposW_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='2' and pd.Jk='1' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhnegP_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='2' and pd.Jk='0' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegW_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.Pengambilan='2' and pd.Jk='1' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));



$jum_mb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'M%'"));
//$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
//$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));
$golA_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golB_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golAB_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golO_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_mb=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='1' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_mb=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M'  and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhpos_m=mysql_fetch_assoc(mysql_query("select count(pd.Rhesus) as pos from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhneg_m=mysql_fetch_assoc(mysql_query("select count(pd.Rhesus) as neg from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhpos_mg=mysql_fetch_assoc(mysql_query("select count(pd.Rhesus) as pos from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhneg_mg=mysql_fetch_assoc(mysql_query("select count(pd.Rhesus) as neg from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

//MU
$rhposA_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>17 and pd.umur <25)  and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposB_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>17 and pd.umur <25) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposAB_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>17 and pd.umur <25) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposO_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>17 and pd.umur <25) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposx_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>17 and pd.umur <25) and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhposA_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>24 and pd.umur <45)  and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposB_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>24 and pd.umur <45) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposAB_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>24 and pd.umur <45) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposO_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>24 and pd.umur <45) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposx_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>24 and pd.umur <45) and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhposA_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>44 and pd.umur <60)  and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposB_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>44 and pd.umur <60) and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposAB_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>44 and pd.umur <60) and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposO_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>44 and pd.umur <60) and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposx_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and (pd.umur>44 and pd.umur <60) and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhposA_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur>59  and pd.GolDarah='A' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposB_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and pd.umur>59 and pd.GolDarah='B' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposAB_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur>59 and pd.GolDarah='AB' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposO_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and pd.umur>59 and pd.GolDarah='O' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhposx_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0'  and pd.umur>59 and pd.GolDarah='X' and pd.Rhesus='+' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

//rh neg
$rhnegA_mu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegB_mu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegAB_mu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegO_mu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegx_mu18=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur<18 and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));


$rhnegA_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>17 and pd.umur <25) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegB_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>17 and pd.umur <25) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegAB_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>17 and pd.umur <25) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegO_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>17 and pd.umur <25) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegx_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>17 and pd.umur <25) and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhnegA_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>24 and pd.umur <45) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegB_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>24 and pd.umur <45) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegAB_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>24 and pd.umur <45) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegO_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>24 and pd.umur <45) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegx_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>24 and pd.umur <45) and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhnegA_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>44 and pd.umur <60) and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegB_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>44 and pd.umur <60) and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegAB_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>44 and pd.umur <60) and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegO_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>44 and pd.umur <60) and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegx_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and (pd.umur>44 and pd.umur <60) and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$rhnegA_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur>59 and pd.GolDarah='A' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegB_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur>59 and pd.GolDarah='B' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegAB_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur>59 and pd.GolDarah='AB' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegO_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur>59 and pd.GolDarah='O' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$rhnegx_m60=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as X from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.umur>59 and pd.GolDarah='X' and pd.Rhesus='-' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

//Jns Kel
$jkP_mu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and pd.umur <18 and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_mu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and pd.umur <18 and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (pd.umur >17 and pd.umur <25) and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (pd.umur >17 and pd.umur <25) and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (pd.umur >24 and pd.umur <45) and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (pd.umur >24 and pd.umur <45) and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (pd.umur >44 and pd.umur <60) and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (pd.umur >44 and pd.umur <60) and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_m60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and pd.umur >59 and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_m60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and pd.umur >59 and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));


//DB & DU
$dBr_mu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.umur<18 and pd.JumDonor=1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dLm_mu18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.umur<18 and pd.JumDonor>1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dBr_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.JumDonor=1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dLm_m18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.JumDonor>1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dBr_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.JumDonor=1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dLm_m25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.JumDonor>1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dBr_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.JumDonor=1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dLm_m45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.JumDonor>1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dBr_m60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.umur >59 and pd.JumDonor=1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$dLm_m60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.umur >59 and pd.JumDonor>1 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));


//Total
$totmu_u18=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.umur <18 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$totmu18_24=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >17 and pd.umur <25) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$totmu25_44=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >24 and pd.umur <45) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$totmu45_59=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and (pd.umur >44 and pd.umur <60) and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$totmu60=mysql_fetch_assoc(mysql_query("select count(pd.Kode) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.tempat='M' and ht.Pengambilan='0' and pd.umur >59 and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

//total rh pos
$totau18=$rhposAu18[A] + $rhposA_mu18[A];
$totbu18=$rhposBu18[B] + $rhposB_mu18[B];
$totabu18=$rhposABu18[AB] + $rhposAB_mu18[AB];
$totou18=$rhposOu18[O] + $rhposO_mu18[O];
$totxu18=$rhposxu18[X] + $rhposx_mu18[X];

$tota18_24=$rhposA18_24[A] + $rhposA_m18_24[A];
$totb18_24=$rhposB18_24[B] + $rhposB_m18_24[B];
$totab18_24=$rhposAB18_24[AB] + $rhposAB_m18_24[AB];
$toto18_24=$rhposO18_24[O] + $rhposO_m18_24[O];
$totx18_24=$rhposx18_24[X] + $rhposx_m18_24[X];

$tota25_44=$rhposA25_44[A] + $rhposA_m25_44[A];
$totb25_44=$rhposB25_44[B] + $rhposB_m25_44[B];
$totab25_44=$rhposAB25_44[AB] + $rhposAB_m25_44[AB];
$toto25_44=$rhposO25_44[O] + $rhposO_m25_44[O];
$totx25_44=$rhposx25_44[X] + $rhposx_m25_44[X];

$tota45_59=$rhposA45_59[A] + $rhposA_m45_59[A];
$totb45_59=$rhposB45_59[B] + $rhposB_m45_59[B];
$totab45_59=$rhposAB45_59[AB] + $rhposAB_m45_59[AB];
$toto45_59=$rhposO45_59[O] + $rhposO_m45_59[O];
$totx45_59=$rhposx45_59[X] + $rhposx_m45_59[X];

$tota60=$rhposA60[A] + $rhposA_m60[A];
$totb60=$rhposB60[B] + $rhposB_m60[B];
$totab60=$rhposAB60[AB] + $rhposAB_m60[AB];
$toto60=$rhposO60[O] + $rhposO_m60[O];
$totx60=$rhposO60[X] + $rhposx_m60[X];
//total rh neg
$totanegu18=$rhnegAu18[A] + $rhnegA_mu18[A];
$totbnegu18=$rhnegBu18[B] + $rhnegB_mu18[B];
$totabnegu18=$rhnegABu18[AB] + $rhnegAB_mu18[AB];
$totonegu18=$rhnegOu18[O] + $rhnegO_mu18[O];
$totxnegu18=$rhnegxu18[X] + $rhnegO_mu18[X];

$totaneg18_24=$rhnegA18_24[A] + $rhnegA_m18_24[A];
$totbneg18_24=$rhnegB18_24[B] + $rhnegB_m18_24[B];
$totabneg18_24=$rhnegAB18_24[AB] + $rhnegAB_m18_24[AB];
$totoneg18_24=$rhnegO18_24[O] + $rhnegO_m18_24[O];
$totxneg18_24=$rhnegx18_24[X] + $rhnegx_m18_24[X];

$totaneg25_44=$rhnegA25_44[A] + $rhnegA_m25_44[A];
$totbneg25_44=$rhnegB25_44[B] + $rhnegB_m25_44[B];
$totabneg25_44=$rhnegAB25_44[AB] + $rhnegAB_m25_44[AB];
$totoneg25_44=$rhnegO25_44[O] + $rhnegO_m25_44[O];
$totxneg25_44=$rhnegx25_44[X] + $rhnegx_m25_44[X];

$totaneg45_59=$rhnegA45_59[A] + $rhnegA_m45_59[A];
$totbneg45_59=$rhnegB45_59[B] + $rhnegB_m45_59[B];
$totabneg45_59=$rhnegAB45_59[AB] + $rhnegAB_m45_59[AB];
$totoneg45_59=$rhnegO45_59[O] + $rhnegO_m45_59[O];
$totxneg45_59=$rhnegx45_59[X] + $rhnegx_m45_59[X];

$totaneg60=$rhnegA60[A] + $rhnegA_m60[A];
$totbneg60=$rhnegB60[B] + $rhnegB_m60[B];
$totabneg60=$rhnegAB60[AB] + $rhnegAB_m60[AB];
$totoneg60=$rhnegO60[O] + $rhnegO_m60[O];
$totxneg60=$rhnegx60[X] + $rhnegx_m60[X];

// total jk
$totjkpu18=$jkPu18[P] + $jkP_mu18[P];
$totjkwu18=$jkWu18[W] + $jkW_mu18[W];
$totjkp18_24=$jkP18_24[P] + $jkP_m18_24[P];
$totjkw18_24=$jkW18_24[W] + $jkW_m18_24[W];
$totjkp25_44=$jkP25_44[P] + $jkP_m25_44[P];
$totjkw25_44=$jkW25_44[W] + $jkW_m25_44[W];
$totjkp45_59=$jkP45_59[P] + $jkP_m45_59[P];
$totjkw45_59=$jkW45_59[W] + $jkW_m45_59[W];
$totjkp60=$jkP60[P] + $jkP_m60[P];
$totjkw60=$jkW60[W] + $jkW_m60[W];

//total donasi
$totdonu18=$totmu_u18[P] + $totu18[P];
$totdon18_24=$tot18_24[W] + $totmu18_24[W];
$totdon25_44=$tot25_44[P] + $totmu25_44[P];
$totdon45_59=$tot45_59[W] + $totmu45_59[W];
$totdon60=$tot60[P] + $totmu60[P];

?>
<br>
<table class="form" width="1071">
<th colspan="20">DONASI DARAH (jumlah Kantong Darah Yang Didapatkan Dari Donor Darah)</th>
<tr>
  <td width="114" rowspan="3">KELOMPOK UMUR</td>
  <td width="76" rowspan="3">JUMLAH TOTAL DONASI</td>
  <td colspan="4" align="center">Jumlah Donasi Dalam Gedung</td>
  <td colspan="2" rowspan="2" align="center">Jumlah Donasi Sukarela Dari Kegiatan Mobil Unit</td>
  <td colspan="2" rowspan="2" align="center">Jumlah Donasi Darah</td>
  <td colspan="10">jumlah donasi darah menurut golongan darah</td>
  </tr>
<tr>
  <td colspan="2" align="center">DS</td>
  <td width="32" rowspan="2">DP</td>
  <td width="82" rowspan="2">BAYARAN</td>
  <td colspan="2" align="center">O</td>
  <td colspan="2" align="center">A</td>
  <td colspan="2" align="center">B</td>
  <td colspan="2" align="center">AB</td>
  <td colspan="2" align="center">X</td>
  </tr>
<tr><td width="56">BARU</td><td width="70">ULANG</td>
  <td width="67">BARU</td>
  <td width="90">ULANG</td><td width="58">PRIA</td><td width="91">WANITA</td>
  <td width="26">Pos</td>
  <td width="33">Neg</td>
  <td width="27">Pos</td>
  <td width="30">Neg</td>
  <td width="30">Pos</td>
  <td width="37">Neg</td>
  <td width="32">Pos</td>
  <td width="44">Neg</td>
  <td width="32">Pos</td>
  <td width="44">Neg</td>
</tr>
<tr>
  <td>&lt; 18 Tahun</td>
  <td><?=$totdonu18?></td>
  <td><?=$dsbru18[P]?></td>
  <td><?=$dslmu18[W]?></td>
  <td><?=$dpu18[P]?></td>
  <td>&nbsp;</td>
  <td><?=$dBr_mu18[P]?></td>
  <td><?=$dLm_mu18[W]?></td>
  <td><?=$totjkpu18?></td>
  <td><?=$totjkwu18?></td>
  <td><?=$totou18?></td>
  <td><?=$totonegu18?></td>
  <td><?=$totau18?></td>
  <td><?=$totanegu18?></td>
  <td><?=$totbu18?></td>
  <td><?=$totbnegu18?></td>
  <td><?=$totabu18?></td>
  <td><?=$totabnegu18?></td>
  <td><?=$totxu18?></td>
  <td><?=$totxnegu18?></td>
</tr>
<tr>
  <td>18 - 24 Tahun</td>
  <td><?=$totdon18_24?></td>
  <td><?=$dsbr18_24[P]?></td>
  <td><?=$dslm18_24[W]?></td>
  <td><?=$dp18_24[W]?></td>
  <td></td>
  <td><?=$dBr_m18_24[P]?></td>
  <td><?=$dLm_m18_24[W]?></td>
  <td><?=$totjkp18_24?></td>
  <td><?=$totjkw18_24?></td>
  <td><?=$toto18_24?></td>
  <td><?=$totoneg18_24?></td>
  <td><?=$tota18_24?></td>
  <td><?=$totaneg18_24?></td>
  <td><?=$totb18_24?></td>
  <td><?=$totbneg18_24?></td>
  <td><?=$totab18_24?></td>
  <td><?=$totabneg18_24?></td>
  <td><?=$totx18_24?></td>
  <td><?=$totxneg18_24?></td>
</tr>
<tr>
  <td>25 - 44 Tahun</td>
  <td><?=$totdon25_44?></td>
  <td><?=$dsbr25_44[P]?></td>
  <td><?=$dslm25_44[W]?></td>
  <td><?=$dp25_44[P]?></td>
  <td>&nbsp;</td>
  <td><?=$dBr_m25_44[P]?></td>
  <td><?=$dLm_m25_44[W]?></td>
  <td><?=$totjkp25_44?></td>
  <td><?=$totjkw25_44?></td>
  <td><?=$toto25_44?></td>
  <td><?=$totoneg25_44?></td>
  <td><?=$tota25_44?></td>
  <td><?=$totaneg25_44?></td>
  <td><?=$totb25_44?></td>
  <td><?=$totbneg25_44?></td>
  <td><?=$totab25_44?></td>
  <td><?=$totabneg25_44?></td>
  <td><?=$totx25_44?></td>
  <td><?=$totxneg25_44?></td>
</tr>
<tr>
  <td>45 - 59 Tahun</td>
  <td><?=$totdon45_59?></td>
  <td><?=$dsbr45_59[P]?></td>
  <td><?=$dslm45_59[W]?></td>
  <td><?=$dp45_59[W]?></td>
  <td>&nbsp;</td>
  <td><?=$dBr_m45_59[P]?></td>
  <td><?=$dLm_m45_59[W]?></td>
  <td><?=$totjkp45_59?></td>
  <td><?=$totjkw45_59?></td>
  <td><?=$toto45_59?></td>
  <td><?=$totoneg45_59?></td>
  <td><?=$tota45_59?></td>
  <td><?=$totaneg45_59?></td>
  <td><?=$totb45_59?></td>
  <td><?=$totbneg45_59?></td>
  <td><?=$totab45_59?></td>
  <td><?=$totabneg45_59?></td>
  <td><?=$totx45_59?></td>
  <td><?=$totxneg45_59?></td>
</tr>
<tr>
  <td>60 Tahun Keatas</td>
  <td><?=$totdon60?></td>
  <td><?=$dsbr60[P]?></td>
  <td><?=$dslm60[W]?></td>
  <td><?=$dp60[P]?></td>
  <td>&nbsp;</td>
  <td><?=$dBr_m60[P]?></td>
  <td><?=$dLm_m60[W]?></td>
  <td><?=$totjkp60?></td>
  <td><?=$totjkw60?></td>
  <td><?=$toto60?></td>
  <td><?=$totoneg60?></td>
  <td><?=$tota60?></td>
  <td><?=$totaneg60?></td>
  <td><?=$totb60?></td>
  <td><?=$totbneg60?></td>
  <td><?=$totab60?></td>
  <td><?=$totabneg60?></td>
  <td><?=$totx60?></td>
  <td><?=$totxneg60?></td>
</tr>
</table>

</br>
<br>

<table class="form" width="1071">
<th colspan="17">Laporan Donasi Apheresis</th>
<tr>
  <td width="149" rowspan="3">KELOMPOK UMUR</td>
  <td width="120" rowspan="3">JUMLAH TOTAL DONASI</td>
  <td colspan="3" align="center">Jumlah Donasi Dalam Gedung</td>
  <td colspan="2" rowspan="2" align="center">Jumlah Donasi Darah</td>
  <td colspan="8">jumlah donasi darah menurut golongan darah</td>
  </tr>
<tr>
  <td width="57" rowspan="2" align="center">DS</td>
  <td width="60" rowspan="2" align="center">DP</td>
  <td width="99" rowspan="2">BAYARAN</td>
  <td colspan="2" align="center">O</td>
  <td colspan="2" align="center">A</td>
  <td colspan="2" align="center">B</td>
  <td colspan="2" align="center">AB</td>
  </tr>
<tr>
  <td width="72">PRIA</td><td width="82">WANITA</td>
  <td width="36">Pos</td>
  <td width="75">Neg</td>
  <td width="34">Pos</td>
  <td width="37">Neg</td>
  <td width="37">Pos</td>
  <td width="46">Neg</td>
  <td width="40">Pos</td>
  <td width="63">Neg</td>
</tr>
<tr>
  <td>&lt; 18 Tahun</td>
  <td><?=$tot_apu18[P]?></td>
  <td><?=$dsapu18[P]?></td>
  <td><?=$dpapu18[W]?></td>
  <td>&nbsp;</td>
  <td><?=$jkP_apu18[P]?></td>
  <td><?=$jkW_apu18[W]?></td>
  <td><?=$rhpos_apOu18[O]?></td>
  <td><?=$rhneg_apOu18[O]?></td>
  <td><?=$rhpos_apAu18[A]?></td>
  <td><?=$rhneg_apAu18[A]?></td>
  <td><?=$rhpos_apBu18[B]?></td>
  <td><?=$rhneg_apBu18[B]?></td>
  <td><?=$rhpos_apABu18[AB]?></td>
  <td><?=$rhneg_apABu18[AB]?></td>
</tr>
<tr>
  <td>18 - 24 Tahun</td>
  <td><?=$tot_ap18_24[W]?></td>
  <td><?=$dsap18_24[P]?></td>
  <td><?=$dpap18_24[W]?></td>
  <td></td>
  <td><?=$jkP_ap18_24[P]?></td>
  <td><?=$jkW_ap18_24[W]?></td>
  <td><?=$rhpos_apO18_24[O]?></td>
  <td><?=$rhneg_apO18_24[O]?></td>
  <td><?=$rhpos_apA18_24[A]?></td>
  <td><?=$rhneg_apA18_24[A]?></td>
  <td><?=$rhpos_apB18_24[B]?></td>
  <td><?=$rhneg_apB18_24[B]?></td>
  <td><?=$rhpos_apAB18_24[AB]?></td>
  <td><?=$rhneg_apAB18_24[AB]?></td>
</tr>
<tr>
  <td>25 - 44 Tahun</td>
  <td><?=$tot_ap25_44[P]?></td>
  <td><?=$dsap25_44[P]?></td>
  <td><?=$dpap25_44[W]?></td>
  <td>&nbsp;</td>
  <td><?=$jkP_ap25_44[P]?></td>
  <td><?=$jkW_ap25_44[W]?></td>
  <td><?=$rhpos_apO25_44[O]?></td>
  <td><?=$rhneg_apO25_44[O]?></td>
  <td><?=$rhpos_apA25_44[A]?></td>
  <td><?=$rhneg_apA25_44[A]?></td>
  <td><?=$rhpos_apB25_44[B]?></td>
  <td><?=$rhneg_apB25_44[B]?></td>
  <td><?=$rhpos_apAB25_44[AB]?></td>
  <td><?=$rhneg_apAB25_44[AB]?></td>
</tr>
<tr>
  <td>45 - 59 Tahun</td>
  <td><?=$tot_ap45_59[W]?></td>
  <td><?=$dsap45_59[P]?></td>
  <td><?=$dpap45_59[W]?></td>
  <td>&nbsp;</td>
  <td><?=$jkP_ap45_59[P]?></td>
  <td><?=$jkW_ap45_59[W]?></td>
  <td><?=$rhpos_apO45_59[O]?></td>
  <td><?=$rhneg_apO45_59[O]?></td>
  <td><?=$rhpos_apA45_59[A]?></td>
  <td><?=$rhneg_apA45_59[A]?></td>
  <td><?=$rhpos_apB45_59[B]?></td>
  <td><?=$rhneg_apB45_59[B]?></td>
  <td><?=$rhpos_apAB45_59[AB]?></td>
  <td><?=$rhneg_apAB45_59[AB]?></td>
</tr>
<tr>
  <td>60 Tahun Keatas</td>
  <td><?=$tot_ap60[P]?></td>
  <td><?=$dsap60[P]?></td>
  <td><?=$dpap60[W]?></td>
  <td>&nbsp;</td>
  <td><?=$jkP_ap60[P]?></td>
  <td><?=$jkW_ap60[W]?></td>
  <td><?=$rhpos_apO60[O]?></td>
  <td><?=$rhneg_apO60[O]?></td>
  <td><?=$rhpos_apA60[A]?></td>
  <td><?=$rhneg_apA60[A]?></td>
  <td><?=$rhpos_apB60[B]?></td>
  <td><?=$rhneg_apB60[B]?></td>
  <td><?=$rhpos_apAB60[AB]?></td>
  <td><?=$rhneg_apAB60[AB]?></td>
</tr>
</table>
</br>
