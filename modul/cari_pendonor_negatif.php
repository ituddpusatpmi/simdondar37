<style type="text/css" title="currentStyle">
			@import "css/dt_page.css";
			@import "css/dt_table.css";
			@import "css/dt_table_jui.css";
		</style>
		<link type="text/css" href="css/blitzer/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
		<link type="text/css" href="css/TableTools_JUI.css" rel="stylesheet" />
		<script type="text/javascript" language="javascript" src="js/jquery-1.5.2.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/jquery-ui-1.8.9.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>


<script>
			function disabletext(val){ 
				if(val=='0'){
					document.getElementById('comments').hidden = true;
					
}
				else {
					document.getElementById('comments').hidden = false;
					
}
			}
			</script>
<?
include("tanggal_indo.php");


/*$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);

if ($td0=='S'){*/

?>
<h1>PENCARIAN DONOR RHESUS NEGATIF</h1>
<?
 
$srckode="";
$srcnama="";
$srcalamat="";
$srckelurahan="";
$srckecamatan="";
$srcwilayah="";
$srctmptlhr="";
$srctgllahir="";
$src_abo="";
$srcrhesus="";
$telp="";
$aph="";

	if ($_POST[kode]!='')		$srckode=$_POST[kode];
	if ($_POST[nama]!='') 		$srcnama=$_POST[nama];
	if ($_POST[alamat]!='') 	$srcalamat=$_POST[alamat];
	if ($_POST[kelurahan]!='') 	$srckelurahan=$_POST[kelurahan];
	if ($_POST[kecamatan]!='') 	$srckecamatan=$_POST[kecamatan];
	if ($_POST[wilayah]!='') 	$srcwilayah=$_POST[wilayah];
	if ($_POST[tempatlahir]!='') 	$tempatlahir=$_POST[tempatlahir];
	if ($_POST[tgllahir]!='') 	$srctgllahir=$_POST[tgllahir];
	if ($_POST[goldarah]!='') 	$src_abo=$_POST[goldarah];
	if ($_POST[rhesus]!='') 	$srcrhesus=$_POST[rhesus];
	if ($_POST[telp]!='') 		$srctelp=$_POST[telp];
//----------------------------
	?>
<body id="dt_example" class="ex_highlight_row">
<form  method=post>
<table>
<td>Golongan Darah</td>
<td>:</td>
<td><select name="goldarah">
																			<option value="">PILIH</option>
																			<option value="A">A</option>
																			<option value="B">B</option>
																			<option value="AB">AB</option>
																			<option value="O">O</option>
																			<!--/select></td></tr>
<td>Rhesus</td><td>:</td><td><select name="rhesus">
																			<option value="">SEMUA</option>
																			<option value="+">(Positif) +</option>
																			<option value="-">(Negatif) -</option>
																			</select></td></tr-->
<tr>
<td>
<input type="submit" name="submit" value="Cari" class="swn_button_blue" id="comments"> 
</td></tr>
</tr>
</table>

</form>

<?

if (isset($_POST[submit])) {
//$kode=$_POST['kode'];
$jd=mysql_query("select * from pendonor where 
		 COALESCE (Kode,'') like '%$srckode%' and
		 COALESCE (Nama,'') like '%$srcnama%' and 
		 COALESCE (Alamat,'') like '%$srcalamat%' and COALESCE (kelurahan,'') like '%$srckelurahan%' and COALESCE (kecamatan,'') like '%$srckecamatan%' and 			 COALESCE (wilayah,'') like '%$srcwilayah%' and COALESCE (TempatLhr,'') like '%$srctmptlhr%' and COALESCE (TglLhr,'') like '%$srctgllahir%' and 		 COALESCE (Rhesus,'') ='-' and COALESCE (GolDarah,'') = '$src_abo' and COALESCE (telp2,'') like '%$srctelp%' ORDER BY tglkembali DESC");

//$jd=mysql_query("select * from pendonor where Nama like '%$srcnama%' OR Nama like '%$srcnama%'");

?>
<br><br>
<!--table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="110%"-->
		<div id="dynamic">
		<table cellpadding="0" cellspacing="0" border="0" class="display"  width="130%">
			
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

<!--td align="center">Aksi</td-->
<th align="center" width="15%">Kode Pendonor</th>
<th align="center">Nama</th>
<th align="center">Alamat</th>
<th align="center">Wilayah</th>
<th align="center">Gol Darah</th>
<th align="center">Rh</th>
<th align="center">Aphr</th>
<th align="center">Jk</th>
<th align="center">Tempat Lahir</th>
<th align="center">Tanggal Lahir</th>
<th align="center">Telp/Hp</th>
<th align="center">Jumlah Donor</th>
<th align="center">IMLTD</th>
<th align="center">Tgl Kembali Donor</th>
<th align="center">Respon Aph</th>
</tr>

<?  
while ($datadonor=mysql_fetch_array($jd)){
$kode=$datadonor['Kode'];
$today=date('Y-m-d');
if ($datadonor['Cekal']=='1') 
echo "<tr style=background-color:#FF6346>";
if ($datadonor['Cekal']=='2') 
echo "<tr style=background-color:#00FF00>";
?>
<td  align="center">
<?
if ($datadonor[Jk]=='1'){
$tahun=date('Y');
$jumtransaksiperempuan=mysql_query("select * from htransaksi where KodePendonor='$kode' and year(tgl)='$tahun'");
if (date('Y-m-d')>=$datadonor['tglkembali'] and ($datadonor['Cekal']=='0') or ($datadonor['Cekal']=='2') and (mysql_num_rows($jumtransaksiperempuan) <'4') ){
?>
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=0" target="isiadmin" class="fisheyeItem"><img src="../images/bloodbag.png" width=25 height=15 /></a> <?}} else
//antri Donor Laki-Laki
if ($datadonor[Jk]=='0'){
if (date('Y-m-d')>=$datadonor['tglkembali'] and ($datadonor['Cekal']=='0') or ($datadonor['Cekal']=='2') ){
?>
<!-- Antri Donor -->
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=0" target="isiadmin" class="fisheyeItem"><img src="../images/bloodbag.png" width=25 height=15 /></a> <?} } else ?>


<!-- Cetak Kartu -->
<a href="/jqupc/index.php?ext=jpg&idpendonor=<? echo $datadonor['Kode'] ?>"><img src="../images/idcard.png" width=25 height=15></a>

<!--Edit Data Donor -->
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=eregistrasi&Kode=<? echo $datadonor['Kode'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/ubah.png" width=25 height=15 /></a>
<!-- Apheresis -->
<?
if (date('Y-m-d')>=$datadonor['tglkembali_apheresis'] and (($datadonor['Cekal']=='0') or ($datadonor['Cekal']=='2')) and ($datadonor['apheresis']=='1')  ){
?>
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=1"><img src="../images/aferesis.png" width=25 height=15></a> 
<? };?>

<br>
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=history&q=<? echo $datadonor['Kode']?>" target="isiadmin" class="fisheyeItem"><?=$datadonor['Kode'] ?></a></td>
<td align="center"><?=$datadonor['Nama'] ?></td>
<td  align="center"><?=$datadonor['Alamat'] ?></td>
<td  align="center"><?=$datadonor['wilayah'] ?></td>
<td align="center"><?=$datadonor['GolDarah'] ?></td>
<td align="center"><?=$datadonor['Rhesus'] ?></td>
<td align="center"><?=$datadonor['apheresis'] ?></td>
<?
if ($datadonor['Jk']=='0')
$jeniskelamin='Laki-Laki';
if ($datadonor['Jk']=='1')
$jeniskelamin='Perempuan';

?>
<td align="center"><?=$jeniskelamin?></td>
<td align="center"><?=$datadonor['TempatLhr'] ?></td>
<td align="center">
<? $tgllahir=date("d/m/Y",strtotime($datadonor['TglLhr'])); 
echo $tgllahir;
?>
</td>
<td align="center"><?=$datadonor['telp2'] ?></td>
<td align="center"><?=$datadonor['jumDonor'] ?> kali</td>
<td align="center">
<?
if ($datadonor['Cekal']=='0') 
$statusc='OK';
 
if ($datadonor['Cekal']=='1') 
$statusc='Konfirm Ke Dokter';
if ($datadonor['Cekal']=='2') 
$statusc='Pernah Cek Ulang IMLTD';

echo $statusc ?></td>
<td align="center"><?=$datadonor['tglkembali'] ?></td>
<td align="center"><?=$datadonor['respon_aph'] ?></td>
</tr>
<?
$no++;
} ;}?>
</table>
</div>
</body>
<? //};?>
