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
session_start();
include("tanggal_indo.php");

//untuk menu mobil unit
	$instan0=mysql_query("select * from detailinstansi where aktif='1'");
	$instan01=mysql_fetch_assoc($instan0);
	$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);
	if ($td0=='M') {
		$ninstan = mysql_num_rows($instan0);
		if ($ninstan!=1)  { echo $pesan="<h1>SILAHKAN <b><a href=pmimobile.php?module=data_jadwal_mobile>PILIH INSTANSI</a></b>  SEBELUM MELANJUTKAN!!!</h1>";}
		else { echo $pesan=$instan01[nama]; 
//		$tempat=mysql_query("update detailinstansi set aktif='0' where aktif='1'");
		};
	};

//selesai mu
$td0;
if ($td0=='M'){
$kinsta=mysql_query("select * from detailinstansi where aktif='1'");
	$kinsta1=mysql_fetch_assoc($kinsta);
	$kinsta1['aktif'];
$rinsta = mysql_num_rows($kinsta);
$rinsta;
	if ($rinsta>=1) {
//selesai

?>
<h1>PENCARIAN DONOR MOBILE UNIT   <b><? echo $pesan ?></b></h1>
<?
 
$srckode="";
$srcNoKTP="";
$srcnama="";
$srcalamat="";
$srckelurahan="";
$srckecamatan="";
$srcwilayah="";
$srctmptlhr="";
$srctgllahir="";
$srcabo="";
$srcrhesus="";
$telp="";

if ($_POST[kode]!='') $srckode=$_POST[kode];
if ($_POST[NoKTP]!='') $srcNoKTP=$_POST[NoKTP];
if ($_POST[nama]!='') $srcnama=$_POST[nama];
if ($_POST[alamat]!='') $srcalamat=$_POST[alamat];
if ($_POST[kelurahan]!='') $srckelurahan=$_POST[kelurahan];
if ($_POST[kecamatan]!='') $srckecamatan=$_POST[kecamatan];
if ($_POST[wilayah]!='') $srcwilayah=$_POST[wilayah];
if ($_POST[tempatlahir]!='') $tempatlahir=$_POST[tempatlahir];
if ($_POST[tgllahir]!='') $srctgllahir=$_POST[tgllahir];
if ($_POST[goldarah]!='') $src_abo=$_POST[goldarah];
if ($_POST[rhesus]!='') $srcrhesus=$_POST[rhesus];
if ($_POST[telp]!='') $srctelp=$_POST[telp];

//----------------------------
	?>
<body id="dt_example" class="ex_highlight_row">
<form  method=post>
<table>
<tr><td>Kode Pendonor</td><td>:</td><td><input type=text name='kode' id='iddonor' size='20' placeholder="ID KARTU DONOR"></td></tr>
<tr><td>No. KTP/Identitas</td><td>:</td><td><input type=text name='NoKTP' size='20' placeholder="No. KTP/Identitas"></td><td>Tempat Lahir</td><td>:</td><td><input type=text name='tempatlahir' size='20' placeholder="Tempat Lahir"></td></tr>
<tr><td>Nama Pendonor</td><td>:</td><td><input type=text id="nama" name='nama' size='25' placeholder="Nama Pendonor"></td><td>Tanggal Lahir</td><td>:</td><td><input type=text name='tgllahir' size='10' placeholder="YYYY-MM-DD"></td></tr>
<tr><td>Alamat</td><td>:</td><td><input type=text id='alamat' name='alamat' size='30' placeholder="Alamat"></td><td>Golongan Darah</td><td>:</td><td><select name="goldarah">
																			<option value="">SEMUA</option>
																			<option value="A">A</option>
																			<option value="B">B</option>
																			<option value="AB">AB</option>
																			<option value="O">O</option>
																			</select></td></tr>
<tr><td>Kelurahan</td><td>:</td><td><input type=text name='kelurahan' size='20' placeholder="Kelurahan"></td>
<td>Rhesus</td><td>:</td><td><select name="rhesus">
																			<option value="">SEMUA</option>
																			<option value="+">(Positif) +</option>
																			<option value="-">(Negatif) -</option>
																			</select></td></tr>
<tr><td>Kecamatan</td><td>:</td><td><input type=text name='kecamatan' size='20' placeholder="Kecamatan"></td><td>No Telp/Hp</td><td>:</td><td><input type=text name='telp' size='13' placeholder="Nomor Handphone"></td></tr>
<tr><td>Wilayah</td><td>:</td><td><input type=text name='wilayah' size='20' placeholder="Wilayah"></td></tr>
<tr>
<td>



</td><td></td><td></td></tr>
</td></tr>
</tr>
</table>
<input type="submit" name="submit" value="Cari Donor Lokal" class="swn_button_blue" id="comments">



<?  if ($_SESSION[leveluser]=='aftap') { ?>
<input type="button" value="Cari Donor Nasional" onClick="document.location.href='pmiaftap.php?module=luarkota'">
<input type="button" value="Donor Baru" onClick="document.location.href='pmiaftap.php?module=registrasi'">

<? } else if ($_SESSION[leveluser]=='kasir') { ?>
<input type="button" value="Cari Donor Nasional" onClick="document.location.href='pmikasir.php?module=luarkota'">
<input type="button" value="Donor Baru" onClick="document.location.href='pmikasir.php?module=registrasi'">
<? } else if ($_SESSION[leveluser]=='mobile') { ?>
<input type="button" value="Cari Donor Nasional" onClick="document.location.href='pmiaftap.php?module=luarkota'">
<input type="button" value="Donor Baru" onClick="document.location.href='pmimobile.php?module=registrasi'">
<? 


} ;
?>
</form>

<?
if (isset($_POST[submit])) {
//$kode=$_POST['kode'];
$jd=mysql_query("select * from pendonor where Kode like '%$srckode%' and NoKTP like '%$srcNoKTP%' and Nama like '%$srcnama%' and Alamat like '%$srcalamat%' and kelurahan like '%$srckelurahan%' and kecamatan like '%$srckecamatan%' and wilayah like '%$srcwilayah%' and TempatLhr like '%$srctmptlhr%' and TglLhr like '%$srctgllahir%' and GolDarah like '%$src_abo%' and Rhesus like '%$srcrhesus%' and telp2 like '%$srctelp%' order by Nama asc");

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
<th align="center">Kelurahan</th>
<th align="center">Kecamatan</th>
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
<th align="center">Kartu</th>
</tr>

<?  
while ($datadonor=mysql_fetch_array($jd)){
$kode=$datadonor['Kode'];
if ($datadonor['Cekal']=='1') 
echo "<tr style=background-color:#FF6346>";
if ($datadonor['Cekal']=='2') 
echo "<tr style=background-color:#00FF00>";
?>
<td  align="center">
<?
if (($datadonor['tglkembali']<= date('Y-m-d')) and ($datadonor['Cekal']=='0')){
?>
<!-- Antri Donor -->
<!--a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=0" target="isiadmin" class="fisheyeItem"--><img src="../images/bloodbag.png" width=25 height=15 /></a> <?} else ?>

<!-- Cetak Kartu -->
<a href="/jqupc/index.php?ext=jpg&idpendonor=<? echo $datadonor['Kode'] ?>"><img src="../images/idcard.png" width=25 height=15></a>

<!--Edit Data Donor -->
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=eregistrasi&Kode=<? echo $datadonor['Kode'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/ubah.png" width=25 height=15 /></a>
<!-- Apheresis -->
<!--//if $datadonor['apheresis']=='1'-->
<?
$td0=php_uname('n');
$td0=strtoupper($td0);
$td0=substr($td0,0,1);
 if ($td0!="M") { ?> 
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=1"><img src="../images/aferesis.png" width=25 height=15></a> 
<? }?>
<br>
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=history&q=<? echo $datadonor['Kode']?>" target="isiadmin" class="fisheyeItem"><?=$datadonor['Kode'] ?></a></td>
<td align="center"><?=$datadonor['Nama'] ?></td>
<td align="center"><?=$datadonor['Alamat'] ?></td>
<td align="center"><?=$datadonor['kelurahan'] ?></td>
<td align="center"><?=$datadonor['kecamatan'] ?></td>
<td align="center"><?=$datadonor['wilayah'] ?></td>
<td align="center"><?=$datadonor['GolDarah'] ?></td>
<td align="center"><?=$datadonor['Rhesus'] ?></td>
<td align="center"><?=$datadonor['apheresis'] ?></td>
<?
if ($datadonor['JK']=='0'){
$jeniskelamin='Laki-Laki';}
if ($datadonor['JK']=='1'){
$jeniskelamin='Perempuan';}

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
if ($datadonor['Cekal']=='0') {
echo "OK";
} if ($datadonor['Cekal']=='1') {
echo "Konfirm ke Dokter";
//echo "<tr style=background-color:#FF6346>";
} 
if ($datadonor['Cekal']=='2') { 
echo "Pernah Cek Ulang IMLTD";
//echo "<tr style=background-color:#00FF00>";
}
?></td>
<td align="center"><?=$datadonor['cetak']="<a href=pmi".$_SESSION[leveluser].".php?module=historycetak&kode=".$kode." TITLE=\"DETIL\">
												".$datadonor['cetak']." kali</a> "?></td>
</tr>
<?
$no++;
} ;}?>
</table>
</div>
</body>
<?};};
$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);

if ($td0=='S'){

?>
<h1>PENCARIAN DONOR</h1>
<?
 
$srckode="";
$srcNoKTP="";
$srcnama="";
$srcalamat="";
$srckelurahan="";
$srckecamatan="";
$srcwilayah="";
$srctmptlhr="";
$srctgllahir="";
$srcabo="";
$srcrhesus="";
$telp="";

if ($_POST[kode]!='') $srckode=$_POST[kode];
if ($_POST[NoKTP]!='') $srcNoKTP=$_POST[NoKTP];
if ($_POST[nama]!='') $srcnama=$_POST[nama];
if ($_POST[alamat]!='') $srcalamat=$_POST[alamat];
if ($_POST[kelurahan]!='') $srckelurahan=$_POST[kelurahan];
if ($_POST[kecamatan]!='') $srckecamatan=$_POST[kecamatan];
if ($_POST[wilayah]!='') $srcwilayah=$_POST[wilayah];
if ($_POST[tempatlahir]!='') $tempatlahir=$_POST[tempatlahir];
if ($_POST[tgllahir]!='') $srctgllahir=$_POST[tgllahir];
if ($_POST[goldarah]!='') $src_abo=$_POST[goldarah];
if ($_POST[rhesus]!='') $srcrhesus=$_POST[rhesus];
if ($_POST[telp]!='') $srctelp=$_POST[telp];

//----------------------------
	?>
<body id="dt_example" class="ex_highlight_row">
<form method=post onsubmit="return validasiregistrasi()">
<table>

<tr><td>Kode Pendonor</td><td>:</td><td><input type=text name='kode' id='iddonor' size='20' placeholder="ID KARTU DONOR"></td></tr>
<tr><td>No. KTP/Identitas</td><td>:</td><td><input type=text name='NoKTP' size='20' placeholder="No. KTP/Identitas"></td><td>Tempat Lahir</td><td>:</td><td><input type=text name='tempatlahir' size='20' placeholder="Tempat Lahir"></td></tr>
<tr><td>Nama Pendonor</td><td>:</td><td><input type=text id="nama" name='nama' size='25' placeholder="Nama Pendonor"></td><td>Tanggal Lahir</td><td>:</td><td><input type=text name='tgllahir' size='10' placeholder="YYYY-MM-DD"></td></tr>
<tr><td>Alamat</td><td>:</td><td><input type=text id='alamat' name='alamat' size='30' placeholder="Alamat"></td><td>Golongan Darah</td><td>:</td><td><select name="goldarah">
																			<option value="">SEMUA</option>
																			<option value="A">A</option>
																			<option value="B">B</option>
																			<option value="AB">AB</option>
																			<option value="O">O</option>
																			</select></td></tr>
<tr><td>Kelurahan</td><td>:</td><td><input type=text name='kelurahan' size='20' placeholder="Kelurahan"></td>
<td>Rhesus</td><td>:</td><td><select name="rhesus">
																			<option value="">SEMUA</option>
																			<option value="+">(Positif) +</option>
																			<option value="-">(Negatif) -</option>
																			</select></td></tr>
<tr><td>Kecamatan</td><td>:</td><td><input type=text name='kecamatan' size='20' placeholder="Kecamatan"></td><td>No Telp/Hp</td><td>:</td><td><input type=text name='telp' size='13' placeholder="Nomor Handphone"></td></tr>
<tr><td>Wilayah</td><td>:</td><td><input type=text name='wilayah' size='20' placeholder="Wilayah"></td></tr>
<tr>
<td>



</td><td></td><td></td></tr>
</td></tr>
</tr>
</table>
<input type="submit" name="submit" value="Cari Donor Lokal" class="swn_button_blue" id="comments">



<?  if ($_SESSION[leveluser]=='aftap') { ?>
<input type="button" value="Cari Donor Nasional" onClick="document.location.href='pmiaftap.php?module=luarkota'">
<input type="button" value="Donor Baru" onClick="document.location.href='pmiaftap.php?module=registrasi'">

<? } else if ($_SESSION[leveluser]=='kasir') { ?>
<input type="button" value="Cari Donor Nasional" onClick="document.location.href='pmikasir.php?module=luarkota'">
<input type="button" value="Donor Baru" onClick="document.location.href='pmikasir.php?module=registrasi'">
<? } else if ($_SESSION[leveluser]=='mobile') { ?>
<input type="button" value="Cari Donor Nasional" onClick="document.location.href='pmiaftap.php?module=luarkota'">
<input type="button" value="Donor Baru" onClick="document.location.href='pmimobile.php?module=registrasi'">
<? 


} ;
?>
</form>

<?

if (isset($_POST[submit])) {
//$kode=$_POST['kode'];
$jd=mysql_query("select * from pendonor where Kode like '%$srckode%' and NoKTP like '%$srcNoKTP%' and Nama like '%$srcnama%' and Alamat like '%$srcalamat%' and kelurahan like '%$srckelurahan%' and kecamatan like '%$srckecamatan%' and wilayah like '%$srcwilayah%' and TempatLhr like '%$srctmptlhr%' and TglLhr like '%$srctgllahir%' and GolDarah like '%$src_abo%' and Rhesus like '%$srcrhesus%' and telp2 like '%$srctelp%' order by Nama asc");

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
<th align="center">Kelurahan</th>
<th align="center">Kecamatan</th>
<th align="center">Wilayah</th>
<th align="center">Gol Darah</th>
<th align="center">Rh</th>
<th align="center">Aphr</th>
<th align="center">Jk</th>
<th align="center">Tempat Lahir</th>
<th align="center">Tanggal Lahir</th>
<th align="center">HP</th>
<th align="center">Telp Rumah</th>
<th align="center">Jumlah Donor</th>
<th align="center">Hasil IMLTD</th>
<th align="center">Cetak Kartu</th>
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
if (date('Y-m-d')>=$datadonor['tglkembali'] and ($datadonor['Cekal']=='0') and (mysql_num_rows($jumtransaksiperempuan) <'4') ){
?>
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=0" target="isiadmin" class="fisheyeItem"><img src="../images/bloodbag.png" width=25 height=15 /></a> <?}} else
//antri Donor Laki-Laki
if ($datadonor[Jk]=='0'){
if (date('Y-m-d')>=$datadonor['tglkembali'] and ($datadonor['Cekal']=='0') ){
?>
<!-- Antri Donor -->
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=0" target="isiadmin" class="fisheyeItem"><img src="../images/bloodbag.png" width=25 height=15 /></a> <?} } else ?>


<!-- Cetak Kartu -->
    <a href="idcard_barcode.php?idpendonor=<? echo $datadonor['Kode'] ?>"><img src="../images/idcard.png" width=25 height=15 /></a>
<!--a href="/jqupc/index.php?ext=jpg&idpendonor=<? echo $datadonor['Kode'] ?>"><img src="../images/idcard.png" width=25 height=15></a-->

<!--Edit Data Donor -->
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=eregistrasi&Kode=<? echo $datadonor['Kode'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/ubah.png" width=25 height=15 /></a>
<!-- Apheresis -->
<?
if (date('Y-m-d')>=$datadonor['tglkembali_apheresis'] and ($datadonor['Cekal']=='0' ) and ($datadonor['apheresis']=='1')  ){
?>
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=transaksi_donor&Kode=<? echo $datadonor['Kode'] ?>&apheresis=1"><img src="../images/aferesis.png" width=25 height=15></a> 
<? };?>

<br>
<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=history&q=<? echo $datadonor['Kode']?>" target="isiadmin" class="fisheyeItem"><?=$datadonor['Kode'] ?></a></td>
<td align="center"><?=$datadonor['Nama'] ?></td>
<td align="center"><?=$datadonor['Alamat'] ?></td>
<td align="center"><?=$datadonor['kelurahan'] ?></td>
<td align="center"><?=$datadonor['kecamatan'] ?></td>
<td align="center"><?=$datadonor['wilayah'] ?></td>
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
<td align="center"><?=$datadonor['telp'] ?></td>
<td align="center"><?=$datadonor['jumDonor'] ?> kali</td>
<td align="center">
<?
if ($datadonor['Cekal']=='0') 
$statusc='OK';
 
if ($datadonor['Cekal']=='1') 
$statusc='Konfirm Ke Dokter';
if ($datadonor['Cekal']=='2') 
$statusc='Pernah Cek Ulang IMLTD';
?></td>
<td align="center"><?=$datadonor['cetak']="<a href=pmi".$_SESSION[leveluser].".php?module=historycetak&kode=".$kode." TITLE=\"DETIL\">
												".$datadonor['cetak']." kali</a> "?></td>
</tr>
<?
$no++;
} ;}?>
</table>
</div>
</body>
<? };?>
<script type="text/javascript">
    function validasiregistrasi()
    {
        if (document.getElementById('iddonor').value == '')
        {
        	if (document.getElementById('nama').value.length < 3)
        	{
            		alert('Pencarian Nama harus diisi/minimal 3 Karakter!');return false;
        	}
        }
//        if (document.getElementById('alamat').value.length == 0)
//        {
//            alert('Alamat diisi dengan jelas dan lengkap ..');return false;
//        }
    }
</script>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
