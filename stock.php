<script type="text/javascript" src="js/jquery-latest.js"></script>
    <script type="text/javascript">
	jQuery(document).ready(function() {
        document.checkkantong.nokantong1.focus();
      });
</script>

<table border=0 width=50% align=left>
  <tr><td>
  <link type="text/css" href="css/stok_darah.css" rel="stylesheet" />
  <?
  include('clogin.php');
  include('config/db_connect.php');
  $bl_thn=date("m").date("y");
  $tgl_skr=date("Y-m-d");
  ?>
  <form name="checkkantong" method="POST">
    <table id="background-image" summary="Check kantong" width="80%">
    <tr><td> Check No Kantong</td><td>:<input type=text name=nokantong1></td></tr>
    <tr><td></td><td><input type=submit name=submit value="Submit"></td></tr>
    </table>
  </form>
<?
if (isset($_POST[submit])) {
  $ckt1=mysql_query("select s.Status,s.stat2,s.jenis,s.sah,s.StatTempat,s.produk,s.noKantong,s.tgl_Aftap,s.merk,s.gol_darah,
		    s.RhesusDrh,s.kadaluwarsa,s.tglperiksa,s.volume,s.tglTerima, s.tglpengolahan,s.tgl_keluar,s.tglmutasi,
		    pd.Kode,pd.Alamat,pd.Nama,pd.GolDarah,pd.Rhesus,pd.TglLhr,pd.kelurahan,pd.kecamatan,pd.wilayah,pd.jumDonor,pd.telp,
		    pd.telp2,pd.cekal,h.JenisDonor,h.Pengambilan,h.tempat,h.Instansi from stokkantong as s,pendonor as pd,htransaksi as h
		    where (s.noKantong='$_POST[nokantong1]' and s.kodePendonor=pd.Kode and h.nokantong='$_POST[nokantong1]')");
  if (mysql_num_rows($ckt1)==0) $ckt1=mysql_query("select * from stokkantong where noKantong='$_POST[nokantong1]'");
  if (mysql_num_rows($ckt1)>0) {
    $ckt=mysql_fetch_assoc($ckt1);
    if ($ckt[Status]=='3') {
	$ttp=mysql_fetch_assoc(mysql_query("select Status,NoForm from dtransaksipermintaan where NoKantong='$_POST[nokantong1]' and Status='1'"));
	$ttp1=mysql_fetch_assoc(mysql_query("select dt.NoForm,ht.NamaOS,ht.bagian,ht.kelas,ht.jk,ht.Alamat,ht.Diagnosa,ht.jenis,ht.rs,ht.Tglminta,ht.NamaDokter,ht.regRS,ht.Alasan from dtransaksipermintaan as dt,htranspermintaan as ht where NoKantong='$_POST[nokantong1]' and ht.NoForm=dt.Noform"));

	$tujuan=mysql_fetch_assoc(mysql_query("select nama from utd where id='$ckt[stat2]'"));
	$tujuan1=mysql_fetch_assoc(mysql_query("select nama from bdrs where kode='$ckt[stat2]'"));
	$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$ttp1[rs]'"));
    }
    if ($ckt[Status]=='4'){
      $e_hbsag=mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode from hasilelisa where noKantong='$_POST[nokantong1]' and jenisPeriksa='0'"));
      $e_hcv=mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode from hasilelisa where noKantong='$_POST[nokantong1]' and jenisPeriksa='1'"));
      $e_hiv=mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode from hasilelisa where noKantong='$_POST[nokantong1]' and jenisPeriksa='2'"));
      $e_syp=mysql_fetch_assoc(mysql_query("select Hasil,OD,tglPeriksa,metode from hasilelisa where noKantong='$_POST[nokantong1]' and jenisPeriksa='3'"));

      $r_hbsag=mysql_fetch_assoc(mysql_query("select Hasil,Metode from drapidtest where noKantong='$_POST[nokantong1]' and jenisPeriksa='0'"));
      $r_hcv=mysql_fetch_assoc(mysql_query("select Hasil,Metode from drapidtest where noKantong='$_POST[nokantong1]' and jenisPeriksa='1'"));
      $r_hiv=mysql_fetch_assoc(mysql_query("select Hasil,Metode from drapidtest where noKantong='$_POST[nokantong1]' and jenisPeriksa='2'"));
      $r_syp=mysql_fetch_assoc(mysql_query("select Hasil,Metode from drapidtest where noKantong='$_POST[nokantong1]' and jenisPeriksa='3'"));
  }

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
$ckt_tujuan=$tujuan[nama];
$ckt_tujuan1=$tujuan1[nama];
$rmhskt1=$rmhskt[NamaRs];
$hbsag1='Non Reaktif';
$hcv1='Non Reaktif';
$hiv1='Non Reaktif';
$syp1='Non Reaktif';
$hbsag2='Non Reaktif';
$hcv2='Non Reaktif';
$hiv2='Non Reaktif';
$syp2='Non Reaktif';
if ($e_hbsag[Hasil]=='1') $hbsag1='Reaktif';
if ($e_hcv[Hasil]=='1') $hcv1='Reaktif';
if ($e_hiv[Hasil]=='1') $hiv1='Reaktif';
if ($e_syp[Hasil]=='1') $syp1='Reaktif';
if ($r_hbsag[Hasil]=='0') $hbsag2='Reaktif';
if ($r_hcv[Hasil]=='0') $hcv2='Reaktif';
if ($r_hiv[Hasil]=='0') $hiv2='Reaktif';
if ($r_syp[Hasil]=='0') $syp2='Reaktif';

if ($ckt[StatTempat]=='1') $ckt_tempat='<br>Sudah DISAHKAN';
if ($ckt[JenisDonor]=='1') $ckt_dsdp='Pengganti'; 
if ($ckt[tempat]=='M') $ckt_instansi='MU';
if ($ckt[stat2]==NULL and $ckt[Status]==3) $ckt_tujuan="Rumah Sakit"; 

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
?>
<table id="background-image" summary="Check kantong" width="80%">
<td colspan='6'>INFORMASI KANTONG</td>
<tr><td>No Kantong </td><td>:</td><td><?=$ckt[noKantong]?></td><td>Status</td><td>:</td><td><? echo $ckt_status; echo $tempat; if ($ckt_status=='Kosong') echo $ckt_tempat;?></td></tr>
<tr><td>Jenis</td><td>:</td><td><?=$jenis?></td><td>Merk</td><td>:</td><td><?=$ckt[merk]?></td></tr>
<tr><td>Produk</td><td>:</td><td><?=$ckt[produk]?>  (<?=$ckt[volume]?> cc)</td><td>Gol Darah</td><td>:</td><td><?=$ckt[gol_darah]?>(<?=$ckt[RhesusDrh]?>)</td></tr>
<tr><td>Tgl Aftap</td><td>:</td><td><?=$ckt[tgl_Aftap]?></td><td>Tgl Kadaluarsa</td><td>:</td><td><?=$ckt[kadaluwarsa]?></td></tr>
<tr><td>Tgl Pengolahan</td><td>:</td><td><?=$ckt[tglpengolahan]?></td><td>Tgl Periksa</td><td>:</td><td><?=$ckt[tglperiksa]?></td></tr>
<tr><td>Tgl mutasi ke LAB</td><td>:</td><td><?=$ckt[tglmutasi]?></td><td>Tgl Input</td><td>:</td><td><?=$ckt[tglTerima]?></td></tr>

<td colspan='6' >INFORMASI DONASI</td>
<tr><td>Kode/ID</td><td>:</td><td><?=$ckt[Kode]?></td><td>Nama</td><td>:</td><td><?=$ckt[Nama]?></td></tr>
<tr><td>Tmpt Lhr</td><td>:</td><td><?=$ckt[TempatLhr]?></td><td>Tgl lhr</td><td>:</td><td><?=$ckt[TglLhr]?></td></tr>
<tr><td>Alamat</td><td>:</td><td><?=$ckt[Alamat]?></td><td>kelurahan</td><td>:</td><td><?=$ckt[kelurahan]?></td></tr>
<tr><td>Kecamatan</td><td>:</td><td><?=$ckt[kecamatan]?></td><td>Wilayah</td><td>:</td><td><?=$ckt[wilayah]?></td></tr>
<tr><td>Telp Rumah</td><td>:</td><td><?=$ckt[telp]?></td><td>Handphone</td><td>:</td><td><?=$ckt[telp2]?></td></tr>
<tr><td>Gol Darah Pendonor</td><td>:</td><td><?=$ckt[GolDarah]?> (<?=$ckt[Rhesus]?>)<td>Donor Ke</td><td>:</td><td><?=$ckt[jumDonor]?></td></td></tr>
<tr><td>Jenis Donor</td><td>:</td><td><?=$ckt_dsdp?></td><td>Tempat Pengambilan<td>:</td><td><?=$ckt_instansi?>(<?=$ckt[Instansi]?>)</td></tr>
<td colspan='6'>INFORMASI DISTRIBUSI</td>
<tr><td>Keluar Ke</td><td>:</td><td><?=$ckt_tujuan?><?=$ckt_tujuan1?></td><td>Nama RS<td>:</td><td><?=$rmhskt1?> </td></tr> 
<tr><td>Nama Pasien</td><td>:</td><td><?=$ttp1[NamaOS]?></td><td>No. Reg. RS<td>:</td><td><?=$ttp1[regRS]?> </td></tr>
<tr><td>No Form</td><td>:</td><td><?=$ttp1[NoForm]?></td><td>Alamat Pasien<td>:</td><td><?=$ttp1[Alamat]?> </td></tr>
<tr><td>Nama Dokter</td><td>:</td><td><?=$ttp1[NamaDokter]?></td><td>Diagnosa Pasien<td>:</td><td><?=$ttp1[Diagnosa]?> </td></tr>
<tr><td>Alasan Transfusi</td><td>:</td><td><?=$ttp1[Alasan]?></td><td>Jenis Layanan<td>:</td><td><?=$ttp1[jenis]?> </td></tr> 
<tr><td>Bagian</td><td>:</td><td><?=$ttp1[bagian]?></td><td>kelas<td>:</td><td><?=$ttp1[kelas]?> </td></tr> 
<tr><td>Tgl Permintaan<td>:</td><td><?=$ttp1[Tglminta]?> </td><td>Tgl Keluar</td><td>:</td><td><?=$ckt[tgl_keluar]?></td></tr> 

<!--td colspan='6'>INFORMASI IMLTD</td>
<tr><td colspan='3'>ELISA</td><td colspan='3'>RAPID TEST</td></tr>
<tr><td>tanggal Periksa<td>:</td><td><?=$ckt[tglperiksa]?></td><td></td><td></td><td></td></tr>  
<tr><td>HBsAg<td>:</td><td><?=$hbsag1?> , <?=$e_hbsag[OD]?> </td>  <td>HBsAg</td><td>:</td><td><?=$hbsag2?></td></tr>
<tr><td>HCV</td><td>:</td><td><?=$hcv1?> , <?=$e_hcv[OD]?> </td>    <td>HCV</td><td>:</td><td><?=$hcv2?></td></tr> 
<tr><td>HIV<td>:</td><td><?=$hiv1?> , <?=$e_hiv[OD]?> </td>          <td>HIV</td><td>:</td><td><?=$hiv2?></td></tr>
<tr><td>Syphilis</td><td>:</td><td><?=$syp1?> , <?=$e_syp[OD]?></td> <td>Syphilis</td><td>:</td><td><?=$syp2?></td></tr--> 
</table>
<? 
}
} else { ?>
<table id="background-image" summary="Stock Darah" width="80%">
	<tr>
		<th scope="col"><a href=modul/karantina.php>Karantina</a></th>
		<th scope="col">A</th>
		<th scope="col">B</th>
		<th scope="col">AB</th>
		<th scope="col">O</th>
	</tr>
<? 
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='A' and kadaluwarsa > current_date )"));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='B' and kadaluwarsa > current_date )"));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='AB' and kadaluwarsa > current_date )"));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (Status='1' and sah='1' and gol_darah='O' and kadaluwarsa > current_date )"));
$stok=mysql_query("update stok set wb_a='$A',wb_b='$B',wb_ab='$AB',wb_o='$O' where status='1'");
if ($A==0) 	$A='-';
if ($B==0) 	$B='-';
if ($AB==0) 	$AB='-';
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
<font color="#000000" size=1 face="Verdana, Arial, Helvetica, sans-serif">(tanpa dikurangi stok emergency)</font>
<table id="background-image" summary="Stock Darah" width="80%">
	<tr>
		<th scope="col">Produk</th>
		<th scope="col">A</th>
		<th scope="col">B</th>
		<th scope="col">AB</th>
		<th scope="col">O</th>
	</tr>
<?
$jumA='0';
$jumB='0';
$jumAB='0';
$jumO='0';
$produk=mysql_query("select * from produk order by no");
while ($produk1=mysql_fetch_assoc($produk)) {
$A=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and (stat2='0' or stat2 is null)) and sah='1' and kadaluwarsa > current_date"));
$pa=$produk1[Nama]."_a";
$pb=$produk1[Nama]."_b";
$pab=$produk1[Nama]."_ab";
$po=$produk1[Nama]."_o";
$jumA=$jumA+$A;
$jumB=$jumB+$B;
$jumAB=$jumAB+$AB;
$jumO=$jumO+$O;
$stok=mysql_query("update stok set $pa='$A',$pb='$B',$pab='$AB',$po='$O' where status='0'");
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
	</tr>"	;}
echo "
<tr>
		<th scope='col'>Jumlah</th>
		<th scope='col'>$jumA</th>
		<th scope='col'>$jumB</th>
		<th scope='col'>$jumAB</th>
		<th scope='col'>$jumO</th>
	</tr>
";
?>
</table>
<table>
<font color="#e30f0f" size=2 face="Verdana, Arial, Helvetica, sans-serif"><a href=modul/titip.php>Darah Titipan</a></font><table id="background-image" summary="Stock Darah" width="80%" >
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
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='A' and sk.kadaluwarsa > current_date
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$B=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='B' and sk.kadaluwarsa > current_date
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$AB=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='AB' and sk.kadaluwarsa > current_date
				AND sk.NoKantong=dt.NoKantong AND dt.Status='1')"));
	$O=mysql_num_rows(mysql_query("
		SELECT sk.Status, sk.produk, sk.gol_darah, sk.NoKantong, dt.NoKantong, dt.Status
		FROM stokkantong sk, dtransaksipermintaan dt
		WHERE (sk.produk='$produk1[Nama]' AND sk.Status='3' AND sk.gol_darah='O' and sk.kadaluwarsa > current_date
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
	</tr>";}?>a
</table>
</td>
</tr>
</table>
<? } ?>
