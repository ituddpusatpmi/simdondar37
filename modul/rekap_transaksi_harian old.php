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

if (isset($_POST[terima])) {
$no_kantong = mysql_real_escape_string($_POST[terima]);
$ck=mysql_fetch_assoc(mysql_query("select Status,sah from stokkantong where noKantong='$no_kantong' and Status='1' and (sah='0' or sah is null or sah='')"));
if ($ck[Status]=='1')  {
$updatektg=mysql_query("update stokkantong set sah='1' where noKantong='$no_kantong'");
                   //Eksekusi SMS
                    //---Minta Id pendonor untuk set data pendonor----
                    $pendonor=mysql_query("select kodependonor from stokkantong where nokantong='$no_kantong'");
                    $datapendonor=mysql_fetch_assoc($pendonor);
                    $idpendonor=$datapendonor[kodependonor];
                    //---End Minta Id pendonor untuk set data pendonor----
                    //kirim ucapan terimakasih
                    $dk=mysql_query("select nama,telp,telp2 from pendonor where Kode='$idpendonor' and LENGTH(telp2)>10");
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
<form name=sahdarah method=post>Pengesahan Penerimaan Darah:
<input type=text name=terima id=terima size=10 onChange="this.form.submit();">
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
$trans0_sql="select ht.NoTrans,ht.KodePendonor,ht.JenisDonor,ht.Reaksi,ht.catatan,ht.Pengambilan,
		ht.jumHB,ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Nama,pd.telp2,ht.petugas,ht.petugasHB,ht.petugasTensi,ht.NamaDokter,ht.Instansi  
		from htransaksi as ht,pendonor as pd 
		where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and 
		ht.KodePendonor=pd.Kode and ht.NoTrans like 'DG%' order by NoTrans";
//echo $trans0_sql;
?>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

          <td>No Transaksi</td>
          <td>Nama Pendonor</td>
	  <td>Alamat</td>
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
          <td>IMLTD</td>
          <td>Petugas Lab</td>
          <td>Konfirmasi Gol Darah</td>
        </tr>
<?
$trans0=mysql_query($trans0_sql);
while ($trans=mysql_fetch_assoc($trans0)) {
$stk='';
$jamaftap='-';
$cocok1='-';
$jamantri=substr($trans[Tgl],11);
if ($trans[NoKantong]!='') {
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
if ($stk[Status]=='3') $stk1='Keluar/Titip';
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

?>
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

      <td class=input><?=$trans[NoTrans]?></td>
      <td class=input><?=$trans[Nama]?></td>
	<td class=input><?=$trans[Alamat]?></td>
	<td class=input><?=$trans[telp2]?></td>
      <td class=input><?=$jamantri?></td>
	<td class=input><?=$petugas_tensi[nama_lengkap]?></td>
	<td class=input><?=$petugas_hb[nama_lengkap]?></td>
      <td class=input><?=$trans[GolDarah]?></td>
      <td class=input><?=$peng?></td>
      <td class=input><?=$jamaftap?></td>
	<td class=input><?=$petugas_aftap[nama_lengkap]?></td>
	<td class=input><?=$dr[Nama]?></td>
      <td class=input><a href=modul/update_sah_kantong.php?noKantong=<?=$trans[NoKantong]?>><?=$trans[NoKantong]?></a></td>
      <td class=input><?=$sah1?></td>
      <td class=input><?=$stk1?></td>
	<td class=input><?=$petugas_imltd[nama_lengkap]?></td>
      <td class=input><?=$cocok1?></td>

	</tr>
<?
}
?>
</table>
<?
$jum=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='0' and NoTrans like 'DG%'"));
/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
$golA=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golB=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golAB=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golO=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='0' and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkP=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and (ht.tempat='0' or ht.tempat='3') and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and (ht.tempat='0' or ht.tempat='3') and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$jum_g=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and NoTrans like 'DG%'"));
/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
$golA_g=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golB_g=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golAB_g=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golO_g=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkP_g=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and (ht.tempat='0' or ht.tempat='3') and ht.Pengambilan='2' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW_g=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and (ht.tempat='0' or ht.tempat='3') and ht.Pengambilan='2' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

$jum_b=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'DG%'"));
/*$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));*/
$golA_b=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golB_b=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golAB_b=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$golO_b=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkP_b=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and (ht.tempat='0' or ht.tempat='3') and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));
$jkW_b=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and (ht.tempat='0' or ht.tempat='3') and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'DG%'"));

?>
<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Dalam Gedung BERHASIL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td class=input><?=$golA[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$golB[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$golAB[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$golO[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW[W]?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum[kod]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Dalam Gedung GAGAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td class=input><?=$golA_g[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$golB_g[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$golAB_g[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$golO_g[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_g[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_g[W]?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum_g[kod]?></td></tr>
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
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum_b[kod]?></td></tr>
</table>
</td>


</tr>
</table>
</br>


<b><font size=3>Mobile Unit</b><br></font>
<table border=1 cellpadding=0 cellspacing=0>
<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

          <td>No Transaksi</td>
          <td>Nama Pendonor</td>
	  <td>Alamat</td>
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
          <td>IMLTD</td>
          <td>Petugas Lab</td>
          <td>Konfirmasi Gol Darah</td>
	<td>Instansi</td>        
	</tr>
<?
$trans0=mysql_query("select ht.NoTrans,ht.KodePendonor,ht.JenisDonor,ht.Reaksi,ht.catatan,ht.Pengambilan,
		ht.jumHB,ht.NoKantong,ht.Tgl,pd.Nama,pd.Alamat,pd.GolDarah,pd.Nama,pd.telp2,ht.petugas,ht.petugasHB,ht.petugasTensi,ht.NamaDokter,ht.Instansi  
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
<tr style="font-size:12px; color:#000000; font-family:Verdana;" onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

      <td class=input><?=$trans[NoTrans]?></td>
      <td class=input><?=$trans[Nama]?></td>
	<td class=input><?=$trans[Alamat]?></td>
	<td class=input><?=$trans[telp2]?></td>
      <td class=input><?=$jamantri?></td>
	<td class=input><?=$petugas_tensi[nama_lengkap]?></td>
	<td class=input><?=$petugas_hb[nama_lengkap]?></td>
      <td class=input><?=$trans[GolDarah]?></td>
      <td class=input><?=$peng?></td>
      <td class=input><?=$jamaftap?></td>
	<td class=input><?=$petugas_aftap[nama_lengkap]?></td>
	<td class=input><?=$dr[Nama]?></td>
      <td class=input><a href=modul/update_sah_kantong.php?noKantong=<?=$trans[NoKantong]?>><?=$trans[NoKantong]?></a></td>
      <td class=input><?=$sah1?></td>
      <td class=input><?=$stk1?></td>
	<td class=input><?=$petugas_imltd[nama_lengkap]?></td>
      <td class=input><?=$cocok1?></td>
	<td class=input><?=$trans[Instansi]?></td>

	</tr>
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
$jkP_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_m=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='0' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$jum_mg=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan='2' and NoTrans like 'M%'"));
//$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
//$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));
$golA_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golAB_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golO_mg=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and ht.Pengambilan='2' and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='2' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_mg=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='2' and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

$jum_mb=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and (Pengambilan='1' or Pengambilan='-') and NoTrans like 'M%'"));
//$jumbat=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='1'"));
//$jumgal=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)='$today' and (tempat='0' or tempat='3') and Pengambilan='2'"));
$golA_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as A from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='A' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golB_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as B from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='B' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golAB_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as AB from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='AB' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$golO_mb=mysql_fetch_assoc(mysql_query("select count(pd.GolDarah) as O from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)>='$today' and CAST(ht.Tgl as date)<='$today1' and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.GolDarah='O' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkP_mb=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as P from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M' and ht.Pengambilan='1' and pd.Jk='0' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));
$jkW_mb=mysql_fetch_assoc(mysql_query("select count(pd.Jk) as W from pendonor as pd,htransaksi as ht where CAST(ht.Tgl as date)='$today' and ht.tempat='M'  and (ht.Pengambilan='1' or ht.Pengambilan='-') and pd.Jk='1' and pd.Kode=ht.KodePendonor and ht.NoTrans like 'M%'"));

?>
<br>
<table><tr>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Mobile Unit BERHASIL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td class=input><?=$golA_m[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$golB_m[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$golAB_m[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$golO_m[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_m[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_m[W]?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum_m[kod]?></td></tr>
</table>
</td>

<td>
<table class=form border=1 cellpadding=0 cellspacing=0>
<th colspan=2><b>Rekap AFTAP Mobile Unit GAGAL</b></th>
<tr class="field">
<td><b>Gol Darah </b></td>
<td><b>Jum Pendonor </b></td>
</tr>
<tr><td> A </td>
<td class=input><?=$golA_mg[A]?></td></tr>
<tr><td> B </td>
<td class=input><?=$golB_mg[B]?></td></tr>
<tr><td> AB </td>
<td class=input><?=$golAB_mg[AB]?></td></tr>
<tr><td> O </td>
<td class=input><?=$golO_mg[O]?></td></tr>
<tr><td>Laki-Laki</td>
<td class=input><?=$jkP_mg[P]?></td></tr>
<tr><td>Perempuan</td>
<td class=input><?=$jkW_mg[W]?></td></tr>
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum_mg[kod]?></td></tr>
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
<tr><td><b>Jumlah Total</b></td>
<td class=input><?=$jum_mb[kod]?></td></tr>
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
