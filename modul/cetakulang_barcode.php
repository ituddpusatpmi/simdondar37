<head>
<script language=javascript src="./js/cetakulang_barcode.js" type="text/javascript"> </script>
<script language=javascript src="./js/util.js" type="text/javascript"> </script>
<script language="javascript" src="./js/AjaxRequest.js" type="text/javascript"></script>
<style type="text/css">
@import url("css/stok_darah.css");
</style>
<script language="javascript">
function setFocus(){document.tambahkantong.nokantong.focus();}
</script>
</head>
<?
include('clogin.php');
include('config/db_connect.php');
$namauser=$_SESSION[namauser];
$nkt1="";

if (isset($_POST[submit])) {
	for ($i=0; $i<sizeof($_POST[merk1]); $i++) {
		$nmr=$_POST[merk1][$i]; 		$njn=$_POST[jenis1][$i];
		$nst="0"; 						$nvo=$_POST[volume1][$i];
		$nkt=$_POST[no_kantong][$i];	$nkt1 .=$nkt.",";
		$nkt=ereg_replace("[^A-Za-z0-9]", "",strtoupper($nkt));
		$today=date("Y-m-d");
        $tambah=mysql_query("insert into
				stokkantong (noKantong,jenis,Status,tglTerima,volume,merk,volumeasal) 
				values ('$nkt','$njn','$nst','$today','$nvo','$nmr','$nvo')");
	}
	if ($tambah) {
        echo "Data Telah berhasil dimasukkan. ";?>
	<?}
} ?>
	<body onLoad=setFocus()>
	<form name="tambahkantong" onsubmit="return ok()" method="POST" action="<?=$PHPSELF?>">
	<table align=top>
	<tr>
			<td>
<!--INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b')" />
				<!--input name="submit" type="submit" value="Simpan">
<!--input type="button" value="Add" onclick="addRow('box-table-b');"-->
			</td>
			<td> </td>
		</tr>
		<tr>
			<td valign=top>
				<table class="form" border="0" align=top>
					
						<td>Jenis Kantong</td>
						<td class="input">
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
						<? if (!isset($_POST[cetakkantong])) $_POST[cetakkantong]='1';?>
						<td class="input"><INPUT size=2 type="text"  name="cetakkantong" id="cetakkantong" value="<?=$_POST[cetakkantong]?>">
						</td>
					</tr>
					<tr>
						<td>No Kantong</td>
						<td class="input"><INPUT type="text"  name="nokantong" id="nokantong"  
							onkeydown="chang(event,this);" onchange="cari_kantong('box-table-b');">
						</td>
					</tr>
				</table>
			</td>
			<td valign=top>
				<table class="list" id="box-table-b" width=350px align=top>
					<tr class="field">
						<td align='center'></td>
						<td align='center'>No</td>
						<td align='center'>No Kantong</td>
						<!--td align='center'>Volume</td>
						<td align='center'>Merk</td>
						<td align='center'>Jenis</td-->
					</tr>
				</table>
			<!--<INPUT type="button" value="Delete Row" onclick="deleteRow('box-table-b')" />

<input name="submit" type="submit" value="Simpan">
<!--<input type="button" value="Add" onclick="addRow('box-table-b');">--> 
			</td>


		</tr>
	
	</table>
</form>
