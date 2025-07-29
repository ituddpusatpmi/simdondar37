
<script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        document.checkkantong.nokantong1.focus();
      });
    </script>
<table border=0 width=50% align=left><tr><td>
<link type="text/css" href="css/stok_darah.css" rel="stylesheet" />
<?
include('clogin.php');
include('config/db_connect.php');
$bl_thn=date("m").date("y");
$tgl_skr=date("Y-m-d");
?>
<form name="checkkantong" method="POST">
<table id="background-image" summary="Check kantong" width="60%">
<tr><td> Check No Kantong</td><td>:<input type=text name=nokantong1></td></tr>
<tr><td></td><td><input type=submit name=submit value="Submit"></td></tr>
</table>
</form>
<?
if (isset($_POST[submit])) {
$ckt1=mysql_query("select s.Status,s.stat2,s.jenis,s.sah,s.StatTempat,s.produk,s.noKantong,s.tgl_Aftap,s.merk,s.gol_darah,s.RhesusDrh,s.kadaluwarsa,s.volume,pd.Kode,pd.Alamat,pd.Nama,pd.GolDarah,pd.Rhesus,pd.TglLhr,pd.kelurahan,pd.kecamatan,pd.wilayah,pd.jumDonor,pd.telp,pd.telp2,pd.cekal,h.JenisDonor,h.Pengambilan,h.tempat,h.Instansi from stokkantong as s,pendonor as pd, htransaksi as h
		where (s.noKantong='$_POST[nokantong1]' and s.kodePendonor=pd.Kode and h.noKantong='$_POST[noKantong1]')");
$ckt2=mysql_query("select noKantong,OD,Hasil,jenisPeriksa,tglperiksa,dicatatOleh,dicekOleh,disahkanOleh from hasilelisa where noKantong='$_POST[noKantong1]'");
if (mysql_num_rows($ckt1)==0) $ckt1=mysql_query("select * form stokkantong,hasilelisa where noKantong='$_POST[nokantong1]'");
if (mysql_num_rows($ckt1)>0) {
$ckt=mysql_fetch_assoc($ckt1);
$ckt0=mysql_fetch_assoc($ckt2);
if ($ckt[Status]=='3') {
	$ttp=mysql_fetch_assoc(mysql_query("select Status,NoForm from dtransaksipermintaan where NoKantong='$_POST[nokantong1]' and Status='1'"));
}


<?
for ($jenis=0;$jenis<4;$jenis++) {
/*$reak0=mysql_query("select Hasil,tgl_tes,dicatatoleh from drapidtest where nokantong='$baris[nk]' and jenisPeriksa='$jenis'");
if (mysql_num_rows($reak0)=='1') {
$reak=mysql_fetch_assoc($reak0);  
$hasilr='Non Reaktif';
if ($reak[Hasil]=='0') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak[tgl_tes];
$pemeriksa=$reak[dicatatoleh];
} else {*/
$reak1=mysql_query("select Hasil,tglPeriksa,dicatatOleh from hasilelisa where noKantong='$baris[nk]' and jenisPeriksa='$jenis'");
$reak2=mysql_fetch_assoc($reak1);
$hasilr='Non Reaktif';
if ($reak2[Hasil]=='1') $hasilr='Reaktif';
?>
<td><?=$hasilr?></td>
<?
$tgl=$reak2[tglPeriksa];
$pemeriksa=$reak2[dicatatOleh];
}
}
?>

$tempat="";
switch ($ckt[Status]) {
	case 0:
		$ckt_status="Kosong";
		break;
	case 1:
		$ckt_status="Aftap";
		if ($ckt[sah]=='1') $ckt_status="Baru Isi/Karantina";
		break;
	case 2:
		$ckt_status="Sehat";
		if (substr($ckt[stat2],0,1)=='b') $tempat=" (BDRS)";
		break;
	case 3:
		$ckt_status="Keluar";
		if ($ttp[Status]=='1') $ckt_status="Titip";
		break;
	case 4:
		$ckt_status="Rusak";
		break;
	case 5:
		$ckt_status="Rusak-Gagal";
		break;
	case 6:
		$ckt_status="Dimusnahkan";
		break;
}
$ckt_tempat='<br>Belum DISAHKAN atau masih di LOGISTIK';
$ckt_dsdp='Sukarela';
$ckt_instansi='Dalam Gedung';
if ($ckt[StatTempat]=='1') $ckt_tempat='<br>Sudah DISAHKAN';
if ($ckt[JenisDonor]=='1') $ckt_dsdp='Pengganti'; 
if ($ckt[tempat]=='M') $ckt_instansi='MU'; 
switch($ckt[jenis]) {
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

switch($ckt0[jenisPeriksa]) {
case '0':
	$jenisperiksa0='HBsAg';
	break;
case '1':
	$jenisperiksa1='HCV';
	break;
case '2':
	$jenisperiksa2='HIV';
	break;
case '3':
	$jenisperiksa3='Shipilys';
	break;
}
?>
<table id="background-image" summary="Check kantong" width="80%">
<td colspan='6'>INFORMASI KANTONG</td>
<tr><td>No Kantong </td><td>:</td><td><?=$ckt[noKantong]?></td><td>Status</td><td>:</td><td><? echo $ckt_status; echo $tempat; if ($ckt_status=='Kosong') echo $ckt_tempat;?></td></tr>
<tr><td>Jenis</td><td>:</td><td><?=$jenis?></td><td>Merk</td><td>:</td><td><?=$ckt[merk]?></td></tr>
<tr><td>Produk</td><td>:</td><td><?=$ckt[produk]?>  (<?=$ckt[volume]?> cc)</td><td>Gol Darah</td><td>:</td><td><?=$ckt[gol_darah]?>(<?=$ckt[RhesusDrh]?>)</td></tr>
<tr><td>Tgl Aftap</td><td>:</td><td><?=$ckt[tgl_Aftap]?></td><td>Tgl Kadaluarsa</td><td>:</td><td><?=$ckt[kadaluwarsa]?></td></tr>
<tr><td>Tgl Pengolahan</td><td>:</td><td><?=$ckt[tglpengolahan]?></td><!--td>Tgl Periksa</td><td>:</td><td><?=$ckt[tglperiksa]?></td--></tr>
<td colspan='6'>INFORMASI PENDONOR</td>
<tr><td>Kode/ID</td><td>:</td><td><?=$ckt[Kode]?></td><td>Nama</td><td>:</td><td><?=$ckt[Nama]?></td></tr>
<tr><td>Tmpt Lhr</td><td>:</td><td><?=$ckt[TempatLhr]?></td><td>Tgl lhr</td><td>:</td><td><?=$ckt[TglLhr]?></td></tr>
<tr><td>Alamat</td><td>:</td><td><?=$ckt[Alamat]?></td><td>kelurahan</td><td>:</td><td><?=$ckt[kelurahan]?></td></tr>
<tr><td>Kecamatan</td><td>:</td><td><?=$ckt[kecamatan]?></td><td>Wilayah</td><td>:</td><td><?=$ckt[wilayah]?></td></tr>
<tr><td>Telp Rumah</td><td>:</td><td><?=$ckt[telp]?></td><td>Handphone</td><td>:</td><td><?=$ckt[telp2]?></td></tr>
<tr><td>Gol Darah Pendonor</td><td>:</td><td><?=$ckt[GolDarah]?> (<?=$ckt[Rhesus]?>)<td>Donor Ke</td><td>:</td><td><?=$ckt[jumDonor]?></td></td></tr>
<tr><td>Jenis Donor</td><td>:</td><td><?=$ckt_dsdp?></td><td>Tempat Pengambilan<td>:</td><td><?=$ckt_instansi?>(<?=$ckt[Instansi]?>)</td></tr>
<td colspan='6'>INFORMASI IMLTD</td>
<tr><td>Tanggal Periksa</td><td>:</td><td><?=$ckt0[tglperiksa]?></td><td>HBsAg</td><td>:</td><td><?=$jenisperiksa0?></td></tr>
<tr><td>Dikerjakan Oleh</td><td>:</td><td><?=$ckt0[dicatatOleh]?></td><td>HCV</td><td>:</td><td><?=$jenisperiksa1?></td></tr>
<tr><td>Di Chek Oleh</td><td>:</td><td><?=$ckt0[dicekOleh]?></td><td>HIV</td><td>:</td><td><?=$jenisperiksa2?></td></tr>
<tr><td>Disahkan Oleh</td><td>:</td><td><?=$ckt0[disahkanOleh]?></td><td>Shipilys</td><td>:</td><td><?=$jenisperiksa3?></td></tr>
</table>
<? 
}
} else { ?>
<table id="background-image" summary="Stock Darah" width="60%">
	<tr>
		<th scope="col"><a href=modul/karantina.php>Karantina</a></th>
		<th scope="col">A</th>
		<th scope="col">B</th>
		<th scope="col">AB</th>
		<th scope="col">O</th>
	</tr>
<? 
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='A' )"));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='B' )"));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='AB' )"));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='O' )"));
$stok=mysql_query("update stok set wb_a='$A',wb_b='$B',wb_ab='$AB',wb_o='$O' where status='0'");
if ($A==0) 	$A='-';
if ($B==0) 	$B='-';
if ($AB==0) $AB='-';
if ($O==0) 	$O='-';
echo "<tr>
		<td></td>
		<td>$A</td>
		<td>$B</td>
		<td>$AB</td>
		<td>$O</td>
	</tr>";?>
</table>

<font color="#e30f0f" size=2 face="Verdana, Arial, Helvetica, sans-serif"><a href=modul/sehat.php>Darah Sehat</a></font>
<table id="background-image" summary="Stock Darah" width="60%">
	<tr>
		<th scope="col">Produk</th>
		<th scope="col">A</th>
		<th scope="col">B</th>
		<th scope="col">AB</th>
		<th scope="col">O</th>
	</tr>
<?
$produk=mysql_query("select * from produk order by no");
while ($produk1=mysql_fetch_assoc($produk)) {
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and (stat2='0' or stat2 is null))"));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and (stat2='0' or stat2 is null))"));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and (stat2='0' or stat2 is null))"));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and (stat2='0' or stat2 is null))"));
$pa=$produk1[Nama]."_a";
$pb=$produk1[Nama]."_b";
$pab=$produk1[Nama]."_ab";
$po=$produk1[Nama]."_o";
$stok=mysql_query("update stok set $pa='$A',$pb='$B',$pab='$AB',$po='$O' where status='1'");
if ($A<1) $A='-';
if ($B<1) $B='-';
if ($AB<1) $AB='-';
if ($O<1) $O='-';
echo "<tr>
		<td>$produk1[Nama]</td>
		<td>$A</td>
		<td>$B</td>
		<td>$AB</td>
		<td>$O</td>
	</tr>";}?>
</table>
<table>
<font color="#e30f0f" size=2 face="Verdana, Arial, Helvetica, sans-serif"><a href=modul/titip.php>Darah Titipan</a></font><table id="background-image" summary="Stock Darah" width="60%">
    	<tr>
            <th scope="col">Produk</th>
            <th scope="col">A</th>
            <th scope="col">B</th>
            <th scope="col">AB</th>
            <th scope="col">O</th>
        </tr>
<?php
$produk=mysql_query("select * from produk order by no");
while ($produk1=mysql_fetch_assoc($produk)) {
	$A=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='A'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$B=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='B'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$AB=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='AB'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$O=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='O'
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
$pa=$produk1[Nama]."_a";
$pb=$produk1[Nama]."_b";
$pab=$produk1[Nama]."_ab";
$po=$produk1[Nama]."_o";
$stok=mysql_query("update stok set $pa='$A',$pb='$B',$pab='$AB',$po='$O' where status='2'");

	if ($A==0) $A='-';
	if ($B==0) $B='-';
	if ($AB==0) $AB='-';
	if ($O==0) $O='-';
echo "<tr>
		<td>$produk1[Nama]</td>
		<td>$A</td>
		<td>$B</td>
		<td>$AB</td>
		<td>$O</td>
	</tr>";}?>
</table>
</td>
</tr>
</table>
<? } ?>
