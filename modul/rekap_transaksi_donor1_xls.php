<?
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_transaksi_darah.xls");
header("Pragma: no-cache");
header("Expires: 0");

include('../config/db_connect.php');




$namauser=$_POST[namauser];
$today      	=$_POST[today];
$today1     	=$_POST[today1];
$src_nomorf   	=$_POST[instansi];
$src_status   	=$_POST[status];
$src_ambil    	=$_POST[ambil];
$src_shift    	=$_POST[shift];
$src_ktg      	=$_POST[ktg];
$src_drh      	=$_POST[drh];
$src_jk       	=$_POST[jk];
$src_rh      	=$_POST[rh];
$src_ds       	=$_POST[ds];
$src_baru       =$_POST[baru];
$hasil		=$_POST[hasil];

?>
<h1>REKAP TRANSAKSI DONOR</h1>
<h3>Dari Tanggal : <?=$today?>  s/d <?=$today1?></h1>


<?
$jum=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' 
and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' "));

//PENGAMBILAN BERHASIL DG

$golA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where  CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='A' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' "));
$golB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='B' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$golAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='AB' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$golO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='O' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$golx=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='X' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$jkP=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jk='0' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$jkW=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jk='1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));


//baru
$rhposA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and gol_darah='A' and rhesus='+' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$rhposB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and gol_darah='B' and rhesus='+' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$rhposAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and gol_darah='AB' and rhesus='+' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$rhposO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and gol_darah='O' and rhesus='+' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$rhposx=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and gol_darah='x' and rhesus='+' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));


$rhnegA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and gol_darah='A' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and gol_darah='B' and rhesus='-' "));
$rhnegAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and gol_darah='AB' and rhesus='-' "));
$rhnegO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and gol_darah='O' and rhesus='-' "));
$rhnegx=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and gol_darah='x' and rhesus='-' "));

$rhposP=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jk='0' and rhesus='+'"));
$rhposW=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jk='1' and rhesus='+'"));
$rhnegP=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jk='0' and rhesus='-'"));
$rhnegW=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jk='1' and rhesus='-'"));

$rhpos=mysql_fetch_assoc(mysql_query("select count(rhesus) as pos from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and rhesus='+' "));
$rhneg=mysql_fetch_assoc(mysql_query("select count(rhesus) as neg from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and rhesus='-' "));


//CARA PENGAMBILAN
$biasa=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and caraAmbil='0'"));
$tromboferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and caraAmbil='1' "));
$leukoferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and caraAmbil='2' "));
$plasmaferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and caraAmbil='3' "));
$eritoferesis=mysql_fetch_assoc(mysql_query("select count(kodependonor) as kod from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and caraAmbil='4' "));

/*
$dspos=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='0' and rhesus='+' and NoTrans like 'DG%'"));
$dsneg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='0' and rhesus='-' and NoTrans like 'DG%'"));
$dppos=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='1' and rhesus='+' and NoTrans like 'DG%'"));
$dpneg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and JenisDonor='1' and rhesus='-' and NoTrans like 'DG%'"));

*/
//Jenis Kantong DG

$single=mysql_fetch_assoc(mysql_query("select count(kodependonor) as S from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='1' "));
$double=mysql_fetch_assoc(mysql_query("select count(kodependonor) as D from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='2' "));
$triple=mysql_fetch_assoc(mysql_query("select count(kodependonor) as T from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='3' "));
$quadruple=mysql_fetch_assoc(mysql_query("select count(kodependonor) as Q from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='4' "));
$pediatrik=mysql_fetch_assoc(mysql_query("select count(kodependonor) as P from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='6' "));

/*
$single_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as S from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jeniskantong='1' and Pengambilan like '%$src_status%' "));
$double_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as D from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jeniskantong='2' and Pengambilan like '%$src_status%' "));
$triple_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as T from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jeniskantong='3' and Pengambilan like '%$src_status%' "));
$quadruple_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as Q from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jeniskantong='4' and Pengambilan like '%$src_status%' "));
$pediatrik_g=mysql_fetch_assoc(mysql_query("select count(kodependonor) as P from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jeniskantong='6' and Pengambilan like '%$src_status%' "));*/

//BARU dan ULANG MU
$db=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%'  and donorbaru='0'"));
$du=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%'  and donorbaru='1'"));

$db_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%'  and donorbaru='0'"));
$du_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and donorbaru='1'"));

$db_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and donorbaru='0'"));
$du_b=mysql_fetch_assoc(mysql_query("select count(gol_darah) as U from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and donorbaru='1'"));

//DS dan DP
$ds=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and JenisDonor='0'"));
$dsb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and JenisDonor='0'"));
$dsg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and JenisDonor='0' "));

$dp=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and JenisDonor='1' "));
$dpb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and JenisDonor='1' "));
$dpg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and JenisDonor='1' "));

//DG dan MU
//DS dan DP
$dg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and notrans like 'DG%' "));

$mu=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and notrans like 'M%' "));


$mu_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and notrans like 'M%' and kendaraan='1'"));

$mu_b=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and notrans like 'M%' and kendaraan='0' "));

//hasil aftap
$dg_s=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan='0' and notrans like 'DG%' "));

$dg_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan='2' and notrans like 'DG%' "));

$dg_b=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and (Pengambilan='1' or Pengambilan='-') and notrans like 'DG%' "));

$mu_s=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan='0' and notrans like 'M%' "));

$mu_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan='2' and notrans like 'M%' "));

$mu_b1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and (Pengambilan='1' or Pengambilan='-') and notrans like 'M%' "));

//KELOMOK UMUR
 //<18 DS
$ds_lk_baru=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='0' and umur < 18 and donorbaru='0'"));

$ds_lk_ulang=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='0' and umur < 18 and donorbaru='1'"));

$ds_pr_baru=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='1' and umur < 18 and donorbaru='0'"));

$ds_pr_ulang=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='1' and umur < 18 and donorbaru='1'"));

//<18 DP
$dp_lk_baru=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='0' and umur < 18 and donorbaru='0'"));

$dp_lk_ulang=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='0' and umur < 18 and donorbaru='1'"));

$dp_pr_baru=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='1' and umur < 18 and donorbaru='0'"));

$dp_pr_ulang=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='1' and umur < 18 and donorbaru='1'"));


 //18-24 DS
$ds_lk_baru1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='0' and umur >= 18 and umur < 25 and donorbaru='0'"));

$ds_lk_ulang1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='0' and umur >= 18 and umur < 25 and donorbaru='1'"));

$ds_pr_baru1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='1' and umur >= 18 and umur < 25 and donorbaru='0'"));

$ds_pr_ulang1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='1' and umur >= 18 and umur < 25 and donorbaru='1'"));

//18-24 DP
$dp_lk_baru1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='0' and umur >= 18 and umur < 25 and donorbaru='0'"));

$dp_lk_ulang1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='0' and umur >= 18 and umur < 25 and donorbaru='1'"));

$dp_pr_baru1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='1' and umur >= 18 and umur < 25 and donorbaru='0'"));

$dp_pr_ulang1=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='1' and umur >= 18 and umur < 25 and donorbaru='1'"));

//25-44 DS

$ds_lk_baru2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='0' and umur >= 25 and umur < 45 and donorbaru='0'"));

$ds_lk_ulang2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='0' and umur >= 25 and umur < 45 and donorbaru='1'"));

$ds_pr_baru2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='1' and umur >= 25 and umur < 45 and donorbaru='0'"));

$ds_pr_ulang2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='1' and umur >= 25 and umur < 45 and donorbaru='1'"));

//25-44 DP
$dp_lk_baru2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='0' and umur >= 25 and umur < 45 and donorbaru='0'"));

$dp_lk_ulang2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='0' and umur >= 25 and umur < 45 and donorbaru='1'"));

$dp_pr_baru2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='1' and umur >= 25 and umur < 45 and donorbaru='0'"));

$dp_pr_ulang2=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='1' and umur >= 25 and umur < 45 and donorbaru='1'")); 


//45-59 DS

$ds_lk_baru3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='0' and umur >= 45 and umur < 60 and donorbaru='0'"));

$ds_lk_ulang3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='0' and umur >= 45 and umur < 60 and donorbaru='1'"));

$ds_pr_baru3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='1' and umur >= 45 and umur < 60 and donorbaru='0'"));

$ds_pr_ulang3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='1' and umur >= 45 and umur < 60 and donorbaru='1'"));

//45-59 DP
$dp_lk_baru3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='0' and umur >= 45 and umur < 60 and donorbaru='0'"));

$dp_lk_ulang3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='0' and umur >= 45 and umur < 60 and donorbaru='1'"));

$dp_pr_baru3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='1' and umur >= 45 and umur < 60 and donorbaru='0'"));

$dp_pr_ulang3=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='1' and umur >= 45 and umur < 60 and donorbaru='1'")); 

//60 DS

$ds_lk_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='0' and umur > 60 and donorbaru='0'"));

$ds_lk_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='0' and umur > 60 and donorbaru='1'"));

$ds_pr_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='1' and umur > 60 and donorbaru='0'"));

$ds_pr_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='1' and umur > 60 and donorbaru='1'"));

//60 DP
$dp_lk_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='0' and umur > 60 and donorbaru='0'"));

$dp_lk_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='0' and umur > 60 and donorbaru='1'"));

$dp_pr_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='1' and umur > 60 and donorbaru='0'"));

$dp_pr_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='1' and umur > 60 and donorbaru='1'")); 


?>
<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP </b></th>
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
<tr><td><b> X </td>
<td class=input><?=$golx[x]?></td><td>Pos: <?=$rhposx[x]?>   Neg: <?=$rhnegx[x]?></tr>
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
<th colspan=2><b>Rekap Jenis Kantong</b></th>
<tr class="field">
<td><b>Jenis Kantong</b></td>
<td><b>Jumlah </b></td>
</tr>

<!--th><b>Berhasil</b></th><th><b>Gagal Aftap</b></th-->

<tr><td>Single</td><td class=input><?=$single[S]?></td></tr>
<tr><td>Double</td><td class=input><?=$double[D]?></td></tr>
<tr><td>Triple</td><td class=input><?=$triple[T]?></td></tr>
<tr><td>Quadruple</td><td class=input><?=$quadruple[Q]?></td></tr>
<tr><td>Pediatrik</td><td class=input><?=$pediatrik[P]?></td></tr>
<tr><td>JML TTL</td><td class=input><?=$single[S]+$double[D]+$triple[T]+$quadruple[Q]+$pediatrik[P]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap Jenis Pendonor</b></th>
<tr class="field">
<td><b>Jenis Pendonor</b></td>
<td><b>Jumlah </b></td>
</tr>

<tr><td>Baru</td>
<td class=input><?=$db[B]?></td></tr>
<tr><td>Ulang</td>
<td class=input><?=$du[U]?></td></tr>
<tr><td>DS</td>
<td class=input><?=$ds[P]?></td></tr>
<tr><td>DP</td>
<td class=input><?=$dp[W]?></td>
<tr><td>JML TTL</td><td class=input><?=$db[B]+$du[U]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=4><b>Rekap TEMPAT AFTAP</b></th>
<th class ="field" colspan='3' rowspan='2'><b>Hasil Aftap</b></th>
<tr class="field">
<td rowspan='2'><b>Tempat Donor</b></td>
<th class ="field" colspan='3'><b>Jumlah Aftap</b></th>

</tr>
<th><b>Jumlah</b></th><th><b>Mobil</b></th><th><b>Bus Donor</b></th><th><b>Berhasil</b></th><th><b>Gagal</b></th><th><b>Batal</b></th>

<tr><td>DG</td>
<td class=input align='center'><?=$dg[P]?></td><td class=input><?='-'?></td><td class=input><?='-'?></td> <td><?=$dg_s[P]?></td><td><?=$dg_g[P]?></td><td><?=$dg_b[P]?></td></tr>
<tr><td>MU</td>
<td class=input><?=$mu[P]?></td><td class=input><?=$mu_m[P]?></td><td class=input><?=$mu_b[P]?></td><td><?=$mu_s[P]?></td><td><?=$mu_g[P]?></td><td><?=$mu_b1[P]?></td></tr>
<!--tr><td>Mobil Donor</td>
<td class=input><?=$ds[P]?></td><td class=input><?=$dsg[P]?></td><td class=input><?=$dsb[P]?></td></tr>
<tr><td>BUS Donor</td>
<td class=input><?=$dp[W]?><td class=input><?=$dpg[W]?></td><td class=input><?=$dpb[W]?></td-->
<tr><td>JML TTL</td><td class=input><?=$dg[P]+$mu[P]?></td><td class=input><?=$mu_m[P]?></td><td class=input><?=$mu_b[P]?></td><td><?=$dg_s[P]+$mu_s[P]?></td><td><?=$dg_g[P]+$mu_g[P]?></td><td><?=$dg_b[P]+$mu_b1[P]?></td></tr>
</table>
</td>


</tr>
</table>
<tr>
</tr>
<table>
<tr>
<th><b>Rekap Umur berdasarkan pengambilan kantong </b></th>
</tr>
</table>

<table class=form border=1 cellpadding=0 cellspacing=0>
<tr class="field">
<td rowspan="3"><b>Kelompok Umur</b></td>
<td colspan="6" align=center ><b>DS</b></td><td colspan="6" align=center ><b>DP</b></td>
</tr>
<tr>
<td colspan="2">Laki - Laki</td><td colspan="2">Perempuan</td><td colspan='2'>Jumlah</td><td colspan="2">Laki - Laki</td><td colspan="2">Perempuan</td>
<td colspan="2">Jumlah</td>
</tr>
<tr>
<td>Baru</td><td>Ulang</td><td>Baru</td><td>Ulang</td><td>Angka</td><td>Persen</td><td>Baru</td><td>Ulang</td><td>Baru</td><td>Ulang</td><td>Angka</td><td>Persen</td>
</tr>

<!--th><b>Berhasil</b></th><th><b>Gagal Aftap</b></th-->

<tr>
<?
$jml_k18_lk_ds	=	$ds_lk_baru[P]  + $ds_lk_ulang[P]  + $ds_pr_baru[P]  + $ds_pr_ulang[P];
$jml_k18_lk_dp	=	$dp_lk_baru[P]  + $dp_lk_ulang[P]  + $dp_pr_baru[P]  + $dp_pr_ulang[P];
$jml_1824_lk_ds	=	$ds_lk_baru1[P] + $ds_lk_ulang1[P] + $ds_pr_baru1[P] + $ds_pr_ulang1[P];
$jml_1824_lk_dp	=	$dp_lk_baru1[P] + $dp_lk_ulang1[P] + $dp_pr_baru1[P] + $dp_pr_ulang1[P];
$jml_2544_lk_ds	=	$ds_lk_baru2[P] + $ds_lk_ulang2[P] + $ds_pr_baru2[P] + $ds_pr_ulang2[P];
$jml_2544_lk_dp	=	$dp_lk_baru2[P] + $dp_lk_ulang2[P] + $dp_pr_baru2[P] + $dp_pr_ulang2[P];
$jml_4559_lk_ds	=	$ds_lk_baru3[P] + $ds_lk_ulang3[P] + $ds_pr_baru3[P] + $ds_pr_ulang3[P];
$jml_4559_lk_dp	=	$dp_lk_baru3[P] + $dp_lk_ulang3[P] + $dp_pr_baru3[P] + $dp_pr_ulang3[P];
$jml_60_lk_ds	=	$ds_lk_baru4[P] + $ds_lk_ulang4[P] + $ds_pr_baru4[P] + $ds_pr_ulang4[P];
$jml_60_lk_dp	=	$dp_lk_baru4[P] + $dp_lk_ulang4[P] + $dp_pr_baru4[P] + $dp_pr_ulang4[P];


$jml_ds_lk_br	= $ds_lk_baru[P] + $ds_lk_baru1[P]  + $ds_lk_baru2[P]  + $ds_lk_baru3[P] + $ds_lk_baru4[P];
$jml_ds_lk_ulang= $ds_lk_ulang[P]+ $ds_lk_ulang1[P] + $ds_lk_ulang2[P] + $ds_lk_ulang3[P]+ $ds_lk_ulang4[P];
$jml_ds_pr_br	= $ds_pr_baru[P] + $ds_pr_baru1[P]  + $ds_pr_baru2[P]  + $ds_pr_baru3[P] + $ds_pr_baru4[P];
$jml_ds_pr_ulang= $ds_pr_ulang[P]+ $ds_pr_ulang1[P] + $ds_pr_ulang2[P] + $ds_pr_ulang3[P]+ $ds_pr_ulang4[P];
$jml_ds_lk_pr	= $jml_k18_lk_ds + $jml_1824_lk_ds  + $jml_2544_lk_ds  + $jml_4559_lk_ds + $jml_60_lk_ds;

$jml_dp_lk_br	= $dp_lk_baru[P] + $dp_lk_baru1[P]  + $dp_lk_baru2[P]  + $dp_lk_baru3[P] + $dp_lk_baru4[P];
$jml_dp_lk_ulang= $dp_lk_ulang[P]+ $dp_lk_ulang1[P] + $dp_lk_ulang2[P] + $dp_lk_ulang3[P]+ $dp_lk_ulang4[P];
$jml_dp_pr_br	= $dp_pr_baru[P] + $dp_pr_baru1[P]  + $dp_pr_baru2[P]  + $dp_pr_baru3[P] + $dp_pr_baru4[P];
$jml_dp_pr_ulang= $dp_pr_ulang[P]+ $dp_pr_ulang1[P] + $dp_pr_ulang2[P] + $dp_pr_ulang3[P]+ $dp_pr_ulang4[P];
$jml_dp_lk_pr	= $jml_k18_lk_dp + $jml_1824_lk_dp  + $jml_2544_lk_dp  + $jml_4559_lk_dp + $jml_60_lk_dp;

$jum_tot	= $jml_ds_lk_pr  + $jml_dp_lk_pr;

?>
<tr>
<td> < 18 Tahun</td><td class=input><?=$ds_lk_baru[P]?></td><td class=input><?=$ds_lk_ulang[P]?></td><td class=input><?=$ds_pr_baru[P]?></td><td class=input><?=$ds_pr_ulang[P]?></td><td><?=$jml_k18_lk_ds?> </td><td align="right"><?=$per_ds_1=round(($jml_k18_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru[P]?></td><td class=input><?=$dp_lk_ulang[P]?></td><td class=input><?=$dp_pr_baru[P]?></td><td class=input><?=$dp_pr_ulang[P]?></td><td><?=$jml_k18_lk_dp?></td><td align="right"><?=$per_dp_1=round(($jml_k18_lk_dp/$jum_tot)*100, 1)?> %</td>
</tr>
<tr><td>18 - 24 Tahun</td>
<td class=input><?=$ds_lk_baru1[P]?></td><td class=input><?=$ds_lk_ulang1[P]?></td><td class=input><?=$ds_pr_baru1[P]?></td><td class=input><?=$ds_pr_ulang1[P]?></td><td><?=$jml_1824_lk_ds?> </td><td align="right"><?=$per_ds_2=round(($jml_1824_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru1[P]?></td><td class=input><?=$dp_lk_ulang1[P]?></td><td class=input><?=$dp_pr_baru1[P]?></td><td class=input><?=$dp_pr_ulang1[P]?></td><td><?=$jml_1824_lk_dp?> </td><td align="right"><?=$per_dp_2=round(($jml_1824_lk_dp/$jum_tot)*100, 1)?> %</td>
</tr>
<tr><td>25 - 44 Tahun</td>
<td class=input><?=$ds_lk_baru2[P]?></td><td class=input><?=$ds_lk_ulang2[P]?></td><td class=input><?=$ds_pr_baru2[P]?></td><td class=input><?=$ds_pr_ulang2[P]?></td><td><?=$jml_2544_lk_ds?> </td><td align="right"><?=$per_ds_3=round(($jml_2544_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru2[P]?></td><td class=input><?=$dp_lk_ulang2[P]?></td><td class=input><?=$dp_pr_baru2[P]?></td><td class=input><?=$dp_pr_ulang2[P]?></td><td><?=$jml_2544_lk_dp?> </td><td align="right"><?=$per_dp_3=round(($jml_2544_lk_dp/$jum_tot)*100, 1)?> %</td>
</tr>
<tr><td>45 - 59 Tahun</td>
<td class=input><?=$ds_lk_baru3[P]?></td><td class=input><?=$ds_lk_ulang3[P]?></td><td class=input><?=$ds_pr_baru3[P]?></td><td class=input><?=$ds_pr_ulang3[P]?></td><td><?=$jml_4559_lk_ds?> </td><td align="right"><?=$per_ds_4=round(($jml_4559_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru3[P]?></td><td class=input><?=$dp_lk_ulang3[P]?></td><td class=input><?=$dp_pr_baru3[P]?></td><td class=input><?=$dp_pr_ulang3[P]?></td><td><?=$jml_4559_lk_dp?> </td><td align="right"><?=$per_dp_4=round(($jml_4559_lk_dp/$jum_tot)*100, 1)?> %</td>
</tr>
<tr><td> >= 60 Tahun</td>
<td class=input><?=$ds_lk_baru4[P]?></td><td class=input><?=$ds_lk_ulang4[P]?></td><td class=input><?=$ds_pr_baru4[P]?></td><td class=input><?=$ds_pr_ulang4[P]?></td><td><?=$jml_60_lk_ds?> </td><td align="right"><?=$per_ds_5=round(($jml_60_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru4[P]?></td><td class=input><?=$dp_lk_ulang4[P]?></td><td class=input><?=$dp_pr_baru4[P]?></td><td class=input><?=$dp_pr_ulang4[P]?></td><td><?=$jml_60_lk_dp?> </td><td align="right"><?=$per_dp_5=round(($jml_60_lk_dp/$jum_tot)*100, 1)?> %</td>
</td></tr>
<?
$per_ds= $per_ds_1 + $per_ds_2 + $per_ds_3 + $per_ds_4 + $per_ds_5 ;
$per_dp= $per_dp_1 + $per_dp_2 + $per_dp_3 + $per_dp_4 + $per_dp_5 ;
?>
<tr><td>JML</td>
<td><?=$jml_ds_lk_br?></td><td><?=$jml_ds_lk_ulang?></td><td><?=$jml_ds_pr_br?></td><td><?=$jml_ds_pr_ulang?></td><td><?=$jml_ds_lk_pr?></td><td align="right"><?=$per_ds?> %</td>
<td><?=$jml_dp_lk_br?></td><td><?=$jml_dp_lk_ulang?></td><td><?=$jml_dp_pr_br?></td><td><?=$jml_dp_pr_ulang?></td><td><?=$jml_dp_lk_pr?></td><td align="right"><?=$per_dp?> %</td>

</tr>
<tr><td>JML TOTAL</td>
<td  align="center" colspan="12"  ><b><?=$jum_tot?></td>
</tr>
</table>
</td>

</table>

<table>

<?
$udd=mysql_fetch_assoc(mysql_query("select nama from utd where down='1' and aktif='1'"));
$today2=date("Y:m:d H:i:s");
$kadaluwarsa=$today2;
$tglkel=date("d",strtotime($kadaluwarsa));
$blnkel=date("n",strtotime($kadaluwarsa));
$thnkel=date("Y",strtotime($kadaluwarsa));
$bulan=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$bln22=$bulan[$blnkel];
$jam = date("H:i:s",strtotime($kadaluwarsa));



?>
<tr><td></td><td colspan="4" align="center"><?=$udd[nama]?>, <?=$tglkel?>  <?=$bln22?>  <?=$thnkel?> , <?=$jam?></td></tr>
<tr><td></td><td align="center">Cheker</td><td></td><td></td><td align="center">Yang Merekap</td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td></td><td></td></tr>
<tr><td></td><td align="center">(...............................)</td><td></td><td></td><td align="center">(<? echo $namauser;?>)</td></tr>
</table>

<?
mysql_close();
?>
