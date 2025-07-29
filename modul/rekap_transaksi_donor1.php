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
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript">
  jQuery(document).ready(function(){
       document.getElementById('terima').focus();
  $('#instansi').autocomplete({source:'modul/suggest_zipnama.php', minLength:2});
	});
  </script>

<?php
require_once("modul/background_process.php");
include('config/db_connect.php');

$namauser=$_SESSION[namauser];
$today=date('Y-m-d');
$today1=$today;
$src_nomorf="";
$src_ambil="";
$src_status="";
$src_shift="";
$src_ktg="";
$src_drh="";
$src_jk="";
$hasil="";
$src_rh="";
$src_ds="";
$src_baru="";

if (isset($_POST[minta1])) {$today=$_POST[minta1];$today1=$today;}
if ($_POST[minta2]!='') 	$today1=$_POST[minta2];
if ($_POST[hasil]!='')      	$hasil=$_POST[hasil];
if ($_POST[nomorf]!='')      	$src_nomorf=$_POST[nomorf];
if ($_POST[gol_status]!='')  	$src_status=$_POST[gol_status];
if ($_POST[gol_ambil]!='')   	$src_ambil=$_POST[gol_ambil];
if ($_POST[gol_shift]!='')   	$src_shift=$_POST[gol_shift];
if ($_POST[gol_ktg]!='')     	$src_ktg=$_POST[gol_ktg];
if ($_POST[gol_drh]!='')     	$src_drh=$_POST[gol_drh];
if ($_POST[gol_jk]!='')      	$src_jk=$_POST[gol_jk];
if ($_POST[gol_rh]!='')        	$src_rh=$_POST[gol_rh];
if ($_POST[ds]!='')            	$src_ds=$_POST[ds];
if ($_POST[baru]!='')          	$src_baru=$_POST[baru];



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
                    $dk=mysql_query("select nama,Jk,Status,telp2 from pendonor where Kode='$idpendonor' and LENGTH(telp2)>9");
                    if (mysql_num_rows($dk)==1) {
                            $dk1=mysql_fetch_assoc($dk);
				if ($dk1[Jk]=='0' and $dk1[Status]=='0') $sapa='Bpk';
				if ($dk1[Jk]=='0' and $dk1[Status]=='1') $sapa='Sdr';
				if ($dk1[Jk]=='1' and $dk1[Status]=='0') $sapa='Ibu';
				if ($dk1[Jk]=='1' and $dk1[Status]=='1') $sapa='Sdri';
                            $ud=mysql_fetch_assoc(mysql_query("select pesan from sms_setting where id='3'"));
                            $telp=$dk1[telp2];
                            $pesan='Yth. '.$sapa.'. '.$dk1[nama].', '.$ud[pesan];
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
/*
$today=date('Y-m-d');
$today1=$today;
if (isset($_POST[terima1])) {$today=$_POST[terima1];$today1=$today;}
if ($_POST[terima2]!='') $today1=$_POST[terima2];*/
$perbln=substr($today,5,2);
$pertgl=substr($today,8,2);
$perthn=substr($today,0,4);
$perbln1=substr($today1,5,2);
$pertgl1=substr($today1,8,2);
$perthn1=substr($today1,0,4);

//$nama=mysql_fetch_assoc(mysql_query("select Instansi from htransaksi where CAST(Tgl as date)='$_POST[waktu]' and Instansi='$_POST[instansi]'"));
?>


<!--div>
<form name=sahdarah1 method=post> Mulai:
<input type=text name=terima1 id="datepicker" size=10>
Sampai:
<input type=text name=terima2 id="datepicker1" size=10>
<input type=submit name=submit value=Submit>
</form></div-->
<? 
if (($_SESSION[leveluser]=='laboratorium') or ($_SESSION[leveluser]=='kasir') or ($_SESSION[leveluser]=='aftap') or ($_SESSION[leveluser]=='komponen')){ ?>
<div>
<form name=sahdarah method=post><h3>Pengesahan Penerimaan Darah, Masukkan No Kantong -->
<input type=text name=terima id=terima size=15 placeholder="Jika Diketik, ENTER" onChange="this.form.submit();"> </h3>
</form></div>
<? } ?>


<h1>REKAP TRANSAKSI DONOR</h1>

<form method=post> 
TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>><br>
INSTANSI <input type=text name=nomorf id=instansi size=20 value=<?=$src_nomorf?>>
	<!--NO.RM <input type=text name=rm id=rm size=10 value=<?=$srcrm?>s-->
STATUS<select name="gol_status">
	<option value="">-SEMUA-</option>
	<option value="0">BERHASIL</option>
	<option value="1">BATAL</option>
	<option value="2">GAGAL</option>
	</select>

TEMPAT<select name="hasil">
	<option value="">-SEMUA-</option>
	<option value="0">DALAM GEDUNG</option>
	<option value="M">MOBIL UNIT</option>
	</select>



CARA AMBIL<select name="gol_ambil">
						<option value="">-SEMUA-</option>
						<option value="0">BIASA</option>
						<option value="1">TROMBOFERESIS</option>
						<option value="2">LEUKAFERESIS</option>
						<option value="3">PLASMAFERESIS</option>
						<option value="4">ERITOFERESIS</option>
					</select>

SHIFT<select name="gol_shift">
						<option value="">-SEMUA-</option>
						<option value="1">SHIFT I</option>
						<option value="2">SHIFT II</option>
						<option value="3">SHIFT III</option>
						<option value="4">SHIFT IV</option>
					</select>
KANTONG<select name="gol_ktg" id="jenis" onchange="viewjenis()">

						<option value="">-SEMUA-</option>
						<option value="1">SINGLE</option>
						<option value="2">DOUBLE</option>
						<option value="3">TRIPLE</option>
						<option value="4">QUADRUPLE</option>
						<option value="6">PEDIATRIK</option>
					</select>
					<!--list quadriple 050518-->
					&nbsp;&nbsp;
						    <span id="bt" style="display: none">
							JENIS :
						    <select name="metoda" id="metoda">
							<option value="" selected>Semua</option>
<!--							<option value="0" selected>Biasa</option>-->
							<option value="TTB">TOP & TOP (Biasa)</option>
							<option value="TTF">TOP & TOP (Filter)</option>
							<option value="TBB">TOP & BOTTOM (Biasa)</option>
							<option value="TBF">TOP & BOTTOM (Filter)</option>
<!--							<option value="FT">FILTER</option>-->
						    </select>
						    </span>
<input type="submit" name="submit" value="Lihat" class="swn_button_blue"><br>


GOL DARAH<select name="gol_drh">
						<option value="">-SEMUA-</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="O">O</option>
						<option value="AB">AB</option>
					</select>
Rh<select name="gol_rh">
						<option value="">-SEMUA-</option>
						<option value="+">POS</option>
						<option value="-">NEG</option>
					
					</select>

JK<select name="gol_jk">
						<option value="">-SEMUA-</option>
						<option value="0">PRIA</option>
						<option value="1">WANITA</option>
					
					</select>
DS/DP<select name="ds">
						<option value="">-SEMUA-</option>
						<option value="0">DS</option>
						<option value="1">DP</option>
					
					</select>
BARU/ULANG<select name="baru">
						<option value="">-SEMUA-</option>
						<option value="0">Baru</option>
						<option value="1">Ulang</option>
					
					</select>

</form>



</table>

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

//Jenis Kantong DG

$single=mysql_fetch_assoc(mysql_query("select count(kodependonor) as S from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='1' "));
$double=mysql_fetch_assoc(mysql_query("select count(kodependonor) as D from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='2' "));
$triple=mysql_fetch_assoc(mysql_query("select count(kodependonor) as T from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='3' "));
$quadruple=mysql_fetch_assoc(mysql_query("select count(kodependonor) as Q from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='4' "));
$pediatrik=mysql_fetch_assoc(mysql_query("select count(kodependonor) as P from htransaksi  where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jeniskantong='6' "));

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

$ds_lk_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='0' and umur >= 60 and donorbaru='0'"));

$ds_lk_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='0' and umur >= 60 and donorbaru='1'"));

$ds_pr_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and jk='1' and umur >= 60 and donorbaru='0'"));

$ds_pr_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='0' and  jk='1' and umur >= 60 and donorbaru='1'"));

//60 DP
$dp_lk_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='0' and umur >= 60 and donorbaru='0'"));

$dp_lk_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='0' and umur >= 60 and donorbaru='1'"));

$dp_pr_baru4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and jk='1' and umur >= 60 and donorbaru='0'"));

$dp_pr_ulang4=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and jenisdonor='1' and  jk='1' and umur >= 60 and donorbaru='1'")); 


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


<table>
<td>

<th><b>Rekap Umur berdasarkan pengambilan kantong </b></th>
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
<td> < 18 Tahun</td><td class=input><?=$ds_lk_baru[P]?></td><td class=input><?=$ds_lk_ulang[P]?></td><td class=input><?=$ds_pr_baru[P]?></td><td class=input><?=$ds_pr_ulang[P]?></td><td><?=$jml_k18_lk_ds?> </td><td><?=$per_ds_1=round(($jml_k18_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru[P]?></td><td class=input><?=$dp_lk_ulang[P]?></td><td class=input><?=$dp_pr_baru[P]?></td><td class=input><?=$dp_pr_ulang[P]?></td><td><?=$jml_k18_lk_dp?></td><td><?=$per_dp_1=round(($jml_k18_lk_dp/$jum_tot)*100, 1)?> %</td>
<tr>
<tr><td>18 - 24 Tahun</td>
<td class=input><?=$ds_lk_baru1[P]?></td><td class=input><?=$ds_lk_ulang1[P]?></td><td class=input><?=$ds_pr_baru1[P]?></td><td class=input><?=$ds_pr_ulang1[P]?></td><td><?=$jml_1824_lk_ds?> </td><td><?=$per_ds_2=round(($jml_1824_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru1[P]?></td><td class=input><?=$dp_lk_ulang1[P]?></td><td class=input><?=$dp_pr_baru1[P]?></td><td class=input><?=$dp_pr_ulang1[P]?></td><td><?=$jml_1824_lk_dp?> </td><td><?=$per_dp_2=round(($jml_1824_lk_dp/$jum_tot)*100, 1)?> %</td>
</tr>
<tr><td>25 - 44 Tahun</td>
<td class=input><?=$ds_lk_baru2[P]?></td><td class=input><?=$ds_lk_ulang2[P]?></td><td class=input><?=$ds_pr_baru2[P]?></td><td class=input><?=$ds_pr_ulang2[P]?></td><td><?=$jml_2544_lk_ds?> </td><td><?=$per_ds_3=round(($jml_2544_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru2[P]?></td><td class=input><?=$dp_lk_ulang2[P]?></td><td class=input><?=$dp_pr_baru2[P]?></td><td class=input><?=$dp_pr_ulang2[P]?></td><td><?=$jml_2544_lk_dp?> </td><td><?=$per_dp_3=round(($jml_2544_lk_dp/$jum_tot)*100, 1)?> %</td>
</tr>
<tr><td>45 - 59 Tahun</td>
<td class=input><?=$ds_lk_baru3[P]?></td><td class=input><?=$ds_lk_ulang3[P]?></td><td class=input><?=$ds_pr_baru3[P]?></td><td class=input><?=$ds_pr_ulang3[P]?></td><td><?=$jml_4559_lk_ds?> </td><td><?=$per_ds_4=round(($jml_4559_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru3[P]?></td><td class=input><?=$dp_lk_ulang3[P]?></td><td class=input><?=$dp_pr_baru3[P]?></td><td class=input><?=$dp_pr_ulang3[P]?></td><td><?=$jml_4559_lk_dp?> </td><td><?=$per_dp_4=round(($jml_4559_lk_dp/$jum_tot)*100, 1)?> %</td>
</tr>
<tr><td> >= 60 Tahun</td>
<td class=input><?=$ds_lk_baru4[P]?></td><td class=input><?=$ds_lk_ulang4[P]?></td><td class=input><?=$ds_pr_baru4[P]?></td><td class=input><?=$ds_pr_ulang4[P]?></td><td><?=$jml_60_lk_ds?> </td><td><?=$per_ds_5=round(($jml_60_lk_ds/$jum_tot)*100, 1)?> %</td>
<td class=input><?=$dp_lk_baru4[P]?></td><td class=input><?=$dp_lk_ulang4[P]?></td><td class=input><?=$dp_pr_baru4[P]?></td><td class=input><?=$dp_pr_ulang4[P]?></td><td><?=$jml_60_lk_dp?> </td><td><?=$per_dp_5=round(($jml_60_lk_dp/$jum_tot)*100, 1)?> %</td>
</td></tr>
<?
$per_ds= $per_ds_1 + $per_ds_2 + $per_ds_3 + $per_ds_4 + $per_ds_5 ;
$per_dp= $per_dp_1 + $per_dp_2 + $per_dp_3 + $per_dp_4 + $per_dp_5 ;
?>
<tr><td>JML</td>
<td><?=$jml_ds_lk_br?></td><td><?=$jml_ds_lk_ulang?></td><td><?=$jml_ds_pr_br?></td><td><?=$jml_ds_pr_ulang?></td><td><?=$jml_ds_lk_pr?></td><td><?=$per_ds?> %</td>
<td><?=$jml_dp_lk_br?></td><td><?=$jml_dp_lk_ulang?></td><td><?=$jml_dp_pr_br?></td><td><?=$jml_dp_pr_ulang?></td><td><?=$jml_dp_lk_pr?></td><td><?=$per_dp?> %</td>

</tr>
<tr><td>JML TOTAL</td>
<td  align="center" colspan="12"  ><b><?=$jum_tot?></td>
</tr>
</table>
</td>

</table>

<br>

<tr>
<td>
<form name=xls method=post action=modul/rekap_transaksi_donor1_xls.php>
<input type=hidden name=today value='<?=$today?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=hidden name=instansi value='<?=$src_nomorf?>'>
<input type=hidden name=status value='<?=$src_status?>'>
<input type=hidden name=ambil value='<?=$src_ambil?>'>
<input type=hidden name=hasil value='<?=$hasil?>'>
<input type=hidden name=shift value='<?=$src_shift?>'>
<input type=hidden name=ktg value='<?=$src_ktg?>'>
<input type=hidden name=drh value='<?=$src_drh?>'>
<input type=hidden name=jk value='<?=$srcr_jk?>'>
<input type=hidden name=rh value='<?=$src_rh?>'>
<input type=hidden name=ds value='<?=$src_ds?>'>
<input type=hidden name=baru value='<?=$src_baru?>'>
<input type=hidden name=namauser value='<?=$namauser?>'>
<input type=submit name=submit2 value='Print Rekap Transaksi Donor Lengkap (.XLS)'>
</form>
</td>
<td>
<form name=xls method=post action=modul/rekap_transaksi_donor_xls1.php>
<input type=hidden name=today value='<?=$today?>'>
<input type=hidden name=today1 value='<?=$today1?>'>
<input type=hidden name=instansi value='<?=$src_nomorf?>'>
<input type=hidden name=status value='<?=$src_status?>'>
<input type=hidden name=ambil value='<?=$src_ambil?>'>
<input type=hidden name=hasil value='<?=$hasil?>'>
<input type=hidden name=shift value='<?=$src_shift?>'>
<input type=hidden name=ktg value='<?=$src_ktg?>'>
<input type=hidden name=drh value='<?=$src_drh?>'>
<input type=hidden name=jk value='<?=$srcr_jk?>'>
<input type=hidden name=rh value='<?=$src_rh?>'>
<input type=hidden name=ds value='<?=$src_ds?>'>
<input type=hidden name=baru value='<?=$src_baru?>'>
<input type=hidden name=namauser value='<?=$namauser?>'>
<input type=submit name=submit3 value='Print Rekap Transaksi Donor Kirim Kebagian (.XLS)'>
</form>
</tr>
<?
mysql_close();
?>

<script>
    function viewjenis(){
        var jenis=document.getElementById("jenis").value;
        if(jenis=='4'){
            document.getElementById("bt").style.display="inline";
        }else{
            document.getElementById("bt").style.display="none";
        }
    }
</script>

<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
