
<?php
require_once('clogin.php');
require_once('config/db_connect.php');
?>
<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript">
jum_select=0;

function show0(id){
	var campur = document.getElementById('reagen').value;
	var jumtest = campur.split('*');
	if (id=='0') document.getElementById('jenis').innerHTML=jumtest[5]+' -  HBsAg';
	if (id=='1') document.getElementById('jenis').innerHTML=jumtest[5]+' -  HCV';
	if (id=='2') document.getElementById('jenis').innerHTML=jumtest[5]+' -  HIV';
	if (id=='3') document.getElementById('jenis').innerHTML=jumtest[5]+' -  Syphilis';
	document.getElementById('kode').innerHTML = jumtest[0];
	document.getElementById('no_lot').innerHTML = jumtest[6];
	document.getElementById('nama').innerHTML = jumtest[7];
	document.getElementById('jenis').innerHTML = jumtest[5];
	document.getElementById('sisa_test').innerHTML = jumtest[1];
	document.getElementById('reaktif').innerHTML = ">= "+jumtest[2];
	document.getElementById('nonreaktif').innerHTML = "< "+jumtest[3];
	document.getElementById('greyzone').innerHTML = ">= "+jumtest[4];
	if (jumtest[0]==""){
		alert("Reagen harus dipilih")
	}
}

function nextproses(jmlperiksa){
	var campur = document.getElementById('reagen').value;
	var masterreagen = campur.split('*');
	var parameter = masterreagen[8];
	var metode  = masterreagen[5];
	var nolot = masterreagen[6];
	var kode_reagen = masterreagen[0];
	var sisa_tes = masterreagen[1];
	var reaktif = masterreagen[2];
	var nonreaktif = masterreagen[3];
	var greyzone = masterreagen[4];
	if (masterreagen[0]==""){
		alert("Proses tidak bisa dilanjutkan, pilih dulu reagen yang digunakan!!!")
	}else if (sisa_tes<jmlperiksa) {
		alert("Proses input manual IMLTD tidak bisa dilanjutkan. Sisa test reagen kurang dari jumlah kantong yang diperiksa. Ganti dengan Reagen lain!!!")
	}else{
		var konfirmasi = confirm('Lanjutkan ke proses input hasil manual?');
		if (konfirmasi==true){document.location.href='pmiimltd.php?module=import_davincimanualinput&parameter='+parameter+
						'&nolot='+nolot+'&metode='+metode+'&kode_reagen='+kode_reagen+'&sisa_tes='+sisa_tes+'&reaktif='+reaktif+'&nonreaktif='+nonreaktif+'&greyzone='+greyzone;}
	}
}
</script>


<title>Input Manual hasil IMLTD bioM&eacuterieux DaVinci Quatro</title>
</head>
<body>
<?php
$jmlperiksa= $_GET['jmlperiksa'];
$parameter = $_GET['parameter'];
switch ($parameter){
	case "hbsag": $reagendinama="HBsAg";$reagendijenis="HBSAG";
		?><script language="javascript">idreag=0;</script><?
		break;
	case "hcv": $reagendinama="Anti-HCV";$reagendijenis="HCV";
		?><script language="javascript">idreag=1;</script><?
		break;
	case "hiv": $reagendinama="Anti-HIV";$reagendijenis="HIV";
		?><script language="javascript">idreag=2;</script><?
		break;
	case "syp": $reagendinama="Syphilis";$reagendijenis="SYPHILIS";
		?><script language="javascript">idreag=3;</script><?
		break;
}
?>
<form name="manual_input" align="left" method="post" action="<?echo $PHPSELF?>">
	<h2>Import Manual hasil IMLTD <u><?=$reagendinama?></u></h2>
	<table class="list" border=1 cellpadding="5" cellspacing="2">
	<tr class="field">
		<td width="200px" align="left">Pilih Reagen <?=$reagendinama?></td>
		<td align="left">
		<select name="reagen0" id="reagen" onChange="show0(idreag)" STYLE="width: 300px">
			<option value="">Pilih reagen <?=$reagendinama?></option>
				<? 
				$jreagen1=mysql_query("select * from reagen where Nama like '%$parameter%' and aktif='1' and jumTest>0");
				while ($jreagen11=mysql_fetch_assoc($jreagen1)) { 
					$nr1=strtoupper($jreagen11[Nama]);
					$merk1=str_replace($reagendijenis,"",$nr1);
					$merk1=str_replace(" ","",$merk1);
					$merk11=mysql_fetch_assoc(mysql_query("select * from master_reagen where nama_reagen='$merk1'"));
					if ($merk11['nama_reagen']!='') {
						$m_reagen1=mysql_fetch_assoc(mysql_query("select reaktif,nonreaktif,greyzone from master_reagen 
										where nama_reagen='$merk11[nama_reagen]' and jenis_reagen='$reagendijenis'"));?>
						<option value="	<?=$jreagen11[kode]?>*<?=$jreagen11[jumTest]?>*<?=$m_reagen1[reaktif]?>*<?=$m_reagen1[nonreaktif]?>*
										<?=$m_reagen1[greyzone]?>*<?=$jreagen11[metode]?>*<?=$jreagen11[noLot]?>*<?=$jreagen11[Nama]?>*<?=$reagendijenis?>">
										<?=$jreagen11[Nama]?>-<?=$jreagen11[noLot]?>_<?=$jreagen11[jumTest]?> test
						</option><?
					}
				} ?>
		</select>
		</td>
	</tr>
	<tr class="record"><td align="left">Kode Reagen</td><td align="left"><b><div id='kode'></div></b></td></tr>
	<tr class="record"><td align="left">Nama reagen</td><td align="left"><div id='nama'></div></td></tr>
	<tr class="record"><td align="left">Metode</td><td align="left"><b><div id='jenis'></div></b></td></tr>
	<tr class="record"><td align="left">Nomor Lot</td><td align="left"><div id='no_lot'></div></td></tr>
	<tr class="record"><td align="left">Sisa tes dalam kit</td><td align="left"><div id='sisa_test'></div></td></tr>
	<tr class="record"><td align="left">Hasil Reaktif</td><td align="left"><div id='reaktif'></div></td></tr>
	<tr class="record"><td align="left">Hasil Non Reaktif</td><td align="left"><div id='nonreaktif'></div></td></tr>
	<tr class="record"><td align="left">Grey Zone</td><td align="left"><div id='greyzone'></div></td></tr>
	<tr class="record"><td align="left">Jumlah Kantong</td><td align="left"><div id='jmlkantong'></div><?=$jmlperiksa?></td></tr>
	</table>
</form>
<a href="javascript:nextproses(<?=$jmlperiksa?>);" class="swn_button_blue">Input manual <?=$reagendinama?></a>
<a href="pmiimltd.php?module=import_davincikonfirmasi"class="swn_button_blue">Kembali ke konfirmasi</a>
</body>
</html>