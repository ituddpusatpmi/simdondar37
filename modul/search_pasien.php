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
$td0=php_uname('n');
	$td0=strtoupper($td0);
	$td0=substr($td0,0,1);

if ($td0=='S'){

?>
<h1>PENCARIAN DATA PASIEN</h1>
<?
 
$srcno_rm="";
$srcnama="";
$srcalamat="";
$srcgol_darah="";
$srcrhesus="";
$srckelamin="";
$srckeluarga="";
$srctgl_lahir="";
$srctlppasien="";
$srcregrs="";



if ($_POST[no_rm]!='') $srcno_rm=$_POST[no_rm];
if ($_POST[nama]!='') $srcnama=$_POST[nama];
if ($_POST[alamat]!='') $srcalamat=$_POST[alamat];
if ($_POST[gol_darah]!='') $srcgol_darah=$_POST[gol_darah];
if ($_POST[rhesus]!='') $srcrhesus=$_POST[rhesus];
if ($_POST[kelamin]!='') $srckelamin=$_POST[kelamin];
if ($_POST[keluarga]!='') $srckeluarga=$_POST[keluarga];
if ($_POST[tgl_lahir]!='') $srctgl_lahir=$_POST[tgl_lahir];
if ($_POST[tlppasien]!='') $srctlppasien=$_POST[tlppasien];

if ($_POST[regrs]!='') $srcregrs=$_POST[regrs];



//----------------------------
	?>
<body id="dt_example" class="ex_highlight_row">
<form  method=post>
<table>

<tr><td>No. Reg RS / RM Pasien</td><td>:</td><td><input type=text name='regrs' size='25' placeholder="No. Reg RS / RM RS"></td></tr>
<tr><td>Kode Pasien</td><td>:</td><td><input type=text name='no_rm' size='25' placeholder="Kode Pasien"></td></tr>
<tr><td>Nama Pasien</td><td>:</td><td><input type=text name='nama' size='25' placeholder="Nama Pasien"></td></tr>
<tr><td>Alamat</td><td>:</td><td><input type=text name='alamat' size='25' placeholder="Alamat Pasien"></td></tr>

<tr><td>Gol Darah</td><td>:</td><td><select name="gol_darah">
<option value="">SEMUA</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="O">O</option>
<option value="AB">AB</option>
</select></td></tr>

<tr><td>Jenis Kelamin</td><td>:</td><td><select name="kelamin">
<option value="">SEMUA</option>
<option value="L">Laki-Laki</option>
<option value="P">Perempuan</option>
</select></td></tr>

<tr><td>Keluarga</td><td>:</td><td><input type=text name='keluarga' size='25' placeholder="Keluarga"></td></tr>
<tr><td>Tgl Lahir</td><td>:</td><td><input type=text name='tgl_lahir' size='25' placeholder="Tahun-Bulan-Tanggal"></td></tr>
<tr><td>Tlp Pasien</td><td>:</td><td><input type=text name='tlppasien' size='25' placeholder="Tlp Pasien"></td></tr>

<tr>
<td>

</td><td></td><td></td></tr>
</td></tr>
</tr>
</table>
<input type="submit" name="submit" value="Cari Data Pasien" class="swn_button_blue" id="comments">

<?  if ($_SESSION[leveluser]=='kasir2') { ?>



<? 


} ;
?>
</form>

<?

if (isset($_POST[submit])) {

$jd=mysql_query("select distinct k.no_rm,k.nama,k.alamat,k.gol_darah,k.rhesus,k.kelamin,k.keluarga,k.tgl_lahir,k.tlppasien,k.umur from htranspermintaan as s, pasien as k where s.no_rm=k.no_rm and s.regrs like '%$srcregrs%' and k.no_rm like '%$srcno_rm%' and k.nama like '%$srcnama%' and k.alamat like '%$srcalamat%' and k.gol_darah like '%$srcgol_darah%'and k.rhesus like '%$srcrhesus%' and k.kelamin like '%$srckelamin%' and k.keluarga like '%$srckeluarga%' and k.tgl_lahir like '%$srctgl_lahir%' and k.tlppasien like '%$srctlppasien%' and k.umur like '%$srcumur%' order by k.no_rm ASC");


?>
<br><br>
<!--table border=1 cellpadding=5 cellspacing=1 style="border-collapse:collapse" width="110%"-->
		<div id="dynamic">
		<table cellpadding="10" cellspacing="10" border="0" class="display"  width="200%">
			
	<tr style="background-color:#FF6346; font-size:12px; color:#FFFFFF; font-family:Verdana;"  onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">

<!--td align="center">Aksi</td-->
<th align="center">Kode Pasien</th>
<th align="left">Nama Pasien</th>
<th align="left">Alamat</th>
<th align="left">Golongan Darah</th>
<th align="left">Rhesus</th>
<th align="left">Jenis Kelamin</th>
<th align="left">Keluarga</th>
<th align="left">Tgl Lahir</th>
<th align="left">Telepon</th>
<th align="left">Usia</th>


</tr>

<?  
while ($datapasien=mysql_fetch_array($jd)){
$kode=$datapasien['no_rm'];
$today=date('Y-m-d');
if ($datapasien['tipe_dokumen']=='0') 
echo "<tr style=background-color:#FFD700>";

?>

<td  align="left">

<!--Tambah Transaksi -->
<a href="pmikasir2.php?module=addpermintaan&Kode=<? echo $datapasien['no_rm'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/bloodbag.png" width=25 height=15 /></a>

<!--Edit Data Pasien -->
<a href="pmikasir2.php?module=epasien&Kode=<? echo $datapasien['no_rm'] ?>" target="isiadmin" class="fisheyeItem"><img src="../images/ubah.png" width=25 height=15 /></a>

<a href="pmi<?echo $_SESSION[leveluser] ?>.php?module=detailpermintaan&kode=<? echo $datapasien['no_rm']?>" target="isiadmin" class="fisheyeItem"><?=$datapasien['no_rm'] ?></a>
</td>
<td align="left"><?=$datapasien['nama'] ?></td>
<td align="left"><?=$datapasien['alamat'] ?></td>
<td align="center"><?=$datapasien['gol_darah'] ?></td>
<td align="center"><?=$datapasien['rhesus'] ?></td>

<?
if ($datapasien['kelamin']=='L'){
$tipepasien='Laki-Laki';}
if ($datapasien['kelamin']=='P'){
$tipepasien='Perempuan';}
?>
<td align="left"><?=$tipepasien?></td>

<td align="left"><?=$datapasien['keluarga'] ?></td>

<td align="left">
<? $tgllahir=date("d-m-Y",strtotime($datapasien['tgl_lahir'])); 
echo $tgllahir;
?>
</td>

<td align="left"><?=$datapasien['tlppasien'] ?></td>
<td align="left"><?=$datapasien['umur'] ?> Tahun </td>



</tr>
<?
$no++;
} ;}?>
</table><br>
</div>
</body>
<? };?>
