<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link type="text/css" href="css/calender.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="js/tgl_rekap.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9m.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script language="javascript">
<!--
function setFocus(){document.tambahkantong.nokantong.focus();}
// -->
</script>
<?
include('clogin.php');
include('config/db_connect.php');
$today=date("Y-m-d");
$namauser=$_SESSION[namauser];
if (isset($_POST[submit1])) {
	$nkt=strtoupper($_POST[nokantong]);
    $cek=mysql_query("SELECT noKantong FROM stokkantong WHERE noKantong='$nkt'");
	if (mysql_num_rows($cek)==1){
		$cekTempat=mysql_fetch_assoc(mysql_query("SELECT StatTempat FROM stokkantong WHERE noKantong='$nkt'"));
		if ($cekTempat[StatTempat]!='1'){
			$tambah=mysql_query("UPDATE stokkantong set StatTempat='1',tglmutasi='$today'
				where (noKantong='$nkt')"); 
			$data=mysql_query("select * from stokkantong where noKantong='$nkt'");
			$data1=mysql_fetch_assoc($data); 
			if ($tambah) { echo ("Data telah ditambahkan !! <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">"); 
?>				
<table class="form" border="0">
					<tr>
						<td>No Kantong</td>
						<td><?=$data1[noKantong]?></a></td>
					</tr>
					<tr>
						<td>Merk</td>
						<td><?=$data1[merk]?></td>
					</tr>
					<tr>
						<td>Volume</td>	
						<td><?=$data1[volume]?></td>
					<tr>
						<td>Jenis Kantong</td>
						<td><?=$data1[jenis]?></td>
					</tr>
				</table>
			<?}		
		} else {
			echo "<div class=\"warning\">Kantong yang anda maksud sudah disahkan.<br>
					Kantong langsung bisa dipakai</div>";
		}
	} else {
		echo "<div class=\"warning\">Kantong yang anda maksud belum ditambahkan.<br>
				KEMBALIKAN KANTONG KE BAGIAN LOGISTIK!!!!</div>";
	}	
}
/*
$today=date("Y-m-d");
$today1=$today;
*/
if (isset($_POST[terima1])) {$today=$_POST[terima1];$today1=$today;}
if ($_POST[terima2]!='') $today1=$_POST[terima2];
?>
<form name=sahdarah1 method=post> Mulai:
<input type=text name=terima1 id="datepicker" size=10>
Sampai:
<input type=text name=terima2 id="datepicker1" size=10>
<input type=submit name=submit value=Submit>
</form></div>
	<body onLoad=setFocus()>
	<form name="tambahkantong" method="POST" action="<?=$PHPSELF?>">
		<table class="form">
			<tr>
				<td>No Kantong</td>
				<td class="input">
					<input type="text" name="nokantong" maxlength="16" tabindex="1" onChange="javascript:submit1();"/>
				</td>
		</table>
			<input name="submit1" type="submit" value="Simpan">
	</form>

<? 
$data=mysql_query("select * from stokkantong where StatTempat is null and noKantong like '%A'");
if (isset($_POST[terima1])) $data=mysql_query("select * from stokkantong where tglTerima>='$today' and tglTerima<='$today1'  and noKantong like '%A' and StatTempat is null "); ?>

<table class="list" cellpadding=5>
	<tr class="field">
		<td>No</td>
		<td>Merk</td>
		<td>Tanggal</td>
		<td>No Kantong</td>
		<td>Jenis</td>
		<td>Status</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		if ($data1[StatTempat]=='') $tempat="Logistik";
		if ($data1[StatTempat]=='1') $tempat="Lab";
		switch ($data1[jenis]){
                       case "1":
				$jenis="Single";
				break;
                       case "2":
				$jenis="Double";
				break;
                       case "3":
				$jenis="Triple";
				break;
                       case "4":
				$jenis="Quadruple";
				break;
                       case "6":
				$jenis="Pediatrik";
				break;
		}
		?>
	<tr class="record">
		<td><?=$no?></td>
		<td><?=$data1[merk]?></td>
		<td><?=$data1[tglTerima]?></td>
		<td> <a href=modul/klik_sah_kantong.php?noKantong=<?=$data1[noKantong]?>><?=$data1[noKantong]?></a></td>
		<td><?=$jenis?></td>
		<td><?=$tempat?></td>
	</tr>
<? } ?>
</table>

