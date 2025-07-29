<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
	document.checkkantong.nokantong1.focus();
    });
</script>

<table border=0 width=50% align=left>
  <tr><td>
    <link type="text/css" href="css/stok_darah.css" rel="stylesheet" />
    <?php
    include('clogin.php');
    include('config/db_connect.php');
    session_start();
    $namabdrs=$_SESSION[bdrs];
    $bl_thn=date("m").date("y");
    $tgl_skr=date("Y-m-d");
    ?>
    <form name="checkkantong" method="POST">
	<table id="background-image" summary="Check kantong" width="80%">
	    <tr><td> Check No Kantong</td><td>:<input type=text name=nokantong1></td></tr>
	    <tr><td></td><td><input type=submit name=submit value="Cek Kantong" class="swn_button_green"></td></tr>
	</table>
    </form>
    <?
if (isset($_POST[submit])) {
    $ckt1=mysql_query("select s.Status,s.jenis,s.produk,s.noKantong,s.tgl_Aftap,s.merk,s.gol_darah,s.RhesusDrh,pd.Kode,pd.Alamat,pd.Nama,pd.GolDarah,pd.Rhesus from stokkantong as s,pendonor as pd
		where (s.noKantong='$_POST[nokantong1]' and s.kodePendonor=pd.Kode)");
    if (mysql_num_rows($ckt1)==0) $ckt1=mysql_query("select * from stokkantong where noKantong='$_POST[nokantong1]'");
    if (mysql_num_rows($ckt1)>0) {
	$ckt=mysql_fetch_assoc($ckt1);
	if ($ckt[Status]=='3') {
	    $ttp=mysql_fetch_assoc(mysql_query("select Status,NoForm from dtransaksipermintaan where NoKantong='$_POST[nokantong1]' and Status='1'"));
	}
	switch ($ckt[Status]) {
	    case 0:
		$ckt_status="Kosong";
		break;
	    case 1:
		$ckt_status="Baru Isi/Karantina";
		break;
	    case 2:
		$ckt_status="Sehat";
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
	}
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
    <table id="background-image" summary="Check kantong" width="80%" cellpadding="2" cellspacing="2">
	<tr><td>No Kantong </td><td>:</td><td><?=$ckt[noKantong]?></td></tr>
	<tr><td>Status</td><td>:</td><td><?=$ckt_status?></td></tr>
	<tr><td>Jenis</td><td>:</td><td><?=$jenis?></td></tr>
	<tr><td>Merk</td><td>:</td><td><?=$ckt[merk]?></td></tr>
	<tr><td>Produk</td><td>:</td><td><?=$ckt[produk]?></td></tr>
	<tr><td>Gol Darah</td><td>:</td><td><?=$ckt[gol_darah]?>(<?=$ckt[RhesusDrh]?>)</td></tr>
	<tr><td>Tgl Aftap</td><td>:</td><td><?=$ckt[tgl_Aftap]?></td></tr>
	<tr><td>Kode Pendonor</td><td>:</td><td><?=$ckt[Kode]?></td></tr>
	<tr><td>Nama Pendonor</td><td>:</td><td><?=$ckt[Nama]?></td></tr>
	<tr><td>Alamat</td><td>:</td><td><?=$ckt[Alamat]?></td></tr>
	<tr><td>Gol Darah Pendonor</td><td>:</td><td><?=$ckt[GolDarah]?>(<?=$ckt[Rhesus]?>)</td></tr>
    </table>
    <? 
    }
} else { ?>
    <? $idbdrs=mysql_fetch_assoc(mysql_query("select kode from bdrs where nama='$namabdrs' limit 1")); ?>
    <font color="#e30f0f" size=4 face="Verdana, Arial, Helvetica, sans-serif"><a href=modul/sehat_bdrs.php>Stok Darah - <?=$namabdrs?></a></font>
    <table id="background-image" summary="Stock Darah" width="80%" cellpadding="2" cellspacing="2">
	<tr>
	    <th scope="col">Produk</th>
	    <th scope="col">A+</th>
	    <th scope="col">A-</th>	
	    <th scope="col">B+</th>
	    <th scope="col">B-</th>	
	    <th scope="col">AB+</th>
	    <th scope="col">AB-</th>
	    <th scope="col">O+</th>
	    <th scope="col">O-</th>
	</tr>
    <?
    $jumA='0';
    $jumB='0';
    $jumAB='0';
    $jumO='0';
    $jumA_='0';
    $jumB_='0';
    $jumAB_='0';
    $jumO_='0';	
    $produk=mysql_query("select * from produk order by no");
    while ($produk1=mysql_fetch_assoc($produk)) {
	$A=mysql_num_rows(mysql_query("select Status from stokkantong
    		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and RhesusDrh='+' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));
	$B=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and RhesusDrh='+' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));
	$AB=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and RhesusDrh='+' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));
	$O=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and RhesusDrh='+' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));

	$A_=mysql_num_rows(mysql_query("select Status from stokkantong
    		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='A' and RhesusDrh='-' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));
	$B_=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='B' and RhesusDrh='-' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));
	$AB_=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='AB' and RhesusDrh='-' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));
	$O_=mysql_num_rows(mysql_query("select Status from stokkantong
		where (produk='$produk1[Nama]' and Status='2'
		and gol_darah='O' and RhesusDrh='-' and (stat2='$idbdrs[kode]')) and sah='1' and kadaluwarsa > current_date"));	

	$pa=$produk1[Nama]."_a";
	$pb=$produk1[Nama]."_b";
	$pab=$produk1[Nama]."_ab";
	$po=$produk1[Nama]."_o";
	$jumA=$jumA+$A;
	$jumB=$jumB+$B;
	$jumAB=$jumAB+$AB;
	$jumO=$jumO+$O;
	$jumA_=$jumA_+$A_;
	$jumB_=$jumB_+$B_;
	$jumAB_=$jumAB_+$AB_;
	$jumO_=$jumO_+$O_;

	$stok=mysql_query("update stok set $pa='$A+$A_',$pb='$B+$B_',$pab='$AB+$AB_',$po='$O+$O_' where status='0'");
	if ($A<1) $A='-';
	if ($B<1) $B='-';
	if ($AB<1) $AB='-';
	if ($O<1) $O='-';
	if ($A_<1) $A_='-';
	if ($B_<1) $B_='-';
	if ($AB_<1) $AB_='-';
	if ($O_<1) $O_='-';
	echo "<tr>
		<td>$produk1[Nama]</td>
		<td>$A</td>
		<td>$A_</td>
		<td>$B</td>
		<td>$B_</td>
		<td>$AB</td>
		<td>$AB_</td>
		<td>$O</td>
		<td>$O_</td>
	</tr>"	;}
	echo "
	<tr>
		<th scope='col'>Jumlah</th>
		<th scope='col'>$jumA</th>
		<th scope='col'>$jumA_</th>
		<th scope='col'>$jumB</th>
		<th scope='col'>$jumB_</th>
		<th scope='col'>$jumAB</th>
		<th scope='col'>$jumAB_</th>
		<th scope='col'>$jumO</th>
		<th scope='col'>$jumO_</th>
	</tr>";?>
    </table>
</td>
</tr>
</table>
<? } ?>
