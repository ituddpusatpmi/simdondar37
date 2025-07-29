<?php
require_once('config/db_connect.php');
session_start();
$namaudd=$_SESSION[namaudd];
$col4=mysql_query("SELECT `nolot_aa` FROM `dkonfirmasi`");if(!$col4){mysql_query("ALTER TABLE `dkonfirmasi` 
ADD `nolot_aa` VARCHAR( 12 ) NULL AFTER `ba`,
ADD `expa` DATE NULL AFTER `nolot_aa`,
ADD `nolot_ab` VARCHAR( 12 ) NULL AFTER `expa`,
ADD `expb` DATE NULL AFTER `nolot_ab`,
ADD `nolot_ad` VARCHAR( 12 ) NULL AFTER `expb`,
ADD `expd` DATE NULL AFTER `nolot_ad`");}
?>
<head>
<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script language=javascript src="js/konfirmasi_gol_darah1.js" type="text/javascript"> </script>
<script language=javascript src="js/util.js" type="text/javascript"> </script>
<script language="javascript" src="js/AjaxRequest.js" type="text/javascript"></script>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script language="javascript">function setFocus(){document.kantong.nokantong.focus();}</script>
<style>
	.merah{
		background-color:#FECCBF;
	}
</style>
</head>
<?php
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION['namauser'];
$today3=date('Y-m-d H:i:s');
if (isset($_POST['terima'])) {
	for ($i=0; $i<sizeof($_POST['goldarah']); $i++) {
		$kode=$_POST['kode'][$i]; 		
		$goldarah=$_POST['goldarah'][$i]; 		
		$rhesus=$_POST['rhesus'][$i]; 		
		$nkt=$_POST['nokantong'][$i];
		$goldarahasal=$_POST['gol_darah'];
		$rhesusasal=$_POST['rhesus_darah'];
		$metode=$_POST['metode'];
		$sel=$_POST['sel'][$i];
		$antiA=$_POST['antia'][$i];
		$antiB=$_POST['antib'][$i];
		$antiO=$_POST['antio'][$i];
		$serum=$_POST['serum'][$i];
		$tA=$_POST['ta'][$i];
		$tB=$_POST['tb'][$i];
		$ac=$_POST['ac'][$i];
		$ba=$_POST['ba'][$i];
		$ser=$_POST['anti'][$i];
		$antiD=$_POST['antid'][$i];
		$no_kantong0=substr($nkt,0,-1);
		$k_today="K".date("dmy")."-";
		$idp	= mysql_query("select NoKonfirmasi from dkonfirmasi where NoKonfirmasi like '$k_today%' order by NoKonfirmasi DESC limit 1");
		$idp1	= mysql_fetch_assoc($idp);
		$idp2	= substr($idp1[NoKonfirmasi],8,3);
		if ($idp2<1) {
			$idp2="000";
		}
		$int_idp2=(int)$idp2+1;
		$j_nol1= 3-(strlen(strval($int_idp2)));
		$idp4='';
		for ($n=0; $n<$j_nol1; $n++){
			$idp4 .="0";
		}
		$no_konfirmasi=$k_today.$idp4.$int_idp2;
        $q_cek_gol=mysql_query("SELECT gol_darah,RhesusDrh,produk,kodependonor from stokkantong where noKantong='$nkt' AND sah='1' AND status between '1' AND '2'");
		$a_cek_gol=mysql_fetch_assoc($q_cek_gol);
		if (($a_cek_gol['gol_darah']==$goldarah) and ($a_cek_gol['RhesusDrh']==$rhesus)){
			$Cocok=0;
		}else{
			$Cocok=1;
		}
		echo $Cocok;
		
        $tambah=mysql_query("UPDATE stokkantong set gol_darah='$goldarah',RhesusDrh='$rhesus',statKonfirmasi='1' where noKantong like '$no_kantong0%'");
        $tambah1=mysql_query("UPDATE pendonor set GolDarah='$goldarah',Rhesus='$rhesus' where Kode='$a_cek_gol[kodependonor]'");
		$komp=mysql_query("UPDATE dpengolahan set goldarah='$goldarah',rhesus='$rhesus' where noKantong like '$no_kantong0%'");
		$nkt1=mysql_query("update stokkantong set kodependonor='$a_cek_gol[kodependonor]' where  (kodependonor='' or kodependonor is NULL) and nokantong like '$no_kantong0%'");
		$tambah3=mysql_query("UPDATE htransaksi set gol_darah='$goldarah',rhesus='$rhesus' where nokantong like '$no_kantong0%'");
        $tambah2=mysql_query("insert into dkonfirmasi(NoKonfirmasi,NoKantong,GolDarah,Rhesus,ket,tgl,petugas,Cocok,goldarah_asal,
				rhesus_asal,metode,sel,antiA,antiB,antiO,serum,tA,tB,`tsO`,`antiD`,`ac`,`ba`,
				`nolot_aa`,`expa`,`nolot_ab`,`expb`,`nolot_ad`,`expd`)
				value ('$no_konfirmasi','$nkt','$goldarah','$rhesus','$_POST[ket]','$today3','$namauser','$Cocok','$a_cek_gol[gol_darah]',
				'$a_cek_gol[RhesusDrh]','$metode','0','$antiA','$antiB','-','0','$tA','$tB','$ser','$antiD','$ac','$ba',
				'$_POST[nolota]','$_POST[expa]','$_POST[nolotb]','$_POST[expb]','$_POST[nolotd]','$_POST[expd]')"); 
	//=======Audit Trial====================================================================================
	$log_mdl ='KONFIRMASI';
	$log_aksi='KGD: '.$nkt.', transaksi: '.$no_konfirmasi. 'Gol. Awal: '.$a_cek_gol[gol_darah].$a_cek_gol[RhesusDrh].', hasil: '.$goldarah.$rhesus;
	include('user_log.php');
	//=====================================================================================================
	
		}
	if ($tambah) {
        echo "Golongan Darah ABO dan Rhesus Telah berhasil diupdate";?>
	<?}
} ?>
	<body onLoad=setFocus() style="margin:30px;font-family: Arial, Helvetica, sans-serif;">
	<form name="kantong" onsubmit="return ok()" method="POST" action="">
	<div style="background-color: #ffffff;font-size:24px; font-weight:bold;color:#ff0000;text-shadow: 1px 1px 1px #000000; font-family:Helvetica, Arial, san-serif;">Pemeriksaan Golongan Darah</div>
	<table style="background-color:#FECCBF; font-size:12px; color:#000000; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'" >
					<tr >
						<td>METODE<select name="metode">
						<option value="Bioplat">Bioplat</option>
						<option value="Otomatis">Otomatis</option>
						<option value="Tube Test">Tube Test</option>
						</select></td>
						<td class="input">NOLOT ANTI-A<INPUT type="text"  name="nolota" size='9' required placeholder="nolot/kod.prod.">
						</td>
						<td class="input">EXP. ANTI-A<INPUT type="text"  name="expa" size='9' required placeholder="yyyy-mm-dd">
						</td>
						<td class="input">NOLOT ANTI-B<INPUT type="text"  name="nolotb" size='9' required placeholder="nolot/kod.prod">
						</td>
						<td class="input">EXP. ANTI-B<INPUT type="text"  name="expb" size='9' required placeholder="yyyy-mm-dd">
						</td>
						<td class="input">NOLOT ANTI-D<INPUT type="text"  name="nolotd" size='9' required placeholder="nolot/kod.prod">
						</td>
						<td class="input">EXP. ANTI-D<INPUT type="text"  name="expd" size='9' required placeholder="yyyy-mm-dd">
						</td>
						</td>

					</tr>
</table>
<table>
					<tr>
						<td>NO KANTONG</td>
						<td class="input" colspan='2' ><INPUT type="text"  name="nokantong" id="nokantong" size='23' placeholder="input nokantong'A'--> ENTER" 
							onkeydown="chang(event,this);" onchange="cari_kantong('box-table-b');">
						</td>
					</tr>
	</table>	
			<table class="form" id="box-table-b" width=100% align=top>
					<tr class="merah">
						<td align='center'>No</td>
						<td align='center'>No Kantong</td>
						<td align='center'>Produk</td>
						<td align='center'>Gol&Rh Darah Lama</td>
						<td align='center'>Gol&Rh Darah Baru</td>
						<td align='center'>Rhesus</td>
						<td align='center'>Anti A</td>
						<td align='center'>Anti B</td>
						<td align='center'>TA</td>
						<td align='center'>TB</td>
						<td align='center'>TO</td>
						<td align='center'>AC</td>
						<td align='center'>Anti D</td>
						<td align='center'>BA 6%</td>
						</tr>
				</table>
				<input name="terima" type="submit" value="Simpan">
</form>

<!--?
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

$tg=$pertgl.$perbln.$perthn1;
?>
<h1 class="table">Rekap Konfirmasi Gol Darah <?=$pertgl?> - <?=$perbln?> - <?=$perthn?><br>
</h1>
<div>
<form name=cek method=post> Cek Tanggal Sebelumnya :
<input type=text name=terima1 id=datepicker2 size=10 onChange="this.form.submit();">
</form></div>
<div>
<form name=sahdarah1 method=post> Mulai:
<input type=text name=terima1 id="datepicker" size=10>
Sampai:
<input type=text name=terima2 id="datepicker1" size=10>
<input type=submit name=submit value=Submit>
</form></div>
<table class=form border=1 cellpadding=0 cellspacing=0>
<tr>
        <td>No Konfirmasi</td>
        <td>No Kantong</td>
	<td>Produk</td>
	<td>Gol Darah Lama</td>
        <td>Gol Darah Baru</td>
        <td>Hasil</td>
        <td>Kode Pendonor</td>
        <td>Nama Pendonor</td>
	<td>Metode</td>
	<td>Aglutinasi</td>
        </tr>
</tr>
<?
//$rekon0=mysql_query("select dk.NoKonfirmasi,dk.NoKantong,dk.GolDarah,dk.Rhesus,ht.KodePendonor,dk.Cocok,sk.produk from dkonfirmasi as dk, htransaksi as ht, stokkantong as sk where dk.NoKantong=ht.NoKantong and dk.NoKantong=sk.noKantong and substring(dk.NoKonfirmasi,2,6)='$tg'");
$rekon0=mysql_query("select dk.NoKonfirmasi,dk.NoKantong,dk.GolDarah,dk.Rhesus,dk.Cocok,dk.goldarah_asal,dk.rhesus_asal,dk.metode,dk.aglutinasi,sk.KodePendonor,sk.produk from dkonfirmasi as dk,stokkantong as sk where dk.NoKantong=sk.noKantong and CASE(dk.tgl as date)>='$today' and CASE(dk.tgl as date)<='$today1'");
while ($rekon=mysql_fetch_assoc($rekon0)) {
$cocok='Cocok';
if ($rekon[Cocok]=='1') $cocok='Tidak Cocok';
?>
<tr class="record">
	<td class=input><?=$rekon[NoKonfirmasi]?></td>
	<td class=input><?=$rekon[NoKantong]?></td>
	<td class=input><?=$rekon[produk]?></td>
	<td class=input><?=$rekon[goldarah_asal]?> (<?=$rekon[rhesus_asal]?>)</td>
	<td class=input><?=$rekon[GolDarah]?> (<?=$rekon[Rhesus]?>)</td>
	<td class=input><?=$cocok?></td>
	<td class=input><?=$rekon[KodePendonor]?></td>
	<td class=input><?=$rekon[metode]?></td>
	<td class=input><?=$rekon[aglutinasi]?></td>
<?
$nm=mysql_fetch_assoc(mysql_query("select Nama from pendonor where Kode='$rekon[KodePendonor]'"));
?>
	<td class=input><?=$nm[Nama]?></td>
        </tr>
<?
}
?>
</table>
<br>
<form name=xls method=post action=modul/konfirmasi_gol_darah_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=submit name=submit2 value='Print Rekap Konfirmasi Darah (.XLS)'>
</form>
-->
