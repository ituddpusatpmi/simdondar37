<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
include 'config/db_connect.php';
if ($_POST[submit1]) {
	$kode=$_POST['notrans'];
	$kodepak=$_POST['kodepaket'];
	$jumawal=$_POST['minta'];
	$bagian=$_POST['bagian'];
        $ket=$_POST['ket'];
        $tgl=$_POST['tgl'];
	$upstat=mysql_query("insert into permintaanpaket (NoTrans,KodePaket,jum,
bagian,diberikan,dikembalikan,Keterangan,Tgl,JumDonor,Minus) values 
('$kode','$kodepak','$jumawal','$bagian','','','$ket','$tgl','','')");
	if ($upstat) echo ("Data telah dimasukkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
}
if ($_POST[submit2]) {
	$no=$_POST['notrans'];
	$kode=$_POST['kodepaket'];
	$tgl=$_POST['tgl'];
	$jumdonor=$_POST['jumdonor'];
	$minta=$_POST['minta'];
	$minus=$_POST['minus'];
	for ($i=0;$i<count($no);$i++) {
	$beri=$jumdonor[$i]+$minus[$i];
	$kembali=$minta[$i]-$beri;
	$update=mysql_query("update permintaanpaket set diberikan='$beri',dikembalikan='$kembali',JumDonor='$jumdonor[$i]',Minus='$minus[$i]' where NoTrans='$no[$i]'");
	
	$pak=mysql_fetch_assoc(mysql_query("select jumlah from paket where Kode='$kode[$i]'"));
	$hit=$pak[jumlah]-$beri;
	$update=mysql_query("update paket set jumlah='$hit' 
                        where (Kode='$kode[$i]')");
	$today=date("Y-m-d G:i:s");
	
	$kartu=mysql_query("update kartustokpaket set Kredit='$beri' where KodeBrg='$kode[$i]'");
	$st0=mysql_query("select ip.KodePaket,ip.KodeBrg,stk.Kode,stk.StokTotal from isipaket as ip,hstok as stk where ip.KodePaket='$kode[$i]' and ip.KodeBrg=stk.Kode");
	while($st=mysql_fetch_assoc($st0)) {
	$hitung=$st[StokTotal]-$beri;
	//echo "$hitung $st[StokTotal] $st[Kode] $beri";
	$stok=mysql_query("update hstok set StokTotal='$hitung' 
                        where (Kode='$st[Kode]')");}
}
if ($update) echo ("Data telah dimasukkan !!
    <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">");
}
?>
<h1 class="table">Form Permintaan Paket Mobile</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Pilih Tanggal : </td>
<td class="input">
<input class=text name="waktu" id="datepicker" type=text size=10>
</td></tr>
</table>
<input type=submit name=submit value="Search">
</form>
<?if (isset($_POST[submit])) {
$today=date("Y-m-d");
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$kodet = "F";
//$kodet4 = $today=date("Y");
$kodet5 = substr($perthn,2,2);
//$kodet6 = $today=date("dm");
$kodet6 = $pertgl.$perbln;
$kodet7 = $kodet6.$kodet5;
$kodet1 = mysql_fetch_assoc(mysql_query("select NoTrans from permintaanpaket where substring(NoTrans,2,6)='$kodet7' order by NoTrans desc limit 1"));
$kodet2 = substr($kodet1[NoTrans],8,3);
//$kodet2 = (int)$kodet2;
$kodet3 = $kodet2+1;
$kode_trans=$kodet.$kodet7;
if ($kodet2>="009") {
$digi="0"; } else { $digi="00";}

                //if ($cek[NoTrans]!='') {

?>
<h1 class="table">
Tanggal Minta <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> 
</h1>
<table class=form border=1 cellpadding=0 cellspacing=0>
<form align="left" method="post" action="<?echo $PHPSELF?>">
	<tr>
        <td>No Transaksi</td>
        <td class="input">
        <input type="hidden" name="notrans" value="<?=$kode_trans?>-<?=$digi?><?=$kodet3?>">
        &nbsp <?=$kode_trans?>-<?=$digi?><?=$kodet3?></td>
    </tr>
	<tr>
<td>Pilih Paket :</td><td class="input">
                <select name="kodepaket"><option selected>--Pilih--</option>
                <?
                $pilpak0=mysql_query("select * from paket");
                while($pilpak=mysql_fetch_assoc($pilpak0)) {
                ?>
                 <option value="<?=$pilpak[Kode]?>"><?=$pilpak[Kode]?></option>
                <? }?>
                </select>
        </td>
	</tr>
	<tr>
        <td>Jumlah Diminta</td>
        <td class="input"><input name="minta" type="text" size="5"></td>
        </tr>
	<tr>
        <td>Keterangan</td>
        <td class="input"><input name="ket" type="text" size="25"></td>
        </tr>
</table>
<input type="hidden" name="bagian" value="1">
<input type="hidden" name="tgl" value="<?=$_POST[waktu]?>">
<input type="submit" name="submit1" value="Tambah">
</form>
<? // } 
?>
<h1 class="table">Laporan Paket</h1>
<table class=form border=1 cellpadding=0 cellspacing=0>
<form name="lapor" align="left" method="post" action="<?echo $PHPSELF?>">
<tr class="field">
	  <td>No Transaksi</td>
          <td>Kode Paket</td>
          <td>Tanggal</td>
          <td>Jumlah Awal</td>
          <td>Jumlah Donor</td>
          <td>Minus</td>
   </tr>
<?
$cek0=mysql_query("select * from permintaanpaket where Tgl='$_POST[waktu]' and bagian='1'");
if ($cek0) while ($cek=mysql_fetch_assoc($cek0)) {
if (($cek[jum]!='0') and ($cek[Tgl]==$_POST[waktu]) and ($cek[JumDonor]=='0')) { 
?>
<tr class="record">
        <td class="input"><input name="notrans[]" type="hidden" size="15" value="<?=$cek[NoTrans]?>"><?=$cek[NoTrans]?></td>
        <td class="input"><input name="kodepaket[]" type="hidden" size="15" value="<?=$cek[KodePaket]?>"><?=$cek[KodePaket]?></td>
        <td class="input"><input name="tgl[]" type="hidden" size="15" value="<?=$cek[Tgl]?>"><?=$cek[Tgl]?></td>
        <td class="input"><input name="minta[]" type="hidden" size="5" value="<?=$cek[jum]?>"><?=$cek[jum]?></td>
        <td class="input"><input name="jumdonor[]" type="text" size="5"></td>
        <td class="input"><input name="minus[]" type="text" size="5"></td>
        </tr>
<?
}
}
?>
</table>
<input type="submit" name="submit2" value="Save">
</form>

<?
}
?>

