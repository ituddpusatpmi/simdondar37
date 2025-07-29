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


<?
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
                    $dk=mysql_query("select nama,telp,telp2 from pendonor where Kode='$idpendonor' and LENGTH(telp2)>9");
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

<!--
<h1>REKAP TRANSAKSI DONOR</h1>

<form method=post> 
TANGGAL : <input type=text name=minta1 id=datepicker size=10 value=<?=$today?>>
	S/D <input type=text name=minta2 id=datepicker1 size=10 value=<?=$today1?>><br>
INSTANSI <input type=text name=nomorf id=instansi size=20 value=<?=$src_nomorf?>>
	<!--NO.RM <input type=text name=rm id=rm size=10 value=<?=$srcrm?>-->
<!--
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
					</select>
KANTONG<select name="gol_ktg">
						<option value="">-SEMUA-</option>
						<option value="1">SINGLE</option>
						<option value="2">DOUBLE</option>
						<option value="3">TRIPLE</option>
						<option value="4">QUADRUPLE</option>
						<option value="6">PEDIATRIK</option>
					</select>
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
-->
<!--?
$transaksipermintaan=mysql_query("select * from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' order by NoTrans ASC  ");
?>
<!--
<h1 class="table">Rekap Transaksi Donor dari Tanggal : <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?>
<?
$countp=mysql_num_rows($transaksipermintaan);
echo"<br><br>";
echo"Sejumlah :  ";
echo"<b>";
echo $countp;
echo"</b>";
echo " data";
?>
</h1>

<table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="100%">
<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">          
	<!--th colspan=12><b>Total = <?$TRec?> Kantong</b></th></tr><tr class="field"-->
<!--	
	<td rowspan='2' align="center">No</td>
	<td rowspan='2' align="center">NoTrans</td>
	<td rowspan='2' align="center">Tanggal</td>
	<td colspan='11' align="center">Pendonor</td>
	<td colspan='10' align="center">Aftap</td>
	 <td colspan='5'>Piagam</td>
	<td colspan='5' align="center">Petugas</td>	
	
        </tr>
	<tr style="background-color:#FF4356; font-size:11px; color:#FFFFFF; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
	<td align="center">ID</td>
	<td align="center">Nama</td>
	<td align="center">Alamat</td>
	<td align="center">HP</td>
	<td align="center">Umur</td>
	<td align="center">Gol<br>(Rh)</td>
	<td align="center">JK</td>
	<td align="center">DS<br>DP</td>
	<td align="center">Baru<br>Ulang</td>
	<td align="center">Donor<br>Ke-</td>
	<td align="center">Jam<br>Antri</td>

	<td align="center">Jenis</td>
	<td align="center">No<br>Kantong</td>
	<td align="center">Penge-<br>sahan</td>
	<td align="center">Jam<br>Aftap</td>
	<td align="center">Status</td>
	<td align="center">Cara Ambil</td>
	<td align="center">CC</td>
	<td align="center">Shift</td>
	<td align="center">DG<br>MU</td>
	<td align="center">Instansi</td>
	
			<td align="center">10x</td>
			<td align="center">25x</td>
			<td align="center">50x</td>
			<td align="center">75x</td>
			<td align="center">100x</td>

	<td align="center">Dokter</td>
        <td align="center">Tensi</td>
	<td align="center">Hb</td>
	<td align="center">Aftap</td>
        <td align="center">Input</td>
        

	</tr>


<?
$no=1;
while ($datatransaksipermintaan=mysql_fetch_array($transaksipermintaan)){
?>


<tr style="background-color:#FF6346; font-size:11px; color:#000000; font-family:Verdana;" 
  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
	<td align="center"><?=$no?></td>
	<td align="center"><?=$datatransaksipermintaan['NoTrans']?></td>
	<td align="center"><?=$datatransaksipermintaan['Tgl']?></td>
	<td align="center"><?=$datatransaksipermintaan['KodePendonor']?></td>

	
	<? 	
	$kantong0=mysql_query("select * from stokkantong where noKantong='$datatransaksipermintaan[NoKantong]'");
	$kantong=mysql_fetch_array($kantong0);
	$pendonor0=mysql_query("select * from pendonor where Kode='$datatransaksipermintaan[KodePendonor]'");
	$pendonor=mysql_fetch_array($pendonor0);
	$jamantri=substr($datatransaksipermintaan[Tgl],11);
	$jamaftap=substr($kantong[tgl_Aftap],11);
	if ($datatransaksipermintaan[jk]==0) $jk='Pria';
	if ($datatransaksipermintaan[jk]==1) $jk='Wanita';
$peng='Antri';
if ($datatransaksipermintaan[jumHB]=='1') $peng='Lolos MCU';
if ($datatransaksipermintaan[jumHB]=='2') $peng='Gagal MCU';
if ($datatransaksipermintaan[jumHB]=='3') $peng='Gagal MCU';
if ($datatransaksipermintaan[jumHB]=='4') $peng='Gagal MCU';
if ($datatransaksipermintaan[Pengambilan]=='0') $peng='Berhasil';
if ($datatransaksipermintaan[Pengambilan]=='2') $peng='Gagal';
if ($datatransaksipermintaan[Pengambilan]=='1') $peng='Batal';

if ($datatransaksipermintaan[caraAmbil]=='0') $caraambil='Biasa';
if ($datatransaksipermintaan[caraAmbil]=='1') $caraambil='Tromboferesis';
if ($datatransaksipermintaan[caraAmbil]=='2') $caraambil='Leukaferesis';
if ($datatransaksipermintaan[caraAmbil]=='3') $caraambil='Plasmaferesis';
if ($datatransaksipermintaan[caraAmbil]=='4') $caraambil='Eritoferesis';

if ($datatransaksipermintaan[JenisDonor]=='0') $ds='DS';
if ($datatransaksipermintaan[JenisDonor]=='1') $ds='DP';
if ($datatransaksipermintaan[JenisDonor]=='2') $ds='Autologus';

if ($datatransaksipermintaan[donorbaru]=='0') $baru='Baru';
if ($datatransaksipermintaan[donorbaru]=='1') $baru='Ulang';

switch($datatransaksipermintaan[jeniskantong]) {
case '1':
	$jenis='Single';
	break;
case '2':
	$jenis='Double';
	break;
case '3':
	$jenis='Triple';
	break;
case '4':
	$jenis='Quadruple';
	break;
case '6':
	$jenis='Pediatrik';
	break;
default:
	$jenis='';
}

//if ($kantong[sah]=='0') $sah1='Belum';
//if ($kantong[sah]==0 and $datatransaksipermintaan[NoKantong]==NULL) $sah1='-';
//if ($kantong[sah]=='1') $sah1='Sudah';
	?>

	<td align="left"><?=$pendonor['Nama']?></td>
	<td align="center"><?=$pendonor['Alamat']?></td>
	<td align="center"><?=$pendonor['telp2']?></td>
	<td align="center"><?=$datatransaksipermintaan['umur']?></td>
	<td align="center"><?=$datatransaksipermintaan['gol_darah']?><?=$datatransaksipermintaan['rhesus']?></td>
	<td align="center"><?=$jk?></td>
	<td align="center"><?=$ds?></td>
	<td align="center"><?=$baru?></td>
	<td align="center"><?=$pendonor['jumDonor']?></td>
	<td align="center"><?=$jamantri?></td>	
	<!--td align="center"><?=$datatransaksipermintaan['NoKantong']?></td-->
	<!--td align="center"><?=$jenis?></td>
	<? echo "<td align=center><a href=pmi".$_SESSION[leveluser].".php?module=updatekantong&noKantong=".$datatransaksipermintaan[NoKantong].">".$datatransaksipermintaan[NoKantong]."</a></td>"; ?>
	<td align="center"><?=$sah1?></td>
	<td align="center"><?=$jamaftap?></td>
	<td align="center"><?=$peng?></td>
	<td align="center"><?=$caraambil?></td>
	<td align="center"><?=$datatransaksipermintaan['volumekantong']?></td> 
	<td align="center"><?=$datatransaksipermintaan['shift']?></td> 
	<?
	if ($datatransaksipermintaan[tempat]=='M') $tempat1='MU';
	if ($datatransaksipermintaan[tempat]!='M') $tempat1='DG';
	?>

	<td align="center"><?=$tempat1?></td>
	<td align="center"><?=$datatransaksipermintaan['Instansi']?></td>


<?
$p10='Sdh';
if ($pendonor['jumDonor'] >9 and $pendonor['p10']==0) $p10='Blm';
if ($pendonor['jumDonor'] <10) $p10='-';
$p25='Sdh';
if ($pendonor['jumDonor'] >24 and $pendonor['p25']=='0')$p25='Blm';
if ($pendonor['jumDonor']<25) $p25='-';
$p50='Sdh';
if ($pendonor['jumDonor'] >49 and $pendonor['p50']=='0')$p50='Blm';
if ($pendonor['jumDonor']<50) $p50='-';
$p75='Sdh';
if ($pendonor['jumDonor'] >74 and $pendonor['p75']=='0')$p75='Blm';
if ($pendonor['jumDonor']<75) $p75='-';
$p100='Sdh';
if ($pendonor['jumDonor'] >99 and $pendonor['p100']=='0')$p100='Blm';
if ($pendonor['jumDonor']<100) $p100='-';
?>
	<td class=input align="right"><?=$p10?></td>
	<td class=input align="right"><?=$p25?></td>
	<td class=input align="right"><?=$p50?></td>
	<td class=input align="right"><?=$p75?></td>
	<td class=input align="right"><?=$p100?></td>



<?
$dokter=mysql_fetch_assoc(mysql_query("select Nama from dokter_periksa where kode='$datatransaksipermintaan[NamaDokter]'"));
?>
	<td class=input><?=$dokter[Nama]?></td>

        <td align="center"><?=$datatransaksipermintaan['petugasTensi']?></td>
	<td align="center"><?=$datatransaksipermintaan['petugasHB']?></td>
	<!--? 	
	$kantong1=mysql_query("select * from stokkantong where NoKantong='$datatransaksipermintaan[NoKantong]'");
	$ambilkantong1=mysql_fetch_array($kantong1);
	
	?-->
	<!--td align="center"><?=$datatransaksipermintaan['petugas']?></td>
	<td align="center"><?=$datatransaksipermintaan['user']?></td-->
	
	
</tr>
<? $no++;} ?>
</table>

<?
$jum=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as kod from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' 
and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' "));

//PENGAMBILAN BERHASIL DG

$golA=mysql_fetch_assoc(mysql_query("select count(gol_darah) as A from htransaksi where  CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='A' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' "));
$golB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as B from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='B' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$golAB=mysql_fetch_assoc(mysql_query("select count(gol_darah) as AB from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='AB' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$golO=mysql_fetch_assoc(mysql_query("select count(gol_darah) as O from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='O'  and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$golx=mysql_fetch_assoc(mysql_query("select count(gol_darah) as x from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and gol_darah='X' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$jkP=mysql_fetch_assoc(mysql_query("select count(jk) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jk='0' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));
$jkW=mysql_fetch_assoc(mysql_query("select count(jk) as W from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and jk='1' and Pengambilan='0' and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%'"));


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
$rhnegP=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and and Pengambilan like '%$src_status%' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%' and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and jk='0' and rhesus='-'"));
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

$mu_m=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and notrans like 'M%' and kendaraan='0' "));

$mu_b=mysql_fetch_assoc(mysql_query("select count(KodePendonor) as P from htransaksi where CAST(Tgl as date)>='$today' and CAST(Tgl as date)<='$today1' and tempat like '%$hasil%' and shift like '%$src_shift%' and caraambil like '%$src_ambil%' and jeniskantong like '%$src_ktg%' and gol_darah like '%$src_drh%' and jk like '%$src_jk%' and Instansi like '%$src_nomorf%'  and rhesus like '%$src_rh%' and JenisDonor like '%$src_ds%' and donorbaru like '%$src_baru%' and Pengambilan like '%$src_status%' and notrans like 'M%' and kendaraan='1' "));

?>
<br>
<!--
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
<!--tr><td>JML TTL</td>
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
<!--
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
<tr class="field">
<td rowspan='2'><b>Tempat Donor</b></td>
<th class ="field" colspan='3'><b>Jumlah Aftap</b></th>
</tr>
<th><b>Jumlah</b></th><th><b>Mobil</b></th><th><b>Bus Donor</b></th>

<tr><td>DG</td>
<td class=input align='center'><?=$dg[P]?></td><td class=input><?='-'?></td><td class=input><?='-'?></td></tr>
<tr><td>MU</td>
<td class=input><?=$mu[P]?></td><td class=input><?=$mu_m[P]?></td><td class=input><?=$mu_b[P]?></td></tr>
<!--tr><td>Mobil Donor</td>
<td class=input><?=$ds[P]?></td><td class=input><?=$dsg[P]?></td><td class=input><?=$dsb[P]?></td></tr>
<tr><td>BUS Donor</td>
<td class=input><?=$dp[W]?><td class=input><?=$dpg[W]?></td><td class=input><?=$dpb[W]?></td-->
<tr><!--td>JML TTL</td><td class=input><?=$dg[P]+$mu[P]?></td><td class=input><?=$mu_m[P]?></td><td class=input><?=$mu_b[P]?></td></tr>
</table>
</td>
-->

</tr>
</table>


<br>



<form name=xls method=post action=modul/rekap_transaksi_donor_xls.php>
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
<!--input type=submit name=submit2 value='Print Rekap Darah Keluar (.XLS)'-->
</form>

<?
mysql_close();
?>
