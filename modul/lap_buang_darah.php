<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<link type="text/css" href="css/table1.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_lap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<h1 class="table">Laporan Pembuangan Darah UDD PMI</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
<table class="form" cellspacing="0" cellpadding="0">
<tr>
<td>Pilih Periode : </td>
<td class="input">
<input class=text name="waktu" id="datepicker" type=text size=10>Sampai Dengan
<input class=text name="waktu1" id="datepicker1" type=text size=10>
</td><td>
<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?if (isset($_POST[submit])) {
$today=date("Y-m-d");
$perbln=substr($_POST[waktu],5,2);
$pertgl=substr($_POST[waktu],8,2);
$perthn=substr($_POST[waktu],0,4);

$perbln1=substr($_POST[waktu1],5,2);
$pertgl1=substr($_POST[waktu1],8,2);
$perthn1=substr($_POST[waktu1],0,4);
?>
<h1 class="table">Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan
<?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h1>
<table class=form border=1 cellpadding=0 cellspacing=0>
	  <td>No Kantong</td>
          <td>Gol Darah</td>
          <td>Tanggal Aftap</td>
          <td>Tanggal Buang</td>
          <td>Alasan</td>
          <td>Petugas</td>
        </tr>
<tr class="record">
	<?
$buang0=mysql_query("select * from ar_stokkantong where tgl_buang>='$_POST[waktu]' and tgl_buang<='$_POST[waktu1]' order by alasan_buang ASC ");
while ($buang=mysql_fetch_assoc($buang0)) {
?>
	<td class=input><?=$buang[noKantong]?></td>
	<td class=input><?=$buang[gol_darah]?></td>
	<td class=input><?=$buang[tgl_Aftap]?></td>
	<td class=input><?=$buang[tgl_buang]?></td>
<?
switch ($buang[alasan_buang]) {
	case ('0'):
                $alasan="Gagal Aftap";
                break;
        case ('1'):
                $alasan="Lisis";
                break;
        case ('2'):
                $alasan="Kadaluarsa";
                break;
        case ('3'):
                $alasan="Plebotomi";
                break;
}
?>
	<td class=input><?=$alasan?></td>
	<td class=input><?=$buang[user]?></td>
	</tr>
<?
}
?>
</table>
</br>
<form name=xls method=post action=modul/lap_buang_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=waktu1 value='<?=$_POST[waktu1]?>'>
<input type=submit name=submit value='Print Lap Pembuangan Darah (.XLS)'>
</form>
<?
}

?>
