<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<?
  include('clogin.php');
  include('config/db_connect.php');
?>
<h1 class="list">REKAP CATATAN PENDONOR</h1>
<form name="cari" method="POST" action="<?echo $PHPSELF?>">
	<table>
	<tr>
        <td>Pilih Catatan</td>
					<td class="input">
						 <select name="piagam">
						<option value="0">Semua Catatan</option>
						<option value="1">Piagam DDS 10x</option>
						<option value="2">Piagam DDS 15x</option>
						<option value="3">Piagam DDS 25x</option>
						<option value="4">Piagam DDS 50x</option>
						<option value="5">Piagam DDS 75x</option>
						<option value="6">Piagam DDS 100x</option>
						<option value="7">Souvenir Donor</option>
						<option value="8">Pembenahan Data</option></select>
					</td>
	<td>Pilih Periode : </td>
	<td>
	<input name="waktu" id="datepicker" type=text size=10> Sampai Dengan
	<input name="waktu1" id="datepicker1" type=text size=10>
	</td><td>
	<input type=submit name=submit value="Submit"></td></tr></table>
</form>
<?
if (isset($_POST[submit])){
        $piagam 	= $_POST[piagam];
	$perbln=substr($_POST[waktu],5,2);
	$pertgl=substr($_POST[waktu],8,2);
	$perthn=substr($_POST[waktu],0,4);

	$perbln1=substr($_POST[waktu1],5,2);
	$pertgl1=substr($_POST[waktu1],8,2);
	$perthn1=substr($_POST[waktu1],0,4);

        switch ($piagam){
                       case "1":
				$piagam1="Piagam DDS 10x";break;
                       case "2":
				$piagam1="Piagam DDS 15x";break;
                            case "3":
				$piagam1="Piagam DDS 25x";break;
                            case "4":
				$piagam1="Piagam DDS 50x";break;
                            case "5":
				$piagam1="Piagam DDS 75x";break;
                            case "6":
				$piagam1="SatyaPiagam DDS 100x";break;
                            case "7":
				$piagam1="Penerimaan Souvenir Donor";break;
			    case "8":
				$piagam1="Pembenahan Data Donor";break;
		}

?>
<h3 class="list">Rekap Catatan <?=$piagam1?> Periode <?=$pertgl?> - <?=$perbln?> - <?=$perthn?> sampai dengan <?=$pertgl1?> - <?=$perbln1?> - <?=$perthn1?></h3>

<?
if($piagam=='0'){
    $data=mysql_query("SELECT a.id, a.Kode, b.Nama, a.catatan, a.uraian, a.petugas, DATE_FORMAT( a.tgl, '%d %M %Y' ) AS tanggal
			FROM pendonor_log a
			INNER JOIN pendonor b ON a.Kode = b.Kode
			WHERE date(a.tgl)
                        BETWEEN  '$_POST[waktu]'
                        AND  '$_POST[waktu1]'
                        ORDER BY a.tgl ASC");
	}else{
    $data=mysql_query("SELECT a.id, a.Kode, b.Nama, a.catatan, a.uraian, a.petugas, DATE_FORMAT( a.tgl, '%d %M %Y' ) AS tanggal
			FROM pendonor_log a
			INNER JOIN pendonor b ON a.Kode = b.Kode
			WHERE a.catatan = '$piagam'
                        AND date(a.tgl)
                        BETWEEN  '$_POST[waktu]'
                        AND  '$_POST[waktu1]'
                        ORDER BY a.tgl ASC");
}
?>
<table class="list" cellpadding=5 cellspacing=1>
	<tr class="field">
		<td>No</td>
		<td>Kode Pendonor</td>
		<td>Nama Pendonor</td>
		<td>Catatan</td>
		<td>Uraian</td>
		<td>Tanggal</td>
		<td>Petugas</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		switch ($data1[catatan]){
                       case "1":
				$ket="Piagam DDS 10x";break;
                       case "2":
				$ket="Piagam DDS 15x";break;
                            case "3":
				$ket="Piagam DDS 25x";break;
                            case "4":
				$ket="Piagam DDS 50x";break;
                            case "5":
				$ket="Piagam DDS 75x";break;
                            case "6":
				$ket="SatyaPiagam DDS 100x";break;
                            case "7":
				$ket="Penerimaan Souvenir Donor";break;
			    case "8":
				$ket="Pembenahan Data Donor";break;
		}
	?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[Kode]?></td>
		<td align="left"><?=$data1[Nama]?></td>
		<td align="left"><?=$ket?></td>
		<td><?=$data1[uraian]?></td>
                <td><?=$data1[tanggal]?></td>
                <td><?=$data1[petugas]?></td>
	</tr>
	<? } ?>
</table>
<br>
<form name=xls method=post action=modul/laporan_piagam_xls.php>
<input type=hidden name=pertgl value='<?=$pertgl?>'>
<input type=hidden name=perbln value='<?=$perbln?>'>
<input type=hidden name=perthn value='<?=$perthn?>'>
<input type=hidden name=pertgl1 value='<?=$pertgl1?>'>
<input type=hidden name=perbln1 value='<?=$perbln1?>'>
<input type=hidden name=perthn1 value='<?=$perthn1?>'>
<input type=hidden name=waktu value='<?=$_POST[waktu]?>'>
<input type=hidden name=waktu1 value='<?=$_POST[waktu1]?>'>
<input type=hidden name=piagam value='<?=$_POST[piagam]?>'>
<input type=submit name=submit value='Eksport ke file (.XLS)'>
</form>

<?
}
?>
