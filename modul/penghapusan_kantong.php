<script language="javascript">
<!--
function setFocus(){document.buangkantong.nokantong.focus();}
// -->
</script>
<?
include('clogin.php');
include('config/db_connect.php');
$today=date("Y-m-d");
$namauser=$_SESSION[namauser];
if (isset($_POST[submit])) {
	$nkt=strtoupper($_POST[nokantong]);
	$nkt0=mysql_real_escape_string($_POST[nokantong]);
	echo $nkt;
	$nkt1=substr($nkt,0,-1);
    $cek=mysql_query("SELECT noKantong,Status FROM stokkantong WHERE noKantong='$nkt'");
	if (mysql_num_rows($cek)>0){
		//$cekTempat=mysql_fetch_assoc(mysql_query("SELECT StatTempat FROM stokkantong WHERE noKantong='$nkt'"));
	//$nkt1=substr($nkt,0,-1);
			$tambah=mysql_query("delete from stokkantong where noKantong='$nkt' and status='0'"); 
			$data=mysql_query("select * from stokkantong where noKantong='$nkt' ");
			$data1=mysql_fetch_assoc($data); 
			if ($tambah) { 
				//=======Audit Trial====================================================================================
				$log_mdl ='LOGISTIK';
				$log_aksi='Hapus data kantong Logistik: '.$nkt;
				include_once "user_log.php";
				//=====================================================================================================				
				echo ("Data telah dihapus dari batabase !!! <meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"1; URL=$PHP_SELF\">"); 

				?>				
				<table class="form" border="0">
					<tr>
						<td>No Kantong</td>
						<td><?=$data1[noKantong]?></td>
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
		echo "<div class=\"warning\">Kantong yang anda maksud tidak ada<br>
				</div>";
	}	
}?>
	<body onLoad=setFocus()>
	<form name="buangkantong" method="POST" action="<?=$PHPSELF?>">
		<table class="form">
			<tr>
				<td>No Kantong</td>
				<td class="input">
					<input type="text" name="nokantong" maxlength="25" tabindex="1" onChange="javascript:submit();"/>
				</td>
		</table>
			<input name="submit" type="submit" value="Proses">
	</form>

<? $data=mysql_query("select * from stokkantong where noKantong like '%A' and Status='0' order by jenis ASC"); 
$jml=mysql_num_rows($data);
echo "<b> Jumlah Kantong Belum Terpakai Aftap: $jml Kantong</b>";
?>
<table class="list" cellpadding=5>
	<tr class="field">
				<td>No.</td>
		<td>Merk</td>
		<td>Tanggal</td>
		<td>No Kantong</td>
		<td>Jenis</td>
		<td>Tempat & Status</td>
	</tr>
	<?
	$no=0;
	while ($data1=mysql_fetch_assoc($data)) { 
	$no++;
		if ($data1['StatTempat']=='') $tempat="Logistik Belum Dipindahkan";
		if ($data1['StatTempat']=='1') $tempat="Aftap Belum Terpakai";

        switch ($data1['metoda']){
//            case "BS":  $metkantong ="BIASA";        break;
//            case "FT":  $metkantong ="FILTER";       break;
            case "TTB":  $metkantong ="TOP & TOP (Biasa)";    break;
            case "TTF":  $metkantong ="TOP & TOP (Filter)";    break;
            case "TBB":  $metkantong ="TOP & BOTTOM (Biasa)"; break;
            case "TBF":  $metkantong ="TOP & BOTTOM (Filter)"; break;
        }

		switch ($data1['jenis']){
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
                $jenis="Quadruple ($metkantong)";
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
		<td><?=$data1[noKantong]?></td>
		<td><?=$jenis?></td>
		<td><?=$tempat?></td>
	</tr>
<? } ?>
</table>

