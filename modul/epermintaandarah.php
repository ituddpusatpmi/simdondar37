<script language=javascript src="js/jquery-latest.js" type="text/javascript"> </script>
<script language=javascript src="js/alert.js" type="text/javascript"> </script>
<!-- HTML5 Shim, IE8 and bellow recognize HTML5 elements -->
<!-- cookies -->
<script src="js/cookies.js"></script>
<!-- jQuery and jQuery UI -->
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!-- jQuery Placehol -->
<script src="components/placeholder/jquery.placehold-0.2.min.js"></script>
<!-- Form layout -->
<script src="js/html5forms.fallback.js"></script>
<!--script language=javascript src="js/crossmatch.js" type="text/javascript"> </script>
<!--<script language=javascript src="js/konfirmasi_crosmatch.js" type="text/javascript"> </script>-->
<script language="javascript">
	function setFocus(){document.periksa.NoKantong.focus();}
</script>
<body OnLoad="document.cek_form.NoForm.focus();">
<?
include ("config/db_connect.php");
require_once("modul/background_process.php");

$petugas = $_SESSION[nama_lengkap];
$tgl_permintaan=date("Y-m-d");
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$tgl_yesterday=date("Y-m-d",$yesterday);
$td0=php_uname('n');
$td0=substr($td0,0,3);
if ($_POST['periksa']=="1") {
	$NoForm=$_POST['NoForm'];
	$gol_darah=$_POST['goldarah'];
	$rhesus=$_POST['rhesus'];
	$jenisdarah=$_POST['jenisdarah'];
	$layanan=$_POST['layanan'];
	$golDrh=$POST['golDrh'];
	
$myfile0="bdrs/dari-$td0-$tgl_permintaan.zip";
if (file_exists($myfile0)) { $fh0=fopen($myfile0,'a') or die ("Cant open file"); } else { $fh0=fopen($myfile0,'w') or die ("Cant open file"); }
$myfile="bdrs/dari-$td0-$tgl_yesterday.zip";
if (file_exists($myfile)) { $fh=fopen($myfile,'a') or die ("Cant open file"); } else { $fh=fopen($myfile,'w') or die ("Cant open file"); }
	$update_os_sql="update dtranspermintaan set GolDarah ='$_POST[goldarah]', Rhesus ='$rhesus',JenisDarah='$jenisdarah' where NoForm='$NoForm'";
	$update_os=mysql_query($update_os_sql);
			$update_os_sql=base64_encode($update_os_sql.';');
			fwrite($fh0,$update_os_sql);
			fwrite($fh0,"\n");
			fwrite($fh,$update_os_sql);
			fwrite($fh,"\n");
/*
$myfile0="bdrs/dari-$td0-$tgl_permintaan.zip";
if (file_exists($myfile0)) { $fh0=fopen($myfile0,'a') or die ("Cant open file"); } else { $fh0=fopen($myfile0,'w') or die ("Cant open file"); }
$myfile="bdrs/dari-$td0-$tgl_yesterday.zip";
if (file_exists($myfile)) { $fh=fopen($myfile,'a') or die ("Cant open file"); } else { $fh=fopen($myfile,'w') or die ("Cant open file"); }*/
	$update_os_sql1="update htranspermintaan set jenis ='$layanan', golDrh='$_POST[golDrh]',rs='$_POST[rsbaru]' where NoForm='$NoForm'";
	$update_os1=mysql_query($update_os_sql1);
			$update_os_sql1=base64_encode($update_os_sql1.';');
			fwrite($fh0,$update_os_sql1);
			fwrite($fh0,"\n");
			fwrite($fh,$update_os_sql1);
			fwrite($fh,"\n");




	//echo $NoForm;
	for ($i=0;$i<count($_POST['no_kantong']);$i++) {
		$NoKantong=strtoupper($_POST['no_kantong'][$i]);
		$metode=$_POST['metode'][$i];
		$status=$_POST['status'][$i];
		$cross=$_POST['cross'][$i];
		$ket=$_POST['ket'][$i];
		$aglutinasi=$_POST['aglutinasi'][$i];
		$listcomb=$_POST['listcomb'][$i];
		$keluar=$_POST['keluar'][$i];
		$titip=$_POST['titip'][$i];
		$sah=$_POST['sah'];
		$sah1=$_POST['sah1'];
		$sah2=$_POST['sah2'];
		//$ckt=mysql_num_rows(mysql_query("select * from dtransaksipermintaan where NoKantong='$NoKantong' and NoForm='$NoForm'"));
		//if ($ckt==0) {
		//	$tambah_sql="insert into dtransaksipermintaan (`NoForm`, `NoKantong`, `Status`, `MetodeCross`,`StatusCross`,`stat2`, `Ket`, `aglutinasi`, `listcomb`,`petugas`,`cheker`,`mengesahkan`) 
		//		                               values ('$NoForm','$NoKantong','$titip', '$metode',    '$status',    '$cross','$ket','$aglutinasi','$listcomb','$sah2',' $sah1', '$sah')";
				//ON DUPLICATE KEY UPDATE
				//`Status`='$titip',MetodeCross='$metode',StatusCross='$status',stat2='$cross',tgl='$tgl_permintaan'";
			//$update_htrans=mysql_query("update htranspermintaan set stat ='1' where Noform='$NoForm'");
		//	$tambah1_sql="update stokkantong set Status='3' where  (NoKantong='$NoKantong')";
		//	$tambah=mysql_query($tambah_sql);
		//	$tambah1=mysql_query($tambah1_sql);
		//	$tambah_sql=base64_encode($tambah_sql.';');
		//	$tambah1_sql=base64_encode($tambah1_sql.';');
		//	fwrite($fh0,$tambah_sql);
		//	fwrite($fh0,"\n");
		//	fwrite($fh0,$tambah1_sql);
		//	fwrite($fh0,"\n");
		//	fwrite($fh,$tambah_sql);
		//	fwrite($fh,"\n");
		//	fwrite($fh,$tambah1_sql);
		//	fwrite($fh,"\n");
		//}
	}
			fclose($fh0);
			fclose($fh);
	if ($update_os_sql1) {
		backgroundPost('http://localhost/simudda/modul/background_up.php');
		echo "Data Pasien Sudah diedit<br>";
		
		?> <?
	}
	
	$_POST['periksa']="";
}
if ($_POST['periksa']=="") { ?>
	<form name="cek_form" method="post" action="<?=$PHPSELF?>">
			<h2>Masukkan No Formulir dan tekan ENTER</h2>
			<input type="search" name="NoForm" value="<?=$_GET[noform]?>" onkeydown="chang(event,this);" onchange="cari_form(); this.form.submit();">
	</form>

	<h1 class="table">DATA PASIEN</h1>
	<form name="periksa" id="periksa" onsubmit="return ok()" method="POST" action=<?=$PHPSELF?>>

    <?
    $check_h=mysql_query("select * from htranspermintaan where NoForm='$_POST[NoForm]'");
    $check_h1=mysql_fetch_assoc($check_h);
    $check_d=mysql_query("select GolDarah,Rhesus,JenisDarah,sum(Jumlah) as Jumlah,sum(JTitip) as JTitip from dtranspermintaan where NoForm='$_POST[NoForm]'");
    $check_d1=mysql_fetch_assoc($check_d);
	$check_cross=0;
    if (isset($_POST[NoForm])) $check_cross=mysql_num_rows(mysql_query("select * from dtransaksipermintaan where NoForm='$_POST[NoForm]'"));
	$jcross0=$check_d1[Jumlah]-$check_cross;
    ?>
	<input type="hidden" name="jcross" id="jcross" value="<?=$jcross0?>">
	<input name="NoForm" type=hidden value="<?=$check_h1[NoForm]?>">

	<table class="form" border=0 cellspacing=0 cellpadding=2>
		<tr>
			<td>No. Formulir</td>
			<td class="input"><?=$check_h1[NoForm]?></td>
			<td>Nama OS</td>
			<td class="input"><?=$check_h1[NamaOS]?></td>
		</tr>
		<tr>
			<td>Nama RS Asal</font></td>
			<?
			$rmhskt=mysql_fetch_assoc(mysql_query("select NamaRs from rmhsakit where Kode='$check_h1[rs]'"));
			?>
			<td class="input"><?=$rmhskt[NamaRs]?></td>
			<td>Nama Dokter</td>
			<td class="input"><?=$check_h1[NamaDokter]?></td>
		</tr>
		<tr>
			<td>Nama RS Baru</font></td>
			
			<td class="input">
			<select name="rsbaru" >
					<!--option selected>--Pilih--</option-->
					<?php
						$permintaan3="select * from rmhsakit";
						$do3=mysql_query($permintaan3);
						while($data3=mysql_fetch_assoc($do3)){
							$select3="";?>
					<option value="<?=$data3[Kode]?>"<?=$select3?>>
						<?=$data3[NamaRs]?>
					</option>
						<?}?>
				</select>
			</td>
			<td>Jenis Layanan Awal</td>
			<td class="input"><?=$check_h1[jenis]?></td>
		</tr>
		<tr>
			<td>Bagian</td>
			<td class="input"><?=$check_h1[bagian]?></td>
			<!--td>Layanan</td>
			<td> <input type="text" name="layanan" value="<?=$check_h1[jenis]?>"></input></td-->

		<td>Jenis Layanan Baru</td>
			<!--td class="input">
				<input name="jenis" type="text" size="20" placeholder='Umum'>
			</td-->
		<td class="input">
				<? $type5=$check_h1[jenis];
				$select2[$type5]="selected";?>
			<select name="layanan" >
					<!--option selected>--Pilih--</option-->
					<?php
						$permintaan2="select * from jenis_layanan";
						$do2=mysql_query($permintaan2);
						while($data2=mysql_fetch_assoc($do2)){
							$select2="";?>
					<option value="<?=$data2[nama]?>"><?=$select2?>
						<?=$data2[nama]?>
					</option>
						<?}?>
				</select>
			</td>

		</tr>




<tr>
<td>Gol. Darah Pasien</td>
			<td class="input">
				<? $type=$check_h1[golDrh];
				$selected[$type]="selected";?>
				<select name="golDrh">
				<option value="A" <?=$selected["A"]?>>A</option>
				<option value="B" <?=$selected["B"]?>>B</option>
				<option value="AB" <?=$selected["AB"]?>>AB</option>
				<option value="O" <?=$selected["O"]?>>O</option>
				<option value="X" <?=$selected["X"]?>>X</option>
				</select>  Jum. HB :  <?=$check_h1[HB]?>  gr/dl
			</td>
			<td>Gol. Darah Diminta</td>
			<td class="input">
				<? $type=$check_d1[GolDarah];
				$selected[$type]="selected";?>
				<select name="goldarah">
				<option value="A" <?=$selected["A"]?>>A</option>
				<option value="B" <?=$selected["B"]?>>B</option>
				<option value="AB" <?=$selected["AB"]?>>AB</option>
				<option value="O" <?=$selected["O"]?>>O</option>
				<option value="X" <?=$selected["X"]?>>X</option>
				</select>
			</td>
		</tr>

		
		<tr>
			<td>Kelas</td>
			<td class="input"><?=$check_h1[kelas]?></td>
			<td>Rhesus</td>
			<td class="input">
				<? $type=$check_d1[Rhesus];
				$selected[$type]="selected";?>
				<select name="rhesus">
				<option value="+" <?=$selected["+"]?>>+</option>
				<option value="-" <?=$selected["-"]?>>-</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Sudah Crossmatch</td><td><?=$check_cross?></td>

		<td>Jenis Komponen</font></td>
			<td class="input">
				<? $type=$check_d1[JenisDarah];
				$selected[$type]="selected";?>
				<select name="jenisdarah">
				<option value="WB" <?=$selected["WB"]?>>WB</option>
				<option value="PRC" <?=$selected["PRC"]?>>PRC</option>
				<option value="TC" <?=$selected["TC"]?>>TC</option>
				<option value="LP" <?=$selected["LP"]?>>LP</option>
				<option value="FFP" <?=$selected["FFP"]?>>FFP</option>
				<option value="FP" <?=$selected["FP"]?>>FP</option>
				<option value="WE" <?=$selected["WE"]?>>WE</option>
				<option value="AHF" <?=$selected["AHF"]?>>AHF</option>
				</select>
			</td>

		</tr>
		<tr>
			<td>Dibawa</td><td><?=$check_d1[Jumlah]-$check_d1[JTitip]?></td>
			<td>Titip</td><td><?=$check_d1[JTitip]?></td>
		</tr>
		
	</table>
	
	
<br>
	<input name="periksa" type=hidden value="1">
	<input name="submit1" type="submit" value="Simpan">
	</form>
	<?
}
?>
</body>

<!--div class="alert" id="alert">
	<div id="kantong_tdk_sesuai" title="Kantong tidak sesuai..!">
		<p>Silahkan cek kembali kantong yang anda masukkan pada menu CHECK STOK, atau masukkan kantong lain</p>
	</div>
	<div id="kantong_sudah_diinput" title="Kantong sudah diinput..!">
		<p>Silahkan masukkan kantong yang lain</p>
	</div>
	<div id="konfirmasi" title="Golongan darah tidak sama..!">
		<p>Golongan darah tidak sama dengan Golongan Darah yang diminta. Apakah anda yakin?</p>
	</div>
	<div id="gol_darah_tdk_sesuai" title="Golongan darah tidak sama..!">
		<p>Golongan darah tidak sama dengan Golongan Darah yang diminta. Apakah anda yakin?</p>
	</div>
	<div id="kantong_terpenuhi" title="Permintaan terpenuhi..!">
		<p>Jumlah Kantong Sudah terpenuhi!!!</p>
	</div>
</div-->
