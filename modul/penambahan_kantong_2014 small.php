<head>
<link type="text/css" href="css/blitzer/suwena.css" rel="stylesheet" />
<script language=javascript src="./js/kantong_2014.js" type="text/javascript"> </script>
<script language=javascript src="./js/util.js" type="text/javascript"> </script>
<script language="javascript" src="./js/AjaxRequest.js" type="text/javascript"></script>
<script language="javascript">
	function setFocus(){document.tambahkantong.nokantong.focus();}
</script>
<style type="text/css">.styled-select select {background-color: #FCF9F9; border: none;width: auto;padding: 3px;font-size: 15px;cursor: pointer; }</style>
</head>
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$nkt1="";

if (isset($_POST[submit])) {
	for ($i=0; $i<sizeof($_POST[merk1]); $i++) {
		$nmr=$_POST[merk1][$i];
		$njn=$_POST[jenis1][$i];
		$nst="0";
		$nvo=$_POST[volume1][$i];
		$nkt=$_POST[no_kantong][$i];
		$nkt1 .=$nkt.",";
		$nkt=ereg_replace("[^A-Za-z0-9]", "",strtoupper($nkt));
		$today=date("Y-m-d");
        $tambah=mysql_query("insert into stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,volumeasal) 
				values ('$nkt','$njn','$nst','$today','$nvo','$nmr','$nvo')");
	}
	if ($tambah) {
	$ident=mysql_query("update stokkantong set ident='m' where nokantong like '%A'");
    echo "Data Telah berhasil dimasukkan. ";?>
	<?}
} ?>
	<body onLoad=setFocus()>
	<font size="4" color=red font-family="Arial">PENAMBAHAN KANTONG DARAH</font><br>
	<form name="tambahkantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
	<table align=top>
		<tr>
			<td valign=top>
				<table class="form" border="0" align=top cellpadding="2" cellspacing="2">
					<tr>
						<td>Tipe Barcode</td>
						<td class="styled-select">
							<select name="tipe_barcode">
							<?
							$select1='';	$select2=''; $select5='';
							$select3='';	$select4=''; $select6='';
							if ($_POST[tipe_barcode]=='C128') $select1='selected';
							if ($_POST[tipe_barcode]=='C128A') $select2='selected';
							if ($_POST[tipe_barcode]=='C128B') $select3='selected';
							if ($_POST[tipe_barcode]=='C39') $select4='selected';
							if ($_POST[tipe_barcode]=='C39E') $select5='selected';
							?>
							<option value="C128" <?=$select1?>>CODE 128 AUT0</option>
							<option value="C128A" <?=$select2?>>CODE 128A</option>
							<option value="C128B" <?=$select3?>>CODE 128B</option>
							<option value="C39" <?=$select4?>>CODE 39</option>
							<option value="C39E" <?=$select5?>>CODE 39 EXTENDED</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Tampilkan Print Dialog?</td>
						<td class="styled-select">
							<select name="dlg">
							<?
							$select1='';	$select2=''; 
							if ($_POST[dlg]=='1') $select1='selected';
							if ($_POST[dlg]=='0') $select2='selected'; 
							?>
							<option value='1' <?=$select1?>>Langsung</option>
							<option value='0' <?=$select2?>>Tidak</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Merk</td>
						<td class="styled-select">
							<select name="merk">
							<?
							$select1='';	$select2='';
							$select3='';	$select4='';
							$select5='';	$select6='';
							$select7='';	
							if ($_POST[merk]=='KARMI') $select1='selected';
							if ($_POST[merk]=='TERUMO') $select2='selected';
							if ($_POST[merk]=='JMS') $select3='selected';
							if ($_POST[merk]=='JML') $select4='selected';
							if ($_POST[merk]=='HLHAEMOPACK') $select5='selected';
							if ($_POST[merk]=='COMTEC') $select6='selected';
							if ($_POST[merk]=='Produk DEMO') $select7='selected';
							?>
							<option value="TERUMO" <?=$select2?>>TERUMO</option>
							<option value="KARMI" <?=$select1?>>KARMI</option>
							<option value="JMS" <?=$select3?>>JMS</option>
							<option value="JML" <?=$select4?>>JML</option>
							<option value="HLHAEMOPACK" <?=$select5?>>HLHAEMOPACK</option>
							<option value="COMTEC" <?=$select6?>>COM.TECH</option>
							<option value="Produk DEMO" <?=$select7?>>Produk DEMO</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Volume</td>	
						<td class="styled-select">
							<select name="volume" >
							<option value="350"  selected> 350 CC</option>
							<option value="250">250 CC</option>
							<option value="200">200 CC</option>
							<option value="450">450 CC</option>
							<option value="500">500 CC</option>
							</select>
						</td>
					<tr>
						<td>Jenis Kantong</td>
						<td class="styled-select">
							<select name="jenis">
							<?
							$select1=''; 	$select2='';
							$select3='';	$select4='';
							$select6='';
							if ($_POST[jenis]=='1') $select1='selected';
							if ($_POST[jenis]=='2') $select2='selected';
							if ($_POST[jenis]=='3') $select3='selected';
							if ($_POST[jenis]=='4') $select4='selected';
							if ($_POST[jenis]=='6') $select6='selected';
							?>
							<option value="1" <?=$select1?>>Single</option>
							<option value="2" <?=$select2?>>Double</option>
							<option value="3" <?=$select3?>>Triple</option>
							<option value="4" <?=$select4?>>Quadruple</option>
							<option value="6" <?=$select6?>>Pediatrik</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jumlah Cetak</td>
						<? if (!isset($_POST[cetakkantong])) $_POST[cetakkantong]='4';?>
						<td "styled-select"><INPUT size=2 type="text"  name="cetakkantong" id="cetakkantong" value="<?=$_POST[cetakkantong]?>">
						</td>
					</tr>
					<tr>
						<td>No Kantong</td>
						<td "styled-select"><INPUT type="text"  name="nokantong" id="nokantong"  
							onkeydown="chang(event,this);" onchange="cari_kantong('box-table-b');">
						</td>
					</tr>
				</table>
			</td>
			<td valign=top>
				<table border=0>
					<tr>
						<td>
							<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b')" class="swn_button_red" />
							<input name="submit" type="submit" value="Simpan" class="swn_button_blue">
						</td>
					</tr>
				</table>
				
				<table class="list" id="box-table-b" width=350px align=top border=1 cellspacing=0 cellpadding=0>
					<tr class="field">
						<th align='center'></th>
						<th align='center'>No</th>
						<th align='center'>Nomor<br>Kantong</th>
						<th align='center'>Volume</th>
						<th align='center'>Merk</th>
						<th align='center'>Jenis</th>
					</tr>
					
				</table>
			</td>
		</tr>
	</table>
</form>
