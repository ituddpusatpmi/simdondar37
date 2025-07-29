<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>

<script type="text/javascript">
function makeFrame() {
	$('#lap_iframe iFrame').remove();
	ifrm = document.createElement("iFrame");
	ifrm.setAttribute("src", "pmiadmin.php?module=lkr");
	ifrm.style.width = 100+"%";
	ifrm.style.height = 620+"px";
	ifrm.style.border=0;
	document.getElementById('lap_iframe').appendChild(ifrm);
}
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?
$tgll=date("Ymd"); 
?>

<h1 class="table">Laporan Keadaan Donor Darah</h1>
<INPUT TYPE="button" name="lpdr" value="Update Terakhir" onClick="makeFrame()">
<INPUT TYPE="button" name="lpdrxls" value="(XLS)" onClick="parent.location='lkr.php'">
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Pilih Periode Laporan : </td>
<td class="input">
<input class=text name="waktu" id="datepicker" type=text size=10>Sampai Dengan
<input class=text name="waktu1" id="datepicker1" type=text size=10>
</td><td>
<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?if (isset($_POST[submit])) { 
$today=date("Y-m-d");
?>
<table class=form border=1 cellpadding=0 cellspacing=0>
<?
include ('modul/lap_17.php');
include ('modul/lap_31.php');
include ('modul/lap_41.php');
include ('modul/lap_51.php');
include ('modul/lap_60.php');
include ('modul/lap_pekerjaan1.php');
include ('modul/lap_pekerjaan2.php');
include ('modul/lap_pekerjaan3.php');
include ('modul/lap_pekerjaan4.php');
include ('modul/lap_pekerjaan5.php');
include ('modul/lap_pekerjaan6.php');
include ('modul/lap_pekerjaan7.php');
include ('modul/lap_pekerjaan8.php');
include ('modul/lap_pekerjaan9.php');
include ('modul/lap_pekerjaan10.php');
include ('modul/lap_pekerjaan11.php');
include ('modul/lap_penghargaan1.php');
include ('modul/lap_penghargaan2.php');
include ('modul/lap_penghargaan3.php');
include ('modul/lap_penghargaan4.php');
include ('modul/lap_penghargaan5.php');
include ('modul/lap_ditolak.php');
include ('modul/lap_cekal.php');

$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);
?>
<h1 class="table">Laporan Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h1>

<tr><td rowspan="3">NO</td><td colspan=2 rowspan="3" align=center>KETERANGAN</td><td colspan=4>DONOR SUKARELA (Or)</td><td colspan=4>DONOR PENGGANTI (Or)</td><td colspan=4 align="center">JUMLAH (Or)</td></tr>
<tr>
<td colspan="2" align="center">PRIA</td><td colspan=2 align="center">WANITA</td>
<td colspan="2" align="center">PRIA</td><td colspan=2 align="center">WANITA</td>
<td colspan="2" align="center">PRIA</td><td colspan=2 align="center">WANITA</td></tr>
	<tr>
	<td align="center">BARU</td><td align="center">LAMA</td>
	<td align="center">BARU</td><td align="center">LAMA</td>
	<td align="center">BARU</td><td align="center">LAMA</td>
	<td align="center">BARU</td><td align="center">LAMA</td>
	<td align="center">BARU</td><td align="center">LAMA</td>
	<td align="center">BARU</td><td align="center">LAMA</td></tr>
<tr><td>1</td><td colspan=2>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td>
<td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td></tr>

<tr><td class=input rowspan=6 align="center">A</td>
<td class=input rowspan=5 align="center">UMUR</td>
<td class=input align="center">17 - 30 Tahun</td>
<td class=input><?=$umur1sp[t17]?></td><td class=input><?=$t17lamasp?></td>
<td class=input><?=$umur1sw[t17]?></td><td class=input><?=$t17lamasw?></td>
<td class=input><?=$umur1gp[t17]?></td><td class=input><?=$t17lamagp?></td>
<td class=input><?=$umur1gw[t17]?></td><td class=input><?=$t17lamagw?></td>
<td class=input><?=$jumt17lb?></td><td class=input><?=$jumt17ll?></td>
<td class=input><?=$jumt17wb?></td><td class=input><?=$jumt17wl?></td></tr>
<tr>
<td class=input align="center">31 - 40 Tahun</td>
<td class=input><?=$umur2sp[t31]?></td><td class=input><?=$t31lamasp?></td>
<td class=input><?=$umur2sw[t31]?></td><td class=input><?=$t31lamasw?></td>
<td class=input><?=$umur2gp[t31]?></td><td class=input><?=$t31lamagp?></td>
<td class=input><?=$umur2gw[t31]?></td><td class=input><?=$t31lamagw?></td>
<td class=input><?=$jumt31lb?></td><td class=input><?=$jumt31ll?></td>
<td class=input><?=$jumt31wb?></td><td class=input><?=$jumt31wl?></td></tr>
<tr>
<td class=input align="center">41 - 50 Tahun</td>
<td class=input><?=$umur3sp[t41]?></td><td class=input><?=$t41lamasp?></td>
<td class=input><?=$umur3sw[t41]?></td><td class=input><?=$t41lamasw?></td>
<td class=input><?=$umur3gp[t41]?></td><td class=input><?=$t41lamagp?></td>
<td class=input><?=$umur3gw[t41]?></td><td class=input><?=$t41lamagw?></td>
<td class=input><?=$jumt41lb?></td><td class=input><?=$jumt41ll?></td>
<td class=input><?=$jumt41wb?></td><td class=input><?=$jumt41wl?></td></tr>
<tr>
<td class=input align="center">51 - 60 Tahun</td>
<td class=input><?=$umur4sp[t51]?></td><td class=input><?=$t51lamasp?></td>
<td class=input><?=$umur4sw[t51]?></td><td class=input><?=$t51lamasw?></td>
<td class=input><?=$umur4gp[t51]?></td><td class=input><?=$t51lamagp?></td>
<td class=input><?=$umur4gw[t51]?></td><td class=input><?=$t51lamagw?></td>
<td class=input><?=$jumt51lb?></td><td class=input><?=$jumt51ll?></td>
<td class=input><?=$jumt51wb?></td><td class=input><?=$jumt51wl?></td></tr>
<tr>
<td class=input align="center"> Diatas 60 Tahun</td>
<td class=input><?=$umur5sp[t61]?></td><td class=input><?=$t61lamasp?></td>
<td class=input><?=$umur5sw[t61]?></td><td class=input><?=$t61lamasw?></td>
<td class=input><?=$umur5gp[t61]?></td><td class=input><?=$t61lamagp?></td>
<td class=input><?=$umur5gw[t61]?></td><td class=input><?=$t61lamagw?></td>
<td class=input><?=$jumt61lb?></td><td class=input><?=$jumt61ll?></td>
<td class=input><?=$jumt61wb?></td><td class=input><?=$jumt61wl?></td></tr>
<?
$tot_dspb=$umur1sp[t17]+$umur2sp[t31]+$umur3sp[t41]+$umur4sp[t51]+$umur5sp[t61];
$tot_dspl=$t17lamasp+$t31lamasp+$t41lamasp+$t51lamasp+$t61lamasp;
$tot_dswb=$umur1sw[t17]+$umur2sw[t31]+$umur3sw[t41]+$umur4sw[t51]+$umur5sw[t61];
$tot_dswl=$t17lamasw+$t31lamasw+$t41lamasw+$t51lamasw+$t61lamasw;
$tot_dgpb=$umur1gp[t17]+$umur2gp[t31]+$umur3gp[t41]+$umur4gp[t51]+$umur5gp[t61];
$tot_dgpl=$t17lamagp+$t31lamagp+$t41lamagp+$t51lamagp+$t61lamagp;
$tot_dgwb=$umur1gw[t17]+$umur2gw[t31]+$umur3gw[t41]+$umur4gw[t51]+$umur5gw[t61];
$tot_dgwl=$t17lamagw+$t31lamagw+$t41lamagw+$t51lamagw+$t61lamagw;
$tot_jumdspb=$jumt17lb+$jumt31lb+$jumt41lb+$jumt51lb+$jumt61lb;
$tot_jumdspl=$jumt17ll+$jumt31ll+$jumt41ll+$jumt51ll+$jumt61ll;
$tot_jumdwpb=$jumt17wb+$jumt31wb+$jumt41wb+$jumt51wb+$jumt61wb;
$tot_jumdwpl=$jumt17wl+$jumt31wl+$jumt41wl+$jumt51wl+$jumt61wl;
?>
<tr><td class=form colspan=2 align="center">JUMLAH</td>
<td class=form><?=$tot_dspb?></td><td class=form><?=$tot_dspl?></td>
<td class=form><?=$tot_dswb?></td><td class=form><?=$tot_dswl?></td>
<td class=form><?=$tot_dgpb?></td><td class=form><?=$tot_dgpl?></td>
<td class=form><?=$tot_dgwb?></td><td class=form><?=$tot_dgwl?></td>
<td class=form><?=$tot_jumdspb?><td class=form><?=$tot_jumdspl?></td>
<td class=form><?=$tot_jumdwpb?><td class=form><?=$tot_jumdwpl?></td></tr>

<tr><td class=input rowspan=12 align="center">B</td>
<td class=input rowspan=11 align="center">PEKERJAAN</td>
<td class=input align="center">BUMN</td>
<td class=input><?=$BUMNsp[BUMN]?></td><td class=input><?=$BUMNlamasp?></td>
<td class=input><?=$BUMNsw[BUMN]?></td><td class=input><?=$BUMNlamasw?></td>
<td class=input><?=$BUMNgp[BUMN]?></td><td class=input><?=$BUMNlamagp?></td>
<td class=input><?=$BUMNgw[BUMN]?></td><td class=input><?=$BUMNlamagw?></td>
<td class=input><?=$jumBUMNlb?></td><td class=input><?=$jumBUMNll?></td>
<td class=input><?=$jumBUMNwb?></td><td class=input><?=$jumBUMNwl?></td></tr>
<tr>
<td class=input align="center">TNI</td>
<td class=input><?=$TNIsp[TNI]?></td><td class=input><?=$TNIlamasp?></td>
<td class=input><?=$TNIsw[TNI]?></td><td class=input><?=$TNIlamasw?></td>
<td class=input><?=$TNIgp[TNI]?></td><td class=input><?=$TNIlamagp?></td>
<td class=input><?=$TNIgw[TNI]?></td><td class=input><?=$TNIlamagw?></td>
<td class=input><?=$jumTNIlb?></td><td class=input><?=$jumTNIll?></td>
<td class=input><?=$jumTNIwb?></td><td class=input><?=$jumTNIwl?></td></tr>
<tr>
<td class=input align="center">POLRI</td>
<td class=input><?=$POLRIsp[POLRI]?></td><td class=input><?=$POLRIlamasp?></td>
<td class=input><?=$POLRIsw[POLRI]?></td><td class=input><?=$POLRIlamasw?></td>
<td class=input><?=$POLRIgp[POLRI]?></td><td class=input><?=$POLRIlamagp?></td>
<td class=input><?=$POLRIgw[POLRI]?></td><td class=input><?=$POLRIlamagw?></td>
<td class=input><?=$jumPOLRIlb?></td><td class=input><?=$jumPOLRIll?></td>
<td class=input><?=$jumPOLRIwb?></td><td class=input><?=$jumPOLRIwl?></td></tr>
<tr>
<td class=input align="center">PEGAWAI NEGERI</td>
<td class=input><?=$PNSsp[PNS]?></td><td class=input><?=$PNSlamasp?></td>
<td class=input><?=$PNSsw[PNS]?></td><td class=input><?=$PNSlamasw?></td>
<td class=input><?=$PNSgp[PNS]?></td><td class=input><?=$PNSlamagp?></td>
<td class=input><?=$PNSgw[PNS]?></td><td class=input><?=$PNSlamagw?></td>
<td class=input><?=$jumPNSlb?></td><td class=input><?=$jumPNSll?></td>
<td class=input><?=$jumPNSwb?></td><td class=input><?=$jumPNSwl?></td></tr>
<tr>
<td class=input align="center">PEGAWAI SWASTA</td>
<td class=input><?=$SWASTAsp[SWASTA]?></td><td class=input><?=$SWASTAlamasp?></td>
<td class=input><?=$SWASTAsw[SWASTA]?></td><td class=input><?=$SWASTAlamasw?></td>
<td class=input><?=$SWASTAgp[SWASTA]?></td><td class=input><?=$SWASTAlamagp?></td>
<td class=input><?=$SWASTAgw[SWASTA]?></td><td class=input><?=$SWASTAlamagw?></td>
<td class=input><?=$jumSWASTAlb?></td><td class=input><?=$jumSWASTAll?></td>
<td class=input><?=$jumSWASTAwb?></td><td class=input><?=$jumSWASTAwl?></td></tr>
<tr>
<td class=input align="center">MAHASISWA</td>
<td class=input><?=$mawasp[mawa]?></td><td class=input><?=$mawalamasp?></td>
<td class=input><?=$mawasw[mawa]?></td><td class=input><?=$mawalamasw?></td>
<td class=input><?=$mawagp[mawa]?></td><td class=input><?=$mawalamagp?></td>
<td class=input><?=$mawagw[mawa]?></td><td class=input><?=$mawalamagw?></td>
<td class=input><?=$jummawalb?></td><td class=input><?=$jummawall?></td>
<td class=input><?=$jummawawb?></td><td class=input><?=$jummawawl?></td></tr>
<tr>
<td class=input align="center">PELAJAR</td>
<td class=input><?=$pelasp[pela]?></td><td class=input><?=$pelalamasp?></td>
<td class=input><?=$pelasw[pela]?></td><td class=input><?=$pelalamasw?></td>
<td class=input><?=$pelagp[pela]?></td><td class=input><?=$pelalamagp?></td>
<td class=input><?=$pelagw[pela]?></td><td class=input><?=$pelalamagw?></td>
<td class=input><?=$jumpelalb?></td><td class=input><?=$jumpelall?></td>
<td class=input><?=$jumpelawb?></td><td class=input><?=$jumpelawl?></td></tr>
<tr>
<td class=input align="center">PETANI / BURUH</td>
<td class=input><?=$petanisp[petani]?></td><td class=input><?=$petanilamasp?></td>
<td class=input><?=$petanisw[petani]?></td><td class=input><?=$petanilamasw?></td>
<td class=input><?=$petanigp[petani]?></td><td class=input><?=$petanilamagp?></td>
<td class=input><?=$petanigw[petani]?></td><td class=input><?=$petanilamagw?></td>
<td class=input><?=$jumpetanilb?></td><td class=input><?=$jumpetanill?></td>
<td class=input><?=$jumpetaniwb?></td><td class=input><?=$jumpetaniwl?></td></tr>
<tr>
<td class=input align="center">PEDAGANG</td>
<td class=input><?=$dagangsp[dagang]?></td><td class=input><?=$daganglamasp?></td>
<td class=input><?=$dagangsw[dagang]?></td><td class=input><?=$daganglamasw?></td>
<td class=input><?=$daganggp[dagang]?></td><td class=input><?=$daganglamagp?></td>
<td class=input><?=$daganggw[dagang]?></td><td class=input><?=$daganglamagw?></td>
<td class=input><?=$jumdaganglb?></td><td class=input><?=$jumdagangll?></td>
<td class=input><?=$jumdagangwb?></td><td class=input><?=$jumdagangwl?></td></tr>
<tr>
<td class=input align="center">WIRASWASTA</td>
<td class=input><?=$wirasp[wira]?></td><td class=input><?=$wiralamasp?></td>
<td class=input><?=$wirasw[wira]?></td><td class=input><?=$wiralamasw?></td>
<td class=input><?=$wiragp[wira]?></td><td class=input><?=$wiralamagp?></td>
<td class=input><?=$wiragw[wira]?></td><td class=input><?=$wiralamagw?></td>
<td class=input><?=$jumwiralb?></td><td class=input><?=$jumwirall?></td>
<td class=input><?=$jumwirawb?></td><td class=input><?=$jumwirawl?></td></tr>
<tr>
<td class=input align="center">LAIN - LAIN</td>
<td class=input><?=$lainsp[lain]?></td><td class=input><?=$lainlamasp?></td>
<td class=input><?=$lainsw[lain]?></td><td class=input><?=$lainlamasw?></td>
<td class=input><?=$laingp[lain]?></td><td class=input><?=$lainlamagp?></td>
<td class=input><?=$laingw[lain]?></td><td class=input><?=$lainlamagw?></td>
<td class=input><?=$jumlainlb?></td><td class=input><?=$jumlainll?></td>
<td class=input><?=$jumlainwb?></td><td class=input><?=$jumlainwl?></td></tr>

<?
$tot1_dspb=$BUMNsp[BUMN]+$TNIsp[TNI]+$POLRIsp[POLRI]+$PNSsp[PNS]+$SWASTAsp[SWASTA]
+$mawasp[mawa]+$pelasp[pela]+$petanisp[petani]+$dagangsp[dagang]+$wirasp[wira]+$lainsp[lain];
$tot1_dspl=$BUMNlamasp+$TNIlamasp+$POLRIlamasp+$PNSlamasp+$SWASTAlamasp
+$mawalamasp+$pelalamasp+$petanilamasp+$daganglamasp+$wiralamasp+$lainlamasp;
$tot1_dswb=$umur1sw[BUMN]+$TNIsw[TNI]+$POLRIsw[POLRI]+$PNSsw[PNS]+$SWASTAsw[SWASTA]
+$mawasw[mawa]+$pelasw[pela]+$petanisw[petani]+$dagangsw[dagang]+$wirasw[wira]+$lainsw[lain];
$tot1_dswl=$BUMNlamasw+$TNIlamasw+$POLRIlamasw+$PNSlamasw+$SWASTAlamasw
+$mawalamasw+$pelalamasw+$petanilamasw+$daganglamasw+$wiralamasw+$lainlamasw[lain];
$tot1_dgpb=$BUMNgp[BUMN]+$TNIgp[TNI]+$POLRIgp[POLRI]+$PNSgp[PNS]+$SWASTAgp[SWASTA]
+$mawagp[mawa]+$pelagp[pela]+$petanigp[petani]+$daganggp[dagang]+$wiragp[wira]+$laingp[lain];
$tot1_dgpl=$BUMNlamagp+$TNIlamagp+$POLRIlamagp+$PNSlamagp+$SWASTAlamagp
+$mawalamagp+$pelalamagp+$petanilamagp+$daganglamagp+$wiralamagp+$lainlamagp;
$tot1_dgwb=$BUMNgw[BUMN]+$TNIgw[TNI]+$POLRIgw[POLRI]+$PNSgw[PNS]+$SWASTAgw[SWASTA]
+$mawagw[mawa]+$pelagw[pela]+$petanigw[petani]+$daganggw[dagang]+$wiragw[wira]+$laingw[lain];
$tot1_dgwl=$BUMNlamagw+$TNIlamagw+$POLRIlamagw+$PNSlamagw+$SWASTAlamagw
+$mawalamagw+$pelalamagw+$petanilamagw+$daganglamagw+$wiralamagw+$lainlamagw;
$tot1_jumdspb=$jumBUMNlb+$jumTNIlb+$jumPOLRIlb+$jumPNSlb+$jumSWASTAlb
+$jummawalb+$jumpelalb+$jumpetanilb+$jumdaganglb+$jumwiralb+$jumlainlb;
$tot1_jumdspl=$jumBUMNll+$jumTNIll+$jumPOLRIll+$jumPNSll+$jumSWASTAll
+$jummawall+$jumpelall+$jumpetanill+$jumdagangll+$jumwirall+$jumlainll;
$tot1_jumdwpb=$jumBUMNwb+$jumTNIwb+$jumPOLRIwb+$jumPNSwb+$jumSWASTAwb
+$jummawawb+$jumpelawb+$jumpetaniwb+$jumdagangwb+$jumwirawb+$jumlainwb;
$tot1_jumdwpl=$jumBUMNll+$jumTNIwl+$jumPOLRIwl+$jumPNSwl+$jumSWASTAwl
+$jummawall+$jumpelawl+$jumpetaniwl+$jumdagangwl+$jumwirawl+$jumlainwl;
?>
<tr><td class=form colspan=2 align="center">JUMLAH</td>
<td class=form><?=$tot1_dspb?></td><td class=form><?=$tot1_dspl?></td>
<td class=form><?=$tot1_dswb?></td><td class=form><?=$tot1_dswl?></td>
<td class=form><?=$tot1_dgpb?></td><td class=form><?=$tot1_dgpl?></td>
<td class=form><?=$tot1_dgwb?></td><td class=form><?=$tot1_dgwl?></td>
<td class=form><?=$tot1_jumdspb?><td class=form><?=$tot1_jumdspl?></td>
<td class=form><?=$tot1_jumdwpb?><td class=form><?=$tot1_jumdwpl?></td></tr>

<tr><td class=input rowspan=6 align="center">C</td>
<td class=input rowspan=5 align="center">JUMLAH DONOR YANG 
<br>MENDAPAT PENGHARGAAN</td>
<td class=input align="center">10 Kali</td>
<td class=input>0</td><td class=input><?=$peng1sp[peng1]?></td>
<td class=input>0</td><td class=input><?=$peng1sw[peng1]?></td>
<td class=input>0</td><td class=input><?=$peng1gp[peng1]?></td>
<td class=input>0</td><td class=input><?=$peng1gw[peng1]?></td>
<td class=input>0</td><td class=input><?=$jumpeng1p?></td>
<td class=input>0</td><td class=input><?=$jumpeng1w?></td></tr>
<tr>
<td class=input align="center">25 Kali</td>
<td class=input>0</td><td class=input><?=$peng2sp[peng2]?></td>
<td class=input>0</td><td class=input><?=$peng2sw[peng2]?></td>
<td class=input>0</td><td class=input><?=$peng2gp[peng2]?></td>
<td class=input>0</td><td class=input><?=$peng2gw[peng2]?></td>
<td class=input>0</td><td class=input><?=$jumpeng2p?></td>
<td class=input>0</td><td class=input><?=$jumpeng2w?></td></tr>
<tr>
<td class=input align="center">50 Kali</td>
<td class=input>0</td><td class=input><?=$peng3sp[peng3]?></td>
<td class=input>0</td><td class=input><?=$peng3sw[peng3]?></td>
<td class=input>0</td><td class=input><?=$peng3gp[peng3]?></td>
<td class=input>0</td><td class=input><?=$peng3gw[peng3]?></td>
<td class=input>0</td><td class=input><?=$jumpeng3p?></td>
<td class=input>0</td><td class=input><?=$jumpeng3w?></td></tr>
<tr>
<td class=input align="center">75 Kali</td>
<td class=input>0</td><td class=input><?=$peng4sp[peng4]?></td>
<td class=input>0</td><td class=input><?=$peng4sw[peng4]?></td>
<td class=input>0</td><td class=input><?=$peng4gp[peng4]?></td>
<td class=input>0</td><td class=input><?=$peng4gw[peng4]?></td>
<td class=input>0</td><td class=input><?=$jumpeng4p?></td>
<td class=input>0</td><td class=input><?=$jumpeng4w?></td></tr>
<tr>
<td class=input align="center">100 Kali</td>
<td class=input>0</td><td class=input><?=$peng5sp[peng5]?></td>
<td class=input>0</td><td class=input><?=$peng5sw[peng5]?></td>
<td class=input>0</td><td class=input><?=$peng5gp[peng5]?></td>
<td class=input>0</td><td class=input><?=$peng5gw[peng5]?></td>
<td class=input>0</td><td class=input><?=$jumpeng5p?></td>
<td class=input>0</td><td class=input><?=$jumpeng5w?></td></tr>
<?
$tot2_pengsp=$peng1sp[peng1]+$peng2sp[peng2]+$peng3sp[peng3]+$peng4sp[peng4]+$peng5sp[peng5];
$tot2_pengsw=$peng1sw[peng1]+$peng2sw[peng2]+$peng3sw[peng3]+$peng4sw[peng4]+$peng5sw[peng5];
$tot2_penggp=$peng1gp[peng1]+$peng2gp[peng2]+$peng3gp[peng3]+$peng4gp[peng4]+$peng5gp[peng5];
$tot2_penggw=$peng1gw[peng1]+$peng2gw[peng2]+$peng3gw[peng3]+$peng4gw[peng4]+$peng5gw[peng5];
$tot2_jump=$jumpeng1p+$jumpeng2p+$jumpeng3p+$jumpeng4p+$jumpeng5p;
$tot2_jumw=$jumpeng1w+$jumpeng2w+$jumpeng3w+$jumpeng4w+$jumpeng5w;
?>

<tr><td class=form colspan=2 align="center">JUMLAH</td>
<td class=form>0</td><td class=form><?=$tot2_pengsp?></td>
<td class=form>0</td><td class=form><?=$tot2_pengsw?></td>
<td class=form>0</td><td class=form><?=$tot2_penggp?></td>
<td class=form>0</td><td class=form><?=$tot2_penggw?></td>
<td class=form>0</td><td class=form><?=$tot2_jump?></td>
<td class=form>0</td><td class=form><?=$tot2_jumw?></td></tr>

<tr><td class=input align="center">D</td>
<td class=input colspan=2 align="center">Jumlah Donor Darah di Tolak</td>
<td class=input><?=$tolaksp[tolak]?></td><td class=input><?=$tolaklamasp?></td>
<td class=input><?=$tolaksw[tolak]?></td><td class=input><?=$tolaklamasw?></td>
<td class=input><?=$tolakgp[tolak]?></td><td class=input><?=$tolaklamagp?></td>
<td class=input><?=$tolakgw[tolak]?></td><td class=input><?=$tolaklamagw?></td>
<td class=input><?=$jumtolaklb?></td><td class=input><?=$jumtolakll?></td>
<td class=input><?=$jumtolakwb?></td><td class=input><?=$jumtolakwl?></td></tr>

<tr><td class=input align="center">E</td>
<td class=input colspan=2 align="center">Jumlah Donor Cekal</td>
<td class=input><?=$cekalsp[cekal]?></td><td class=input><?=$cekallamasp?></td>
<td class=input><?=$cekalsw[cekal]?></td><td class=input><?=$cekallamasw?></td>
<td class=input><?=$cekalgp[cekal]?></td><td class=input><?=$cekallamagp?></td>
<td class=input><?=$cekalgw[cekal]?></td><td class=input><?=$cekallamagw?></td>
<td class=input><?=$jumcekallb?></td><td class=input><?=$jumcekalll?></td>
<td class=input><?=$jumcekalwb?></td><td class=input><?=$jumcekalwl?></td></tr>
</table>
<br>
<form name=xls method=post action=modul/lap_kegiatan_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=waktu1 value='<?=$_POST[waktu1]?>'>
<input type=submit name=submit value='Download Rekap (.XLS)'>
</form>
<?
}
?>
<div id="lap_iframe">
</div>
