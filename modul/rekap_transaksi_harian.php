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
<script type="text/javascript">
  jQuery(document).ready(function(){
       document.getElementById('terima').focus();
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});});
  </script>

<?
require_once("modul/background_process.php");
include ('config/db_connect.php');
require_once('config/db_connect.php');
session_start();
//alter table pengesahan
$table=mysql_query("SELECT `up` FROM `pengesahan`");
if (!$table) {mysql_query("ALTER TABLE `pengesahan` CHANGE `tgl` `tgl` DATETIME NULL DEFAULT NULL,ADD `up` INT( 1 ) NOT NULL DEFAULT '0',ADD `penerimaktg` VARCHAR( 30 ) NULL");}

$today=date("Y-m-d H:i:s");
$namauser=$_SESSION[namauser];

if (isset($_POST[terima])) {
$no_kantong = mysql_real_escape_string($_POST[terima]);
$ck=mysql_fetch_assoc(mysql_query("select Status,sah from stokkantong where noKantong='$no_kantong' and Status='1' and (sah='0' or sah is null or sah='')"));
	$cek1=mysql_fetch_assoc(mysql_query("select * from stokkantong where nokantong='$no_kantong'"));
	$cek2=mysql_fetch_assoc(mysql_query("select * from htransaksi where nokantong='$no_kantong'"));
	$pengesahan=mysql_query("insert into pengesahan (nokantong,tgl,ygmenyerahkan,jns,ket,shift) value ('$no_kantong','$today','$namauser','$cek1[jenis]','$cek2[Pengambilan]','$cek2[shift]')");
if ($ck[Status]=='1')  {
$updatektg=mysql_query("update stokkantong set sah='1' where noKantong='$no_kantong'");
                   //Eksekusi SMS
                    //---Minta Id pendonor untuk set data pendonor----
                    $pendonor=mysql_query("select kodependonor from stokkantong where nokantong='$no_kantong'");
                    $datapendonor=mysql_fetch_assoc($pendonor);
                    $idpendonor=$datapendonor[kodependonor];
                    //---End Minta Id pendonor untuk set data pendonor----
                    //kirim ucapan terimakasih
                    $dk=mysql_query("select nama,telp2 from pendonor where Kode='$idpendonor' and LENGTH(telp2)>9");
                    if (mysql_num_rows($dk)==1) {
                            $dk1=mysql_fetch_assoc($dk);
                            $ud=mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='3'"));
                            $telp=$dk1[telp2];
                            $pesan='Yth. '.$dk1[nama].', '.$ud[pesan];
                            $kirim=mysql_query("insert into sms.outbox (DestinationNumber,TextDecoded,CreatorID) 
                                            values ('$telp','$pesan','1')");
                     }
                    // end ucapan
        
echo  "Darah dengan NoKantong<b> $no_kantong </b>Telah Berhasil disahkan";
		backgroundPost('http://localhost/simudda/modul/background_up_karantina.php');
} else {
echo "NoKantong<b> $no_kantong </b> TIDAK DITEMUKAN Atau Telah disahkan sebelumnya, silahkan Check Kantong melalui menu CHECK STOK";
}
}
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[terima1])) {$today=$_POST[terima1];$today1=$today;}
if ($_POST[terima2]!='') $today1=$_POST[terima2];
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);

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
<!--<form name=sahdarah method=post>Pengesahan Penerimaan Darah:
<input type=text name=terima id=terima size=10 onChange="this.form.submit();">-->
</form></div>
<? } ?>
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
          <!--<td>Serah Terima</td>-->
          <td>Status</td>
          <!--td>Petugas Lab</td-->
          <td>Konfirmasi</td>
	  <td>Cara Ambil</td>
	  <td>Jenis</td>
	  <!--<td>NoForm</td>-->
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
	<td style="background-color: #ffff99; color: #000000"><?=$no++?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[NoTrans]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[Nama]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[Alamat]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[umur]?> th</td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[telp2]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$jamantri?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$petugas_tensi[nama_lengkap]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$petugas_hb[nama_lengkap]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[GolDarah]?>(<?=$trans[Rhesus]?>)</td>
	<td style="background-color: #ffff99; color: #000000"><?=$peng?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$jamaftap?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$petugas_aftap[nama_lengkap]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$dr[Nama]?></td>
	      <? echo "<td style='background-color: #ffff99; color: #000000'><a href=pmi".$_SESSION[leveluser].".php?module=updatekantong&noKantong=".$trans[NoKantong].">".$trans[NoKantong]."</a></td>"; ?>
	<!--<td style="background-color: #ffff99; color: #000000"><?=$sah1?></td>-->
	<td style="background-color: #ffff99; color: #000000"><?=$stk1?></td>
	<!--td style="background-color: #ffff99; color: #000000"><?=$petugas_imltd[nama_lengkap]?></td-->
	<td style="background-color: #ffff99; color: #000000"><?=$cocok1?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$cara?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$jenis?></td>
	<!--<td style="background-color: #ffff99; color: #000000"><?=$trans[NoForm]?></td>-->
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
$golx=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='x' and NoTrans like 'DG%'"));
$jkP=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='0' and NoTrans like 'DG%'"));
$jkW=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and jk='1' and NoTrans like 'DG%'"));


//baru
$rhposA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and rhesus='+' and NoTrans like 'DG%'"));
$rhposB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and rhesus='+' and NoTrans like 'DG%'"));
$rhposAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and rhesus='+' and NoTrans like 'DG%'"));
$rhposO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and rhesus='+' and NoTrans like 'DG%'"));
$rhposx=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='x' and rhesus='+' and NoTrans like 'DG%'"));


$rhnegA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='A' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='B' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='AB' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='O' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegx=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and gol_darah='x' and rhesus='-' and NoTrans like 'DG%'"));

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
$golx_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='x' and NoTrans like 'DG%'"));
$jkP_g=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and NoTrans like 'DG%'"));
$jkW_g=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and jk='0' and NoTrans like 'DG%'"));


$rhposA_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and rhesus='+' and NoTrans like 'DG%'"));
$rhposB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and rhesus='+' and NoTrans like 'DG%'"));
$rhposAB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and rhesus='+' and NoTrans like 'DG%'"));
$rhposO_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='O' and rhesus='+' and NoTrans like 'DG%'"));
$rhposx_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='x' and rhesus='+' and NoTrans like 'DG%'"));

$rhnegA_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='A' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='B' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegAB_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='AB' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegO_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='Os' and rhesus='-' and NoTrans like 'DG%'"));
$rhnegx_g=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and gol_darah='x' and rhesus='+' and NoTrans like 'DG%'"));
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

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Dalam Gedung BERHASIL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>JML </b></td>
<td><b>Rhesus </b></td>
</tr>
<tr><td><b> A </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golA[A]?></td><td>Pos: <?=$rhposA[A]?>   Neg: <?=$rhnegA[A]?></td></tr>
<tr><td><b> B </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golB[B]?></td><td>Pos: <?=$rhposB[B]?>   Neg: <?=$rhnegB[B]?></td></tr>
<tr><td><b> AB </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golAB[AB]?></td><td>Pos: <?=$rhposAB[AB]?>  Neg: <?=$rhnegAB[AB]?></td></tr>
<tr><td><b> O </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golO[O]?></td><td>Pos: <?=$rhposO[O]?>   Neg: <?=$rhnegO[O]?></td></tr>
<tr><td><b> X </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golx[x]?></td><td>Pos: <?=$rhposx[x]?>   Neg: <?=$rhnegx[x]?></tr>
<tr><td>Laki-Laki</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$jkP[P]?></td><td>Pos: <?=$rhposP[P]?>   Neg: <?=$rhnegP[P]?></td></tr>
<tr><td>Perempuan</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$jkW[W]?></td><td>Pos: <?=$rhposW[W]?>   Neg: <?=$rhnegW[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum[kod]?></td><td><b>Pos: <?=$rhpos[pos]?>  Neg: <?=$rhneg[neg]?></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Dalam Gedung GAGAL</b></th>
<tr class=field>
<td align=center><b>Gol Darah</b></td>
<td align=center><b>JML</b></td>
<td align=center><b>Rhesus</b></td>
</tr>
<tr><td><b> A </td>
<td style="background-color: #ffff99; color: #000000; color: #000000" ><?=$golA_g[A]?></td><td>Pos: <?=$rhposA_g[A]?>   Neg: <?=$rhnegA_g[A]?></tr>
<tr><td><b> B </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golB_g[B]?></td><td>Pos: <?=$rhposB_g[B]?>   Neg: <?=$rhnegB_g[B]?></tr>
<tr><td><b> AB </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golAB_g[AB]?></td><td>Pos: <?=$rhposAB_g[AB]?>   Neg: <?=$rhnegAB_g[AB]?></tr>
<tr><td><b> O </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golO_g[O]?></td><td>Pos: <?=$rhposO_g[O]?>   Neg: <?=$rhnegO_g[O]?></tr>
<tr><td><b> X </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golx_g[x]?></td><td>Pos: <?=$rhposx_g[x]?>   Neg: <?=$rhnegx_g[x]?></tr>
<tr><td>Laki-Laki</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$jkP_g[P]?></td><td>Pos: <?=$rhposP_g[P]?>   Neg: <?=$rhnegP_g[P]?></tr>
<tr><td>Perempuan</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$jkW_g[W]?></td><td>Pos: <?=$rhposW_g[W]?>  Neg: <?=$rhnegW_g[W]?></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum_g[kod]?></b></td><td><b>Pos: <?=$rhpos_g[pos]?>  Neg: <?=$rhneg_g[neg]?></b></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Dalam Gedung BATAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golA_b[A]?></td></tr>
<tr><td> B </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golB_b[B]?></td></tr>
<tr><td> AB </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golAB_b[AB]?></td></tr>
<tr><td> O </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$golO_b[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$jkP_b[P]?></td></tr>
<tr><td>Perempuan</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$jkW_b[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$jum_b[kod]?></td></tr>
</table>
</td>


<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Dalam Gedung CARA AMBIL</b></th>
<tr class="field">
<td><b>Cara Ambil</b></td>
<td><b>Jumlah </b></td>
</tr>
<tr><td> Biasa </td>
<td style="background-color: #ffff99; color: #000000"><?=$biasa[kod]?></td></tr>
<th colspan='2' >AFERESIS</th>
<tr><td> Tromboferesis </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$tromboferesis[kod]?></td></tr>
<tr><td> Leukaferesis </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$leukoferesis[kod]?></td></tr>
<tr><td> Plasmaferesis </td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$plasmaferesis[kod]?></td></tr>
<tr><td>Eritoferesis</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$eritoferesis[kod]?></td></tr>
<tr><td>JML TTL</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$eritoferesis[kod]+$plasmaferesis[kod]+$leukoferesis[kod]+$tromboferesis[kod]+$biasa[kod]?></td></tr>
</table>
</td>


<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap JENIS KANTONG yang terpakai DG</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Kantong</b></td>
<th class ="field" colspan='2'><b>Jumlah </b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal Aftap</b></th>

<tr><td>Single</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$single[S]?></td><td style="background-color: #ffff99; color: #000000"><?=$single_g[S]?></td></tr>
<tr><td>Double</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$double[D]?></td><td style="background-color: #ffff99; color: #000000"><?=$double_g[D]?></td></tr>
<tr><td>Triple</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$triple[T]?></td><td style="background-color: #ffff99; color: #000000"><?=$triple_g[T]?></td></tr>
<tr><td>Quadruple</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$quadruple[Q]?><td style="background-color: #ffff99; color: #000000"><?=$quadruple_g[Q]?></td></td></tr>
<tr><td>Pediatrik</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$pediatrik[P]?><td style="background-color: #ffff99; color: #000000"><?=$pediatrik_g[P]?></td></td></tr>
<tr><td>JML TTL</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$single[S]+$double[D]+$triple[T]+$quadruple[Q]+$pediatrik[P]?></td><td style="background-color: #ffff99; color: #000000"><?=$single_g[S]+$double_g[D]+$triple_g[T]+$quadruple_g[Q]+$pediatrik_g[P]?></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=4><b>Rekap JENIS PENDONOR DG</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Pendonor</b></td>
<th class ="field" colspan='3'><b>Jumlah Aftap</b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal</b></th><th><b>Batal</b></th>

<tr><td>Baru</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$db[B]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$db_g[B]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$db_b[B]?></td></tr>
<tr><td>Ulang</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$du[U]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$du_g[U]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$du_b[U]?></td></tr>
<tr><td>DS</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$ds[P]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$dsg[P]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$dsb[P]?></td></tr>
<tr><td>DP</td>
<td style="background-color: #ffff99; color: #000000; color: #000000"><?=$dp[W]?><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$dpg[W]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$dpb[W]?></td>
<tr><td>JML TTL</td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$db[B]+$du[U]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$db_g[B]+$du_g[U]?></td><td style="background-color: #ffff99; color: #000000; color: #000000"><?=$db_b[B]+$du_b[U]?></td></tr>
</table>
</td>


</tr>
</table>

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

	<td style="background-color: #ffff99; color: #000000"><?=$no1++?></td>
      <td style="background-color: #ffff99; color: #000000"><?=$trans[NoTrans]?></td>
      <td style="background-color: #ffff99; color: #000000"><?=$trans[Nama]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[Alamat]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[umur]?> th</td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[telp2]?></td>
      <td style="background-color: #ffff99; color: #000000"><?=$jamantri1?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$petugas_tensi[nama_lengkap]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$petugas_hb[nama_lengkap]?></td>
      <td style="background-color: #ffff99; color: #000000"><?=$trans[GolDarah]?>(<?=$trans[Rhesus]?>)</td>
      <td style="background-color: #ffff99; color: #000000"><?=$peng?></td>
      <td style="background-color: #ffff99; color: #000000"><?=$jamaftap1?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$petugas_aftap[nama_lengkap]?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$dr[Nama]?></td>
        <? echo "<td style='background-color: #ffff99; color: #000000'><a href=pmi".$_SESSION[leveluser].".php?module=updatekantong&noKantong=".$trans[NoKantong].">".$trans[NoKantong]."</a></td>"; ?>
      <td style="background-color: #ffff99; color: #000000"><?=$sah3?></td>
      <td style="background-color: #ffff99; color: #000000"><?=$stk3?></td>
	<!--td style="background-color: #ffff99; color: #000000"><?=$petugas_imltd[nama_lengkap]?></td-->
      <td style="background-color: #ffff99; color: #000000"><?=$cocok3?></td>
	<td style="background-color: #ffff99; color: #000000"><?=$trans[Instansi]?></td>

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

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Mobile Unit BERHASIL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>JML</b></td>
<td><b>Rhesus</b></td>
</tr>
<tr><td> <b> A </td>
<td style="background-color: #ffff99; color: #000000"><?=$golA_m[A]?></td><td>Pos: <?=$rhposA_m[A]?>   Neg: <?=$rhnegA_m[A]?></td></tr>
<tr><td> <b>B </td>
<td style="background-color: #ffff99; color: #000000"><?=$golB_m[B]?></td><td>Pos: <?=$rhposB_m[B]?>   Neg: <?=$rhnegB_m[B]?></td></tr>
<tr><td> <b>AB </td>
<td style="background-color: #ffff99; color: #000000"><?=$golAB_m[AB]?></td><td>Pos: <?=$rhposAB_m[AB]?>   Neg: <?=$rhnegAB_m[AB]?></td></tr>
<tr><td> <b>O </td>
<td style="background-color: #ffff99; color: #000000"><?=$golO_m[O]?></td><td>Pos: <?=$rhposO_m[O]?>   Neg: <?=$rhnegO_m[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td style="background-color: #ffff99; color: #000000"><?=$jkP_m[P]?></td><td>Pos: <?=$rhposP_m[P]?>   Neg: <?=$rhnegP_m[P]?></td></tr>
<tr><td>Perempuan</td>
<td style="background-color: #ffff99; color: #000000"><?=$jkW_m[W]?></td><td>Pos: <?=$rhposW_m[W]?>   Neg: <?=$rhnegW_m[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum_m[kod]?></b></td><td><b>Pos: <?=$rhpos_m[pos]?>   Neg: <?=$rhneg_m[neg]?></b></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap AFTAP Mobile Unit GAGAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>JML</b></td>
<td><b>Rhesus</b></td>
</tr>
<tr><td> <b> A </td>
<td style="background-color: #ffff99; color: #000000"><?=$golA_mg[A]?></td><td>Pos: <?=$rhposA_mg[A]?>   Neg: <?=$rhnegA_mg[A]?></td></tr>
<tr><td> <b>B </td>
<td style="background-color: #ffff99; color: #000000"><?=$golB_mg[B]?></td><td>Pos: <?=$rhposB_mg[B]?>   Neg: <?=$rhnegB_mg[B]?></td></tr>
<tr><td> <b>AB </td>
<td style="background-color: #ffff99; color: #000000"><?=$golAB_mg[AB]?></td><td>Pos: <?=$rhposAB_mg[AB]?>   Neg: <?=$rhnegAB_mg[AB]?></td></tr>
<tr><td> <b>O </td>
<td style="background-color: #ffff99; color: #000000"><?=$golO_mg[O]?></td><td>Pos: <?=$rhposO_mg[O]?>   Neg: <?=$rhnegO_mg[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td style="background-color: #ffff99; color: #000000"><?=$jkP_mg[P]?></td><td>Pos: <?=$rhposP_mg[P]?>   Neg: <?=$rhnegP_g[P]?></td></tr>
<tr><td>Perempuan</td>
<td style="background-color: #ffff99; color: #000000"><?=$jkW_mg[W]?></td><td>Pos: <?=$rhposW_mg[W]?>   Neg: <?=$rhnegW_mg[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td><b><?=$jum_mg[kod]?></td><td>Pos: <?=$rhpos_mg[pos]?>   Neg: <?=$rhneg_mg[neg]?></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Mobile Unit BATAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td style="background-color: #ffff99; color: #000000"><?=$golA_mb[A]?></td></tr>
<tr><td> B </td>
<td style="background-color: #ffff99; color: #000000"><?=$golB_mb[B]?></td></tr>
<tr><td> AB </td>
<td style="background-color: #ffff99; color: #000000"><?=$golAB_mb[AB]?></td></tr>
<tr><td> O </td>
<td style="background-color: #ffff99; color: #000000"><?=$golO_mb[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td style="background-color: #ffff99; color: #000000"><?=$jkP_mb[P]?></td></tr>
<tr><td>Perempuan</td>
<td style="background-color: #ffff99; color: #000000"><?=$jkW_mb[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td style="background-color: #ffff99; color: #000000"><?=$jum_mb[kod]?></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=4><b>Rekap Transaksi BUS MU</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Berhasil </b></td>
<td><b>Gagal </b></td>
<td><b>Batal </b></td>
</tr>
<tr><td> A </td>
<td style="background-color: #ffff99; color: #000000"><?=$mgolA_m[A]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolA_mg[A]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolA_mb[A]?></td></tr>
<tr><td> B </td>
<td style="background-color: #ffff99; color: #000000"><?=$mgolB_m[B]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolB_mg[B]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolB_mb[B]?></td></tr>
<tr><td> AB </td>
<td style="background-color: #ffff99; color: #000000"><?=$mgolAB_m[AB]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolAB_mg[AB]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolAB_mb[AB]?></td></tr>
<tr><td> O </td>
<td style="background-color: #ffff99; color: #000000"><?=$mgolO_m[O]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolO_mg[O]?></td><td style="background-color: #ffff99; color: #000000"><?=$mgolO_mb[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td style="background-color: #ffff99; color: #000000"><?=$mjkP_m[P]?></td><td style="background-color: #ffff99; color: #000000"><?=$mjkP_mg[P]?></td><td style="background-color: #ffff99; color: #000000"><?=$mjkP_mb[P]?></td></tr>
<tr><td>Perempuan</td>
<td style="background-color: #ffff99; color: #000000"><?=$mjkW_m[W]?></td><td style="background-color: #ffff99; color: #000000"><?=$mjkW_mg[W]?></td><td style="background-color: #ffff99; color: #000000"><?=$mjkW_mb[W]?></td></tr>
<tr><td><b>JML TTL</b></td>
<td style="background-color: #ffff99; color: #000000"><?=$mjum_m[kod]?></td><td style="background-color: #ffff99; color: #000000"><?=$mjum_mg[kod]?></td><td style="background-color: #ffff99; color: #000000"><?=$mjum_mb[kod]?></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=3><b>Rekap JENIS KANTONG yang terpakai MU</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Kantong</b></td>
<th class ="field" colspan='2'><b>Jumlah </b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal Aftap</b></th>

<tr><td>Single</td>
<td style="background-color: #ffff99; color: #000000"><?=$single_m[S]?></td><td style="background-color: #ffff99; color: #000000"><?=$single_mg[S]?></td></tr>
<tr><td>Double</td>
<td style="background-color: #ffff99; color: #000000"><?=$double_m[D]?></td><td style="background-color: #ffff99; color: #000000"><?=$double_mg[D]?></td></tr>
<tr><td>Triple</td>
<td style="background-color: #ffff99; color: #000000"><?=$triple_m[T]?></td><td style="background-color: #ffff99; color: #000000"><?=$triple_mg[T]?></td></tr>
<tr><td>Quadruple</td>
<td style="background-color: #ffff99; color: #000000"><?=$quadruple_m[Q]?><td style="background-color: #ffff99; color: #000000"><?=$quadruple_mg[Q]?></td></td></tr>
<tr><td>Pediatrik</td>
<td style="background-color: #ffff99; color: #000000"><?=$pediatrik_m[P]?><td style="background-color: #ffff99; color: #000000"><?=$pediatrik_mg[P]?></td></td></tr>
<tr><td>JML TTL</td>
<td style="background-color: #ffff99; color: #000000"><?=$single_m[S]+$double_m[D]+$triple_m[T]+$quadruple_m[Q]+$pediatrik_m[P]?></td><td style="background-color: #ffff99; color: #000000"><?=$single_mg[S]+$double_mg[D]+$triple_mg[T]+$quadruple_mg[Q]+$pediatrik_mg[P]?></td></tr>
</table>
</td>

<td style="vertical-align: top">
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=4><b>Rekap JENIS PENDONOR MU</b></th>
<tr class="field">
<td rowspan='2'><b>Jenis Pendonor</b></td>
<th class ="field" colspan='3'><b>Jumlah Aftap</b></th>
</tr>
<th><b>Berhasil</b></th><th><b>Gagal</b></th><th><b>Batal</b></th>

<tr><td>Baru</td>
<td style="background-color: #ffff99; color: #000000"><?=$db_m[B]?></td><td style="background-color: #ffff99; color: #000000"><?=$db_mg[B]?></td><td style="background-color: #ffff99; color: #000000"><?=$db_mb[B]?></td></tr>
<tr><td>Ulang</td>
<td style="background-color: #ffff99; color: #000000"><?=$du_m[U]?></td><td style="background-color: #ffff99; color: #000000"><?=$du_mg[U]?></td><td style="background-color: #ffff99; color: #000000"><?=$du_mb[U]?></td></tr>
<tr><td>JML TTL</td><td style="background-color: #ffff99; color: #000000"><?=$db_m[B]+$du_m[U]?></td><td style="background-color: #ffff99; color: #000000"><?=$db_mg[B]+$du_mg[U]?></td><td style="background-color: #ffff99; color: #000000"><?=$db_mb[B]+$du_mb[U]?></td></tr>
</table>
</td>


</tr>
</table>
</br>


<form name=xls method=post action=modul/rekap_transaksi_harian_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=submit name=submit value='Print Rekap Transaksi Harian (.XLS)'>
</form>
